<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Data Sekolah - GUSPELOR.NET</title>

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

        /* STEP COMPLETED */
        .step-item.completed .step-circle {
            background: #ffffff;
            border-color: #cbd5e1;
            color: #2563eb;
        }

        .step-item.completed .step-label {
            color: #64748b;
            font-weight: 600;
        }

        /* STEP ACTIVE */
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

        .step-line.completed {
            background: #cbd5e1;
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

        .form-group.full-width {
            grid-column: span 2;
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
            z-index: 2;
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

        /* CUSTOM SELECT STYLING */
        select.form-control {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 38px;
            cursor: pointer;
        }

        select.form-control option[disabled] {
            color: #94a3b8;
        }

        .input-right-icon {
            position: absolute;
            right: 14px;
            color: #94a3b8;
            display: flex;
            align-items: center;
            pointer-events: none;
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
            .form-group.full-width {
                grid-column: span 1;
            }
            .register-card {
                padding: 24px 20px;
            }
        }
    </style>
</head>
<body>

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

            <div class="step-badge">Langkah 2 dari 3</div>

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

    <!-- SISI KANAN: CARD FORM REGISTER STEP 2 -->
    <div class="right-content">
        <div class="register-card">

            <!-- STEPPER BAR -->
            <div class="stepper">
                <div class="step-item completed">
                    <div class="step-circle">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <span class="step-label">Data Diri</span>
                </div>
                <div class="step-line completed"></div>
                <div class="step-item active">
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
                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                        <path d="M6 12H4a2 2 0 0 0-2 2v8"></path>
                        <path d="M18 9h2a2 2 0 0 1 2 2v11"></path>
                        <path d="M10 6h4"></path>
                        <path d="M10 10h4"></path>
                        <path d="M10 14h4"></path>
                        <path d="M10 18h4"></path>
                    </svg>
                </div>
                <div class="header-text">
                    <h3>Data Sekolah</h3>
                    <p>Lengkapi informasi dirimu dengan benar</p>
                </div>
            </div>

            <!-- FORM DATA SEKOLAH -->
            <form action="{{ route('register.step2.process') }}" method="POST">
                @csrf

                <div class="form-grid">

                    <!-- Asal Sekolah -->
                    <div class="form-group">
                        <label for="asal_sekolah">Asal Sekolah</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v8"/><path d="M18 9h2a2 2 0 0 1 2 2v11"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>
                            </span>
                            <select id="asal_sekolah" name="asal_sekolah" class="form-control" required>
                                <option value="" disabled selected>Pilih asal sekolah</option>
                                <option value="SMKN 1 Jakarta" {{ old('asal_sekolah') == 'SMKN 1 Jakarta' ? 'selected' : '' }}>SMKN 1 Jakarta</option>
                                <option value="SMKN 2 Jakarta" {{ old('asal_sekolah') == 'SMKN 2 Jakarta' ? 'selected' : '' }}>SMKN 2 Jakarta</option>
                            </select>
                        </div>
                    </div>

                    <!-- Kelas -->
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                            </span>
                            <select id="kelas" name="kelas" class="form-control" required>
                                <option value="" disabled selected>Pilih kelas</option>
                                <option value="X" {{ old('kelas') == 'X' ? 'selected' : '' }}>Kelas X</option>
                                <option value="XI" {{ old('kelas') == 'XI' ? 'selected' : '' }}>Kelas XI</option>
                                <option value="XII" {{ old('kelas') == 'XII' ? 'selected' : '' }}>Kelas XII</option>
                            </select>
                        </div>
                    </div>

                    <!-- Jurusan -->
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                            </span>
                            <select id="jurusan" name="jurusan" class="form-control" required>
                                <option value="" disabled selected>Pilih jurusan</option>
                                <option value="RPL" {{ old('jurusan') == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak (RPL)</option>
                                <option value="TKJ" {{ old('jurusan') == 'TKJ' ? 'selected' : '' }}>Teknik Komputer & Jaringan (TKJ)</option>
                                <option value="MM" {{ old('jurusan') == 'MM' ? 'selected' : '' }}>Multimedia (MM)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Masa Magang -->
                    <div class="form-group">
                        <label for="masa_magang">Masa Magang</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            </span>
                            <select id="masa_magang" name="masa_magang" class="form-control" required>
                                <option value="" disabled selected>Pilih masa magang</option>
                                <option value="3 Bulan" {{ old('masa_magang') == '3 Bulan' ? 'selected' : '' }}>3 Bulan</option>
                                <option value="6 Bulan" {{ old('masa_magang') == '6 Bulan' ? 'selected' : '' }}>6 Bulan</option>
                            </select>
                            <span class="input-right-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            </span>
                        </div>
                    </div>

                    <!-- Alamat Sekolah (Full Width) -->
                    <div class="form-group full-width">
                        <label for="alamat_sekolah">Alamat Sekolah</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </span>
                            <input type="text" id="alamat_sekolah" name="alamat_sekolah" class="form-control" placeholder="Masukan alamat sekolah" value="{{ old('alamat_sekolah') }}" required>
                        </div>
                    </div>

                    <!-- Nama Guru Pembimbing -->
                    <div class="form-group">
                        <label for="nama_pembimbing">Nama Guru Pembimbing</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </span>
                            <input type="text" id="nama_pembimbing" name="nama_pembimbing" class="form-control" placeholder="Masukkan nama pembimbing" value="{{ old('nama_pembimbing') }}" required>
                        </div>
                    </div>

                    <!-- No. Telepon Pembimbing -->
                    <div class="form-group">
                        <label for="no_telepon_pembimbing">No. Telepon Pembimbing</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </span>
                            <input type="text" id="no_telepon_pembimbing" name="no_telepon_pembimbing" class="form-control" placeholder="Contoh: 081234567890" value="{{ old('no_telepon_pembimbing') }}" required>
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
                    <a href="{{ route('register.step1.process') }}" class="btn-back">
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

</body>
</html>