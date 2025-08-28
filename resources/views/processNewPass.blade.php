<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Establecer Nueva Contraseña - LESSA</title>
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

        .card {
            width: 100%;
            max-width: 520px;
            background: linear-gradient(180deg, rgba(10, 36, 99, 0.96), rgba(10, 36, 99, 0.9));
            border-radius: calc(var(--radius) + 2px);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            min-height: clamp(420px, 58vh, 720px);
            padding: clamp(10px, 3.6vw, 40px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 12px;
            position: relative;
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

        input[type="email"],
        input[type="password"],
        input[type="text"] {
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

        .password-strength-indicator {
            width: 100%;
            height: 8px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
            margin-top: 8px;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            width: 0%;
            border-radius: 4px;
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        .strength-text {
            font-size: 12px;
            text-align: right;
            margin-top: 5px;
            font-weight: bold;
        }

        .strength-text.weak {
            color: #d9534f;
        }

        .strength-text.moderate {
            color: #FFD166;
        }

        .strength-text.strong {
            color: #4CB944;
        }

        .strength-text.very-strong {
            color: #0A2463;
        }

        .strength-bar.weak {
            background: #d9534f;
        }

        .strength-bar.moderate {
            background: #FFD166;
        }

        .strength-bar.strong {
            background: #4CB944;
        }

        .strength-bar.very-strong {
            background: #0A2463;
        }

        @media (max-width:980px) {
            .card {
                max-width: 680px;
            }
        }

        @media (max-width:420px) {
            .card {
                padding: 18px;
            }

            h1 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <main class="card" role="main" aria-labelledby="newPassTitle">
        <div class="brand">
            <div class="logo" aria-hidden="true"></div>
            <h3>LESSA</h3>
        </div>
        <h1 id="newPassTitle">Nueva Contraseña</h1>
        <p class="subtitle">Ingresa el código de recuperación recibido y tu nueva contraseña.</p>
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
        <form action="{{ route('newPass') }}" method="POST" novalidate>
            @csrf
            <div class="field">
                <label for="token">Código de Recuperación</label>
                <input id="token" name="token" type="text" placeholder="Código de 6 dígitos" value="{{ old('token') }}"
                    required class="@error('token') is-invalid @enderror" />
                @error('token') <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                </div> @enderror
            </div>
            <div class="field">
                <label for="password">Nueva Contraseña</label>
                <input id="password-input" name="password" type="password"
                    placeholder="Nueva contraseña (mínimo 8 caracteres)" required class="@error('password') is-invalid @enderror" />
                <div class="password-strength-indicator">
                    <div id="strength-bar" class="strength-bar"></div>
                </div>
                <div id="strength-text" class="strength-text"></div>
                @error('password') <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                </div> @enderror
            </div>
            <div class="field">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                    placeholder="Confirma tu nueva contraseña" required />
            </div>
            <div class="actions">
                <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
            </div>
        </form>
        <div class="links" style="margin-top:14px;">
            <a href="{{ route('login') }}" style="color:var(--accent); font-weight:800;">¿Recordaste tu contraseña?
                Inicia sesión</a>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password-input');
            const strengthBar = document.getElementById('strength-bar');
            const strengthText = document.getElementById('strength-text');
            passwordInput.addEventListener('input', e => updateStrength(e.target.value));
            function updateStrength(password) {
                let score = 0;
                if (password.length >= 8) score++;
                if (password.length >= 10) score++;
                if (password.length >= 12) score++;
                if (/[a-z]/.test(password)) score++;
                if (/[A-Z]/.test(password)) score++;
                if (/[0-9]/.test(password)) score++;
                if (/[^a-zA-Z0-9]/.test(password)) score++;
                let level = 'weak', feedback = 'Débil';
                if (score < 3) { level = 'weak'; feedback = 'Débil'; }
                else if (score < 5) { level = 'moderate'; feedback = 'Moderada'; }
                else if (score < 7) { level = 'strong'; feedback = 'Fuerte'; }
                else { level = 'very-strong'; feedback = 'Muy Fuerte'; }
                strengthBar.style.width = (score / 7) * 100 + '%';
                strengthBar.className = 'strength-bar ' + level;
                strengthText.textContent = feedback;
                strengthText.className = 'strength-text ' + level;
            }
            document.querySelectorAll('.alert button.close').forEach(btn => {
                btn.addEventListener('click', function () { const a = this.closest('.alert'); if (!a) return; a.style.opacity = '0'; a.style.transform = 'translateY(-8px)'; setTimeout(() => a.remove(), 280); });
            });
            document.querySelectorAll('.alert[data-auto-hide]').forEach(a => {
                setTimeout(() => { if (!document.body.contains(a)) return; a.style.opacity = '0'; a.style.transform = 'translateY(-8px)'; setTimeout(() => { if (a) a.remove(); }, 300); }, 7000);
            });
        });
    </script>
</body>

</html>