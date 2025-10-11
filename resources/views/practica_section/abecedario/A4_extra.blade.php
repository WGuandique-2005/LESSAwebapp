<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad Futura: Detección de Señas</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Colores Base */
            --primary-blue: #2a6fdb; /* Añadido para el botón */
            --light-gray: #f4f6f9;
            --medium-gray: #e9ecef;
            --text-color: #212529;
            --white: #ffffff;
            --secondary-yellow: #ffc107; /* Amarillo para destacar */
            --level-color-main: #dc3545; /* Rojo de emergencia */
            --dark-gray: #212529;

            /* Espaciado y Tipografía */
            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --font-family-primary: 'Poppins', sans-serif;
            --font-size-base: 1rem;
            --font-size-xl: 2.5rem;
            --font-size-lg: 1.35rem;
            --font-size-md: 1.125rem;
            --border-radius: 12px;
            --transition-speed: 0.3s;
        }

        body {
            font-family: var(--font-family-primary);
            line-height: 1.6;
            color: var(--text-color);
            margin: 0;
            padding: 0;
            background-color: var(--light-gray);
            /* Quitamos el centrado completo del body para que se comporte como una página web */
            /* display: flex; */
            /* justify-content: center; */
            /* align-items: center; */
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: var(--spacing-xl) var(--spacing-md);
            /* Ajuste de padding para no chocar con el header */
        }

        /* --- NUEVO HEADER PERSONALIZADO --- */
        .page-header {
            background-color: var(--white);
            border-bottom: 2px solid var(--medium-gray);
            padding: var(--spacing-md) 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            margin-bottom: var(--spacing-lg); /* Espacio debajo del header */
        }

        .header-content {
            max-width: 800px; /* Ancho consistente con el contenedor principal */
            margin: 0 auto;
            padding: 0 var(--spacing-md);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-content h1 {
            font-size: var(--font-size-lg);
            font-weight: 700;
            color: var(--level-color-main);
            margin: 0;
        }

        .back-button {
            background: none;
            border: none;
            color: var(--primary-blue);
            font-size: var(--font-size-md);
            font-weight: 600;
            cursor: pointer;
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--border-radius);
            transition: background-color var(--transition-speed);
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
        }

        .back-button:hover {
            background-color: var(--medium-gray);
        }
        /* --- FIN NUEVO HEADER PERSONALIZADO --- */


        /* Contenedor Principal de Anuncio */
        .future-activity-announcement {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            text-align: center;
            overflow: hidden;
            border-top: 10px solid var(--level-color-main);
            margin-bottom: var(--spacing-xl); /* Espacio para el footer */
        }

        /* Encabezado Rojo */
        .announcement-header {
            background-color: var(--level-color-main);
            color: var(--white);
            padding: var(--spacing-lg) var(--spacing-xl);
        }

        .announcement-header h3 {
            font-size: var(--font-size-xl);
            font-weight: 800;
            margin: 0;
            color: var(--secondary-yellow); /* Texto amarillo para contraste */
            text-transform: uppercase;
        }

        .announcement-header p {
            font-size: var(--font-size-lg);
            margin: var(--spacing-md) 0 0;
            font-weight: 600;
        }

        /* Cuerpo del Anuncio */
        .announcement-body {
            padding: var(--spacing-xl);
        }

        .announcement-body h3 {
            font-size: var(--font-size-lg);
            color: var(--dark-gray);
            margin-bottom: var(--spacing-md);
            font-weight: 700;
        }

        /* Caja de Proposición de Cámara */
        .camera-proposition {
            background-color: var(--level-color-main);
            color: var(--white);
            padding: var(--spacing-lg);
            border-radius: var(--border-radius);
            margin-top: var(--spacing-lg);
            font-size: var(--font-size-md);
            border: 2px solid var(--secondary-yellow);
        }

        .camera-proposition strong {
            color: var(--secondary-yellow);
            font-weight: 800;
            display: block;
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>
    <div>
        @include('partials.navbar')
    </div>
    
    <div class="container">
        <div class="future-activity-announcement">
            <div class="announcement-header">
                <h3>¡PRÓXIMAMENTE! 🛠️</h3>
                <p>Nueva Actividad de Práctica de Dactilología</p>
            </div>
            <div class="announcement-body">
                <h3>Este espacio está reservado para una actividad de práctica avanzada.</h3>
                <p>Estamos trabajando para integrar herramientas de última generación que llevarán tu aprendizaje de la Lengua de Señas Salvadoreña (LESSA) al siguiente nivel.</p>
                
                <div class="camera-proposition">
                    <strong>PROPUESTA DE ACTIVIDAD FUTURA:</strong>
                    <p>Se propone el uso de la cámara de tu dispositivo (webcam o móvil) para detectar la forma de tu mano y analizar la seña de dactilología que estás realizando. Esto permitirá una corrección en tiempo real y práctica interactiva.</p>
                    <p>¡Prepárate para practicar con las manos! ✋</p>
                </div>
                
                <p style="margin-top: var(--spacing-lg);">Vuelve pronto para probar esta emocionante característica que mejorará tu precisión y velocidad.</p>
            </div>
        </div>
    </div>
    
    <footer>@include('partials.footer')</footer>
</body>
</html>