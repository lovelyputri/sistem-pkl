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

        /* ===== ACTIONS (FIXED - SEJAJAR) ===== */
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
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
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
        }

        /* KUNCI: SVG jadi block biar sejajar tengah */
        .btn-back-gray svg,
        .btn-finish svg {
            display: block;
            flex-shrink: 0;
            width: 16px;
            height: 16px;
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
        .transition-link { transition: transform 0.2s ease, color 0.2s ease; display: inline-block; }
        .transition-link:hover { transform: translateX(2px); color: #2563eb !important; }
    </style>
</head>
<body>

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

                <!-- GAMBAR REGISTER3 -->
                <img src="{{ asset('images/register3.png') }}" alt="Verifikasi" class="verify-img">

                <h2 class="verify-title">Pendaftaran Berhasil!</h2>
                <p class="verify-desc">
                    Terima kasih telah mendaftar di GUSPELOR.NET<br>
                    Akun kamu sedang dalam proses <strong>verifikasi oleh admin</strong>.
                </p>

                <!-- INFO BOX BIRU -->
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

                <!-- INFO BOX PUTIH -->
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

                <!-- ACTIONS (SEJAJAR) -->
                <div class="verify-actions">
                    <a href="{{ route('register.step2') }}" class="btn-back-gray">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"/>
                            <polyline points="12 19 5 12 12 5"/>
                        </svg>
                        <span>Kembali ke Data Sekolah</span>
                    </a>

                    <a href="{{ route('login') }}" class="btn-finish">
                        <span>Selesai</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>
</div>

<script>
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
</script>

</body>
</html>
