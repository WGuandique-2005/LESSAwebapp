<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprender - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            min-height: 400px;
            display: flex;
            align-items: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("{{ asset('img/aprender.png') }}");
            background-size: cover;
            background-position: center;
            opacity: 0.1;
            mix-blend-mode: overlay;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 40px;
            width: 100%;
        }

        .hero-text {
            max-width: 800px;
        }

        .hero-text h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0 0 10px 0;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .hero-text h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--accent-color);
            margin: 0 0 20px 0;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .hero-text p {
            font-size: 1.1rem;
            opacity: 0.95;
            line-height: 1.8;
            margin: 0;
        }

        .hero-logo {
            width: 180px;
            height: auto;
            filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.2));
            transition: transform 0.3s ease;
        }

        .hero-logo:hover {
            transform: scale(1.05) rotate(-2deg);
        }

        /* Main Content */
        .learn-sections {
            padding: 80px 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .section-header h2 {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-main);
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }

        .section-header h2::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--accent-color);
            margin: 12px auto 0;
            border-radius: 2px;
        }

        .section-header p {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        /* Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 40px;
            padding: 10px;
        }

        .learn-card {
            background: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            cursor: pointer;
            border: 1px solid rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .learn-card:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow-hover);
        }

        .card-image-container {
            height: 240px;
            background: #f1f3f5;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-image-container::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.05) 100%);
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .learn-card:hover .card-image {
            transform: scale(1.08);
        }

        .card-content {
            padding: 32px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-content h3 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0 0 16px 0;
        }

        .card-content p {
            color: var(--text-light);
            font-size: 1rem;
            line-height: 1.6;
            margin: 0;
        }

        /* Feedback Messages */
        .feedback-message {
            max-width: 800px;
            margin: 20px auto;
            padding: 16px 24px;
            border-radius: 12px;
            font-weight: 500;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
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

        /* Responsive Design */
        @media (min-width: 992px) {
            .hero-content {
                flex-direction: row;
                text-align: left;
                justify-content: space-between;
            }

            .hero-text {
                flex: 1;
                order: 1;
                padding-right: 60px;
            }

            .hero-logo {
                order: 2;
                width: 220px;
            }

            .hero-text h2 {
                font-size: 3rem;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 0;
            }

            .hero-text h2 {
                font-size: 2rem;
            }

            .section-header h2 {
                font-size: 1.8rem;
            }

            .cards-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }
    </style>
</head>

<body>
    @if(session('status'))
        <div class="container">
            <p class="feedback-message success">
                {{ session('status') }}
            </p>
        </div>
    @endif
    @if(session('error'))
        <div class="container">
            <p class="feedback-message error">
                {{ session('error') }}
            </p>
        </div>
    @endif

    <header>@include('partials.navbar')</header>

    <main>
        <section class="hero-section">
            <!-- Background image handled by CSS ::before -->
            <div class="container hero-content">
                <div class="hero-text">
                    <h2>Sección de Aprendizaje</h2>
                    <h3>¡Comienza tu viaje con LESSA!</h3>
                    <p>Bienvenido a tu espacio de aprendizaje en la plataforma LESSA. Aquí encontrarás todos los
                        recursos organizados para que desarrolles tus habilidades en el Lenguaje de Señas Salvadoreño
                        paso a paso, a tu ritmo, y con herramientas dinámicas.</p>
                </div>
                <img src="{{ asset('img/logo2.png') }}" alt="LESSA Logo" class="hero-logo">
            </div>
        </section>

        <section class="learn-sections">
            <div class="container">
                <div class="section-header">
                    <h2>Descubre el Lenguaje de Señas Salvadoreño</h2>
                    <p>Desde principiante hasta avanzado: cursos organizados, herramientas interactivas y apoyo constante. ¡Rompe barreras y comunica con tus manos!</p>
                </div>

                <div class="cards-grid">
                    <!-- Diccionario Card -->
                    <div class="learn-card goToDicc">
                        <div class="card-image-container">
                            <img src="{{ asset('img/diccionario.png') }}" alt="Diccionario de señas" class="card-image">
                        </div>
                        <div class="card-content">
                            <h3>Diccionario LESSA</h3>
                            <p>Consulta nuestro diccionario con más de 350 palabras. Incluye GIFs, definiciones y contexto de uso para cada seña.</p>
                        </div>
                    </div>

                    <!-- Lecciones Card -->
                    <div class="learn-card goToLessons">
                        <div class="card-image-container">
                            <img src="{{ asset('img/lecciones.png') }}" alt="Lecciones interactivas" class="card-image">
                        </div>
                        <div class="card-content">
                            <h3>Lecciones Interactivas</h3>
                            <p>Módulos organizados por niveles. Teoría, práctica visual y contenido interactivo para asegurar tu aprendizaje.</p>
                        </div>
                    </div>

                    <!-- Videos Card -->
                    <div class="learn-card goToVideos">
                        <div class="card-image-container">
                            <img src="{{ asset('img/videos.png') }}" alt="Videos educativos" class="card-image">
                        </div>
                        <div class="card-content">
                            <h3>Videos Educativos</h3>
                            <p>Aprende visualmente con nuestra biblioteca de videos. Expertos te enseñan la correcta ejecución de las señas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>@include('partials.footer')</footer>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const goToLessons = document.querySelector('.goToLessons');
            if(goToLessons) {
                goToLessons.addEventListener('click', function(){
                    window.location.href = "{{ route('lecciones') }}"
                });
            }

            const goToDicc = document.querySelector('.goToDicc');
            if(goToDicc) {
                goToDicc.addEventListener('click', function(){
                    window.location.href = "{{ route('lecciones.diccionario') }}"
                });
            }

            const goToVideos = document.querySelector('.goToVideos');
            if(goToVideos) {
                goToVideos.addEventListener('click', function(){
                    window.location.href = "{{ route('lecciones.videos') }}"
                });
            }
        });
    </script>
</body>

</html>