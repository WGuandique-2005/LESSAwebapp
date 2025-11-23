<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual de Usuario - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* --- VARIABLES (Consistent with Home & Ayuda) --- */
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #eff6ff;
            --accent-color: #f97316;
            --accent-hover: #ea580c;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --text-main: #1f2937;
            --text-secondary: #6b7280;
            --bg-body: #f3f4f6;
            --bg-card: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --radius-lg: 1rem;
            --radius-xl: 1.5rem;
            --radius-full: 9999px;
            --transition-base: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- HERO SECTION --- */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: #ffffff;
            padding: 4rem 0 6rem;
            position: relative;
            border-radius: 0 0 var(--radius-xl) var(--radius-xl);
            overflow: hidden;
            text-align: center;
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.125rem;
            opacity: 0.9;
            font-weight: 300;
        }

        /* --- MAIN CONTAINER --- */
        .main-container {
            width: 100%;
            max-width: 1100px;
            margin: -4rem auto 0;
            padding: 0 1.5rem 4rem;
            position: relative;
            z-index: 10;
        }

        /* --- SECTIONS GRID --- */
        .manual-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .manual-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: var(--transition-base);
        }

        .manual-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .card-header {
            padding: 1.5rem 2rem;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            gap: 1rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            flex-shrink: 0;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .card-body {
            padding: 2rem;
            color: var(--text-secondary);
        }

        .card-body p {
            margin-bottom: 1rem;
        }

        .card-body ul {
            list-style: none;
            margin-top: 1rem;
        }

        .card-body li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .card-body li::before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            left: 0;
            color: var(--success-color);
            font-size: 0.9rem;
            top: 4px;
        }

        /* --- SPECIFIC COLORS --- */
        .bg-blue { background-color: var(--primary-color); }
        .bg-orange { background-color: var(--accent-color); }
        .bg-green { background-color: var(--success-color); }
        .bg-purple { background-color: #8b5cf6; }
        .bg-red { background-color: var(--danger-color); }
        .bg-teal { background-color: #14b8a6; }

        /* --- RESPONSIVE --- */
        @media (min-width: 768px) {
            .manual-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .full-width {
                grid-column: span 2;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0 5rem;
            }
            .hero-title {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>

    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Manual de Usuario</h1>
            <p class="hero-subtitle">Descubre todo lo que puedes hacer en LESSA y sácale el máximo provecho a tu aprendizaje.</p>
        </div>
    </section>

    <main class="main-container">
        <div class="manual-grid">
            
            <!-- 0. Registro y Acceso -->
            <div class="manual-card full-width">
                <div class="card-header">
                    <div class="card-icon" style="background-color: #4f46e5;">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h2 class="card-title">Registro y Acceso</h2>
                </div>
                <div class="card-body">
                    <p>Para acceder a todo el contenido educativo y las herramientas de práctica de LESSA, es necesario crear una cuenta. Ofrecemos opciones de registro rápidas y seguras:</p>
                    <ul>
                        <li><strong>Registro con Google:</strong> Accede con un solo clic vinculando tu cuenta de Google.</li>
                        <li><strong>Registro con Correo:</strong> Crea una cuenta utilizando tu dirección de correo electrónico y una contraseña segura.</li>
                    </ul>
                </div>
            </div>

            <!-- 1. Sección de Aprendizaje -->
            <div class="manual-card full-width">
                <div class="card-header">
                    <div class="card-icon bg-blue">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h2 class="card-title">Sección de Aprendizaje</h2>
                </div>
                <div class="card-body">
                    <p>Esta es la base de tu educación en LESSA. Aquí encontrarás todo el material didáctico necesario para dominar el lenguaje de señas. Se encuentra en la navbar y aparece como "Aprender".</p>
                    <ul>
                        <li><strong>Lecciones:</strong> Módulos estructurados por niveles (Abecedario, Números, Saludos, Salud) donde aprenderás paso a paso, se muestra contenido didáctico, explicación y ejemplos, y contextualización de las señas.</li>
                        <li><strong>Diccionario LESSA:</strong> Una herramienta de consulta rápida para buscar señas específicas y su significado, tambien contiene audio y explicaciones detalladas de como realizarlas.</li>
                        <li><strong>Videos Educativos:</strong> Material audiovisual de apoyo para reforzar la correcta ejecución de las señas, contenido disponible gracias al canal de YouTube de LESSA virtual.</li>
                    </ul>
                </div>
            </div>

            <!-- 2. Sección de Práctica -->
            <div class="manual-card">
                <div class="card-header">
                    <div class="card-icon bg-orange">
                        <i class="fas fa-gamepad"></i>
                    </div>
                    <h2 class="card-title">Sección de Práctica</h2>
                </div>
                <div class="card-body">
                    <p>¡Aprender jugando es mejor! En esta sección pondrás a prueba tus conocimientos mediante divertidos minijuegos. Se encuentra en la navbar y aparece como "Practicar".</p>
                    <ul>
                        <li>Juegos temáticos basados en las lecciones aprendidas (abecedario, números, saludos, salud).</li>
                        <li>Desafíos de memoria, asociación y rapidez, tambien contamos una sección para la ejecución de las señas con camara y detección inteligente.</li>
                        <li>Al completar estos juegos, ganarás puntos y podras desbloquear insignias y trofeos.</li>
                    </ul>
                </div>
            </div>

            <!-- 3. Recompensas y Puntos -->
            <div class="manual-card">
                <div class="card-header">
                    <div class="card-icon bg-purple">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h2 class="card-title">Sistema de Recompensas</h2>
                </div>
                <div class="card-body">
                    <p>Tu esfuerzo tiene recompensa. A medida que completas lecciones y minijuegos en la Zona de Práctica, acumularás puntos.</p>
                    <ul>
                        <li>Desbloquea insignias y trofeos especiales.</li>
                        <li>Sube de nivel en el ranking global de usuarios.</li>
                        <li>Compite sanamente con otros usuarios por el primer lugar.</li>
                        <li>Puedes desbloquear trofeos temáticos (abecedario, números, saludos, salud).</li>
                    </ul>
                </div>
            </div>

            <!-- 4. Mi Progreso -->
            <div class="manual-card">
                <div class="card-header">
                    <div class="card-icon bg-green">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h2 class="card-title">Mi Progreso</h2>
                </div>
                <div class="card-body">
                    <p>Mantén el control de tu avance. En esta sección podrás visualizar estadísticas detalladas de tu aprendizaje. Puedes encontrarla en la navbar y aparece como "Mi Progreso".</p>
                    <ul>
                        <li>Porcentaje global de completitud del curso.</li>
                        <li>Desglose de progreso por cada nivel (Abecedario, Números, etc.).</li>
                        <li>Identifica qué áreas necesitas reforzar.</li>
                        <li>Ver tus insignias y trofeos desbloqueados.</li>
                        <li>Ver tus puntos acumulados y actividades restantes.</li>
                    </ul>
                </div>
            </div>

            <!-- 5. Ranking -->
            <div class="manual-card">
                <div class="card-header">
                    <div class="card-icon bg-teal">
                        <i class="fas fa-list-ol"></i>
                    </div>
                    <h2 class="card-title">Ranking</h2>
                </div>
                <div class="card-body">
                    <p>¡Mídete con la comunidad! El ranking muestra a los usuarios más destacados basado en la suma total de sus puntos. Puedes encontrarla en la navbar y aparece como "Ranking".</p>
                    <ul>
                        <li>Se actualiza con los puntos obtenidos en los minijuegos.</li>
                        <li>Motívate viendo tu posición escalar hacia la cima.</li>
                        <li>Ver tus insignias y trofeos desbloqueados, tambien de los otros usuarios.</li>
                        <li>Se muestran los 10 usuarios con más puntos.</li>
                    </ul>
                </div>
            </div>

            <!-- 6. Perfil de Usuario -->
            <div class="manual-card">
                <div class="card-header">
                    <div class="card-icon bg-red">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    <h2 class="card-title">Tu Perfil</h2>
                </div>
                <div class="card-body">
                    <p>Gestiona tu cuenta y datos personales con total libertad. Puedes encontrarla en la navbar y aparece como el avatar en la esquina superior derecha.</p>
                    <ul>
                        <li>Edita tu información personal como contraseña, nombre y nombre de usuario.</li>
                        <li>Consulta tus datos de incorporación a la plataforma.</li>
                        <li>Opciones de seguridad y, si lo deseas, eliminación de cuenta.</li>
                    </ul>
                </div>
            </div>

            <!-- 7. Preguntas Frecuentes -->
            <div class="manual-card">
                <div class="card-header">
                    <div class="card-icon" style="background-color: #db2777;">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <h2 class="card-title">Preguntas Frecuentes</h2>
                </div>
                <div class="card-body">
                    <p>¿Tienes dudas sobre el funcionamiento de LESSA? Consulta nuestra sección de preguntas frecuentes para resolverlas rápidamente. Puedes encontrarla en la navbar y aparece como el avatar con ? en la esquina superior derecha.</p>
                    <ul>
                        <li>Encuentra respuestas a dudas comunes sobre lecciones y niveles.</li>
                        <li>Entiende mejor el sistema de puntos y recompensas.</li>
                        <li><a href="{{ route('ayuda') }}" style="color: var(--primary-color); font-weight: 600;">Ir a Preguntas Frecuentes <i class="fas fa-arrow-right" style="font-size: 0.8em;"></i></a></li>
                    </ul>
                </div>
            </div>

            <!-- 7. Información de la Web -->
            <div class="manual-card full-width">
                <div class="card-header">
                    <div class="card-icon" style="background-color: #64748b;">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h2 class="card-title">Sobre LESSA</h2>
                </div>
                <div class="card-body">
                    <p>En la sección de <strong>Información</strong> encontrarás todo acerca de nuestra misión, visión y el equipo detrás de esta plataforma. Nuestro propósito es facilitar la inclusión y el aprendizaje del Lenguaje de Señas Salvadoreño para todos.</p>
                </div>
            </div>

            <!-- 8. Soporte y Contacto -->
            <div class="manual-card full-width">
                <div class="card-header">
                    <div class="card-icon" style="background-color: #0ea5e9;">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h2 class="card-title">Soporte y Contacto</h2>
                </div>
                <div class="card-body">
                    <p>¿Tienes algún problema con tu cuenta o alguna duda sobre la plataforma? Estamos aquí para ayudarte.</p>
                    <p>Puedes contactarnos directamente al siguiente correo electrónico:</p>
                    <p style="font-weight: 600; color: var(--primary-color); font-size: 1.1rem; margin: 0.5rem 0;">
                        <i class="fas fa-envelope"></i> wguandique2006@gmail.com
                    </p>
                    <p>Nos comprometemos a responder a todas tus inquietudes de la manera más rápida posible para garantizar tu mejor experiencia en LESSA.</p>
                </div>
            </div>

        </div>
        
        <div style="text-align: center; margin-top: 3rem;">
            <a href="{{ route('ayuda') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; color: var(--text-secondary); font-weight: 500; transition: color 0.3s;">
                <i class="fas fa-arrow-left"></i> Volver a Ayuda
            </a>
        </div>

    </main>

    <footer>@include('partials.footer')</footer>
</body>

</html>
