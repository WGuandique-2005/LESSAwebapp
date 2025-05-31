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
</head>
<body>
    <h2>Hola, {{ $user->name }}!</h2>
    <p>Recibimos una solicitud para actualizar tu contraseña.</p>
    <p>Usa el siguiente código para actualizar tu contraseña:</p>
    <h1 style="letter-spacing:4px">{{ $token }}</h1>
    <p>Si no solicitaste este cambio, puedes ignorar este mensaje.</p>
    <p>Gracias por usar nuestro servicio.</p>
    <p>&copy; {{ date('Y') }} LESSA. Todos los derechos reservados.</p>
</body>
</html>
