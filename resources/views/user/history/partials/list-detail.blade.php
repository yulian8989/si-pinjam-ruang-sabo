                            {{-- RUANGAN --}}
                            <li class="list-group-item p-4">
                                <div class="row">
                                    <div class="col-sm-4  fw-bold small text-uppercase mb-2 mb-sm-0"><i class="bi bi-door-open me-2"></i>Ruangan</div>
                                    <div class="col-sm-8 fw-medium fs-6">{{ $booking->room->name ?? 'Ruangan Tidak Ditemukan/Terhapus' }}</div>
                                </div>
                            </li>

                            {{-- KEPERLUAN KEGIATAN (BARU DITAMBAHKAN) --}}
                            <li class="list-group-item p-4 bg-light-subtle">
                                <div class="row align-items-center">
                                    <div class="col-sm-4  fw-bold small text-uppercase mb-2 mb-sm-0"><i class="bi bi-info-circle me-2"></i>Keperluan</div>
                                    <div class="col-sm-8 fw-medium fs-6">
                                        {{ $booking->purpose ?? '-' }}
                                    </div>
                                </div>
                            </li>

                            {{-- TANGGAL PELAKSANAAN --}}
                            <li class="list-group-item p-4">
                                <div class="row">
                                    <div class="col-sm-4 fw-bold small text-uppercase mb-2 mb-sm-0"><i class="bi bi-calendar-event me-2"></i>Tanggal Pelaksanaan</div>
                                    <div class="col-sm-8 fw-medium fs-6">
                                        {{ \Carbon\Carbon::parse($booking->start_time)->translatedFormat('l, d F Y') }}<br>
                                        <span class="text-primary"><i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }} WIB</span>
                                    </div>
                                </div>
                            </li>

                            {{-- BERKAS SURAT --}}
                            <li class="list-group-item p-4 bg-light-subtle">
                                <div class="row align-items-center">
                                    <div class="col-sm-4  fw-bold small text-uppercase mb-2 mb-sm-0"><i class="bi bi-file-earmark-pdf me-2"></i>Berkas Surat</div>
                                    <div class="col-sm-8">
                                        @if($booking->attachment)
                                            <a href="{{ asset('storage/' . $booking->attachment) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                <i class="bi bi-eye me-1"></i> Lihat Berkas
                                            </a>
                                        @else
                                            <span class=" fst-italic">Tidak ada berkas terlampir</span>
                                        @endif
                                    </div>
                                </div>
                            </li>

                            {{-- STATUS PERSETUJUAN --}}
                            <li class="list-group-item p-4">
                                <div class="row">
                                    <div class="col-sm-4  fw-bold small text-uppercase mb-2 mb-sm-0"><i class="bi bi-clipboard-check me-2"></i>Status Persetujuan</div>
                                    <div class="col-sm-8">
                                        <div class="d-flex gap-3">
                                            <div>
                                                <small class=" d-block mb-1">Staff:</small>
                                                <span class="badge {{ $booking->staff_status == 'approved' ? 'bg-success' : ($booking->staff_status == 'rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                                    {{ ucfirst($booking->staff_status) }}
                                                </span>
                                            </div>
                                            <div>
                                                <small class=" d-block mb-1">Administrator:</small>
                                                <span class="badge {{ $booking->admin_status == 'approved' ? 'bg-success' : ($booking->admin_status == 'rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                                    {{ ucfirst($booking->admin_status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            {{-- ALASAN PENOLAKAN (Jika Ada) --}}
                            @if($booking->status == 'rejected' && $booking->reject_reason)
                            <li class="list-group-item p-4 border-danger border-start border-5 bg-danger-subtle">
                                <div class="row align-items-center">
                                    <div class="col-sm-4 text-danger fw-bold small text-uppercase mb-2 mb-sm-0"><i class="bi bi-exclamation-triangle me-2"></i>Alasan Penolakan</div>
                                    <div class="col-sm-8 fw-medium fs-6 text-danger">
                                        {{ $booking->reject_reason }}
                                    </div>
                                </div>
                            </li>
                            @endif

                            {{-- KOMENTAR & ULASAN (Jika Sudah Dinilai) --}}
                            @if($booking->review)
                            <li class="list-group-item p-4 border-warning border-start border-5 bg-warning-subtle">
                                <div class="row">
                                    <div class="col-sm-4 text-warning-emphasis fw-bold small text-uppercase mb-2 mb-sm-0">
                                        <i class="bi bi-star-half me-2"></i>Ulasan Anda
                                    </div>
                                    <div class="col-sm-8">
                                        {{-- Bintang Rating --}}
                                        <div class="text-warning mb-2 fs-5">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= $booking->review->rating ? '-fill' : '' }}"></i>
                                            @endfor
                                            <span class="text-dark fs-6 fw-bold ms-2">({{ $booking->review->rating }} / 5)</span>
                                        </div>
                                        
                                        {{-- Komentar (Review) --}}
                                        <div class="bg-white p-3 rounded border shadow-sm mt-2">
                                            <p class="mb-0 fst-italic text-secondary">
                                                "{{ $booking->review->comment }}"
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif