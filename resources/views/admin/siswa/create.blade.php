@extends('layouts.admin')

@section('title', 'Tambah Siswa')
@section('page-heading', 'Tambah Siswa')

@push('styles')
<style>
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
</style>
@endpush

@section('content')
<div style="display:flex;justify-content:space-between;align-items:flex-start;gap:14px;flex-wrap:wrap;margin-bottom:24px">
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
<form class="student-form" method="POST" enctype="multipart/form-data" action="{{ route('admin.siswa.store') }}">
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
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;padding:8px 0 24px">
    <span style="font-size:11px;color:#64748b"><span class="required">*</span> Wajib diisi</span>
    <div style="display:flex;gap:10px;flex-wrap:wrap"><a href="{{ route('admin.siswa.index') }}" style="padding:12px 16px;border:1px solid #d7deea;background:#fff;border-radius:9px;font-size:13px;color:#475569">Batal</a><button type="submit" style="padding:12px 18px;border:0;background:#17357f;color:#fff;border-radius:9px;font-size:13px;font-weight:650;cursor:pointer">Simpan Siswa →</button></div>
</div>
</form>

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
