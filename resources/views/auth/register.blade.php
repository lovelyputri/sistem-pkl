<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - GUSPELOR.NET</title>

    <!-- Google Fonts -->
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
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            background: linear-gradient(135deg, #f0f6ff 0%, #e5effd 100%);
        }

        .register-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 40px 60px 0 60px;
            position: relative;
            overflow: hidden;
        }

        /* ==========================================
           SISI KIRI: BRANDING & ILUSTRASI
        ========================================== */
        .left-content {
            flex: 1;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 2;
            align-self: stretch;
            padding-top: 10px;
        }

        .left-text-group {
            display: flex;
            flex-direction: column;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: #2563eb;
            border-radius: 10px;
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
            letter-spacing: -0.2px;
        }

        .brand-text p {
            font-size: 11px;
            color: #64748b;
            font-weight: 600;
            margin-top: 1px;
        }

        .step-badge {
            display: inline-block;
            background: #dbeafe;
            color: #2563eb;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 20px;
            margin-bottom: 16px;
            width: fit-content;
        }

        .main-title {
            font-size: 30px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.25;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .main-title span {
            color: #2563eb;
        }

        .main-desc {
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 16px;
            font-weight: 500;
        }

        .illustration-box {
            width: calc(100% + 60px);
            margin-left: -60px;
            margin-bottom: 0;
            display: flex;
            justify-content: flex-start;
            align-items: flex-end;
            margin-top: auto;
        }

        .register-img {
            width: 108%;
            max-width: 500px;
            height: auto;
            object-fit: contain;
            pointer-events: none;
            filter: drop-shadow(0 10px 20px rgba(37, 99, 235, 0.08));
        }

        /* ==========================================
           SISI KANAN: CARD REGISTER
        ========================================== */
        .right-content {
            flex: 1.2;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            z-index: 2;
            padding-bottom: 40px;
        }

        .register-card {
            width: 100%;
            max-width: 680px;
            background: #ffffff;
            border-radius: 28px;
            padding: 36px 40px;
            box-shadow: 0 20px 45px -10px rgba(30, 58, 138, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        /* STEPPER HEADER */
        .stepper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            padding: 0 20px;
            position: relative;
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            position: relative;
            z-index: 2;
        }

        .step-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            background: #ffffff;
            border: 2px solid #e2e8f0;
            color: #94a3b8;
            transition: all 0.3s ease;
        }

        .step-item.active .step-circle {
            background: #2563eb;
            border-color: #2563eb;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .step-label {
            font-size: 11.5px;
            font-weight: 600;
            color: #94a3b8;
        }

        .step-item.active .step-label {
            color: #2563eb;
            font-weight: 700;
        }

        .step-line {
            flex: 1;
            height: 2px;
            background: #e2e8f0;
            margin: 0 12px;
            position: relative;
            top: -12px;
            z-index: 1;
        }

        /* CARD HEADER TITLE */
        .card-header-title {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 22px;
        }

        .header-icon-box {
            width: 42px;
            height: 42px;
            background: #eff6ff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            border: 1px solid #dbeafe;
        }

        .header-text h3 {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
        }

        .header-text p {
            font-size: 12.5px;
            color: #64748b;
            font-weight: 500;
        }

        /* FORM GRID */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 12.5px;
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
            left: 14px;
            color: #2563eb;
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            height: 46px;
            border: 1.5px solid #d0e1fd;
            border-radius: 12px;
            padding: 0 14px 0 42px;
            font-size: 13px;
            color: #0f172a;
            background: #ffffff;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .form-control::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        /* RADIO BUTTONS */
        .radio-group {
            display: flex;
            align-items: center;
            gap: 24px;
            height: 46px;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            cursor: pointer;
        }

        .radio-label input[type="radio"] {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #cbd5e1;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
        }

        .radio-label input[type="radio"]:checked {
            border-color: #2563eb;
            background-color: #ffffff;
        }

        .radio-label input[type="radio"]:checked::after {
            content: "";
            position: absolute;
            top: 3px;
            left: 3px;
            width: 8px;
            height: 8px;
            background-color: #2563eb;
            border-radius: 50%;
        }

        /* INFO NOTICE BOX */
        .info-notice {
            margin-top: 22px;
            background: #f0f7ff;
            border: 1px solid #d0e1fd;
            border-radius: 14px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .info-notice-icon {
            width: 36px;
            height: 36px;
            background: #ffffff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.08);
        }

        .info-notice p {
            font-size: 12px;
            color: #334155;
            font-weight: 600;
            line-height: 1.45;
        }

        /* BUTTON ACTIONS */
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 22px;
            border-radius: 12px;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            color: #334155;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-next {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 28px;
            border-radius: 12px;
            background: #2563eb;
            border: none;
            color: #ffffff;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
            transition: all 0.2s ease;
        }

        .btn-next:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.4);
        }

        @media (max-width: 1100px) {
            .register-wrapper {
                flex-direction: column;
                padding: 30px 20px;
            }
            .left-content {
                max-width: 100%;
                margin-bottom: 30px;
            }
            .right-content {
                width: 100%;
                justify-content: center;
                padding-bottom: 0;
            }
            .illustration-box {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            .register-card {
                padding: 24px 20px;
            }
        }

        /* ==========================================
           SLIDE PAGE TRANSITION (TAMBAHAN)
        ========================================== */

        @keyframes slideInFromRight {
            0% { opacity: 0; transform: translateX(60px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideInFromLeft {
            0% { opacity: 0; transform: translateX(-60px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideOutToLeft {
            0% { opacity: 1; transform: translateX(0); }
            100% { opacity: 0; transform: translateX(-60px); }
        }

        @keyframes slideOutToRight {
            0% { opacity: 1; transform: translateX(0); }
            100% { opacity: 0; transform: translateX(60px); }
        }

        .page-transition-wrap {
            width: 100%;
            min-height: 100vh;
            will-change: transform, opacity;
        }

        body.enter-from-right .page-transition-wrap {
            animation: slideInFromRight 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        body.enter-from-left .page-transition-wrap {
            animation: slideInFromLeft 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        body.leave-to-left .page-transition-wrap {
            animation: slideOutToLeft 0.45s cubic-bezier(0.55, 0, 0.55, 0.2) forwards;
        }

        body.leave-to-right .page-transition-wrap {
            animation: slideOutToRight 0.45s cubic-bezier(0.55, 0, 0.55, 0.2) forwards;
        }

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

<div class="register-wrapper">

    <!-- SISI KIRI: INFO & ILUSTRASI -->
    <div class="left-content">
        
        <div class="left-text-group">
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

            <div class="step-badge">Langkah 1 dari 3</div>

            <h1 class="main-title">
                Daftar akun baru<br>
                <span>dan mulai perjalanan</span><br>
                <span>PKL-mu bersama kami</span>
            </h1>

            <p class="main-desc">
                Lengkapi data dirimu dengan benar<br>
                untuk mempermudah verifikasi oleh admin.
            </p>
        </div>

        <!-- GAMBAR ILUSTRASI -->
        <div class="illustration-box">
            <img src="{{ asset('images/register.png') }}" alt="Ilustrasi Register GUSPELOR.NET" class="register-img">
        </div>

    </div>

    <!-- SISI KANAN: CARD FORM REGISTER -->
    <div class="right-content">
        <div class="register-card">

            <!-- STEPPER BAR -->
            <div class="stepper">
                <div class="step-item active">
                    <div class="step-circle">1</div>
                    <span class="step-label">Data Diri</span>
                </div>
                <div class="step-line"></div>
                <div class="step-item">
                    <div class="step-circle">2</div>
                    <span class="step-label">Data Sekolah</span>
                </div>
                <div class="step-line"></div>
                <div class="step-item">
                    <div class="step-circle">3</div>
                    <span class="step-label">Verifikasi</span>
                </div>
            </div>

            <!-- HEADER FORM -->
            <div class="card-header-title">
                <div class="header-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div class="header-text">
                    <h3>Data Diri</h3>
                    <p>Lengkapi informasi dirimu dengan benar</p>
                </div>
            </div>

            <!-- FORM REGISTER -->
            <form action="{{ route('register.step1.process') }}" method="POST">
                @csrf

                <div class="form-grid">

                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </span>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('nama_lengkap') }}" required>
                        </div>
                    </div>

                    <!-- Tempat Lahir -->
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </span>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir') }}" required>
                        </div>
                    </div>

                    <!-- NISN -->
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><line x1="7" y1="8" x2="17" y2="8"/><line x1="7" y1="12" x2="13" y2="12"/></svg>
                            </span>
                            <input type="text" id="nisn" name="nisn" class="form-control" placeholder="Masukkan NISN" value="{{ old('nisn') }}" required>
                        </div>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            </span>
                            <input type="text" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" id="tanggal_lahir" name="tanggal_lahir" class="form-control" placeholder="Pilih tanggal lahir" value="{{ old('tanggal_lahir') }}" required>
                            <span class="password-toggle" style="pointer-events:none;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            </span>
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin', 'Laki-laki') == 'Laki-laki' ? 'checked' : '' }}>
                                <span>Laki-laki</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}>
                                <span>Perempuan</span>
                            </label>
                        </div>
                    </div>

                    <div></div>

                    <!-- No. Telepon -->
                    <div class="form-group">
                        <label for="no_telepon">No. Telepon</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </span>
                            <input type="text" id="no_telepon" name="no_telepon" class="form-control" placeholder="Contoh: 081234567890" value="{{ old('no_telepon') }}" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            <button type="button" class="password-toggle" onclick="togglePass('password', 'eye1')">
                                <svg id="eye1" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </span>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                            <button type="button" class="password-toggle" onclick="togglePass('password_confirmation', 'eye2')">
                                <svg id="eye2" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- INFO NOTICE -->
                <div class="info-notice">
                    <div class="info-notice-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                    <p>
                        Pastikan data yang kamu masukkan sudah benar.<br>
                        Data ini akan digunakan untuk verifikasi oleh admin.
                    </p>
                </div>

                <!-- TOMBOL NAVIGASI -->
                <div class="form-actions">
                    <a href="{{ route('login') }}" class="btn-back transition-link" data-transition="back">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        <span>Kembali</span>
                    </a>

                    <button type="submit" class="btn-next">
                        <span>Selanjutnya</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

</div>
<!-- END WRAPPER TRANSISI -->

<script>
    function togglePass(inputId, eyeId) {
        const input = document.getElementById(inputId);
        const eye = document.getElementById(eyeId);

        if (input.type === 'password') {
            input.type = 'text';
            eye.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
        } else {
            input.type = 'password';
            eye.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
        }
    }

    // ==========================================
    // SLIDE PAGE TRANSITION (TAMBAHAN)
    // ==========================================
    (function () {
        const KEY = 'pageTransition';

        document.addEventListener('DOMContentLoaded', function () {

            // 1) Cek arah masuk halaman ini
            const incoming = sessionStorage.getItem(KEY);
            if (incoming === 'forward') {
                document.body.classList.add('enter-from-right');
            } else if (incoming === 'back') {
                document.body.classList.add('enter-from-left');
            }
            sessionStorage.removeItem(KEY);

            // 2) Handle klik link transisi
            const links = document.querySelectorAll('[data-transition]');
            links.forEach(function (link) {
                link.addEventListener('click', function (e) {
                    const href = link.getAttribute('href');
                    if (!href || href.startsWith('#') || href.startsWith('javascript')) return;

                    e.preventDefault();

                    const dir = link.getAttribute('data-transition');

                    sessionStorage.setItem(KEY, dir);

                    if (dir === 'forward') {
                        document.body.classList.add('leave-to-left');
                    } else {
                        document.body.classList.add('leave-to-right');
                    }

                    setTimeout(function () {
                        window.location.href = href;
                    }, 430);
                });
            });

            // 3) Handle tombol back browser
            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    document.body.classList.remove('leave-to-left', 'leave-to-right');
                    document.body.classList.add('enter-from-left');
                }
            });
        });
    })();
</script>

</body>
</html>