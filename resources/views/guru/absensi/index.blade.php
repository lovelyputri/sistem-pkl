@extends('layouts.guru')
@section('title','Monitoring Absensi')
@section('page-heading','Monitoring Absensi')
@section('content')
<style>
    .reminder-panel{background:#fff;border:1px solid #e8edf5;border-radius:18px;padding:22px;margin:22px 0;box-shadow:0 5px 18px rgba(25,45,90,.04)}
    .reminder-head{display:flex;align-items:flex-start;justify-content:space-between;gap:14px;margin-bottom:18px}
    .reminder-kicker{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#64748b;margin:0 0 6px}
    .reminder-title{font-size:19px;font-weight:750;color:#172554;margin:0 0 5px}
    .reminder-desc{font-size:13px;line-height:1.6;color:#64748b;margin:0}
    .reminder-count{flex-shrink:0;background:#fff7ed;color:#c2410c;border:1px solid #fed7aa;border-radius:12px;padding:8px 12px;font-size:12px;font-weight:700}
    .reminder-list{display:grid;gap:10px}
    .reminder-item{display:flex;align-items:center;justify-content:space-between;gap:16px;padding:13px 15px;border:1px solid #edf0f5;border-radius:13px;background:#fcfdff}
    .reminder-person{display:flex;align-items:center;gap:12px;min-width:0}
    .reminder-avatar{width:38px;height:38px;display:grid;place-items:center;flex-shrink:0;border-radius:12px;background:#eef2ff;color:#3730a3;font-size:14px;font-weight:800}
    .reminder-name{font-size:13px;font-weight:700;color:#1e293b;margin:0 0 3px}
    .reminder-email{font-size:12px;color:#94a3b8;margin:0;overflow-wrap:anywhere}
    .reminder-action{flex-shrink:0}
    .reminder-btn{display:inline-flex;align-items:center;justify-content:center;gap:7px;border:0;border-radius:10px;padding:9px 13px;background:#2563eb;color:#fff;font-size:12px;font-weight:700;text-decoration:none;cursor:pointer;transition:background .18s ease}
    .reminder-btn:hover{background:#1d4ed8}
    .reminder-btn.sent{background:#dcfce7;color:#15803d;cursor:default}
    .reminder-empty{padding:22px 14px;text-align:center;border:1px dashed #cbd5e1;border-radius:13px;color:#64748b;font-size:13px}
    .reminder-feedback{padding:11px 13px;border-radius:10px;font-size:13px;margin-bottom:14px}
    .reminder-feedback.success{background:#ecfdf5;color:#047857}
    .reminder-feedback.error{background:#fff1f2;color:#be123c}
    @media(max-width:640px){.reminder-panel{padding:16px}.reminder-head{flex-direction:column}.reminder-item{align-items:flex-start;flex-direction:column}.reminder-action,.reminder-btn{width:100%}}
</style>

<h1>Monitoring Absensi</h1>
<p class="guru-intro">Pantau catatan kehadiran siswa bimbingan.</p>

<div class="guru-stats" style="margin-bottom:22px">
    <div class="guru-card"><div class="guru-stat-label">Hadir Hari Ini</div><div class="guru-stat-value">{{ $totalHadir }}</div></div>
    <div class="guru-card"><div class="guru-stat-label">Izin / Sakit Hari Ini</div><div class="guru-stat-value">{{ $totalIzinSakit }}</div></div>
    <div class="guru-card"><div class="guru-stat-label">Belum Absen Hari Ini</div><div class="guru-stat-value">{{ $belumAbsen }}</div></div>
</div>

<section class="reminder-panel">
    <div class="reminder-head">
        <div>
            <p class="reminder-kicker">Tindak lanjut kehadiran</p>
            <h2 class="reminder-title">Pengingat Absensi</h2>
            <p class="reminder-desc">Daftar siswa bimbingan beserta status absensi hari ini. Pengingat hanya tersedia untuk siswa yang belum absen.</p>
        </div>
        <span class="reminder-count">{{ $jumlahBelumAbsen }} siswa belum absen</span>
    </div>

    @if(session('success'))
        <div class="reminder-feedback success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="reminder-feedback error">{{ session('error') }}</div>
    @endif

    @if($siswaBelumAbsen->isEmpty())
        <div class="reminder-empty">Belum ada siswa yang ditugaskan kepadamu.</div>
    @else
        <div class="reminder-list">
            @foreach($siswaBelumAbsen as $siswa)
                @php($absensiHariIni = $siswa->absensis->first())
                @php($sudahDiingatkan = $siswa->user?->notifications?->isNotEmpty() ?? false)
                <div class="reminder-item">
                    <div class="reminder-person">
                        <div class="reminder-avatar">{{ strtoupper(substr($siswa->nama_lengkap, 0, 1)) }}</div>
                        <div style="min-width:0">
                            <p class="reminder-name">{{ $siswa->nama_lengkap }}</p>
                            <p class="reminder-email">{{ $siswa->user->email ?? 'Akun siswa tidak ditemukan' }}</p>
                        </div>
                    </div>
                    <div class="reminder-action">
                        @if($absensiHariIni)
                            <span class="reminder-btn sent" style="background:#dcfce7;color:#15803d">✓ Sudah Absen</span>
                        @elseif(!$siswa->user)
                            <button type="button" class="reminder-btn sent" disabled>Akun tidak tersedia</button>
                        @elseif($sudahDiingatkan)
                            <button type="button" class="reminder-btn sent" disabled>✓ Sudah Diingatkan</button>
                        @else
                            <form method="POST" action="{{ route('guru.pengingat.store', $siswa) }}" onsubmit="return confirm('Kirim pengingat absensi kepada {{ addslashes($siswa->nama_lengkap) }}?')">
                                @csrf
                                <input type="hidden" name="jenis" value="absensi">
                                <button type="submit" class="reminder-btn">Kirim Pengingat <span aria-hidden="true">→</span></button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>

<form class="guru-form" method="GET">
    <input type="date" name="tanggal" value="{{ request('tanggal') }}">
    <select name="status"><option value="">Semua status</option>@foreach(['hadir','izin','sakit','alpha','terlambat'] as $status)<option value="{{ $status }}" @selected(request('status')===$status)>{{ ucfirst($status) }}</option>@endforeach</select>
    <button class="guru-btn">Terapkan filter</button>
    <a class="guru-btn" style="background:#e8edf7;color:#17357f" href="{{ route('guru.absensi.index') }}">Reset</a>
</form>

<div class="guru-panel"><div class="guru-table-wrap"><table><thead><tr><th>Tanggal</th><th>Nama Siswa</th><th>Status</th><th>Keterangan</th></tr></thead><tbody>@forelse($absensis as $absensi)<tr><td>{{ $absensi->tanggal?->format('d M Y') }}</td><td>{{ $absensi->siswa->nama_lengkap ?? '-' }}</td><td>{{ ucfirst($absensi->status) }}</td><td>{{ $absensi->keterangan ?: '-' }}</td></tr>@empty<tr><td colspan="4" class="guru-muted">Belum ada catatan absensi untuk filter ini.</td></tr>@endforelse</tbody></table></div><div class="guru-pagination">{{ $absensis->links() }}</div></div>
@endsection
