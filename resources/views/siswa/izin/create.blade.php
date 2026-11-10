@extends('layouts.siswa')
@section('title', 'Ajukan Izin')
@section('page-heading', 'Ajukan Izin')
@section('content')
<h1>Form Pengajuan Izin</h1>
<p class="siswa-intro">Lengkapi informasi izin dan unggah surat atau bukti pendukung untuk diperiksa Guru Pembimbing.</p>
<div class="siswa-panel" style="max-width:760px">
@if ($errors->any())
    <div role="alert" style="margin-bottom:16px;padding:13px 15px;border:1px solid #fecaca;border-radius:9px;background:#fef2f2;color:#991b1b;font-size:13px">
        <strong>Pengajuan belum berhasil dikirim.</strong>
        <ul style="margin:8px 0 0;padding-left:20px">
            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
@endif
@if (session('error'))
    <div role="alert" style="margin-bottom:16px;padding:13px 15px;border:1px solid #fecaca;border-radius:9px;background:#fef2f2;color:#991b1b;font-size:13px">{{ session('error') }}</div>
@endif
<form method="POST" action="{{ route('siswa.izin.store') }}" enctype="multipart/form-data" class="siswa-form">
    @csrf
    <div class="siswa-grid-2">
        <div class="siswa-field"><label for="tanggal_mulai">Tanggal Mulai Izin</label><input type="date" id="tanggal_mulai" name="tanggal_mulai" min="{{ today()->toDateString() }}" value="{{ old('tanggal_mulai') }}" required></div>
        <div class="siswa-field"><label for="tanggal_selesai">Tanggal Selesai Izin</label><input type="date" id="tanggal_selesai" name="tanggal_selesai" min="{{ today()->toDateString() }}" value="{{ old('tanggal_selesai') }}" required></div>
    </div>
    <div class="siswa-field"><label for="jenis_izin">Jenis Izin</label><select id="jenis_izin" name="jenis_izin" required><option value="">Pilih jenis izin</option><option value="Sakit" @selected(old('jenis_izin')==='Sakit')>Sakit</option><option value="Keperluan Lain" @selected(old('jenis_izin')==='Keperluan Lain')>Keperluan Lain</option></select></div>
    <div class="siswa-field"><label for="alasan">Alasan Izin</label><textarea id="alasan" name="alasan" maxlength="1500" required placeholder="Jelaskan alasan pengajuan izin...">{{ old('alasan') }}</textarea></div>
    <div class="siswa-field"><label for="surat">Surat / Bukti Pendukung</label><input type="file" id="surat" name="surat" accept=".pdf,.jpg,.jpeg,.png" required><small>Format PDF, JPG, JPEG, atau PNG. Maksimal 5 MB.</small></div>
    <div style="display:flex;justify-content:flex-end;gap:9px;flex-wrap:wrap"><a href="{{ route('siswa.izin.index') }}" class="siswa-btn secondary">Kembali</a><button type="submit" class="siswa-btn">Kirim Pengajuan</button></div>
</form>
</div>
@endsection
