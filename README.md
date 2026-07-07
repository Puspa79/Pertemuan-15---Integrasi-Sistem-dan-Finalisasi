# Sistem Perpustakaan Laravel

## Deskripsi
Aplikasi manajemen perpustakaan berbasis web yang dikembangkan menggunakan Laravel.  
Aplikasi ini mencakup fitur authentication, CRUD data master, transaksi peminjaman & pengembalian buku, dashboard statistik, laporan, serta notifikasi keterlambatan.

## Identitas
- **Nama:** Puspa Dwi Setyorini  
- **NIM:** 60324003  
- **Prodi:** Informatika  
- **Semester:** 4  
- **Mata Kuliah:** Pemrograman Web II

---

## Fitur Utama
- Authentication (Register, Login, Logout)
- Proteksi Route (Middleware Auth)
- CRUD Buku
- CRUD Anggota
- Transaksi Peminjaman & Pengembalian
- Perhitungan Denda Otomatis
- Dashboard & Statistik
- Laporan PDF & Excel
- Notifikasi Keterlambatan

---

## Tech Stack
- Laravel 12.x
- PHP 8.x
- MySQL 8.x
- Bootstrap 5.3
- Barryvdh Laravel DomPDF

---

## Instalasi
1. Clone repository  
2. `composer install`  
3. `npm install`  
4. `cp .env.example .env`  
5. `php artisan key:generate`  
6. `php artisan migrate --seed`  
7. `php artisan serve`  

---

# Testing Checklist & Screenshot

## 🔐 Authentication

### Register Berfungsi
![Register](screenshoot/authentication/register.png)
![Register Berfungsi](screenshoot/authentication/regberfungsi.png)

### Login Berfungsi
![Login Berfungsi](screenshoot/authentication/loginberfungsi.png)

### Logout
![Logout](screenshoot/authentication/logout.png)

### Protected Routes Redirect
![Protected Route](screenshoot/authentication/searchbukuprotectroute.png)

### Password Hashing
![Password Hashing](screenshoot/authentication/passwordhashing.png)

---

## 📚 CRUD Buku

### Create Buku
![Create](screenshoot/CRUD-Buku/create.png)
![Create Berhasil](screenshoot/CRUD-Buku/create-berhasil.png)

### Read Buku
![Read](screenshoot/CRUD-Buku/read.png)

### Update Buku
![Update](screenshoot/CRUD-Buku/update.png)

### Delete Buku
![Delete](screenshoot/CRUD-Buku/delete.png)

### Validation Berfungsi
![Validasi](screenshoot/CRUD-Buku/validasi.png)

### Search Buku
![Cari Lokal](screenshoot/CRUD-Buku/carilokal.png)
![Search Global](screenshoot/CRUD-Buku/searchglobal.png)

---

## 👥 CRUD Anggota

### Create Anggota
![Create](screenshoot/CRUD-Anggota/create.png)

### Read Anggota
![Read](screenshoot/CRUD-Anggota/read.png)

### Update Anggota
![Update](screenshoot/CRUD-Anggota/update.png)

### Delete Anggota
![Delete](screenshoot/CRUD-Anggota/delete.png)

### Date Picker Functional
![Date Picker](screenshoot/CRUD-Anggota/datepicker.png)

### Email Unique Validation
![Email Unique](screenshoot/CRUD-Anggota/emailunique.png)

---

## 🔄 Transaksi

### Peminjaman Buku (Stok -1)
![Stok Berkurang](screenshoot/transaksi/berkurang1.png)

### Pengembalian Buku (Stok +1 & Denda)
![Dikembalikan](screenshoot/transaksi/dikembalikan.png)
![Stok Bertambah](screenshoot/transaksi/bertambah1.png)

### Business Rules Validation
![Stok Awal](screenshoot/transaksi/stokawal.png)

---

## 📊 Dashboard

### Statistik Akurat
![Statistik](screenshoot/fitur-tambahan/alertdetailtransaksi.png)

### Charts Tampil Data
![Chart Advanced](screenshoot/fitur-tambahan/chartadvanced.png)

### Quick Actions Berfungsi
![Notifikasi Terlambat](screenshoot/fitur-tambahan/notifikasiterlambat.png)

---

## 🔍 Search

### Results Correct
![Search Global](screenshoot/CRUD-Buku/searchglobal.png)

### Tabs Berfungsi
![Filter Kategori](screenshoot/fitur-tambahan/filterbukukategori.png)

### Highlighting Works
![Highlight](screenshoot/CRUD-Buku/searchglobal.png)

---

## 📄 Laporan

### Export PDF
![PDF](screenshoot/laporan/PDF.png)

### Export Excel Buku
![Excel Buku](screenshoot/laporan/excelbuku.png)

### Export Excel Anggota
![Excel Anggota](screenshoot/laporan/excelanggota.png)

---

## 📱 UI / UX Tambahan

### Responsive Design
![Responsive](screenshoot/fiturtambahan/responsivedesign.png)

### Riwayat Peminjaman Buku
![Riwayat](screenshoot/fiturtambahan/riwayatpeminjamanbuku.png)

---

## Kesimpulan
Seluruh fitur pada sistem perpustakaan ini telah diuji berdasarkan skenario fungsional dan business rules.  
Hasil pengujian menunjukkan bahwa sistem berjalan dengan baik, valid, dan sesuai dengan kebutuhan aplikasi.