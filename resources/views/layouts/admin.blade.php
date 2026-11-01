
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin') | GUSPELOR.NET</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Inter, sans-serif;
            color: #172033;
            background: #f5f7fb;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* =========================
           LAYOUT
        ========================= */

        .admin-layout {
            min-height: 100vh;
            display: flex;
            align-items: stretch;
        }

        .admin-main {
            min-width: 0;
            flex: 1;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .admin-sidebar {
            width: 230px;
            flex: 0 0 230px;
            align-self: flex-start;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,.3) transparent;
            background: #17357f;
            color: #fff;
            padding: 25px 16px;
            z-index: 100;
            transition: transform .3s ease;
        }

        .admin-brand {
            display: block;
            padding: 0 10px 26px;
            font-size: 17px;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .admin-brand small {
            display: block;
            margin-top: 6px;
            font-size: 11px;
            font-weight: 400;
            color: #cbd8f7;
        }

        .admin-nav-title {
            padding: 22px 10px 10px;
            font-size: 10px;
            color: #b7c8f2;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .admin-nav-link {
            display: block;
            padding: 12px 11px;
            border-radius: 8px;
            margin-bottom: 5px;
            font-size: 13px;
            color: #fff;
            transition: background .2s ease;
        }

        .admin-nav-link.active,
        .admin-nav-link:hover {
            background: #315fc4;
        }

        .admin-sidebar-footer {
            margin-top: 32px;
            padding: 15px 10px;
            border-top: 1px solid rgba(255,255,255,.15);
            color: #cbd8f7;
            font-size: 11px;
            line-height: 1.6;
        }

        /* =========================
           TOPBAR
        ========================= */

        .admin-topbar {
            min-height: 68px;
            position: sticky;
            top: 0;
            z-index: 20;
            background: rgba(255,255,255,.96);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e5eaf2;
            padding: 15px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .admin-topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .admin-topbar strong {
            font-size: 15px;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-user-name {
            font-size: 12px;
            font-weight: 600;
        }

        .admin-user-role {
            color: #64748b;
            font-size: 11px;
            margin-top: 3px;
        }

        .admin-logout {
            background: #fff;
            border: 1px solid #d9e1ef;
            border-radius: 7px;
            padding: 8px 12px;
            color: #334155;
            cursor: pointer;
            font: inherit;
            font-size: 12px;
            transition: .2s;
        }

        .admin-logout:hover {
            background: #f1f5f9;
        }

        /* =========================
           HAMBURGER
        ========================= */

        .admin-menu-toggle {
            display: none;
            width: 40px;
            height: 40px;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            background: #fff;
            color: #17357f;
            font-size: 22px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* =========================
           OVERLAY
        ========================= */

        .admin-sidebar-overlay {
            display: none;
        }

        /* =========================
           CONTENT
        ========================= */

        .admin-content {
            max-width: 1200px;
            padding: 28px;
            margin: auto;
        }

        .admin-content h1 {
            font-size: 24px;
            margin: 0;
        }

        .admin-intro {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 8px 0 24px;
        }

        /* =========================
           DASHBOARD CARDS
        ========================= */

        .admin-cards {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .admin-card {
            background: #fff;
            border: 1px solid #e4e9f2;
            border-radius: 12px;
            padding: 19px;
            min-width: 0;
        }

        .admin-card-label {
            color: #64748b;
            font-size: 12px;
        }

        .admin-card-number {
            margin-top: 13px;
            font-size: 27px;
            font-weight: 700;
        }

        /* =========================
           SECTION
        ========================= */

        .admin-section {
            margin-top: 24px;
            background: #fff;
            border: 1px solid #e4e9f2;
            border-radius: 12px;
            padding: 20px;
        }

        .admin-section h2 {
            margin: 0 0 8px;
            font-size: 15px;
        }

        .admin-section p {
            margin: 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.7;
        }

        /* =========================
           SHORTCUTS
        ========================= */

        .admin-shortcuts {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 16px;
        }

        .admin-shortcut {
            border: 1px solid #e7ebf3;
            border-radius: 9px;
            padding: 14px;
            font-size: 12px;
            font-weight: 600;
        }

        .admin-shortcut span {
            display: block;
            margin-top: 6px;
            color: #64748b;
            font-weight: 400;
            line-height: 1.5;
        }

        /* =========================
           TABLET
        ========================= */

        @media (max-width: 900px) {
            .admin-cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .admin-shortcuts {
                grid-template-columns: 1fr;
            }

            .admin-content {
                padding: 22px;
            }
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 768px) {

            .admin-layout {
                display: block;
                min-height: 100vh;
            }

            /* Sidebar menjadi drawer */

            .admin-sidebar {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                width: 260px;
                height: 100dvh;
                max-height: none;
                padding: 24px 16px;
                overflow-y: auto;
                transform: translateX(-100%);
                transition: transform .3s ease;
                box-shadow: 5px 0 25px rgba(0,0,0,.12);
                z-index: 100;
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-brand {
                padding: 0 10px 20px;
            }

            .admin-nav-title {
                display: block;
            }

            .admin-nav-link {
                display: block;
                margin: 0 0 5px;
                padding: 12px 11px;
            }

            .admin-sidebar-footer {
                display: block;
            }

            /* Overlay */

            .admin-sidebar-overlay {
                position: fixed;
                inset: 0;
                z-index: 90;
                background: rgba(15,23,42,.45);
            }

            .admin-sidebar-overlay.show {
                display: block;
            }

            /* Main */

            .admin-main {
                width: 100%;
                min-width: 0;
            }

            /* Topbar */

            .admin-topbar {
                min-height: 64px;
                padding: 12px 16px;
                gap: 10px;
            }

            .admin-topbar-left {
                gap: 10px;
            }

            .admin-topbar-left strong {
                font-size: 14px;
            }

            /* Hamburger muncul */

            .admin-menu-toggle {
                display: flex;
            }

            .admin-user {
                gap: 8px;
            }

            .admin-user-name {
                max-width: 125px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .admin-logout {
                padding: 7px 9px;
                font-size: 11px;
            }

            /* Content */

            .admin-content {
                padding: 22px 16px;
            }

            .admin-cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
            }

            .admin-card {
                padding: 15px;
            }

            .admin-card-number {
                font-size: 23px;
            }

            .admin-shortcuts {
                grid-template-columns: 1fr;
            }
        }

        /* =========================
           SMALL MOBILE
        ========================= */

        @media (max-width: 400px) {

            .admin-topbar {
                padding: 10px;
            }

            .admin-topbar-left {
                gap: 8px;
            }

            .admin-topbar-left strong {
                font-size: 12px;
            }

            .admin-menu-toggle {
                width: 36px;
                height: 36px;
                font-size: 20px;
            }

            .admin-user {
                gap: 6px;
            }

            .admin-user-name {
                max-width: 85px;
                font-size: 10px;
            }

            .admin-user-role {
                font-size: 10px;
            }

            .admin-logout {
                padding: 7px;
                font-size: 10px;
            }

            .admin-content {
                padding: 18px 12px;
            }

            .admin-card {
                padding: 13px;
            }

            .admin-card-number {
                font-size: 21px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="admin-layout">

    <!-- OVERLAY MOBILE -->
    <div
        class="admin-sidebar-overlay"
        id="sidebarOverlay"
        onclick="closeAdminSidebar()">
    </div>

    <!-- SIDEBAR -->
    <aside class="admin-sidebar" id="adminSidebar">

        <a class="admin-brand" href="{{ route('admin.dashboard') }}">
            GUSPELOR.NET
            <small>Sistem Informasi PKL</small>
        </a>

        <div class="admin-nav-title">Menu Admin</div>

        <a
            class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            href="{{ route('admin.dashboard') }}">
            Dashboard
        </a>

        <a
            class="admin-nav-link"
            href="{{ route('admin.siswa.approval.index') }}">
            Persetujuan Siswa
        </a>

        <a
            class="admin-nav-link {{ request()->routeIs('admin.siswa.index', 'admin.siswa.show', 'admin.siswa.edit') ? 'active' : '' }}"
            href="{{ route('admin.siswa.index') }}">
            Data Siswa
        </a>

        <a
            class="admin-nav-link {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}"
            href="{{ route('admin.guru.index') }}">
            Guru Pembimbing
        </a>

        <a
            class="admin-nav-link {{ request()->routeIs('admin.sekolah-jurusan.*') ? 'active' : '' }}"
            href="{{ route('admin.sekolah-jurusan.index') }}">
            Sekolah & Jurusan
        </a>

        <a
            class="admin-nav-link {{ request()->routeIs('admin.absensi.index') ? 'active' : '' }}"
            href="{{ route('admin.absensi.index') }}">
            Absensi
        </a>

        <a
            class="admin-nav-link {{ request()->routeIs('admin.absensi.riwayat') ? 'active' : '' }}"
            href="{{ route('admin.absensi.riwayat') }}">
            Riwayat Absensi
        </a>

        <a
            class="admin-nav-link {{ request()->routeIs('admin.jurnal.index') ? 'active' : '' }}"
            href="{{ route('admin.jurnal.index') }}">
            Jurnal Harian
        </a>

        <a
            class="admin-nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"
            href="{{ route('admin.settings.edit') }}">
            Pengaturan Admin
        </a>

        <div class="admin-sidebar-footer">
            GUSPELOR.NET
            <br>
            Pengelolaan Praktik Kerja Lapangan
        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="admin-main">

        <!-- TOPBAR -->
        <header class="admin-topbar">

            <div class="admin-topbar-left">

                <!-- HAMBURGER MOBILE -->
                <button
                    type="button"
                    class="admin-menu-toggle"
                    id="adminMenuToggle"
                    onclick="toggleAdminSidebar()"
                    aria-label="Buka menu"
                    aria-expanded="false">
                    ☰
                </button>

                <strong>
                    @yield('page-heading', 'Panel Admin')
                </strong>

            </div>

            <!-- USER -->
            <div class="admin-user">

                <div>
                    <div class="admin-user-name">
                        {{ auth()->user()->email ?? 'Administrator' }}
                    </div>

                    <div class="admin-user-role">
                        Administrator
                    </div>
                </div>

                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="admin-logout" type="submit">
                        Keluar
                    </button>
                </form>

            </div>

        </header>

        <!-- PAGE CONTENT -->
        <section class="admin-content">
            @yield('content')
        </section>

    </main>

</div>

@stack('scripts')

<!-- SIDEBAR JAVASCRIPT -->
<script>
    const adminSidebar = document.getElementById('adminSidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const adminMenuToggle = document.getElementById('adminMenuToggle');

    // Buka dan tutup sidebar
    function toggleAdminSidebar() {
        const isOpen = adminSidebar.classList.contains('show');

        if (isOpen) {
            closeAdminSidebar();
        } else {
            openAdminSidebar();
        }
    }

    // Membuka sidebar
    function openAdminSidebar() {
        adminSidebar.classList.add('show');
        sidebarOverlay.classList.add('show');

        adminMenuToggle.setAttribute('aria-expanded', 'true');

        document.body.style.overflow = 'hidden';
    }

    // Menutup sidebar
    function closeAdminSidebar() {
        adminSidebar.classList.remove('show');
        sidebarOverlay.classList.remove('show');

        adminMenuToggle.setAttribute('aria-expanded', 'false');

        document.body.style.overflow = '';
    }

    // Tutup sidebar ketika menu diklik
    document.querySelectorAll('.admin-nav-link').forEach(link => {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                closeAdminSidebar();
            }
        });
    });

    // Tutup sidebar menggunakan tombol Escape
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeAdminSidebar();
        }
    });

    // Reset sidebar ketika ukuran layar berubah ke desktop
    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            closeAdminSidebar();
        }
    });
</script>

</body>
</html>
