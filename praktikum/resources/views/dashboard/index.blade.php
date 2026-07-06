@extends('layouts.app')

@section('title', 'Dashboard - PerpusCore')

@section('content')
<div class="container">
    
    <div class="row g-4 mb-5">
        <div class="col-12 col-md-4">
            <div class="card p-4 h-100 bg-white border-start border-primary border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Total Buku</h6>
                        <h2 class="fw-bold mb-0 text-dark">{{ $totalBuku }}</h2>
                    </div>
                    <span class="fs-1 text-primary opacity-50">📚</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card p-4 h-100 bg-white border-start border-success border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Buku Tersedia</h6>
                        <h2 class="fw-bold mb-0 text-success">{{ $bukuTersedia }}</h2>
                    </div>
                    <span class="fs-1 text-success opacity-50">✅</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card p-4 h-100 bg-white border-start border-danger border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Buku Habis</h6>
                        <h2 class="fw-bold mb-0 text-danger">{{ $bukuHabis }}</h2>
                    </div>
                    <span class="fs-1 text-danger opacity-50">❌</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card p-4 h-100 bg-white border-start border-info border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Total Anggota</h6>
                        <h2 class="fw-bold mb-0 text-info">{{ $totalAnggota }}</h2>
                    </div>
                    <span class="fs-1 text-info opacity-50">👥</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card p-4 h-100 bg-white border-start border-primary border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Anggota Aktif</h6>
                        <h2 class="fw-bold mb-0 text-primary">{{ $anggotaAktif }}</h2>
                    </div>
                    <span class="fs-1 text-primary opacity-50">👤</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card p-4 h-100 bg-white border-start border-secondary border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Anggota Nonaktif</h6>
                        <h2 class="fw-bold mb-0 text-secondary">{{ $anggotaNonaktif }}</h2>
                    </div>
                    <span class="fs-1 text-secondary opacity-50">🚫</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5 bg-white p-3 rounded-4 shadow-sm d-flex gap-3 align-items-center">
        <span class="fw-bold text-secondary small text-uppercase ms-2 me-2">Quick Links:</span>
        <a href="{{ route('buku.index') }}" class="btn btn-outline-primary btn-sm px-3">Kelola Buku</a>
        <a href="/anggota" class="btn btn-outline-info btn-sm px-3">Kelola Anggota</a>
    </div>

    <div class="row g-4">
        
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm overflow-hidden h-100">
                <div class="card-header bg-light py-3 px-4 d-flex justify-content-between align-items-center border-bottom-0">
                    <h6 class="mb-0 fw-bold text-dark"><span class="me-2">✨</span>5 Buku Terbaru</h6>
                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3">Buku</span>
                </div>
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        @forelse($bukuTerbaru as $buku)
                            <x-buku-card :buku="$buku" />
                        @empty
                            <div class="p-4 text-center text-muted small">Belum ada data buku baru.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card shadow-sm overflow-hidden h-100">
                <div class="card-header bg-light py-3 px-4 d-flex justify-content-between align-items-center border-bottom-0">
                    <h6 class="mb-0 fw-bold text-dark"><span class="me-2">👥</span>5 Anggota Terbaru</h6>
                    <span class="badge bg-info-subtle text-info rounded-pill px-3">Anggota</span>
                </div>
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        @forelse($anggotaTerbaru as $anggota)
                            <div class="d-flex align-items-center justify-content-between py-3 px-4 border-bottom card-hover bg-white" style="transition: background-color 0.15s ease;">
                                <div class="d-flex align-items-center">
                                    <span class="fs-3 bg-light p-2 rounded-3 me-3">👤</span>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $anggota->nama }}</h6>
                                        <small class="text-muted">ID Anggota: {{ $anggota->id }}</small>
                                    </div>
                                </div>
                                <span class="badge bg-light text-secondary border rounded px-2.5 py-1" style="font-size: 0.75rem;">
                                    {{ $anggota->created_at->diffForHumans() }}
                                </span>
                            </div>
                        @empty
                            <div class="p-4 text-center text-muted small">Belum ada data anggota baru.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection