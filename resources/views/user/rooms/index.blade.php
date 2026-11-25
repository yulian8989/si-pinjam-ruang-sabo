@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="fw-bold">Katalog Ruangan</h3></div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            @forelse ($rooms as $room)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">

                        @include ('user.rooms.partials.room-image')

                        @include ('user.rooms.partials.room-info')
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="100" class="mb-3 opacity-50">
                    <p class="text-muted">Maaf, saat ini tidak ada ruangan yang tersedia untuk dipinjam.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection