@extends('layouts.admin')
@section('title', 'Sekolah & Jurusan')
@section('page-heading', 'Sekolah & Jurusan')
@push('styles')
<style>
.sj-head{display:flex;justify-content:space-between;align-items:flex-start;gap:12px;flex-wrap:wrap;margin-bottom:22px}
.sj-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.sj-panel{background:#fff;border:1px solid #e4e9f2;border-radius:12px;padding:20px;min-width:0}
.sj-panel h2{font-size:16px;margin:0 0 6px}.sj-muted{font-size:12px;color:#64748b;line-height:1.6;margin:0 0 17px}
.sj-form{display:grid;gap:10px;margin-bottom:20px}.sj-input{width:100%;padding:10px 11px;border:1px solid #d7deea;border-radius:8px;font:inherit;font-size:12px;background:#fff}
.sj-btn{display:inline-flex;justify-content:center;align-items:center;border:0;border-radius:8px;padding:10px 13px;font:inherit;font-size:12px;font-weight:600;cursor:pointer}
.sj-primary{background:#17357f;color:#fff}.sj-light{background:#fff;color:#334155;border:1px solid #d7deea}.sj-danger{background:#fff1f2;color:#9f1239}
.sj-table-wrap{overflow-x:auto}.sj-table{width:100%;border-collapse:collapse;min-width:350px}.sj-table th{text-align:left;background:#f8fafc;color:#64748b;font-size:10px;text-transform:uppercase;letter-spacing:.4px;padding:10px}.sj-table td{padding:11px 10px;border-bottom:1px solid #edf0f5;font-size:12px;vertical-align:top}.sj-inline-edit{display:none;background:#f8fafc;padding:12px;border-radius:8px;margin-top:8px}.sj-inline-edit.open{display:block}.sj-actions{display:flex;gap:6px;flex-wrap:wrap}.sj-count{display:inline-block;padding:4px 7px;border-radius:6px;background:#eff6ff;color:#1d4ed8;font-size:10px;white-space:nowrap}
@media(max-width:850px){.sj-grid{grid-template-columns:1fr}.sj-panel{padding:15px}}
</style>
@endpush
@section('content')
<div class="sj-head"><div><h1>Data Sekolah & Jurusan</h1><p class="admin-intro" style="margin-bottom:0">Kelola daftar sekolah dan program keahlian yang digunakan dalam data siswa dan guru.</p></div></div>
@if(session('success'))<div style="padding:12px 14px;background:#ecfdf5;color:#166534;border-radius:9px;margin-bottom:14px;font-size:13px">{{ session('success') }}</div>@endif
@if(session('error'))<div style="padding:12px 14px;background:#fff1f2;color:#9f1239;border-radius:9px;margin-bottom:14px;font-size:13px">{{ session('error') }}</div>@endif
@if($errors->any())<div style="padding:12px 14px;background:#fff1f2;color:#9f1239;border-radius:9px;margin-bottom:14px;font-size:12px"><strong>Data belum tersimpan:</strong><ul style="margin-bottom:0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="sj-grid">
<section class="sj-panel" id="panel-sekolah">
<h2>Data Sekolah</h2><p class="sj-muted">Nama dan alamat sekolah. Sekolah yang masih digunakan siswa atau guru tidak dapat dihapus.</p>
<form class="sj-form" method="POST" action="{{ route('admin.sekolah-jurusan.sekolah.store') }}">@csrf
<input class="sj-input" name="nama_sekolah" placeholder="Nama sekolah" value="{{ old('nama_sekolah') }}" required maxlength="255">
<textarea class="sj-input" name="alamat" placeholder="Alamat sekolah (opsional)" rows="2">{{ old('alamat') }}</textarea>
<button class="sj-btn sj-primary" type="submit">+ Tambah Sekolah</button>
</form>
<form method="GET" action="{{ route('admin.sekolah-jurusan.index') }}" style="display:flex;gap:7px;margin-bottom:12px"><input type="hidden" name="bagian" value="sekolah"><input class="sj-input" name="cari_sekolah" placeholder="Cari sekolah..." value="{{ $cariSekolah }}"><button class="sj-btn sj-light">Cari</button></form>
<div class="sj-table-wrap"><table class="sj-table"><thead><tr><th>Sekolah</th><th>Siswa</th><th>Aksi</th></tr></thead><tbody>
@forelse($sekolahs as $sekolah)
<tr><td><strong>{{ $sekolah->nama_sekolah }}</strong><div style="color:#64748b;margin-top:5px;white-space:pre-line">{{ $sekolah->alamat ?: 'Alamat belum diisi' }}</div><form id="edit-sekolah-{{ $sekolah->id }}" class="sj-inline-edit" method="POST" action="{{ route('admin.sekolah-jurusan.sekolah.update',$sekolah) }}">@csrf @method('PUT')<input class="sj-input" name="nama_sekolah" value="{{ $sekolah->nama_sekolah }}" required><textarea class="sj-input" name="alamat" rows="2" placeholder="Alamat">{{ $sekolah->alamat }}</textarea><button class="sj-btn sj-primary" type="submit">Simpan</button></form></td><td><span class="sj-count">{{ $sekolah->siswas_count }} siswa</span></td><td><div class="sj-actions"><button type="button" class="sj-btn sj-light" onclick="toggleEdit('edit-sekolah-{{ $sekolah->id }}')">Edit</button><form method="POST" action="{{ route('admin.sekolah-jurusan.sekolah.destroy',$sekolah) }}" onsubmit="return confirm('Hapus sekolah ini?')">@csrf @method('DELETE')<button class="sj-btn sj-danger" type="submit">Hapus</button></form></div></td></tr>
@empty<tr><td colspan="3" style="text-align:center;color:#64748b;padding:22px">Belum ada data sekolah.</td></tr>@endforelse
</tbody></table></div><div style="margin-top:14px">{{ $sekolahs->links() }}</div>
</section>
<section class="sj-panel" id="panel-jurusan">
<h2>Data Jurusan</h2><p class="sj-muted">Kelola nama jurusan/program keahlian yang digunakan saat pendaftaran dan pengelolaan siswa.</p>
<form class="sj-form" method="POST" action="{{ route('admin.sekolah-jurusan.jurusan.store') }}">@csrf
<input class="sj-input" name="nama_jurusan" placeholder="Nama jurusan, contoh: Rekayasa Perangkat Lunak" value="{{ old('nama_jurusan') }}" required maxlength="255">
<button class="sj-btn sj-primary" type="submit">+ Tambah Jurusan</button>
</form>
<form method="GET" action="{{ route('admin.sekolah-jurusan.index') }}" style="display:flex;gap:7px;margin-bottom:12px"><input type="hidden" name="bagian" value="jurusan"><input class="sj-input" name="cari_jurusan" placeholder="Cari jurusan..." value="{{ $cariJurusan }}"><button class="sj-btn sj-light">Cari</button></form>
<div class="sj-table-wrap"><table class="sj-table"><thead><tr><th>Nama Jurusan</th><th>Siswa</th><th>Aksi</th></tr></thead><tbody>
@forelse($jurusans as $jurusan)
<tr><td><strong>{{ $jurusan->nama_jurusan }}</strong><form id="edit-jurusan-{{ $jurusan->id }}" class="sj-inline-edit" method="POST" action="{{ route('admin.sekolah-jurusan.jurusan.update',$jurusan) }}">@csrf @method('PUT')<input class="sj-input" name="nama_jurusan" value="{{ $jurusan->nama_jurusan }}" required><button class="sj-btn sj-primary" type="submit">Simpan</button></form></td><td><span class="sj-count">{{ $jurusan->siswas_count }} siswa</span></td><td><div class="sj-actions"><button type="button" class="sj-btn sj-light" onclick="toggleEdit('edit-jurusan-{{ $jurusan->id }}')">Edit</button><form method="POST" action="{{ route('admin.sekolah-jurusan.jurusan.destroy',$jurusan) }}" onsubmit="return confirm('Hapus jurusan ini?')">@csrf @method('DELETE')<button class="sj-btn sj-danger" type="submit">Hapus</button></form></div></td></tr>
@empty<tr><td colspan="3" style="text-align:center;color:#64748b;padding:22px">Belum ada data jurusan.</td></tr>@endforelse
</tbody></table></div><div style="margin-top:14px">{{ $jurusans->links() }}</div>
</section>
</div>
@endsection
@push('scripts')
<script>
function toggleEdit(id){const el=document.getElementById(id);if(el)el.classList.toggle('open');}
</script>
@endpush
