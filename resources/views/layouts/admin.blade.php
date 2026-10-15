<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | GUSPELOR.NET</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Inter, sans-serif; color: #172033; background: #f5f7fb; }
        a { color: inherit; text-decoration: none; }
        .admin-layout { min-height: 100vh; display: flex; }
        .admin-sidebar { width: 230px; flex-shrink: 0; background: #17357f; color: #fff; padding: 25px 16px; }
        .admin-brand { padding: 0 10px 26px; font-size: 17px; font-weight: 700; border-bottom: 1px solid rgba(255,255,255,.15); }
        .admin-brand small { display: block; margin-top: 6px; font-size: 11px; font-weight: 400; color: #cbd8f7; }
        .admin-nav-title { padding: 22px 10px 10px; font-size: 10px; color: #b7c8f2; text-transform: uppercase; letter-spacing: 1px; }
        .admin-nav-link { display: block; padding: 12px 11px; border-radius: 8px; margin-bottom: 5px; font-size: 13px; color: #fff; }
        .admin-nav-link.active, .admin-nav-link:hover { background: #315fc4; }
        .admin-sidebar-footer { margin-top: 32px; padding: 15px 10px; border-top: 1px solid rgba(255,255,255,.15); color: #cbd8f7; font-size: 11px; line-height: 1.6; }
        .admin-main { min-width: 0; flex: 1; }
        .admin-topbar { min-height: 68px; background: #fff; border-bottom: 1px solid #e5eaf2; padding: 15px 28px; display: flex; justify-content: space-between; align-items: center; gap: 16px; }
        .admin-topbar strong { font-size: 15px; }
        .admin-user { display: flex; align-items: center; gap: 12px; }
        .admin-user-name { font-size: 12px; font-weight: 600; }
        .admin-user-role { color: #64748b; font-size: 11px; margin-top: 3px; }
        .admin-logout { background: #fff; border: 1px solid #d9e1ef; border-radius: 7px; padding: 8px 12px; color: #334155; cursor: pointer; font: inherit; font-size: 12px; }
        .admin-content { max-width: 1200px; padding: 28px; margin: auto; }
        .admin-content h1 { font-size: 24px; margin: 0; }
        .admin-intro { color: #64748b; font-size: 13px; line-height: 1.6; margin: 8px 0 24px; }
        .admin-cards { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 14px; }
        .admin-card { background: #fff; border: 1px solid #e4e9f2; border-radius: 12px; padding: 19px; }
        .admin-card-label { color: #64748b; font-size: 12px; }
        .admin-card-number { margin-top: 13px; font-size: 27px; font-weight: 700; }
        .admin-section { margin-top: 24px; background: #fff; border: 1px solid #e4e9f2; border-radius: 12px; padding: 20px; }
        .admin-section h2 { margin: 0 0 8px; font-size: 15px; }
        .admin-section p { margin: 0; color: #64748b; font-size: 12px; line-height: 1.7; }
        .admin-shortcuts { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 12px; margin-top: 16px; }
        .admin-shortcut { border: 1px solid #e7ebf3; border-radius: 9px; padding: 14px; font-size: 12px; font-weight: 600; }
        .admin-shortcut span { display: block; margin-top: 6px; color: #64748b; font-weight: 400; line-height: 1.5; }
        @media(max-width: 900px) { .admin-cards { grid-template-columns: repeat(2, minmax(0,1fr)); } .admin-shortcuts { grid-template-columns: 1fr; } }
        @media(max-width: 600px) { .admin-layout { display: block; } .admin-sidebar { width: 100%; padding: 14px; } .admin-brand { padding: 0 5px 12px; } .admin-nav-title { display: none; } .admin-nav-link { display: inline-block; margin: 4px 2px 0 0; padding: 9px; } .admin-sidebar-footer { display: none; } .admin-topbar { padding: 14px 16px; } .admin-content { padding: 20px 14px; } .admin-cards { gap: 9px; } .admin-card { padding: 14px; } .admin-card-number { font-size: 23px; } }
    </style>
    @stack('styles')
</head>
<body>
<div class="admin-layout">
    <aside class="admin-sidebar">
        <a class="admin-brand" href="{{ route('admin.dashboard') }}">GUSPELOR.NET<small>Sistem Informasi PKL</small></a>
        <div class="admin-nav-title">Menu Admin</div>
        <a class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a class="admin-nav-link" href="{{ route('admin.dashboard') }}#data-siswa">Data Siswa</a>
        <a class="admin-nav-link" href="{{ route('admin.dashboard') }}#data-guru">Guru Pembimbing</a>
        <a class="admin-nav-link" href="{{ route('admin.dashboard') }}#data-lainnya">Sekolah & Jurusan</a>
        <a class="admin-nav-link" href="{{ route('admin.dashboard') }}#data-lainnya">Perusahaan PKL</a>
        <div class="admin-sidebar-footer">GUSPELOR.NET<br>Pengelolaan Praktik Kerja Lapangan</div>
    </aside>
    <main class="admin-main">
        <header class="admin-topbar">
            <strong>@yield('page-heading', 'Panel Admin')</strong>
            <div class="admin-user">
                <div><div class="admin-user-name">{{ auth()->user()->email ?? 'Administrator' }}</div><div class="admin-user-role">Administrator</div></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="admin-logout" type="submit">Keluar</button>
                </form>
            </div>
        </header>
        <section class="admin-content">
            @yield('content')
        </section>
    </main>
</div>
@stack('scripts')
</body>
</html>
