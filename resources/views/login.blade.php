<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Login - LESSA</title>

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
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light) url({{ asset('img/login.png') }}) center/cover no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--dark);
            padding: 24px;
        }

        .container {
            width: 100%;
            max-width: 480px;
            background: rgba(10, 36, 99, 0.88);
            color: white;
            padding: 36px 28px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
            text-align: center;
            position: relative;
            animation: fadeIn .6s ease;
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
            margin-bottom: 14px;
            color: rgba(255, 255, 255, 0.9);
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
        }

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

        .login-btn {
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
        }

        .login-btn:hover {
            transform: translateY(-3px);
            background: var(--secondary);
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
            margin-top: 14px;
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
        }

        /* small helper for hide animation */
        .fade-out {
            opacity: 0;
            transform: translateY(-8px);
            transition: opacity .35s, transform .35s;
        }

        @media (max-width:520px) {
            .container {
                padding: 22px;
                border-radius: 12px
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

    <form action="{{ route('login.submit') }}" method="POST" class="container" aria-labelledby="login-title" novalidate>
        @csrf
        <div class="logo" role="img" aria-label="LESSA logo"></div>
        <h1 id="login-title">Iniciar sesión</h1>
        <p class="lead">Accede a tu cuenta para continuar aprendiendo con LESSA.</p>

        <!-- Alerts region (status, error, validation) -->
        <div class="alerts" id="alerts" aria-live="polite" aria-atomic="true">
            {{-- success message --}}
            @if(session('status'))
                <div class="alert alert-success" role="status" data-auto-hide>
                    <div class="left">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <div class="msg">{{ session('status') }}</div>
                    </div>
                    <div class="actions"><button type="button" class="close" aria-label="Cerrar alerta">&times;</button>
                    </div>
                </div>
            @endif

            {{-- generic error message --}}
            @if(session('error'))
                <div class="alert alert-error" role="alert" data-auto-hide>
                    <div class="left">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 9v4m0 4h.01" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <div class="msg">{{ session('error') }}</div>
                    </div>
                    <div class="actions"><button type="button" class="close" aria-label="Cerrar alerta">&times;</button>
                    </div>
                </div>
            @endif

            {{-- validation errors (Illuminate\Support\MessageBag) --}}
            @if ($errors->any())
                <div class="alert alert-error" role="alert" data-auto-hide="false">
                    <div class="left">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 9v4m0 4h.01" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <div class="msg validation-list">
                            <div>Se encontraron los siguientes errores:</div>
                            <ul>
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="actions"><button type="button" class="close" aria-label="Cerrar errores">&times;</button>
                    </div>
                </div>
            @endif
        </div>
        <!-- /Alerts region -->

        <!-- Form fields -->
        <div class="input-group">
            <label for="email">Correo</label>
            <input id="email" name="email" type="email" placeholder="ejemplo@correo.com" value="{{ old('email') }}"
                required class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
        </div>

        <div class="input-group">
            <label for="password">Contraseña</label>
            <input id="password" name="password" type="password" placeholder="********" required
                class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
        </div>

        <button type="submit" class="login-btn" aria-label="Iniciar sesión">Entrar</button>

        <a href="{{ route('auth.google') }}" class="google-btn" role="button" aria-label="Iniciar sesión con Google">
            <img src="https://img.icons8.com/?size=512&id=17949&format=png" alt="Google logo">Continuar con Google
        </a>

        <div class="links">
            <a href="{{ route('recuperar') }}">¿Olvidaste tu contraseña?</a><br>
            ¿No tienes cuenta? <a href="{{ route('signup') }}">Regístrate aquí</a>
        </div>
    </form>

    <script>
        (function () {
            // Close button behavior: remove alert on click
            document.querySelectorAll('.alert .close').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const alert = btn.closest('.alert');
                    if (!alert) return;
                    alert.classList.add('fade-out');
                    setTimeout(() => alert.remove(), 350);
                });
            });

            // Auto-hide alerts that have [data-auto-hide] (defaults to 7000ms)
            document.querySelectorAll('.alert[data-auto-hide]').forEach(alert => {
                const timeout = 7000;
                setTimeout(() => {
                    if (!document.body.contains(alert)) return;
                    alert.classList.add('fade-out');
                    setTimeout(() => alert.remove(), 350);
                }, timeout);
            });

            // Improve UX: focus first invalid field if validation failed
            @if($errors->any())
                (function () {
                    const firstInvalid = document.querySelector('.is-invalid');
                    if (firstInvalid) firstInvalid.focus();
                })();
            @endif
    })();
    </script>
</body>

</html>