@extends('layouts.admin')

@section('title', 'Detail Data Siswa')
@section('page-heading', 'Detail Data Siswa')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:20px">
        <div><h1 style="margin:0">Detail Data Siswa</h1><p class="admin-intro" style="margin-bottom:0">Informasi lengkap siswa dan penempatan PKL.</p></div>
        <a href="{{ route('admin.siswa.index') }}" style="padding:10px 14px;border:1px solid #cbd5e1;border-radius:8px;color:#334155">Kembali ke daftar</a>
    </div>
    @if (session('success'))<p style="padding:12px;background:#dcfce7;color:#166534;border-radius:8px">{{ session('success') }}</p>@endif
    <div class="admin-section">
        <h2 style="font-size:17px">Data Pribadi</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px">
            <div><p>Nama lengkap</p><strong>{{ $siswa->nama_lengkap }}</strong></div>
            <div><p>NISN</p><strong>{{ $siswa->nisn }}</strong></div>
            <div><p>Email</p><strong>{{ $siswa->user?->email ?? '-' }}</strong></div>
            <div><p>Tempat, tanggal lahir</p><strong>{{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir?->format('d-m-Y') ?? '-' }}</strong></div>
            <div><p>Jenis kelamin</p><strong>{{ $siswa->jenis_kelamin ?? '-' }}</strong></div>
            <div><p>Nomor telepon</p><strong>{{ $siswa->no_telepon ?? '-' }}</strong></div>
            <div><p>Status akun</p><strong>{{ ucfirst($siswa->user?->status ?? 'tidak diketahui') }}</strong></div>
        </div>
    </div>
    <div class="admin-section">
        <h2 style="font-size:17px">Data Sekolah dan PKL</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px">
            <div><p>Sekolah</p><strong>{{ $siswa->sekolah?->nama_sekolah ?? '-' }}</strong></div>
            <div><p>Jurusan</p><strong>{{ $siswa->jurusan?->nama_jurusan ?? '-' }}</strong></div>
            <div><p>Kelas</p><strong>{{ $siswa->kelas?->nama_kelas ?? '-' }}</strong></div>
            <div><p>Guru pembimbing</p><strong>{{ $siswa->guru?->nama_lengkap ?? 'Belum ditetapkan' }}</strong></div>
            <div><p>Tanggal mulai PKL</p><strong>{{ $siswa->tanggal_mulai_pkl?->format('d-m-Y') ?? '-' }}</strong></div>
            <div><p>Tanggal selesai PKL</p><strong>{{ $siswa->tanggal_selesai_pkl?->format('d-m-Y') ?? '-' }}</strong></div>
        </div>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:20px">
        <a href="{{ route('admin.siswa.edit', $siswa) }}" style="padding:10px 15px;background:#17357f;color:#fff;border-radius:8px">Edit Data</a>
        <form method="POST" action="{{ route('admin.siswa.destroy', $siswa) }}" onsubmit="return confirm('Hapus data siswa ini? Akun siswa beserta jurnal dan absensi terkait dapat ikut terhapus. Tindakan ini tidak dapat dibatalkan.')">
            @csrf @method('DELETE')
            <button type="submit" style="padding:10px 15px;background:#fee2e2;color:#991b1b;border:0;border-radius:8px;cursor:pointer">Hapus Data Siswa</button>
        </form>
    </div>
@endsection
