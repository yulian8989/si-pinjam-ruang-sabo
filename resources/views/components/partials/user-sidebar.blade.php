@if($role == 'user')
<li class="nav-header {{ $accentColor }} fw-bold text-uppercase">Menu Peminjam</li>

<li class="nav-item">
    <a href="{{ route('user.rooms.index') }}" class="nav-link {{ request()->routeIs('user.rooms.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-calendar-plus"></i>
        <p>Pinjam Ruangan</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('user.bookings.index') }}" class="nav-link {{ request()->routeIs('user.bookings.index') ? 'active' : '' }}">
        <i class="nav-icon bi bi-file-earmark-person"></i>
        <p>Status Peminjaman</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('user.history.index') }}" class="nav-link {{ request()->routeIs('user.history.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-clock-history"></i>
        <p>Riwayat</p>
    </a>
</li>
@endif