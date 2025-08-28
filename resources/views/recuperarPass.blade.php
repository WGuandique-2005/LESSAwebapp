<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Recuperar Contraseña - LESSA</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        :root {
            --primary: #0A2463;
            --secondary: #3E92CC;
            --accent: #FFD166;
            --glass: rgba(10, 36, 99, 0.86);
            --muted-white: rgba(255, 255, 255, 0.95);
            --danger: #d9534f;
            --success: #4CB944;
            --radius: 18px;
            --shadow-lg: 0 18px 50px rgba(8, 29, 68, 0.36);
            --shadow-sm: 0 8px 24px rgba(8, 29, 68, 0.18);
            --transition: all .28s ease;
        }

        * {
            box-sizing: border-box
        }

        html,
        body {
            height: 100%
        }

        body {
            margin: 0;
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, Arial;
            background: url("{{ asset('img/login.png') }}") center/cover no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: var(--muted-white);
        }

        /* Main card */
        .card {
            width: 100%;
            max-width: 980px;
            display: grid;
            grid-template-columns: 1fr 420px;
            background: linear-gradient(180deg, rgba(10, 36, 99, 0.96), rgba(10, 36, 99, 0.9));
            border-radius: calc(var(--radius) + 2px);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            min-height: clamp(420px, 58vh, 720px);
        }

        .panel {
            padding: clamp(20px, 3.6vw, 40px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 12px;
            position: relative;
        }

        .back {
            position: absolute;
            left: 18px;
            top: 18px;
            background: var(--accent);
            color: var(--primary);
            padding: 8px 12px;
            border-radius: 12px;
            font-weight: 800;
            text-decoration: none;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .back:hover {
            transform: translateY(-3px);
            background: #fff;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 6px;
        }

        .brand .logo {
            width: 56px;
            height: 56px;
            background: url("{{ asset('img/logo2.png') }}") center/contain no-repeat;
        }

        .brand h3 {
            margin: 0;
            color: var(--muted-white);
            font-size: 18px;
            letter-spacing: 0.3px;
        }

        h1 {
            margin: 0;
            font-size: 26px;
            color: var(--muted-white);
        }

        .subtitle {
            margin: 0;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            font-size: 14px;
        }

        /* Alerts */
        .alerts {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 8px;
        }

        .alert {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 10px 12px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            box-shadow: var(--shadow-sm);
        }

        .alert .left {
            display: flex;
            gap: 10px;
            align-items: center;
            flex: 1;
        }

        .alert .msg {
            color: #fff;
            text-align: left;
        }

        .alert-success {
            background: linear-gradient(90deg, var(--success), #45b75a);
        }

        .alert-error {
            background: linear-gradient(90deg, var(--danger), #c83a3a);
        }

        .alert button.close {
            background: transparent;
            border: 0;
            color: inherit;
            font-size: 18px;
            cursor: pointer;
            padding: 6px;
        }

        /* Form */
        form {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 6px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            color: rgba(255, 255, 255, 0.95);
            font-weight: 700;
            font-size: 0.95rem;
        }

        input[type="email"] {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.04);
            color: #fff;
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 15px;
            outline: none;
            transition: var(--transition);
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        input:focus {
            box-shadow: 0 12px 30px rgba(62, 146, 204, 0.06);
            border-color: rgba(255, 209, 102, 0.45);
            background: rgba(255, 255, 255, 0.08);
        }

        .is-invalid {
            border-color: rgba(255, 120, 120, 0.9) !important;
        }

        .field-error {
            color: #ffdede;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 6px;
            align-items: center;
        }

        .btn {
            padding: 12px 14px;
            border-radius: 12px;
            border: 0;
            cursor: pointer;
            font-weight: 800;
            font-size: 15px;
            transition: var(--transition);
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
            box-shadow: var(--shadow-sm);
            width: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            background: var(--secondary);
        }

        .links {
            margin-top: 10px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.92);
            text-align: center;
        }

        .links a {
            color: var(--accent);
            font-weight: 800;
            text-decoration: none;
        }

        /* Visual aside */
        .visual {
            background: linear-gradient(180deg, rgba(62, 146, 204, 0.12), rgba(10, 36, 99, 0.18));
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px;
            position: relative;
        }

        .visual .inner {
            max-width: 320px;
            text-align: center;
            color: rgba(255, 255, 255, 0.96);
        }

        .visual h3 {
            margin: 0 0 10px;
            font-size: 22px;
            color: var(--muted-white);
        }

        .visual p {
            margin: 0;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
        }

        @media (max-width:980px) {
            .card {
                grid-template-columns: 1fr;
                min-height: auto;
                max-width: 680px;
            }

            .visual {
                display: none;
            }

            .back {
                left: 12px;
                top: 12px;
            }
        }

        @media (max-width:420px) {
            .panel {
                padding: 18px;
            }

            h1 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

    <a id="backBtn" class="back" href="/login" aria-label="Volver">← Volver</a>

    <main class="card" role="main" aria-labelledby="recoverTitle">
        <section class="panel" aria-label="Recuperar contraseña">
            <div class="brand">
                <div class="logo" aria-hidden="true"></div>
                <h3>LESSA</h3>
            </div>

            <h1 id="recoverTitle">Recuperar contraseña</h1>
            <p class="subtitle">Introduce tu correo para enviarte un código de recuperación.</p>

            <!-- Alerts -->
            <div class="alerts" id="alerts" aria-live="polite" aria-atomic="true">
                @if(session('status'))
                    <div class="alert alert-success" data-auto-hide>
                        <div class="left">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <div class="msg">{{ session('status') }}</div>
                        </div>
                        <button class="close" aria-label="Cerrar">×</button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error" data-auto-hide>
                        <div class="left">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 9v4m0 4h.01" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <div class="msg">{{ session('error') }}</div>
                        </div>
                        <button class="close" aria-label="Cerrar">×</button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error" data-auto-hide="false">
                        <div class="left">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 9v4m0 4h.01" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <div class="msg">
                                <div style="font-weight:900; margin-bottom:6px;">Corrige los siguientes errores:</div>
                                <ul style="padding-left:18px; margin:0;">
                                    @foreach($errors->all() as $err)
                                        <li style="font-weight:800;">{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button class="close" aria-label="Cerrar">×</button>
                    </div>
                @endif
            </div>

            <!-- Form -->
            <form id="recoverForm" action="{{ route('recuperarPass') }}" method="POST" novalidate>
                @csrf

                <div class="field">
                    <label for="email">Correo electrónico</label>
                    <input id="email" name="email" type="email" placeholder="tu@correo.com" value="{{ old('email') }}"
                        required class="@error('email') is-invalid @enderror" />
                    @error('email') <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>
                    {{ $message }}</div> @enderror
                </div>

                <div class="actions">
                    <button type="submit" class="btn btn-primary">Solicitar código</button>
                </div>
            </form>

            <div class="links" style="margin-top:14px;">
                <a href="{{ route('login') }}" style="color:var(--accent); font-weight:800;">¿Recordaste tu contraseña?
                    Inicia sesión</a>
            </div>

            @if(session('status'))
                <div style="margin-top:14px; text-align:center;">
                    <a href="{{ route('newPass_view') }}" class="links" style="font-weight:800; color:var(--accent);">¿Ya
                        tienes el código? Cambia tu contraseña aquí.</a>
                </div>
            @endif
        </section>

        <aside class="visual" aria-hidden="true">
            <div class="inner">
                <h3>Recupera el acceso</h3>
                <p>Te enviaremos un código al correo para restablecer tu contraseña de forma segura.</p>
                <div style="height:20px"></div>
                <img src="{{ asset('img/illustration_recover.png') }}" alt=""
                    style="max-width:240px; opacity:0.96; filter: drop-shadow(0 12px 30px rgba(8,29,68,0.22));">
            </div>
        </aside>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Back button behaviour
            const backBtn = document.getElementById('backBtn');
            if (backBtn) backBtn.addEventListener('click', function (e) { e.preventDefault(); window.history.back(); });

            // Clear invalid state when user types
            const form = document.getElementById('recoverForm');
            if (form) {
                form.querySelectorAll('input').forEach(input => {
                    input.addEventListener('input', function () {
                        if (this.classList.contains('is-invalid')) this.classList.remove('is-invalid');
                        const fe = this.parentElement.querySelector('.field-error');
                        if (fe) fe.remove();
                    });
                });
            }

            // Alerts: close & auto-hide
            document.querySelectorAll('.alert button.close').forEach(btn => {
                btn.addEventListener('click', function () { const a = this.closest('.alert'); if (!a) return; a.style.opacity = '0'; a.style.transform = 'translateY(-8px)'; setTimeout(() => a.remove(), 280); });
            });
            document.querySelectorAll('.alert[data-auto-hide]').forEach(a => {
                setTimeout(() => { if (!document.body.contains(a)) return; a.style.opacity = '0'; a.style.transform = 'translateY(-8px)'; setTimeout(() => { if (a) a.remove(); }, 300); }, 7000);
            });

            // initial micro animation
            const card = document.querySelector('.card');
            if (card) { card.style.opacity = '0'; card.style.transform = 'translateY(6px)'; setTimeout(() => { card.style.transition = 'opacity .45s ease, transform .45s ease'; card.style.opacity = '1'; card.style.transform = 'translateY(0)'; }, 40); }

            // If server validation flagged fields, focus the first one
            @if($errors->any())
                (function () { const first = document.querySelector('.is-invalid'); if (first) first.focus(); })();
            @endif
});
    </script>
</body>

</html>