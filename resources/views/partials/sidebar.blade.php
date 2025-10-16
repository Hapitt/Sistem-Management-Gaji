<nav class="sb-sidenav accordion sb-sidenav-primary" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="{{ route('dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-qrcode"></i></div>
                Dashboard
            </a>

            <div class="sb-sidenav-menu-heading">Manajemen</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" id="manajemenToggle">
                <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                Manajemen Data
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('karyawan.index') }}"><i class="fas fa-users me-2"></i>Kelola Karyawan</a>
                    <a class="nav-link" href="{{ route('jabatan.index') }}"><i class="fas fa-briefcase me-2"></i>Kelola Jabatan</a>
                    <a class="nav-link" href="{{ route('rating.index') }}"><i class="fas fa-star me-2"></i>Kelola Rating</a>
                    <a class="nav-link" href="{{ route('lembur.index') }}"><i class="fas fa-clock me-2"></i>Kelola Lembur</a>
                    <a class="nav-link" href="{{ route('gaji.index') }}"><i class="fas fa-money-bill-wave me-2"></i>Gaji Karyawan</a>
                </nav>
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const collapseElement = document.getElementById('collapseLayouts');
    const toggleButton = document.getElementById('manajemenToggle');
    

    const isOpen = localStorage.getItem('manajemenDataOpen') === 'true';
    
    if (isOpen) {
        collapseElement.classList.add('show');
        toggleButton.classList.remove('collapsed');
        toggleButton.setAttribute('aria-expanded', 'true');
    }
    

    collapseElement.addEventListener('show.bs.collapse', function() {
        localStorage.setItem('manajemenDataOpen', 'true');
    });
    
    collapseElement.addEventListener('hide.bs.collapse', function() {
        localStorage.setItem('manajemenDataOpen', 'false');
    });
});
</script>