<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Establecer Nueva Contraseña - LESSA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        xintegrity="sha512-Fo3rlalr+G/yqW8S8H5f+3zT1xZ6+K/5B5E1Q6Z8c2q5f8+5z7m3gD9c5O6Z7t0+7z9f+2V0P3p3P4p+1Q8+"
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

            /* Password strength colors */
            --strength-weak: #ff6b6b; /* Red */
            --strength-moderate: #ffcc00; /* Yellow */
            --strength-strong: #4CAF50; /* Green */
            --strength-very-strong: #007bff; /* Blue */
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
            background: url({{ asset('img/login.png') }}) no-repeat center center/cover;
            position: relative;
            flex-direction: column;
            padding: 20px;
        }

        .container {
            width: 90%;
            max-width: 500px;
            background: rgba(22, 66, 71, 0.7);
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
        }

        .logo {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 160px;
            height: 160px;
            background: url({{ asset('img/logo_sinfondo.png') }}) center/contain no-repeat;
            z-index: 10;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            color: var(--text-light);
            text-align: center;
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

        .action-btn { /* Renamed from login-btn */
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

        .action-btn:hover {
            background-color: var(--primary-blue-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
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

        .back-container {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        /* Feedback and Error Messages */
        .feedback-message {
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            width: 100%;
            text-align: center;
            font-weight: bold;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .feedback-message.success {
            background-color: var(--success-green);
            color: white;
        }

        .feedback-message.error {
            background-color: var(--danger-red);
            color: white;
        }

        .feedback-message.hidden {
            opacity: 0;
            pointer-events: none;
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
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
            padding-left: 5px;
        }

        .error-list li i {
            font-size: 14px;
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

        .strength-text.weak { color: var(--strength-weak); }
        .strength-text.moderate { color: var(--strength-moderate); }
        .strength-text.strong { color: var(--strength-strong); }
        .strength-text.very-strong { color: var(--strength-very-strong); }

        .strength-bar.weak { background-color: var(--strength-weak); }
        .strength-bar.moderate { background-color: var(--strength-moderate); }
        .strength-bar.strong { background-color: var(--strength-strong); }
        .strength-bar.very-strong { background-color: var(--strength-very-strong); }


        /* Responsive Adjustments */
        @media screen and (max-width: 768px) {
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

            .back-button {
                padding: 8px 15px;
                font-size: 14px;
            }
        }

        @media screen and (max-width: 480px) {
            .container {
                padding: 25px 15px;
            }

            h1 {
                font-size: 24px;
            }

            h2, input, .action-btn, .back-button {
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
    <form action="{{ route('newPass') }}" method="POST" class="container">
        @csrf
        <h1>Establecer Nueva Contraseña</h1>
        <p style="text-align: center; margin-bottom: 20px;">Por favor, ingresa el correo electrónico asociado a tu cuenta, el código de recuperación que recibiste, y tu nueva contraseña.</p>

        @if(session('status'))
            <p class="feedback-message success" id="session-message">
                {{ session('status') }}
            </p>
        @endif
        @if(session('error'))
            <p class="feedback-message error" id="session-message">
                {{ session('error') }}
            </p>
        @endif

        <div class="input-group">
            <h2>Código de Recuperación</h2>
            <input type="text" name="token" placeholder="Ingresa tu código de 6 dígitos" value="{{ old('token') }}" required>
            @error('token')
                <ul class="error-list">
                    <li><i class="fas fa-exclamation-circle"></i> {{ $message }}</li>
                </ul>
            @enderror
        </div>

        <div class="input-group">
            <h2>Nueva Contraseña</h2>
            <input type="password" name="password" id="password-input" placeholder="Nueva contraseña (mínimo 8 caracteres)" required>
            <div class="password-strength-indicator">
                <div id="strength-bar" class="strength-bar"></div>
            </div>
            <div id="strength-text" class="strength-text"></div>
            @error('password')
                <ul class="error-list">
                    <li><i class="fas fa-exclamation-circle"></i> {{ $message }}</li>
                </ul>
            @enderror
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
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password-input');
            const strengthBar = document.getElementById('strength-bar');
            const strengthText = document.getElementById('strength-text');

            if (passwordInput && strengthBar && strengthText) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    updatePasswordStrength(password);
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
                        if (password.length < 8) feedback += ' (mínimo 8 caracteres)';
                        if (!hasLowercase) feedback += ' (falta minúscula)';
                        if (!hasUppercase) feedback += ' (falta mayúscula)';
                        if (!hasNumber) feedback += ' (falta número)';
                        if (!hasSymbol) feedback += ' (falta símbolo)';
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
                    strengthBar.style.width = (score / 7) * 100 + '%';
                    strengthBar.className = 'strength-bar ' + strengthLevel;
                    strengthText.textContent = feedback;
                    strengthText.className = 'strength-text ' + strengthLevel;
                }
            }
        });
    </script>
</body>

</html>
