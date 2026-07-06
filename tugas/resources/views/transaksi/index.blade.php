<x-app-layout>

    <div class="py-12">
        <div class="max-w-[90%] mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Bagian Atas: Judul & Tombol Aksi --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-2">
                        Daftar Transaksi Peminjaman
                    </h1>
                </div>

                <div class="flex items-center gap-2 w-full sm:w-auto mt-4 sm:mt-0">
                    {{-- Tombol Laporan --}}
                    <a href="{{ route('transaksi.laporan') }}"
                        class="inline-flex items-center justify-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-base font-medium rounded-lg shadow-sm transition-colors gap-2 w-full sm:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2m32-2v-2a4 4 0 00-4-4h-3a4 4 0 00-4 4v2M9 21h12a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Laporan
                    </a>

                    {{-- Tombol Pinjam Buku --}}
                    <a href="{{ route('transaksi.create') }}"
                        class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-base font-medium rounded-lg shadow-sm transition-colors gap-2 w-full sm:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pinjam Buku
                    </a>
                </div>
            </div>

            {{-- Bagian Statistik (Grid 3 Kolom) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500 flex flex-col justify-between">
                    <span class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total Transaksi</span>
                    <span class="text-4xl font-extrabold text-blue-600 mt-2">{{ $transaksis->count() }}</span>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-amber-500 flex flex-col justify-between">
                    <span class="text-sm font-bold text-gray-400 uppercase tracking-wider">Sedang Dipinjam</span>
                    <span class="text-4xl font-extrabold text-amber-500 mt-2">{{ $transaksis->where('status', 'Dipinjam')->count() }}</span>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500 flex flex-col justify-between">
                    <span class="text-sm font-bold text-gray-400 uppercase tracking-wider">Sudah Dikembalikan</span>
                    <span class="text-4xl font-extrabold text-green-600 mt-2">{{ $transaksis->where('status', 'Dikembalikan')->count() }}</span>
                </div>
            </div>

            {{-- Form Advanced Search & Filter --}}
            <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
                <form action="{{ route('transaksi.search') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                        <div class="md:col-span-4">
                            <input type="text" name="keyword"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-base bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 placeholder-gray-400"
                                value="{{ request('keyword') }}"
                                placeholder="Cari kode, nama anggota, atau judul buku...">
                        </div>
                        <div class="md:col-span-2">
                            <input type="date" name="tanggal_pinjam"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-base bg-gray-50/50 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ request('tanggal_pinjam') }}">
                        </div>
                        <div class="md:col-span-2">
                            <select name="status"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-base bg-gray-50/50 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Status</option>
                                <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                            </select>
                        </div>
                        <div class="md:col-span-4 flex gap-2">
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg text-base font-semibold transition duration-150 flex items-center justify-center gap-1">
                                <i class="bi bi-search"></i> Cari
                            </button>
                            <a href="{{ route('transaksi.index') }}"
                                class="w-full bg-gray-500 hover:bg-gray-600 text-white px-4 py-2.5 rounded-lg text-base font-semibold transition duration-150 flex items-center justify-center gap-1">
                                <i class="bi bi-arrow-clockwise"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Tabel Transaksi Utama --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-sm font-bold text-gray-500 uppercase tracking-wider w-16">No</th>
                                <th class="px-6 py-4 text-sm font-bold text-gray-500 uppercase tracking-wider">Kode</th>
                                <th class="px-6 py-4 text-sm font-bold text-gray-500 uppercase tracking-wider">Anggota</th>
                                <th class="px-6 py-4 text-sm font-bold text-gray-500 uppercase tracking-wider">Buku</th>
                                <th class="px-6 py-4 text-sm font-bold text-gray-500 uppercase tracking-wider">Tgl Pinjam</th>
                                <th class="px-6 py-4 text-sm font-bold text-gray-500 uppercase tracking-wider">Tgl Kembali</th>
                                <th class="px-6 py-4 text-sm font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-sm font-bold text-gray-500 uppercase tracking-wider text-center w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($transaksis as $transaksi)
                                <tr class="hover:bg-gray-50/80 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-base text-gray-600">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-base font-mono text-pink-600 bg-pink-50/50 rounded px-1.5 py-0.5 inline-block my-3 mx-2">
                                        {{ $transaksi->kode_transaksi }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-base font-semibold text-gray-900">{{ $transaksi->anggota->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-base text-gray-600">{{ $transaksi->buku->judul }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-base text-gray-500">{{ $transaksi->tanggal_pinjam->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-base text-gray-500">{{ $transaksi->tanggal_kembali->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-base">
                                        <div class="flex flex-col gap-1">
                                            @if ($transaksi->status == 'Dipinjam')
                                                <span class="px-2 py-1 text-sm font-semibold rounded-full bg-amber-100 text-amber-800 w-fit">
                                                    Dipinjam
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800 w-fit">
                                                    Dikembalikan
                                                </span>
                                            @endif

                                            @if ($transaksi->status == 'Dipinjam' && \Carbon\Carbon::parse($transaksi->tanggal_kembali)->isPast())
                                                <span class="px-2 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-700 w-fit">
                                                    Terlambat {{ abs((int) now()->diffInDays(\Carbon\Carbon::parse($transaksi->tanggal_kembali))) }} Hari
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-center">
                                        <div class="flex items-center justify-center gap-1">
                                            <a href="{{ route('transaksi.show', $transaksi->id) }}"
                                                class="px-3 py-1.5 bg-cyan-400 hover:bg-cyan-500 text-white text-sm font-semibold rounded shadow-sm transition-colors">
                                                <i class="bi bi-eye-fill me-1"></i> Lihat
                                            </a>

                                            <form action="{{ route('transaksi.destroy', $transaksi->id) }}"
                                                method="POST" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold rounded shadow-sm transition-colors btn-delete"
                                                    data-kode="{{ $transaksi->kode_transaksi }}">
                                                    <i class="bi bi-trash3-fill me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-10 text-center text-base text-gray-400 bg-gray-50/30">
                                        Belum ada data riwayat transaksi peminjaman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    {{-- Memanggil library SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // 2. SWEETALERT PEMBERITAHUAN SUKSES DARI CONTROLLER
            @if(session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{!! session('success') !!}",
                    icon: 'success',
                    confirmButtonColor: '#6366f1', // Warna indigo menyesuaikan tema transaksi
                    confirmButtonText: 'Oke'
                });
            @endif

            // 3. SWEETALERT KONFIRMASI TOMBOL HAPUS DATA
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('.delete-form');
                    const kode = this.getAttribute('data-kode');

                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: `Apakah Anda yakin ingin menghapus transaksi ${kode}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            }); // <-- Satu penutup DOMContentLoaded yang membungkus semua kode di atas
        </script>
    @endpush
</x-app-layout>