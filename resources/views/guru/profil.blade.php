@extends('layouts.guru')
@section('title','Profil Guru')
@section('page-heading','Profil Saya')

@push('styles')
<style>
.profile-wrap{max-width:920px}
.profile-intro{color:#64748b;font-size:13px;margin:0 0 22px}
.profile-card{background:#fff;border:1px solid #e5eaf2;border-radius:16px;padding:24px;box-shadow:0 5px 18px rgba(15,23,42,.035)}
.profile-head{display:flex;align-items:center;gap:16px;padding-bottom:22px;margin-bottom:22px;border-bottom:1px solid #edf0f5}
.profile-avatar{width:76px;height:76px;border-radius:50%;object-fit:cover;background:#eef2ff;display:flex;align-items:center;justify-content:center;color:#29488e;font-size:25px;font-weight:700;flex-shrink:0}
.profile-head h2{font-size:18px;color:#172554;margin:0 0 5px}
.profile-head p{font-size:12px;color:#64748b;margin:0}
.profile-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}
.profile-field label{display:block;font-size:12px;font-weight:650;color:#334155;margin-bottom:8px}
.profile-field input{width:100%;box-sizing:border-box;padding:12px 13px;border:1px solid #d7deea;border-radius:9px;font:inherit;font-size:13px;color:#1e293b;background:#fff}
.profile-field input:focus{outline:none;border-color:#3156a5;box-shadow:0 0 0 3px rgba(49,86,165,.1)}
.profile-field small{display:block;color:#64748b;font-size:11px;margin-top:6px}
.profile-actions{display:flex;justify-content:flex-end;margin-top:24px}
.profile-save{border:0;border-radius:9px;background:#17357f;color:#fff;padding:12px 18px;font-size:12px;font-weight:650;cursor:pointer}
.profile-alert{padding:13px 15px;border-radius:9px;margin-bottom:16px;font-size:13px}
.profile-success{background:#ecfdf5;color:#166534}
.profile-error{background:#fff1f2;color:#9f1239}
.password-card{margin-top:22px}
.password-card h2{font-size:16px;color:#172554;margin:0 0 7px}
.password-card>p{font-size:12px;color:#64748b;margin:0 0 20px}
@media(max-width:640px){.profile-card{padding:17px}.profile-grid{grid-template-columns:1fr}.profile-head{align-items:flex-start}}
</style>
@endpush

@section('content')
<div class="profile-wrap">
    <h1>Profil Guru</h1>
    <p class="profile-intro">Kelola informasi pribadi dan akun yang digunakan untuk masuk ke GUSPELOR.NET.</p>

    @if(session('success'))
        <div class="profile-alert profile-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="profile-alert profile-error">
            <strong>Profil belum berhasil disimpan. Periksa kembali:</strong>
            <ul style="margin:8px 0 0;padding-left:20px">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('guru.profil.update') }}" enctype="multipart/form-data" class="profile-card">
        @csrf
        @method('PUT')

        <div class="profile-head">
            @if($guru->foto_profil)
                <img class="profile-avatar" src="{{ asset('storage/' . $guru->foto_profil) }}" alt="Foto profil {{ $guru->nama_lengkap }}">
            @else
                <div class="profile-avatar">{{ strtoupper(substr($guru->nama_lengkap, 0, 1)) }}</div>
            @endif
            <div>
                <h2>{{ $guru->nama_lengkap }}</h2>
                <p>Guru Pembimbing · {{ $guru->sekolah->nama_sekolah ?? 'Sekolah belum tersedia' }}</p>
            </div>
        </div>

        <div class="profile-grid">
            <div class="profile-field">
                <label for="nama_lengkap">Nama lengkap *</label>
                <input id="nama_lengkap" name="nama_lengkap" type="text" value="{{ old('nama_lengkap', $guru->nama_lengkap) }}" maxlength="255" required>
            </div>

            <div class="profile-field">
                <label for="email">Email akun *</label>
                <input id="email" name="email" type="email" value="{{ old('email', $guru->user->email ?? '') }}" maxlength="255" required>
                <small>Email ini digunakan untuk login berikutnya.</small>
            </div>

            <div class="profile-field">
                <label for="nip">NIP</label>
                <input id="nip" name="nip" type="text" value="{{ old('nip', $guru->nip) }}" maxlength="50">
            </div>

            <div class="profile-field">
                <label for="no_telepon">Nomor telepon</label>
                <input id="no_telepon" name="no_telepon" type="text" value="{{ old('no_telepon', $guru->no_telepon) }}" maxlength="30">
            </div>

            <div class="profile-field">
                <label for="foto_profil">Foto profil</label>
                <input id="foto_profil" name="foto_profil" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                <small>Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB. Kosongkan jika tidak ingin mengganti foto.</small>
            </div>

            <div class="profile-field">
                <label>Sekolah</label>
                <input type="text" value="{{ $guru->sekolah->nama_sekolah ?? '-' }}" disabled>
                <small>Perubahan sekolah tetap dilakukan oleh admin.</small>
            </div>
        </div>

        <div class="profile-actions">
            <button type="submit" class="profile-save">Simpan Perubahan</button>
        </div>
    </form>

    <form method="POST" action="{{ route('guru.profil.password.update') }}" class="profile-card password-card">
        @csrf
        @method('PUT')

        <h2>Ganti Password</h2>
        <p>Gunakan password lama untuk mengonfirmasi perubahan password akun.</p>

        @if(session('password_success'))
            <div class="profile-alert profile-success">{{ session('password_success') }}</div>
        @endif

        @if($errors->passwordUpdate->any())
            <div class="profile-alert profile-error">
                <strong>Password belum berhasil diperbarui:</strong>
                <ul style="margin:8px 0 0;padding-left:20px">
                    @foreach($errors->passwordUpdate->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="profile-grid">
            <div class="profile-field">
                <label for="current_password">Password lama *</label>
                <input id="current_password" name="current_password" type="password" autocomplete="current-password" required>
            </div>

            <div class="profile-field">
                <label for="password">Password baru *</label>
                <input id="password" name="password" type="password" minlength="8" autocomplete="new-password" required>
                <small>Password baru minimal 8 karakter.</small>
            </div>

            <div class="profile-field">
                <label for="password_confirmation">Konfirmasi password baru *</label>
                <input id="password_confirmation" name="password_confirmation" type="password" minlength="8" autocomplete="new-password" required>
            </div>
        </div>

        <div class="profile-actions">
            <button type="submit" class="profile-save">Perbarui Password</button>
        </div>
    </form>
</div>
@endsection
