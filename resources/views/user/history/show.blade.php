@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="fw-bold mb-0"><i class="bi bi-file-earmark-text me-2 text-primary"></i>Detail Peminjaman</h3>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('user.history.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Riwayat
                </a>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row g-4 justify-content-center">
            
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    @include ('user.history.partials.header-detail')
                    
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            
                            @include ('user.history.partials.list-detail')

                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection