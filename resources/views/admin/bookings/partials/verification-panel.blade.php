{{-- ==========================================
     FORM VERIFIKASI / EDIT STATUS
     ========================================== --}}
     <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom pt-3 pb-2">
            <h6 class="card-title fw-bold mb-0 text-dark"><i class="bi bi-shield-check me-2 text-success"></i>Panel Verifikasi Admin</h6>
        </div>
        
        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="card-body p-4">
                
                <div class="row g-4 mb-4">
                    {{-- Persetujuan Staff --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-muted small text-uppercase mb-2">Persetujuan Staff</label>
                        <div class="d-flex flex-wrap gap-2">
                            <input type="radio" class="btn-check" name="staff_status" id="staff_pending" value="pending" {{ $booking->staff_status == 'pending' ? 'checked' : '' }}>
                            <label class="btn btn-outline-warning shadow-sm" for="staff_pending"><i class="bi bi-hourglass-split me-1"></i> Pending</label>
    
                            <input type="radio" class="btn-check" name="staff_status" id="staff_approved" value="approved" {{ $booking->staff_status == 'approved' ? 'checked' : '' }}>
                            <label class="btn btn-outline-success shadow-sm" for="staff_approved"><i class="bi bi-check-circle me-1"></i> Approved</label>
    
                            <input type="radio" class="btn-check" name="staff_status" id="staff_rejected" value="rejected" {{ $booking->staff_status == 'rejected' ? 'checked' : '' }}>
                            <label class="btn btn-outline-danger shadow-sm" for="staff_rejected"><i class="bi bi-x-circle me-1"></i> Rejected</label>
                        </div>
                    </div>
    
                    {{-- Persetujuan Admin --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-muted small text-uppercase mb-2">Persetujuan Admin</label>
                        <div class="d-flex flex-wrap gap-2">
                            <input type="radio" class="btn-check" name="admin_status" id="admin_pending" value="pending" {{ $booking->admin_status == 'pending' ? 'checked' : '' }}>
                            <label class="btn btn-outline-warning shadow-sm" for="admin_pending"><i class="bi bi-hourglass-split me-1"></i> Pending</label>
    
                            <input type="radio" class="btn-check" name="admin_status" id="admin_approved" value="approved" {{ $booking->admin_status == 'approved' ? 'checked' : '' }}>
                            <label class="btn btn-outline-success shadow-sm" for="admin_approved"><i class="bi bi-check-circle me-1"></i> Approved</label>
    
                            <input type="radio" class="btn-check" name="admin_status" id="admin_rejected" value="rejected" {{ $booking->admin_status == 'rejected' ? 'checked' : '' }}>
                            <label class="btn btn-outline-danger shadow-sm" for="admin_rejected"><i class="bi bi-x-circle me-1"></i> Rejected</label>
                        </div>
                    </div>
                </div>
    
                <hr class="text-muted my-4">
    
                <div class="mb-4">
                    <label class="form-label fw-bold text-muted small text-uppercase mb-3">Status Kegiatan</label>
                    
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6">
                            <input type="radio" class="btn-check status-radio" name="status" id="status_pending" value="pending" {{ $booking->status == 'pending' ? 'checked' : '' }}>
                            <label class="btn btn-outline-warning w-100 text-start p-3 h-80 shadow-sm" for="status_pending">
                                <div class="fw-bold"><i class="bi bi-hourglass-top me-2"></i>PENDING</div>
                            </label>
                        </div>
    
                        <div class="col-md-4 col-sm-6">
                            <input type="radio" class="btn-check status-radio" name="status" id="status_active" value="active" {{ $booking->status == 'active' ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary w-100 text-start p-3 h-100 shadow-sm" for="status_active">
                                <div class="fw-bold"><i class="bi bi-play-circle me-2"></i>ACTIVE</div>
                            </label>
                        </div>
    
                        <div class="col-md-4 col-sm-6">
                            <input type="radio" class="btn-check status-radio" name="status" id="status_finished" value="finished" {{ $booking->status == 'finished' ? 'checked' : '' }}>
                            <label class="btn btn-outline-success w-100 text-start p-3 h-100 shadow-sm" for="status_finished">
                                <div class="fw-bold"><i class="bi bi-check2-all me-2"></i>FINISHED</div>
                            </label>
                        </div>
    
                        <div class="col-md-4 col-sm-6">
                            <input type="radio" class="btn-check status-radio" name="status" id="status_rejected" value="rejected" {{ $booking->status == 'rejected' ? 'checked' : '' }}>
                            <label class="btn btn-outline-danger w-100 text-start p-3 h-100 shadow-sm" for="status_rejected">
                                <div class="fw-bold"><i class="bi bi-x-octagon me-2"></i>REJECTED</div>
                            </label>
                        </div>
    
                        <div class="col-md-4 col-sm-6">
                            <input type="radio" class="btn-check status-radio" name="status" id="status_cancelled" value="cancelled" {{ $booking->status == 'cancelled' ? 'checked' : '' }}>
                            <label class="btn btn-outline-dark w-100 text-start p-3 h-100 shadow-sm" for="status_cancelled">
                                <div class="fw-bold"><i class="bi bi-slash-circle me-2"></i>CANCELLED</div>
                            </label>
                        </div>
    
                        <div class="col-md-4 col-sm-6">
                            <input type="radio" class="btn-check status-radio" name="status" id="status_expired" value="expired" {{ $booking->status == 'expired' ? 'checked' : '' }}>
                            <label class="btn btn-outline-secondary w-100 text-start p-3 h-100 shadow-sm" for="status_expired">
                                <div class="fw-bold"><i class="bi bi-clock-history me-2"></i>EXPIRED</div>
                            </label>
                        </div>
                    </div>
                </div>
    
                <div class="mb-3 mt-4" id="reject_reason_container" style="{{ ($booking->status == 'rejected' || $booking->admin_status == 'rejected') ? 'display:block;' : 'display:none;' }}">
                    <label for="notes" class="form-label fw-bold text-danger small text-uppercase"><i class="bi bi-exclamation-circle me-1"></i>Alasan Penolakan</label>
                    
                    <textarea name="notes" id="notes" rows="3" class="form-control border-danger bg-danger-subtle" placeholder="Masukkan alasan mengapa pengajuan ini ditolak...">{{ old('notes', $booking->notes) }}</textarea>
                    
                    <div class="form-text text-danger"><i class="bi bi-arrow-up-short"></i> Wajib diisi karena status diubah menjadi REJECTED.</div>
                </div>
    
            </div>
            
            <div class="card-footer bg-light p-3 text-end">
                <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                    <i class="bi bi-save me-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
    
