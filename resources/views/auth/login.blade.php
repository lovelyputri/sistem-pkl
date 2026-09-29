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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            overflow-x: hidden;
        }

        .login-wrapper {
            width: 100%;
            min-height: 100vh;
            position: relative;
            background: linear-gradient(135deg, #f0f7ff 0%, #e4efff 100%);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            overflow: hidden;
            padding: 30px 70px 0;
            gap: 30px;
        }

        /* ==========================================
           ANIMASI CSS
        ========================================== */
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-14px) rotate(4deg); }
        }

        @keyframes floatMedium {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(-3deg); }
        }

        @keyframes alertShake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-8px); }
            40%, 80% { transform: translateX(8px); }
        }

        @keyframes cardGlow {
            0%, 100% {
                box-shadow:
                    0 25px 50px -12px rgba(30, 58, 138, 0.12),
                    0 0 0 0 rgba(37, 99, 235, 0);
            }
            50% {
                box-shadow:
                    0 25px 50px -12px rgba(30, 58, 138, 0.18),
                    0 0 0 6px rgba(37, 99, 235, 0.05);
            }
        }

        @keyframes ringPulse {
            0% { transform: scale(1); opacity: 0.5; }
            100% { transform: scale(1.4); opacity: 0; }
        }

        @keyframes shimmerLine {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        @keyframes dotBlink {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }

        /* ==========================================
           IKON-IKON DEKORATIF MELAYANG
        ========================================== */
        .floating-badge {
            position: absolute;
            z-index: 2;
            background: #ffffff;
            padding: 10px 16px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.8);
            pointer-events: none;
        }

        .floating-badge .badge-icon {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .floating-badge span {
            font-size: 12px;
            font-weight: 700;
            color: #1e293b;
        }

        .badge-1 { top: 14%; left: 42%; animation: floatSlow 5s ease-in-out infinite; }
        .badge-1 .badge-icon { background: #dbeafe; color: #2563eb; }

        .badge-2 { top: 48%; left: 36%; animation: floatMedium 4s ease-in-out infinite 1s; }
        .badge-2 .badge-icon { background: #dcfce7; color: #16a34a; }

        .badge-3 { bottom: 18%; left: 48%; animation: floatSlow 6s ease-in-out infinite 0.5s; }
        .badge-3 .badge-icon { background: #fef3c7; color: #d97706; }

        /* ==========================================
           GAMBAR ILUSTRASI
        ========================================== */
        .bg-illustration {
            position: absolute;
            bottom: 0;
            left: 0px;
            height: 65vh;
            max-height: 560px;
            width: auto;
            max-width: 48%;
            object-fit: contain;
            object-position: bottom left;
            pointer-events: none;
            z-index: 1;
        }

        /* ==========================================
           AREA KIRI: TEKS & FITUR
        ========================================== */
        .left-content {
            position: relative;
            z-index: 5;
            flex: 1;
            max-width: 460px;
            padding: 0;
            margin-top: 0;
            align-self: flex-start;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 22px;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: #2563eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .brand-text h2 {
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.1;
        }

        .brand-text p {
            font-size: 11px;
            color: #475569;
            font-weight: 600;
            margin-top: 2px;
        }

        .main-title {
            font-size: 30px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.25;
            margin-bottom: 12px;
        }

        .main-title span { color: #2563eb; }

        .main-desc {
            font-size: 12.5px;
            color: #475569;
            line-height: 1.6;
            margin-bottom: 24px;
            max-width: 400px;
            font-weight: 500;
        }

        /* ==========================================
           FEATURE LIST
        ========================================== */
        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-width: 360px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.75);
            border-radius: 12px;
            padding: 8px 12px;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.06);
            transition: all 0.25s ease;
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.65);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.12);
            transform: translateY(-2px);
        }

        .feature-icon {
            width: 36px;
            height: 36px;
            background: #ffffff;
            border: 1.5px solid #bfdbfe;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.06);
        }

        .feature-info h4 {
            font-size: 13.5px;
            font-weight: 700;
            color: rgb(0, 30, 101);
            margin-bottom: 2px;
        }

        .feature-info p {
            font-size: 11.5px;
            color: #2e3745;
            line-height: 1.45;
            font-weight: 500;
        }

        /* ==========================================
           AREA KANAN: KARTU LOGIN
        ========================================== */
        .right-content {
            position: relative;
            z-index: 5;
            flex: 1;
            display: flex;
            justify-content: flex-end;
            align-items: flex-start;
            padding: 100px 0;
        }

        .login-card {
            width: 100%;
            max-width: 470px;
            min-height: 680px;
            border-radius: 30px;
            padding: 70px 45px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;

            background-color: #ffffff;
            background-image:
                radial-gradient(rgba(37, 99, 235, 0.055) 1px, transparent 1px);
            background-size: 18px 18px;

            border: 1px solid #e6efff;
            box-shadow: 0 25px 50px -12px rgba(30, 58, 138, 0.12);

            animation: cardGlow 4s ease-in-out infinite;
        }

        .login-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(
                90deg,
                #2563eb 0%,
                #60a5fa 25%,
                #a5c8ff 50%,
                #60a5fa 75%,
                #2563eb 100%
            );
            background-size: 200% 100%;
            border-radius: 30px 30px 0 0;
            animation: shimmerLine 3s linear infinite;
            z-index: 2;
        }

        .login-card::after {
            content: "";
            position: absolute;
            top: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.10) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .login-card > * {
            position: relative;
            z-index: 1;
        }

        .card-header {
            text-align: center;
            margin-bottom: 36px;
        }

        .card-header-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 14px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            box-shadow:
                0 8px 20px rgba(37, 99, 235, 0.15),
                inset 0 -2px 6px rgba(37, 99, 235, 0.08);
            position: relative;
        }

        .card-header-icon::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 2px solid rgba(37, 99, 235, 0.35);
            animation: ringPulse 2.5s ease-out infinite;
        }

        .card-header h1 {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .card-header p {
            font-size: 13px;
            color: #64748b;
        }

        .alert-error {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 12.5px;
            font-weight: 600;
            margin-bottom: 18px;
            animation: alertShake 0.4s cubic-bezier(.36,.07,.19,.97) both;
        }

        .alert-error svg { flex-shrink: 0; }

        .form-group { margin-bottom: 18px; }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            color: #2563eb;
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            height: 50px;
            border: 1.5px solid #bfdbfe;
            border-radius: 12px;
            padding: 0 44px 0 46px;
            font-size: 13.5px;
            color: #0f172a;
            background: #ffffff;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 8px;
            margin-bottom: 24px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #64748b;
            cursor: pointer;
        }

        .remember-me input {
            width: 17px;
            height: 17px;
            accent-color: #2563eb;
            cursor: pointer;
        }

        .forgot-link {
            font-size: 13px;
            font-weight: 700;
            color: #0f172a;
            text-decoration: none;
        }

        .btn-submit {
            width: 100%;
            height: 50px;
            background: #2563eb;
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.28);
            transition: all 0.2s ease;
        }

        .btn-submit:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 26px;
            font-size: 13px;
            color: #64748b;
        }

        .card-footer::before,
        .card-footer::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .card-footer a {
            color: #0f172a;
            font-weight: 700;
            text-decoration: none;
        }

        /* ==========================================
           RESPONSIVE
        ========================================== */
        @media (max-width: 1024px) {
            .login-wrapper {
                flex-direction: column;
                padding: 30px 20px;
                align-items: center;
            }
            .bg-illustration, .floating-badge { display: none; }
            .left-content {
                max-width: 100%;
                width: 100%;
                align-items: center;
                text-align: center;
            }
            .right-content {
                width: 100%;
                justify-content: center;
                align-items: center;
            }
            .login-card {
                max-width: 100%;
                min-height: auto;
            }
        }

        /* ==========================================
           SLIDE PAGE TRANSITION (TAMBAHAN)
        ========================================== */

        /* Halaman masuk dari kanan (dipakai saat balik ke login dari register/lupa password) */
        @keyframes slideInFromRight {
            0% {
                opacity: 0;
                transform: translateX(60px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Halaman masuk dari kiri (dipakai saat balik ke login dari arah kiri) */
        @keyframes slideInFromLeft {
            0% {
                opacity: 0;
                transform: translateX(-60px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Halaman keluar ke kiri (saat klik Register / Lupa Password) */
        @keyframes slideOutToLeft {
            0% {
                opacity: 1;
                transform: translateX(0);
            }
            100% {
                opacity: 0;
                transform: translateX(-60px);
            }
        }

        /* Halaman keluar ke kanan (saat balik ke login) */
        @keyframes slideOutToRight {
            0% {
                opacity: 1;
                transform: translateX(0);
            }
            100% {
                opacity: 0;
                transform: translateX(60px);
            }
        }

        /* Container transisi */
        .page-transition-wrap {
            width: 100%;
            min-height: 100vh;
            will-change: transform, opacity;
        }

        /* State: masuk dari kanan */
        body.enter-from-right .page-transition-wrap {
            animation: slideInFromRight 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        /* State: masuk dari kiri */
        body.enter-from-left .page-transition-wrap {
            animation: slideInFromLeft 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        /* State: keluar ke kiri */
        body.leave-to-left .page-transition-wrap {
            animation: slideOutToLeft 0.45s cubic-bezier(0.55, 0, 0.55, 0.2) forwards;
        }

        /* State: keluar ke kanan */
        body.leave-to-right .page-transition-wrap {
            animation: slideOutToRight 0.45s cubic-bezier(0.55, 0, 0.55, 0.2) forwards;
        }

        /* Efek hover pada link transisi */
        .transition-link {
            transition: transform 0.2s ease, color 0.2s ease;
            display: inline-block;
        }

        .transition-link:hover {
            transform: translateX(2px);
            color: #2563eb !important;
        }

        .transition-link:active {
            transform: scale(0.96);
        }
    </style>
</head>
<body>

<!-- WRAPPER TRANSISI (TAMBAHAN) -->
<div class="page-transition-wrap">

<div class="login-wrapper">

    <!-- IKON-IKON DEKORATIF MELAYANG -->
    <div class="floating-badge badge-1">
        <div class="badge-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 20h.01M5 12.55a11 11 0 0 1 14.08 0M1.42 9a16 16 0 0 1 21.16 0M8.53 16.11a6 6 0 0 1 6.95 0"/></svg>
        </div>
        <span>Realtime Sync</span>
    </div>

    <div class="floating-badge badge-2">
        <div class="badge-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <span>Terproteksi 100%</span>
    </div>

    <div class="floating-badge badge-3">
        <div class="badge-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <span>Akses Otomatis</span>
    </div>

    <!-- ILUSTRASI GAMBAR -->
    <img src="{{ asset('images/login.png') }}" alt="Ilustrasi GUSPELOR.NET" class="bg-illustration">

    <!-- SISI KIRI -->
    <div class="left-content">

        <div class="brand">
            <div class="brand-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12.55a11 11 0 0 1 14.08 0"></path>
                    <path d="M1.42 9a16 16 0 0 1 21.16 0"></path>
                    <path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path>
                    <line x1="12" y1="20" x2="12.01" y2="20"></line>
                </svg>
            </div>
            <div class="brand-text">
                <h2>GUSPELOR.NET</h2>
                <p>Sistem Pengelolaan PKL</p>
            </div>
        </div>

        <h1 class="main-title">
            Kelola PKL dengan<br>
            <span>mudah, efektif, dan</span><br>
            <span>terstruktur</span>
        </h1>

        <p class="main-desc">
            GUSPELOR.NET membantu sekolah, siswa, dan pembimbing dalam mengelola kegiatan PKL dengan lebih terintegrasi, transparan, dan efisien
        </p>

        <div class="feature-list">

            <div class="feature-item">
                <div class="feature-icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div class="feature-info">
                    <h4>Manajemen Terpadu</h4>
                    <p>Kelola siswa, guru pembimbing, absensi, jurnal, dan data PKL dalam satu sistem.</p>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        <path d="M9 12l2 2 4-4"></path>
                    </svg>
                </div>
                <div class="feature-info">
                    <h4>Aman & Terpercaya</h4>
                    <p>Data tersimpan aman hanya dapat diakses oleh yang berwenang.</p>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"></line>
                        <line x1="12" y1="20" x2="12" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="14"></line>
                        <polyline points="3 20 18 5 21 8"></polyline>
                    </svg>
                </div>
                <div class="feature-info">
                    <h4>Laporan Real-Time</h4>
                    <p>Pantau aktivitas dan dapatkan laporan secara real-time kapan saja.</p>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <div class="feature-info">
                    <h4>Efisien & Praktis</h4>
                    <p>Otomatis proses administrasi PKL sehingga lebih efisien dan praktis.</p>
                </div>
            </div>

        </div>

    </div>

    <!-- SISI KANAN (CARD LOGIN) -->
    <div class="right-content">
        <div class="login-card">

            <div>
                <div class="card-header">
                    <div class="card-header-icon">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12.55a11 11 0 0 1 14.08 0"></path>
                            <path d="M1.42 9a16 16 0 0 1 21.16 0"></path>
                            <path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path>
                            <line x1="12" y1="20" x2="12.01" y2="20"></line>
                        </svg>
                    </div>
                    <h1>Selamat datang kembali !</h1>
                    <p>Silahkan masuk untuk melanjutkan ke dashboard</p>
                </div>

                @if (session('error'))
                    <div class="alert-error">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-error">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.process') }}">
                    @csrf

                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </span>
                            <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" placeholder="Masukkan email atau username" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <svg id="eye-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember" value="1">
                            <span>Ingat saya</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="forgot-link transition-link" data-transition="forward">Lupa Password?</a>
                    </div>

                    <button type="submit" class="btn-submit">
                        Masuk
                    </button>

                </form>
            </div>

            <div class="card-footer">
                <span>Belum punya akun?</span>
                <a href="{{ route('register') }}" class="transition-link" data-transition="forward">Daftar sekarang</a>
            </div>

        </div>
    </div>

</div>

</div>
<!-- END WRAPPER TRANSISI -->

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

    // ==========================================
    // SLIDE PAGE TRANSITION (TAMBAHAN)
    // ==========================================
    (function () {
        const KEY = 'pageTransition';

        document.addEventListener('DOMContentLoaded', function () {

            // 1) Cek apakah halaman ini harus masuk dari kanan/kiri
            const incoming = sessionStorage.getItem(KEY);
            if (incoming === 'forward') {
                // halaman baru masuk dari KANAN
                document.body.classList.add('enter-from-right');
            } else if (incoming === 'back') {
                // halaman baru masuk dari KIRI
                document.body.classList.add('enter-from-left');
            }
            // bersihkan agar tidak kepakai lagi saat refresh
            sessionStorage.removeItem(KEY);

            // 2) Handle klik link transisi
            const links = document.querySelectorAll('[data-transition]');
            links.forEach(function (link) {
                link.addEventListener('click', function (e) {
                    const href = link.getAttribute('href');
                    if (!href || href.startsWith('#') || href.startsWith('javascript')) return;

                    e.preventDefault();

                    const dir = link.getAttribute('data-transition'); // "forward" atau "back"

                    // Simpan arah ke sessionStorage buat halaman berikutnya
                    sessionStorage.setItem(KEY, dir);

                    // Jalankan animasi keluar
                    if (dir === 'forward') {
                        document.body.classList.add('leave-to-left');
                    } else {
                        document.body.classList.add('leave-to-right');
                    }

                    // Redirect setelah animasi selesai
                    setTimeout(function () {
                        window.location.href = href;
                    }, 430);
                });
            });

            // 3) Kalau user pakai tombol BACK browser, tetap animasi masuk dari kiri
            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    // dari bfcache (back/forward browser)
                    document.body.classList.remove('leave-to-left', 'leave-to-right');
                    document.body.classList.add('enter-from-left');
                }
            });
        });
    })();
</script>

</body>
</html>
