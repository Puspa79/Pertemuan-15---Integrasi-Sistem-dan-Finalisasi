<x-app-layout>
 
    <div class="max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8 py-8">
 
        {{-- Breadcrumb --}}
        <nav class="mb-5">
            <ol class="flex items-center gap-2 text-sm text-gray-500">
                <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">Home</a></li>
                <li><span class="text-gray-300">/</span></li>
                <li><a href="{{ route('anggota.index') }}" class="hover:text-blue-600 transition">Anggota</a></li>
                <li><span class="text-gray-300">/</span></li>
                <li class="text-gray-700 font-medium">{{ $anggota->nama }}</li>
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
 
            {{-- Kolom Kiri: Info Anggota --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-green-600 px-6 py-4">
                        <h4 class="text-white font-bold text-lg flex items-center gap-2">
                            <i class="bi bi-person"></i> Detail Anggota
                        </h4>
                    </div>
 
                    <div class="p-6">
                        {{-- Avatar & Nama --}}
                        <div class="text-center mb-6">
                            @if ($anggota->jenis_kelamin == 'Laki-laki')
                                <i class="bi bi-person-circle text-blue-500" style="font-size: 5rem;"></i>
                            @else
                                <i class="bi bi-person-circle text-red-500" style="font-size: 5rem;"></i>
                            @endif
                            <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $anggota->nama }}</h3>
                            @if ($anggota->status == 'Aktif')
                                <span class="inline-flex items-center gap-1 px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-700 mt-1">
                                    <i class="bi bi-check-circle"></i> Anggota Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-600 mt-1">
                                    <i class="bi bi-x-circle"></i> Nonaktif
                                </span>
                            @endif
                        </div>
 
                        {{-- Detail Info --}}
                        <div class="space-y-3">
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-upc text-green-500"></i> Kode Anggota
                                </span>
                                <span class="font-mono text-sm text-gray-800 bg-gray-50 px-2 py-0.5 rounded border border-gray-200">{{ $anggota->kode_anggota }}</span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-envelope text-green-500"></i> Email
                                </span>
                                <span class="text-gray-800">{{ $anggota->email }}</span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-telephone text-green-500"></i> Telepon
                                </span>
                                <span class="text-gray-800">{{ $anggota->telepon }}</span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-geo-alt text-green-500"></i> Alamat
                                </span>
                                <span class="text-gray-800">{{ $anggota->alamat }}</span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-calendar text-green-500"></i> Tanggal Lahir
                                </span>
                                <span class="text-gray-800">{{ $anggota->tanggal_lahir->format('d F Y') }} <span class="text-gray-400 text-sm">({{ $anggota->umur }} tahun)</span></span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-gender-ambiguous text-green-500"></i> Jenis Kelamin
                                </span>
                                <span class="text-gray-800">{{ $anggota->jenis_kelamin }}</span>
                            </div>
                            <div class="flex gap-4 py-2 border-b border-gray-100">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-briefcase text-green-500"></i> Pekerjaan
                                </span>
                                <span class="text-gray-800">{{ $anggota->pekerjaan ?? '-' }}</span>
                            </div>
                            <div class="flex gap-4 py-2">
                                <span class="w-48 text-sm font-semibold text-gray-500 flex items-center gap-1.5">
                                    <i class="bi bi-calendar-check text-green-500"></i> Tanggal Daftar
                                </span>
                                <span class="text-gray-800">{{ $anggota->tanggal_daftar->format('d F Y') }} <span class="text-gray-400 text-sm">({{ $anggota->lama_anggota }} hari)</span></span>
                            </div>
                        </div>
 
                        {{-- Timestamps --}}
                        <div class="border-t border-gray-100 mt-4 pt-4 flex justify-between text-xs text-gray-400">
                            <span><i class="bi bi-clock me-1"></i>Ditambahkan: {{ $anggota->created_at->format('d M Y H:i') }}</span>
                            <span><i class="bi bi-clock-history me-1"></i>Terakhir Update: {{ $anggota->updated_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
 
            {{-- Kolom Kanan: Aksi --}}
            <div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-600 px-5 py-3">
                        <h6 class="text-white font-semibold flex items-center gap-1.5">
                            <i class="bi bi-gear"></i> Aksi
                        </h6>
                    </div>
                    <div class="p-5 flex flex-col gap-2">
                        <a href="{{ route('anggota.edit', $anggota->id) }}" class="inline-flex items-center justify-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                            <i class="bi bi-pencil"></i> Edit Anggota
                        </a>
                        <a href="{{ route('anggota.index') }}" class="inline-flex items-center justify-center gap-2 border border-green-500 text-green-600 hover:bg-green-50 px-4 py-2 rounded-lg text-sm font-semibold transition">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <hr class="border-gray-100">
                        <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="w-full inline-flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition btn-delete"
                                    data-nama="{{ $anggota->nama }}">
                                <i class="bi bi-trash"></i> Hapus Anggota
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ================================================================= --}}
            {{-- BAGIAN BARU: RIWAYAT PEMINJAMAN BUKU (Diletakkan di Paling Bawah) --}}
            {{-- ================================================================= --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-700 px-6 py-4 flex items-center gap-2">
                        <i class="bi bi-clock-history text-white text-lg"></i>
                        <h4 class="text-white font-bold text-lg">Riwayat Peminjaman Buku</h4>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-100 bg-gray-50/70">
                                    <th class="p-4 text-sm font-bold text-gray-500 uppercase tracking-wider w-12">No</th>
                                    <th class="p-4 text-sm font-bold text-gray-500 uppercase tracking-wider">Kode Transaksi</th>
                                    <th class="p-4 text-sm font-bold text-gray-500 uppercase tracking-wider">Judul Buku</th>
                                    <th class="p-4 text-sm font-bold text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                                    <th class="p-4 text-sm font-bold text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                                    <th class="p-4 text-sm font-bold text-gray-500 uppercase tracking-wider text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($anggota->transaksi as $ts)
                                    <tr class="hover:bg-gray-50/40 transition duration-150">
                                        <td class="p-4 text-base font-semibold text-gray-400">{{ $loop->iteration }}</td>
                                        <td class="p-4">
                                            <span class="font-mono text-sm font-semibold px-2 py-0.5 bg-gray-100 text-gray-700 rounded border border-gray-200">
                                                {{ $ts->kode_transaksi }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-base font-bold text-gray-800">{{ $ts->buku->judul ?? 'Buku Dihapus' }}</td>
                                        <td class="p-4 text-base text-gray-500">{{ \Carbon\Carbon::parse($ts->tgl_pinjam)->translatedFormat('d F Y') }}</td>
                                        <td class="p-4 text-base text-gray-500">
                                            {{ $ts->tgl_kembali ? \Carbon\Carbon::parse($ts->tgl_kembali)->translatedFormat('d F Y') : '-' }}
                                        </td>
                                        <td class="p-4 text-center">
                                            @if ($ts->status == 'Dipinjam')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Dipinjam
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Kembali
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-12 text-gray-400">
                                            <i class="bi bi-folder-x" style="font-size: 3rem; display: block; margin-bottom: 8px;"></i>
                                            <span class="text-base">Anggota ini belum memiliki riwayat peminjaman buku.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
 
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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

            // Alert Sukses Otomatis dari Session Laravel (Fix Tanda Petik / Encoded HTML)
            @if(session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{!! session('success') !!}",
                    icon: 'success',
                    confirmButtonColor: '#10b981',
                    confirmButtonText: 'Oke'
                });
            @endif

            // Aksi Konfirmasi SweetAlert2 Hapus Data
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

        });
    </script>
    @endpush
     
</x-app-layout>