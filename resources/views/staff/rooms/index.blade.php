@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="fw-bold">Manajemen Ruangan</h3></div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('staff.rooms.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add New Room
                </a>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="card  shadow-sm border-0 overflow-hidden">
            <div class="card-body p-0">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 50px">#</th>
                            <th>Gambar</th>
                            <th>Nama Ruangan</th>
                            <th>Deskripsi</th>
                            <th>Kapasitas</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $room)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($room->image)
                                    <img src="{{ asset('storage/' . $room->image) }}" class="img-thumbnail" style="width: 80px;">
                                @else
                                    <span class="text-muted">Tidak ada Gambar</span>
                                @endif
                            </td>
                            <td><strong>{{ $room->name }}</strong></td>
                            <td>{{ Str::limit($room->description, 50) }}</td>
                            <td>{{ $room->capacity }} Orang</td>
                            <td>
                                <span class="badge  py-2 px-3 {{ $room->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $room->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('staff.rooms.edit', $room->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('staff.rooms.destroy', $room->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this room?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center py-4">TIdak ada Ruangan tersedia.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection