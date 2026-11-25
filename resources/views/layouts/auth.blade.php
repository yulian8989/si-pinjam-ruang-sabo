<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pinjam Ruang Sabo | Auth</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {
            /* Menggunakan gambar milik Anda */
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), 
                        url("{{ asset('images/baltek-sabo.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.9); /* Lebih putih agar teks jelas */
            backdrop-filter: blur(8px);
            border: none;
            border-radius: 25px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
                <i class="bi me-2"></i> Pinjam Ruang Sabo
            </a>
            <div class="ms-auto">
                @if(request()->routeIs('login'))
                    <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4">Daftar</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4">Masuk</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; padding-top: 80px;">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>