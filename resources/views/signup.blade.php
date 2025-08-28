<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro - LESSA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        xintegrity="sha512-Fo3rlalr+G/yqW8S8H5f+3zT1xZ6+K/5B5E1Q6Z8c2q5f8+5z7m3gD9c5O6Z7t0+7z9f+2V0P3p3P4p+1Q8+"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --primary-blue: #4285f4;
            --primary-blue-dark: #3367d6;
            --secondary-orange: #F4A261;
            --text-light: #fff;
            --text-dark: #333;
            --input-bg: rgba(255, 255, 255, 0.2);
            --input-border-focus: #F4A261;
            --shadow-light: rgba(0, 0, 0, 0.3);
            --blur-strength: 15px;

            --strength-weak: #ff6b6b;
            /* Red */
            --strength-moderate: #ffcc00;
            /* Yellow */
            --strength-strong: #4CAF50;
            /* Green */
            --strength-very-strong: #007bff;
            /* Blue */

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
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url({{ asset('img/signup.png') }}) no-repeat center center/cover;
            position: relative;
            flex-direction: column;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            width: 70%;
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
            position: relative;
            z-index: 5;
            flex-shrink: 0;
            margin-top: 100px;
            margin-bottom: 20px;
        }

        .logo {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 160px;
            height: 160px;
            background: url({{ asset('img/logo2.png') }}) center/contain no-repeat;
            z-index: 10;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            color: var(--text-light);
        }

        h2 {
            font-size: 16px;
            margin-bottom: 5px;
            color: var(--text-light);
            align-self: flex-start;
            padding-left: 5px;
        }

        .input-group {
            width: 100%;
            margin-bottom: 20px;
            position: relative;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid transparent;
            border-radius: 10px;
            font-size: 16px;
            background: var(--input-bg);
            color: var(--text-light);
            outline: none;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        input:focus {
            border-color: var(--input-border-focus);
            background-color: rgba(255, 255, 255, 0.3);
        }

        input::placeholder {
            color: #ddd;
        }

        .signup-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            background-color: var(--primary-blue);
            color: var(--text-light);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .signup-btn:hover {
            background-color: var(--primary-blue-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .google-btn {
            background-color: var(--text-light);
            color: var(--text-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }

        .google-btn:hover {
            background-color: #f0f0f0;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .google-icon {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .links {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
            line-height: 1.6;
        }

        .links a {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease, text-decoration 0.3s ease;
        }

        .links a:hover {
            color: var(--secondary-orange);
            text-decoration: underline;
        }

        .back-button {
            position: absolute;
            top: 30px;
            left: 30px;
            color: var(--text-light);
            background-color: var(--secondary-orange);
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .back-button:hover {
            background-color: var(--text-light);
            color: var(--secondary-orange);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
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

        /* Password Strength Indicator Styles */
        .password-strength-indicator {
            width: 100%;
            height: 8px;
            background-color: rgba(255, 255, 255, 0.3);
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
            color: var(--text-light);
            font-weight: bold;
            transition: color 0.3s ease-in-out;
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
            background-color: var(--strength-weak);
        }

        .strength-bar.moderate {
            background-color: var(--strength-moderate);
        }

        .strength-bar.strong {
            background-color: var(--strength-strong);
        }

        .strength-bar.very-strong {
            background-color: var(--strength-very-strong);
        }


        @media screen and (max-width: 768px) {
            .container {
                padding: 30px 20px;
                margin-top: 120px;
                margin-bottom: 40px;
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

            .back-button {
                top: 20px;
                left: 20px;
                padding: 8px 15px;
                font-size: 14px;
            }
        }

        @media screen and (max-width: 480px) {
            .container {
                padding: 25px 15px;
                margin-top: 100px;
                margin-bottom: 30px;
            }

            h1 {
                font-size: 24px;
            }

            h2 {
                font-size: 14px;
            }

            input,
            .signup-btn,
            .google-btn {
                font-size: 14px;
                padding: 10px;
            }

            .google-icon {
                width: 18px;
                height: 18px;
            }

            .links {
                font-size: 13px;
            }

            .logo {
                width: 60px;
                height: 60px;
                top: 15px;
                right: 15px;
            }

            .back-button {
                top: 15px;
                left: 15px;
                padding: 7px 12px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

    <a class="back-button" href="{{ url()->previous() }}">Volver</a>
    <div class="logo"></div>

    <div class="container">
        <h1>Registrarse</h1>

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
        <form method="POST" action="{{ route('signup.submit') }}" style="width: 100%;">
            @csrf

            <div class="input-group">
                <h2>Nombre Completo</h2>
                <input type="text" name="name" placeholder="Tu nombre" value="{{ old('name') }}"
                    class="@error('name') is-invalid @enderror" required autocomplete="name" autofocus />
                @error('name')
                    <div class="error-message show"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <h2>Nombre de Usuario</h2>
                <input type="text" name="username" placeholder="Tu nombre de usuario" value="{{ old('username') }}"
                    class="@error('username') is-invalid @enderror" required autocomplete="username" />
                @error('username')
                    <div class="error-message show"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <h2>Correo Electrónico</h2>
                <input type="email" name="email" placeholder="email@example.com" value="{{ old('email') }}"
                    class="@error('email') is-invalid @enderror" required autocomplete="email" />
                @error('email')
                    <div class="error-message show"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <h2>Contraseña</h2>
                <input type="password" name="password" id="password-input" placeholder="Contraseña"
                    class="@error('password') is-invalid @enderror" required autocomplete="new-password" />
                @error('password')
                    <div class="error-message show"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>
                @enderror
                <div class="password-strength-indicator">
                    <div id="strength-bar" class="strength-bar"></div>
                </div>
                <div id="strength-text" class="strength-text"></div>
            </div>

            <div class="input-group">
                <h2>Confirmar Contraseña</h2>
                <input type="password" name="password_confirmation" placeholder="Repite tu contraseña" required
                    autocomplete="new-password" />
            </div>

            <button type="submit" class="signup-btn">Registrarse</button>
        </form>

        <a class="google-btn" href="{{ route('auth.google') }}">
            <img src="https://img.icons8.com/?size=512&id=17949&format=png" alt="Google logo" class="google-icon" />
            Continuar con Google
        </a>

        <div class="links">¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.alert button.close').forEach(btn => {
                btn.addEventListener('click', function () { const a = this.closest('.alert'); if (!a) return; a.style.opacity = '0'; a.style.transform = 'translateY(-8px)'; setTimeout(() => a.remove(), 280); });
            });
            document.querySelectorAll('.alert[data-auto-hide]').forEach(a => {
                setTimeout(() => { if (!document.body.contains(a)) return; a.style.opacity = '0'; a.style.transform = 'translateY(-8px)'; setTimeout(() => { if (a) a.remove(); }, 300); }, 7000);
            });

            const passwordInput = document.getElementById('password-input');
            const strengthBar = document.getElementById('strength-bar');
            const strengthText = document.getElementById('strength-text');

            const form = document.querySelector('form');
            if (form) {
                form.querySelectorAll('input').forEach(input => {
                    input.addEventListener('input', function () {
                        if (this.classList.contains('is-invalid')) {
                            this.classList.remove('is-invalid');
                            const errorDiv = this.nextElementSibling;
                            if (errorDiv && errorDiv.classList.contains('error-message')) {
                                errorDiv.classList.remove('show');
                                errorDiv.addEventListener('transitionend', function handler() {
                                    errorDiv.remove();
                                    errorDiv.removeEventListener('transitionend', handler);
                                });
                            }
                        }
                    });
                });
            }

            const container = document.querySelector('.container');
            if (container) {
                container.style.opacity = '0';
                container.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    container.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                    container.style.opacity = '1';
                    container.style.transform = 'translateY(0)';
                }, 100);
            }

            if (passwordInput && strengthBar && strengthText) {
                passwordInput.addEventListener('input', function () {
                    const password = this.value;
                    updatePasswordStrength(password);
                });

                function updatePasswordStrength(password) {
                    let score = 0;
                    let feedback = '';
                    let strengthLevel = 'none'; // 'none', 'weak', 'moderate', 'strong', 'very-strong'

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
                        if (password.length < 8) feedback += ' (mínimo 8 caracteres)';
                        if (!hasLowercase) feedback += ' (minúscula)';
                        if (!hasUppercase) feedback += ' (mayúscula)';
                        if (!hasNumber) feedback += ' (número)';
                        if (!hasSymbol) feedback += ' (símbolo)';
                    } else if (score < 5) {
                        strengthLevel = 'moderate';
                        feedback = 'Moderada';
                        if (password.length < 10) feedback += ' (considera más caracteres)';
                        if (!(hasLowercase && hasUppercase && hasNumber && hasSymbol)) feedback += ' (combina tipos)';
                    } else if (score < 7) {
                        strengthLevel = 'strong';
                        feedback = 'Fuerte';
                        if (password.length < 12) feedback += ' (considera más caracteres)';
                    } else {
                        strengthLevel = 'very-strong';
                        feedback = 'Muy Fuerte';
                    }

                    // Update UI
                    strengthBar.style.width = (score / 7) * 100 + '%'; // Max score 7 (3 for length, 4 for types)
                    strengthBar.className = 'strength-bar ' + strengthLevel;
                    strengthText.textContent = feedback;
                    strengthText.className = 'strength-text ' + strengthLevel;
                }
            }
        });
    </script>
</body>

</html>