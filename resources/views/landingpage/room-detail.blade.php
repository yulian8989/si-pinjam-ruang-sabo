<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Ruangan - {{ $room->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('landing') }}">
                Pinjam Ruang Sabo
            </a>
            
            @auth
                <div class="ms-auto d-none d-md-block">
                    <span class="text-muted small me-2">Login sebagai:</span>
                    <span class="badge bg-primary-subtle text-primary border border-primary rounded-pill">
                        {{ auth()->user()->name }}
                    </span>
                </div>
            @endauth
        </div>
    </nav>

@include('landingpage.partials.room-pictures')
{{-- @include('landingpage.partials.room-reviews') --}}
@include('landingpage.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>