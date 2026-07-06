<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Transaksi; // Pastikan Model Transaksi di-import jika ada

class SearchController extends Controller
{
    public function globalSearch(Request $request)
    {
        // Ambil input pencarian 'q' dari navbar, default-kan string kosong jika tidak ada
        $keyword = $request->input('q', '');

        // 1. Cari data Buku
        $buku = Buku::where('judul', 'LIKE', "%{$keyword}%")
            ->orWhere('isbn', 'LIKE', "%{$keyword}%")
            ->orWhere('pengarang', 'LIKE', "%{$keyword}%") // sesuaikan pengarang/penulis
            ->get();

        // 2. Cari data Anggota
        $anggota = Anggota::where('nama', 'LIKE', "%{$keyword}%")
            ->orWhere('email', 'LIKE', "%{$keyword}%")
            ->get();

        // 3. Cari data Transaksi (Mencari berdasarkan kode_transaksi)
        // 3. Cari data Transaksi (Mencari berdasarkan kode, nama anggota, ATAU judul buku)
        $transaksi = Transaksi::with(['anggota', 'buku'])
            ->where('kode_transaksi', 'LIKE', "%{$keyword}%")
            ->orWhereHas('anggota', function ($query) use ($keyword) {
                // Menggunakan LOWER untuk memastikan huruf besar/kecil tidak berpengaruh
                $query->whereRaw('LOWER(nama) LIKE ?', ["%".strtolower($keyword)."%"]);
            })
            ->orWhereHas('buku', function ($query) use ($keyword) {
                $query->whereRaw('LOWER(judul) LIKE ?', ["%".strtolower($keyword)."%"]);
            })
            ->get();

        // Bungkus sesuai dengan struktur array $results di Blade Anda
        $results = [
            'buku' => $buku,
            'anggota' => $anggota,
            'transaksi' => $transaksi,
        ];

        // Pastikan melempar 'keyword' dan 'results'
        return view('search.index', compact('keyword', 'results')); 
        // Catatan: Jika nama file blade Anda search/index.blade.php, ubah menjadi 'search.index'
    }
}