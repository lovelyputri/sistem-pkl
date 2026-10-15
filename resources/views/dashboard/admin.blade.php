<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | GUSPELOR.NET</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Inter, sans-serif; color: #172033; background: #f5f7fb; }
        .layout { min-height: 100vh; display: flex; }
        aside { width: 230px; background: #17357f; color: white; padding: 25px 16px; }
        .brand { font-size: 17px; font-weight: 700; padding: 0 10px 26px; }
        .brand small { display: block; margin-top: 6px; font-size: 11px; font-weight: 400; color: #cbd8f7; }
        .nav-title { padding: 12px 10px; font-size: 10px; color: #b7c8f2; text-transform: uppercase; letter-spacing: 1px; }
        .nav-link { display: block; padding: 12px 11px; border-radius: 8px; margin-bottom: 5px; font-size: 13px; color: white; text-decoration: none; }
        .nav-link.active, .nav-link:hover { background: #315fc4; }
        main { min-width: 0; flex: 1; }
        header { min-height: 68px; background: white; border-bottom: 1px solid #e5eaf2; padding: 16px 28px; display: flex; justify-content: space-between; align-items: center; gap: 16px; }
        header strong { font-size: 15px; }
        .logout { background: white; border: 1px solid #d9e1ef; border-radius: 7px; padding: 8px 12px; color: #334155; cursor: pointer; font: inherit; font-size: 12px; }
        .content { max-width: 1200px; padding: 28px; margin: auto; }
        h1 { font-size: 24px; margin: 0; }
        .intro { color: #64748b; font-size: 13px; line-height: 1.6; margin: 8px 0 24px; }
        .cards { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 14px; }
        .card { background: white; border: 1px solid #e4e9f2; border-radius: 12px; padding: 19px; }
        .label { color: #64748b; font-size: 12px; }
        .number { margin-top: 13px; font-size: 27px; font-weight: 700; }
        .section { margin-top: 24px; background: white; border: 1px solid #e4e9f2; border-radius: 12px; padding: 20px; }
        h2 { margin: 0 0 8px; font-size: 15px; }
        .section p { margin: 0; color: #64748b; font-size: 12px; line-height: 1.7; }
        .todo { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 12px; margin-top: 16px; }
        .todo-item { border: 1px solid #e7ebf3; border-radius: 9px; padding: 14px; font-size: 12px; font-weight: 600; }
        .todo-item span { display: block; margin-top: 6px; color: #64748b; font-weight: 400; line-height: 1.5; }
        @media (max-width: 900px) { .cards { grid-template-columns: repeat(2, minmax(0,1fr)); } .todo { grid-template-columns: 1fr; } }
        @media (max-width: 600px) { .layout { display: block; } aside { width: 100%; padding: 14px; } .brand { padding: 0 5px 12px; } .nav-title { display: none; } .nav-link { display: inline-block; margin: 4px 2px 0 0; padding: 9px; } header { padding: 14px 16px; } .content { padding: 20px 14px; } .cards { gap: 9px; } .card { padding: 14px; } .number { font-size: 23px; } }
    </style>
</head>
<body>
<div class="layout">
    <aside>
        <div class="brand">GUSPELOR.NET<small>Sistem Informasi PKL</small></div>
        <div class="nav-title">Menu Admin</div>
        <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a class="nav-link" href="#data-siswa">Data Siswa</a>
        <a class="nav-link" href="#data-guru">Guru Pembimbing</a>
        <a class="nav-link" href="#data-lainnya">Sekolah & Jurusan</a>
        <a class="nav-link" href="#data-lainnya">Perusahaan PKL</a>
    </aside>
    <main>
        <header>
            <strong>Dashboard Admin</strong>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout" type="submit">Keluar</button>
            </form>
        </header>
        <div class="content">
            <h1>Selamat datang, Admin!</h1>
            <p class="intro">Berikut ringkasan data pada sistem GUSPELOR.NET. Gunakan menu di samping untuk mulai mengelola data PKL.</p>
            <div class="cards">
                <div class="card"><div class="label">Total Siswa</div><div class="number">{{ $totalSiswa }}</div></div>
                <div class="card"><div class="label">Guru Pembimbing</div><div class="number">{{ $totalGuru }}</div></div>
                <div class="card"><div class="label">Pendaftaran Menunggu</div><div class="number">{{ $siswaPending }}</div></div>
                <div class="card"><div class="label">Perusahaan PKL</div><div class="number">{{ $totalPerusahaan }}</div></div>
            </div>
            <section class="section" id="data-siswa">
                <h2>Pengelolaan Data</h2>
                <p>Dashboard ini menjadi halaman awal Admin. Fitur pengelolaan akan kita lengkapi bertahap agar setiap menu benar-benar terhubung ke database.</p>
                <div class="todo">
                    <div class="todo-item">Data Siswa<span>Melihat data siswa dan memproses persetujuan pendaftaran.</span></div>
                    <div class="todo-item" id="data-guru">Guru Pembimbing<span>Mengelola akun guru dan penugasan siswa bimbingan.</span></div>
                    <div class="todo-item" id="data-lainnya">Data Pendukung<span>Mengelola sekolah, jurusan, kelas, dan perusahaan PKL.</span></div>
                </div>
            </section>
        </div>
    </main>
</div>
</body>
</html>
