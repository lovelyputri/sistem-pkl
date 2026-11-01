@extends('layouts.siswa')
@section('title','Tulis Jurnal')
@section('page-heading','Tulis Jurnal Harian')
@section('content')
<h1>Tulis Jurnal Harian</h1><p class="siswa-intro">Isi kegiatan PKL sesuai aktivitas yang benar-benar kamu lakukan.</p>
<div class="siswa-panel"><form method="POST" action="{{ route('siswa.jurnal.store') }}" enctype="multipart/form-data" class="siswa-form">@csrf
<div class="siswa-grid-2"><div class="siswa-field"><label for="tanggal">Tanggal kegiatan *</label><input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal',today()->toDateString()) }}" max="{{ today()->toDateString() }}" required></div><div class="siswa-field"><label for="judul">Judul kegiatan *</label><input id="judul" name="judul" type="text" maxlength="255" value="{{ old('judul') }}" placeholder="Contoh: Membuat halaman login" required></div></div>
<div class="siswa-field"><label for="kegiatan">Deskripsi kegiatan * (minimal 200 karakter)</label><textarea id="kegiatan" name="kegiatan" minlength="200" maxlength="10000" required placeholder="Jelaskan pekerjaan yang dilakukan, prosesnya, dan hasilnya minimal 200 karakter...">{{ old('kegiatan') }}</textarea></div>
<div class="siswa-field"><label for="keterangan">Keterangan tambahan</label><textarea id="keterangan" name="keterangan" maxlength="2000" placeholder="Kendala atau hal yang dipelajari (opsional)">{{ old('keterangan') }}</textarea></div>
<div class="siswa-grid-2" style="align-items:start"><div class="siswa-field"><label for="image">Foto dokumentasi *</label><input id="image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" required><small>JPG, PNG, atau WEBP. Maksimal 4 MB.</small><img id="image-preview" alt="Pratinjau foto kegiatan" style="display:none;width:100%;max-height:220px;object-fit:cover;border-radius:10px;margin-top:10px"></div><div class="siswa-field"><label>Pratinjau gambar</label><div style="min-height:150px;border:1px dashed #cbd5e1;border-radius:10px;display:grid;place-items:center;color:#94a3b8;font-size:12px" id="image-placeholder">Gambar akan muncul di sini</div></div></div>
<div class="siswa-actions"><a class="siswa-btn secondary" href="{{ route('siswa.jurnal.index') }}">Batal</a><button class="siswa-btn" type="submit">Simpan Jurnal</button></div>
</form></div>
@endsection
@push('scripts')
<script>document.getElementById('image')?.addEventListener('change',function(e){const file=e.target.files?.[0],img=document.getElementById('image-preview'),placeholder=document.getElementById('image-placeholder');if(!file){img.style.display='none';placeholder.style.display='grid';return;}img.src=URL.createObjectURL(file);img.style.display='block';placeholder.style.display='none';});</script>
@endpush
