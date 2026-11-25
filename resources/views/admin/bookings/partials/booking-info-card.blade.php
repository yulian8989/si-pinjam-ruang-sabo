{{-- ==========================================
     DETAIL PENGAJUAN (Read-Only)
     ========================================== --}}
     <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white pt-3 pb-2">
            <h6 class="card-title fw-bold mb-0"><i class="bi bi-file-earmark-text me-2"></i>Informasi Pengajuan</h6>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                    <small class="text-muted d-block fw-bold text-uppercase mb-1">Peminjam / Instansi</small>
                    <div class="fw-medium fs-6">{{ $booking->user->name ?? 'User Terhapus' }}</div>
                    <div class="text-secondary small">{{ $booking->user->institution ?? '-' }}</div>
                </li>
                <li class="list-group-item p-3 bg-light-subtle">
                    <small class="text-muted d-block fw-bold text-uppercase mb-1">Ruangan</small>
                    <div class="fw-medium fs-6"><i class="bi bi-door-open me-1 text-primary"></i> {{ $booking->room->name ?? 'Ruangan Terhapus' }}</div>
                </li>
                <li class="list-group-item p-3">
                    <small class="text-muted d-block fw-bold text-uppercase mb-1">Waktu Pelaksanaan</small>
                    <div class="fw-medium">
                        {{ \Carbon\Carbon::parse($booking->start_time)->translatedFormat('l, d F Y') }}<br>
                        <span class="text-primary"><i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }} WIB</span>
                    </div>
                </li>
                <li class="list-group-item p-3 bg-light-subtle">
                    <small class="text-muted d-block fw-bold text-uppercase mb-1">Keperluan Kegiatan</small>
                    <p class="mb-0 fw-medium">{{ $booking->purpose }}</p>
                </li>
                <li class="list-group-item p-3 text-center">
                    @if($booking->attachment)
                        <a href="{{ asset('storage/' . $booking->attachment) }}" target="_blank" class="btn btn-outline-info w-100 shadow-sm">
                            <i class="bi bi-file-earmark-pdf me-2"></i> Lihat Berkas Pendukung
                        </a>
                    @else
                        <span class="text-muted fst-italic">Tidak ada berkas terlampir</span>
                    @endif
                </li>
            </ul>
        </div>
    </div>