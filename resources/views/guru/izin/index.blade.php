@extends('layouts.guru')
@section('title', 'Persetujuan Izin')
@section('page-heading', 'Persetujuan Izin')
@section('content')
<h1>Persetujuan Izin</h1>
<p class="guru-intro">Periksa pengajuan izin dari siswa bimbingan dan berikan keputusan.</p>
<div class="guru-stats" style="margin-bottom:20px">
    <div class="guru-card"><div class="guru-stat-label">Menunggu Persetujuan</div><div class="guru-stat-value">{{ $jumlahMenunggu }}</div></div>
    <div class="guru-card"><div class="guru-stat-label">Total Ditampilkan</div><div class="guru-stat-value">{{ $pengajuans->total() }}</div></div>
    <div class="guru-card"><div class="guru-stat-label">Peran</div><div class="guru-stat-value" style="font-size:18px">Guru Pembimbing</div></div>
</div>
<form method="GET" class="guru-form"><select name="status"><option value="">Semua status</option>@foreach(['Menunggu','Disetujui','Ditolak'] as $status)<option value="{{ $status }}" @selected(request('status')===$status)>{{ $status }}</option>@endforeach</select><button class="guru-btn">Filter</button><a class="guru-btn" style="background:#e8edf7;color:#17357f" href="{{ route('guru.izin.index') }}">Reset</a></form>
<div class="guru-panel"><div class="guru-table-wrap"><table>
<thead><tr><th>Nama Siswa</th><th>Tanggal Izin</th><th>Jenis</th><th>Status</th><th>Diajukan</th><th>Aksi</th></tr></thead>
<tbody>
@forelse($pengajuans as $izin)
<tr><td>{{ $izin->siswa->nama_lengkap ?? '-' }}</td><td>{{ $izin->tanggal_mulai->format('d M Y') }} – {{ $izin->tanggal_selesai->format('d M Y') }}</td><td>{{ $izin->jenis_izin }}</td><td><span style="display:inline-block;padding:5px 9px;border-radius:20px;font-size:11px;font-weight:700;background:{{ $izin->status==='Disetujui'?'#dcfce7':($izin->status==='Ditolak'?'#fff1f2':'#eff6ff') }};color:{{ $izin->status==='Disetujui'?'#166534':($izin->status==='Ditolak'?'#be123c':'#1d4ed8') }}">{{ $izin->status }}</span></td><td>{{ $izin->created_at->format('d M Y') }}</td><td><a class="guru-btn" href="{{ route('guru.izin.show', $izin) }}">Periksa Pengajuan</a></td></tr>
@empty<tr><td colspan="6" class="guru-muted" style="text-align:center;padding:24px">Belum ada pengajuan izin dari siswa bimbingan.</td></tr>@endforelse
</tbody></table></div><div class="guru-pagination">{{ $pengajuans->links() }}</div></div>
@endsection
