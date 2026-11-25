<div class="card-header bg-white border-bottom pt-4 pb-3">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-title fw-bold mb-0">Informasi Kegiatan</h5>
        {{-- Menampilkan Status Utama --}}
        @if($booking->status == 'pending')
            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm">PENDING</span>
        @elseif($booking->status == 'active')
            <span class="badge bg-primary px-3 py-2 rounded-pill shadow-sm">ACTIVE</span>
        @elseif($booking->status == 'finished')
            <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm">FINISHED</span>
        @elseif($booking->status == 'rejected')
            <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm">REJECTED</span>
        @else
            <span class="badge bg-secondary px-3 py-2 rounded-pill shadow-sm">{{ strtoupper($booking->status) }}</span>
        @endif
    </div>
</div>