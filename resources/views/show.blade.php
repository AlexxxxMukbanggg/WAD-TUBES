@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('ukm-ormawa.index') }}" class="text-decoration-none">Daftar UKM</a></li>
                <li class="breadcrumb-item active text-muted" aria-current="page">{{ $item->nama }}</li>
            </ol>
        </nav>
        <a href="{{ route('ukm-ormawa.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden mb-4">
        <div class="position-relative" style="height: 300px; background-color: #eee;">
            @if($item->banner_url)
                <img src="{{ Storage::url($item->banner_url) }}" class="w-100 h-100 object-fit-cover" alt="Banner {{ $item->nama }}">
            @else
                <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                    <i class="bi bi-image me-2"></i> Tidak ada banner
                </div>
            @endif
            
            <div class="position-absolute bottom-0 start-0 w-100 h-50" 
                 style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);"></div>
        </div>

        <div class="card-body position-relative pt-0 px-4 pb-4">
            <div class="d-md-flex align-items-end">
                <div class="position-relative me-md-4 mb-3 mb-md-0" style="margin-top: -60px;">
                    <div class="bg-white rounded-circle p-1 shadow d-flex align-items-center justify-content-center" 
                         style="width: 120px; height: 120px;">
                        @if($item->logo_url)
                            <img src="{{ Storage::url($item->logo_url) }}" class="rounded-circle w-100 h-100 object-fit-cover" alt="Logo">
                        @else
                            <span class="fw-bold fs-2 text-primary">{{ substr($item->nama, 0, 2) }}</span>
                        @endif
                    </div>
                </div>

                <div class="flex-grow-1 pb-1 text-center text-md-start">
                    <h2 class="fw-bold text-dark mb-1">{{ $item->nama }}</h2>
                    <div class="mb-2">
                        <span class="badge {{ $item->tipe == 'UKM' ? 'bg-primary' : 'bg-warning text-dark' }} me-1">
                            {{ $item->tipe }}
                        </span>
                        <span class="badge bg-secondary">{{ $item->kategori }}</span>
                    </div>
                </div>

                @auth
                    @if(Auth::user()->manages_ukm_ormawa_id == $item->id)
                    <div class="mt-3 mt-md-0">
                        <a href="{{ route('pengurus.ukm-ormawa.edit') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-pencil-square me-1"></i> Edit Profil
                        </a>
                    </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-primary mb-3">
                        <i class="bi bi-card-text me-2"></i>Tentang Kami
                    </h5>
                    <p class="text-secondary" style="line-height: 1.8; text-align: justify;">
                        {!! nl2br(e($item->deskripsi)) !!}
                    </p>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-primary mb-3">
                        <i class="bi bi-bullseye me-2"></i>Visi & Misi
                    </h5>
                    
                    <div class="mb-4">
                        <h6 class="fw-bold text-dark">Visi</h6>
                        <p class="text-secondary fst-italic">"{{ $item->visi }}"</p>
                    </div>

                    <div>
                        <h6 class="fw-bold text-dark">Misi</h6>
                        @if(is_array($item->misi) && count($item->misi) > 0)
                            <ul class="list-group list-group-flush ps-0">
                                @foreach($item->misi as $misi)
                                    <li class="list-group-item border-0 px-0 py-1 d-flex">
                                        <i class="bi bi-check-circle-fill text-success me-2 mt-1 small"></i>
                                        <span class="text-secondary">{{ $misi }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @elseif(is_string($item->misi))
                            {{-- Fallback jika data masih string --}}
                            <p class="text-secondary">{!! nl2br(e($item->misi)) !!}</p>
                        @else
                            <p class="text-muted small">Data misi belum diisi.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-3">Kontak & Media Sosial</h5>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center p-3 bg-light rounded hover-bg-white border transition-all">
                            <i class="bi bi-instagram fs-3 text-danger me-3"></i>
                            <div class="overflow-hidden">
                                <small class="text-muted d-block">Instagram</small>
                                <a href="https://instagram.com/{{ str_replace('@', '', $item->kontak_instagram) }}" 
                                   target="_blank" class="fw-bold text-dark text-decoration-none text-truncate d-block">
                                    {{ $item->kontak_instagram }}
                                </a>
                            </div>
                        </div>

                        <div class="d-flex align-items-center p-3 bg-light rounded hover-bg-white border transition-all">
                            <i class="bi bi-envelope fs-3 text-primary me-3"></i>
                            <div class="overflow-hidden">
                                <small class="text-muted d-block">Email Resmi</small>
                                <a href="mailto:{{ $item->kontak_email }}" 
                                   class="fw-bold text-dark text-decoration-none text-truncate d-block">
                                    {{ $item->kontak_email }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-3">Sekretariat</h5>
                    <div class="d-flex">
                        <i class="bi bi-geo-alt-fill text-danger me-3 mt-1"></i>
                        <div>
                            @if($item->alamat_jalan)
                                <p class="mb-1 text-secondary">{{ $item->alamat_jalan }}</p>
                                <small class="text-muted">
                                    {{ $item->nama_keldesa ? $item->nama_keldesa . ', ' : '' }}
                                    {{ $item->nama_kecamatan ? $item->nama_kecamatan . ', ' : '' }}
                                    {{ $item->nama_kabkota ? $item->nama_kabkota : '' }}
                                </small>
                            @else
                                <p class="text-muted fst-italic">Alamat belum diisi.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .object-fit-cover { object-fit: cover; }
    .transition-all { transition: all 0.3s ease; }
    .hover-bg-white:hover { background-color: #fff !important; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
</style>
@endsection