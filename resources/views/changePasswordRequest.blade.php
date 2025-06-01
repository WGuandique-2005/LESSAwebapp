<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar cambio de contraseña</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4A90E2; /* A modern blue */
            --primary-hover-color: #357ABD;
            --text-color: #333;
            --light-text-color: #666;
            --border-color: #E0E0E0;
            --error-color: #EF4444;
            --success-color: #22C55E;
            --background-color: #F8F9FA;
            --card-background: #FFFFFF;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --border-radius: 8px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text-color);
        }

        .container {
            background-color: var(--card-background);
            padding: 32px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
            text-align: center; /* Center content within the container */
        }

        h1 {
            text-align: center;
            margin-bottom: 24px;
            color: var(--primary-color);
            font-weight: 700;
        }

        p {
            font-size: 0.95em;
            line-height: 1.5;
            margin-bottom: 16px;
            color: var(--light-text-color);
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 0.95em;
            color: var(--text-color);
            text-align: left; /* Align label left */
        }

        input[type="email"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px; /* More space below input */
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 1em;
            color: var(--text-color);
            background-color: #F0F0F0; /* Slightly differentiate readonly input */
            cursor: default;
        }

        .feedback-message {
            text-align: center;
            margin-bottom: 20px; /* More space for feedback */
            padding: 10px;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 0.95em;
        }

        .feedback-message.success {
            color: var(--success-color);
            background-color: rgba(34, 197, 94, 0.1);
            border: 1px solid var(--success-color);
        }

        .feedback-message.error {
            color: var(--error-color);
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid var(--error-color);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 1.05em;
            font-weight: 700;
            transition: background-color 0.2s ease-in-out;
            margin-top: 10px; /* Space above button */
        }

        button:hover {
            background-color: var(--primary-hover-color);
        }

        /* Basic header/footer styling for context */
        header, footer {
            width: 100%;
            padding: 15px 0;
        }

        header {
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .instructions {
            margin-top: 20px;
            color: var(--light-text-color);
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <header>@include('partials.navbar')</header>

    <div class="container">
        <h1>Solicitar cambio de contraseña</h1>

        @if(session('status'))
            <p class="feedback-message success">
                {{ session('status') }}
            </p>
        @endif

        @if(session('error'))
            <p class="feedback-message error">
                {{ session('error') }}
            </p>
        @endif

        <p>
            Para cambiar tu contraseña, haz clic en el botón de abajo.
            Enviaremos un **código de verificación** a tu correo electrónico registrado.
        </p>

        <form method="POST" action="{{ route('password.change.send') }}">
            @csrf

            <label for="email">Tu correo electrónico</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email', Auth::user()->email) }}"
                required
                readonly
            >

            <button type="submit">Enviar código de cambio</button>
        </form>

        <div class="instructions">
            <p>
                **Importante:** Revisa tu bandeja de entrada y la carpeta de spam.
                El correo con el código puede tardar unos minutos en llegar.
            </p>
            {{-- Reenviar token de cambio de contraseña --}}
            <form method="POST" action="{{ route('password.change.resend') }}">
                @csrf
                <button type="submit">Reenviar código</button>
            </form>
        </div>
    </div>

    <footer>@include('partials.footer')</footer>
</body>
</html>