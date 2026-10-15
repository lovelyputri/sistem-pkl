@extends('layouts.admin')

@section('title', 'Edit Data Siswa')
@section('page-heading', 'Edit Data Siswa')

@section('content')
    <div style="margin-bottom:20px"><h1>Edit Data Siswa</h1><p class="admin-intro">Perbarui informasi siswa. Kolom bertanda * wajib diisi.</p></div>
    @if ($errors->any())
        <div style="padding:12px;background:#fee2e2;color:#991b1b;border-radius:8px;margin-bottom:16px">
            @foreach ($errors->all() as $error)<p style="margin:0 0 4px">{{ $error }}</p>@endforeach
        </div>
    @endif
    <div class="admin-section">
        <form method="POST" action="{{ route('admin.siswa.update', $siswa) }}" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px">
            @csrf @method('PUT')
            <div><label for="nama_lengkap">Nama lengkap *</label><input id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}" required maxlength="255" style="width:100%;box-sizing:border-box;padding:10px;border:1px solid #cbd5e1;border-radius:8px"></div>
            <div><label for="email">Email akun *</label><input id="email" type="email" name="email" value="{{ old('email', $siswa->user?->email) }}" required style="width:100%;box-sizing:border-box;padding:10px;border:1px solid #cbd5e1;border-radius:8px"></div>
            <div><label for="nisn">NISN *</label><input id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" required maxlength="30" style="width:100%;box-sizing:border-box;padding:10px;border:1px solid #cbd5e1;border-radius:8px"></div>
            <div><label for="tempat_lahir">Tempat lahir *</label><input id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" required style="width:100%;box-sizing:border-box;padding:10px;border:1px solid #cbd5e1;border-radius:8px"></div>
            <div><label for="tanggal_lahir">Tanggal lahir</label><input id="tanggal_lahir" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir?->format('Y-m-d')) }}" style="width:100%;box-sizing:border-box;padding:10px;border:1px solid #cbd5e1;border-radius:8px"></div>
            <div><label for="jenis_kelamin">Jenis kelamin</label><select id="jenis_kelamin" name="jenis_kelamin" style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:8px"><option value="">Pilih jenis kelamin</option><option value="Laki-laki" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) === 'Laki-laki')>Laki-laki</option><option value="Perempuan" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) === 'Perempuan')>Perempuan</option></select></div>
            <div><label for="no_telepon">Nomor telepon</label><input id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $siswa->no_telepon) }}" style="width:100%;box-sizing:border-box;padding:10px;border:1px solid #cbd5e1;border-radius:8px"></div>
            <div><label for="sekolah_id">Sekolah *</label><select id="sekolah_id" name="sekolah_id" required style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:8px">@foreach ($sekolahs as $row)<option value="{{ $row->id }}" @selected((string) old('sekolah_id', $siswa->sekolah_id) === (string) $row->id)>{{ $row->nama_sekolah }}</option>@endforeach</select></div>
            <div><label for="jurusan_id">Jurusan *</label><select id="jurusan_id" name="jurusan_id" required style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:8px">@foreach ($jurusans as $row)<option value="{{ $row->id }}" @selected((string) old('jurusan_id', $siswa->jurusan_id) === (string) $row->id)>{{ $row->nama_jurusan }}</option>@endforeach</select></div>
            <div><label for="kelas_id">Kelas *</label><select id="kelas_id" name="kelas_id" required style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:8px">@foreach ($kelases as $row)<option value="{{ $row->id }}" @selected((string) old('kelas_id', $siswa->kelas_id) === (string) $row->id)>{{ $row->nama_kelas }}</option>@endforeach</select></div>
            <div><label for="guru_id">Guru pembimbing</label><select id="guru_id" name="guru_id" style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:8px"><option value="">Belum ditetapkan</option>@foreach ($gurus as $row)<option value="{{ $row->id }}" @selected((string) old('guru_id', $siswa->guru_id) === (string) $row->id)>{{ $row->nama_lengkap }}</option>@endforeach</select></div>
            <div><label for="tanggal_mulai_pkl">Tanggal mulai PKL</label><input id="tanggal_mulai_pkl" type="date" name="tanggal_mulai_pkl" value="{{ old('tanggal_mulai_pkl', $siswa->tanggal_mulai_pkl?->format('Y-m-d')) }}" style="width:100%;box-sizing:border-box;padding:10px;border:1px solid #cbd5e1;border-radius:8px"></div>
            <div><label for="tanggal_selesai_pkl">Tanggal selesai PKL</label><input id="tanggal_selesai_pkl" type="date" name="tanggal_selesai_pkl" value="{{ old('tanggal_selesai_pkl', $siswa->tanggal_selesai_pkl?->format('Y-m-d')) }}" style="width:100%;box-sizing:border-box;padding:10px;border:1px solid #cbd5e1;border-radius:8px"></div>
            <div style="grid-column:1/-1;display:flex;gap:10px;flex-wrap:wrap;margin-top:8px"><button type="submit" style="padding:11px 16px;background:#17357f;color:#fff;border:0;border-radius:8px;cursor:pointer">Simpan Perubahan</button><a href="{{ route('admin.siswa.show', $siswa) }}" style="padding:11px 16px;border:1px solid #cbd5e1;border-radius:8px;color:#334155">Batal</a></div>
        </form>
    </div>
@endsection
