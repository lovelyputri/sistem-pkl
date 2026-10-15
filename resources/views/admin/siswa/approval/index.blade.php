@extends('layouts.admin')

@section('title', 'Persetujuan Siswa')
@section('page-heading', 'Persetujuan Siswa')

@section('content')
    <h1>Persetujuan Pendaftaran Siswa</h1>
    <p class="admin-intro">Semua pendaftaran siswa ditampilkan dalam satu tabel. Periksa kolom Status untuk melihat perkembangan pendaftaran.</p>

    @if (session('success'))
        <p style="padding:12px;background:#dcfce7;color:#166534;border-radius:8px">{{ session('success') }}</p>
    @endif
    @if (session('info'))
        <p style="padding:12px;background:#e0f2fe;color:#075985;border-radius:8px">{{ session('info') }}</p>
    @endif

    <div class="admin-section">
        <div style="overflow-x:auto">
            <table style="width:100%;border-collapse:collapse;min-width:850px">
                <thead>
                    <tr style="background:#f8fafc;text-align:left">
                        <th style="padding:12px">Nama</th>
                        <th style="padding:12px">Email</th>
                        <th style="padding:12px">NISN</th>
                        <th style="padding:12px">Sekolah</th>
                        <th style="padding:12px">Status</th>
                        <th style="padding:12px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendaftar as $user)
                        <tr style="border-top:1px solid #e5eaf2">
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
                                @if ($user->status === 'pending')
                                    <form method="POST" action="{{ route('admin.siswa.approval.approve', $user) }}" style="display:inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" style="padding:7px 10px;background:#dcfce7;color:#166534;border:0;border-radius:6px;cursor:pointer">Setujui</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.siswa.approval.reject', $user) }}" style="display:inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" style="padding:7px 10px;background:#fee2e2;color:#991b1b;border:0;border-radius:6px;cursor:pointer">Tolak</button>
                                    </form>
                                @else
                                    <span style="color:#64748b;font-size:12px">Sudah diproses</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" style="padding:24px;text-align:center;color:#64748b">Belum ada pendaftaran siswa.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top:16px">{{ $pendaftar->links() }}</div>
    </div>
@endsection
