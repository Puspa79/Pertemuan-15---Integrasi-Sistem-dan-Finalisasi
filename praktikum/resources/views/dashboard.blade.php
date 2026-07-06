<x-app-layout>
    {{-- 
        ========================================
        DASHBOARD PERPUSTAKAAN - FULL TAILWIND CSS
        ========================================
        Fitur:
        - 8 Statistics Cards (Total Buku, Anggota, Transaksi, dll)
        - 4 Charts: Line, Pie, Bar, Donut
        - Recent Transactions Table
        - Responsive Design dengan Tailwind CSS
        ========================================
    --}}

    <div class="max-w-[95%] mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- HEADER SECTION: Judul Dashboard --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Dashboard Perpustakaan
            </h1>
            <p class="text-gray-500 mt-2 text-base">Ringkasan statistik dan aktivitas perpustakaan</p>
        </div>

        {{-- 
            ========================================
            STATISTICS CARDS SECTION (8 Cards)
            ========================================
            Menampilkan 8 kartu statistik utama:
            1. Total Buku
            2. Anggota Aktif
            3. Sedang Dipinjam
            4. Terlambat
            5. Transaksi Hari Ini
            6. Buku Tersedia
            7. Total Transaksi
            8. Denda Bulan Ini
            ========================================
        --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            {{-- Card 1: Total Buku --}}
            <div
                class="bg-white rounded-xl shadow-sm border-l-4 border-blue-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Buku</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_buku'] }}</h3>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
            </div>


            {{-- Card 2: Anggota Aktif --}}
            <div
                class="bg-white rounded-xl shadow-sm border-l-4 border-green-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Anggota Aktif</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_anggota'] }}</h3>
                    </div>
                    <div class="bg-green-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 3: Sedang Dipinjam --}}
            <div
                class="bg-white rounded-xl shadow-sm border-l-4 border-cyan-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Sedang Dipinjam</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['sedang_dipinjam'] }}</h3>
                    </div>
                    <div class="bg-cyan-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-cyan-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 4: Terlambat --}}
            <div
                class="bg-white rounded-xl shadow-sm border-l-4 border-red-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Terlambat</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['terlambat'] }}</h3>
                    </div>
                    <div class="bg-red-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 5: Transaksi Hari Ini --}}
            <div
                class="bg-white rounded-xl shadow-sm border-l-4 border-amber-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Transaksi Hari Ini</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['transaksi_hari_ini'] }}</h3>
                    </div>
                    <div class="bg-amber-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 6: Buku Tersedia --}}
            <div
                class="bg-white rounded-xl shadow-sm border-l-4 border-purple-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Buku Tersedia</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['buku_tersedia'] }}</h3>
                    </div>
                    <div class="bg-purple-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 7: Total Transaksi --}}
            <div
                class="bg-white rounded-xl shadow-sm border-l-4 border-gray-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Transaksi</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_transaksi'] }}</h3>
                    </div>
                    <div class="bg-gray-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 8: Denda Bulan Ini --}}
            <div
                class="bg-white rounded-xl shadow-sm border-l-4 border-pink-500 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Denda Bulan Ini</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">Rp
                            {{ number_format($stats['denda_bulan_ini'], 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-pink-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>


        {{-- 
            ========================================
            CHARTS SECTION (4 Charts Total)
            ========================================
            1. Line Chart - Transaksi 6 Bulan Terakhir
            2. Pie Chart - Top 5 Buku Populer
            3. Bar Chart - Top 10 Buku Terpopuler
            4. Donut Chart - Status Transaksi
            ========================================
        --}}

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

            {{-- CHART 1: LINE CHART - Menampilkan trend peminjaman vs pengembalian dalam 6 bulan terakhir --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 lg:col-span-2">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                        Transaksi 6 Bulan Terakhir
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Grafik perbandingan peminjaman dan pengembalian buku</p>
                </div>
                <div class="relative" style="height: 300px;">
                    <canvas id="chartTransaksi"></canvas>
                </div>
            </div>

            {{-- CHART 2: PIE CHART - Menampilkan 5 buku yang paling banyak dipinjam --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                        Top 5 Buku Populer
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Buku dengan peminjaman terbanyak</p>
                </div>
                <div class="relative" style="height: 300px;">
                    <canvas id="chartBukuPopuler"></canvas>
                </div>
            </div>

            {{-- CHART 3: BAR CHART - Ranking 10 buku teratas dengan horizontal bar --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Top 10 Buku Terpopuler
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Ranking buku berdasarkan jumlah peminjaman</p>
                </div>
                <div class="relative" style="height: 300px;">
                    <canvas id="chartTop10Buku"></canvas>
                </div>
            </div>

            {{-- CHART 4: DONUT CHART - Distribusi status transaksi dengan center text --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 lg:col-span-2">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Distribusi Status Transaksi
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Persentase status transaksi peminjaman buku</p>
                </div>
                <div class="relative flex justify-center" style="height: 350px;">
                    <canvas id="chartStatusTransaksi"></canvas>
                </div>
            </div>

        </div>
