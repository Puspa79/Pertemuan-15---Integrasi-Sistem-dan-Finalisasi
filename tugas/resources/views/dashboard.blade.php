<x-app-layout>
    {{--
        ========================================
        DASHBOARD PERPUSTAKAAN - FULL TAILWIND CSS
        (Fixed: canvas ID mismatch yang menyebabkan
        bar/pie/donut chart tidak muncul)
        ========================================
    --}}
 
    <div class="max-w-[95%] mx-auto px-4 sm:px-6 lg:px-8 py-8">
 
        {{-- HEADER SECTION --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                Dashboard Perpustakaan
            </h1>
        </div>
 
        {{-- STATISTICS CARDS SECTION (8 Cards) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
 
            {{-- Card 1: Total Buku --}}
            <div class="bg-white rounded-xl shadow-sm border-l-4 border-blue-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Buku</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_buku'] }}</h3>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
            </div>
 
            {{-- Card 2: Anggota Aktif --}}
            <div class="bg-white rounded-xl shadow-sm border-l-4 border-green-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Anggota Aktif</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_anggota'] }}</h3>
                    </div>
                    <div class="bg-green-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>
 
            {{-- Card 3: Sedang Dipinjam --}}
            <div class="bg-white rounded-xl shadow-sm border-l-4 border-cyan-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Sedang Dipinjam</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['sedang_dipinjam'] }}</h3>
                    </div>
                    <div class="bg-cyan-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                    </div>
                </div>
            </div>
 
            {{-- Card 4: Terlambat --}}
            <div class="bg-white rounded-xl shadow-sm border-l-4 border-red-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Terlambat</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['terlambat'] }}</h3>
                    </div>
                    <div class="bg-red-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
            </div>
 
            {{-- Card 5: Transaksi Hari Ini --}}
            <div class="bg-white rounded-xl shadow-sm border-l-4 border-amber-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Transaksi Hari Ini</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['transaksi_hari_ini'] }}</h3>
                    </div>
                    <div class="bg-amber-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>
 
            {{-- Card 6: Buku Tersedia --}}
            <div class="bg-white rounded-xl shadow-sm border-l-4 border-purple-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Buku Tersedia</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['buku_tersedia'] }}</h3>
                    </div>
                    <div class="bg-purple-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                </div>
            </div>
 
            {{-- Card 7: Total Transaksi --}}
            <div class="bg-white rounded-xl shadow-sm border-l-4 border-gray-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Transaksi</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_transaksi'] }}</h3>
                    </div>
                    <div class="bg-gray-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                </div>
            </div>
 
            {{-- Card 8: Denda Bulan Ini --}}
            <div class="bg-white rounded-xl shadow-sm border-l-4 border-pink-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Denda Bulan Ini</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">Rp {{ number_format($stats['denda_bulan_ini'], 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-pink-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
 
        </div>
 
        {{-- WIDGET: Notifikasi Buku Terlambat --}}
        @isset($bukuTerlambat)
        <div class="bg-white rounded-xl shadow-sm border border-red-200 overflow-hidden mb-8">
            <div class="bg-red-50 px-6 py-4 border-b border-red-200 flex items-center justify-between">
                <h3 class="text-lg font-bold text-red-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Buku Terlambat
                </h3>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-red-600 text-white">
                    {{ $jumlahTerlambat ?? $bukuTerlambat->count() }} Transaksi
                </span>
            </div>
 
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Anggota</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Buku</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Terlambat</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($bukuTerlambat as $trx)
                            @php
                                // Menggunakan properti diffInDays(now()) agar otomatis menghasilkan angka bulat positif
                                $hariTerlambat = $trx->tanggal_kembali ? abs(intval(now()->diffInDays($trx->tanggal_kembali))) : 0;
                            @endphp
                            <tr class="hover:bg-red-50/50 transition-colors duration-150">
                                <td class="px-6 py-3 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $trx->anggota->nama }}</td>
                                <td class="px-6 py-3 text-sm text-gray-600">{{ Str::limit($trx->buku->judul ?? 'Buku telah dihapus', 40) }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500">{{ optional($trx->tanggal_kembali)->format('d M Y') }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                        Terlambat {{ $hariTerlambat }} Hari
                                    </span>
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-center">
                                    <a href="{{ route('transaksi.show', $trx->id) }}" class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded shadow-sm transition-colors duration-150">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">
                                    Tidak ada buku yang terlambat saat ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endisset
 
        {{-- CHART ROW 1: Transaksi 6 Bulan --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="mb-4">
                <h3 class="text-lg font-bold text-gray-900">Transaksi 6 Bulan Terakhir</h3>
                <p class="text-sm text-gray-500 mt-1">Grafik perbandingan peminjaman dan pengembalian buku</p>
            </div>
            <div class="relative" style="height: 300px;">
                <canvas id="chartTransaksi"></canvas>
            </div>
        </div>
 
        {{-- CHARTS ROW 2 : Kategori Buku (bar) + Status Transaksi (donut) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
 
            {{-- Pie: Kategori Buku --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                        Kategori Buku
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Kategori dengan buku terbanyak</p>
                </div>
                <div class="relative" style="height: 280px;">
                    <canvas id="chartKategoriPopuler"></canvas>
                </div>
            </div>
 
            {{-- Donut: Status Transaksi --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Status Transaksi
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Persentase status transaksi peminjaman</p>
                </div>
                <div class="relative" style="height: 280px;">
                    <canvas id="chartStatusTransaksi"></canvas>
                </div>
            </div>
 
        </div>
 
        {{-- CHARTS ROW 3 : Top 5 Buku Terpopuler (bar, full width) --}}
        @isset($top10Buku)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="mb-4">
                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Top 5 Buku Terpopuler
                </h3>
                <p class="text-sm text-gray-500 mt-1">Ranking buku dengan jumlah peminjaman terbanyak</p>
            </div>
            <div class="relative" style="height: 340px;">
                <canvas id="chartTop10Buku"></canvas>
            </div>
        </div>
        @endisset
 
        {{-- CHARTS ROW 4 : Trend Peminjaman 12 Bulan (line, full width) --}}
        @isset($trendPeminjaman)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="mb-4">
                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    Trend Peminjaman 12 Bulan Terakhir
                </h3>
                <p class="text-sm text-gray-500 mt-1">Perkembangan jumlah peminjaman sepanjang tahun</p>
            </div>
            <div class="relative" style="height: 300px;">
                <canvas id="chartTrendPeminjaman"></canvas>
            </div>
        </div>
        @endisset
 
        {{-- TABEL: Top 5 Anggota Aktif --}}
        @isset($anggotaAktif)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Top 5 Anggota Aktif
                </h3>
                <p class="text-sm text-gray-500 mt-1">Anggota dengan jumlah peminjaman terbanyak</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Total Peminjaman</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($anggotaAktif as $anggota)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $anggota->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $anggota->transaksis_count }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-12 text-center text-sm text-gray-500">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endisset
 
        {{-- TABEL: Transaksi Terbaru --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Transaksi Terbaru
                </h3>
                <p class="text-sm text-gray-500 mt-1">Transaksi peminjaman terakhir</p>
            </div>
 
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Kode Transaksi</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Anggota</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Buku</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($recentTransaksi as $trx)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-mono text-sm font-semibold text-pink-600 bg-pink-50 px-2 py-1 rounded">
                                        {{ $trx->kode_transaksi }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-semibold text-gray-900">{{ $trx->anggota->nama }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-600">{{ $trx->buku->judul ?? "Buku telah dihapus" }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-500">{{ $trx->tanggal_pinjam->format('d M Y') }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if ($trx->status === 'Dipinjam')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                            Dipinjam
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            Dikembalikan
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">Belum ada transaksi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
 
    </div>
 
    {{-- JAVASCRIPT SECTION - CHART.JS COMPLETE (FIXED) --}}
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
 
            // Helper: bikin chart dengan aman.
            // Kalau canvas tidak ada di DOM, atau ada error saat membuat
            // satu chart, chart lain tetap lanjut dibuat (tidak ikut gagal).
            function buatChart(canvasId, config) {
                const canvas = document.getElementById(canvasId);
                if (!canvas) {
                    console.warn('Canvas dengan id "' + canvasId + '" tidak ditemukan, chart dilewati.');
                    return;
                }
                try {
                    new Chart(canvas, config);
                } catch (err) {
                    console.error('Gagal membuat chart "' + canvasId + '":', err);
                }
            }
 
            // CHART 1: Line - Transaksi 6 Bulan Terakhir
            buatChart('chartTransaksi', {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartData->pluck('bulan')) !!},
                    datasets: [
                        {
                            label: 'Peminjaman',
                            data: {!! json_encode($chartData->pluck('pinjam')) !!},
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            tension: 0.4,
                            fill: true,
                            borderWidth: 3,
                            pointRadius: 5,
                            pointBackgroundColor: '#3b82f6',
                            pointBorderColor: '#fff'
                        },
                        {
                            label: 'Pengembalian',
                            data: {!! json_encode($chartData->pluck('kembali')) !!},
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            tension: 0.4,
                            fill: true,
                            borderWidth: 3,
                            pointRadius: 5,
                            pointBackgroundColor: '#10b981',
                            pointBorderColor: '#fff'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top', labels: { usePointStyle: true } }
                    },
                    scales: {
                        y: { beginAtZero: true, ticks: { precision: 0 } }
                    }
                }
            });
 
            // CHART 2: Bar - Top 5 Kategori Buku
            // (ID canvas & JS sekarang cocok: chartKategoriPopuler)
            buatChart('chartKategoriPopuler', {
                type: 'pie',
                data: {
                    labels: {!! isset($kategoriChart) ? json_encode($kategoriChart->pluck('nama')) : '[]' !!},
                    datasets: [{
                        label: 'Jumlah Peminjaman',
                        data: {!! isset($kategoriChart) ? json_encode($kategoriChart->pluck('buku_count')) : '[]' !!},
                        backgroundColor: ['#6366f1', '#ec4899', '#14b8a6', '#f59e0b', '#8b5cf6'],
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
                }
            });
 
            // CHART 3: Donut - Status Transaksi
            buatChart('chartStatusTransaksi', {
                type: 'doughnut',
                data: {
                    labels: ['Dipinjam', 'Dikembalikan', 'Terlambat'],
                    datasets: [{
                        data: [
                            {{ $stats['sedang_dipinjam'] }},
                            {{ $stats['total_transaksi'] - $stats['sedang_dipinjam'] }},
                            {{ $stats['terlambat'] }}
                        ],
                        backgroundColor: ['#f59e0b', '#10b981', '#ef4444'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom', labels: { boxWidth: 12 } } }
                }
            });
 
            // CHART 4: Bar - Top 10 Buku Terpopuler
            @isset($top10Buku)
            buatChart('chartTop10Buku', {
                type: 'bar',
                data: {
                    labels: {!! json_encode($top10Buku->pluck('judul')) !!},
                    datasets: [{
                        label: 'Jumlah Dipinjam',
                        data: {!! json_encode($top10Buku->pluck('transaksis_count')) !!},
                        backgroundColor: '#8b5cf6',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } }
                }
            });
            @endisset
 
            // CHART 5: Line - Trend Peminjaman 12 Bulan
            @isset($trendPeminjaman)
            buatChart('chartTrendPeminjaman', {
                type: 'line',
                data: {
                    labels: {!! json_encode($trendPeminjaman->pluck('bulan')) !!},
                    datasets: [{
                        label: 'Total Peminjaman',
                        data: {!! json_encode($trendPeminjaman->pluck('total')) !!},
                        borderColor: '#7c3aed',
                        backgroundColor: 'rgba(124, 58, 237, 0.05)',
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } }
                }
            });
            @endisset
 
        });
    </script>
    @endpush
</x-app-layout>