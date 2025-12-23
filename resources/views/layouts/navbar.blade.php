<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/737px-Logo_Telkom_University_potrait.png') }}" 
                alt="Telkom University" 
                height="40" 
                class="d-inline-block align-text-top">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    {{-- Pastikan route 'ukm-ormawa.index' ada di web.php --}}
                    <a class="nav-link {{ request()->routeIs('ukm-ormawa.index') ? 'active fw-bold' : '' }}" 
                       href="{{ route('ukm-ormawa.index') }}">
                        Daftar UKM/Ormawa
                    </a>
                </li>

                @auth
                    @if(Auth::user()->role === 'pengurus')
                        <li class="nav-item">
                            {{-- Cek apakah user sudah punya UKM yang dikelola --}}
                            @if(Auth::user()->manages_ukm_ormawa_id)
                                {{-- Jika sudah punya, arahkan ke Edit --}}
                                <a class="nav-link fw-bold text-success" href="{{ route('pengurus.ukm-ormawa.edit') }}">
                                    <i class="bi bi-gear-fill"></i> Kelola UKM/Ormawa
                                </a>
                            @else
                                {{-- Jika belum punya, arahkan ke Buat Baru --}}
                                {{-- Catatan: Menggunakan route 'pengurus.ukm-ormawa.store' sesuai web.php Anda untuk method GET --}}
                                <a class="nav-link fw-bold text-success" href="{{ route('pengurus.ukm-ormawa.store') }}">
                                    <i class="bi bi-plus-circle"></i> Buat UKM/Ormawa
                                </a>
                            @endif
                        </li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-danger me-2 px-3 text-danger border-0" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link btn btn-danger px-3 text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }} 
                            <span class="badge bg-secondary ms-1">{{ Auth::user()->role }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
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