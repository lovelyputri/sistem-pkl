@extends('layouts.siswa')
@section('title','Absensi')
@section('page-heading','Absensi Harian')
@section('content')
<h1>Absensi Harian</h1><p class="s-intro">Catat kehadiranmu. Izinkan akses lokasi di browser agar koordinat perangkat dapat disimpan bersama absensi.</p>
<div class="s-panel" style="margin-top:0"><h2>Absensi Hari Ini · {{ now()->translatedFormat('l, d F Y') }}</h2>
@if($absensiHariIni)
<p>Absensi hari ini sudah tercatat dengan status <span class="s-badge">{{ $absensiHariIni->status }}</span>.</p><p class="s-muted">Waktu: {{ $absensiHariIni->created_at->format('H:i') }} @if($absensiHariIni->latitude && $absensiHariIni->longitude) · Koordinat: {{ $absensiHariIni->latitude }}, {{ $absensiHariIni->longitude }} @endif</p>
@else
<p class="s-muted">Pastikan kamu berada di tempat PKL sebelum melakukan absensi. Sistem ini merekam lokasi perangkat, tetapi belum membatasi jarak ke titik lokasi PKL.</p>
<form id="attendance-form" method="POST" action="{{ route('siswa.absensi.store') }}">@csrf
<input type="hidden" name="latitude" id="latitude"><input type="hidden" name="longitude" id="longitude">
<div class="s-field" style="max-width:600px;margin:15px 0"><label for="keterangan">Keterangan (opsional)</label><textarea name="keterangan" id="keterangan" maxlength="500" placeholder="Catatan singkat jika diperlukan"></textarea></div>
<p id="location-status" class="s-muted">Lokasi belum diambil.</p><button id="attendance-button" class="s-btn" type="button">Ambil Lokasi & Absen</button>
</form>
@endif
</div>
<div class="s-panel"><h2>Riwayat Absensi</h2><div class="s-table-wrap"><table><thead><tr><th>Tanggal</th><th>Status</th><th>Waktu</th><th>Koordinat</th><th>Keterangan</th></tr></thead><tbody>
@forelse($riwayat as $item)<tr><td>{{ $item->tanggal?->format('d/m/Y') }}</td><td><span class="s-badge">{{ $item->status }}</span></td><td>{{ $item->created_at->format('H:i') }}</td><td>{{ $item->latitude && $item->longitude ? $item->latitude.', '.$item->longitude : '-' }}</td><td>{{ $item->keterangan ?: '-' }}</td></tr>@empty<tr><td colspan="5" class="s-muted">Belum ada riwayat absensi.</td></tr>@endforelse
</tbody></table></div><div class="s-pagination">{{ $riwayat->links() }}</div></div>
@endsection
@push('scripts')
<script>
const attendanceButton = document.getElementById('attendance-button');
if (attendanceButton) {
 attendanceButton.addEventListener('click', () => {
  const status = document.getElementById('location-status');
  if (!navigator.geolocation) { status.textContent = 'Browser ini tidak mendukung akses lokasi.'; return; }
  attendanceButton.disabled = true; attendanceButton.textContent = 'Mengambil lokasi...'; status.textContent = 'Mohon izinkan akses lokasi.';
  navigator.geolocation.getCurrentPosition(position => {
   document.getElementById('latitude').value = position.coords.latitude;
   document.getElementById('longitude').value = position.coords.longitude;
   status.textContent = 'Lokasi berhasil diambil. Absensi sedang disimpan...';
   document.getElementById('attendance-form').submit();
  }, error => {
   const messages = {1:'Izin lokasi ditolak. Aktifkan izin lokasi pada browser.',2:'Lokasi perangkat tidak tersedia. Coba lagi.',3:'Permintaan lokasi habis waktu. Coba lagi.'};
   status.textContent = messages[error.code] || 'Lokasi gagal diambil.';
   attendanceButton.disabled = false; attendanceButton.textContent = 'Coba Ambil Lokasi Lagi';
  }, {enableHighAccuracy:true, timeout:15000, maximumAge:0});
 });
}
</script>
@endpush
