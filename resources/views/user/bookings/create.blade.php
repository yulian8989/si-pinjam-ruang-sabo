@extends('layouts.master')

@section('content')

{{-- ==========================================
     1. CSS FLATPICKR
     ========================================== --}}
     @include('user.bookings.partials.flatpickr-styles')

{{-- ==========================================
     2. STRUKTUR HTML HALAMAN FORM
     ========================================== --}}
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="fw-bold"><i class="bi bi-calendar-event me-2 text-primary"></i>Form Peminjaman Ruangan</h3>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Gagal!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @include('user.bookings.partials.room-info-card')
            @include('user.bookings.partials.form-field')
        </div>
    </div>
</div>

{{-- ==========================================
     3. JAVASCRIPT FLATPICKR
     ========================================== --}}
     @include('user.bookings.partials.flatpickr-scripts')

@endsection