@extends('layouts.admin')

@section('title', 'Tambah Siswa')
@section('page-heading', 'Tambah Siswa')

@push('styles')
<style>
/* Samakan lebar dan jarak area konten dengan Dashboard serta Data Siswa */
.admin-content:has(.student-create-head){width:100%;max-width:none;margin:0;padding:22px 24px 30px}
@media(max-width:820px){.admin-content:has(.student-create-head){padding:17px}}
@media(max-width:560px){.admin-content:has(.student-create-head){padding:13px 11px 20px}}

.student-form .form-section{border:1px solid #e5eaf2;border-radius:13px;padding:22px;margin-bottom:18px;background:#fff}
.student-form .section-heading{display:flex;gap:12px;align-items:center;margin-bottom:20px}
.student-form .section-number{width:36px;height:36px;border-radius:10px;background:#eaf0ff;color:#244a9b;display:flex;align-items:center;justify-content:center;font-weight:700}
.student-form .section-heading h2{font-size:15px;margin:0 0 4px}
.student-form .section-heading p{font-size:12px;color:#64748b;margin:0}
.student-form .fields{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}
.student-form .field label{display:block;font-size:12px;font-weight:650;color:#334155;margin-bottom:8px}
.student-form .field input,.student-form .field select{width:100%;padding:12px 13px;border:1px solid #d7deea;border-radius:9px;background:#fff;color:#172033;font:inherit;font-size:13px;outline:none;transition:border .15s,box-shadow .15s}
.student-form .field input:focus,.student-form .field select:focus{border-color:#315fc4;box-shadow:0 0 0 3px rgba(49,95,196,.1)}
.student-form .field small{display:block;color:#94a3b8;font-size:11px;margin-top:6px;line-height:1.5}
.student-form .required{color:#dc2626}
@media(max-width:650px){.student-form .fields{grid-template-columns:1fr}.student-form .form-section{padding:16px}}

.student-create-page{max-width:100%;color:#172033}
.student-create-head{display:flex;justify-content:space-between;align-items:center;gap:18px;flex-wrap:wrap;padding:24px 26px;margin-bottom:20px;border-radius:18px;background:linear-gradient(115deg,#122b68 0%,#214b9d 62%,#3972ce 100%);color:#fff;position:relative;overflow:hidden}
.student-create-head:after{content:"";position:absolute;width:230px;height:230px;border:1px solid rgba(255,255,255,.13);border-radius:50%;right:8%;top:-145px;box-shadow:0 0 0 28px rgba(255,255,255,.035),0 0 0 58px rgba(255,255,255,.025)}
.student-create-head h1{font-size:23px;font-weight:750;letter-spacing:-.5px;margin:0 0 7px;color:#fff}
.student-create-head p{font-size:12px;color:#dce8ff;margin:0;line-height:1.6}
.student-create-head a{position:relative;z-index:1;padding:10px 15px;border:1px solid rgba(255,255,255,.32);background:rgba(255,255,255,.12);border-radius:10px;color:#fff;font-size:12px;font-weight:650}
.student-create-page .form-section{position:relative;border:1px solid #e5eaf2;border-radius:16px;padding:23px 24px;margin-bottom:15px;background:linear-gradient(145deg,#fff,#fbfcff);box-shadow:0 5px 18px rgba(24,48,91,.035)}
.student-create-page .section-heading{padding-bottom:15px;border-bottom:1px solid #edf1f7;margin-bottom:19px}
.student-create-page .section-number{width:39px;height:39px;border-radius:12px;background:#eaf1ff;color:#244a9b;font-size:12px;box-shadow:inset 0 0 0 1px #dce7ff}
.student-create-page .section-heading h2{font-size:15px;font-weight:750;color:#1d2d49}
.student-create-page .section-heading p{font-size:11px;color:#8996aa}
.student-create-page .fields{gap:19px 22px}
.student-create-page .field label{font-size:11px;font-weight:700;color:#3b4a63}
.student-create-page .field input,.student-create-page .field select{min-height:44px;padding:11px 13px;border:1px solid #dce3ee;border-radius:10px;background:#fff;font-size:12px;transition:.18s}
.student-create-page .field input:focus,.student-create-page .field select:focus{border-color:#4775ca;box-shadow:0 0 0 4px rgba(49,95,196,.09)}
.student-create-page .field small{font-size:10px;color:#8996aa}
.student-create-page .form-note{padding:15px 17px;border-radius:12px;background:#edf4ff;border:1px solid #d9e6ff;color:#294d8c}
.student-create-page .form-actions{border-top:1px solid #e8edf5;margin-top:5px;padding:18px 0 28px}
.student-create-page .form-actions button{padding:12px 20px!important;border-radius:10px!important;background:#214b9d!important;box-shadow:0 5px 12px rgba(33,75,157,.18);font-weight:700!important}
@media(max-width:650px){.student-create-head{padding:20px;border-radius:14px}.student-create-head h1{font-size:20px}.student-create-page .form-section{padding:17px}.student-create-page .fields{gap:14px}}


/* Penyempurnaan tampilan form tambah siswa */
.student-create-head{min-height:142px;padding:27px 30px;box-shadow:0 12px 28px rgba(23,53,127,.13)}
.student-create-head:before{content:"DATA SISWA / PENDAFTARAN";display:block;position:absolute;left:30px;bottom:17px;color:rgba(255,255,255,.58);font-size:9px;font-weight:800;letter-spacing:1.4px}
.student-create-head>div{position:relative;z-index:1}
.student-create-page .form-section{transition:border-color .2s,box-shadow .2s}
.student-create-page .form-section:hover{border-color:#d5e1f5;box-shadow:0 9px 24px rgba(24,48,91,.06)}
.student-create-page .section-number{display:grid;place-items:center;flex:0 0 40px;font-size:12px;font-weight:800}
.student-create-page .field input[type=file]{padding:9px;background:#f8faff;border-style:dashed;cursor:pointer}
.student-create-page .field input[type=file]::file-selector-button{border:0;border-radius:7px;padding:7px 11px;margin-right:10px;background:#e8efff;color:#244a9b;font-size:11px;font-weight:700;cursor:pointer}
.student-create-page .form-actions{display:flex;align-items:center;justify-content:space-between;gap:12px}
.student-create-page .form-actions a{transition:.18s}
.student-create-page .form-actions a:hover{background:#f5f7fb!important}
@media(max-width:650px){.student-create-head:before{display:none}.student-create-head{min-height:unset}}


/* Redesign visual form: hierarki lebih tegas, variasi section, dan field lebih nyaman */
.student-create-head{min-height:168px;padding:30px 34px;margin-bottom:22px;border-radius:18px;background:radial-gradient(circle at 82% 18%,rgba(129,177,255,.28),transparent 25%),linear-gradient(115deg,#10275f 0%,#1b438e 58%,#3974d2 100%);box-shadow:0 14px 30px rgba(23,53,127,.14)}
.student-create-head:before{left:34px;bottom:20px;font-size:9px;letter-spacing:1.8px;color:#bcd1ff}
.student-create-head h1{font-size:27px;letter-spacing:-.8px}
.student-create-head p{font-size:13px;max-width:520px}
.student-create-head>a{padding:11px 16px!important;border-radius:10px!important;background:rgba(255,255,255,.13)!important;border-color:rgba(255,255,255,.28)!important;color:#fff!important;transition:.2s}
.student-create-head>a:hover{background:#fff!important;color:#17357f!important;transform:translateY(-2px)}
.student-create-page .form-section{padding:0 25px 25px;margin-bottom:17px;border:1px solid #e1e8f3;border-radius:15px;background:#fff;box-shadow:0 5px 16px rgba(27,53,95,.035);overflow:hidden}
.student-create-page .form-section:before{content:"";display:block;height:4px;margin:0 -25px 21px;background:linear-gradient(90deg,#315fc4,#8bb4ff 65%,#edf3ff)}
.student-create-page .form-section:nth-of-type(2):before{background:linear-gradient(90deg,#168b9b,#7ed3d5 65%,#edfafa)}
.student-create-page .form-section:nth-of-type(3):before{background:linear-gradient(90deg,#6c63bd,#aaa4f1 65%,#f2f0ff)}
.student-create-page .form-section:nth-of-type(4):before{background:linear-gradient(90deg,#c18a36,#f0c779 65%,#fff8e9)}
.student-create-page .section-heading{padding:0 0 16px;margin-bottom:21px;border-bottom:1px solid #edf1f7}
.student-create-page .section-number{width:42px;height:42px;flex-basis:42px;border-radius:13px;background:#eaf1ff;color:#2452a6;font-size:13px;box-shadow:none}
.student-create-page .form-section:nth-of-type(2) .section-number{background:#e7f7f7;color:#147b87}
.student-create-page .form-section:nth-of-type(3) .section-number{background:#f0efff;color:#6258ad}
.student-create-page .form-section:nth-of-type(4) .section-number{background:#fff5e2;color:#a87520}
.student-create-page .section-heading h2{font-size:16px;letter-spacing:-.25px}
.student-create-page .section-heading p{font-size:11px;line-height:1.6}
.student-create-page .fields{gap:21px 25px}
.student-create-page .field label{font-size:11px;margin-bottom:8px}
.student-create-page .field input,.student-create-page .field select{min-height:46px;border-radius:9px;background:#fbfcff;padding:12px 14px}
.student-create-page .field input:hover,.student-create-page .field select:hover{border-color:#b9c9e4;background:#fff}
.student-create-page .field input:focus,.student-create-page .field select:focus{background:#fff}
.student-create-page .field small{line-height:1.55}
.student-create-page .field input[type=file]{min-height:46px;background:#f7f9fd}
.student-create-page .form-note{box-shadow:inset 3px 0 #3972ce}
.student-create-page .form-actions{padding:17px 0 30px;border-top:1px solid #e8edf5}
.student-create-page .form-actions button{padding:13px 22px!important;background:linear-gradient(120deg,#17357f,#315fc4)!important;transition:.2s}
.student-create-page .form-actions button:hover{transform:translateY(-2px);box-shadow:0 8px 18px rgba(33,75,157,.24)}
.student-create-page .form-actions a{padding:12px 18px!important;border-radius:10px!important}
@media(max-width:650px){.student-create-head{min-height:unset;padding:23px 20px}.student-create-head:before{display:none}.student-create-head h1{font-size:22px}.student-create-page .form-section{padding:0 16px 19px}.student-create-page .form-section:before{margin:0 -16px 17px}.student-create-page .section-heading{gap:10px}.student-create-page .fields{gap:15px}}


/* Konsistensi layout CRUD siswa dengan dashboard admin */
.admin-content:has(.student-create-head){width:100%;max-width:1200px;margin:0 auto;padding:28px}
.student-create-head{margin-bottom:22px;border-radius:14px}
.student-create-page .form-section{padding:24px;margin-bottom:17px;border-radius:13px;background:#fff;box-shadow:0 3px 12px rgba(24,48,91,.035)}
.student-create-page .section-heading{margin-bottom:21px}
.student-create-page .fields{gap:20px 24px}
.student-create-page .field input,.student-create-page .field select{min-height:46px}
.student-create-page .form-actions{padding-top:17px}
@media(max-width:760px){.admin-content:has(.student-create-head){padding:20px 15px}}
@media(max-width:650px){.student-create-page .form-section{padding:17px}.student-create-page .fields{gap:15px}}
@media(max-width:480px){.admin-content:has(.student-create-head){padding:17px 11px}.student-create-head{padding:20px 18px}}


/* Samakan lebar dan padding halaman CRUD Siswa dengan Dashboard Admin. */
.admin-content:has(.student-create-head){width:100%!important;max-width:none!important;margin:0!important;padding:22px 24px 30px!important}
@media(max-width:760px){.admin-content:has(.student-create-head){padding:17px 15px!important}}
@media(max-width:560px){.admin-content:has(.student-create-head){padding:13px 11px 20px!important}}
</style>
@endpush

@section('content')
<div class="student-create-head">
    <div><h1>Tambah Siswa</h1><p class="admin-intro" style="margin-bottom:0">Buat data dan akun siswa baru langsung dari panel admin.</p></div>
    <a href="{{ route('admin.siswa.index') }}" style="padding:10px 13px;border:1px solid #d7deea;background:#fff;border-radius:9px;font-size:12px;color:#475569">← Kembali ke Data Siswa</a>
</div>
@if ($errors->any())
<div style="padding:14px 16px;background:#fff1f2;border:1px solid #fecdd3;color:#9f1239;border-radius:10px;margin-bottom:18px;font-size:13px">
    <strong>Periksa kembali data berikut:</strong>
    <ul style="margin:8px 0 0;padding-left:20px">@foreach ($errors->all() as $error)<li style="margin:3px 0">{{ $error }}</li>@endforeach</ul>
</div>
@endif
<div style="padding:15px 17px;background:#eef4ff;border:1px solid #d9e5ff;border-radius:11px;color:#244a9b;font-size:12px;line-height:1.7;margin-bottom:20px">
    <strong>Akun langsung aktif</strong><br>Setelah disimpan, siswa dapat login menggunakan email dan password yang dibuat di formulir ini. Beri tahu siswa password awalnya secara pribadi.
</div>
<div class="student-create-page"><form class="student-form" method="POST" enctype="multipart/form-data" action="{{ route('admin.siswa.store') }}">
@csrf
<section class="form-section">
    <div class="section-heading"><div class="section-number">01</div><div><h2>Identitas Siswa</h2><p>Informasi dasar untuk mengenali siswa.</p></div></div>
    <div class="fields">
        <div class="field"><label for="nama_lengkap">Nama lengkap <span class="required">*</span></label><input id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap" required maxlength="255" autocomplete="name"></div>
        <div class="field"><label for="nisn">NISN <span class="required">*</span></label><input id="nisn" name="nisn" value="{{ old('nisn') }}" placeholder="Masukkan NISN" required maxlength="30" inputmode="numeric"></div>
        <div class="field"><label for="tempat_lahir">Tempat lahir <span class="required">*</span></label><input id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Contoh: Banyuwangi" required maxlength="100"></div>
        <div class="field"><label for="tanggal_lahir">Tanggal lahir <span class="required">*</span></label><input id="tanggal_lahir" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required max="{{ now()->format('Y-m-d') }}"></div>
        <div class="field"><label for="jenis_kelamin">Jenis kelamin <span class="required">*</span></label><select id="jenis_kelamin" name="jenis_kelamin" required><option value="">Pilih jenis kelamin</option><option value="Laki-laki" @selected(old('jenis_kelamin') === 'Laki-laki')>Laki-laki</option><option value="Perempuan" @selected(old('jenis_kelamin') === 'Perempuan')>Perempuan</option></select></div>
        <div class="field"><label for="no_telepon">Nomor telepon <span class="required">*</span></label><input id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="Contoh: 08xxxxxxxxxx" required maxlength="30" inputmode="tel"></div>
        <div class="field"><label for="foto_profil">Foto profil</label><input id="foto_profil" type="file" name="foto_profil" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"><small>Opsional. JPG, JPEG, PNG, atau WEBP, maksimal 2 MB.</small></div>
    </div>
</section>
<section class="form-section">
    <div class="section-heading"><div class="section-number">02</div><div><h2>Akun untuk Login</h2><p>Email dan password yang akan digunakan siswa saat masuk.</p></div></div>
    <div class="fields">
        <div class="field"><label for="email">Email aktif <span class="required">*</span></label><input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required maxlength="255" autocomplete="email"></div>
        <div class="field"><label for="password">Password awal <span class="required">*</span></label><input id="password" type="password" name="password" required minlength="8" autocomplete="new-password" placeholder="Minimal 8 karakter"><small>Password tidak ditampilkan kembali setelah data disimpan.</small></div>
        <div class="field"><label for="password_confirmation">Konfirmasi password <span class="required">*</span></label><input id="password_confirmation" type="password" name="password_confirmation" required minlength="8" autocomplete="new-password" placeholder="Ulangi password yang sama"></div>
    </div>
</section>
<section class="form-section">
    <div class="section-heading"><div class="section-number">03</div><div><h2>Data Sekolah</h2><p>Tentukan sekolah, kelas, jurusan, dan guru pembimbing.</p></div></div>
    <div class="fields">
        <div class="field"><label for="sekolah_id">Sekolah <span class="required">*</span></label><select id="sekolah_id" name="sekolah_id" required><option value="">Pilih sekolah</option>@foreach($sekolahs as $row)<option value="{{ $row->id }}" @selected((string)old('sekolah_id') === (string)$row->id)>{{ $row->nama_sekolah }}</option>@endforeach</select></div>
        <div class="field"><label for="kelas_id">Kelas <span class="required">*</span></label><select id="kelas_id" name="kelas_id" required><option value="">Pilih kelas</option>@foreach($kelases as $row)<option value="{{ $row->id }}" @selected((string)old('kelas_id') === (string)$row->id)>Kelas {{ $row->nama_kelas }}</option>@endforeach</select></div>
        <div class="field"><label for="jurusan_id">Jurusan <span class="required">*</span></label><select id="jurusan_id" name="jurusan_id" required><option value="">Pilih jurusan</option>@foreach($jurusans as $row)<option value="{{ $row->id }}" @selected((string)old('jurusan_id') === (string)$row->id)>{{ $row->nama_jurusan }}</option>@endforeach</select></div>
        <div class="field"><label for="guru_id">Guru pembimbing</label><select id="guru_id" name="guru_id" disabled><option value="">Pilih sekolah terlebih dahulu</option></select><small>Daftar guru akan menyesuaikan dengan sekolah yang dipilih. Penentuan guru bersifat opsional.</small></div>
    </div>
</section>
<section class="form-section">
    <div class="section-heading"><div class="section-number">04</div><div><h2>Periode PKL</h2><p>Jadwal pelaksanaan praktik kerja lapangan.</p></div></div>
    <div class="fields">
        <div class="field"><label for="tanggal_mulai_pkl">Tanggal mulai PKL</label><input id="tanggal_mulai_pkl" type="date" name="tanggal_mulai_pkl" value="{{ old('tanggal_mulai_pkl') }}"></div>
        <div class="field"><label for="tanggal_selesai_pkl">Tanggal selesai PKL</label><input id="tanggal_selesai_pkl" type="date" name="tanggal_selesai_pkl" value="{{ old('tanggal_selesai_pkl') }}"><small>Tanggal selesai tidak boleh lebih awal dari tanggal mulai.</small></div>
    </div>
</section>
<div class="form-actions" style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;padding:8px 0 24px">
    <span style="font-size:11px;color:#64748b"><span class="required">*</span> Wajib diisi</span>
    <div style="display:flex;gap:10px;flex-wrap:wrap"><a href="{{ route('admin.siswa.index') }}" style="padding:12px 16px;border:1px solid #d7deea;background:#fff;border-radius:9px;font-size:13px;color:#475569">Batal</a><button type="submit" style="padding:12px 18px;border:0;background:#17357f;color:#fff;border-radius:9px;font-size:13px;font-weight:650;cursor:pointer">Simpan Siswa →</button></div>
</div>
</form></div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sekolahSelect = document.getElementById('sekolah_id');
    const guruSelect = document.getElementById('guru_id');
    const endpoint = @json(route('admin.siswa.guru-by-sekolah'));
    const guruLama = @json(old('guru_id'));

    async function muatGuru(sekolahId, guruTerpilih = '') {
        guruSelect.innerHTML = '';

        if (!sekolahId) {
            guruSelect.disabled = true;
            guruSelect.add(new Option('Pilih sekolah terlebih dahulu', ''));
            return;
        }

        guruSelect.disabled = true;
        guruSelect.add(new Option('Memuat daftar guru...', ''));

        try {
            const response = await fetch(endpoint + '?sekolah_id=' + encodeURIComponent(sekolahId), {
                headers: { 'Accept': 'application/json' }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil daftar guru.');
            }

            const gurus = await response.json();
            guruSelect.innerHTML = '';
            guruSelect.add(new Option(
                gurus.length ? 'Pilih guru pembimbing (opsional)' : 'Belum ada guru di sekolah ini',
                ''
            ));

            gurus.forEach(function (guru) {
                const option = new Option(guru.nama_lengkap, guru.id);
                if (String(guru.id) === String(guruTerpilih)) {
                    option.selected = true;
                }
                guruSelect.add(option);
            });

            guruSelect.disabled = false;
        } catch (error) {
            guruSelect.innerHTML = '';
            guruSelect.add(new Option('Gagal memuat guru. Coba pilih sekolah lagi.', ''));
            guruSelect.disabled = true;
            console.error(error);
        }
    }

    sekolahSelect.addEventListener('change', function () {
        muatGuru(this.value);
    });

    muatGuru(sekolahSelect.value, guruLama);
});
</script>
@endpush

@endsection
