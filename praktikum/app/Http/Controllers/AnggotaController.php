<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;
use App\Exports\AnggotaExport;
use Maatwebsite\Excel\Facades\Excel;
 
class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggotas = Anggota::latest()->get();
        
        // Statistik
        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'Aktif')->count();
        $anggotaNonaktif = Anggota::where('status', 'Nonaktif')->count();
        
        return view('anggota.index', compact(
            'anggotas',
            'totalAnggota',
            'anggotaAktif',
            'anggotaNonaktif'
        ));
    }
 
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.show', compact('anggota'));
    }
 
    // Methods lainnya akan diimplementasi di pertemuan 13
    public function create()
    {
        $kodeAnggota = $this->generateKodeAnggota();
        return view('anggota.create', compact('kodeAnggota'));
    }

    public function store(StoreAnggotaRequest $request)
    {
        // 1. Jalankan Validasi Terlebih Dahulu
        $validatedData = $request->validate([
            'kode_anggota'   => 'required|unique:anggota,kode_anggota',
            'nama'           => 'required|string|max:255',
            'email'          => 'required|email|unique:anggota,email',
            'telepon'        => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'alamat'         => 'required|string',
            'tanggal_lahir'  => 'required|date|before:today',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'pekerjaan'      => 'nullable|string|max:100',
            'tanggal_daftar' => 'required|date',
            'status'         => 'required|in:Aktif,Nonaktif',
        ]);

        // 2. Simpan menggunakan data yang sudah tervalidasi agar semua field masuk ke SQL
        Anggota::create($validatedData);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit(string $id) {
    $anggota = Anggota::findOrFail($id);
    return view('anggota.edit', compact('anggota'));
    }

    public function update(UpdateAnggotaRequest $request, string $id)
    {
        try {
            $anggota = Anggota::findOrFail($id);
            
            // Update anggota dengan validated data
            $anggota->update($request->validated());
            
            // Redirect dengan success message
            return redirect()->route('anggota.show', $anggota->id)
                            ->with('success', 'Data anggota berhasil diupdate!');
                            
        } catch (\Exception $e) {
            // Redirect dengan error message jika gagal
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Gagal mengupdate anggota: ' . $e->getMessage());
        }
    }
    
    public function destroy(string $id)
    {
        try {
            $anggota = Anggota::findOrFail($id);
            $namaAnggota = $anggota->nama;
            
            // Delete anggota
            $anggota->delete();
            
            // Redirect dengan success message
            return redirect()->route('anggota.index')
                            ->with('success', "Anggota '{$namaAnggota}' berhasil dihapus!");
                            
        } catch (\Exception $e) {
            // Redirect dengan error message jika gagal
            return redirect()->back()
                            ->with('error', 'Gagal menghapus anggota: ' . $e->getMessage());
        }
    }

    private function generateKodeAnggota()
    {
        $tahun = date('Y');
        // Mencari anggota terakhir yang didaftarkan pada tahun berjalan
        $lastAnggota = Anggota::whereYear('created_at', $tahun)
                            ->orderBy('kode_anggota', 'desc')
                            ->first();
        
        if ($lastAnggota) {
            // Mengambil 3 digit angka terakhir dari string kode_anggota
            $lastNumber = intval(substr($lastAnggota->kode_anggota, -3));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        // Format menjadi AGT-[TAHUN]-[NOMOR_URUT] pad dengan 0 (misal: 001)
        return 'AGT-' . $tahun . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function export()
    {
        return Excel::download(new AnggotaExport, 'anggota_' . date('Y-m-d_His') . '.xlsx');
    }

    public function search(Request $request)
    {
        $query = Anggota::query();
        
        // Filter berdasarkan Keyword (Nama / Email / Telepon)
        if ($request->keyword) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->keyword . '%')
                ->orWhere('email', 'like', '%' . $request->keyword . '%')
                ->orWhere('telepon', 'like', '%' . $request->keyword . '%');
            });
        }
        
        // Filter berdasarkan Jenis Kelamin
        if ($request->jenis_kelamin) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }
        
        // Filter berdasarkan Status
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        // Filter berdasarkan Pekerjaan
        if ($request->pekerjaan) {
            $query->where('pekerjaan', $request->pekerjaan);
        }
        
        // Dapatkan hasil filter terbaru
        $anggotas = $query->latest()->get();
        
        // Hitung ulang statistik berdasarkan hasil pencarian agar sinkron di card atas
        $totalAnggota = $anggotas->count();
        $anggotaAktif = $anggotas->where('status', 'Aktif')->count();
        $anggotaNonaktif = $anggotas->where('status', 'Nonaktif')->count();
        
        return view('anggota.index', compact(
            'anggotas',
            'totalAnggota',
            'anggotaAktif',
            'anggotaNonaktif'
        ));
    }
}