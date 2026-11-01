@extends('layouts.siswa')
@section('title','Absensi Saya')
@section('page-heading','Absensi')
@section('content')
<h1>Absensi Saya</h1><p class="siswa-intro">Isi kehadiran satu kali setiap hari. Lokasi perangkat akan dicatat bersama waktu pengisian.</p>
<div class="siswa-stats" style="margin-bottom:20px">
<div class="siswa-card"><div class="siswa-stat-label">Hadir</div><div class="siswa-stat-value">{{ $totalHadir }}</div></div>
<div class="siswa-card"><div class="siswa-stat-label">Izin</div><div class="siswa-stat-value">{{ $totalIzin }}</div></div>
<div class="siswa-card"><div class="siswa-stat-label">Sakit / Alpa</div><div class="siswa-stat-value">{{ $totalSakit + $totalAlpa }}</div></div>
</div>
<div class="siswa-panel">
<h2>Absensi Hari Ini</h2>
@if($absensiHariIni)
<p class="siswa-muted">Kamu sudah mengisi absensi pada {{ $absensiHariIni->created_at?->format('d M Y, H:i') }} WIB.</p>
<span class="siswa-badge success">✓ {{ $absensiHariIni->status }}</span>
@else
<p class="siswa-muted" style="line-height:1.7">Tekan tombol di bawah. Browser akan meminta izin lokasi untuk menyimpan koordinat kehadiran. Pastikan GPS/lokasi perangkat aktif.</p>
<form id="attendance-form" method="POST" action="{{ route('siswa.absensi.store') }}" class="siswa-form">
@csrf
<input type="hidden" name="latitude" id="latitude"><input type="hidden" name="longitude" id="longitude">
<div class="siswa-field"><label for="keterangan">Keterangan (opsional)</label><textarea name="keterangan" id="keterangan" maxlength="500" placeholder="Contoh: Kegiatan PKL di kantor...">{{ old('keterangan') }}</textarea></div>
<div id="location-status" class="siswa-muted" aria-live="polite">Lokasi belum diambil.</div>
<div class="siswa-actions"><button class="siswa-btn" id="attendance-submit" type="button">Ambil Lokasi & Absen</button></div>
</form>
@endif
</div>
<div class="siswa-panel"><div style="display:flex;justify-content:space-between;gap:12px;align-items:center;flex-wrap:wrap"><h2 style="margin:0">Riwayat Absensi</h2><form method="GET" style="display:flex;gap:8px"><input type="month" name="bulan" value="{{ request('bulan') }}" style="padding:8px;border:1px solid #d7deea;border-radius:8px"><button class="siswa-btn">Filter</button></form></div>
<div class="siswa-table-wrap" style="margin-top:15px"><table><thead><tr><th>Tanggal</th><th>Waktu</th><th>Status</th><th>Keterangan</th></tr></thead><tbody>@forelse($absensis as $absensi)<tr><td>{{ $absensi->tanggal?->format('d M Y') }}</td><td>{{ $absensi->created_at?->format('H:i') ?? '-' }} WIB</td><td><span class="siswa-badge {{ $absensi->status==='Hadir'?'success':'info' }}">{{ $absensi->status }}</span></td><td>{{ $absensi->keterangan ?: '-' }}</td></tr>@empty<tr><td colspan="4" class="siswa-muted">Belum ada riwayat absensi.</td></tr>@endforelse</tbody></table></div><div class="siswa-pagination">{{ $absensis->links() }}</div></div>
@endsection
@push('scripts')
<script>
document.getElementById('attendance-submit')?.addEventListener('click', function () {
 const button=this, status=document.getElementById('location-status');
 if(!navigator.geolocation){status.textContent='Browser tidak mendukung fitur lokasi.';return;}
 button.disabled=true;button.textContent='Mengambil lokasi...';status.textContent='Meminta izin lokasi perangkat...';
 navigator.geolocation.getCurrentPosition(function(position){
  document.getElementById('latitude').value=position.coords.latitude;
  document.getElementById('longitude').value=position.coords.longitude;
  status.textContent='Lokasi berhasil didapatkan. Absensi sedang disimpan...';
  document.getElementById('attendance-form').submit();
 },function(error){
  button.disabled=false;button.textContent='Coba Ambil Lokasi Lagi';
  status.textContent=error.code===1?'Izin lokasi ditolak. Aktifkan izin lokasi pada browser.':'Lokasi gagal didapatkan. Periksa GPS dan koneksi, lalu coba lagi.';
 },{enableHighAccuracy:true,timeout:15000,maximumAge:0});
});
</script>
@endpush
