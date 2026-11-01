@extends('layouts.admin')
@section('title','Tambah Guru Pembimbing')
@section('page-heading','Tambah Guru Pembimbing')
@push('styles')
<style>
.gf-card{background:#fff;border:1px solid #e5eaf2;border-radius:14px;padding:24px;max-width:850px}.gf-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}.gf-field label{display:block;font-size:12px;font-weight:650;color:#334155;margin-bottom:8px}.gf-field input,.gf-field select{width:100%;padding:12px;border:1px solid #d7deea;border-radius:9px;font:inherit;font-size:13px}.gf-field small{display:block;color:#64748b;font-size:11px;margin-top:6px}.gf-head{margin-bottom:22px}.gf-head h2{margin:0 0 6px;font-size:16px}.gf-head p{margin:0;color:#64748b;font-size:12px}.gf-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:24px;flex-wrap:wrap}@media(max-width:620px){.gf-grid{grid-template-columns:1fr}.gf-card{padding:16px}}
</style>
@endpush
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:22px"><div><h1>Tambah Guru Pembimbing</h1><p class="admin-intro" style="margin-bottom:0">Buat akun guru dan tentukan sekolah tempat guru membimbing siswa.</p></div><a href="{{ route('admin.guru.index') }}" style="padding:10px 13px;border:1px solid #d7deea;border-radius:9px;background:#fff;font-size:12px">← Kembali</a></div>
@if($errors->any())<div style="padding:14px;background:#fff1f2;color:#9f1239;border-radius:9px;margin-bottom:16px;font-size:13px"><strong>Periksa data berikut:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<form method="POST" enctype="multipart/form-data" action="{{ route('admin.guru.store') }}" class="gf-card">@csrf
<div class="gf-head"><h2>Informasi Guru</h2><p>Isi identitas dan akun login guru pembimbing.</p></div>
<div class="gf-grid">
<div class="gf-field"><label for="nama_lengkap">Nama lengkap *</label><input id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required maxlength="255" placeholder="Nama lengkap guru"></div>
<div class="gf-field"><label for="nip">NIP</label><input id="nip" name="nip" value="{{ old('nip') }}" maxlength="50" placeholder="Nomor induk pegawai (opsional)"></div>
<div class="gf-field"><label for="no_telepon">Nomor telepon</label><input id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" maxlength="30" placeholder="08xxxxxxxxxx"></div>
<div class="gf-field"><label for="foto_profil">Foto profil</label><input id="foto_profil" type="file" name="foto_profil" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"><small>Opsional. JPG, JPEG, PNG, atau WEBP, maksimal 2 MB.</small></div>
<div class="gf-field"><label for="sekolah_id">Sekolah *</label><select id="sekolah_id" name="sekolah_id" required><option value="">Pilih sekolah</option>@foreach($sekolahs as $sekolah)<option value="{{ $sekolah->id }}" @selected((string)old('sekolah_id')===(string)$sekolah->id)>{{ $sekolah->nama_sekolah }}</option>@endforeach</select><small>Guru hanya dapat diberi penugasan siswa dari sekolah ini.</small></div>
<div class="gf-field"><label for="email">Email akun *</label><input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="guru@email.com"></div>
<div class="gf-field"><label for="password">Password awal *</label><input id="password" type="password" name="password" required minlength="8" autocomplete="new-password" placeholder="Minimal 8 karakter"></div>
<div class="gf-field"><label for="password_confirmation">Konfirmasi password *</label><input id="password_confirmation" type="password" name="password_confirmation" required minlength="8" autocomplete="new-password" placeholder="Ulangi password"></div>
</div>
<div class="gf-actions"><a href="{{ route('admin.guru.index') }}" style="padding:12px 15px;border:1px solid #d7deea;border-radius:9px;font-size:12px">Batal</a><button type="submit" style="padding:12px 17px;background:#17357f;color:#fff;border:0;border-radius:9px;font-size:12px;font-weight:650;cursor:pointer">Simpan Guru</button></div>
</form>
@endsection