<x-app-layout>

    <div class="max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header Halaman & Tombol Aksi --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight flex items-center gap-2">
                <i class="bi bi-people text-gray-500"></i> Daftar Anggota
            </h1>
            <div class="flex items-center gap-2">
                <a href="{{ route('anggota.create') }}"
                    class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-base font-semibold shadow-sm transition duration-150">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Anggota
                </a>
                <a href="{{ route('anggota.export') }}"
                    class="inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-base font-semibold shadow-sm transition duration-150">
                    <i class="bi bi-file-excel me-1"></i> Export Excel
                </a>
            </div>
        </div>

        {{-- Statistik Anggota --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div
                class="bg-white p-5 rounded-xl border border-gray-100 border-l-4 border-green-500 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Anggota</p>
                    <h2 class="text-4xl font-bold text-green-600 mb-0">{{ $totalAnggota }}</h2>
                </div>
                <i class="bi bi-people-fill text-green-400" style="font-size: 3rem; opacity: 0.6;"></i>
            </div>
            <div
                class="bg-white p-5 rounded-xl border border-gray-100 border-l-4 border-blue-500 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1">Anggota Aktif</p>
                    <h2 class="text-4xl font-bold text-blue-600 mb-0">{{ $anggotaAktif }}</h2>
                </div>
                <i class="bi bi-person-check-fill text-blue-400" style="font-size: 3rem; opacity: 0.6;"></i>
            </div>
            <div
                class="bg-white p-5 rounded-xl border border-gray-100 border-l-4 border-gray-400 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1">Anggota Nonaktif</p>
                    <h2 class="text-4xl font-bold text-gray-500 mb-0">{{ $anggotaNonaktif }}</h2>
                </div>
                <i class="bi bi-person-x-fill text-gray-300" style="font-size: 3rem; opacity: 0.6;"></i>
            </div>
        </div>

        {{-- Form Advanced Search & Filter --}}
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm mb-6">
            <form action="{{ route('anggota.search') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                    <div class="md:col-span-3">
                        <input type="text" name="keyword"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-base bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 placeholder-gray-400"
                            value="{{ request('keyword') }}" placeholder="Cari nama, email, atau telepon...">
                    </div>
                    <div class="md:col-span-2">
                        <select name="jenis_kelamin"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-base bg-gray-50/50 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Jenis Kelamin</option>
                            <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <select name="status"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-base bg-gray-50/50 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Status</option>
                            <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif
                            </option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <select name="pekerjaan"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-base bg-gray-50/50 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Pekerjaan</option>
                            <option value="Mahasiswa" {{ request('pekerjaan') == 'Mahasiswa' ? 'selected' : '' }}>
                                Mahasiswa</option>
                            <option value="Pegawai" {{ request('pekerjaan') == 'Pegawai' ? 'selected' : '' }}>Pegawai
                            </option>
                            <option value="Wiraswasta" {{ request('pekerjaan') == 'Wiraswasta' ? 'selected' : '' }}>
                                Wiraswasta</option>
                        </select>
                    </div>
                    <div class="md:col-span-3 flex gap-2">
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg text-base font-semibold transition duration-150 flex items-center justify-center gap-1">
                            <i class="bi bi-search"></i> Cari
                        </button>
                        <a href="{{ route('anggota.index') }}"
                            class="w-full bg-gray-500 hover:bg-gray-600 text-white px-4 py-2.5 rounded-lg text-base font-semibold transition duration-150 flex items-center justify-center gap-1">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Tabel Anggota --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/70">
                            <th class="p-4 text-sm font-bold text-gray-500 uppercase tracking-wider">No</th>
                            <th class="p-4 text-sm font-bold text-gray-500 uppercase tracking-wider">Kode</th>
                            <th class="p-4 text-sm font-bold text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="p-4 text-sm font-bold text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="p-4 text-sm font-bold text-gray-500 uppercase tracking-wider">Telepon</th>
                            <th class="p-4 text-sm font-bold text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                            <th class="p-4 text-sm font-bold text-gray-500 uppercase tracking-wider text-center">Status
                            </th>
                            <th class="p-4 text-sm font-bold text-gray-500 uppercase tracking-wider text-center">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($anggotas as $anggota)
                            <tr class="hover:bg-gray-50/40 transition duration-150">
                                <td class="p-4 text-base font-semibold text-gray-400">{{ $loop->iteration }}</td>
                                <td class="p-4">
                                    <span
                                        class="font-mono text-sm font-semibold px-2 py-0.5 bg-gray-100 text-gray-700 rounded border border-gray-200">
                                        {{ $anggota->kode_anggota }}
                                    </span>
                                </td>
                                <td class="p-4 text-base font-bold text-gray-800">{{ $anggota->nama }}</td>
                                <td class="p-4 text-base text-gray-500">
                                    <i class="bi bi-envelope me-1"></i>{{ $anggota->email }}
                                </td>
                                <td class="p-4 text-base text-gray-500">
                                    <i class="bi bi-telephone me-1"></i>{{ $anggota->telepon }}
                                </td>
                                <td class="p-4 text-base text-gray-600">
                                    @if ($anggota->jenis_kelamin == 'Laki-laki')
                                        <i class="bi bi-gender-male text-blue-500 me-1"></i>Laki-laki
                                    @else
                                        <i class="bi bi-gender-female text-red-500 me-1"></i>Perempuan
                                    @endif
                                </td>
                                <td class="p-4 text-center">
                                    @if ($anggota->status == 'Aktif')
                                        <span
                                            class="px-2 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800 w-fit">
                                            <i class="bi bi-check-circle me-1"></i>Aktif
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-600 w-fit">
                                            <i class="bi bi-x-circle me-1"></i>Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="{{ route('anggota.show', $anggota->id) }}"
                                            class="inline-flex items-center justify-center bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-medium px-3 py-1.5 rounded transition shadow-sm">
                                            <i class="bi bi-eye-fill me-1"></i> Lihat
                                        </a>
                                        <a href="{{ route('anggota.edit', $anggota->id) }}"
                                            class="inline-flex items-center justify-center bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium px-3 py-1.5 rounded transition shadow-sm">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST"
                                            class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="inline-flex items-center justify-center bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-3 py-1.5 rounded transition shadow-sm btn-delete"
                                                data-nama="{{ $anggota->nama }}">
                                                <i class="bi bi-trash3-fill me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-12 text-gray-400">
                                    <i class="bi bi-inbox"
                                        style="font-size: 3rem; display: block; margin-bottom: 8px;"></i>
                                    <span class="text-base">Belum ada data anggota yang tersimpan.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            // SweetAlert2 untuk tombol hapus
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('.delete-form');
                    const nama = this.getAttribute('data-nama');

                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: `Apakah Anda yakin ingin menghapus anggota "${nama}"?`,
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
        </script>
    @endpush
</x-app-layout>
