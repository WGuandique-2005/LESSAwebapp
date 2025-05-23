<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro - PlotChat</title>
    <style>
        /* Tu CSS existente aquí */
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
        }

        .container {
            width: 70%;
            max-width: 500px;
            background: #16424774;
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            color: #fff;
        }

        .logo {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 160px;
            height: 160px;
            background: url({{ asset('img/logo_sinfondo.png') }}) center/contain no-repeat;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            color: white;
        }

        h2 {
            font-size: 16px;
            margin-bottom: 5px;
            color: white;
        }

        .input-group {
            width: 100%;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            outline: none;
            transition: border-color 0.3s ease; /* Transición suave para el borde */
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
            transition: background-color 0.3s;
            background-color: #4285f4;
            color: white;
        }

        .signup-btn:hover {
            background-color: #3367d6;
        }

        .google-btn {
            background-color: white;
            color: #333;
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
            transition: background-color 0.3s;
        }

        .google-btn:hover {
            background-color: #f0f0f0;
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
        }

        .links a {
            color: #fff;
            text-decoration: underline;
        }

        .back-button {
            position: absolute;
            top: 30px;
            left: 30px;
            color: white;
            background-color: #F4A261;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .back-button:hover {
            background-color: #ffffff;
            color: #F4A261;
        }

        /* Estilos para errores de validación */
        .error-message {
            color: #ffdddd;
            font-size: 13px;
            margin-top: 5px;
            padding-left: 5px;
            opacity: 1; /* Por defecto visible si hay error */
            transition: opacity 0.3s ease-in-out; /* Transición para ocultar/mostrar */
        }

        .input-group input.is-invalid {
            border: 1px solid #ff6b6b;
        }

        /* Estilo para mensajes de sesión */
        .session-message {
            padding: 10px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            width: 100%;
            text-align: center;
            font-weight: bold;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        .session-message.success {
            background-color: rgba(40, 167, 69, 0.8); /* Verde */
            color: white;
        }

        .session-message.error {
            background-color: rgba(220, 53, 69, 0.8); /* Rojo */
            color: white;
        }

        .session-message.hidden {
            opacity: 0;
            pointer-events: none; /* Evita que sea clicable cuando está oculto */
        }


        @media screen and (max-width: 768px) {
            .container {
                padding: 30px 20px;
                margin-top: 80px;
            }

            .logo {
                width: 60px;
                height: 60px;
                top: 20px;
                right: 20px;
            }
        }

        @media screen and (max-width: 480px) {
            h1 {
                font-size: 24px;
            }

            input,
            .signup-btn,
            .google-btn {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <a href="/" class="back-button">Volver</a>
    <div class="logo"></div>

    <div class="container">
        <h1>Registrarse</h1>

        {{-- Mensaje de éxito/error global de sesión --}}
        @if (session('success'))
            <div class="session-message success" id="session-message">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="session-message error" id="session-message">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('signup.submit') }}" style="width: 100%;">
            @csrf

            <div class="input-group">
                <h2>Nombre Completo</h2>
                <input type="text" name="name" placeholder="Tu nombre" value="{{ old('name') }}"
                       class="@error('name') is-invalid @enderror" required autocomplete="name" autofocus />
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <h2>Nombre de Usuario</h2>
                <input type="text" name="username" placeholder="Tu nombre de usuario" value="{{ old('username') }}"
                       class="@error('username') is-invalid @enderror" required autocomplete="username" />
                @error('username')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <h2>Correo Electrónico</h2>
                <input type="email" name="email" placeholder="Correo" value="{{ old('email') }}"
                       class="@error('email') is-invalid @enderror" required autocomplete="email" />
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <h2>Contraseña</h2>
                <input type="password" name="password" placeholder="Contraseña"
                       class="@error('password') is-invalid @enderror" required autocomplete="new-password" />
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <h2>Confirmar Contraseña</h2>
                <input type="password" name="password_confirmation" placeholder="Repite tu contraseña" required autocomplete="new-password" />
            </div>

            <button type="submit" class="signup-btn">Registrarse</button>
        </form>

        <a class="google-btn" href="{{ route('auth.google') }}">
            <img src="https://img.icons8.com/?size=512&id=17949&format=png" alt="Google logo" class="google-icon" />
            Inicia sesión con tu cuenta Google
        </a>

        <div class="links">
            <a href="{{ route('login') }}">¿Ya tienes una cuenta? Inicia sesión aquí</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sessionMessage = document.getElementById('session-message');
            if (sessionMessage) {
                setTimeout(() => {
                    sessionMessage.classList.add('hidden');
                }, 5000); // Oculta después de 5 segundos
            }

            // 2. Limpiar errores de validación al escribir en el campo
            const form = document.querySelector('form');
            if (form) {
                form.querySelectorAll('input').forEach(input => {
                    input.addEventListener('input', function() {
                        if (this.classList.contains('is-invalid')) {
                            this.classList.remove('is-invalid');
                            const errorDiv = this.nextElementSibling; // Asume que el div de error es el siguiente hermano
                            if (errorDiv && errorDiv.classList.contains('error-message')) {
                                errorDiv.style.opacity = '0'; // Ocultar el mensaje de error con transición
                                setTimeout(() => {
                                    errorDiv.remove(); // Eliminar el div después de la transición
                                }, 300); // Coincide con la duración de la transición CSS
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
                }, 100); // Pequeño retraso para asegurar que el CSS inicial se aplique
            }
        });
    </script>
</body>

</html>