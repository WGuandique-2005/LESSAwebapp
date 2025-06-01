<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LESSA - Plataforma de Aprendizaje</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
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

            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --spacing-xxl: 3rem;

            --font-family-primary: 'Poppins', sans-serif;
            --font-size-base: 1rem;
            --font-size-sm: 0.875rem;
            --font-size-lg: 1.25rem;
            --font-size-xl: 2rem;
            --font-size-xxl: 2.5rem;

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
        }

        .hero-logo {
            max-width: 150px;
            margin-bottom: var(--spacing-lg);
            filter: brightness(0) invert(1);
            /* Para que el logo se vea blanco */
        }

        .hero-text {
            max-width: 800px;
        }

        .hero-text h1 {
            font-size: var(--font-size-xxl);
            font-weight: 700;
            margin-bottom: var(--spacing-md);
        }

        .hero-text h2 {
            font-size: var(--font-size-xl);
            font-weight: 600;
            margin-bottom: var(--spacing-md);
        }


        .hero-text p {
            font-size: var(--font-size-lg);
            margin-bottom: var(--spacing-xl);
        }

        .features-section {
            background-color: var(--white);
            padding: var(--spacing-lg) var(--spacing-xl);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 12px var(--shadow-light);
            text-align: center;
            position: relative;
            z-index: 2;
            margin-top: var(--spacing-xl);
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-section h2 {
            font-size: var(--font-size-xl);
            color: var(--dark-gray);
            margin-bottom: var(--spacing-lg);
        }

        .feature-item {
            text-align: center;
        }

        .feature-item img {
            max-width: 240px;
            height: auto;
            margin-bottom: var(--spacing-sm);
        }

        .feature-item p {
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
        }

        .practice-sections {
            padding: var(--spacing-xxl) 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: var(--spacing-xl);
        }

        .section-header h2 {
            font-size: var(--font-size-xl);
            color: var(--dark-gray);
            margin-bottom: var(--spacing-md);
        }

        .section-header p {
            color: var(--text-secondary);
            max-width: 700px;
            margin: 0 auto;
        }

        .practice-sections-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--spacing-lg);
        }

        .main-practice-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: var(--spacing-lg);
        }

        .practice-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 2px 8px var(--shadow-light);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
        }

        .practice-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px var(--shadow-medium);
        }

        .card-image-container {
            width: 100%;
            height: 180px;
            overflow: hidden;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--medium-gray);
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .card-lock-icon {
            position: absolute;
            top: var(--spacing-md);
            right: var(--spacing-md);
            background-color: rgba(0, 0, 0, 0.5);
            color: var(--white);
            border-radius: 50%;
            padding: var(--spacing-sm);
            font-size: var(--font-size-base);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
        }

        .card-content {
            padding: var(--spacing-md);
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-content h3 {
            font-size: var(--font-size-lg);
            color: var(--dark-gray);
            margin-bottom: var(--spacing-sm);
        }

        .card-content p {
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
            flex-grow: 1;
        }

        .progress-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 2px 8px var(--shadow-light);
            padding: var(--spacing-lg);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
            height: auto;
        }

        .progress-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px var(--shadow-medium);
        }

        .progress-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: var(--medium-gray);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: var(--font-size-lg);
            font-weight: 700;
            color: var(--primary-orange);
            position: relative;
            margin-bottom: var(--spacing-md);
            box-shadow: inset 0 0 0 5px var(--medium-gray); /* Border effect for progress */
        }

        .progress-circle::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(var(--primary-orange) 180deg, var(--medium-gray) 0deg);
            /* 50% progress */
            z-index: 0;
        }

        .progress-circle span {
            position: relative;
            z-index: 1;
            background-color: var(--white);
            padding: var(--spacing-sm);
            border-radius: 50%;
        }


        .progress-card h3 {
            font-size: var(--font-size-lg);
            color: var(--dark-gray);
            margin-bottom: var(--spacing-sm);
        }

        .progress-card p {
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
        }

        .tip-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 2px 8px var(--shadow-light);
            padding: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
            display: flex;
            align-items: flex-start;
            gap: var(--spacing-md);
        }

        .tip-icon {
            font-size: var(--font-size-lg);
            color: var(--primary-orange);
            min-width: 24px;
            text-align: center;
        }

        .tip-content {
            flex-grow: 1;
        }

        .tip-content h3 {
            font-size: var(--font-size-base);
            color: var(--dark-gray);
            margin-bottom: var(--spacing-sm);
        }

        .tip-content p {
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
        }

        .feedback-message {
            text-align: center;
            margin-bottom: 16px;
            padding: 10px;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 0.95em;
        }

        .feedback-message.success {
            color: var(--success-color);
            background-color: rgba(34, 197, 94, 0.1); /* Light green background */
            border: 1px solid var(--success-color);
        }

        .feedback-message.error {
            color: var(--error-color);
            background-color: rgba(239, 68, 68, 0.1); /* Light red background */
            border: 1px solid var(--error-color);
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.85em;
            margin-top: -10px; /* Pull error message closer to input */
            margin-bottom: 16px;
            display: block; /* Ensure it takes full width */
        }

        /* Responsive Layouts */
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
                /* Apply negative margin for overlap only on larger screens */
                margin-top: calc(var(--spacing-xxl) * -3);
                margin-left: 0;
                margin-right: 0;
                width: calc(40% - var(--spacing-xl));
                max-width: 400px;
                align-self: flex-end;
            }

            .practice-sections-layout {
                grid-template-columns: 1fr 2fr;
            }

            .main-practice-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 992px) {
            .main-practice-grid {
                grid-template-columns: repeat(2, 1fr); /* Ensure two columns even at larger sizes */
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>
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
    <main>
        <section class="hero-section">
            <img src="{{ asset('img/sansalvador.png') }}" alt="Background image of San Salvador Monument"
                class="hero-bg-img">
            <div class="container hero-content">
                <div class="hero-text">
                    <img src="{{ asset('img/logo_sinfondo.png') }}" alt="LESSA Logo" class="hero-logo">
                    <h1 style="color: white;">Bienvenido, {{ Auth::user()->name }}</h1>
                    <h3>Aquí es donde transformas todo tu conocimiento teórico en habilidades de comunicación.</h3>
                    <p>La sección de práctica de LESSA está diseñada para ayudarte a fortalecer tu confianza como
                        profesional. ¡No más dudas, adquiere confianza en el uso del Lenguaje de Señas Salvadoreño!</p>
                </div>
                <div class="features-section">
                    <h2>Recuerda</h2>
                    <div class="feature-item">
                        <img src="{{ asset('img/icon.png') }}" alt="Smartphone icon">
                        <p style="color:black;">¡La práctica constante y la paciencia son la clave para dominar con
                            fluidez y naturalidad!</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="practice-sections">
            <div class="container">
                <div class="section-header">
                    <h2>Secciones de Práctica</h2>
                    <p>A través de ejercicios graduales y organizados por niveles de dificultad, podrás practicar desde
                        las señas más básicas hasta construir frases completas. Cada sección ofrece una experiencia
                        interactiva, divertida y personalizada, adaptada a tu ritmo de aprendizaje.</p>
                </div>

                <div class="practice-sections-layout">
                    <div class="sidebar-practice">
                        <div class="tip-card">
                            <div class="tip-content">
                                <h3>Consejo</h3>
                                <p>¡Recuerda practicar frente a un espejo para observar tu posición corporal y gestos
                                    faciales! Esto te ayudará a asegurarte de que tu señas sean naturales. ¡La práctica
                                    constante es la mejor manera de mejorar tu fluidez y confianza!</p>
                            </div>
                        </div>
                        <div class="progress-card">
                            <div class="progress-circle">
                                <span>50%</span>
                            </div>
                            <h3>Abecedario</h3>
                            <p>Nivel III</p>
                            <p>¡Puedes avanzar al segundo nivel!</p>
                        </div>
                    </div>

                    <div class="main-practice-grid">
                        <div class="practice-card">
                            <div class="card-image-container">
                                <img src="{{ asset('img/letters.png') }}" alt="Abecedario" class="card-image">
                            </div>
                            <div class="card-content">
                                <h3>Abecedario</h3>
                                <p>Domínalo a la perfección; esta es una excelente forma de desarrollar coordinación
                                    motriz y familiarizarte con la estructura de LESSA.</p>
                            </div>
                        </div>
                        <div class="practice-card">
                            <div class="card-image-container">
                                <img src="{{ asset('img/phrases.png') }}" alt="Frases practice" class="card-image">
                            </div>
                            <div class="card-content">
                                <h3>Frases</h3>
                                <p>Explora estructuras poblacionales con temas, preguntas básicas, presentaciones y
                                    frases habituales.</p>
                            </div>
                        </div>

                        <div class="practice-card">
                            <div class="card-image-container">
                                <img src="{{ asset('img/usefulVocabulary.png') }}" alt="Vocabulario practice"
                                    class="card-image">
                            </div>
                            <div class="card-content">
                                <h3>Vocabulario Útil</h3>
                                <p>Descubre un amplio conjunto de palabras que son esenciales en múltiples contextos.
                                </p>
                            </div>
                        </div>

                        <div class="practice-card">
                            <div class="card-image-container">
                                <img src="{{ asset('img/commonTerms.png') }}" alt="Términos Comunes practice"
                                    class="card-image">
                            </div>
                            <div class="card-content">
                                <h3>Términos Comunes</h3>
                                <p>Sumérgete en un diccionario de fácil recuperación que te ayudará a comunicarte
                                    fácilmente.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>@include('partials.footer')</footer>
</body>

</html>