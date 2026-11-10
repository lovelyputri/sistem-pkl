@extends('layouts.admin')
@section('title', 'Pengajuan Izin')
@section('page-heading', 'Pengajuan Izin')
@section('content')
<h1>Pengajuan Izin Siswa</h1>
<p class="admin-intro">Pantau seluruh pengajuan izin PKL. Admin dapat melihat dokumen pendukung dan status persetujuan Guru Pembimbing.</p>
<div class="admin-cards">
    <div class="admin-card"><div class="admin-card-label">Menunggu</div><div class="admin-card-number">{{ $totalMenunggu }}</div></div>
    <div class="admin-card"><div class="admin-card-label">Disetujui</div><div class="admin-card-number">{{ $totalDisetujui }}</div></div>
    <div class="admin-card"><div class="admin-card-label">Ditolak</div><div class="admin-card-number">{{ $totalDitolak }}</div></div>
    <div class="admin-card"><div class="admin-card-label">Total Pengajuan</div><div class="admin-card-number">{{ $pengajuans->total() }}</div></div>
</div>
<form method="GET" class="admin-section" style="display:flex;gap:12px;flex-wrap:wrap;align-items:end">
    <label style="font-size:12px">Nama siswa<input type="search" name="siswa" value="{{ request('siswa') }}" placeholder="Cari nama siswa..." style="display:block;padding:10px;border:1px solid #d9e1ef;border-radius:7px;margin-top:5px"></label>
    <label style="font-size:12px">Status<select name="status" style="display:block;padding:10px;border:1px solid #d9e1ef;border-radius:7px;margin-top:5px"><option value="">Semua status</option>@foreach(['Menunggu','Disetujui','Ditolak'] as $status)<option value="{{ $status }}" @selected(request('status')===$status)>{{ $status }}</option>@endforeach</select></label>
    <button class="admin-logout" type="submit">Filter</button><a class="admin-logout" href="{{ route('admin.izin.index') }}">Reset</a>
</form>
<div class="admin-section" style="overflow-x:auto">
<table style="width:100%;border-collapse:collapse;font-size:12px">
<thead><tr><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Siswa</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Sekolah</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Periode</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Jenis</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Guru Pembimbing</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Status</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Aksi</th></tr></thead>
<tbody>
@forelse($pengajuans as $izin)
<tr><td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $izin->siswa->nama_lengkap ?? '-' }}</td><td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $izin->siswa->sekolah->nama_sekolah ?? '-' }}</td><td style="padding:12px;border-bottom:1px solid #eef1f6;white-space:nowrap">{{ $izin->tanggal_mulai->format('d M Y') }} – {{ $izin->tanggal_selesai->format('d M Y') }}</td><td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $izin->jenis_izin }}</td><td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $izin->guru->nama_lengkap ?? '-' }}</td><td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $izin->status }}</td><td style="padding:12px;border-bottom:1px solid #eef1f6"><a class="admin-logout" target="_blank" href="{{ route('admin.izin.surat', $izin) }}">Lihat Surat</a></td></tr>
@empty<tr><td colspan="7" style="padding:22px;text-align:center;color:#64748b">Belum ada pengajuan izin.</td></tr>@endforelse
</tbody></table>
<div style="margin-top:16px">{{ $pengajuans->links() }}</div>
</div>
@endsection
