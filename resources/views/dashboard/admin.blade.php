@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-heading', 'Dashboard Admin')

@section('content')
    <h1>Selamat datang, Admin!</h1>
    <p class="admin-intro">Berikut ringkasan data GUSPELOR.NET. Gunakan menu di samping untuk mulai mengelola data Praktik Kerja Lapangan.</p>

    <div class="admin-cards">
        <article class="admin-card">
            <div class="admin-card-label">Total Siswa</div>
            <div class="admin-card-number">{{ $totalSiswa }}</div>
        </article>
        <article class="admin-card">
            <div class="admin-card-label">Guru Pembimbing</div>
            <div class="admin-card-number">{{ $totalGuru }}</div>
        </article>
        <article class="admin-card">
            <div class="admin-card-label">Pendaftaran Menunggu</div>
            <div class="admin-card-number">{{ $siswaPending }}</div>
        </article>
    </div>

    <section class="admin-section" id="data-siswa">
        <h2>Pengelolaan Data</h2>
        <p>Halaman utama Admin sudah terhubung dengan ringkasan database. Fitur pengelolaan akan dibuat bertahap supaya setiap menu benar-benar berfungsi.</p>
        <div class="admin-shortcuts">
            <div class="admin-shortcut">Data Siswa<span>Melihat data siswa dan memproses pendaftaran.</span></div>
            <div class="admin-shortcut" id="data-guru">Guru Pembimbing<span>Mengelola data guru dan penugasan siswa.</span></div>
            <div class="admin-shortcut" id="data-lainnya">Data Pendukung<span>Mengelola sekolah, jurusan, dan kelas.</span></div>
        </div>
    </section>
@endsection
