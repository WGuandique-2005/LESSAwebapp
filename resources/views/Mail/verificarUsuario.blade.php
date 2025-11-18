<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Código de Verificación LESSA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-top: 5px solid #0056b3; /* Línea de color azul para destacar */
        }
        .header {
            padding: 20px 20px 10px 20px;
            text-align: center;
        }
        .content {
            padding: 30px;
            color: #333333;
            text-align: center;
        }
        .logo {
            max-width: 150px;
            height: auto;
            margin-bottom: 10px;
        }
        .code-box {
            background-color: #e6f7ff; /* Fondo azul muy claro */
            border: 1px solid #cceeff;
            padding: 15px;
            margin: 25px auto;
            border-radius: 8px;
            font-size: 24px;
            font-weight: bold;
            color: #0056b3; /* Azul oscuro para el código */
            display: inline-block;
            letter-spacing: 5px;
        }
        .button {
            display: inline-block;
            margin-top: 25px;
            padding: 15px 30px;
            background-color: #28a745; /* Verde para la acción */
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 50px;
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
            {{-- Se asume que la imagen está en public/img/logo2.png --}}
            <img src="{{ asset('img/logo2.png') }}" alt="Logo LESSA" class="logo">
            <h2>Verificación de Cuenta</h2>
        </div>
        <div class="content">
            <p>Hola **{{ $user->name }}**, te enviamos tu código para validar tu dirección de correo electrónico (**{{ $user->email }}**).</p>

            <p>Tu código de verificación es:</p>
            <div class="code-box">{{ $token }}</div>

            <p>Este código es necesario para activar tu cuenta. Por favor, ingrésalo en la página de verificación haciendo clic en el siguiente botón:</p>

            <p style="text-align: center;">
                {{-- ENLACE ROBUSTO: Pasa el ID del usuario en la URL para que el formulario sepa
                     a qué usuario verificar, incluso sin una sesión activa. --}}
                <a href="{{ route('verification.form', ['user_id' => $user->id]) }}" 
                   class="button" 
                   style="color: #ffffff; text-decoration: none; background-color: #007bff; border-radius: 5px; padding: 12px 25px;">
                    Ir a la Verificación
                </a>
            </p>

            <p style="font-size: 14px; margin-top: 30px;">
                **Importante:** Este código tiene validez de **24 horas**. Si el botón no funciona, copia y pega este enlace en tu navegador:
            </p>
            <p><a href="{{ route('verification.form', ['user_id' => $user->id]) }}" style="color: #007bff;">{{ route('verification.form', ['user_id' => $user->id]) }}</a></p>

        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} LESSA. Todos los derechos reservados.</p>
            <p>Si no solicitaste este código, ignora este correo.</p>
        </div>
    </div>
</body>
</html>