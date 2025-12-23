@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 text-center pt-4 pb-0">
                    <img src="{{ asset('images/737px-Logo_Telkom_University_potrait.png') }}" 
                         alt="Logo" width="80" class="mb-3">
                    <h4 class="fw-bold text-dark">Selamat Datang</h4>
                    <p class="text-muted small">Silakan masuk untuk melanjutkan ke Student Center</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-secondary small">EMAIL SSO / NON-SSO</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope"></i></span>
                                <input id="email" type="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nama@student.telkomuniversity.ac.id">
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label fw-semibold text-secondary small">PASSWORD</label>
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none small fw-bold" href="{{ route('password.request') }}">
                                        Lupa Password?
                                    </a>
                                @endif
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock"></i></span>
                                <input id="password" type="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="current-password" placeholder="••••••••">
                                <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword" style="border-color: #dee2e6;">
                                    <i class="bi bi-eye-slash" id="iconPassword"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label small text-muted" for="remember">
                                Ingat Saya di perangkat ini
                            </label>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary fw-bold py-2 rounded-pill">
                                MASUK SEKARANG <i class="bi bi-arrow-right-short"></i>
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="text-muted small mb-0">Belum memiliki akun?</p>
                            <a href="{{ route('register') }}" class="fw-bold text-decoration-none">Daftar Akun Baru</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const icon = document.querySelector('#iconPassword');

    togglePassword.addEventListener('click', function (e) {
        // Toggle tipe atribut
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Toggle ikon mata
        if (type === 'password') {
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    });
</script>
@endsection