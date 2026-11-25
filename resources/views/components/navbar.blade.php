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

<nav class="app-header navbar navbar-expand bg-body shadow-sm">
  <div class="container-fluid">
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar-full" href="#" role="button">
                  <i class="bi bi-list"></i>
              </a>
          </li>
      </ul>

      <ul class="navbar-nav ms-auto">
          @auth
          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
              @if(auth()->user()->avatar)
                  <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="rounded-circle shadow-sm" style="width: 32px; height: 32px; object-fit: cover;">
              @else
                  <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px; font-size: 14px; font-weight: bold;">
                      {{ substr(auth()->user()->name, 0, 1) }}
                  </div>
              @endif
              <span class="d-none d-md-inline ms-2 fw-semibold text-dark">{{ auth()->user()->name }}</span>
          </a>
              
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end border-0 shadow">
                <li class="user-header {{ $roleLabelColor }} text-white p-4 text-center rounded-top">
                  @if(auth()->user()->avatar)
                      <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                           class="rounded-circle mx-auto mb-2 shadow border border-2 border-white" 
                           style="width: 70px; height: 70px; object-fit: cover;"
                           alt="User Image">
                  @else
                      <div class="bg-white {{ $accentColor }} rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2 shadow" 
                           style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">
                          {{ substr(auth()->user()->name, 0, 1) }}
                      </div>
                  @endif
                  
                  <p class="mb-0 fw-bold">{{ auth()->user()->name }}</p>
              </li>
                  
                  <li class="user-body p-2">
                      <a href="{{ route('profile.index') }}" class="dropdown-item rounded d-flex align-items-center py-2">
                          <i class="bi bi-person-circle me-3 text-primary"></i> Pengaturan Profil
                      </a>
                  </li>
                  
                  <li class="user-footer border-top p-2 bg-light rounded-bottom">
                      <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                         class="btn btn-danger btn-sm w-100 rounded-pill">
                          <i class="bi bi-box-arrow-right me-1"></i> Keluar Aplikasi
                      </a>
                  </li>
              </ul>
          </li>
          @endauth
      </ul>
  </div>
</nav>