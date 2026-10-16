@extends('layouts.guru')
@section('title', 'Dashboard Guru')
@section('page-heading', 'Dashboard Guru')

@section('content')
    <h1>Selamat datang, {{ $guru->nama_lengkap }}</h1>
    <p class="guru-intro">Pantau perkembangan siswa bimbingan, absensi, dan jurnal PKL dari satu tempat.</p>

    <div class="guru-stats">
        <div class="guru-card">
            <div class="guru-stat-label">Siswa Bimbingan</div>
            <div class="guru-stat-value">{{ $totalSiswa }}</div>
        </div>

        <div class="guru-card">
            <div class="guru-stat-label">Sudah Absen Hari Ini</div>
            <div class="guru-stat-value">{{ $sudahAbsen }}</div>
        </div>

        <div class="guru-card">
            <div class="guru-stat-label">Belum Absen Hari Ini</div>
            <div class="guru-stat-value">{{ $belumAbsen }}</div>
        </div>

        <div class="guru-card">
            <div class="guru-stat-label">Total Catatan Absensi Hari Ini</div>
            <div class="guru-stat-value">{{ $totalAbsensiHariIni }}</div>
        </div>

        <div class="guru-card">
            <div class="guru-stat-label">Total Hadir Hari Ini</div>
            <div class="guru-stat-value">{{ $totalHadir }}</div>
        </div>

        <div class="guru-card">
            <div class="guru-stat-label">Izin / Sakit Hari Ini</div>
            <div class="guru-stat-value">{{ $totalIzinSakit }}</div>
        </div>

        <div class="guru-card">
            <div class="guru-stat-label">Total Jurnal Siswa</div>
            <div class="guru-stat-value">{{ $totalJurnal }}</div>
        </div>
    </div>

    <div class="guru-panel">
        <h2>Jurnal Terbaru</h2>
        <div class="guru-table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Siswa</th>
                        <th>Judul Jurnal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jurnalTerbaru as $jurnal)
                        <tr>
                            <td>{{ $jurnal->tanggal?->format('d M Y') }}</td>
                            <td>{{ $jurnal->siswa->nama_lengkap ?? '-' }}</td>
                            <td>{{ $jurnal->judul }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="guru-muted">Belum ada jurnal dari siswa bimbingan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <p style="margin-top: 16px">
            <a class="guru-btn" href="{{ route('guru.jurnal.index') }}">Lihat semua jurnal</a>
        </p>
    </div>
@endsection
