@extends('layouts.admin')

@section('title', 'Pengaturan Admin')
@section('page-heading', 'Pengaturan Admin')

@section('content')
    <h1>Pengaturan Akun Admin</h1>
    <p class="admin-intro">Kelola email dan password untuk akun administrator yang sedang digunakan.</p>

    @if (session('success'))
        <div class="settings-alert settings-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="settings-alert settings-error">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="settings-panel">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            @method('PUT')

            <h2>Informasi Akun</h2>
            <label for="email">Email admin</label>
            <input id="email" type="email" name="email" value="{{ old('email', $admin->email) }}" required autocomplete="email">

            <div class="settings-divider"></div>
            <h2>Ganti Password</h2>
            <p class="settings-help">Kosongkan password baru jika tidak ingin menggantinya. Password saat ini tetap wajib diisi untuk keamanan.</p>

            <label for="current_password">Password saat ini</label>
            <input id="current_password" type="password" name="current_password" required autocomplete="current-password">

            <label for="password">Password baru (opsional)</label>
            <input id="password" type="password" name="password" minlength="8" autocomplete="new-password">

            <label for="password_confirmation">Konfirmasi password baru</label>
            <input id="password_confirmation" type="password" name="password_confirmation" minlength="8" autocomplete="new-password">

            <button type="submit" class="settings-button">Simpan Perubahan</button>
        </form>
    </section>
@endsection

@push('styles')
<style>
    .settings-panel { max-width: 680px; padding: 24px; background: #fff; border: 1px solid #e4e9f2; border-radius: 12px; }
    .settings-panel h2 { margin: 0 0 18px; font-size: 16px; }
    .settings-panel label { display: block; margin: 16px 0 7px; color: #334155; font-size: 12px; font-weight: 600; }
    .settings-panel input { display: block; width: 100%; padding: 11px 12px; border: 1px solid #d8e0ed; border-radius: 7px; font: inherit; font-size: 13px; outline: none; }
    .settings-panel input:focus { border-color: #315fc4; box-shadow: 0 0 0 3px rgba(49,95,196,.1); }
    .settings-help { margin: -8px 0 12px; color: #64748b; font-size: 12px; line-height: 1.6; }
    .settings-divider { height: 1px; margin: 25px 0; background: #e8edf5; }
    .settings-button { margin-top: 22px; padding: 11px 16px; border: 0; border-radius: 7px; background: #234da7; color: #fff; font: inherit; font-size: 13px; font-weight: 600; cursor: pointer; }
    .settings-alert { max-width: 680px; margin: 0 0 16px; padding: 13px 16px; border-radius: 8px; font-size: 13px; }
    .settings-success { background: #ecfdf5; color: #166534; border: 1px solid #bbf7d0; }
    .settings-error { background: #fff1f2; color: #9f1239; border: 1px solid #fecdd3; }
    .settings-error ul { margin: 8px 0 0; padding-left: 20px; }
</style>
@endpush
