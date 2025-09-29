<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practicar - LESSA</title>
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
            font-size: var(--font-size-xl);
            font-weight: 700;
            margin-bottom: var(--spacing-md);
            color: var(--white);
        }

        .hero-text h3 {
            font-size: var(--font-size-md);
            font-weight: 600;
            margin-bottom: var(--spacing-md);
            color: var(--white);
        }

        .hero-text p {
            font-size: var(--font-size-sm);
            margin-bottom: var(--spacing-xl);
            color: var(--white);
        }

        .learn-sections {
            padding: var(--spacing-xl) 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: var(--spacing-xl);
        }

        .section-header h2 {
            font-size: var(--font-size-xl);
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
            padding-bottom: var(--spacing-md);
        }

        .main-learn-grid {
            display: grid;
            grid-template-columns: 1fr;
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

        .progress-container {
            text-align: center;
            margin: var(--spacing-lg) 0;
        }

        /* Progress Bar */
        .progress-container {
            margin-top: 30px;
            background-color: #070776ff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .progress-container p {
            margin-top: 0;
            margin-bottom: 10px;
            font-weight: bold;
            color: #ffffffff;
        }

        .progress-bar-outer {
            background-color: #ccc;
            border-radius: 5px;
            height: 15px;
            overflow: hidden;
        }

        .progress-bar-inner {
            background-color: #e6a717ff;
            height: 100%;
            border-radius: 5px;
            width: 0%;
            transition: width 0.5s ease-in-out;
        }

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

            .hero-text h3 {
                font-size: var(--font-size-xxl);
            }

            .main-learn-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 992px) {
            .main-learn-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 991px) {
            .main-learn-grid {
                display: flex;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                scroll-snap-type: x mandatory;
                gap: var(--spacing-lg);
                padding: var(--spacing-xs);
            }

            .main-learn-grid::-webkit-scrollbar {
                display: none;
            }

            .learn-card {
                flex-shrink: 0;
                width: calc(85vw - (2 * var(--spacing-md)));
                scroll-snap-align: start;
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
                <img src="{{ asset('img/logo2.png') }}" alt="LESSA Logo" class="hero-logo">
                <div class="hero-text">
                    <h2>Sección de Práctica</h2>
                    <h3>¡Pon a prueba lo que has aprendido en LESSA!</h3>
                    <p>Bienvenido a tu espacio de práctica activa. Aquí consolidarás tus habilidades en el Lenguaje de
                        Señas Salvadoreño con ejercicios, evaluaciones y herramientas interactivas diseñadas para
                        reforzar tu memoria visual y fluidez. ¡Prepárate para llevar tu conocimiento al siguiente nivel!
                    </p>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="progress-container">
                <p>Progreso de Aprendizaje</p>
                <div class="progress-bar-outer">
                    <div class="progress-bar-inner" style="width: 20%;"></div>
                </div>
            </div>
            <section class="learn-sections">
                <div class="section-header">
                    <h2>Lecciones de LESSA</h2>
                    <p>Selecciona una lección para practicar y reforzar tus conocimientos en el Lenguaje de Señas Salvadoreño.</p>
                </div>
                <div class="learn-sections-layout">
                    <div class="main-learn-grid">
                        <div class="learn-card goToLevelAbecedario" style="cursor: pointer;">
                            <div class="card-image-container">
                                <img src="{{ asset('img/abcd.png') }}" alt="Abecedario" class="card-image">
                            </div>
                            <div class="card-content">
                                <h3>Abecedario</h3>
                                <p>Aprenderás las letras del abecedario para poder por ejemplo deletrar tu nombre, siglas u otros usos que descubrirás.</p>
                            </div>
                        </div>
                        <div class="learn-card goToLevelNumeros" style="cursor: pointer;">
                            <div class="card-image-container">
                                <img src="{{ asset('img/numbers.png') }}" alt="Números" class="card-image">
                            </div>
                            <div class="card-content">
                                <h3>Números</h3>
                                <p>Aprenderás los números del 1 al 100, cantidades más grandes, así como a contar objetos y a hacer preguntas simples sobre cantidades.</p>
                            </div>
                        </div>
                        <div class="learn-card goToLevelSaludos" style="cursor: pointer;">
                            <div class="card-image-container">
                                <img src="{{ asset('img/saludos.png') }}" alt="Saludos y Presentaciones" class="card-image">
                            </div>
                            <div class="card-content">
                                <h3>Saludos y Presentaciones</h3>
                                <p>Aprenderás a comunicar saludos como "Hola", "Buenos días", "Buenas noches", "¿Cómo estás?", así como frases para presentarte como "Mi nombre es..." o "Mucho gusto".</p>
                            </div>
                        </div>
                        <div class="learn-card goToLevelSalud" style="cursor: pointer;">
                            <div class="card-image-container">
                                <img src="{{ asset('img/health.png') }}" alt="Salud y Emergencias" class="card-image">
                            </div>
                            <div class="card-content">
                                <h3>Salud y Emergencias</h3>
                                <p>Aprenderás a señalar síntomas básicos ("me duele", "fiebre", "cansado"), a expresar si tienes alguna alergia y reconocer lugares de atención médica ("hospital", "clínica").</p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer>@include('partials.footer')</footer>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Corrige los selectores agregando el punto (.) para seleccionar por clase
            const goToLevelAbecedario = document.querySelector('.goToLevelAbecedario');
            if(goToLevelAbecedario){
                goToLevelAbecedario.addEventListener('click', function() {
                    window.location.href = "{{ route('nivel.abecedario') }}";
                });
            }

            const goToLevelNumeros = document.querySelector('.goToLevelNumeros');
            if(goToLevelNumeros){
                goToLevelNumeros.addEventListener('click', function() {
                    window.location.href = "{{ route('nivel.numeros') }}";
                });
            }

            const goToLevelSaludos = document.querySelector('.goToLevelSaludos');
            if(goToLevelSaludos){
                goToLevelSaludos.addEventListener('click', function() {
                    window.location.href = "{{ route('nivel.saludos') }}";
                });
            }

            const goToLevelSalud = document.querySelector('.goToLevelSalud');
            if(goToLevelSalud){
                goToLevelSalud.addEventListener('click', function() {
                    window.location.href = "{{ route('nivel.salud') }}";
                });
            }

            // Animación de barra de progreso (solo para demo)
            const progressBar = document.querySelector('.progress-bar-inner');
            setTimeout(() => {
                progressBar.style.width = '0%';
            }, 200);
        });
    </script>
</body>

</html>