@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 text-center pt-4 pb-0">
                    <h4 class="fw-bold text-primary">Buat Akun Baru</h4>
                    <p class="text-muted small">Bergabunglah dengan Student Center Telkom University</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold small text-secondary">NAMA LENGKAP</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama sesuai KTM">
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nim" class="form-label fw-semibold small text-secondary">NIM</label>
                            <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror" 
                                   name="nim" value="{{ old('nim') }}" required placeholder="Nomor Induk Mahasiswa">
                            @error('nim')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold small text-secondary">EMAIL INSTITUSI</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nama@student.telkomuniversity.ac.id">
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold small text-secondary">PASSWORD</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="new-password" placeholder="Min. 8 karakter">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye-slash" id="iconPassword"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label fw-semibold small text-secondary">KONFIRMASI PASSWORD</label>
                            <div class="input-group">
                                <input id="password-confirm" type="password" class="form-control" 
                                       name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password">
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirm">
                                    <i class="bi bi-eye-slash" id="iconConfirm"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary fw-bold py-2 rounded-pill">
                                DAFTAR SEKARANG
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="text-muted small mb-0">Sudah memiliki akun?</p>
                            <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Masuk di sini</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi reusable untuk toggle password
    function setupToggle(buttonId, inputId, iconId) {
        const button = document.querySelector(buttonId);
        const input = document.querySelector(inputId);
        const icon = document.querySelector(iconId);

        button.addEventListener('click', function () {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            if (type === 'password') {
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    }

    // Aktifkan untuk Password Utama
    setupToggle('#togglePassword', '#password', '#iconPassword');
    // Aktifkan untuk Konfirmasi Password
    setupToggle('#toggleConfirm', '#password-confirm', '#iconConfirm');
</script>
@endsection