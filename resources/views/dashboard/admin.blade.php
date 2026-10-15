<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | GUSPELOR.NET</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --blue:#2563eb; --blue-dark:#1d4ed8; --ink:#172033; --muted:#718096; --line:#e8edf5; --surface:#f6f8fc; }
        * { box-sizing:border-box; }
        body { margin:0; font-family:Inter, sans-serif; color:var(--ink); background:var(--surface); }
        a { color:inherit; text-decoration:none; }
        .app { min-height:100vh; display:flex; }
        .sidebar { width:250px; background:#fff; border-right:1px solid var(--line); padding:26px 17px; display:flex; flex-direction:column; flex-shrink:0; }
        .brand { display:flex; align-items:center; gap:11px; padding:0 10px 28px; border-bottom:1px solid var(--line); }
        .brand-mark { width:42px; height:42px; border-radius:13px; display:grid; place-items:center; background:linear-gradient(135deg,#2563eb,#60a5fa); color:#fff; font-weight:800; letter-spacing:-1px; }
        .brand-name { font-size:14px; font-weight:800; letter-spacing:-.3px; }
        .brand-sub { margin-top:4px; font-size:10px; color:var(--muted); font-weight:600; }
        .nav-label { padding:26px 12px 10px; font-size:10px; color:#9aa5b5; font-weight:800; letter-spacing:1.2px; }
        .nav-link { display:flex; align-items:center; gap:12px; padding:12px 13px; border-radius:11px; font-size:13px; color:#657187; font-weight:600; margin:3px 0; }
        .nav-link.active { color:var(--blue); background:#eff5ff; }
        .nav-icon { width:20px; text-align:center; font-size:17px; }
        .sidebar-bottom { margin-top:auto; padding:18px 12px 0; border-top:1px solid var(--line); color:#9aa5b5; font-size:11px; line-height:1.7; }
        .main { min-width:0; flex:1; }
        .topbar { height:78px; background:#fff; border-bottom:1px solid var(--line); display:flex; align-items:center; justify-content:space-between; padding:0 34px; }
        .crumb { color:var(--muted); font-size:12px; }
        .crumb strong { color:var(--ink); font-weight:700; }
        .profile { display:flex; align-items:center; gap:11px; }
        .avatar { width:38px; height:38px; border-radius:50%; display:grid; place-items:center; background:#dbeafe; color:#1d4ed8; font-size:13px; font-weight:800; }
        .profile-name { font-size:12px; font-weight:700; }
        .profile-role { font-size:11px; color:var(--muted); margin-top:3px; }
        .content { padding:34px; max-width:1500px; margin:auto; }
        .welcome { display:flex; justify-content:space-between; align-items:flex-start; gap:20px; margin-bottom:27px; }
        h1 { margin:0; font-size:25px; letter-spacing:-.8px; }
        .welcome p { color:var(--muted); font-size:13px; margin:9px 0 0; line-height:1.6; }
        .date-pill { background:#fff; border:1px solid var(--line); border-radius:11px; padding:11px 14px; color:#526078; font-size:12px; white-space:nowrap; }
        .section-title { font-size:14px; font-weight:800; margin:0 0 15px; }
        .stats { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:16px; margin-bottom:27px; }
        .stat { background:#fff; border:1px solid var(--line); border-radius:16px; padding:20px; box-shadow:0 3px 12px rgba(20,40,80,.025); }
        .stat-top { display:flex; align-items:center; justify-content:space-between; gap:10px; }
        .stat-label { font-size:12px; color:var(--muted); font-weight:600; }
        .stat-icon { width:38px; height:38px; display:grid; place-items:center; border-radius:12px; background:#eff5ff; color:var(--blue); font-size:18px; }
        .stat-value { font-size:28px; font-weight:800; letter-spacing:-1px; margin-top:18px; }
        .stat-note { color:#96a0b0; font-size:11px; margin-top:5px; }
        .lower { display:grid; grid-template-columns:minmax(0,1.35fr) minmax(280px,.85fr); gap:18px; }
        .panel { background:#fff; border:1px solid var(--line); border-radius:16px; padding:22px; }
        .panel-head { display:flex; align-items:center; justify-content:space-between; gap:12px; margin-bottom:18px; }
        .panel-title { font-size:14px; font-weight:800; margin:0; }
        .panel-desc { color:var(--muted); font-size:12px; margin:6px 0 0; }
        .status-row { display:flex; align-items:center; gap:12px; padding:14px 0; border-top:1px solid #f0f2f7; }
        .status-icon { width:39px; height:39px; border-radius:12px; background:#f1f5ff; display:grid; place-items:center; color:var(--blue); font-size:17px; flex-shrink:0; }
        .status-text { font-size:12px; font-weight:700; }
        .status-sub { font-size:11px; color:var(--muted); margin-top:4px; line-height:1.5; }
        .status-badge { margin-left:auto; background:#f1f5f9; color:#64748b; padding:6px 8px; border-radius:7px; font-size:10px; font-weight:700; white-space:nowrap; }
        .quick-grid { display:grid; grid-template-columns:1fr 1fr; gap:11px; }
        .quick-link { border:1px solid var(--line); border-radius:12px; padding:15px; transition:.2s; }
        .quick-link:hover { border-color:#b9d1ff; background:#f8fbff; }
        .quick-icon { color:var(--blue); font-size:19px; }
        .quick-title { font-size:12px; font-weight:700; margin-top:12px; }
        .quick-sub { color:var(--muted); font-size:10px; line-height:1.5; margin-top:5px; }
        .footer-note { color:#98a2b3; font-size:11px; text-align:center; padding:28px 0 8px; }
        @media(max-width:1100px) { .stats { grid-template-columns:repeat(2,minmax(0,1fr)); } .lower { grid-template-columns:1fr; } }
        @media(max-width:700px) { .sidebar { width:66px; padding:18px 8px; } .brand { padding:0 4px 22px; border:0; } .brand-copy,.nav-label,.nav-text,.sidebar-bottom { display:none; } .nav-link { justify-content:center; padding:12px 6px; } .topbar { padding:0 18px; height:68px; } .content { padding:23px 16px; } .welcome { flex-direction:column; } h1 { font-size:22px; } .stats { gap:10px; } .stat { padding:15px; } .stat-value { font-size:24px; } .quick-grid { grid-template-columns:1fr 1fr; } }
        @media(max-width:390px) { .stats { grid-template-columns:1fr; } .profile-name,.profile-role { display:none; } }
    </style>
</head>
<body>
<div class="app">
    <aside class="sidebar">
        <a class="brand" href="{{ route('admin.dashboard') }}">
            <div class="brand-mark">G</div>
            <div class="brand-copy"><div class="brand-name">GUSPELOR.NET</div><div class="brand-sub">SISTEM INFORMASI PKL</div></div>
        </a>
        <div class="nav-label">MENU UTAMA</div>
        <a class="nav-link active" href="{{ route('admin.dashboard') }}"><span class="nav-icon">▦</span><span class="nav-text">Dashboard</span></a>
        <div class="nav-label">MANAJEMEN DATA</div>
        <a class="nav-link" href="#"><span class="nav-icon">♙</span><span class="nav-text">Data Siswa</span></a>
        <a class="nav-link" href="#"><span class="nav-icon">♧</span><span class="nav-text">Guru Pembimbing</span></a>
        <a class="nav-link" href="#"><span class="nav-icon">▤</span><span class="nav-text">Sekolah</span></a>
        <a class="nav-link" href="#"><span class="nav-icon">⌘</span><span class="nav-text">Jurusan & Kelas</span></a>
        <a class="nav-link" href="#"><span class="nav-icon">▣</span><span class="nav-text">Perusahaan PKL</span></a>
        <div class="sidebar-bottom">GUSPELOR.NET<br>Pengelolaan Praktik Kerja Lapangan</div>
    </aside>
    <main class="main">
        <header class="topbar">
            <div class="crumb">Halaman <span style="margin:0 8px;color:#c4cad5">/</span> <strong>Dashboard</strong></div>
            <div class="profile">
                <div class="avatar">A</div>
                <div><div class="profile-name">Administrator</div><div class="profile-role">Admin Sistem</div></div>
            </div>
        </header>
        <section class="content">
            <div class="welcome">
                <div><h1>Dashboard Admin</h1><p>Selamat datang di panel pengelolaan GUSPELOR.NET.<br>Pantau dan kelola data Praktik Kerja Lapangan dari satu tempat.</p></div>
                <div class="date-pill">◷ &nbsp; {{ now()->translatedFormat('l, d F Y') }}</div>
            </div>
            <h2 class="section-title">Ringkasan Sistem</h2>
            <div class="stats">
                <article class="stat"><div class="stat-top"><span class="stat-label">Total Siswa</span><span class="stat-icon">♙</span></div><div class="stat-value">{{ $totalSiswa ?? 0 }}</div><div class="stat-note">Siswa terdaftar</div></article>
                <article class="stat"><div class="stat-top"><span class="stat-label">Guru Pembimbing</span><span class="stat-icon">♧</span></div><div class="stat-value">{{ $totalGuru ?? 0 }}</div><div class="stat-note">Guru terdaftar</div></article>
                <article class="stat"><div class="stat-top"><span class="stat-label">Menunggu Persetujuan</span><span class="stat-icon">◷</span></div><div class="stat-value">{{ $siswaPending ?? 0 }}</div><div class="stat-note">Pendaftaran siswa pending</div></article>
                <article class="stat"><div class="stat-top"><span class="stat-label">Perusahaan PKL</span><span class="stat-icon">▣</span></div><div class="stat-value">{{ $totalPerusahaan ?? 0 }}</div><div class="stat-note">Tempat PKL terdata</div></article>
            </div>
            <div class="lower">
                <section class="panel">
                    <div class="panel-head"><div><h2 class="panel-title">Mulai dari Sini</h2><p class="panel-desc">Area utama yang akan digunakan untuk mengelola sistem.</p></div></div>
                    <div class="status-row"><div class="status-icon">♙</div><div><div class="status-text">Kelola Data Siswa</div><div class="status-sub">Periksa data pendaftaran dan informasi siswa PKL.</div></div><span class="status-badge">Segera</span></div>
                    <div class="status-row"><div class="status-icon">♧</div><div><div class="status-text">Kelola Guru Pembimbing</div><div class="status-sub">Siapkan data guru dan pembagian siswa bimbingan.</div></div><span class="status-badge">Segera</span></div>
                    <div class="status-row"><div class="status-icon">▣</div><div><div class="status-text">Kelola Perusahaan PKL</div><div class="status-sub">Atur informasi lokasi PKL untuk kebutuhan penempatan dan absensi.</div></div><span class="status-badge">Segera</span></div>
                </section>
                <section class="panel">
                    <div class="panel-head"><div><h2 class="panel-title">Akses Cepat</h2><p class="panel-desc">Pintasan pengelolaan data.</p></div></div>
                    <div class="quick-grid">
                        <a class="quick-link" href="#"><div class="quick-icon">♙</div><div class="quick-title">Data Siswa</div><div class="quick-sub">Profil & pendaftaran</div></a>
                        <a class="quick-link" href="#"><div class="quick-icon">♧</div><div class="quick-title">Data Guru</div><div class="quick-sub">Guru pembimbing</div></a>
                        <a class="quick-link" href="#"><div class="quick-icon">▤</div><div class="quick-title">Data Sekolah</div><div class="quick-sub">Sekolah, kelas, jurusan</div></a>
                        <a class="quick-link" href="#"><div class="quick-icon">▣</div><div class="quick-title">Perusahaan PKL</div><div class="quick-sub">Lokasi tempat PKL</div></a>
                    </div>
                </section>
            </div>
            <div class="footer-note">© {{ now()->year }} GUSPELOR.NET · Sistem Informasi Praktik Kerja Lapangan</div>
        </section>
    </main>
</div>
</body>
</html>
