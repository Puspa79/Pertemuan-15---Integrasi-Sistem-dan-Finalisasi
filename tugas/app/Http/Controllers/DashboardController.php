<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung denda dari transaksi yang BENAR-BENAR SUDAH DIKEMBALIKAN bulan ini (setelah klik tombol kembalikan)
        $dendaSelesai = Transaksi::whereNotNull('tanggal_dikembalikan')
            ->whereMonth('tanggal_dikembalikan', now()->month)
            ->whereYear('tanggal_dikembalikan', now()->year)
            ->sum('denda');

        // 2. Susun semua data statistik ke dalam array $stats
        $stats = [
            'total_buku'         => Buku::count(),
            'total_anggota'      => Anggota::where('status', 'Aktif')->count(),
            'sedang_dipinjam'    => Transaksi::where('status', 'Dipinjam')->count(),

            // Cek tanggal_kembali sudah lewat dari waktu sekarang
            'terlambat'          => Transaksi::where('status', 'Dipinjam')
                ->whereDate('tanggal_kembali', '<', now())
                ->count(),

            'transaksi_hari_ini' => Transaksi::whereDate('created_at', today())->count(),
            'buku_tersedia'      => Buku::where('stok', '>', 0)->count(),
            'total_transaksi'    => Transaksi::count(),

            // KUNCI UTAMA: Denda bulan ini dipaksa kelipatan 5.000 murni dari data yang SUDAH SELESAI dikembalikan saja
            'denda_bulan_ini'    => round($dendaSelesai / 5000) * 5000,
        ];

        $chartData = Transaksi::selectRaw('
            DATE_FORMAT(tanggal_pinjam, "%b %Y") as bulan,
            COUNT(*) as pinjam,
            SUM(CASE WHEN status = "Dikembalikan" THEN 1 ELSE 0 END) as kembali
        ')
            ->where('tanggal_pinjam', '>=', now()->subMonths(6))
            ->groupByRaw('DATE_FORMAT(tanggal_pinjam, "%Y-%m"), DATE_FORMAT(tanggal_pinjam, "%b %Y")')
            ->orderByRaw('DATE_FORMAT(tanggal_pinjam, "%Y-%m") asc')
            ->get();

        // Data untuk Pie Chart: Top 5 Buku Populer
        $bukuPopuler = Buku::withCount('transaksis')
            ->orderByDesc('transaksis_count')
            ->limit(5)
            ->get();

        // Data untuk Bar Chart: Top 10 Buku Terpopuler
        $top10Buku = Buku::withCount('transaksis')
            ->orderByDesc('transaksis_count')
            ->limit(10)
            ->get();

        // Data untuk Donut Chart: Status Transaksi
        $statusTransaksi = [
            'dipinjam' => Transaksi::where('status', 'Dipinjam')->count(),
            'dikembalikan' => Transaksi::where('status', 'Dikembalikan')->count(),
            'terlambat' => Transaksi::where('status', 'Dipinjam')
                ->whereDate('tanggal_kembali', '<', now())
                ->count(),
        ];

        // Data transaksi terbaru untuk tabel
        $recentTransaksi = Transaksi::with(['anggota', 'buku'])
            ->latest()
            ->limit(5)
            ->get();

        // Notifikasi Terlambat (Widget Dashboard)
        $bukuTerlambat = Transaksi::where('status', 'Dipinjam')
            ->whereDate('tanggal_kembali', '<', now())
            ->with(['anggota', 'buku'])
            ->orderBy('tanggal_kembali', 'asc')
            ->get();

        $jumlahTerlambat = $bukuTerlambat->count();

        // Ambil data chart berdasarkan kategori buku
        $kategoriChart = Buku::with('kategori')
            ->withCount('transaksis')
            ->get()
            ->groupBy(function ($buku) {
                return optional($buku->kategori)->nama ?? 'Tanpa Kategori';
            })
            ->map(fn ($group, $nama) => [
                'nama'       => $nama,
                'buku_count' => $group->sum('transaksis_count'),
            ])
            ->sortByDesc('buku_count')
            ->take(5)
            ->values();

        return view('dashboard', compact(
            'stats',
            'chartData',
            'bukuPopuler',
            'top10Buku',
            'statusTransaksi',
            'recentTransaksi',
            'bukuTerlambat',
            'jumlahTerlambat',
            'kategoriChart'
        ));
    }
}