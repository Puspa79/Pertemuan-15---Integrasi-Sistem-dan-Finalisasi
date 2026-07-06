<x-app-layout>

    <div class="max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header Halaman & Tombol Aksi --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">
                Daftar Koleksi Buku
            </h1>
            <div class="flex items-center gap-2">
                <a href="{{ route('buku.create') }}"
                    class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-base font-semibold shadow-sm transition duration-150">
                    <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Buku
                </a>
                <a href="{{ route('buku.export') }}"
                    class="inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-base font-semibold shadow-sm transition duration-150">
                    <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Export CSV
                </a>
            </div>
        </div>

        {{-- Widget Statistik --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
            <div
                class="bg-white p-5 rounded-xl border border-gray-100 border-l-4 border-blue-500 shadow-sm flex flex-col justify-between">
                <span class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Total Buku</span>
                <span class="text-4xl font-bold text-gray-800 mt-2">{{ $totalBuku ?? 12 }}</span>
            </div>
            <div
                class="bg-white p-5 rounded-xl border border-gray-100 border-l-4 border-green-500 shadow-sm flex flex-col justify-between">
                <span class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Buku Tersedia</span>
                <span class="text-4xl font-bold text-gray-800 mt-2">{{ $bukuTersedia ?? 12 }}</span>
            </div>
            <div
                class="bg-white p-5 rounded-xl border border-gray-100 border-l-4 border-red-500 shadow-sm flex flex-col justify-between">
                <span class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Buku Habis</span>
                <span class="text-4xl font-bold text-gray-800 mt-2">{{ $bukuHabis ?? 0 }}</span>
            </div>
        </div>

        {{-- Form Pencarian & Filter Kategori --}}
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm mb-6">
            <form action="{{ route('buku.index') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                    <div class="md:col-span-5">
                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-base bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 placeholder-gray-400"
                            placeholder="Cari Judul, Pengarang, atau Penerbit...">
                    </div>
                    <div class="md:col-span-3">
                        <select name="tahun"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-base bg-gray-50/50 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Pilih Tahun --</option>
                            @for ($year = date('Y'); $year >= 2000; $year--)
                                <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <select name="status"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-base bg-gray-50/50 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Status --</option>
                            <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia
                            </option>
                            <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg text-base font-semibold transition duration-150 flex items-center justify-center gap-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari
                        </button>
                    </div>
                </div>

                {{-- Filter Tag Kategori --}}
                <div class="flex flex-wrap items-center gap-2 pt-4 border-t border-gray-100">
                    <span class="text-sm font-bold text-gray-400 uppercase tracking-wider mr-2">Filter Kategori:</span>
                    <a href="{{ route('buku.index') }}"
                        class="text-sm font-medium px-3 py-1.5 rounded-full border transition {{ !request('kategori') ? 'bg-gray-800 text-white border-gray-800' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                        Semua
                    </a>

                    @php
                        $warnaFilter = [
                            'Programming' => 'text-blue-600 bg-blue-50 border-blue-200 hover:bg-blue-100',
                            'Database' => 'text-emerald-600 bg-emerald-50 border-emerald-200 hover:bg-emerald-100',
                            'Web Design' => 'text-cyan-600 bg-cyan-50 border-cyan-200 hover:bg-cyan-100',
                            'Networking' => 'text-amber-600 bg-amber-50 border-amber-200 hover:bg-amber-100',
                            'Data Science' => 'text-rose-600 bg-rose-50 border-rose-200 hover:bg-rose-100',
                        ];
                        $warnaFilterAktif = [
                            'Programming' => 'bg-blue-600 text-white border-blue-600',
                            'Database' => 'bg-emerald-600 text-white border-emerald-600',
                            'Web Design' => 'bg-cyan-600 text-white border-cyan-600',
                            'Networking' => 'bg-amber-500 text-white border-amber-500',
                            'Data Science' => 'bg-rose-600 text-white border-rose-600',
                        ];
                    @endphp

                    @foreach (['Programming', 'Database', 'Web Design', 'Networking', 'Data Science'] as $kat)
                        <a href="{{ route('buku.index', ['kategori' => $kat]) }}"
                            class="text-sm font-medium px-3 py-1.5 rounded-full border transition {{ request('kategori') == $kat ? $warnaFilterAktif[$kat] : $warnaFilter[$kat] }}">
                            {{ $kat }}
                        </a>
                    @endforeach
                </div>
            </form>
        </div>

        {{-- Tabel Buku --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/70">
                            <th
                                class="p-4 font-semibold text-gray-500 text-sm uppercase tracking-wider w-40 text-center">
                                No</th>
                            <th class="p-4 font-semibold text-gray-500 text-sm uppercase tracking-wider w-60">Sampul /
                                Kode</th>
                            <th class="p-4 font-semibold text-gray-500 text-sm uppercase tracking-wider">Informasi
                                Buku
                            </th>
                            <th
                                class="p-4 font-semibold text-gray-500 text-sm uppercase tracking-wider text-right w-40">
                                Harga & Stok</th>
                            <th
                                class="p-4 font-semibold text-gray-500 text-sm uppercase tracking-wider text-center w-40">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($bukus ?? [] as $buku)
                            <tr class="hover:bg-gray-50/40 transition duration-150">
                                <td class="p-4 text-base font-semibold text-gray-400 text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="p-4">
                                    <div class="flex flex-col gap-1.5">
                                        <span
                                            class="inline-block font-mono text-sm font-semibold px-2 py-0.5 bg-gray-100 text-gray-700 rounded border border-gray-200 w-max">
                                            {{ $buku->kode_buku ?? 'BK-PROG-2026' }}
                                        </span>
                                        @php
                                            $warnaKategori = match ($buku->kategori ?? 'Programming') {
                                                'Programming' => 'bg-blue-50 text-blue-600 border-blue-100',
                                                'Database' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                'Web Design' => 'bg-cyan-50 text-cyan-600 border-cyan-100',
                                                'Networking' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                'Data Science' => 'bg-rose-50 text-rose-600 border-rose-100',
                                                default => 'bg-gray-50 text-gray-600 border-gray-100',
                                            };
                                        @endphp
                                        <span
                                            class="inline-block text-sm font-bold uppercase tracking-wide px-2 py-0.5 rounded-full border {{ $warnaKategori }} w-max">
                                            {{ $buku->kategori ?? 'Programming' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="font-bold text-gray-800 text-base mb-1">
                                        {{ $buku->judul ?? 'PostgreSQL Advanced' }}
                                    </div>
                                    <div class="flex flex-wrap items-center gap-x-2 text-sm text-gray-400">
                                        <span>{{ $buku->pengarang ?? 'Ahmad Yani' }}</span>
                                        <span class="text-gray-200">|</span>
                                        <span>{{ $buku->penerbit ?? 'Graha Ilmu' }}</span>
                                        <span class="text-gray-200">|</span>
                                        <span>{{ $buku->tahun_terbit ?? '2026' }}</span>
                                    </div>
                                    <div class="mt-1">
                                        <span
                                            class="text-sm text-gray-400 bg-gray-50 px-1.5 py-0.5 rounded border border-gray-100">
                                            ISBN: {{ $buku->isbn ?? '978-602-1234-56-1' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="p-4 text-right">
                                    <div class="font-bold text-blue-600 text-base mb-1 text-center">
                                        Rp {{ number_format($buku->harga ?? 170000, 0, ',', '.') }}
                                    </div>
                                    @if ($buku->stok > 0)
                                        <span
                                            class="inline-block text-sm font-semibold px-2.5 py-0.5 bg-green-50 text-green-600 border border-green-100 rounded-full text-center">
                                            Tersedia ({{ $buku->stok }})
                                        </span>
                                    @else
                                        <span
                                            class="inline-block text-sm font-semibold px-2.5 py-0.5 bg-red-50 text-red-600 border border-red-100 rounded-full">
                                            Habis
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="{{ route('buku.show', $buku->id ?? 1) }}"
                                            class="inline-flex items-center justify-center bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-medium px-3 py-1.5 rounded transition shadow-sm">
                                            <i class="bi bi-eye-fill me-1"></i>
                                            Lihat
                                        </a>
                                        <form action="{{ route('buku.destroy', $buku->id ?? 1) }}" method="POST"
                                            class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="inline-flex items-center justify-center bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-3 py-1.5 rounded transition shadow-sm btn-delete"
                                                data-judul="{{ $buku->judul }}">
                                                <i class="bi bi-trash3-fill me-1"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-12 text-gray-400 bg-white">
                                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                    <span class="text-base">Tidak ada data buku yang sesuai dengan filter.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Cek apakah ada session success dari controller
            @if(session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{!! session('success') !!}",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Oke'
                });
            @endif

            // Script untuk konfirmasi hapus (btn-delete) jika diperlukan di halaman index
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    const judul = this.getAttribute('data-judul') || 'data ini';
    
                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: `Apakah Anda yakin ingin menghapus "${judul}"?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
