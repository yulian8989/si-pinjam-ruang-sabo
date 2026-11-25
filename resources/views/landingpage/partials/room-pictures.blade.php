<div class="container mb-5">
    <div class="row g-4">
        
        {{-- Tombol Kembali dibungkus col-12 agar grid Bootstrap rapi --}}
        <div class="col-12 mb-2">
            <a href="{{ route('landing') }}" class="text-decoration-none fw-bold text-secondary transition-hover">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
            </a>
        </div>

        {{-- Sisi Kiri: Carousel Gambar --}}
        <div class="col-md-7">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @if($room->images && count($room->images) > 0)
                            @foreach($room->images as $index => $image)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    {{-- Lightbox dilepas, hanya menyisakan tag img murni --}}
                                    <img src="{{ asset('storage/' . $image) }}" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="Foto Ruangan {{ $room->name }}">
                                </div>
                            @endforeach
                        @else
                            <div class="carousel-item active bg-light text-secondary text-center d-flex flex-column justify-content-center" style="height: 450px;">
                                <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                                <span class="mt-2 fw-medium">Tidak ada foto tersedia</span>
                            </div>
                        @endif
                    </div>
                    
                    {{-- Navigasi Carousel --}}
                    @if($room->images && count($room->images) > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon shadow-sm" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon shadow-sm" aria-hidden="true"></span>
                        </button>
                    @endif
                </div>
            </div>
            @include('landingpage.partials.room-reviews')
        </div>

        @include('landingpage.partials.detail')

    </div>
</div>