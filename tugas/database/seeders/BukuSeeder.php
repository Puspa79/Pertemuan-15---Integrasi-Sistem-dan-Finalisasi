<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku; // <-- Digunakan di bawah

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        // Mengosongkan data menggunakan Eloquent Model
        Buku::truncate();

        // Memasukkan data menggunakan Eloquent Model
        Buku::insert([
            [
                'judul' => 'Belajar Laravel 11 untuk Pemula',
                'stok' => 20,
                'harga' => 150000,
                'tahun_terbit' => 2025,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Mastering MySQL Database',
                'stok' => 3,
                'harga' => 95000,
                'tahun_terbit' => 2024,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Jaringan Komputer Dasar',
                'stok' => 0,
                'harga' => 75000,
                'tahun_terbit' => 2022,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Algoritma Pemrograman C++',
                'stok' => 10,
                'harga' => 110000,
                'tahun_terbit' => 2021,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Data Science Modern',
                'stok' => 15,
                'harga' => 125000,
                'tahun_terbit' => 2026,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}