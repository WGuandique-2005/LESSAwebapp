<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practicar - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Variables y Estilos Base */
        :root {
            --primary-blue: #007bff; /* Principal: Azul */
            --primary-orange: #ff6b35; /* Acento: Naranja */
            --light-gray: #f4f6f9; /* Fondo muy claro */
            --medium-gray: #e9ecef;
            --dark-gray: #2c3e50; /* Texto principal oscuro */
            --text-color: #34495e;
            --white: #ffffff;
            --border-color: #dcdcdc;
            --shadow-light: rgba(0, 0, 0, 0.05);
            --shadow-medium: rgba(0, 0, 0, 0.12);
            --text-secondary: #7f8c8d;
            --error-color: #EF4444;
            --success-color: #22C55E;

            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2.5rem; /* Más grande para secciones */
            --spacing-xxl: 4rem;

            --font-family-primary: 'Poppins', sans-serif;
            --font-size-base: 1rem;
            --font-size-sm: 0.875rem;
            --font-size-md: 1rem;
            --font-size-lg: 1.15rem;
            --font-size-xl: 2.2rem;
            --font-size-xxl: 3rem;

            --border-radius-sm: 8px;
            --border-radius-lg: 16px;
            --transition-speed: 0.3s;
        }

        /* RESET / BASE */
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
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 var(--spacing-md);
        }
        
        /* HERO SECTION (UX/UI MEJORADA - CORRECCIÓN DE VISIBILIDAD) */
        .hero-section {
            /* Mantenemos el degradado de color principal */
            background: linear-gradient(135deg, var(--primary-blue) 0%, #0056b3 100%);
            padding: var(--spacing-xxl) 0;
            color: var(--white);
            position: relative;
            overflow: hidden;
            min-height: 380px; /* Un poco más alto para impacto */
            display: flex;
            align-items: center;
        }

        /* Nueva gestión de la imagen de fondo para mejor contraste */
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Utilizamos la imagen como fondo con 'cover' */
            background-image: url("{{ asset('img/aprender.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            /* Aplicamos una capa semitransparente sobre la imagen para alto contraste */
            background-blend-mode: multiply;
            background-color: rgba(0, 123, 255, 0.4); /* Capa azul más fuerte */
            opacity: 0.4; /* Opacidad sutil para que se vea el patrón pero sin opacar el texto */
            z-index: 0;
        }

        /* Ocultamos la etiqueta img que estaba causando problemas y usamos la pseudo-clase ::before */
        .hero-bg-img {
            display: none; 
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 1; /* Asegura que el contenido esté sobre el fondo */
            width: 100%;
        }

        .hero-text h2 {
            font-size: var(--font-size-xxl);
            font-weight: 800;
            margin-bottom: var(--spacing-sm);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Sombra para resaltar aún más */
        }
        
        .hero-text h3 {
             font-size: var(--font-size-lg);
             font-weight: 600;
             margin-bottom: var(--spacing-md);
             color: var(--primary-orange); /* Color de acento para el subtítulo */
             text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .hero-text p {
            font-size: var(--font-size-md);
            max-width: 700px;
            margin-bottom: var(--spacing-xl);
            color: rgba(255, 255, 255, 0.95); /* Mayor opacidad para el párrafo */
        }
        
        /* SECCIONES Y HEADERS */
        .learn-sections {
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
            font-weight: 700;
            position: relative;
            display: inline-block;
        }

        .section-header h2::after { /* Separador visual bajo el título */
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: var(--primary-orange);
            border-radius: 2px;
        }

        .section-header p {
            color: var(--text-secondary);
            max-width: 800px;
            margin: var(--spacing-lg) auto 0;
            font-size: var(--font-size-md);
        }

        /* MENSAJES DE FEEDBACK */
        .feedback-message {
            margin: var(--spacing-lg) auto;
            padding: var(--spacing-md);
            border-radius: var(--border-radius-sm);
            font-weight: 600;
        }

        .feedback-message.success {
            background-color: var(--success-color);
            color: var(--white);
        }

        .feedback-message.error {
            background-color: var(--error-color);
            color: var(--white);
        }
        
        /* PROGRESS BAR (Mejora visual) */
        .progress-container {
            margin: var(--spacing-xl) auto 0 auto;
            padding: var(--spacing-md) var(--spacing-lg);
            border-radius: var(--border-radius-lg);
            background-color: var(--dark-gray); /* Fondo más oscuro y elegante */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            text-align: left; 
        }

        .progress-container p {
            margin-top: 0;
            margin-bottom: var(--spacing-sm);
            font-weight: 600;
            color: var(--white);
            font-size: var(--font-size-lg);
        }
        
        .progress-container small {
            display: block;
            color: rgba(255, 255, 255, 0.7);
            font-size: var(--font-size-sm);
            margin-bottom: var(--spacing-sm);
        }

        .progress-bar-outer {
            background-color: #4a637d; 
            border-radius: 5px;
            height: 18px; 
            overflow: hidden;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .progress-bar-inner {
            background-color: var(--primary-orange); 
            height: 100%;
            border-radius: 5px;
            width: 0%;
            transition: width 0.7s ease-in-out;
            position: relative;
        }
        

        /* GRID DE ACTIVIDADES */
        .main-learn-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); 
            gap: var(--spacing-md); 
            padding: var(--spacing-md) 0;
        }

        /* LEARN CARD (Rediseño UX/UI) */
        .learn-card {
            background-color: var(--white);
            border-radius: var(--border-radius-lg); 
            box-shadow: 0 6px 15px var(--shadow-medium); 
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            border: 1px solid var(--border-color); 
        }

        .learn-card:hover {
            transform: translateY(-10px) scale(1.02); 
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        
        .learn-card:active {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }

        .card-image-container {
            width: 100%;
            height: 220px; 
            overflow: hidden;
            background-color: var(--medium-gray);
            position: relative;
        }
        
        .card-image-container::after { 
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 123, 255, 0.1); 
            mix-blend-mode: multiply;
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .learn-card:hover .card-image {
            transform: scale(1.05); 
        }

        .card-content {
            padding: var(--spacing-lg) var(--spacing-xl); 
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        
        .card-content h3 {
            font-size: var(--font-size-lg);
            color: var(--primary-blue);
            margin-bottom: var(--spacing-sm);
            font-weight: 700; 
            border-bottom: 2px solid var(--primary-orange); 
            padding-bottom: 5px;
            display: inline-block;
        }

        .card-content p {
            font-size: var(--font-size-base);
            color: var(--text-secondary);
            flex-grow: 1;
            margin-top: var(--spacing-md);
        }
        
        /* ESTILOS ESPECÍFICOS PARA DISPOSITIVOS MÓVILES (Responsividad Mejorada) */
        @media (max-width: 767px) {
            .hero-section {
                padding: var(--spacing-xl) 0;
                min-height: 300px;
            }
            
            .hero-text h2 {
                font-size: 2rem;
            }
            
            .hero-text h3 {
                font-size: 1.15rem;
            }
            
            .progress-container {
                margin: var(--spacing-lg) var(--spacing-md);
            }

            .main-learn-grid {
                grid-template-columns: 1fr; 
                padding: 0;
            }
            
            .learn-card {
                width: 100%;
                margin: 0;
            }

            .card-content {
                padding: var(--spacing-md);
            }
            
            .section-header h2 {
                font-size: 1.8rem;
            }
            
            .section-header {
                margin-bottom: var(--spacing-lg);
            }
            
            .learn-sections {
                padding: var(--spacing-xl) 0;
            }

            .hero-logo {
                display: none; /* Ocultar el logo en móvil para dar más espacio al texto */
            }
        }

        /* ESTILOS PARA TABLETS Y DESKTOP */
        @media (min-width: 768px) {
            .hero-content {
                flex-direction: row;
                text-align: left;
                justify-content: space-between;
                align-items: center;
            }

            .hero-logo {
                max-width: 150px;
                margin-right: var(--spacing-md);
                order: 2; 
                filter: drop-shadow(0 0 10px rgba(0, 0, 0, 0.5)); /* Sombra para resaltar el logo blanco */
            }

            .hero-text {
                max-width: 70%;
                order: 1;
            }

            .hero-text h2 {
                font-size: var(--font-size-xl);
            }
            
            .progress-container {
                text-align: center;
            }
        }

    </style>
</head>

<body>
    @if(session('status'))
        <p class="feedback-message success container">
            {{ session('status') }}
        </p>
    @endif
    @if(session('error'))
        <p class="feedback-message error container">
            {{ session('error') }}
        </p>
    @endif
    
    <header>@include('partials.navbar')</header>
    
    <main>
        <section class="hero-section">
            <img src="{{ asset('img/aprender.png') }}" alt="Fondo de la sección de práctica"
                class="hero-bg-img">
            <div class="container hero-content">
                <div class="hero-text">
                    <h2>Sección de Práctica</h2>
                    <h3>¡Pon a prueba y consolida lo que has aprendido en LESSA!</h3>
                    <p>Bienvenido a tu espacio de práctica. Con ejercicios, evaluaciones y herramientas interactivas, reforzarás tu memoria visual y fluidez en el Lenguaje de Señas Salvadoreño. ¡Lleva tu conocimiento al siguiente nivel!</p>
                </div>
                 <img src="{{ asset('img/logo2.png') }}" alt="LESSA Logo" class="hero-logo">
            </div>
        </section>
        
        <div class="container">
            @php
                use App\Models\PuntosUsuario;
                // Simulación para un entorno sin autenticación si no tienes el contexto
                if (Auth::check()) {
                    $userId = Auth::id();
                    $completadas = PuntosUsuario::where('usuario_id', $userId)->where('completado', true)->count();
                } else {
                    $completadas = 3; // Valor de ejemplo
                }
                
                $totalNiveles = 16;
                $progresoPorcentaje = $totalNiveles > 0 ? round(($completadas / $totalNiveles) * 100) : 0;
            @endphp
            
            <div class="progress-container">
                <p>Progreso Global de Práctica: {{ $progresoPorcentaje }}%</p>
                <small>Has completado {{ $completadas }} de {{ $totalNiveles }} actividades disponibles.</small>
                <div class="progress-bar-outer">
                    <div class="progress-bar-inner" style="width: {{ $progresoPorcentaje }}%;">
                </div>
                </div>
            </div>
            
            <section class="learn-sections">
                <div class="section-header">
                    <h2>Actividades de LESSA</h2>
                    <p>Selecciona una lección para iniciar tu práctica y reforzar tus conocimientos con ejercicios interactivos.</p>
                </div>
                <div class="learn-sections-layout">
                    <div class="main-learn-grid">
                        
                        <div class="learn-card goToLevelAbecedario">
                            <div class="card-image-container">
                                <img src="{{ asset('img/abcd.png') }}" alt="Señal del abecedario" class="card-image">
                            </div>
                            <div class="card-content">
                                <h3>Abecedario</h3>
                                <p>Practica el deletreo manual para nombres propios, siglas y palabras desconocidas. ¡La base de la comunicación!</p>
                            </div>
                        </div>
                        
                        <div class="learn-card goToLevelNumeros">
                            <div class="card-image-container">
                                <img src="{{ asset('img/numbers.png') }}" alt="Señal de números" class="card-image">
                            </div>
                            <div class="card-content">
                                <h3>Números y Cantidades</h3>
                                <p>Domina los números del 1 al 100 y más allá, aprende a contar objetos y a formular preguntas sobre cantidades.</p>
                            </div>
                        </div>
                        
                        <div class="learn-card goToLevelSaludos">
                            <div class="card-image-container">
                                <img src="{{ asset('img/saludos.png') }}" alt="Señal de saludo" class="card-image">
                            </div>
                            <div class="card-content">
                                <h3>Saludos y Presentaciones</h3>
                                <p>Refuerza las frases esenciales para iniciar una conversación: "Hola", "¿Cómo estás?" y presentarte formal e informalmente.</p>
                            </div>
                        </div>
                        
                        <div class="learn-card goToLevelSalud">
                            <div class="card-image-container">
                                <img src="{{ asset('img/health.png') }}" alt="Señal de salud" class="card-image">
                            </div>
                            <div class="card-content">
                                <h3>Salud y Emergencias</h3>
                                <p>Practica cómo señalar síntomas básicos ("me duele", "fiebre") y cómo comunicar información médica crítica en situaciones de emergencia.</p>
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
            // Función para manejar la navegación por click en las cards
            function setupCardNavigation(className, route) {
                const card = document.querySelector('.' + className);
                if (card) {
                    card.addEventListener('click', function() {
                        window.location.href = route;
                    });
                }
            }
            
            // Asignación de rutas a las tarjetas
            setupCardNavigation('goToLevelAbecedario', "{{ route('nivel.abecedario') }}");
            setupCardNavigation('goToLevelNumeros', "{{ route('nivel.numeros') }}");
            setupCardNavigation('goToLevelSaludos', "{{ route('nivel.saludos') }}");
            setupCardNavigation('goToLevelSalud', "{{ route('nivel.salud') }}");

            // Animación de barra de progreso (usando el valor dinámico de Blade)
            const progressBar = document.querySelector('.progress-bar-inner');
            const porcentaje = '{{ $progresoPorcentaje }}';

            setTimeout(() => {
                // Aplicar el porcentaje con animación CSS
                progressBar.style.width = porcentaje + '%';
            }, 200);
        });
    </script>
</body>

</html>