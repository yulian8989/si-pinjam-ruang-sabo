@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="fw-bold text-success"><i class="bi bi-shield-check me-2"></i>Staff Dashboard</h3>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            {{-- Box 1: Antrean --}}
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-warning text-dark p-3 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold mb-0">{{ $stats['pending_verification'] }}</h2>
                            <p class="mb-0">Perlu Verifikasi Staff</p>
                        </div>
                        <i class="bi bi-hourglass-split fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
            {{-- Box 2: Total Proses --}}
            {{-- <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-success text-white p-3 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold mb-0">{{ $stats['total_processed'] }}</h2>
                            <p class="mb-0">Total Berkas Diproses</p>
                        </div>
                        <i class="bi bi-check2-all fs-1 opacity-50"></i>
                    </div>
                </div>
            </div> --}}
            {{-- Box 3: Hari Ini --}}
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-info text-white p-3 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold mb-0">{{ $stats['today_incoming'] }}</h2>
                            <p class="mb-0">Peminjaman Hari Ini</p>
                        </div>
                        <i class="bi bi-calendar-event fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-list-ul me-2 text-primary"></i>Antrean Verifikasi Terbaru</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Peminjam</th>
                                        <th>Ruangan</th>
                                        <th>Waktu Pinjam</th>
                                        <th class="text-end pe-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendingBookings as $booking)
                                    <tr>
                                        <td class="ps-3">
                                            <strong>{{ $booking->user->name }}</strong>
                                            <br><small class="text-muted">ID: {{ $booking->id }}</small>
                                        </td>
                                        <td>{{ $booking->room->name }}</td>
                                        <td>{{ date('d M Y', strtotime($booking->start_time)) }}</td>
                                        <td class="text-end pe-3">
                                            {{-- Link diarahkan ke index bookings staff untuk verifikasi, tanpa tombol "Buka Berkas" --}}
                                            <a href="{{ route('staff.bookings.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                                Detail Verifikasi <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="bi bi-emoji-smile fs-2 d-block mb-2"></i>
                                            Semua antrean sudah diproses!
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection