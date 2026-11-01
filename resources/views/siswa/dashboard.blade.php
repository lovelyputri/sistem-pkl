@extends('layouts.siswa')
@section('title','Dashboard Siswa')
@section('page-heading','Dashboard Siswa')
@section('content')
<h1>Halo, {{ $siswa->nama_lengkap }}!</h1>
<p class="siswa-intro">Selamat datang di GUSPELOR.NET. Catat kehadiran dan kegiatan PKL kamu secara rutin.</p>
<div class="siswa-stats">
<div class="siswa-card"><div class="siswa-stat-label">Status Absensi Hari Ini</div><div style="margin-top:12px">@if($absensiHariIni)<span class="siswa-badge success">Sudah Absen</span>@else<span class="siswa-badge warning">Belum Absen</span>@endif</div></div>
<div class="siswa-card"><div class="siswa-stat-label">Status Jurnal Hari Ini</div><div style="margin-top:12px">@if($jurnalHariIni)<span class="siswa-badge success">Sudah Mengisi</span>@else<span class="siswa-badge warning">Belum Mengisi</span>@endif</div></div>
<div class="siswa-card"><div class="siswa-stat-label">Notifikasi Belum Dibaca</div><div class="siswa-stat-value">{{ $notifikasiBelumDibaca }}</div></div>
<div class="siswa-card"><div class="siswa-stat-label">Total Riwayat Absensi</div><div class="siswa-stat-value">{{ $totalAbsensi }}</div></div>
<div class="siswa-card"><div class="siswa-stat-label">Total Jurnal Tersimpan</div><div class="siswa-stat-value">{{ $totalJurnal }}</div></div>
<div class="siswa-card"><div class="siswa-stat-label">Guru Pembimbing</div><div style="font-size:15px;font-weight:700;margin-top:12px">{{ $siswa->guru?->nama_lengkap ?? 'Belum ditentukan' }}</div></div>
</div>
<div class="siswa-panel">
<h2>Informasi PKL</h2>
<div class="siswa-grid-2">
<div><div class="siswa-muted">Sekolah</div><strong>{{ $siswa->sekolah?->nama_sekolah ?? '-' }}</strong></div>
<div><div class="siswa-muted">Jurusan / Kelas</div><strong>{{ $siswa->jurusan?->nama_jurusan ?? '-' }} / {{ $siswa->kelas?->nama_kelas ?? '-' }}</strong></div>
<div><div class="siswa-muted">Mulai PKL</div><strong>{{ $siswa->tanggal_mulai_pkl?->format('d M Y') ?? '-' }}</strong></div>
<div><div class="siswa-muted">Selesai PKL</div><strong>{{ $siswa->tanggal_selesai_pkl?->format('d M Y') ?? '-' }}</strong></div>
</div>
<div class="siswa-actions" style="justify-content:flex-start"><a class="siswa-btn" href="{{ route('siswa.absensi.index') }}">Isi Absensi</a><a class="siswa-btn secondary" href="{{ route('siswa.jurnal.create') }}">Tulis Jurnal</a></div>
</div>
<div class="siswa-panel"><h2>Jurnal Terbaru</h2><div class="siswa-table-wrap"><table><thead><tr><th>Tanggal</th><th>Judul</th><th>Kegiatan</th></tr></thead><tbody>@forelse($jurnalTerbaru as $jurnal)<tr><td>{{ $jurnal->tanggal?->format('d M Y') }}</td><td>{{ $jurnal->judul }}</td><td>{{ \Illuminate\Support\Str::limit($jurnal->kegiatan,80) }}</td></tr>@empty<tr><td colspan="3" class="siswa-muted">Belum ada jurnal yang dibuat.</td></tr>@endforelse</tbody></table></div></div>
@endsection
