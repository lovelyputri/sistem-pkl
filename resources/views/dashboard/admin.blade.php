 @extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-heading', 'Dashboard Admin')

@push('styles')
<style>
/* =====================================================
   GUSPELOR.NET - ADMIN DASHBOARD
===================================================== */

.admin-content {
    max-width: none;
    width: 100%;
    padding: 12px 19px;
}

.dashboard {
    --navy: #102b70;
    --blue: #2154d9;
    --light-blue: #eaf0ff;
    --border: #d8deea;
    --muted: #71809a;
    color: var(--navy);
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 100%;
    min-width: 0;
    font-family: Inter, sans-serif;
}

.dashboard * {
    box-sizing: border-box;
}

.dashboard a {
    text-decoration: none;
    color: inherit;
}

/* =====================================================
   BARIS PERTAMA: WELCOME + KETERLAMBATAN
===================================================== */

.dashboard-top-grid {
    display: grid;
    grid-template-columns: 1.48fr 1fr;
    gap: 12px;
    min-width: 0;
}

.welcome-banner {
    position: relative;
    min-width: 0;
    min-height: 162px;
    overflow: hidden;
    display: flex;
    align-items: center;
    padding: 17px;
    border: 1px solid #d0dcf6;
    border-radius: 9px;
    background: #e4ecff;
}

.welcome-text {
    position: relative;
    z-index: 2;
    width: 60%;
}

.welcome-text h1 {
    margin: 0 0 5px;
    font-size: 23px;
    line-height: 1.25;
    font-weight: 750;
    letter-spacing: -.6px;
    color: #102b70;
}

.welcome-text p {
    margin: 0;
    max-width: 310px;
    color: #172e66;
    font-size: 11px;
    line-height: 1.45;
}

.welcome-date {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-top: 39px;
    font-size: 10px;
    font-weight: 600;
    color: #102b70;
}

.welcome-date svg {
    width: 16px;
    height: 16px;
    fill: #2154d9;
    stroke: #2154d9;
}

.welcome-illustration {
    position: absolute;
    width: 48%;
    height: 100%;
    right: 0;
    bottom: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    pointer-events: none;
}

.welcome-illustration svg {
    width: 100%;
    height: 100%;
    opacity: .16;
}

/* KETERLAMBATAN */

.late-panel {
    min-width: 0;
    min-height: 162px;
    padding: 10px 12px;
    border: 1px solid var(--border);
    border-radius: 9px;
    background: #fff;
}

.panel-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 8px;
    padding-bottom: 7px;
    border-bottom: 1px solid #e1e5ed;
}

.panel-heading h2 {
    margin: 0;
    font-size: 10px;
    font-weight: 700;
    color: var(--navy);
}

.small-link {
    padding: 4px 7px;
    border: 1px solid #d5e1ff;
    border-radius: 4px;
    color: #1747c5 !important;
    font-size: 8px;
    font-weight: 600;
    white-space: nowrap;
}

.late-content {
    display: grid;
    grid-template-columns: 39% 61%;
    min-height: 100px;
}

.late-summary {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 7px 8px 4px 0;
    border-right: 1px solid #e1e5ed;
}

.late-summary-main {
    display: flex;
    align-items: center;
    gap: 10px;
}

.late-clock {
    width: 58px;
    height: 58px;
    flex-shrink: 0;
    display: grid;
    place-items: center;
    border-radius: 50%;
    background: #ffe3e3;
    color: #ed1010;
}

.late-clock svg {
    width: 40px;
    height: 40px;
}

.late-number {
    font-size: 25px;
    font-weight: 750;
    line-height: 1;
}

.late-number small {
    display: block;
    margin-top: 5px;
    font-size: 8px;
    font-weight: 600;
    white-space: nowrap;
}

.late-summary p {
    margin: 7px 0 0;
    font-size: 8px;
    color: #102b70;
}

.late-list {
    padding: 3px 0 3px 9px;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    min-width: 0;
}

.late-list-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 5px;
    padding: 5px 0;
    border-bottom: 1px solid #edf0f5;
    font-size: 8px;
    min-width: 0;
}

.late-list-item:last-child {
    border-bottom: 0;
}

.late-list-item strong {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-weight: 500;
}

.late-list-item span {
    flex-shrink: 0;
    color: #ed1010;
    font-size: 8px;
}

/* =====================================================
   BARIS KEDUA: 4 STATISTIK
===================================================== */

.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 10px;
}

.stat-card {
    min-width: 0;
    min-height: 88px;
    padding: 11px;
    display: flex;
    align-items: center;
    gap: 11px;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 8px;
}

.stat-icon {
    width: 60px;
    height: 57px;
    flex-shrink: 0;
    display: grid;
    place-items: center;
    border-radius: 6px;
    color: #fff;
}

.stat-icon svg {
    width: 35px;
    height: 35px;
}

.stat-icon.blue { background: #2054d9; }
.stat-icon.green { background: #168519; }
.stat-icon.purple { background: #5014c7; }
.stat-icon.orange { background: #ed6200; }

.stat-info {
    min-width: 0;
    flex: 1;
}

.stat-label {
    font-size: 9px;
    color: #173477;
    font-weight: 600;
    line-height: 1.4;
}

.stat-number {
    margin-top: 4px;
    font-size: 23px;
    font-weight: 750;
    line-height: 1.1;
    color: #102b70;
}

.stat-description {
    margin-top: 5px;
    font-size: 8px;
    color: #1b3b81;
}

/* =====================================================
   PANEL UTAMA
===================================================== */

.dashboard-middle {
    display: grid;
    grid-template-columns: 1fr 1.1fr;
    gap: 10px;
    min-width: 0;
}

.dashboard-panel {
    min-width: 0;
    padding: 16px 20px;
    border: 1px solid #d5e0fa;
    border-radius: 9px;
    background: #fff;
}

.dashboard-panel-title {
    margin: 0 0 15px;
    font-size: 15px;
    font-weight: 750;
    color: #102b70;
}

/* =====================================================
   GRAFIK KEHADIRAN
===================================================== */

.attendance-content {
    display: grid;
    grid-template-columns: 1fr 1.1fr;
    align-items: center;
    gap: 12px;
    min-height: 190px;
}

.donut-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
}

.donut-chart {
    width: 181px;
    height: 181px;
    position: relative;
    border-radius: 50%;
    background: conic-gradient(
        #168519 0% var(--hadir-end),
        #ffad13 var(--hadir-end) var(--late-end),
        #303bff var(--late-end) var(--izin-end),
        #e91010 var(--izin-end) 100%
    );
}

.donut-chart::after {
    content: '';
    position: absolute;
    inset: 35px;
    border-radius: 50%;
    background: #fff;
}

.attendance-legend {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.legend-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 6px;
    font-size: 11px;
}

.legend-label {
    display: flex;
    align-items: center;
    gap: 10px;
}

.legend-color {
    width: 19px;
    height: 19px;
    border-radius: 4px;
    flex-shrink: 0;
}

.legend-value {
    font-weight: 700;
    white-space: nowrap;
}

.attendance-note {
    display: flex;
    align-items: center;
    gap: 9px;
    margin-top: 14px;
    padding: 9px 12px;
    border-radius: 6px;
    background: #e8efff;
    color: #153477;
    font-size: 11px;
    font-weight: 500;
}

.attendance-note svg {
    width: 16px;
    height: 16px;
    color: #1555ed;
}

/* =====================================================
   STATISTIK JURNAL
===================================================== */

.journal-main {
    display: grid;
    grid-template-columns: 1fr .8fr;
    align-items: center;
    gap: 15px;
    min-height: 168px;
}

.journal-circle-wrap {
    display: flex;
    justify-content: center;
}

.journal-circle {
    position: relative;
    width: 156px;
    height: 156px;
    border-radius: 50%;
    background: conic-gradient(
        #214fe5 calc(var(--progress) * 1%),
        #dedede 0
    );
    display: grid;
    place-items: center;
    transform: rotate(-90deg);
}

.journal-circle::before {
    content: '';
    position: absolute;
    inset: 11px;
    border-radius: 50%;
    background: #fff;
}

.journal-circle-content {
    position: relative;
    z-index: 1;
    transform: rotate(90deg);
    text-align: center;
}

.journal-circle-content strong {
    display: block;
    font-size: 37px;
    line-height: 1;
    font-weight: 750;
    color: #102b70;
}

.journal-circle-content span {
    display: block;
    margin-top: 6px;
    font-size: 10px;
    font-weight: 600;
}

.journal-numbers {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.journal-number strong {
    display: block;
    font-size: 22px;
    font-weight: 750;
    color: #102b70;
}

.journal-number span {
    display: block;
    margin-top: 2px;
    font-size: 10px;
    font-weight: 600;
}

.journal-number small {
    display: block;
    margin-top: 4px;
    color: #66748c;
    font-size: 8px;
}

.journal-comparison {
    margin-top: 8px;
    padding: 11px 14px;
    border: 1px solid #d8d8d8;
    border-radius: 9px;
}

.journal-comparison h3 {
    margin: 0 0 10px;
    font-size: 9px;
    color: #102b70;
}

.comparison-row {
    display: grid;
    grid-template-columns: 30px 1fr 24px;
    align-items: center;
    gap: 7px;
    margin-top: 8px;
    font-size: 8px;
}

.comparison-track {
    height: 6px;
    overflow: hidden;
    border-radius: 10px;
    background: #dce6ff;
}

.comparison-fill {
    height: 100%;
    border-radius: inherit;
    background: #173caa;
}

/* =====================================================
   BARIS TABEL + AKTIVITAS
===================================================== */

.dashboard-bottom {
    display: grid;
    grid-template-columns: 1.48fr 1fr;
    gap: 11px;
    align-items: stretch;
    min-width: 0;
}

.students-panel,
.activity-panel {
    min-width: 0;
    padding: 12px 19px;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 8px;
}

.students-panel h2,
.activity-panel h2 {
    margin: 0 0 9px;
    font-size: 15px;
    color: #102b70;
}

.student-table-wrap {
    width: 100%;
    overflow-x: auto;
}

.student-table {
    width: 100%;
    border-collapse: collapse;
    white-space: nowrap;
    font-size: 9px;
    color: #173477;
}

.student-table th {
    padding: 7px 6px;
    text-align: left;
    background: #e8efff;
    font-weight: 700;
    border-top: 1px solid #d3dcec;
    border-bottom: 1px solid #d3dcec;
}

.student-table td {
    padding: 6px;
    border-bottom: 1px solid #e3e6ec;
}

.student-table tr:last-child td {
    border-bottom: 0;
}

.student-table th:first-child,
.student-table td:first-child {
    text-align: center;
    width: 36px;
}

.student-name-cell {
    display: flex;
    align-items: center;
    gap: 7px;
}

.student-avatar {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid #dce3ef;
}

.student-empty {
    padding: 25px 10px !important;
    text-align: center;
    color: #8a96a9;
}

/* =====================================================
   AKTIVITAS TERBARU
===================================================== */

.activity-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
}

.activity-icon {
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    display: grid;
    place-items: center;
    border-radius: 7px;
    color: white;
}

.activity-icon svg {
    width: 21px;
    height: 21px;
}

.activity-icon.green { background: #168519; }
.activity-icon.purple { background: #5014c7; }
.activity-icon.blue { background: #2054d9; }
.activity-icon.orange { background: #ed7000; }
.activity-icon.red { background: #ed1010; }

.activity-info {
    flex: 1;
    min-width: 0;
}

.activity-info strong {
    display: block;
    color: #102b70;
    font-size: 10px;
    font-weight: 650;
    line-height: 1.45;
}

.activity-info small {
    display: block;
    margin-top: 2px;
    color: #173477;
    font-size: 10px;
    line-height: 1.35;
}

.activity-time {
    align-self: flex-start;
    flex-shrink: 0;
    color: #173caa;
    font-size: 8px;
    margin-top: 4px;
}

/* =====================================================
   QUICK ACTION
===================================================== */

.quick-panel {
    padding: 9px 12px 12px;
    border: 1px solid var(--border);
    border-radius: 8px;
    background: #fff;
}

.quick-panel h2 {
    margin: 0 0 9px;
    font-size: 13px;
    color: #102b70;
}

.quick-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 8px;
}

.quick-item {
    display: flex;
    align-items: center;
    gap: 9px;
    min-width: 0;
    padding: 8px;
    border: 1px solid #e6e8ed;
    border-radius: 6px;
    transition: .2s;
}

.quick-item:hover {
    background: #f5f8ff;
    border-color: #bdcdf2;
}

.quick-icon {
    display: grid;
    place-items: center;
    width: 35px;
    height: 35px;
    flex-shrink: 0;
    color: white;
    border-radius: 6px;
}

.quick-icon svg {
    width: 20px;
    height: 20px;
}

.quick-icon.blue { background: #2054d9; }
.quick-icon.green { background: #168519; }
.quick-icon.purple { background: #5014c7; }
.quick-icon.orange { background: #ed7000; }

.quick-info {
    flex: 1;
    min-width: 0;
}

.quick-info strong {
    display: block;
    font-size: 9px;
    color: #102b70;
}

.quick-info small {
    display: block;
    margin-top: 3px;
    color: #596b8a;
    font-size: 8px;
    line-height: 1.4;
}

.quick-arrow {
    font-size: 16px;
    color: #193b91;
    flex-shrink: 0;
}

/* =====================================================
   EMPTY STATE
===================================================== */

.dashboard-empty {
    padding: 18px;
    text-align: center;
    color: #94a3b8;
    font-size: 10px;
}

/* =====================================================
   RESPONSIVE
===================================================== */

@media (min-width: 1500px) {
    .dashboard {
        gap: 11px;
    }
}

@media (max-width: 1100px) {
    .dashboard-top-grid {
        grid-template-columns: 1.2fr 1fr;
    }

    .dashboard-stats {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .dashboard-bottom {
        grid-template-columns: 1fr;
    }

    .activity-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 760px) {
    .admin-content {
        padding: 12px;
    }

    .dashboard-top-grid,
    .dashboard-middle {
        grid-template-columns: 1fr;
    }

    .welcome-banner {
        min-height: 145px;
    }

    .late-panel {
        min-height: 145px;
    }

    .dashboard-bottom {
        grid-template-columns: 1fr;
    }

    .quick-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 480px) {
    .dashboard-stats {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 8px;
    }

    .stat-card {
        padding: 9px;
        gap: 8px;
    }

    .stat-icon {
        width: 39px;
        height: 43px;
    }

    .stat-icon svg {
        width: 25px;
        height: 25px;
    }

    .stat-number {
        font-size: 20px;
    }

    .welcome-text {
        width: 80%;
    }

    .welcome-text h1 {
        font-size: 19px;
    }

    .welcome-date {
        margin-top: 23px;
    }

    .dashboard-panel {
        padding: 13px;
    }

    .attendance-content {
        grid-template-columns: 1fr 1fr;
        gap: 7px;
    }

    .donut-chart {
        width: 135px;
        height: 135px;
    }

    .donut-chart::after {
        inset: 27px;
    }

    .attendance-legend {
        gap: 15px;
    }

    .legend-item {
        font-size: 9px;
    }

    .legend-color {
        width: 14px;
        height: 14px;
    }

    .journal-circle {
        width: 125px;
        height: 125px;
    }

    .journal-circle-content strong {
        font-size: 30px;
    }

    .journal-main {
        grid-template-columns: 1fr 1fr;
    }

    .activity-list {
        grid-template-columns: 1fr;
    }

    .quick-grid {
        grid-template-columns: 1fr 1fr;
    }

    .quick-item {
        padding: 7px;
    }
}
</style>
@endpush

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | Pengolahan data tampilan
    |--------------------------------------------------------------------------
    */

    $jumlahTerlambat = $absensiTerlambat->count();

    $hadirTepatWaktu = max(0, $absensiHadir - $jumlahTerlambat);

    $totalKehadiran = $hadirTepatWaktu
        + $jumlahTerlambat
        + $absensiIzin
        + $absensiSakit
        + $absensiAlpa;

    $totalKehadiran = max(1, $totalKehadiran);

    $hadirPersen = ($hadirTepatWaktu / $totalKehadiran) * 100;
    $terlambatPersen = ($jumlahTerlambat / $totalKehadiran) * 100;
    $izinPersen = ($absensiIzin / $totalKehadiran) * 100;

    $hadirEnd = $hadirPersen;
    $lateEnd = $hadirEnd + $terlambatPersen;
    $izinEnd = $lateEnd + $izinPersen;

    $persentaseJurnal = min(100, max(0, $persentaseJurnal));

    $jumlahAktivitas = $aktivitasTerbaru->count();
@endphp

<div class="dashboard">

    {{-- =================================================
         BANNER + ABSENSI TERLAMBAT
    ================================================== --}}

    <section class="dashboard-top-grid">

        <div class="welcome-banner">

            <div class="welcome-text">
                <h1>Selamat datang, Admin!</h1>

                <p>
                    Kelola seluruh aktivitas PKL siswa
                    di GUSPELOR.NET dengan mudah.
                </p>

                <div class="welcome-date">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="17" rx="2"/>
                        <path d="M16 2v4M8 2v4M3 10h18" fill="none"
                            stroke="white" stroke-width="2"/>
                    </svg>

                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>

            <div class="welcome-illustration">
                <svg viewBox="0 0 300 180" fill="none">
                    <circle cx="235" cy="35" r="25" fill="#315fca"/>
                    <circle cx="45" cy="50" r="30" fill="#315fca"/>
                    <circle cx="150" cy="130" r="55" stroke="#315fca" stroke-width="13"/>
                    <path d="M0 145L65 85L115 125L185 55L280 120"
                        stroke="#315fca" stroke-width="8"/>
                    <circle cx="65" cy="85" r="9" fill="#315fca"/>
                    <circle cx="185" cy="55" r="9" fill="#315fca"/>
                    <circle cx="280" cy="120" r="9" fill="#315fca"/>
                </svg>
            </div>

        </div>


        <div class="late-panel">

            <div class="panel-heading">
                <h2>Absensi Telat (Hari ini)</h2>
                <a href="{{ route('admin.absensi.index') }}" class="small-link">
                    Lihat Semua
                </a>
            </div>

            <div class="late-content">

                <div class="late-summary">

                    <div class="late-summary-main">

                        <div class="late-clock">
                            <svg viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 7v5l3 2"/>
                            </svg>
                        </div>

                        <div class="late-number">
                            {{ $jumlahTerlambat }}
                            <small>Siswa Telat</small>
                        </div>

                    </div>

                    <p>Total keterlambatan hari ini</p>

                </div>

                <div class="late-list">

                    @forelse($absensiTerlambat->take(5) as $item)
                        <div class="late-list-item">
                            <strong>{{ $item->nama_lengkap }}</strong>

                            <span>
                                {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}
                            </span>
                        </div>
                    @empty
                        <div class="dashboard-empty">
                            Tidak ada siswa terlambat.
                        </div>
                    @endforelse

                </div>

            </div>

        </div>

    </section>


    {{-- =================================================
         EMPAT KARTU STATISTIK
    ================================================== --}}

    <section class="dashboard-stats">

        {{-- TOTAL SISWA --}}
        <article class="stat-card">

            <div class="stat-icon blue">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="9" cy="7" r="4"/>
                    <circle cx="18" cy="8" r="3"/>
                    <path d="M2 21v-2a7 7 0 0 1 14 0v2z"/>
                    <path d="M16 15a6 6 0 0 1 6 6h-4v-2a8 8 0 0 0-2-4z"/>
                </svg>
            </div>

            <div class="stat-info">
                <div class="stat-label">Total Siswa</div>
                <div class="stat-number">{{ $totalSiswa }}</div>
                <div class="stat-description">Siswa terdaftar</div>
            </div>

        </article>


        {{-- TOTAL GURU --}}
        <article class="stat-card">

            <div class="stat-icon green">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="9" cy="7" r="4"/>
                    <circle cx="18" cy="8" r="3"/>
                    <path d="M2 21v-2a7 7 0 0 1 14 0v2z"/>
                    <path d="M16 15a6 6 0 0 1 6 6h-4v-2a8 8 0 0 0-2-4z"/>
                </svg>
            </div>

            <div class="stat-info">
                <div class="stat-label">Total Guru Pembimbing</div>
                <div class="stat-number">{{ $totalGuru }}</div>
                <div class="stat-description">Guru terdaftar</div>
            </div>

        </article>


        {{-- ABSENSI --}}
        <article class="stat-card">

            <div class="stat-icon purple">
                <svg viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <rect x="3" y="5" width="18" height="17" rx="2"/>
                    <path d="M8 3v4M16 3v4M3 10h18"/>
                    <path d="m8 15 3 3 6-6"/>
                </svg>
            </div>

            <div class="stat-info">
                <div class="stat-label">Absensi Hari Ini</div>
                <div class="stat-number">{{ $absensiHariIni }}</div>
                <div class="stat-description">Siswa sudah absen</div>
            </div>

        </article>


        {{-- JURNAL --}}
        <article class="stat-card">

            <div class="stat-icon orange">
                <svg viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2"
                    stroke-linecap="round">
                    <rect x="4" y="3" width="16" height="18" rx="2"/>
                    <path d="M8 8h8M8 12h8M8 16h5"/>
                </svg>
            </div>

            <div class="stat-info">
                <div class="stat-label">Jurnal Belum Diisi</div>
                <div class="stat-number">{{ $jurnalBelumIsi }}</div>
                <div class="stat-description">Siswa belum mengisi jurnal</div>
            </div>

        </article>

    </section>


    {{-- =================================================
         RINGKASAN KEHADIRAN + STATISTIK JURNAL
    ================================================== --}}

    <section class="dashboard-middle">

        {{-- KEHADIRAN --}}
        <div class="dashboard-panel">

            <h2 class="dashboard-panel-title">
                Ringkasan Kehadiran
            </h2>

            <div class="attendance-content">

                <div class="donut-wrapper">

                    <div class="donut-chart"
                        style="
                            --hadir-end: {{ $hadirEnd }}%;
                            --late-end: {{ $lateEnd }}%;
                            --izin-end: {{ $izinEnd }}%;
                        ">
                    </div>

                </div>

                <div class="attendance-legend">

                    <div class="legend-item">
                        <div class="legend-label">
                            <span class="legend-color" style="background:#168519"></span>
                            Hadir
                        </div>

                        <span class="legend-value">
                            {{ $hadirTepatWaktu }}
                            ({{ round($hadirPersen, 1) }}%)
                        </span>
                    </div>

                    <div class="legend-item">
                        <div class="legend-label">
                            <span class="legend-color" style="background:#ffad13"></span>
                            Terlambat
                        </div>

                        <span class="legend-value">
                            {{ $jumlahTerlambat }}
                            ({{ round($terlambatPersen, 1) }}%)
                        </span>
                    </div>

                    <div class="legend-item">
                        <div class="legend-label">
                            <span class="legend-color" style="background:#303bff"></span>
                            Izin
                        </div>

                        <span class="legend-value">
                            {{ $absensiIzin }}
                            ({{ round($izinPersen, 1) }}%)
                        </span>
                    </div>

                    <div class="legend-item">
                        <div class="legend-label">
                            <span class="legend-color" style="background:#e91010"></span>
                            Tidak hadir
                        </div>

                        <span class="legend-value">
                            {{ $absensiAlpa + $absensiSakit }}
                            ({{ round((($absensiAlpa + $absensiSakit) / $totalKehadiran) * 100, 1) }}%)
                        </span>
                    </div>

                </div>

            </div>

            <div class="attendance-note">
                <svg viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 11v5M12 7h.01"/>
                </svg>

                Data diperbarui setiap kali halaman dimuat
            </div>

        </div>


        {{-- JURNAL --}}
        <div class="dashboard-panel">

            <h2 class="dashboard-panel-title">
                Statistik Pengisian Jurnal Hari Ini
            </h2>

            <div class="journal-main">

                <div class="journal-circle-wrap">

                    <div class="journal-circle"
                        style="--progress: {{ $persentaseJurnal }}">

                        <div class="journal-circle-content">
                            <strong>{{ $persentaseJurnal }}%</strong>
                            <span>Jurnal Terisi</span>
                        </div>

                    </div>

                </div>

                <div class="journal-numbers">

                    <div class="journal-number">
                        <strong>{{ $siswaSudahMengisiJurnal }}</strong>
                        <span>Jurnal sudah terisi</span>
                        <small>dari {{ $totalSiswaAktif }} siswa aktif</small>
                    </div>

                    <div class="journal-number">
                        <strong>{{ $jurnalBelumIsi }}</strong>
                        <span>Jurnal belum terisi</span>
                        <small>dari {{ $totalSiswaAktif }} siswa aktif</small>
                    </div>

                </div>

            </div>

            <div class="journal-comparison">

                <h3>Perbandingan pengisian jurnal</h3>

                <div class="comparison-row">
                    <span>Hari ini</span>

                    <div class="comparison-track">
                        <div class="comparison-fill"
                            style="width: {{ $persentaseJurnal }}%">
                        </div>
                    </div>

                    <strong>{{ $persentaseJurnal }}%</strong>
                </div>

                <div class="comparison-row">
                    <span>Target</span>

                    <div class="comparison-track">
                        <div class="comparison-fill"
                            style="width:100%">
                        </div>
                    </div>

                    <strong>100%</strong>
                </div>

            </div>

        </div>

    </section>


    {{-- =================================================
         TABEL SISWA + AKTIVITAS TERBARU
    ================================================== --}}

    <section class="dashboard-bottom">

        {{-- SISWA AKTIF --}}
        <div class="students-panel">

            <h2>Siswa Aktif</h2>

            <div class="student-table-wrap">

                <table class="student-table">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Siswa</th>
                            <th>Sekolah</th>
                            <th>Masa Magang</th>
                            <th>Guru Pembimbing</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($siswaAktif as $index => $siswa)

                            <tr>
                                <td>{{ $index + 1 }}.</td>

                                <td>
                                    <div class="student-name-cell">

                                        <img
                                            class="student-avatar"
                                            src="{{ $siswa->foto_profil ? asset('storage/'.$siswa->foto_profil) : asset('images/logo.png') }}"
                                            alt="Foto siswa"
                                            onerror="this.src='{{ asset('images/logo.png') }}'">

                                        <span>{{ $siswa->nama_lengkap }}</span>

                                    </div>
                                </td>

                                <td>{{ $siswa->nama_sekolah ?? '-' }}</td>

                                <td>
                                    {{ $siswa->tanggal_mulai_pkl
                                        ? \Carbon\Carbon::parse($siswa->tanggal_mulai_pkl)->translatedFormat('d F Y')
                                        : '-' }}

                                    -

                                    {{ $siswa->tanggal_selesai_pkl
                                        ? \Carbon\Carbon::parse($siswa->tanggal_selesai_pkl)->translatedFormat('d F Y')
                                        : '-' }}
                                </td>

                                <td>{{ $siswa->nama_guru ?? '-' }}</td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="student-empty">
                                    Belum ada siswa aktif.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- AKTIVITAS TERBARU --}}
        <div class="activity-panel">

            <div class="panel-heading">
                <h2>Aktivitas Terbaru</h2>

                <a href="{{ route('admin.absensi.index') }}" class="small-link">
                    Lihat Semua
                </a>
            </div>

            <div class="activity-list">

                @forelse($aktivitasTerbaru as $aktivitas)

                    @php
                        $isAbsensi = $aktivitas->jenis === 'absensi';
                    @endphp

                    <div class="activity-item">

                        <div class="activity-icon {{ $isAbsensi ? 'green' : 'purple' }}">

                            @if($isAbsensi)
                                <svg viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="17" rx="2"/>
                                    <path d="M8 2v4M16 2v4M3 10h18"/>
                                    <path d="m8 15 3 3 5-5"/>
                                </svg>
                            @else
                                <svg viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <rect x="4" y="3" width="16" height="18" rx="2"/>
                                    <path d="M8 8h8M8 12h8M8 16h5"/>
                                </svg>
                            @endif

                        </div>

                        <div class="activity-info">

                            <strong>
                                {{ $aktivitas->nama_lengkap }}
                                {{ $isAbsensi ? 'melakukan absensi' : 'mengisi jurnal' }}
                            </strong>

                            <small>
                                {{ $isAbsensi
                                    ? 'Status: '.$aktivitas->keterangan
                                    : $aktivitas->keterangan }}
                            </small>

                        </div>

                        <span class="activity-time">
                            {{ \Carbon\Carbon::parse($aktivitas->created_at)->format('H:i') }}
                            WIB
                        </span>

                    </div>

                @empty

                    <div class="dashboard-empty">
                        Belum ada aktivitas terbaru.
                    </div>

                @endforelse

            </div>

        </div>

    </section>


    {{-- =================================================
         QUICK ACTION
    ================================================== --}}

    <section class="quick-panel">

        <h2>Quick Action</h2>

        <div class="quick-grid">

            {{-- KELOLA SISWA --}}
            <a href="{{ route('admin.siswa.index') }}" class="quick-item">

                <div class="quick-icon blue">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M2 21v-2a7 7 0 0 1 14 0v2z"/>
                        <path d="M19 8v6M16 11h6"
                            stroke="white" stroke-width="2"/>
                    </svg>
                </div>

                <div class="quick-info">
                    <strong>Kelola Siswa</strong>
                    <small>Tambah dan kelola data siswa</small>
                </div>

                <span class="quick-arrow">›</span>

            </a>


            {{-- KELOLA GURU --}}
            <a href="{{ route('admin.guru.index') }}" class="quick-item">

                <div class="quick-icon green">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M2 21v-2a7 7 0 0 1 14 0v2z"/>
                        <path d="M19 8v6M16 11h6"
                            stroke="white" stroke-width="2"/>
                    </svg>
                </div>

                <div class="quick-info">
                    <strong>Kelola Guru</strong>
                    <small>Tambah dan kelola guru pembimbing</small>
                </div>

                <span class="quick-arrow">›</span>

            </a>


            {{-- JURNAL --}}
            <a href="{{ route('admin.jurnal.index') }}" class="quick-item">

                <div class="quick-icon purple">
                    <svg viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <rect x="4" y="3" width="16" height="18" rx="2"/>
                        <path d="M8 8h8M8 12h8M8 16h5"/>
                    </svg>
                </div>

                <div class="quick-info">
                    <strong>Jurnal Harian</strong>
                    <small>Periksa jurnal harian siswa</small>
                </div>

                <span class="quick-arrow">›</span>

            </a>


            {{-- ABSENSI --}}
            <a href="{{ route('admin.absensi.index') }}" class="quick-item">

                <div class="quick-icon orange">
                    <svg viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M3 3v18h18"/>
                        <path d="m7 14 4-4 4 3 6-7"/>
                    </svg>
                </div>

                <div class="quick-info">
                    <strong>Data Absensi</strong>
                    <small>Lihat dan kelola data absensi</small>
                </div>

                <span class="quick-arrow">›</span>

            </a>

        </div>

    </section>

</div>

@endsection
