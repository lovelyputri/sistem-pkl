@extends('layouts.siswa')
@section('title', 'Pengajuan Izin')
@section('page-heading', 'Pengajuan Izin')
@section('content')
@if (session('success'))
    <div role="status" style="margin-bottom:16px;padding:13px 15px;border:1px solid #bbf7d0;border-radius:9px;background:#f0fdf4;color:#166534;font-size:13px">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div role="alert" style="margin-bottom:16px;padding:13px 15px;border:1px solid #fecaca;border-radius:9px;background:#fef2f2;color:#991b1b;font-size:13px">{{ session('error') }}</div>
@endif
<div style="display:flex;justify-content:space-between;align-items:flex-start;gap:14px;flex-wrap:wrap">
    <div><h1>Pengajuan Izin</h1><p class="siswa-intro">Ajukan izin PKL dan pantau keputusan Guru Pembimbing.</p></div>
    <a href="{{ route('siswa.izin.create') }}" class="siswa-btn">+ Ajukan Izin</a>
</div>
<div class="siswa-panel">
    <h2>Riwayat Pengajuan</h2>
    <div class="siswa-table-wrap"><table>
        <thead><tr><th>Tanggal Izin</th><th>Jenis</th><th>Alasan</th><th>Status</th><th>Surat</th><th>Catatan Guru</th></tr></thead>
        <tbody>
        @forelse($pengajuans as $izin)
            <tr>
                <td>{{ $izin->tanggal_mulai->format('d M Y') }}@if(!$izin->tanggal_mulai->isSameDay($izin->tanggal_selesai)) – {{ $izin->tanggal_selesai->format('d M Y') }}@endif</td>
                <td>{{ $izin->jenis_izin }}</td><td style="min-width:180px;white-space:normal">{{ $izin->alasan }}</td>
                <td><span class="siswa-badge {{ $izin->status === 'Disetujui' ? 'success' : ($izin->status === 'Ditolak' ? 'warning' : 'info') }}">{{ $izin->status }}</span></td>
                <td><a class="siswa-btn secondary" target="_blank" href="{{ route('siswa.izin.surat', $izin) }}">Lihat Surat</a></td>
                <td style="min-width:160px;white-space:normal">{{ $izin->catatan_guru ?: '-' }}</td>
            </tr>
        @empty
            <tr><td colspan="6" style="text-align:center;padding:24px;color:#64748b">Belum ada pengajuan izin.</td></tr>
        @endforelse
        </tbody>
    </table></div>
    <div class="siswa-pagination">{{ $pengajuans->links() }}</div>
</div>
@endsection
