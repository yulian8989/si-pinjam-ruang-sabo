@if($role == 'admin')
<li class="nav-header {{ $accentColor }} fw-bold">ADMINISTRATOR</li>

{{-- Hitung Notifikasi Admin (Misal: staff sudah setuju, admin belum) --}}
@php
    // Menghitung semua peminjaman yang masih pending di sisi Admin
    $pendingBookingCount = \App\Models\Booking::where('admin_status', 'pending')
                                              ->where('status', 'pending') // <-- INI KUNCI UTAMANYA
                                              ->count();
    
    // PERBAIKAN: Hitung user yang rolenya 'user' dan is_active-nya masih false (0)
    $unverifiedCount = \App\Models\User::where('role', 'user')
                                       ->where('is_active', false) 
                                       ->count(); 
@endphp

<li class="nav-item">
    <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-file-earmark-check"></i>
        <p class="d-flex align-items-center justify-content-between w-100 mb-0">
            <span>Manajemen Pinjam</span>
            @if($pendingBookingCount > 0)
                <span class="badge bg-warning text-dark rounded-pill shadow-sm">{{ $pendingBookingCount }}</span>
            @endif
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-people"></i>
        <p class="d-flex align-items-center justify-content-between w-100 mb-0">
            <span>Manajemen User</span>
            @if($unverifiedCount > 0)
                <span class="badge bg-danger rounded-pill">{{ $unverifiedCount }}</span>
            @endif
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.reviews.index') }}" class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-star"></i>
        <p>Ulasan & Rating</p>
    </a>
</li>
@endif