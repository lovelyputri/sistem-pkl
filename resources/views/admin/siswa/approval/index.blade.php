@extends('layouts.admin')

@section('title', 'Persetujuan Siswa')
@section('page-heading', 'Persetujuan Siswa')

@section('content')
    <h1>Persetujuan Pendaftaran Siswa</h1>
    <p class="admin-intro">Periksa data pendaftar, lihat detailnya, lalu tentukan status pendaftaran.</p>

    @if (session('success'))
        <p style="padding:12px;background:#dcfce7;color:#166534;border-radius:8px;margin-bottom:16px">{{ session('success') }}</p>
    @endif
    @if (session('info'))
        <p style="padding:12px;background:#e0f2fe;color:#075985;border-radius:8px;margin-bottom:16px">{{ session('info') }}</p>
    @endif
    @if ($errors->any())
        <div style="padding:12px;background:#fee2e2;color:#991b1b;border-radius:8px;margin-bottom:16px">
            @foreach ($errors->all() as $error)<p style="margin:0 0 4px">{{ $error }}</p>@endforeach
        </div>
    @endif

    <div class="admin-section">
        <form method="GET" action="{{ route('admin.siswa.approval.index') }}" style="display:flex;gap:12px;align-items:end;flex-wrap:wrap;margin-bottom:20px">
            <div style="flex:1;min-width:220px">
                <label for="cari" style="display:block;font-size:13px;font-weight:600;color:#334155;margin-bottom:7px">Cari siswa</label>
                <input id="cari" name="cari" type="search" value="{{ $cari }}" placeholder="Nama, email, atau NISN..." style="width:100%;box-sizing:border-box;padding:11px 12px;border:1px solid #cbd5e1;border-radius:8px">
            </div>
            <div style="min-width:180px">
                <label for="status" style="display:block;font-size:13px;font-weight:600;color:#334155;margin-bottom:7px">Status pendaftaran</label>
                <select id="status" name="status" style="width:100%;padding:11px 12px;border:1px solid #cbd5e1;border-radius:8px;background:#fff">
                    <option value="" @selected($status === '')>Semua status</option>
                    <option value="pending" @selected($status === 'pending')>Menunggu</option>
                    <option value="approved" @selected($status === 'approved')>Disetujui</option>
                    <option value="rejected" @selected($status === 'rejected')>Ditolak</option>
                </select>
            </div>
            <button type="submit" style="padding:11px 16px;background:#17357f;color:#fff;border:0;border-radius:8px;cursor:pointer">Terapkan</button>
            @if ($cari !== '' || $status !== '')
                <a href="{{ route('admin.siswa.approval.index') }}" style="padding:11px 14px;color:#475569;text-decoration:none;border:1px solid #cbd5e1;border-radius:8px">Reset</a>
            @endif
        </form>

        <p style="margin:0 0 12px;color:#64748b;font-size:13px">Menampilkan {{ $pendaftar->firstItem() ?? 0 }}–{{ $pendaftar->lastItem() ?? 0 }} dari {{ $pendaftar->total() }} pendaftar</p>

        <div style="overflow-x:auto">
            <table style="width:100%;border-collapse:collapse;min-width:980px">
                <thead><tr style="background:#f8fafc;text-align:left">
                    <th style="padding:12px;width:55px">No.</th><th style="padding:12px">Nama</th><th style="padding:12px">Email</th><th style="padding:12px">NISN</th><th style="padding:12px">Sekolah</th><th style="padding:12px">Status</th><th style="padding:12px">Aksi</th>
                </tr></thead>
                <tbody>
                @forelse ($pendaftar as $user)
                    <tr style="border-top:1px solid #e5eaf2">
                        <td style="padding:12px;color:#64748b">{{ $pendaftar->firstItem() + $loop->index }}</td>
                        <td style="padding:12px">{{ $user->siswa?->nama_lengkap ?? 'Data siswa belum tersedia' }}</td>
                        <td style="padding:12px">{{ $user->email }}</td>
                        <td style="padding:12px">{{ $user->siswa?->nisn ?? '-' }}</td>
                        <td style="padding:12px">{{ $user->siswa?->sekolah?->nama_sekolah ?? '-' }}</td>
                        <td style="padding:12px">
                            @if ($user->status === 'approved')
                                <span style="display:inline-block;padding:5px 9px;border-radius:999px;background:#dcfce7;color:#166534;font-size:12px">Disetujui</span>
                            @elseif ($user->status === 'rejected')
                                <span style="display:inline-block;padding:5px 9px;border-radius:999px;background:#fee2e2;color:#991b1b;font-size:12px">Ditolak</span>
                            @else
                                <span style="display:inline-block;padding:5px 9px;border-radius:999px;background:#fef3c7;color:#92400e;font-size:12px">Menunggu</span>
                            @endif
                        </td>
                        <td style="padding:12px;white-space:nowrap">
                            <a href="{{ route('admin.siswa.approval.show', $user) }}" style="display:inline-block;padding:7px 10px;border:1px solid #cbd5e1;border-radius:6px;color:#334155;font-size:12px">Detail</a>
                            @if ($user->status === 'pending')
                                <form method="POST" action="{{ route('admin.siswa.approval.approve', $user) }}" style="display:inline" onsubmit="return confirm('Yakin ingin menyetujui pendaftaran siswa ini?')">
                                    @csrf @method('PATCH')
                                    <button type="submit" style="padding:7px 10px;background:#dcfce7;color:#166534;border:0;border-radius:6px;cursor:pointer">Setujui</button>
                                </form>
                                <a href="{{ route('admin.siswa.approval.show', $user) }}#tolak" style="display:inline-block;padding:7px 10px;background:#fee2e2;color:#991b1b;border-radius:6px;font-size:12px">Tolak</a>
                            @else
                                <span style="color:#64748b;font-size:12px;margin-left:5px">Sudah diproses</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="padding:24px;text-align:center;color:#64748b">Tidak ada pendaftar yang cocok dengan pencarian atau filter ini.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top:16px">{{ $pendaftar->links() }}</div>
    </div>
@endsection
