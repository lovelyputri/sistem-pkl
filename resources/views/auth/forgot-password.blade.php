@extends('layouts.auth')

@section('title', 'Lupa Password')

@section('content')

<div class="auth-page">

    <div class="auth-card">


        <div class="auth-visual">

            <div class="logo">

                GUSPELOR.NET

                <span>
                    Sistem Informasi PKL
                </span>

            </div>


            <div class="visual-content">

                <h1>
                    Lupa password?
                </h1>

                <p>
                    Jangan khawatir. Masukkan email
                    yang digunakan saat mendaftar
                    untuk mendapatkan bantuan
                    pemulihan akun.
                </p>

            </div>


            <div class="illustration">

                <div class="illustration-person">

                    <div class="illustration-laptop"></div>

                </div>

            </div>

        </div>


        <div class="auth-form-area">

            <div class="auth-form">

                <h2 class="auth-title">
                    Lupa Password
                </h2>

                <p class="auth-description">
                    Masukkan email akun kamu.
                </p>


                <form>

                    <div class="field">

                        <label>
                            Email
                        </label>

                        <input
                            type="email"
                            placeholder="email@example.com"
                        >

                    </div>


                    <button
                        type="button"
                        class="btn-main"
                    >
                        Kirim Link Pemulihan
                    </button>

                </form>


                <div class="bottom-link">

                    <a href="{{ route('login') }}">
                        ← Kembali ke Login
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
