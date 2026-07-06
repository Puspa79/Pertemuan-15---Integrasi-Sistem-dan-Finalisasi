<x-app-layout>
 
    <div class="max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8 py-8">
 
        {{-- Breadcrumb --}}
        <nav class="mb-5">
            <ol class="flex items-center gap-2 text-sm text-gray-500">
                <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">Home</a></li>
                <li><span class="text-gray-300">/</span></li>
                <li><a href="{{ route('transaksi.index') }}" class="hover:text-blue-600 transition">Transaksi</a></li>
                <li><span class="text-gray-300">/</span></li>
                <li class="text-gray-700 font-medium">{{ $transaksi->kode_transaksi }}</li>
            </ol>
        </nav>

        {{-- Alert Sukses dengan Tombol Silang --}}
        @if (session('success'))
            <div class="mb-6" id="success-alert">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl p-4 flex items-center justify-between gap-3 shadow-sm">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-check-circle-fill text-emerald-500 text-lg"></i>
                        <div class="text-sm font-medium">
                            {{ session('success') }}
                        </div>
                    </div>
                    {{-- Tombol Silang --}}
                    <button type="button" id="btn-close-alert" class="text-emerald-500 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100 transition-colors">
                        <i class="bi bi-x-lg text-sm"></i>
                    </button>
                </div>
            </div>
        @endif
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
 
            {{-- Kolom Kiri: Detail Transaksi --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-blue-600 px-6 py-4">
                        <h4 class="text-white font-bold text-lg flex items-center gap-2">
                            <i class="bi bi-file-earmark-text"></i> Detail Peminjaman Buku
                        </h4>
                    </div>
 
                    <div class="p-6">
 
                        {{-- Warning Terlambat --}}
                        @if(strtolower($transaksi->status) == 'dipinjam' && now()->isAfter($transaksi->tanggal_kembali))
                            <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-3"> {{-- Mengubah mb-5 menjadi mb-3 agar jarak ke estimasi denda lebih rapat --}}
                                <i class="bi bi-exclamation-triangle-fill text-lg"></i>
                                <div>
                                    <strong>Peringatan!</strong> Peminjaman ini telah terlambat selama
                                    <strong>{{ abs((int)now()->diffInDays($transaksi->tanggal_kembali)) }} hari</strong>.
                                </div>
                            </div>
                        @endif
 
                        {{-- Detail Info --}}
                        <div class="space-y-3 mb-5">
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-upc text-blue-500"></i> Kode Transaksi
                                </span>
                                <span class="font-bold text-gray-800">{{ $transaksi->kode_transaksi }}</span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-person text-blue-500"></i> Nama Anggota
                                </span>
                                <span class="text-gray-800">{{ $transaksi->anggota->nama }}</span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-book text-blue-500"></i> Judul Buku
                                </span>
                                <span class="text-gray-800">{{ $transaksi->buku->judul ?? '-' }}</span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-calendar text-blue-500"></i> Tanggal Pinjam
                                </span>
                                <span class="text-gray-800">{{ \Carbon\Carbon::parse($transaksi->tanggal_pinjam)->format('d-m-Y') }}</span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-calendar-check text-blue-500"></i> Tenggat Kembali
                                </span>
                                <span class="text-gray-800">{{ \Carbon\Carbon::parse($transaksi->tanggal_kembali)->format('d-m-Y') }}</span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-calendar-x text-blue-500"></i> Tanggal Dikembalikan
                                </span>
                                <span class="text-gray-800">
                                    {{ $transaksi->tanggal_dikembalikan ? \Carbon\Carbon::parse($transaksi->tanggal_dikembalikan)->format('d-m-Y') : '-' }}
                                </span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-info-circle text-blue-500"></i> Status
                                </span>
                                <span>
                                    @if(strtolower($transaksi->status) == 'dipinjam')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">
                                            {{ ucfirst($transaksi->status) }}
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ ucfirst($transaksi->status) }}
                                        </span>
                                    @endif
                                </span>
                            </div>
                            <div class="flex gap-4 py-2">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-cash text-blue-500"></i> Total Denda
                                </span>
                                <span class="font-bold text-red-600">Rp {{ number_format($transaksi->denda ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
 
                        {{-- Info dikembalikan tepat waktu / terlambat --}}
                        @if($transaksi->status !== 'Dipinjam' && $transaksi->tanggal_dikembalikan)
                            @if($transaksi->tanggal_dikembalikan <= $transaksi->tanggal_kembali)
                                <div class="flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">
                                    <i class="bi bi-check-circle"></i>
                                    Dikembalikan tepat waktu pada {{ \Carbon\Carbon::parse($transaksi->tanggal_dikembalikan)->format('d M Y') }}
                                </div>
                            @else
                                <div class="flex items-center gap-2 bg-amber-50 border border-amber-200 text-amber-700 rounded-lg px-4 py-3 text-sm">
                                    <i class="bi bi-exclamation-triangle"></i>
                                    Terlambat dikembalikan! Denda: Rp {{ number_format($transaksi->denda ?? 0, 0, ',', '.') }}
                                </div>
                            @endif
                        @endif
 
                    </div>
                            {{-- BAGIAN BARU: ESTIMASI DENDA TEPAT DI BAWAH ALERT PERINGATAN --}}
                            @php
                                $hariTerlambat = abs((int)now()->diffInDays($transaksi->tanggal_kembali));
                                $tarifDendaPerHari = 1000; 
                                $estimasiDenda = $hariTerlambat * $tarifDendaPerHari;
                            @endphp

                            <div class="flex flex-col sm:flex-row sm:items-center justify-between bg-amber-50/60 border border-amber-200 text-amber-900 rounded-xl px-5 py-4 gap-4 shadow-sm mb-5">
                                {{-- Sisi Kiri: Ikon & Penjelasan --}}
                                <div class="flex items-start gap-3.5">
                                    <div class="p-2 bg-amber-100 text-amber-700 rounded-lg shrink-0 mt-0.5">
                                        <i class="bi bi-cash-coin text-xl flex"></i>
                                    </div>
                                    <div class="flex flex-col gap-0.5">
                                        <span class="font-bold text-amber-800 text-base">Estimasi Denda Akumulatif</span>
                                        <span class="text-sm text-amber-700/80 font-medium">Denda berjalan sementara sebelum buku dikembalikan secara fisik.</span>
                                    </div>
                                </div>
                                
                                {{-- Sisi Kanan: Nominal Denda --}}
                                <div class="bg-white/80 border border-amber-100 rounded-lg px-4 py-2 text-right shadow-inner shrink-0 self-end sm:self-center">
                                    <span class="text-xs font-bold text-amber-600/80 block uppercase tracking-wider mb-0.5">Total Sementara</span>
                                    <span class="text-xl font-black text-amber-700 tracking-tight">
                                        Rp {{ number_format($estimasiDenda, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                </div>
            </div>
 
            {{-- Kolom Kanan: Aksi --}}
            <div class="flex flex-col gap-4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-600 px-5 py-3">
                        <h6 class="text-white font-semibold flex items-center gap-1.5">
                            <i class="bi bi-gear"></i> Aksi
                        </h6>
                    </div>
                    <div class="p-5 flex flex-col gap-2">
                        <a href="{{ route('transaksi.edit', $transaksi->id ?? 1) }}"
                            class="inline-flex items-center justify-center bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium px-3 py-1.5 rounded transition shadow-sm">
                            <i class="bi bi-pencil-square me-1"></i>
                            Edit
                        </a>
                        <a href="{{ route('transaksi.index') }}" class="inline-flex items-center justify-center gap-2 border border-blue-500 text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm font-semibold transition">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        
                        @if($transaksi->status === 'Dipinjam')
                            <button type="button" id="btn-kembalikan" class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                <i class="bi bi-arrow-return-left"></i> Kembalikan Buku
                            </button>
                            <form id="form-kembalikan" action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('PUT')
                            </form>
                        @endif
                    </div>
                </div>
 
                {{-- Info Card --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-cyan-500 px-5 py-3">
                        <h6 class="text-white font-semibold flex items-center gap-1.5">
                            <i class="bi bi-info-circle"></i> Info Buku
                        </h6>
                    </div>
                    <div class="p-5 space-y-2 text-sm text-gray-600">
                        <div><span class="font-semibold text-gray-700">Kategori:</span> {{ $transaksi->buku->kategori ?? '-' }}</div>
                        <div><span class="font-semibold text-gray-700">Pengarang:</span> {{ $transaksi->buku->pengarang ?? '-' }}</div>
                        <div><span class="font-semibold text-gray-700">Penerbit:</span> {{ $transaksi->buku->penerbit ?? '-' }}</div>
                        <div><span class="font-semibold text-gray-700">Stok Saat Ini:</span> {{ $transaksi->buku->stok ?? '-' }} buku</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
 
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Memastikan skrip berjalan setelah DOM selesai dimuat sepenuhnya
        document.addEventListener('DOMContentLoaded', function () {
            
            // Perbaikan Aksi Tombol Silang Tutup Alert
            const closeAlertBtn = document.getElementById('btn-close-alert');
            if (closeAlertBtn) {
                closeAlertBtn.addEventListener('click', function() {
                    const alertBox = document.getElementById('success-alert');
                    if (alertBox) {
                        alertBox.remove();
                    }
                });
            }

            // Aksi Konfirmasi Tombol Kembalikan Buku (SweetAlert2)
            const btnKembalikan = document.getElementById('btn-kembalikan');
            if (btnKembalikan) {
                btnKembalikan.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Konfirmasi Pengembalian',
                        text: 'Apakah Anda yakin ingin mengembalikan buku ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#16a34a',
                        confirmButtonText: 'Ya, Kembalikan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('form-kembalikan').submit();
                        }
                    });
                });
            }
        });
    </script>
    @endpush
 
</x-app-layout>