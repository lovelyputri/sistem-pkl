@extends('layouts.guru')
@section('title','Detail Siswa')
@section('page-heading','Detail Siswa Bimbingan')
@section('content')
<a href="{{ route('guru.siswa.index') }}" class="guru-btn" style="margin-bottom:18px">← Kembali</a>
<h1>{{ $siswa->nama_lengkap }}</h1>
<p class="guru-intro">Informasi siswa dan rekap kegiatan PKL berdasarkan bulan yang dipilih.</p>
<div class="guru-panel">
    <div class="guru-table-wrap"><table>
        <tbody>
            <tr><th>Nama lengkap</th><td>{{ $siswa->nama_lengkap }}</td><th>NISN</th><td>{{ $siswa->nisn }}</td></tr>
            <tr><th>Email</th><td>{{ $siswa->user?->email ?? '-' }}</td><th>No. telepon</th><td>{{ $siswa->no_telepon ?? '-' }}</td></tr>
            <tr><th>Sekolah</th><td>{{ $siswa->sekolah?->nama_sekolah ?? '-' }}</td><th>Kelas / Jurusan</th><td>{{ $siswa->kelas?->nama_kelas ?? '-' }} / {{ $siswa->jurusan?->nama_jurusan ?? '-' }}</td></tr>
            <tr><th>Masa PKL</th><td colspan="3">{{ $siswa->tanggal_mulai_pkl?->format('d M Y') ?? '-' }} — {{ $siswa->tanggal_selesai_pkl?->format('d M Y') ?? '-' }}</td></tr>
        </tbody>
    </table></div>
</div>
<form method="GET" class="guru-form" style="margin-top:20px"><label class="guru-muted">Rekap bulan</label><input type="month" name="bulan" value="{{ $bulan }}"><button class="guru-btn">Tampilkan</button></form>
<div class="guru-stats">
    <div class="guru-card"><div class="guru-stat-label">Hadir</div><div class="guru-stat-value">{{ $totalHadir }}</div></div>
    <div class="guru-card"><div class="guru-stat-label">Terlambat</div><div class="guru-stat-value">{{ $totalTerlambat }}</div></div>
    <div class="guru-card"><div class="guru-stat-label">Izin</div><div class="guru-stat-value">{{ $totalIzin }}</div></div>
    <div class="guru-card"><div class="guru-stat-label">Sakit</div><div class="guru-stat-value">{{ $totalSakit }}</div></div>
    <div class="guru-card"><div class="guru-stat-label">Alfa</div><div class="guru-stat-value">{{ $totalAlpa }}</div></div>
    <div class="guru-card"><div class="guru-stat-label">Jurnal Bulan Ini</div><div class="guru-stat-value">{{ $totalJurnal }}</div></div>
</div>
<div class="guru-panel"><h2>Riwayat Absensi Bulan Ini</h2><div class="guru-table-wrap"><table><thead><tr><th>Tanggal</th><th>Jam</th><th>Status</th><th>Keterangan</th></tr></thead><tbody>
@forelse($riwayatAbsensi as $absen)<tr><td>{{ $absen->tanggal?->format('d M Y') }}</td><td>{{ $absen->created_at?->format('H:i') ?? '-' }}</td><td>{{ $absen->status }}</td><td>{{ $absen->keterangan ?: '-' }}</td></tr>@empty<tr><td colspan="4" class="guru-muted">Belum ada absensi pada bulan ini.</td></tr>@endforelse
</tbody></table></div></div>
<div class="guru-panel"><h2>Jurnal Terbaru Bulan Ini</h2><div class="guru-table-wrap"><table><thead><tr><th>Tanggal</th><th>Judul</th><th>Isi kegiatan</th></tr></thead><tbody>
@forelse($riwayatJurnal as $jurnal)<tr><td>{{ $jurnal->tanggal?->format('d M Y') }}</td><td>{{ $jurnal->judul }}</td><td style="white-space:normal;min-width:250px">{{ \Illuminate\Support\Str::limit($jurnal->kegiatan,160) }}</td></tr>@empty<tr><td colspan="3" class="guru-muted">Belum ada jurnal pada bulan ini.</td></tr>@endforelse
</tbody></table></div></div>
@endsection
