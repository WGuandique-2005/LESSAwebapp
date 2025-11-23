<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset and base styles */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        .wrapper {
            width: 100%;
            background-color: #f3f4f6;
            padding: 40px 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }
        .header {
            background-color: #2563eb;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 24px;
            font-weight: bold;
            color: #111827;
            margin: 0 0 20px;
        }
        .message-body {
            font-size: 16px;
            color: #4b5563;
            white-space: pre-wrap;
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
        @media only screen and (max-width: 600px) {
            .wrapper {
                padding: 0;
            }
            .container {
                width: 100% !important;
                border-radius: 0 !important;
                box-shadow: none !important;
            }
            .content {
                padding: 20px !important;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1 class="greeting">LESSA</h1>
            </div>
            <div class="content">
                <h1 class="greeting">Hola,</h1>
                <div class="message-body">
{{ $messageText }}
                </div>
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
    </div>
</body>
</html>
