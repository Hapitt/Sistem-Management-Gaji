<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Manajemen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #5ab2f0;
            --secondary-color: #3f8efc;
            --accent-color: #2c6ef2;
            --light-color: #f0f8ff;
            --dark-color: #1c1c1c;
            --gradient: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        }

        body {
            background: var(--gradient);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
        }

        .login-container {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 1;
        }

        .login-header {
            background: var(--gradient);
            color: white;
            padding: 40px 30px 30px;
            text-align: center;
            position: relative;
        }

        .logo {
            width: 80px;
            height: 80px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .login-body {
            padding: 40px 30px 30px;
        }

        .form-group {
            position: relative;
            margin-bottom: 30px;
        }

        .form-control {
            border: none;
            border-bottom: 2px solid #d0d0d0;
            border-radius: 0;
            padding: 10px 0;
            font-size: 16px;
            background: transparent;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-bottom-color: var(--primary-color);
            box-shadow: none;
        }

        .form-label {
            position: absolute;
            top: 10px;
            left: 0;
            font-size: 16px;
            color: #999;
            pointer-events: none;
            transition: all 0.3s;
        }

        .form-control:focus + .form-label,
        .form-control:not(:placeholder-shown) + .form-label {
            top: -15px;
            font-size: 12px;
            color: var(--primary-color);
        }

        .btn-login {
            background: var(--gradient);
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            width: 100%;
            margin-top: 10px;
            color: white;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(90, 178, 240, 0.4);
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }

        .register-link a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            overflow: hidden;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }

        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-duration: 20s;
        }

        .floating-element:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            left: 80%;
            animation-duration: 25s;
        }

        .floating-element:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 80%;
            left: 20%;
            animation-duration: 15s;
        }

        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(10px, 15px) rotate(5deg); }
            100% { transform: translate(0, 0) rotate(0deg); }
        }

        @media (max-width: 576px) {
            .login-body {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>

    <div class="login-container">
        <div class="login-header">
            <div class="logo">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo" style="width: 80px; height: 80px; object-fit: contain; border-radius:50%;">
            </div>
            <h3>SISTEM MANAJEMEN GAJI</h3>
            <p>Buat akun baru Anda</p>
        </div>

        <div class="login-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" placeholder=" ">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    @error('name')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" placeholder=" ">
                    <label for="email" class="form-label">Alamat Email</label>
                    @error('email')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" placeholder=" ">
                    <label for="password" class="form-label">Kata Sandi</label>
                    @error('password')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" 
                        name="password_confirmation" required autocomplete="new-password" placeholder=" ">
                    <label for="password-confirm" class="form-label">Konfirmasi Kata Sandi</label>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                </button>
            </form>

            <div class="register-link">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
            </div>
        </div>
    </div>
</body>
</html>
