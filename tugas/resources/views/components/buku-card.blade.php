<div class="p-3 border-bottom card-hover bg-white" style="transition: background-color 0.15s ease;">
    <div class="row align-items-center g-0">
        
        <div class="col-12 col-sm-6 d-flex align-items-center">
            <span class="fs-3 bg-light p-2 rounded-3 me-3 flex-shrink-0">📖</span>
            
            <div class="text-truncate">
                <h6 class="mb-0 fw-bold text-dark text-truncate">{{ $buku->judul }}</h6>
                <small class="text-muted d-block mt-0.5">Tahun: {{ $buku->tahun_terbit }}</small>
            </div>
        </div>

        <div class="col-12 col-sm-6 mt-2 mt-sm-0">
            <div class="row align-items-center g-0 justify-content-end text-sm-end text-start">
                
                <div class="col-auto px-2" style="width: 110px;">
                    <small class="text-muted d-none d-sm-block" style="font-size: 0.7rem; margin-bottom: -2px;">Harga</small>
                    <span class="fw-semibold text-secondary" style="font-size: 0.85rem;">
                        Rp{{ number_format($buku->harga, 0, ',', '.') }}
                    </span>
                </div>
                
                <div class="col-auto px-2" style="width: 70px;">
                    <small class="text-muted d-none d-sm-block" style="font-size: 0.7rem; margin-bottom: -2px;">Stok</small>
                    <span class="fw-semibold text-secondary" style="font-size: 0.85rem;">
                        {{ $buku->stok }}
                    </span>
                </div>
                
                <div class="col-auto ps-2" style="width: 100px;">
                    @if($buku->stok > 0)
                        <span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1.5 w-100 text-center" style="font-size: 0.725rem; display: block;">
                            Tersedia
                        </span>
                    @else
                        <span class="badge bg-danger-subtle text-danger rounded-pill px-2.5 py-1.5 w-100 text-center" style="font-size: 0.725rem; display: block;">
                            Habis
                        </span>
                    @endif
                </div>

            </div>
        </div>

    </div>
</div>