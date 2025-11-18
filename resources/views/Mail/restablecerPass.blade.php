<!DOCTYPE html>
<html>
<head><meta charset="utf-8">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    h2 {
        text-align: center;
    }
    h1 {
        text-align: center;
        letter-spacing: 4px;
    }
    p {
        text-align: center;
    }
</style>
<title>Recuperación de contraseña</title>
</head>
<body>
    <h2>Hola, {{ $user->name }}</h2>
    <p>Hemos recibido una solicitud para restablecer tu contraseña.</p>
    <p>Este es tu código de recuperación:</p>
    <h1>{{ $token }}</h1>

    <!-- NUEVO: enlace directo que incluye uid + token -->
    <p>También puedes usar el siguiente enlace para abrir el formulario de recuperación en tu navegador:</p>
    <p>
        <a href="{{ url('/new_pass') . '?uid=' . $user->id . '&token=' . $token }}">
            {{ url('/new_pass') . '?uid=' . $user->id . '&token=' . $token }}
        </a>
    </p>

    <p>Este código expirará en 2 horas.</p>
    <p>Si no solicitaste este cambio, puedes ignorar este correo.</p>
</body>
</html>
