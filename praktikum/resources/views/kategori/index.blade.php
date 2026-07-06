@extends('layouts.app')
@section('title', 'Kategori Buku')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col-md-6">
        <h2 class="fw-bold text-dark mb-1">Kategori Buku</h2>
        <p class="text-muted mb-0">Eksplorasi koleksi perpustakaan berdasarkan kategori literatur.</p>
    </div>
    <div class="col-md-6 mt-3 mt-md-0">
        <div class="input-group shadow-sm rounded-3 overflow-hidden" style="border-radius: 12px;">
            <input type="text" id="keyword" class="form-content form-control border-0 px-3 py-2.5" placeholder="Cari nama kategori...">
            <button onclick="cariKategori()" class="btn btn-primary px-4">Cari</button>
        </div>
    </div>
</div>

<div class="row">
    @foreach ($kategori_list as $kat)
    <div class="col-md-4 mb-4">
        <div class="card card-hover h-100 p-4 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-3 fw-bold">
                        {{ $kat['jumlah_buku'] }} Buku
                    </span>
                </div>
                <h4 class="fw-bold text-dark mb-2">{{ $kat['nama'] }}</h4>
                <p class="text-muted small mb-4">{{ $kat['deskripsi'] }}</p>
            </div>
            <div class="d-grid">
                <a href="{{ route('kategori.show', $kat['id']) }}" class="btn btn-outline-primary btn-sm py-2">
                    Buka Koleksi Buku ➔
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
    function cariKategori() {
        let key = document.getElementById('keyword').value;
        if(key.trim() !== "") {
            window.location.href = "/kategori/search/" + key;
        }
    }
</script>
@endsection