<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6fb;
            color: #123243;
            margin: 0;
            padding: 0
        }

        .container {
            max-width: 600px;
            margin: 36px auto;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e9f0fb
        }

        .header {
            background: linear-gradient(90deg, #0066cc, #17a2b8);
            padding: 18px;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 12px
        }

        .h-title {
            font-size: 18px;
            font-weight: 800
        }

        .body {
            padding: 26px;
            text-align: center
        }

        .token {
            display: block;
            font-size: 32px;
            letter-spacing: 6px;
            font-weight: 800;
            margin: 12px 0;
            color: #063852
        }

        .cta {
            display: inline-block;
            padding: 12px 22px;
            background: #0066cc;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            margin-top: 8px
        }

        .note {
            color: #56707a;
            margin-top: 14px;
            font-size: 14px
        }

        .footer {
            background-color: #f9fafb;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
            color: #6b7280;
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

        .small {
            font-size: 12px;
            color: #9aa7b3;
            margin-top: 6px
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div>
                <div class="h-title">LESSA — Verificación de cuenta</div>
                <div class="small">Aprende Lengua de Señas</div>
            </div>
        </div>

        <div class="body">
            <h2 style="margin:10px 0 6px">Hola, {{ $user->name }}!</h2>
            <p class="note">Tu código de verificación es:</p>
            <span class="token">{{ $token }}</span>

            <p style="margin:14px 0">
                <a class="cta" href="{{ route('verify.view', ['uid' => $user->id, 'token' => $token]) }}">
                    Verificar mi cuenta
                </a>
            </p>

            <p class="note">Si prefieres, introduce el código en la pantalla de verificación de la app. El código expira
                en 5 minutos.</p>
            <p class="small">Si no solicitaste este código, ignora este correo.</p>
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