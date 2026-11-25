@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0 fw-bold"><i class="bi bi-trash text-danger me-2"></i>Akun Terhapus (Trash)</h3>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar User
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
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-3">Nama Lengkap</th>
                                <th>NIK</th>
                                <th>Waktu Dihapus</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($trashedUsers as $user)
                            <tr>
                                <td class="ps-3">
                                    <div class="fw-bold text-dark">{{ $user->name }}</div>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </td>
                                <td><span class="font-monospace">{{ $user->nik ?? '-' }}</span></td>
                                <td>
                                    <span class="text-danger"><i class="bi bi-clock-history me-1"></i>{{ $user->deleted_at->format('d M Y H:i') }}</span>
                                </td>
                                <td class="text-center pe-3">
                                    <div class="d-flex justify-content-center gap-2">
                                        
                                        {{-- Tombol Restore --}}
                                        <form action="{{ route('admin.users.restore', $user->id) }}" method="POST" onsubmit="return confirm('Pulihkan akun {{ $user->name }}?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success shadow-sm">
                                                <i class="bi bi-arrow-counterclockwise me-1"></i> Pulihkan
                                            </button>
                                        </form>

                                        {{-- Tombol Force Delete --}}
                                        <form action="{{ route('admin.users.forceDelete', $user->id) }}" method="POST" onsubmit="return confirm('PERINGATAN: Menghapus permanen akan menghilangkan data ini selamanya. Yakin?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger shadow-sm">
                                                <i class="bi bi-trash-fill"></i> Hapus Permanen
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
                                    Tidak ada akun di tong sampah.
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
@endsection