@extends('layouts.admin')

@section('title', 'Tambah Siswa')
@section('page-heading', 'Tambah Siswa')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
<style>
/* Samakan lebar dan jarak area konten dengan Dashboard serta Data Siswa */
.admin-content:has(.student-create-head){width:100%;max-width:none;margin:0;padding:22px 24px 30px}
@media(max-width:820px){.admin-content:has(.student-create-head){padding:17px}}
@media(max-width:560px){.admin-content:has(.student-create-head){padding:13px 11px 20px}}

.student-form .form-section{border:1px solid #e5eaf2;border-radius:13px;padding:22px;margin-bottom:18px;background:#fff}
.student-form .section-heading{display:flex;gap:12px;align-items:center;margin-bottom:20px}
.student-form .section-number{width:36px;height:36px;border-radius:10px;background:#eaf0ff;color:#244a9b;display:flex;align-items:center;justify-content:center;font-weight:700}
.student-form .section-heading h2{font-size:15px;margin:0 0 4px}
.student-form .section-heading p{font-size:12px;color:#64748b;margin:0}
.student-form .fields{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}
.student-form .field label{display:block;font-size:12px;font-weight:650;color:#334155;margin-bottom:8px}
.student-form .field input,.student-form .field select{width:100%;padding:12px 13px;border:1px solid #d7deea;border-radius:9px;background:#fff;color:#172033;font:inherit;font-size:13px;outline:none;transition:border .15s,box-shadow .15s}
.student-form .field input:focus,.student-form .field select:focus{border-color:#315fc4;box-shadow:0 0 0 3px rgba(49,95,196,.1)}
.student-form .field small{display:block;color:#94a3b8;font-size:11px;margin-top:6px;line-height:1.5}
.student-form .required{color:#dc2626}
@media(max-width:650px){.student-form .fields{grid-template-columns:1fr}.student-form .form-section{padding:16px}}

.student-create-page{max-width:100%;color:#172033}
.student-create-head{display:flex;justify-content:space-between;align-items:center;gap:18px;flex-wrap:wrap;padding:24px 26px;margin-bottom:20px;border-radius:18px;background:linear-gradient(115deg,#122b68 0%,#214b9d 62%,#3972ce 100%);color:#fff;position:relative;overflow:hidden}
.student-create-head:after{content:"";position:absolute;width:230px;height:230px;border:1px solid rgba(255,255,255,.13);border-radius:50%;right:8%;top:-145px;box-shadow:0 0 0 28px rgba(255,255,255,.035),0 0 0 58px rgba(255,255,255,.025)}
.student-create-head h1{font-size:23px;font-weight:750;letter-spacing:-.5px;margin:0 0 7px;color:#fff}
.student-create-head p{font-size:12px;color:#dce8ff;margin:0;line-height:1.6}
.student-create-head a{position:relative;z-index:1;padding:10px 15px;border:1px solid rgba(255,255,255,.32);background:rgba(255,255,255,.12);border-radius:10px;color:#fff;font-size:12px;font-weight:650}
.student-create-page .form-section{position:relative;border:1px solid #e5eaf2;border-radius:16px;padding:23px 24px;margin-bottom:15px;background:linear-gradient(145deg,#fff,#fbfcff);box-shadow:0 5px 18px rgba(24,48,91,.035)}
.student-create-page .section-heading{padding-bottom:15px;border-bottom:1px solid #edf1f7;margin-bottom:19px}
.student-create-page .section-number{width:39px;height:39px;border-radius:12px;background:#eaf1ff;color:#244a9b;font-size:12px;box-shadow:inset 0 0 0 1px #dce7ff}
.student-create-page .section-heading h2{font-size:15px;font-weight:750;color:#1d2d49}
.student-create-page .section-heading p{font-size:11px;color:#8996aa}
.student-create-page .fields{gap:19px 22px}
.student-create-page .field label{font-size:11px;font-weight:700;color:#3b4a63}
.student-create-page .field input,.student-create-page .field select{min-height:44px;padding:11px 13px;border:1px solid #dce3ee;border-radius:10px;background:#fff;font-size:12px;transition:.18s}
.student-create-page .field input:focus,.student-create-page .field select:focus{border-color:#4775ca;box-shadow:0 0 0 4px rgba(49,95,196,.09)}
.student-create-page .field small{font-size:10px;color:#8996aa}
.student-create-page .form-note{padding:15px 17px;border-radius:12px;background:#edf4ff;border:1px solid #d9e6ff;color:#294d8c}
.student-create-page .form-actions{border-top:1px solid #e8edf5;margin-top:5px;padding:18px 0 28px}
.student-create-page .form-actions button{padding:12px 20px!important;border-radius:10px!important;background:#214b9d!important;box-shadow:0 5px 12px rgba(33,75,157,.18);font-weight:700!important}
@media(max-width:650px){.student-create-head{padding:20px;border-radius:14px}.student-create-head h1{font-size:20px}.student-create-page .form-section{padding:17px}.student-create-page .fields{gap:14px}}


/* Penyempurnaan tampilan form tambah siswa */
.student-create-head{min-height:142px;padding:27px 30px;box-shadow:0 12px 28px rgba(23,53,127,.13)}
.student-create-head:before{content:"DATA SISWA / PENDAFTARAN";display:block;position:absolute;left:30px;bottom:17px;color:rgba(255,255,255,.58);font-size:9px;font-weight:800;letter-spacing:1.4px}
.student-create-head>div{position:relative;z-index:1}
.student-create-page .form-section{transition:border-color .2s,box-shadow .2s}
.student-create-page .form-section:hover{border-color:#d5e1f5;box-shadow:0 9px 24px rgba(24,48,91,.06)}
.student-create-page .section-number{display:grid;place-items:center;flex:0 0 40px;font-size:12px;font-weight:800}
.student-create-page .field input[type=file]{padding:9px;background:#f8faff;border-style:dashed;cursor:pointer}
.student-create-page .field input[type=file]::file-selector-button{border:0;border-radius:7px;padding:7px 11px;margin-right:10px;background:#e8efff;color:#244a9b;font-size:11px;font-weight:700;cursor:pointer}
.student-create-page .form-actions{display:flex;align-items:center;justify-content:space-between;gap:12px}
.student-create-page .form-actions a{transition:.18s}
.student-create-page .form-actions a:hover{background:#f5f7fb!important}
@media(max-width:650px){.student-create-head:before{display:none}.student-create-head{min-height:unset}}


/* Redesign visual form: hierarki lebih tegas, variasi section, dan field lebih nyaman */
.student-create-head{min-height:168px;padding:30px 34px;margin-bottom:22px;border-radius:18px;background:radial-gradient(circle at 82% 18%,rgba(129,177,255,.28),transparent 25%),linear-gradient(115deg,#10275f 0%,#1b438e 58%,#3974d2 100%);box-shadow:0 14px 30px rgba(23,53,127,.14)}
.student-create-head:before{left:34px;bottom:20px;font-size:9px;letter-spacing:1.8px;color:#bcd1ff}
.student-create-head h1{font-size:27px;letter-spacing:-.8px}
.student-create-head p{font-size:13px;max-width:520px}
.student-create-head>a{padding:11px 16px!important;border-radius:10px!important;background:rgba(255,255,255,.13)!important;border-color:rgba(255,255,255,.28)!important;color:#fff!important;transition:.2s}
.student-create-head>a:hover{background:#fff!important;color:#17357f!important;transform:translateY(-2px)}
.student-create-page .form-section{padding:0 25px 25px;margin-bottom:17px;border:1px solid #e1e8f3;border-radius:15px;background:#fff;box-shadow:0 5px 16px rgba(27,53,95,.035);overflow:hidden}
.student-create-page .form-section:before{content:"";display:block;height:4px;margin:0 -25px 21px;background:linear-gradient(90deg,#315fc4,#8bb4ff 65%,#edf3ff)}
.student-create-page .form-section:nth-of-type(2):before{background:linear-gradient(90deg,#168b9b,#7ed3d5 65%,#edfafa)}
.student-create-page .form-section:nth-of-type(3):before{background:linear-gradient(90deg,#6c63bd,#aaa4f1 65%,#f2f0ff)}
.student-create-page .form-section:nth-of-type(4):before{background:linear-gradient(90deg,#c18a36,#f0c779 65%,#fff8e9)}
.student-create-page .section-heading{padding:0 0 16px;margin-bottom:21px;border-bottom:1px solid #edf1f7}
.student-create-page .section-number{width:42px;height:42px;flex-basis:42px;border-radius:13px;background:#eaf1ff;color:#2452a6;font-size:13px;box-shadow:none}
.student-create-page .form-section:nth-of-type(2) .section-number{background:#e7f7f7;color:#147b87}
.student-create-page .form-section:nth-of-type(3) .section-number{background:#f0efff;color:#6258ad}
.student-create-page .form-section:nth-of-type(4) .section-number{background:#fff5e2;color:#a87520}
.student-create-page .section-heading h2{font-size:16px;letter-spacing:-.25px}
.student-create-page .section-heading p{font-size:11px;line-height:1.6}
.student-create-page .fields{gap:21px 25px}
.student-create-page .field label{font-size:11px;margin-bottom:8px}
.student-create-page .field input,.student-create-page .field select{min-height:46px;border-radius:9px;background:#fbfcff;padding:12px 14px}
.student-create-page .field input:hover,.student-create-page .field select:hover{border-color:#b9c9e4;background:#fff}
.student-create-page .field input:focus,.student-create-page .field select:focus{background:#fff}
.student-create-page .field small{line-height:1.55}
.student-create-page .field input[type=file]{min-height:46px;background:#f7f9fd}
.student-create-page .form-note{box-shadow:inset 3px 0 #3972ce}
.student-create-page .form-actions{padding:17px 0 30px;border-top:1px solid #e8edf5}
.student-create-page .form-actions button{padding:13px 22px!important;background:linear-gradient(120deg,#17357f,#315fc4)!important;transition:.2s}
.student-create-page .form-actions button:hover{transform:translateY(-2px);box-shadow:0 8px 18px rgba(33,75,157,.24)}
.student-create-page .form-actions a{padding:12px 18px!important;border-radius:10px!important}
@media(max-width:650px){.student-create-head{min-height:unset;padding:23px 20px}.student-create-head:before{display:none}.student-create-head h1{font-size:22px}.student-create-page .form-section{padding:0 16px 19px}.student-create-page .form-section:before{margin:0 -16px 17px}.student-create-page .section-heading{gap:10px}.student-create-page .fields{gap:15px}}


/* Konsistensi layout CRUD siswa dengan dashboard admin */
.admin-content:has(.student-create-head){width:100%;max-width:1200px;margin:0 auto;padding:28px}
.student-create-head{margin-bottom:22px;border-radius:14px}
.student-create-page .form-section{padding:24px;margin-bottom:17px;border-radius:13px;background:#fff;box-shadow:0 3px 12px rgba(24,48,91,.035)}
.student-create-page .section-heading{margin-bottom:21px}
.student-create-page .fields{gap:20px 24px}
.student-create-page .field input,.student-create-page .field select{min-height:46px}
.student-create-page .form-actions{padding-top:17px}
@media(max-width:760px){.admin-content:has(.student-create-head){padding:20px 15px}}
@media(max-width:650px){.student-create-page .form-section{padding:17px}.student-create-page .fields{gap:15px}}
@media(max-width:480px){.admin-content:has(.student-create-head){padding:17px 11px}.student-create-head{padding:20px 18px}}


/* Samakan lebar dan padding halaman CRUD Siswa dengan Dashboard Admin. */
.admin-content:has(.student-create-head){width:100%!important;max-width:none!important;margin:0!important;padding:22px 24px 30px!important}
@media(max-width:760px){.admin-content:has(.student-create-head){padding:17px 15px!important}}
@media(max-width:560px){.admin-content:has(.student-create-head){padding:13px 11px 20px!important}}

/* Redesign form tambah siswa: satu panel form yang ringkas dan rapi */
.student-create-head{
    min-height:0!important;
    display:flex;align-items:center;justify-content:space-between;gap:18px;
    padding:4px 2px 18px!important;margin:0 0 16px!important;
    border-radius:0!important;background:transparent!important;
    box-shadow:none!important;color:#172033!important;overflow:visible!important;
}
.student-create-head:before,.student-create-head:after{display:none!important}
.student-create-head>div{position:static!important}
.student-create-head h1{font-size:23px!important;font-weight:750!important;letter-spacing:-.55px!important;color:#172b4d!important;margin:0 0 5px!important}
.student-create-head p{font-size:12px!important;color:#718096!important;line-height:1.6}
.student-create-head>a{
    flex:0 0 auto;position:static!important;z-index:auto!important;
    padding:9px 13px!important;border:1px solid #dce4f0!important;
    border-radius:8px!important;background:#fff!important;color:#36558c!important;
    font-size:11px!important;font-weight:650!important;transition:.18s;
}
.student-create-head>a:hover{background:#f4f7fc!important;border-color:#b9c9e4!important}
.student-account-note{
    display:flex;align-items:flex-start;gap:12px;padding:12px 15px;
    margin:0 0 16px;border:1px solid #dce7f8;border-left:3px solid #4775ca;
    border-radius:8px;background:#f7faff;color:#526782;font-size:11px;line-height:1.65;
}
.student-account-note strong{flex:0 0 auto;color:#294d8c;font-size:11px}
.student-create-page .student-form{
    padding:0 25px;background:#fff;border:1px solid #e3e9f2;
    border-radius:12px;box-shadow:0 3px 12px rgba(24,48,91,.035);
}
.student-create-page .form-section{
    padding:23px 0!important;margin:0!important;border:0!important;
    border-radius:0!important;background:transparent!important;
    box-shadow:none!important;overflow:visible!important;
}
.student-create-page .form-section+ .form-section{border-top:1px solid #edf1f6!important}
.student-create-page .form-section:before{display:none!important}
.student-create-page .section-heading{
    display:flex;align-items:center;gap:10px;padding:0!important;
    margin:0 0 19px!important;border:0!important;
}
.student-create-page .section-number{
    display:grid;place-items:center;width:31px!important;height:31px!important;
    flex:0 0 31px!important;border-radius:8px!important;
    background:#f0f4fb!important;color:#315b9e!important;
    box-shadow:none!important;font-size:10px!important;font-weight:750!important;
}
.student-create-page .section-heading h2{font-size:14px!important;font-weight:700!important;color:#243653!important;margin:0 0 3px!important}
.student-create-page .section-heading p{font-size:10px!important;color:#8793a5!important;margin:0!important}
.student-create-page .fields{grid-template-columns:repeat(2,minmax(0,1fr));gap:17px 22px!important}
.student-create-page .field label{display:block;font-size:11px!important;font-weight:650!important;color:#42516a!important;margin:0 0 7px!important}
.student-create-page .field input,.student-create-page .field select{
    width:100%;min-height:41px!important;padding:10px 12px!important;
    border:1px solid #dce3ed!important;border-radius:7px!important;
    background:#fff!important;color:#26364d!important;font-size:11px!important;
    box-shadow:none!important;
}
.student-create-page .field input:hover,.student-create-page .field select:hover{border-color:#b9c9df!important}
.student-create-page .field input:focus,.student-create-page .field select:focus{
    border-color:#4775ca!important;box-shadow:0 0 0 3px rgba(49,95,196,.09)!important;
}
.student-create-page .field small{font-size:10px!important;color:#8793a5!important;line-height:1.5}
.student-create-page .field input[type=file]{min-height:41px!important;padding:7px 9px!important;background:#fafbfd!important;border:1px dashed #cfd9e8!important}
.student-create-page .field input[type=file]::file-selector-button{border:0;border-radius:5px;padding:6px 9px;margin-right:8px;background:#edf2fb;color:#31558f;font-size:10px;font-weight:650;cursor:pointer}
.student-create-page .form-actions{
    display:flex;align-items:center;justify-content:space-between;gap:12px;
    margin:0!important;padding:17px 0 20px!important;border-top:1px solid #edf1f6!important;
}
.student-create-page .form-actions button{
    padding:10px 17px!important;border:0!important;border-radius:7px!important;
    background:#2454a5!important;color:#fff!important;font-size:11px!important;
    font-weight:700!important;box-shadow:none!important;
}
.student-create-page .form-actions button:hover{background:#1b4389!important;transform:none!important}
.student-create-page .form-actions a{padding:10px 15px!important;border:1px solid #dce3ed!important;border-radius:7px!important;background:#fff!important;font-size:11px!important}
@media(max-width:700px){
    .student-create-head{align-items:flex-start;flex-direction:column;padding-bottom:14px!important}
    .student-account-note{display:block}
    .student-account-note strong{display:block;margin-bottom:3px}
    .student-create-page .student-form{padding:0 16px}
    .student-create-page .form-section{padding:19px 0!important}
    .student-create-page .fields{grid-template-columns:1fr;gap:14px!important}
}
@media(max-width:480px){
    .student-create-head h1{font-size:20px!important}
    .student-create-page .student-form{padding:0 13px}
    .student-create-page .form-actions{align-items:stretch;flex-direction:column}
    .student-create-page .form-actions>div{width:100%}
    .student-create-page .form-actions>div a,.student-create-page .form-actions>div button{flex:1;text-align:center}
}


/* Aksen biru pada dropdown dan input tanggal, mengikuti halaman pendaftaran */
.student-create-page .field select{
    appearance:none!important;-webkit-appearance:none!important;
    padding-right:38px!important;
    background-color:#f4f8ff!important;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E")!important;
    background-repeat:no-repeat!important;background-position:right 13px center!important;background-size:15px!important;
    border-color:#cbdcf7!important;
}
.student-create-page .field select:focus{background-color:#fff!important;border-color:#2563eb!important}
.student-create-page .field select option{background:#fff;color:#1e3a8a}
.student-create-page .field input[type=date]{
    color-scheme:light;background:#f4f8ff!important;border-color:#cbdcf7!important;
    accent-color:#2563eb;cursor:pointer;
}
.student-create-page .field input[type=date]::-webkit-calendar-picker-indicator{
    opacity:1;cursor:pointer;filter:invert(29%) sepia(89%) saturate(1715%) hue-rotate(205deg) brightness(92%) contrast(94%);
}
.profile-photo-control{display:flex;align-items:center;gap:14px;padding:12px;border:1px solid #dce7f8;border-radius:9px;background:#f7faff}
.profile-photo-preview{width:76px;height:76px;flex:0 0 76px;display:grid;place-items:center;overflow:hidden;border-radius:50%;border:2px solid #c9dcff;background:#eaf2ff;color:#4775b9;font-size:10px;font-weight:800}
.profile-photo-preview img{width:100%;height:100%;object-fit:cover}
.profile-photo-upload{min-width:0;display:flex;flex-direction:column;align-items:flex-start;gap:7px}
.student-create-page .profile-photo-upload input[type=file]{width:100%;min-height:unset!important;padding:6px 8px!important;background:#fff!important;border:1px dashed #b9cdef!important;border-radius:7px}
.student-create-page .profile-photo-upload input[type=file]::file-selector-button{background:#e7f0ff!important;color:#1d4ed8!important}
.photo-crop-button{border:1px solid #b9d1fb;background:#eaf2ff;color:#1d4ed8;border-radius:7px;padding:7px 11px;font-size:10px;font-weight:700;cursor:pointer}
.photo-crop-button:disabled{opacity:.45;cursor:not-allowed}
.photo-crop-button:not(:disabled):hover{background:#dbeafe}
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
@media(max-width:480px){.profile-photo-control{align-items:flex-start}.profile-photo-preview{width:64px;height:64px;flex-basis:64px}.photo-crop-dialog{padding:15px}}

</style>
@endpush

@section('content')
<div class="student-create-head">
    <div><h1>Tambah Siswa</h1><p class="admin-intro" style="margin-bottom:0">Buat data dan akun siswa baru langsung dari panel admin.</p></div>
    <a href="{{ route('admin.siswa.index') }}" style="padding:10px 13px;border:1px solid #d7deea;background:#fff;border-radius:9px;font-size:12px;color:#475569">← Kembali ke Data Siswa</a>
</div>
@if ($errors->any())
<div style="padding:14px 16px;background:#fff1f2;border:1px solid #fecdd3;color:#9f1239;border-radius:10px;margin-bottom:18px;font-size:13px">
    <strong>Periksa kembali data berikut:</strong>
    <ul style="margin:8px 0 0;padding-left:20px">@foreach ($errors->all() as $error)<li style="margin:3px 0">{{ $error }}</li>@endforeach</ul>
</div>
@endif
<div class="student-account-note">
    <strong>Akun langsung aktif</strong>
    <span>Setelah disimpan, siswa dapat login menggunakan email dan password yang dibuat di formulir ini. Beri tahu siswa password awalnya secara pribadi.</span>
</div>
<div class="student-create-page"><form class="student-form" method="POST" enctype="multipart/form-data" action="{{ route('admin.siswa.store') }}">
@csrf
<section class="form-section">
    <div class="section-heading"><div class="section-number">01</div><div><h2>Identitas Siswa</h2><p>Informasi dasar untuk mengenali siswa.</p></div></div>
    <div class="fields">
        <div class="field"><label for="nama_lengkap">Nama lengkap <span class="required">*</span></label><input id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap" required maxlength="255" autocomplete="name"></div>
        <div class="field"><label for="nisn">NISN <span class="required">*</span></label><input id="nisn" name="nisn" value="{{ old('nisn') }}" placeholder="Masukkan NISN" required maxlength="30" inputmode="numeric"></div>
        <div class="field"><label for="tempat_lahir">Tempat lahir <span class="required">*</span></label><input id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Contoh: Banyuwangi" required maxlength="100"></div>
        <div class="field"><label for="tanggal_lahir">Tanggal lahir <span class="required">*</span></label><input id="tanggal_lahir" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required max="{{ now()->format('Y-m-d') }}"></div>
        <div class="field"><label for="jenis_kelamin">Jenis kelamin <span class="required">*</span></label><select id="jenis_kelamin" name="jenis_kelamin" required><option value="">Pilih jenis kelamin</option><option value="Laki-laki" @selected(old('jenis_kelamin') === 'Laki-laki')>Laki-laki</option><option value="Perempuan" @selected(old('jenis_kelamin') === 'Perempuan')>Perempuan</option></select></div>
        <div class="field"><label for="no_telepon">Nomor telepon <span class="required">*</span></label><input id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="Contoh: 08xxxxxxxxxx" required maxlength="30" inputmode="tel"></div>
        <div class="field profile-photo-field">
            <label for="foto_profil">Foto profil</label>
            <div class="profile-photo-control">
                <div class="profile-photo-preview" id="profilePhotoPreview"><span>FOTO</span></div>
                <div class="profile-photo-upload">
                    <input id="foto_profil" type="file" name="foto_profil" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                    <small id="profilePhotoName">Belum ada foto yang dipilih</small>
                    <small>Format JPG, PNG, atau WEBP. Maksimal 2 MB.</small>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="form-section">
    <div class="section-heading"><div class="section-number">02</div><div><h2>Akun untuk Login</h2><p>Email dan password yang akan digunakan siswa saat masuk.</p></div></div>
    <div class="fields">
        <div class="field"><label for="email">Email aktif <span class="required">*</span></label><input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required maxlength="255" autocomplete="email"></div>
        <div class="field"><label for="password">Password awal <span class="required">*</span></label><input id="password" type="password" name="password" required minlength="8" autocomplete="new-password" placeholder="Minimal 8 karakter"><small>Password tidak ditampilkan kembali setelah data disimpan.</small></div>
        <div class="field"><label for="password_confirmation">Konfirmasi password <span class="required">*</span></label><input id="password_confirmation" type="password" name="password_confirmation" required minlength="8" autocomplete="new-password" placeholder="Ulangi password yang sama"></div>
    </div>
</section>
<section class="form-section">
    <div class="section-heading"><div class="section-number">03</div><div><h2>Data Sekolah</h2><p>Tentukan sekolah, kelas, jurusan, dan guru pembimbing.</p></div></div>
    <div class="fields">
        <div class="field"><label for="sekolah_id">Sekolah <span class="required">*</span></label><select id="sekolah_id" name="sekolah_id" required><option value="">Pilih sekolah</option>@foreach($sekolahs as $row)<option value="{{ $row->id }}" @selected((string)old('sekolah_id') === (string)$row->id)>{{ $row->nama_sekolah }}</option>@endforeach</select></div>
        <div class="field"><label for="kelas_id">Kelas <span class="required">*</span></label><select id="kelas_id" name="kelas_id" required><option value="">Pilih kelas</option>@foreach($kelases as $row)<option value="{{ $row->id }}" @selected((string)old('kelas_id') === (string)$row->id)>Kelas {{ $row->nama_kelas }}</option>@endforeach</select></div>
        <div class="field"><label for="jurusan_id">Jurusan <span class="required">*</span></label><select id="jurusan_id" name="jurusan_id" required><option value="">Pilih jurusan</option>@foreach($jurusans as $row)<option value="{{ $row->id }}" @selected((string)old('jurusan_id') === (string)$row->id)>{{ $row->nama_jurusan }}</option>@endforeach</select></div>
        <div class="field"><label for="guru_id">Guru pembimbing</label><select id="guru_id" name="guru_id" disabled><option value="">Pilih sekolah terlebih dahulu</option></select><small>Daftar guru akan menyesuaikan dengan sekolah yang dipilih. Penentuan guru bersifat opsional.</small></div>
    </div>
</section>
<section class="form-section">
    <div class="section-heading"><div class="section-number">04</div><div><h2>Periode PKL</h2><p>Jadwal pelaksanaan praktik kerja lapangan.</p></div></div>
    <div class="fields">
        <div class="field"><label for="tanggal_mulai_pkl">Tanggal mulai PKL</label><input id="tanggal_mulai_pkl" type="date" name="tanggal_mulai_pkl" value="{{ old('tanggal_mulai_pkl') }}"></div>
        <div class="field"><label for="tanggal_selesai_pkl">Tanggal selesai PKL</label><input id="tanggal_selesai_pkl" type="date" name="tanggal_selesai_pkl" value="{{ old('tanggal_selesai_pkl') }}"><small>Tanggal selesai tidak boleh lebih awal dari tanggal mulai.</small></div>
    </div>
</section>
<div class="form-actions" style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;padding:8px 0 24px">
    <span style="font-size:11px;color:#64748b"><span class="required">*</span> Wajib diisi</span>
    <div style="display:flex;gap:10px;flex-wrap:wrap"><a href="{{ route('admin.siswa.index') }}" style="padding:12px 16px;border:1px solid #d7deea;background:#fff;border-radius:9px;font-size:13px;color:#475569">Batal</a><button type="submit" style="padding:12px 18px;border:0;background:#17357f;color:#fff;border-radius:9px;font-size:13px;font-weight:650;cursor:pointer">Simpan Siswa →</button></div>
</div>
</form></div>

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
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sekolahSelect = document.getElementById('sekolah_id');
    const guruSelect = document.getElementById('guru_id');
    const endpoint = @json(route('admin.siswa.guru-by-sekolah'));
    const guruLama = @json(old('guru_id'));

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

    muatGuru(sekolahSelect.value, guruLama);
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const photoInput = document.getElementById('foto_profil');
    const previewWrap = document.getElementById('profilePhotoPreview');
    const photoName = document.getElementById('profilePhotoName');
    const modal = document.getElementById('profileCropModal');
    const cropImage = document.getElementById('profileCropImage');
    const applyButton = document.getElementById('applyCrop');
    const cancelButton = document.getElementById('cancelCrop');
    const closeButton = document.getElementById('cancelCropTop');
    if (!photoInput || !previewWrap || !modal) return;

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
            photoName.textContent = 'Belum ada foto yang dipilih';
            previewWrap.innerHTML = '<span>FOTO</span>';
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
            previewWrap.innerHTML = '';
            const imagePreview = document.createElement('img');
            imagePreview.src = previewUrl;
            imagePreview.alt = 'Pratinjau foto profil';
            previewWrap.appendChild(imagePreview);
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
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('foto_profil');
    const preview = document.getElementById('profilePhotoPreview');
    const openButton = document.getElementById('openPhotoCrop');
    if (!input || !preview || !openButton) return;

    let sourceImage = null;
    let zoom = 1;
    let offsetX = 0;
    let offsetY = 0;
    let dragging = false;
    let lastX = 0;
    let lastY = 0;

    const overlay = document.createElement('div');
    overlay.className = 'photo-crop-overlay';
    overlay.innerHTML = `
        <div class="photo-crop-dialog" role="dialog" aria-modal="true" aria-labelledby="photoCropTitle">
            <h3 id="photoCropTitle">Atur Foto Profil</h3>
            <p>Geser foto untuk mengatur posisi, lalu gunakan zoom agar hasil crop terlihat pas.</p>
            <div class="photo-crop-canvas-wrap"><canvas class="photo-crop-canvas" width="640" height="640"></canvas></div>
            <label class="photo-crop-zoom">Zoom <input type="range" min="1" max="3" step="0.01" value="1" id="photoCropZoom"></label>
            <div class="photo-crop-actions">
                <button type="button" class="photo-crop-cancel">Batal</button>
                <button type="button" class="photo-crop-apply">Gunakan Foto</button>
            </div>
        </div>`;
    document.body.appendChild(overlay);
    const canvas = overlay.querySelector('canvas');
    const ctx = canvas.getContext('2d');
    const zoomInput = overlay.querySelector('#photoCropZoom');

    function drawCrop() {
        if (!sourceImage) return;
        const baseScale = Math.max(canvas.width / sourceImage.naturalWidth, canvas.height / sourceImage.naturalHeight);
        const scale = baseScale * zoom;
        const width = sourceImage.naturalWidth * scale;
        const height = sourceImage.naturalHeight * scale;
        const x = (canvas.width - width) / 2 + offsetX;
        const y = (canvas.height - height) / 2 + offsetY;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = '#eaf2ff';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(sourceImage, x, y, width, height);
    }

    function closeCrop() {
        overlay.classList.remove('active');
        dragging = false;
    }

    input.addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (!file) {
            openButton.disabled = true;
            preview.innerHTML = '<span>FOTO</span>';
            sourceImage = null;
            return;
        }
        if (!/^image\/(jpeg|png|webp)$/.test(file.type)) {
            alert('Pilih foto berformat JPG, PNG, atau WEBP.');
            this.value = '';
            openButton.disabled = true;
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran foto maksimal 2 MB.');
            this.value = '';
            openButton.disabled = true;
            return;
        }
        const reader = new FileReader();
        reader.onload = function (event) {
            const image = new Image();
            image.onload = function () {
                sourceImage = image;
                zoom = 1; offsetX = 0; offsetY = 0;
                zoomInput.value = '1';
                drawCrop();
                overlay.classList.add('active');
                openButton.disabled = false;
            };
            image.src = event.target.result;
        };
        reader.readAsDataURL(file);
    });

    openButton.addEventListener('click', function () {
        if (!sourceImage) return;
        drawCrop();
        overlay.classList.add('active');
    });
    zoomInput.addEventListener('input', function () {
        zoom = Number(this.value);
        drawCrop();
    });

    canvas.addEventListener('pointerdown', function (event) {
        dragging = true;
        lastX = event.clientX;
        lastY = event.clientY;
        canvas.setPointerCapture(event.pointerId);
    });
    canvas.addEventListener('pointermove', function (event) {
        if (!dragging) return;
        const rect = canvas.getBoundingClientRect();
        offsetX += (event.clientX - lastX) * (canvas.width / rect.width);
        offsetY += (event.clientY - lastY) * (canvas.height / rect.height);
        lastX = event.clientX;
        lastY = event.clientY;
        drawCrop();
    });
    canvas.addEventListener('pointerup', function () { dragging = false; });
    canvas.addEventListener('pointercancel', function () { dragging = false; });
    overlay.querySelector('.photo-crop-cancel').addEventListener('click', closeCrop);
    overlay.addEventListener('click', function (event) {
        if (event.target === overlay) closeCrop();
    });
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') closeCrop();
    });

    overlay.querySelector('.photo-crop-apply').addEventListener('click', function () {
        if (!sourceImage) return;
        canvas.toBlob(function (blob) {
            if (!blob) {
                alert('Foto gagal diproses. Silakan coba lagi.');
                return;
            }
            const croppedFile = new File([blob], 'foto-profil.jpg', { type: 'image/jpeg', lastModified: Date.now() });
            const transfer = new DataTransfer();
            transfer.items.add(croppedFile);
            input.files = transfer.files;
            preview.innerHTML = '';
            const image = document.createElement('img');
            image.src = URL.createObjectURL(blob);
            image.alt = 'Pratinjau foto profil';
            preview.appendChild(image);
            closeCrop();
        }, 'image/jpeg', 0.92);
    });
});
</script>

@endpush

@endsection
