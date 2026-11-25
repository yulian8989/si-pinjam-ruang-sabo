<div class="col-md-8">
    <div class="card shadow border-0">
        <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-bold text-dark">Lengkapi Data Peminjaman</h5>
        </div>

        <form action="{{ route('user.bookings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-12 mb-3">
                        <label class="form-label fw-semibold">Tanggal Peminjaman</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-calendar3"></i></span>
                            <input type="text" name="booking_date" id="datepicker"
                                   class="form-control @error('booking_date') is-invalid @enderror" 
                                   placeholder="Pilih Tanggal" required>
                        </div>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jam Mulai</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-clock"></i></span>
                                <input type="text" name="start_time" id="start_time"
                                       class="form-control timepicker @error('start_time') is-invalid @enderror" 
                                       placeholder="00:00" required>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jam Selesai</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-clock-history"></i></span>
                                <input type="text" name="end_time" id="end_time"
                                       class="form-control timepicker @error('end_time') is-invalid @enderror" 
                                       placeholder="00:00" required>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Tujuan / Keperluan Kegiatan</label>
                        <textarea name="purpose" class="form-control @error('purpose') is-invalid @enderror" 
                                  rows="5" placeholder="Masukkan tujuan atau keperluan kegiatan" required>{{ old('purpose') }}</textarea> @error('purpose')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Unggah Berkas Pendukung</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-file-earmark-arrow-up"></i></span>
                            <input type="file" name="attachment" class="form-control @error('attachment') is-invalid @enderror" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white border-top p-4 text-end">
                <a href="{{ route('user.rooms.index') }}" class="btn btn-outline-secondary px-4 me-2">Kembali ke Katalog</a>
                <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">Kirim Permohonan Pinjam</button>
            </div>
        </form>
    </div>
</div>