@extends('layouts.app')
@section('title', 'Kategori - ' . $kategori['nama'])

@section('content')
<nav class="mb-4" aria-label="breadcrumb">
  <ol class="breadcrumb bg-white p-3 rounded-3 shadow-sm border">
    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}" class="text-decoration-none text-muted">Kategori</a></li>
    <li class="breadcrumb-item active text-dark fw-medium" aria-current="page">{{ $kategori['nama'] }}</li>
  </ol>
</nav>

<div class="card p-4 mb-4 bg-dark text-white border-0 position-relative overflow-hidden shadow">
    <div class="position-relative z-1">
        <span class="badge bg-info text-dark mb-2 px-3 py-2 fw-bold">Modul Kategori</span>
        <h2 class="fw-bold mb-2 text-info">{{ $kategori['nama'] }}</h2>
        <p class="lead text-light-50 mb-0 small" style="opacity: 0.8;">{{ $kategori['deskripsi'] }}</p>
    </div>
</div>

<h4 class="fw-bold text-dark mb-3">Buku yang Tersedia</h4>
<div class="card p-3">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
            <tr class="small text-muted text-uppercase">
                <th class="ps-3">No</th>
                <th>Judul Buku</th>
                <th>Nama Penerbit</th>
                <th class="text-end pe-3">Jumlah Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($buku_list as $index => $buku)
            <tr>
                <td class="ps-3 text-muted">{{ $index + 1 }}</td>
                <td><strong class="text-dark">{{ $buku['judul'] }}</strong></td>
                <td class="text-muted">{{ $buku['penerbit'] }}</td>
                <td class="text-end pe-3">
                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2">
                        {{ $buku['stok'] }} Unit
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<a href="{{ route('kategori.index') }}" class="btn btn-light border mt-4 px-4 text-muted">
    ← Kembali ke Kategori
</a>
@endsection