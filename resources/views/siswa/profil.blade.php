@extends('layouts.siswa')
@section('title','Profil Saya')
@section('page-heading','Profil Saya')
@section('content')
<h1>Profil Saya</h1><p class="s-intro">Perbarui data pribadi dan email akun. Data sekolah dan penugasan PKL dikelola oleh administrator.</p>
<div class="s-panel" style="margin-top:0"><form method="POST" action="{{ route('siswa.profil.update') }}" class="s-form">@csrf @method('PUT')
<div class="s-field"><label for="nama_lengkap">Nama lengkap *</label><input id="nama_lengkap" name="nama_lengkap" required maxlength="255" value="{{ old('nama_lengkap',$siswa->nama_lengkap) }}"></div>
<div class="s-field"><label for="email">Email akun *</label><input id="email" type="email" name="email" required maxlength="255" value="{{ old('email',$siswa->user->email) }}"></div>
<div class="s-field"><label for="tempat_lahir">Tempat lahir</label><input id="tempat_lahir" name="tempat_lahir" maxlength="100" value="{{ old('tempat_lahir',$siswa->tempat_lahir) }}"></div>
<div class="s-field"><label for="tanggal_lahir">Tanggal lahir</label><input id="tanggal_lahir" type="date" name="tanggal_lahir" max="{{ today()->subDay()->toDateString() }}" value="{{ old('tanggal_lahir',$siswa->tanggal_lahir?->toDateString()) }}"></div>
<div class="s-field"><label for="jenis_kelamin">Jenis kelamin</label><select id="jenis_kelamin" name="jenis_kelamin"><option value="">Pilih jenis kelamin</option><option value="Laki-laki" @selected(old('jenis_kelamin',$siswa->jenis_kelamin)==='Laki-laki')>Laki-laki</option><option value="Perempuan" @selected(old('jenis_kelamin',$siswa->jenis_kelamin)==='Perempuan')>Perempuan</option></select></div>
<div class="s-field"><label for="no_telepon">Nomor telepon</label><input id="no_telepon" name="no_telepon" maxlength="25" value="{{ old('no_telepon',$siswa->no_telepon) }}"></div>
<div class="s-field"><label for="password">Password baru</label><input id="password" type="password" name="password" minlength="8" autocomplete="new-password" placeholder="Kosongkan jika tidak diubah"></div>
<div class="s-field"><label for="password_confirmation">Konfirmasi password baru</label><input id="password_confirmation" type="password" name="password_confirmation" minlength="8" autocomplete="new-password"></div>
<div class="s-full s-actions"><button class="s-btn" type="submit">Simpan Profil</button></div>
</form></div>
<div class="s-panel"><h2>Data Sekolah dan PKL</h2><div class="s-info-grid">
<div class="s-info"><span>NISN</span><strong>{{ $siswa->nisn }}</strong></div><div class="s-info"><span>Sekolah</span><strong>{{ $siswa->sekolah?->nama_sekolah ?? $siswa->sekolah?->nama ?? '-' }}</strong></div>
<div class="s-info"><span>Jurusan</span><strong>{{ $siswa->jurusan?->nama_jurusan ?? $siswa->jurusan?->nama ?? '-' }}</strong></div><div class="s-info"><span>Kelas</span><strong>{{ $siswa->kelas?->nama_kelas ?? $siswa->kelas?->nama ?? '-' }}</strong></div>
<div class="s-info"><span>Guru pembimbing</span><strong>{{ $siswa->guru?->nama_lengkap ?? $siswa->guru?->nama ?? $siswa->guru?->user?->email ?? 'Belum ditugaskan' }}</strong></div>
<div class="s-info"><span>Periode PKL</span><strong>{{ $siswa->tanggal_mulai_pkl?->format('d M Y') ?? '-' }} – {{ $siswa->tanggal_selesai_pkl?->format('d M Y') ?? '-' }}</strong></div>
</div></div>
@endsection
