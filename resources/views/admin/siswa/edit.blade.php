@extends('layouts.admin')

@section('title', 'Edit Profil Siswa')
@section('page-heading', 'Edit Profil Siswa')

@push('styles')
<style>
.edit-intro{display:flex;align-items:center;gap:14px}
.edit-avatar{width:52px;height:52px;flex-shrink:0;border-radius:50%;display:flex;align-items:center;justify-content:center;background:#e8efff;color:#244a9b;font-size:20px;font-weight:700}
.edit-card{background:#fff;border:1px solid #e5eaf2;border-radius:13px;padding:22px;margin-bottom:18px}
.edit-card-head{display:flex;align-items:center;gap:12px;margin-bottom:20px}
.edit-card-head .num{width:34px;height:34px;display:flex;align-items:center;justify-content:center;border-radius:9px;background:#eaf0ff;color:#244a9b;font-weight:700;font-size:12px}
.edit-card-head h2{margin:0 0 4px;font-size:14px}
.edit-card-head p{margin:0;color:#64748b;font-size:11px}
.edit-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:17px}
.edit-field label{display:block;font-size:12px;font-weight:650;color:#334155;margin-bottom:8px}
.edit-field input,.edit-field select{width:100%;padding:12px;border:1px solid #d7deea;border-radius:9px;background:#fff;font:inherit;font-size:13px;color:#172033}
.edit-field input:focus,.edit-field select:focus{outline:none;border-color:#315fc4;box-shadow:0 0 0 3px rgba(49,95,196,.1)}
.edit-field small{display:block;color:#94a3b8;font-size:11px;margin-top:6px}
.edit-required{color:#dc2626}
@media(max-width:650px){.edit-grid{grid-template-columns:1fr}.edit-card{padding:16px}}
</style>
@endpush

@section('content')
<div style="display:flex;justify-content:space-between;align-items:flex-start;gap:14px;flex-wrap:wrap;margin-bottom:24px">
    <div class="edit-intro"><div class="edit-avatar">{{ mb_strtoupper(mb_substr($siswa->nama_lengkap, 0, 1)) }}</div><div><h1>Edit Profil Siswa</h1><p class="admin-intro" style="margin:6px 0 0">Perbarui informasi milik {{ $siswa->nama_lengkap }}.</p></div></div>
    <a href="{{ route('admin.siswa.show', $siswa) }}" style="padding:10px 13px;border:1px solid #d7deea;background:#fff;border-radius:9px;font-size:12px;color:#475569">← Kembali ke Profil</a>
</div>
@if ($errors->any())
<div style="padding:14px 16px;background:#fff1f2;border:1px solid #fecdd3;color:#9f1239;border-radius:10px;margin-bottom:18px;font-size:13px"><strong>Data belum bisa disimpan.</strong><ul style="margin:8px 0 0;padding-left:20px">@foreach ($errors->all() as $error)<li style="margin:3px 0">{{ $error }}</li>@endforeach</ul></div>
@endif
<form method="POST" action="{{ route('admin.siswa.update', $siswa) }}">
@csrf @method('PUT')
<section class="edit-card">
    <div class="edit-card-head"><div class="num">01</div><div><h2>Identitas Pribadi</h2><p>Pastikan data sesuai dengan identitas siswa.</p></div></div>
    <div class="edit-grid">
        <div class="edit-field"><label for="nama_lengkap">Nama lengkap <span class="edit-required">*</span></label><input id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}" required maxlength="255"></div>
        <div class="edit-field"><label for="nisn">NISN <span class="edit-required">*</span></label><input id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" required maxlength="30"></div>
        <div class="edit-field"><label for="tempat_lahir">Tempat lahir <span class="edit-required">*</span></label><input id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" required maxlength="100"></div>
        <div class="edit-field"><label for="tanggal_lahir">Tanggal lahir</label><input id="tanggal_lahir" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir?->format('Y-m-d')) }}"></div>
        <div class="edit-field"><label for="jenis_kelamin">Jenis kelamin</label><select id="jenis_kelamin" name="jenis_kelamin"><option value="">Pilih jenis kelamin</option><option value="Laki-laki" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) === 'Laki-laki')>Laki-laki</option><option value="Perempuan" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) === 'Perempuan')>Perempuan</option></select></div>
        <div class="edit-field"><label for="no_telepon">Nomor telepon</label><input id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $siswa->no_telepon) }}" maxlength="30"></div>
    </div>
</section>
<section class="edit-card">
    <div class="edit-card-head"><div class="num">02</div><div><h2>Akun Siswa</h2><p>Email untuk masuk ke GUSPELOR.NET.</p></div></div>
    <div class="edit-grid"><div class="edit-field"><label for="email">Email akun <span class="edit-required">*</span></label><input id="email" type="email" name="email" value="{{ old('email', $siswa->user?->email) }}" required maxlength="255"><small>Jika email diubah, siswa harus login menggunakan email yang baru.</small></div></div>
</section>
<section class="edit-card">
    <div class="edit-card-head"><div class="num">03</div><div><h2>Data Sekolah</h2><p>Perbarui sekolah, jurusan, kelas, dan pembimbing.</p></div></div>
    <div class="edit-grid">
        <div class="edit-field"><label for="sekolah_id">Sekolah <span class="edit-required">*</span></label><select id="sekolah_id" name="sekolah_id" required>@foreach($sekolahs as $row)<option value="{{ $row->id }}" @selected((string)old('sekolah_id', $siswa->sekolah_id) === (string)$row->id)>{{ $row->nama_sekolah }}</option>@endforeach</select></div>
        <div class="edit-field"><label for="jurusan_id">Jurusan <span class="edit-required">*</span></label><select id="jurusan_id" name="jurusan_id" required>@foreach($jurusans as $row)<option value="{{ $row->id }}" @selected((string)old('jurusan_id', $siswa->jurusan_id) === (string)$row->id)>{{ $row->nama_jurusan }}</option>@endforeach</select></div>
        <div class="edit-field"><label for="kelas_id">Kelas <span class="edit-required">*</span></label><select id="kelas_id" name="kelas_id" required>@foreach($kelases as $row)<option value="{{ $row->id }}" @selected((string)old('kelas_id', $siswa->kelas_id) === (string)$row->id)>Kelas {{ $row->nama_kelas }}</option>@endforeach</select></div>
        <div class="edit-field"><label for="guru_id">Guru pembimbing</label><select id="guru_id" name="guru_id" disabled><option value="">Pilih sekolah terlebih dahulu</option></select><small>Pilihan guru akan mengikuti sekolah yang dipilih.</small></div>
    </div>
</section>
<section class="edit-card">
    <div class="edit-card-head"><div class="num">04</div><div><h2>Periode PKL</h2><p>Atur jadwal praktik kerja lapangan.</p></div></div>
    <div class="edit-grid">
        <div class="edit-field"><label for="tanggal_mulai_pkl">Tanggal mulai PKL</label><input id="tanggal_mulai_pkl" type="date" name="tanggal_mulai_pkl" value="{{ old('tanggal_mulai_pkl', $siswa->tanggal_mulai_pkl?->format('Y-m-d')) }}"></div>
        <div class="edit-field"><label for="tanggal_selesai_pkl">Tanggal selesai PKL</label><input id="tanggal_selesai_pkl" type="date" name="tanggal_selesai_pkl" value="{{ old('tanggal_selesai_pkl', $siswa->tanggal_selesai_pkl?->format('Y-m-d')) }}"><small>Tidak boleh sebelum tanggal mulai.</small></div>
    </div>
</section>
<div style="display:flex;justify-content:flex-end;gap:10px;flex-wrap:wrap;padding-bottom:26px"><a href="{{ route('admin.siswa.show', $siswa) }}" style="padding:12px 16px;border:1px solid #d7deea;background:#fff;border-radius:9px;font-size:13px;color:#475569">Batal</a><button type="submit" style="padding:12px 18px;border:0;background:#17357f;color:#fff;border-radius:9px;font-size:13px;font-weight:650;cursor:pointer">Simpan Perubahan</button></div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sekolahSelect = document.getElementById('sekolah_id');
    const guruSelect = document.getElementById('guru_id');
    const endpoint = @json(route('admin.siswa.guru-by-sekolah'));
    const guruTerpilihAwal = @json(old('guru_id', $siswa->guru_id));

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

    muatGuru(sekolahSelect.value, guruTerpilihAwal);
});
</script>
@endpush

@endsection
