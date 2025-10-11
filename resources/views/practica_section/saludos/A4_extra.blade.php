<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad Futura: Detección de Señas</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            /* Colores Base */
            --primary-blue: #2a6fdb;
            --secondary-green: #2ecc71; /* Nuevo color de éxito */
            --light-gray: #f4f6f9;
            --medium-gray: #e9ecef;
            --text-color: #212529;
            --white: #ffffff;
            --secondary-yellow: #ffc107;
            --level-color-main: #dc3545; /* Rojo (para contraste fuerte) */
            --dark-gray: #212529;

            /* Espaciado y Tipografía */
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --font-family-primary: 'Poppins', sans-serif;
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
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: var(--spacing-xl) var(--spacing-md);
            /* Asegura padding lateral en móvil */
            box-sizing: border-box; 
        }

        
        /* --- Contenedor Principal de Anuncio (Tarjeta) --- */
        .future-activity-announcement {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* Sombra más profunda */
            text-align: center;
            overflow: hidden;
            border: 1px solid var(--medium-gray); /* Borde suave */
        }

        /* Sección superior con Icono y Titulo */
        .announcement-header {
            background: linear-gradient(135deg, var(--level-color-main) 0%, #a0222f 100%); /* Degradado Rojo */
            color: var(--white);
            padding: var(--spacing-xl) var(--spacing-xl);
            position: relative;
        }
        
        .announcement-header .icon-container {
            font-size: 4rem;
            color: var(--secondary-yellow);
            margin-bottom: var(--spacing-md);
            animation: pulse 2s infinite; /* Animación de pulsación */
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .announcement-header h3 {
            font-size: 2.2rem; /* Ligeramente más pequeño para mejor responsividad */
            font-weight: 800;
            margin: 0;
            color: var(--secondary-yellow);
            text-transform: uppercase;
        }

        .announcement-header p {
            font-size: var(--font-size-lg);
            margin: var(--spacing-sm) 0 0;
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

        /* Caja de Proposición de Cámara (Destacado) */
        .camera-proposition {
            background-color: var(--light-gray); /* Fondo gris claro */
            color: var(--dark-gray);
            padding: var(--spacing-lg);
            border-radius: var(--border-radius);
            margin-top: var(--spacing-lg);
            font-size: var(--font-size-md);
            border: 1px solid var(--medium-gray);
            text-align: left; /* Texto alineado a la izquierda para mejor lectura */
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .camera-proposition strong {
            color: var(--primary-blue); /* Resaltar en azul */
            font-weight: 800;
            display: block;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        
        /* Botón de Guardado (Simulación de completado) */
        .complete-button {
            display: block;
            width: 90%; /* Más ancho */
            margin: var(--spacing-xl) auto var(--spacing-md) auto;
            padding: 15px 20px;
            font-size: var(--font-size-lg);
            font-weight: 700;
            color: var(--white);
            background-color: var(--secondary-green); /* ¡Cambio a Verde! */
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all var(--transition-speed);
            box-shadow: 0 4px 0 #248f58; /* Sombra 3D Verde Oscuro */
            text-transform: uppercase;
        }

        .complete-button:hover {
            background-color: #248f58;
            transform: translateY(-2px);
            box-shadow: 0 6px 0 #1b6b41;
        }
        
        .complete-button:active {
            transform: translateY(2px);
            box-shadow: 0 2px 0 #1b6b41;
        }

        /* --- MEDIA QUERIES (Responsividad) --- */
        @media (max-width: 650px) {
            .header-content {
                /* Permite que el título ocupe más espacio */
                flex-direction: column;
                gap: 10px;
            }
            .header-content h1 {
                font-size: 1.25rem;
            }
            .back-button {
                /* Alinea el botón a la izquierda en móvil */
                align-self: flex-start; 
                padding: var(--spacing-sm);
            }
            .announcement-header h3 {
                font-size: 1.8rem;
            }
            .announcement-header .icon-container {
                font-size: 3rem;
            }
            .announcement-body {
                padding: var(--spacing-lg);
            }
            .complete-button {
                width: 100%;
                font-size: var(--font-size-md);
                padding: 12px 15px;
            }
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
                <div class="icon-container">
                    <i class="fas fa-screwdriver-wrench"></i>
                </div>
                <h3>¡PRÓXIMAMENTE!</h3>
                <p>Práctica Avanzada: Detección de Señas</p>
            </div>
            
            <div class="announcement-body">
                <h3>Este espacio está reservado para una actividad de práctica avanzada.</h3>
                <p>Mientras tanto, puedes marcar esta actividad como completada para ganar los puntos. Esto simula que has superado el desafío y te permite avanzar en tu progreso.</p>
                
                <form id="complete-form" action="{{ route('lecciones.saludos.extra.complete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="errors_count" value="0"> 
                    <button type="submit" class="complete-button">
                        <i class="fas fa-medal"></i> Marcar como Completado y Ganar Puntos
                    </button>
                </form>
                
                <p style="margin-top: var(--spacing-lg);">Vuelve pronto para probar esta emocionante característica que mejorará tu precisión y velocidad.</p>

                <div class="camera-proposition">
                    <strong>¡DETALLES DE LA PROPUESTA FUTURA!</strong>
                    <p>Se utilizará la cámara de tu dispositivo (webcam o móvil) para detectar la forma de tu mano y analizar la seña de dactilología que estás realizando. Esto permitirá una corrección en tiempo real y práctica interactiva.</p>
                    <p style="margin-top: 10px; text-align: center;">¡Prepárate para practicar con las manos! ✋</p>
                </div>
            </div>
        </div>
    </div>
    
    <footer>@include('partials.footer')</footer>
</body>
</html>