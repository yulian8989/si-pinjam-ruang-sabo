<section id="rooms" class="py-5">
    <div class="container py-5">
        <h2 class="text-center fw-bold mb-5">Katalog Ruangan</h2>
        <div class="row g-4">
            @foreach($featuredRooms as $room)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm card-room">
                    <a href="{{ route('room.detail', $room->id) }}">
                        @if($room->images && count($room->images) > 0)
                            <img src="{{ asset('storage/' . $room->images[0]) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $room->name }}">
                        @endif
                    </a>
            
                    <div class="card-body">
                        <h5 class="card-title fw-bold">
                            <a href="{{ route('room.detail', $room->id) }}" class="text-decoration-none text-primary">
                                {{ $room->name }}
                            </a>
                        </h5>
                        
                        <p class="card-text text-muted small">{{ Str::limit($room->description, 100) }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="badge bg-primary-subtle text-primary border border-primary px-3 rounded-pill">
                                Kapasitas: {{ $room->capacity }}
                            </span>
                            <span class="badge bg-warning text-dark px-3 rounded-pill d-flex align-items-center">
                                <i class="bi bi-star-fill me-1"></i> 
                                {{ number_format($room->reviews->avg('rating') ?? 0, 1) }}
                            </span>
                            
                            <a href="{{ route('room.detail', $room->id) }}" class="btn btn-sm btn-outline-primary px-3 fw-bold">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>