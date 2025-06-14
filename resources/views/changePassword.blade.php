<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar cambio de contraseña</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4A90E2;
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
            --focus-ring-color: rgba(74, 144, 226, 0.2);
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
            line-height: 1.6;
        }

        .container {
            background-color: var(--card-background);
            padding: 32px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 440px;
            margin: 20px auto;
            text-align: left;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
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

        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 1em;
            color: var(--text-color);
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        input[type="password"]:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--focus-ring-color);
        }

        .feedback-message {
            text-align: center;
            margin-bottom: 20px;
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

        .error-list {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
            text-align: left;
        }

        .error-list li {
            color: var(--error-color);
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid var(--error-color);
            padding: 8px 12px;
            border-radius: var(--border-radius);
            margin-bottom: 8px;
            font-size: 0.9em;
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
            transition: background-color 0.2s ease-in-out, transform 0.1s ease-in-out;
            margin-top: 10px;
        }

        button:hover {
            background-color: var(--primary-hover-color);
            transform: translateY(-1px);
        }

        button:active {
            transform: translateY(0);
        }

        .password-strength {
            font-size: 0.85em;
            margin-top: -10px;
            margin-bottom: 18px;
            text-align: right;
            color: var(--light-text-color);
        }

        .strength-indicator {
            height: 5px;
            background-color: #eee;
            border-radius: 2.5px;
            margin-top: 5px;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            width: 0%;
            background-color: transparent;
            transition: width 0.3s ease-in-out, background-color 0.3s ease-in-out;
        }

        .strength-weak .strength-bar { background-color: var(--error-color); width: 33%; }
        .strength-medium .strength-bar { background-color: orange; width: 66%; }
        .strength-strong .strength-bar { background-color: var(--success-color); width: 100%; }
    </style>
</head>
<body>
    <header>@include('partials.navbar')</header>
    <div class="container">
        <h2>Confirmar cambio de contraseña</h2>

        @if(session('status'))
            <p class="feedback-message success">
                {{ session('status') }}
            </p>
        @endif

        @if($errors->any())
            <ul class="error-list">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('password.change') }}">
            @csrf

            <label for="current_password">Ingresa tu contraseña actual</label>
            <input type="password" name="current_password" id="current_password" required>

            <label for="new_password">Nueva contraseña</label>
            <input type="password" name="new_password" id="new_password" required autocomplete="new-password">
            <div class="password-strength">
                <span id="strength-text"></span>
                <div class="strength-indicator">
                    <div id="strength-bar" class="strength-bar"></div>
                </div>
            </div>

            <label for="new_password_confirmation">Confirmar nueva contraseña</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" required autocomplete="new-password">

            <button type="submit">Cambiar contraseña</button>
        </form>
    </div>
    <footer>@include('partials.footer')</footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const newPasswordInput = document.getElementById('new_password');
            const strengthText = document.getElementById('strength-text');
            const strengthBar = document.getElementById('strength-bar');
            const strengthIndicator = document.querySelector('.strength-indicator');

            newPasswordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                let text = 'Muy débil';
                let className = '';

                if (password.length > 0) {
                    // Check for length
                    if (password.length >= 8) strength += 1;
                    // Check for numbers
                    if (/[0-9]/.test(password)) strength += 1;
                    // Check for special characters
                    if (/[^A-Za-z0-9]/.test(password)) strength += 1;
                    // Check for mixed case
                    if (/[A-Z]/.test(password) && /[a-z]/.test(password)) strength += 1;

                    if (strength === 0) {
                        text = 'Muy débil';
                        className = 'strength-weak';
                    } else if (strength <= 2) {
                        text = 'Débil';
                        className = 'strength-weak';
                    } else if (strength === 3) {
                        text = 'Medio';
                        className = 'strength-medium';
                    } else {
                        text = 'Fuerte';
                        className = 'strength-strong';
                    }
                } else {
                    text = ''; // Clear text if password is empty
                    strengthBar.style.width = '0%'; // Reset bar
                    strengthIndicator.className = 'strength-indicator'; // Reset class
                }

                strengthText.textContent = text;
                strengthIndicator.className = 'strength-indicator ' + className;
            });
        });
    </script>
</body>
</html>