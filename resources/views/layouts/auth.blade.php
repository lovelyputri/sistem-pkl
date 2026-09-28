<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'GUSPELOR.NET')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            overflow-x: hidden;
        }

        body {
            min-height: 100vh;
        }

        /* ==========================================
           BACKGROUND UTAMA
        ========================================== */

        .login-wrapper {
            width: 100%;
            min-height: 100vh;

            position: relative;

            background-image:
                linear-gradient(
                    rgba(255, 255, 255, 0.10),
                    rgba(255, 255, 255, 0.10)
                ),
                url('/images/bg.png');

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            display: flex;
            align-items: flex-start;
            justify-content: space-between;

            overflow: hidden;

            padding: 30px 40px 30px;
            gap: 30px;
        }

        /* Overlay background */

        .login-wrapper::before {
            content: "";

            position: absolute;
            inset: 0;

            background:
                linear-gradient(
                    90deg,
                    rgba(255, 255, 255, 0.18) 0%,
                    rgba(255, 255, 255, 0.05) 50%,
                    rgba(255, 255, 255, 0.12) 100%
                );

            pointer-events: none;

            z-index: 0;
        }

        /* ==========================================
           ANIMASI
        ========================================== */

        @keyframes floatSlow {
            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-14px) rotate(4deg);
            }
        }

        @keyframes floatMedium {
            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(-3deg);
            }
        }

        @keyframes alertShake {
            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-8px);
            }

            40%,
            80% {
                transform: translateX(8px);
            }
        }

        @keyframes cardGlow {
            0%,
            100% {
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
            0% {
                transform: scale(1);
                opacity: 0.5;
            }

            100% {
                transform: scale(1.4);
                opacity: 0;
            }
        }

        @keyframes shimmerLine {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        /* ==========================================
           FLOATING BADGE
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

            box-shadow:
                0 10px 25px rgba(37, 99, 235, 0.12);

            border:
                1px solid rgba(255, 255, 255, 0.8);

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

        .badge-1 {
            top: 14%;
            left: 42%;

            animation:
                floatSlow
                5s
                ease-in-out
                infinite;
        }

        .badge-1 .badge-icon {
            background: #dbeafe;
            color: #2563eb;
        }

        .badge-2 {
            top: 48%;
            left: 36%;

            animation:
                floatMedium
                4s
                ease-in-out
                infinite
                1s;
        }

        .badge-2 .badge-icon {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-3 {
            bottom: 18%;
            left: 48%;

            animation:
                floatSlow
                6s
                ease-in-out
                infinite
                0.5s;
        }

        .badge-3 .badge-icon {
            background: #fef3c7;
            color: #d97706;
        }

        /* ==========================================
           AREA KIRI
        ========================================== */

        .left-content {
            position: relative;

            z-index: 5;

            flex: 1;

            max-width: 460px;

            align-self: flex-start;

            display: flex;

            flex-direction: column;

            justify-content: flex-start;
        }

        /* ==========================================
           BRAND
        ========================================== */

        .brand {
            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 22px;
        }

        .brand-icon {
            width: 40px;
            height: 40px;

            background: #ffffff;

            border-radius: 12px;

            display: flex;

            align-items: center;
            justify-content: center;

            overflow: hidden;

            box-shadow:
                0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .brand-icon img {
            width: 100%;
            height: 100%;

            object-fit: contain;

            padding: 5px;
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

        /* ==========================================
           JUDUL
        ========================================== */

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

        /* ==========================================
           FEATURE
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

            background:
                rgba(255, 255, 255, 0.45);

            backdrop-filter: blur(12px);

            -webkit-backdrop-filter: blur(12px);

            border:
                1px solid rgba(255, 255, 255, 0.75);

            border-radius: 12px;

            padding: 8px 12px;

            box-shadow:
                0 4px 15px rgba(37, 99, 235, 0.06);

            transition:
                all 0.25s ease;
        }

        .feature-item:hover {
            background:
                rgba(255, 255, 255, 0.65);

            box-shadow:
                0 6px 20px rgba(37, 99, 235, 0.12);

            transform:
                translateY(-2px);
        }

        .feature-icon {
            width: 36px;
            height: 36px;

            background: #ffffff;

            border:
                1.5px solid #bfdbfe;

            border-radius: 10px;

            display: flex;

            align-items: center;
            justify-content: center;

            color: #2563eb;

            flex-shrink: 0;

            box-shadow:
                0 2px 6px rgba(37, 99, 235, 0.06);
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
           AREA KANAN
        ========================================== */

        .right-content {
            position: relative;

            z-index: 5;

            flex: 1;

            display: flex;

            justify-content: flex-end;

            align-items: flex-start;
        }

        /* ==========================================
           LOGIN CARD
        ========================================== */

        .login-card {
            width: 100%;

            max-width: 470px;

            min-height: 640px;

            border-radius: 30px;

            padding: 55px 45px;

            display: flex;

            flex-direction: column;

            justify-content: space-between;

            position: relative;

            overflow: hidden;

            background-color:
                rgba(255, 255, 255, 0.96);

            background-image:
                radial-gradient(
                    rgba(37, 99, 235, 0.055) 1px,
                    transparent 1px
                );

            background-size: 18px 18px;

            border:
                1px solid #e6efff;

            box-shadow:
                0 25px 50px -12px rgba(30, 58, 138, 0.12);

            animation:
                cardGlow
                4s
                ease-in-out
                infinite;
        }

        .login-card::before {
            content: "";

            position: absolute;

            top: 0;
            left: 0;
            right: 0;

            height: 4px;

            background:
                linear-gradient(
                    90deg,
                    #2563eb 0%,
                    #60a5fa 25%,
                    #a5c8ff 50%,
                    #60a5fa 75%,
                    #2563eb 100%
                );

            background-size: 200% 100%;

            border-radius:
                30px 30px 0 0;

            animation:
                shimmerLine
                3s
                linear
                infinite;

            z-index: 2;
        }

        .login-card::after {
            content: "";

            position: absolute;

            top: -60px;
            right: -60px;

            width: 200px;
            height: 200px;

            background:
                radial-gradient(
                    circle,
                    rgba(37, 99, 235, 0.10) 0%,
                    transparent 70%
                );

            border-radius: 50%;

            pointer-events: none;

            z-index: 0;
        }

        .login-card > * {
            position: relative;

            z-index: 1;
        }

        /* ==========================================
           CARD HEADER
        ========================================== */

        .card-header {
            text-align: center;

            margin-bottom: 36px;
        }

        .card-header-icon {
            width: 76px;
            height: 76px;

            margin:
                0 auto 14px;

            background:
                linear-gradient(
                    135deg,
                    #eff6ff 0%,
                    #dbeafe 100%
                );

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            box-shadow:
                0 8px 20px rgba(37, 99, 235, 0.15),
                inset 0 -2px 6px rgba(37, 99, 235, 0.08);

            position: relative;

            overflow: visible;
        }

        .card-header-icon img {
            width: 100%;
            height: 100%;

            object-fit: contain;

            padding: 10px;

            border-radius: 50%;

            position: relative;

            z-index: 2;
        }

        .card-header-icon::before {
            content: "";

            position: absolute;

            inset: 0;

            border-radius: 50%;

            border:
                2px solid rgba(37, 99, 235, 0.35);

            animation:
                ringPulse
                2.5s
                ease-out
                infinite;
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

        /* ==========================================
           ALERT
        ========================================== */

        .alert-error {
            display: flex;

            align-items: center;

            gap: 12px;

            background: #fef2f2;

            border:
                1px solid #fecaca;

            color: #dc2626;

            padding: 12px 16px;

            border-radius: 12px;

            font-size: 12.5px;

            font-weight: 600;

            margin-bottom: 18px;

            animation:
                alertShake
                0.4s
                cubic-bezier(.36,.07,.19,.97)
                both;
        }

        .alert-error svg {
            flex-shrink: 0;
        }

        /* ==========================================
           FORM
        ========================================== */

        .form-group {
            margin-bottom: 18px;
        }

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

            border:
                1.5px solid #bfdbfe;

            border-radius: 12px;

            padding:
                0 44px 0 46px;

            font-size: 13.5px;

            color: #0f172a;

            background: #ffffff;

            transition:
                all 0.2s ease;
        }

        .form-control:focus {
            outline: none;

            border-color: #2563eb;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, 0.15);
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

        /* ==========================================
           OPTIONS
        ========================================== */

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

        /* ==========================================
           BUTTON
        ========================================== */

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

            box-shadow:
                0 4px 14px rgba(37, 99, 235, 0.28);

            transition:
                all 0.2s ease;
        }

        .btn-submit:hover {
            background: #1d4ed8;

            transform:
                translateY(-1px);
        }

        /* ==========================================
           FOOTER
        ========================================== */

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

                padding:
                    30px 20px;

                align-items: center;
            }

            .floating-badge {
                display: none;
            }

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
                max-width: 500px;

                min-height: auto;
            }

            .feature-list {
                width: 100%;

                max-width: 500px;
            }

            .main-desc {
                max-width: 600px;
            }
        }

        @media (max-width: 600px) {

            .login-wrapper {
                padding:
                    20px 15px 30px;

                gap: 25px;
            }

            .main-title {
                font-size: 25px;
            }

            .main-desc {
                font-size: 12px;

                margin-bottom: 20px;
            }

            .login-card {
                width: 100%;

                padding:
                    40px 25px;

                border-radius: 24px;
            }

            .card-header {
                margin-bottom: 28px;
            }

            .card-header-icon {
                width: 68px;
                height: 68px;
            }

            .card-header h1 {
                font-size: 20px;
            }

            .form-options {
                gap: 10px;
            }

            .remember-me,
            .forgot-link {
                font-size: 12px;
            }
        }

        @media (max-width: 380px) {

            .login-wrapper {
                padding-left: 12px;
                padding-right: 12px;
            }

            .login-card {
                padding:
                    35px 20px;
            }

            .main-title {
                font-size: 22px;
            }

            .feature-info h4 {
                font-size: 12.5px;
            }

            .feature-info p {
                font-size: 11px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    @yield('content')

    @stack('scripts')

</body>

</html>