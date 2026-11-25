<div class="col-md-7">
    <div class="card-body p-4 p-lg-5">
        <div class="mb-4">
            <h4 class="fw-bold mb-1">Berikan Ulasan</h4>
            <p class="text-muted small">Ruangan: {{ $booking->room->name }}</p>
        </div>

        <form action="{{ route('user.history.review.store') }}" method="POST">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            <input type="hidden" name="room_id" value="{{ $booking->room_id }}">

            <div class="mb-4">
                <label class="form-label fw-bold">Seberapa puas Anda?</label>
                <select name="rating" class="form-select" required>
                    <option value="5">⭐⭐⭐⭐⭐ (Sangat Puas)</option>
                    <option value="4">⭐⭐⭐⭐ (Puas)</option>
                    <option value="3" selected>⭐⭐⭐ (Biasa Saja)</option>
                    <option value="2">⭐⭐ (Kurang)</option>
                    <option value="1">⭐ (Buruk)</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Komentar / Kesan</label>
                <textarea name="comment" class="form-control" rows="5" 
                          placeholder="Apa yang Anda suka dari ruangan ini?" required></textarea>
            </div>

            <div class="row g-2">
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2">
                        <i class="bi bi-send me-2"></i>Kirim Ulasan
                    </button>
                </div>
                <div class="col-sm-4">
                    <a href="{{ route('user.history.index') }}" class="btn btn-light w-100 py-2">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>