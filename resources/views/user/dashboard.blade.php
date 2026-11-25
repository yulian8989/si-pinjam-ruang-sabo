@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="fw-bold">Selamat Datang, {{ auth()->user()->name }}!</h3>
        <p class="text-muted small">Berikut adalah ringkasan aktivitas peminjaman ruangan Anda.</p>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary text-white p-3 rounded shadow-sm mb-4">
                    <div class="inner">
                        <h3>{{ $stats['total'] }}</h3>
                        <p>Total Pengajuan</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning text-dark p-3 rounded shadow-sm mb-4">
                    <div class="inner">
                        <h3>{{ $stats['pending'] }}</h3>
                        <p>Menunggu Approval</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success text-white p-3 rounded shadow-sm mb-4">
                    <div class="inner">
                        <h3>{{ $stats['active'] }}</h3>
                        <p>Peminjaman Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info text-white p-3 rounded shadow-sm mb-4">
                    <div class="inner">
                        <h3>{{ $stats['finished'] }}</h3>
                        <p>Riwayat Selesai</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0 fw-bold">Aktivitas Terbaru</h5>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover align-middle mb-0">
                            <tbody>
                                @forelse($recentBookings as $booking)
                                <tr>
                                    <td class="ps-3">
                                        <strong>{{ $booking->room->name }}</strong>
                                        <br><small class="text-muted">{{ date('d M Y', strtotime($booking->start_time)) }}</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge {{ $booking->status == 'active' ? 'bg-success' : ($booking->status == 'rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-3">
                                        <a href="{{ route('user.bookings.index') }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">Belum ada aktivitas peminjaman.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white text-center">
                        <a href="{{ route('user.bookings.index') }}" class="small-box-footer text-primary text-decoration-none small fw-bold">Lihat Semua Peminjaman <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection