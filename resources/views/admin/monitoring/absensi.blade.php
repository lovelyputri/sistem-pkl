@extends('layouts.admin')

@section('title', 'Absensi Siswa')
@section('page-heading', 'Absensi Siswa')

@section('content')
<h1>Absensi Siswa</h1>
<p class="admin-intro">Pantau kehadiran siswa dan riwayat pengajuan izin dalam satu halaman. Admin hanya memantau; keputusan pengajuan tetap dilakukan Guru Pembimbing.</p>

<div class="admin-cards">
    <div class="admin-card"><div class="admin-card-label">Pengajuan Menunggu</div><div class="admin-card-number">{{ $totalIzinMenunggu }}</div></div>
    <div class="admin-card"><div class="admin-card-label">Pengajuan Disetujui</div><div class="admin-card-number">{{ $totalIzinDisetujui }}</div></div>
    <div class="admin-card"><div class="admin-card-label">Pengajuan Ditolak</div><div class="admin-card-number">{{ $totalIzinDitolak }}</div></div>
    <div class="admin-card"><div class="admin-card-label">Total Pengajuan</div><div class="admin-card-number">{{ $pengajuans->total() }}</div></div>
</div>

<div class="admin-section">
    <h2>Filter Data</h2>
    <form method="GET" style="display:flex;gap:12px;flex-wrap:wrap;align-items:end;margin-top:14px">
        <label style="font-size:12px">Tanggal absensi<input type="date" name="tanggal" value="{{ request('tanggal') }}" style="display:block;padding:10px;border:1px solid #d9e1ef;border-radius:7px;margin-top:5px"></label>
        <label style="font-size:12px">Nama siswa<input type="search" name="siswa" value="{{ request('siswa') }}" placeholder="Cari nama siswa..." style="display:block;padding:10px;border:1px solid #d9e1ef;border-radius:7px;margin-top:5px"></label>
        <label style="font-size:12px">Status absensi<select name="status" style="display:block;padding:10px;border:1px solid #d9e1ef;border-radius:7px;margin-top:5px"><option value="">Semua status</option>@foreach(['Hadir','Terlambat','Izin','Sakit','Alpa'] as $status)<option value="{{ $status }}" @selected(($statusFilter ?? '') === $status)>{{ $status }}</option>@endforeach</select></label>
        <label style="font-size:12px">Status pengajuan<select name="izin_status" style="display:block;padding:10px;border:1px solid #d9e1ef;border-radius:7px;margin-top:5px"><option value="">Semua status</option>@foreach(['Menunggu','Disetujui','Ditolak'] as $status)<option value="{{ $status }}" @selected(($izinStatusFilter ?? '') === $status)>{{ $status }}</option>@endforeach</select></label>
        <button class="admin-logout" type="submit">Terapkan Filter</button>
        <a class="admin-logout" href="{{ route('admin.absensi.index') }}">Reset</a>
    </form>
</div>

<div class="admin-section" style="overflow-x:auto">
    <h2>Riwayat Absensi</h2>
    <p style="margin-bottom:14px">Daftar kehadiran siswa PKL.</p>
    <table style="width:100%;border-collapse:collapse;font-size:13px">
        <thead><tr><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Tanggal</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Siswa</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Sekolah</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Status</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Keterangan</th></tr></thead>
        <tbody>
        @forelse($absensis as $absensi)
            <tr>
                <td style="padding:12px;border-bottom:1px solid #eef1f6">{{ optional($absensi->tanggal)->format('d-m-Y') }}</td>
                <td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $absensi->siswa->nama_lengkap ?? 'Siswa dihapus' }}</td>
                <td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $absensi->siswa->sekolah->nama_sekolah ?? '-' }}</td>
                <td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $absensi->status ?? '-' }}</td>
                <td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $absensi->keterangan ?: '-' }}</td>
            </tr>
        @empty
            <tr><td colspan="5" style="padding:20px;text-align:center;color:#64748b">Belum ada data absensi yang sesuai.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $absensis->links() }}</div>
</div>

<div class="admin-section" style="overflow-x:auto">
    <h2>Riwayat Pengajuan Izin</h2>
    <p style="margin-bottom:14px">Informasi pengajuan, dokumen pendukung, dan keputusan Guru Pembimbing. Admin tidak memiliki aksi menyetujui atau menolak.</p>
    <table style="width:100%;border-collapse:collapse;font-size:12px">
        <thead><tr><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Siswa</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Sekolah</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Periode Izin</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Jenis</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Guru Pembimbing</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Dokumen</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Status</th><th style="text-align:left;padding:12px;border-bottom:1px solid #e5eaf2">Catatan Guru</th></tr></thead>
        <tbody>
        @forelse($pengajuans as $izin)
            <tr>
                <td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $izin->siswa->nama_lengkap ?? '-' }}</td>
                <td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $izin->siswa->sekolah->nama_sekolah ?? '-' }}</td>
                <td style="padding:12px;border-bottom:1px solid #eef1f6;white-space:nowrap">{{ $izin->tanggal_mulai->format('d M Y') }} – {{ $izin->tanggal_selesai->format('d M Y') }}</td>
                <td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $izin->jenis_izin }}</td>
                <td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $izin->guru->nama_lengkap ?? '-' }}</td>
                <td style="padding:12px;border-bottom:1px solid #eef1f6">@if($izin->surat_path)<a href="{{ route('admin.izin.surat', $izin->id) }}" target="_blank" rel="noopener" style="color:#2563eb;font-weight:600;text-decoration:none">Lihat Dokumen</a>@else<span style="color:#94a3b8">Tidak ada file</span>@endif</td>
                <td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $izin->status }}</td>
                <td style="padding:12px;border-bottom:1px solid #eef1f6">{{ $izin->catatan_guru ?: '-' }}</td>
            </tr>
        @empty
            <tr><td colspan="8" style="padding:20px;text-align:center;color:#64748b">Belum ada pengajuan izin.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $pengajuans->links() }}</div>
</div>
@endsection
