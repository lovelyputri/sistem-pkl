@extends('layouts.admin')

@section('title', 'Data Siswa')
@section('page-heading', 'Data Siswa')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap;margin-bottom:24px"><div><h1>Data Siswa</h1><p class="admin-intro" style="margin-bottom:0">Kelola akun, identitas, dan informasi PKL siswa dalam satu tempat.</p></div><a href="{{ route('admin.siswa.create') }}" style="background:#17357f;color:#fff;padding:12px 16px;border-radius:9px;font-size:13px;font-weight:600">+ Tambah Siswa</a></div>

    @if (session('success'))
        <p style="padding:12px;background:#dcfce7;color:#166534;border-radius:8px;margin-bottom:16px">{{ session('success') }}</p>
    @endif

    <div class="admin-section">
        <form method="GET" action="{{ route('admin.siswa.index') }}" style="display:flex;gap:12px;align-items:end;flex-wrap:wrap;margin-bottom:20px">
            <div style="flex:1;min-width:220px">
                <label for="cari" style="display:block;font-size:13px;font-weight:600;margin-bottom:7px">Pencarian</label>
                <input id="cari" name="cari" type="search" value="{{ $cari }}" placeholder="Nama, email, atau NISN..." style="width:100%;box-sizing:border-box;padding:11px 12px;border:1px solid #cbd5e1;border-radius:8px">
            </div>
            <div style="min-width:165px">
                <label for="status" style="display:block;font-size:13px;font-weight:600;margin-bottom:7px">Status akun</label>
                <select id="status" name="status" style="width:100%;padding:11px;border:1px solid #cbd5e1;border-radius:8px;background:#fff">
                    <option value="" @selected($status === '')>Semua status</option>
                    <option value="pending" @selected($status === 'pending')>Menunggu</option>
                    <option value="approved" @selected($status === 'approved')>Disetujui</option>
                    <option value="rejected" @selected($status === 'rejected')>Ditolak</option>
                </select>
            </div>
            <div style="min-width:180px">
                <label for="sekolah_id" style="display:block;font-size:13px;font-weight:600;margin-bottom:7px">Sekolah</label>
                <select id="sekolah_id" name="sekolah_id" style="width:100%;padding:11px;border:1px solid #cbd5e1;border-radius:8px;background:#fff">
                    <option value="">Semua sekolah</option>
                    @foreach ($sekolahs as $sekolah)
                        <option value="{{ $sekolah->id }}" @selected((string) $sekolahId === (string) $sekolah->id)>{{ $sekolah->nama_sekolah }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="padding:11px 16px;background:#17357f;color:#fff;border:0;border-radius:8px;cursor:pointer">Terapkan</button>
            @if ($cari !== '' || $status !== '' || $sekolahId !== '')
                <a href="{{ route('admin.siswa.index') }}" style="padding:11px 14px;color:#475569;text-decoration:none;border:1px solid #cbd5e1;border-radius:8px">Reset</a>
            @endif
        </form>

        <p style="margin:0 0 12px;color:#64748b;font-size:13px">Menampilkan {{ $siswa->firstItem() ?? 0 }}–{{ $siswa->lastItem() ?? 0 }} dari {{ $siswa->total() }} siswa</p>
        <div style="overflow-x:auto">
            <table style="width:100%;border-collapse:collapse;min-width:950px">
                <thead><tr style="background:#f8fafc;text-align:left">
                    <th style="padding:12px;width:55px">No.</th><th style="padding:12px">Profil Siswa</th><th style="padding:12px">NISN</th><th style="padding:12px">Email</th><th style="padding:12px">Sekolah</th><th style="padding:12px">Guru Pembimbing</th><th style="padding:12px">Status</th><th style="padding:12px">Aksi</th>
                </tr></thead>
                <tbody>
                @forelse ($siswa as $item)
                    <tr style="border-top:1px solid #e5eaf2">
                        <td style="padding:12px;color:#64748b">{{ $siswa->firstItem() + $loop->index }}</td>
                        <td style="padding:12px"><div style="display:flex;align-items:center;gap:10px"><div style="width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:#e8efff;color:#244a9b;font-weight:700">{{ mb_strtoupper(mb_substr($item->nama_lengkap, 0, 1)) }}</div><div><strong>{{ $item->nama_lengkap }}</strong><div style="font-size:11px;color:#64748b;margin-top:4px">{{ $item->kelas?->nama_kelas ? 'Kelas '.$item->kelas->nama_kelas : 'Kelas belum diatur' }}</div></div></div></td>
                        <td style="padding:12px">{{ $item->nisn }}</td>
                        <td style="padding:12px">{{ $item->user?->email ?? '-' }}</td>
                        <td style="padding:12px">{{ $item->sekolah?->nama_sekolah ?? '-' }}</td>
                        <td style="padding:12px">{{ $item->guru?->nama_lengkap ?? 'Belum ditetapkan' }}</td>
                        <td style="padding:12px">
                            @if ($item->user?->status === 'approved')
                                <span style="padding:5px 9px;border-radius:999px;background:#dcfce7;color:#166534;font-size:12px">Disetujui</span>
                            @elseif ($item->user?->status === 'rejected')
                                <span style="padding:5px 9px;border-radius:999px;background:#fee2e2;color:#991b1b;font-size:12px">Ditolak</span>
                            @else
                                <span style="padding:5px 9px;border-radius:999px;background:#fef3c7;color:#92400e;font-size:12px">Menunggu</span>
                            @endif
                        </td>
                        <td style="padding:12px;white-space:nowrap">
                            <a href="{{ route('admin.siswa.show', $item) }}" style="padding:7px 9px;border:1px solid #cbd5e1;border-radius:6px;color:#334155;font-size:12px">Profil</a>
                            <a href="{{ route('admin.siswa.edit', $item) }}" style="padding:7px 9px;background:#dbeafe;border-radius:6px;color:#1d4ed8;font-size:12px">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" style="padding:24px;text-align:center;color:#64748b">Tidak ada data siswa yang cocok dengan pencarian atau filter.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top:16px">{{ $siswa->links() }}</div>
    </div>
@endsection
