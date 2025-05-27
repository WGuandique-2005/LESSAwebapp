<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Perfil</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Open Sans", sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f3f3f3;
        }

        nav {
            width: 100%;
            height: 75px;
            line-height: 75px;
            padding: 0 100px;
            position: fixed;
            top: 0;
            background: #4a90e2;
            z-index: 999;
        }

        nav ul {
            float: right;
        }

        nav li {
            display: inline-block;
            list-style: none;
        }

        nav li a {
            font-size: 14px;
            text-transform: uppercase;
            padding: 0 30px;
            color: white;
            text-decoration: none;
        }

        .contenido {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px 40px 40px 40px;
            gap: 40px;
            flex-wrap: wrap;
        }

        .editar_Datos {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .editFoto {
            width: 700px;
            height: 350px;
            background-color: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .editFoto img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .descripcion {
            width: 700px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            height: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .descripcion label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        .descripcion input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .datos {
            width: 400px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            height: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        input::placeholder {
            color: #aaa;
        }

        .btn {
            font-size: 12px;
        }

        .btn button {
            font-size: 12px;
            padding: 10px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: #fff;
            margin-right: 5px;
        }


        .btn_borrar {
            background-color: #d9534f;
        }

        .btn_borrar:hover {
            background-color: #c9302c;
        }

        .btn_cerrar {
            background-color: #5bc0de;
        }

        .btn_cerrar:hover {
            background-color: #31b0d5;
        }

        footer {
            background: #4a90e2;
            color: #fff;
            text-align: center;
            padding: 30px 20px;
        }

        .footer-content p {
            margin: 0;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <nav>@include('partials.navbar')</nav>
    <div class="contenido">
        <div class="editar_Datos">
            <div class="editFoto">
                <img src="{{ asset('img/farolitos.png') }}" alt="Foto de perfil">
            </div>

            <div class="descripcion">
                <label for="descripcion">Descripción</label>
                <input type="text" id="descripcion" placeholder="Agrega una" />
            </div>
        </div>


        <div class="datos">
            <div class="form-container">
                <form>
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" placeholder="Escribe tu nombre (maximo 2 caracteres)">


                    <label for="correo">Correo</label>
                    <input type="email" id="correo" placeholder="Escribe tu correo">


                    <label for="contrasena">Contraseña</label>
                    <input type="password" id="contrasena" placeholder="Ingresa tu contraseña">

                    <div class="btn">
                        <button type="button" class="btn_borrar">Borrar</button>
                        <button type="button" class="btn_cerrar">Cerrar sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        @include('partials.footer')
    </footer>
</body>

</html>