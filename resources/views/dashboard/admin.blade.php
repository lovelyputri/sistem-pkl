@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-heading', 'Dashboard')

@section('content')
    <div class="dashboard-admin">
        <section class="dashboard-hero">
            <div class="dashboard-hero-copy">
                <span class="dashboard-eyebrow"><span class="dashboard-live-dot"></span> ADMIN OVERVIEW</span>
                <h1>Selamat datang kembali, {{ auth()->user()->nama_akun ?: 'Admin' }}.</h1>
                <p>Pantau aktivitas Praktik Kerja Lapangan dan kelola seluruh data dalam satu tempat.</p>
                <div class="dashboard-date">
                    <span class="dashboard-date-icon">◷</span>
                    <span>{{ now()->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>
            <div class="dashboard-hero-art" aria-hidden="true">
                <div class="hero-orbit hero-orbit-one"></div>
                <div class="hero-orbit hero-orbit-two"></div>
                <div class="hero-glass-card">
                    <span class="hero-card-kicker">GUSPELOR.NET</span>
                    <span class="hero-card-symbol">G</span>
                    <span class="hero-card-caption">Internship management</span>
                </div>
                <span class="hero-spark hero-spark-one">✦</span>
                <span class="hero-spark hero-spark-two">✧</span>
            </div>
        </section>

        <div class="dashboard-section-heading">
            <div>
                <span class="dashboard-overline">RINGKASAN</span>
                <h2>Statistik sistem</h2>
                <p>Gambaran singkat data yang tercatat di GUSPELOR.NET.</p>
            </div>
            <span class="dashboard-updated">Diperbarui {{ $tanggalDashboard }}</span>
        </div>

        <section class="dashboard-stats" aria-label="Statistik sistem">
            <article class="dashboard-stat stat-blue">
                <div class="stat-topline">
                    <span class="stat-label">Total siswa</span>
                    <span class="stat-icon">♙</span>
                </div>
                <div class="stat-value">{{ number_format($totalSiswa, 0, ',', '.') }}</div>
                <div class="stat-foot"><span class="stat-foot-dot"></span> Seluruh data siswa terdaftar</div>
                <div class="stat-decoration"></div>
            </article>

            <article class="dashboard-stat stat-violet">
                <div class="stat-topline">
                    <span class="stat-label">Guru pembimbing</span>
                    <span class="stat-icon">♧</span>
                </div>
                <div class="stat-value">{{ number_format($totalGuru, 0, ',', '.') }}</div>
                <div class="stat-foot"><span class="stat-foot-dot"></span> Data guru dalam sistem</div>
                <div class="stat-decoration"></div>
            </article>

            <article class="dashboard-stat stat-amber">
                <div class="stat-topline">
                    <span class="stat-label">Menunggu approval</span>
                    <span class="stat-icon">◷</span>
                </div>
                <div class="stat-value">{{ number_format($siswaPending, 0, ',', '.') }}</div>
                <div class="stat-foot"><span class="stat-foot-dot"></span> Pendaftaran perlu ditinjau</div>
                <div class="stat-decoration"></div>
            </article>

            <article class="dashboard-stat stat-teal">
                <div class="stat-topline">
                    <span class="stat-label">Absensi hari ini</span>
                    <span class="stat-icon">▣</span>
                </div>
                <div class="stat-value">{{ number_format($absensiHariIni, 0, ',', '.') }}</div>
                <div class="stat-foot"><span class="stat-foot-dot"></span> Catatan presensi hari ini</div>
                <div class="stat-decoration"></div>
            </article>
        </section>

        <section class="dashboard-main-grid">
            <article class="dashboard-panel dashboard-approval-panel">
                <div class="panel-heading">
                    <div>
                        <span class="dashboard-overline">PERLU PERHATIAN</span>
                        <h2>Pendaftaran siswa</h2>
                    </div>
                    <span class="panel-icon amber-icon">◷</span>
                </div>
                <div class="approval-content">
                    <div class="approval-number">{{ number_format($siswaPending, 0, ',', '.') }}</div>
                    <div>
                        <strong>{{ $siswaPending > 0 ? 'Pendaftaran menunggu pemeriksaan' : 'Tidak ada pendaftaran tertunda' }}</strong>
                        <p>{{ $siswaPending > 0 ? 'Periksa data pendaftar agar siswa dapat melanjutkan proses PKL.' : 'Semua pendaftaran yang masuk sudah ditangani.' }}</p>
                    </div>
                </div>
                <a href="{{ route('admin.siswa.approval.index') }}" class="dashboard-primary-link">
                    Tinjau pendaftaran <span>→</span>
                </a>
            </article>

            <article class="dashboard-panel dashboard-attendance-panel">
                <div class="panel-heading">
                    <div>
                        <span class="dashboard-overline">PRESENSI</span>
                        <h2>Aktivitas hari ini</h2>
                    </div>
                    <span class="panel-icon blue-icon">▣</span>
                </div>
                <div class="attendance-total">
                    <strong>{{ number_format($absensiHariIni, 0, ',', '.') }}</strong>
                    <span>catatan absensi tercatat hari ini</span>
                </div>
                <div class="attendance-track">
                    <span></span>
                </div>
                <p class="panel-note">Data akan bertambah ketika siswa mengirimkan presensi melalui akun masing-masing.</p>
                <a href="{{ route('admin.absensi.index') }}" class="dashboard-text-link">Lihat data absensi <span>→</span></a>
            </article>
        </section>

        <section class="dashboard-panel dashboard-quick-panel">
            <div class="panel-heading quick-heading">
                <div>
                    <span class="dashboard-overline">AKSES CEPAT</span>
                    <h2>Kelola sistem</h2>
                    <p class="quick-description">Pilih menu yang ingin kamu kelola.</p>
                </div>
            </div>
            <div class="dashboard-quick-links">
                <a href="{{ route('admin.siswa.index') }}" class="quick-link">
                    <span class="quick-link-icon quick-blue">♙</span>
                    <span class="quick-link-copy"><strong>Data siswa</strong><small>Lihat dan kelola siswa</small></span>
                    <span class="quick-arrow">↗</span>
                </a>
                <a href="{{ route('admin.guru.index') }}" class="quick-link">
                    <span class="quick-link-icon quick-violet">♧</span>
                    <span class="quick-link-copy"><strong>Guru pembimbing</strong><small>Kelola data dan penugasan</small></span>
                    <span class="quick-arrow">↗</span>
                </a>
                <a href="{{ route('admin.sekolah-jurusan.index') }}" class="quick-link">
                    <span class="quick-link-icon quick-teal">⌂</span>
                    <span class="quick-link-copy"><strong>Sekolah & jurusan</strong><small>Kelola data pendukung</small></span>
                    <span class="quick-arrow">↗</span>
                </a>
                <a href="{{ route('admin.jurnal.index') }}" class="quick-link">
                    <span class="quick-link-icon quick-amber">▤</span>
                    <span class="quick-link-copy"><strong>Jurnal harian</strong><small>Pantau kegiatan siswa</small></span>
                    <span class="quick-arrow">↗</span>
                </a>
            </div>
        </section>

        <footer class="dashboard-footer">
            <span>GUSPELOR.NET</span>
            <span>Sistem Informasi Praktik Kerja Lapangan</span>
        </footer>
    </div>
@endsection

@push('styles')
<style>
    .dashboard-admin{--ink:#17243b;--muted:#78859a;--line:#e8edf5;--blue:#315fce;--surface:#fff;color:var(--ink);width:100%}
    .dashboard-admin *{box-sizing:border-box}
    .dashboard-hero{position:relative;overflow:hidden;display:flex;align-items:center;justify-content:space-between;min-height:208px;padding:30px 36px;border-radius:18px;background:linear-gradient(112deg,#172f69 0%,#244b9e 58%,#3268c9 100%);color:#fff;box-shadow:0 12px 30px rgba(32,69,139,.13)}
    .dashboard-hero:after{content:"";position:absolute;width:330px;height:330px;border:1px solid rgba(255,255,255,.10);border-radius:50%;right:8%;top:-190px}
    .dashboard-hero-copy{position:relative;z-index:2;max-width:590px}
    .dashboard-eyebrow,.dashboard-overline{display:flex;align-items:center;gap:8px;font-size:9px;font-weight:800;letter-spacing:1.5px}
    .dashboard-eyebrow{color:#c6d8ff}
    .dashboard-live-dot,.stat-foot-dot{width:7px;height:7px;border-radius:50%;background:#70e1b2;display:inline-block}
    .dashboard-hero h1{font-size:clamp(22px,2.5vw,30px);line-height:1.2;letter-spacing:-.8px;margin:13px 0 9px;font-weight:750}
    .dashboard-hero p{font-size:12px;line-height:1.7;color:#d6e2ff;margin:0;max-width:480px}
    .dashboard-date{display:inline-flex;align-items:center;gap:8px;margin-top:20px;padding:8px 11px;border:1px solid rgba(255,255,255,.18);border-radius:8px;background:rgba(255,255,255,.09);font-size:10px;color:#eef4ff}
    .dashboard-date-icon{font-size:15px}
    .dashboard-hero-art{position:absolute;right:7%;top:0;width:270px;height:100%;display:flex;align-items:center;justify-content:center;opacity:.95}
    .hero-orbit{position:absolute;border:1px solid rgba(255,255,255,.18);border-radius:50%;transform:rotate(-25deg)}
    .hero-orbit-one{width:230px;height:115px}.hero-orbit-two{width:270px;height:155px;transform:rotate(35deg)}
    .hero-glass-card{position:relative;z-index:1;width:138px;height:142px;border:1px solid rgba(255,255,255,.3);border-radius:17px;background:linear-gradient(145deg,rgba(255,255,255,.24),rgba(255,255,255,.07));box-shadow:0 18px 38px rgba(7,25,66,.2);backdrop-filter:blur(9px);display:flex;flex-direction:column;align-items:center;justify-content:center;transform:rotate(7deg)}
    .hero-card-kicker{font-size:7px;letter-spacing:1.5px;color:#dbe8ff;font-weight:700}
    .hero-card-symbol{font-size:62px;font-weight:800;line-height:1.1;color:#fff;text-shadow:0 5px 20px rgba(255,255,255,.25)}
    .hero-card-caption{font-size:7px;color:#dbe8ff;letter-spacing:.6px}
    .hero-spark{position:absolute;color:#cfe1ff}.hero-spark-one{right:22px;top:43px;font-size:25px}.hero-spark-two{left:15px;bottom:37px;font-size:19px}
    .dashboard-section-heading{display:flex;align-items:flex-end;justify-content:space-between;gap:15px;margin:27px 1px 14px}
    .dashboard-overline{color:#8b98ad;margin-bottom:6px}
    .dashboard-section-heading h2,.panel-heading h2{font-size:16px;letter-spacing:-.3px;margin:0;font-weight:750;color:#1d2b43}
    .dashboard-section-heading p,.quick-description{font-size:11px;color:var(--muted);margin:5px 0 0}
    .dashboard-updated{font-size:10px;color:#8491a5;padding-bottom:2px}
    .dashboard-stats{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:13px}
    .dashboard-stat{position:relative;overflow:hidden;min-height:137px;padding:17px 18px;border:1px solid var(--line);border-radius:13px;background:#fff;box-shadow:0 3px 12px rgba(23,42,76,.025)}
    .stat-topline{display:flex;align-items:center;justify-content:space-between;gap:10px}
    .stat-label{font-size:11px;color:#69778d;font-weight:600}
    .stat-icon,.panel-icon{width:32px;height:32px;border-radius:10px;display:grid;place-items:center;font-size:16px}
    .stat-value{font-size:28px;line-height:1;margin:16px 0 10px;font-weight:800;letter-spacing:-1px;color:#1c2a42}
    .stat-foot{display:flex;align-items:center;gap:7px;font-size:9px;color:#8793a6}
    .stat-foot-dot{width:6px;height:6px;background:#a9b7cc}
    .stat-blue .stat-icon,.blue-icon,.quick-blue{background:#edf3ff;color:#3564cb}
    .stat-violet .stat-icon,.quick-violet{background:#f2efff;color:#7960c9}
    .stat-amber .stat-icon,.amber-icon,.quick-amber{background:#fff5e7;color:#d28b2d}
    .stat-teal .stat-icon,.quick-teal{background:#e9f8f5;color:#279b8b}
    .stat-decoration{position:absolute;width:72px;height:72px;border:12px solid rgba(49,95,206,.035);border-radius:50%;right:-22px;bottom:-36px}
    .dashboard-main-grid{display:grid;grid-template-columns:1.12fr .88fr;gap:13px;margin-top:14px}
    .dashboard-panel{background:#fff;border:1px solid var(--line);border-radius:13px;padding:19px;box-shadow:0 3px 12px rgba(23,42,76,.025)}
    .panel-heading{display:flex;align-items:center;justify-content:space-between;gap:12px}
    .approval-content{display:flex;align-items:center;gap:16px;margin:21px 0 18px}
    .approval-number{min-width:70px;font-size:40px;line-height:1;font-weight:800;letter-spacing:-1.5px;color:#d28b2d}
    .approval-content strong{font-size:11px;color:#29364c}
    .approval-content p,.panel-note{font-size:10px;line-height:1.6;color:#8491a5;margin:5px 0 0}
    .dashboard-primary-link{display:flex;align-items:center;justify-content:space-between;padding:11px 13px;border-radius:8px;background:#244d9d;color:#fff;font-size:10px;font-weight:700;transition:.2s}
    .dashboard-primary-link:hover{background:#193d84;transform:translateY(-1px)}
    .dashboard-primary-link span,.dashboard-text-link span{font-size:16px}
    .attendance-total{display:flex;align-items:baseline;gap:9px;margin:20px 0 13px}
    .attendance-total strong{font-size:34px;letter-spacing:-1px;color:#2c5fc2}
    .attendance-total span{font-size:10px;color:#8491a5}
    .attendance-track{height:7px;border-radius:20px;background:#edf1f7;overflow:hidden}
    .attendance-track span{display:block;width:100%;height:100%;border-radius:20px;background:linear-gradient(90deg,#4e7de0,#83a6f4);opacity:.75}
    .panel-note{margin-top:10px}
    .dashboard-text-link{display:inline-flex;align-items:center;gap:7px;margin-top:13px;color:#315fce;font-size:10px;font-weight:700}
    .dashboard-quick-panel{margin-top:14px;padding-bottom:17px}
    .quick-heading{margin-bottom:15px}
    .dashboard-quick-links{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:10px}
    .quick-link{min-width:0;display:flex;align-items:center;gap:10px;padding:12px;border:1px solid #edf0f5;border-radius:10px;transition:border-color .2s,transform .2s,box-shadow .2s}
    .quick-link:hover{border-color:#cbd8f4;transform:translateY(-2px);box-shadow:0 7px 18px rgba(35,69,130,.07)}
    .quick-link-icon{flex:0 0 34px;width:34px;height:34px;display:grid;place-items:center;border-radius:9px;font-size:16px}
    .quick-link-copy{display:flex;flex-direction:column;gap:4px;min-width:0}
    .quick-link-copy strong{font-size:10px;color:#29364c;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .quick-link-copy small{font-size:8px;color:#8a96a8;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .quick-arrow{margin-left:auto;color:#a0aabd;font-size:13px}
    .dashboard-footer{display:flex;justify-content:space-between;gap:12px;margin:17px 2px 2px;color:#9aa5b5;font-size:9px}
    .dashboard-footer span:first-child{font-weight:800;letter-spacing:1px;color:#73819a}
    @media(max-width:1100px){.dashboard-hero-art{right:2%}.dashboard-quick-links{grid-template-columns:repeat(2,minmax(0,1fr))}}
    @media(max-width:850px){.dashboard-stats{grid-template-columns:repeat(2,minmax(0,1fr))}.dashboard-main-grid{grid-template-columns:1fr}.dashboard-hero-art{opacity:.45;right:-20px}}
    @media(max-width:560px){.dashboard-hero{min-height:190px;padding:23px 20px}.dashboard-hero-art{display:none}.dashboard-hero h1{font-size:23px}.dashboard-section-heading{align-items:flex-start;flex-direction:column}.dashboard-updated{font-size:9px}.dashboard-stats{gap:9px}.dashboard-stat{padding:14px;min-height:125px}.stat-value{font-size:25px}.dashboard-panel{padding:15px}.dashboard-quick-links{grid-template-columns:1fr}.dashboard-footer{flex-direction:column;gap:4px}}
</style>
@endpush
