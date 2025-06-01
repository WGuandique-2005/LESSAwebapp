<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Recuperar Contraseña - LESSA</title>
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
            --border-radius: 10px; /* Added for consistency */
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
            flex-direction: column; /* Allows content to stack vertically */
            padding: 20px; /* Added for small screen padding */
        }

        .container {
            width: 90%; /* Adjusted for better mobile fit */
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
            flex-shrink: 0; /* Prevents shrinking on smaller screens */
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
            align-self: flex-start; /* Aligns label to the start */
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

        .action-btn { /* Renamed from login-btn for generic use */
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
            display: inline-flex; /* Use flex for icon alignment */
            align-items: center;
            gap: 8px; /* Space between icon and text */
            margin-top: 20px;
            color: var(--text-light);
            background-color: var(--secondary-orange);
            padding: 10px 20px;
            border-radius: 8px; /* Slightly more rounded */
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
            margin-top: 10px;
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

        .change-password-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .change-password-link a {
            color: var(--secondary-orange);
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .change-password-link a:hover {
            color: var(--text-light);
            text-decoration: underline;
        }

        /* Responsive Adjustments */
        @media screen and (max-width: 768px) {
            .container {
                padding: 30px 20px;
                margin-top: 80px;
            }

            .logo {
                width: 80px; /* Smaller logo */
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
    <form action="{{ route('recuperarPass') }}" method="POST" class="container">
        @csrf
        <h1>Recuperar Contraseña</h1>
        <p style="text-align: center; margin-bottom: 20px;">Ingresa tu correo electrónico para recibir un código de recuperación.</p>

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
            <h2>Correo Electrónico</h2>
            <input type="email" name="email" placeholder="email@example.com" value="{{ old('email') }}" required />
            @error('email')
                <ul class="error-list">
                    <li><i class="fas fa-exclamation-circle"></i> {{ $message }}</li>
                </ul>
            @enderror
        </div>

        <button type="submit" class="action-btn">Solicitar Código de Recuperación</button>

        <div class="back-container">
            <a href="{{ route('login') }}" class="back-button">
                <i class="fas fa-arrow-left"></i> Volver al Inicio de Sesión
            </a>
        </div>

        @if (session('status'))
            <div class="change-password-link">
                <a href="{{ route('newPass_view') }}">¿Ya tienes el código? Cambia tu contraseña aquí.</a>
            </div>
        @endif
    </form>
</body>

</html>
