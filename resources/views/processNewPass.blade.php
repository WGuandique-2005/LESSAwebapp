<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Establecer Nueva Contraseña - LESSA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --primary-blue: #4285f4;
            --primary-blue-dark: #3367d6;
            --secondary-orange: #F4A261;
            --text-light: #fff;
            --input-bg: rgba(255, 255, 255, 0.2);
            --input-border-focus: #F4A261;
            --shadow-light: rgba(0, 0, 0, 0.3);
            --blur-strength: 15px;
            --error-red: #ff6b6b;
            --success-green: rgba(40, 167, 69, 0.8);
            --danger-red: rgba(220, 53, 69, 0.8);
            --border-radius: 10px;
            --strength-weak: #ff6b6b;
            --strength-moderate: #ffcc00;
            --strength-strong: #4CAF50;
            --strength-very-strong: #007bff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, Arial;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url({{ asset('img/login.png') }}) no-repeat center center/cover;
            padding: 20px;
            flex-direction: column;
        }

        .container {
            width: 90%;
            max-width: 500px;
            background: rgba(10, 36, 99, 0.88);
            backdrop-filter: blur(var(--blur-strength));
            border-radius: 20px;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 8px 32px var(--shadow-light);
            color: var(--text-light);
            z-index: 5;
        }

        .logo {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 160px;
            height: 160px;
            background: url({{ asset('img/logo2.png') }}) center/contain no-repeat;
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

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            text-align: center;
        }

        h2 {
            font-size: 16px;
            margin-bottom: 5px;
            align-self: flex-start;
            padding-left: 5px;
        }

        .input-group {
            width: 100%;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid transparent;
            border-radius: var(--border-radius);
            font-size: 16px;
            background: var(--input-bg);
            color: var(--text-light);
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: var(--input-border-focus);
            background-color: rgba(255, 255, 255, 0.3);
        }

        input::placeholder {
            color: #ddd;
        }

        .action-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            background-color: var(--primary-blue);
            color: var(--text-light);
            margin-top: 10px;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .action-btn:hover {
            background: var(--primary-blue-dark);
            transform: translateY(-2px);
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            padding: 10px 20px;
            background: var(--secondary-orange);
            color: var(--text-light);
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .back-button:hover {
            background: var(--text-light);
            color: var(--secondary-orange);
            transform: translateY(-2px);
        }

        .back-container {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .feedback-message {
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            width: 100%;
            text-align: center;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .feedback-message.success {
            background: var(--success-green);
        }

        .feedback-message.error {
            background: var(--danger-red);
        }

        .error-list {
            list-style: none;
            padding: 0;
            margin-top: 5px;
            width: 100%;
        }

        .error-list li {
            color: var(--error-red);
            font-size: 13px;
            display: flex;
            gap: 5px;
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
            color: var(--strength-weak);
        }

        .strength-text.moderate {
            color: var(--strength-moderate);
        }

        .strength-text.strong {
            color: var(--strength-strong);
        }

        .strength-text.very-strong {
            color: var(--strength-very-strong);
        }

        .strength-bar.weak {
            background: var(--strength-weak);
        }

        .strength-bar.moderate {
            background: var(--strength-moderate);
        }

        .strength-bar.strong {
            background: var(--strength-strong);
        }

        .strength-bar.very-strong {
            background: var(--strength-very-strong);
        }

        @media (max-width:768px) {
            .container {
                padding: 30px 20px;
                margin-top: 80px;
            }

            .logo {
                width: 80px;
                height: 80px;
                top: 20px;
                right: 20px;
            }

            h1 {
                font-size: 28px;
            }
        }

        @media (max-width:480px) {
            .container {
                padding: 25px 15px;
            }

            h1 {
                font-size: 24px;
            }

            h2,
            input,
            .action-btn,
            .back-button {
                font-size: 14px;
            }

            .back-button {
                padding: 7px 12px;
            }
        }
    </style>
</head>

<body>
    <div class="logo"></div>
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
    <form action="{{ route('newPass') }}" method="POST" class="container">
        @csrf
        <h1>Nueva Contraseña</h1>
        <p style="text-align:center; margin-bottom:20px;">Ingresa el código de recuperación recibido y tu nueva
            contraseña.</p>

        @if(session('status'))
            <p class="feedback-message success">{{ session('status') }}</p>
        @endif
        @if(session('error'))
            <p class="feedback-message error">{{ session('error') }}</p>
        @endif

        <div class="input-group">
            <h2>Código de Recuperación</h2>
            <input type="text" name="token" placeholder="Código de 6 dígitos" value="{{ old('token') }}" required>
            @error('token') <ul class="error-list">
                <li><i class="fas fa-exclamation-circle"></i> {{ $message }}</li>
            </ul> @enderror
        </div>

        <div class="input-group">
            <h2>Nueva Contraseña</h2>
            <input type="password" name="password" id="password-input"
                placeholder="Nueva contraseña (mínimo 8 caracteres)" required>
            <div class="password-strength-indicator">
                <div id="strength-bar" class="strength-bar"></div>
            </div>
            <div id="strength-text" class="strength-text"></div>
            @error('password') <ul class="error-list">
                <li><i class="fas fa-exclamation-circle"></i> {{ $message }}</li>
            </ul> @enderror
        </div>

        <div class="input-group">
            <h2>Confirmar Contraseña</h2>
            <input type="password" name="password_confirmation" placeholder="Confirma tu nueva contraseña" required>
        </div>

        <button type="submit" class="action-btn">Actualizar Contraseña</button>
        <div class="back-container">
            <a href="{{ route('login') }}" class="back-button">
                <i class="fas fa-arrow-left"></i> Volver al Inicio de Sesión
            </a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
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