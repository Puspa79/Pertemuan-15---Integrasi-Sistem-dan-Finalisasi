# Pertemuan 14 - Pengembalian Buku, Laporan Transaksi & Notifikasi Terlambat
 
**Nama:** Puspa Dwi Setyorini  
**NIM:** 60324003  
**Prodi:** Informatika  
**Semester:** 4  
**Mata Kuliah:** Pemrograman Web II  
**Repository:** [Link GitHub](https://github.com/Puspa79/Tugas-14-Authentication-Transaksi-Peminjaman.git)
 
## Perintah & Fitur Baru yang Dijalankan:
* `Route::put('transaksi/{id}/kembalikan', [TransaksiController::class, 'kembalikan'])`
* `Route::get('transaksi/laporan', [TransaksiController::class, 'laporan'])`
* `Route::get('transaksi/laporan/pdf', [TransaksiController::class, 'exportPdf'])`
* `composer require barryvdh/laravel-dompdf`
* `php artisan make:export TransaksiExport --model=Transaksi`
---
 
## TUGAS 1 - Fitur Pengembalian Buku (40%)
### 1. Deskripsi Fitur
Implementasi lengkap alur pengembalian buku dengan mekanisme perhitungan denda otomatis berbasis selisih hari. Sistem membandingkan tanggal kembali yang ditetapkan dengan tanggal aktual pengembalian; apabila melewati batas waktu, denda sebesar **Rp 5.000/hari** dikalkulasi secara otomatis dan dicatat ke basis data. Antarmuka halaman detail transaksi dilengkapi tombol **"Kembalikan Buku"** yang memanggil method `kembalikan()` pada controller. Stok buku secara otomatis bertambah 1 unit setiap kali proses pengembalian berhasil divalidasi sistem.
 
### 2. Hasil Implementasi Fitur Pengembalian Buku
Tampilan halaman detail transaksi yang memuat informasi peminjaman lengkap, total denda terhitung, serta tombol aksi pengembalian buku.
![Tampilan Detail Transaksi & Tombol Kembalikan](screenshoot/detail_transaksi.png)
 
---
 
## TUGAS 2 - Laporan Transaksi (30%)
### 1. Deskripsi Fitur
Pengembangan halaman laporan transaksi interaktif yang dilengkapi modul filter multi-parameter. Admin dapat menyaring data berdasarkan rentang tanggal (*date range*), status transaksi (Semua / Dipinjam / Dikembalikan), serta anggota tertentu melalui komponen *dropdown*. Halaman merangkum hasil filter dalam bentuk kartu statistik yang menampilkan total transaksi dan total denda secara real-time. Tersedia pula tombol **Export PDF** yang memanggil route `/transaksi/laporan/pdf` dan menghasilkan dokumen laporan siap cetak menggunakan library **barryvdh/laravel-dompdf**.
 
### 2. Hasil Implementasi Fitur Laporan Transaksi
* **Halaman Laporan dengan Filter:** Tampilan form filter multi-parameter yang terintegrasi dengan tabel data dan kartu ringkasan statistik transaksi.
![Halaman Laporan Transaksi](screenshoot/halaman_laporan.png)
* **Hasil Export PDF:** Dokumen laporan `.pdf` yang berhasil diunduh, menyajikan data transaksi terstruktur lengkap dengan total transaksi dan total denda.
![Hasil Export PDF](screenshoot/hasil_laporan.png)
---
 
## TUGAS 3 - Notifikasi Terlambat (30%)
### 1. Deskripsi Fitur
Penambahan modul notifikasi keterlambatan pengembalian buku yang terintegrasi di tiga titik antarmuka secara bersamaan. Dashboard utama diperkaya dengan *widget card* **"Buku Terlambat"** yang menampilkan jumlah transaksi melewati tenggat beserta daftar nama anggota yang bersangkutan. Pada halaman index transaksi, setiap entri yang melampaui tanggal kembali secara otomatis mendapat *badge* merah bertuliskan **"Terlambat"** disertai keterangan jumlah hari keterlambatan. Halaman detail transaksi menampilkan blok peringatan (*warning banner*) secara kondisional apabila status pengembalian sudah melewati batas waktu yang ditentukan.
 
### 2. Hasil Implementasi Fitur Notifikasi Terlambat
* **Dashboard Widget Buku Terlambat:** Card statistik pada dashboard yang memuat jumlah transaksi terlambat dan daftar anggota yang belum mengembalikan buku tepat waktu.
![Widget Buku Terlambat di Dashboard](screenshoot/badge_terlambat.png)
* **Badge Terlambat di Index Transaksi:** Penanda visual berwarna merah yang muncul secara otomatis pada baris transaksi yang melewati tenggat, disertai informasi jumlah hari keterlambatan.
![Badge Terlambat](screenshoot/terlambat_halamanTransaksi.png)
* **Warning Banner di Detail Transaksi:** Blok peringatan yang tampil secara kondisional di halaman detail apabila buku belum dikembalikan dan sudah melampaui tanggal kembali yang ditetapkan.
![Warning Banner Detail Transaksi](screenshoot/warning_terlambat.png)