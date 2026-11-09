 @extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-heading', 'Dashboard Admin')

@section('content')
@php
    $totalPresensi = max(1, $jumlahHadir + $jumlahTerlambat + $jumlahIzin + $jumlahSakit + $jumlahAlpa);
    $hadirPersen = round(($jumlahHadir / $totalPresensi) * 100);
    $terlambatPersen = round(($jumlahTerlambat / $totalPresensi) * 100);
    $izinPersen = round(($jumlahIzin / $totalPresensi) * 100);
    $sakitPersen = round(($jumlahSakit / $totalPresensi) * 100);
    $alpaPersen = max(0, 100 - $hadirPersen - $terlambatPersen - $izinPersen - $sakitPersen);
@endphp

<div class="dashboard-admin">
    <section class="dashboard-top-grid">
        <div class="dashboard-hero">
            <div class="hero-content">
                <span class="hero-kicker"><span class="hero-kicker-dot"></span> GUSPELOR.NET · ADMIN PANEL</span>
                <h1>Selamat datang, {{ auth()->user()->nama_akun ?: 'Admin' }}!</h1>
                <p>Kelola aktivitas Praktik Kerja Lapangan dengan lebih mudah. Pantau presensi, jurnal harian, dan data siswa dalam satu dashboard.</p>
                <div class="hero-bottom">
                    <span class="hero-date"><span>▦</span> {{ $tanggalDashboard }}</span>
                    <a href="{{ route('admin.siswa.approval.index') }}" class="hero-action">Periksa pendaftaran <span>→</span></a>
                </div>
            </div>
            <div class="hero-visual" aria-hidden="true">
                <div class="hero-visual-ring ring-a"></div>
                <div class="hero-visual-ring ring-b"></div>
                <div class="hero-visual-card">
                    <span class="visual-card-label">PKL OVERVIEW</span>
                    <div class="visual-bars"><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div>
                    <div class="visual-card-line"></div>
                    <div class="visual-card-line short"></div>
                </div>
                <span class="visual-float float-one">✓</span>
                <span class="visual-float float-two">✦</span>
                <span class="visual-float float-three">⌁</span>
            </div>
        </div>

        <aside class="dashboard-late-card">
            <div class="late-card-heading">
                <div><span class="section-kicker">PERLU DIPANTAU</span><h2>Presensi terlambat</h2></div>
                <span class="late-icon">◷</span>
            </div>
            <div class="late-number">{{ number_format($jumlahTerlambat, 0, ',', '.') }}</div>
            <p>Siswa yang melakukan presensi hadir setelah pukul 08.00 hari ini.</p>
            <div class="late-card-footer">
                <span><i></i> Data hari ini</span>
                <a href="{{ route('admin.absensi.index') }}">Lihat absensi →</a>
            </div>
        </aside>
    </section>

    <section class="dashboard-stats">
        <article class="stat-card stat-blue">
            <div class="stat-icon">♙</div>
            <div class="stat-content"><span>Total siswa aktif</span><strong>{{ number_format($totalSiswa, 0, ',', '.') }}</strong><small>Masih dalam periode PKL</small></div>
            <span class="stat-watermark">01</span>
        </article>
        <article class="stat-card stat-green">
            <div class="stat-icon">♧</div>
            <div class="stat-content"><span>Guru pembimbing</span><strong>{{ number_format($totalGuru, 0, ',', '.') }}</strong><small>Terdaftar dalam sistem</small></div>
            <span class="stat-watermark">02</span>
        </article>
        <article class="stat-card stat-purple">
            <div class="stat-icon">▣</div>
            <div class="stat-content"><span>Presensi hari ini</span><strong>{{ number_format($absensiHariIni, 0, ',', '.') }}</strong><small>Catatan presensi masuk</small></div>
            <span class="stat-watermark">03</span>
        </article>
        <article class="stat-card stat-orange">
            <div class="stat-icon">▤</div>
            <div class="stat-content"><span>Menunggu approval</span><strong>{{ number_format($siswaPending, 0, ',', '.') }}</strong><small>Pendaftaran siswa baru</small></div>
            <span class="stat-watermark">04</span>
        </article>
    </section>

    <section class="dashboard-insight-grid">
        <article class="dashboard-panel attendance-panel">
            <div class="panel-heading">
                <div><span class="section-kicker">RINGKASAN PRESENSI</span><h2>Kehadiran siswa hari ini</h2><p>Komposisi status presensi yang tercatat hari ini.</p></div>
                <a href="{{ route('admin.absensi.index') }}" class="panel-link">Detail <span>↗</span></a>
            </div>
            <div class="attendance-content">
                <div class="donut-chart" style="--hadir: {{ $hadirPersen }}%; --terlambat: {{ $terlambatPersen }}%; --izin: {{ $izinPersen }}%; --sakit: {{ $sakitPersen }}%; --alpa: {{ $alpaPersen }}%">
                    <div class="donut-center"><strong>{{ $absensiHariIni }}</strong><span>Presensi</span></div>
                </div>
                <div class="attendance-legend">
                    <div><span class="legend-label"><i class="legend-green"></i> Hadir</span><strong>{{ $jumlahHadir }}</strong></div>
                    <div><span class="legend-label"><i class="legend-orange"></i> Terlambat</span><strong>{{ $jumlahTerlambat }}</strong></div>
                    <div><span class="legend-label"><i class="legend-blue"></i> Izin</span><strong>{{ $jumlahIzin }}</strong></div>
                    <div><span class="legend-label"><i class="legend-yellow"></i> Sakit</span><strong>{{ $jumlahSakit }}</strong></div>
                    <div><span class="legend-label"><i class="legend-red"></i> Alpa</span><strong>{{ $jumlahAlpa }}</strong></div>
                </div>
            </div>
            <div class="panel-footnote"><span>ⓘ</span> Rekap dihitung dari data presensi tanggal {{ now()->format('d/m/Y') }}.</div>
        </article>

        <article class="dashboard-panel journal-panel">
            <div class="panel-heading">
                <div><span class="section-kicker">MONITORING JURNAL</span><h2>Pengisian jurnal harian</h2><p>Perbandingan siswa aktif yang sudah mengisi jurnal.</p></div>
                <a href="{{ route('admin.jurnal.index') }}" class="panel-link">Detail <span>↗</span></a>
            </div>
            <div class="journal-content">
                <div class="journal-progress">
                    <div class="journal-progress-inner"><strong>{{ $persentaseJurnal }}%</strong><span>Terisi hari ini</span></div>
                </div>
                <div class="journal-numbers">
                    <div><strong>{{ number_format($siswaIsiJurnal, 0, ',', '.') }}</strong><span>Siswa sudah mengisi</span></div>
                    <div><strong>{{ number_format($jurnalBelumIsi, 0, ',', '.') }}</strong><span>Belum mengisi jurnal</span></div>
                </div>
            </div>
            <div class="journal-bottom"><span>Progress pengisian</span><strong>{{ $persentaseJurnal }}%</strong><div class="progress-track"><i style="width: {{ $persentaseJurnal }}%"></i></div></div>
        </article>
    </section>

    <section class="dashboard-bottom-grid">
        <div class="dashboard-panel students-panel">
            <div class="panel-heading">
                <div><span class="section-kicker">DATA PESERTA PKL</span><h2>Siswa aktif</h2></div>
                <a href="{{ route('admin.siswa.index') }}" class="panel-link">Lihat semua <span>↗</span></a>
            </div>
            @if($siswaTerbaru->isNotEmpty())
                <div class="table-wrap">
                    <table class="student-table">
                        <thead><tr><th>Nama siswa</th><th>Sekolah</th><th>Periode PKL</th><th>Guru pembimbing</th></tr></thead>
                        <tbody>
                        @foreach($siswaTerbaru as $siswa)
                            <tr>
                                <td><div class="student-name">
                                    @if($siswa->foto_profil)
                                        <img src="{{ asset('storage/'.$siswa->foto_profil) }}" alt="" class="student-avatar">
                                    @else
                                        <span class="student-avatar student-avatar-fallback">{{ strtoupper(substr($siswa->nama_lengkap, 0, 1)) }}</span>
                                    @endif
                                    <span>{{ $siswa->nama_lengkap }}</span>
                                </div></td>
                                <td>{{ $siswa->nama_sekolah ?: '—' }}</td>
                                <td>{{ $siswa->tanggal_mulai_pkl ? \Carbon\Carbon::parse($siswa->tanggal_mulai_pkl)->format('d M Y') : 'Belum diatur' }}</td>
                                <td>{{ $siswa->nama_guru ?: 'Belum ditugaskan' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="dashboard-empty"><span>♙</span><strong>Belum ada siswa aktif</strong><p>Data siswa yang sedang menjalani PKL akan tampil di sini.</p></div>
            @endif
            <div class="student-table-footer"><span>Menampilkan maksimal 5 siswa aktif</span><a href="{{ route('admin.siswa.index') }}">Kelola data siswa →</a></div>
        </div>

        <aside class="dashboard-panel activity-panel">
            <div class="panel-heading"><div><span class="section-kicker">PEMBARUAN SISTEM</span><h2>Aktivitas terbaru</h2></div></div>
            @forelse($aktivitasTerbaru as $aktivitas)
                <div class="activity-item">
                    <span class="activity-icon {{ $aktivitas['jenis'] === 'absensi' ? 'activity-green' : 'activity-purple' }}">{{ $aktivitas['jenis'] === 'absensi' ? '✓' : '▤' }}</span>
                    <div class="activity-copy"><strong>{{ $aktivitas['judul'] }}</strong><p>{{ $aktivitas['deskripsi'] }}</p><small>{{ \Carbon\Carbon::parse($aktivitas['waktu'])->format('H:i') }} WIB</small></div>
                </div>
            @empty
                <div class="activity-empty">Belum ada aktivitas presensi atau jurnal hari ini.</div>
            @endforelse
        </aside>
    </section>

    <section class="dashboard-panel quick-panel">
        <div class="panel-heading"><div><span class="section-kicker">PINTASAN MENU</span><h2>Akses cepat</h2></div></div>
        <div class="quick-grid">
            <a href="{{ route('admin.siswa.index') }}" class="quick-item"><span class="quick-icon quick-blue">♙</span><span><strong>Kelola siswa</strong><small>Data peserta PKL</small></span><b>↗</b></a>
            <a href="{{ route('admin.guru.index') }}" class="quick-item"><span class="quick-icon quick-green">♧</span><span><strong>Kelola guru</strong><small>Data pembimbing</small></span><b>↗</b></a>
            <a href="{{ route('admin.absensi.index') }}" class="quick-item"><span class="quick-icon quick-purple">▣</span><span><strong>Data absensi</strong><small>Monitoring kehadiran</small></span><b>↗</b></a>
            <a href="{{ route('admin.jurnal.index') }}" class="quick-item"><span class="quick-icon quick-orange">▤</span><span><strong>Jurnal harian</strong><small>Monitoring kegiatan</small></span><b>↗</b></a>
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
.dashboard-admin{--navy:#142b62;--blue:#2858c7;--muted:#77849a;--line:#e5eaf2;color:#1b2b49;width:100%;min-width:0}
.dashboard-admin *{box-sizing:border-box}
.admin-content:has(.dashboard-admin){max-width:none;width:100%;padding:22px 24px 30px}
.dashboard-admin a{ text-decoration:none }
.dashboard-top-grid{display:grid;grid-template-columns:minmax(0,1.75fr) minmax(245px,.95fr);gap:14px}
.dashboard-hero{position:relative;overflow:hidden;min-height:190px;border-radius:15px;padding:25px 29px;display:flex;align-items:center;background:linear-gradient(112deg,#eaf1ff 0%,#dce8ff 58%,#cbdcff 100%);border:1px solid #d4e0f5}
.hero-content{position:relative;z-index:2;max-width:570px}
.hero-kicker,.section-kicker{font-size:9px;font-weight:800;letter-spacing:1.25px;color:#7183a5}
.hero-kicker{display:flex;align-items:center;gap:7px;color:#4568a9}
.hero-kicker-dot{width:7px;height:7px;background:#2b67d7;border-radius:50%;box-shadow:0 0 0 4px rgba(43,103,215,.12)}
.dashboard-hero h1{font-size:clamp(22px,2.2vw,29px);line-height:1.15;letter-spacing:-.9px;margin:12px 0 8px;color:#142c64;font-weight:800}
.dashboard-hero p{font-size:11px;line-height:1.7;color:#52678e;margin:0;max-width:430px}
.hero-bottom{display:flex;align-items:center;gap:17px;margin-top:18px}
.hero-date{font-size:9px;color:#52678e;font-weight:600}
.hero-date span{font-size:14px;margin-right:5px}
.hero-action{font-size:9px;font-weight:700;color:#fff;background:#2858c7;padding:8px 11px;border-radius:7px}
.hero-visual{position:absolute;right:5%;top:0;width:230px;height:100%;display:grid;place-items:center}
.hero-visual-ring{position:absolute;border:1px solid rgba(48,94,177,.16);border-radius:50%}
.ring-a{width:200px;height:110px;transform:rotate(-25deg)}.ring-b{width:245px;height:145px;transform:rotate(28deg)}
.hero-visual-card{z-index:1;width:132px;height:115px;border:1px solid rgba(255,255,255,.9);border-radius:13px;background:rgba(255,255,255,.78);box-shadow:0 13px 30px rgba(45,82,150,.13);padding:14px;transform:rotate(5deg)}
.visual-card-label{font-size:7px;letter-spacing:1px;color:#7b8eaf;font-weight:800}
.visual-bars{height:48px;display:flex;align-items:flex-end;gap:6px;padding:5px 2px 7px;border-bottom:1px solid #e3eaf6}
.visual-bars i{display:block;flex:1;border-radius:3px 3px 0 0;background:linear-gradient(#6e9cf1,#3268ce)}
.visual-bars i:nth-child(1){height:35%}.visual-bars i:nth-child(2){height:55%}.visual-bars i:nth-child(3){height:42%}.visual-bars i:nth-child(4){height:78%}.visual-bars i:nth-child(5){height:61%}.visual-bars i:nth-child(6){height:90%}.visual-bars i:nth-child(7){height:72%}
.visual-card-line{height:4px;width:80%;border-radius:5px;background:#dbe5f6;margin-top:8px}.visual-card-line.short{width:48%;margin-top:5px}
.visual-float{position:absolute;z-index:2;width:27px;height:27px;border-radius:9px;background:#fff;box-shadow:0 5px 14px #7d9ed333;display:grid;place-items:center;color:#3268ce;font-weight:800}
.float-one{right:6px;top:36px}.float-two{left:15px;top:40px;color:#e6a53b}.float-three{right:26px;bottom:25px;color:#36a58d}
.dashboard-late-card{border:1px solid var(--line);border-radius:15px;background:#fff;padding:17px 18px;display:flex;flex-direction:column;min-width:0}
.late-card-heading{display:flex;align-items:center;justify-content:space-between}
.late-card-heading h2,.panel-heading h2{font-size:15px;color:#1b2d54;letter-spacing:-.3px;margin:5px 0 0;font-weight:800}
.late-icon{width:34px;height:34px;border-radius:10px;background:#fff0ef;color:#e34b4b;display:grid;place-items:center;font-size:20px}
.late-number{font-size:39px;font-weight:800;letter-spacing:-1.5px;color:#1d3267;margin:15px 0 1px}
.dashboard-late-card>p{font-size:10px;line-height:1.55;color:#7c899e;margin:0;max-width:230px}
.late-card-footer{display:flex;align-items:center;justify-content:space-between;gap:8px;margin-top:auto;padding-top:15px;font-size:9px}
.late-card-footer span{color:#8793a7}.late-card-footer span i{display:inline-block;width:6px;height:6px;background:#e6a23c;border-radius:50%;margin-right:5px}
.late-card-footer a,.panel-link{font-size:9px;font-weight:700;color:#315fc6}
.dashboard-stats{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px;margin-top:13px}
.stat-card{position:relative;overflow:hidden;display:flex;align-items:center;gap:13px;min-height:96px;padding:15px 16px;border:1px solid var(--line);border-radius:13px;background:#fff}
.stat-icon{width:43px;height:43px;flex:0 0 43px;border-radius:11px;display:grid;place-items:center;font-size:22px;font-weight:700}
.stat-blue .stat-icon,.quick-blue{background:#eaf1ff;color:#2f61ca}.stat-green .stat-icon,.quick-green{background:#eaf7ef;color:#25844a}.stat-purple .stat-icon,.quick-purple{background:#f1edff;color:#704bd0}.stat-orange .stat-icon,.quick-orange{background:#fff2e6;color:#dd7a22}
.stat-content{display:flex;flex-direction:column;min-width:0;gap:3px;z-index:1}
.stat-content>span{font-size:10px;color:#718098;font-weight:600}
.stat-content strong{font-size:25px;line-height:1.1;color:#1b2e58;letter-spacing:-.7px}
.stat-content small{font-size:8px;color:#9aa5b6}
.stat-watermark{position:absolute;right:10px;bottom:-8px;font-size:42px;font-weight:800;color:#f5f7fb}
.dashboard-insight-grid{display:grid;grid-template-columns:1fr 1fr;gap:13px;margin-top:13px}
.dashboard-panel{min-width:0;border:1px solid var(--line);border-radius:13px;background:#fff;padding:17px 19px;box-shadow:0 3px 12px rgba(25,48,88,.025)}
.panel-heading{display:flex;align-items:center;justify-content:space-between;gap:12px}
.panel-heading p{font-size:9px;color:#8a96a9;margin:5px 0 0}
.panel-link{white-space:nowrap}
.panel-link span{font-size:13px;margin-left:3px}
.attendance-content{display:flex;align-items:center;justify-content:space-around;gap:20px;padding:14px 4px 12px}
.donut-chart{width:145px;height:145px;flex:0 0 145px;border-radius:50%;display:grid;place-items:center;background:conic-gradient(#18833c 0 var(--hadir),#ed9d24 var(--hadir) calc(var(--hadir) + var(--terlambat)),#3869e9 calc(var(--hadir) + var(--terlambat)) calc(var(--hadir) + var(--terlambat) + var(--izin)),#e5b84b calc(var(--hadir) + var(--terlambat) + var(--izin)) calc(var(--hadir) + var(--terlambat) + var(--izin) + var(--sakit)),#e34b4b calc(var(--hadir) + var(--terlambat) + var(--izin) + var(--sakit)) 100%)}
.donut-center{width:105px;height:105px;border-radius:50%;background:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center}
.donut-center strong{font-size:27px;color:#1b3269;line-height:1.1}.donut-center span{font-size:9px;color:#8591a5;margin-top:3px}
.attendance-legend{flex:1;display:flex;flex-direction:column;gap:13px;min-width:115px}
.attendance-legend>div{display:flex;justify-content:space-between;align-items:center;gap:10px;font-size:10px;color:#33466d}
.legend-label{display:flex;align-items:center;gap:8px}.legend-label i{width:10px;height:10px;border-radius:3px;display:inline-block}
.legend-green{background:#18833c}.legend-blue{background:#3869e9}.legend-orange{background:#ed9d24}.legend-yellow{background:#e5b84b}.legend-red{background:#e34b4b}
.attendance-legend strong{font-size:11px;color:#1e3261}
.panel-footnote{display:flex;align-items:center;gap:8px;padding:9px 11px;border-radius:7px;background:#f1f5ff;color:#5d7199;font-size:9px}
.panel-footnote span{font-size:13px;color:#3769d2}
.journal-content{display:flex;align-items:center;justify-content:space-evenly;gap:18px;padding:14px 0 12px}
.journal-progress{width:145px;height:145px;flex:0 0 145px;border-radius:50%;display:grid;place-items:center;background:conic-gradient(#285ce0 0 {{ $persentaseJurnal }}%,#e9edf4 {{ $persentaseJurnal }}% 100%);transform:rotate(-90deg)}
.journal-progress-inner{width:111px;height:111px;border-radius:50%;background:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center;transform:rotate(90deg)}
.journal-progress-inner strong{font-size:29px;color:#1b3269;line-height:1.1}.journal-progress-inner span{font-size:9px;color:#8793a7;margin-top:4px}
.journal-numbers{display:flex;flex-direction:column;gap:17px}
.journal-numbers div{display:flex;flex-direction:column;gap:3px}
.journal-numbers strong{font-size:24px;color:#1b3269;line-height:1.1}.journal-numbers span{font-size:9px;color:#78869d}
.journal-bottom{display:grid;grid-template-columns:1fr auto;gap:7px 12px;align-items:center;padding:10px 11px;border:1px solid #edf0f5;border-radius:8px}
.journal-bottom>span{font-size:9px;color:#6e7e98}.journal-bottom>strong{font-size:9px;color:#315fc6}
.progress-track{grid-column:1/-1;height:6px;background:#edf1f8;border-radius:9px;overflow:hidden}.progress-track i{display:block;height:100%;background:#315fc6;border-radius:9px}
.dashboard-bottom-grid{display:grid;grid-template-columns:minmax(0,1.55fr) minmax(260px,.85fr);gap:13px;margin-top:13px}
.students-panel{padding-bottom:12px}
.table-wrap{overflow-x:auto;margin-top:13px}
.student-table{width:100%;border-collapse:collapse;white-space:nowrap}
.student-table th{padding:9px 10px;background:#f2f5fb;text-align:left;font-size:9px;color:#526481;font-weight:700}
.student-table td{padding:9px 10px;border-bottom:1px solid #edf0f5;font-size:9px;color:#53627b}
.student-table tbody tr:last-child td{border-bottom:0}
.student-name{display:flex;align-items:center;gap:8px;font-weight:700;color:#263b65}
.student-avatar{width:25px;height:25px;border-radius:50%;object-fit:cover;flex:0 0 25px}
.student-avatar-fallback{display:grid;place-items:center;background:#e8efff;color:#315fc6;font-size:10px}
.student-table-footer{display:flex;justify-content:space-between;gap:10px;border-top:1px solid #edf0f5;padding:11px 2px 0;margin-top:3px;font-size:8px;color:#98a2b2}
.student-table-footer a{color:#315fc6;font-weight:700}
.activity-panel{padding:17px 18px}
.activity-item{display:flex;align-items:flex-start;gap:10px;padding:13px 0;border-bottom:1px solid #f0f2f6}
.activity-item:last-child{border-bottom:0;padding-bottom:2px}
.activity-icon{width:31px;height:31px;flex:0 0 31px;border-radius:9px;display:grid;place-items:center;font-size:15px;font-weight:700}
.activity-green{background:#eaf7ef;color:#25844a}.activity-purple{background:#f1edff;color:#704bd0}
.activity-copy{min-width:0;display:grid;gap:3px}
.activity-copy strong{font-size:9px;line-height:1.45;color:#293d66}
.activity-copy p{font-size:8px;line-height:1.4;color:#8793a6;margin:0;overflow-wrap:anywhere}
.activity-copy small{font-size:8px;color:#a0a9b7}
.activity-empty,.dashboard-empty{padding:27px 12px;text-align:center;color:#8995a8;font-size:10px}
.dashboard-empty{display:flex;flex-direction:column;align-items:center;gap:6px}.dashboard-empty>span{font-size:24px;color:#9aabc8}.dashboard-empty strong{color:#52627c;font-size:11px}.dashboard-empty p{margin:0;font-size:9px}
.quick-panel{margin-top:13px;padding:16px 18px}
.quick-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:10px;margin-top:13px}
.quick-item{display:flex;align-items:center;gap:9px;min-width:0;padding:10px;border:1px solid #edf0f5;border-radius:9px;transition:.2s}
.quick-item:hover{border-color:#cbd8f2;transform:translateY(-2px);box-shadow:0 6px 16px #1d3e7410}
.quick-icon{width:33px;height:33px;flex:0 0 33px;border-radius:8px;display:grid;place-items:center;font-size:16px}
.quick-item>span:nth-child(2){display:flex;flex-direction:column;gap:3px;min-width:0}
.quick-item strong{font-size:9px;color:#2b3e65}.quick-item small{font-size:8px;color:#8b97a9;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.quick-item b{margin-left:auto;font-size:13px;color:#9aa7bc}
@media(max-width:1100px){.dashboard-top-grid{grid-template-columns:minmax(0,1.5fr) minmax(220px,.8fr)}.hero-visual{right:0;opacity:.6}.dashboard-bottom-grid{grid-template-columns:1fr}.quick-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:820px){.admin-content:has(.dashboard-admin){padding:17px}.dashboard-top-grid{grid-template-columns:1fr}.dashboard-late-card{min-height:160px}.dashboard-insight-grid{grid-template-columns:1fr}.dashboard-stats{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:560px){.admin-content:has(.dashboard-admin){padding:13px 11px 20px}.dashboard-hero{min-height:190px;padding:20px}.hero-visual{display:none}.dashboard-hero h1{font-size:23px}.hero-bottom{flex-wrap:wrap;gap:10px}.dashboard-stats{gap:8px}.stat-card{min-height:88px;padding:11px;gap:9px}.stat-icon{width:35px;height:35px;flex-basis:35px;font-size:18px}.stat-content>span{font-size:9px}.stat-content strong{font-size:21px}.stat-content small{font-size:7px}.dashboard-panel{padding:14px}.attendance-content,.journal-content{gap:10px}.donut-chart,.journal-progress{width:118px;height:118px;flex-basis:118px}.donut-center{width:86px;height:86px}.journal-progress-inner{width:88px;height:88px}.donut-center strong,.journal-progress-inner strong{font-size:23px}.attendance-legend{gap:10px}.journal-numbers strong{font-size:21px}.quick-grid{grid-template-columns:1fr}.student-table-footer{flex-direction:column}.panel-heading h2{font-size:14px}}
</style>
@endpush
