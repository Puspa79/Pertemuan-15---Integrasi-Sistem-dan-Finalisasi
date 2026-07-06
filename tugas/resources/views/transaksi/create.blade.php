<x-app-layout>
 
    <div class="max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8 py-8">
 
        {{-- Breadcrumb --}}
        <nav class="mb-5">
            <ol class="flex items-center gap-2 text-sm text-gray-500">
                <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">Home</a></li>
                <li><span class="text-gray-300">/</span></li>
                <li><a href="{{ route('transaksi.index') }}" class="hover:text-blue-600 transition">Transaksi</a></li>
                <li><span class="text-gray-300">/</span></li>
                <li class="text-gray-700 font-medium">Form Peminjaman</li>
            </ol>
        </nav>
 
        <div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
 
                {{-- Header --}}
                <div class="bg-blue-600 px-6 py-4">
                    <h4 class="text-white font-bold text-lg flex items-center gap-2">
                        <i class="bi bi-plus-circle"></i> Form Peminjaman Buku
                    </h4>
                </div>
 
                <div class="p-6">
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf
 
                        {{-- Pilih Anggota --}}
                        <div class="mb-5">
                            <label for="anggota_id" class="block text-sm font-semibold text-gray-700 mb-1">
                                Pilih Anggota <span class="text-red-500">*</span>
                            </label>
                            <select name="anggota_id" id="anggota_id"
                                    class="w-full border {{ $errors->has('anggota_id') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                <option value="">-- Pilih Anggota --</option>
                                @foreach($anggotas as $anggota)
                                    <option value="{{ $anggota->id }}" {{ old('anggota_id') == $anggota->id ? 'selected' : '' }}>
                                        {{ $anggota->kode_anggota }} - {{ $anggota->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('anggota_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-400 text-xs mt-1">Hanya anggota dengan status Aktif yang dapat meminjam</p>
                        </div>
 
                        {{-- Pilih Buku --}}
                        <div class="mb-5">
                            <label for="buku_id" class="block text-sm font-semibold text-gray-700 mb-1">
                                Pilih Buku <span class="text-red-500">*</span>
                            </label>
                            <select name="buku_id" id="buku_id"
                                    class="w-full border {{ $errors->has('buku_id') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                <option value="">-- Pilih Buku --</option>
                                @foreach($bukus as $buku)
                                    <option value="{{ $buku->id }}" {{ old('buku_id') == $buku->id ? 'selected' : '' }}>
                                        {{ $buku->judul }} - (Stok: {{ $buku->stok }})
                                    </option>
                                @endforeach
                            </select>
                            @error('buku_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-400 text-xs mt-1">Hanya buku dengan stok tersedia yang dapat dipinjam</p>
                        </div>
 
                        {{-- Tanggal Pinjam --}}
                        <div class="mb-5">
                            <label for="tanggal_pinjam" class="block text-sm font-semibold text-gray-700 mb-1">
                                Tanggal Pinjam <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                                   class="w-full border {{ $errors->has('tanggal_pinjam') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                                   max="{{ date('Y-m-d') }}">
                            @error('tanggal_pinjam')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-400 text-xs mt-1">Tanggal kembali otomatis 7 hari dari tanggal pinjam</p>
                        </div>
 
                        {{-- Keterangan --}}
                        <div class="mb-5">
                            <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-1">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="3"
                                      class="w-full border {{ $errors->has('keterangan') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
 
                        {{-- Info Box --}}
                        <div class="flex items-start gap-3 bg-blue-50 border border-blue-100 rounded-lg px-4 py-3 mb-6 text-sm text-blue-700">
                            <i class="bi bi-info-circle mt-0.5 text-base"></i>
                            <div>
                                <strong>Informasi Peminjaman:</strong>
                                <ul class="mt-1 space-y-0.5 list-disc list-inside">
                                    <li>Durasi peminjaman: <strong>7 hari</strong></li>
                                    <li>Denda keterlambatan: <strong>Rp 5.000/hari</strong></li>
                                    <li>Stok buku akan berkurang otomatis setelah peminjaman</li>
                                </ul>
                            </div>
                        </div>
 
                        <hr class="border-gray-100 mb-5">
 
                        {{-- Buttons --}}
                        <div class="flex justify-between">
                            <a href="{{ route('transaksi.index') }}" class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-lg text-base font-semibold transition">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-base font-semibold transition">
                                <i class="bi bi-save"></i> Proses Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
 
            </div>
        </div>
    </div>
 
</x-app-layout>