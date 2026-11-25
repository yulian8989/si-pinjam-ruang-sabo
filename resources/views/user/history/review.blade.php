@extends('layouts.master')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        {{-- Melebarkan kolom luar menjadi col-md-10 agar ruang horizontal lebih luas --}}
        <div class="col-md-10 col-lg-8">
            <div class="card shadow border-0 overflow-hidden">
                <div class="row g-0"> {{-- Grid horizontal di dalam card --}}
                    
                    {{-- Bagian Kiri: Gambar Ruangan --}}
                    @include('user.history.partials.room-image-review')

                    {{-- Bagian Kanan: Form Review --}}

                    @include('user.history.partials.form-review')

                </div> {{-- End Row --}}
            </div>
        </div>
    </div>
</div>
@endsection