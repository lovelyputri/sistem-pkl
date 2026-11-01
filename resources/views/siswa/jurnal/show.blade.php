@extends('layouts.siswa')
@section('title','Detail Jurnal')
@section('page-heading','Detail Jurnal')
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap"><div><h1>{{ $jurnal->judul }}</h1><p class="siswa-intro">{{ $jurnal->tanggal?->format('d F Y') }}</p></div><a class="siswa-btn secondary" href="{{ route('siswa.jurnal.index') }}">← Kembali</a></div>
<div class="siswa-panel">
@if($jurnal->image)<img src="{{ asset('storage/'.$jurnal->image) }}" alt="Dokumentasi {{ $jurnal->judul }}" style="display:block;width:100%;max-width:680px;max-height:420px;object-fit:contain;background:#f8fafc;border-radius:12px;margin-bottom:20px">@endif
<h2>Deskripsi Kegiatan</h2><p style="font-size:13px;line-height:1.8;color:#334155;white-space:pre-line">{{ $jurnal->kegiatan }}</p>
<h2 style="margin-top:22px">Keterangan</h2><p class="siswa-muted" style="white-space:pre-line">{{ $jurnal->keterangan ?: 'Tidak ada keterangan tambahan.' }}</p>
<div class="siswa-actions"><a class="siswa-btn secondary" href="{{ route('siswa.jurnal.edit',$jurnal) }}">Edit Jurnal</a><form method="POST" action="{{ route('siswa.jurnal.destroy',$jurnal) }}" onsubmit="return confirm('Yakin ingin menghapus jurnal ini?')">@csrf @method('DELETE')<button class="siswa-btn danger">Hapus</button></form></div>
</div>
@endsection
