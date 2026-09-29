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
            padding: 40px 60px;
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
            z-index: 2; align-self: stretch;
            padding: 20px 0;
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

        /* ===== SISI KANAN (CARD) ===== */
        .right-content {
            flex: 1.2; display: flex; justify-content: flex-end;
            align-items: center; z-index: 2;
        }
        .register-card {
            width: 100%; max-width: 500px;
            background: #ffffff; border-radius: 28px;
            padding: 40px 44px 36px;
            box-shadow: 0 20px 45px -10px rgba(30, 58, 138, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        /* CARD HEADER */
        .card-header-title { margin-bottom: 26px; text-align: center; }
        .header-icon-circle {
            width: 76px; height: 76px; margin: 0 auto 16px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 50%; display: flex; align-items: center;
            justify-content: center; color: #2563eb;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.15),
                        inset 0 -2px 6px rgba(37, 99, 235, 0.08);
            position: relative;
        }
        .header-icon-circle::before {
            content: ""; position: absolute; inset: 0;
            border-radius: 50%; border: 2px solid rgba(37, 99, 235, 0.35);
            animation: ringPulse 2.5s ease-out infinite;
        }
        @keyframes ringPulse {
            0% { transform: scale(1); opacity: 0.5; }
            100% { transform: scale(1.4); opacity: 0; }
        }
        .card-header-title h3 {
            font-size: 22px; font-weight: 800; color: #0f172a;
            margin-bottom: 6px; letter-spacing: -0.3px;
        }
        .card-header-title p {
            font-size: 13px; color: #64748b; line-height: 1.55;
            font-weight: 500; padding: 0 10px;
        }

        /* ALERT SUCCESS */
        .alert-success {
            display: flex; align-items: flex-start; gap: 12px;
            background: #dcfce7; border: 1px solid #bbf7d0;
            color: #166534; padding: 14px 16px;
            border-radius: 12px; font-size: 12.5px;
            font-weight: 600; margin-bottom: 18px;
            line-height: 1.5;
        }
        .alert-success svg { flex-shrink: 0; margin-top: 1px; }

        /* ALERT ERROR */
        .alert-error {
            display: flex; align-items: flex-start; gap: 12px;
            background: #fef2f2; border: 1px solid #fecaca;
            color: #dc2626; padding: 14px 16px;
            border-radius: 12px; font-size: 12.5px;
            font-weight: 600; margin-bottom: 18px;
            line-height: 1.5;
        }
        .alert-error svg { flex-shrink: 0; margin-top: 1px; }

        /* FORM */
        .form-group { margin-bottom: 18px; }
        .form-group label {
            display: block; font-size: 13px;
            font-weight: 700; color: #1e293b;
            margin-bottom: 8px;
        }
        .input-wrapper {
            position: relative; display: flex;
            align-items: center;
        }
        .input-icon {
            position: absolute; left: 16px;
            color: #2563eb; display: flex;
            align-items: center; pointer-events: none;
        }
        .form-control {
            width: 100%; height: 50px;
            border: 1.5px solid #bfdbfe;
            border-radius: 12px;
            padding: 0 16px 0 46px;
            font-size: 13.5px; color: #0f172a;
            background: #ffffff;
            transition: all 0.2s ease;
            font-family: inherit;
            font-weight: 500;
        }
        .form-control::placeholder {
            color: #94a3b8; font-weight: 400;
        }
        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        /* INFO BOX */
        .info-note {
            background: #f0f7ff;
            border: 1px solid #d0e1fd;
            border-radius: 12px;
            padding: 12px 14px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 22px;
        }
        .info-note .in-icon {
            color: #2563eb;
            flex-shrink: 0;
            margin-top: 1px;
        }
        .info-note p {
            font-size: 12px;
            color: #334155;
            font-weight: 500;
            line-height: 1.55;
        }

        /* BUTTON */
        .btn-submit {
            width: 100%; height: 50px;
            background: #2563eb;
            border: none; border-radius: 12px;
            color: #ffffff; font-size: 14px;
            font-weight: 700;
            display: flex; align-items: center;
            justify-content: center; gap: 10px;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.28);
            transition: all 0.2s ease;
            font-family: inherit;
        }
        .btn-submit:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.4);
        }
        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        /* BACK LINK */
        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .back-link:hover {
            color: #2563eb;
        }
        .back-link svg {
            transition: transform 0.2s ease;
        }
        .back-link:hover svg {
            transform: translateX(-3px);
        }

        /* RESPONSIVE */
        @media (max-width: 1100px) {
            .register-wrapper { flex-direction: column; padding: 30px 20px; justify-content: center; }
            .left-content { max-width: 100%; margin-bottom: 30px; align-items: center; text-align: center; }
            .illustration-box, .floating-badge { display: none; }
            .right-content { width: 100%; justify-content: center; }
            .register-card { max-width: 100%; }
        }
        @media (max-width: 640px) {
            .register-card { padding: 30px 24px 26px; }
            .main-title { font-size: 24px; }
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

            <div class="step-badge">Lupa Password</div>

            <h1 class="main-title">
                Jangan panik,<br>
                <span>kamu bisa reset</span><br>
                <span>password-mu kok</span>
            </h1>

            <p class="main-desc">
                Masukkan email yang terdaftar,<br>
                kami akan kirimkan tautan untuk reset password-mu.
            </p>
        </div>

        <div class="illustration-box">
            <img src="{{ asset('images/register.png') }}" alt="Ilustrasi Lupa Password" class="register-img">
        </div>
    </div>

    <!-- SISI KANAN (CARD LUPA PASSWORD) -->
    <div class="right-content">
        <div class="register-card">

            <div class="card-header-title">
                <div class="header-icon-circle">
                    <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        <circle cx="12" cy="16" r="1.2"/>
                    </svg>
                </div>
                <h3>Lupa Password?</h3>
                <p>Masukkan email yang terdaftar.<br>Kami akan kirim tautan untuk mengatur ulang password.</p>
            </div>

            <!-- Alert Success -->
            @if (session('status'))
                <div class="alert-success">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <!-- Alert Error -->
            @if ($errors->any())
                <div class="alert-error">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- FORM -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            placeholder="contoh@email.com"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <div class="info-note">
                    <span class="in-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="16" x2="12" y2="12"/>
                            <line x1="12" y1="8" x2="12.01" y2="8"/>
                        </svg>
                    </span>
                    <p>
                        Pastikan email yang kamu masukkan sudah benar. Cek juga folder <strong>Spam</strong> jika email tidak masuk dalam beberapa menit.
                    </p>
                </div>

                <button type="submit" class="btn-submit">
                    <span>Kirim Tautan Reset</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </button>
            </form>

            <a href="{{ route('login') }}" class="back-link transition-link" data-transition="back">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"/>
                    <polyline points="12 19 5 12 12 5"/>
                </svg>
                <span>Kembali ke Login</span>
            </a>

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
