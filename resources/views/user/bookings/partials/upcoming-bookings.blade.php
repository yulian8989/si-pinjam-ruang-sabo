<div class="card shadow-sm border-0 mt-4">
    <div class="card-header bg-white border-bottom pt-3 pb-2">
        <h6 class="card-title fw-bold mb-0">
            <i class="bi bi-calendar-week text-primary me-2"></i>Jadwal Mendatang
        </h6>
    </div>
    
    <div class="card-body p-0" style="max-height: 350px; overflow-y: auto;">
        <ul class="list-group list-group-flush">
            @forelse($upcomingBookings as $booking)
            <li class="list-group-item p-3 bg-light-subtle">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="fw-bold text-dark" style="font-size: 0.9rem;">
                        {{ \Carbon\Carbon::parse($booking->start_time)->translatedFormat('d M Y') }}
                    </span>
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle shadow-sm">
                        {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
                    </span>
                </div>
                <p class="text-muted small mb-0">
                    <i class="bi bi-info-circle me-1"></i> {{ $booking->purpose ?? 'Peminjaman Ruangan' }}
                </p>
            </li>
            @empty
            <li class="list-group-item p-4 text-center text-muted small">
                <i class="bi bi-calendar-check fs-3 d-block mb-2 opacity-50"></i>
                Belum ada jadwal mendatang.<br>Ruangan ini kosong!
            </li>
            @endforelse
        </ul>
    </div>
</div>