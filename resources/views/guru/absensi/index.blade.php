@extends('layouts.guru')
@section('title','Monitoring Absensi')
@section('page-heading','Monitoring Absensi')
@section('content')
<h1>Monitoring Absensi</h1><p class="guru-intro">Pantau catatan kehadiran siswa bimbingan.</p>
<form class="guru-form" method="GET"><input type="date" name="tanggal" value="{{ request('tanggal') }}"><select name="status"><option value="">Semua status</option>@foreach(['hadir','izin','sakit','alpha','terlambat'] as $status)<option value="{{ $status }}" @selected(request('status')===$status)>{{ ucfirst($status) }}</option>@endforeach</select><button class="guru-btn">Terapkan filter</button><a class="guru-btn" style="background:#e8edf7;color:#17357f" href="{{ route('guru.absensi.index') }}">Reset</a></form>
<div class="guru-panel"><div class="guru-table-wrap"><table><thead><tr><th>Tanggal</th><th>Nama Siswa</th><th>Status</th><th>Keterangan</th></tr></thead><tbody>@forelse($absensis as $absensi)<tr><td>{{ $absensi->tanggal?->format('d M Y') }}</td><td>{{ $absensi->siswa->nama_lengkap ?? '-' }}</td><td>{{ ucfirst($absensi->status) }}</td><td>{{ $absensi->keterangan ?: '-' }}</td></tr>@empty<tr><td colspan="4" class="guru-muted">Belum ada catatan absensi untuk filter ini.</td></tr>@endforelse</tbody></table></div><div class="guru-pagination">{{ $absensis->links() }}</div></div>
@endsection