<div class="card-body d-flex flex-column">
    <h5 class="card-title fw-bold text-primary">{{ $room->name }}</h5>
    <p class="card-text text-muted small mt-2">
        <i class="bi bi-geo-alt me-1"></i> {{ Str::limit($room->description, 80) }}
    </p>
    
    <div class="mt-auto">
        <hr>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="badge bg-info text-dark">
                <i class="bi bi-people me-1"></i> Kapasitas: {{ $room->capacity }}
            </span>
            <span class="badge bg-warning text-dark shadow-sm">
                <i class="bi bi-star-fill text-dark me-1"></i> 
                {{ number_format($room->reviews->avg('rating') ?? 0, 1) }}
            </span>
        </div>
        
        <p class="small mb-2"><strong>Fasilitas:</strong></p>
        <div class="d-flex flex-wrap gap-1 mb-3">
            @foreach($room->facilities as $facility)
                <span class="badge border text-dark bg-light shadow-sm" style="font-size: 0.75rem;">
                    {{ $facility->name }} ({{ $facility->pivot->quantity }})
                </span>
            @endforeach
        </div>

        <a href="{{ route('user.bookings.create', ['room_id' => $room->id]) }}" class="btn btn-primary w-100">
            <i class="bi bi-calendar-plus me-1"></i> Pinjam Sekarang
        </a>
    </div>
</div>