<div class="modal fade" id="noteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="bi bi-exclamation-circle me-2"></i>Alasan Penolakan Admin</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <p id="noteContent" class="fs-5 text-dark"></p>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    function showNote(note) {
        document.getElementById('noteContent').innerText = note ? note : "Tidak ada catatan tambahan.";
        var myModal = new bootstrap.Modal(document.getElementById('noteModal'));
        myModal.show();
    }
</script>
@endpush