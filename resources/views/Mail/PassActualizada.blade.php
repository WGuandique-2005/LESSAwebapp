<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contraseña actualizada</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 30px;
            color: #333333;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
            color: #6b7280;
            margin-top: 30px;
        }
        .contact-email {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
        }
        .team-signature {
            font-weight: 600;
            color: #374151;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Contraseña actualizada</h1>
        </div>
        <div class="content">
            <p>Hola {{ $user->name }},</p>
            <p>Tu contraseña fue actualizada con exito.</p>
        </div>
        <div class="footer">
            <p style="margin-bottom: 15px;">Atentamente,<br><span class="team-signature">El equipo de LESSA</span></p>
            <p style="margin-bottom: 5px;">¿Tienes alguna duda? Contáctanos:</p>
            <a href="mailto:wguandique2006@gmail.com" class="contact-email">wguandique2006@gmail.com</a>
            <p style="margin-top: 20px; font-size: 12px; color: #9ca3af;">
                &copy; {{ date('Y') }} LESSA. Todos los derechos reservados.
            </p>
        </div>
    </div>
</body>
</html>
