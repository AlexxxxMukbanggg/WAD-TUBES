@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-warning mb-1">
                        <i class="bi bi-pencil-square me-2"></i>Edit UKM/Ormawa
                    </h2>
                    <p class="text-muted mb-0">Perbarui data organisasi Anda di sini.</p>
                </div>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('pengelola.ukm-ormawa.update', $ukmOrmawa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- PENTING: Method PUT untuk update data --}}
                
                {{-- Card Identitas Organisasi --}}
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="mb-0 fw-bold text-dark border-start border-4 border-warning ps-3">Identitas Organisasi</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-12">
                                <label for="nama" class="form-label fw-semibold">Nama UKM / Ormawa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg @error('nama') is-invalid @enderror" 
                                       id="nama" name="nama" value="{{ old('nama', $ukmOrmawa->nama) }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tipe" class="form-label fw-semibold">Tipe Organisasi <span class="text-danger">*</span></label>
                                <select class="form-select @error('tipe') is-invalid @enderror" id="tipe" name="tipe" required>
                                    <option value="UKM" {{ old('tipe', $ukmOrmawa->tipe) == 'UKM' ? 'selected' : '' }}>UKM (Unit Kegiatan Mahasiswa)</option>
                                    <option value="Ormawa" {{ old('tipe', $ukmOrmawa->tipe) == 'Ormawa' ? 'selected' : '' }}>Ormawa (Organisasi Mahasiswa)</option>
                                </select>
                                @error('tipe')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="kategori" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                    @foreach(['Kesenian & Budaya', 'Olahraga', 'Penalaran', 'Kerohanian', 'Sosial'] as $kat)
                                        <option value="{{ $kat }}" {{ old('kategori', $ukmOrmawa->kategori) == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="deskripsi" class="form-label fw-semibold">Deskripsi Singkat <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $ukmOrmawa->deskripsi) }}</textarea>
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
                        <h5 class="mb-0 fw-bold text-dark border-start border-4 border-warning ps-3">Visi & Misi</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label for="visi" class="form-label fw-semibold">Visi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('visi') is-invalid @enderror" 
                                      id="visi" name="visi" rows="2" required>{{ old('visi', $ukmOrmawa->visi) }}</textarea>
                            @error('visi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="misi" class="form-label fw-semibold">Misi <span class="text-danger">*</span></label>
                            <div class="alert alert-light border small text-muted mb-2">
                                <i class="bi bi-info-circle me-1"></i> Pisahkan setiap poin misi dengan menekan tombol <strong>Enter</strong>.
                            </div>
                            {{-- Menggabungkan array misi kembali menjadi string dengan enter --}}
                            @php
                                $misiString = is_array($ukmOrmawa->misi) ? implode("\n", $ukmOrmawa->misi) : $ukmOrmawa->misi;
                            @endphp
                            <textarea class="form-control @error('misi') is-invalid @enderror" 
                                      id="misi" name="misi" rows="5" required>{{ old('misi', $misiString) }}</textarea>
                            @error('misi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Card Branding --}}
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="mb-0 fw-bold text-dark border-start border-4 border-warning ps-3">Branding & Aset Visual</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="logo_url" class="form-label fw-semibold">Logo Organisasi</label>
                                <div class="d-flex align-items-center mb-3">
                                    @if($ukmOrmawa->logo_url)
                                        <img src="{{ Storage::url($ukmOrmawa->logo_url) }}" alt="Logo Lama" class="rounded me-3 border" width="80" height="80" style="object-fit: cover;">
                                        <div class="small text-muted fst-italic">Logo saat ini</div>
                                    @endif
                                </div>
                                <input type="file" class="form-control @error('logo_url') is-invalid @enderror" 
                                       id="logo_url" name="logo_url" accept="image/*">
                                <div class="form-text small">Biarkan kosong jika tidak ingin mengubah logo.</div>
                                @error('logo_url')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="banner_url" class="form-label fw-semibold">Banner Sampul</label>
                                <div class="mb-3">
                                    @if($ukmOrmawa->banner_url)
                                        <img src="{{ Storage::url($ukmOrmawa->banner_url) }}" alt="Banner Lama" class="rounded border w-100" height="100" style="object-fit: cover;">
                                    @endif
                                </div>
                                <input type="file" class="form-control @error('banner_url') is-invalid @enderror" 
                                       id="banner_url" name="banner_url" accept="image/*">
                                <div class="form-text small">Biarkan kosong jika tidak ingin mengubah banner.</div>
                                @error('banner_url')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card Kontak & Lokasi --}}
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="mb-0 fw-bold text-dark border-start border-4 border-warning ps-3">Kontak & Lokasi</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="kontak_email" class="form-label fw-semibold">Email Resmi <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control @error('kontak_email') is-invalid @enderror" 
                                           id="kontak_email" name="kontak_email" value="{{ old('kontak_email', $ukmOrmawa->kontak_email) }}" required>
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
                                           id="kontak_instagram" name="kontak_instagram" value="{{ old('kontak_instagram', $ukmOrmawa->kontak_instagram) }}" required>
                                </div>
                                @error('kontak_instagram')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Wilayah API --}}
                            <div class="col-12 mt-4 mb-2">
                                <h6 class="fw-bold text-secondary border-bottom pb-2">Alamat Lengkap</h6>
                            </div>

                            {{-- Input Hidden untuk menyimpan ID wilayah lama agar JS bisa memuatnya --}}
                            <input type="hidden" id="old_province_id" value="{{ old('province_id', $ukmOrmawa->id_provinsi) }}">
                            <input type="hidden" id="old_regency_id" value="{{ old('regency_id', $ukmOrmawa->id_kabkota) }}">
                            <input type="hidden" id="old_district_id" value="{{ old('district_id', $ukmOrmawa->id_kecamatan) }}">
                            <input type="hidden" id="old_village_id" value="{{ old('village_id', $ukmOrmawa->id_keldesa) }}">

                            <div class="col-md-6">
                                <label for="province_id" class="form-label fw-semibold">Provinsi</label>
                                <select class="form-select" id="province_id" name="province_id">
                                    <option value="" selected disabled>Loading...</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="regency_id" class="form-label fw-semibold">Kabupaten/Kota</label>
                                <select class="form-select" id="regency_id" name="regency_id" disabled>
                                    <option value="" selected disabled>Pilih Kabupaten/Kota...</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="district_id" class="form-label fw-semibold">Kecamatan</label>
                                <select class="form-select" id="district_id" name="district_id" disabled>
                                    <option value="" selected disabled>Pilih Kecamatan...</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="village_id" class="form-label fw-semibold">Kelurahan/Desa</label>
                                <select class="form-select" id="village_id" name="village_id" disabled>
                                    <option value="" selected disabled>Pilih Kelurahan/Desa...</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="alamat_jalan" class="form-label fw-semibold">Detail Jalan/Gedung</label>
                                <textarea class="form-control @error('alamat_jalan') is-invalid @enderror" 
                                          id="alamat_jalan" name="alamat_jalan" rows="2">{{ old('alamat_jalan', $ukmOrmawa->alamat_jalan) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 pb-5">
                    <hr class="text-muted opacity-25 mb-4">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-warning text-white px-5 fw-bold shadow-lg rounded-pill">
                            <i class="bi bi-save me-2"></i> Update Data
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', async function() {
        const provinceSelect = document.getElementById('province_id');
        const regencySelect = document.getElementById('regency_id');
        const districtSelect = document.getElementById('district_id');
        const villageSelect = document.getElementById('village_id');

        const oldProv = document.getElementById('old_province_id').value;
        const oldReg = document.getElementById('old_regency_id').value;
        const oldDist = document.getElementById('old_district_id').value;
        const oldVill = document.getElementById('old_village_id').value;

        // Fungsi Helper Fetch
        async function fetchData(url, targetSelect, placeholder, selectedValue = null) {
            targetSelect.innerHTML = `<option value="" disabled selected>Loading...</option>`;
            try {
                const response = await fetch(url);
                const data = await response.json();
                
                targetSelect.innerHTML = `<option value="" disabled selected>${placeholder}</option>`;
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.name;
                    if (selectedValue && String(item.id) === String(selectedValue)) {
                        option.selected = true;
                    }
                    targetSelect.appendChild(option);
                });
                targetSelect.disabled = false;
            } catch (error) {
                console.error('Error fetching data:', error);
                targetSelect.innerHTML = `<option value="" disabled selected>Gagal memuat</option>`;
            }
        }

        // --- LOGIKA INIT DATA (EDIT MODE) ---
        
        // 1. Load Provinsi
        await fetchData('/api/provinces', provinceSelect, 'Pilih Provinsi...', oldProv);

        // 2. Jika ada Provinsi terpilih, Load Kab/Kota
        if (oldProv) {
            await fetchData(`/api/regencies/${oldProv}`, regencySelect, 'Pilih Kabupaten/Kota...', oldReg);
        }

        // 3. Jika ada Kab/Kota terpilih, Load Kecamatan
        if (oldReg) {
            await fetchData(`/api/districts/${oldReg}`, districtSelect, 'Pilih Kecamatan...', oldDist);
        }

        // 4. Jika ada Kecamatan terpilih, Load Kelurahan
        if (oldDist) {
            await fetchData(`/api/villages/${oldDist}`, villageSelect, 'Pilih Kelurahan/Desa...', oldVill);
        }


        // --- EVENT LISTENERS (Sama seperti create) ---

        provinceSelect.addEventListener('change', function() {
            const val = this.value;
            regencySelect.innerHTML = '<option value="" disabled selected>Loading...</option>';
            regencySelect.disabled = true;
            districtSelect.innerHTML = '<option value="" disabled selected>Pilih Kecamatan...</option>';
            districtSelect.disabled = true;
            villageSelect.innerHTML = '<option value="" disabled selected>Pilih Kelurahan/Desa...</option>';
            villageSelect.disabled = true;
            if(val) fetchData(`/api/regencies/${val}`, regencySelect, 'Pilih Kabupaten/Kota...');
        });

        regencySelect.addEventListener('change', function() {
            const val = this.value;
            districtSelect.innerHTML = '<option value="" disabled selected>Loading...</option>';
            districtSelect.disabled = true;
            villageSelect.innerHTML = '<option value="" disabled selected>Pilih Kelurahan/Desa...</option>';
            villageSelect.disabled = true;
            if(val) fetchData(`/api/districts/${val}`, districtSelect, 'Pilih Kecamatan...');
        });

        districtSelect.addEventListener('change', function() {
            const val = this.value;
            villageSelect.innerHTML = '<option value="" disabled selected>Loading...</option>';
            villageSelect.disabled = true;
            if(val) fetchData(`/api/villages/${val}`, villageSelect, 'Pilih Kelurahan/Desa...');
        });
    });
</script>
@endsection