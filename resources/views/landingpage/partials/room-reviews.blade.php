<div class="card shadow-sm border-0 mt-4">
    <div class="card-header bg-white border-bottom pt-3 pb-2">
        <h6 class="card-title fw-bold mb-0">
            <i class="bi bi-chat-quote text-primary me-2"></i>Ulasan Peminjam
        </h6>
    </div>
    
    {{-- max-height mengatur agar kotak tidak memanjang ke bawah jika ulasan ratusan --}}
    <div class="card-body p-0" style="max-height: 350px; overflow-y: auto;">
        <ul class="list-group list-group-flush">
            @forelse($room->reviews as $review)
            <li class="list-group-item p-3 bg-light-subtle">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    
                    {{-- Sisi Kiri: Nama & Waktu --}}
                    <div>
                        <span class="fw-bold text-dark d-block" style="font-size: 0.9rem;">
                            {{ $review->user->name ?? 'Pengguna Terhapus' }}
                        </span>
                        {{-- Keterangan Waktu Ditambahkan di Sini --}}
                        <span class="text-muted" style="font-size: 0.75rem;">
                            <i class="bi bi-clock me-1"></i>{{ $review->created_at->translatedFormat('d F Y, H:i') }} WIB
                        </span>
                    </div>

                    {{-- Sisi Kanan: Bintang Rating --}}
                    <div class="text-warning" style="font-size: 0.85rem;">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                        @endfor
                    </div>

                </div>
                
                {{-- Komentar --}}
                <p class="text-muted small mb-0 fst-italic">"{{ $review->comment }}"</p>
            </li>
            @empty
            <li class="list-group-item p-4 text-center text-muted small">
                <i class="bi bi-chat-square-text fs-3 d-block mb-2 opacity-50"></i>
                Belum ada ulasan untuk ruangan ini.
            </li>
            @endforelse
        </ul>
    </div>
</div>