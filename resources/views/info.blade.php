<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LESSA - Info</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --primary-blue: #0056b3;
            --primary-orange: #e65100;
            --light-gray: #f0f2f5;
            --medium-gray: #ced4da;
            --dark-gray: #212529;
            --text-color: #343a40;
            --white: #ffffff;
            --border-color: #dee2e6;
            --shadow-light: rgba(0, 0, 0, 0.05);
            --shadow-medium: rgba(0, 0, 0, 0.1);
            --text-secondary: #6c757d;
            --error-color: #dc3545;
            --success-color: #28a745;

            --spacing-xs: 0.5rem;
            --spacing-sm: 1rem;
            --spacing-md: 1.5rem;
            --spacing-lg: 2rem;
            --spacing-xl: 3rem;
            --spacing-xxl: 4rem;

            --font-family-primary: 'Poppins', sans-serif;
            --font-size-base: 1rem;
            --font-size-sm: 0.875rem;
            --font-size-md: 1.125rem;
            --font-size-lg: 1.5rem;
            --font-size-xl: 2.25rem;
            --font-size-xxl: 3rem;

            --border-radius: 12px;
            --transition-speed: 0.4s;
        }

        body {
            font-family: var(--font-family-primary);
            line-height: 1.7;
            color: var(--text-color);
            margin: 0;
            padding: 0;
            background-color: var(--light-gray);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .container {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 var(--spacing-md);
        }

        .hero-section {
            background-color: var(--primary-blue);
            padding: var(--spacing-xl) 0 var(--spacing-xxl);
            color: var(--white);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 450px;
            text-align: center;
        }

        .hero-bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.15;
            z-index: 0;
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 1;
            gap: var(--spacing-xl);
        }

        .hero-logo {
            max-width: 180px;
            margin-bottom: var(--spacing-md);
            filter: brightness(0) invert(1);
        }

        .hero-text {
            max-width: 700px;
            padding: var(--spacing-sm);
        }

        .hero-text h1 {
            font-size: var(--font-size-xxl);
            font-weight: 700;
            margin-bottom: var(--spacing-sm);
            line-height: 1.2;
        }

        .hero-text h3 {
            font-size: var(--font-size-lg);
            font-weight: 600;
            margin-bottom: var(--spacing-md);
            color: rgba(255, 255, 255, 0.9);
        }

        .hero-text p {
            font-size: var(--font-size-md);
            margin-bottom: var(--spacing-lg);
            color: rgba(255, 255, 255, 0.8);
        }

        .features-section {
            background-color: var(--white);
            padding: var(--spacing-lg);
            border-radius: var(--border-radius);
            box-shadow: 0 8px 20px var(--shadow-medium);
            text-align: center;
            position: relative;
            z-index: 2;
            margin-top: var(--spacing-xl);
            width: 100%;
            max-width: 380px;
        }

        .features-section h3 {
            font-size: var(--font-size-xl);
            color: var(--success-color);
            margin-bottom: var(--spacing-md);
            font-weight: 700;
        }

        .feature-item {
            padding: var(--spacing-sm);
        }

        .feature-item img {
            max-width: 200px;
            height: auto;
            margin-bottom: var(--spacing-sm);
            filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.1));
        }

        .feature-item p {
            font-size: var(--font-size-base);
            color: var(--dark-gray);
            font-weight: 500;
        }

        .info-section {
            display: flex;
            background-color: var(--white);
            margin-top: var(--spacing-xl);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 15px var(--shadow-light);
            overflow: hidden;
            flex-direction: column;
        }

        .info-left {
            position: relative;
            min-height: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            overflow: hidden;
        }

        .info-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3));
            z-index: 1;
        }

        .info-left-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            transition: transform var(--transition-speed) ease-in-out;
        }

        .info-left:hover .info-left-bg {
            transform: scale(1.05);
        }

        .info-logo-overlay {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: var(--spacing-sm);
        }

        .info-logo-overlay img {
            max-width: 160px;
            height: auto;
            filter: brightness(0) invert(1);
            margin-bottom: var(--spacing-sm);
        }

        .info-logo-overlay p {
            color: var(--white);
            font-size: var(--font-size-md);
            font-weight: 600;
            background-color: var(--primary-orange);
            padding: var(--spacing-xs) var(--spacing-md);
            border-radius: var(--border-radius);
            display: inline-block;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .info-right {
            padding: var(--spacing-xl);
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: var(--white);
        }

        .info-right h3 {
            font-size: var(--font-size-xl);
            color: var(--success-color);
            margin-bottom: var(--spacing-md);
            font-weight: 700;
            line-height: 1.3;
        }

        .info-right p {
            font-size: var(--font-size-base);
            color: var(--text-color);
            margin-bottom: var(--spacing-lg);
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: var(--spacing-md);
            gap: var(--spacing-md);
        }

        .info-item .icon {
            font-size: 36px;
            color: var(--primary-blue);
            min-width: 36px;
            text-align: center;
        }

        .info-item p {
            margin: 0;
            font-size: var(--font-size-base);
            color: var(--text-color);
        }

        .info-item p b {
            font-size: var(--font-size-md);
            color: var(--dark-gray);
        }

        .btn-info {
            margin-top: var(--spacing-lg);
            text-align: center;
            background-color: var(--primary-blue);
            padding: var(--spacing-sm) var(--spacing-lg);
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: background-color var(--transition-speed) ease, transform var(--transition-speed) ease;
            display: inline-block;
            align-self: flex-start;
        }

        .btn-info:hover {
            background-color: var(--primary-orange);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn-info a {
            color: var(--white);
            text-decoration: none;
            font-weight: 600;
            font-size: var(--font-size-lg);
            display: block;
        }

        footer {
            background-color: var(--dark-gray);
            color: var(--white);
            padding: var(--spacing-md) 0;
            text-align: center;
            margin-top: var(--spacing-xxl);
        }

        @media (min-width: 768px) {
            .hero-content {
                flex-direction: row;
                text-align: left;
                justify-content: space-between;
                align-items: flex-start;
                padding-bottom: var(--spacing-xxl);
            }

            .hero-text {
                max-width: 60%;
                margin-bottom: 0;
            }

            .features-section {
                margin-top: calc(var(--spacing-xxl) * -3);
                margin-left: 0;
                margin-right: 0;
                width: auto;
                max-width: 400px;
                align-self: flex-end;
            }

            .info-section {
                flex-direction: row;
                margin-top: var(--spacing-xxl);
            }

            .info-left, .info-right {
                flex: 1;
            }

            .info-left {
                min-height: 400px;
            }

            .info-section:nth-of-type(even) {
                flex-direction: row-reverse;
            }

        }

        @media (min-width: 992px) {
            .container {
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <header>@include('partials.navbar')</header>
    <main>
        <section class="hero-section">
            <img src="{{ asset('img/iglesia.png') }}" alt="Background image of San Salvador Monument"
                class="hero-bg-img">
            <div class="container hero-content">
                <div class="hero-text">
                    <img src="{{ asset('img/logo_sinfondo.png') }}" alt="LESSA Logo" class="hero-logo">
                    <h1 style="color: white;">Bienvenid@ a LESSA</h1>
                    <h3>¡Nos alegra tenerte aquí una vez más!</h3>
                    <p>Tu dedicación a aprender el Lenguaje de Señas Salvadoreño nos inspira. Desde esta sección puedes acceder rápidamente
                        a tus lecciones, ver tu progreso, desbloquear nuevos niveles y continuar tu camino hacia una comunicación más
                        inclusiva y significativa.</p>
                </div>
                <div class="features-section">
                    <h3>Recuerda</h3>
                    <div class="feature-item">
                        <img src="{{ asset('img/icon.png') }}" alt="Smartphone icon">
                        <p style="color:black;">¡Nunca es un mal monento para comenzar a aprender algo, tu puedes!</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="container info-section">
            <div class="info-left">
                <img src="{{ asset('img/centroHistorico.png') }}" alt="Person signing" class="info-left-bg">
                <div class="info-logo-overlay">
                    <img src="{{ asset('img/logo_sinfondo.png') }}" alt="ESSA Logo">
                    <p>Lenguaje de Señas Salvadoreño</p>
                </div>
            </div>
            <div class="info-right">
                <h3>¡Retos que desafiarán tus conocimientos!</h3>
                <p>La motivación es clave en cualquier proceso de aprendizaje. Por eso, hemos incorporado una sección dinámica con desafíos, pruebas rápidas, juegos visuales y recompensas (insignias, puntos, desbloqueos). Aquí podrás aplicar tus conocimientos de forma divertida y retadora.</p>
                <div class="info-item">
                    <i class="fas fa-play-circle icon"></i>
                    <div>
                        <p><b>Zona de Práctica</b></p>
                        <p>Diversidad de actividades</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-trophy icon"></i>
                    <div>
                        <p><b>Recompensas</b></p>
                        <p>Se recompensan tus esfuerzos</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-book-open icon"></i>
                    <div>
                        <p><b>Variedad de contenido</b></p>
                        <p>Diferente tipo de contenido de LESSA</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="container info-section">
            <div class="info-left">
                <img src="{{ asset('img/interactiveLessons.png') }}" alt="Person signing" class="info-left-bg">
                <div class="info-logo-overlay">
                    <img src="{{ asset('img/logo_sinfondo.png') }}" alt="ESSA Logo">
                </div>
            </div>
            <div class="info-right">
                <h3>Contamos con lecciones interactivas</h3>
                <p>Nuestro núcleo educativo está compuesto por lecciones organizadas por niveles de dificultad (Básico, Intermedio y Avanzado). Estas lecciones están diseñadas para adaptarse a tu ritmo de aprendizaje, brindándote explicaciones claras, retroalimentación inmediata y recursos complementarios.</p>
                <div class="info-item">
                    <i class="fas fa-play-circle icon"></i>
                    <div>
                        <p>Lecciones interactivas</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-trophy icon"></i>
                    <div>
                        <p>Registro de tu progreso</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-book-open icon"></i>
                    <div>
                        <p>Videos educativos</p>
                    </div>
                </div>
                <div class="btn-info">
                    <a href="#" class="btn btn-primary">Ver sección -></a>
                </div>
            </div>
        </section>
        <section class="container info-section">
            <div class="info-left">
                <img src="{{ asset('img/progress.png') }}" alt="Person signing" class="info-left-bg">
                <div class="info-logo-overlay">
                    <img src="{{ asset('img/logo_sinfondo.png') }}" alt="ESSA Logo">
                </div>
            </div>
            <div class="info-right">
                <h3>Sigue Aprendiendo</h3>
                <p>Accede a tu progreso aquí para seguir motivándote en tu aprendizaje de LESSA. Cada avance refleja tu esfuerzo y dedicación para construir una comunicación más inclusiva. Recuerda que cada palabra y cada señal que dominas te acerca más a un mundo sin barreras. ¡Sigue adelante y celebra cada logro en tu camino!</p>
                <div class="info-item">
                    <i class="fas fa-play-circle icon"></i>
                    <div>
                        <p><b>Tu tiempo</b></p>
                        <p>Podrás observar el tiempo que inviertes en tu proceso de aprendizaje</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-trophy icon"></i>
                    <div>
                        <p><b>Seguimiento de Progreso</b></p>
                        <p>Visualiza estadísticas detalladas</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-book-open icon"></i>
                    <div>
                        <p><b>Recompensas</b></p>
                        <p>Crea un ambiente positivo premiando el esfuerzo y los logros</p>
                    </div>
                </div>
                <div class="btn-info">
                    <a href="#" class="btn btn-primary">Ver sección -></a>
                </div>
            </div>
        </section>
    </main>
    <footer style="margin-top: 20px;">@include('partials.footer')</footer>
</body>
</html>