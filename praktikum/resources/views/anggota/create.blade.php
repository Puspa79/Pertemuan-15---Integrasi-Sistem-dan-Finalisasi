<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Anggota') }}
        </h2>
    </x-slot>

    {{-- CSS Khusus Halaman Ini (Dipindahkan dari @push('styles')) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Mengatasi bug tinggi elemen akibat altInput Flatpickr di dalam grid Bootstrap */
        .flatpickr-wrapper {
            display: block !important;
            width: 100% !important;
        }
        
        /* Tambahan estetika agar border serasi dengan komponen buku kemarin */
        .card {
            border: 1.5px solid #007bff !important; /* Diubah ke warna primary agar serasi dengan header */
            border-radius: 0.5rem;
            overflow: hidden;
        }
    </style>

    {{-- Pembungkus Container Bootstrap agar Tampilan Rapi di dalam Breeze --}}
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm bg-white">
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="mb-0 h5">
                            <i class="bi bi-person-plus-fill me-2"></i>Tambah Anggota Baru
                        </h4>
                    </div>
                    <div class="card-body p-4 bg-white">
                        <form action="{{ route('anggota.store') }}" method="POST" class="form-loading">
                            @csrf
                            
                            {{-- Baris 1: Kode Anggota & Nama Lengkap --}}
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="kode_anggota" class="form-label fw-semibold">Kode Anggota <span class="text-danger">*</span></label>
                                    <input type="text" 
                                        name="kode_anggota" 
                                        id="kode_anggota"
                                        class="form-control bg-light" 
                                        value="{{ old('kode_anggota', $kodeAnggota ?? '') }}" 
                                        readonly>
                                    <small class="text-muted">Format otomatis: AGT-[TAHUN]-[NOMOR_URUT]</small>
                                </div>
                                
                                <div class="col-md-8 mb-3">
                                    <label for="nama" class="form-label fw-semibold">
                                        Nama Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="nama" 
                                           id="nama" 
                                           class="form-control @error('nama') is-invalid @enderror"
                                           value="{{ old('nama') }}"
                                           placeholder="Nama lengkap anggota">
                                    @error('nama')
                                        <div class="invalid-feedback mt-1 fw-semibold">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            {{-- Baris 2: Email & Nomor Telepon --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-semibold">
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="email" 
                                           id="email" 
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}"
                                           placeholder="email@example.com">
                                    @error('email')
                                        <div class="invalid-feedback mt-1 fw-semibold">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="telepon" class="form-label fw-semibold">
                                        Nomor Telepon <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="telepon" 
                                           id="telepon" 
                                           class="form-control @error('telepon') is-invalid @enderror"
                                           value="{{ old('telepon') }}"
                                           placeholder="081234567890">
                                    @error('telepon')
                                        <div class="invalid-feedback mt-1 fw-semibold">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted d-block mt-1">Format: 08xxxxxxxxxx atau +628xxxxxxxxxx</small>
                                </div>
                            </div>
                            
                            {{-- Baris 3: Alamat Lengkap --}}
                            <div class="mb-3">
                                <label for="alamat" class="form-label fw-semibold">
                                    Alamat Lengkap <span class="text-danger">*</span>
                                </label>
                                <textarea name="alamat" 
                                          id="alamat" 
                                          rows="3" 
                                          class="form-control @error('alamat') is-invalid @enderror"
                                          placeholder="Alamat lengkap dengan kota dan kode pos">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback mt-1 fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            {{-- Baris 4: Tanggal Lahir, Jenis Kelamin, Pekerjaan --}}
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="tanggal_lahir" class="form-label fw-semibold">
                                        Tanggal Lahir <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="tanggal_lahir" 
                                           id="tanggal_lahir" 
                                           class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                           value="{{ old('tanggal_lahir') }}"
                                           placeholder="Pilih Tanggal">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback mt-1 fw-semibold">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="jenis_kelamin" class="form-label fw-semibold">
                                        Jenis Kelamin <span class="text-danger">*</span>
                                    </label>
                                    <select name="jenis_kelamin" 
                                            id="jenis_kelamin" 
                                            class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback mt-1 fw-semibold">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="pekerjaan" class="form-label fw-semibold">Pekerjaan</label>
                                    <input type="text" 
                                           name="pekerjaan" 
                                           id="pekerjaan" 
                                           class="form-control @error('pekerjaan') is-invalid @enderror"
                                           value="{{ old('pekerjaan') }}"
                                           placeholder="Contoh: Mahasiswa, Pegawai, dll">
                                    @error('pekerjaan')
                                        <div class="invalid-feedback mt-1 fw-semibold">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            {{-- Baris 5: Tanggal Daftar & Status --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_daftar" class="form-label fw-semibold">
                                        Tanggal Pendaftaran <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="tanggal_daftar" 
                                           id="tanggal_daftar" 
                                           class="form-control @error('tanggal_daftar') is-invalid @enderror"
                                           value="{{ old('tanggal_daftar', date('Y-m-d')) }}"
                                           placeholder="Pilih Tanggal">
                                    @error('tanggal_daftar')
                                        <div class="invalid-feedback mt-1 fw-semibold">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label fw-semibold">
                                        Status <span class="text-danger">*</span>
                                    </label>
                                    <select name="status" 
                                            id="status" 
                                            class="form-select @error('status') is-invalid @enderror">
                                        <option value="Aktif" {{ old('status', 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback mt-1 fw-semibold">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <hr class="text-mutedmy-4">
                            
                            {{-- Tombol Aksi --}}
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('anggota.index') }}" class="btn btn-secondary fw-semibold shadow-sm">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary fw-semibold shadow-sm">
                                    <i class="bi bi-check-circle me-1"></i>Simpan Anggota
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript Khusus Halaman Ini (Dipindahkan dari @push('scripts')) --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script>
        // Inisialisasi Flatpickr dengan perbaikan pembungkus agar responsif lebar grid 100%
        flatpickr("#tanggal_lahir", {
            dateFormat: "Y-m-d",
            maxDate: "today",
            locale: "id",
            altInput: true,
            altFormat: "d F Y",
            wrap: false /* Diubah ke false agar tidak merusak wrapper container Bootstrap */
        });
        
        flatpickr("#tanggal_daftar", {
            dateFormat: "Y-m-d",
            maxDate: "today",
            locale: "id",
            altInput: true,
            altFormat: "d F Y",
            defaultDate: "{{ old('tanggal_daftar', date('Y-m-d')) }}",
            wrap: false
        });
        
        // Auto format nomor telepon
        document.getElementById('telepon').addEventListener('input', function() {
            let value = this.value.replace(/[^\d+]/g, '');
            this.value = value;
        });
    </script>
</x-app-layout>