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
    .btn {
        display:inline-block;
        padding:10px 18px;
        background:#1a73e8;
        color:#fff;
        text-decoration:none;
        border-radius:6px;
        margin-top:10px;
    }
</style>
</head>
<body>
    <h2>Hola, {{ $user->name }}!</h2>
    <p>Tu código de verificación es:</p>
    <h1 style="letter-spacing:4px">{{ $token }}</h1>

    <p>También puedes verificar tu cuenta haciendo clic en el siguiente enlace. Al abrirlo se preparará la pantalla de verificación para que pegues el código.</p>

    <p style="text-align:center">
        <a class="btn" href="{{ route('verify.view', ['uid' => $user->id, 'token' => $token]) }}">
            Verificar mi cuenta
        </a>
    </p>

    <p>Ingresa este código en la pantalla de verificación de nuestra aplicación. Tiene validez de 5 minutos.</p>
    <p>Si no solicitaste este código, ignora este correo.</p>
    <p>&copy; {{ date('Y') }} LESSA. Todos los derechos reservados.</p>
</body>
</html>
