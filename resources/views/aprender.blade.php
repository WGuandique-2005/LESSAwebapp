<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprender - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* --- VARIABLES (Existing Colors + New Structure) --- */
        :root {
            --primary-color: #007bff;
            --primary-dark: #0056b3;
            --accent-color: #ff6b35;
            --accent-hover: #e85d2a;
            --bg-body: #f8f9fa;
            --bg-card: #ffffff;
            --text-main: #2c3e50;
            --text-light: #6c757d;
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
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

        .hero-bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.1;
            mix-blend-mode: overlay;
            pointer-events: none;
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
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--accent-color);
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .hero-desc {
            font-size: 1.1rem;
            opacity: 0.95;
            margin-bottom: 2rem;
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

        /* --- SECTION HEADER --- */
        .section-header {
            text-align: center;
            margin-bottom: 3rem;
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

        .section-desc {
            color: var(--text-light);
            font-size: 1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* --- CARDS GRID --- */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .learn-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition-base);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            height: 100%;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .learn-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(0, 123, 255, 0.2);
        }

        .card-img-wrapper {
            height: 200px;
            background: #f1f5f9;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .learn-card:hover .card-img {
            transform: scale(1.05);
        }

        .card-content {
            padding: 2rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.75rem;
        }

        .card-text {
            color: var(--text-light);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .card-footer {
            display: flex;
            align-items: center;
            color: var(--accent-color);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .card-footer i {
            margin-left: 0.5rem;
            transition: transform 0.2s;
        }

        .learn-card:hover .card-footer i {
            transform: translateX(4px);
        }

        /* --- FEEDBACK MESSAGES --- */
        .feedback-message {
            max-width: 800px;
            margin: 1rem auto;
            padding: 1rem 1.5rem;
            border-radius: var(--radius-lg);
            font-weight: 500;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: var(--shadow-sm);
        }

        .feedback-message.success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .feedback-message.error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0 5rem;
            }

            .hero-title {
                font-size: 2rem;
            }

            .main-container {
                margin-top: -3rem;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>

    @if(session('status'))
        <div class="container" style="padding: 0 1.5rem;">
            <div class="feedback-message success">
                <i class="fas fa-check-circle"></i> {{ session('status') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="container" style="padding: 0 1.5rem;">
            <div class="feedback-message error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        </div>
    @endif

    <section class="hero-section">
        <div class="hero-bg-img" style="background-image: url('{{ asset('img/aprender.png') }}');"></div>
        <div class="hero-content">
            <h1 class="hero-title">Sección de Aprendizaje</h1>
            <h2 class="hero-subtitle">¡Comienza tu viaje con LESSA!</h2>
            <p class="hero-desc">
                Bienvenido a tu espacio de aprendizaje. Aquí encontrarás todos los recursos organizados para que desarrolles tus habilidades en el Lenguaje de Señas Salvadoreño paso a paso.
            </p>
        </div>
    </section>

    <main class="main-container">
        <br>
        <br>
        <div class="section-header">
            <h3 class="section-title">Descubre el Lenguaje de Señas</h3>
            <p class="section-desc">Desde principiante hasta avanzado: cursos organizados, herramientas interactivas y apoyo constante.</p>
        </div>

        <div class="cards-grid">
            <!-- Diccionario Card -->
            <div class="learn-card" onclick="window.location.href='{{ route('lecciones.diccionario') }}'">
                <div class="card-img-wrapper">
                    <img src="{{ asset('img/diccionario.png') }}" alt="Diccionario" class="card-img">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Diccionario LESSA</h3>
                    <p class="card-text">Consulta nuestro diccionario con más de 350 palabras. Incluye GIFs, definiciones y contexto de uso para cada seña.</p>
                    <div class="card-footer">
                        Explorar Diccionario <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>

            <!-- Lecciones Card -->
            <div class="learn-card" onclick="window.location.href='{{ route('lecciones') }}'">
                <div class="card-img-wrapper">
                    <img src="{{ asset('img/lecciones.png') }}" alt="Lecciones" class="card-img">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Lecciones Interactivas</h3>
                    <p class="card-text">Módulos organizados por niveles. Teoría, práctica visual y contenido interactivo para asegurar tu aprendizaje.</p>
                    <div class="card-footer">
                        Ir a Lecciones <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>

            <!-- Videos Card -->
            <div class="learn-card" onclick="window.location.href='{{ route('lecciones.videos') }}'">
                <div class="card-img-wrapper">
                    <img src="{{ asset('img/videos.png') }}" alt="Videos" class="card-img">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Videos Educativos</h3>
                    <p class="card-text">Aprende visualmente con nuestra biblioteca de videos. Expertos te enseñan la correcta ejecución de las señas.</p>
                    <div class="card-footer">
                        Ver Videos <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>@include('partials.footer')</footer>
</body>

</html>