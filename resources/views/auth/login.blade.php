@extends('layouts.auth')
@section('content')
<div class="card glass-card shadow-lg p-3" style="width: 100%; max-width: 450px;">
    @if (session('login_error'))
    <div class="alert alert-danger shadow-sm border-0">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('login_error') }}
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success shadow-sm border-0">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
    </div>
@endif
    <div class="card-body">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">Selamat Datang</h2>
            <p class="text-muted small">Silakan masuk untuk meminjam ruangan</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control border-0 bg-light rounded-3 @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                <label for="email"><i class="bi bi-envelope me-2"></i>Alamat Email</label>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control border-0 bg-light rounded-3 @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                <label for="password"><i class="bi bi-lock me-2"></i>Kata Sandi</label>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label small" for="remember">Ingat saya</label>
                </div>
                <a href="{{ route('password.request') }}" class="small text-decoration-none text-primary">Lupa Password?</a>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold shadow">
                Masuk Sekarang
            </button>
        </form>
    </div>
</div>
@endsection