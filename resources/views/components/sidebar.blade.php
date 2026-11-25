@php
    $role = 'guest';
    $sidebarClass = 'bg-dark';
    $accentColor = 'text-white';
    $roleLabelColor = 'bg-secondary';

    if (auth()->check()) {
        $role = auth()->user()->role;
        if ($role == 'admin') {
            $sidebarClass = 'bg-danger-subtle';
            $accentColor = 'text-danger';
            $roleLabelColor = 'bg-danger';
        } elseif ($role == 'staff') {
            $sidebarClass = 'bg-success-subtle';
            $accentColor = 'text-success';
            $roleLabelColor = 'bg-success';
        } elseif ($role == 'user') {
            $sidebarClass = 'bg-primary-subtle';
            $accentColor = 'text-primary';
            $roleLabelColor = 'bg-primary';
        }
    }
@endphp

<aside class="app-sidebar {{ $sidebarClass }} shadow" data-bs-theme="light">
    <div class="sidebar-brand border-bottom border-secondary-subtle">
        <a href="{{ url('/') }}" class="brand-link text-decoration-none">
            <span class="brand-text fw-bold {{ $accentColor }}">Pinjam Ruang Sabo</span>
        </a>
    </div>
    
    <div class="sidebar-wrapper d-flex flex-column" style="height: calc(100vh - 60px);">
        {{-- AREA NAVIGASI UTAMA --}}
        <nav class="mt-2 flex-grow-1">
            <ul class="nav sidebar-menu flex-column" role="navigation">
                @auth
                
                {{-- Dashboard (Semua Role) --}}
                <li class="nav-item">
                    <a href="{{ 
                        auth()->user()->role == 'admin' ? route('admin.dashboard') : 
                        (auth()->user()->role == 'staff' ? route('staff.dashboard') : route('user.dashboard')) 
                    }}" 
                    class="nav-link {{ request()->routeIs('*.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- AREA ADMIN --}}
                @include ('components.partials.admin-sidebar')


                {{-- AREA STAFF --}}
                @include ('components.partials.staff-sidebar')

                {{-- AREA USER (PEMINJAM) --}}

                @include ('components.partials.user-sidebar')
                
                @endauth
            </ul>
        </nav>

        {{-- AREA LOGOUT (POSISI DI PALING BAWAH) --}}
        @auth
        <div class="mt-auto border-top border-secondary-subtle p-2">
            <ul class="nav sidebar-menu flex-column">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="nav-link text-danger fw-bold d-flex align-items-center">
                        <i class="nav-icon bi bi-box-arrow-right me-2"></i>
                        <p class="mb-0">Keluar Aplikasi</p>
                    </a>
                </li>
            </ul>
        </div>
        @endauth
    </div>
</aside>