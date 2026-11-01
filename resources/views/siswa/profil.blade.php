@extends('layouts.siswa')
@section('title','Profil Saya')
@section('page-heading','Profil Saya')
@section('content')
<h1>Profil Saya</h1><p class="siswa-intro">Perbarui informasi akun dan data kontak. Data sekolah serta periode PKL dikelola melalui admin.</p>
<div class="siswa-panel"><form method="POST" action="{{ route('siswa.profil.update') }}" enctype="multipart/form-data" class="siswa-form">@csrf @method('PUT')
<div style="display:flex;align-items:center;gap:16px;margin-bottom:10px">
@if($siswa->foto_profil)<img src="{{ asset('storage/'.$siswa->foto_profil) }}" alt="Foto profil" style="width:76px;height:76px;border-radius:50%;object-fit:cover">@else<div style="width:76px;height:76px;border-radius:50%;display:grid;place-items:center;background:#eef2ff;color:#17357f;font-size:25px;font-weight:800">{{ mb_strtoupper(mb_substr($siswa->nama_lengkap,0,1)) }}</div>@endif
<div><strong>{{ $siswa->nama_lengkap }}</strong><p class="siswa-muted" style="margin:5px 0 0">NISN {{ $siswa->nisn }}</p></div>
</div>
<div class="siswa-grid-2"><div class="siswa-field"><label for="nama_lengkap">Nama lengkap *</label><input id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap',$siswa->nama_lengkap) }}" required maxlength="255"></div><div class="siswa-field"><label for="email">Email akun *</label><input id="email" name="email" type="email" value="{{ old('email',$siswa->user->email) }}" required></div><div class="siswa-field"><label for="no_telepon">Nomor telepon</label><input id="no_telepon" name="no_telepon" value="{{ old('no_telepon',$siswa->no_telepon) }}" maxlength="30"></div><div class="siswa-field"><label for="foto_profil">Foto profil</label><input id="foto_profil" name="foto_profil" type="file" accept=".jpg,.jpeg,.png,.webp"><small>JPG, PNG, WEBP maksimal 2 MB.</small></div></div>
<div class="siswa-field"><label for="alamat">Alamat</label><textarea id="alamat" name="alamat" maxlength="1000">{{ old('alamat',$siswa->alamat) }}</textarea></div>
<div class="siswa-actions"><button class="siswa-btn">Simpan Perubahan</button></div>
</form></div>
<div class="siswa-panel"><h2>Informasi Pendidikan dan PKL</h2><div class="siswa-grid-2"><div><div class="siswa-muted">Sekolah</div><strong>{{ $siswa->sekolah?->nama_sekolah ?? '-' }}</strong></div><div><div class="siswa-muted">Jurusan / Kelas</div><strong>{{ $siswa->jurusan?->nama_jurusan ?? '-' }} / {{ $siswa->kelas?->nama_kelas ?? '-' }}</strong></div><div><div class="siswa-muted">Guru Pembimbing</div><strong>{{ $siswa->guru?->nama_lengkap ?? 'Belum ditentukan' }}</strong></div><div><div class="siswa-muted">Periode PKL</div><strong>{{ $siswa->tanggal_mulai_pkl?->format('d M Y') ?? '-' }} — {{ $siswa->tanggal_selesai_pkl?->format('d M Y') ?? '-' }}</strong></div></div></div>

<div class="siswa-panel"><h2>Ganti Password</h2>
@if(session('password_success'))<div class="siswa-alert success">{{ session('password_success') }}</div>@endif
<form method="POST" action="{{ route('siswa.profil.password.update') }}" class="siswa-form">@csrf @method('PUT')
<div class="siswa-grid-2">
<div class="siswa-field"><label for="current_password">Password lama *</label><input id="current_password" name="current_password" type="password" autocomplete="current-password" required></div>
<div class="siswa-field"><label for="password">Password baru *</label><input id="password" name="password" type="password" minlength="8" autocomplete="new-password" required></div>
<div class="siswa-field"><label for="password_confirmation">Konfirmasi password baru *</label><input id="password_confirmation" name="password_confirmation" type="password" minlength="8" autocomplete="new-password" required></div>
</div><div class="siswa-actions"><button class="siswa-btn">Perbarui Password</button></div>
</form></div>
@endsection
