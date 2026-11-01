@extends('layouts.admin')

@section('title', 'Absensi Siswa')
@section('page-heading', 'Absensi Siswa')

@section('content')
<h1>Absensi Siswa</h1>
<p class="admin-intro">Pantau data kehadiran siswa PKL berdasarkan tanggal atau nama siswa.</p>
<form method="GET" class="admin-section" style="display:flex;gap:12px;flex-wrap:wrap;align-items:end">
    <label style="font-size:12px">Tanggal<input type="date" name="tanggal" value="{{ request('tanggal') }}" style="display:block;padding:10px;border:1px solid #d9e1ef;border-radius:7px;margin-top:5px"></label>
    <label style="font-size:12px">Status<select name="status" style="display:block;padding:10px;border:1px solid #d9e1ef;border-radius:7px;margin-top:5px"><option value="">Semua status</option>@foreach(['Hadir','Terlambat','Izin','Sakit','Alpa'] as $status)<option value="{{ $status }}" @selected(($statusFilter ?? request('status')) === $status)>{{ $status }}</option>@endforeach</select></label>
    <label style="font-size:12px">Nama siswa<input type="search" name="siswa" value="{{ request('siswa') }}" placeholder="Cari siswa..." style="display:block;padding:10px;border:1px solid #d9e1ef;border-radius:7px;margin-top:5px"></label>
    <button class="admin-logout" type="submit">Filter</button>
    <a class="admin-logout" href="{{ route('admin.absensi.index') }}">Reset</a>
</form>
<div class="admin-section" style="overflow-x:auto">
<table style="width:100%;border-collapse:collapse;font-size:13px">
<thead><tr><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Tanggal</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Siswa</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Sekolah</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Status</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Keterangan</th></tr></thead>
<tbody>
@forelse($absensis as $absensi)
<tr><td style="padding:12px;border-bottom:1px solid #eef1f6">{{ optional($absensi->tanggal)->format('d-m-Y') }}</td><td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $absensi->siswa->nama_lengkap ?? 'Siswa dihapus' }}</td><td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $absensi->siswa->sekolah->nama_sekolah ?? '-' }}</td><td style="padding:12px;border-bottom:1px solid #eef1f6"><span style="display:inline-block;padding:5px 9px;border-radius:20px;background:{{ $absensi->status === 'Hadir' ? '#dcfce7' : ($absensi->status === 'Terlambat' ? '#ffedd5' : ($absensi->status === 'Sakit' ? '#dbeafe' : '#f1f5f9')) }};color:{{ $absensi->status === 'Hadir' ? '#166534' : ($absensi->status === 'Terlambat' ? '#9a3412' : ($absensi->status === 'Sakit' ? '#1d4ed8' : '#475569')) }}">{{ $absensi->status ?? '-' }}</span></td><td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $absensi->keterangan ?: '-' }}</td></tr>
@empty<tr><td colspan="5" style="padding:18px;text-align:center;color:#64748b">Belum ada data absensi yang sesuai.</td></tr>@endforelse
</tbody></table>
<div style="margin-top:16px">{{ $absensis->links() }}</div>
</div>
@endsection
