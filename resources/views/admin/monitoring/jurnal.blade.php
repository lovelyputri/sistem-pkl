@extends('layouts.admin')

@section('title', 'Jurnal Harian')
@section('page-heading', 'Jurnal Harian')

@section('content')
<h1>Jurnal Harian Siswa</h1>
<p class="admin-intro">Lihat catatan kegiatan PKL yang dikirim siswa.</p>
<form method="GET" class="admin-section" style="display:flex;gap:12px;flex-wrap:wrap;align-items:end">
    <label style="font-size:12px">Tanggal<input type="date" name="tanggal" value="{{ request('tanggal') }}" style="display:block;padding:10px;border:1px solid #d9e1ef;border-radius:7px;margin-top:5px"></label>
    <label style="font-size:12px">Nama siswa<input type="search" name="siswa" value="{{ request('siswa') }}" placeholder="Cari siswa..." style="display:block;padding:10px;border:1px solid #d9e1ef;border-radius:7px;margin-top:5px"></label>
    <button class="admin-logout" type="submit">Filter</button>
    <a class="admin-logout" href="{{ route('admin.jurnal.index') }}">Reset</a>
</form>
<div class="admin-section" style="overflow-x:auto">
<table style="width:100%;border-collapse:collapse;font-size:13px">
<thead><tr><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Tanggal</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Siswa</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Judul</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Kegiatan</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Keterangan</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Foto</th></tr></thead>
<tbody>
@forelse($jurnals as $jurnal)
<tr><td style="padding:12px;border-bottom:1px solid #eef1f6">{{ optional($jurnal->tanggal)->format('d-m-Y') }}</td><td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $jurnal->siswa->nama_lengkap ?? 'Siswa dihapus' }}</td><td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $jurnal->judul }}</td><td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $jurnal->kegiatan }}</td><td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $jurnal->keterangan ?: '-' }}</td><td style="padding:12px;border-bottom:1px solid #eef1f6">@if($jurnal->image)<a href="{{ asset('storage/'.$jurnal->image) }}" target="_blank" rel="noopener">Lihat foto</a>@else-@endif</td></tr>
@empty<tr><td colspan="6" style="padding:18px;text-align:center;color:#64748b">Belum ada jurnal yang sesuai.</td></tr>@endforelse
</tbody></table>
<div style="margin-top:16px">{{ $jurnals->links() }}</div>
</div>
@endsection
