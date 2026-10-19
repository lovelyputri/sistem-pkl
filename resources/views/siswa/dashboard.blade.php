@extends('layouts.siswa')
@section('title','Dashboard Siswa')
@section('page-heading','Dashboard Siswa')
@section('content')
<h1>Halo, {{ $siswa->nama_lengkap }}!</h1>
<p class="s-intro">Pantau kegiatan Praktik Kerja Lapangan, absensi, dan jurnal harianmu dari satu tempat.</p>
<div class="s-stats">
<div class="s-card"><div class="s-stat-label">Status Absensi Hari Ini</div><div class="s-stat-value" style="font-size:20px">{{ $absensiHariIni?->status ?? 'Belum Absen' }}</div><p class="s-muted">{{ $absensiHariIni ? 'Tercatat pada '.\Carbon\Carbon::parse($absensiHariIni->created_at)->format('H:i') : 'Jangan lupa mengisi absensi hari ini.' }}</p><a class="s-btn" href="{{ route('siswa.absensi.index') }}">Buka Absensi</a></div>
<div class="s-card"><div class="s-stat-label">Total Kehadiran</div><div class="s-stat-value">{{ $totalHadir }}</div><p class="s-muted">Catatan dengan status hadir</p></div>
<div class="s-card"><div class="s-stat-label">Jurnal Tersimpan</div><div class="s-stat-value">{{ $totalJurnal }}</div><p class="s-muted">Jurnal kegiatan PKL kamu</p><a class="s-btn secondary" href="{{ route('siswa.jurnal.index') }}">Kelola Jurnal</a></div>
</div>
<div class="s-panel"><h2>Informasi PKL</h2><div class="s-info-grid">
<div class="s-info"><span>Nama Sekolah</span><strong>{{ $siswa->sekolah?->nama_sekolah ?? $siswa->sekolah?->nama ?? '-' }}</strong></div>
<div class="s-info"><span>Jurusan</span><strong>{{ $siswa->jurusan?->nama_jurusan ?? $siswa->jurusan?->nama ?? '-' }}</strong></div>
<div class="s-info"><span>Kelas</span><strong>{{ $siswa->kelas?->nama_kelas ?? $siswa->kelas?->nama ?? '-' }}</strong></div>
<div class="s-info"><span>Guru Pembimbing</span><strong>{{ $siswa->guru?->nama_lengkap ?? $siswa->guru?->nama ?? $siswa->guru?->user?->email ?? 'Belum ditugaskan' }}</strong></div>
<div class="s-info"><span>Mulai PKL</span><strong>{{ $siswa->tanggal_mulai_pkl?->format('d M Y') ?? '-' }}</strong></div>
<div class="s-info"><span>Selesai PKL</span><strong>{{ $siswa->tanggal_selesai_pkl?->format('d M Y') ?? '-' }}</strong></div>
</div></div>
<div class="s-panel"><h2>Jurnal Terbaru</h2>
@if($jurnalTerbaru->isEmpty())<p class="s-muted">Belum ada jurnal yang ditambahkan.</p>@else<div class="s-table-wrap"><table><thead><tr><th>Tanggal</th><th>Judul</th><th>Kegiatan</th></tr></thead><tbody>@foreach($jurnalTerbaru as $jurnal)<tr><td>{{ $jurnal->tanggal?->format('d/m/Y') }}</td><td>{{ $jurnal->judul }}</td><td>{{ \Illuminate\Support\Str::limit($jurnal->kegiatan,100) }}</td></tr>@endforeach</tbody></table></div>@endif
</div>
@endsection
