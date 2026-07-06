@extends('layouts.app')
@section('title', 'Pencarian Kategori: ' . $keyword)

@section('content')
<div class="mb-5">
    <h2 class="fw-bold text-dark mb-1">Hasil Pencarian</h2>
    <p class="text-muted">Menampilkan hasil untuk kata kunci: <span class="badge bg-warning text-dark fs-6 px-3 py-1.5">"{{ $keyword }}"</span></p>
</div>

@if(count($kategori_list) > 0)
<div class="row">
    @foreach ($kategori_list as $kat)
    <div class="col-md-4 mb-4">
        <div class="card card-hover h-100 p-4 d-flex flex-column justify-content-between">
            <div>
                <h4 class="fw-bold text-dark mb-2">
                    {!! str_ireplace($keyword, "<mark class='bg-warning rounded px-1'>$keyword</mark>", $kat['nama']) !!}
                </h4>
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
@else
<div class="card p-5 text-center shadow-sm">
    <div class="text-muted mb-3" style="font-size: 48px;">🔍</div>
    <h4 class="fw-bold text-dark">Kategori Tidak Ditemukan</h4>
    <p class="text-muted">Kata kunci "{{ $keyword }}" tidak cocok dengan kategori apa pun.</p>
    <div class="d-inline-block mt-2">
        <a href="{{ route('kategori.index') }}" class="btn btn-primary px-4 py-2">Ulangi Pencarian</a>
    </div>
</div>
@endif
@endsection