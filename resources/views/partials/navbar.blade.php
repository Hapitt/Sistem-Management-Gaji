<nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
    <a class="navbar-brand ps-3 d-flex align-items-center" href="https://hapit.rpl-stemanika.com/Hapit_Sport/">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="rounded-circle me-2" style="width: 35px; height: 35px; object-fit: cover;">
        <span>MANAGEMEN</span>
    </a>

    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search..." />
            <button class="btn btn-dark" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>

    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdown" href="#" data-bs-toggle="dropdown">
            <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('images/default-avatar.png') }}" 
                 class="rounded-circle me-2" width="35" height="35" alt="User Photo">
            <span>{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdown">
            <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="fas fa-user-cog me-2 text-primary"></i> Profil
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i> Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </li>
        </ul>
    </li>
</ul>

</nav>
