<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Sistem Manajemen Gaji" />
    <meta name="author" content="Hafidz" />
    <title>@yield('title', 'Dashboard - Sistem Manajemen Gaji')</title>

    {{-- CSS --}}
    @vite(['resources/css/style.css'])
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/sbadmin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    @stack('styles')

    <style>
        /* ==== Tampilan Guest Modern ==== */
        body.guest {
            background: linear-gradient(135deg, #5ab2f0, #2c6ef2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
            color: #fff;
        }

        .guest-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.12);
            padding: 40px 30px;
            border-radius: 20px;
            backdrop-filter: blur(15px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            animation: fadeIn 0.8s ease-in-out;
        }

        .guest-container img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 20px;
        }

        .guest-container h2 {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .guest-container p {
            font-size: 1rem;
            color: #f0f8ff;
            margin-bottom: 25px;
        }

        .guest-container a {
            background: #fff;
            color: #2c6ef2;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .guest-container a:hover {
            background: #2c6ef2;
            color: #fff;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        /* Animasi masuk */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Elemen melayang */
        .floating-bg {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            animation: float 10s ease-in-out infinite alternate;
            z-index: 0;
        }

        .floating-bg:nth-child(1) { top: -100px; left: -100px; }
        .floating-bg:nth-child(2) { bottom: -120px; right: -80px; animation-delay: 2s; }

        @keyframes float {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(-30px) scale(1.05); }
        }

        @media (max-width: 576px) {
            .guest-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>

@guest
<body class="guest">
    <div class="floating-bg"></div>
    <div class="floating-bg"></div>

    <div class="guest-container">
        <img src="{{ asset('images/Logo.png') }}" alt="Logo Sistem">
        <h2>Anda Belum Login</h2>
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
