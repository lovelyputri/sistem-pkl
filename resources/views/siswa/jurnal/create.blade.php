@extends('layouts.siswa')
@section('title','Tambah Jurnal')
@section('page-heading','Tambah Jurnal')
@section('content')
<h1>Tambah Jurnal Harian</h1><p class="s-intro">Isi kegiatan PKL dengan jelas dan unggah foto dokumentasi bila ada (maksimal 2 MB).</p>
<div class="s-panel" style="margin-top:0"><form method="POST" action="{{ route('siswa.jurnal.store') }}" enctype="multipart/form-data" class="s-form">@csrf
<div class="s-field"><label for="judul">Judul kegiatan *</label><input id="judul" name="judul" required maxlength="255" value="{{ old('judul') }}" placeholder="Contoh: Membuat halaman login"></div>
<div class="s-field"><label for="tanggal">Tanggal kegiatan *</label><input id="tanggal" type="date" name="tanggal" required max="{{ today()->toDateString() }}" value="{{ old('tanggal',today()->toDateString()) }}"></div>
<div class="s-field s-full"><label for="kegiatan">Uraian kegiatan *</label><textarea id="kegiatan" name="kegiatan" required maxlength="10000" placeholder="Jelaskan pekerjaan yang dilakukan, proses, dan hasilnya...">{{ old('kegiatan') }}</textarea></div>
<div class="s-field s-full"><label for="keterangan">Kendala / keterangan</label><textarea id="keterangan" name="keterangan" maxlength="5000" placeholder="Opsional">{{ old('keterangan') }}</textarea></div>
<div class="s-field s-full"><label for="image">Foto dokumentasi (opsional)</label><input id="image" type="file" name="image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"><span class="s-muted">Format JPG, PNG, atau WEBP; maksimal 2 MB.</span></div>
<div class="s-full s-actions"><button class="s-btn" type="submit">Simpan Jurnal</button><a class="s-btn secondary" href="{{ route('siswa.jurnal.index') }}">Batal</a></div>
</form></div>
@endsection
