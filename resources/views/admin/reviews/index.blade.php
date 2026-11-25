@extends('layouts.master')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="fw-bold"><i class="bi bi-star-fill me-2 text-warning"></i> Ulasan & Rating</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
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
                                        <small class="text-muted">{{ $review->created_at->format('d M Y, H:i') }}</small>
                                    </td>
                                    <td class="ps-3">
                                        <strong>{{ $review->user->name }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill">
                                            {{ $review->room->name }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        {{-- Visualisasi Bintang --}}
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star-fill {{ $i <= $review->rating ? 'text-warning' : 'text-muted opacity-25' }}"></i>
                                        @endfor
                                        <br><small class="text-muted">({{ $review->rating }}/5)</small>
                                    </td>
                                    <td>
                                        <p class="mb-0 small text-wrap" style="max-width: 300px;">
                                            "{{ $review->comment }}"
                                        </p>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-chat-left-dots fs-1 d-block mb-2"></i>
                                        Belum ada ulasan dari pengguna.
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