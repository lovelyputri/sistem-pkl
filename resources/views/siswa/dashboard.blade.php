@extends('layouts.siswa')
@section('title','Dashboard Siswa')
@section('page-heading','Dashboard Siswa')
@section('content')
<h1>Halo, {{ $siswa->nama_lengkap }}!</h1>
<p class="siswa-intro">Ringkasan aktivitas PKL dan perkembangan jurnal serta kehadiranmu.</p>
<div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:18px">
    <span class="siswa-badge {{ $absensiHariIni ? ($absensiHariIni->status === 'Terlambat' ? 'warning' : 'success') : 'info' }}">Absensi: {{ $absensiHariIni?->status ?? 'Belum absen' }}</span>
    <span class="siswa-badge {{ $jurnalHariIni ? 'success' : 'info' }}">Jurnal: {{ $jurnalHariIni ? 'Sudah mengisi' : 'Belum mengisi' }}</span>
</div>
<div class="siswa-stats">
    <div class="siswa-card"><div class="siswa-stat-label">Total Kehadiran</div><div class="siswa-stat-value">{{ $totalAbsensi }}</div></div>
    <div class="siswa-card"><div class="siswa-stat-label">Total Jurnal</div><div class="siswa-stat-value">{{ $totalJurnal }}</div></div>
    <div class="siswa-card"><div class="siswa-stat-label">Terlambat</div><div class="siswa-stat-value">{{ $totalTerlambat }}</div></div>
</div>
<div class="siswa-panel">
    <h2>Statistik Aktivitas Bulan Ini</h2>
    <p class="siswa-muted">{{ now()->translatedFormat('F Y') }}</p>
    <div style="margin-top:20px">
        <div style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:7px"><strong>Absensi tercatat</strong><span>{{ $absensiBulanIni }} hari</span></div>
        <div style="height:10px;background:#edf2f7;border-radius:20px;overflow:hidden"><div style="height:100%;width:{{ min(100, ($absensiBulanIni / max(1, now()->daysInMonth)) * 100) }}%;background:#315fc4;border-radius:20px"></div></div>
    </div>
    <div style="margin-top:18px">
        <div style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:7px"><strong>Jurnal tersimpan</strong><span>{{ $jurnalBulanIni }} jurnal</span></div>
        <div style="height:10px;background:#edf2f7;border-radius:20px;overflow:hidden"><div style="height:100%;width:{{ min(100, ($jurnalBulanIni / max(1, now()->daysInMonth)) * 100) }}%;background:#f97316;border-radius:20px"></div></div>
    </div>
</div>
<div class="siswa-actions" style="justify-content:flex-start"><a class="siswa-btn" href="{{ route('siswa.absensi.index') }}">Buka Absensi</a><a class="siswa-btn secondary" href="{{ route('siswa.jurnal.create') }}">Tulis Jurnal</a><a class="siswa-btn secondary" href="{{ route('siswa.notifikasi.index') }}">Notifikasi ({{ $notifikasiBelumDibaca }})</a></div>
@endsection
