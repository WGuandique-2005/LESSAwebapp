<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica tu cuenta</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --light-bg: #f5f7fa; /* Fondo más claro */
            --card-bg: #ffffff;
            --dark-text: #212529;
            --border-color: #e0e6ed;
            --shadow-soft: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .verify-container {
            background-color: var(--card-bg);
            padding: 40px;
            border-radius: 12px; /* Más redondeado */
            box-shadow: var(--shadow-soft);
            width: 100%;
            max-width: 420px; /* Ancho optimizado */
            text-align: center;
            box-sizing: border-box;
            transition: transform 0.3s ease-in-out;
        }

        .verify-container:hover {
            transform: translateY(-3px); /* Pequeño efecto hover */
        }

        .logo-container {
            margin-bottom: 25px;
        }

        .logo {
            max-width: 120px; /* Tamaño del logo */
            height: auto;
            border-radius: 5px; /* Bordes suaves si el logo es cuadrado */
        }

        h1 {
            font-size: 1.8em;
            color: var(--primary-color);
            margin-bottom: 5px;
            font-weight: 700;
        }

        p.instruction {
            color: var(--secondary-color);
            margin-bottom: 30px;
            font-size: 1em;
        }

        p.alert-box {
            background-color: #e6f7ff; /* Azul claro */
            color: #0056b3; /* Azul oscuro */
            border: 1px solid #b3d9ff;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.95em;
            font-weight: 600;
        }

        p.text-danger {
            color: var(--danger-color);
            font-size: 0.85em;
            margin-top: 5px;
            margin-bottom: 15px;
            text-align: left;
            font-weight: 600;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--dark-text);
            text-align: left;
            font-size: 1em;
        }

        /* Estilo para el input del código */
        .input-group {
            display: flex;
            justify-content: center;
            margin-bottom: 25px;
        }

        input[type="text"] {
            width: 100%;
            padding: 15px;
            border-radius: 8px;
            border: 2px solid var(--border-color);
            font-size: 1.5em; /* Tamaño grande para el código */
            text-align: center;
            letter-spacing: 5px; /* Espaciado para los dígitos */
            font-weight: 700;
            color: var(--dark-text);
            transition: border-color 0.3s, box-shadow 0.3s;
            max-width: 250px; /* Limita el ancho del input para 6 dígitos */
            box-sizing: border-box;
        }

        input[type="text"]:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.15);
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: var(--success-color);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.05em;
            font-weight: 700;
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
            box-sizing: border-box;
        }

        button:hover {
            background-color: #1e7e34; /* Darker shade of success */
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .resend-form button {
            margin-top: 15px;
            background-color: var(--secondary-color);
        }

        .resend-form button:hover {
            background-color: #5a6268;
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .verify-container {
                padding: 30px 20px;
                border-radius: 10px;
                margin: 0;
            }

            h1 {
                font-size: 1.6em;
            }

            input[type="text"] {
                padding: 12px;
                font-size: 1.3em;
                letter-spacing: 4px;
            }

            button {
                padding: 12px;
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="verify-container">
        <div class="logo-container">
            <img src="{{ asset('img/logo2.png') }}" alt="Logo LESSA" class="logo">
        </div>

        <h1>Verifica tu cuenta</h1>
        <p class="instruction">Introduce el código de 6 dígitos que enviamos a tu correo electrónico.</p>

        @if(session('status'))
            <p class="alert-box">{{ session('status') }}</p>
        @endif
        
        @if(session('error'))
            <p class="alert-box" style="background-color: #f8d7da; color: var(--danger-color); border-color: #f5c6cb;">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('verify.submit') }}">
            @csrf

            <label for="token">Código de Verificación</label>
            <div class="input-group">
                <input
                    id="token"
                    name="token"
                    type="text"
                    maxlength="6"
                    value="{{ old('token') }}"
                    required
                    autofocus
                    placeholder="------"
                >
            </div>
            
            @error('token')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <button type="submit">Activar Cuenta</button>
        </form>

        <form method="POST" action="{{ route('verify.resend') }}" class="resend-form">
            @csrf
            <button type="submit">Reenviar código</button>
        </form>
    </div>

    @if(session('verify_user_id'))
    <script>
        (function(){
            const statusUrl = "{{ route('verify.status') }}";
            const remoteLoginUrl = "{{ route('verify.remoteLogin') }}";
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Poll cada 3s para comprobar si el usuario se activó en otro dispositivo
            const pollInterval = 3000;
            let poller = setInterval(async () => {
                try {
                    const res = await fetch(statusUrl, { credentials: 'same-origin' });
                    if (!res.ok) return;
                    const data = await res.json();
                    if (data.activated) {
                        clearInterval(poller);
                        // Solicitar al servidor que haga login en esta sesión
                        const r = await fetch(remoteLoginUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            credentials: 'same-origin',
                            body: JSON.stringify({})
                        });
                        if (r.ok) {
                            const jr = await r.json();
                            if (jr.ok && jr.redirect) {
                                window.location.href = jr.redirect;
                            } else {
                                // fallback: recargar
                                window.location.reload();
                            }
                        } else {
                            window.location.reload();
                        }
                    }
                } catch (e) {
                    // Silencioso: seguir intentando
                }
            }, pollInterval);
        })();
    </script>
    @endif
</body>
</html>