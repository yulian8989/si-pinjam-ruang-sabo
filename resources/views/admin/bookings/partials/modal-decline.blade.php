<div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="declineModalLabel"><i class="bi bi-exclamation-octagon me-2"></i>Alasan Penolakan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- Form tidak perlu action kosong, biarkan kosong --}}
            <form id="declineForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="notes" class="form-label fw-semibold">Catatan / Alasan Penolakan</label>
                        {{-- UBAH name="notes" dan id="notes" --}}
                        <textarea name="notes" id="notes" class="form-control" rows="4" placeholder="Contoh: Jadwal bentrok dengan acara internal balai..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger px-4 fw-bold">Tolak Peminjaman</button>
                </div>
            </form>
        </div>
    </div>
</div>