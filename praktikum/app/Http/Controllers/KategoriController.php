<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class KategoriController extends Controller
{
    private function getKategoriData() {
        return [
            1 => ['id' => 1, 'nama' => 'Programming', 'deskripsi' => 'Buku pemrograman dan coding dunia IT', 'jumlah_buku' => 25],
            2 => ['id' => 2, 'nama' => 'Desain Grafis', 'deskripsi' => 'Panduan belajar Photoshop, Figma, dan UI/UX', 'jumlah_buku' => 14],
            3 => ['id' => 3, 'nama' => 'Jaringan Komputer', 'deskripsi' => 'Teori dan praktik instalasi Mikrotik & Cisco', 'jumlah_buku' => 18],
            4 => ['id' => 4, 'nama' => 'Sains & Matematika', 'deskripsi' => 'Kumpulan buku rumus eksakta dan penelitian sains', 'jumlah_buku' => 9],
            5 => ['id' => 5, 'nama' => 'Agama & Filsafat', 'deskripsi' => 'Kajian keislaman, akhlak, dan sejarah peradaban', 'jumlah_buku' => 30],
        ];
    }

    public function index()
    {
        $kategori_list = $this->getKategoriData();
        return view('kategori.index', compact('kategori_list'));
    }
    
    public function show($id)
    {
        $all_kategori = $this->getKategoriData();
        if(!isset($all_kategori[$id])) { abort(404, 'Kategori tidak ditemukan'); }
        
        $kategori = $all_kategori[$id];
        
        // Data buku tiruan dalam kategori ini
        $buku_list = [
            ['judul' => 'Koding itu Mudah', 'penerbit' => 'TechMedia', 'stok' => 5],
            ['judul' => 'Mastering Laravel Modern', 'penerbit' => 'Informatika', 'stok' => 3],
        ];
        
        return view('kategori.show', compact('kategori', 'buku_list'));
    }
    
    public function search($keyword)
    {
        $all_kategori = $this->getKategoriData();
        $kategori_list = [];
        
        // Cari kategori yang namanya mengandung kata kunci
        foreach($all_kategori as $kat) {
            if(str_contains(strtolower($kat['nama']), strtolower($keyword))) {
                $kategori_list[] = $kat;
            }
        }
        
        return view('kategori.search', compact('kategori_list', 'keyword'));
    }
}