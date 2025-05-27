<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ventana</title>
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
        }

        #btn-modal {
            display: none;
        }

        .container-modal {
            width: 100%;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: rgba(203, 206, 207, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 100;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.3s ease;
        }

        #btn-modal:checked~.container-modal {
            visibility: visible;
            opacity: 1;
        }

        .content-modal {
            width: 600px;
            height: 500px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .boton-modal {
            padding: 40px;
            background-color: #fff;
        }

        .boton-modal label {
            padding: 10px 15px;
            background-color: rgb(0, 30, 255);
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            transition: all 300ms ease;
        }

        .boton-modal label:hover {
            background-color: #5bc0de;
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

        .cambiar_Foto {
            width: 160px;
            height: 100px;
            border-radius: 8px;
            overflow: hidden;
            position: top: relative;
            background-color: white;
        }

        .cambiar_Foto img {
            width: 100%;
            height: 100%;
            object-fit: cover;

        }
    </style>
</head>

<body>
    <div class="boton-modal">
        <label for="btn-modal">
            Abrir ventana
        </label>
    </div>

    <input type="checkbox" id="btn-modal">
    <div class="container-modal">
        <div class="content-modal">
            <h2>Edita tu perfil</h2>
            <br>
            <p>Realiza los cambios necesarios</p>
            <br>
            <div class="cambiar_Foto">
                <img src="{{ asset('img/salvadorMundo.png') }}" alt="Foto de perfil">
            </div>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" placeholder="------" />

            <label for="correo">Correo</label>
            <input type="email" id="correo" placeholder="---------" />

            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" value="------" readonly />
            <label for="correo">Descripción</label>
            <input type="text" id="descripcion" placeholder="---------" />
            <div class="btn-cerrar">
                <button type="button" class="btn_guardar">Guardar</button>
                <button type="button" class="btn_cancelar">Cancelar</button>
            </div>
        </div>

    </div>
</body>

</html>