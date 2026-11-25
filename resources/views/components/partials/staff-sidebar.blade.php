@if($role == 'staff')
<li class="nav-header {{ $accentColor }} fw-bold">STAFF OPERASIONAL</li>

<li class="nav-item">
    <a href="{{ route('staff.facilities.index') }}" class="nav-link {{ request()->routeIs('staff.facilities.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-tools"></i>
        <p>Data Fasilitas</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('staff.rooms.index') }}" class="nav-link {{ request()->routeIs('staff.rooms.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-door-open"></i>
        <p>Data Ruangan</p>
    </a>
</li>

{{-- Hitung Notifikasi Staff --}}
@php
    $pendingStaffCount = \App\Models\Booking::where('staff_status', 'pending')
                                            ->where('status', 'pending')
                                            ->count();
@endphp

<li class="nav-item">
    <a href="{{ route('staff.bookings.index') }}" class="nav-link {{ request()->routeIs('staff.bookings.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-eye"></i>
        <p class="d-flex align-items-center justify-content-between w-100 mb-0">
            <span>Perlu Persetujuan</span>
            @if($pendingStaffCount > 0)
                <span class="badge bg-danger rounded-pill shadow-sm">{{ $pendingStaffCount }}</span>
            @endif
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('staff.reviews.index') }}" class="nav-link {{ request()->routeIs('staff.reviews.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-star"></i>
        <p>Ulasan & Rating</p>
    </a>
</li>
@endif