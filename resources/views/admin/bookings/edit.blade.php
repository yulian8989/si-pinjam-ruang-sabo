@extends('layouts.master')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2 text-primary"></i>Verifikasi & Edit Peminjaman</h3>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        
        @if ($errors->any())
            <div class="alert alert-danger shadow-sm alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <strong>Gagal menyimpan!</strong> Terdapat kesalahan input:
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            
            {{-- Panggil Komponen Bagian Kiri (Info Ruangan & Peminjam) --}}
            <div class="col-lg-5">
                @include('admin.bookings.partials.booking-info-card')
            </div>

            {{-- Panggil Komponen Bagian Kanan (Form Verifikasi & Status) --}}
            <div class="col-lg-7">
                @include('admin.bookings.partials.verification-panel')
            </div>

        </div>
    </div>
</div>
{{-- ==========================================
         JAVASCRIPT LOGIKA STATUS VERIFIKASI
         ========================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reasonContainer = document.getElementById('reject_reason_container');
            
            const staffRadios = document.querySelectorAll('input[name="staff_status"]');
            const adminRadios = document.querySelectorAll('input[name="admin_status"]');
            const statusRadios = document.querySelectorAll('input[name="status"]');

            // 1. Fungsi untuk mengecek dan menampilkan text area alasan penolakan
            function checkRejectionState() {
                const selectedStatus = document.querySelector('input[name="status"]:checked');
                
                // Text area hanya muncul jika Status Utama adalah REJECTED
                if (selectedStatus && selectedStatus.value === 'rejected') {
                    reasonContainer.style.display = 'block';
                } else {
                    reasonContainer.style.display = 'none';
                }
            }

            // 2. Fungsi cerdas untuk sinkronisasi Status Utama otomatis
            function syncMainStatus() {
                const staffVal = document.querySelector('input[name="staff_status"]:checked')?.value;
                const adminVal = document.querySelector('input[name="admin_status"]:checked')?.value;

                // Logika A: Jika SAH SATU menolak, kegiatan langsung batal (REJECTED)
                if (staffVal === 'rejected' || adminVal === 'rejected') {
                    document.getElementById('status_rejected').checked = true;
                } 
                // Logika B: Jika KEDUANYA setuju, kegiatan siap jalan (ACTIVE)
                else if (staffVal === 'approved' && adminVal === 'approved') {
                    document.getElementById('status_active').checked = true;
                } 
                // Logika C: Jika tidak ada yang menolak, tapi belum dua-duanya setuju (PENDING)
                else if (staffVal === 'pending' || adminVal === 'pending') {
                    document.getElementById('status_pending').checked = true;
                }

                // Selalu cek apakah text area perlu dimunculkan setelah status berubah
                checkRejectionState();
            }

            // Pasang "pendengar" ke setiap tombol Staff dan Admin
            staffRadios.forEach(radio => radio.addEventListener('change', syncMainStatus));
            adminRadios.forEach(radio => radio.addEventListener('change', syncMainStatus));

            // Pasang pendengar manual jika Admin iseng mengklik Status Utama langsung
            statusRadios.forEach(radio => {
                radio.addEventListener('change', checkRejectionState);
            });

            // Jalankan satu kali saat halaman pertama kali dibuka
            checkRejectionState();
        });
    </script>
@endsection