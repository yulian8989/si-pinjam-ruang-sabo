<table class="table table-hover align-middle mb-0">
    <thead class="table-dark">
        <tr>
            <th>User / Peminjam</th>
            <th>Ruangan</th>
            <th>Waktu</th>
            <th class="text-center">Berkas</th>
            <th class="text-center">Status Staff</th>
            <th class="text-center">Status Admin</th>
            <th class="text-center">Status Utama</th> 
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr class="{{ $booking->status == 'expired' ? 'table-secondary opacity-75' : '' }}">
            <td>
                <strong>{{ $booking->user->name }}</strong><br>
                <small class="text-muted italic">{{ $booking->purpose }}</small>
            </td>
            <td>
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3">
                    {{ $booking->room->name }}
                </span>
            </td>
            <td>
                <div class="small fw-bold">{{ \Carbon\Carbon::parse($booking->start_time)->format('d M Y') }}</div>
                <div class="small text-muted">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</div>
            </td>
            
            <td class="text-center">
                @if($booking->attachment)
                    <a href="{{ asset('storage/' . $booking->attachment) }}" target="_blank" class="btn btn-sm btn-info text-white rounded-pill shadow-sm">
                        <i class="bi bi-file-earmark-pdf"></i> Lihat
                    </a>
                @else
                    <span class="text-muted small">Tanpa Berkas</span>
                @endif
            </td>

            {{-- Status Staff --}}
            <td class="text-center">
                @php
                    $staffClass = [
                        'approved' => 'bg-success',
                        'rejected' => 'bg-danger',
                        'expired'  => 'bg-secondary',
                        'pending'  => 'bg-warning text-dark'
                    ][$booking->staff_status] ?? 'bg-light';
                @endphp
                <span class="badge {{ $staffClass }}  px-3  rounded-pill shadow-sm">{{ ucfirst($booking->staff_status) }}</span>
            </td>

            {{-- Status Admin --}}
            <td class="text-center">
                @php
                    $adminClass = [
                        'approved' => 'bg-success',
                        'rejected' => 'bg-danger',
                        'expired'  => 'bg-secondary',
                        'pending'  => 'bg-warning text-dark'
                    ][$booking->admin_status] ?? 'bg-light';
                @endphp
                <span class="badge {{ $adminClass }} px-3  rounded-pill shadow-sm">{{ ucfirst($booking->admin_status) }}</span>
            </td>

            {{-- Status Utama --}}
            <td class="text-center">
                @php
                    $mainStatusClass = [
                        'pending'   => 'bg-warning text-dark',
                        'active'    => 'bg-primary',
                        'finished'  => 'bg-success',
                        'expired'   => 'bg-secondary',
                        'rejected'  => 'bg-danger',
                        'cancelled' => 'bg-dark'
                    ][$booking->status] ?? 'bg-light';
                @endphp
                <span class="badge px-3 py-2 {{ $mainStatusClass }} shadow-sm">
                    {{ strtoupper($booking->status) }}
                </span>
            </td>

            <td class="text-center align-middle">
                @php
                    // Cek apakah status terkunci atau waktu terlewat
                    $isLockedStatus = in_array($booking->status, ['finished', 'expired']);
                    $isTimePassed = \Carbon\Carbon::parse($booking->end_time)->isPast();
                    $isLocked = $isLockedStatus || $isTimePassed;
                @endphp
            
                @if($isLocked)
                    {{-- 1. Tampilkan Terkunci / Selesai --}}
                    <span class="badge bg-light text-muted border shadow-sm px-3 py-2" title="{{ $isTimePassed ? 'Waktu kegiatan sudah terlewat' : 'Data sudah permanen' }}">
                        <i class="bi bi-check2-circle me-1"></i> Selesai
                    </span>
                @else

                    @if($booking->admin_status == 'pending' && $booking->status == 'pending')
                        
                        <div class="d-flex justify-content-center gap-1">
                            {{-- Tombol Approve --}}
                            <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" onsubmit="return confirm('Setujui pengajuan peminjaman ini?')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success shadow-sm" title="Setujui">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>
            
                            {{-- Tombol Reject (Memicu Modal) --}}
                            <button type="button" class="btn btn-sm btn-danger shadow-sm btn-decline" 
                                    data-url="{{ route('admin.bookings.reject', $booking->id) }}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#declineModal" 
                                    title="Tolak">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        
                    @else
                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-primary shadow-sm" title="Edit Keputusan">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>
                    @endif
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>