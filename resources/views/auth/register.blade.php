@extends('layouts.auth')

@section('content')
<div class="card glass-card shadow-lg p-3 my-5" style="width: 100%; max-width: 550px;">
    <div class="card-body">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">Daftar Akun Baru</h2>
            <p class="text-muted small">Lengkapi data diri Anda untuk sistem peminjaman ruangan.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input id="name" type="text" class="form-control border-0 bg-light @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required autofocus>
                        <label for="name"><i class="bi bi-person me-2"></i>Nama Lengkap</label>
                        @error('name') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input id="nik" type="text" maxlength="16" class="form-control border-0 bg-light @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" placeholder="NIK" required>
                        <label for="nik"><i class="bi bi-card-text me-2"></i>NIK (16 Digit)</label>
                        @error('nik') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input id="phone" type="text" class="form-control border-0 bg-light @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="No. Telepon" required>
                        <label for="phone"><i class="bi bi-telephone me-2"></i>No. Telepon</label>
                        @error('phone') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input id="email" type="email" class="form-control border-0 bg-light @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Alamat Email" required>
                <label for="email"><i class="bi bi-envelope me-2"></i>Alamat Email</label>
                @error('email') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <div class="form-floating mb-3">
                <input id="institution" type="text" class="form-control border-0 bg-light @error('institution') is-invalid @enderror" name="institution" value="{{ old('institution') }}" placeholder="Asal Instansi" required>
                <label for="institution"><i class="bi bi-building me-2"></i>Asal Instansi / Afiliasi</label>
                @error('institution') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input id="password" type="password" class="form-control border-0 bg-light @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                        <label for="password"><i class="bi bi-key me-2"></i>Kata Sandi</label>
                        @error('password') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input id="password-confirm" type="password" class="form-control border-0 bg-light" name="password_confirmation" placeholder="Konfirmasi" required>
                        <label for="password-confirm"><i class="bi bi-check-circle me-2"></i>Konfirmasi Password</label>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold shadow">
                    Daftar Sekarang <i class="bi bi-person-plus ms-1"></i>
                </button>
            </div>

            <div class="text-center mt-4">
                <p class="small text-muted">Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Masuk di sini</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection