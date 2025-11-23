<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 5px;
            max-width: 600px;
            margin: 0 auto;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hola,</h2>
        <p style="white-space: pre-wrap;">{{ $messageText }}</p>
        
        <div class="footer">
            <p>Atentamente,<br>El equipo de LESSA</p>
        </div>
    </div>
</body>
</html>
