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

                // 4. Create transaksi
                Transaksi::create([
                    'kode_transaksi' => $kodeTransaksi,
                    'anggota_id' => $request->anggota_id,
                    'buku_id' => $request->buku_id,
                    'tanggal_pinjam' => $request->tanggal_pinjam,
                    'tanggal_kembali' => $tanggalKembali,
                    'status' => 'Dipinjam',
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

        if ($transaksi->status === 'Dipinjam') {
            $tenggat = \Carbon\Carbon::parse($transaksi->tenggat_kembali);
            $sekarang = \Carbon\Carbon::now(); // atau hitung berdasarkan waktu saat ini

            if ($sekarang->gt($tenggat)) {
                $keteranganTerlambat = $sekarang->diffInDays($tenggat);
                
                // Misalkan denda per hari adalah Rp 1.000 (silakan sesuaikan nominalnya)
                $tarifDendaPerHari = 1000; 
                $estimasiDenda = $keteranganTerlambat * $tarifDendaPerHari;
            }
        }

        return view('transaksi.show', compact('transaksi', 'estimasiDenda', 'keteranganTerlambat'));
    }
    /**
     * Kembalikan buku (update status transaksi).
     */
    public function kembalikan(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $transaksi = Transaksi::findOrFail($id);

                if ($transaksi->status === 'Dikembalikan') {
                    throw new \Exception('Buku sudah dikembalikan sebelumnya.');
                }
                // 1. Update transaksi
                $tanggalDikembalikan = now();
                $denda = $this->hitungDenda($transaksi, $tanggalDikembalikan);

                $transaksi->update([
                    'status' => 'Dikembalikan',
                    'tanggal_dikembalikan' => $tanggalDikembalikan,
                    'denda' => $denda,
                ]);

                // 2. Update stok buku (tambah 1)
                $transaksi->buku->increment('stok');
            });

            return redirect()->route('transaksi.show', $id)
                ->with('success', 'Buku berhasil dikembalikan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengembalikan buku: ' . $e->getMessage());
        }
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
     * Hitung denda keterlambatan.
     */
    private function hitungDenda($transaksi, $tanggalDikembalikan)
    {
        $hariTerlambat = $transaksi->tanggal_kembali->diffInDays($tanggalDikembalikan, false);

        if ($hariTerlambat > 0) {
            // Denda Rp 5.000 per hari
            return $hariTerlambat * 5000;
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
        // dd(compact('transaksis'));

        // Perhitungan Total Ringkasan
        $totalTransaksi = $transaksis->count();
        $totalDenda = $transaksis->sum('denda');
        $anggotaList = Anggota::where('status', 'Aktif')->get();

        return view('transaksi.laporan', compact('transaksis', 'totalTransaksi', 'totalDenda', 'anggotaList'));
    }

    public function exportPdf(Request $request)
    {
        // 1. Ambil data transaksi beserta relasinya
        $transaksis = Transaksi::with(['anggota', 'buku'])->get();

        // 2. Ambil data semua anggota (jika dibutuhkan oleh view)
        $anggotaList = \App\Models\Anggota::all();

        // 3. SEBELUMNYA: $totalDenda = 0; -> DIUBAH AGAR MENGHITUNG OTOMATIS:
        $totalDenda = $transaksis->sum('denda');

        // 4. Hitung total baris transaksi
        $totalTransaksi = $transaksis->count();

        // 5. Generate PDF menggunakan data yang sudah valid
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
                    $transaksi->buku->increment('stok');
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
            $q->withTrashed(); // ambil buku meski sudah dihapus
        }]);

        // Filter berdasarkan Keyword (Kode Transaksi / Nama Anggota / Judul Buku)
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

        // Filter berdasarkan Tanggal Pinjam
        if ($request->filled('tanggal_pinjam')) {
            $query->whereDate('tanggal_pinjam', $request->tanggal_pinjam);
        }

        // Filter berdasarkan Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Dapatkan hasil filter terbaru
        $transaksis = $query->latest()->get();

        return view('transaksi.index', compact('transaksis'));
    }

    public function edit(Transaksi $transaksi)
    {
        // 1. Ambil data semua anggota untuk isi select option dropdown
        $anggota = Anggota::orderBy('nama', 'asc')->get();

        // 2. Ambil data semua buku untuk isi select option dropdown
        // Jika Anda menggunakan soft deletes pada model Buku, gunakan Buku::withTrashed()
        $buku = Buku::orderBy('judul', 'asc')->get();

        // 3. Kirim data transaksi, anggota, dan buku ke file Blade yang baru kita ubah kemarin
        return view('transaksi.edit', compact('transaksi', 'anggota', 'buku'));

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Data transaksi berhasil diperbarui!');
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        // 1. Validasi data yang dikirim dari form
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
            // Pesan error kustom (opsional, agar lebih user-friendly)
            'anggota_id.required'      => 'Anggota harus dipilih.',
            'buku_id.required'         => 'Buku harus dipilih.',
            'tanggal_kembali.after_or_equal' => 'Batas tanggal kembali tidak boleh sebelum tanggal pinjam.',
        ]);

        // 2. Eksekusi perubahan ke database
        $transaksi->update($validated);

        // 3. Alihkan halaman kembali ke index dengan pesan sukses
        return redirect()
            ->route('transaksi.show', $transaksi)
            ->with('success', 'Data transaksi berhasil diperbarui!');
    }
}
