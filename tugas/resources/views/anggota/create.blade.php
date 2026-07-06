<x-app-layout>
 
    {{-- Flatpickr CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
 
    <div class="max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8 py-8">
 
        {{-- Breadcrumb --}}
        <nav class="mb-3">
            <ol class="flex items-center gap-2 text-sm text-gray-500">
                <li>
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">
                        Home
                    </a>
                </li>
                <li class="text-gray-300">/</li>
                <li>
                    <a href="{{ route('anggota.index') }}" class="hover:text-blue-600 transition">
                        Anggota
                    </a>
                </li>
                <li class="text-gray-300">/</li>
                <li class="text-gray-700 font-medium">
                    Tambah Anggota
                </li>
            </ol>
        </nav>
 
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
 
            {{-- Header --}}
            <div class="bg-blue-600 px-6 py-4">
                <h4 class="text-white font-bold text-lg flex items-center gap-2">
                    <i class="bi bi-person-plus-fill"></i>
                    Tambah Anggota Baru
                </h4>
            </div>
 
            <div class="p-6">
 
                @if (session('error'))
                    <div class="flex items-start gap-3 bg-red-50 border border-red-200 rounded-lg px-4 py-3 mb-6 text-sm text-red-700">
                        <i class="bi bi-x-circle mt-0.5"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif
 
                <form action="{{ route('anggota.store') }}" method="POST">
                    @csrf
 
                    {{-- Baris 1: Kode Anggota & Nama Lengkap --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3">
 
                        <div>
                            <label for="kode_anggota" class="block text-sm font-semibold text-gray-700 mb-1">
                                Kode Anggota <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="kode_anggota"
                                id="kode_anggota"
                                value="{{ old('kode_anggota', $kodeAnggota ?? '') }}"
                                readonly
                                class="w-full border border-gray-200 bg-gray-100 text-gray-500 rounded-lg px-4 py-2 text-base cursor-not-allowed"
                            >
                            <p class="text-gray-400 text-xs mt-1">
                                Format otomatis: AGT-[TAHUN]-[NOMOR_URUT]
                            </p>
                        </div>
 
                        <div class="md:col-span-2">
                            <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="nama"
                                id="nama"
                                value="{{ old('nama') }}"
                                placeholder="Nama lengkap anggota"
                                class="w-full border {{ $errors->has('nama') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                    </div>
 
                    {{-- Baris 2: Email & Nomor Telepon --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
 
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                placeholder="email@example.com"
                                class="w-full border {{ $errors->has('email') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="telepon" class="block text-sm font-semibold text-gray-700 mb-1">
                                Nomor Telepon <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="telepon"
                                id="telepon"
                                value="{{ old('telepon') }}"
                                placeholder="081234567890"
                                class="w-full border {{ $errors->has('telepon') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                            @error('telepon')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-400 text-xs mt-1">
                                Format: 08xxxxxxxxxx atau +628xxxxxxxxxx
                            </p>
                        </div>
 
                    </div>
 
                    {{-- Baris 3: Alamat Lengkap --}}
                    <div class="mb-3">
                        <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-1">
                            Alamat Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            name="alamat"
                            id="alamat"
                            rows="3"
                            placeholder="Alamat lengkap dengan kota dan kode pos"
                            class="w-full border {{ $errors->has('alamat') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
 
                    {{-- Baris 4: Tanggal Lahir, Jenis Kelamin, Pekerjaan --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3">
 
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700 mb-1">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="tanggal_lahir"
                                id="tanggal_lahir"
                                value="{{ old('tanggal_lahir') }}"
                                placeholder="Pilih Tanggal"
                                class="w-full border {{ $errors->has('tanggal_lahir') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                            @error('tanggal_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-700 mb-1">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <select
                                name="jenis_kelamin"
                                id="jenis_kelamin"
                                class="w-full border {{ $errors->has('jenis_kelamin') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="pekerjaan" class="block text-sm font-semibold text-gray-700 mb-1">
                                Pekerjaan
                            </label>
                            <input
                                type="text"
                                name="pekerjaan"
                                id="pekerjaan"
                                value="{{ old('pekerjaan') }}"
                                placeholder="Contoh: Mahasiswa, Pegawai, dll"
                                class="w-full border {{ $errors->has('pekerjaan') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                            @error('pekerjaan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                    </div>
 
                    {{-- Baris 5: Tanggal Daftar & Status --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
 
                        <div>
                            <label for="tanggal_daftar" class="block text-sm font-semibold text-gray-700 mb-1">
                                Tanggal Pendaftaran <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="tanggal_daftar"
                                id="tanggal_daftar"
                                value="{{ old('tanggal_daftar', date('Y-m-d')) }}"
                                placeholder="Pilih Tanggal"
                                class="w-full border {{ $errors->has('tanggal_daftar') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                            @error('tanggal_daftar')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select
                                name="status"
                                id="status"
                                class="w-full border {{ $errors->has('status') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                <option value="Aktif" {{ old('status', 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                    </div>
 
                    <hr class="border-gray-100 mb-4">
 
                    {{-- Buttons --}}
                    <div class="flex justify-between">
                        <a
                            href="{{ route('anggota.index') }}"
                            class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg text-base font-semibold transition"
                        >
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </a>
 
                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-base font-semibold transition"
                        >
                            <i class="bi bi-check-circle"></i>
                            Simpan Anggota
                        </button>
                    </div>
 
                </form>
            </div>
        </div>
 
    </div>
 
    {{-- Flatpickr JS --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script>
        flatpickr("#tanggal_lahir", {
            dateFormat: "Y-m-d",
            maxDate: "today",
            locale: "id",
            altInput: true,
            altFormat: "d F Y",
        });
 
        flatpickr("#tanggal_daftar", {
            dateFormat: "Y-m-d",
            maxDate: "today",
            locale: "id",
            altInput: true,
            altFormat: "d F Y",
            defaultDate: "{{ old('tanggal_daftar', date('Y-m-d')) }}",
        });
 
        // Auto format nomor telepon: hanya angka dan tanda +
        document.getElementById('telepon').addEventListener('input', function() {
            this.value = this.value.replace(/[^\d+]/g, '');
        });
    </script>
</x-app-layout>