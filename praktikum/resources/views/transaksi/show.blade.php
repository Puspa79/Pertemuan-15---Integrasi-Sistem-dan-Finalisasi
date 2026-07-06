<x-app-layout>
    <div class="container py-5">
        <div class="card border-0 shadow-sm rounded-3 col-md-8 mx-auto">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-file-earmark-text me-2"></i>Detail Peminjaman Buku</h5>
            </div>
            <div class="card-body p-4 bg-white">
                
                {{-- Tugas 3: Warning Reminder Terlambat --}}
                @if(strtolower($transaksi->status) == 'dipinjam' && now()->isAfter($transaksi->tanggal_kembali))
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                        <div>
                            <strong>Peringatan!</strong> Peminjaman ini telah terlambat selama 
                            <strong>{{ abs((int)now()->diffInDays($transaksi->tanggal_kembali)) }} hari</strong>.
                        </div>
                    </div>
                @endif

                <table class="table table-bordered">
                    <tr><th class="bg-light" style="width: 35%">Kode Transaksi</th><td><strong>{{ $transaksi->kode_transaksi }}</strong></td></tr>
                    <tr><th class="bg-light">Nama Anggota</th><td>{{ $transaksi->anggota->nama }}</td></tr>
                    <tr><th class="bg-light">Judul Buku</th><td>{{ $transaksi->buku->judul }}</td></tr>
                    <tr><th class="bg-light">Tanggal Pinjam</th><td>{{ \Carbon\Carbon::parse($transaksi->tanggal_pinjam)->format('d-m-Y') }}</td></tr>
                    <tr><th class="bg-light">Tenggat Kembali</th><td>{{ \Carbon\Carbon::parse($transaksi->tanggal_kembali)->format('d-m-Y') }}</td></tr>
                    <tr><th class="bg-light">Tanggal Dikembalikan</th><td>{{ $transaksi->tanggal_dikembalikan ? \Carbon\Carbon::parse($transaksi->tanggal_dikembaliikan)->format('d-m-Y') : '-' }}</td></tr>
                    <tr>
                        <th class="bg-light">Status</th>
                        <td>
                            <span class="badge {{ $transaksi->status == 'dipinjam' ? 'bg-warning' : 'bg-success' }}">
                                {{ ucfirst($transaksi->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Total Denda</th>
                        <td class="text-danger fw-bold">Rp {{ number_format($transaksi->denda ?? 0, 0, ',', '.') }}</td>
                    </tr>
                </table>

                <div class="d-flex gap-2.5 mt-4 height=12px">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary fw-semibold" style="height: 57.5px; line-height: 2.5;">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    
                    {{-- Tombol Kembalikan Buku --}}
                    @if($transaksi->status === 'Dipinjam')
                            <button type="button" class="btn btn-success" id="btn-kembalikan">
                                <i class="bi bi-arrow-return-left"></i> Kembalikan Buku
                            </button>
                        
                            <form id="form-kembalikan" action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('PUT')
                            </form>
                        @else
                            @if($transaksi->tanggal_dikembalikan <= $transaksi->tanggal_kembali)
                                <div class="alert alert-success">
                                    <i class="bi bi-check-circle"></i> Dikembalikan tepat waktu pada
                                    {{ $transaksi->tanggal_dikembalikan->format('d M Y') }}
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="bi bi-exclamation-triangle"></i> Terlambat dikembalikan!
                                    Denda: Rp {{ number_format($transaksi->denda, 0, ',', '.') }}
                                </div>
                            @endif
                        @endif
                        
                        @push('scripts')
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                        document.getElementById('btn-kembalikan')?.addEventListener('click', function() {
                            Swal.fire({
                                title: 'Konfirmasi Pengembalian',
                                text: 'Apakah Anda yakin ingin mengembalikan buku ini?',
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#198754',
                                confirmButtonText: 'Ya, Kembalikan!',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('form-kembalikan').submit();
                                }
                            });
                        });
                        </script>
                        @endpush
                </div>
            </div>
        </div>
    </div>
</x-app-layout>