@extends('layouts.app')

@section('content')
<div class="container pb-5">
    {{-- Breadcrumb Navigasi --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $item->nama }}</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            {{-- Header: Banner & Logo --}}
            <div class="card shadow-sm border-0 overflow-hidden mb-4">
                {{-- Banner Image --}}
                <div class="bg-light position-relative" style="height: 250px;">
                    @if($item->banner_url)
                        <img src="{{ Storage::url($item->banner_url) }}" alt="Banner {{ $item->nama }}" class="w-100 h-100 object-fit-cover">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted bg-secondary bg-opacity-10">
                            <i class="bi bi-image fs-1"></i>
                        </div>
                    @endif
                </div>

                <div class="card-body position-relative px-4 pb-4">
                    <div class="d-md-flex align-items-end">
                        {{-- Logo (Posisi overlapping banner) --}}
                        <div class="position-relative" style="margin-top: -80px; margin-bottom: 1rem;">
                            @if($item->logo_url)
                                <img src="{{ Storage::url($item->logo_url) }}" alt="Logo {{ $item->nama }}" 
                                     class="rounded-circle border border-4 border-white shadow-sm bg-white" 
                                     width="150" height="150" style="object-fit: cover;">
                            @else
                                <div class="rounded-circle border border-4 border-white shadow-sm bg-white d-flex align-items-center justify-content-center text-primary fw-bold fs-2" 
                                     style="width: 150px; height: 150px;">
                                    {{ substr($item->nama, 0, 2) }}
                                </div>
                            @endif
                        </div>
                        
                        {{-- Judul & Kategori --}}
                        <div class="ms-md-4 mb-2 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <span class="badge bg-primary mb-2">{{ $item->tipe }}</span>
                                    <span class="badge bg-secondary mb-2">{{ $item->kategori }}</span>
                                    <h1 class="fw-bold mb-1">{{ $item->nama }}</h1>
                                    <p class="text-muted mb-0"><i class="bi bi-geo-alt-fill me-1"></i> {{ $item->nama_kabkota ?? 'Lokasi tidak spesifik' }}</p>
                                </div>
                                {{-- Tombol Edit (Hanya muncul jika user adalah pemilik) --}}
                                @if(Auth::check() && Auth::id() == $item->user_id)
                                    <a href="{{ route('pengelola.ukm-ormawa.edit', $item->id) }}" class="btn btn-outline-warning btn-sm fw-bold">
                                        <i class="bi bi-pencil-square me-1"></i> Edit Profil
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                {{-- Kolom Kiri: Informasi Utama --}}
                <div class="col-lg-8">
                    {{-- Deskripsi --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold border-start border-4 border-primary ps-3 mb-3">Tentang Kami</h5>
                            <p class="text-secondary" style="white-space: pre-line; line-height: 1.6;">{{ $item->deskripsi }}</p>
                        </div>
                    </div>

                    {{-- Visi & Misi --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold border-start border-4 border-primary ps-3 mb-3">Visi & Misi</h5>
                            
                            <div class="mb-4">
                                <h6 class="fw-bold text-dark">Visi</h6>
                                <p class="text-secondary fst-italic">"{{ $item->visi }}"</p>
                            </div>

                            <div>
                                <h6 class="fw-bold text-dark">Misi</h6>
                                @if(!empty($item->misi) && is_array($item->misi))
                                    <ul class="list-group list-group-flush list-group-numbered">
                                        @foreach($item->misi as $misi)
                                            <li class="list-group-item border-0 ps-0 text-secondary">{{ $misi }}</li>
                                        @endforeach
                                    </ul>
                                @elseif(!empty($item->misi) && is_string($item->misi))
                                    <p class="text-secondary" style="white-space: pre-line;">{{ $item->misi }}</p>
                                @else
                                    <p class="text-muted small">Belum ada data misi.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Sidebar Kontak & Detail --}}
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm sticky-top" style="top: 20px; z-index: 1;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Informasi Kontak</h5>

                            {{-- Email --}}
                            <div class="d-flex align-items-start mb-3">
                                <div class="bg-primary bg-opacity-10 p-2 rounded text-primary me-3">
                                    <i class="bi bi-envelope-fill fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block small text-muted fw-bold">EMAIL</span>
                                    <a href="mailto:{{ $item->kontak_email }}" class="text-decoration-none text-dark">{{ $item->kontak_email }}</a>
                                </div>
                            </div>

                            {{-- Instagram --}}
                            <div class="d-flex align-items-start mb-3">
                                <div class="bg-danger bg-opacity-10 p-2 rounded text-danger me-3">
                                    <i class="bi bi-instagram fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block small text-muted fw-bold">INSTAGRAM</span>
                                    <a href="https://instagram.com/{{ str_replace('@', '', $item->kontak_instagram) }}" target="_blank" class="text-decoration-none text-dark">
                                        {{ $item->kontak_instagram }}
                                    </a>
                                </div>
                            </div>

                            <hr class="my-4 border-secondary opacity-10">

                            {{-- Logic Alamat yang Diperbaiki --}}
                            <div class="d-flex align-items-start">
                                <div class="bg-success bg-opacity-10 p-2 rounded text-success me-3">
                                    <i class="bi bi-geo-alt-fill fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block small text-muted fw-bold mb-1">ALAMAT SEKRETARIAT</span>
                                    <p class="mb-0 text-secondary small" style="line-height: 1.5;">
                                        @php
                                            // Menggabungkan bagian alamat
                                            $alamatLengkap = collect([
                                                $item->alamat_jalan,
                                                $item->nama_keldesa ? 'Kel. ' . $item->nama_keldesa : null,
                                                $item->nama_kecamatan ? 'Kec. ' . $item->nama_kecamatan : null,
                                                $item->nama_kabkota,
                                                $item->nama_provinsi
                                            ])
                                            ->filter() // Hapus bagian yang kosong/null
                                            ->map(fn($text) => \Illuminate\Support\Str::title($text)) // Ubah setiap bagian jadi Title Case
                                            ->implode(', '); // Gabungkan dengan koma
                                        @endphp

                                        @if($alamatLengkap)
                                            {{ $alamatLengkap }}
                                        @else
                                            <span class="fst-italic text-muted">Lokasi belum diatur.</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection