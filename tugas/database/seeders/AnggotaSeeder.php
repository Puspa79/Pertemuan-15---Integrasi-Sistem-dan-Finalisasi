<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        // Mengosongkan data lama terlebih dahulu agar tidak double
        DB::table('anggota')->truncate();

        DB::table('anggota')->insert([
            [
                'nama' => 'Puspa Dwi',
                'umur' => 19,
                'jenis_kelamin' => 'P',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Setyorini',
                'umur' => 25,
                'jenis_kelamin' => 'P',
                'status' => 'nonaktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Budi Santoso',
                'umur' => 55,
                'jenis_kelamin' => 'L',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ahmad Dhani',
                'umur' => 30,
                'jenis_kelamin' => 'L',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Dewi Lestari',
                'umur' => 28,
                'jenis_kelamin' => 'P',
                'status' => 'nonaktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}