<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-color: #4A90E2;
        --primary-hover-color: #357ABD;
        --text-color: #333;
        --placeholder-color: #999;
        --border-color: #E0E0E0;
        --error-color: #EF4444;
        --success-color: #22C55E;
        --background-color: #F5F7FA;
        --card-background: #FFFFFF;
        --shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        --border-radius: 10px;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--background-color);
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        color: var(--text-color);
    }

    header, footer {
        width: 100%;
    }

    .edit-container {
        background-color: var(--card-background);
        padding: 24px;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        width: 92%;
        max-width: 420px;
        margin: 24px auto;
        box-sizing: border-box;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.6rem;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        font-size: 0.95em;
    }

    input[type="text"],
    input[type="email"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 16px;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        font-size: 1em;
        color: var(--text-color);
        box-sizing: border-box;
    }

    input[type="text"]:focus,
    input[type="email"]:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.25);
    }

    .feedback-message {
        padding: 12px;
        border-radius: var(--border-radius);
        font-weight: 600;
        font-size: 0.95em;
        margin-bottom: 18px;
        text-align: center;
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

    .error-message {
        color: var(--error-color);
        font-size: 0.85em;
        margin-top: -10px;
        margin-bottom: 12px;
        display: block;
    }

    button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        font-size: 1.05em;
        font-weight: 700;
        background-color: var(--primary-color);
        color: #fff;
        transition: 0.2s ease-in-out;
        margin-top: 10px;
    }

    button:hover {
        background-color: var(--primary-hover-color);
    }

    /* Reemplazado: mejora visual y centrado consistente */
    .btn-link {
        display: flex;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
        width: 100%;
        padding: 10px 14px;
        height: 44px; /* altura fija para alineación consistente con el botón principal */
        border-radius: var(--border-radius);
        border: 1px solid var(--primary-color);
        background-color: transparent;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 700;
        margin-top: 10px;
        transition: background-color 0.15s ease, color 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    .btn-link:hover {
        background-color: var(--primary-color);
        color: #fff;
        border-color: var(--primary-hover-color);
    }

    .btn-link:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.15);
    }

    p {
        margin-top: 18px;
        text-align: center;
        font-size: 0.9rem;
    }

    /* RESPONSIVIDAD */
    @media (max-width: 480px) {
        h1 {
            font-size: 1.4rem;
        }

        .edit-container {
            padding: 20px;
        }

        input,
        button,
        .btn-link {
            font-size: 1rem;
            padding: 10px;
        }
    }
</style>

</head>

<body>
    <header>@include('partials.navbar')</header>

    <div class="edit-container">
        <h1>Editar Perfil</h1>

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

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf

            <label for="name">Nombre completo</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus>
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror

            <label for="username">Nombre de usuario</label>
            <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}" required>
            @error('username')
                <span class="error-message">{{ $message }}</span>
            @enderror

            <button type="submit">Guardar cambios</button>
            @if(Auth::user()->es_google_oauth == 0)
                <p>¿Quieres cambiar tu contraseña?</p>
                <a href="{{ route('password.change.form') }}" class="btn-link">
                    Cambiar contraseña
                </a>
            @endif
        </form>
    </div>

    <footer>@include('partials.footer')</footer>
</body>

</html>