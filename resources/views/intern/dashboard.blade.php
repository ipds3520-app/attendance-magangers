
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Attendance Magangers</title>

    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#F97316">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Attendance">

    <link rel="icon" href="/icons/icon-192.png">
    <link rel="apple-touch-icon" href="/icons/icon-192.png">

    <style>
        /* =========================
           GLOBAL
        ========================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        :root {
            --orange: #F97316;
            --orange-dark: #EA580C;
            --orange-soft: #FFF7ED;
            --orange-border: #FED7AA;
            --cream: #FFFAF5;
            --white: #FFFFFF;
            --dark: #1E293B;
            --muted: #64748B;
            --muted-light: #94A3B8;
            --border: #E8EDF3;
            --green: #16A34A;
            --green-soft: #DCFCE7;
            --red: #DC2626;
            --red-soft: #FEE2E2;
            --shadow: 0 5px 24px rgba(15, 23, 42, 0.04);
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 24px;
        }

        body {
            background: var(--cream);
            color: var(--dark);
            min-height: 100vh;
        }

        button, a {
            -webkit-tap-highlight-color: transparent;
        }

        /* =========================
           LAYOUT
        ========================= */
        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* =========================
           SIDEBAR DESKTOP
        ========================= */
        .sidebar {
            width: 250px;
            flex-shrink: 0;
            background: #1C1917;
            color: white;
            padding: 28px 20px;
            display: flex;
            flex-direction: column;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 19px;
            font-weight: 800;
            margin-bottom: 40px;
            letter-spacing: -0.5px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            object-fit: contain;
        }

        .brand-text span {
            color: #FB923C;
        }

        .menu-label {
            color: #A8A29E;
            font-size: 10px;
            letter-spacing: 1.5px;
            font-weight: 700;
            margin: 0 0 14px 10px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #D6D3D1;
            padding: 13px 14px;
            border-radius: 12px;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu a:hover {
            background: #292524;
            color: white;
        }

        .menu a.active {
            background: #EA580C;
            color: white;
            font-weight: 600;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 17px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 30px;
        }

        .logout-btn {
            width: 100%;
            padding: 12px;
            background: transparent;
            border: 1px solid #44403C;
            border-radius: 12px;
            color: #E7E5E4;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background: #7F1D1D;
            border-color: #7F1D1D;
            color: white;
        }

        /* =========================
           MAIN
        ========================= */
        .main {
            flex: 1;
            min-width: 0;
            padding: 34px 42px;
            max-width: 1600px;
            margin: 0 auto;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .topbar-title h2 {
            font-size: 23px;
            font-weight: 750;
            letter-spacing: -0.5px;
        }

        .topbar-title p {
            color: var(--muted);
            font-size: 13px;
            margin-top: 6px;
        }

        .profile-mini {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            background: #FFEDD5;
            color: #C2410C;
            font-size: 17px;
            font-weight: 800;
        }

        .profile-mini strong {
            font-size: 13px;
            display: block;
        }

        .profile-mini small {
            color: var(--muted);
            font-size: 11px;
            display: block;
            margin-top: 4px;
        }

        /* =========================
           WELCOME
        ========================= */
        .welcome {
            position: relative;
            overflow: hidden;
            background: linear-gradient(125deg, #F97316, #FB923C);
            color: white;
            padding: 32px;
            border-radius: 24px;
            margin-bottom: 24px;
            box-shadow: 0 12px 30px rgba(249, 115, 22, 0.15);
        }

        .welcome::after {
            content: "";
            position: absolute;
            width: 210px;
            height: 210px;
            border: 35px solid rgba(255,255,255,0.10);
            border-radius: 50%;
            right: -65px;
            top: -80px;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
        }

        .welcome-tag {
            display: inline-block;
            padding: 7px 11px;
            background: rgba(255,255,255,0.18);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .welcome h1 {
            font-size: 27px;
            line-height: 1.35;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }

        .welcome p {
            font-size: 14px;
            color: #FFF7ED;
            line-height: 1.7;
            max-width: 550px;
        }

        /* =========================
           STATISTICS
        ========================= */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--white);
            padding: 22px;
            border: 1px solid #F1F0ED;
            border-radius: 18px;
            box-shadow: var(--shadow);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.06);
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 17px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            display: grid;
            place-items: center;
            font-size: 20px;
        }

        .stat-icon.orange {
            background: #FFF7ED;
        }

        .stat-icon.green {
            background: #DCFCE7;
        }

        .stat-icon.yellow {
            background: #FEF3C7;
        }

        .stat-value {
            font-size: 27px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .stat-label {
            font-size: 12px;
            color: var(--muted);
        }

        /* =========================
           CONTENT GRID
        ========================= */
        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(280px, 0.9fr);
            gap: 20px;
            align-items: start;
        }

        .panel {
            background: white;
            padding: 24px;
            border: 1px solid #F1F0ED;
            border-radius: 20px;
            box-shadow: var(--shadow);
            min-width: 0;
        }

        .panel-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 22px;
        }

        .panel-heading h3 {
            font-size: 17px;
            font-weight: 750;
        }

        .panel-heading p {
            font-size: 12px;
            color: var(--muted);
            margin-top: 5px;
        }

        /* =========================
           ALERTS
        ========================= */
        .alert {
            padding: 13px 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            font-size: 13px;
            line-height: 1.6;
        }

        .alert-success {
            background: var(--green-soft);
            color: #166534;
            border: 1px solid #BBF7D0;
        }

        .alert-error {
            background: var(--red-soft);
            color: #991B1B;
            border: 1px solid #FECACA;
        }

        /* =========================
           SCHEDULE
        ========================= */
        .schedule-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 12px;
            border-radius: 30px;
            background: var(--green-soft);
            color: #166534;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22C55E;
        }

        .schedule-info {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 18px;
        }

        .time-box {
            background: #FFFAF5;
            border: 1px solid #FDE7D3;
            padding: 17px;
            border-radius: 15px;
        }

        .time-box small {
            color: var(--muted);
            display: block;
            font-size: 11px;
            margin-bottom: 9px;
        }

        .time-box strong {
            display: block;
            font-size: 23px;
            color: #C2410C;
            font-weight: 800;
        }

        .schedule-details {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-bottom: 22px;
        }

        .detail-chip {
            padding: 8px 11px;
            background: #F8FAFC;
            border: 1px solid var(--border);
            border-radius: 9px;
            color: #475569;
            font-size: 11px;
        }

        /* =========================
           ATTENDANCE ACTION
        ========================= */
        .attendance-divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 20px 0;
        }

        .attendance-state {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 14px;
            border-radius: 13px;
            background: #F8FAFC;
            margin-bottom: 15px;
        }

        .attendance-state.success {
            background: #F0FDF4;
            border: 1px solid #DCFCE7;
        }

        .state-icon {
            width: 35px;
            height: 35px;
            flex-shrink: 0;
            border-radius: 11px;
            background: #DCFCE7;
            display: grid;
            place-items: center;
            color: #15803D;
            font-weight: 800;
        }

        .attendance-state strong {
            display: block;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .attendance-state p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .checkin-btn {
            width: 100%;
            min-height: 52px;
            border: none;
            border-radius: 14px;
            padding: 15px;
            background: var(--orange);
            color: white;
            font-size: 14px;
            font-weight: 750;
            cursor: pointer;
            transition: 0.2s;
        }

        .checkin-btn:hover {
            background: var(--orange-dark);
            transform: translateY(-1px);
        }

        .checkin-btn:active {
            transform: scale(0.98);
        }

        .checkin-btn:disabled {
            cursor: wait;
            opacity: 0.65;
            transform: none;
        }

        .checkout-btn {
            background: #16A34A;
        }

        .checkout-btn:hover {
            background: #15803D;
        }

        .gps-message {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
            margin-top: 12px;
        }

        .completed-box {
            padding: 16px;
            background: #F0FDF4;
            border: 1px solid #BBF7D0;
            border-radius: 14px;
            color: #166534;
        }

        .completed-box strong {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .completed-box p {
            font-size: 12px;
            line-height: 1.7;
        }

        .no-schedule {
            padding: 24px 15px;
            text-align: center;
            background: #FFFAF5;
            border-radius: 14px;
        }

        .no-schedule-icon {
            font-size: 32px;
            margin-bottom: 12px;
        }

        .no-schedule strong {
            display: block;
            margin-bottom: 8px;
        }

        .no-schedule p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        /* =========================
           PROFILE
        ========================= */
        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .profile-item {
            padding: 15px 0;
            border-bottom: 1px solid #F1F5F9;
        }

        .profile-item:last-child {
            border-bottom: none;
        }

        .profile-item small {
            display: block;
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 6px;
        }

        .profile-item strong {
            display: block;
            font-size: 13px;
            overflow-wrap: anywhere;
        }

        .profile-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #15803D !important;
        }

        /* =========================
           FOOTER
        ========================= */
        .footer {
            text-align: center;
            color: var(--muted-light);
            font-size: 11px;
            padding: 30px 10px 15px;
        }

        /* =========================
           MOBILE BOTTOM NAV
        ========================= */
        .mobile-bottom-nav {
            display: none;
        }

        /* =========================
           TABLET
        ========================= */
        @media (max-width: 1050px) {
            .sidebar {
                width: 220px;
            }

            .main {
                padding: 28px;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        /* =========================
           MOBILE
        ========================= */
        @media (max-width: 700px) {
            body {
                background: #FFFAF5;
            }

            .layout {
                display: block;
                min-height: 100vh;
            }

            /* MOBILE HEADER */
            .sidebar {
                width: 100%;
                height: auto;
                padding: 15px 18px;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                position: sticky;
                top: 0;
                z-index: 100;
                background: #1C1917;
            }

            .brand {
                font-size: 16px;
                margin: 0;
                gap: 9px;
            }

            .brand-icon {
                width: 34px;
                height: 34px;
                border-radius: 9px;
            }

            .menu,
            .menu-label {
                display: none;
            }

            .sidebar-bottom {
                margin: 0;
                padding: 0;
            }

            .logout-btn {
                width: auto;
                padding: 9px 12px;
                font-size: 11px;
                border-radius: 9px;
            }

            /* MAIN */
            .main {
                padding: 20px 16px 110px;
                width: 100%;
            }

            .topbar {
                margin-bottom: 20px;
                gap: 10px;
            }

            .topbar-title h2 {
                font-size: 20px;
            }

            .topbar-title p {
                font-size: 11px;
                margin-top: 5px;
            }

            .profile-mini {
                gap: 8px;
            }

            .profile-mini strong {
                font-size: 11px;
                max-width: 120px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .profile-mini small {
                font-size: 10px;
            }

            .avatar {
                width: 38px;
                height: 38px;
                border-radius: 12px;
                font-size: 14px;
            }

            /* WELCOME */
            .welcome {
                padding: 23px 20px;
                border-radius: 20px;
                margin-bottom: 18px;
            }

            .welcome::after {
                width: 150px;
                height: 150px;
                right: -55px;
                top: -55px;
                border-width: 25px;
            }

            .welcome-tag {
                font-size: 10px;
                padding: 6px 9px;
                margin-bottom: 12px;
            }

            .welcome h1 {
                font-size: 21px;
                line-height: 1.4;
                margin-bottom: 8px;
            }

            .welcome p {
                font-size: 12px;
                line-height: 1.65;
            }

            /* STATS */
            .stats {
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 9px;
                margin-bottom: 18px;
            }

            .stat-card {
                padding: 13px 10px;
                border-radius: 15px;
            }

            .stat-top {
                margin-bottom: 12px;
            }

            .stat-icon {
                width: 34px;
                height: 34px;
                font-size: 16px;
                border-radius: 10px;
            }

            .stat-value {
                font-size: 20px;
                margin-bottom: 5px;
            }

            .stat-label {
                font-size: 10px;
                line-height: 1.4;
            }

            /* PANELS */
            .content-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .panel {
                padding: 19px 16px;
                border-radius: 18px;
            }

            .panel-heading {
                margin-bottom: 18px;
            }

            .panel-heading h3 {
                font-size: 16px;
            }

            .panel-heading p {
                font-size: 11px;
            }

            .schedule-status {
                margin-bottom: 16px;
            }

            .schedule-info {
                gap: 10px;
                margin-bottom: 14px;
            }

            .time-box {
                padding: 14px 12px;
                border-radius: 13px;
            }

            .time-box small {
                font-size: 10px;
                margin-bottom: 7px;
            }

            .time-box strong {
                font-size: 21px;
            }

            .schedule-details {
                gap: 7px;
                margin-bottom: 18px;
            }

            .detail-chip {
                font-size: 10px;
                padding: 7px 9px;
            }

            .attendance-divider {
                margin: 17px 0;
            }

            .attendance-state {
                padding: 12px;
                gap: 9px;
            }

            .attendance-state strong {
                font-size: 12px;
            }

            .attendance-state p {
                font-size: 11px;
            }

            .checkin-btn {
                min-height: 52px;
                font-size: 13px;
                border-radius: 13px;
            }

            .gps-message {
                font-size: 11px;
            }

            .profile-item {
                padding: 13px 0;
            }

            .footer {
                padding-top: 20px;
                padding-bottom: 10px;
            }

            /* BOTTOM NAV */
            .mobile-bottom-nav {
                display: flex;
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                min-height: 72px;
                padding: 8px 12px calc(8px + env(safe-area-inset-bottom));
                background: rgba(255, 255, 255, 0.97);
                backdrop-filter: blur(14px);
                border-top: 1px solid #F1F5F9;
                box-shadow: 0 -5px 20px rgba(15, 23, 42, 0.04);
                justify-content: space-around;
                align-items: center;
                z-index: 999;
            }

            .mobile-bottom-nav a {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 5px;
                min-width: 65px;
                min-height: 48px;
                text-decoration: none;
                color: #A8A29E;
                font-size: 10px;
                font-weight: 600;
                transition: 0.2s;
            }

            .mobile-bottom-nav a span:first-child {
                font-size: 21px;
                line-height: 1;
            }

            .mobile-bottom-nav a.active {
                color: var(--orange);
            }

            .mobile-bottom-nav a.active span:first-child {
                background: #FFF7ED;
                border-radius: 12px;
                padding: 5px 14px;
            }
        }

        /* =========================
           SMALL MOBILE
        ========================= */
        @media (max-width: 380px) {
            .main {
                padding-left: 12px;
                padding-right: 12px;
            }

            .welcome {
                padding: 20px 16px;
            }

            .welcome h1 {
                font-size: 19px;
            }

            .stat-card {
                padding: 12px 7px;
            }

            .stat-value {
                font-size: 18px;
            }

            .stat-label {
                font-size: 9px;
            }

            .panel {
                padding: 17px 13px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            <img src="/icons/icon-192.png" alt="Attendance" class="brand-icon">
            <div class="brand-text">
                Attendance <span>Magangers</span>
            </div>
        </div>

        <div class="menu">
            <p class="menu-label">MENU UTAMA</p>

            <a href="#dashboard" class="active">
                <span class="menu-icon">⌂</span>
                Dashboard
            </a>

            <a href="#jadwal">
                <span class="menu-icon">▣</span>
                Jadwal Absensi
            </a>

            <a href="#riwayat">
                <span class="menu-icon">◷</span>
                Riwayat Absensi
            </a>

            <a href="#pengajuan">
                <span class="menu-icon">▤</span>
                Pengajuan Izin
            </a>

            <a href="#profil">
                <span class="menu-icon">♙</span>
                Profil Saya
            </a>
        </div>

        <div class="sidebar-bottom">
            <form action="{{ route('intern.logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-btn">
                    ↪ Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- MOBILE BOTTOM NAVIGATION -->
    <nav class="mobile-bottom-nav">
        <a href="#dashboard" class="active">
            <span>⌂</span>
            <span>Beranda</span>
        </a>

        <a href="#jadwal">
            <span>▣</span>
            <span>Jadwal</span>
        </a>

        <a href="#profil">
            <span>♙</span>
            <span>Profil</span>
        </a>
    </nav>

    <!-- MAIN -->
    <main class="main" id="dashboard">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="topbar-title">
                <h2>Dashboard</h2>

                <p>
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>

            <div class="profile-mini">

                <div class="avatar">
                    {{ strtoupper(substr($intern->name, 0, 1)) }}
                </div>

                <div>
                    <strong>{{ $intern->name }}</strong>
                    <small>Peserta Magang</small>
                </div>

            </div>

        </header>

        <!-- WELCOME -->
        <section class="welcome">

            <div class="welcome-content">

                <span class="welcome-tag">
                    ✦ ATTENDANCE MAGANGERS
                </span>

                <h1>Halo, {{ $intern->name }}! 👋</h1>

                <p>
                    Selamat datang di sistem presensi magang.
                    Pantau jadwal dan kehadiranmu dengan mudah
                    melalui dashboard ini.
                </p>

            </div>

        </section>

        <!-- STATISTICS -->
        <section class="stats">

            <div class="stat-card">

                <div class="stat-top">
                    <div class="stat-icon orange">📅</div>
                </div>

                <h3 class="stat-value">—</h3>
                <p class="stat-label">Total Kehadiran</p>

            </div>

            <div class="stat-card">

                <div class="stat-top">
                    <div class="stat-icon green">⏰</div>
                </div>

                <h3 class="stat-value">—</h3>
                <p class="stat-label">Tepat Waktu</p>

            </div>

            <div class="stat-card">

                <div class="stat-top">
                    <div class="stat-icon yellow">📋</div>
                </div>

                <h3 class="stat-value">—</h3>
                <p class="stat-label">Izin / Sakit</p>

            </div>

        </section>

        <!-- CONTENT -->
        <section class="content-grid">

            <!-- ATTENDANCE SCHEDULE -->
            <div class="panel" id="jadwal">

                <div class="panel-heading">
                    <div>
                        <h3>Jadwal Absensi</h3>
                        <p>Informasi presensi hari ini</p>
                    </div>
                </div>

                <!-- SUCCESS MESSAGE -->
                @if (session('success'))
                    <div class="alert alert-success">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                <!-- ERROR MESSAGE -->
                @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- VALIDATION ERRORS -->
                @if ($errors->any())
                    <div class="alert alert-error">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                @if ($schedule)

                    <div class="schedule-status">
                        <span class="status-dot"></span>
                        Jadwal Aktif
                    </div>

                    <!-- SCHEDULE TIME -->
                    <div class="schedule-info">

                        <div class="time-box">
                            <small>🟠 Jam Masuk</small>

                            <strong>
                                {{ substr($schedule->start_time, 0, 5) }}
                            </strong>
                        </div>

                        <div class="time-box">
                            <small>🟢 Jam Pulang</small>

                            <strong>
                                {{ substr($schedule->end_time, 0, 5) }}
                            </strong>
                        </div>

                    </div>

                    <!-- SCHEDULE DETAILS -->
                    <div class="schedule-details">

                        <span class="detail-chip">
                            ⏱ Toleransi {{ $schedule->late_tolerance }} menit
                        </span>

                        <span class="detail-chip">
                            📍 Radius {{ $schedule->allowed_radius }} meter
                        </span>

                    </div>

                    <hr class="attendance-divider">

                    <!-- CHECK-IN -->
                    @if (!$attendance)

                        <div class="attendance-state">

                            <div class="state-icon">!</div>

                            <div>
                                <strong>Belum melakukan check-in</strong>

                                <p>
                                    Pastikan GPS aktif dan kamu berada
                                    di area lokasi magang sebelum melakukan presensi.
                                </p>
                            </div>

                        </div>

                        <form id="checkInForm"
                              action="{{ route('intern.attendance.checkin') }}"
                              method="POST">

                            @csrf

                            <input type="hidden" name="latitude">
                            <input type="hidden" name="longitude">
                            <input type="hidden" name="accuracy">

                            <button type="button"
                                    class="checkin-btn"
                                    onclick="getLocation('checkInForm')">
                                📍 Check-in Sekarang
                            </button>

                        </form>

                    <!-- CHECK-OUT -->
                    @elseif (!$attendance->check_out_at)

                        <div class="attendance-state success">

                            <div class="state-icon">✓</div>

                            <div>
                                <strong>Check-in berhasil!</strong>

                                <p>
                                    Kamu sudah check-in pukul
                                    {{ $attendance->check_in_at->format('H:i:s') }}.
                                    Jangan lupa check-out saat selesai bekerja.
                                </p>
                            </div>

                        </div>

                        <form id="checkOutForm"
                              action="{{ route('intern.attendance.checkout') }}"
                              method="POST">

                            @csrf

                            <input type="hidden" name="latitude">
                            <input type="hidden" name="longitude">
                            <input type="hidden" name="accuracy">

                            <button type="button"
                                    class="checkin-btn checkout-btn"
                                    onclick="getLocation('checkOutForm')">
                                📍 Check-out Sekarang
                            </button>

                        </form>

                    <!-- COMPLETED -->
                    @else

                        <div class="completed-box">

                            <strong>✓ Presensi hari ini sudah lengkap!</strong>

                            <p>
                                Check-in:
                                {{ $attendance->check_in_at->format('H:i:s') }}
                                <br>

                                Check-out:
                                {{ $attendance->check_out_at->format('H:i:s') }}
                            </p>

                        </div>

                    @endif

                    <p id="gpsMessage" class="gps-message"></p>

                @else

                    <div class="no-schedule">

                        <div class="no-schedule-icon">🗓️</div>

                        <strong>Tidak ada jadwal aktif</strong>

                        <p>
                            Belum ada jadwal absensi untuk hari ini.
                            Silakan cek kembali nanti.
                        </p>

                    </div>

                @endif

            </div>

            <!-- PROFILE -->
            <div class="panel" id="profil">

                <div class="panel-heading">
                    <div>
                        <h3>Profil Peserta</h3>
                        <p>Informasi akun magangmu</p>
                    </div>
                </div>

                <div class="profile-info">

                    <div class="profile-item">
                        <small>Nama Lengkap</small>
                        <strong>{{ $intern->name }}</strong>
                    </div>

                    <div class="profile-item">
                        <small>Email</small>
                        <strong>{{ $intern->email }}</strong>
                    </div>

                    <div class="profile-item">
                        <small>Nomor Telepon</small>
                        <strong>{{ $intern->phone ?? '-' }}</strong>
                    </div>

                    <div class="profile-item">
                        <small>Status Akun</small>

                        <strong class="profile-status">
                            ● Aktif
                        </strong>
                    </div>

                </div>

            </div>

        </section>

        <!-- FOOTER -->
        <footer class="footer">
            © {{ date('Y') }} Attendance Magangers · Sistem Presensi Peserta Magang
        </footer>

    </main>

</div>

<!-- JAVASCRIPT GPS -->
<script>
    function getLocation(formId) {

        const message = document.getElementById('gpsMessage');
        const form = document.getElementById(formId);
        const button = form.querySelector('button');

        if (!navigator.geolocation) {
            message.textContent = 'Browser tidak mendukung GPS.';
            return;
        }

        button.disabled = true;
        button.style.opacity = '0.6';

        message.textContent = 'Sedang mengambil lokasi GPS...';

        navigator.geolocation.getCurrentPosition(

            function (position) {

                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                const accuracy = position.coords.accuracy;

                form.querySelector('[name="latitude"]').value = latitude;
                form.querySelector('[name="longitude"]').value = longitude;
                form.querySelector('[name="accuracy"]').value = accuracy;

                message.textContent =
                    'Lokasi berhasil ditemukan. Akurasi GPS: ' +
                    Math.round(accuracy) +
                    ' meter. Mengirim presensi...';

                form.submit();

            },

            function (error) {

                const errors = {
                    1: 'Izin lokasi ditolak. Aktifkan akses lokasi browser.',
                    2: 'Lokasi tidak berhasil ditemukan.',
                    3: 'Pengambilan lokasi terlalu lama. Coba lagi.'
                };

                message.textContent =
                    errors[error.code] || 'Terjadi kesalahan GPS.';

                button.disabled = false;
                button.style.opacity = '1';

            },

            {
                enableHighAccuracy: true,
                timeout: 15000,
                maximumAge: 0
            }

        );

    }
</script>

<!-- PWA SERVICE WORKER -->
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function () {
            navigator.serviceWorker.register('/sw.js')
                .then(function (registration) {
                    console.log(
                        'PWA Service Worker aktif:',
                        registration.scope
                    );
                })
                .catch(function (error) {
                    console.error(
                        'PWA Service Worker gagal:',
                        error
                    );
                });
        });
    }
</script>

</body>
</html>
