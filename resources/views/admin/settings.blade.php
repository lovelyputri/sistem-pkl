@extends('layouts.admin')

@section('title', 'Pengaturan Admin')
@section('page-heading', 'Pengaturan Akun')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
<style>
.settings-page{max-width:1440px;margin:0 auto;padding:4px 0 18px;color:#102653}
.settings-hero{position:relative;isolation:isolate;display:flex;align-items:center;gap:20px;min-height:128px;margin:0 0 18px;padding:22px 28px;overflow:hidden;border-radius:18px;background:linear-gradient(105deg,#f7f9ff 0%,#edf2ff 58%,#dce7ff 100%)}
.settings-hero:before{content:"";position:absolute;z-index:-1;right:3%;top:-100px;width:310px;height:310px;border:1px solid rgba(63,108,210,.1);border-radius:50%;box-shadow:0 0 0 28px rgba(63,108,210,.035),0 0 0 58px rgba(63,108,210,.025)}
.settings-hero:after{content:"";position:absolute;z-index:-1;right:7%;bottom:-120px;width:220px;height:220px;border-radius:48% 48% 44% 44%;background:linear-gradient(145deg,rgba(91,137,236,.17),rgba(91,137,236,.02));transform:rotate(25deg)}
.settings-hero-icon{display:grid;place-items:center;width:72px;height:72px;flex:0 0 72px;border-radius:22px;background:#dce6ff;color:#2456c5;box-shadow:inset 0 0 0 1px rgba(255,255,255,.7)}
.settings-hero-icon svg{width:37px;height:37px;fill:currentColor}
.settings-hero-copy{position:relative;z-index:1}
.settings-hero-copy h1{margin:0;color:#102653;font-size:clamp(22px,2vw,29px);font-weight:800;letter-spacing:-.8px}
.settings-hero-copy p{margin:7px 0 0;color:#687fae;font-size:13px}
.settings-hero-art{position:absolute;right:7%;top:50%;width:135px;height:135px;display:grid;place-items:center;transform:translateY(-50%);opacity:.85}
.settings-hero-art svg{width:100%;height:100%;filter:drop-shadow(0 10px 12px rgba(35,83,185,.12))}
.settings-alert{display:flex;gap:10px;align-items:flex-start;padding:12px 15px;margin:0 0 16px;border-radius:11px;font-size:12px;line-height:1.6}
.settings-alert strong{display:block;margin-bottom:3px}
.settings-success{background:#effaf4;border:1px solid #ccebd8;color:#17643a}
.settings-error{background:#fff5f5;border:1px solid #f4d0d0;color:#a12d35}
.settings-error ul{margin:5px 0 0;padding-left:18px}
.settings-workspace{display:grid;grid-template-columns:minmax(250px, .78fr) minmax(0,2.22fr);gap:20px;align-items:stretch}
.settings-profile-card{position:relative;isolation:isolate;display:flex;flex-direction:column;align-items:center;min-height:570px;padding:32px 25px 25px;overflow:hidden;border-radius:20px;background:radial-gradient(circle at 100% 5%,rgba(77,128,230,.34),transparent 32%),linear-gradient(155deg,#193b7d 0%,#112b60 52%,#0e2451 100%);color:#fff;box-shadow:0 14px 32px rgba(20,48,102,.14)}
.settings-profile-card:before,.settings-profile-card:after{content:"";position:absolute;z-index:-1;border:1px solid rgba(255,255,255,.12);border-radius:50%}
.settings-profile-card:before{width:220px;height:220px;top:-120px;right:-90px;box-shadow:0 0 0 22px rgba(255,255,255,.025),0 0 0 46px rgba(255,255,255,.02)}
.settings-profile-card:after{width:180px;height:180px;bottom:-95px;left:-90px;box-shadow:0 0 0 22px rgba(255,255,255,.025)}
.settings-profile-eyebrow{align-self:flex-start;color:#b9cbed;font-size:9px;font-weight:800;letter-spacing:1.7px;text-transform:uppercase}
.settings-avatar-area{position:relative;margin:20px auto 15px}
.settings-avatar-frame{width:132px;height:132px;padding:6px;border:2px solid rgba(255,255,255,.88);border-radius:50%;background:rgba(255,255,255,.12);box-shadow:0 8px 24px rgba(0,0,0,.18)}
.settings-avatar{display:block;width:100%;height:100%;object-fit:cover;border-radius:50%;background:#eaf0fa}
.settings-avatar-camera{position:absolute;right:-3px;bottom:7px;display:grid;place-items:center;width:39px;height:39px;border:3px solid #173875;border-radius:50%;background:#3268e2;color:#fff;cursor:pointer;box-shadow:0 4px 10px rgba(0,0,0,.18)}
.settings-avatar-camera svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.settings-profile-name{max-width:100%;overflow:hidden;margin:0;color:#fff;font-size:23px;font-weight:800;text-overflow:ellipsis;white-space:nowrap}
.settings-profile-role{display:inline-flex;align-items:center;margin-top:7px;padding:5px 13px;border-radius:20px;background:rgba(151,181,245,.4);color:#edf3ff;font-size:11px;font-weight:650}
.settings-profile-quote{max-width:220px;margin:19px 0 22px;color:#d5e2ff;font-size:12px;font-style:italic;line-height:1.65;text-align:center}
.settings-profile-meta{width:100%;margin-top:auto;padding-top:17px;border-top:1px solid rgba(255,255,255,.24)}
.settings-meta-row{display:flex;align-items:center;gap:12px;margin:0 0 14px;color:#e8efff;font-size:11px;line-height:1.5;overflow-wrap:anywhere}
.settings-meta-icon{display:grid;place-items:center;width:30px;height:30px;flex:0 0 30px;border-radius:9px;background:rgba(255,255,255,.1);color:#d8e5ff}
.settings-meta-icon svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.settings-change-photo{display:flex;align-items:center;justify-content:center;gap:9px;width:100%;min-height:44px;margin-top:8px;border:1px solid rgba(255,255,255,.72);border-radius:11px;background:rgba(255,255,255,.035);color:#fff;font-size:11px;font-weight:750;cursor:pointer;transition:.18s}
.settings-change-photo:hover{background:rgba(255,255,255,.13)}
.settings-change-photo svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.settings-file-input{position:absolute!important;width:1px!important;height:1px!important;padding:0!important;margin:-1px!important;overflow:hidden!important;clip:rect(0,0,0,0)!important;white-space:nowrap!important;border:0!important}
.settings-file-name{display:block;max-width:100%;margin-top:7px;color:#b9cbed;font-size:9px;line-height:1.5;text-align:center;overflow-wrap:anywhere}
.settings-panels{display:flex;flex-direction:column;gap:18px;min-width:0}
.settings-panel{padding:23px 25px;border:1px solid rgba(222,231,249,.95);border-radius:19px;background:rgba(255,255,255,.93);box-shadow:0 9px 26px rgba(42,77,143,.065)}
.settings-panel-head{display:flex;align-items:center;justify-content:space-between;gap:15px;margin-bottom:25px}
.settings-panel-title{display:flex;align-items:center;gap:14px;min-width:0}
.settings-panel-icon{display:grid;place-items:center;width:58px;height:58px;flex:0 0 58px;border-radius:19px;background:linear-gradient(145deg,#e4ebff,#d6e1ff);color:#245bd0}
.settings-panel-icon svg{width:29px;height:29px;fill:currentColor}
.settings-panel-head h2{margin:0;color:#102653;font-size:18px;font-weight:800;letter-spacing:-.3px}
.settings-panel-head p{margin:5px 0 0;color:#7387b3;font-size:11px;line-height:1.5}
.settings-active{display:inline-flex;align-items:center;gap:8px;padding:9px 14px;border-radius:20px;background:#e4f8f0;color:#0c9d70;font-size:11px;font-weight:750;white-space:nowrap}
.settings-active:before{content:"";width:9px;height:9px;border-radius:50%;background:#16b982}
.settings-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px 22px}
.settings-field{min-width:0}
.settings-field.full{grid-column:1/-1}
.settings-field label{display:block;margin:0 0 8px;color:#102653;font-size:12px;font-weight:750}
.settings-input-wrap{position:relative}
.settings-input-icon{position:absolute;left:15px;top:50%;display:grid;place-items:center;color:#718ac4;transform:translateY(-50%);pointer-events:none}
.settings-input-icon svg{width:19px;height:19px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.settings-field input{display:block;width:100%;height:49px;padding:11px 43px 11px 48px;border:1.5px solid #d7e0f5;border-radius:14px;background:#fff;color:#172b50;font:inherit;font-size:12px;transition:border-color .15s,box-shadow .15s}
.settings-field input:focus{outline:none;border-color:#5b7fe0;box-shadow:0 0 0 4px rgba(62,105,211,.1)}
.settings-field input::placeholder{color:#8b9bc0}
.settings-field small{display:block;margin-top:7px;color:#8494b7;font-size:10px;line-height:1.5}
.settings-password-note{margin:-8px 0 18px;color:#8292b3;font-size:10px;line-height:1.6}
.settings-password-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:17px 22px}
.settings-password-grid .settings-field:nth-child(3){grid-column:1}
.settings-toggle-password{position:absolute;right:12px;top:50%;display:grid;place-items:center;width:27px;height:27px;padding:0;border:0;border-radius:7px;background:transparent;color:#7489bd;cursor:pointer;transform:translateY(-50%)}
.settings-toggle-password:hover{background:#eef3ff;color:#315ec5}
.settings-toggle-password svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.settings-actions{display:flex;align-items:center;justify-content:flex-end;gap:12px;margin-top:auto;padding:0 3px 2px}
.settings-reset,.settings-save{display:inline-flex;align-items:center;justify-content:center;gap:10px;min-height:48px;padding:0 19px;border-radius:13px;font:inherit;font-size:12px;font-weight:750;cursor:pointer;transition:transform .15s,box-shadow .15s,background .15s}
.settings-reset{border:1.5px solid #9bb5ff;background:rgba(255,255,255,.68);color:#285bd0}
.settings-reset:hover{background:#fff;box-shadow:0 5px 15px rgba(43,87,185,.1)}
.settings-save{border:1px solid #285bd0;background:linear-gradient(100deg,#3268e5,#2453c8);color:#fff;box-shadow:0 7px 17px rgba(40,88,205,.2)}
.settings-save:hover{transform:translateY(-1px);box-shadow:0 10px 20px rgba(40,88,205,.25)}
.settings-actions svg{width:17px;height:17px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.crop-modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:20px;background:rgba(15,23,42,.66);backdrop-filter:blur(4px)}
.crop-modal.is-open{display:flex}
.crop-dialog{width:min(100%,620px);max-height:calc(100vh - 40px);overflow:auto;border-radius:16px;background:#fff;box-shadow:0 24px 70px rgba(0,0,0,.25)}
.crop-dialog-head{display:flex;align-items:flex-start;justify-content:space-between;gap:15px;padding:19px 22px;border-bottom:1px solid #edf0f5}
.crop-dialog-head h3{margin:0;color:#172554;font-size:15px;font-weight:750}
.crop-dialog-head p{margin:5px 0 0;color:#718096;font-size:11px;line-height:1.5}
.crop-close{width:32px;height:32px;border:0;border-radius:8px;background:#f1f5f9;color:#475569;font-size:20px;cursor:pointer}
.crop-workspace{height:360px;margin:18px 22px 12px;overflow:hidden;background:#f1f4f8;border-radius:10px}
.crop-workspace img{display:block;max-width:100%;max-height:100%}
.crop-hint{margin:0 22px;color:#718096;font-size:11px;line-height:1.6}
.crop-dialog-actions{display:flex;justify-content:flex-end;gap:9px;padding:17px 22px 20px}
.crop-action{min-height:38px;padding:0 15px;border:1px solid #dbe2ec;border-radius:8px;background:#fff;color:#475569;font:inherit;font-size:12px;font-weight:650;cursor:pointer}
.crop-action.primary{border-color:#234da7;background:#234da7;color:#fff}
.crop-action:disabled{opacity:.55;cursor:not-allowed}
.cropper-view-box,.cropper-face{border-radius:50%}
.cropper-view-box{outline:2px solid #fff;box-shadow:0 0 0 1px rgba(35,77,167,.5)}
@media(max-width:1050px){.settings-workspace{grid-template-columns:250px minmax(0,1fr);gap:14px}.settings-profile-card{min-height:550px;padding:26px 18px}.settings-panel{padding:20px}}
@media(max-width:760px){.settings-hero{min-height:112px;padding:18px}.settings-hero-icon{width:56px;height:56px;flex-basis:56px;border-radius:17px}.settings-hero-icon svg{width:29px;height:29px}.settings-hero-art{right:1%;width:105px;height:105px;opacity:.45}.settings-workspace{grid-template-columns:1fr}.settings-profile-card{min-height:0;padding:22px}.settings-profile-meta{max-width:380px;margin-top:15px}.settings-profile-quote{margin:12px 0}.settings-avatar-area{margin:13px auto}.settings-avatar-frame{width:105px;height:105px}.settings-panels{gap:13px}.settings-panel{padding:18px}.settings-panel-head{margin-bottom:19px}.settings-panel-icon{width:47px;height:47px;flex-basis:47px;border-radius:15px}.settings-panel-head h2{font-size:16px}}
@media(max-width:520px){.settings-hero{gap:12px;padding:16px}.settings-hero-copy h1{font-size:21px}.settings-hero-copy p{font-size:11px;max-width:240px}.settings-hero-art{display:none}.settings-grid,.settings-password-grid{grid-template-columns:1fr;gap:14px}.settings-field.full,.settings-password-grid .settings-field:nth-child(3){grid-column:auto}.settings-panel-head{align-items:flex-start}.settings-active{padding:7px 10px;font-size:10px}.settings-panel-title{gap:10px}.settings-panel-icon{width:42px;height:42px;flex-basis:42px}.settings-panel-head h2{font-size:15px}.settings-panel-head p{font-size:10px}.settings-actions{flex-direction:column-reverse;align-items:stretch}.settings-reset,.settings-save{width:100%}.crop-modal{padding:10px}.crop-dialog{max-height:calc(100vh - 20px)}.crop-workspace{height:300px;margin:14px}.crop-dialog-head{padding:16px}.crop-dialog-actions{padding:14px}.crop-hint{margin:0 14px}}

/* Samakan lebar dan padding halaman dengan Dashboard Admin */
.admin-content:has(.settings-page){width:100%!important;max-width:none!important;margin:0!important;padding:22px 24px 30px!important}
.settings-page{width:100%!important;max-width:none!important;margin:0!important;padding:0 0 18px!important;box-sizing:border-box}
.settings-page *{box-sizing:border-box}
@media(max-width:820px){.admin-content:has(.settings-page){padding:17px 15px!important}}
@media(max-width:560px){.admin-content:has(.settings-page){padding:13px 11px 20px!important}}

</style>
@endpush

@section('content')
<div class="settings-page">
    <div class="settings-hero">
        <div class="settings-hero-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24"><path d="M19.4 13a7.8 7.8 0 0 0 0-2l2-1.5-2-3.4-2.4 1a7.7 7.7 0 0 0-1.7-1L15 3h-4l-.4 3.1a7.7 7.7 0 0 0-1.7 1l-2.4-1-2 3.4 2 1.5a7.8 7.8 0 0 0 0 2l-2 1.5 2 3.4 2.4-1a7.7 7.7 0 0 0 1.7 1L11 21h4l.4-3.1a7.7 7.7 0 0 0 1.7-1l2.4 1 2-3.4zM13 15.5a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7"/></svg>
        </div>
        <div class="settings-hero-copy">
            <h1>Pengaturan Akun Admin</h1>
            <p>Kelola informasi akun dan keamanan Anda dengan mudah.</p>
        </div>
        <div class="settings-hero-art" aria-hidden="true">
            <svg viewBox="0 0 160 160" fill="none">
                <path d="M80 12 133 32v39c0 35-21 58-53 76C48 129 27 106 27 71V32L80 12Z" fill="#6C91EF" opacity=".22"/>
                <path d="M80 24 120 39v32c0 27-15 45-40 60-25-15-40-33-40-60V39l40-15Z" fill="#3568D7"/>
                <path d="M80 24 120 39v32c0 27-15 45-40 60-25-15-40-33-40-60V39l40-15Z" stroke="#8EAEFF" stroke-width="3"/>
                <rect x="61" y="65" width="38" height="31" rx="7" fill="#EAF0FF"/>
                <path d="M69 65V55a11 11 0 0 1 22 0v10" stroke="#EAF0FF" stroke-width="7" stroke-linecap="round"/>
                <circle cx="80" cy="79" r="5" fill="#3568D7"/><path d="M80 83v6" stroke="#3568D7" stroke-width="3" stroke-linecap="round"/>
                <path d="m18 42 3 7 7 3-7 3-3 7-3-7-7-3 7-3 3-7Zm119-17 2 5 5 2-5 2-2 5-2-5-5-2 5-2 2-5Z" fill="#7EA2F5"/>
            </svg>
        </div>
    </div>

    @if (session('success'))
        <div class="settings-alert settings-success" role="status">
            <span aria-hidden="true">✓</span>
            <div><strong>Perubahan berhasil disimpan</strong>{{ session('success') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="settings-alert settings-error" role="alert">
            <span aria-hidden="true">!</span>
            <div><strong>Periksa kembali data yang dimasukkan.</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        </div>
    @endif

    <form id="adminSettingsForm" method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="settings-workspace">
            <aside class="settings-profile-card">
                <div class="settings-profile-eyebrow">Admin profile</div>
                <div class="settings-avatar-area">
                    <div class="settings-avatar-frame">
                        <img id="profilePhotoPreview" class="settings-avatar" src="{{ $admin->foto_profil ? asset('storage/'.$admin->foto_profil) : asset('images/logo.png') }}" alt="Foto profil admin">
                    </div>
                    <label class="settings-avatar-camera" for="foto_profil" title="Ganti foto profil">
                        <svg viewBox="0 0 24 24"><path d="M4 8h3l2-3h6l2 3h3a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1Z"/><circle cx="12" cy="13" r="3.5"/></svg>
                    </label>
                </div>
                <h2 class="settings-profile-name" id="profileDisplayName">{{ old('nama_akun', $admin->nama_akun ?? 'Admin') }}</h2>
                <span class="settings-profile-role">Administrator</span>
                <p class="settings-profile-quote">“Kelola sistem dengan lebih baik lagi.”</p>
                <div class="settings-profile-meta">
                    <div class="settings-meta-row">
                        <span class="settings-meta-icon"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></svg></span>
                        <span>{{ $admin->email }}</span>
                    </div>
                    <div class="settings-meta-row">
                        <span class="settings-meta-icon"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg></span>
                        <span>Administrator GUSPELOR.NET</span>
                    </div>
                    <label class="settings-change-photo" for="foto_profil">
                        <svg viewBox="0 0 24 24"><path d="M20 7v5h-5M4 17v-5h5"/><path d="M5.6 9A7 7 0 0 1 18 6l2 6M4 12l2 6a7 7 0 0 0 12.4-3"/></svg>
                        Ganti Foto Profil
                    </label>
                    <input id="foto_profil" class="settings-file-input" type="file" name="foto_profil" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                    <span class="settings-file-name" id="profilePhotoName">JPG, PNG, atau WEBP · Maksimal 2 MB</span>
                </div>
            </aside>

            <div class="settings-panels">
                <section class="settings-panel">
                    <div class="settings-panel-head">
                        <div class="settings-panel-title">
                            <span class="settings-panel-icon"><svg viewBox="0 0 24 24"><path d="M12 12a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM4 21a8 8 0 0 1 16 0H4Z"/></svg></span>
                            <div><h2>Informasi Akun</h2><p>Perbarui informasi profil dan akun Anda.</p></div>
                        </div>
                        <span class="settings-active">Aktif</span>
                    </div>
                    <div class="settings-grid">
                        <div class="settings-field">
                            <label for="nama_akun">Nama Akun Admin</label>
                            <div class="settings-input-wrap">
                                <span class="settings-input-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg></span>
                                <input id="nama_akun" type="text" name="nama_akun" value="{{ old('nama_akun', $admin->nama_akun ?? 'Admin') }}" maxlength="100" autocomplete="name" required>
                            </div>
                        </div>
                        <div class="settings-field">
                            <label for="email">Email Admin</label>
                            <div class="settings-input-wrap">
                                <span class="settings-input-icon"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></svg></span>
                                <input id="email" type="email" name="email" value="{{ old('email', $admin->email) }}" maxlength="255" autocomplete="email" required>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="settings-panel">
                    <div class="settings-panel-head">
                        <div class="settings-panel-title">
                            <span class="settings-panel-icon"><svg viewBox="0 0 24 24"><path d="M12 2 20 5v6c0 5-3.5 8.5-8 11-4.5-2.5-8-6-8-11V5l8-3Z"/><path d="m9 12 2 2 4-4"/></svg></span>
                            <div><h2>Keamanan Akun</h2><p>Jaga keamanan akun Anda dengan mengganti password secara berkala.</p></div>
                        </div>
                    </div>
                    <p class="settings-password-note">Password saat ini wajib diisi untuk memverifikasi perubahan. Password baru boleh dikosongkan jika tidak ingin menggantinya.</p>
                    <div class="settings-password-grid">
                        <div class="settings-field">
                            <label for="current_password">Password Saat Ini *</label>
                            <div class="settings-input-wrap">
                                <span class="settings-input-icon"><svg viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg></span>
                                <input id="current_password" type="password" name="current_password" placeholder="Masukkan password saat ini" autocomplete="current-password" required>
                                <button class="settings-toggle-password" type="button" data-target="current_password" aria-label="Tampilkan password"><svg viewBox="0 0 24 24"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6Z"/><circle cx="12" cy="12" r="3"/></svg></button>
                            </div>
                        </div>
                        <div class="settings-field">
                            <label for="password">Password Baru</label>
                            <div class="settings-input-wrap">
                                <span class="settings-input-icon"><svg viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg></span>
                                <input id="password" type="password" name="password" placeholder="Masukkan password baru" minlength="8" autocomplete="new-password">
                                <button class="settings-toggle-password" type="button" data-target="password" aria-label="Tampilkan password"><svg viewBox="0 0 24 24"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6Z"/><circle cx="12" cy="12" r="3"/></svg></button>
                            </div>
                            <small>Minimal 8 karakter.</small>
                        </div>
                        <div class="settings-field">
                            <label for="password_confirmation">Konfirmasi Password Baru</label>
                            <div class="settings-input-wrap">
                                <span class="settings-input-icon"><svg viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg></span>
                                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Konfirmasi password baru" minlength="8" autocomplete="new-password">
                                <button class="settings-toggle-password" type="button" data-target="password_confirmation" aria-label="Tampilkan password"><svg viewBox="0 0 24 24"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6Z"/><circle cx="12" cy="12" r="3"/></svg></button>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="settings-actions">
                    <button type="reset" class="settings-reset" id="resetSettings">
                        <svg viewBox="0 0 24 24"><path d="M3 12a9 9 0 1 0 2.6-6.4L3 8"/><path d="M3 3v5h5"/></svg>
                        Reset Form
                    </button>
                    <button type="submit" class="settings-save">
                        <svg viewBox="0 0 24 24"><path d="M5 3h12l4 4v14H3V3h2Z"/><path d="M7 3v6h10V3M7 21v-8h10v8"/></svg>
                        Simpan Perubahan
                        <svg viewBox="0 0 24 24"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="crop-modal" id="profileCropModal" aria-hidden="true">
    <div class="crop-dialog" role="dialog" aria-modal="true" aria-labelledby="cropDialogTitle">
        <div class="crop-dialog-head">
            <div><h3 id="cropDialogTitle">Atur Foto Profil</h3><p>Geser foto untuk mengatur posisi. Area lingkaran menunjukkan bagian foto yang akan digunakan.</p></div>
            <button type="button" class="crop-close" id="cancelCropTop" aria-label="Tutup">×</button>
        </div>
        <div class="crop-workspace"><img id="profileCropImage" alt="Foto yang akan dipangkas"></div>
        <p class="crop-hint">Gunakan scroll atau gerakan pinch untuk memperbesar dan memperkecil foto.</p>
        <div class="crop-dialog-actions"><button type="button" class="crop-action" id="cancelCrop">Batal</button><button type="button" class="crop-action primary" id="applyCrop">Gunakan Foto</button></div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('adminSettingsForm');
    const photoInput = document.getElementById('foto_profil');
    const photoPreview = document.getElementById('profilePhotoPreview');
    const photoName = document.getElementById('profilePhotoName');
    const profileName = document.getElementById('profileDisplayName');
    const modal = document.getElementById('profileCropModal');
    const cropImage = document.getElementById('profileCropImage');
    const applyButton = document.getElementById('applyCrop');
    const cancelButton = document.getElementById('cancelCrop');
    const closeButton = document.getElementById('cancelCropTop');
    if (!form || !photoInput || !photoPreview || !modal) return;

    const originalPreview = photoPreview.src;
    const originalFileLabel = photoName.textContent;
    let cropper = null;
    let selectedFile = null;
    let sourceUrl = null;
    let previewUrl = null;

    function closeCropper(resetInput) {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        if (cropper) { cropper.destroy(); cropper = null; }
        if (sourceUrl) { URL.revokeObjectURL(sourceUrl); sourceUrl = null; }
        if (resetInput) {
            photoInput.value = '';
            selectedFile = null;
            photoName.textContent = originalFileLabel;
        }
    }

    function openCropper(file) {
        selectedFile = file;
        sourceUrl = URL.createObjectURL(file);
        cropImage.onload = function () {
            if (cropper) cropper.destroy();
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            cropper = new Cropper(cropImage, {
                aspectRatio: 1, viewMode: 1, dragMode: 'move', autoCropArea: 1,
                responsive: true, background: false, guides: false, center: true,
                highlight: false, cropBoxMovable: false, cropBoxResizable: false,
                toggleDragModeOnDblclick: false, zoomable: true, scalable: true, rotatable: false
            });
        };
        cropImage.src = sourceUrl;
    }

    photoInput.addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (!file) return;
        if (!['image/jpeg','image/png','image/webp'].includes(file.type)) {
            this.value = ''; photoName.textContent = 'Format foto tidak didukung'; return;
        }
        if (file.size > 2 * 1024 * 1024) {
            this.value = ''; photoName.textContent = 'Ukuran foto melebihi 2 MB'; return;
        }
        if (typeof Cropper === 'undefined') {
            photoName.textContent = 'Fitur pangkas gagal dimuat. Periksa koneksi internet.';
            this.value = ''; return;
        }
        openCropper(file);
    });

    applyButton.addEventListener('click', function () {
        if (!cropper || !selectedFile) return;
        applyButton.disabled = true;
        const canvas = cropper.getCroppedCanvas({width:512,height:512,imageSmoothingEnabled:true,imageSmoothingQuality:'high'});
        canvas.toBlob(function (blob) {
            applyButton.disabled = false;
            if (!blob) return;
            const baseName = selectedFile.name.replace(/\\.[^.]+$/, '') || 'foto-profil';
            const croppedFile = new File([blob], baseName + '-crop.jpg', {type:'image/jpeg',lastModified:Date.now()});
            const transfer = new DataTransfer();
            transfer.items.add(croppedFile);
            photoInput.files = transfer.files;
            if (previewUrl) URL.revokeObjectURL(previewUrl);
            previewUrl = URL.createObjectURL(croppedFile);
            photoPreview.src = previewUrl;
            photoName.textContent = croppedFile.name + ' · sudah dipangkas';
            closeCropper(false);
            selectedFile = null;
        }, 'image/jpeg', 0.92);
    });

    function cancelSelection() { closeCropper(true); }
    cancelButton.addEventListener('click', cancelSelection);
    closeButton.addEventListener('click', cancelSelection);
    modal.addEventListener('click', function (event) { if (event.target === modal) cancelSelection(); });
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal.classList.contains('is-open')) cancelSelection();
    });

    document.querySelectorAll('.settings-toggle-password').forEach(function (button) {
        button.addEventListener('click', function () {
            const field = document.getElementById(button.dataset.target);
            if (!field) return;
            const show = field.type === 'password';
            field.type = show ? 'text' : 'password';
            button.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        });
    });

    const nameInput = document.getElementById('nama_akun');
    if (nameInput && profileName) {
        nameInput.addEventListener('input', function () {
            profileName.textContent = nameInput.value.trim() || 'Admin';
        });
    }

    form.addEventListener('reset', function () {
        setTimeout(function () {
            photoPreview.src = originalPreview;
            photoName.textContent = originalFileLabel;
            if (profileName && nameInput) profileName.textContent = nameInput.value || 'Admin';
            document.querySelectorAll('.settings-toggle-password').forEach(function (button) {
                const field = document.getElementById(button.dataset.target);
                if (field) field.type = 'password';
            });
            if (previewUrl) { URL.revokeObjectURL(previewUrl); previewUrl = null; }
            if (modal.classList.contains('is-open')) closeCropper(true);
        }, 0);
    });
});
</script>
@endpush
@endsection
