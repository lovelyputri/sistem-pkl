@extends('layouts.guru')
@section('title','Jurnal Harian')
@section('page-heading','Jurnal Harian')
@section('content')
<h1>Jurnal Harian Siswa</h1>
<p class="guru-intro">Baca catatan kegiatan PKL dan foto yang dilampirkan siswa bimbingan.</p>

<div class="guru-stats" style="margin-bottom:22px">
    <div class="guru-card"><div class="guru-stat-label">Total Jurnal Siswa</div><div class="guru-stat-value">{{ $totalJurnal }}</div></div>
    <div class="guru-card"><div class="guru-stat-label">Jurnal Hari Ini</div><div class="guru-stat-value">{{ $jurnalHariIni }}</div></div>
    <div class="guru-card"><div class="guru-stat-label">Jurnal Bulan Ini</div><div class="guru-stat-value">{{ $jurnalBulanIni }}</div></div>
</div>

<div class="guru-panel" style="margin-bottom:22px;padding:20px">
    <h2 style="margin:0 0 6px">Pengingat Jurnal Harian</h2>
    <p class="guru-muted" style="margin:0 0 16px">Siswa berikut belum mengisi jurnal untuk hari ini. Kamu bisa mengirimkan pengingat kepada mereka.</p>
    @if(session('success'))
        <div class="guru-alert" style="margin-bottom:14px">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="guru-alert" style="margin-bottom:14px;background:#fff1f2;color:#be123c">{{ session('error') }}</div>
    @endif
    @if($siswaBelumMengisiJurnal->isEmpty())
        <p class="guru-muted" style="margin:0">Semua siswa bimbingan sudah mengisi jurnal hari ini.</p>
    @else
        <div class="guru-table-wrap">
            <table>
                <thead><tr><th>Nama Siswa</th><th>Email Akun</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($siswaBelumMengisiJurnal as $siswa)
                        <tr>
                            <td>{{ $siswa->nama_lengkap }}</td>
                            <td>{{ $siswa->user->email ?? '-' }}</td>
                            <td>
                                @if($siswa->user)
                                    <form method="POST" action="{{ route('guru.pengingat.store', $siswa) }}" onsubmit="return confirm('Kirim pengingat jurnal kepada {{ addslashes($siswa->nama_lengkap) }}?')">
                                        @csrf
                                        <input type="hidden" name="jenis" value="jurnal">
                                        <button type="submit" class="guru-btn">Ingatkan Isi Jurnal</button>
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

<form class="guru-form" method="GET"><input type="search" name="cari" value="{{ request('cari') }}" placeholder="Cari judul atau nama siswa"><input type="date" name="tanggal" value="{{ request('tanggal') }}"><button class="guru-btn">Cari jurnal</button><a class="guru-btn" style="background:#e8edf7;color:#17357f" href="{{ route('guru.jurnal.index') }}">Reset</a></form>
<div class="guru-panel"><div class="guru-table-wrap"><table><thead><tr><th>Tanggal</th><th>Nama Siswa</th><th>Judul</th><th>Kegiatan</th><th>Keterangan</th><th>Foto</th></tr></thead><tbody>@forelse($jurnals as $jurnal)<tr><td>{{ $jurnal->tanggal?->format('d M Y') }}</td><td>{{ $jurnal->siswa->nama_lengkap ?? '-' }}</td><td>{{ $jurnal->judul }}</td><td style="white-space:normal;min-width:220px">{{ $jurnal->kegiatan }}</td><td style="white-space:normal;min-width:160px">{{ $jurnal->keterangan ?: '-' }}</td><td>@if($jurnal->image)<a href="{{ asset('storage/'.$jurnal->image) }}" target="_blank" rel="noopener">Lihat foto</a>@else-@endif</td></tr>@empty<tr><td colspan="6" class="guru-muted">Belum ada jurnal untuk filter ini.</td></tr>@endforelse</tbody></table></div><div class="guru-pagination">{{ $jurnals->links() }}</div></div>
@endsection
