<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - LESSA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlalr+G/yqW8S8H5f+3zT1xZ6+K/5B5E1Q6Z8c2q5f8+5z7m3gD9c5O6Z7t0+7z9f+2V0P3p3P4p+1Q8+"
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
            --error-red: #ff6b6b;
            --success-green: rgba(40, 167, 69, 0.8);
            --danger-red: rgba(220, 53, 69, 0.8);
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
            background-color: #333;
            background-image: url({{ asset('img/login.png') }});
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            position: relative;
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
            box-shadow: 0 10px 40px var(--shadow-light);
            color: var(--text-light);
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 120px;
            height: 120px;
            background: url({{ asset('img/logo_sinfondo.png') }}) center/contain no-repeat;
            opacity: 0.9;
            transition: transform 0.3s ease-in-out;
            z-index: 10;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        h1 {
            font-size: 32px;
            margin-bottom: 25px;
            color: var(--text-light);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 16px;
            margin-bottom: 8px;
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
            padding-right: 45px;
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


        .login-btn,
        .google-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }

        .login-btn {
            background-color: var(--primary-blue);
            color: var(--text-light);
        }

        .login-btn:hover {
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
            margin-bottom: 25px;
        }

        .google-btn:hover {
            background-color: #f0f0f0;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .google-icon {
            width: 22px;
            height: 22px;
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

        .error-message {
            color: var(--error-red);
            font-size: 13px;
            margin-top: 5px;
            padding-left: 5px;
            display: flex;
            align-items: center;
            opacity: 0;
            height: 0;
            overflow: hidden;
            transition: opacity 0.4s ease-in-out, height 0.4s ease-in-out, margin-top 0.4s ease-in-out;
        }

        .error-message.show {
            opacity: 1;
            height: auto;
            margin-top: 5px;
        }

        .error-message i {
            margin-right: 8px;
            font-size: 14px;
        }

        .input-group input.is-invalid {
            border: 1px solid var(--error-red);
        }

        .session-message {
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

        .session-message.success {
            background-color: var(--success-green);
            color: white;
        }

        .session-message.error {
            background-color: var(--danger-red);
            color: white;
        }

        .session-message.hidden {
            opacity: 0;
            pointer-events: none;
        }

        @media screen and (max-width: 768px) {
            .container {
                padding: 30px 25px;
                margin-top: 80px;
                width: 95%;
            }

            .logo {
                width: 80px;
                height: 80px;
                top: 20px;
                right: 20px;
            }

            h1 {
                font-size: 28px;
                margin-bottom: 20px;
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
                padding: 25px 20px;
                margin-top: 70px;
            }

            h1 {
                font-size: 24px;
            }

            h2 {
                font-size: 14px;
            }

            input,
            .login-btn,
            .google-btn {
                font-size: 15px;
                padding: 12px;
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
    <a class="back-button">Volver</a>
    <div class="logo"></div>

    <form action="{{ route('login.submit') }}" method="POST" class="container">
        @csrf

        <h1>Login</h1>

        @if (session('status'))
            <div class="session-message success" id="session-message">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="session-message error" id="session-message">
                {{ session('error') }}
            </div>
        @endif
        @if (session('google'))
            <div class="session-message error" id="google-message">
                {{ session('google') }}
            </div>
        @endif
        @error('loginError')
            <div class="session-message error show" id="login-error-message">
                <i class="fa-solid fa-circle-exclamation"></i>{{ $message }}
            </div>
        @enderror


        <div class="input-group">
            <h2>Correo</h2>
            <input type="email" name="email" id="email" placeholder="Introduce tu correo"
                value="{{ old('email') }}" class="@error('email') is-invalid @enderror" required />
            @error('email')
                <div class="error-message show"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group">
            <h2>Contraseña</h2>
            <input type="password" name="password" id="password" placeholder="Introduce tu contraseña"
                class="@error('password') is-invalid @enderror" required />
            @error('password')
                <div class="error-message show"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="login-btn">Iniciar sesión</button>

        <a class="google-btn" href="{{ route('auth.google') }}">
            <img src="https://img.icons8.com/?size=512&id=17949&format=png" alt="Google logo" class="google-icon" />
            Inicia sesión con tu cuenta Google
        </a>

        <div class="links">
            <a href="{{ route('recuperar') }}">¿Olvidaste tu contraseña?</a><br>
            ¿No tienes una cuenta? <a href="{{ route('signup') }}">Crea una aquí</a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const backButton = document.querySelector('.back-button');
            if (backButton) {
                backButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    window.history.back();
                });
            }

            const form = document.querySelector('form');
            if (form) {
                form.querySelectorAll('input').forEach(input => {
                    input.addEventListener('input', function() {
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
        });
    </script>
</body>

</html>