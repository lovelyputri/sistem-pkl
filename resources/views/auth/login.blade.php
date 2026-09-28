<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GUSPELOR.NET</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        html, body {
            width: 100%;
            min-height: 100vh;
            overflow: hidden;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #1e3a8a;
        }

        /* ==============================
           HALAMAN FULL SCREEN
           Background SATU warna biru muda
        ============================== */
        .login-page {
            width: 100%;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            background: #eaf4ff;
        }

        /* ==============================
           ILUSTRASI - BESAR & KE KIRI
           Boleh ketutup card login (z-index 1)
        ============================== */
        .illustration-bg {
            position: absolute;
            bottom: -50px;
            left: -150px;
            width: 1300px;
            height: 850px;
            background-image: url('{{ asset('images/login.png') }}');
            background-size: contain;
            background-position: left bottom;
            background-repeat: no-repeat;
            z-index: 1;
            pointer-events: none;
        }

        /* ==============================
           KONTEN UTAMA 2 KOLOM
        ============================== */
        .login-content {
            position: relative;
            z-index: 2;
            width: 100%;
            min-height: 100vh;
            display: flex;
        }

        /* ==============================
           KIRI: Teks & Fitur
        ============================== */
        .login-left {
            flex: 1 1 55%;
            padding: 40px 20px 0 60px;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 3;
        }

        /* Logo */
        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 32px;
            position: relative;
            z-index: 4;
        }

        .brand-logo-img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .brand-text h2 {
            font-size: 18px;
            font-weight: 800;
            color: #1e3a8a;
            line-height: 1.1;
        }

        .brand-text p {
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
            margin-top: 3px;
        }

        /* Judul */
        .left-title {
            font-size: 38px;
            font-weight: 800;
            color: #1e3a8a;
            line-height: 1.22;
            margin-bottom: 16px;
            max-width: 460px;
            position: relative;
            z-index: 4;
        }

        .left-title span {
            color: #2563eb;
        }

        .left-desc {
            font-size: 14.5px;
            color: #64748b;
            line-height: 1.7;
            margin-bottom: 26px;
            max-width: 440px;
            font-weight: 500;
            position: relative;
            z-index: 4;
        }

        /* ==============================
           FITUR - TANPA CARD
        ============================== */
        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
            max-width: 400px;
            position: relative;
            z-index: 4;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            background: transparent;
            border: none;
            padding: 0;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: #ffffff;
            border: 1.5px solid #bfdbfe;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            flex-shrink: 0;
        }

        .feature-text h4 {
            font-size: 13.5px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 3px;
        }

        .feature-text p {
            font-size: 11.5px;
            color: #64748b;
            line-height: 1.5;
            font-weight: 500;
        }

        /* ==============================
           KANAN: Card Login TRANSPARAN
        ============================== */
        .login-right {
            flex: 1 1 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 60px 30px 20px;
            position: relative;
            z-index: 5;
        }

        .login-card {
            width: 100%;
            max-width: 480px;
            /* TRANSPARAN - glassmorphism */
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1.5px solid rgba(255, 255, 255, 0.75);
            border-radius: 24px;
            padding: 45px 42px 40px;
            box-shadow: 0 20px 60px rgba(30, 58, 138, 0.12);
        }

        /* Card Header */
        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-header-icon {
            width: 90px;
            height: 90px;
            margin: 0 auto 18px;
            background: rgba(229, 240, 253, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .login-header-icon img {
            width: 55%;
            height: 55%;
            object-fit: contain;
        }

        .login-header h1 {
            font-size: 25px;
            font-weight: 800;
            color: #1e3a8a;
            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 14px;
            color: #2563eb;
            font-weight: 500;
        }

        /* Form */
        .form-group { margin-bottom: 20px; }

        .form-group label {
            display: block;
            font-size: 14.5px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 10px;
        }

        .input-wrapper { position: relative; }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #2563eb;
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            height: 58px;
            border: 1.5px solid rgba(168, 199, 250, 0.7);
            border-radius: 12px;
            padding: 0 50px 0 52px;
            font-size: 14px;
            color: #1e3a8a;
            background: rgba(255, 255, 255, 0.85);
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
            font-weight: 500;
        }

        .form-control::placeholder {
            color: #2563eb;
            font-weight: 500;
            opacity: 0.85;
        }

        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #2563eb;
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 0;
        }

        /* Options */
        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 4px;
            margin-bottom: 26px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13.5px;
            color: #1e3a8a;
            font-weight: 500;
            cursor: pointer;
        }

        .remember input {
            width: 20px;
            height: 20px;
            accent-color: #2563eb;
            cursor: pointer;
            border-radius: 5px;
        }

        .forgot-password {
            font-size: 13.5px;
            font-weight: 700;
            color: #1e3a8a;
            text-decoration: none;
        }

        .forgot-password:hover { color: #2563eb; }

        /* Tombol */
        .btn-login {
            width: 100%;
            height: 58px;
            background: #2563eb;
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 17px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: background 0.2s;
        }

        .btn-login:hover { background: #1d4ed8; }

        /* Divider */
        .register-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-top: 28px;
            font-size: 13px;
            color: #2563eb;
            font-weight: 500;
            white-space: nowrap;
        }

        .register-divider::before,
        .register-divider::after {
            content: "";
            flex: 1;
            height: 1.5px;
            background: rgba(168, 199, 250, 0.6);
        }

        .register-divider a {
            color: #1e3a8a;
            font-weight: 700;
            text-decoration: none;
        }

        /* Alert */
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }
        .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        .alert-success {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        /* ==============================
           RESPONSIVE
        ============================== */
        @media (max-width: 1200px) {
            .login-left { padding: 32px 20px 0 40px; }
            .login-right { padding: 30px 40px 30px 10px; }
            .left-title { font-size: 32px; }
            .login-card { padding: 40px 35px; }
            .illustration-bg { width: 1100px; height: 720px; left: -130px; }
        }

        @media (max-width: 950px) {
            html, body { overflow: auto; }
            .login-page { overflow: visible; }
            .login-content {
                flex-direction: column;
                min-height: auto;
            }
            .login-left {
                flex: 0 0 auto;
                min-height: 500px;
                padding: 30px 25px 320px;
            }
            .illustration-bg {
                width: 100%;
                height: 320px;
                left: 0;
                bottom: 0;
                background-position: center bottom;
            }
            .login-right {
                flex: 1 1 auto;
                padding: 30px 20px 40px;
                width: 100%;
            }
            .login-card { max-width: 100%; }
        }

        @media (max-width: 600px) {
            .login-left { padding: 22px 20px 220px; min-height: 420px; }
            .illustration-bg { height: 220px; }
            .left-title { font-size: 24px; }
            .left-desc { font-size: 13px; }
            .feature-list { display: none; }
            .login-card { padding: 30px 22px; border-radius: 20px; }
            .login-header h1 { font-size: 21px; }
            .login-header-icon { width: 70px; height: 70px; }
        }
    </style>
</head>
<body>

<div class="login-page">

    {{-- Ilustrasi besar di belakang (boleh ketutup card login) --}}
    <div class="illustration-bg"></div>

    {{-- Konten utama --}}
    <div class="login-content">

        {{-- KIRI --}}
        <div class="login-left">

            <div class="brand">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo-img">
                <div class="brand-text">
                    <h2>GUSPELOR.NET</h2>
                    <p>Sistem Pengelolaan PKL</p>
                </div>
            </div>

            <h1 class="left-title">
                Kelola PKL dengan <span>mudah, efektif,</span> dan terstruktur
            </h1>

            <p class="left-desc">
                GUSPELOR.NET membantu sekolah, siswa, dan pembimbing dalam mengelola kegiatan PKL dengan lebih terintegrasi, transparan, dan efisien
            </p>

            <div class="feature-list">

                <div class="feature-item">
                    <div class="feature-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <h4>Manajemen Terpadu</h4>
                        <p>Kelola siswa, guru pembimbing, absensi, jurnal, dan data PKL dalam satu sistem.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <path d="M9 12l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <h4>Aman & Terpercaya</h4>
                        <p>Data tersimpan aman hanya dapat diakses oleh yang berwenang.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="20" x2="18" y2="10"></line>
                            <line x1="12" y1="20" x2="12" y2="4"></line>
                            <line x1="6" y1="20" x2="6" y2="14"></line>
                            <polyline points="3 20 18 5 21 8"></polyline>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <h4>Laporan Real-Time</h4>
                        <p>Pantau aktivitas dan dapatkan laporan secara real-time kapan saja.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <h4>Efisien & Praktis</h4>
                        <p>Otomatis proses administrasi PKL sehingga lebih efisien dan praktis.</p>
                    </div>
                </div>

            </div>

        </div>

        {{-- KANAN: Card Login Transparan --}}
        <div class="login-right">
            <div class="login-card">

                <div class="login-header">
                    <div class="login-header-icon">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo">
                    </div>
                    <h1>Selamat datang kembali !</h1>
                    <p>Silahkan masuk untuk melanjutkan ke dashboard</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('login.process') }}">
                    @csrf

                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </span>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                class="form-control"
                                value="{{ old('username') }}"
                                placeholder="Masukkan email atau username"
                                autocomplete="username"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </span>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan password"
                                autocomplete="current-password"
                                required
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <svg id="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="login-options">
                        <label class="remember">
                            <input type="checkbox" name="remember" value="1">
                            <span>Ingat saya</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="forgot-password">
                            Lupa Password?
                        </a>
                    </div>

                    <button type="submit" class="btn-login">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                            <polyline points="10 17 15 12 10 7"></polyline>
                            <line x1="15" y1="12" x2="3" y2="12"></line>
                        </svg>
                        Masuk
                    </button>

                </form>

                <div class="register-divider">
                    <span>Belum punya akun?</span>
                    <a href="{{ route('register') }}">Daftar sekarang</a>
                </div>

            </div>
        </div>

    </div>

</div>

<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const icon = document.getElementById('eye-icon');

        if (password.type === 'password') {
            password.type = 'text';
            icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
        } else {
            password.type = 'password';
            icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
        }
    }
</script>

</body>
</html>
