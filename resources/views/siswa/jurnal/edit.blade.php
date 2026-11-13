@extends('layouts.siswa')
@section('title','Edit Jurnal')
@section('page-heading','Edit Jurnal')
@section('content')
<h1>Edit Jurnal</h1><p class="siswa-intro">Perbarui catatan kegiatan PKL kamu.</p>
<div class="siswa-panel"><form method="POST" action="{{ route('siswa.jurnal.update',$jurnal) }}" enctype="multipart/form-data" class="siswa-form">@csrf @method('PUT')
<div class="siswa-grid-2"><div class="siswa-field"><label for="tanggal">Tanggal kegiatan *</label><input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal',$jurnal->tanggal?->toDateString()) }}" max="{{ today()->toDateString() }}" required></div><div class="siswa-field"><label for="judul">Judul kegiatan *</label><input id="judul" name="judul" type="text" maxlength="255" value="{{ old('judul',$jurnal->judul) }}" required></div></div>
<div class="siswa-field"><label for="kegiatan">Deskripsi kegiatan *</label><textarea id="kegiatan" name="kegiatan" minlength="200" maxlength="10000" required>{{ old('kegiatan',$jurnal->kegiatan) }}</textarea><small>Deskripsi kegiatan minimal 200 karakter.</small></div>
@if($jurnal->image)<div><p class="siswa-muted">Foto saat ini:</p><img src="{{ asset('storage/'.$jurnal->image) }}" alt="Foto jurnal" style="width:160px;height:120px;object-fit:cover;border-radius:9px"></div>@endif
<div class="siswa-field"><label for="image">Ganti foto dokumentasi</label><input id="image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"><small>Kosongkan jika foto tidak ingin diganti. Maksimal 4 MB.</small></div>
<div class="siswa-actions"><a class="siswa-btn secondary" href="{{ route('siswa.jurnal.show',$jurnal) }}">Batal</a><button class="siswa-btn">Simpan Perubahan</button></div>
</form></div>
@endsection
