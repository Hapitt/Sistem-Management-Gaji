<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Sistem Manajemen Gaji" />
    <meta name="author" content="Hafidz" />
    <title>@yield('title', 'Sistem Manajemen Gaji')</title>

    {{-- CSS --}}
    @vite(['resources/css/style.css'])
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/sbadmin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</head>

@guest
<body class="guest">
    <div class="floating-bg"></div>
    <div class="floating-bg"></div>

    <div class="guest-container">
        <img src="{{ asset('images/Logo.png') }}" alt="Logo Sistem">
        <h2>Anda Belum Login!!</h2>
        <p>Silakan login terlebih dahulu untuk mengakses Sistem Manajemen Gaji.</p>
        <a href="{{ route('login') }}">
            <i class="fas fa-sign-in-alt me-2"></i> Masuk Sekarang
        </a>
    </div>
</body>
@else
<body class="sb-nav-fixed">
    {{-- Navbar --}}
    @include('partials.navbar')

    <div id="layoutSidenav">
        {{-- Sidebar --}}
        <div id="layoutSidenav_nav">
            @include('partials.sidebar')
        </div>

        {{-- Content --}}
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('partials.footer')
        </div>
    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/sbadmin/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('scripts')
</body>
@endguest
</html>