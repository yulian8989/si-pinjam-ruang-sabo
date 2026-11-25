<div id="carousel-{{ $room->id }}" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @if($room->images && count($room->images) > 0)
            @foreach($room->images as $index => $image)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $image) }}" class="d-block w-100" style="height: 200px; object-fit: cover; border-radius: 8px 8px 0 0;">
                </div>
            @endforeach
        @else
            <div class="carousel-item active text-center bg-light" style="height: 200px; line-height: 200px;">
                <span class="text-muted">Tidak ada foto</span>
            </div>
        @endif
    </div>
    @if($room->images && count($room->images) > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $room->id }}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $room->id }}" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    @endif
</div>