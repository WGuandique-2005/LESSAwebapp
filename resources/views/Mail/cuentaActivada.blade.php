<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Felicidades! Cuenta activada</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15); /* Sombra mejorada */
        }
        .header {
            background-color: #1976D2; /* Color azul más profesional */
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .content {
            padding: 30px;
            color: #333333;
        }
        .info-box {
            background-color: #E3F2FD; /* Fondo azul claro */
            border-left: 5px solid #1976D2;
            padding: 15px;
            margin-top: 20px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .button {
            display: inline-block;
            margin-top: 25px;
            padding: 15px 30px;
            background-color: #28A745; /* Verde de éxito */
            color: #ffffff !important; /* !important para asegurar que el texto sea blanco */
            text-decoration: none;
            border-radius: 50px; /* Botón más redondeado */
            font-weight: bold;
            font-size: 16px;
        }
        .footer {
            border-top: 1px solid #eeeeee;
            margin-top: 30px;
            padding: 20px;
            font-size: 12px;
            color: #777777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>¡Cuenta Activada en LESSA!</h2>
        </div>
        <div class="content">
            <p>Hola **{{ $user->name }}**, te damos la bienvenida.</p>
            <p>Hemos completado la activación de tu cuenta. Ya puedes iniciar sesión y acceder a todas las funcionalidades de la plataforma.</p>

            <div class="info-box">
                <p>⚠️ **NOTA IMPORTANTE:** Si has recibido este correo después de iniciar el proceso de verificación de tu cuenta, haz clic en el botón de abajo para ser redirigido a la página donde debes **introducir el código** que te enviamos en el correo anterior.</p>
                <p>Tu código ha sido enviado a tu email y está esperando ser ingresado para completar el proceso.</p>
            </div>

            <p style="text-align: center;">
                <a href="{{ route('verify.view') }}" class="button">
                    Ir a la Verificación de Código
                </a>
            </p>

            <p>Si tienes problemas con el botón, copia y pega el siguiente enlace en tu navegador:</p>
            <p><a href="{{ route('verify.view') }}" style="color: #1976D2; text-decoration: none;">{{ route('verify.view') }}</a></p>

        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} LESSA. Todos los derechos reservados.</p>
            <p>Si tienes alguna pregunta, por favor contáctanos.</p>
        </div>
    </div>
</body>
</html>