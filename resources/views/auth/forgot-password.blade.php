<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - GUSPELOR.NET</title>

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
            background: linear-gradient(135deg, #eef5ff 0%, #e2eeff 100%);
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
            padding: 0 70px;
        }

        /* ANIMASI */
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(3deg); }
        }

        @keyframes alertShake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-8px); }
            40%, 80% { transform: translateX(8px); }
        }

        /* IKON MELAYANG DEKORATIF */
        .floating-badge {
            position: absolute;
            z-index: 2;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 10px 16px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.8);
            pointer-events: none;
        }

        .floating-badge .badge-icon {
            width: 30px;
            height: 30px;
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

        .badge-1 { top: 16%; left: 42%; animation: floatSlow 5s ease-in-out infinite; }
        .badge-1 .badge-icon { background: #dbeafe; color: #2563eb; }

        .badge-2 { top: 52%; left: 36%; animation: floatSlow 4s ease-in-out infinite 1s; }
        .badge-2 .badge-icon { background: #fef3c7; color: #d97706; }

        /* GAMBAR ILUSTRASI */
        .bg-illustration {
            position: absolute;
            bottom: 0;
            left: 180px;
            height: 65vh;
            max-height: 560px;
            width: auto;
            max-width: 48%;
            object-fit: contain;
            object-position: bottom left;
            pointer-events: none;
            z-index: 1;
        }

        /* AREA KIRI */
        .left-content {
            position: relative;
            z-index: 5;
            flex: 1;
            max-width: 420px;
            padding: 30px 0;
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
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3);
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

        .main-title span {
            color: #2563eb;
        }

        .main-desc {
            font-size: 12.5px;
            color: #475569;
            line-height: 1.6;
            margin-bottom: 24px;
            max-width: 400px;
            font-weight: 500;
        }

        /* LANGKAH-LANGKAH RESET PASSWORD */
        .step-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            max-width: 380px;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .step-number {
            width: 32px;
            height: 32px;
            background: #ffffff;
            border: 1.5px solid #bfdbfe;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            font-weight: 800;
            font-size: 13px;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.06);
        }

        .step-info h4 {
            font-size: 13.5px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .step-info p {
            font-size: 11.5px;
            color: #475569;
            line-height: 1.45;
            font-weight: 500;
        }

        /* CARD LUPA PASSWORD */
        .right-content {
            position: relative;
            z-index: 5;
            flex: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 20px 0;
        }

        .login-card {
            position: relative;
            width: 100%;
            max-width: 470px;
            min-height: 520px;
            background: #ffffff;
            border-radius: 28px;
            padding: 48px 40px;
            box-shadow: 0 20px 50px -10px rgba(30, 58, 138, 0.12);
            border: 1px solid rgba(226, 232, 240, 0.8);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        /* Garis Gradasi Atas Card */
        .login-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #2563eb, #60a5fa, #3b82f6);
        }

        /* Glow Halus */
        .login-card::after {
            content: "";
            position: absolute;
            top: -60px;
            right: -60px;
            width: 180px;
            height: 180px;
            background: rgba(37, 99, 235, 0.06);
            border-radius: 50%;
            filter: blur(35px);
            pointer-events: none;
        }

        /* Header Card */
        .card-header {
            text-align: center;
            margin-bottom: 24px;
            position: relative;
            z-index: 2;
        }

        .card-header-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 16px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            box-shadow: inset 0 0 0 4px rgba(255, 255, 255, 0.9), 0 8px 20px rgba(37, 99, 235, 0.15);
        }

        .card-header h1 {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 6px;
            letter-spacing: -0.3px;
        }

        .card-header p {
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
        }

        /* NOTIFIKASI LARAVEL */
        /* Success Alert */
        .alert-success {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            padding: 12px 16px;
            border-radius: 14px;
            font-size: 12.5px;
            font-weight: 600;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.06);
        }

        /* Error Alert */
        .alert-error {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #e11d48;
            padding: 12px 16px;
            border-radius: 14px;
            font-size: 12.5px;
            font-weight: 600;
            margin-bottom: 20px;
            animation: alertShake 0.4s cubic-bezier(.36,.07,.19,.97) both;
            box-shadow: 0 4px 12px rgba(225, 29, 72, 0.06);
        }

        /* FORM INPUTS */
        .form-group {
            margin-bottom: 24px;
            position: relative;
            z-index: 2;
        }

        .form-group label {
            display: block;
            font-size: 12.5px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            color: #3b82f6;
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            height: 52px;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            padding: 0 16px 0 48px;
            font-size: 13.5px;
            color: #0f172a;
            background: #f8fafc;
            transition: all 0.25s ease;
            font-weight: 500;
        }

        .form-control:focus {
            outline: none;
            background: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        /* TOMBOL SUBMIT GRADASI */
        .btn-submit {
            position: relative;
            z-index: 2;
            width: 100%;
            height: 52px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border: none;
            border-radius: 14px;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
            transition: all 0.25s ease;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.4);
        }

        /* FOOTER CARD */
        .card-footer {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 24px;
            font-size: 13.5px;
        }

        .back-to-login {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .back-to-login:hover {
            color: #1d4ed8;
            transform: translateX(-3px);
        }

        @media (max-width: 1024px) {
            .login-wrapper {
                flex-direction: column;
                padding: 30px 20px;
            }
            .bg-illustration, .floating-badge {
                display: none;
            }
            .left-content {
                max-width: 100%;
            }
            .right-content {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- IKON MELAYANG -->
    <div class="floating-badge badge-1">
        <div class="badge-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 9.9-1"/></svg>
        </div>
        <span>Keamanan Terjamin</span>
    </div>

    <div class="floating-badge badge-2">
        <div class="badge-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 13V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h9"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        </div>
        <span>Notifikasi Email Instan</span>
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
            Reset Password Anda<br>
            <span>dengan mudah dan</span><br>
            <span>terlindungi</span>
        </h1>

        <p class="main-desc">
            Jangan khawatir jika lupa password. Ikuti petunjuk berikut untuk mendapatkan kembali akses ke akun dashboard Anda.
        </p>

        <div class="step-list">
            
            <div class="step-item">
                <div class="step-number">1</div>
                <div class="step-info">
                    <h4>Masukkan Email Terdaftar</h4>
                    <p>Tuliskan alamat email yang terhubung dengan akun GUSPELOR Anda.</p>
                </div>
            </div>

            <div class="step-item">
                <div class="step-number">2</div>
                <div class="step-info">
                    <h4>Cek Kotak Masuk Email</h4>
                    <p>Sistem akan mengirimkan tautan konfirmasi dan petunjuk pemulihan.</p>
                </div>
            </div>

            <div class="step-item">
                <div class="step-number">3</div>
                <div class="step-info">
                    <h4>Buat Password Baru</h4>
                    <p>Klik tautan pada email lalu perbarui password Anda yang lebih aman.</p>
                </div>
            </div>

        </div>

    </div>

    <!-- SISI KANAN (CARD LUPA PASSWORD) -->
    <div class="right-content">
        <div class="login-card">

            <div>
                <div class="card-header">
                    <div class="card-header-icon">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </div>
                    <h1>Lupa Password?</h1>
                    <p>Masukkan alamat email terdaftar untuk menerima tautan instruksi reset password.</p>
                </div>

                <!-- NOTIFIKASI SUKSES (Tautan Dikirim) -->
                @if (session('status'))
                    <div class="alert-success">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <!-- NOTIFIKASI ERROR (Email Tidak Ditemukan) -->
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

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </span>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="contoh: nama@email.com" required autocomplete="off">
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <span>Kirim Tautan Reset</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>

                </form>
            </div>

            <div class="card-footer">
                <a href="{{ route('login') }}" class="back-to-login">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    <span>Kembali ke Halaman Login</span>
                </a>
            </div>

        </div>
    </div>

</div>

</body>
</html>