<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Peserta Magang | Attendance Magangers</title>

    <!-- PWA CONFIGURATION -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#F97316">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Attendance">

    <link rel="icon" type="image/png" href="/icons/icon-192.png">
    <link rel="apple-touch-icon" href="/icons/icon-192.png">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: #FFF7ED;
            color: #1E293B;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            background: #FFFFFF;
            padding: 36px;
            border-radius: 24px;
            border: 1px solid #FED7AA;
            box-shadow: 0 15px 40px rgba(124, 45, 18, 0.08);
        }

        .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-icon {
            width: 82px;
            height: 82px;
            object-fit: contain;
            margin-bottom: 16px;
        }

        .brand h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1E293B;
            margin-bottom: 8px;
        }

        .brand p {
            color: #64748B;
            font-size: 14px;
            line-height: 1.6;
        }

        .orange-text {
            color: #F97316;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #CBD5E1;
            border-radius: 12px;
            outline: none;
            font-size: 15px;
            background: #FFFFFF;
            transition: 0.2s ease;
        }

        .form-group input:focus {
            border-color: #F97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.12);
        }

        .login-button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: #F97316;
            color: #FFFFFF;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .login-button:hover {
            background: #EA580C;
            transform: translateY(-1px);
        }

        .login-button:active {
            transform: scale(0.98);
        }

        .error-message {
            padding: 12px 14px;
            border-radius: 10px;
            background: #FEF2F2;
            color: #DC2626;
            border: 1px solid #FECACA;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* PWA INSTALL BUTTON */
        #installAppBtn {
            width: 100%;
            margin-top: 14px;
            padding: 14px 18px;
            border: 1px solid #FED7AA;
            border-radius: 12px;
            background: #FFF7ED;
            color: #C2410C;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
        }

        #installAppBtn:hover {
            background: #FFEDD5;
        }

        #installAppBtn[hidden] {
            display: none !important;
        }

        .footer {
            text-align: center;
            margin-top: 24px;
            color: #94A3B8;
            font-size: 12px;
        }

        /* RESPONSIVE */
        @media (max-width: 480px) {
            body {
                padding: 16px;
            }

            .login-card {
                padding: 28px 22px;
                border-radius: 20px;
            }

            .brand h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="login-card">

            <!-- BRAND -->
            <div class="brand">
                <img
                    src="/icons/icon-192.png"
                    alt="Attendance Magangers"
                    class="brand-icon"
                >

                <h1>Attendance <span class="orange-text">Magangers</span></h1>

                <p>
                    Sistem Presensi Peserta Magang
                </p>
            </div>

            <!-- ERROR VALIDATION -->
            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- LOGIN FORM -->
            <form action="{{ route('intern.login.process') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email kamu"
                        autocomplete="username"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >
                </div>

                <button type="submit" class="login-button">
                    Login
                </button>

            </form>

            <!-- PWA INSTALL BUTTON -->
            <button id="installAppBtn" type="button" hidden>
                📲 Install Attendance Magangers
            </button>

        </div>

        <div class="footer">
            Attendance Magangers &copy; {{ date('Y') }}
        </div>

    </div>

    <!-- SERVICE WORKER -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function () {
                navigator.serviceWorker.register('/sw.js')
                    .then(function (registration) {
                        console.log(
                            'PWA Login Service Worker aktif:',
                            registration.scope
                        );
                    })
                    .catch(function (error) {
                        console.error('PWA gagal dijalankan:', error);
                    });
            });
        }
    </script>

    <!-- PWA INSTALL PROMPT -->
    <script>
        let deferredInstallPrompt = null;

        const installButton = document.getElementById('installAppBtn');

        window.addEventListener('beforeinstallprompt', (event) => {
            event.preventDefault();

            deferredInstallPrompt = event;

            if (installButton) {
                installButton.hidden = false;
            }
        });

        if (installButton) {
            installButton.addEventListener('click', async () => {
                if (!deferredInstallPrompt) return;

                deferredInstallPrompt.prompt();

                const result = await deferredInstallPrompt.userChoice;

                console.log('Install result:', result.outcome);

                deferredInstallPrompt = null;
                installButton.hidden = true;
            });
        }

        window.addEventListener('appinstalled', () => {
            console.log('Attendance Magangers berhasil di-install!');

            if (installButton) {
                installButton.hidden = true;
            }
        });
    </script>

</body>
</html>