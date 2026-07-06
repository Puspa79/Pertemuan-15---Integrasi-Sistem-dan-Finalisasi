<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Buku Baru') }}
        </h2>
    </x-slot>

    {{-- Container pembungkus form Bootstrap agar posisinya pas di dalam Breeze --}}
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="mb-0 fw-semibold">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Buku Baru
                        </h4>
                    </div>
                    <div class="card-body p-4 bg-white">
                        <form action="{{ route('buku.store') }}" method="POST">
                            @csrf
                            
                            {{-- Baris Baru untuk Menyatukan Kode Buku dan Judul Buku --}}
                            <div class="row">
                                {{-- 1. Kolom Kode Buku (Kiri) --}}
                                <div class="col-md-6 mb-3">
                                    <label for="kode_buku" class="form-label fw-bold">Kode Buku <span class="text-danger">*</span></label>
                                    <input type="text" 
                                        name="kode_buku" 
                                        id="kode_buku" 
                                        class="form-control @error('kode_buku') is-invalid @enderror" 
                                        placeholder="Format: BK-XXX-000" 
                                        value="{{ old('kode_buku') }}">
                                    
                                    @error('kode_buku')
                                        <div class="invalid-feedback mt-1 fw-semibold" style="display: block !important;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- 2. Kolom Judul Buku (Kanan) --}}
                                <div class="col-md-6 mb-3">
                                    <label for="judul" class="form-label fw-bold">Judul Buku <span class="text-danger">*</span></label>
                                    <input type="text" 
                                        name="judul" 
                                        id="judul" 
                                        class="form-control @error('judul') is-invalid @enderror" 
                                        placeholder="Masukkan Judul Buku" 
                                        value="{{ old('judul') }}">
                                    
                                    @error('judul')
                                        <div class="invalid-feedback mt-1 fw-semibold" style="display: block !important;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                {{-- Kategori --}}
                                <div class="col-md-4 mb-3">
                                    <label for="kategori" class="form-label fw-bold">
                                        Kategori <span class="text-danger">*</span>
                                    </label>
                                    <select name="kategori" 
                                            id="kategori" 
                                            class="form-select @error('kategori') is-invalid @enderror">
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="Programming" {{ old('kategori') == 'Programming' ? 'selected' : '' }}>Programming</option>
                                        <option value="Database" {{ old('kategori') == 'Database' ? 'selected' : '' }}>Database</option>
                                        <option value="Web Design" {{ old('kategori') == 'Web Design' ? 'selected' : '' }}>Web Design</option>
                                        <option value="Networking" {{ old('kategori') == 'Networking' ? 'selected' : '' }}>Networking</option>
                                        <option value="Data Science" {{ old('kategori') == 'Data Science' ? 'selected' : '' }}>Data Science</option>
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                {{-- Pengarang --}}
                                <div class="col-md-4 mb-3">
                                    <label for="pengarang" class="form-label fw-bold">
                                        Pengarang <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="pengarang" 
                                           id="pengarang" 
                                           class="form-control @error('pengarang') is-invalid @enderror"
                                           value="{{ old('pengarang') }}"
                                           placeholder="Nama pengarang">
                                    @error('pengarang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                {{-- Penerbit --}}
                                <div class="col-md-4 mb-3">
                                    <label for="penerbit" class="form-label fw-bold">
                                        Penerbit <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="penerbit" 
                                           id="penerbit" 
                                           class="form-control @error('penerbit') is-invalid @enderror"
                                           value="{{ old('penerbit') }}"
                                           placeholder="Nama penerbit">
                                    @error('penerbit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                {{-- Tahun Terbit --}}
                                <div class="col-md-3 mb-3">
                                    <label for="tahun_terbit" class="form-label fw-bold">
                                        Tahun Terbit <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" 
                                           name="tahun_terbit" 
                                           id="tahun_terbit" 
                                           class="form-control @error('tahun_terbit') is-invalid @enderror"
                                           value="{{ old('tahun_terbit', date('Y')) }}"
                                           min="1900"
                                           max="{{ date('Y') }}">
                                    @error('tahun_terbit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                {{-- ISBN --}}
                                <div class="col-md-3 mb-3">
                                    <label for="isbn" class="form-label fw-bold">ISBN</label>
                                    <input type="text" 
                                           name="isbn" 
                                           id="isbn" 
                                           class="form-control @error('isbn') is-invalid @enderror"
                                           value="{{ old('isbn') }}"
                                           placeholder="978-xxx-xxx">
                                    @error('isbn')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                {{-- Bahasa --}}
                                <div class="col-md-2 mb-3">
                                    <label for="bahasa" class="form-label fw-bold">
                                        Bahasa <span class="text-danger">*</span>
                                    </label>
                                    <select name="bahasa" 
                                            id="bahasa" 
                                            class="form-select @error('bahasa') is-invalid @enderror">
                                        <option value="Indonesia" {{ old('bahasa', 'Indonesia') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                        <option value="Inggris" {{ old('bahasa') == 'Inggris' ? 'selected' : '' }}>Inggris</option>
                                    </select>
                                    @error('bahasa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                {{-- Harga --}}
                                <div class="col-md-2 mb-3">
                                    <label for="harga" class="form-label fw-bold">
                                        Harga <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" 
                                           name="harga" 
                                           id="harga" 
                                           class="form-control @error('harga') is-invalid @enderror"
                                           value="{{ old('harga', 0) }}"
                                           min="0"
                                           step="1000">
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                {{-- Stok --}}
                                <div class="col-md-2 mb-3">
                                    <label for="stok" class="form-label fw-bold">
                                        Stok <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" 
                                           name="stok" 
                                           id="stok" 
                                           class="form-control @error('stok') is-invalid @enderror"
                                           value="{{ old('stok', 0) }}"
                                           min="0">
                                    @error('stok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            {{-- Deskripsi --}}
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                <textarea name="deskripsi" 
                                          id="deskripsi" 
                                          rows="4" 
                                          class="form-control @error('deskripsi') is-invalid @enderror"
                                          placeholder="Deskripsi singkat tentang buku (opsional)">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <hr class="my-4">
                            
                            {{-- Buttons --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('buku.index') }}" class="btn btn-secondary fw-semibold">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary fw-semibold shadow-sm">
                                    <i class="bi bi-save"></i> Simpan Buku
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pemindahan script agar berjalan aman di dalam x-app-layout --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hargaInput = document.getElementById('harga');
            if(hargaInput) {
                hargaInput.addEventListener('blur', function() {
                    let value = this.value.replace(/\D/g, '');
                    this.value = value;
                });
            }
        });
    </script>
</x-app-layout>