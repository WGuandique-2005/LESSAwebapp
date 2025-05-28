<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Recuperar contraseña</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url({{ asset('img/login.png') }}) no-repeat center center/cover;
            position: relative;
        }

        .container {
            width: 70%;
            max-width: 500px;
            background: #16424774;
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            color: #fff;
        }

        .logo {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 160px;
            height: 160px;
            background: url({{ asset('img/logo_sinfondo.png') }}) center/contain no-repeat;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            color: white;
        }

        h2 {
            font-size: 16px;
            margin-bottom: 5px;
            color: white;
        }

        .input-group {
            width: 100%;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            outline: none;
        }

        input::placeholder {
            color: #ddd;
        }

        .login-btn,
        .google-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .login-btn {
            background-color: #4285f4;
            color: white;
        }

        .login-btn:hover {
            background-color: #3367d6;
        }

        .google-btn {
            background-color: white;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .google-btn:hover {
            background-color: #f0f0f0;
        }

        .google-icon {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .links {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
        }

        .links a {
            color: #fff;
            text-decoration: underline;
        }

        .back-button {
            position: absolute;
            top: 30px;
            left: 30px;
            color: white;
            background-color: #F4A261;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #ffffff;
            color: #F4A261;
        }

        @media screen and (max-width: 768px) {
            .container {
                padding: 30px 20px;
                margin-top: 80px;
            }

            .logo {
                width: 60px;
                height: 60px;
                top: 20px;
                right: 20px;
            }
        }

        @media screen and (max-width: 480px) {
            h1 {
                font-size: 24px;
            }

            input,
            .login-btn,
            .google-btn {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    
    <div class="logo"></div>
<form action="{{ route('login.submit') }}" method="POST" class="container">
    @csrf
    <h1>Recuperar contraseña</h1>

    <div class="input-group">
        <h2>Correo</h2>
        <input type="email" name="email" placeholder="Correo" required />
    </div>

    <button type="submit" class="login-btn">Solicitar nueva contraseña</button>

    <a class="google-btn" href="{{ route('auth.google') }}">
        Volver a inicio de sesión
    </a>
</form>
</body>

</html>