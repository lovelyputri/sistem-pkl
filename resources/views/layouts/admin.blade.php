<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | GUSPELOR.NET</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box}
        :root{--sidebar-width:275px;--sidebar-bg:#102c78;--sidebar-deep:#10286d;--sidebar-active:#3475ff}
        body{margin:0;font-family:Inter,sans-serif;color:#172033;background:#f5f7fb}
        a{color:inherit;text-decoration:none}
        .admin-layout{min-height:100vh;display:flex;align-items:stretch}
        .admin-sidebar{width:var(--sidebar-width);flex:0 0 var(--sidebar-width);height:100vh;position:sticky;top:0;display:flex;flex-direction:column;overflow:hidden;background:linear-gradient(160deg,#10286e 0%,#153a9a 58%,#12358d 100%);color:#fff;padding:24px 15px 17px;z-index:50}
        .admin-brand{display:flex;align-items:center;gap:12px;padding:0 5px 23px;border-bottom:1px solid rgba(255,255,255,.13)}
        .brand-mark{width:58px;height:48px;flex:0 0 58px;color:#9bbcff}
        .brand-copy{min-width:0}
        .brand-name{font-size:19px;line-height:1.15;font-weight:800;letter-spacing:-.65px;white-space:nowrap}
        .brand-subtitle{display:block;margin-top:5px;font-size:10px;font-weight:400;color:#e0eaff}
        .admin-nav-scroll{flex:1;min-height:0;overflow-y:auto;padding:18px 0 8px;scrollbar-width:thin;scrollbar-color:rgba(255,255,255,.2) transparent}
        .admin-nav-title{padding:0 7px 10px;font-size:9px;color:#c5d5ff;text-transform:uppercase;letter-spacing:.75px}
        .admin-nav-link{display:flex;align-items:center;gap:13px;min-height:43px;padding:9px 12px;margin:0 0 10px;border-radius:7px;background:rgba(44,83,183,.43);color:#fff;font-size:11px;font-weight:600;transition:background .18s ease,transform .18s ease}
        .admin-nav-link:hover{background:rgba(66,116,230,.72);transform:translateX(2px)}
        .admin-nav-link.active{background:var(--sidebar-active);box-shadow:0 5px 14px rgba(4,20,69,.15)}
        .nav-icon{width:24px;height:24px;flex:0 0 24px;display:grid;place-items:center;color:#fff}
        .nav-icon svg{width:23px;height:23px;display:block;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
        .nav-section-label{margin:18px 7px 9px;padding-top:13px;border-top:1px solid rgba(255,255,255,.12);font-size:8px;font-weight:700;letter-spacing:1px;color:#9fb8f4;text-transform:uppercase}
        .admin-sidebar-art{display:block;width:calc(100% + 30px);height:190px;flex:0 0 190px;margin:0 -15px -2px;object-fit:contain;object-position:center bottom;opacity:.96;pointer-events:none}
        .admin-sidebar-caption{text-align:center;padding:0 0 4px;position:relative;z-index:1}
        .admin-sidebar-caption strong{display:block;font-size:15px;font-weight:800;letter-spacing:-.3px}
        .admin-sidebar-caption span{display:block;margin-top:5px;font-size:9px;color:#d9e6ff}
        .admin-main{min-width:0;flex:1}
        .admin-topbar{min-height:68px;position:sticky;top:0;z-index:30;background:rgba(255,255,255,.96);backdrop-filter:blur(10px);border-bottom:1px solid #e5eaf2;padding:13px 25px;display:flex;justify-content:space-between;align-items:center;gap:16px}
        .topbar-left{display:flex;align-items:center;gap:12px;min-width:0}
        .admin-topbar strong{font-size:14px}
        .admin-user{display:flex;align-items:center;gap:10px}
        .admin-user-name{font-size:11px;font-weight:700}
        .admin-user-role{color:#64748b;font-size:10px;margin-top:3px}
        .admin-logout{background:#fff;border:1px solid #d9e1ef;border-radius:7px;padding:8px 12px;color:#334155;cursor:pointer;font:inherit;font-size:11px}
        .admin-content{max-width:1200px;padding:28px;margin:auto}
        .admin-content h1{font-size:24px;margin:0}
        .admin-intro{color:#64748b;font-size:13px;line-height:1.6;margin:8px 0 24px}
        .admin-cards{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px}
        .admin-card{background:#fff;border:1px solid #e4e9f2;border-radius:12px;padding:19px}
        .admin-card-label{color:#64748b;font-size:12px}
        .admin-card-number{margin-top:13px;font-size:27px;font-weight:700}
        .admin-section{margin-top:24px;background:#fff;border:1px solid #e4e9f2;border-radius:12px;padding:20px}
        .admin-section h2{margin:0 0 8px;font-size:15px}
        .admin-section p{margin:0;color:#64748b;font-size:12px;line-height:1.7}
        .admin-shortcuts{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px;margin-top:16px}
        .admin-shortcut{border:1px solid #e7ebf3;border-radius:9px;padding:14px;font-size:12px;font-weight:600}
        .admin-shortcut span{display:block;margin-top:6px;color:#64748b;font-weight:400;line-height:1.5}
        .admin-menu-toggle{display:none;width:38px;height:38px;border:1px solid #e1e7f0;border-radius:9px;background:#fff;color:#17377f;align-items:center;justify-content:center;cursor:pointer}
        .admin-menu-toggle svg{width:20px;height:20px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round}
        .admin-sidebar-overlay{display:none}
        @media(max-width:1050px){:root{--sidebar-width:245px}.admin-sidebar{padding-left:13px;padding-right:13px}.admin-brand{gap:9px}.brand-name{font-size:17px}.admin-sidebar-art{height:165px;flex-basis:165px}.admin-cards{grid-template-columns:repeat(2,minmax(0,1fr))}.admin-shortcuts{grid-template-columns:1fr}}
        @media(max-width:760px){
            .admin-layout{display:block}
            .admin-sidebar{position:fixed;left:0;top:0;bottom:0;height:100dvh;width:min(285px,84vw);max-width:100%;transform:translateX(-105%);transition:transform .25s ease;box-shadow:12px 0 35px rgba(7,20,54,.22);padding-top:20px}
            body.admin-sidebar-open{overflow:hidden}
            body.admin-sidebar-open .admin-sidebar{transform:translateX(0)}
            .admin-sidebar-overlay{position:fixed;inset:0;background:rgba(8,18,43,.48);z-index:40}
            body.admin-sidebar-open .admin-sidebar-overlay{display:block}
            .admin-menu-toggle{display:inline-flex;flex:0 0 38px}
            .admin-topbar{min-height:62px;padding:11px 15px}
            .admin-content{padding:20px 15px}
            .admin-cards{grid-template-columns:repeat(2,minmax(0,1fr))}
        }
        @media(max-width:480px){.admin-topbar{padding:10px 12px}.admin-topbar strong{font-size:12px}.admin-user{gap:7px}.admin-user img{width:30px!important;height:30px!important}.admin-user-role{font-size:9px}.admin-logout{padding:7px 9px;font-size:10px}.admin-content{padding:17px 11px}.admin-cards{gap:9px}.admin-card{padding:14px}.admin-card-number{font-size:23px}}
        @media(prefers-reduced-motion:reduce){.admin-sidebar,.admin-nav-link{transition:none}}
    </style>
    @stack('styles')
</head>
<body>
<div class="admin-layout">
    <aside class="admin-sidebar" id="adminSidebar" aria-label="Navigasi admin">
        <a class="admin-brand" href="{{ route('admin.dashboard') }}">
            <svg class="brand-mark" viewBox="0 0 64 52" aria-hidden="true">
                <path d="M5 17C20 2 44 2 59 17" stroke="currentColor" stroke-width="8" stroke-linecap="round" fill="none"/>
                <path d="M15 28C25 18 39 18 49 28" stroke="currentColor" stroke-width="8" stroke-linecap="round" fill="none"/>
                <path d="M25 39C29 35 35 35 39 39" stroke="currentColor" stroke-width="8" stroke-linecap="round" fill="none"/>
                <circle cx="32" cy="47" r="4.5" fill="currentColor"/>
            </svg>
            <span class="brand-copy"><span class="brand-name">GUSPELOR.NET</span><span class="brand-subtitle">Sistem Pengelolaan PKL</span></span>
        </a>

        <nav class="admin-nav-scroll">
            <div class="admin-nav-title">Menu Admin</div>
            <a class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="m3 10 9-7 9 7"/><path d="M5 9v11h14V9M9 20v-7h6v7"/></svg></span><span>Dashboard</span>
            </a>
            <a class="admin-nav-link {{ request()->routeIs('admin.siswa.*','admin.siswa.approval.*') ? 'active' : '' }}" href="{{ route('admin.siswa.index') }}">
                <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M20 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg></span><span>Siswa</span>
            </a>
            <a class="admin-nav-link {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}" href="{{ route('admin.guru.index') }}">
                <span class="nav-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M4 21v-2a8 8 0 0 1 16 0v2z"/></svg></span><span>Guru Pembimbing</span>
            </a>
            <a class="admin-nav-link {{ request()->routeIs('admin.absensi.index') && !request()->has('riwayat') ? 'active' : '' }}" href="{{ route('admin.absensi.index') }}">
                <span class="nav-icon"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="17" rx="2"/><path d="M8 2v4m8-4v4M3 9h18m-13 5 2 2 5-5"/></svg></span><span>Absensi</span>
            </a>
            <a class="admin-nav-link {{ request()->routeIs('admin.jurnal.*') ? 'active' : '' }}" href="{{ route('admin.jurnal.index') }}">
                <span class="nav-icon"><svg viewBox="0 0 24 24"><rect x="5" y="3" width="16" height="18" rx="2"/><path d="M9 7h8M9 11h8M9 15h5M3 7h2M3 11h2M3 15h2"/></svg></span><span>Jurnal Harian</span>
            </a>
            <a class="admin-nav-link {{ request()->routeIs('admin.absensi.index') && request()->has('riwayat') ? 'active' : '' }}" href="{{ route('admin.absensi.index') }}#riwayat-absensi">
                <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M3 12a9 9 0 1 0 2.6-6.4L3 8"/><path d="M3 3v5h5m4-1v5l3 2"/></svg></span><span>Riwayat Absensi</span>
            </a>

            <div class="nav-section-label">Data Pendukung</div>
            <a class="admin-nav-link {{ request()->routeIs('admin.siswa.approval.*') ? 'active' : '' }}" href="{{ route('admin.siswa.approval.index') }}">
                <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M9 11 12 14 22 4"/><path d="M20 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></span><span>Approval Siswa</span>
            </a>
            <a class="admin-nav-link {{ request()->routeIs('admin.sekolah-jurusan.*') ? 'active' : '' }}" href="{{ route('admin.sekolah-jurusan.index') }}">
                <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M3 21h18M5 21V7l7-4 7 4v14M9 10h1m4 0h1m-6 4h1m4 0h1m-5 7v-4h4v4"/></svg></span><span>Sekolah &amp; Jurusan</span>
            </a>
            <a class="admin-nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.edit') }}">
                <span class="nav-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="m19.4 15 .1.1 1.4 1.1-1.4 2.4-1.7-.6a8 8 0 0 1-1.6.9l-.3 1.8h-2.8l-.3-1.8a8 8 0 0 1-1.6-.9l-1.7.6-1.4-2.4 1.4-1.1a7 7 0 0 1 0-1.9l-1.4-1.1 1.4-2.4 1.7.6a8 8 0 0 1 1.6-.9l.3-1.8h2.8l.3 1.8a8 8 0 0 1 1.6.9l1.7-.6 1.4 2.4-1.4 1.1a7 7 0 0 1 0 1.8Z"/></svg></span><span>Pengaturan</span>
            </a>
        </nav>

        <img
            class="admin-sidebar-art"
            src="{{ asset('images/gedung.png') }}"
            alt="Ilustrasi gedung dan jaringan GUSPELOR.NET"
        >
        <div class="admin-sidebar-caption"><strong>GUSPELOR.NET</strong><span>Connecting People, Connecting Future</span></div>
    </aside>

    <div class="admin-sidebar-overlay" data-sidebar-close></div>
    <main class="admin-main">
        <header class="admin-topbar">
            <div class="topbar-left">
                <button type="button" class="admin-menu-toggle" id="adminMenuToggle" aria-label="Buka menu navigasi" aria-controls="adminSidebar" aria-expanded="false">
                    <svg viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <strong>@yield('page-heading', 'Panel Admin')</strong>
            </div>
            <div class="admin-user">
                <img src="{{ auth()->user()->foto_profil ? asset('storage/'.auth()->user()->foto_profil) : asset('images/logo.png') }}" alt="Foto akun" style="width:34px;height:34px;border-radius:50%;object-fit:cover;border:1px solid #e2e8f0">
                <div><div class="admin-user-name">{{ auth()->user()->nama_akun ?: 'Admin' }}</div><div class="admin-user-role">Administrator</div></div>
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
<script>
(function(){
    const toggle=document.getElementById('adminMenuToggle');
    const closeTargets=document.querySelectorAll('[data-sidebar-close]');
    const closeMenu=()=>{
        document.body.classList.remove('admin-sidebar-open');
        if(toggle) toggle.setAttribute('aria-expanded','false');
    };
    if(toggle){
        toggle.addEventListener('click',()=>{
            const isOpen=document.body.classList.toggle('admin-sidebar-open');
            toggle.setAttribute('aria-expanded',String(isOpen));
        });
    }
    closeTargets.forEach(el=>el.addEventListener('click',closeMenu));
    document.querySelectorAll('.admin-nav-link').forEach(link=>link.addEventListener('click',closeMenu));
    document.addEventListener('keydown',event=>{if(event.key==='Escape')closeMenu();});
})();
</script>
@stack('scripts')
</body>
</html>