<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LESSA - Info</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --primary-color: #007bff;
            --primary-dark: #0056b3;
            --accent-color: #ff6b35;
            --bg-color: #f8f9fa;
            --text-main: #2c3e50;
            --text-light: #6c757d;
            --white: #ffffff;
            --border-radius: 16px;
            --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 15px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            padding: 80px 0;
            color: var(--white);
            position: relative;
            overflow: hidden;
            min-height: 450px;
            display: flex;
            align-items: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url("{{ asset('img/iglesia.png') }}");
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            mix-blend-mode: overlay;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
            width: 100%;
        }

        .hero-text {
            max-width: 700px;
            text-align: center;
        }

        .hero-text h1 {
            font-size: 3rem;
            font-weight: 800;
            margin: 0 0 16px 0;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .hero-text h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--accent-color);
            margin: 0 0 24px 0;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .hero-text p {
            font-size: 1.1rem;
            opacity: 0.95;
            line-height: 1.8;
            margin: 0;
        }

        /* Features Card in Hero */
        .hero-card {
            background: var(--white);
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-hover);
            max-width: 400px;
            width: 100%;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .hero-card h3 {
            color: var(--primary-color);
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-card img {
            width: 80px;
            height: auto;
            margin-bottom: 16px;
        }

        .hero-card p {
            color: var(--text-main);
            font-weight: 500;
            font-size: 1rem;
            margin: 0;
        }

        /* Info Sections */
        .info-section {
            display: flex;
            flex-direction: column;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            margin: 60px auto;
            transition: var(--transition);
        }

        .info-section:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-5px);
        }

        .info-image {
            position: relative;
            min-height: 300px;
            overflow: hidden;
        }

        .info-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
            position: absolute;
            top: 0; left: 0;
        }

        .info-section:hover .info-image img {
            transform: scale(1.05);
        }

        .info-image-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.6));
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .info-image-overlay img {
            position: relative;
            width: 140px;
            height: auto;
            filter: brightness(0) invert(1);
            margin-bottom: 16px;
            transform: none !important;
        }

        .info-content {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info-content h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0 0 16px 0;
            position: relative;
            padding-bottom: 16px;
        }

        .info-content h3::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 60px;
            height: 4px;
            background: var(--accent-color);
            border-radius: 2px;
        }

        .info-content > p {
            color: var(--text-light);
            font-size: 1.05rem;
            margin-bottom: 32px;
        }

        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(0, 123, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .feature-text h4 {
            margin: 0 0 4px 0;
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .feature-text p {
            margin: 0;
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .btn-action {
            display: inline-block;
            background: var(--primary-color);
            color: var(--white);
            padding: 12px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 32px;
            align-self: flex-start;
            transition: var(--transition);
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
        }

        .btn-action:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
        }

        /* Responsive */
        @media (min-width: 992px) {
            .hero-content {
                flex-direction: row;
                justify-content: space-between;
                text-align: left;
            }

            .hero-text {
                max-width: 55%;
                text-align: left;
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
                min-height: auto;
            }

            .info-content {
                flex: 1;
                padding: 60px;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 0;
            }

            .hero-text h1 {
                font-size: 2.2rem;
            }

            .info-content {
                padding: 30px;
            }

            .info-content h3 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <header>@include('partials.navbar')</header>
    
    <main>
        <section class="hero-section">
            <div class="container hero-content">
                <div class="hero-text">
                    <h1>Bienvenid@ a LESSA</h1>
                    <h3>¡Nos alegra tenerte aquí una vez más!</h3>
                    <p>Tu dedicación a aprender el Lenguaje de Señas Salvadoreño nos inspira. Desde esta sección puedes acceder rápidamente
                        a tus lecciones, ver tu progreso, desbloquear nuevos niveles y continuar tu camino hacia una comunicación más
                        inclusiva.</p>
                </div>
                <div class="hero-card">
                    <h3>Recuerda</h3>
                    <img src="{{ asset('img/icon.png') }}" alt="Smartphone icon">
                    <p>¡Nunca es un mal momento para comenzar a aprender algo, tú puedes!</p>
                </div>
            </div>
        </section>

        <div class="container">
            <!-- Section 1: Retos -->
            <section class="info-section">
                <div class="info-image">
                    <img src="{{ asset('img/centroHistorico.png') }}" alt="Centro Histórico">
                    <div class="info-image-overlay">
                        <img src="{{ asset('img/logo2.png') }}" alt="LESSA Logo">
                    </div>
                </div>
                <div class="info-content">
                    <h3>¡Retos que desafiarán tus conocimientos!</h3>
                    <p>La motivación es clave en cualquier proceso de aprendizaje. Por eso, hemos incorporado una sección dinámica con desafíos, pruebas rápidas y juegos visuales.</p>
                    
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
                    <h3>Contamos con lecciones interactivas</h3>
                    <p>Nuestro núcleo educativo está compuesto por lecciones organizadas por niveles de dificultad, diseñadas para adaptarse a tu propio ritmo.</p>
                    
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
                    
                    <a href="{{ route('lecciones') }}" class="btn-action">Ver Lecciones <i class="fas fa-arrow-right" style="margin-left: 8px;"></i></a>
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
                    <h3>Sigue Aprendiendo</h3>
                    <p>Accede a tu progreso para mantener la motivación. Cada avance refleja tu esfuerzo y dedicación para construir una comunicación más inclusiva.</p>
                    
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
                    
                    <a href="{{ route('miProgreso') }}" class="btn-action">Ver Mi Progreso <i class="fas fa-arrow-right" style="margin-left: 8px;"></i></a>
                </div>
            </section>
        </div>
    </main>

    <footer style="margin-top: 40px;">@include('partials.footer')</footer>
</body>
</html>