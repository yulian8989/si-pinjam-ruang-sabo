@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0 fw-bold"  >Manajemen Fasilitas</h3>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('staff.facilities.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Fasilitas
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
                            <th style="width: 60px">#</th>
                            <th>Nama Fasilitas</th>
                            <th>Informasi</th>
                            <th style="width: 150px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($facilities as $facility)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $facility->name }}</strong></td>
                                <td class="text-muted">{{ $facility->information ?? 'No additional information' }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('staff.facilities.edit', $facility->id) }}" class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('staff.facilities.destroy', $facility->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this facility?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Tidak ada data fasilitas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection