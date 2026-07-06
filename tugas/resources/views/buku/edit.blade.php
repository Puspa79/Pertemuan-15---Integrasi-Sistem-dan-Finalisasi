<x-app-layout>
 
    <div class="max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8 py-8">
 
        {{-- Card Utama --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-4">
            <div class="bg-amber-500 px-6 py-4">
                <h4 class="text-white font-bold text-lg flex items-center gap-2">
                    <i class="bi bi-pencil-square"></i> Edit Buku: {{ $buku->judul }}
                </h4>
            </div>
 
            <div class="p-6">
                <form action="{{ route('buku.update', $buku->id) }}" method="POST">
                    @csrf
                    @method('PUT')
 
                    {{-- Baris 1: Kode Buku & Judul --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="kode_buku" class="block text-sm font-semibold text-gray-700 mb-1">
                                Kode Buku <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="kode_buku" id="kode_buku"
                                   class="w-full border {{ $errors->has('kode_buku') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('kode_buku', $buku->kode_buku) }}">
                            @error('kode_buku')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div class="md:col-span-2">
                            <label for="judul" class="block text-sm font-semibold text-gray-700 mb-1">
                                Judul Buku <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul" id="judul"
                                   class="w-full border {{ $errors->has('judul') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('judul', $buku->judul) }}">
                            @error('judul')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
 
                    {{-- Baris 2: Kategori, Pengarang, Penerbit --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-1">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select name="kategori" id="kategori"
                                    class="w-full border {{ $errors->has('kategori') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach(['Programming', 'Database', 'Web Design', 'Networking', 'Data Science'] as $kat)
                                    <option value="{{ $kat }}" {{ old('kategori', $buku->kategori) == $kat ? 'selected' : '' }}>
                                        {{ $kat }}
                                    </option>
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
                                   class="w-full border {{ $errors->has('pengarang') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('pengarang', $buku->pengarang) }}">
                            @error('pengarang')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="penerbit" class="block text-sm font-semibold text-gray-700 mb-1">
                                Penerbit <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="penerbit" id="penerbit"
                                   class="w-full border {{ $errors->has('penerbit') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('penerbit', $buku->penerbit) }}">
                            @error('penerbit')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
 
                    {{-- Baris 3: Tahun, ISBN, Bahasa, Harga, Stok --}}
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-4">
                        <div>
                            <label for="tahun_terbit" class="block text-sm font-semibold text-gray-700 mb-1">
                                Tahun Terbit <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="tahun_terbit" id="tahun_terbit"
                                   class="w-full border {{ $errors->has('tahun_terbit') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                                   min="1900" max="{{ date('Y') }}">
                            @error('tahun_terbit')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="isbn" class="block text-sm font-semibold text-gray-700 mb-1">ISBN</label>
                            <input type="text" name="isbn" id="isbn"
                                   class="w-full border {{ $errors->has('isbn') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('isbn', $buku->isbn) }}">
                            @error('isbn')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="bahasa" class="block text-sm font-semibold text-gray-700 mb-1">
                                Bahasa <span class="text-red-500">*</span>
                            </label>
                            <select name="bahasa" id="bahasa"
                                    class="w-full border {{ $errors->has('bahasa') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400">
                                <option value="Indonesia" {{ old('bahasa', $buku->bahasa) == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                <option value="Inggris" {{ old('bahasa', $buku->bahasa) == 'Inggris' ? 'selected' : '' }}>Inggris</option>
                            </select>
                            @error('bahasa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="harga" class="block text-sm font-semibold text-gray-700 mb-1">
                                Harga <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="harga" id="harga"
                                   class="w-full border {{ $errors->has('harga') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('harga', $buku->harga) }}"
                                   min="0" step="1000">
                            @error('harga')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <div>
                            <label for="stok" class="block text-sm font-semibold text-gray-700 mb-1">
                                Stok <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="stok" id="stok"
                                   class="w-full border {{ $errors->has('stok') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('stok', $buku->stok) }}"
                                   min="0">
                            @error('stok')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
 
                    {{-- Deskripsi --}}
                    <div class="mb-6">
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                                  class="w-full border {{ $errors->has('deskripsi') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
 
                    <hr class="border-gray-100 mb-5">
 
                    {{-- Buttons --}}
                    <div class="flex justify-between">
                        <a href="{{ route('buku.index', $buku->id) }}" class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-lg text-base font-semibold transition">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-lg text-base font-semibold transition">
                            <i class="bi bi-save"></i> Update Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
 
        {{-- Info Update --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <p class="text-sm text-gray-400">
                <i class="bi bi-info-circle me-1"></i>
                <strong class="text-gray-600">Informasi:</strong><br>
                - Buku ditambahkan: {{ $buku->created_at->format('d M Y H:i') }}<br>
                - Terakhir diupdate: {{ $buku->updated_at->format('d M Y H:i') }}
            </p>
        </div>
 
    </div>
</x-app-layout>