@extends('layouts.admin')

@section('title', 'Detail Pendaftar')
@section('page-heading', 'Detail Pendaftar')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:20px">
        <div>
            <h1 style="margin:0">Detail Pendaftar</h1>
            <p class="admin-intro" style="margin-bottom:0">Periksa informasi siswa sebelum memproses pendaftaran.</p>
        </div>
        <a href="{{ route('admin.siswa.approval.index') }}" style="padding:10px 14px;border:1px solid #cbd5e1;border-radius:8px;color:#334155">Kembali ke daftar</a>
    </div>

    @if (session('success'))
        <p style="padding:12px;background:#dcfce7;color:#166534;border-radius:8px;margin-bottom:16px">{{ session('success') }}</p>
    @endif
    @if ($errors->any())
        <div style="padding:12px;background:#fee2e2;color:#991b1b;border-radius:8px;margin-bottom:16px">
            @foreach ($errors->all() as $error)<p style="margin:0 0 4px">{{ $error }}</p>@endforeach
        </div>
    @endif

    <div class="admin-section" style="margin-top:0">
        <h2 style="font-size:17px;margin-bottom:16px">Informasi Akun</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px">
            <div><p>Nama lengkap</p><strong>{{ $user->siswa?->nama_lengkap ?? '-' }}</strong></div>
            <div><p>Email</p><strong>{{ $user->email }}</strong></div>
            <div><p>NISN</p><strong>{{ $user->siswa?->nisn ?? '-' }}</strong></div>
            <div><p>Nomor telepon</p><strong>{{ $user->siswa?->no_telepon ?? '-' }}</strong></div>
            <div><p>Status pendaftaran</p>
                @if ($user->status === 'approved')
                    <span style="display:inline-block;padding:5px 9px;border-radius:999px;background:#dcfce7;color:#166534;font-size:12px">Disetujui</span>
                @elseif ($user->status === 'rejected')
                    <span style="display:inline-block;padding:5px 9px;border-radius:999px;background:#fee2e2;color:#991b1b;font-size:12px">Ditolak</span>
                @else
                    <span style="display:inline-block;padding:5px 9px;border-radius:999px;background:#fef3c7;color:#92400e;font-size:12px">Menunggu</span>
                @endif
            </div>
        </div>
    </div>

    <div class="admin-section">
        <h2 style="font-size:17px;margin-bottom:16px">Informasi Data Sekolah dan PKL</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px">
            <div><p>Tempat lahir</p><strong>{{ $user->siswa?->tempat_lahir ?? '-' }}</strong></div>
            <div><p>Tanggal lahir</p><strong>{{ $user->siswa?->tanggal_lahir?->format('d-m-Y') ?? '-' }}</strong></div>
            <div><p>Jenis kelamin</p><strong>{{ $user->siswa?->jenis_kelamin ?? '-' }}</strong></div>
            <div><p>Sekolah</p><strong>{{ $user->siswa?->sekolah?->nama_sekolah ?? '-' }}</strong></div>
            <div><p>Alamat sekolah</p><strong>{{ $user->siswa?->sekolah?->alamat ?? '-' }}</strong></div>
            <div><p>Kelas</p><strong>{{ $user->siswa?->kelas?->nama_kelas ?? '-' }}</strong></div>
            <div><p>Jurusan</p><strong>{{ $user->siswa?->jurusan?->nama_jurusan ?? '-' }}</strong></div>
            <div><p>Tanggal mulai PKL</p><strong>{{ $user->siswa?->tanggal_mulai_pkl?->format('d-m-Y') ?? '-' }}</strong></div>
            <div><p>Tanggal selesai PKL</p><strong>{{ $user->siswa?->tanggal_selesai_pkl?->format('d-m-Y') ?? '-' }}</strong></div>
        </div>
    </div>

    @if ($user->status === 'rejected' && $user->alasan_penolakan)
        <div class="admin-section">
            <h2 style="font-size:17px;margin-bottom:8px">Alasan Penolakan</h2>
            <p>{{ $user->alasan_penolakan }}</p>
        </div>
    @endif

    @if ($user->status === 'pending')
        <div class="admin-section" style="display:flex;gap:12px;align-items:center;flex-wrap:wrap">
            <form method="POST" action="{{ route('admin.siswa.approval.approve', $user) }}" onsubmit="return confirm('Yakin ingin menyetujui pendaftaran siswa ini?')">
                @csrf
                @method('PATCH')
                <button type="submit" style="padding:10px 15px;background:#15803d;color:#fff;border:0;border-radius:8px;cursor:pointer">Setujui pendaftaran</button>
            </form>
            <span style="color:#64748b;font-size:13px">Jika ditolak, isi alasan penolakan di bawah ini.</span>
        </div>

        <div class="admin-section" id="tolak">
            <h2 style="font-size:17px;margin-bottom:8px">Tolak Pendaftaran</h2>
            <p style="margin-bottom:14px">Alasan akan disimpan bersama status pendaftaran sebagai catatan admin.</p>
            <form method="POST" action="{{ route('admin.siswa.approval.reject', $user) }}" onsubmit="return confirm('Yakin ingin menolak pendaftaran ini? Pastikan alasan sudah benar.')">
                @csrf
                @method('PATCH')
                <label for="alasan_penolakan" style="display:block;font-size:13px;font-weight:600;margin-bottom:7px">Alasan penolakan <span style="color:#b91c1c">*</span></label>
                <textarea id="alasan_penolakan" name="alasan_penolakan" required minlength="5" maxlength="1000" rows="4" placeholder="Contoh: Data sekolah belum sesuai, silakan periksa kembali informasi yang diisi." style="width:100%;box-sizing:border-box;padding:12px;border:1px solid #cbd5e1;border-radius:8px;font:inherit;resize:vertical">{{ old('alasan_penolakan') }}</textarea>
                <button type="submit" style="margin-top:12px;padding:10px 15px;background:#b91c1c;color:#fff;border:0;border-radius:8px;cursor:pointer">Konfirmasi penolakan</button>
            </form>
        </div>
    @endif
@endsection
