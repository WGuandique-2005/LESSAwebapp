<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LESSA - Plataforma de Aprendizaje</title>
    <!-- Importación de fuentes e íconos -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        /* --- 1. VARIABLES Y ESTILOS BASE --- */
        :root {
            --primary-blue: #0b63ff; /* Azul principal */
            --primary-dark: #0056b3;
            --accent-orange: #ff6b35; /* Naranja para contraste */
            --success-color: #16a34a; 
            --warning-color: #f59e0b;
            --background-light: #f5f8fb;
            --card-bg: #ffffff;
            --text-dark: #212529;
            --text-muted: #6b7280;
            --white: #ffffff;
            --shadow-soft: 0 12px 36px rgba(12, 24, 60, 0.08);
            --radius-md: 14px;
            
            /* Variables originales del Hero */
            --spacing-md: 1rem;
            --spacing-xl: 2rem;
            --font-size-xl: 2rem;
            --font-size-xxl: 2.5rem;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background-light);
            color: var(--text-dark);
            min-height: 100vh;
        }
        
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* --- 2. ESTILOS DEL HERO ORIGINAL (PRESERVADOS) --- */
        .hero-section {
            background-color: var(--primary-blue);
            padding: var(--spacing-xl) 0;
            color: var(--white);
            position: relative;
            overflow: hidden;
            border-radius: 0 0 25px 25px; /* Para que coincida con el borde del progreso */
        }
        .hero-bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.1; /* Reducir opacidad para mejorar legibilidad */
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
            max-width: 80px;
            margin-bottom: var(--spacing-md);
            filter: brightness(0) invert(1);
        }
        .hero-text {
            max-width: 700px;
            margin-bottom: 20px;
        }
        .hero-text h2 {
            font-size: var(--font-size-xxl);
            font-weight: 700;
            margin-bottom: var(--spacing-md);
        }
        .hero-text p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
        }
        .hero-button {
            display: inline-block;
            background-color: var(--accent-orange);
            color: var(--white);
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .hero-button:hover {
            background-color: #e55c2f;
        }


        /* --- 3. ESTILOS DE PROGRESO GLOBAL (NUEVOS) --- */
        .progress-summary-section {
            padding: 40px 0;
            background: var(--white); /* Fondo blanco que contrasta con el Hero */
            margin-top: -25px; /* Superponer ligeramente al Hero */
            border-radius: 25px 25px 0 0;
            box-shadow: 0 -10px 20px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 5;
        }

        .progress-container-main {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
        }

        .progress-circle-wrap {
            display: flex;
            align-items: center;
            gap: 30px;
            width: 100%;
            justify-content: center;
            margin-bottom: 20px;
        }

        .progress-details {
            max-width: 400px;
            text-align: left;
        }

        .progress-title {
            font-size: 1.8rem;
            margin-top: 0;
            margin-bottom: 10px;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .progress-description {
            font-size: 1rem;
            color: var(--text-muted);
        }

        /* ESTILO DEL PROGRESS CIRCLE (USANDO CONIC-GRADIENT) */
        .progress-circle {
            --size: 150px;
            --border-width: 12px;
            --progress-color: var(--success-color); /* Usamos verde para el progreso */
            --track-color: var(--background-light);
            
            width: var(--size);
            height: var(--size);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-dark);
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.05);
            
            /* --- CORRECCIÓN CRÍTICA AQUÍ --- */
            /* La variable --progress se establece en línea con el porcentaje de PHP */
            background: conic-gradient(
                var(--progress-color) calc(var(--progress) * 3.6deg), 
                var(--track-color) 0deg
            );
            transition: background 1s ease-out; /* Animación de carga */
        }

        .progress-circle::before {
            content: '';
            position: absolute;
            /* Se resta 2px adicionales para asegurar que el borde verde se vea limpio */
            width: calc(var(--size) - var(--border-width) * 2 - 2px); 
            height: calc(var(--size) - var(--border-width) * 2 - 2px);
            background: var(--card-bg);
            border-radius: 50%;
        }

        .progress-value {
            position: relative;
            z-index: 2;
        }

        /* Actividades Pendientes (Detalle) */
        .pending-activities-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            width: 100%;
            padding: 20px 0;
            border-top: 1px solid var(--background-light);
        }

        .pending-item {
            background: var(--background-light);
            border-radius: var(--radius-md);
            padding: 15px 20px;
            text-align: center;
            min-width: 200px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: background 0.3s;
        }
        .pending-item:hover {
            background: #e6eaf0;
        }

        .pending-count {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
            color: var(--accent-orange);
        }

        .pending-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .pending-link {
            display: block;
            color: var(--primary-blue);
            font-weight: 600;
            text-decoration: none;
            margin-top: 5px;
            transition: color 0.2s;
        }
        .pending-link:hover {
            color: var(--primary-dark);
        }
        .pending-item .fa-check-circle {
            color: var(--success-color);
            margin-left: 5px;
        }
        
        /* RESPONSIVIDAD DEL PROGRESO */
        @media (max-width: 768px) {
            .progress-circle-wrap {
                flex-direction: column;
                text-align: center;
            }
            .progress-details {
                text-align: center;
            }
            .pending-item {
                min-width: 45%;
            }
        }
        @media (max-width: 480px) {
            .pending-item {
                min-width: 100%;
            }
        }


        /* --- 4. ESTILOS DE CARDS MEJORADOS (NUEVOS) --- */
        .practice-sections-v2 {
            padding: 30px 0 60px;
            position: relative;
            z-index: 4;
        }

        .section-title-v2 {
            text-align: center;
            font-size: 2.2rem;
            color: var(--text-dark);
            margin-bottom: 30px;
            font-weight: 800;
        }

        .cards-grid-v2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .lesson-card {
            display: flex;
            flex-direction: column;
            background: var(--card-bg);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-soft);
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            color: inherit;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .lesson-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 45px rgba(12, 24, 60, 0.15);
        }

        .card-icon-box {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 1.8rem;
        }
        /* Colores específicos para cada sección */
        .card-icon-box.abecedario {
            background: rgba(11, 99, 255, 0.1);
            color: var(--primary-blue);
        }
        .card-icon-box.numeros {
            background: rgba(255, 107, 53, 0.1);
            color: var(--accent-orange);
        }
        .card-icon-box.saludos {
            background: rgba(22, 163, 74, 0.1);
            color: var(--success-color);
        }
        .card-icon-box.salud {
            background: rgba(220, 34, 56, 0.1);
            color: #dc2238;
        }


        .card-content-v2 {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-content-v2 h3 {
            font-size: 1.4rem;
            margin-top: 0;
            margin-bottom: 5px;
            color: var(--primary-dark);
        }

        .card-content-v2 p {
            font-size: 0.95rem;
            color: var(--text-muted);
            margin-bottom: 15px;
            flex-grow: 1; 
        }

        .card-footer {
            padding-top: 10px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-warning {
            background-color: var(--warning-color);
            color: var(--text-dark);
        }

        .badge-success {
            background-color: var(--success-color);
            color: var(--white);
        }
    </style>
</head>

<body>
    {{-- Asume la inclusión de tu navbar --}}
    @include('partials.navbar')

    <main>
        @php
            // Se asume que $progressData ya fue pasado desde el closure de la ruta en web.php
            // Valores de prueba si no se reciben (por ejemplo, 75% completado)
            $progressData = $progressData ?? [
                'porcentajeGlobal' => 75, 
                'pendingBySection' => ['Abecedario' => 1, 'Números' => 0, 'Saludos' => 2, 'Salud' => 0],
                'descripcionProgreso' => '¡Estás en camino! Completa las lecciones pendientes para ser un experto.',
            ];
            $porcentaje = $progressData['porcentajeGlobal'];
            $pendingBySection = $progressData['pendingBySection'];
            $descripcion = $progressData['descripcionProgreso'];

            // Definición de las secciones con sus rutas e íconos
            $sections = [
                'Abecedario' => [
                    'icon' => 'fas fa-fingerprint', 
                    'route' => route('nivel.abecedario'), // Asegúrate que esta ruta exista
                    'description' => 'Aprende y practica la dactilología completa de la LESSA.'
                ],
                'Números' => [
                    'icon' => 'fas fa-calculator',
                    'route' => route('nivel.numeros'), // Asegúrate que esta ruta exista
                    'description' => 'Domina las señas para contar del 0 al 100.'
                ],
                'Saludos' => [
                    'icon' => 'fas fa-handshake',
                    'route' => route('nivel.saludos'), // Asegúrate que esta ruta exista
                    'description' => 'Comienza conversaciones básicas y formales en LESSA.'
                ],
                'Salud' => [
                    'icon' => 'fas fa-heartbeat',
                    'route' => route('nivel.salud'), // Asegúrate que esta ruta exista
                    'description' => 'Vocabulario esencial relacionado con el cuerpo y la salud.'
                ],
            ];
        @endphp

        <!-- 1. SECCIÓN HERO (ORIGINAL) -->
        <section class="hero-section">
            <img src="{{ asset('img/sansalvador.png') }}" alt="LESSA Background" class="hero-bg-img">
            <div class="container">
                <div class="hero-content">
                    <img src="{{ asset('img/logo2.png') }}" alt="LESSA Logo" class="hero-logo">
                    <div class="hero-text">
                        <h2>¡Bienvenido, <span style="font-style: italic;">{{ Auth::user()->name }}</span>!</h2>
                        <p>Tu camino para dominar el lenguaje de señas salvadoreño comienza aquí. ¡Aprende, practica y
                            conéctate!</p>
                    </div>
                    <a href="{{ route('miProgreso') }}" class="hero-button">Ver Mi Progreso <i class="fas fa-chart-line"></i></a>
                </div>
            </div>
        </section>

        <!-- 2. SECCIÓN DE PROGRESO GLOBAL (NUEVA - CÍRCULO) -->
        <section class="progress-summary-section">
            <div class="container progress-container-main">
                <div class="progress-circle-wrap">
                    {{-- El estilo CSS utiliza la variable --progress para el cálculo --}}
                    <div class="progress-circle" style="--progress: {{ $porcentaje }};">
                        <span class="progress-value">{{ $porcentaje }}%</span>
                    </div>
                    <div class="progress-details">
                        <h2 class="progress-title">Tu Progreso Global</h2>
                        <p class="progress-description">{{ $descripcion }}</p>
                    </div>
                </div>
                
                {{-- Detalle de actividades pendientes por sección --}}
                <div class="pending-activities-grid">
                    @foreach($pendingBySection as $sectionName => $pendingCount)
                        @if (isset($sections[$sectionName]))
                            <div class="pending-item">
                                <span class="pending-count">{{ $pendingCount }}</span>
                                <span class="pending-label">
                                    {{ $pendingCount === 1 ? 'Actividad Pendiente' : 'Actividades Pendientes' }} en {{ $sectionName }}
                                </span>
                                <a href="{{ $sections[$sectionName]['route'] ?? '#' }}" class="pending-link">
                                    @if ($pendingCount > 0)
                                        ¡Empezar! <i class="fas fa-arrow-right"></i>
                                    @else
                                        Completado <i class="fas fa-check-circle"></i>
                                    @endif
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        <!-- 3. SECCIÓN DE PRÁCTICA (CARDS MEJORADOS) -->
        <section class="practice-sections-v2">
            <div class="container">
                <h2 class="section-title-v2">Inicia o Continúa tu Práctica</h2>
                <div class="cards-grid-v2">
                    {{-- Recorre las 4 secciones principales --}}
                    @foreach($sections as $sectionName => $data)
                        {{-- Clase dinámica para los colores del icono --}}
                        <a href="{{ $data['route'] }}" class="lesson-card" aria-label="Ir a sección de {{ $sectionName }}">
                            <div class="card-icon-box {{ strtolower(str_replace('ó', 'o', $sectionName)) }}">
                                <i class="{{ $data['icon'] }}"></i>
                            </div>
                            <div class="card-content-v2">
                                <h3>{{ $sectionName }}</h3>
                                <p>{{ $data['description'] }}</p>
                                <div class="card-footer">
                                    @if($pendingBySection[$sectionName] > 0)
                                        <span class="badge badge-warning">{{ $pendingBySection[$sectionName] }} pendiente(s)</span>
                                    @else
                                        <span class="badge badge-success">Completado</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                    
                    {{-- Tarjetas adicionales (Mantenidas para otros contenidos) --}}
                    <a href="#" class="lesson-card">
                        <div class="card-icon-box" style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="card-content-v2">
                            <h3>Vocabulario Útil</h3>
                            <p>Descubre un amplio conjunto de palabras que son esenciales en múltiples contextos.</p>
                        </div>
                    </a>
                    <a href="#" class="lesson-card">
                        <div class="card-icon-box" style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="card-content-v2">
                            <h3>Términos Comunes</h3>
                            <p>Sumérgete en un diccionario de fácil recuperación que te ayudará a comunicarte fácilmente.</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer>@include('partials.footer')</footer>
    
    <script>
        // Animación de carga del círculo (opcional)
        window.addEventListener('load', () => {
            const circle = document.querySelector('.progress-circle');
            if (circle) {
                // Forzar la aplicación del conic-gradient para activar la transición/animación
                circle.style.background = circle.style.background; 
            }
        });
    </script>
</body>

</html>
