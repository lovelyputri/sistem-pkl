@extends('layouts.guru')
@section('title','Monitoring Absensi')
@section('page-heading','Monitoring Absensi')
@section('content')
<h1>Monitoring Absensi</h1>
<p class="guru-intro">Pantau catatan kehadiran siswa bimbingan.</p>

<div class="guru-stats" style="margin-bottom:22px">
    <div class="guru-card"><div class="guru-stat-label">Hadir Hari Ini</div><div class="guru-stat-value">{{ $totalHadir }}</div></div>
    <div class="guru-card"><div class="guru-stat-label">Izin / Sakit Hari Ini</div><div class="guru-stat-value">{{ $totalIzinSakit }}</div></div>
    <div class="guru-card"><div class="guru-stat-label">Belum Absen Hari Ini</div><div class="guru-stat-value">{{ $belumAbsen }}</div></div>
</div>

<div class="guru-panel" style="margin-bottom:22px;padding:20px">
    <h2 style="margin:0 0 6px">Pengingat Absensi</h2>
    <p class="guru-muted" style="margin:0 0 16px">Siswa berikut belum tercatat melakukan absensi hari ini. Kamu bisa mengirimkan pengingat kepada mereka.</p>
    @if(session('success'))
        <div class="guru-alert" style="margin-bottom:14px">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="guru-alert" style="margin-bottom:14px;background:#fff1f2;color:#be123c">{{ session('error') }}</div>
    @endif
    @if($siswaBelumAbsen->isEmpty())
        <p class="guru-muted" style="margin:0">Semua siswa bimbingan sudah memiliki catatan absensi hari ini.</p>
    @else
        <div class="guru-table-wrap">
            <table>
                <thead><tr><th>Nama Siswa</th><th>Email Akun</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($siswaBelumAbsen as $siswa)
                        <tr>
                            <td>{{ $siswa->nama_lengkap }}</td>
                            <td>{{ $siswa->user->email ?? '-' }}</td>
                            <td>
                                @if($siswa->user)
                                    <form method="POST" action="{{ route('guru.pengingat.store', $siswa) }}" onsubmit="return confirm('Kirim pengingat absensi kepada {{ addslashes($siswa->nama_lengkap) }}?')">
                                        @csrf
                                        <input type="hidden" name="jenis" value="absensi">
                                        <button type="submit" class="guru-btn">Ingatkan Absen</button>
                                    </form>
                                @else
                                    <span class="guru-muted">Akun siswa tidak ditemukan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<form class="guru-form" method="GET">
    <input type="date" name="tanggal" value="{{ request('tanggal') }}">
    <select name="status"><option value="">Semua status</option>@foreach(['hadir','izin','sakit','alpha','terlambat'] as $status)<option value="{{ $status }}" @selected(request('status')===$status)>{{ ucfirst($status) }}</option>@endforeach</select>
    <button class="guru-btn">Terapkan filter</button>
    <a class="guru-btn" style="background:#e8edf7;color:#17357f" href="{{ route('guru.absensi.index') }}">Reset</a>
</form>

<div class="guru-panel"><div class="guru-table-wrap"><table><thead><tr><th>Tanggal</th><th>Nama Siswa</th><th>Status</th><th>Keterangan</th></tr></thead><tbody>@forelse($absensis as $absensi)<tr><td>{{ $absensi->tanggal?->format('d M Y') }}</td><td>{{ $absensi->siswa->nama_lengkap ?? '-' }}</td><td>{{ ucfirst($absensi->status) }}</td><td>{{ $absensi->keterangan ?: '-' }}</td></tr>@empty<tr><td colspan="4" class="guru-muted">Belum ada catatan absensi untuk filter ini.</td></tr>@endforelse</tbody></table></div><div class="guru-pagination">{{ $absensis->links() }}</div></div>
@endsection
