@extends('layouts.admin')

@section('title', 'Data Siswa')
@section('page-heading', 'Data Siswa')

@push('styles')
<style>
.student-page{--student-blue:#17357f;--student-blue-2:#315fc4;--student-ink:#172b4d;--student-muted:#718096;--student-line:#e7ecf4}
.student-page *{box-sizing:border-box}
.student-page .page-heading{display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:22px}
.student-page .page-heading h1{font-size:23px;letter-spacing:-.55px;color:#172b4d}
.student-page .page-heading p{margin:7px 0 0;color:#718096;font-size:12px;line-height:1.6}
.student-page .primary-action{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:11px 15px;background:linear-gradient(135deg,#17357f,#315fc4);color:#fff;border-radius:9px;font-size:12px;font-weight:700;box-shadow:0 5px 13px rgba(23,53,127,.16);transition:.18s}
.student-page .primary-action:hover{transform:translateY(-1px);box-shadow:0 8px 18px rgba(23,53,127,.22)}
.student-page .student-stats{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:13px;margin-bottom:18px}
.student-page .stat-card{position:relative;min-width:0;display:flex;align-items:center;gap:12px;padding:16px;background:#fff;border:1px solid var(--student-line);border-radius:12px;box-shadow:0 3px 12px rgba(22,43,82,.025);overflow:hidden}
.student-page .stat-card:after{content:"";position:absolute;right:-19px;top:-23px;width:70px;height:70px;border-radius:50%;background:#f3f6fc}
.student-page .stat-icon{position:relative;z-index:1;width:39px;height:39px;flex:0 0 39px;border-radius:10px;display:grid;place-items:center;background:#edf3ff;color:#244a9b}
.student-page .stat-icon svg{width:19px;height:19px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.student-page .stat-copy{position:relative;z-index:1;min-width:0}
.student-page .stat-copy span{display:block;color:#7b8799;font-size:10px;font-weight:600}
.student-page .stat-copy strong{display:block;margin-top:4px;color:#1b3157;font-size:23px;line-height:1.1;letter-spacing:-.5px}
.student-page .stat-card.pending .stat-icon{background:#fff6e7;color:#b7791f}
.student-page .stat-card.active .stat-icon{background:#eaf7ef;color:#25844a}
.student-page .stat-card.alumni .stat-icon{background:#eef1f5;color:#64748b}
.student-page .notice{display:flex;align-items:center;gap:10px;padding:12px 14px;margin-bottom:16px;border:1px solid #dce7fb;background:#f4f7ff;border-radius:10px;color:#31517f;font-size:11px;line-height:1.55}
.student-page .notice svg{width:17px;height:17px;flex:0 0 17px;stroke:currentColor;fill:none;stroke-width:1.8}
.student-page .table-panel{background:#fff;border:1px solid var(--student-line);border-radius:13px;box-shadow:0 4px 18px rgba(22,43,82,.035);overflow:hidden}
.student-page .panel-top{padding:18px 19px 15px;border-bottom:1px solid #edf0f5}
.student-page .panel-title{display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;margin-bottom:15px}
.student-page .panel-title h2{margin:0;color:#1b3157;font-size:14px;font-weight:750}
.student-page .panel-title p{margin:5px 0 0;color:#8a96a8;font-size:10px}
.student-page .result-count{padding:6px 9px;border-radius:7px;background:#f1f5fb;color:#526783;font-size:10px;font-weight:650;white-space:nowrap}
.student-page .filter-form{display:grid;grid-template-columns:minmax(200px,1.5fr) repeat(3,minmax(135px,1fr)) auto;gap:9px;align-items:end}
.student-page .filter-field{min-width:0}
.student-page .filter-field label{display:block;margin:0 0 6px;color:#526078;font-size:10px;font-weight:700}
.student-page .filter-control{width:100%;height:39px;padding:0 11px;border:1px solid #dfe5ef;border-radius:8px;background:#fff;color:#334155;font:inherit;font-size:11px;outline:none;transition:border-color .15s,box-shadow .15s}
.student-page .filter-control:focus{border-color:#6386d2;box-shadow:0 0 0 3px rgba(49,95,196,.1)}
.student-page .search-wrap{position:relative}
.student-page .search-wrap svg{position:absolute;left:11px;top:12px;width:15px;height:15px;stroke:#94a3b8;fill:none;stroke-width:2;pointer-events:none}
.student-page .search-wrap input{padding-left:33px}
.student-page .filter-actions{display:flex;gap:7px}
.student-page .filter-submit,.student-page .filter-reset{height:39px;display:inline-flex;align-items:center;justify-content:center;padding:0 13px;border-radius:8px;font-size:10px;font-weight:700;white-space:nowrap}
.student-page .filter-submit{border:0;background:#17357f;color:#fff;cursor:pointer}
.student-page .filter-reset{border:1px solid #dfe5ef;color:#64748b;background:#fff}
.student-page .table-meta{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;padding:13px 19px 10px;color:#8490a2;font-size:10px}
.student-page .table-meta strong{color:#405575}
.student-page .table-scroll{width:100%;overflow-x:auto}
.student-page table{width:100%;min-width:1080px;border-collapse:separate;border-spacing:0;text-align:left}
.student-page thead th{padding:11px 13px;background:#f7f9fc;border-top:1px solid #edf0f5;border-bottom:1px solid #e9edf4;color:#718096;font-size:9px;font-weight:750;letter-spacing:.45px;text-transform:uppercase;white-space:nowrap}
.student-page tbody td{padding:12px 13px;border-bottom:1px solid #eff2f6;color:#536176;font-size:10px;vertical-align:middle}
.student-page tbody tr:last-child td{border-bottom:0}
.student-page tbody tr{transition:background .15s}
.student-page tbody tr:hover{background:#f9fbff}
.student-page .number-cell{width:48px;color:#9aa5b5;font-weight:650}
.student-page .student-person{display:flex;align-items:center;gap:9px;min-width:190px}
.student-page .student-avatar{width:36px;height:36px;flex:0 0 36px;display:grid;place-items:center;border-radius:10px;background:#eaf0ff;color:#244a9b;font-size:12px;font-weight:800;object-fit:cover}
.student-page .student-name{display:block;color:#243957;font-size:10px;font-weight:750;line-height:1.4}
.student-page .student-sub{display:block;margin-top:3px;color:#9aa5b5;font-size:9px}
.student-page .email-cell{max-width:190px;overflow-wrap:anywhere}
.student-page .period-cell{white-space:nowrap;line-height:1.65}
.student-page .period-cell small{display:block;color:#9aa5b5;font-size:9px}
.student-page .status-pill{display:inline-flex;align-items:center;gap:5px;padding:5px 8px;border-radius:20px;font-size:9px;font-weight:700;white-space:nowrap}
.student-page .status-pill:before{content:"";width:5px;height:5px;border-radius:50%;background:currentColor}
.student-page .status-approved,.student-page .status-active{background:#eaf7ef;color:#25844a}
.student-page .status-pending{background:#fff5df;color:#a66a0a}
.student-page .status-rejected{background:#fff0f0;color:#c04444}
.student-page .status-alumni{background:#eef1f5;color:#64748b}
.student-page .action-group{display:flex;align-items:center;gap:6px}
.student-page .row-action{display:inline-flex;align-items:center;justify-content:center;min-height:29px;padding:0 9px;border:1px solid #dce4f1;border-radius:7px;color:#31517f;font-size:9px;font-weight:700;white-space:nowrap;transition:.15s}
.student-page .row-action:hover{background:#f0f5ff;border-color:#b9cbed}
.student-page .row-action.edit{border-color:#dbe6fb;background:#edf3ff;color:#2451a0}
.student-page .empty-state{padding:42px 20px!important;text-align:center!important;color:#8793a5!important}
.student-page .empty-state .empty-icon{width:44px;height:44px;display:grid;place-items:center;margin:0 auto 10px;border-radius:13px;background:#f1f5fb;color:#8294b2}
.student-page .empty-state svg{width:21px;height:21px;stroke:currentColor;fill:none;stroke-width:1.7}
.student-page .empty-state strong{display:block;color:#52627c;font-size:11px;margin-bottom:5px}
.student-page .empty-state span{font-size:10px}
.student-page .pagination-wrap{display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;padding:14px 19px;border-top:1px solid #edf0f5}
.student-page .pagination-info{color:#8793a5;font-size:10px}
.student-page .pagination-info strong{color:#52627c}
.student-page .pagination{display:flex;align-items:center;gap:5px;flex-wrap:wrap}
.student-page .page-link{min-width:30px;height:30px;padding:0 9px;display:inline-flex;align-items:center;justify-content:center;border:1px solid #e1e7f0;border-radius:7px;background:#fff;color:#536783;font-size:10px;font-weight:650}
.student-page .page-link:hover{border-color:#b9cbed;background:#f5f8ff;color:#244a9b}
.student-page .page-link.current{border-color:#17357f;background:#17357f;color:#fff;box-shadow:0 3px 8px rgba(23,53,127,.16)}
.student-page .page-link.disabled{opacity:.4;pointer-events:none}
.student-page .alert-success{display:flex;align-items:center;gap:9px;padding:12px 14px;margin-bottom:16px;border:1px solid #ccebd6;background:#f0fbf4;border-radius:9px;color:#267345;font-size:11px}
.student-page .alert-success svg{width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2}
@media(max-width:1100px){.student-page .filter-form{grid-template-columns:repeat(2,minmax(0,1fr))}.student-page .filter-actions{grid-column:1/-1}}
@media(max-width:760px){.student-page .student-stats{grid-template-columns:repeat(2,minmax(0,1fr));gap:9px}.student-page .stat-card{padding:13px;gap:9px}.student-page .stat-icon{width:34px;height:34px;flex-basis:34px}.student-page .stat-copy strong{font-size:20px}.student-page .panel-top{padding:15px}.student-page .table-meta,.student-page .pagination-wrap{padding-left:15px;padding-right:15px}}
@media(max-width:480px){.student-page .page-heading h1{font-size:20px}.student-page .page-heading{margin-bottom:17px}.student-page .primary-action{width:100%}.student-page .student-stats{gap:8px}.student-page .stat-card{padding:11px 9px;align-items:flex-start}.student-page .stat-icon{width:31px;height:31px;flex-basis:31px;border-radius:8px}.student-page .stat-copy span{font-size:9px}.student-page .stat-copy strong{font-size:19px}.student-page .filter-form{grid-template-columns:1fr}.student-page .filter-actions{grid-column:auto}.student-page .filter-submit,.student-page .filter-reset{flex:1}.student-page .pagination-wrap{align-items:flex-start;flex-direction:column}.student-page .pagination{width:100%}}
</style>
@endpush

@section('content')
<div class="student-page">
    <div class="page-heading">
        <div>
            <h1>Data Siswa</h1>
            <p>Kelola identitas, akun, sekolah, dan periode PKL seluruh siswa dalam satu tempat.</p>
        </div>
        <a class="primary-action" href="{{ route('admin.siswa.create') }}">
            <span aria-hidden="true">＋</span> Tambah Siswa
        </a>
    </div>

    @if (session('success'))
        <div class="alert-success">
            <svg viewBox="0 0 24 24"><path d="m5 12 4 4L19 6"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="student-stats">
        <div class="stat-card">
            <div class="stat-icon"><svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M20 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
            <div class="stat-copy"><span>Total Siswa</span><strong>{{ number_format($ringkasan['total'], 0, ',', '.') }}</strong></div>
        </div>
        <div class="stat-card pending">
            <div class="stat-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></div>
            <div class="stat-copy"><span>Menunggu Persetujuan</span><strong>{{ number_format($ringkasan['menunggu'], 0, ',', '.') }}</strong></div>
        </div>
        <div class="stat-card active">
            <div class="stat-icon"><svg viewBox="0 0 24 24"><path d="m5 12 4 4L19 6"/><circle cx="12" cy="12" r="10"/></svg></div>
            <div class="stat-copy"><span>PKL Aktif</span><strong>{{ number_format($ringkasan['aktif'], 0, ',', '.') }}</strong></div>
        </div>
        <div class="stat-card alumni">
            <div class="stat-icon"><svg viewBox="0 0 24 24"><path d="M3 8.5 12 4l9 4.5-9 4.5-9-4.5Z"/><path d="M7 11v5c3 2.5 7 2.5 10 0v-5M21 9v6"/></svg></div>
            <div class="stat-copy"><span>Alumni</span><strong>{{ number_format($ringkasan['alumni'], 0, ',', '.') }}</strong></div>
        </div>
    </div>

    <div class="notice">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 11v5m0-8h.01"/></svg>
        Gunakan pencarian dan filter untuk menemukan siswa berdasarkan nama, NISN, email, status akun, status PKL, atau sekolah.
    </div>

    <section class="table-panel">
        <div class="panel-top">
            <div class="panel-title">
                <div>
                    <h2>Daftar Siswa</h2>
                    <p>Informasi akun dan penempatan praktik kerja lapangan</p>
                </div>
                <span class="result-count">{{ number_format($siswa->total(), 0, ',', '.') }} data ditemukan</span>
            </div>

            <form class="filter-form" method="GET" action="{{ route('admin.siswa.index') }}">
                <div class="filter-field">
                    <label for="cari">Cari siswa</label>
                    <div class="search-wrap">
                        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>
                        <input class="filter-control" id="cari" name="cari" type="search" value="{{ $cari }}" placeholder="Nama, email, atau NISN...">
                    </div>
                </div>
                <div class="filter-field">
                    <label for="status">Status akun</label>
                    <select class="filter-control" id="status" name="status">
                        <option value="" @selected($status === '')>Semua status</option>
                        <option value="pending" @selected($status === 'pending')>Menunggu</option>
                        <option value="approved" @selected($status === 'approved')>Disetujui</option>
                        <option value="rejected" @selected($status === 'rejected')>Ditolak</option>
                    </select>
                </div>
                <div class="filter-field">
                    <label for="status_magang">Status PKL</label>
                    <select class="filter-control" id="status_magang" name="status_magang">
                        <option value="" @selected($statusMagang === '')>Semua status</option>
                        <option value="aktif" @selected($statusMagang === 'aktif')>Aktif</option>
                        <option value="alumni" @selected($statusMagang === 'alumni')>Alumni</option>
                    </select>
                </div>
                <div class="filter-field">
                    <label for="sekolah_id">Asal sekolah</label>
                    <select class="filter-control" id="sekolah_id" name="sekolah_id">
                        <option value="">Semua sekolah</option>
                        @foreach ($sekolahs as $sekolah)
                            <option value="{{ $sekolah->id }}" @selected((string) $sekolahId === (string) $sekolah->id)>{{ $sekolah->nama_sekolah }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-actions">
                    <button class="filter-submit" type="submit">Terapkan</button>
                    @if ($cari !== '' || $status !== '' || $statusMagang !== '' || $sekolahId !== '')
                        <a class="filter-reset" href="{{ route('admin.siswa.index') }}">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="table-meta">
            <span>Menampilkan <strong>{{ $siswa->firstItem() ?? 0 }}–{{ $siswa->lastItem() ?? 0 }}</strong> dari <strong>{{ number_format($siswa->total(), 0, ',', '.') }}</strong> siswa</span>
            <span>10 data per halaman</span>
        </div>

        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Profil Siswa</th>
                        <th>NISN</th>
                        <th>Email</th>
                        <th>Sekolah</th>
                        <th>Guru Pembimbing</th>
                        <th>Periode PKL</th>
                        <th>Status PKL</th>
                        <th>Status Akun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswa as $item)
                        <tr>
                            <td class="number-cell">{{ $siswa->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="student-person">
                                    @if ($item->foto_profil)
                                        <img class="student-avatar" src="{{ asset('storage/' . $item->foto_profil) }}" alt="Foto {{ $item->nama_lengkap }}" loading="lazy" onerror="this.onerror=null;this.replaceWith(Object.assign(document.createElement('span'),{className:'student-avatar',textContent:'{{ mb_strtoupper(mb_substr($item->nama_lengkap, 0, 1)) }}'}))">
                                    @else
                                        <span class="student-avatar">{{ mb_strtoupper(mb_substr($item->nama_lengkap, 0, 1)) }}</span>
                                    @endif
                                    <span>
                                        <strong class="student-name">{{ $item->nama_lengkap }}</strong>
                                        <small class="student-sub">{{ $item->kelas?->nama_kelas ? 'Kelas '.$item->kelas->nama_kelas : 'Kelas belum diatur' }}</small>
                                    </span>
                                </div>
                            </td>
                            <td>{{ $item->nisn ?: '-' }}</td>
                            <td class="email-cell">{{ $item->user?->email ?? '-' }}</td>
                            <td>{{ $item->sekolah?->nama_sekolah ?? '-' }}</td>
                            <td>{{ $item->guru?->nama_lengkap ?? 'Belum ditetapkan' }}</td>
                            <td class="period-cell">
                                {{ $item->tanggal_mulai_pkl?->format('d/m/Y') ?? 'Belum diatur' }}
                                <small>s.d. {{ $item->tanggal_selesai_pkl?->format('d/m/Y') ?? 'Belum diatur' }}</small>
                            </td>
                            <td>
                                @if ($item->status_magang === 'Alumni')
                                    <span class="status-pill status-alumni">Alumni</span>
                                @else
                                    <span class="status-pill status-active">Aktif</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->user?->status === 'approved')
                                    <span class="status-pill status-approved">Disetujui</span>
                                @elseif ($item->user?->status === 'rejected')
                                    <span class="status-pill status-rejected">Ditolak</span>
                                @else
                                    <span class="status-pill status-pending">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-group">
                                    <a class="row-action" href="{{ route('admin.siswa.show', $item) }}">Profil</a>
                                    <a class="row-action edit" href="{{ route('admin.siswa.edit', $item) }}">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="empty-state" colspan="10">
                                <span class="empty-icon"><svg viewBox="0 0 24 24"><circle cx="10.5" cy="10.5" r="6.5"/><path d="m16 16 5 5M8 10h5"/></svg></span>
                                <strong>Data siswa tidak ditemukan</strong>
                                <span>Coba ubah kata kunci atau sesuaikan filter pencarian.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($siswa->hasPages())
            <div class="pagination-wrap">
                <div class="pagination-info">
                    Halaman <strong>{{ $siswa->currentPage() }}</strong> dari <strong>{{ $siswa->lastPage() }}</strong>
                </div>
                <nav class="pagination" aria-label="Navigasi halaman data siswa">
                    <a class="page-link {{ $siswa->onFirstPage() ? 'disabled' : '' }}" href="{{ $siswa->previousPageUrl() ?? '#' }}" aria-label="Halaman sebelumnya">‹</a>
                    @foreach ($siswa->getUrlRange(max(1, $siswa->currentPage() - 2), min($siswa->lastPage(), $siswa->currentPage() + 2)) as $page => $url)
                        <a class="page-link {{ $page === $siswa->currentPage() ? 'current' : '' }}" href="{{ $url }}" @if ($page === $siswa->currentPage()) aria-current="page" @endif>{{ $page }}</a>
                    @endforeach
                    <a class="page-link {{ $siswa->hasMorePages() ? '' : 'disabled' }}" href="{{ $siswa->nextPageUrl() ?? '#' }}" aria-label="Halaman berikutnya">›</a>
                </nav>
            </div>
        @endif
    </section>
</div>
@endsection
