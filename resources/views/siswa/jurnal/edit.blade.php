@extends('layouts.siswa')
@section('title','Edit Jurnal')
@section('page-heading','Edit Jurnal')
@section('content')
<h1>Edit Jurnal Harian</h1><p class="s-intro">Perbarui catatan kegiatan PKL milikmu.</p>
<div class="s-panel" style="margin-top:0"><form method="POST" action="{{ route('siswa.jurnal.update',$jurnal) }}" enctype="multipart/form-data" class="s-form">@csrf @method('PUT')
<div class="s-field"><label for="judul">Judul kegiatan *</label><input id="judul" name="judul" required maxlength="255" value="{{ old('judul',$jurnal->judul) }}"></div>
<div class="s-field"><label for="tanggal">Tanggal kegiatan *</label><input id="tanggal" type="date" name="tanggal" required max="{{ today()->toDateString() }}" value="{{ old('tanggal',$jurnal->tanggal?->toDateString()) }}"></div>
<div class="s-field s-full"><label for="kegiatan">Uraian kegiatan *</label><textarea id="kegiatan" name="kegiatan" required maxlength="10000">{{ old('kegiatan',$jurnal->kegiatan) }}</textarea></div>
<div class="s-field s-full"><label for="keterangan">Kendala / keterangan</label><textarea id="keterangan" name="keterangan" maxlength="5000">{{ old('keterangan',$jurnal->keterangan) }}</textarea></div>
<div class="s-field s-full"><label for="image">Ganti foto dokumentasi (opsional)</label>@if($jurnal->image)<img class="s-photo" src="{{ asset('storage/'.$jurnal->image) }}" alt="Foto jurnal saat ini">@endif<input id="image" type="file" name="image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"><span class="s-muted">Biarkan kosong jika foto tidak ingin diganti. Maksimal 2 MB.</span></div>
<div class="s-full s-actions"><button class="s-btn" type="submit">Simpan Perubahan</button><a class="s-btn secondary" href="{{ route('siswa.jurnal.index') }}">Batal</a></div>
</form></div>
@endsection
