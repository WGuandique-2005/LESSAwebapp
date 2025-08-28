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
            /* A modern blue */
            --primary-hover-color: #357ABD;
            --text-color: #333;
            --placeholder-color: #999;
            --border-color: #E0E0E0;
            --error-color: #EF4444;
            /* Tailwind red-500 */
            --success-color: #22C55E;
            /* Tailwind green-500 */
            --background-color: #F8F9FA;
            /* Light gray background */
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
            /* Allow header/footer on top/bottom */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            /* Use min-height for flexible content */
            color: var(--text-color);
        }

        .edit-container {
            background-color: var(--card-background);
            padding: 32px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 400px;
            /* Constrain max width for better readability */
            margin: 20px auto;
            /* Add margin for spacing from header/footer */
        }

        h1 {
            text-align: center;
            margin-bottom: 24px;
            color: var(--primary-color);
            font-weight: 700;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 0.95em;
            color: var(--text-color);
        }

        input[type="text"],
        input[type="email"] {
            /* Added email as a common profile field */
            width: calc(100% - 20px);
            /* Account for padding */
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 1em;
            color: var(--text-color);
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
            /* Soft focus ring */
        }

        .feedback-message {
            text-align: center;
            margin-bottom: 16px;
            padding: 10px;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 0.95em;
        }

        .feedback-message.success {
            color: var(--success-color);
            background-color: rgba(34, 197, 94, 0.1);
            /* Light green background */
            border: 1px solid var(--success-color);
        }

        .feedback-message.error {
            color: var(--error-color);
            background-color: rgba(239, 68, 68, 0.1);
            /* Light red background */
            border: 1px solid var(--error-color);
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.85em;
            margin-top: -10px;
            /* Pull error message closer to input */
            margin-bottom: 16px;
            display: block;
            /* Ensure it takes full width */
        }

        button,
        .btn-link {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 1.05em;
            font-weight: 700;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
            text-decoration: none;
            /* For btn-link */
            display: block;
            /* For btn-link */
            text-align: center;
            /* For btn-link */
        }

        button {
            background-color: var(--primary-color);
            color: #fff;
            margin-top: 16px;
        }

        button:hover {
            background-color: var(--primary-hover-color);
        }

        .btn-link {
            background-color: transparent;
            color: var(--primary-color);
            margin-top: 18px;
            border: 1px solid var(--primary-color);
            /* Add a border for better visual weight */
        }

        .btn-link:hover {
            background-color: var(--primary-color);
            color: #fff;
        }

        header,
        footer {
            width: 100%;
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
        </form>

        <p>¿Quieres cambiar tu contraseña?</p>
        <a href="{{ route('password.change.form') }}" class="btn-link">
            Cambiar contraseña
        </a>
    </div>

    <footer>@include('partials.footer')</footer>
</body>

</html>