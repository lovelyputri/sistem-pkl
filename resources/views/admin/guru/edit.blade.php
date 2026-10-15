@extends('layouts.admin')
@section('title','Edit Guru Pembimbing')
@section('page-heading','Edit Guru Pembimbing')
@push('styles')
<style>
.gf-card{background:#fff;border:1px solid #e5eaf2;border-radius:14px;padding:24px;max-width:850px}.gf-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}.gf-field label{display:block;font-size:12px;font-weight:650;color:#334155;margin-bottom:8px}.gf-field input,.gf-field select{width:100%;padding:12px;border:1px solid #d7deea;border-radius:9px;font:inherit;font-size:13px}.gf-field small{display:block;color:#64748b;font-size:11px;margin-top:6px}@media(max-width:620px){.gf-grid{grid-template-columns:1fr}.gf-card{padding:16px}}
</style>
@endpush
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:22px"><div><h1>Edit Guru Pembimbing</h1><p class="admin-intro" style="margin-bottom:0">Perbarui identitas, email akun, atau sekolah guru.</p></div><a href="{{ route('admin.guru.show',$guru) }}" style="padding:10px 13px;border:1px solid #d7deea;border-radius:9px;background:#fff;font-size:12px">← Kembali ke Profil</a></div>
@if($errors->any())<div style="padding:14px;background:#fff1f2;color:#9f1239;border-radius:9px;margin-bottom:16px;font-size:13px"><strong>Periksa data berikut:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<form method="POST" action="{{ route('admin.guru.update',$guru) }}" class="gf-card">@csrf @method('PUT')
<div class="gf-grid">
<div class="gf-field"><label for="nama_lengkap">Nama lengkap *</label><input id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap',$guru->nama_lengkap) }}" required maxlength="255"></div>
<div class="gf-field"><label for="nip">NIP</label><input id="nip" name="nip" value="{{ old('nip',$guru->nip) }}" maxlength="50"></div>
<div class="gf-field"><label for="no_telepon">Nomor telepon</label><input id="no_telepon" name="no_telepon" value="{{ old('no_telepon',$guru->no_telepon) }}" maxlength="30"></div>
<div class="gf-field"><label for="email">Email akun *</label><input id="email" type="email" name="email" value="{{ old('email',$guru->user?->email) }}" required><small>Email baru digunakan untuk login berikutnya.</small></div>
<div class="gf-field"><label for="sekolah_id">Sekolah *</label><select id="sekolah_id" name="sekolah_id" required>@foreach($sekolahs as $sekolah)<option value="{{ $sekolah->id }}" @selected((string)old('sekolah_id',$guru->sekolah_id)===(string)$sekolah->id)>{{ $sekolah->nama_sekolah }}</option>@endforeach</select><small>Jika sekolah diganti, penugasan siswa lama akan dilepas agar tidak tercampur antar sekolah.</small></div>
</div>
<div style="display:flex;justify-content:flex-end;gap:10px;margin-top:24px;flex-wrap:wrap"><a href="{{ route('admin.guru.show',$guru) }}" style="padding:12px 15px;border:1px solid #d7deea;border-radius:9px;font-size:12px">Batal</a><button type="submit" style="padding:12px 17px;background:#17357f;color:#fff;border:0;border-radius:9px;font-size:12px;font-weight:650;cursor:pointer">Simpan Perubahan</button></div>
</form>
@endsection