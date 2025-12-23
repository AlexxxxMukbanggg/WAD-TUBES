<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Student Center') }}</title>

    <link rel="icon" href="{{ asset('images/logo-telkom.png') }}" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --telkom-red: #b61e2e; 
            --telkom-dark-red: #8f1220;
            --bs-primary: var(--telkom-red);
            --bs-link-color: var(--telkom-red);
        }

        body { 
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Agar footer selalu di bawah */
        }

        #app {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1; /* Konten utama akan mengisi ruang kosong */
        }

        /* Navbar Styling */
        .navbar {
            border-top: 4px solid var(--telkom-red);
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }

        /* Button Override */
        .btn-primary {
            background-color: var(--telkom-red);
            border-color: var(--telkom-red);
        }
        .btn-primary:hover {
            background-color: var(--telkom-dark-red) !important;
            border-color: var(--telkom-dark-red) !important;
        }
        .btn-outline-primary {
            color: var(--telkom-red);
            border-color: var(--telkom-red);
        }
        .btn-outline-primary:hover {
            background-color: var(--telkom-red);
            color: white;
        }
        
        /* Pagination */
        .page-item.active .page-link {
            background-color: var(--telkom-red);
            border-color: var(--telkom-red);
        }
        .page-link { color: var(--telkom-red); }

        /* Card Styling agar lebih elegan */
        .card { 
            border: none; 
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.05); 
            border-radius: 0.5rem;
            overflow: hidden; /* Tambahkan baris ini! */
        }
    </style>
</head>
<body>
    <div id="app">
        @include('layouts.navbar')

        <main class="py-5">
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <footer class="bg-white text-center py-4 border-top mt-auto">
            <div class="container">
                <small class="text-muted">
                    &copy; {{ date('Y') }} <strong>Student Center</strong> - Telkom University. All Rights Reserved.
                </small>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>