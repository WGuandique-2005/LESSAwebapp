<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Registro - LESSA</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        :root {
            --primary: #0A2463;
            --secondary: #3E92CC;
            --accent: #FFD166;
            --light: #F2F4F7;
            --dark: #1E1E24;
            --success: #4CB944;
            --radius: 16px;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            --transition: all 0.3s ease;

            /* Strength colors */
            --strength-weak: #ff6b6b;
            --strength-moderate: #ffcc00;
            --strength-strong: #4CAF50;
            --strength-very-strong: #007bff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light) url({{ asset('img/signup.png') }}) center/cover no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--dark);
            padding: 24px;
        }

        .container {
            width: 100%;
            max-width: 520px;
            background: rgba(10, 36, 99, 0.88);
            color: white;
            padding: 36px 28px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
            text-align: center;
            position: relative;
            animation: fadeIn .6s ease;
            margin: 20px 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: none
            }
        }

        .logo {
            width: 84px;
            height: 84px;
            margin: 0 auto 16px;
            background: url({{ asset('img/logo2.png') }}) center/contain no-repeat;
        }

        h1 {
            font-size: 26px;
            margin-bottom: 8px;
            color: var(--light);
        }

        p.lead {
            margin-bottom: 20px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
        }

        /* Alerts region */
        .alerts {
            width: 100%;
            margin-bottom: 14px;
            display: grid;
            gap: 10px;
        }

        .alert {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            font-weight: 600;
            font-size: 14px;
        }

        .alert .left {
            display: flex;
            gap: 10px;
            align-items: center;
            flex: 1;
        }

        .alert .msg {
            text-align: left;
            color: #fff;
        }

        .alert .actions {
            margin-left: 12px;
        }

        .alert button.close {
            background: transparent;
            border: 0;
            color: inherit;
            font-size: 18px;
            cursor: pointer;
            padding: 6px;
            border-radius: 8px;
        }

        .alert-success {
            background: linear-gradient(90deg, var(--success), #3fb86a);
        }

        .alert-error {
            background: linear-gradient(90deg, #d9534f, #c63b3b);
        }

        /* validation list */
        .validation-list {
            text-align: left;
            color: rgba(255, 255, 255, 0.95);
            font-weight: 600;
        }

        .validation-list ul {
            margin-top: 8px;
            color: rgba(255, 255, 255, 0.95);
            font-weight: 500;
            padding-left: 18px;
        }

        .input-group {
            margin-bottom: 14px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 6px;
            color: rgba(255, 255, 255, 0.95);
            font-weight: 600;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid transparent;
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
            font-size: 15px;
            outline: none;
            transition: var(--transition);
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        input:focus {
            border-color: rgba(255, 209, 102, 0.6);
            background: rgba(255, 255, 255, 0.10);
            box-shadow: 0 8px 26px rgba(62, 146, 204, 0.06);
        }

        .is-invalid {
            border-color: rgba(255, 120, 120, 0.9);
            box-shadow: none;
        }

        .signup-btn {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            background: var(--primary);
            border: none;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 28px rgba(10, 36, 99, 0.18);
            transition: var(--transition);
            margin-top: 10px;
        }

        .signup-btn:hover:not(:disabled) {
            transform: translateY(-3px);
            background: var(--secondary);
        }

        .signup-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background: #555;
            box-shadow: none;
        }

        .google-btn {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            border-radius: 12px;
            background: #fff;
            color: var(--dark);
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }

        .google-btn img {
            width: 20px;
            height: 20px;
        }

        .links {
            margin-top: 20px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.95);
        }

        .links a {
            color: var(--accent);
            font-weight: 700;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .back-button {
            position: absolute;
            left: 18px;
            top: 18px;
            background: var(--accent);
            color: var(--dark);
            padding: 8px 12px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            z-index: 100;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        /* Password Strength Indicator Styles */
        .password-strength-indicator {
            width: 100%;
            height: 6px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            margin-top: 8px;
            overflow: hidden;
            position: relative;
        }

        .strength-bar {
            height: 100%;
            width: 0%;
            border-radius: 4px;
            transition: width 0.3s ease-in-out, background-color 0.3s ease-in-out;
        }

        .strength-text {
            font-size: 12px;
            text-align: right;
            margin-top: 5px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            transition: color 0.3s ease-in-out;
        }

        .strength-text.weak { color: var(--strength-weak); }
        .strength-text.moderate { color: var(--strength-moderate); }
        .strength-text.strong { color: var(--strength-strong); }
        .strength-text.very-strong { color: var(--strength-very-strong); }

        .strength-bar.weak { background-color: var(--strength-weak); }
        .strength-bar.moderate { background-color: var(--strength-moderate); }
        .strength-bar.strong { background-color: var(--strength-strong); }
        .strength-bar.very-strong { background-color: var(--strength-very-strong); }

        /* small helper for hide animation */
        .fade-out {
            opacity: 0;
            transform: translateY(-8px);
            transition: opacity .35s, transform .35s;
        }

        @media (max-width:520px) {
            .container {
                padding: 22px;
                border-radius: 12px;
                margin-top: 60px; /* Space for back button */
            }

            .logo {
                width: 68px;
                height: 68px
            }
        }
    </style>
</head>

<body>

    <a class="back-button" href="{{ route('/') }}">← Volver</a>

    <form action="{{ route('signup.submit') }}" method="POST" class="container" aria-labelledby="signup-title" novalidate>
        @csrf
        <div class="logo" role="img" aria-label="LESSA logo"></div>
        <h1 id="signup-title">Crear Cuenta</h1>
        <p class="lead">Únete a LESSA y comienza tu aprendizaje hoy mismo.</p>

        <!-- Alerts region -->
        <div class="alerts" id="alerts" aria-live="polite" aria-atomic="true">
            @if(session('status'))
                <div class="alert alert-success" role="status" data-auto-hide>
                    <div class="left">
                        <i class="fa-solid fa-check-circle"></i>
                        <div class="msg">{{ session('status') }}</div>
                    </div>
                    <div class="actions"><button type="button" class="close" aria-label="Cerrar alerta">&times;</button></div>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error" role="alert" data-auto-hide>
                    <div class="left">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <div class="msg">{{ session('error') }}</div>
                    </div>
                    <div class="actions"><button type="button" class="close" aria-label="Cerrar alerta">&times;</button></div>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error" role="alert" data-auto-hide="false">
                    <div class="left">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <div class="msg validation-list">
                            <div>Corrige los siguientes errores:</div>
                            <ul>
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="actions"><button type="button" class="close" aria-label="Cerrar errores">&times;</button></div>
                </div>
            @endif
        </div>

        <!-- Form fields -->
        <div class="input-group">
            <label for="name">Nombre Completo</label>
            <input id="name" name="name" type="text" placeholder="Tu nombre" value="{{ old('name') }}"
                required class="{{ $errors->has('name') ? 'is-invalid' : '' }}" autocomplete="name" autofocus>
        </div>

        <div class="input-group">
            <label for="username">Nombre de Usuario</label>
            <input id="username" name="username" type="text" placeholder="Tu nombre de usuario" value="{{ old('username') }}"
                required class="{{ $errors->has('username') ? 'is-invalid' : '' }}" autocomplete="username">
        </div>

        <div class="input-group">
            <label for="email">Correo Electrónico</label>
            <input id="email" name="email" type="email" placeholder="ejemplo@correo.com" value="{{ old('email') }}"
                required class="{{ $errors->has('email') ? 'is-invalid' : '' }}" autocomplete="email">
        </div>

        <div class="input-group">
            <label for="password">Contraseña</label>
            <input id="password" name="password" type="password" placeholder="********" required
                class="{{ $errors->has('password') ? 'is-invalid' : '' }}" autocomplete="new-password">
            
            <div class="password-strength-indicator">
                <div id="strength-bar" class="strength-bar"></div>
            </div>
            <div id="strength-text" class="strength-text"></div>
        </div>

        <div class="input-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Repite tu contraseña" required
                autocomplete="new-password">
        </div>

        <button type="submit" class="signup-btn" aria-label="Registrarse" disabled>Registrarse</button>

        <a href="{{ route('auth.google') }}" class="google-btn" role="button" aria-label="Registrarse con Google">
            <img src="https://img.icons8.com/?size=512&id=17949&format=png" alt="Google logo">Continuar con Google
        </a>

        <div class="links">
            ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Alert closing logic
            document.querySelectorAll('.alert .close').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const alert = btn.closest('.alert');
                    if (!alert) return;
                    alert.classList.add('fade-out');
                    setTimeout(() => alert.remove(), 350);
                });
            });

            // Auto-hide alerts
            document.querySelectorAll('.alert[data-auto-hide]').forEach(alert => {
                const timeout = 7000;
                setTimeout(() => {
                    if (!document.body.contains(alert)) return;
                    alert.classList.add('fade-out');
                    setTimeout(() => alert.remove(), 350);
                }, timeout);
            });

            // Focus first invalid field
            const firstInvalid = document.querySelector('.is-invalid');
            if (firstInvalid) firstInvalid.focus();

            // Password Strength Logic
            const passwordInput = document.getElementById('password');
            const strengthBar = document.getElementById('strength-bar');
            const strengthText = document.getElementById('strength-text');
            const submitBtn = document.querySelector('.signup-btn');

            if (passwordInput && strengthBar && strengthText) {
                // Initial check in case of browser autofill
                updatePasswordStrength(passwordInput.value);

                passwordInput.addEventListener('input', function () {
                    updatePasswordStrength(this.value);
                });

                function updatePasswordStrength(password) {
                    let score = 0;
                    let feedback = '';
                    let strengthLevel = 'none';

                    const hasLowercase = /[a-z]/.test(password);
                    const hasUppercase = /[A-Z]/.test(password);
                    const hasNumber = /[0-9]/.test(password);
                    const hasSymbol = /[^a-zA-Z0-9]/.test(password);

                    if (password.length >= 8) score += 1;
                    if (password.length >= 10) score += 1;
                    if (password.length >= 12) score += 1;

                    if (hasLowercase) score += 1;
                    if (hasUppercase) score += 1;
                    if (hasNumber) score += 1;
                    if (hasSymbol) score += 1;

                    if (password.length === 0) {
                        strengthLevel = 'none';
                        feedback = '';
                    } else if (score < 3) {
                        strengthLevel = 'weak';
                        feedback = 'Débil';
                        if (password.length < 8) feedback += ' (min. 8 chars)';
                    } else if (score < 5) {
                        strengthLevel = 'moderate';
                        feedback = 'Moderada';
                    } else if (score < 7) {
                        strengthLevel = 'strong';
                        feedback = 'Fuerte';
                    } else {
                        strengthLevel = 'very-strong';
                        feedback = 'Muy Fuerte';
                    }

                    // Update UI
                    strengthBar.style.width = (score / 7) * 100 + '%';
                    strengthBar.className = 'strength-bar ' + strengthLevel;
                    strengthText.textContent = feedback;
                    strengthText.className = 'strength-text ' + strengthLevel;

                    // Enable/Disable Submit Button
                    // Requirement: Block until password meets characteristics.
                    // Assuming "Moderate" (score >= 3) is the threshold where it starts being acceptable.
                    // Score 3 usually means length >= 8 and at least 2 types of characters, or just length >= 12.
                    // Let's stick to score >= 3 as a reasonable baseline for "cumple con las características".
                    
                    if (score >= 3) {
                        submitBtn.disabled = false;
                        submitBtn.title = "Listo para registrarse";
                    } else {
                        submitBtn.disabled = true;
                        submitBtn.title = "La contraseña es demasiado débil";
                    }
                }
            }
        });
    </script>
</body>

</html>