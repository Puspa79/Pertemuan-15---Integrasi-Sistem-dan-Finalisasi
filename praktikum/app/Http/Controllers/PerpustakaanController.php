<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class PerpustakaanController extends Controller
{
    // 1. Method untuk halaman utama (Daftar Buku)
    public function index()
    {
        $nama_sistem = "Sistem Perpustakaan Laravel";
        $versi = "12.x";
        $total_buku = 5;
        
        $buku_list = [
            ['id' => 1, 'judul' => 'Pemrograman PHP', 'pengarang' => 'Budi Raharjo', 'harga' => 75000, 'stok' => 10],
            ['id' => 2, 'judul' => 'Laravel Framework', 'pengarang' => 'Andi Nugroho', 'harga' => 125000, 'stok' => 5],
            ['id' => 3, 'judul' => 'MySQL Database', 'pengarang' => 'Siti Aminah', 'harga' => 95000, 'stok' => 0],
            ['id' => 4, 'judul' => 'Web Design', 'pengarang' => 'Dedi Santoso', 'harga' => 85000, 'stok' => 8],
            ['id' => 5, 'judul' => 'JavaScript Modern', 'pengarang' => 'Rina Wijaya', 'harga' => 80000, 'stok' => 12]
        ];
        
        return view('perpustakaan.index', compact('nama_sistem', 'versi', 'total_buku', 'buku_list'));
    }
    
    // 2. Method untuk melihat detail satu buku berdasarkan ID
    public function show($id)
    {
        $buku_list = [
            1 => [
                'id' => 1, 'judul' => 'Pemrograman PHP', 'pengarang' => 'Budi Raharjo', 
                'penerbit' => 'Informatika', 'tahun' => 2023, 'harga' => 75000, 'stok' => 10,
                'deskripsi' => 'Buku panduan lengkap pemrograman PHP dari dasar hingga advanced'
            ],
            2 => [
                'id' => 2, 'judul' => 'Laravel Framework', 'pengarang' => 'Andi Nugroho', 
                'penerbit' => 'Graha Ilmu', 'tahun' => 2024, 'harga' => 125000, 'stok' => 5,
                'deskripsi' => 'Membangun aplikasi web modern dengan Laravel framework'
            ]
        ];
        
        // Jika ID buku tidak ada di array, munculkan error 404
        if (!isset($buku_list[$id])) {
            abort(404, 'Buku tidak ditemukan');
        }
        
        $buku = $buku_list[$id];
        
        return view('perpustakaan.show', compact('buku'));
    }
    
    // 3. Method untuk halaman About (Tentang Mahasiswa)
    public function about()
    {
        $info = [
            'nama' => 'Sistem Perpustakaan Laravel',
            'versi' => '1.0.0',
            'deskripsi' => 'Sistem manajemen perpustakaan berbasis Laravel framework',
            'developer' => 'Nama Anda / Nama Mahasiswa',
            'tahun' => date('Y')
        ];
        
        return view('perpustakaan.about', compact('info'));
    }
}