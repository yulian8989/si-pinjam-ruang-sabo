<div class="col-md-5">
    <div class="card border-0 shadow-sm h-100 p-4">
        <h2 class="fw-bold text-dark">{{ $room->name }}</h2>
        <p class="text-muted">{{ Str::limit($room->description, 80) }}</p>
        <hr>
        
        <div class="mb-4">
            <h6 class="fw-bold text-secondary">Kapasitas</h6>
            <span class="badge bg-primary-subtle text-primary border border-primary px-3 py-2 rounded-pill fs-6">
                <i class="bi bi-people-fill me-2"></i> {{ $room->capacity }} Orang
            </span>
        </div>

        <div class="mb-4">
            <h6 class="fw-bold text-secondary">Fasilitas Tersedia</h6>
            <div class="d-flex flex-wrap gap-2">
                @forelse($room->facilities as $facility)
                    <span class="badge bg-white text-dark border p-2 shadow-xs">
                        <i class="bi bi-check-circle-fill text-success me-1"></i> 
                        {{ $facility->name }} ({{ $facility->pivot->quantity }})
                    </span>
                @empty
                    <small class="text-muted italic">Fasilitas tidak terdaftar.</small>
                @endforelse
            </div>
        </div>

        <div class="mt-auto">
            <p class="small text-muted mb-3">
                <i class="bi bi-info-circle me-1"></i> 
                Anda harus masuk ke sistem untuk melakukan pengajuan peminjaman.
            </p>
            @auth
                <a href="{{ route('user.bookings.create', ['room_id' => $room->id]) }}" class="btn btn-primary btn-lg w-100 fw-bold">
                    Ajukan Peminjaman Sekarang
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg w-100 fw-bold mb-2">
                    Login untuk Meminjam
                </a>
                <a href="{{ route('register') }}" class="btn btn-link w-100 text-decoration-none small">
                    Belum punya akun? Daftar di sini
                </a>
            @endauth
        </div>
    </div>
</div>