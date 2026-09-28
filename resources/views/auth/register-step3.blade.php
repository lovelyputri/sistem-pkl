@extends('layouts.auth')

@section('title', 'Register Tahap 3')

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
                    Sedikit lagi,
                    pendaftaranmu
                    hampir selesai
                </h1>

                <p>
                    Periksa kembali data yang telah
                    kamu masukkan sebelum membuat
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


                <div class="steps">

                    <div class="step done">

                        <div class="step-circle">
                            ✓
                        </div>

                        <div class="step-text">
                            Data Diri
                        </div>

                    </div>


                    <div class="step-line active"></div>


                    <div class="step done">

                        <div class="step-circle">
                            ✓
                        </div>

                        <div class="step-text">
                            Data Sekolah
                        </div>

                    </div>


                    <div class="step-line active"></div>


                    <div class="step active">

                        <div class="step-circle">
                            3
                        </div>

                        <div class="step-text">
                            Verifikasi
                        </div>

                    </div>

                </div>


                <div
                    style="
                        text-align:center;
                        padding:15px 0 10px;
                    "
                >

                    <div
                        style="
                            width:70px;
                            height:70px;
                            border-radius:50%;
                            background:#eaf5ff;
                            color:#367fe8;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            font-size:28px;
                            margin:auto auto 15px;
                        "
                    >
                        ✓
                    </div>


                    <h2 class="auth-title">
                        Pendaftaran Berhasil
                    </h2>


                    <p class="auth-description">
                        Semua data sudah siap disimpan.
                        Klik tombol di bawah untuk
                        menyelesaikan pendaftaran.
                    </p>

                </div>


                <div
                    style="
                        background:#eaf7ff;
                        border-radius:11px;
                        padding:13px;
                        color:#637f9d;
                        font-size:10px;
                        line-height:1.7;
                        margin-bottom:20px;
                    "
                >

                    <strong>
                        Data siap diverifikasi
                    </strong>

                    <br>

                    Setelah pendaftaran selesai,
                    kamu dapat langsung masuk
                    sebagai siswa.

                </div>


                <form
                    method="POST"
                    action="{{ route('register.finish') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn-main"
                    >
                        Selesaikan Pendaftaran
                    </button>

                </form>


                <div class="bottom-link">

                    <a href="{{ route('register.step2') }}">
                        ← Kembali dan periksa data
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
