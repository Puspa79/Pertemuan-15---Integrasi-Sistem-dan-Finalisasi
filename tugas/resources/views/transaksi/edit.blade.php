<x-app-layout>

    <div class="max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Card Utama --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-4">
            <div class="bg-amber-500 px-6 py-4">
                <h4 class="text-white font-bold text-lg flex items-center gap-2">
                    <i class="bi bi-pencil-square"></i> Edit Transaksi: #{{ $transaksi->id }}
                </h4>
            </div>

            <div class="p-6">
                <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Baris 1: Anggota & Buku --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="anggota_id" class="block text-sm font-semibold text-gray-700 mb-1">
                                Anggota / Peminjam <span class="text-red-500">*</span>
                            </label>
                            <select name="anggota_id" id="anggota_id"
                                    class="w-full border {{ $errors->has('anggota_id') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400">
                                <option value="">-- Pilih Anggota --</option>
                                @foreach($anggota as $item)
                                    <option value="{{ $item->id }}" {{ old('anggota_id', $transaksi->anggota_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }} ({{ $item->kode_anggota ?? $item->id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('anggota_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="buku_id" class="block text-sm font-semibold text-gray-700 mb-1">
                                Buku yang Dipinjam <span class="text-red-500">*</span>
                            </label>
                            <select name="buku_id" id="buku_id"
                                    class="w-full border {{ $errors->has('buku_id') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400">
                                <option value="">-- Pilih Buku --</option>
                                @foreach($buku as $item)
                                    <option value="{{ $item->id }}" {{ old('buku_id', $transaksi->buku_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->judul }}
                                    </option>
                                @endforeach
                            </select>
                            @error('buku_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Baris 2: Tanggal Pinjam, Tanggal Kembali, Tanggal Dikembalikan --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="tanggal_pinjam" class="block text-sm font-semibold text-gray-700 mb-1">
                                Tanggal Pinjam <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                                   class="w-full border {{ $errors->has('tanggal_pinjam') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('tanggal_pinjam', $transaksi->tanggal_pinjam ? \Carbon\Carbon::parse($transaksi->tanggal_pinjam)->format('Y-m-d') : '') }}">
                            @error('tanggal_pinjam')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal_kembali" class="block text-sm font-semibold text-gray-700 mb-1">
                                Batas Tanggal Kembali <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                                   class="w-full border {{ $errors->has('tanggal_kembali') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('tanggal_kembali', $transaksi->tanggal_kembali ? \Carbon\Carbon::parse($transaksi->tanggal_kembali)->format('Y-m-d') : '') }}">
                            @error('tanggal_kembali')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal_dikembalikan" class="block text-sm font-semibold text-gray-700 mb-1">
                                Realisasi Tanggal Kembali
                            </label>
                            <input type="date" name="tanggal_dikembalikan" id="tanggal_dikembalikan"
                                   class="w-full border {{ $errors->has('tanggal_dikembalikan') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('tanggal_dikembalikan', $transaksi->tanggal_dikembalikan ? \Carbon\Carbon::parse($transaksi->tanggal_dikembalikan)->format('Y-m-d') : '') }}">
                            @error('tanggal_dikembalikan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Baris 3: Status & Denda --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">
                                Status Transaksi <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status"
                                    class="w-full border {{ $errors->has('status') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400">
                                @foreach(['Dipinjam', 'Dikembalikan'] as $stat)
                                    <option value="{{ $stat }}" {{ old('status', $transaksi->status) == $stat ? 'selected' : '' }}>
                                        {{ $stat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="denda" class="block text-sm font-semibold text-gray-700 mb-1">
                                Total Denda (Rp)
                            </label>
                            <input type="number" name="denda" id="denda"
                                   class="w-full border {{ $errors->has('denda') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400"
                                   value="{{ old('denda', $transaksi->denda ?? 0) }}"
                                   min="0" step="500">
                            @error('denda')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Keterangan / Catatan Tambahan --}}
                    <div class="mb-6">
                        <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-1">Keterangan / Catatan</label>
                        <textarea name="keterangan" id="keterangan" rows="3"
                                  class="w-full border {{ $errors->has('keterangan') ? 'border-red-400' : 'border-gray-200' }} rounded-lg px-4 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-amber-400">{{ old('keterangan', $transaksi->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="border-gray-100 mb-5">

                    {{-- Buttons --}}
                    <div class="flex justify-between">
                        <a href="{{ route('transaksi.index') }}" class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-lg text-base font-semibold transition">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-lg text-base font-semibold transition">
                            <i class="bi bi-save"></i> Update Transaksi
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
                - Transaksi dibuat: {{ $transaksi->created_at->format('d M Y H:i') }}<br>
                - Terakhir diupdate: {{ $transaksi->updated_at->format('d M Y H:i') }}
            </p>
        </div>

    </div>
</x-app-layout>