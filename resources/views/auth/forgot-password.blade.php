@extends('layouts.auth')
@section('title', 'Lupa Password')

@section('content')
    <h1>Lupa Password</h1>
    <p class="sub">Masukkan email akun kamu. Kami akan mengirim tautan untuk membuat password baru.</p>

    @if (session('success'))
        <div class="alert ok">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email') <div class="err">{{ $message }}</div> @enderror

        <button type="submit">Kirim Tautan Reset</button>
    </form>

    <a class="back" href="{{ route('login') }}">← Kembali ke login</a>
@endsection
