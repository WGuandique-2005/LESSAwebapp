<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página no encontrada</title>
    <style>
        /* Definición de variables CSS para manejo de temas y colores */
        :root {
            --color-primary: #2b6cb0;
            --color-primary-hover: #2c5282;
            --color-text-dark: #1a202c;
            --color-text-medium: #4a5568;
            --color-background-light: #f7fafc;
            --color-card-background: #fff;
        }

        body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background: var(--color-background-light);
            color: var(--color-text-dark);
            text-align: center;
        }

        .card {
            max-width: 90%;
            width: 400px;
            padding: 40px;
            border-radius: 12px;
            background: var(--color-card-background);
            box-shadow: 0 10px 25px rgba(11, 17, 34, 0.1);
        }

        /* Estilos para el logo */
        .logo {
            margin-bottom: 24px; /* Espacio debajo del logo */
            max-width: 150px; /* Tamaño máximo para el logo */
            height: auto; /* Mantener la proporción */
            display: block; /* Para que el margin-bottom funcione correctamente */
            margin-left: auto; /* Centrar el logo */
            margin-right: auto; /* Centrar el logo */
        }

        h1 {
            font-size: 80px;
            margin: 0 0 12px;
            color: var(--color-primary);
            font-weight: 800;
            line-height: 1;
        }

        h2 {
            font-size: 24px;
            margin: 0 0 8px;
            color: var(--color-text-dark);
        }

        p {
            margin: 0 0 24px;
            color: var(--color-text-medium);
            font-size: 16px;
        }
        
        a.home-link {
            display: inline-block;
            padding: 12px 24px;
            background: var(--color-primary);
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        a.home-link:hover {
            background: var(--color-primary-hover);
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 60px;
            }
            .card {
                padding: 30px 20px;
            }
            .logo {
                max-width: 120px; /* Ajustar el tamaño del logo para móviles */
            }
        }
    </style>
</head>
<body>
    <div class="card" role="main" aria-labelledby="error-title">
        <img src="{{ asset('img/logo2.png') }}" alt="Logo de la Web" class="logo">

        <h1 id="error-title">404</h1>
        <h2>Página no encontrada</h2>
        <p>Lo sentimos — la dirección web que has solicitado no existe o ha sido movida.</p>
        <p>Por favor, revisa la URL o haz clic abajo para volver al inicio.</p>
        
        <a href="{{ url('/') }}" class="home-link">Volver al inicio</a>
    </div>
</body>
</html>