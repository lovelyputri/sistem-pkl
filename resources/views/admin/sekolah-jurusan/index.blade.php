@extends('layouts.admin')
@section('title', 'Sekolah & Jurusan')
@section('page-heading', 'Sekolah & Jurusan')

@push('styles')
<style>
.sj-page{max-width:1450px;margin:0 auto;padding-bottom:24px;color:#142b55}
.sj-hero{position:relative;display:flex;align-items:center;justify-content:space-between;gap:20px;min-height:142px;padding:25px 30px;margin-bottom:20px;overflow:hidden;border-radius:18px;background:linear-gradient(110deg,#f5f8ff 0%,#eaf0ff 62%,#dce7ff 100%);isolation:isolate}
.sj-hero:before{content:"";position:absolute;z-index:-1;right:8%;top:-130px;width:330px;height:330px;border:1px solid #c9d8fa;border-radius:50%;box-shadow:0 0 0 28px #dce6fb55,0 0 0 58px #dce6fb44}
.sj-hero-copy{max-width:700px}.sj-eyebrow{display:inline-flex;align-items:center;gap:7px;margin-bottom:8px;color:#4169b7;font-size:10px;font-weight:800;letter-spacing:1.3px;text-transform:uppercase}.sj-eyebrow:before{content:"";width:20px;height:2px;border-radius:3px;background:#4774d5}
.sj-hero h1{margin:0;color:#112957;font-size:clamp(22px,2vw,29px);font-weight:800;letter-spacing:-.7px}.sj-hero p{margin:7px 0 0;color:#6b80aa;font-size:12px;line-height:1.6}
.sj-hero-art{display:grid;place-items:center;width:92px;height:92px;flex:0 0 92px;border:1px solid #ffffffa8;border-radius:25px;background:#ffffff80;color:#3263c5;box-shadow:0 10px 25px #375b9c12}
.sj-hero-art svg{width:48px;height:48px;fill:none;stroke:currentColor;stroke-width:1.5;stroke-linecap:round;stroke-linejoin:round}
.sj-alert{padding:12px 15px;margin:0 0 15px;border-radius:10px;font-size:12px;line-height:1.55}.sj-alert.success{background:#edfaf3;border:1px solid #c9eed9;color:#17643d}.sj-alert.error{background:#fff2f2;border:1px solid #f2d0d0;color:#9f3030}.sj-alert ul{margin:5px 0 0;padding-left:18px}
.sj-summary{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px;margin-bottom:18px}
.sj-summary-card{display:flex;align-items:center;gap:13px;padding:15px 18px;border:1px solid #e1e9f8;border-radius:14px;background:#fff;box-shadow:0 5px 16px #233e7010}
.sj-summary-icon{display:grid;place-items:center;width:43px;height:43px;flex:0 0 43px;border-radius:13px;background:#edf2ff;color:#3264cb}.sj-summary-icon svg{width:22px;height:22px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.sj-summary-label{color:#8291ad;font-size:10px;font-weight:650}.sj-summary-value{margin-top:3px;color:#142b55;font-size:20px;font-weight:800;line-height:1}
.sj-columns{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px;align-items:start}
.sj-card{min-width:0;overflow:hidden;border:1px solid #e2e9f5;border-radius:17px;background:#fff;box-shadow:0 8px 24px #243f7410}
.sj-card-head{display:flex;align-items:center;gap:13px;padding:19px 20px;border-bottom:1px solid #edf1f8;background:linear-gradient(110deg,#fff,#f9fbff)}
.sj-card-icon{display:grid;place-items:center;width:47px;height:47px;flex:0 0 47px;border-radius:14px;background:#eaf0ff;color:#285cc5}.sj-card-icon svg{width:24px;height:24px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.sj-card-head h2{margin:0;color:#142b55;font-size:15px;font-weight:800}.sj-card-head p{margin:4px 0 0;color:#8291ad;font-size:10px;line-height:1.5}
.sj-card-body{padding:18px 20px 20px}
.sj-form-box{padding:15px;margin-bottom:18px;border:1px solid #e6edfa;border-radius:13px;background:#f8faff}
.sj-form-title{display:flex;align-items:center;gap:8px;margin:0 0 12px;color:#27477e;font-size:11px;font-weight:800}.sj-form-title span{display:grid;place-items:center;width:22px;height:22px;border-radius:7px;background:#e4ecff;color:#3264cb;font-size:15px}
.sj-form-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px}.sj-form-grid .wide{grid-column:1/-1}
.sj-field label{display:block;margin:0 0 6px;color:#4d6084;font-size:10px;font-weight:700}
.sj-input{display:block;width:100%;min-height:39px;padding:9px 11px;border:1px solid #dbe4f3;border-radius:9px;background:#fff;color:#1c3156;font:inherit;font-size:11px;transition:.15s}
.sj-input:focus{outline:0;border-color:#6b8de0;box-shadow:0 0 0 3px #4f77d51a}.sj-input::placeholder{color:#9aa8c0}
.sj-input[type=file]{padding:7px;font-size:10px}.sj-field textarea{resize:vertical;min-height:58px}
.sj-btn{display:inline-flex;align-items:center;justify-content:center;gap:7px;min-height:35px;padding:0 12px;border:1px solid transparent;border-radius:8px;font:inherit;font-size:10px;font-weight:750;cursor:pointer;text-decoration:none;transition:.15s}
.sj-btn svg{width:14px;height:14px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.sj-primary{background:#2859c2;color:#fff;box-shadow:0 4px 10px #2859c222}.sj-primary:hover{background:#1e49a8;transform:translateY(-1px)}
.sj-soft{border-color:#dbe5f5;background:#fff;color:#36558c}.sj-soft:hover{border-color:#9bb4e8;background:#f5f8ff}
.sj-delete{border-color:#f4d6da;background:#fff5f6;color:#b33d4b}.sj-delete:hover{background:#ffe9ec}
.sj-form-submit{width:100%;margin-top:11px;min-height:39px}
.sj-list-heading{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:11px}
.sj-list-heading h3{margin:0;color:#233d6b;font-size:12px;font-weight:800}
.sj-total{padding:4px 8px;border-radius:20px;background:#edf3ff;color:#4168b6;font-size:9px;font-weight:750;white-space:nowrap}
.sj-search{display:flex;gap:7px;margin-bottom:11px}.sj-search .sj-input{min-width:0;flex:1}
.sj-list{display:flex;flex-direction:column;gap:9px}
.sj-item{padding:12px;border:1px solid #e9eef7;border-radius:11px;background:#fff;transition:border-color .15s,box-shadow .15s}.sj-item:hover{border-color:#d5e1f8;box-shadow:0 4px 12px #294b8510}
.sj-item-main{display:flex;align-items:flex-start;gap:11px;min-width:0}
.sj-item-logo{display:grid;place-items:center;width:42px;height:42px;flex:0 0 42px;overflow:hidden;border:1px solid #e4eaf5;border-radius:10px;background:#f3f6fc;color:#6680b3}.sj-item-logo img{width:100%;height:100%;object-fit:contain}
.sj-item-symbol{font-size:18px;font-weight:800}
.sj-item-copy{flex:1;min-width:0}.sj-item-copy strong{display:block;color:#203960;font-size:11px;line-height:1.45;overflow-wrap:anywhere}
.sj-item-copy p{margin:4px 0 0;color:#8391aa;font-size:9px;line-height:1.5;overflow-wrap:anywhere}
.sj-item-actions{display:flex;align-items:center;gap:6px;flex-wrap:wrap;margin-top:10px;padding-left:53px}
.sj-student-count{display:inline-flex;align-items:center;gap:5px;margin-left:auto;padding:4px 7px;border-radius:6px;background:#f0f5ff;color:#4767a4;font-size:9px;font-weight:700;white-space:nowrap}
.sj-student-count svg{width:12px;height:12px;fill:none;stroke:currentColor;stroke-width:1.8}
.sj-edit{display:none;margin-top:11px;padding:12px;border-radius:10px;background:#f6f8fd;border:1px dashed #cbd8ef}.sj-edit.open{display:block}.sj-edit .sj-form-grid{margin-bottom:9px}
.sj-empty{padding:25px 12px;border:1px dashed #dce5f3;border-radius:11px;color:#8a98b1;text-align:center;font-size:11px}.sj-empty span{display:block;margin-bottom:7px;color:#a9b9d5;font-size:24px}
.sj-pagination{margin-top:13px}.sj-pagination nav{display:flex;justify-content:center}
@media(max-width:1050px){.sj-columns{grid-template-columns:1fr}.sj-card-body{padding:16px}}
@media(max-width:600px){.sj-hero{min-height:115px;padding:18px}.sj-hero-art{width:65px;height:65px;flex-basis:65px;border-radius:18px}.sj-hero-art svg{width:34px;height:34px}.sj-summary{gap:8px}.sj-summary-card{padding:12px;gap:9px}.sj-summary-icon{width:36px;height:36px;flex-basis:36px}.sj-summary-value{font-size:17px}.sj-card-head{padding:15px}.sj-card-body{padding:13px}.sj-form-box{padding:12px}.sj-form-grid{grid-template-columns:1fr}.sj-form-grid .wide{grid-column:auto}.sj-item-actions{padding-left:0}.sj-student-count{margin-left:0}}

/* Samakan lebar dan padding halaman dengan Dashboard Admin */
.admin-content:has(.sj-page){width:100%!important;max-width:none!important;margin:0!important;padding:22px 24px 30px!important}
.sj-page{width:100%!important;max-width:none!important;margin:0!important;padding:0 0 24px!important;box-sizing:border-box}
.sj-page *{box-sizing:border-box}
@media(max-width:820px){.admin-content:has(.sj-page){padding:17px 15px!important}}
@media(max-width:560px){.admin-content:has(.sj-page){padding:13px 11px 20px!important}}

</style>
@endpush

@section('content')
<div class="sj-page">
    <header class="sj-hero">
        <div class="sj-hero-copy">
            <span class="sj-eyebrow">Data Master · Administrator</span>
            <h1>Data Sekolah & Jurusan</h1>
            <p>Atur identitas sekolah dan program keahlian agar data siswa tersusun rapi dan mudah dikelola.</p>
        </div>
        <div class="sj-hero-art" aria-hidden="true">
            <svg viewBox="0 0 48 48"><path d="M5 19 24 9l19 10-19 10L5 19Z"/><path d="M12 23v10c7 6 17 6 24 0V23M43 20v13"/><path d="M19 27v-5h10v5M20 37v-5h8v5"/></svg>
        </div>
    </header>

    @if(session('success'))<div class="sj-alert success" role="status">✓ &nbsp;{{ session('success') }}</div>@endif
    @if(session('error'))<div class="sj-alert error" role="alert">! &nbsp;{{ session('error') }}</div>@endif
    @if($errors->any())<div class="sj-alert error" role="alert"><strong>Periksa kembali data yang dimasukkan.</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

    <div class="sj-summary">
        <div class="sj-summary-card"><span class="sj-summary-icon"><svg viewBox="0 0 24 24"><path d="m3 9 9-5 9 5-9 5-9-5Z"/><path d="M6 11v6c4 3 8 3 12 0v-6M21 10v7"/></svg></span><div><div class="sj-summary-label">Total Sekolah</div><div class="sj-summary-value">{{ $sekolahs->total() }}</div></div></div>
        <div class="sj-summary-card"><span class="sj-summary-icon"><svg viewBox="0 0 24 24"><path d="M4 5h16v14H4zM8 9h8M8 13h8M8 17h5"/></svg></span><div><div class="sj-summary-label">Total Jurusan</div><div class="sj-summary-value">{{ $jurusans->total() }}</div></div></div>
    </div>

    <div class="sj-columns">
        <section class="sj-card" id="panel-sekolah">
            <div class="sj-card-head"><span class="sj-card-icon"><svg viewBox="0 0 24 24"><path d="m3 9 9-6 9 6v11H3V9Z"/><path d="M8 20v-7h8v7M7 9h.01M12 9h.01M17 9h.01"/></svg></span><div><h2>Data Sekolah</h2><p>Kelola nama, alamat, kontak, dan logo sekolah.</p></div></div>
            <div class="sj-card-body">
                <form class="sj-form-box" method="POST" enctype="multipart/form-data" action="{{ route('admin.sekolah-jurusan.sekolah.store') }}">
                    @csrf
                    <h3 class="sj-form-title"><span>+</span> Tambahkan Sekolah Baru</h3>
                    <div class="sj-form-grid">
                        <div class="sj-field wide"><label for="nama_sekolah">Nama Sekolah *</label><input id="nama_sekolah" class="sj-input" name="nama_sekolah" placeholder="Contoh: SMK Negeri 1" value="{{ old('nama_sekolah') }}" required maxlength="255"></div>
                        <div class="sj-field wide"><label for="alamat">Alamat Sekolah</label><textarea id="alamat" class="sj-input" name="alamat" placeholder="Masukkan alamat sekolah" rows="2">{{ old('alamat') }}</textarea></div>
                        <div class="sj-field"><label for="no_telepon">Nomor Telepon</label><input id="no_telepon" class="sj-input" name="no_telepon" placeholder="08xxxxxxxxxx" value="{{ old('no_telepon') }}" maxlength="30"></div>
                        <div class="sj-field"><label for="email_sekolah">Email Sekolah</label><input id="email_sekolah" class="sj-input" type="email" name="email" placeholder="sekolah@email.com" value="{{ old('email') }}" maxlength="255"></div>
                        <div class="sj-field wide"><label for="logo_sekolah">Logo Sekolah <span style="font-weight:400;color:#8a98b1">(Opsional · Maks. 2 MB)</span></label><input id="logo_sekolah" class="sj-input" type="file" name="logo" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"></div>
                    </div>
                    <button class="sj-btn sj-primary sj-form-submit" type="submit"><svg viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg> Tambah Sekolah</button>
                </form>

                <div class="sj-list-heading"><h3>Daftar Sekolah</h3><span class="sj-total">{{ $sekolahs->total() }} data</span></div>
                <form class="sj-search" method="GET" action="{{ route('admin.sekolah-jurusan.index') }}"><input type="hidden" name="bagian" value="sekolah"><input class="sj-input" name="cari_sekolah" placeholder="Cari nama sekolah..." value="{{ $cariSekolah }}"><button class="sj-btn sj-soft" type="submit">Cari</button></form>
                <div class="sj-list">
                    @forelse($sekolahs as $sekolah)
                        <article class="sj-item">
                            <div class="sj-item-main">
                                <div class="sj-item-logo">@if($sekolah->logo)<img src="{{ asset('storage/'.$sekolah->logo) }}" alt="Logo {{ $sekolah->nama_sekolah }}">@else<span class="sj-item-symbol">{{ strtoupper(substr($sekolah->nama_sekolah,0,1)) }}</span>@endif</div>
                                <div class="sj-item-copy"><strong>{{ $sekolah->nama_sekolah }}</strong><p>{{ $sekolah->alamat ?: 'Alamat belum diisi' }}</p><p>{{ $sekolah->no_telepon ?: 'Telepon belum diisi' }} · {{ $sekolah->email ?: 'Email belum diisi' }}</p></div>
                                <span class="sj-student-count"><svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M10 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM20 8v6m3-3h-6"/></svg>{{ $sekolah->siswas_count }} siswa</span>
                            </div>
                            <div class="sj-item-actions">
                                <button type="button" class="sj-btn sj-soft" onclick="toggleSjEdit('edit-sekolah-{{ $sekolah->id }}')">Edit Data</button>
                                <form method="POST" action="{{ route('admin.sekolah-jurusan.sekolah.destroy',$sekolah) }}" onsubmit="return confirm('Hapus sekolah {{ addslashes($sekolah->nama_sekolah) }}?')">@csrf @method('DELETE')<button class="sj-btn sj-delete" type="submit">Hapus</button></form>
                            </div>
                            <form id="edit-sekolah-{{ $sekolah->id }}" class="sj-edit" enctype="multipart/form-data" method="POST" action="{{ route('admin.sekolah-jurusan.sekolah.update',$sekolah) }}">
                                @csrf @method('PUT')
                                <div class="sj-form-grid">
                                    <div class="sj-field wide"><label>Nama Sekolah *</label><input class="sj-input" name="nama_sekolah" value="{{ $sekolah->nama_sekolah }}" required maxlength="255"></div>
                                    <div class="sj-field wide"><label>Alamat</label><textarea class="sj-input" name="alamat" rows="2">{{ $sekolah->alamat }}</textarea></div>
                                    <div class="sj-field"><label>Nomor Telepon</label><input class="sj-input" name="no_telepon" value="{{ $sekolah->no_telepon }}" maxlength="30"></div>
                                    <div class="sj-field"><label>Email</label><input class="sj-input" type="email" name="email" value="{{ $sekolah->email }}" maxlength="255"></div>
                                    <div class="sj-field wide"><label>Ganti Logo (Opsional)</label><input class="sj-input" type="file" name="logo" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"></div>
                                </div>
                                <button class="sj-btn sj-primary" type="submit">Simpan Perubahan</button>
                            </form>
                        </article>
                    @empty
                        <div class="sj-empty"><span>⌂</span>Belum ada data sekolah. Tambahkan sekolah melalui formulir di atas.</div>
                    @endforelse
                </div>
                <div class="sj-pagination">{{ $sekolahs->links() }}</div>
            </div>
        </section>

        <section class="sj-card" id="panel-jurusan">
            <div class="sj-card-head"><span class="sj-card-icon"><svg viewBox="0 0 24 24"><path d="M4 4h16v16H4zM8 8h8M8 12h8M8 16h5"/></svg></span><div><h2>Data Jurusan</h2><p>Kelola program keahlian yang tersedia untuk siswa.</p></div></div>
            <div class="sj-card-body">
                <form class="sj-form-box" method="POST" action="{{ route('admin.sekolah-jurusan.jurusan.store') }}">
                    @csrf
                    <h3 class="sj-form-title"><span>+</span> Tambahkan Jurusan Baru</h3>
                    <div class="sj-field"><label for="nama_jurusan">Nama Jurusan / Program Keahlian *</label><input id="nama_jurusan" class="sj-input" name="nama_jurusan" placeholder="Contoh: Rekayasa Perangkat Lunak" value="{{ old('nama_jurusan') }}" required maxlength="255"></div>
                    <button class="sj-btn sj-primary sj-form-submit" type="submit"><svg viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg> Tambah Jurusan</button>
                </form>

                <div class="sj-list-heading"><h3>Daftar Jurusan</h3><span class="sj-total">{{ $jurusans->total() }} data</span></div>
                <form class="sj-search" method="GET" action="{{ route('admin.sekolah-jurusan.index') }}"><input type="hidden" name="bagian" value="jurusan"><input class="sj-input" name="cari_jurusan" placeholder="Cari nama jurusan..." value="{{ $cariJurusan }}"><button class="sj-btn sj-soft" type="submit">Cari</button></form>
                <div class="sj-list">
                    @forelse($jurusans as $jurusan)
                        <article class="sj-item">
                            <div class="sj-item-main">
                                <div class="sj-item-logo"><span class="sj-item-symbol">#</span></div>
                                <div class="sj-item-copy"><strong>{{ $jurusan->nama_jurusan }}</strong><p>Program keahlian</p></div>
                                <span class="sj-student-count"><svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M10 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM20 8v6m3-3h-6"/></svg>{{ $jurusan->siswas_count }} siswa</span>
                            </div>
                            <div class="sj-item-actions">
                                <button type="button" class="sj-btn sj-soft" onclick="toggleSjEdit('edit-jurusan-{{ $jurusan->id }}')">Edit Data</button>
                                <form method="POST" action="{{ route('admin.sekolah-jurusan.jurusan.destroy',$jurusan) }}" onsubmit="return confirm('Hapus jurusan {{ addslashes($jurusan->nama_jurusan) }}?')">@csrf @method('DELETE')<button class="sj-btn sj-delete" type="submit">Hapus</button></form>
                            </div>
                            <form id="edit-jurusan-{{ $jurusan->id }}" class="sj-edit" method="POST" action="{{ route('admin.sekolah-jurusan.jurusan.update',$jurusan) }}">
                                @csrf @method('PUT')
                                <div class="sj-field"><label>Nama Jurusan *</label><input class="sj-input" name="nama_jurusan" value="{{ $jurusan->nama_jurusan }}" required maxlength="255"></div>
                                <button class="sj-btn sj-primary" style="margin-top:9px" type="submit">Simpan Perubahan</button>
                            </form>
                        </article>
                    @empty
                        <div class="sj-empty"><span>▤</span>Belum ada data jurusan. Tambahkan jurusan melalui formulir di atas.</div>
                    @endforelse
                </div>
                <div class="sj-pagination">{{ $jurusans->links() }}</div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleSjEdit(id) {
    const target = document.getElementById(id);
    if (!target) return;
    const willOpen = !target.classList.contains('open');
    document.querySelectorAll('.sj-edit.open').forEach(function (form) { form.classList.remove('open'); });
    if (willOpen) {
        target.classList.add('open');
        target.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
}
</script>
@endpush
