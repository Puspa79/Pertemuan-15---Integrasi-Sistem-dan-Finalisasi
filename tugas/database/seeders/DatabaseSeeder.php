<?php

namespace Database\Seeders;

// use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void {

        DB::table('users')->insert([
            'name' => 'Puspa Dwi',
            'email' => 'puspa@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), 
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Buat Data Anggota Contoh
        $anggota1 = DB::table('anggota')->insertGetId([
            'nama' => 'Randi Wijaya',
            'umur' => 20,
            'jenis_kelamin' => 'Laki-laki',
            'status' => 'Aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Buat Data Buku Contoh
        $buku1 = DB::table('buku')->insertGetId([
            'judul' => 'Belajar Laravel 11',
            'stok' => 5,
            'harga' => 85000,
            'tahun_terbit' => 2024,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. Masukkan Isi Tabel Transaksi
        DB::table('transaksis')->insert([
            [
                'kode_transaksi' => 'TRX-' . date('Ymd') . '-001',
                'anggota_id' => $anggota1,
                'buku_id' => $buku1,
                'tanggal_pinjam' => now()->format('Y-m-d'),
                'tanggal_kembali' => now()->addDays(7)->format('Y-m-d'), // Otomatis durasi 7 hari
                'status' => 'Dipinjam',
                'keterangan' => 'Pinjam untuk tugas praktikum',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
}
}