@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-primary mb-1">
                        <i class="bi bi-pencil-square me-2"></i>Registrasi UKM/Ormawa
                    </h2>
                    <p class="text-muted mb-0">Lengkapi data di bawah ini untuk mendaftarkan organisasi baru.</p>
                </div>
                <a href="{{ route('ukm-ormawa.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('pengelola.ukm-ormawa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="mb-0 fw-bold text-dark border-start border-4 border-primary ps-3">Identitas Organisasi</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-12">
                                <label for="nama" class="form-label fw-semibold">Nama UKM / Ormawa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg @error('nama') is-invalid @enderror" 
                                       id="nama" name="nama" value="{{ old('nama') }}" 
                                       placeholder="Contoh: UKM Bola Basket, BEM Fakultas..." required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tipe" class="form-label fw-semibold">Tipe Organisasi <span class="text-danger">*</span></label>
                                <select class="form-select @error('tipe') is-invalid @enderror" id="tipe" name="tipe" required>
                                    <option value="" disabled selected>Pilih Tipe...</option>
                                    <option value="UKM" {{ old('tipe') == 'UKM' ? 'selected' : '' }}>UKM (Unit Kegiatan Mahasiswa)</option>
                                    <option value="Ormawa" {{ old('tipe') == 'Ormawa' ? 'selected' : '' }}>Ormawa (Organisasi Mahasiswa)</option>
                                </select>
                                @error('tipe')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="kategori" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                    <option value="" disabled selected>Pilih Kategori...</option>
                                    <option value="Kesenian & Budaya" {{ old('kategori') == 'Kesenian & Budaya' ? 'selected' : '' }}>Kesenian & Budaya</option>
                                    <option value="Olahraga" {{ old('kategori') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                                    <option value="Penalaran" {{ old('kategori') == 'Penalaran' ? 'selected' : '' }}>Penalaran</option>
                                    <option value="Kerohanian" {{ old('kategori') == 'Kerohanian' ? 'selected' : '' }}>Kerohanian</option>
                                    <option value="Sosial" {{ old('kategori') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                                </select>
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="deskripsi" class="form-label fw-semibold">Deskripsi Singkat <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" name="deskripsi" rows="4" 
                                          placeholder="Ceritakan profil singkat organisasi Anda di sini..." required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="mb-0 fw-bold text-dark border-start border-4 border-primary ps-3">Visi & Misi</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label for="visi" class="form-label fw-semibold">Visi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('visi') is-invalid @enderror" 
                                      id="visi" name="visi" rows="2" required>{{ old('visi') }}</textarea>
                            @error('visi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="misi" class="form-label fw-semibold">Misi <span class="text-danger">*</span></label>
                            <div class="alert alert-light border small text-muted mb-2">
                                <i class="bi bi-info-circle me-1"></i> Pisahkan setiap poin misi dengan menekan tombol <strong>Enter</strong> (Baris baru).
                            </div>
                            <textarea class="form-control @error('misi') is-invalid @enderror" 
                                      id="misi" name="misi" rows="5" 
                                      placeholder="- Misi poin pertama&#10;- Misi poin kedua" required>{{ old('misi') }}</textarea>
                            @error('misi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="mb-0 fw-bold text-dark border-start border-4 border-primary ps-3">Branding & Aset Visual</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="logo_url" class="form-label fw-semibold">Logo Organisasi <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" class="form-control @error('logo_url') is-invalid @enderror" 
                                           id="logo_url" name="logo_url" accept="image/*" required>
                                </div>
                                <div class="form-text small">Format: JPG, PNG, WEBP. Maks: 2MB. Rasio 1:1 disarankan.</div>
                                @error('logo_url')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="banner_url" class="form-label fw-semibold">Banner Sampul <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" class="form-control @error('banner_url') is-invalid @enderror" 
                                           id="banner_url" name="banner_url" accept="image/*" required>
                                </div>
                                <div class="form-text small">Format: JPG, PNG. Maks: 4MB. Gambar Landscape.</div>
                                @error('banner_url')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="mb-0 fw-bold text-dark border-start border-4 border-primary ps-3">Kontak & Lokasi</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="kontak_email" class="form-label fw-semibold">Email Resmi <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control @error('kontak_email') is-invalid @enderror" 
                                           id="kontak_email" name="kontak_email" value="{{ old('kontak_email') }}" 
                                           placeholder="ukm@telkomuniversity.ac.id" required>
                                </div>
                                @error('kontak_email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="kontak_instagram" class="form-label fw-semibold">Instagram <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted">@</span>
                                    <input type="text" class="form-control @error('kontak_instagram') is-invalid @enderror" 
                                           id="kontak_instagram" name="kontak_instagram" value="{{ old('kontak_instagram') }}" 
                                           placeholder="username_ukm" required>
                                </div>
                                @error('kontak_instagram')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="alamat_jalan" class="form-label fw-semibold">Alamat Sekretariat <span class="text-muted fw-normal">(Opsional)</span></label>
                                <textarea class="form-control @error('alamat_jalan') is-invalid @enderror" 
                                          id="alamat_jalan" name="alamat_jalan" rows="2" 
                                          placeholder="Contoh: Gedung Student Center Lt. 2...">{{ old('alamat_jalan') }}</textarea>
                                @error('alamat_jalan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 bg-transparent mb-5">
                    <div class="card-body p-0 d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-light border px-4">Reset Form</button>
                        <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                            <i class="bi bi-save me-2"></i> Simpan Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection