@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="fw-bold mb-0"><i class="bi bi-people me-2 text-primary"></i>Manajemen User</h3>
            </div>
            <div class="col-sm-6 text-end">
                {{-- Tombol Cetak Laporan (Buka di tab baru) --}}
                <a href="{{ route('admin.users.print') }}" target="_blank" class="btn btn-success shadow-sm me-2">
                    <i class="bi bi-printer me-1"></i> Cetak Laporan
                </a>
                
                {{-- Tombol Trash --}}
                <a href="{{ route('admin.users.trashed') }}" class="btn btn-secondary shadow-sm">
                    <i class="bi bi-trash me-1"></i> Lihat Akun Terhapus
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
                                <th>Instansi / Institution</th>
                                <th class="text-center">Status Akun</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td class="ps-3">
                                    <div class="fw-bold text-dark">{{ $user->name }}</div>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </td>
                                <td><code>{{ $user->nik }}</code></td>
                                <td>{{ $user->institution ?? '-' }}</td>
                                <td class="text-center">
                                    @if($user->is_active)
                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Aktif</span>
                                    @else
                                        <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i> Menunggu Verifikasi</span>
                                    @endif
                                </td>
                                <td class="text-center pe-3">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Tombol Lihat Detail (Memicu Modal) --}}
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info text-white shadow-sm">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>


                                        {{-- Tombol Toggle Status (Kode Anda Sebelumnya) --}}
                                        <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            @if(!$user->is_active)
                                                <button type="submit" class="btn btn-sm btn-primary shadow-sm">
                                                    <i class="bi bi-person-check me-1"></i> Aktifkan Akun
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm">
                                                    <i class="bi bi-person-x me-1"></i> Nonaktifkan
                                                </button>
                                            @endif
                                        </form>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Peringatan: Apakah Anda yakin ingin menghapus akun {{ $user->name }} secara permanen? Data peminjaman yang terkait dengan akun ini mungkin akan ikut terpengaruh.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger shadow-sm">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Belum ada user yang mendaftar.</td>
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