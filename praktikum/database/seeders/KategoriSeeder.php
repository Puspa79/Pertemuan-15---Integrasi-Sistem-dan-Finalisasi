<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_kategori' => 'Programming',
                'deskripsi' => 'Buku seputar dunia pemrograman dan software engineering',
                'icon' => 'code-slash',
                'warna' => 'primary'
            ],
            [
                'nama_kategori' => 'Database',
                'deskripsi' => 'Buku mengenai perancangan dan manajemen basis data',
                'icon' => 'database',
                'warna' => 'success'
            ],
            [
                'nama_kategori' => 'Web Design',
                'deskripsi' => 'Buku tentang desain antarmuka, HTML, CSS, dan UX',
                'icon' => 'palette',
                'warna' => 'info'
            ],
            [
                'nama_kategori' => 'Networking',
                'deskripsi' => 'Buku infrastruktur jaringan, router, dan keamanan komputer',
                'icon' => 'wifi',
                'warna' => 'warning'
            ],
            [
                'nama_kategori' => 'Data Science',
                'deskripsi' => 'Buku analisis data, statistik, dan machine learning',
                'icon' => 'graph-up',
                'warna' => 'danger'
            ],
        ];

        foreach ($data as $item) {
            Kategori::create($item);
        }
    }
}