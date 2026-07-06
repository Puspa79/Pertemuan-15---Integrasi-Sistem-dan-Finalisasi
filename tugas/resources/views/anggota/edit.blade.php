<x-app-layout>
 
    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush
 
    <div class="max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8 py-8">
 
        {{-- Card Utama --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-4">
            <div class="bg-amber-500 px-6 py-4">
                <h4 class="text-white font-bold text-lg flex items-center gap-2">
                    <i class="bi bi-pencil-square"></i> Edit Anggota: {{ $anggota->nama }}
                </h4>
            </div>
 
            <div class="p-6">
                <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
                    @csrf
                    @method('PUT')
 
                    {{-- Baris 1: Kode Anggota & Nama --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="kode_anggota" class="block text-sm font-semibold text-gray-700 mb-1">
                                Kode Anggota <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="kode_anggota" id="kode_anggota"
                                   class="w-full border {{ $errors->has('kode_anggota') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('kode_anggota', $anggota->kode_anggota) }}">
                            @error('kode_anggota')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div class="md:col-span-2">
                            <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama" id="nama"
                                   class="w-full border {{ $errors->has('nama') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('nama', $anggota->nama) }}">
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
 
                    {{-- Baris 2: Email & Telepon --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email"
                                   class="w-full border {{ $errors->has('email') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('email', $anggota->email) }}">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="telepon" class="block text-sm font-semibold text-gray-700 mb-1">
                                Nomor Telepon <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="telepon" id="telepon"
                                   class="w-full border {{ $errors->has('telepon') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('telepon', $anggota->telepon) }}">
                            @error('telepon')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
 
                    {{-- Alamat --}}
                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-1">
                            Alamat Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea name="alamat" id="alamat" rows="3"
                                  class="w-full border {{ $errors->has('alamat') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400">{{ old('alamat', $anggota->alamat) }}</textarea>
                        @error('alamat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
 
                    {{-- Baris 3: Tanggal Lahir, Jenis Kelamin, Pekerjaan --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700 mb-1">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                   class="w-full border {{ $errors->has('tanggal_lahir') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('tanggal_lahir', date('Y-m-d', strtotime($anggota->tanggal_lahir))) }}"
                                   max="{{ date('Y-m-d') }}">
                            @error('tanggal_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-700 mb-1">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                    class="w-full border {{ $errors->has('jenis_kelamin') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                @foreach(['Laki-laki', 'Perempuan'] as $jk)
                                    <option value="{{ $jk }}" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == $jk ? 'selected' : '' }}>
                                        {{ $jk }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_kelamin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="pekerjaan" class="block text-sm font-semibold text-gray-700 mb-1">Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="pekerjaan"
                                   class="w-full border {{ $errors->has('pekerjaan') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('pekerjaan', $anggota->pekerjaan) }}">
                            @error('pekerjaan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
 
                    {{-- Baris 4: Tanggal Daftar & Status --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="tanggal_daftar" class="block text-sm font-semibold text-gray-700 mb-1">
                                Tanggal Pendaftaran <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_daftar" id="tanggal_daftar"
                                   class="w-full border {{ $errors->has('tanggal_daftar') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('tanggal_daftar', $anggota->tanggal_daftar?->format('Y-m-d')) }}"
                                   max="{{ date('Y-m-d') }}">
                            @error('tanggal_daftar')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status"
                                    class="w-full border {{ $errors->has('status') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400">
                                @foreach(['Aktif', 'Nonaktif'] as $st)
                                    <option value="{{ $st }}" {{ old('status', $anggota->status) == $st ? 'selected' : '' }}>
                                        {{ $st }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
 
                    <hr class="border-gray-100 mb-5">
 
                    {{-- Buttons --}}
                    <div class="flex justify-between">
                        <a href="{{ route('anggota.index', $anggota->id) }}" class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-lg text-base font-semibold transition">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-lg text-base font-semibold transition">
                            <i class="bi bi-save"></i> Update Anggota
                        </button>
                    </div>
                </form>
            </div>
        </div>
 
        {{-- Info Update --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <p class="text-sm text-gray-400">
                <strong class="text-gray-600">Informasi:</strong><br>
                - Anggota terdaftar: {{ $anggota->created_at->format('d M Y H:i') }}<br>
                - Terakhir diupdate: {{ $anggota->updated_at->format('d M Y H:i') }}<br>
                - Lama menjadi anggota: {{ $anggota->lama_anggota }} hari ({{ round($anggota->lama_anggota / 365, 1) }} tahun)
            </p>
        </div>
 
    </div>
 
    @push('scripts')
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
        });
    </script>
    @endpush
</x-app-layout>