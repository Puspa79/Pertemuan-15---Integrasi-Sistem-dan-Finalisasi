# Sistem Perpustakaan Laravel

## Deskripsi
Aplikasi manajemen perpustakaan berbasis web yang dikembangkan menggunakan framework Laravel.  
Sistem ini mendukung proses **authentication**, **proteksi route**, serta fitur pencarian buku yang hanya dapat diakses oleh user terautentikasi.

Project ini dibuat sebagai bagian dari tugas **Pemrograman Web II**.

---

## Informasi Mahasiswa
- **Nama:** Puspa Dwi Setyorini  
- **NIM:** 60324003  
- **Prodi:** Informatika  
- **Semester:** 4  
- **Mata Kuliah:** Pemrograman Web II  

📦 **Repository GitHub:**  
https://github.com/Puspa79/Tugas-14-Authentication-Transaksi-Peminjaman.git

---

## Fitur Utama

### 1. Authentication
- Register user
- Login user
- Logout user
- Proteksi halaman menggunakan middleware `auth`

### 2. Proteksi Route
- Halaman tertentu hanya bisa diakses setelah login
- User yang belum login akan diarahkan ke halaman login

### 3. Pencarian Buku
- Fitur pencarian buku
- Route pencarian dilindungi middleware authentication

---

## Screenshot Aplikasi

### Halaman Register
![Register](screenshoot/register.png)

### Register Berfungsi
![Register Berfungsi](screenshoot/regberfungsi.png)

### Login Berfungsi
![Login Berfungsi](screenshoot/loginberfungsi.png)

### Pencarian Buku (Protected Route)
![Search Buku Protected Route](screenshoot/searchbukuprotectroute.png)

### Logout
![Logout](screenshoot/logout.png)

> 📌 *Pastikan seluruh file screenshot berada di dalam folder `screenshoot/`.*

---

## Tech Stack
- Laravel 12.x
- PHP 8.x
- MySQL 8.x
- Bootstrap 5.3

---

## Instalasi & Menjalankan Project

1. Clone repository
   ```bash
   git clone https://github.com/Puspa79/Tugas-14-Authentication-Transaksi-Peminjaman.git