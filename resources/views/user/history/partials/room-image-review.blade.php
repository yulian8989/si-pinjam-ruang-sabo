<div class="col-md-5 bg-light">
    <div id="reviewCarousel" class="carousel slide h-100" data-bs-ride="carousel">
        <div class="carousel-inner h-100">
            @foreach($booking->room->images as $index => $image)
                <div class="carousel-item h-100 {{ $index == 0 ? 'active' : '' }}">
                    {{-- Mengatur tinggi 100% agar mengikuti tinggi form di kanan --}}
                    <img src="{{ asset('storage/' . $image) }}" 
                         class="d-block w-100 h-100" 
                         style="object-fit: cover; min-height: 400px;">
                </div>
            @endforeach
        </div>
        {{-- Tambahkan navigasi jika gambar lebih dari satu --}}
        @if(count($booking->room->images) > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        @endif
    </div>
</div>