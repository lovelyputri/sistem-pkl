@extends('layouts.admin')

@section('title', 'Profil Siswa')
@section('page-heading', 'Profil Siswa')

@push('styles')
<style>
.profile-head{background:linear-gradient(120deg,#17357f,#315fc4);border-radius:16px;padding:26px;color:#fff;display:flex;align-items:center;gap:18px;justify-content:space-between;flex-wrap:wrap}
.profile-avatar{width:76px;height:76px;border-radius:50%;background:rgba(255,255,255,.16);border:2px solid rgba(255,255,255,.35);display:flex;align-items:center;justify-content:center;font-size:28px;font-weight:700}
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
</style>
@endpush

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:20px">
    <div><h1>Profil Siswa</h1><p class="admin-intro" style="margin-bottom:0">Ringkasan identitas, akun, sekolah, dan periode PKL.</p></div>
    <a href="{{ route('admin.siswa.index') }}" style="padding:10px 13px;border:1px solid #d7deea;background:#fff;border-radius:9px;font-size:12px;color:#475569">← Data Siswa</a>
</div>
@if (session('success'))<div style="padding:13px 15px;background:#ecfdf5;border:1px solid #bbf7d0;color:#166534;border-radius:10px;margin-bottom:16px;font-size:13px">{{ session('success') }}</div>@endif
<div class="profile-head">
    <div style="display:flex;align-items:center;gap:18px;min-width:0">
        <div class="profile-avatar">{{ mb_strtoupper(mb_substr($siswa->nama_lengkap, 0, 1)) }}</div>
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
    <h2>Periode Praktik Kerja Lapangan</h2>
    <div class="profile-grid">
        <div class="profile-item"><label>Tanggal mulai PKL</label><div>{{ $siswa->tanggal_mulai_pkl?->format('d F Y') ?? 'Belum ditentukan' }}</div></div>
        <div class="profile-item"><label>Tanggal selesai PKL</label><div>{{ $siswa->tanggal_selesai_pkl?->format('d F Y') ?? 'Belum ditentukan' }}</div></div>
        <div class="profile-item"><label>Data dibuat</label><div>{{ $siswa->created_at?->format('d F Y') ?? '-' }}</div></div>
    </div>
</div>
@endsection
