@extends('layouts.guru')
@section('title', 'Detail Pengajuan Izin')
@section('page-heading', 'Detail Pengajuan Izin')
@section('content')
<h1>Detail Pengajuan Izin</h1>
<p class="guru-intro">Periksa identitas siswa, alasan, dan dokumen pendukung sebelum menentukan keputusan.</p>
@if(session('success'))<div style="padding:12px 14px;background:#ecfdf5;color:#047857;border-radius:9px;margin-bottom:16px;font-size:13px">{{ session('success') }}</div>@endif
@if(session('error'))<div style="padding:12px 14px;background:#fff1f2;color:#be123c;border-radius:9px;margin-bottom:16px;font-size:13px">{{ session('error') }}</div>@endif
<div class="guru-panel">
    <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;align-items:center"><h2 style="margin:0">Informasi Pengajuan</h2><strong>{{ $izin->status }}</strong></div>
    <div class="guru-table-wrap" style="margin-top:14px"><table><tbody>
        <tr><th>Nama Siswa</th><td>{{ $izin->siswa->nama_lengkap }}</td></tr>
        <tr><th>Sekolah</th><td>{{ $izin->siswa->sekolah->nama_sekolah ?? '-' }}</td></tr>
        <tr><th>Jurusan</th><td>{{ $izin->siswa->jurusan->nama_jurusan ?? '-' }}</td></tr>
        <tr><th>Periode Izin</th><td>{{ $izin->tanggal_mulai->format('d M Y') }} – {{ $izin->tanggal_selesai->format('d M Y') }}</td></tr>
        <tr><th>Jenis Izin</th><td>{{ $izin->jenis_izin }}</td></tr>
        <tr><th>Alasan</th><td style="white-space:normal">{{ $izin->alasan }}</td></tr>
        <tr><th>Dokumen</th><td><a class="guru-btn" target="_blank" href="{{ route('guru.izin.surat', $izin) }}">Buka Surat / Bukti</a></td></tr>
    </tbody></table></div>
</div>
@if($izin->status === 'Menunggu')
<div class="guru-panel">
    <h2>Keputusan Guru Pembimbing</h2>
    <form method="POST" action="{{ route('guru.izin.update', $izin) }}" style="display:grid;gap:14px">
        @csrf @method('PATCH')
        <label style="font-size:12px;font-weight:600">Catatan untuk Siswa<textarea name="catatan_guru" rows="3" maxlength="1000" style="display:block;width:100%;margin-top:7px;padding:11px;border:1px solid #d7deea;border-radius:8px;font:inherit" placeholder="Opsional, terutama jika pengajuan ditolak...">{{ old('catatan_guru') }}</textarea></label>
        <div style="display:flex;gap:9px;flex-wrap:wrap">
            <button class="guru-btn" name="keputusan" value="Disetujui" onclick="return confirm('Setujui pengajuan izin ini?')">Setujui Izin</button>
            <button class="guru-btn" style="background:#be123c" name="keputusan" value="Ditolak" onclick="return confirm('Tolak pengajuan izin ini?')">Tolak Izin</button>
            <a class="guru-btn" style="background:#e8edf7;color:#17357f" href="{{ route('guru.izin.index') }}">Kembali</a>
        </div>
    </form>
</div>
@else
<div class="guru-panel"><h2>Catatan Keputusan</h2><p class="guru-muted">{{ $izin->catatan_guru ?: 'Tidak ada catatan tambahan.' }}</p><a class="guru-btn" style="margin-top:14px" href="{{ route('guru.izin.index') }}">Kembali ke Daftar</a></div>
@endif
@endsection
