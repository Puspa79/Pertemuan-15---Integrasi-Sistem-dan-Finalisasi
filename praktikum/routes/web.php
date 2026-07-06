<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\TransaksiController;
use App\Models\Transaksi;
use App\Models\Buku;     // <-- Ditambahkan agar grafik buku tidak error
use App\Models\Anggota;  // <-- Ditambahkan agar hitung statistik anggota tidak error
// use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Public routes (tanpa auth)
Route::get('/', function () {
    return redirect()->route('login');
});

// Protected routes (dengan auth middleware)
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    // 1. Chart Transaksi 6 bulan terakhir
    $chartData = Transaksi::selectRaw('
            DATE_FORMAT(tanggal_pinjam, "%b %Y") as bulan,
            COUNT(*) as pinjam,
            SUM(CASE WHEN status = "Dikembalikan" THEN 1 ELSE 0 END) as kembali
        ')
        ->where('tanggal_pinjam', '>=', now()->subMonths(6))
        ->groupByRaw('DATE_FORMAT(tanggal_pinjam, "%Y-%m"), DATE_FORMAT(tanggal_pinjam, "%b %Y")')
        ->orderByRaw('DATE_FORMAT(tanggal_pinjam, "%Y-%m") asc')
        ->get();

    // 2. Buku Populer (5 buku terbanyak dipinjam)
    $bukuPopuler = Buku::withCount('transaksis')
        ->orderByDesc('transaksis_count')
        ->take(5)
        ->get();

    // 3. Ambil data transaksi terbaru untuk tabel dashboard
    $recentTransaksi = Transaksi::with(['anggota', 'buku'])
        ->orderBy('tanggal_pinjam', 'desc')
        ->take(5)
        ->get();

    // 4. Hitung data statistik untuk Cards ($stats)
    $stats = [
        'total_buku'          => Buku::count(),
        'total_anggota'       => Anggota::count(),
        'sedang_dipinjam'     => Transaksi::where('status', 'Dipinjam')->count(),
        'terlambat'           => Transaksi::where('status', 'Terlambat')->count(),
        'transaksi_hari_ini'  => Transaksi::whereDate('tanggal_pinjam', now()->today())->count(),
        'buku_tersedia'       => Buku::count() - Transaksi::where('status', 'Dipinjam')->count(), // Logic sisa buku yang tersedia
        'total_transaksi'     => Transaksi::count(),
        'denda_bulan_ini'     => Transaksi::whereMonth('tanggal_pinjam', now()->month)
            ->whereYear('tanggal_pinjam', now()->year)
            ->sum('denda'),
    ];

    // Mengirimkan semua data ke view termasuk 'recentTransaksi' dan 'stats' yang baru dibuat
    return view('dashboard', compact('chartData', 'bukuPopuler', 'recentTransaksi', 'stats'));
})->name('dashboard');

// Profile
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::match(['put', 'patch'], '/transaksi/{id}/kembalikan', [TransaksiController::class, 'kembalikan'])->name('transaksi.kembalikan');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/buku/export', [BukuController::class, 'export'])->name('buku.export');
Route::get('/buku/kategori/{kategori}', [BukuController::class, 'kategori'])->name('buku.kategori');
Route::delete('/buku/bulk-delete', [BukuController::class, 'bulkDelete'])->name('buku.bulk-delete');

// Buku - CRUD
Route::resource('buku', BukuController::class);

// Anggota - CRUD
Route::get('/anggota/search', [App\Http\Controllers\AnggotaController::class, 'search'])->name('anggota.search');
Route::get('/anggota/export', [App\Http\Controllers\AnggotaController::class, 'export'])->name('anggota.export');
Route::resource('anggota', AnggotaController::class);

// Transaksi - CRUD + Custom routes
Route::get('/transaksi/search', [TransaksiController::class, 'search'])->name('transaksi.search');
Route::get('/transaksi/laporan', [TransaksiController::class, 'laporan'])->name('transaksi.laporan');
Route::get('/transaksi/laporan/pdf', [TransaksiController::class, 'exportPdf'])->name('transaksi.laporan.pdf');
Route::put('/transaksi/{id}/kembalikan', [TransaksiController::class, 'kembalikan'])->name('transaksi.kembalikan');
Route::resource('transaksi', TransaksiController::class);

require __DIR__ . '/auth.php';
