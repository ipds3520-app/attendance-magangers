
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Attendance</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: #f4f7fb;
            color: #1e293b;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #172554;
            color: white;
            padding: 28px 20px;
            display: flex;
            flex-direction: column;
        }

        .brand {
            font-size: 23px;
            font-weight: 700;
            margin-bottom: 45px;
        }

        .brand span {
            color: #60a5fa;
        }

        .menu-label {
            color: #94a3b8;
            font-size: 11px;
            letter-spacing: 1.5px;
            margin-bottom: 15px;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: #cbd5e1;
            padding: 13px 15px;
            border-radius: 9px;
            margin-bottom: 8px;
            font-size: 14px;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #2563eb;
            color: white;
        }

        .sidebar-bottom {
            margin-top: auto;
        }

        .logout-btn {
            width: 100%;
            padding: 12px;
            border: 1px solid #475569;
            background: transparent;
            color: white;
            border-radius: 9px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #dc2626;
            border-color: #dc2626;
        }

        /* MAIN CONTENT */
        .main {
            flex: 1;
            padding: 30px 40px;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .topbar h2 {
            font-size: 22px;
        }

        .date {
            color: #64748b;
            font-size: 13px;
        }

        .profile-mini {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            background: #dbeafe;
            color: #1d4ed8;
            display: grid;
            place-items: center;
            border-radius: 50%;
            font-weight: bold;
        }

        /* WELCOME */
        .welcome {
            background: linear-gradient(120deg, #1d4ed8, #2563eb);
            padding: 30px;
            color: white;
            border-radius: 16px;
            margin-bottom: 25px;
        }

        .welcome h1 {
            font-size: 25px;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #dbeafe;
            font-size: 14px;
        }

        /* STATISTICS */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(0,0,0,.03);
        }

        .stat-card .icon {
            font-size: 25px;
            margin-bottom: 15px;
        }

        .stat-card h3 {
            font-size: 25px;
            margin-bottom: 5px;
        }

        .stat-card p {
            color: #64748b;
            font-size: 13px;
        }

        /* CONTENT GRID */
        .content-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 20px;
        }

        .panel {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(0,0,0,.03);
        }

        .panel h3 {
            margin-bottom: 20px;
            font-size: 17px;
        }

        .schedule-info {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 18px;
        }

        .schedule-info small {
            display: block;
            color: #64748b;
            margin-bottom: 7px;
        }

        .schedule-info strong {
            font-size: 17px;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            background: #fef3c7;
            color: #92400e;
            border-radius: 20px;
            font-size: 12px;
            margin-bottom: 18px;
        }

        .checkin-btn {
            width: 100%;
            border: none;
            padding: 13px;
            background: #2563eb;
            color: white;
            border-radius: 9px;
            font-weight: 600;
            cursor: pointer;
            opacity: 1;
            transition: .2s;
        }

        .checkin-btn:hover {
            background: #1d4ed8;
        }

        .checkout-btn {
            background: #16a34a;
        }

        .checkout-btn:hover {
            background: #15803d;
        }

        .placeholder {
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.6;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin: 15px 0;
            font-size: 13px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .gps-message {
            margin-top: 12px;
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 17px;
        }

        .profile-info div {
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 12px;
        }

        .profile-info small {
            display: block;
            color: #64748b;
            margin-bottom: 5px;
        }

        .profile-info strong {
            font-size: 14px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
        }

        
    /* RESPONSIVE DESKTOP */
    @media (max-width: 900px) {
        .sidebar {
            width: 210px;
        }

        .main {
            padding: 25px;
        }

        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    /* TABLET DAN MOBILE */
    @media (max-width: 650px) {
        body {
            font-size: 14px;
            background: #f4f7fb;
        }

        .layout {
            display: block;
            min-height: 100vh;
        }

        /* SIDEBAR MOBILE */
        .sidebar {
            width: 100%;
            padding: 15px 18px;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .brand {
            font-size: 20px;
            margin: 0;
        }

        .menu {
            display: none;
        }

        .sidebar-bottom {
            margin: 0;
        }

        .logout-btn {
            width: auto;
            padding: 9px 13px;
            font-size: 12px;
        }

        /* MAIN CONTENT */
        .main {
            padding: 20px 16px 100px;
            width: 100%;
        }

        .topbar {
            margin-bottom: 22px;
            gap: 12px;
            align-items: center;
        }

        .topbar h2 {
            font-size: 20px;
        }

        .profile-mini {
            gap: 8px;
        }

        .profile-mini strong {
            font-size: 12px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            font-size: 14px;
        }

        .date {
            font-size: 11px;
        }

        /* WELCOME */
        .welcome {
            padding: 23px 19px;
            border-radius: 15px;
            margin-bottom: 18px;
        }

        .welcome h1 {
            font-size: 20px;
            line-height: 1.4;
        }

        .welcome p {
            font-size: 12px;
            line-height: 1.6;
        }

        /* STATISTICS */
        .stats {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 9px;
            margin-bottom: 18px;
        }

        .stat-card {
            padding: 13px 9px;
            border-radius: 12px;
            min-width: 0;
        }

        .stat-card .icon {
            font-size: 19px;
            margin-bottom: 8px;
        }

        .stat-card h3 {
            font-size: 19px;
        }

        .stat-card p {
            font-size: 10px;
            line-height: 1.4;
        }

        /* CONTENT */
        .content-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .panel {
            padding: 19px 16px;
            border-radius: 14px;
        }

        .panel h3 {
            font-size: 16px;
            margin-bottom: 17px;
        }

        .schedule-info {
            gap: 10px;
        }

        .schedule-info strong {
            font-size: 16px;
        }

        .placeholder {
            font-size: 12px;
        }

        .checkin-btn {
            min-height: 48px;
            padding: 14px;
            font-size: 14px;
            border-radius: 11px;
        }

        .gps-message {
            font-size: 12px;
        }

        .profile-info {
            gap: 14px;
        }

        .footer {
            margin-top: 22px;
            padding-bottom: 10px;
        }

        /* BOTTOM NAVIGATION */
        .mobile-bottom-nav {
            display: flex;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 68px;
            background: white;
            border-top: 1px solid #e2e8f0;
            justify-content: space-around;
            align-items: center;
            z-index: 999;
            padding-bottom: env(safe-area-inset-bottom);
            box-shadow: 0 -3px 15px rgba(0,0,0,.04);
        }

        .mobile-bottom-nav a {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 500;
            min-width: 65px;
        }

        .mobile-bottom-nav a span:first-child {
            font-size: 20px;
        }

        .mobile-bottom-nav a.active {
            color: #2563eb;
            font-weight: 700;
        }
    }

/* SEMBUNYIKAN NAVIGASI MOBILE DI DESKTOP */
.mobile-bottom-nav {
    display: none;
}

    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            ATTEND<span>ANCE.</span>
        </div>

        <div class="menu">
            <p class="menu-label">MENU UTAMA</p>

            <a href="#dashboard" class="active">▦ Dashboard</a>
            <a href="#jadwal">▣ Jadwal Absensi</a>
            <a href="#riwayat">◷ Riwayat Absensi</a>
            <a href="#pengajuan">▤ Pengajuan Izin</a>
            <a href="#profil">♙ Profil Saya</a>
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

        <header class="topbar">

            <div>
                <h2>Dashboard</h2>
                <p class="date">
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>

            <div class="profile-mini">

                <div class="avatar">
                    {{ strtoupper(substr($intern->name, 0, 1)) }}
                </div>

                <div>
                    <strong>{{ $intern->name }}</strong>
                    <p class="date">Peserta Magang</p>
                </div>

            </div>

        </header>

        <!-- WELCOME -->
        <section class="welcome">

            <h1>Selamat Datang, {{ $intern->name }}! 👋</h1>

            <p>
                Selamat datang di sistem Attendance.
                Pantau jadwal dan kehadiran magangmu di sini.
            </p>

        </section>

        <!-- STATISTICS -->
        <section class="stats">

            <div class="stat-card">
                <div class="icon">📅</div>
                <h3>—</h3>
                <p>Total Kehadiran</p>
            </div>

            <div class="stat-card">
                <div class="icon">⏰</div>
                <h3>—</h3>
                <p>Tepat Waktu</p>
            </div>

            <div class="stat-card">
                <div class="icon">📋</div>
                <h3>—</h3>
                <p>Total Izin / Sakit</p>
            </div>

        </section>

        <!-- CONTENT -->
        <section class="content-grid">

            <!-- JADWAL ABSENSI -->
            <div class="panel" id="jadwal">

                <h3>Jadwal Absensi Hari Ini</h3>

                <!-- NOTIFIKASI -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                @if ($schedule)

                    <span class="status"
                          style="background:#dcfce7;color:#166534;">
                        Jadwal Aktif
                    </span>

                    <div class="schedule-info">

                        <div>
                            <small>Jam Masuk</small>
                            <strong>
                                {{ substr($schedule->start_time, 0, 5) }}
                            </strong>
                        </div>

                        <div>
                            <small>Jam Pulang</small>
                            <strong>
                                {{ substr($schedule->end_time, 0, 5) }}
                            </strong>
                        </div>

                    </div>

                    <p class="placeholder">
                        Toleransi keterlambatan:
                        {{ $schedule->late_tolerance }} menit
                        <br>
                        Radius presensi:
                        {{ $schedule->allowed_radius }} meter
                    </p>

                    <hr style="border:0;border-top:1px solid #e2e8f0;margin:20px 0;">

                    <!-- CHECK-IN / CHECK-OUT -->
                    @if (!$attendance)

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

                    @elseif (!$attendance->check_out_at)

                        <p style="color:#16a34a;margin-bottom:12px;">
                            ✓ Kamu sudah melakukan check-in.
                        </p>

                        <p class="placeholder" style="margin-bottom:15px;">
                            Waktu check-in:
                            <strong>
                                {{ $attendance->check_in_at->format('H:i:s') }}
                            </strong>
                        </p>

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

                    @else

                        <p style="color:#16a34a;font-weight:bold;">
                            ✓ Presensi hari ini sudah lengkap!
                        </p>

                        <p class="placeholder" style="margin-top:10px;">
                            Check-in:
                            <strong>
                                {{ $attendance->check_in_at->format('H:i:s') }}
                            </strong>
                            <br>
                            Check-out:
                            <strong>
                                {{ $attendance->check_out_at->format('H:i:s') }}
                            </strong>
                        </p>

                    @endif

                    <p id="gpsMessage" class="gps-message"></p>

                @else

                    <span class="status">
                        Tidak ada jadwal aktif
                    </span>

                    <p class="placeholder">
                        Belum ada jadwal absensi untuk hari ini.
                    </p>

                @endif

            </div>

            <!-- INFORMASI PESERTA -->
            <div class="panel" id="profil">

                <h3>Informasi Peserta</h3>

                <div class="profile-info">

                    <div>
                        <small>Nama Lengkap</small>
                        <strong>{{ $intern->name }}</strong>
                    </div>

                    <div>
                        <small>Email</small>
                        <strong>{{ $intern->email }}</strong>
                    </div>

                    <div>
                        <small>Nomor Telepon</small>
                        <strong>{{ $intern->phone ?? '-' }}</strong>
                    </div>

                    <div>
                        <small>Status Akun</small>
                        <strong style="color:#16a34a;">
                            Aktif
                        </strong>
                    </div>

                </div>

            </div>

        </section>

        <footer class="footer">
            © {{ date('Y') }} Attendance System. All rights reserved.
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

        function(position) {

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

        function(error) {

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

</body>
</html>
