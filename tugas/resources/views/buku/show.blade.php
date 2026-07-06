<x-app-layout>
 
    <div class="max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8 py-8">
 
        {{-- Breadcrumb --}}
        <nav class="mb-5">
            <ol class="flex items-center gap-2 text-sm text-gray-500">
                <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">Home</a></li>
                <li><span class="text-gray-300">/</span></li>
                <li><a href="{{ route('buku.index') }}" class="hover:text-blue-600 transition">Buku</a></li>
                <li><span class="text-gray-300">/</span></li>
                <li class="text-gray-700 font-medium">{{ $buku->judul }}</li>
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
 
            {{-- Kolom Kiri: Info Buku --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    {{-- Header --}}
                    <div class="bg-blue-600 px-6 py-4">
                        <h4 class="text-white font-bold text-lg flex items-center gap-2">
                            <i class="bi bi-book"></i> Detail Buku
                        </h4>
                    </div>
 
                    <div class="p-6">
                        {{-- Judul --}}
                        <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ $buku->judul }}</h2>
 
                        {{-- Badge Kategori --}}
                        @php
                            $warnaKategori = match($buku->kategori) {
                                'Programming' => 'bg-blue-100 text-blue-700 border-blue-200',
                                'Database' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                'Web Design' => 'bg-cyan-100 text-cyan-700 border-cyan-200',
                                'Networking' => 'bg-amber-100 text-amber-700 border-amber-200',
                                'Data Science' => 'bg-rose-100 text-rose-700 border-rose-200',
                                default => 'bg-gray-100 text-gray-700 border-gray-200',
                            };
                        @endphp
                        <div class="mb-5">
                            <span class="inline-block text-sm font-bold uppercase tracking-wide px-3 py-1 rounded-full border {{ $warnaKategori }}">
                                <i class="bi bi-tag me-1"></i>{{ $buku->kategori }}
                            </span>
                        </div>
 
                        {{-- Informasi Detail --}}
                        <div class="space-y-3 mb-5">
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-44 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-upc text-blue-500"></i> Kode Buku
                                </span>
                                <span class="text-gray-800 font-mono text-sm">{{ $buku->kode_buku }}</span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-44 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-person text-blue-500"></i> Pengarang
                                </span>
                                <span class="text-gray-800">{{ $buku->pengarang }}</span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-44 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-building text-blue-500"></i> Penerbit
                                </span>
                                <span class="text-gray-800">{{ $buku->penerbit }}</span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-44 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-calendar text-blue-500"></i> Tahun Terbit
                                </span>
                                <span class="text-gray-800">{{ $buku->tahun_terbit }}</span>
                            </div>
                            @if ($buku->isbn)
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-44 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-hash text-blue-500"></i> ISBN
                                </span>
                                <span class="text-gray-800">{{ $buku->isbn }}</span>
                            </div>
                            @endif
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-44 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-translate text-blue-500"></i> Bahasa
                                </span>
                                <span class="text-gray-800">{{ $buku->bahasa }}</span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-44 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-cash text-blue-500"></i> Harga
                                </span>
                                <span class="text-gray-800 font-bold">Rp {{ number_format($buku->harga, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex gap-4 py-2">
                                <span class="w-44 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-boxes text-blue-500"></i> Stok
                                </span>
                                <span class="text-gray-800 flex items-center gap-2">
                                    <strong>{{ $buku->stok }}</strong> buku
                                    @if ($buku->stok > 0)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                            <i class="bi bi-check-circle"></i> Tersedia
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                            <i class="bi bi-x-circle"></i> Habis
                                        </span>
                                    @endif
                                </span>
                            </div>
                        </div>
 
                        {{-- Deskripsi --}}
                        <div class="border-t border-gray-100 pt-4">
                            @if ($buku->deskripsi)
                                <h5 class="text-base font-semibold text-gray-700 mb-2 flex items-center gap-1.5">
                                    <i class="bi bi-file-text text-blue-500"></i> Deskripsi
                                </h5>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $buku->deskripsi }}</p>
                            @else
                                <p class="text-gray-400 italic text-sm flex items-center gap-1.5">
                                    <i class="bi bi-info-circle"></i> Tidak ada deskripsi untuk buku ini
                                </p>
                            @endif
                        </div>
 
                        {{-- Timestamps --}}
                        <div class="border-t border-gray-100 mt-4 pt-4 flex justify-between text-xs text-gray-400">
                            <span><i class="bi bi-clock me-1"></i>Ditambahkan: {{ $buku->created_at->format('d M Y H:i') }}</span>
                            <span><i class="bi bi-clock-history me-1"></i>Terakhir Update: {{ $buku->updated_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
 
            {{-- Kolom Kanan --}}
            <div class="flex flex-col gap-4">
 
                {{-- Card Aksi --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-600 px-5 py-3">
                        <h6 class="text-white font-semibold flex items-center gap-1.5">
                            <i class="bi bi-gear"></i> Aksi
                        </h6>
                    </div>
                    <div class="p-5 flex flex-col gap-2">
                        <a href="{{ route('buku.edit', $buku->id) }}" class="inline-flex items-center justify-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                            <i class="bi bi-pencil"></i> Edit Buku
                        </a>
 
                        @if ($buku->stok > 0)
                            <button class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                <i class="bi bi-cart-plus"></i> Pinjam Buku
                            </button>
                        @else
                            <button disabled class="inline-flex items-center justify-center gap-2 bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-sm font-semibold cursor-not-allowed">
                                <i class="bi bi-x-circle"></i> Stok Habis
                            </button>
                        @endif
 
                        <a href="{{ route('buku.index') }}" class="inline-flex items-center justify-center gap-2 border border-blue-500 text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm font-semibold transition">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
 
                        <hr class="border-gray-100">
 
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="w-full inline-flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition btn-delete"
                                    data-judul="{{ $buku->judul }}">
                                <i class="bi bi-trash"></i> Hapus Buku
                            </button>
                        </form>
                    </div>
                </div>
 
                {{-- Card Status Stok --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-cyan-500 px-5 py-3">
                        <h6 class="text-white font-semibold flex items-center gap-1.5">
                            <i class="bi bi-info-circle"></i> Status Stok
                        </h6>
                    </div>
                    <div class="p-5">
                        @if ($buku->stok == 0)
                            <div class="flex items-start gap-2 bg-red-50 border border-red-100 rounded-lg p-4 text-red-700 text-sm">
                                <i class="bi bi-exclamation-triangle mt-0.5"></i>
                                <div><strong>Stok Habis!</strong><br>Buku ini sedang tidak tersedia.</div>
                            </div>
                        @elseif ($buku->stok <= 5)
                            <div class="flex items-start gap-2 bg-amber-50 border border-amber-100 rounded-lg p-4 text-amber-700 text-sm">
                                <i class="bi bi-exclamation-circle mt-0.5"></i>
                                <div><strong>Stok Menipis!</strong><br>Tersisa {{ $buku->stok }} buku.</div>
                            </div>
                        @else
                            <div class="flex items-start gap-2 bg-green-50 border border-green-100 rounded-lg p-4 text-green-700 text-sm">
                                <i class="bi bi-check-circle mt-0.5"></i>
                                <div><strong>Stok Aman!</strong><br>Tersedia {{ $buku->stok }} buku.</div>
                            </div>
                        @endif
                    </div>
                </div>
 
                {{-- Card Buku Serupa --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-800 px-5 py-3">
                        <h6 class="text-white font-semibold flex items-center gap-1.5">
                            <i class="bi bi-collection"></i> Buku Serupa
                        </h6>
                    </div>
                    <div class="p-5">
                        @php
                            $bukuSerupa = App\Models\Buku::where('kategori', $buku->kategori)
                                                                          ->where('id', '!=', $buku->id)
                                                                          ->take(3)
                                                                          ->get();
                        @endphp
 
                        @forelse ($bukuSerupa as $item)
                            <div class="{{ !$loop->last ? 'mb-4 pb-4 border-b border-gray-100' : '' }}">
                                <a href="{{ route('buku.show', $item->id) }}" class="text-sm font-semibold text-gray-800 hover:text-blue-600 transition block mb-0.5">
                                    {{ Str::limit($item->judul, 40) }}
                                </a>
                                <span class="text-xs text-gray-400">{{ $item->pengarang }}</span>
                            </div>
                        @empty
                            <p class="text-gray-400 text-sm flex items-center gap-1.5">
                                <i class="bi bi-info-circle"></i> Tidak ada buku serupa
                            </p>
                        @endforelse
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
            
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    const judul = this.getAttribute('data-judul');
     
                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: `Apakah Anda yakin ingin menghapus buku "${judul}"?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

        }); // <-- Tanda kurung penutup DOMContentLoaded ini yang sebelumnya hilang
    </script>
    @endpush
</x-app-layout>