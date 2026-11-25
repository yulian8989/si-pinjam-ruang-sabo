<table class="table table-hover align-middle mb-0">
    <thead class="table-dark">
        <tr>
            <th class="ps-3">Ruangan</th>
            <th>Jadwal Peminjaman</th>
            <th>Keperluan</th>
            <th class="text-center">Progres Persetujuan</th>
            <th class="text-center">Status Utama</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($bookings as $booking)
        <tr class="{{ $booking->status == 'expired' ? 'opacity-50 table-secondary' : '' }}">
            <td class="ps-3">
                <span class="fw-bold text-dark">{{ $booking->room->name }}</span>
                <br>
                <small class="text-muted"><i class="bi bi-hash"></i>ID-{{ $booking->id }}</small>
            </td>
            <td>
                <div class="small">
                    <i class="bi bi-calendar-check text-primary me-1"></i>
                    {{ date('d M Y', strtotime($booking->start_time)) }}
                </div>
                <div class="small fw-bold">
                    <i class="bi bi-clock text-secondary me-1"></i>
                    {{ date('H:i', strtotime($booking->start_time)) }} - {{ date('H:i', strtotime($booking->end_time)) }}
                </div>
            </td>
            <td>
                <span title="{{ $booking->purpose }}">
                    {{ Str::limit($booking->purpose, 25) }}
                </span>
            </td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                    {{-- Progres Staff --}}
                    <div class="text-center">
                        <small class="d-block text-muted " style="font-size: 15px;">Staff </small>
                        <span class="badge {{ $booking->staff_status == 'approved' ? 'bg-success' : ($booking->staff_status == 'rejected' ? 'bg-danger' : ($booking->staff_status == 'expired' ? 'bg-secondary' : 'bg-warning text-dark')) }}">
                            <i class="bi {{ $booking->staff_status == 'approved' ? 'bi-check-circle' : ($booking->staff_status == 'rejected' ? 'bi-x-circle' : ($booking->staff_status == 'expired' ? 'bi-clock-history' : 'bi-hourglass-split')) }}"></i>
                            {{ ucfirst($booking->staff_status) }}
                        </span>
                    </div>
                    {{-- Progres Admin --}}
                    <div class="text-center">
                        <small class="d-block text-muted " style="font-size: 15px;">Admin</small>
                        <span class="badge {{ $booking->admin_status == 'approved' ? 'bg-success' : ($booking->admin_status == 'rejected' ? 'bg-danger' : ($booking->admin_status == 'expired' ? 'bg-secondary' : 'bg-warning text-dark')) }}">
                            <i class="bi {{ $booking->admin_status == 'approved' ? 'bi-check-circle' : ($booking->admin_status == 'rejected' ? 'bi-x-circle' : ($booking->admin_status == 'expired' ? 'bi-clock-history' : 'bi-hourglass-split')) }}"></i>
                            {{ ucfirst($booking->admin_status) }}
                        </span>
                    </div>
                </div>
            </td>
            <td class="text-center">
                @php
                    $mainStatusClass = [
                        'pending'   => 'bg-warning text-dark',
                        'active'    => 'bg-primary',
                        'finished'  => 'bg-success',
                        'expired'   => 'bg-secondary',
                        'rejected'  => 'bg-danger',
                        'cancelled' => 'bg-danger'
                    ][$booking->status] ?? 'bg-light';
                @endphp
                <span class="badge {{ $mainStatusClass }} px-3 py-2 shadow-sm">
                    {{ strtoupper($booking->status) }}
                </span>
            </td>
            <td class="text-center pe-3">
                <div class="d-flex flex-column align-items-center gap-2">
                    @if($booking->status == 'rejected')
                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                onclick="showNote('{{ $booking->admin_notes }}')" 
                                title="Lihat Alasan Penolakan">
                            <i class="bi bi-info-circle"></i> Alasan
                        </button>
                    {{-- @elseif($booking->status == 'expired')
                        <span class="text-secondary small fw-bold"><i class="bi bi-exclamation-circle"></i> Kadaluarsa</span>
                    @elseif($booking->status == 'active')
                        <span class="text-success fw-bold small mb-1"><i class="bi bi-patch-check-fill"></i> Siap Digunakan</span>
                    @elseif($booking->status == 'cancelled')
                        <span class="text-danger small fw-bold">Dibatalkan</span>
                    @else
                        <span class="text-muted small italic mb-1">Diproses</span> --}}
                    @endif

                    {{-- Tombol Batal: Hanya muncul jika status masih pending atau active --}}
                    @if(in_array($booking->status, ['pending', 'active']))
                        <form action="{{ route('user.bookings.cancel', $booking->id) }}" method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin membatalkan peminjaman ini? ')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-xs btn-outline-danger shadow-sm" style="font-size: 15px; padding: 2px 8px;">
                                <i class="bi bi-x-circle"></i> Batalkan Peminjaman
                            </button>
                        </form>
                    @endif
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="mb-3 opacity-25">
                <p class="text-muted">Anda belum memiliki peminjaman yang sedang diproses.</p>
                <a href="{{ route('user.rooms.index') }}" class="btn btn-primary btn-sm mt-2">Mulai Pinjam Sekarang</a>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>