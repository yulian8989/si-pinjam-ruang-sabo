<table class="table table-hover align-middle mb-0">
    <thead class="table-dark">
        <tr>
            <th>Peminjam</th>
            <th>Ruangan</th>
            <th>Waktu Penggunaan</th>
            <th class="text-center">Status Staff</th>
            <th class="text-center">Status Admin</th> 
            <th class="text-center">Status Utama</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($bookings as $booking)
        <tr class="{{ $booking->status == 'expired' ? 'table-secondary opacity-75' : '' }}">
            
            {{-- Kolom Peminjam & Ruangan --}}
            <td>
                <strong>{{ $booking->user->name }}</strong><br>
                <small class="text-muted"><i class="bi bi-chat-left-text"></i> {{ $booking->purpose }}</small>
            </td>
            <td>
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle py-2 px-3">
                    {{ $booking->room->name }}
                </span>
            </td>
            
            {{-- Kolom Waktu --}}
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

            {{-- Kolom Status Khusus Staff --}}
            <td class="text-center">
                @php
                    $staffBadge = match($booking->staff_status) {
                        'approved' => 'bg-success',
                        'rejected' => 'bg-danger',
                        default    => 'bg-warning text-dark',
                    };
                @endphp
                <span class="badge {{ $staffBadge }} px-3  rounded-pill shadow-sm">
                    {{ strtoupper($booking->staff_status) }}
                </span>
            </td>

            {{-- Kolom Status Khusus Admin --}}
            <td class="text-center">
                @php
                    $adminBadge = match($booking->admin_status) {
                        'approved' => 'bg-success',
                        'rejected' => 'bg-danger',
                        default    => 'bg-warning text-dark',
                    };
                @endphp
                <span class="badge {{ $adminBadge }} px-3  rounded-pill shadow-sm">
                    {{ strtoupper($booking->admin_status) }}
                </span>
            </td>

            {{-- Kolom Status Utama Sistem --}}
            <td class="text-center">
                @php
                    $statusClass = match($booking->status) {
                        'active'    => 'bg-success',
                        'pending'   => 'bg-warning text-dark',
                        'rejected'  => 'bg-danger',
                        'expired'   => 'bg-secondary',
                        'finished'  => 'bg-info text-dark',
                        'cancelled' => 'bg-dark',
                        default     => 'bg-light text-dark',
                    };
                @endphp
                <span class="badge {{ $statusClass }} px-3 py-2 shadow-sm">
                    @if($booking->status == 'pending') 
                        <i class="bi bi-hourglass-split me-1"></i> 
                    @elseif($booking->status == 'active') 
                        <i class="bi bi-check-circle me-1"></i> 
                    @endif
                    {{ strtoupper($booking->status) }}
                </span>
            </td>

            {{-- Kolom Aksi Verifikasi Staff --}}
            <td class="text-center align-middle">
                @if($booking->staff_status == 'pending' && $booking->status == 'pending')
                    <div class="d-flex justify-content-center gap-1">
                        
                        {{-- Tombol Verifikasi (Hanya Ikon) --}}
                        <form action="{{ route('staff.bookings.approve', $booking->id) }}" method="POST" class="m-0" onsubmit="return confirm('Verifikasi peminjaman ini?')">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success shadow-sm" title="Verifikasi">
                                <i class="bi bi-check-lg"></i>
                            </button>
                        </form>

                        {{-- Tombol Tolak (Hanya Ikon) --}}
                        <button type="button" class="btn btn-sm btn-danger shadow-sm btn-decline" 
                                data-bs-toggle="modal" 
                                data-bs-target="#declineModal" 
                                data-url="{{ route('staff.bookings.reject', $booking->id) }}"
                                title="Tolak">
                            <i class="bi bi-x-lg"></i>
                        </button>
                        
                    </div>
                @else
                    <span class="badge bg-light text-muted border shadow-sm px-3 py-2">
                        <i class="bi bi-lock-fill me-1"></i> Diproses
                    </span>
                @endif
            </td>
            
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center py-5 text-muted">
                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                Belum ada data peminjaman.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>