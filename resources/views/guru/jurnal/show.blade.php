@extends('layouts.guru')
@section('title','Detail Jurnal')
@section('page-heading','Detail Jurnal Siswa')
@section('content')
<a class="guru-btn" href="{{ route('guru.jurnal.index') }}" style="margin-bottom:18px">← Kembali ke jurnal</a>
<h1>{{ $jurnal->judul }}</h1>
<p class="guru-intro">Jurnal kegiatan PKL yang dikirim oleh siswa.</p>
<div class="guru-panel">
    <div class="guru-table-wrap"><table><tbody>
        <tr><th>Nama siswa</th><td>{{ $jurnal->siswa?->nama_lengkap ?? '-' }}</td><th>Tanggal</th><td>{{ $jurnal->tanggal?->format('d M Y') ?? '-' }}</td></tr>
        <tr><th>Sekolah</th><td>{{ $jurnal->siswa?->sekolah?->nama_sekolah ?? '-' }}</td><th>Kelas / Jurusan</th><td>{{ $jurnal->siswa?->kelas?->nama_kelas ?? '-' }} / {{ $jurnal->siswa?->jurusan?->nama_jurusan ?? '-' }}</td></tr>
    </tbody></table></div>
    <h2 style="margin-top:22px">Deskripsi Kegiatan</h2>
    <p style="font-size:13px;line-height:1.8;white-space:pre-line">{{ $jurnal->kegiatan }}</p>
    <h2 style="margin-top:22px">Keterangan Tambahan</h2>
    <p style="font-size:13px;line-height:1.8;white-space:pre-line">{{ $jurnal->keterangan ?: 'Tidak ada keterangan tambahan.' }}</p>
    @if($jurnal->image)
        <h2 style="margin-top:22px">Dokumentasi Kegiatan</h2>
        <img src="{{ asset('storage/'.$jurnal->image) }}" alt="Dokumentasi {{ $jurnal->judul }}" style="display:block;max-width:100%;max-height:520px;object-fit:contain;border-radius:12px">
    @endif
</div>
@endsection
