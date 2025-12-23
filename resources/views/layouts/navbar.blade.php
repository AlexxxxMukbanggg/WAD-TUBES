<nav class="navbar navbar-expand-md navbar-light bg-white sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/dashboard') }}">
            <img src="{{ asset('images/737px-Logo_Telkom_University_potrait.png') }}" 
                 alt="Telkom University" 
                 height="40">
            <span class="d-none d-lg-block text-secondary small border-start ps-2 ms-1" style="line-height: 1.2;">
                Student<br>Center
            </span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto ms-md-3 align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold text-primary' : '' }}" 
                       href="{{ route('home') }}">
                        Daftar UKM/Ormawa
                    </a>
                </li>
                
                @auth
                    @if(Auth::user()->role === 'pengelola')
                        {{-- PERBAIKAN: Menggunakan createdUkmOrmawa (relasi yang sudah diperbaiki di Model User) --}}
                        @if(Auth::user()->createdUkmOrmawa)
                            <li class="nav-item ms-md-2">
                                {{-- PERBAIKAN: Menambahkan parameter ID ke route --}}
                                <a class="nav-link fw-bold text-success" href="{{ route('pengelola.ukm-ormawa.edit', Auth::user()->createdUkmOrmawa->id) }}">
                                    <i class="bi bi-gear-fill me-1"></i> Kelola Organisasi
                                </a>
                            </li>
                        @endif
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto align-items-center">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link fw-semibold px-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="btn btn-primary px-4 rounded-pill btn-sm ms-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-primary fw-bold border" style="width: 35px; height: 35px;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="d-flex flex-column text-start" style="line-height: 1.1;">
                                <span class="fw-semibold small">{{ Auth::user()->name }}</span>
                                <span class="text-muted" style="font-size: 10px;">{{ ucfirst(Auth::user()->role) }}</span>
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>