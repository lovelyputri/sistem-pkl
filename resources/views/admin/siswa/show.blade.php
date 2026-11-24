@extends('layouts.admin')

@section('title', 'Profil Siswa')
@section('page-heading', 'Profil Siswa')

@push('styles')
<style>
/* Samakan lebar dan jarak area konten dengan Dashboard serta Data Siswa */
.admin-content:has(.student-profile-page){width:100%;max-width:none;margin:0;padding:22px 24px 30px}
@media(max-width:820px){.admin-content:has(.student-profile-page){padding:17px}}
@media(max-width:560px){.admin-content:has(.student-profile-page){padding:13px 11px 20px}}

.profile-head{background:linear-gradient(120deg,#17357f,#315fc4);border-radius:16px;padding:26px;color:#fff;display:flex;align-items:center;gap:18px;justify-content:space-between;flex-wrap:wrap}
.profile-avatar{width:96px;height:96px;flex:0 0 96px;border-radius:50%;background:rgba(255,255,255,.16);border:2px solid rgba(255,255,255,.45);display:flex;align-items:center;justify-content:center;font-size:28px;font-weight:700;object-fit:cover}
.profile-head h1{font-size:22px;margin:0 0 7px}
.profile-head p{margin:0;color:#dbe7ff;font-size:12px}
.profile-actions{display:flex;gap:9px;flex-wrap:wrap}
.profile-btn{display:inline-flex;padding:10px 13px;border-radius:8px;font-size:12px;font-weight:600}
.profile-panel{background:#fff;border:1px solid #e5eaf2;border-radius:13px;padding:22px;margin-top:18px}
.profile-panel h2{font-size:14px;margin:0 0 18px;color:#172033}
.profile-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:20px}
.profile-item label{display:block;font-size:11px;color:#94a3b8;margin-bottom:7px}
.profile-item div{font-size:13px;font-weight:600;color:#243047;overflow-wrap:anywhere}
@media(max-width:720px){.profile-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.profile-panel{padding:16px}}
@media(max-width:440px){.profile-grid{grid-template-columns:1fr}}

.student-profile-page{color:#172033}
.student-profile-heading{display:flex;justify-content:space-between;align-items:center;gap:14px;flex-wrap:wrap;margin-bottom:18px}
.student-profile-heading h1{font-size:22px;font-weight:750;letter-spacing:-.4px;color:#1d2d49;margin:0 0 5px}
.student-profile-heading p{font-size:12px;color:#8794a8}
.student-profile-heading>a{padding:10px 14px!important;border:1px solid #dce4ef!important;background:#fff!important;border-radius:10px!important;color:#425574!important}
.student-profile-page .profile-head{position:relative;overflow:hidden;padding:27px 28px;border-radius:18px;background:linear-gradient(115deg,#122b68 0%,#214b9d 62%,#3972ce 100%);box-shadow:0 10px 24px rgba(23,53,127,.12)}
.student-profile-page .profile-head:after{content:"";position:absolute;width:250px;height:250px;border:1px solid rgba(255,255,255,.13);border-radius:50%;right:8%;top:-165px;box-shadow:0 0 0 30px rgba(255,255,255,.035),0 0 0 62px rgba(255,255,255,.025);pointer-events:none}
.student-profile-page .profile-head>div,.student-profile-page .profile-head form{position:relative;z-index:1}
.student-profile-page .profile-avatar{width:88px;height:88px;flex-basis:88px;border:3px solid rgba(255,255,255,.5);box-shadow:0 5px 16px rgba(0,0,0,.12)}
.student-profile-page .profile-head h1{font-size:23px;font-weight:750;letter-spacing:-.4px}
.student-profile-page .profile-head p{font-size:12px}
.student-profile-page .profile-btn{padding:10px 14px;border-radius:9px;font-size:11px;font-weight:700}
.student-profile-page .profile-panel{padding:23px 24px;margin-top:15px;border:1px solid #e5eaf2;border-radius:16px;box-shadow:0 5px 18px rgba(24,48,91,.035)}
.student-profile-page .profile-panel h2{display:flex;align-items:center;gap:9px;font-size:14px;font-weight:750;color:#1d2d49;margin-bottom:19px}
.student-profile-page .profile-panel h2:before{content:"";width:4px;height:17px;border-radius:5px;background:#3972ce}
.student-profile-page .profile-grid{gap:20px 24px}
.student-profile-page .profile-item{padding:12px 13px;border:1px solid #edf1f7;border-radius:11px;background:#fbfcff;min-width:0}
.student-profile-page .profile-item label{font-size:10px;font-weight:600;color:#8996aa;margin-bottom:6px}
.student-profile-page .profile-item div{font-size:12px;font-weight:700;color:#2b3b55}
@media(max-width:720px){.student-profile-page .profile-head{padding:20px}.student-profile-page .profile-panel{padding:17px}.student-profile-page .profile-grid{gap:11px}}
@media(max-width:440px){.student-profile-page .profile-head{align-items:flex-start}.student-profile-page .profile-head>div:first-child{align-items:flex-start!important;gap:12px!important}.student-profile-page .profile-avatar{width:64px;height:64px;flex-basis:64px;font-size:21px}.student-profile-page .profile-head h1{font-size:18px}.student-profile-page .profile-actions{width:100%}.student-profile-page .profile-actions>*{flex:1}.student-profile-page .profile-actions .profile-btn{justify-content:center;width:100%}}


/* Penyempurnaan tampilan detail siswa */
.student-profile-heading{padding:3px 0 5px}
.student-profile-page .profile-head{min-height:154px}
.student-profile-page .profile-panel{transition:border-color .2s,box-shadow .2s}
.student-profile-page .profile-panel:hover{border-color:#d5e1f5;box-shadow:0 9px 24px rgba(24,48,91,.06)}
.student-profile-page .profile-item{transition:background .18s,border-color .18s}
.student-profile-page .profile-item:hover{background:#f4f7ff;border-color:#dce6f7}
.student-profile-page .profile-actions form{margin:0}
.student-profile-page .profile-actions button{font:inherit}
@media(max-width:600px){.student-profile-page .profile-head{min-height:unset}}


/* Redesign halaman profil: ringkasan kuat, detail terkelompok, tidak berupa kotak seragam */
.student-profile-heading{margin-bottom:20px}
.student-profile-heading h1{font-size:25px;letter-spacing:-.7px}
.student-profile-heading p{font-size:12px}
.student-profile-heading>a{padding:11px 16px!important;border-radius:10px!important;transition:.2s}
.student-profile-heading>a:hover{background:#edf3ff!important;border-color:#c8d8f4!important;color:#17357f!important}
.student-profile-page .profile-head{min-height:174px;padding:30px 32px;border-radius:18px;background:radial-gradient(circle at 82% 18%,rgba(129,177,255,.26),transparent 25%),linear-gradient(115deg,#10275f 0%,#1b438e 58%,#3974d2 100%);box-shadow:0 14px 30px rgba(23,53,127,.14)}
.student-profile-page .profile-avatar{width:100px;height:100px;flex-basis:100px;border-radius:22px;font-size:30px}
.student-profile-page .profile-head h1{font-size:25px;letter-spacing:-.7px}
.student-profile-page .profile-head p{color:#dce8ff}
.student-profile-page .profile-actions{gap:9px}
.student-profile-page .profile-btn{padding:11px 17px;border-radius:9px;transition:.2s}
.student-profile-page .profile-actions a:hover{transform:translateY(-2px);box-shadow:0 7px 16px rgba(0,0,0,.13)}
.student-profile-page .profile-actions button:hover{background:#bd3547!important;transform:translateY(-2px)}
.student-profile-page .profile-panel{position:relative;padding:22px 25px 25px;margin-top:17px;border-radius:15px;box-shadow:0 5px 16px rgba(27,53,95,.035)}
.student-profile-page .profile-panel h2{font-size:15px;margin-bottom:20px}
.student-profile-page .profile-panel h2:before{width:5px;height:21px;border-radius:5px}
.student-profile-page .profile-grid{gap:0 22px}
.student-profile-page .profile-item{padding:15px 4px;border:0;border-bottom:1px solid #edf1f7;border-radius:0;background:transparent}
.student-profile-page .profile-item:hover{background:transparent;border-color:#dce6f7}
.student-profile-page .profile-item label{font-size:10px;letter-spacing:.35px;text-transform:uppercase}
.student-profile-page .profile-item div{font-size:13px;line-height:1.55;color:#243957}
.student-profile-page .profile-panel:nth-of-type(3) h2:before{background:#168b9b}
.student-profile-page .profile-panel:nth-of-type(4) h2:before{background:#c18a36}
.student-profile-page .profile-panel>div[style*="padding:13px"]{border-left:4px solid #2e9b69;border-radius:9px!important;background:#f0faf5!important;color:#176b49!important}
@media(max-width:720px){.student-profile-page .profile-head{padding:22px}.student-profile-page .profile-panel{padding:18px}.student-profile-page .profile-grid{gap:0 14px}}
@media(max-width:440px){.student-profile-page .profile-head{padding:18px}.student-profile-page .profile-avatar{width:68px;height:68px;flex-basis:68px;border-radius:17px}.student-profile-page .profile-head h1{font-size:19px}.student-profile-page .profile-panel{padding:16px}.student-profile-page .profile-grid{grid-template-columns:1fr}}


/* Konsistensi layout CRUD siswa dengan dashboard admin */
.admin-content:has(.student-profile-page){width:100%;max-width:1200px;margin:0 auto;padding:28px}
.student-profile-heading{align-items:center;margin-bottom:22px}
.student-profile-page .profile-head{padding:28px 30px;border-radius:14px}
.student-profile-page .profile-panel{padding:24px;margin-top:17px;border-radius:13px;background:#fff;box-shadow:0 3px 12px rgba(24,48,91,.035)}
.student-profile-page .profile-grid{gap:14px}
.student-profile-page .profile-item{padding:14px 15px}
@media(max-width:760px){.admin-content:has(.student-profile-page){padding:20px 15px}.student-profile-page .profile-panel{padding:18px}}
@media(max-width:480px){.admin-content:has(.student-profile-page){padding:17px 11px}.student-profile-page .profile-head{padding:19px}.student-profile-page .profile-item{padding:12px}}


/* Samakan lebar dan padding halaman CRUD Siswa dengan Dashboard Admin. */
.admin-content:has(.student-profile-page){width:100%!important;max-width:none!important;margin:0!important;padding:22px 24px 30px!important}
@media(max-width:760px){.admin-content:has(.student-profile-page){padding:17px 15px!important}}
@media(max-width:560px){.admin-content:has(.student-profile-page){padding:13px 11px 20px!important}}
</style>
@endpush

@section('content')
<div class="student-profile-heading">
    <div><h1>Profil Siswa</h1><p class="admin-intro" style="margin-bottom:0">Ringkasan identitas, akun, sekolah, dan periode PKL.</p></div>
    <a href="{{ route('admin.siswa.index') }}" style="padding:10px 13px;border:1px solid #d7deea;background:#fff;border-radius:9px;font-size:12px;color:#475569">← Data Siswa</a>
</div>
@if (session('success'))<div style="padding:13px 15px;background:#ecfdf5;border:1px solid #bbf7d0;color:#166534;border-radius:10px;margin-bottom:16px;font-size:13px">{{ session('success') }}</div>@endif
<div class="student-profile-page"><div class="profile-head">
    <div style="display:flex;align-items:center;gap:18px;min-width:0">
        @if ($siswa->foto_profil)
            <img class="profile-avatar" src="{{ asset('storage/' . $siswa->foto_profil) }}" alt="Foto {{ $siswa->nama_lengkap }}" onerror="this.onerror=null;this.style.display='none';this.nextElementSibling.style.display='flex'">
            <div class="profile-avatar" style="display:none">{{ mb_strtoupper(mb_substr($siswa->nama_lengkap, 0, 1)) }}</div>
        @else
            <div class="profile-avatar">{{ mb_strtoupper(mb_substr($siswa->nama_lengkap, 0, 1)) }}</div>
        @endif
        <div><h1>{{ $siswa->nama_lengkap }}</h1><p>NISN {{ $siswa->nisn }} · {{ $siswa->kelas?->nama_kelas ? 'Kelas '.$siswa->kelas->nama_kelas : 'Kelas belum diatur' }}</p><div style="margin-top:11px"><span style="display:inline-block;padding:5px 9px;border-radius:20px;background:rgba(255,255,255,.16);font-size:11px">{{ $siswa->user?->status === 'approved' ? 'Akun Aktif' : ($siswa->user?->status === 'rejected' ? 'Pendaftaran Ditolak' : 'Menunggu Persetujuan') }}</span></div></div>
    </div>
    <div class="profile-actions">
        <a class="profile-btn" href="{{ route('admin.siswa.edit', $siswa) }}" style="background:#fff;color:#17357f">Edit Profil</a>
        <form method="POST" action="{{ route('admin.siswa.destroy', $siswa) }}" onsubmit="return confirm('Hapus data siswa ini? Akun siswa beserta jurnal dan absensi terkait dapat ikut terhapus. Tindakan ini tidak dapat dibatalkan.')">@csrf @method('DELETE')<button class="profile-btn" type="submit" style="background:#9f2535;color:#fff;border:0;cursor:pointer">Hapus</button></form>
    </div>
</div>
<div class="profile-panel">
    <h2>Informasi Pribadi</h2>
    <div class="profile-grid">
        <div class="profile-item"><label>Nama lengkap</label><div>{{ $siswa->nama_lengkap }}</div></div>
        <div class="profile-item"><label>NISN</label><div>{{ $siswa->nisn }}</div></div>
        <div class="profile-item"><label>Email akun</label><div>{{ $siswa->user?->email ?? '-' }}</div></div>
        <div class="profile-item"><label>Tempat lahir</label><div>{{ $siswa->tempat_lahir ?: '-' }}</div></div>
        <div class="profile-item"><label>Tanggal lahir</label><div>{{ $siswa->tanggal_lahir?->format('d F Y') ?? '-' }}</div></div>
        <div class="profile-item"><label>Jenis kelamin</label><div>{{ $siswa->jenis_kelamin ?? '-' }}</div></div>
        <div class="profile-item"><label>Nomor telepon</label><div>{{ $siswa->no_telepon ?? '-' }}</div></div>
    </div>
</div>
<div class="profile-panel">
    <h2>Informasi Pendidikan</h2>
    <div class="profile-grid">
        <div class="profile-item"><label>Asal sekolah</label><div>{{ $siswa->sekolah?->nama_sekolah ?? '-' }}</div></div>
        <div class="profile-item"><label>Jurusan</label><div>{{ $siswa->jurusan?->nama_jurusan ?? '-' }}</div></div>
        <div class="profile-item"><label>Kelas</label><div>{{ $siswa->kelas?->nama_kelas ?? '-' }}</div></div>
        <div class="profile-item"><label>Guru pembimbing</label><div>{{ $siswa->guru?->nama_lengkap ?? 'Belum ditentukan' }}</div></div>
    </div>
</div>
<div class="profile-panel">
    <h2>Status dan Periode Praktik Kerja Lapangan</h2>
    <div style="padding:13px 15px;border-radius:10px;background:{{ $siswa->status_magang === 'Alumni' ? '#f1f5f9' : '#ecfdf5' }};color:{{ $siswa->status_magang === 'Alumni' ? '#475569' : '#166534' }};font-size:13px;font-weight:700;margin-bottom:18px">
        Status Magang: {{ $siswa->status_magang }}
        <div style="font-size:11px;font-weight:400;margin-top:5px;color:inherit">{{ $siswa->status_magang === 'Alumni' ? 'Masa PKL telah berakhir berdasarkan tanggal selesai yang tercatat.' : 'Siswa masih dalam masa PKL atau tanggal selesai belum ditentukan.' }}</div>
    </div>
    <div class="profile-grid">
        <div class="profile-item"><label>Tanggal mulai PKL</label><div>{{ $siswa->tanggal_mulai_pkl?->format('d F Y') ?? 'Belum ditentukan' }}</div></div>
        <div class="profile-item"><label>Tanggal selesai PKL</label><div>{{ $siswa->tanggal_selesai_pkl?->format('d F Y') ?? 'Belum ditentukan' }}</div></div>
        <div class="profile-item"><label>Data dibuat</label><div>{{ $siswa->created_at?->format('d F Y') ?? '-' }}</div></div>
    </div>
</div>
@endsection
