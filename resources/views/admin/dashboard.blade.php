@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3>Admin Dashboard</h3></div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <h6 class="mb-3 text-muted fw-bold text-uppercase" style="letter-spacing: 1px;">
            <small><i class="bi bi-grid-1x2-fill me-2"></i>Statistik Peminjaman & Ruangan</small>
        </h6>
        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="small-box bg-primary text-white p-2 rounded shadow-sm mb-3">
                    <div class="inner ps-2">
                        <h4 class="fw-bold mb-0">{{ $totalRooms }}</h4>
                        <p class="mb-0 small fw-bold">Total Ruangan</p>
                    </div>
                    <div class="icon"><i class="bi bi-door-open-fill opacity-25" style="font-size: 2rem;"></i></div>
                </div>
            </div>
        
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success text-white p-2 rounded shadow-sm mb-3">
                    <div class="inner ps-2">
                        <h4 class="fw-bold mb-0">{{ $totalFacilities }}</h4>
                        <p class="mb-0 small fw-bold">Total Fasilitas</p>
                    </div>
                    <div class="icon"><i class="bi bi-tools opacity-25" style="font-size: 2rem;"></i></div>
                </div>
            </div>
        
            <div class="col-lg-4 col-12">
                <div class="small-box bg-warning text-dark p-2 rounded shadow-sm mb-3 border-start border-4 border-white">
                    <div class="inner ps-2">
                        <h4 class="fw-bold mb-0">{{ $pendingBookings }}</h4>
                        <p class="mb-0 small fw-bold">Perlu Persetujuan</p>
                    </div>
                    <div class="icon"><i class="bi bi-hourglass-split opacity-25" style="font-size: 2rem;"></i></div>
                </div>
            </div>
        </div>
        
        <hr class="my-3">
        
        <h6 class="mb-3 text-muted fw-bold text-uppercase" style="letter-spacing: 1px;">
            <small><i class="bi bi-people-fill me-2"></i>Manajemen Pengguna</small>
        </h6>
        <div class="row">
            <div class="col-lg-6 col-6">
                <div class="small-box bg-info text-white p-2 rounded shadow-sm mb-3">
                    <div class="inner ps-2">
                        <h4 class="fw-bold mb-0">{{ $activeUsers }}</h4>
                        <p class="mb-0 small fw-bold">Pengguna Aktif</p>
                    </div>
                    <div class="icon"><i class="bi bi-person-check-fill opacity-25" style="font-size: 2rem;"></i></div>
                </div>
            </div>
        
            <div class="col-lg-6 col-6">
                <div class="small-box bg-danger text-white p-2 rounded shadow-sm mb-3">
                    <div class="inner ps-2">
                        <h4 class="fw-bold mb-0">{{ $unverifiedUsers }}</h4>
                        <p class="mb-0 small fw-bold"> User Menunggu Verifikasi</p>
                    </div>
                    <div class="icon"><i class="bi bi-person-exclamation opacity-25" style="font-size: 2rem;"></i></div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card card-outline card-primary shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title"><i class="bi bi-calendar3 me-2"></i> Jadwal Peminjaman Hari Ini</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Waktu</th>
                                    <th>Ruangan</th>
                                    <th>Peminjam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($todayBookings as $booking)
                                <tr>
                                    <td>
                                        <span class="text-primary fw-bold">
                                            {{ date('H:i', strtotime($booking->start_time)) }} - {{ date('H:i', strtotime($booking->end_time)) }}
                                        </span>
                                    </td>
                                    <td>{{ $booking->room->name }}</td>
                                    <td>{{ $booking->user->name }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">Tidak ada jadwal untuk hari ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('admin.bookings.index') }}" class="small-box-footer">Lihat Semua Data <i class="bi bi-arrow-right-circle"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection