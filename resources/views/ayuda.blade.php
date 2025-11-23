<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuda y FAQ - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* --- VARIABLES (Consistent with Home) --- */
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #eff6ff;
            --accent-color: #f97316;
            --accent-hover: #ea580c;
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
            max-width: 900px;
            margin: -4rem auto 0;
            padding: 0 1.5rem 4rem;
            position: relative;
            z-index: 10;
        }

        /* --- FAQ SECTION --- */
        .faq-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .faq-item {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: var(--transition-base);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .faq-item:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .faq-header {
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            background: var(--bg-card);
            font-weight: 600;
            color: var(--text-main);
            transition: background 0.3s ease;
        }

        .faq-header:hover {
            background: var(--primary-light);
            color: var(--primary-color);
        }

        .faq-header i {
            color: var(--accent-color);
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-header i {
            transform: rotate(180deg);
        }

        .faq-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            background: #ffffff;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        .faq-content-inner {
            padding: 1.5rem;
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.7;
        }

        /* --- MANUAL SECTION --- */
        .manual-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 3rem 2rem;
            text-align: center;
            margin-top: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .manual-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1rem;
        }

        .manual-desc {
            color: var(--text-secondary);
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .manual-placeholder {
            background: var(--bg-body);
            border: 2px dashed #d1d5db;
            border-radius: var(--radius-lg);
            padding: 2rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
            font-style: italic;
        }

        .btn-manual {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--accent-color);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: var(--radius-full);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition-base);
            box-shadow: var(--shadow-sm);
        }

        .btn-manual:hover {
            background-color: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* --- SECTION HEADER --- */
        .section-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            display: inline-block;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--accent-color);
            margin: 0.5rem auto 0;
            border-radius: var(--radius-full);
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0 5rem;
            }

            .hero-title {
                font-size: 2rem;
            }
            
            .faq-header {
                padding: 1rem;
                font-size: 0.95rem;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>

    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Centro de Ayuda</h1>
            <p class="hero-subtitle">Encuentra respuestas a las preguntas más frecuentes y aprende a usar la plataforma.</p>
        </div>
    </section>

    <main class="main-container">
        <br>
        <br>
        <div class="section-header">
            <h2 class="section-title">Preguntas Frecuentes (FAQ)</h2>
        </div>

        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-header">
                    <span>¿Cómo se estructura el aprendizaje en LESSA?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-content">
                    <div class="faq-content-inner">
                        El aprendizaje se organiza en niveles temáticos (ej. Abecedario, Números, Saludos). Cada nivel contiene múltiples lecciones y mini-juegos de práctica que debes completar para avanzar y ganar puntos de experiencia (XP).
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>¿Cuál es la diferencia entre una Lección y un Nivel?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-content">
                    <div class="faq-content-inner">
                        Un Nivel es una unidad temática grande (ej. Abecedario) que agrupa un conjunto de habilidades. Una Lección es un subtema o módulo específico dentro de un nivel, enfocado en un grupo reducido de señas o conceptos, culminando generalmente en un mini-juego.
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>¿Cómo gano Puntos de Experiencia (XP) en LESSA?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-content">
                    <div class="faq-content-inner">
                        Ganas XP al completar mini-juegos, responder correctamente en las evaluaciones de los niveles y mantener una racha de práctica diaria. Los puntos reflejan tu esfuerzo y dedicación en la plataforma.
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>¿Qué recompensas obtengo al acumular puntos?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-content">
                    <div class="faq-content-inner">
                        Los puntos desbloquean insignias de logro (badges) y trofeos y te dan a recompensas exclusivas. ¡Motívate a coleccionarlas todas!
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>¿Cuál fue la inspiración detrás de la aplicación LESSA?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-content">
                    <div class="faq-content-inner">
                        LESSA nació de la profunda necesidad de promover la inclusión y facilitar el aprendizaje del Lenguaje de Señas Salvadoreño (LESSA). Nuestro objetivo es reducir la brecha comunicativa, apoyar a la comunidad sorda en El Salvador y honrar su rica cultura lingüística.
                    </div>
                </div>
            </div>
        </div>

        <div class="manual-card">
            <h2 class="manual-title">Manual de Usuario</h2>
            <p class="manual-desc">Esta sección está destinada a ofrecer una guía detallada paso a paso de todas las funciones de LESSA.</p>

            <a href="{{ route('manual') }}" class="btn-manual">
                <i class="fas fa-book-reader"></i> Ver Manual de Usuario
            </a>
        </div>

    </main>

    <footer>@include('partials.footer')</footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const faqHeaders = document.querySelectorAll('.faq-header');

            faqHeaders.forEach(header => {
                header.addEventListener('click', () => {
                    const item = header.parentElement;
                    const content = item.querySelector('.faq-content');
                    const isActive = item.classList.contains('active');

                    // Close all other items
                    document.querySelectorAll('.faq-item').forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('active');
                            otherItem.querySelector('.faq-content').style.maxHeight = null;
                        }
                    });

                    // Toggle current item
                    if (isActive) {
                        item.classList.remove('active');
                        content.style.maxHeight = null;
                    } else {
                        item.classList.add('active');
                        content.style.maxHeight = content.scrollHeight + "px";
                    }
                });
            });
        });
    </script>
</body>

</html>