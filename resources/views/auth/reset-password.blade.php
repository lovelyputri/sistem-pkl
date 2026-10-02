@extends('layouts.auth')
@section('title', 'Reset Password')

@section('content')
    <h1>Buat Password Baru</h1>
    <p class="sub">Gunakan minimal 8 karakter.</p>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $email) }}" required readonly>
        @error('email') <div class="err">{{ $message }}</div> @enderror

        <label for="password">Password Baru</label>
        <input type="password" id="password" name="password" required minlength="8" autofocus>
        @error('password') <div class="err">{{ $message }}</div> @enderror

        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8">

        <button type="submit">Simpan Password</button>
    </form>
@endsection
