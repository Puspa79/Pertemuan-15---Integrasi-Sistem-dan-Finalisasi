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
 
            // Filter denda berdasarkan tanggal_dikembalikan bulan ini
            'denda_bulan_ini'    => Transaksi::whereNotNull('tanggal_dikembalikan')
                ->whereMonth('tanggal_dikembalikan', now()->month)
                ->whereYear('tanggal_dikembalikan', now()->year)
                ->sum('denda'),
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

        // FIX: Pastikan memanggil get() dulu untuk mengubah query menjadi Collection sebelum menggunakan groupBy dan map
        $kategoriChart = Buku::with('kategori')
            ->withCount('transaksis')
            ->get()
            ->groupBy(function ($buku) {
                // Menggunakan optional() untuk menghindari error jika data kategori di DB kosong/null
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