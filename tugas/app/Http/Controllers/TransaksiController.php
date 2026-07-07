<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::with(['anggota', 'buku' => function ($q) {
            $q->withTrashed(); // ambil buku meski sudah dihapus
        }])
            ->latest()
            ->get();

        // PENGAMAN OTOMATIS: Jika ada status 'Dipinjam' tapi kolom denda > 0 di database,
        // kita paksa reset ke 0 saat halaman dibuka agar tidak mengotori kas keuangan dashboard.
        foreach ($transaksis as $t) {
            if ($t->status === 'Dipinjam' && $t->denda > 0) {
                $t->update(['denda' => 0]);
            }
        }

        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get only anggota aktif
        $anggotas = Anggota::where('status', 'Aktif')->orderBy('nama')->get();

        // Get only buku yang tersedia (stok > 0)
        $bukus = Buku::where('stok', '>', 0)->orderBy('judul')->get();

        return view('transaksi.create', compact('anggotas', 'bukus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'buku_id' => 'required|exists:buku,id',
            'tanggal_pinjam' => 'required|date',
            'keterangan' => 'nullable|string',
        ], [
            'anggota_id.required' => 'Anggota wajib dipilih.',
            'buku_id.required' => 'Buku wajib dipilih.',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // 1. Check stok buku
                $buku = Buku::findOrFail($request->buku_id);
                if ($buku->stok <= 0) {
                    throw new \Exception('Stok buku habis!');
                }

                // 2. Generate kode transaksi
                $kodeTransaksi = $this->generateKodeTransaksi();

                // 3. Calculate tanggal kembali (7 hari dari tanggal pinjam)
                $tanggalKembali = Carbon::parse($request->tanggal_pinjam)->addDays(7);

                // 4. Create transaksi dengan mengunci Denda = 0 & Tanggal Dikembalikan = null
                Transaksi::create([
                    'kode_transaksi' => $kodeTransaksi,
                    'anggota_id' => $request->anggota_id,
                    'buku_id' => $request->buku_id,
                    'tanggal_pinjam' => $request->tanggal_pinjam,
                    'tanggal_kembali' => $tanggalKembali,
                    'status' => 'Dipinjam',
                    'denda' => 0,                          // Dikunci murni 0 saat buat baru
                    'tanggal_dikembalikan' => null,        // Dikunci murni null saat baru pinjam
                    'keterangan' => $request->keterangan,
                ]);

                // 5. Update stok buku (kurang 1)
                $buku->decrement('stok');
            });

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi peminjaman berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal membuat transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaksi = Transaksi::with(['anggota', 'buku'])->findOrFail($id);
        
        $estimasiDenda = 0;
        $keteranganTerlambat = 0;

        // Tampilan di halaman detail HANYA berupa SIMULASI/ESTIMASI sementara, tidak disimpan ke DB
        if ($transaksi->status === 'Dipinjam') {
            $tenggat = Carbon::parse($transaksi->tanggal_kembali)->startOfDay();
            $sekarang = Carbon::now()->startOfDay();

            if ($sekarang->greaterThan($tenggat)) {
                $keteranganTerlambat = $tenggat->diffInDays($sekarang);
                $estimasiDenda = $keteranganTerlambat * 5000;
            }
        }

        return view('transaksi.show', compact('transaksi', 'estimasiDenda', 'keteranganTerlambat'));
    }

    /**
     * Kembalikan buku (update status transaksi).
     */
    public function kembalikan($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        
        // Ambil waktu hari ini saat tombol benar-benar diklik
        $hari_ini = Carbon::now()->startOfDay();
        $tanggal_kembali = Carbon::parse($transaksi->tanggal_kembali)->startOfDay();
        
        $denda = 0;
        
        // HITUNG DENDA MURNI: Hanya dihitung saat tombol benar-benar diklik
        if ($hari_ini->greaterThan($tanggal_kembali)) {
            $hariTerlambat = $tanggal_kembali->diffInDays($hari_ini);
            $tarifDendaPerHari = 5000; 
            
            $denda = intval($hariTerlambat * $tarifDendaPerHari);
        }

        $buku = Buku::find($transaksi->buku_id);

        DB::transaction(function () use ($transaksi, $denda, $buku, $hari_ini) {
            // Update data transaksi & Baru sah simpan nilai denda resmi ke database
            $transaksi->update([
                'tanggal_dikembalikan' => $hari_ini,
                'status' => 'Dikembalikan',
                'denda' => $denda 
            ]);

            // Kembalikan stok buku bertambah 1
            if ($buku) {
                $buku->increment('stok');
            }
        });

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan dengan denda Rp ' . number_format($denda, 0, ',', '.'));
    }

    /**
     * Generate kode transaksi otomatis.
     */
    private function generateKodeTransaksi()
    {
        $lastTransaksi = Transaksi::latest()->first();

        if ($lastTransaksi) {
            $lastNumber = intval(substr($lastTransaksi->kode_transaksi, -3));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return 'TRX-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Hitung denda keterlambatan otomatis.
     */
    private function hitungDenda($transaksi, $tanggalDikembalikan)
    {
        $tenggat = Carbon::parse($transaksi->tanggal_kembali)->startOfDay();
        $realitasKembali = Carbon::parse($tanggalDikembalikan)->startOfDay();

        if ($realitasKembali->greaterThan($tenggat)) {
            $hariTerlambat = $tenggat->diffInDays($realitasKembali);
            return intval($hariTerlambat * 5000);
        }

        return 0;
    }

    public function laporan(Request $request)
    {
        $query = Transaksi::with(['anggota', 'buku']);

        // Filter Range Tanggal
        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal_pinjam', [$request->dari, $request->sampai]);
        }

        // Filter Status
        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        // Filter Anggota
        if ($request->filled('anggota_id')) {
            $query->where('anggota_id', $request->anggota_id);
        }

        $transaksis = $query->latest()->get();

        // Perhitungan Total Ringkasan
        $totalTransaksi = $transaksis->count();
        $totalDenda = $transaksis->sum('denda');
        $anggotaList = Anggota::where('status', 'Aktif')->get();

        return view('transaksi.laporan', compact('transaksis', 'totalTransaksi', 'totalDenda', 'anggotaList'));
    }

    public function exportPdf(Request $request)
    {
        $transaksis = Transaksi::with(['anggota', 'buku'])->get();
        $anggotaList = Anggota::all();
        $totalDenda = $transaksis->sum('denda');
        $totalTransaksi = $transaksis->count();

        $pdf = app('dompdf.wrapper')->loadView('transaksi.laporan_pdf', compact(
            'transaksis',
            'totalDenda',
            'anggotaList',
            'totalTransaksi'
        ));

        return $pdf->download('Laporan-Transaksi-Perpustakaan.pdf');
    }

    public function destroy(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $transaksi = Transaksi::findOrFail($id);

                // Kalau buku masih dipinjam, kembalikan stoknya dulu sebelum dihapus
                if ($transaksi->status == 'Dipinjam') {
                    if ($transaksi->buku) {
                        $transaksi->buku->increment('stok');
                    }
                }

                $transaksi->delete();
            });

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        $query = Transaksi::with(['anggota', 'buku' => function ($q) {
            $q->withTrashed();
        }]);

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('kode_transaksi', 'like', '%' . $request->keyword . '%')
                    ->orWhereHas('anggota', function ($q) use ($request) {
                        $q->where('nama', 'like', '%' . $request->keyword . '%');
                    })
                    ->orWhereHas('buku', function ($q) use ($request) {
                        $q->where('judul', 'like', '%' . $request->keyword . '%');
                    });
            });
        }

        if ($request->filled('tanggal_pinjam')) {
            $query->whereDate('tanggal_pinjam', $request->tanggal_pinjam);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $transaksis = $query->latest()->get();

        return view('transaksi.index', compact('transaksis'));
    }

    public function edit(Transaksi $transaksi)
    {
        $anggota = Anggota::orderBy('nama', 'asc')->get();
        $buku = Buku::orderBy('judul', 'asc')->get();

        return view('transaksi.edit', compact('transaksi', 'anggota', 'buku'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'anggota_id'           => 'required|exists:anggota,id',
            'buku_id'              => 'required|exists:buku,id',
            'tanggal_pinjam'       => 'required|date',
            'tanggal_kembali'      => 'required|date|after_or_equal:tanggal_pinjam',
            'tanggal_dikembalikan' => 'nullable|date',
            'status'               => 'required|in:Dipinjam,Dikembalikan',
            'denda'                => 'nullable|numeric|min:0',
            'keterangan'           => 'nullable|string',
        ], [
            'anggota_id.required'      => 'Anggota harus dipilih.',
            'buku_id.required'         => 'Buku harus dipilih.',
            'tanggal_kembali.after_or_equal' => 'Batas tanggal kembali tidak boleh sebelum tanggal pinjam.',
        ]);

        if (isset($validated['denda'])) {
            $validated['denda'] = intval($validated['denda']);
        }

        $transaksi->update($validated);

        return redirect()
            ->route('transaksi.show', $transaksi)
            ->with('success', 'Data transaksi berhasil diperbarui!');
    }
}