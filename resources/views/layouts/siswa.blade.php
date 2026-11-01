<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title','Panel Siswa') | GUSPELOR.NET</title>
<link rel="preconnect" href="https://fonts.googleapis.com"><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box}body{margin:0;background:#f5f7fb;color:#172033;font-family:Inter,sans-serif}a{color:inherit;text-decoration:none}.siswa-layout{min-height:100vh;display:flex}.siswa-sidebar{width:238px;flex:0 0 238px;position:sticky;top:0;height:100vh;overflow-y:auto;background:#17357f;color:#fff;padding:24px 16px}.siswa-brand{display:block;padding:0 10px 24px;border-bottom:1px solid #ffffff26;font-size:16px;font-weight:800}.siswa-brand small{display:block;font-size:11px;font-weight:400;color:#cbd8f7;margin-top:6px}.siswa-nav-title{font-size:10px;color:#b7c8f2;letter-spacing:1px;text-transform:uppercase;padding:22px 10px 10px}.siswa-link{display:flex;align-items:center;justify-content:space-between;padding:12px 11px;margin-bottom:5px;border-radius:9px;font-size:13px}.siswa-link:hover,.siswa-link.active{background:#315fc4}.siswa-bubble{background:#f97316;color:#fff;border-radius:20px;padding:2px 7px;font-size:10px;font-weight:700}.siswa-main{flex:1;min-width:0}.siswa-topbar{min-height:68px;position:sticky;top:0;z-index:10;background:#fff;border-bottom:1px solid #e5eaf2;padding:14px 28px;display:flex;align-items:center;justify-content:space-between;gap:12px}.siswa-topbar strong{font-size:14px}.siswa-user{font-size:12px;color:#64748b;display:flex;align-items:center;gap:12px}.siswa-logout{border:1px solid #d9e1ef;background:#fff;border-radius:8px;padding:8px 12px;color:#334155;cursor:pointer;font:inherit;font-size:12px}.siswa-content{max-width:1200px;margin:auto;padding:28px}.siswa-content h1{font-size:24px;margin:0}.siswa-intro{font-size:13px;line-height:1.7;color:#64748b;margin:8px 0 24px}.siswa-stats{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:15px}.siswa-card,.siswa-panel{background:#fff;border:1px solid #e4e9f2;border-radius:14px;padding:20px}.siswa-stat-label{font-size:12px;color:#64748b}.siswa-stat-value{font-size:27px;font-weight:800;margin-top:11px;color:#172554}.siswa-panel{margin-top:22px}.siswa-panel h2{font-size:15px;margin:0 0 16px}.siswa-table-wrap{overflow-x:auto}table{width:100%;border-collapse:collapse;font-size:12px}th,td{text-align:left;padding:13px 12px;border-bottom:1px solid #edf0f5;vertical-align:middle}th{color:#64748b;background:#f8fafc;font-weight:650;white-space:nowrap}.siswa-btn{display:inline-flex;align-items:center;justify-content:center;border:0;background:#17357f;color:#fff;border-radius:9px;padding:10px 14px;font:inherit;font-size:12px;font-weight:650;cursor:pointer}.siswa-btn:hover{background:#244a9e}.siswa-btn.secondary{background:#eef2ff;color:#17357f}.siswa-btn.danger{background:#fff1f2;color:#be123c}.siswa-form{display:grid;gap:16px}.siswa-field label{display:block;font-size:12px;font-weight:650;color:#334155;margin-bottom:7px}.siswa-field input,.siswa-field select,.siswa-field textarea{width:100%;padding:11px 12px;border:1px solid #d7deea;border-radius:9px;background:#fff;font:inherit;font-size:13px;color:#1e293b}.siswa-field textarea{min-height:120px;resize:vertical}.siswa-field small{display:block;color:#64748b;font-size:11px;margin-top:6px}.siswa-alert{padding:12px 14px;border-radius:10px;font-size:13px;margin-bottom:16px}.siswa-alert.success{background:#ecfdf5;color:#047857;border:1px solid #bbf7d0}.siswa-alert.error{background:#fff1f2;color:#be123c;border:1px solid #fecdd3}.siswa-badge{display:inline-flex;align-items:center;border-radius:20px;padding:5px 9px;font-size:11px;font-weight:700}.siswa-badge.success{background:#ecfdf5;color:#047857}.siswa-badge.warning{background:#fff7ed;color:#c2410c}.siswa-badge.info{background:#eff6ff;color:#1d4ed8}.siswa-muted{color:#64748b;font-size:12px}.siswa-grid-2{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}.siswa-actions{display:flex;justify-content:flex-end;gap:9px;flex-wrap:wrap;margin-top:20px}.siswa-pagination{padding-top:16px;font-size:12px}.siswa-notice{border:1px solid #e5eaf2;border-radius:12px;padding:16px;margin-bottom:10px;background:#fff}.siswa-notice.unread{border-left:4px solid #315fc4;background:#f8faff}.siswa-notice h3{font-size:13px;margin:0 0 6px}.siswa-notice p{font-size:12px;line-height:1.6;color:#64748b;margin:0 0 8px}
@media(max-width:850px){.siswa-stats{grid-template-columns:1fr 1fr}.siswa-content{padding:20px}}@media(max-width:620px){.siswa-layout{display:block}.siswa-sidebar{position:relative;width:100%;height:auto;max-height:none;overflow:visible;padding:14px}.siswa-brand{padding:0 5px 12px}.siswa-nav-title{display:none}.siswa-link{display:inline-flex;padding:9px;margin:4px 2px 0 0}.siswa-topbar{padding:14px 16px}.siswa-content{padding:18px 14px}.siswa-content h1{font-size:21px}.siswa-grid-2{grid-template-columns:1fr}.siswa-stats{gap:9px}.siswa-card{padding:14px}.siswa-stat-value{font-size:23px}}
</style>
@stack('styles')
</head>
<body>
<div class="siswa-layout">
<aside class="siswa-sidebar">
<a class="siswa-brand" href="{{ route('siswa.dashboard') }}">GUSPELOR.NET<small>Panel Siswa PKL</small></a>
<div class="siswa-nav-title">Menu Siswa</div>
<a class="siswa-link {{ request()->routeIs('siswa.dashboard')?'active':'' }}" href="{{ route('siswa.dashboard') }}">Dashboard</a>
<a class="siswa-link {{ request()->routeIs('siswa.absensi.*')?'active':'' }}" href="{{ route('siswa.absensi.index') }}">Absensi</a>
<a class="siswa-link {{ request()->routeIs('siswa.jurnal.*')?'active':'' }}" href="{{ route('siswa.jurnal.index') }}">Jurnal Harian</a>
<a class="siswa-link {{ request()->routeIs('siswa.notifikasi.*')?'active':'' }}" href="{{ route('siswa.notifikasi.index') }}">Notifikasi @if(($jumlahNotifikasi ?? 0)>0)<span class="siswa-bubble">{{ $jumlahNotifikasi }}</span>@endif</a>
<a class="siswa-link {{ request()->routeIs('siswa.profil')?'active':'' }}" href="{{ route('siswa.profil') }}">Profil Saya</a>
</aside>
<main class="siswa-main">
<header class="siswa-topbar"><strong>@yield('page-heading','Panel Siswa')</strong><div class="siswa-user"><span>{{ auth()->user()->email ?? 'Siswa' }}</span><form method="POST" action="{{ route('logout') }}">@csrf<button class="siswa-logout" type="submit">Keluar</button></form></div></header>
<section class="siswa-content">
@if(session('success'))<div class="siswa-alert success">{{ session('success') }}</div>@endif
@if(session('error'))<div class="siswa-alert error">{{ session('error') }}</div>@endif
@if($errors->any())<div class="siswa-alert error"><strong>Periksa kembali data berikut:</strong><ul style="margin:7px 0 0;padding-left:20px">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
@yield('content')
</section>
</main>
</div>
@stack('scripts')
</body>
</html>
