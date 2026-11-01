@extends('layouts.admin')
@section('title','Detail Jurnal')
@section('page-heading','Detail Jurnal Harian')
@section('content')
<a class="admin-logout" href="{{ route('admin.jurnal.index') }}">← Kembali ke jurnal</a>
<h1 style="margin-top:20px">{{ $jurnal->judul }}</h1>
<p class="admin-intro">Detail jurnal kegiatan PKL siswa.</p>
<div class="admin-section">
    <table style="width:100%;border-collapse:collapse;font-size:13px"><tbody>
        <tr><th style="text-align:left;padding:12px">Nama siswa</th><td style="padding:12px">{{ $jurnal->siswa?->nama_lengkap ?? '-' }}</td><th style="text-align:left;padding:12px">Tanggal</th><td style="padding:12px">{{ $jurnal->tanggal?->format('d M Y') ?? '-' }}</td></tr>
        <tr><th style="text-align:left;padding:12px">Sekolah</th><td style="padding:12px">{{ $jurnal->siswa?->sekolah?->nama_sekolah ?? '-' }}</td><th style="text-align:left;padding:12px">Kelas / Jurusan</th><td style="padding:12px">{{ $jurnal->siswa?->kelas?->nama_kelas ?? '-' }} / {{ $jurnal->siswa?->jurusan?->nama_jurusan ?? '-' }}</td></tr>
    </tbody></table>
    <h2 style="margin-top:24px">Deskripsi Kegiatan</h2><p style="font-size:13px;line-height:1.8;white-space:pre-line">{{ $jurnal->kegiatan }}</p>
    <h2 style="margin-top:24px">Keterangan</h2><p style="font-size:13px;line-height:1.8;white-space:pre-line">{{ $jurnal->keterangan ?: 'Tidak ada keterangan tambahan.' }}</p>
    @if($jurnal->image)<h2 style="margin-top:24px">Foto Dokumentasi</h2><img src="{{ asset('storage/'.$jurnal->image) }}" alt="Dokumentasi jurnal" style="max-width:100%;max-height:520px;object-fit:contain;border-radius:12px">@endif
</div>
@endsection
