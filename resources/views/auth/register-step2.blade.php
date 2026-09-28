@extends('layouts.auth')

@section('title', 'Register Tahap 1')

@section('content')

<div class="auth-page">

    <div class="auth-card">


        {{-- LEFT --}}

        <div class="auth-visual">

            <div class="logo">

                GUSPELOR.NET

                <span>
                    Sistem Informasi PKL
                </span>

            </div>


            <div class="visual-content">

                <h1>
                    Daftar akun baru
                    dan mulai perjalanan
                    PKL-mu bersama kami
                </h1>

                <p>
                    Lengkapi data diri dengan benar
                    untuk melanjutkan pendaftaran
                    akun GUSPELOR.NET.
                </p>

            </div>


            <div class="illustration">

                <div class="illustration-person">

                    <div class="illustration-laptop"></div>

                </div>

            </div>

        </div>


        {{-- RIGHT --}}

        <div class="auth-form-area">

            <div class="auth-form">


                {{-- STEP --}}

                <div class="steps">

                    <div class="step active">

                        <div class="step-circle">
                            1
                        </div>

                        <div class="step-text">
                            Data Diri
                        </div>

                    </div>


                    <div class="step-line"></div>


                    <div class="step">

                        <div class="step-circle">
                            2
                        </div>

                        <div class="step-text">
                            Data Sekolah
                        </div>

                    </div>


                    <div class="step-line"></div>


                    <div class="step">

                        <div class="step-circle">
                            3
                        </div>

                        <div class="step-text">
                            Verifikasi
                        </div>

                    </div>

                </div>


                <h2 class="auth-title">
                    Data Diri
                </h2>

                <p class="auth-description">
                    Lengkapi data diri kamu
                    sebelum melanjutkan.
                </p>


                @if($errors->any())

                    <div class="alert alert-danger">

                        <ul style="margin:0;padding-left:15px;">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    method="POST"
                    action="{{ route('register.step1') }}"
                >

                    @csrf


                    <div class="form-grid">


                        <div class="field">

                            <label>
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                name="nama_lengkap"
                                value="{{ old('nama_lengkap') }}"
                                placeholder="Nama lengkap"
                            >

                        </div>


                        <div class="field">

                            <label>
                                NISN
                            </label>

                            <input
                                type="text"
                                name="nisn"
                                value="{{ old('nisn') }}"
                                placeholder="Nomor NISN"
                            >

                        </div>


                        <div class="field">

                            <label>
                                Tanggal Lahir
                            </label>

                            <input
                                type="date"
                                name="tanggal_lahir"
                                value="{{ old('tanggal_lahir') }}"
                            >

                        </div>


                        <div class="field">

                            <label>
                                Jenis Kelamin
                            </label>

                            <select name="jenis_kelamin">

                                <option value="">
                                    Pilih jenis kelamin
                                </option>

                                <option value="Laki-laki">
                                    Laki-laki
                                </option>

                                <option value="Perempuan">
                                    Perempuan
                                </option>

                            </select>

                        </div>


                        <div class="field">

                            <label>
                                No. Telepon
                            </label>

                            <input
                                type="text"
                                name="no_telepon"
                                value="{{ old('no_telepon') }}"
                                placeholder="08xxxxxxxxxx"
                            >

                        </div>


                        <div class="field">

                            <label>
                                Username
                            </label>

                            <input
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                placeholder="Buat username"
                            >

                        </div>


                        <div class="field">

                            <label>
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="email@example.com"
                            >

                        </div>


                        <div class="field">

                            <label>
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                placeholder="Minimal 8 karakter"
                            >

                        </div>


                        <div class="field">

                            <label>
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                placeholder="Ulangi password"
                            >

                        </div>

                    </div>


                    <div
                        style="
                            display:flex;
                            justify-content:space-between;
                            align-items:center;
                            margin-top:8px;
                        "
                    >

                        <a
                            href="{{ route('login') }}"
                            class="bottom-link"
                            style="margin:0;"
                        >
                            ← Kembali
                        </a>


                        <button
                            type="submit"
                            class="btn-main"
                            style="width:150px;"
                        >
                            Selanjutnya
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
