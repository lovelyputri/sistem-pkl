@extends('layouts.admin')

@section('title', 'Persetujuan Siswa')
@section('page-heading', 'Persetujuan Siswa')

@section('content')
    <h1>Persetujuan Pendaftaran Siswa</h1>
    <p class="admin-intro">Periksa pendaftaran siswa sebelum menyetujui atau menolaknya.</p>

    @if (session('success'))
        <p style="padding:12px;background:#dcfce7;color:#166534;border-radius:8px">{{ session('success') }}</p>
    @endif
    @if (session('info'))
        <p style="padding:12px;background:#e0f2fe;color:#075985;border-radius:8px">{{ session('info') }}</p>
    @endif

    <div class="admin-section">
        <p><strong>{{ $totalPending }}</strong> pendaftaran menunggu persetujuan.</p>
        <div style="overflow-x:auto;margin-top:16px">
            <table style="width:100%;border-collapse:collapse;min-width:760px">
                <thead>
                    <tr style="background:#f8fafc;text-align:left">
                        <th style="padding:12px">Nama</th>
                        <th style="padding:12px">Email</th>
                        <th style="padding:12px">NISN</th>
                        <th style="padding:12px">Sekolah</th>
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
                            <td style="padding:12px;white-space:nowrap">
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
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" style="padding:24px;text-align:center;color:#64748b">Belum ada pendaftaran yang menunggu persetujuan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top:16px">{{ $pendaftar->links() }}</div>
    </div>
@endsection
