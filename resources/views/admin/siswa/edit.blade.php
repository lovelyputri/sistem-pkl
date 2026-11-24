@extends('layouts.admin')

@section('title', 'Edit Profil Siswa')
@section('page-heading', 'Edit Profil Siswa')

@push('styles')
<style>
/* Samakan lebar dan jarak area konten dengan Dashboard serta Data Siswa */
.admin-content:has(.student-edit-head){width:100%;max-width:none;margin:0;padding:22px 24px 30px}
@media(max-width:820px){.admin-content:has(.student-edit-head){padding:17px}}
@media(max-width:560px){.admin-content:has(.student-edit-head){padding:13px 11px 20px}}

.edit-intro{display:flex;align-items:center;gap:14px}
.edit-avatar{width:52px;height:52px;flex-shrink:0;border-radius:50%;display:flex;align-items:center;justify-content:center;background:#e8efff;color:#244a9b;font-size:20px;font-weight:700}
.edit-card{background:#fff;border:1px solid #e5eaf2;border-radius:13px;padding:22px;margin-bottom:18px}
.edit-card-head{display:flex;align-items:center;gap:12px;margin-bottom:20px}
.edit-card-head .num{width:34px;height:34px;display:flex;align-items:center;justify-content:center;border-radius:9px;background:#eaf0ff;color:#244a9b;font-weight:700;font-size:12px}
.edit-card-head h2{margin:0 0 4px;font-size:14px}
.edit-card-head p{margin:0;color:#64748b;font-size:11px}
.edit-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:17px}
.edit-field label{display:block;font-size:12px;font-weight:650;color:#334155;margin-bottom:8px}
.edit-field input,.edit-field select{width:100%;padding:12px;border:1px solid #d7deea;border-radius:9px;background:#fff;font:inherit;font-size:13px;color:#172033}
.edit-field input:focus,.edit-field select:focus{outline:none;border-color:#315fc4;box-shadow:0 0 0 3px rgba(49,95,196,.1)}
.edit-field small{display:block;color:#94a3b8;font-size:11px;margin-top:6px}
.edit-required{color:#dc2626}
@media(max-width:650px){.edit-grid{grid-template-columns:1fr}.edit-card{padding:16px}}

.student-edit-page{max-width:100%;color:#172033}
.student-edit-head{display:flex;align-items:center;justify-content:space-between;gap:18px;flex-wrap:wrap;padding:22px 25px;margin-bottom:20px;border-radius:17px;background:linear-gradient(115deg,#122b68,#214b9d 65%,#3972ce);color:#fff}
.student-edit-head .edit-intro{gap:14px}
.student-edit-head .edit-avatar{width:58px;height:58px;border:2px solid rgba(255,255,255,.4);background:rgba(255,255,255,.16);color:#fff;overflow:hidden}
.student-edit-head h1{font-size:22px;font-weight:750;letter-spacing:-.4px;margin:0 0 5px;color:#fff}
.student-edit-head p{font-size:12px;color:#dce8ff}
.student-edit-head>a{padding:10px 14px!important;border:1px solid rgba(255,255,255,.32)!important;background:rgba(255,255,255,.12)!important;color:#fff!important;border-radius:10px!important;position:relative}
.student-edit-page .edit-card{border:1px solid #e5eaf2;border-radius:16px;padding:23px 24px;background:linear-gradient(145deg,#fff,#fbfcff);box-shadow:0 5px 18px rgba(24,48,91,.035);margin-bottom:15px}
.student-edit-page .edit-card-head{padding-bottom:15px;border-bottom:1px solid #edf1f7;margin-bottom:19px}
.student-edit-page .edit-card-head .num{width:38px;height:38px;border-radius:12px;background:#eaf1ff;color:#244a9b;box-shadow:inset 0 0 0 1px #dce7ff}
.student-edit-page .edit-card-head h2{font-size:15px;font-weight:750;color:#1d2d49}
.student-edit-page .edit-card-head p{font-size:11px;color:#8996aa}
.student-edit-page .edit-grid{gap:19px 22px}
.student-edit-page .edit-field label{font-size:11px;font-weight:700;color:#3b4a63}
.student-edit-page .edit-field input,.student-edit-page .edit-field select{min-height:44px;padding:11px 13px;border:1px solid #dce3ee;border-radius:10px;font-size:12px;transition:.18s}
.student-edit-page .edit-field input:focus,.student-edit-page .edit-field select:focus{outline:none;border-color:#4775ca;box-shadow:0 0 0 4px rgba(49,95,196,.09)}
.student-edit-page .edit-field small{font-size:10px;color:#8996aa}
.student-edit-page .edit-actions{border-top:1px solid #e8edf5;margin-top:5px;padding:18px 0 28px}
.student-edit-page .edit-actions button{padding:12px 20px!important;border-radius:10px!important;background:#214b9d!important;box-shadow:0 5px 12px rgba(33,75,157,.18);font-weight:700!important}
@media(max-width:650px){.student-edit-head{padding:18px;border-radius:14px}.student-edit-head h1{font-size:19px}.student-edit-page .edit-card{padding:17px}.student-edit-page .edit-grid{gap:14px}}


/* Penyempurnaan tampilan form edit siswa */
.student-edit-head{min-height:132px;padding:25px 29px;box-shadow:0 12px 28px rgba(23,53,127,.13);position:relative;overflow:hidden}
.student-edit-head:after{content:"";position:absolute;width:220px;height:220px;border:1px solid rgba(255,255,255,.13);border-radius:50%;right:12%;top:-150px;box-shadow:0 0 0 28px rgba(255,255,255,.035),0 0 0 56px rgba(255,255,255,.025);pointer-events:none}
.student-edit-head .edit-intro,.student-edit-head>a{z-index:1}
.student-edit-page .edit-card{transition:border-color .2s,box-shadow .2s}
.student-edit-page .edit-card:hover{border-color:#d5e1f5;box-shadow:0 9px 24px rgba(24,48,91,.06)}
.student-edit-page .edit-field input[type=file]{padding:9px;background:#f8faff;border-style:dashed;cursor:pointer}
.student-edit-page .edit-field input[type=file]::file-selector-button{border:0;border-radius:7px;padding:7px 11px;margin-right:10px;background:#e8efff;color:#244a9b;font-size:11px;font-weight:700;cursor:pointer}
.student-edit-page .edit-actions{display:flex;align-items:center}
.student-edit-page .edit-actions a{transition:.18s}
.student-edit-page .edit-actions a:hover{background:#f5f7fb!important}
@media(max-width:650px){.student-edit-head{min-height:unset}}


/* Redesign visual form edit agar tidak monoton dan tetap konsisten dengan halaman tambah */
.student-edit-head{min-height:154px;padding:28px 32px;border-radius:18px;background:radial-gradient(circle at 82% 18%,rgba(129,177,255,.26),transparent 25%),linear-gradient(115deg,#10275f 0%,#1b438e 58%,#3974d2 100%);box-shadow:0 14px 30px rgba(23,53,127,.14)}
.student-edit-head h1{font-size:26px;letter-spacing:-.7px}
.student-edit-head p{font-size:13px}
.student-edit-head .edit-avatar{width:66px;height:66px;border-radius:18px;font-size:25px;background:rgba(255,255,255,.17);box-shadow:0 5px 16px rgba(4,20,60,.16)}
.student-edit-head>a{padding:11px 16px!important;transition:.2s}
.student-edit-head>a:hover{background:#fff!important;color:#17357f!important;transform:translateY(-2px)}
.student-edit-page .edit-card{position:relative;padding:0 25px 25px;margin-bottom:17px;border-radius:15px;background:#fff;box-shadow:0 5px 16px rgba(27,53,95,.035);overflow:hidden}
.student-edit-page .edit-card:before{content:"";display:block;height:4px;margin:0 -25px 21px;background:linear-gradient(90deg,#315fc4,#8bb4ff 65%,#edf3ff)}
.student-edit-page .edit-card:nth-of-type(2):before{background:linear-gradient(90deg,#168b9b,#7ed3d5 65%,#edfafa)}
.student-edit-page .edit-card:nth-of-type(3):before{background:linear-gradient(90deg,#6c63bd,#aaa4f1 65%,#f2f0ff)}
.student-edit-page .edit-card:nth-of-type(4):before{background:linear-gradient(90deg,#c18a36,#f0c779 65%,#fff8e9)}
.student-edit-page .edit-card-head{padding-bottom:16px;margin-bottom:21px}
.student-edit-page .edit-card-head .num{width:42px;height:42px;border-radius:13px;background:#eaf1ff;color:#2452a6;box-shadow:none;font-size:13px}
.student-edit-page .edit-card:nth-of-type(2) .num{background:#e7f7f7;color:#147b87}
.student-edit-page .edit-card:nth-of-type(3) .num{background:#f0efff;color:#6258ad}
.student-edit-page .edit-card:nth-of-type(4) .num{background:#fff5e2;color:#a87520}
.student-edit-page .edit-card-head h2{font-size:16px;letter-spacing:-.25px}
.student-edit-page .edit-card-head p{line-height:1.6}
.student-edit-page .edit-grid{gap:21px 25px}
.student-edit-page .edit-field label{font-size:11px;margin-bottom:8px}
.student-edit-page .edit-field input,.student-edit-page .edit-field select{min-height:46px;border-radius:9px;background:#fbfcff;padding:12px 14px}
.student-edit-page .edit-field input:hover,.student-edit-page .edit-field select:hover{border-color:#b9c9e4;background:#fff}
.student-edit-page .edit-field input:focus,.student-edit-page .edit-field select:focus{background:#fff}
.student-edit-page .edit-field small{line-height:1.55}
.student-edit-page .edit-field input[type=file]{min-height:46px;background:#f7f9fd}
.student-edit-page .edit-actions{padding:18px 0 30px;border-top:1px solid #e8edf5}
.student-edit-page .edit-actions button{padding:13px 22px!important;background:linear-gradient(120deg,#17357f,#315fc4)!important;transition:.2s}
.student-edit-page .edit-actions button:hover{transform:translateY(-2px);box-shadow:0 8px 18px rgba(33,75,157,.24)}
.student-edit-page .edit-actions a{padding:12px 18px!important;border-radius:10px!important}
@media(max-width:650px){.student-edit-head{min-height:unset;padding:20px}.student-edit-head h1{font-size:21px}.student-edit-head .edit-avatar{width:54px;height:54px;flex-basis:54px;border-radius:15px}.student-edit-page .edit-card{padding:0 16px 19px}.student-edit-page .edit-card:before{margin:0 -16px 17px}.student-edit-page .edit-grid{gap:15px}}


/* Konsistensi layout CRUD siswa dengan dashboard admin */
.admin-content:has(.student-edit-head){width:100%;max-width:1200px;margin:0 auto;padding:28px}
.student-edit-head{margin-bottom:22px;border-radius:14px}
.student-edit-page .edit-card{padding:24px;margin-bottom:17px;border-radius:13px;background:#fff;box-shadow:0 3px 12px rgba(24,48,91,.035)}
.student-edit-page .edit-card-head{margin-bottom:21px}
.student-edit-page .edit-grid{gap:20px 24px}
.student-edit-page .edit-field input,.student-edit-page .edit-field select{min-height:46px}
.student-edit-page .edit-actions{padding-top:8px}
@media(max-width:760px){.admin-content:has(.student-edit-head){padding:20px 15px}}
@media(max-width:650px){.student-edit-page .edit-card{padding:17px}.student-edit-page .edit-grid{gap:15px}}
@media(max-width:480px){.admin-content:has(.student-edit-head){padding:17px 11px}.student-edit-head{padding:19px 18px}}


/* Samakan lebar dan padding halaman CRUD Siswa dengan Dashboard Admin. */
.admin-content:has(.student-edit-head){width:100%!important;max-width:none!important;margin:0!important;padding:22px 24px 30px!important}
@media(max-width:760px){.admin-content:has(.student-edit-head){padding:17px 15px!important}}
@media(max-width:560px){.admin-content:has(.student-edit-head){padding:13px 11px 20px!important}}

/* Aksen biru pada input tanggal, samakan dengan form pendaftaran dan form tambah siswa */
.student-edit-page .edit-field input[type="date"]{
    color-scheme:light;
    accent-color:#2563eb;
    background:#f4f8ff!important;
    border-color:#cbdcf7!important;
    cursor:pointer;
}
.student-edit-page .edit-field input[type="date"]:hover{
    border-color:#9dbcf0!important;
    background:#edf4ff!important;
}
.student-edit-page .edit-field input[type="date"]:focus{
    border-color:#2563eb!important;
    background:#fff!important;
    box-shadow:0 0 0 3px rgba(37,99,235,.12)!important;
    outline:0;
}
.student-edit-page .edit-field input[type="date"]::-webkit-calendar-picker-indicator{
    opacity:1;
    cursor:pointer;
    filter:invert(29%) sepia(89%) saturate(1715%) hue-rotate(205deg) brightness(92%) contrast(94%);
}

/* Dropdown custom biru: konsisten dengan dropdown pada daftar siswa */
.student-form-select{position:relative;width:100%}
.student-form-select-trigger{width:100%;min-height:46px;display:flex;align-items:center;justify-content:space-between;gap:10px;padding:0 13px;border:1px solid #cbdcf7;border-radius:9px;background:#f4f8ff;color:#244579;font:inherit;font-size:12px;text-align:left;cursor:pointer;transition:border-color .15s,background .15s,box-shadow .15s}
.student-form-select-trigger:hover{background:#edf4ff;border-color:#b7c9eb}
.student-form-select.open .student-form-select-trigger,.student-form-select-trigger:focus-visible{outline:0;border-color:#315fc4;box-shadow:0 0 0 3px rgba(49,95,196,.12);background:#fff}
.student-form-select-chevron{width:15px;height:15px;flex:0 0 15px;color:#315fc4;transition:transform .18s}
.student-form-select.open .student-form-select-chevron{transform:rotate(180deg)}
.student-form-select-menu{position:absolute;z-index:80;top:calc(100% + 6px);left:0;right:0;display:none;max-height:230px;overflow-y:auto;padding:5px;border:1px solid #dbe5f5;border-radius:9px;background:#fff;box-shadow:0 12px 28px rgba(20,48,100,.16)}
.student-form-select.open .student-form-select-menu{display:block}
.student-form-select-option{width:100%;display:flex;align-items:center;gap:8px;padding:9px;border:0;border-radius:6px;background:transparent;color:#405675;font:inherit;font-size:12px;text-align:left;cursor:pointer}
.student-form-select-option:hover,.student-form-select-option:focus-visible{outline:0;background:#edf3ff;color:#17357f}
.student-form-select-option[aria-selected=true]{background:#17357f;color:#fff;font-weight:700}
.student-form-select-option[aria-selected=true]::before{content:'✓';font-size:10px}
.student-form-select-option:not([aria-selected=true])::before{content:'';width:10px;flex:0 0 10px}
.student-form-select select{position:absolute!important;width:1px!important;height:1px!important;padding:0!important;margin:-1px!important;overflow:hidden!important;clip:rect(0,0,0,0)!important;white-space:nowrap!important;border:0!important}
@media(max-width:650px){.student-form-select-trigger{min-height:44px}}


/* Custom date picker: mengikuti kalender biru pada halaman Register */
.student-date-field{position:relative}
.student-date-display{width:100%;min-height:46px;padding:11px 42px 11px 13px!important;border:1px solid #cbdcf7!important;border-radius:9px;background:#f4f8ff!important;color:#244579!important;font:inherit;font-size:12px;cursor:pointer}
.student-date-display:hover{background:#edf4ff!important;border-color:#9dbcf0!important}
.student-date-display:focus{outline:0;border-color:#2563eb!important;background:#fff!important;box-shadow:0 0 0 3px rgba(37,99,235,.12)!important}
.student-date-field:after{content:"";position:absolute;right:14px;top:43px;width:16px;height:16px;pointer-events:none;background-repeat:no-repeat;background-size:contain;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2'/%3E%3Cpath d='M16 2v4M8 2v4M3 10h18'/%3E%3C/svg%3E")}
.student-date-picker{display:none;position:absolute;top:calc(100% + 8px);left:0;width:min(100%,360px);min-width:290px;background:#fff;border-radius:16px;padding:17px;box-shadow:0 20px 45px rgba(15,23,42,.18);border:1px solid #e2e8f0;z-index:120}
.student-date-picker.active{display:block;animation:studentDateIn .18s ease}
@keyframes studentDateIn{from{opacity:0;transform:translateY(-6px)}to{opacity:1;transform:translateY(0)}}
.student-date-nav{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
.student-date-nav button{border:0;background:transparent;color:#2563eb;cursor:pointer;padding:7px;border-radius:8px}
.student-date-nav button:hover{background:#eff6ff}
.student-date-title{font-size:14px;font-weight:800;color:#2563eb;cursor:pointer;padding:6px 10px;border-radius:8px}
.student-date-title:hover{background:#eff6ff}
.student-date-grid{display:grid;grid-template-columns:repeat(7,1fr);gap:4px;text-align:center}
.student-date-week{font-size:11px;font-weight:700;color:#64748b;padding:6px 0}
.student-date-day{height:34px;border:0;border-radius:50%;background:transparent;color:#334155;font-size:12px;font-weight:600;cursor:pointer}
.student-date-day:hover{background:#eff6ff;color:#2563eb}
.student-date-day.selected{background:#2563eb;color:#fff;box-shadow:0 3px 9px rgba(37,99,235,.28)}
.student-date-day.muted{color:#a8b3c4}
.student-date-actions{display:flex;gap:9px;margin-top:14px}
.student-date-actions button{flex:1;height:37px;border-radius:9px;font-size:12px;font-weight:700;cursor:pointer}
.student-date-clear{background:#fff;border:1px solid #e2e8f0;color:#475569}
.student-date-today,.student-date-save{background:#2563eb;border:1px solid #2563eb;color:#fff}
.student-date-months{display:none;position:absolute;inset:48px 12px 12px;background:#fff;border:1px solid #e2e8f0;border-radius:13px;padding:12px;box-shadow:0 12px 30px rgba(15,23,42,.14);z-index:2}
.student-date-months.active{display:block}
.student-date-month-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:7px}
.student-date-month-grid button{border:0;border-radius:8px;padding:10px 4px;background:#f8fafc;color:#334155;font-size:12px;font-weight:700;cursor:pointer}
.student-date-month-grid button:hover,.student-date-month-grid button.active{background:#2563eb;color:#fff}
.student-date-year-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
.student-date-year-row button{border:0;border-radius:7px;background:#eff6ff;color:#2563eb;padding:6px 10px;cursor:pointer}
.student-date-year-row strong{color:#1e293b}
@media(max-width:650px){.student-date-picker{width:min(100%,330px);min-width:0;padding:14px}.student-date-day{height:32px}}

</style>
@endpush

@section('content')
<div class="student-edit-head">
    <div class="edit-intro"><div class="edit-avatar">{{ mb_strtoupper(mb_substr($siswa->nama_lengkap, 0, 1)) }}</div><div><h1>Edit Profil Siswa</h1><p class="admin-intro" style="margin:6px 0 0">Perbarui informasi milik {{ $siswa->nama_lengkap }}.</p></div></div>
    <a href="{{ route('admin.siswa.show', $siswa) }}" style="padding:10px 13px;border:1px solid #d7deea;background:#fff;border-radius:9px;font-size:12px;color:#475569">← Kembali ke Profil</a>
</div>
@if ($errors->any())
<div style="padding:14px 16px;background:#fff1f2;border:1px solid #fecdd3;color:#9f1239;border-radius:10px;margin-bottom:18px;font-size:13px"><strong>Data belum bisa disimpan.</strong><ul style="margin:8px 0 0;padding-left:20px">@foreach ($errors->all() as $error)<li style="margin:3px 0">{{ $error }}</li>@endforeach</ul></div>
@endif
<div class="student-edit-page"><form method="POST" enctype="multipart/form-data" action="{{ route('admin.siswa.update', $siswa) }}">
@csrf @method('PUT')
<section class="edit-card">
    <div class="edit-card-head"><div class="num">01</div><div><h2>Identitas Pribadi</h2><p>Pastikan data sesuai dengan identitas siswa.</p></div></div>
    <div class="edit-grid">
        <div class="edit-field"><label for="nama_lengkap">Nama lengkap <span class="edit-required">*</span></label><input id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}" required maxlength="255"></div>
        <div class="edit-field"><label for="nisn">NISN <span class="edit-required">*</span></label><input id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" required maxlength="30"></div>
        <div class="edit-field"><label for="tempat_lahir">Tempat lahir <span class="edit-required">*</span></label><input id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" required maxlength="100"></div>
        <div class="edit-field"><label for="tanggal_lahir_display">Tanggal lahir</label><div class="student-date-field"><input id="tanggal_lahir_display" type="text" class="student-date-display" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir?->format('Y-m-d')) ? \Carbon\Carbon::parse(old('tanggal_lahir', $siswa->tanggal_lahir?->format('Y-m-d')))->format('d/m/Y') : '' }}" placeholder="dd/mm/yyyy" readonly aria-label="Pilih tanggal lahir"><input id="tanggal_lahir" type="hidden" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir?->format('Y-m-d')) }}"><div class="student-date-picker" role="dialog" aria-label="Kalender"><div class="student-date-nav"><button type="button" class="date-prev" aria-label="Bulan sebelumnya">‹</button><button type="button" class="student-date-title date-title"></button><button type="button" class="date-next" aria-label="Bulan berikutnya">›</button></div><div class="student-date-grid"></div><div class="student-date-actions"><button type="button" class="student-date-clear">Bersihkan</button><button type="button" class="student-date-today">Hari ini</button><button type="button" class="student-date-save">Pilih</button></div><div class="student-date-months"><div class="student-date-year-row"><button type="button" class="year-prev">‹</button><strong class="year-label"></strong><button type="button" class="year-next">›</button></div><div class="student-date-month-grid"></div></div></div></div></div>
        <div class="edit-field"><label for="jenis_kelamin">Jenis kelamin</label><select id="jenis_kelamin" name="jenis_kelamin"><option value="">Pilih jenis kelamin</option><option value="Laki-laki" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) === 'Laki-laki')>Laki-laki</option><option value="Perempuan" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) === 'Perempuan')>Perempuan</option></select></div>
        <div class="edit-field"><label for="no_telepon">Nomor telepon</label><input id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $siswa->no_telepon) }}" maxlength="30"></div>
        <div class="edit-field"><label for="foto_profil">Foto profil</label>@if($siswa->foto_profil)<img src="{{ asset('storage/' . $siswa->foto_profil) }}" alt="Foto profil {{ $siswa->nama_lengkap }}" style="width:76px;height:76px;object-fit:cover;border-radius:50%;display:block;margin-bottom:10px">@endif<input id="foto_profil" type="file" name="foto_profil" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"><small>Biarkan kosong jika tidak ingin mengganti foto. Maksimal 2 MB.</small></div>
    </div>
</section>
<section class="edit-card">
    <div class="edit-card-head"><div class="num">02</div><div><h2>Akun Siswa</h2><p>Email untuk masuk ke GUSPELOR.NET.</p></div></div>
    <div class="edit-grid"><div class="edit-field"><label for="email">Email akun <span class="edit-required">*</span></label><input id="email" type="email" name="email" value="{{ old('email', $siswa->user?->email) }}" required maxlength="255"><small>Jika email diubah, siswa harus login menggunakan email yang baru.</small></div></div>
</section>
<section class="edit-card">
    <div class="edit-card-head"><div class="num">03</div><div><h2>Data Sekolah</h2><p>Perbarui sekolah, jurusan, kelas, dan pembimbing.</p></div></div>
    <div class="edit-grid">
        <div class="edit-field"><label for="sekolah_id">Sekolah <span class="edit-required">*</span></label><select id="sekolah_id" name="sekolah_id" required>@foreach($sekolahs as $row)<option value="{{ $row->id }}" @selected((string)old('sekolah_id', $siswa->sekolah_id) === (string)$row->id)>{{ $row->nama_sekolah }}</option>@endforeach</select></div>
        <div class="edit-field"><label for="jurusan_id">Jurusan <span class="edit-required">*</span></label><select id="jurusan_id" name="jurusan_id" required>@foreach($jurusans as $row)<option value="{{ $row->id }}" @selected((string)old('jurusan_id', $siswa->jurusan_id) === (string)$row->id)>{{ $row->nama_jurusan }}</option>@endforeach</select></div>
        <div class="edit-field"><label for="kelas_id">Kelas <span class="edit-required">*</span></label><select id="kelas_id" name="kelas_id" required>@foreach($kelases as $row)<option value="{{ $row->id }}" @selected((string)old('kelas_id', $siswa->kelas_id) === (string)$row->id)>Kelas {{ $row->nama_kelas }}</option>@endforeach</select></div>
        <div class="edit-field"><label for="guru_id">Guru pembimbing</label><select id="guru_id" name="guru_id" disabled><option value="">Pilih sekolah terlebih dahulu</option></select><small>Pilihan guru akan mengikuti sekolah yang dipilih.</small></div>
    </div>
</section>
<section class="edit-card">
    <div class="edit-card-head"><div class="num">04</div><div><h2>Periode PKL</h2><p>Atur jadwal praktik kerja lapangan.</p></div></div>
    <div class="edit-grid">
        <div class="edit-field"><label for="tanggal_mulai_pkl_display">Tanggal mulai PKL</label><div class="student-date-field"><input id="tanggal_mulai_pkl_display" type="text" class="student-date-display" value="{{ old('tanggal_mulai_pkl', $siswa->tanggal_mulai_pkl?->format('Y-m-d')) ? \Carbon\Carbon::parse(old('tanggal_mulai_pkl', $siswa->tanggal_mulai_pkl?->format('Y-m-d')))->format('d/m/Y') : '' }}" placeholder="dd/mm/yyyy" readonly aria-label="Pilih tanggal mulai pkl"><input id="tanggal_mulai_pkl" type="hidden" name="tanggal_mulai_pkl" value="{{ old('tanggal_mulai_pkl', $siswa->tanggal_mulai_pkl?->format('Y-m-d')) }}"><div class="student-date-picker" role="dialog" aria-label="Kalender"><div class="student-date-nav"><button type="button" class="date-prev" aria-label="Bulan sebelumnya">‹</button><button type="button" class="student-date-title date-title"></button><button type="button" class="date-next" aria-label="Bulan berikutnya">›</button></div><div class="student-date-grid"></div><div class="student-date-actions"><button type="button" class="student-date-clear">Bersihkan</button><button type="button" class="student-date-today">Hari ini</button><button type="button" class="student-date-save">Pilih</button></div><div class="student-date-months"><div class="student-date-year-row"><button type="button" class="year-prev">‹</button><strong class="year-label"></strong><button type="button" class="year-next">›</button></div><div class="student-date-month-grid"></div></div></div></div></div>
        <div class="edit-field"><label for="tanggal_selesai_pkl_display">Tanggal selesai PKL</label><div class="student-date-field"><input id="tanggal_selesai_pkl_display" type="text" class="student-date-display" value="{{ old('tanggal_selesai_pkl', $siswa->tanggal_selesai_pkl?->format('Y-m-d')) ? \Carbon\Carbon::parse(old('tanggal_selesai_pkl', $siswa->tanggal_selesai_pkl?->format('Y-m-d')))->format('d/m/Y') : '' }}" placeholder="dd/mm/yyyy" readonly aria-label="Pilih tanggal selesai pkl"><input id="tanggal_selesai_pkl" type="hidden" name="tanggal_selesai_pkl" value="{{ old('tanggal_selesai_pkl', $siswa->tanggal_selesai_pkl?->format('Y-m-d')) }}"><div class="student-date-picker" role="dialog" aria-label="Kalender"><div class="student-date-nav"><button type="button" class="date-prev" aria-label="Bulan sebelumnya">‹</button><button type="button" class="student-date-title date-title"></button><button type="button" class="date-next" aria-label="Bulan berikutnya">›</button></div><div class="student-date-grid"></div><div class="student-date-actions"><button type="button" class="student-date-clear">Bersihkan</button><button type="button" class="student-date-today">Hari ini</button><button type="button" class="student-date-save">Pilih</button></div><div class="student-date-months"><div class="student-date-year-row"><button type="button" class="year-prev">‹</button><strong class="year-label"></strong><button type="button" class="year-next">›</button></div><div class="student-date-month-grid"></div></div></div></div><small>Tidak boleh sebelum tanggal mulai.</small></div>
    </div>
</section>
<div class="edit-actions" style="display:flex;justify-content:flex-end;gap:10px;flex-wrap:wrap;padding-bottom:26px"><a href="{{ route('admin.siswa.show', $siswa) }}" style="padding:12px 16px;border:1px solid #d7deea;background:#fff;border-radius:9px;font-size:13px;color:#475569">Batal</a><button type="submit" style="padding:12px 18px;border:0;background:#17357f;color:#fff;border-radius:9px;font-size:13px;font-weight:650;cursor:pointer">Simpan Perubahan</button></div>
</form></div>

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {
 const months=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
 const shortMonths=['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
 const weekdays=['Min','Sen','Sel','Rab','Kam','Jum','Sab'];
 document.querySelectorAll('.student-date-field').forEach(function(field){
  const display=field.querySelector('.student-date-display'), hidden=field.querySelector('input[type=hidden]'), picker=field.querySelector('.student-date-picker'), grid=field.querySelector('.student-date-grid'), title=field.querySelector('.date-title'), monthsPanel=field.querySelector('.student-date-months'), monthGrid=field.querySelector('.student-date-month-grid'), yearLabel=field.querySelector('.year-label');
  let view=new Date(), selected=null, panelYear=view.getFullYear();
  function parse(v){if(!v)return null;const p=v.split('-').map(Number);return p.length===3?new Date(p[0],p[1]-1,p[2]):null}
  function iso(d){return d.getFullYear()+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+String(d.getDate()).padStart(2,'0')}
  function fmt(d){return String(d.getDate()).padStart(2,'0')+'/'+String(d.getMonth()+1).padStart(2,'0')+'/'+d.getFullYear()}
  function render(){
   title.textContent=months[view.getMonth()]+' '+view.getFullYear();grid.innerHTML='';
   weekdays.forEach(w=>{const el=document.createElement('div');el.className='student-date-week';el.textContent=w;grid.appendChild(el)});
   const first=new Date(view.getFullYear(),view.getMonth(),1).getDay(), count=new Date(view.getFullYear(),view.getMonth()+1,0).getDate();
   for(let i=0;i<first;i++){const e=document.createElement('div');grid.appendChild(e)}
   for(let d=1;d<=count;d++){const btn=document.createElement('button');btn.type='button';btn.className='student-date-day';btn.textContent=d;
    if(selected&&selected.getFullYear()===view.getFullYear()&&selected.getMonth()===view.getMonth()&&selected.getDate()===d)btn.classList.add('selected');
    btn.addEventListener('click',()=>{selected=new Date(view.getFullYear(),view.getMonth(),d);render()});grid.appendChild(btn)}
  }
  function renderMonths(){monthGrid.innerHTML='';yearLabel.textContent=panelYear;shortMonths.forEach((m,i)=>{const b=document.createElement('button');b.type='button';b.textContent=m;if(i===view.getMonth()&&panelYear===view.getFullYear())b.classList.add('active');b.addEventListener('click',()=>{view=new Date(panelYear,i,1);monthsPanel.classList.remove('active');render()});monthGrid.appendChild(b)})}
  function open(){document.querySelectorAll('.student-date-picker.active').forEach(p=>p.classList.remove('active'));selected=parse(hidden.value);view=selected?new Date(selected.getFullYear(),selected.getMonth(),1):new Date();picker.classList.add('active');monthsPanel.classList.remove('active');render()}
  display.addEventListener('click',e=>{e.stopPropagation();picker.classList.contains('active')?picker.classList.remove('active'):open()});
  field.querySelector('.date-prev').addEventListener('click',()=>{view.setMonth(view.getMonth()-1);render()});
  field.querySelector('.date-next').addEventListener('click',()=>{view.setMonth(view.getMonth()+1);render()});
  title.addEventListener('click',()=>{panelYear=view.getFullYear();renderMonths();monthsPanel.classList.toggle('active')});
  field.querySelector('.year-prev').addEventListener('click',()=>{panelYear--;renderMonths()});
  field.querySelector('.year-next').addEventListener('click',()=>{panelYear++;renderMonths()});
  field.querySelector('.student-date-clear').addEventListener('click',()=>{selected=null;hidden.value='';display.value='';picker.classList.remove('active')});
  field.querySelector('.student-date-today').addEventListener('click',()=>{selected=new Date();view=new Date(selected.getFullYear(),selected.getMonth(),1);render()});
  field.querySelector('.student-date-save').addEventListener('click',()=>{if(!selected)return;hidden.value=iso(selected);display.value=fmt(selected);hidden.dispatchEvent(new Event('change',{bubbles:true}));picker.classList.remove('active')});
  const initial=parse(hidden.value);if(initial)display.value=fmt(initial);
  picker.addEventListener('click',e=>e.stopPropagation());
 });
 document.addEventListener('click',()=>document.querySelectorAll('.student-date-picker.active').forEach(p=>p.classList.remove('active')));
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.student-create-page form, .student-edit-page form');
    if (!form) return;

    const closeMenus = (except = null) => {
        form.querySelectorAll('.student-form-select.open').forEach((wrapper) => {
            if (wrapper !== except) {
                wrapper.classList.remove('open');
                wrapper.querySelector('.student-form-select-trigger')?.setAttribute('aria-expanded', 'false');
            }
        });
    };

    form.querySelectorAll('select').forEach((select) => {
        if (select.dataset.customized === 'true') return;
        select.dataset.customized = 'true';
        const wrapper = document.createElement('div');
        wrapper.className = 'student-form-select';
        const trigger = document.createElement('button');
        trigger.type = 'button';
        trigger.className = 'student-form-select-trigger';
        trigger.setAttribute('aria-haspopup', 'listbox');
        trigger.setAttribute('aria-expanded', 'false');
        const label = document.createElement('span');
        label.textContent = select.options[select.selectedIndex]?.text || 'Pilih';
        const chevron = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        chevron.setAttribute('viewBox', '0 0 24 24');
        chevron.setAttribute('fill', 'none');
        chevron.setAttribute('stroke', 'currentColor');
        chevron.setAttribute('stroke-width', '2');
        chevron.setAttribute('stroke-linecap', 'round');
        chevron.setAttribute('stroke-linejoin', 'round');
        chevron.classList.add('student-form-select-chevron');
        const iconPath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        iconPath.setAttribute('d', 'm6 9 6 6 6-6');
        chevron.appendChild(iconPath);
        trigger.append(label, chevron);

        const menu = document.createElement('div');
        menu.className = 'student-form-select-menu';
        menu.setAttribute('role', 'listbox');
        select.parentNode.insertBefore(wrapper, select);
        wrapper.append(trigger, menu, select);

        const renderOptions = () => {
            menu.replaceChildren();
            Array.from(select.options).forEach((option) => {
                const item = document.createElement('button');
                item.type = 'button';
                item.className = 'student-form-select-option';
                item.textContent = option.text;
                item.setAttribute('role', 'option');
                item.setAttribute('aria-selected', option.value === select.value ? 'true' : 'false');
                item.disabled = option.disabled;
                item.addEventListener('click', () => {
                    select.value = option.value;
                    select.dispatchEvent(new Event('change', { bubbles: true }));
                    label.textContent = option.text;
                    renderOptions();
                    wrapper.classList.remove('open');
                    trigger.setAttribute('aria-expanded', 'false');
                });
                menu.appendChild(item);
            });
        };
        renderOptions();
        trigger.addEventListener('click', () => {
            const willOpen = !wrapper.classList.contains('open');
            closeMenus(wrapper);
            wrapper.classList.toggle('open', willOpen);
            trigger.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
        });
        select.addEventListener('change', () => {
            label.textContent = select.options[select.selectedIndex]?.text || 'Pilih';
            renderOptions();
        });
    });

    document.addEventListener('click', (event) => {
        if (!form.contains(event.target) || !event.target.closest('.student-form-select')) closeMenus();
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeMenus();
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sekolahSelect = document.getElementById('sekolah_id');
    const guruSelect = document.getElementById('guru_id');
    const endpoint = @json(route('admin.siswa.guru-by-sekolah'));
    const guruTerpilihAwal = @json(old('guru_id', $siswa->guru_id));

    async function muatGuru(sekolahId, guruTerpilih = '') {
        guruSelect.innerHTML = '';

        if (!sekolahId) {
            guruSelect.disabled = true;
            guruSelect.add(new Option('Pilih sekolah terlebih dahulu', ''));
            return;
        }

        guruSelect.disabled = true;
        guruSelect.add(new Option('Memuat daftar guru...', ''));

        try {
            const response = await fetch(endpoint + '?sekolah_id=' + encodeURIComponent(sekolahId), {
                headers: { 'Accept': 'application/json' }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil daftar guru.');
            }

            const gurus = await response.json();
            guruSelect.innerHTML = '';
            guruSelect.add(new Option(
                gurus.length ? 'Pilih guru pembimbing (opsional)' : 'Belum ada guru di sekolah ini',
                ''
            ));

            gurus.forEach(function (guru) {
                const option = new Option(guru.nama_lengkap, guru.id);
                if (String(guru.id) === String(guruTerpilih)) {
                    option.selected = true;
                }
                guruSelect.add(option);
            });

            guruSelect.disabled = false;
        } catch (error) {
            guruSelect.innerHTML = '';
            guruSelect.add(new Option('Gagal memuat guru. Coba pilih sekolah lagi.', ''));
            guruSelect.disabled = true;
            console.error(error);
        }
    }

    sekolahSelect.addEventListener('change', function () {
        muatGuru(this.value);
    });

    muatGuru(sekolahSelect.value, guruTerpilihAwal);
});
</script>
@endpush

@endsection
