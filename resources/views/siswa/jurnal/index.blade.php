@extends('layouts.siswa')
@section('title','Jurnal Harian')
@section('page-heading','Jurnal Harian')
@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap"><div><h1>Jurnal Harian</h1><p class="s-intro" style="margin-bottom:0">Catat pekerjaan dan pengalaman PKL setiap hari.</p></div><a class="s-btn" href="{{ route('siswa.jurnal.create') }}">+ Tambah Jurnal</a></div>
<div class="s-panel"><div class="s-table-wrap"><table><thead><tr><th>Tanggal</th><th>Judul</th><th>Kegiatan</th><th>Foto</th><th>Aksi</th></tr></thead><tbody>
@forelse($jurnals as $jurnal)<tr><td>{{ $jurnal->tanggal?->format('d/m/Y') }}</td><td>{{ $jurnal->judul }}</td><td style="min-width:220px">{{ \Illuminate\Support\Str::limit($jurnal->kegiatan,120) }}</td><td>@if($jurnal->image)<a href="{{ asset('storage/'.$jurnal->image) }}" target="_blank" rel="noopener">Lihat foto</a>@else<span class="s-muted">-</span>@endif</td><td><div class="s-actions"><a class="s-btn secondary" href="{{ route('siswa.jurnal.edit',$jurnal) }}">Edit</a><form method="POST" action="{{ route('siswa.jurnal.destroy',$jurnal) }}" onsubmit="return confirm('Hapus jurnal ini?')">@csrf @method('DELETE')<button class="s-btn danger" type="submit">Hapus</button></form></div></td></tr>
@empty<tr><td colspan="5" class="s-muted">Belum ada jurnal. Klik “Tambah Jurnal” untuk mulai mencatat kegiatan PKL.</td></tr>@endforelse
</tbody></table></div><div class="s-pagination">{{ $jurnals->links() }}</div></div>
@endsection
