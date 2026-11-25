<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('landing') }}">
            Pinjam Ruang Sabo
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="#rooms">Daftar Ruangan</a></li>
                @guest
                    <li class="nav-item ms-lg-3"><a class="btn btn-outline-primary px-4" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item ms-lg-2"><a class="btn btn-primary px-4" href="{{ route('register') }}">Daftar</a></li>
                @else
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-primary px-4 shadow-sm" href="{{ auth()->user()->role == 'admin' ? route('admin.dashboard') : (auth()->user()->role == 'staff' ? route('staff.dashboard') : route('user.dashboard')) }}">
                            Ke Dashboard <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>