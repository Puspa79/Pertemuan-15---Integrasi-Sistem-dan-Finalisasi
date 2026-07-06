<x-app-layout>
 
    <div class="max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8 py-8">
 
        {{-- Breadcrumb --}}
        <nav class="mb-3">
            <ol class="flex items-center gap-2 text-sm text-gray-500">
                <li>
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">Home</a>
                </li>
                <li class="text-gray-300">/</li>
                <li>
                    <a href="{{ route('buku.index') }}" class="hover:text-blue-600 transition">Buku</a>
                </li>
                <li class="text-gray-300">/</li>
                <li class="text-gray-700 font-medium">Tambah Buku</li>
            </ol>
        </nav>
 
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
 
            {{-- Header --}}
            <div class="bg-blue-600 px-6 py-4">
                <h4 class="text-white font-bold text-lg flex items-center gap-2">
                    <i class="bi bi-plus-circle"></i> Tambah Buku Baru
                </h4>
            </div>
 
            <div class="p-6">
 
                @if (session('error'))
                    <div class="flex items-start gap-3 bg-red-50 border border-red-200 rounded-lg px-4 py-3 mb-6 text-sm text-red-700">
                        <i class="bi bi-x-circle mt-0.5"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif
 
                <form action="{{ route('buku.store') }}" method="POST">
                    @csrf
 
                    {{-- Baris 1: Kode Buku (1/3) + Judul (2/3) --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="kode_buku" class="block text-sm font-semibold text-gray-700 mb-1">
                                Kode Buku <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="kode_buku" id="kode_buku"
                                   value="{{ old('kode_buku') }}" maxlength="20"
                                   placeholder="Contoh: BK-0001"
                                   class="w-full border {{ $errors->has('kode_buku') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('kode_buku')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div class="md:col-span-2">
                            <label for="judul" class="block text-sm font-semibold text-gray-700 mb-1">
                                Judul Buku <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul" id="judul"
                                   value="{{ old('judul') }}" maxlength="200"
                                   placeholder="Judul buku"
                                   class="w-full border {{ $errors->has('judul') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('judul')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
 
                    {{-- Baris 2: Kategori + Pengarang --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-1">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            @php $kategoriList = ['Programming', 'Database', 'Web Design', 'Networking', 'Data Science']; @endphp
                            <select name="kategori" id="kategori"
                                    class="w-full border {{ $errors->has('kategori') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoriList as $kat)
                                    <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="pengarang" class="block text-sm font-semibold text-gray-700 mb-1">
                                Pengarang <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="pengarang" id="pengarang"
                                   value="{{ old('pengarang') }}" maxlength="100"
                                   placeholder="Nama pengarang"
                                   class="w-full border {{ $errors->has('pengarang') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('pengarang')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
 
                    {{-- Baris 3: Penerbit + Tahun Terbit --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="penerbit" class="block text-sm font-semibold text-gray-700 mb-1">
                                Penerbit <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="penerbit" id="penerbit"
                                   value="{{ old('penerbit') }}" maxlength="100"
                                   placeholder="Nama penerbit"
                                   class="w-full border {{ $errors->has('penerbit') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('penerbit')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="tahun_terbit" class="block text-sm font-semibold text-gray-700 mb-1">
                                Tahun Terbit <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="tahun_terbit" id="tahun_terbit"
                                   value="{{ old('tahun_terbit') }}" min="1900" max="{{ date('Y') }}"
                                   placeholder="Contoh: {{ date('Y') }}"
                                   class="w-full border {{ $errors->has('tahun_terbit') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('tahun_terbit')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
 
                    {{-- Baris 4: ISBN + Harga --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="isbn" class="block text-sm font-semibold text-gray-700 mb-1">ISBN</label>
                            <input type="text" name="isbn" id="isbn"
                                   value="{{ old('isbn') }}" maxlength="20"
                                   placeholder="Nomor ISBN (opsional)"
                                   class="w-full border {{ $errors->has('isbn') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('isbn')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="harga" class="block text-sm font-semibold text-gray-700 mb-1">
                                Harga (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="harga" id="harga"
                                   value="{{ old('harga') }}" min="0" step="0.01"
                                   placeholder="Contoh: 150000"
                                   class="w-full border {{ $errors->has('harga') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('harga')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
 
                    {{-- Baris 5: Stok + Bahasa --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="stok" class="block text-sm font-semibold text-gray-700 mb-1">
                                Stok <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="stok" id="stok"
                                   value="{{ old('stok', 0) }}" min="0"
                                   placeholder="Jumlah stok"
                                   class="w-full border {{ $errors->has('stok') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('stok')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="bahasa" class="block text-sm font-semibold text-gray-700 mb-1">Bahasa</label>
                            <input type="text" name="bahasa" id="bahasa"
                                   value="{{ old('bahasa', 'Indonesia') }}" maxlength="20"
                                   class="w-full border {{ $errors->has('bahasa') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('bahasa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
 
                    {{-- Deskripsi --}}
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                                  placeholder="Deskripsi singkat buku (opsional)"
                                  class="w-full border {{ $errors->has('deskripsi') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
 
                    <hr class="border-gray-100 mb-4">
 
                    {{-- Buttons --}}
                    <div class="flex justify-between">
                        <a href="{{ route('buku.index') }}"
                           class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg text-base font-semibold transition">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit"
                                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-base font-semibold transition">
                            <i class="bi bi-save"></i> Simpan Buku
                        </button>
                    </div>
 
                </form>
            </div>
        </div>
 
    </div>
 
</x-app-layout>