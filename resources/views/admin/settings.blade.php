@extends('layouts.admin')

@section('title', 'Pengaturan Admin')
@section('page-heading', 'Pengaturan Akun')

@push('styles')
<style>
    .settings-page{max-width:1040px}
    .settings-heading{margin-bottom:24px}
    .settings-heading h1{margin:0;color:#172554;font-size:23px;font-weight:750;letter-spacing:-.5px}
    .settings-heading p{margin:7px 0 0;color:#64748b;font-size:13px;line-height:1.65}
    .settings-alert{display:flex;gap:10px;align-items:flex-start;padding:14px 16px;margin:0 0 18px;border-radius:10px;font-size:13px;line-height:1.6}
    .settings-alert strong{display:block;margin-bottom:3px}
    .settings-success{background:#effaf4;border:1px solid #ccebd8;color:#17643a}
    .settings-error{background:#fff5f5;border:1px solid #f4d0d0;color:#a12d35}
    .settings-error ul{margin:5px 0 0;padding-left:18px}
    .settings-card{background:#fff;border:1px solid #e5eaf2;border-radius:14px;box-shadow:0 4px 14px rgba(15,23,42,.025);overflow:hidden;margin-bottom:18px}
    .settings-card-head{display:flex;align-items:center;gap:12px;padding:20px 22px;border-bottom:1px solid #edf0f5}
    .settings-icon{width:38px;height:38px;display:grid;place-items:center;flex:0 0 38px;border-radius:10px;background:#edf3ff;color:#234da7}
    .settings-icon svg{width:19px;height:19px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .settings-card-head h2{margin:0;color:#172554;font-size:14px;font-weight:700}
    .settings-card-head p{margin:4px 0 0;color:#718096;font-size:11px;line-height:1.5}
    .settings-card-body{padding:22px}
    .settings-profile{display:flex;align-items:center;gap:16px;padding:0 0 21px;margin-bottom:20px;border-bottom:1px solid #edf0f5}
    .settings-avatar{width:66px;height:66px;flex:0 0 66px;object-fit:cover;border:1px solid #e5eaf2;border-radius:50%;background:#f3f6fb}
    .settings-profile-copy strong{display:block;color:#1e293b;font-size:13px}
    .settings-profile-copy span{display:block;margin-top:4px;color:#718096;font-size:11px}
    .settings-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}
    .settings-field{min-width:0}
    .settings-field.full{grid-column:1/-1}
    .settings-field label{display:block;margin:0 0 7px;color:#334155;font-size:12px;font-weight:650}
    .settings-field input{display:block;width:100%;min-height:42px;padding:10px 12px;border:1px solid #dbe2ec;border-radius:8px;background:#fff;color:#1e293b;font:inherit;font-size:12px;transition:border-color .15s,box-shadow .15s}
    .settings-field input:focus{outline:none;border-color:#3766bd;box-shadow:0 0 0 3px rgba(55,102,189,.1)}
    .settings-field input[type=file]{padding:8px;background:#fbfcfe}
    .settings-field small{display:block;margin-top:6px;color:#8290a3;font-size:10px;line-height:1.55}
    .settings-password-note{margin:0 0 18px;padding:11px 13px;border-radius:8px;background:#f7f9fc;color:#64748b;font-size:11px;line-height:1.6}
    .settings-actions{display:flex;justify-content:flex-end;align-items:center;gap:10px;padding:17px 22px;border-top:1px solid #edf0f5;background:#fcfdff}
    .settings-submit{display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:39px;padding:0 16px;border:0;border-radius:8px;background:#234da7;color:#fff;font:inherit;font-size:12px;font-weight:650;cursor:pointer;transition:background .15s,transform .15s}
    .settings-submit:hover{background:#193d8e;transform:translateY(-1px)}
    .settings-submit:focus-visible{outline:3px solid rgba(49,95,196,.25);outline-offset:2px}
    @media(max-width:640px){.settings-page{width:100%}.settings-heading h1{font-size:21px}.settings-card-head{padding:16px}.settings-card-body{padding:17px}.settings-grid{grid-template-columns:1fr;gap:15px}.settings-field.full{grid-column:auto}.settings-actions{padding:14px 17px}.settings-submit{width:100%}}
</style>
@endpush

@section('content')
<div class="settings-page">
    <div class="settings-heading">
        <h1>Pengaturan Akun Admin</h1>
        <p>Perbarui informasi profil dan keamanan akun administrator GUSPELOR.NET.</p>
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
            <div>
                <strong>Periksa kembali data yang dimasukkan.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <section class="settings-card">
            <div class="settings-card-head">
                <span class="settings-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>
                </span>
                <div>
                    <h2>Informasi Profil</h2>
                    <p>Informasi dasar yang ditampilkan pada akun administrator.</p>
                </div>
            </div>

            <div class="settings-card-body">
                <div class="settings-profile">
                    <img
                        class="settings-avatar"
                        src="{{ $admin->foto_profil ? asset('storage/'.$admin->foto_profil) : asset('images/logo.png') }}"
                        alt="Foto profil admin"
                    >
                    <div class="settings-profile-copy">
                        <strong>{{ old('nama_akun', $admin->nama_akun ?? 'Administrator') }}</strong>
                        <span>Administrator GUSPELOR.NET</span>
                    </div>
                </div>

                <div class="settings-grid">
                    <div class="settings-field">
                        <label for="nama_akun">Nama akun admin</label>
                        <input
                            id="nama_akun"
                            type="text"
                            name="nama_akun"
                            value="{{ old('nama_akun', $admin->nama_akun ?? 'Admin') }}"
                            maxlength="100"
                            autocomplete="name"
                            required
                        >
                    </div>

                    <div class="settings-field">
                        <label for="email">Email admin</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email', $admin->email) }}"
                            maxlength="255"
                            autocomplete="email"
                            required
                        >
                    </div>

                    <div class="settings-field full">
                        <label for="foto_profil">Foto profil</label>
                        <input
                            id="foto_profil"
                            type="file"
                            name="foto_profil"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        >
                        <small>Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB. Kosongkan jika tidak ingin mengganti foto.</small>
                    </div>
                </div>
            </div>
        </section>

        <section class="settings-card">
            <div class="settings-card-head">
                <span class="settings-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3m-4 5v2"/></svg>
                </span>
                <div>
                    <h2>Keamanan Akun</h2>
                    <p>Gunakan bagian ini jika ingin mengganti password administrator.</p>
                </div>
            </div>

            <div class="settings-card-body">
                <p class="settings-password-note">Password saat ini wajib diisi setiap kali menyimpan perubahan. Jika tidak ingin mengganti password, biarkan kolom password baru tetap kosong.</p>

                <div class="settings-grid">
                    <div class="settings-field full">
                        <label for="current_password">Password saat ini <span aria-hidden="true">*</span></label>
                        <input id="current_password" type="password" name="current_password" autocomplete="current-password" required>
                    </div>

                    <div class="settings-field">
                        <label for="password">Password baru</label>
                        <input id="password" type="password" name="password" minlength="8" autocomplete="new-password">
                        <small>Minimal 8 karakter. Kosongkan jika tidak ingin mengganti password.</small>
                    </div>

                    <div class="settings-field">
                        <label for="password_confirmation">Konfirmasi password baru</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" minlength="8" autocomplete="new-password">
                        <small>Isi ulang password baru untuk memastikan tidak ada kesalahan pengetikan.</small>
                    </div>
                </div>
            </div>

            <div class="settings-actions">
                <button type="submit" class="settings-submit">Simpan Perubahan</button>
            </div>
        </section>
    </form>
</div>
@endsection
