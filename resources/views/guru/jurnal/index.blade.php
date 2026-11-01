@extends('layouts.guru')
@section('title','Jurnal Harian')
@section('page-heading','Jurnal Harian')
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
    .reminder-avatar{width:38px;height:38px;display:grid;place-items:center;flex-shrink:0;border-radius:12px;background:#eef2ff;color:#3730a3;font-size:14px;font-weight:800}
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

<h1>Jurnal Harian Siswa</h1>
<p class="guru-intro">Baca catatan kegiatan PKL dan foto yang dilampirkan siswa bimbingan.</p>

<div class="guru-stats" style="margin-bottom:22px">
    <div class="guru-card"><div class="guru-stat-label">Total Jurnal Siswa</div><div class="guru-stat-value">{{ $totalJurnal }}</div></div>
    <div class="guru-card"><div class="guru-stat-label">Jurnal Hari Ini</div><div class="guru-stat-value">{{ $jurnalHariIni }}</div></div>
    <div class="guru-card"><div class="guru-stat-label">Jurnal Bulan Ini</div><div class="guru-stat-value">{{ $jurnalBulanIni }}</div></div>
</div>

<section class="reminder-panel">
    <div class="reminder-head">
        <div>
            <p class="reminder-kicker">Tindak lanjut jurnal</p>
            <h2 class="reminder-title">Pengingat Jurnal Harian</h2>
            <p class="reminder-desc">Daftar siswa bimbingan beserta status pengisian jurnal hari ini. Pengingat hanya tersedia untuk siswa yang belum mengisi.</p>
        </div>
        <span class="reminder-count">{{ $jumlahBelumMengisiJurnal }} siswa belum mengisi</span>
    </div>

    @if(session('success'))
        <div class="reminder-feedback success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="reminder-feedback error">{{ session('error') }}</div>
    @endif

    @if($siswaBelumMengisiJurnal->isEmpty())
        <div class="reminder-empty">Belum ada siswa yang ditugaskan kepadamu.</div>
    @else
        <div class="reminder-list">
            @foreach($siswaBelumMengisiJurnal as $siswa)
                @php($jurnalHariIni = $siswa->jurnals->first())
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
                        @if($jurnalHariIni)
                            <span class="reminder-status done">✓ Sudah Mengisi</span>
                        @else
                            <span class="reminder-status pending">Belum Mengisi</span>
                            @if(!$siswa->user)
                                <span class="reminder-status unavailable">Akun tidak tersedia</span>
                            @elseif($sudahDiingatkan)
                                <span class="reminder-status done">✓ Sudah Diingatkan</span>
                            @else
                                <form method="POST" action="{{ route('guru.pengingat.store', $siswa) }}" onsubmit="return confirm('Kirim pengingat jurnal kepada {{ addslashes($siswa->nama_lengkap) }}?')">
                                    @csrf
                                    <input type="hidden" name="jenis" value="jurnal">
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

<form class="guru-form" method="GET"><input type="search" name="cari" value="{{ request('cari') }}" placeholder="Cari judul atau nama siswa"><input type="date" name="tanggal" value="{{ request('tanggal') }}"><button class="guru-btn">Cari jurnal</button><a class="guru-btn" style="background:#e8edf7;color:#17357f" href="{{ route('guru.jurnal.index') }}">Reset</a></form>
<div class="guru-panel"><div class="guru-table-wrap"><table><thead><tr><th>Tanggal</th><th>Nama Siswa</th><th>Judul</th><th>Kegiatan</th><th>Keterangan</th><th>Foto</th></tr></thead><tbody>@forelse($jurnals as $jurnal)<tr><td>{{ $jurnal->tanggal?->format('d M Y') }}</td><td>{{ $jurnal->siswa->nama_lengkap ?? '-' }}</td><td>{{ $jurnal->judul }}</td><td style="white-space:normal;min-width:220px">{{ $jurnal->kegiatan }}</td><td style="white-space:normal;min-width:160px">{{ $jurnal->keterangan ?: '-' }}</td><td>@if($jurnal->image)<a href="{{ asset('storage/'.$jurnal->image) }}" target="_blank" rel="noopener">Lihat foto</a>@else-@endif</td></tr>@empty<tr><td colspan="6" class="guru-muted">Belum ada jurnal untuk filter ini.</td></tr>@endforelse</tbody></table></div><div class="guru-pagination">{{ $jurnals->links() }}</div></div>
@endsection
