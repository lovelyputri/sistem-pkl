@extends('layouts.guru')
@section('title','Monitoring Absensi')
@section('page-heading','Monitoring Absensi')
@section('content')
<style>
    .reminder-panel{background:#fff;border:1px solid #e8edf5;border-radius:18px;padding:22px;margin:22px 0;box-shadow:0 5px 18px rgba(25,45,90,.04)}
    .reminder-head{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:18px}
    .reminder-kicker{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#64748b;margin:0 0 6px}
    .reminder-title{font-size:19px;font-weight:750;color:#172554;margin:0 0 5px}
    .reminder-desc{font-size:13px;line-height:1.6;color:#64748b;margin:0}
    .reminder-count{flex-shrink:0;background:#fff7ed;color:#c2410c;border:1px solid #fed7aa;border-radius:12px;padding:8px 12px;font-size:12px;font-weight:700}
    .reminder-list{display:grid;gap:9px}
    .reminder-item{display:flex;align-items:center;justify-content:space-between;gap:18px;padding:14px 16px;border:1px solid #e8edf5;border-radius:13px;background:#fff;transition:border-color .18s ease,box-shadow .18s ease}.reminder-item:hover{border-color:#cbd8f4;box-shadow:0 3px 12px rgba(30,64,175,.05)}
    .reminder-person{display:flex;align-items:center;gap:12px;min-width:0}
    .reminder-avatar{width:42px;height:42px;display:grid;place-items:center;flex-shrink:0;overflow:hidden;border-radius:50%;background:#eef2ff;color:#3730a3;font-size:14px;font-weight:800;border:1px solid #e2e8f0}.reminder-avatar img{display:block;width:100%;height:100%;object-fit:cover;border-radius:50%}.reminder-avatar-fallback{width:100%;height:100%;display:grid;place-items:center}
    .reminder-name{font-size:13px;font-weight:700;color:#1e293b;margin:0 0 3px}
    .reminder-email{font-size:12px;color:#94a3b8;margin:0;overflow-wrap:anywhere}
    .reminder-action{display:flex;align-items:center;justify-content:flex-end;gap:8px;flex-shrink:0;flex-wrap:wrap}.reminder-action form{margin:0}
    .reminder-status{display:inline-flex;align-items:center;justify-content:center;min-height:34px;border-radius:9px;padding:7px 11px;font-size:11px;font-weight:700;white-space:nowrap;letter-spacing:.01em}
    .reminder-status.pending{background:#fff7ed;color:#c2410c;border:1px solid #fed7aa}
    .reminder-status.done{background:#ecfdf5;color:#047857;border:1px solid #bbf7d0}
    .reminder-status.unavailable{background:#f1f5f9;color:#64748b}
    .reminder-btn{display:inline-flex;align-items:center;justify-content:center;gap:7px;min-height:34px;border:0;border-radius:9px;padding:8px 13px;background:#2457d6;color:#fff;font-size:11px;font-weight:700;text-decoration:none;cursor:pointer;white-space:nowrap;transition:background .18s ease}
    .reminder-btn:hover{background:#1d4ed8;box-shadow:0 3px 9px rgba(37,99,235,.18)}
    .reminder-btn.sent{background:#dcfce7;color:#15803d;cursor:default}
    .reminder-empty{padding:22px 14px;text-align:center;border:1px dashed #cbd5e1;border-radius:13px;color:#64748b;font-size:13px}
    .reminder-feedback{padding:11px 13px;border-radius:10px;font-size:13px;margin-bottom:14px}
    .reminder-feedback.success{background:#ecfdf5;color:#047857}
    .reminder-feedback.error{background:#fff1f2;color:#be123c}
    @media(max-width:700px){.reminder-panel{padding:16px}.reminder-head{align-items:flex-start;flex-direction:column}.reminder-count{align-self:flex-start}.reminder-item{align-items:flex-start;flex-direction:column;gap:12px}.reminder-action{width:100%;justify-content:flex-start}.reminder-action form{flex:1}.reminder-action .reminder-btn{width:100%}}
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
                        <div class="reminder-avatar">
                            @if($siswa->foto_profil)
                                <img src="{{ asset('storage/' . $siswa->foto_profil) }}" alt="Foto {{ $siswa->nama_lengkap }}" loading="lazy" onerror="this.style.display='none';this.nextElementSibling.style.display='grid'">
                                <span class="reminder-avatar-fallback" style="display:none">{{ mb_strtoupper(mb_substr($siswa->nama_lengkap, 0, 1)) }}</span>
                            @else
                                <span class="reminder-avatar-fallback">{{ mb_strtoupper(mb_substr($siswa->nama_lengkap, 0, 1)) }}</span>
                            @endif
                        </div>
                        <div style="min-width:0">
                            <p class="reminder-name">{{ $siswa->nama_lengkap }}</p>
                            <p class="reminder-email">{{ $siswa->user->email ?? 'Akun siswa tidak ditemukan' }}</p>
                        </div>
                    </div>
                    <div class="reminder-action">
                        @if($absensiHariIni)
                            <span class="reminder-status done">✓ Sudah Absen</span>
                        @else
                            <span class="reminder-status pending">Belum Absen</span>
                            @if(!$siswa->user)
                                <span class="reminder-status unavailable">Akun tidak tersedia</span>
                            @elseif($sudahDiingatkan)
                                <span class="reminder-status done">✓ Sudah Diingatkan</span>
                            @else
                                <form method="POST" action="{{ route('guru.pengingat.store', $siswa) }}" onsubmit="return confirm('Kirim pengingat absensi kepada {{ addslashes($siswa->nama_lengkap) }}?')">
                                    @csrf
                                    <input type="hidden" name="jenis" value="absensi">
                                    <button type="submit" class="reminder-btn">Kirim Pengingat <span aria-hidden="true">→</span></button>
                                </form>
                            @endif
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
