@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="fw-bold"><i class="bi bi-shield-lock me-2 text-primary"></i>Data Peminjaman (Admin)</h3>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('admin.bookings.report') }}" class="btn btn-outline-primary shadow-sm">
                    <i class="bi bi-file-earmark-pdf"></i> Cetak Laporan PDF
                </a>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    @include('admin.bookings.partials.table-bookings-admin')
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL DECLINE --}}
@include('admin.bookings.partials.modal-decline')


@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const declineModal = new bootstrap.Modal(document.getElementById('declineModal'));
        const declineForm = document.getElementById('declineForm');

        document.querySelectorAll('.btn-decline').forEach(button => {
            button.addEventListener('click', function () {
                const url = this.getAttribute('data-url');
                declineForm.setAttribute('action', url);
                declineModal.show();
            });
        });
    });
</script>
@endpush
@endsection