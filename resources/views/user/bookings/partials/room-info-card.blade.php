<div class="col-md-4">
    <div class="card border-0 overflow-hidden mb-4">
        
        {{-- Area Carousel --}}
        <div id="roomImagesCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @if($room->images && count($room->images) > 0)
                    @foreach($room->images as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            {{-- BUNGKUSAN LIGHTBOX DIMULAI DI SINI --}}
                            <a data-fslightbox="gallery-booking-{{ $room->id }}" href="{{ asset('storage/' . $image) }}">
                                <img src="{{ asset('storage/' . $image) }}" class="d-block w-100" style="height: 250px; object-fit: cover; cursor: zoom-in;" alt="Foto Ruangan">
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="carousel-item active bg-light text-center d-flex align-items-center justify-content-center" style="height: 250px;">
                        <i class="bi bi-image text-muted fs-1"></i>
                    </div>
                @endif
            </div>
            
            {{-- Navigasi Carousel --}}
            @if($room->images && count($room->images) > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#roomImagesCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon shadow-sm" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#roomImagesCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon shadow-sm" aria-hidden="true"></span>
                </button>
            @endif
        </div>

        {{-- Area Informasi Ruangan --}}
     <div class="card-body p-4">
            <h4 class="fw-bold text-primary mb-2">{{ $room->name }}</h4>
            <p class="text-muted mb-3"><i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $room->description }}</p>
            
            {{-- Tambahkan gap-2 di sini untuk memberi jarak antar badge --}}
            <div class="d-flex align-items-center gap-2 mb-4">
                <span class="badge bg-info-subtle text-info border border-info px-3 py-2 rounded-pill fs-6">
                    <i class="bi bi-people-fill me-1"></i> Kapasitas: {{ $room->capacity }} Orang
                </span>
                
                {{-- Badge Rating Baru --}}
                <span class="badge bg-warning text-dark border border-warning px-3 py-1.5 rounded-pill fs-6 shadow-sm">
                    <i class="bi bi-star-fill text-dark me-1"></i> 
                    {{ number_format($room->reviews->avg('rating') ?? 0, 1) }}
                </span>
            </div>

            <hr class="text-secondary opacity-25 mb-4">

            <h6 class="fw-bold mb-3"><i class="bi bi-box-seam me-2 text-warning"></i>Fasilitas Tersedia:</h6>
            <div class="row g-2">
                @forelse($room->facilities as $facility)
                    <div class="col-6">
                        <div class="p-2 border rounded bg-light-subtle d-flex align-items-center h-100 shadow-sm">
                            <i class="bi bi-check2-circle text-success me-2"></i>
                            <span class="text-dark small lh-sm">
                                {{ $facility->name }} <strong class="text-primary">({{ $facility->pivot->quantity }})</strong>
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light border text-muted small text-center mb-0">
                            Tidak ada fasilitas terdaftar.
                        </div>
                    </div>
                @endforelse
            </div>
            
        </div>
        
    </div>
    @include('user.bookings.partials.upcoming-bookings')
</div>