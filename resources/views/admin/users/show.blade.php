@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0 fw-bold"><i class="bi bi-person-vcard me-2 text-primary"></i>Detail Pengguna</h3>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row g-4">
            
            {{-- Kolom Kiri: Profil Singkat & Avatar --}}
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center p-4">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar Pengguna" class="rounded-circle shadow mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center shadow mx-auto mb-3 fs-1 fw-bold" style="width: 150px; height: 150px;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        
                        <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                        <p class="text-muted mb-3">{{ $user->email }}</p>
                        
                        <div class="d-flex justify-content-center gap-2 mb-2">
                            <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-warning text-dark' }} px-3 py-2 rounded-pill shadow-sm">
                                <i class="bi {{ $user->is_active ? 'bi-check-circle' : 'bi-hourglass-split' }} me-1"></i>
                                {{ $user->is_active ? 'Akun Aktif' : 'Belum Aktif' }}
                            </span>
                            <span class="badge bg-primary px-3 py-2 rounded-pill shadow-sm text-uppercase">
                                {{ $user->role }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Detail Informasi Kelengkapan --}}
            <div class="col-md-8">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-bottom pt-3 pb-2">
                        <h5 class="card-title fw-bold mb-0">Informasi Pendaftaran</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-4">
                                <div class="row align-items-center">
                                    <div class="col-sm-4 text-muted fw-bold small text-uppercase"><i class="bi bi-person-badge me-2"></i>Nomor Induk Kependudukan</div>
                                    <div class="col-sm-8 fw-medium fs-6 font-monospace">{{ $user->nik ?? '-' }}</div>
                                </div>
                            </li>
                            <li class="list-group-item p-4 bg-light-subtle">
                                <div class="row align-items-center">
                                    <div class="col-sm-4 text-muted fw-bold small text-uppercase"><i class="bi bi-telephone me-2"></i>Nomor Telepon / WA</div>
                                    <div class="col-sm-8 fw-medium fs-6">{{ $user->phone ?? '-' }}</div>
                                </div>
                            </li>
                            <li class="list-group-item p-4">
                                <div class="row align-items-center">
                                    <div class="col-sm-4 text-muted fw-bold small text-uppercase"><i class="bi bi-building me-2"></i>Asal Instansi / Institusi</div>
                                    <div class="col-sm-8 fw-medium fs-6">{{ $user->institution ?? '-' }}</div>
                                </div>
                            </li>
                            <li class="list-group-item p-4 bg-light-subtle">
                                <div class="row align-items-center">
                                    <div class="col-sm-4 text-muted fw-bold small text-uppercase"><i class="bi bi-calendar-check me-2"></i>Tanggal Terdaftar</div>
                                    <div class="col-sm-8 fw-medium fs-6">
                                        {{ $user->created_at ? $user->created_at->format('d F Y, H:i') . ' WIB' : '-' }}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection