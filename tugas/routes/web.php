<?php
 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
 
// Public routes (tanpa auth)
Route::get('/', function () {
    return redirect()->route('login');
});
 
// Protected routes (dengan auth middleware)
Route::middleware(['auth'])->group(function () {
 
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
 
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 
    // Buku - Custom routes HARUS di atas resource
    Route::get('/buku/export', [BukuController::class, 'export'])->name('buku.export');
    Route::get('/buku/kategori/{kategori}', [BukuController::class, 'kategori'])->name('buku.kategori');
    Route::delete('/buku/bulk-delete', [BukuController::class, 'bulkDelete'])->name('buku.bulk-delete');
    Route::resource('buku', BukuController::class);
 
    // Anggota - Custom routes HARUS di atas resource
    Route::get('/anggota/search', [AnggotaController::class, 'search'])->name('anggota.search');
    Route::get('/anggota/export', [AnggotaController::class, 'export'])->name('anggota.export');
    Route::resource('anggota', AnggotaController::class);
 
    // Transaksi - Custom routes HARUS di atas resource
    Route::get('/transaksi/search', [TransaksiController::class, 'search'])->name('transaksi.search');
    Route::get('/transaksi/laporan', [TransaksiController::class, 'laporan'])->name('transaksi.laporan');
    Route::get('/transaksi/laporan/pdf', [TransaksiController::class, 'exportPdf'])->name('transaksi.laporan.pdf');
    Route::match(['put', 'patch'], '/transaksi/{id}/kembalikan', [TransaksiController::class, 'kembalikan'])->name('transaksi.kembalikan');
    Route::resource('transaksi', TransaksiController::class);

    Route::get('/search', [SearchController::class, 'globalSearch'])->name('search.global');
 
});
 
require __DIR__ . '/auth.php';