<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GUSPELOR.NET')</title>

    <!-- Google Fonts: Inter (mirip dengan font di gambar) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #eaf4ff; /* Warna latar belakang halaman */
        }

        /* Container Utama untuk memusatkan konten */
        .login-page {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Kotak utama yang menampung gambar dan form */
        .login-container {
            width: 100%;
            max-width: 1300px;
            min-height: 800px;
            display: flex;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 70, 160, 0.1);
            position: relative;
        }

        /* Bagian Kiri: Menggunakan Gambar login.png */
        .login-left {
            width: 55%; /* Sesuaikan dengan proporsi gambar */
            background-image: url('{{ asset('images/login.png') }}');
            background-size: cover;
            background-position: left center;
            background-repeat: no-repeat;
            background-color: #eaf4ff; /* Fallback color jika gambar gagal load */
        }

        /* Bagian Kanan: Form Login */
        .login-right {
            width: 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 60px;
            background: #ffffff;
        }

        /* Kartu Form */
        .login-card {
            width: 100%;
            max-width: 420px;
        }

        /* Header Form (Logo & Judul) */
        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header-icon {
            width: 80px;
            height: 80px;
            background: #e0f2fe;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #1a56db;
        }

        .login-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 15px;
            color: #1a56db;
            font-weight: 500;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 15px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 10px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #1a56db;
            display: flex;
            align-items: center;
        }

        .form-control {
            width: 100%;
            height: 60px;
            border: 1.5px solid #bfdbfe;
            border-radius: 12px;
            padding: 0 50px 0 55px;
            font-size: 15px;
            color: #333;
            background: #ffffff;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: #1a56db;
            box-shadow: 0 0 0 4px rgba(26, 86, 219, 0.1);
        }

        .form-control::placeholder {
            color: #93c5fd;
            font-weight: 500;
        }

        /* Toggle Password (Ikon Mata) */
        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #1a56db;
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 0;
        }

        /* Opsi Ingat Saya & Lupa Password */
        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            margin-top: 5px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            color: #1e3a8a;
            cursor: pointer;
            font-weight: 500;
        }

        .remember input {
            width: 20px;
            height: 20px;
            border: 1.5px solid #bfdbfe;
            border-radius: 4px;
            accent-color: #1a56db;
            cursor: pointer;
        }

        .forgot-password {
            font-size: 15px;
            font-weight: 700;
            color: #1e3a8a;
            text-decoration: none;
        }

        .forgot-password:hover {
            color: #1a56db;
        }

        /* Tombol Login */
        .btn-login {
            width: 100%;
            height: 60px;
            background: #2563eb;
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            cursor: pointer;
            transition: background 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

        /* Divider Daftar */
        .register-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-top: 35px;
            color: #1a56db;
            font-size: 14px;
            font-weight: 500;
        }

        .register-divider::before,
        .register-divider::after {
            content: "";
            flex: 1;
            height: 1.5px;
            background: #bfdbfe;
        }

        .register-divider a {
            color: #1e3a8a;
            font-weight: 700;
            text-decoration: none;
        }

        .register-divider a:hover {
            color: #1a56db;
        }

        /* Alert Error/Success */
        .alert {
            padding: 15px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 25px;
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

        /* Responsive untuk Layar Kecil */
        @media (max-width: 1024px) {
            .login-left {
                width: 50%;
                background-size: cover;
                background-position: center;
            }
            .login-right {
                width: 50%;
                padding: 40px;
            }
            .login-header h1 {
                font-size: 22px;
            }
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                min-height: 100vh;
                border-radius: 0;
            }
            .login-left {
                display: none; /* Sembunyikan gambar di mobile agar form lega */
            }
            .login-right {
                width: 100%;
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GUSPELOR.NET')</title>

    <!-- Google Fonts: Inter (mirip dengan font di gambar) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #eaf4ff; /* Warna latar belakang halaman */
        }

        /* Container Utama untuk memusatkan konten */
        .login-page {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Kotak utama yang menampung gambar dan form */
        .login-container {
            width: 100%;
            max-width: 1300px;
            min-height: 800px;
            display: flex;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 70, 160, 0.1);
            position: relative;
        }

        /* Bagian Kiri: Menggunakan Gambar login.png */
        .login-left {
            width: 55%; /* Sesuaikan dengan proporsi gambar */
            background-image: url('{{ asset('images/login.png') }}');
            background-size: cover;
            background-position: left center;
            background-repeat: no-repeat;
            background-color: #eaf4ff; /* Fallback color jika gambar gagal load */
        }

        /* Bagian Kanan: Form Login */
        .login-right {
            width: 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 60px;
            background: #ffffff;
        }

        /* Kartu Form */
        .login-card {
            width: 100%;
            max-width: 420px;
        }

        /* Header Form (Logo & Judul) */
        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header-icon {
            width: 80px;
            height: 80px;
            background: #e0f2fe;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #1a56db;
        }

        .login-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 15px;
            color: #1a56db;
            font-weight: 500;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 15px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 10px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #1a56db;
            display: flex;
            align-items: center;
        }

        .form-control {
            width: 100%;
            height: 60px;
            border: 1.5px solid #bfdbfe;
            border-radius: 12px;
            padding: 0 50px 0 55px;
            font-size: 15px;
            color: #333;
            background: #ffffff;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: #1a56db;
            box-shadow: 0 0 0 4px rgba(26, 86, 219, 0.1);
        }

        .form-control::placeholder {
            color: #93c5fd;
            font-weight: 500;
        }

        /* Toggle Password (Ikon Mata) */
        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #1a56db;
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 0;
        }

        /* Opsi Ingat Saya & Lupa Password */
        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            margin-top: 5px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            color: #1e3a8a;
            cursor: pointer;
            font-weight: 500;
        }

        .remember input {
            width: 20px;
            height: 20px;
            border: 1.5px solid #bfdbfe;
            border-radius: 4px;
            accent-color: #1a56db;
            cursor: pointer;
        }

        .forgot-password {
            font-size: 15px;
            font-weight: 700;
            color: #1e3a8a;
            text-decoration: none;
        }

        .forgot-password:hover {
            color: #1a56db;
        }

        /* Tombol Login */
        .btn-login {
            width: 100%;
            height: 60px;
            background: #2563eb;
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            cursor: pointer;
            transition: background 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

        /* Divider Daftar */
        .register-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-top: 35px;
            color: #1a56db;
            font-size: 14px;
            font-weight: 500;
        }

        .register-divider::before,
        .register-divider::after {
            content: "";
            flex: 1;
            height: 1.5px;
            background: #bfdbfe;
        }

        .register-divider a {
            color: #1e3a8a;
            font-weight: 700;
            text-decoration: none;
        }

        .register-divider a:hover {
            color: #1a56db;
        }

        /* Alert Error/Success */
        .alert {
            padding: 15px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 25px;
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

        /* Responsive untuk Layar Kecil */
        @media (max-width: 1024px) {
            .login-left {
                width: 50%;
                background-size: cover;
                background-position: center;
            }
            .login-right {
                width: 50%;
                padding: 40px;
            }
            .login-header h1 {
                font-size: 22px;
            }
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                min-height: 100vh;
                border-radius: 0;
            }
            .login-left {
                display: none; /* Sembunyikan gambar di mobile agar form lega */
            }
            .login-right {
                width: 100%;
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GUSPELOR.NET')</title>

    <!-- Google Fonts: Inter (mirip dengan font di gambar) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #eaf4ff; /* Warna latar belakang halaman */
        }

        /* Container Utama untuk memusatkan konten */
        .login-page {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Kotak utama yang menampung gambar dan form */
        .login-container {
            width: 100%;
            max-width: 1300px;
            min-height: 800px;
            display: flex;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 70, 160, 0.1);
            position: relative;
        }

        /* Bagian Kiri: Menggunakan Gambar login.png */
        .login-left {
            width: 55%; /* Sesuaikan dengan proporsi gambar */
            background-image: url('{{ asset('images/login.png') }}');
            background-size: cover;
            background-position: left center;
            background-repeat: no-repeat;
            background-color: #eaf4ff; /* Fallback color jika gambar gagal load */
        }

        /* Bagian Kanan: Form Login */
        .login-right {
            width: 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 60px;
            background: #ffffff;
        }

        /* Kartu Form */
        .login-card {
            width: 100%;
            max-width: 420px;
        }

        /* Header Form (Logo & Judul) */
        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header-icon {
            width: 80px;
            height: 80px;
            background: #e0f2fe;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #1a56db;
        }

        .login-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 15px;
            color: #1a56db;
            font-weight: 500;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 15px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 10px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #1a56db;
            display: flex;
            align-items: center;
        }

        .form-control {
            width: 100%;
            height: 60px;
            border: 1.5px solid #bfdbfe;
            border-radius: 12px;
            padding: 0 50px 0 55px;
            font-size: 15px;
            color: #333;
            background: #ffffff;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: #1a56db;
            box-shadow: 0 0 0 4px rgba(26, 86, 219, 0.1);
        }

        .form-control::placeholder {
            color: #93c5fd;
            font-weight: 500;
        }

        /* Toggle Password (Ikon Mata) */
        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #1a56db;
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 0;
        }

        /* Opsi Ingat Saya & Lupa Password */
        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            margin-top: 5px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            color: #1e3a8a;
            cursor: pointer;
            font-weight: 500;
        }

        .remember input {
            width: 20px;
            height: 20px;
            border: 1.5px solid #bfdbfe;
            border-radius: 4px;
            accent-color: #1a56db;
            cursor: pointer;
        }

        .forgot-password {
            font-size: 15px;
            font-weight: 700;
            color: #1e3a8a;
            text-decoration: none;
        }

        .forgot-password:hover {
            color: #1a56db;
        }

        /* Tombol Login */
        .btn-login {
            width: 100%;
            height: 60px;
            background: #2563eb;
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            cursor: pointer;
            transition: background 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

        /* Divider Daftar */
        .register-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-top: 35px;
            color: #1a56db;
            font-size: 14px;
            font-weight: 500;
        }

        .register-divider::before,
        .register-divider::after {
            content: "";
            flex: 1;
            height: 1.5px;
            background: #bfdbfe;
        }

        .register-divider a {
            color: #1e3a8a;
            font-weight: 700;
            text-decoration: none;
        }

        .register-divider a:hover {
            color: #1a56db;
        }

        /* Alert Error/Success */
        .alert {
            padding: 15px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 25px;
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

        /* Responsive untuk Layar Kecil */
        @media (max-width: 1024px) {
            .login-left {
                width: 50%;
                background-size: cover;
                background-position: center;
            }
            .login-right {
                width: 50%;
                padding: 40px;
            }
            .login-header h1 {
                font-size: 22px;
            }
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                min-height: 100vh;
                border-radius: 0;
            }
            .login-left {
                display: none; /* Sembunyikan gambar di mobile agar form lega */
            }
            .login-right {
                width: 100%;
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
