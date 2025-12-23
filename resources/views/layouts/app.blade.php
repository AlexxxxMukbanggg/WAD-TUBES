<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Student Center') }}</title>

    <link rel="icon" href="{{ asset('images/logo-telkom.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('images/logo-telkom.png') }}" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        /* Override Variabel Bootstrap untuk Warna Utama */
        :root {
            /* Warna Telkom Red (Maroon-ish) */
            --telkom-red: #b61e2e; 
            --telkom-dark-red: #8f1220;
            
            /* Mengganti warna --bs-primary jadi merah Telkom */
            --bs-primary: var(--telkom-red);
            --bs-primary-rgb: 182, 30, 46;
            
            /* Mengganti warna Link default */
            --bs-link-color: var(--telkom-red);
            --bs-link-hover-color: var(--telkom-dark-red);
        }

        body { 
            background-color: #f4f6f9; /* Background sedikit abu-abu muda */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Styling Navbar */
        .navbar { 
            box-shadow: 0 4px 6px -1px rgba(182, 30, 46, 0.1); 
            border-top: 4px solid var(--telkom-red); /* Garis Merah di atas Navbar */
        }
        
        .navbar-brand {
            font-weight: 700;
        }

        /* Override Tombol Primary */
        .btn-primary {
            background-color: var(--telkom-red);
            border-color: var(--telkom-red);
        }

        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background-color: var(--telkom-dark-red) !important;
            border-color: var(--telkom-dark-red) !important;
        }

        /* Override Tombol Outline Primary */
        .btn-outline-primary {
            color: var(--telkom-red);
            border-color: var(--telkom-red);
        }

        .btn-outline-primary:hover {
            background-color: var(--telkom-red);
            border-color: var(--telkom-red);
            color: white;
        }

        /* Text Colors */
        .text-primary {
            color: var(--telkom-red) !important;
        }

        /* Card Styling agar lebih elegan */
        .card { 
            border: none; 
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.05); 
            border-radius: 0.5rem;
        }
        
        /* Pagination Color Override */
        .page-link {
            color: var(--telkom-red);
        }
        .page-item.active .page-link {
            background-color: var(--telkom-red);
            border-color: var(--telkom-red);
        }
    </style>
</head>
<body>
    <div id="app">
        @include('layouts.navbar')

        <main class="py-5">
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('info'))
                    <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
                         <i class="bi bi-info-circle-fill me-2"></i>{{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
        
        <footer class="text-center py-4 text-muted mt-5 border-top">
            <small>&copy; {{ date('Y') }} Student Center - Telkom University</small>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>