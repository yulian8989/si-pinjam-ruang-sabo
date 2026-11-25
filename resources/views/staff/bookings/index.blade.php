@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="fw-bold"><i class="bi bi-eye me-2 text-primary"></i>Verifikasi Persetujuan</h3>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">

                    @include('staff.bookings.partials.table-bookings-staff')
                    
                </div>
            </div>
        </div>
    </div>
</div>

@include('staff.bookings.partials.modal-decline')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil semua tombol dengan class btn-decline
        const declineButtons = document.querySelectorAll('.btn-decline');
        // Ambil form yang ada di dalam modal
        const declineForm = document.getElementById('declineForm');

        declineButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Ambil URL spesifik dari atribut data-url milik tombol
                const actionUrl = this.getAttribute('data-url');
                // Masukkan URL tersebut ke action form pada Modal
                if(declineForm && actionUrl) {
                    declineForm.setAttribute('action', actionUrl);
                }
            });
        });
    });
</script>

@endsection