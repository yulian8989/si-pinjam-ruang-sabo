@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="fw-bold"><i class=" me-2 text-primary"></i>Status Peminjaman</h3>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    @include('user.bookings.partials.table-bookings-user')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection