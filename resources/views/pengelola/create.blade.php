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
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('pengelola.ukm-ormawa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Card Identitas Organisasi --}}
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

                {{-- Card Visi & Misi --}}
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

                {{-- Card Branding --}}
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

                {{-- Card Kontak & Lokasi (UPDATED) --}}
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="mb-0 fw-bold text-dark border-start border-4 border-primary ps-3">Kontak & Lokasi</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            {{-- Kontak --}}
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

                            {{-- Wilayah API --}}
                            <div class="col-12 mt-4 mb-2">
                                <h6 class="fw-bold text-secondary border-bottom pb-2">Alamat Lengkap</h6>
                            </div>

                            {{-- INPUT HIDDEN UNTUK MENYIMPAN NAMA WILAYAH --}}
                            <input type="hidden" name="nama_provinsi" id="input_nama_provinsi">
                            <input type="hidden" name="nama_kabkota" id="input_nama_kabkota">
                            <input type="hidden" name="nama_kecamatan" id="input_nama_kecamatan">
                            <input type="hidden" name="nama_keldesa" id="input_nama_keldesa">

                            <div class="col-md-6">
                                <label for="id_provinsi" class="form-label fw-semibold">Provinsi</label>
                                {{-- Ubah name menjadi id_provinsi sesuai database --}}
                                <select class="form-select @error('id_provinsi') is-invalid @enderror" id="id_provinsi" name="id_provinsi" required>
                                    <option value="" selected disabled>Pilih Provinsi...</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="id_kabkota" class="form-label fw-semibold">Kabupaten/Kota</label>
                                {{-- Ubah name menjadi id_kabkota --}}
                                <select class="form-select @error('id_kabkota') is-invalid @enderror" id="id_kabkota" name="id_kabkota" required disabled>
                                    <option value="" selected disabled>Pilih Kabupaten/Kota...</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="id_kecamatan" class="form-label fw-semibold">Kecamatan</label>
                                {{-- Ubah name menjadi id_kecamatan --}}
                                <select class="form-select @error('id_kecamatan') is-invalid @enderror" id="id_kecamatan" name="id_kecamatan" required disabled>
                                    <option value="" selected disabled>Pilih Kecamatan...</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="id_keldesa" class="form-label fw-semibold">Kelurahan/Desa</label>
                                {{-- Ubah name menjadi id_keldesa --}}
                                <select class="form-select @error('id_keldesa') is-invalid @enderror" id="id_keldesa" name="id_keldesa" required disabled>
                                    <option value="" selected disabled>Pilih Kelurahan/Desa...</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="alamat_jalan" class="form-label fw-semibold">Detail Jalan/Gedung <span class="text-muted fw-normal">(Opsional)</span></label>
                                <textarea class="form-control @error('alamat_jalan') is-invalid @enderror" 
                                        id="alamat_jalan" name="alamat_jalan" rows="2" 
                                        placeholder="Contoh: Gedung Student Center Lt. 2, Jalan Telekomunikasi No. 1...">{{ old('alamat_jalan') }}</textarea>
                                @error('alamat_jalan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 pb-5">
                    <hr class="text-muted opacity-25 mb-4">
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="reset" class="btn btn-outline-secondary px-4 fw-semibold rounded-pill">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Form
                        </button>
                        <button type="submit" class="btn btn-primary px-5 fw-bold shadow-lg rounded-pill">
                            <i class="bi bi-check-lg me-2"></i> Simpan & Daftarkan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Script untuk Wilayah API --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sesuaikan ID selector dengan HTML di atas
        const provinceSelect = document.getElementById('id_provinsi');
        const regencySelect = document.getElementById('id_kabkota');
        const districtSelect = document.getElementById('id_kecamatan');
        const villageSelect = document.getElementById('id_keldesa');

        // Selector untuk Hidden Input Nama
        const provinceNameInput = document.getElementById('input_nama_provinsi');
        const regencyNameInput = document.getElementById('input_nama_kabkota');
        const districtNameInput = document.getElementById('input_nama_kecamatan');
        const villageNameInput = document.getElementById('input_nama_keldesa');

        // Fungsi Helper untuk Fetch
        async function fetchData(url, targetSelect, placeholder) {
            targetSelect.innerHTML = `<option value="" disabled selected>Loading...</option>`;
            try {
                const response = await fetch(url);
                const data = await response.json();
                
                targetSelect.innerHTML = `<option value="" disabled selected>${placeholder}</option>`;
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.name;
                    // Simpan nama di attribute data-name agar mudah diambil
                    option.setAttribute('data-name', item.name);
                    targetSelect.appendChild(option);
                });
                targetSelect.disabled = false;
            } catch (error) {
                console.error('Error fetching data:', error);
                targetSelect.innerHTML = `<option value="" disabled selected>Gagal memuat data</option>`;
            }
        }

        // Fungsi untuk update hidden input nama saat dropdown berubah
        function updateNameInput(selectElement, hiddenInput) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            if (selectedOption && selectedOption.getAttribute('data-name')) {
                hiddenInput.value = selectedOption.getAttribute('data-name');
            } else {
                hiddenInput.value = '';
            }
        }

        // 1. Load Provinces
        fetchData('/api/provinces', provinceSelect, 'Pilih Provinsi...');

        // Event Listener Provinsi
        provinceSelect.addEventListener('change', function() {
            updateNameInput(this, provinceNameInput); // Simpan Nama Provinsi
            
            const provinceId = this.value;
            regencySelect.disabled = true; districtSelect.disabled = true; villageSelect.disabled = true;
            regencySelect.innerHTML = '<option value="" disabled selected>Pilih Kabupaten/Kota...</option>';
            
            if (provinceId) fetchData(`/api/regencies/${provinceId}`, regencySelect, 'Pilih Kabupaten/Kota...');
        });

        // Event Listener Kota/Kab
        regencySelect.addEventListener('change', function() {
            updateNameInput(this, regencyNameInput); // Simpan Nama Kota
            
            const regencyId = this.value;
            districtSelect.disabled = true; villageSelect.disabled = true;
            districtSelect.innerHTML = '<option value="" disabled selected>Pilih Kecamatan...</option>';
            
            if (regencyId) fetchData(`/api/districts/${regencyId}`, districtSelect, 'Pilih Kecamatan...');
        });

        // Event Listener Kecamatan
        districtSelect.addEventListener('change', function() {
            updateNameInput(this, districtNameInput); // Simpan Nama Kecamatan
            
            const districtId = this.value;
            villageSelect.disabled = true;
            villageSelect.innerHTML = '<option value="" disabled selected>Pilih Kelurahan/Desa...</option>';
            
            if (districtId) fetchData(`/api/villages/${districtId}`, villageSelect, 'Pilih Kelurahan/Desa...');
        });

        // Event Listener Kelurahan
        villageSelect.addEventListener('change', function() {
            updateNameInput(this, villageNameInput); // Simpan Nama Desa
        });
    });
</script>
@endsection