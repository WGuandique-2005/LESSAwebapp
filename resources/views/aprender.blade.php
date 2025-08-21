<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprender - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #007bff;
            --primary-orange: #ff6b35;
            --light-gray: #f8f9fa;
            --medium-gray: #e9ecef;
            --dark-gray: #343a40;
            --text-color: #212529;
            --white: #ffffff;
            --border-color: #dee2e6;
            --shadow-light: rgba(0, 0, 0, 0.08);
            --shadow-medium: rgba(0, 0, 0, 0.15);
            --text-secondary: #6c757d;
            --error-color: #EF4444;
            --success-color: #22C55E;

            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --spacing-xxl: 3rem;

            --font-family-primary: 'Poppins', sans-serif;
            --font-size-base: 1rem;
            --font-size-sm: 0.875rem;
            --font-size-md: 1.125rem;
            --font-size-lg: 1.25rem;
            --font-size-xl: 2rem;
            --font-size-xxl: 2.5rem;
            --font-size-xxxl: 3rem;

            --border-radius: 10px;
            --transition-speed: 0.3s;
        }

        body {
            font-family: var(--font-family-primary);
            line-height: 1.6;
            color: var(--text-color);
            margin: 0;
            padding: 0;
            background-color: var(--light-gray);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .container {
            max-width: 1080px;
            margin: 0 auto;
            padding: 0 var(--spacing-md);
        }

        .hero-section {
            background-color: var(--primary-blue);
            padding: var(--spacing-xl) 0;
            color: var(--white);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            min-height: 400px;
        }

        .hero-bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.2;
            z-index: 0;
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 1;
            width: 100%;
        }

        .hero-logo {
            max-width: 180px;
            margin-bottom: var(--spacing-lg);
            filter: brightness(0) invert(1);
        }

        .hero-text {
            max-width: 900px;
        }

        .hero-text h2 {
            font-size: var(--font-size-xxl);
            font-weight: 700;
            margin-bottom: var(--spacing-md);
            color: var(--white);
        }

        .hero-text h2 {
            font-size: var(--font-size-xl);
            font-weight: 600;
            margin-bottom: var(--spacing-md);
            color: var(--white);
        }

        .hero-text p {
            font-size: var(--font-size-lg);
            margin-bottom: var(--spacing-xl);
            color: var(--white);
        }

        .learn-sections {
            padding: var(--spacing-xxl) 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: var(--spacing-xl);
        }

        .section-header h2 {
            font-size: var(--font-size-xxl);
            color: var(--dark-gray);
            margin-bottom: var(--spacing-md);
            font-weight: 700;
        }

        .section-header p {
            color: var(--text-secondary);
            max-width: 700px;
            margin: 0 auto;
            font-size: var(--font-size-md);
        }

        .learn-sections-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--spacing-lg);
        }

        .main-learn-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: var(--spacing-lg);
        }

        .learn-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 12px var(--shadow-light);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
        }

        .learn-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px var(--shadow-medium);
        }

        .card-image-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--medium-gray);
            border-bottom: 1px solid var(--border-color);
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .card-content {
            padding: var(--spacing-lg);
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-content h3 {
            font-size: var(--font-size-lg);
            color: var(--primary-blue);
            margin-bottom: var(--spacing-sm);
            font-weight: 600;
        }

        .card-content p {
            font-size: var(--font-size-base);
            color: var(--text-secondary);
            flex-grow: 1;
        }

        .feedback-message {
            text-align: center;
            margin: var(--spacing-md) auto;
            padding: var(--spacing-md);
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: var(--font-size-base);
            max-width: 600px;
        }

        .feedback-message.success {
            color: var(--success-color);
            background-color: rgba(34, 197, 94, 0.1);
            border: 1px solid var(--success-color);
        }

        .feedback-message.error {
            color: var(--error-color);
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid var(--error-color);
        }

        /* Responsive Layouts */
        @media (min-width: 768px) {
            .hero-content {
                flex-direction: row;
                text-align: left;
                justify-content: space-between;
                align-items: center;
                padding-bottom: var(--spacing-xxl);
            }

            .hero-logo {
                margin-right: var(--spacing-xl);
                margin-bottom: 0;
            }

            .hero-text {
                max-width: 65%;
            }

            .hero-text h2 {
                font-size: var(--font-size-xxxl);
            }

            .hero-text h2 {
                font-size: var(--font-size-xxl);
            }

            .learn-sections-layout {
                grid-template-columns: 1fr;
            }

            .main-learn-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 992px) {
            .main-learn-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (min-width: 1200px) {
            .container {
                padding: 0;
            }
        }
    </style>
</head>

<body>
    @if(session('status'))
        <p class="feedback-message success">
            {{ session('status') }}
        </p>
    @endif
    @if(session('error'))
        <p class="feedback-message error">
            {{ session('error') }}
        </p>
    @endif
    <header>@include('partials.navbar')</header>
    <main>
        <section class="hero-section">
            <img src="{{ asset('img/aprender.png') }}" alt="Background image of San Salvador Monument"
                class="hero-bg-img">
            <div class="container hero-content">
                <img src="{{ asset('img/logo_sinfondo.png') }}" alt="LESSA Logo" class="hero-logo">
                <div class="hero-text">
                    <h2>Sección de Aprendizaje</h2>
                    <h3>¡Comienza tu viaje con LESSA!</h3>
                    <p>Bienvenido a tu espacio de aprendizaje en la plataforma LESSA. Aquí encontrarás todos los
                        recursos organizados para que desarrolles tus habilidades en el Lenguaje de Señas Salvadoreño
                        paso a paso, a tu ritmo, y con herramientas dinámicas que te acompañarán en cada lección.
                        Ya sea que seas principiante, intermedio o avanzado, esta sección ha sido diseñada pensando en
                        ti.</p>
                </div>
            </div>
        </section>
        <section class="learn-sections">
            <div class="container">
                <div class="section-header">
                    <h2>Descubre el Lenguaje de Señas Salvadoreño</h2>
                    <p>Desde principiante hasta avanzado: cursos organizados, herramientas interactivas y apoyo constante para tu aprendizaje en LESSA. Rompe barreras, comunica con tus manos. ¡Bienvenido a tu viaje en el Lenguaje de Señas Salvadoreño!</p>
                </div>

                <div class="learn-sections-layout">
                    <div class="main-learn-grid">
                        <div class="learn-card">
                            <div class="card-image-container">
                                <img src="{{ asset('img/diccionario.png') }}" alt="Ilustración de un diccionario de señas" class="card-image">
                            </div>
                            <div class="card-content">
                                <h3 class="cursor: pointer;">Diccionario LESSA</h3>
                                <p>Consulta nuestro diccionario de señas con más de 350 palabras, categorizadas
                                    alfabéticamente y por temas. Cada entrada incluye: GIF/imagen de la seña,
                                    definición, contexto de uso y sinónimos.</p>
                            </div>
                        </div>
                        <div class="learn-card">
                            <div class="card-image-container">
                                <img src="{{ asset('img/lecciones.png') }}" alt="Ilustración de lecciones organizadas" class="card-image">
                            </div>
                            <div class="card-content goToLessons" >
                                <h3>Lecciones Interactivas</h3>
                                <p>Accede a módulos organizados por niveles de dificultad. Cada lección contiene una
                                    mezcla de teoría, práctica visual y contenido interactivo para asegurar que
                                    comprendes cada seña y su contexto de uso.</p>
                            </div>
                        </div>
                        <div class="learn-card goToVideos" style="cursos:pointer;">
                            <div class="card-image-container">
                                <img src="{{ asset('img/videos.png') }}" alt="Ilustración de videos educativos" class="card-image">
                            </div>
                            <div class="card-content">
                                <h3>Videos Educativos</h3>
                                <p>Aprende visualmente con nuestra biblioteca de videos cortos, donde expertos y
                                    usuarios reales te enseñan la correcta ejecución de las señas.
                                    Incluyen subtítulos y opción de ralentizar la reproducción para facilitar la
                                    práctica.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        addEventListener('DOMContentLoaded', function(){
            const goToLessons = document.querySelector('.goToLessons');
            goToLessons.addEventListener('click', function(){
                window,location.href = "{{  route('lecciones') }}"
            })

            const goToVideos = document.querySelector('.goToVideos')
            goToVideos.addEventListener('click', function(){
                window.location.href = "{{ route('lecciones.videos') }}"
            })
        })
    </script>
    <footer>@include('partials.footer')</footer>
</body>

</html>