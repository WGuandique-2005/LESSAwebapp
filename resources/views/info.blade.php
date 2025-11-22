<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LESSA - Información</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* --- 1. VARIABLES Y ESTILOS BASE (Coincide con home.blade.php) --- */
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
            --shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
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
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
        }

        .hero-bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.15;
            mix-blend-mode: overlay;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
            text-align: center;
        }

        .hero-text {
            max-width: 800px;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--accent-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .hero-desc {
            font-size: 1.1rem;
            opacity: 0.9;
            font-weight: 300;
            line-height: 1.6;
        }

        .hero-card {
            background: var(--bg-card);
            color: var(--text-main);
            padding: 2rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            max-width: 400px;
            width: 100%;
            text-align: center;
            margin-top: 1rem;
        }

        .hero-card h3 {
            color: var(--primary-color);
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .hero-card img {
            width: 64px;
            height: auto;
            margin-bottom: 1rem;
        }

        .hero-card p {
            font-weight: 500;
            font-size: 1rem;
            color: var(--text-secondary);
        }

        /* --- MAIN CONTAINER --- */
        .main-container {
            width: 100%;
            max-width: 1200px;
            margin: -4rem auto 0;
            padding: 0 1.5rem 4rem;
            position: relative;
            z-index: 10;
        }

        /* --- INFO SECTIONS --- */
        .info-section {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            margin-bottom: 3rem;
            display: flex;
            flex-direction: column;
            transition: var(--transition-base);
        }

        .info-section:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .info-image {
            position: relative;
            height: 300px;
            overflow: hidden;
        }

        .info-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .info-section:hover .info-image img {
            transform: scale(1.05);
        }

        .info-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.6));
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-image-overlay img {
            width: 120px;
            height: auto;
            filter: brightness(0) invert(1);
            opacity: 0.9;
            transform: none !important;
        }

        .info-content {
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .info-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--accent-color);
            border-radius: 2px;
        }

        .info-desc {
            color: var(--text-secondary);
            font-size: 1.05rem;
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .feature-text h4 {
            margin: 0 0 0.25rem 0;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .feature-text p {
            margin: 0;
            font-size: 0.95rem;
            color: var(--text-secondary);
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--primary-color);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: var(--radius-full);
            text-decoration: none;
            font-weight: 600;
            margin-top: 2rem;
            align-self: flex-start;
            transition: var(--transition-base);
            box-shadow: var(--shadow-sm);
        }

        .btn-action:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* --- RESPONSIVE --- */
        @media (min-width: 992px) {
            .hero-content {
                flex-direction: row;
                justify-content: space-between;
                text-align: left;
                align-items: center;
            }

            .hero-text {
                max-width: 55%;
            }

            .info-section {
                flex-direction: row;
                min-height: 450px;
            }

            .info-section:nth-of-type(even) {
                flex-direction: row-reverse;
            }

            .info-image {
                flex: 1;
                height: auto;
            }

            .info-content {
                flex: 1;
                padding: 3rem 4rem;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0 5rem;
            }

            .hero-title {
                font-size: 2rem;
            }

            .info-content {
                padding: 2rem;
            }

            .info-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>

    <section class="hero-section">
        <img src="{{ asset('img/iglesia.png') }}" alt="Background" class="hero-bg-img">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title">Bienvenid@ a LESSA</h1>
                    <h3 class="hero-subtitle">¡Nos alegra tenerte aquí una vez más!</h3>
                    <p class="hero-desc">
                        Tu dedicación a aprender el Lenguaje de Señas Salvadoreño nos inspira.
                        Accede rápidamente a tus lecciones, ver tu progreso y continúa tu camino hacia una comunicación más inclusiva.
                    </p>
                </div>
                <div class="hero-card">
                    <h3>Recuerda</h3>
                    <img src="{{ asset('img/icon.png') }}" alt="Smartphone icon">
                    <p>¡Nunca es un mal momento para comenzar a aprender algo, tú puedes!</p>
                </div>
            </div>
        </div>
    </section>

    <main class="main-container">
        <!-- Section 1: Retos -->
        <section class="info-section">
            <div class="info-image">
                <img src="{{ asset('img/centroHistorico.png') }}" alt="Centro Histórico">
                <div class="info-image-overlay">
                    <img src="{{ asset('img/logo2.png') }}" alt="LESSA Logo">
                </div>
            </div>
            <div class="info-content">
                <h3 class="info-title">¡Retos que desafiarán tus conocimientos!</h3>
                <p class="info-desc">La motivación es clave en cualquier proceso de aprendizaje. Por eso, hemos incorporado una sección dinámica con desafíos, pruebas rápidas y juegos visuales.</p>

                <div class="feature-list">
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-play-circle"></i></div>
                        <div class="feature-text">
                            <h4>Zona de Práctica</h4>
                            <p>Diversidad de actividades para reforzar tu aprendizaje.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-trophy"></i></div>
                        <div class="feature-text">
                            <h4>Recompensas</h4>
                            <p>Se reconocen y celebran tus esfuerzos.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-book-open"></i></div>
                        <div class="feature-text">
                            <h4>Variedad de contenido</h4>
                            <p>Diferentes tipos de recursos educativos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2: Lecciones Interactivas -->
        <section class="info-section">
            <div class="info-image">
                <img src="{{ asset('img/interactiveLessons.png') }}" alt="Lecciones Interactivas">
                <div class="info-image-overlay">
                    <img src="{{ asset('img/logo2.png') }}" alt="LESSA Logo">
                </div>
            </div>
            <div class="info-content">
                <h3 class="info-title">Contamos con lecciones interactivas</h3>
                <p class="info-desc">Nuestro núcleo educativo está compuesto por lecciones organizadas por niveles de dificultad, diseñadas para adaptarse a tu propio ritmo.</p>

                <div class="feature-list">
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-play-circle"></i></div>
                        <div class="feature-text">
                            <h4>Lecciones dinámicas</h4>
                            <p>Aprende haciendo con ejercicios prácticos.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-trophy"></i></div>
                        <div class="feature-text">
                            <h4>Registro de progreso</h4>
                            <p>Mantén un seguimiento de tus avances.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-video"></i></div>
                        <div class="feature-text">
                            <h4>Videos educativos</h4>
                            <p>Material audiovisual de apoyo.</p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('lecciones') }}" class="btn-action">
                    Ver Lecciones <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </section>

        <!-- Section 3: Progreso -->
        <section class="info-section">
            <div class="info-image">
                <img src="{{ asset('img/progress.png') }}" alt="Progreso">
                <div class="info-image-overlay">
                    <img src="{{ asset('img/logo2.png') }}" alt="LESSA Logo">
                </div>
            </div>
            <div class="info-content">
                <h3 class="info-title">Sigue Aprendiendo</h3>
                <p class="info-desc">Accede a tu progreso para mantener la motivación. Cada avance refleja tu esfuerzo y dedicación para construir una comunicación más inclusiva.</p>

                <div class="feature-list">
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-clock"></i></div>
                        <div class="feature-text">
                            <h4>Tu tiempo</h4>
                            <p>Observa el tiempo invertido en tu aprendizaje.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                        <div class="feature-text">
                            <h4>Estadísticas detalladas</h4>
                            <p>Visualiza tu crecimiento paso a paso.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-star"></i></div>
                        <div class="feature-text">
                            <h4>Logros</h4>
                            <p>Premiamos tu constancia y dedicación.</p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('miProgreso') }}" class="btn-action">
                    Ver Mi Progreso <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </section>
    </main>

    <footer>@include('partials.footer')</footer>
</body>

</html>