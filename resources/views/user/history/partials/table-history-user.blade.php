<table class="table table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>Ruangan</th>
            <th>Jadwal Peminjaman</th>
            <th>Keperluan</th>
            <th>Ulasan</th>
            <th>Rating</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr class="{{ in_array($booking->status, ['expired', 'rejected', 'cancelled']) ? 'opacity-75' : '' }}">
            <td>
                <strong>{{ $booking->room->name }}</strong><br>
                <small class="text-muted"># ID-{{ $booking->id }}</small>
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
                    {{ Str::limit($booking->purpose, 20) }}
                </span>
            </td>
            <td>
                @if($booking->review)
                    <span title="{{ $booking->review->comment }}">
                        {{ Str::limit($booking->review->comment, 20) }}
                    </span>
                @else
                    <span class="text-muted small">-</span>
                @endif
            </td>
            <td>
                @if($booking->review)
                    <div class="text-warning">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star{{ $i <= $booking->review->rating ? '-fill' : '' }}"></i>
                        @endfor
                    </div>
                @else
                    <span class="badge bg-light text-dark border small">Belum ada rating</span>
                @endif
            </td>
            
            {{-- KOLOM AKSI --}}
            <td class="text-center">
                <div class="d-flex justify-content-center align-items-center gap-2">
                    
                    {{-- 1. Tombol Detail --}}
                    <a href="{{ route('user.history.show', $booking->id) }}" class="btn btn-sm btn-info text-white shadow-sm text-nowrap" title="Lihat Detail">
                        <i class="bi bi-eye"></i> Detail
                    </a>
            
                    {{-- 2. Badge Status (Dikembalikan ke desain asli) --}}
                    @if($booking->status == 'finished')
                        @if(!$booking->review)
                            <a href="{{ route('user.history.review', $booking->id) }}" class="btn btn-sm btn-primary shadow-sm text-nowrap" title="Tulis Ulasan">
                                <i class="bi bi-pencil-square"></i> Ulas
                            </a>
                        @else
                            <span class="badge bg-success shadow-sm text-nowrap" style="padding: 7px 10px;">
                                <i class="bi bi-check2-all"></i> Diulas
                            </span>
                        @endif
                        
                    @elseif($booking->status == 'rejected')
                        <button type="button" class="badge bg-danger shadow-sm border-0 text-nowrap" 
                                style="padding: 7px 10px; cursor: pointer; font-size: 0.85em;" 
                                data-note="{{ $booking->notes }}" 
                                onclick="showNote(this.getAttribute('data-note'))" 
                                title="Lihat Alasan Penolakan">
                            <i class="bi bi-x-circle"></i> Alasan
                        </button>

                    @elseif($booking->status == 'cancelled')
                        <span class="badge bg-dark shadow-sm text-nowrap" style="padding: 7px 10px;">CANCELLED</span>
                        
                    @elseif($booking->status == 'expired')
                        <span class="badge bg-secondary shadow-sm text-nowrap" style="padding: 7px 10px;">EXPIRED</span>
                        
                    @elseif($booking->status == 'pending')
                        <span class="badge bg-warning text-dark shadow-sm text-nowrap" style="padding: 7px 10px;">PENDING</span>
                        
                    @elseif($booking->status == 'active')
                        <span class="badge bg-primary shadow-sm text-nowrap" style="padding: 7px 10px;">ACTIVE</span>
                    @endif
                    
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>