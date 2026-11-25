@extends('layouts.master') {{-- Sesuaikan dengan layout utama Anda --}}

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0 fw-bold"><i class="bi bi-star me-2 text-warning"></i>Ulasan & Rating Ruangan</h3>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="card shadow border-0">
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="15%">Tanggal</th>
                            <th width="20%">Peminjam</th>
                            <th width="20%">Ruangan</th>
                            <th width="15%">Rating</th>
                            <th width="30%">Komentar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                        <tr>
                            <td>
                                <i class="bi bi-calendar3 text-muted me-1"></i> 
                                {{ $review->created_at->format('d M Y') }}
                            </td>
                            <td>
                                <strong>{{ $review->user->name ?? 'User Dihapus' }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                                    {{ $review->room->name ?? 'Ruangan Dihapus' }}
                                </span>
                            </td>
                            <td>
                                <div class="text-warning fs-6">
                                    {{-- Looping untuk menampilkan ikon bintang sesuai angka rating --}}
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                    <span class="text-dark fw-bold ms-1 small">({{ $review->rating }}/5)</span>
                                </div>
                            </td>
                            <td>
                                <span class="{{ $review->comment ? 'text-dark' : 'text-muted italic' }}">
                                    {{ $review->comment ?? 'Tidak ada komentar yang ditinggalkan.' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-chat-square-text fs-1 d-block mb-3 opacity-50"></i>
                                Belum ada ulasan yang masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Menampilkan navigasi pagination jika data lebih dari 10 --}}
            @if($reviews->hasPages())
                <div class="card-footer bg-white border-top pt-3 pb-0">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection