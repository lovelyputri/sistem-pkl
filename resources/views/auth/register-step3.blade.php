<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Verifikasi - GUSPELOR.NET</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body {
            width: 100%; min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            background: linear-gradient(135deg, #f0f6ff 0%, #e5effd 100%);
            overflow-x: hidden;
        }

        .register-wrapper {
            width: 100%; min-height: 100vh;
            display: flex; align-items: center; justify-content: space-between;
            padding: 40px 60px 0 60px;
            position: relative; overflow: hidden;
        }

        /* ===== FLOATING BADGE ===== */
        @keyframes floatSlow {
            0%, 100% { transform: translate(-50%, 0) rotate(0deg); }
            50%      { transform: translate(-50%, -14px) rotate(4deg); }
        }
        @keyframes floatMedium {
            0%, 100% { transform: translate(-50%, 0) rotate(0deg); }
            50%      { transform: translate(-50%, -10px) rotate(-3deg); }
        }
        .floating-badge {
            position: absolute; z-index: 3; background: #ffffff;
            padding: 10px 16px; border-radius: 16px;
            display: flex; align-items: center; gap: 10px;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.8);
            pointer-events: none;
        }
        .floating-badge .badge-icon {
            width: 32px; height: 32px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .floating-badge span { font-size: 12px; font-weight: 700; color: #1e293b; }

        .badge-1 { top: 18%; left: 46%; animation: floatSlow 5s ease-in-out infinite; }
        .badge-1 .badge-icon { background: #dbeafe; color: #2563eb; }
        .badge-2 { top: 48%; left: 32%; animation: floatMedium 4s ease-in-out infinite 1s; }
        .badge-2 .badge-icon { background: #dcfce7; color: #16a34a; }
        .badge-3 { top: 76%; left: 44%; animation: floatSlow 6s ease-in-out infinite 0.5s; }
        .badge-3 .badge-icon { background: #fef3c7; color: #d97706; }

        /* ===== SISI KIRI ===== */
        .left-content {
            flex: 1; max-width: 500px;
            display: flex; flex-direction: column;
            justify-content: space-between;
            z-index: 2; align-self: stretch; padding-top: 10px;
        }
        .brand { display: flex; align-items: center; gap: 12px; margin-bottom: 24px; }
        .brand-icon {
            width: 40px; height: 40px; background: #2563eb;
            border-radius: 10px; display: flex; align-items: center;
            justify-content: center; color: #fff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }
        .brand-text h2 { font-size: 16px; font-weight: 800; color: #0f172a; line-height: 1.1; letter-spacing: -0.2px; }
        .brand-text p { font-size: 11px; color: #64748b; font-weight: 600; margin-top: 1px; }
        .step-badge {
            display: inline-block; background: #dbeafe; color: #2563eb;
            font-size: 12px; font-weight: 700; padding: 6px 14px;
            border-radius: 20px; margin-bottom: 16px; width: fit-content;
        }
        .main-title {
            font-size: 30px; font-weight: 800; color: #0f172a;
            line-height: 1.25; margin-bottom: 12px; letter-spacing: -0.5px;
        }
        .main-title span { color: #2563eb; }
        .main-desc { font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 16px; font-weight: 500; }
        .illustration-box {
            width: calc(100% + 60px); margin-left: -60px; margin-bottom: 0;
            display: flex; justify-content: flex-start; align-items: flex-end; margin-top: auto;
        }
        .register-img {
            width: 108%; max-width: 500px; height: auto;
            object-fit: contain; pointer-events: none;
            filter: drop-shadow(0 10px 20px rgba(37, 99, 235, 0.08));
        }

        /* ===== SISI KANAN ===== */
        .right-content {
            flex: 1.2; display: flex; justify-content: flex-end;
            align-items: center; z-index: 2; padding-bottom: 40px;
        }
        .register-card {
            width: 100%; max-width: 680px;
            background: #ffffff; border-radius: 28px;
            padding: 36px 40px 32px;
            box-shadow: 0 20px 45px -10px rgba(30, 58, 138, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        /* STEPPER */
        .stepper {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 26px; padding: 0 20px; position: relative;
        }
        .step-item { display: flex; flex-direction: column; align-items: center; gap: 6px; position: relative; z-index: 2; }
        .step-circle {
            width: 36px; height: 36px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700;
            background: #ffffff; border: 2px solid #e2e8f0; color: #94a3b8;
            transition: all 0.3s ease;
        }
        .step-item.completed .step-circle { background: #ffffff; border-color: #cbd5e1; color: #2563eb; }
        .step-item.completed .step-label { color: #64748b; font-weight: 600; }
        .step-item.active .step-circle {
            background: #2563eb; border-color: #2563eb; color: #fff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        .step-label { font-size: 11.5px; font-weight: 600; color: #94a3b8; }
        .step-item.active .step-label { color: #2563eb; font-weight: 700; }
        .step-line { flex: 1; height: 2px; background: #e2e8f0; margin: 0 12px; position: relative; top: -12px; z-index: 1; }
        .step-line.completed { background: #cbd5e1; }

        /* ===== VERIFIKASI CONTENT ===== */
        .verify-wrap {
            text-align: center;
            padding: 0 4px;
        }

        .verify-img {
            width: 200px;
            max-width: 60%;
            height: auto;
            margin: 0 auto 12px;
            display: block;
            filter: drop-shadow(0 10px 25px rgba(37, 99, 235, 0.15));
            animation: floatVerify 4s ease-in-out infinite;
        }
        @keyframes floatVerify {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-8px); }
        }

        .verify-title {
            font-size: 22px;
            font-weight: 800;
            color: #2563eb;
            margin-bottom: 8px;
            letter-spacing: -0.3px;
        }

        .verify-desc {
            font-size: 13px;
            color: #64748b;
            line-height: 1.65;
            font-weight: 500;
            margin-bottom: 22px;
        }
        .verify-desc strong { color: #0f172a; font-weight: 800; }

        /* ===== INFO BOXES ===== */
        .info-box-blue {
            background: #e0eeff;
            border-radius: 16px;
            padding: 16px 18px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            text-align: left;
            margin-bottom: 14px;
        }
        .info-box-blue .ib-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #ffffff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-weight: 800;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.1);
        }
        .info-box-blue .ib-text h4 {
            font-size: 12.5px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
            line-height: 1.45;
        }
        .info-box-blue .ib-text p {
            font-size: 11.5px;
            color: #475569;
            line-height: 1.55;
            font-weight: 500;
        }

        .info-box-white {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px 18px;
            text-align: left;
            margin-bottom: 22px;
        }
        .info-box-white h5 {
            font-size: 12.5px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 12px;
        }
        .info-box-white ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .info-box-white ul li {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 12px;
            color: #475569;
            font-weight: 600;
            line-height: 1.45;
        }
        .info-box-white ul li svg {
            flex-shrink: 0;
            color: #2563eb;
        }

        /* ===== ACTIONS (SEJAJAR) ===== */
        .verify-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 8px;
            flex-wrap: nowrap;
        }

        .btn-back-gray,
        .btn-finish {
            display: inline-flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            height: 46px;
            padding: 0 26px;
            border-radius: 30px;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            line-height: 1;
            white-space: nowrap;
            transition: all 0.2s ease;
            box-sizing: border-box;
            cursor: pointer;
        }

        /* KUNCI: SVG block biar sejajar tengah */
        .btn-back-gray svg,
        .btn-finish svg {
            display: block !important;
            flex-shrink: 0 !important;
            width: 16px;
            height: 16px;
            position: relative;
            top: 1px;
        }

        .btn-back-gray span,
        .btn-finish span {
            display: inline-block;
            line-height: 1;
        }

        .btn-back-gray {
            background: #ffffff;
            border: 1.5px solid #d0e1fd;
            color: #2563eb;
            flex-shrink: 0;
        }
        .btn-back-gray:hover {
            background: #f0f7ff;
            border-color: #bfdbfe;
            transform: translateX(-2px);
        }

        .btn-finish {
            background: #2563eb;
            border: none;
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
            flex: 1;
            max-width: 240px;
        }
        .btn-finish:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.4);
        }

        /* ===== TOAST ===== */
        #toastContainer {
            position: fixed !important;
            top: 20px !important;
            right: 20px !important;
            z-index: 999999 !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 12px !important;
            max-width: 400px !important;
            pointer-events: none !important;
        }

        .toast {
            display: flex !important;
            align-items: flex-start !important;
            gap: 12px !important;
            background: #ffffff !important;
            border-radius: 14px !important;
            padding: 14px 16px !important;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.18) !important;
            border-left: 4px solid #2563eb !important;
            pointer-events: auto !important;
            animation: toastIn 0.3s cubic-bezier(0.22, 1, 0.36, 1) !important;
            position: relative !important;
            overflow: hidden !important;
            min-width: 300px !important;
        }

        @keyframes toastIn {
            from { opacity: 0; transform: translateX(60px) scale(0.95); }
            to   { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes toastOut {
            from { opacity: 1; transform: translateX(0); }
            to   { opacity: 0; transform: translateX(60px); }
        }

        .toast.hiding { animation: toastOut 0.25s ease forwards !important; }

        .toast-icon {
            width: 32px; height: 32px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .toast-body { flex: 1; min-width: 0; }
        .toast-title {
            font-size: 13px; font-weight: 800; color: #0f172a; margin-bottom: 2px;
        }
        .toast-message {
            font-size: 12px; color: #475569; font-weight: 500;
            line-height: 1.4; word-wrap: break-word;
        }
        .toast-close {
            background: none; border: none; color: #94a3b8;
            cursor: pointer; padding: 2px; display: flex;
            align-items: center; flex-shrink: 0;
        }
        .toast-close:hover { color: #dc2626; }

        .toast.success { border-left-color: #16a34a !important; }
        .toast.success .toast-icon { background: #dcfce7; color: #16a34a; }
        .toast.error { border-left-color: #dc2626 !important; }
        .toast.error .toast-icon { background: #fee2e2; color: #dc2626; }
        .toast.warning { border-left-color: #d97706 !important; }
        .toast.warning .toast-icon { background: #fef3c7; color: #d97706; }
        .toast.info { border-left-color: #2563eb !important; }
        .toast.info .toast-icon { background: #dbeafe; color: #2563eb; }

        .toast-progress {
            position: absolute; bottom: 0; left: 0;
            height: 2px; background: currentColor; opacity: 0.4;
            animation: toastProgress 3.5s linear forwards;
        }
        @keyframes toastProgress {
            from { width: 100%; }
            to   { width: 0%; }
        }

        /* ===== MODAL ===== */
        #modalOverlay {
            position: fixed !important;
            inset: 0 !important;
            background: rgba(15, 23, 42, 0.55) !important;
            backdrop-filter: blur(4px) !important;
            z-index: 999998 !important;
            display: none !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 20px !important;
        }
        #modalOverlay.active {
            display: flex !important;
            animation: fadeIn 0.2s ease !important;
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        .modal-box {
            background: #ffffff;
            border-radius: 24px;
            padding: 32px 28px 24px;
            max-width: 440px;
            width: 100%;
            text-align: center;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            animation: modalIn 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.9) translateY(15px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }

        .modal-icon {
            width: 68px; height: 68px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
        }
        .modal-icon.success { background: #dcfce7; color: #16a34a; }
        .modal-icon.error { background: #fee2e2; color: #dc2626; }
        .modal-icon.warning { background: #fef3c7; color: #d97706; }
        .modal-icon.info { background: #dbeafe; color: #2563eb; }

        .modal-title {
            font-size: 19px; font-weight: 800;
            color: #0f172a; margin-bottom: 8px;
        }
        .modal-message {
            font-size: 13px; color: #64748b; font-weight: 500;
            line-height: 1.55; margin-bottom: 20px;
        }
        .modal-btn-row {
            display: flex;
            gap: 10px;
        }
        .modal-btn {
            flex: 1;
            height: 48px; border-radius: 12px;
            border: none; font-size: 14px; font-weight: 700;
            cursor: pointer; transition: all 0.2s ease;
            color: #ffffff; background: #2563eb;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
        }
        .modal-btn:hover { background: #1d4ed8; transform: translateY(-1px); }
        .modal-btn.secondary {
            background: #ffffff;
            color: #334155;
            border: 1.5px solid #e2e8f0;
            box-shadow: none;
        }
        .modal-btn.secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }
        .modal-btn.success { background: #16a34a; box-shadow: 0 4px 14px rgba(22, 163, 74, 0.3); }
        .modal-btn.success:hover { background: #15803d; }
        .modal-btn.warning {
            background: #d97706;
            box-shadow: 0 4px 14px rgba(217, 119, 6, 0.3);
        }
        .modal-btn.warning:hover { background: #b45309; }

        /* RESPONSIVE */
        @media (max-width: 1100px) {
            .register-wrapper { flex-direction: column; padding: 30px 20px; }
            .left-content { max-width: 100%; margin-bottom: 30px; }
            .right-content { width: 100%; justify-content: center; padding-bottom: 0; }
            .illustration-box, .floating-badge { display: none; }
        }
        @media (max-width: 640px) {
            .register-card { padding: 24px 20px; }
            .verify-actions { flex-direction: column-reverse; }
            .btn-finish { max-width: 100%; width: 100%; }
            .btn-back-gray { width: 100%; justify-content: center; }
            #toastContainer { top: 12px !important; right: 12px !important; left: 12px !important; max-width: none !important; }
            .toast { min-width: auto !important; }
        }

        /* ===== SLIDE PAGE TRANSITION ===== */
        @keyframes slideInFromRight { 0% { opacity: 0; transform: translateX(60px); } 100% { opacity: 1; transform: translateX(0); } }
        @keyframes slideInFromLeft  { 0% { opacity: 0; transform: translateX(-60px); } 100% { opacity: 1; transform: translateX(0); } }
        @keyframes slideOutToLeft   { 0% { opacity: 1; transform: translateX(0); } 100% { opacity: 0; transform: translateX(-60px); } }
        @keyframes slideOutToRight  { 0% { opacity: 1; transform: translateX(0); } 100% { opacity: 0; transform: translateX(60px); } }

        .page-transition-wrap { width: 100%; min-height: 100vh; will-change: transform, opacity; }
        body.enter-from-right .page-transition-wrap { animation: slideInFromRight 0.55s cubic-bezier(0.22, 1, 0.36, 1) both; }
        body.enter-from-left  .page-transition-wrap { animation: slideInFromLeft  0.55s cubic-bezier(0.22, 1, 0.36, 1) both; }
        body.leave-to-left    .page-transition-wrap { animation: slideOutToLeft   0.45s cubic-bezier(0.55, 0, 0.55, 0.2) forwards; }
        body.leave-to-right   .page-transition-wrap { animation: slideOutToRight  0.45s cubic-bezier(0.55, 0, 0.55, 0.2) forwards; }
    </style>
</head>
<body>

<!-- TOAST CONTAINER -->
<div id="toastContainer"></div>

<!-- MODAL OVERLAY -->
<div id="modalOverlay">
    <div class="modal-box" id="modalBox"></div>
</div>

<div class="page-transition-wrap">
<div class="register-wrapper">

    <!-- FLOATING BADGE -->
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

    <!-- SISI KIRI -->
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

            <div class="step-badge">Langkah 3 dari 3</div>

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

        <div class="illustration-box">
            <img src="{{ asset('images/register.png') }}" alt="Ilustrasi Register" class="register-img">
        </div>
    </div>

    <!-- SISI KANAN -->
    <div class="right-content">
        <div class="register-card">

            <!-- STEPPER -->
            <div class="stepper">
                <div class="step-item completed">
                    <div class="step-circle">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <span class="step-label">Data Diri</span>
                </div>
                <div class="step-line completed"></div>
                <div class="step-item completed">
                    <div class="step-circle">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <span class="step-label">Data Sekolah</span>
                </div>
                <div class="step-line completed"></div>
                <div class="step-item active">
                    <div class="step-circle">3</div>
                    <span class="step-label">Verifikasi</span>
                </div>
            </div>

            <!-- ISI VERIFIKASI -->
            <div class="verify-wrap">

                <img src="{{ asset('images/register3.png') }}" alt="Verifikasi" class="verify-img">

                <h2 class="verify-title">Pendaftaran Berhasil!</h2>
                <p class="verify-desc">
                    Terima kasih telah mendaftar di GUSPELOR.NET<br>
                    Akun kamu sedang dalam proses <strong>verifikasi oleh admin</strong>.
                </p>

                <div class="info-box-blue">
                    <div class="ib-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="16" x2="12" y2="12"/>
                            <line x1="12" y1="8" x2="12.01" y2="8"/>
                        </svg>
                    </div>
                    <div class="ib-text">
                        <h4>Mohon tunggu konfirmasi melalui email atau WhatsApp.</h4>
                        <p>Pastikan data yang kamu masukkan sudah benar.<br>Setelah disetujui, kamu akan bisa masuk ke dashboard.</p>
                    </div>
                </div>

                <div class="info-box-white">
                    <h5>Apa yang terjadi selanjutnya?</h5>
                    <ul>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            Admin akan memverifikasi data kamu
                        </li>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                            Kamu akan menerima notifikasi jika akan disetujui
                        </li>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            Setelah disetujui, kamu bisa login dan mulai menggunakan sistem
                        </li>
                    </ul>
                </div>

                <!-- ACTIONS -->
                <div class="verify-actions">
                    <a href="{{ route('register.step2') }}"
                       class="btn-back-gray"
                       id="btnBack"
                       data-transition="back">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"/>
                            <polyline points="12 19 5 12 12 5"/>
                        </svg>
                        <span>Kembali</span>
                    </a>

                   <form action="{{ route('register.finish') }}" method="POST" id="finishForm">
                        @csrf

                        <button type="submit" class="btn-finish" id="btnFinish">
                            <span>Selesai</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </div>

</div>
</div>


<script>

// ==========================================
// TOAST SYSTEM
// ==========================================
const Toast = {
    _closeCurrent: function() {
        const container = document.getElementById('toastContainer');
        if (!container) return;
        container.querySelectorAll('.toast').forEach(function(el) {
            el.classList.add('hiding');
            setTimeout(function() { el.remove(); }, 250);
        });
    },

    show: function(type, title, message, duration) {
        duration = duration || 3500;
        try {
            const container = document.getElementById('toastContainer');
            if (!container) return;

            this._closeCurrent();

            const icons = {
                success: '<polyline points="20 6 9 17 4 12"/>',
                error: '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>',
                warning: '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
                info: '<circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>'
            };

            const toast = document.createElement('div');
            toast.className = 'toast ' + type;
            toast.innerHTML =
                '<div class="toast-icon">' +
                    '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">' +
                        (icons[type] || icons.info) +
                    '</svg>' +
                '</div>' +
                '<div class="toast-body">' +
                    '<div class="toast-title">' + title + '</div>' +
                    '<div class="toast-message">' + message + '</div>' +
                '</div>' +
                '<button class="toast-close" type="button">' +
                    '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">' +
                        '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>' +
                    '</svg>' +
                '</button>' +
                '<div class="toast-progress"></div>';

            setTimeout(function() { container.appendChild(toast); }, 50);

            const removeToast = function() {
                if (!toast.parentElement) return;
                toast.classList.add('hiding');
                setTimeout(function() { toast.remove(); }, 250);
            };

            const timeout = setTimeout(removeToast, duration);
            toast.querySelector('.toast-close').addEventListener('click', function() {
                clearTimeout(timeout);
                removeToast();
            });
        } catch(err) { console.error('Toast error:', err); }
    },

    success: function(t, m) { this.show('success', t, m); },
    error:   function(t, m) { this.show('error', t, m); },
    warning: function(t, m) { this.show('warning', t, m); },
    info:    function(t, m) { this.show('info', t, m); }
};


// ==========================================
// MODAL SYSTEM (dengan tombol custom)
// ==========================================
const Modal = {
    show: function(options) {
        try {
            const overlay = document.getElementById('modalOverlay');
            const box = document.getElementById('modalBox');
            if (!overlay || !box) return;

            const type = options.type || 'info';
            const title = options.title || '';
            const message = options.message || '';
            const buttons = options.buttons || [{ text: 'OK', class: type }];

            const icons = {
                success: '<polyline points="20 6 9 17 4 12" stroke-width="3"/>',
                error: '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>',
                warning: '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
                info: '<circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>'
            };

            let buttonsHTML = '<div class="modal-btn-row">';
            buttons.forEach(function(btn, i) {
                const cls = btn.class || type;
                buttonsHTML +=
                    '<button type="button" class="modal-btn ' + cls + '" data-btn-index="' + i + '">' +
                        btn.text +
                    '</button>';
            });
            buttonsHTML += '</div>';

            box.innerHTML =
                '<div class="modal-icon ' + type + '">' +
                    '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">' +
                        (icons[type] || icons.info) +
                    '</svg>' +
                '</div>' +
                '<div class="modal-title">' + title + '</div>' +
                '<div class="modal-message">' + message + '</div>' +
                buttonsHTML;

            overlay.classList.add('active');

            const closeModal = function() {
                overlay.classList.remove('active');
            };

            box.querySelectorAll('.modal-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const idx = parseInt(btn.getAttribute('data-btn-index'), 10);
                    const handler = buttons[idx] && buttons[idx].onClick;
                    closeModal();
                    if (typeof handler === 'function') handler();
                });
            });

            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) closeModal();
            });

        } catch(err) { console.error('Modal error:', err); }
    }
};


// ==========================================
// SLIDE PAGE TRANSITION
// ==========================================
(function () {
    const KEY = 'pageTransition';

    document.addEventListener('DOMContentLoaded', function () {
        const incoming = sessionStorage.getItem(KEY);
        if (incoming === 'forward') document.body.classList.add('enter-from-right');
        else if (incoming === 'back') document.body.classList.add('enter-from-left');
        sessionStorage.removeItem(KEY);

        // Link dengan data-transition (generic)
        document.querySelectorAll('a[data-transition]').forEach(function (link) {
            link.addEventListener('click', function (e) {
                const href = link.getAttribute('href');
                if (!href || href.startsWith('#') || href.startsWith('javascript')) return;
                e.preventDefault();
                const dir = link.getAttribute('data-transition');
                sessionStorage.setItem(KEY, dir);
                document.body.classList.add(dir === 'forward' ? 'leave-to-left' : 'leave-to-right');
                setTimeout(function () { window.location.href = href; }, 430);
            });
        });

        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                document.body.classList.remove('leave-to-left', 'leave-to-right');
                document.body.classList.add('enter-from-left');
            }
        });
    });
})();


// ==========================================
// HALAMAN VERIFIKASI — INTERAKSI
// ==========================================
document.addEventListener('DOMContentLoaded', function () {

    // ====== TOAST SAMBUTAN ======
    setTimeout(function () {
        Toast.success(
            'Pendaftaran Berhasil! 🎉',
            'Akun kamu sedang diverifikasi oleh admin'
        );
    }, 500);

    setTimeout(function () {
        Toast.info(
            'Cek Email / WhatsApp',
            'Kami akan mengabari setelah verifikasi selesai'
        );
    }, 4500);


    // ====== TOMBOL SELESAI — modal sukses + submit ======
    const btnFinish = document.getElementById('btnFinish');
    const finishForm = document.getElementById('finishForm');

    if (btnFinish && finishForm) {
        btnFinish.addEventListener('click', function (e) {
            e.preventDefault();

            Modal.show({
                type: 'success',
                title: 'Pendaftaran Selesai! 🎉',
                message: 'Data pendaftaran kamu akan disimpan dan dikirim untuk proses verifikasi admin.',
                buttons: [
                    {
                        text: 'Ke Halaman Login',
                        class: 'success',
                        onClick: function () {

                            Toast.success(
                                'Berhasil!',
                                'Menyimpan data pendaftaran...'
                            );

                            sessionStorage.setItem(
                                'pageTransition',
                                'forward'
                            );

                            document.body.classList.add(
                                'leave-to-left'
                            );

                            setTimeout(function () {
                                finishForm.submit();
                            }, 600);
                        }
                    }
                ]
            });
        });
    }
});

</script>

</body>
</html>