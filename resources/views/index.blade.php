@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary">Daftar Unit Kegiatan Mahasiswa (UKM) & Organisasi Kemahasiswaan</h2>
            <p class="text-muted">Temukan Unit Kegiatan Mahasiswa dan Organisasi Mahasiswa yang sesuai dengan minatmu.</p>
        </div>
        
        @auth
            @if(Auth::user()->role === 'pengelola') 
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('pengelola.ukm-ormawa.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-1"></i> Daftarkan UKM/Ormawa
                    </a>
                </div>
            @endif
        @endauth
    </div>

    <div class="card mb-5 border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ url()->current() }}" method="GET">
                <div class="row g-3">
                    <div class="col-lg-4 col-md-6">
                        <label for="search_name" class="form-label fw-semibold">Cari Nama</label>
                        <input type="text" class="form-control" id="search_name" name="search_name" 
                               value="{{ request('search_name') }}" placeholder="Cari UKM...">
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <label for="filter_type" class="form-label fw-semibold">Tipe</label>
                        <select class="form-select" id="filter_type" name="filter_type">
                            <option value="">Semua Tipe</option>
                            <option value="UKM" {{ request('filter_type') == 'UKM' ? 'selected' : '' }}>UKM</option>
                            <option value="Ormawa" {{ request('filter_type') == 'Ormawa' ? 'selected' : '' }}>Ormawa</option>
                        </select>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <label for="filter_category" class="form-label fw-semibold">Kategori</label>
                        <select class="form-select" id="filter_category" name="filter_category">
                            <option value="">Semua Kategori</option>
                            <option value="Kesenian & Budaya" {{ request('filter_category') == 'Kesenian & Budaya' ? 'selected' : '' }}>Kesenian & Budaya</option>
                            <option value="Olahraga" {{ request('filter_category') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                            <option value="Penalaran" {{ request('filter_category') == 'Penalaran' ? 'selected' : '' }}>Penalaran</option>
                            <option value="Kerohanian" {{ request('filter_category') == 'Kerohanian' ? 'selected' : '' }}>Kerohanian</option>
                            <option value="Sosial" {{ request('filter_category') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($ukmOrmawas as $ukm)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="position-relative overflow-hidden" style="height: 180px; background-color: #eee;">
                    @if($ukm->banner_url)
                        <img src="{{ Storage::url($ukm->banner_url) }}" class="w-100 h-100 object-fit-cover" alt="{{ $ukm->nama }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 text-muted">No Banner</div>
                    @endif
                    
                    <div class="position-absolute bottom-0 start-0 p-3">
                        <div class="bg-white rounded-circle p-1 shadow-sm d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            @if($ukm->logo_url)
                                <img src="{{ Storage::url($ukm->logo_url) }}" class="rounded-circle w-100 h-100" style="object-fit: cover;" alt="Logo">
                            @else
                                <span class="fw-bold text-primary small">{{ substr($ukm->nama, 0, 2) }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body pt-3">
                    <div class="mb-2">
                        <span class="badge {{ $ukm->tipe == 'UKM' ? 'bg-info' : 'bg-warning' }} text-dark">{{ $ukm->tipe }}</span>
                        <span class="badge bg-secondary">{{ $ukm->kategori }}</span>
                    </div>

                    <h5 class="card-title fw-bold">
                        <a href="{{ route('ukm-ormawa.show', $ukm->slug) }}" class="text-decoration-none text-dark stretched-link">
                            {{ $ukm->nama }}
                        </a>
                    </h5>
                    <p class="card-text text-muted small">
                        {{ Str::limit($ukm->deskripsi, 80) }}
                    </p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12" style="width: 100%;">
            <div class="d-flex flex-column justify-content-center align-items-center py-5 text-center" style="min-height: 60vh;">
                <div class="mb-3 text-secondary opacity-25">
                    <i class="bi bi-search" style="font-size: 5rem;"></i>
                </div>
                <h4 class="fw-bold text-secondary">Tidak ada data ditemukan</h4>
                <p class="text-muted mb-4" style="max-width: 500px;">
                    Kami tidak dapat menemukan UKM atau Ormawa yang cocok dengan kata kunci pencarian atau filter yang Anda pilih.
                </p>
                <a href="{{ route('ukm-ormawa.index') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                    <i class="bi bi-arrow-repeat me-2"></i> Reset Filter Pencarian
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $ukmOrmawas->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>

<style>
    .hover-card:hover { transform: translateY(-5px); transition: 0.3s; }
    .object-fit-cover { object-fit: cover; }
</style>
@endsection