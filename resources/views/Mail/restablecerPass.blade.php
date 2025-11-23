<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f8;
        color: #333;
        margin: 0;
        padding: 24px;
    }
    .email-wrapper {
        max-width: 600px;
        margin: 24px auto;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    .email-header {
        background: linear-gradient(90deg,#4A90E2,#357ABD);
        color: #fff;
        padding: 20px;
        text-align: center;
    }
    .email-body {
        padding: 28px;
        text-align: center;
    }
    .greeting { font-size: 18px; margin: 0 0 12px; }
    .lead { color: #555; margin: 0 0 18px; }
    .token-box {
        display: inline-block;
        font-family: 'Courier New', monospace;
        font-size: 28px;
        letter-spacing: 6px;
        background: #f1f5f9;
        border: 1px dashed #d1d5db;
        color: #1f2937;
        padding: 14px 22px;
        border-radius: 8px;
        margin: 12px 0 20px;
    }
    .cta {
        display: inline-block;
        text-decoration: none;
        background-color: #2563eb;
        color: #fff;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 700;
        box-shadow: 0 6px 14px rgba(37,99,235,0.18);
        margin-bottom: 14px;
    }
    .small {
        font-size: 13px;
        color: #6b7280;
        margin-top: 12px;
    }
    .foot {
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
    @media screen and (max-width:480px){
        .token-box { font-size: 22px; letter-spacing:4px; padding:10px 16px; }
        .cta { width: 100%; display: block; }
    }
</style>
<title>Recuperación de contraseña</title>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            <h2 style="margin:0;">Recuperación de contraseña</h2>
        </div>

        <div class="email-body">
            <p class="greeting">Hola, {{ $user->name }}</p>
            <p class="lead">Hemos recibido una solicitud para restablecer tu contraseña.</p>

            <p style="margin:0 0 8px;">Tu código de recuperación</p>
            <div class="token-box">{{ $token }}</div>

            <!-- Botón CTA (único visible) -->
            <div>
                <a class="cta" href="{{ url('/new_pass') . '?uid=' . $user->id . '&token=' . $token }}" target="_blank" rel="noopener noreferrer">
                    Restablecer contraseña
                </a>
            </div>

            <p class="small">El enlace y el código expiran en 2 horas. Si no solicitaste este cambio, puedes ignorar este correo.</p>
        </div>

        <div class="foot">
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
