<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LESSA - Plataforma de Aprendizaje</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* --- 1. VARIABLES Y ESTILOS BASE --- */
        :root {
            --primary-blue: #0b63ff;
            /* Azul principal */
            --primary-dark: #0056b3;
            --accent-orange: #ff6b35;
            /* Naranja para contraste */
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
            border-radius: 0 0 25px 25px;
        }

        .hero-bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.1;
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
            background: var(--white);
            margin-top: -25px;
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
            --progress-color: var(--success-color);
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

            /* --- La variable --progress se establece en línea con el porcentaje de PHP --- */
            background: conic-gradient(var(--progress-color) calc(var(--progress) * 3.6deg),
                    var(--track-color) 0deg);
            transition: background 1s ease-out;
        }

        .progress-circle::before {
            content: '';
            position: absolute;
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

        /* --- ESTILOS DEL MODAL DE PROGRESO (NUEVOS) --- */
        .progress-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1200;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .progress-modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .progress-modal-content {
            background: var(--card-bg);
            border-radius: var(--radius-md);
            padding: 30px;
            width: 90%;
            max-width: 500px;
            box-shadow: var(--shadow-soft);
            text-align: center;
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }

        .progress-modal-overlay.active .progress-modal-content {
            transform: scale(1);
        }

        .modal-header {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .modal-header i {
            font-size: 2.5rem;
            color: var(--primary-blue);
            margin-bottom: 10px;
        }

        .modal-header h3 {
            font-size: 1.5rem;
            color: var(--primary-dark);
            margin: 0;
            font-weight: 700;
        }

        .modal-body-progress {
            margin-bottom: 25px;
            padding: 15px;
            border-radius: var(--radius-md);
            background: var(--background-light);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .modal-progress-text {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .modal-progress-desc {
            font-size: 0.95rem;
            color: var(--text-muted);
            margin-top: 0;
        }

        .modal-circle {
            --size: 100px;
            --border-width: 10px;
            --progress-color: var(--success-color);
            --track-color: #e2e8f0;
            width: var(--size);
            height: var(--size);
            border-radius: 50%;
            margin: 15px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-dark);
            position: relative;
            background: conic-gradient(var(--progress-color) calc(var(--progress) * 3.6deg),
                    var(--track-color) 0deg);
        }

        .modal-circle::before {
            content: '';
            position: absolute;
            width: calc(var(--size) - var(--border-width) * 2 - 2px);
            height: calc(var(--size) - var(--border-width) * 2 - 2px);
            background: var(--card-bg);
            border-radius: 50%;
        }

        .modal-circle .progress-value {
            position: relative;
            z-index: 2;
        }

        .pending-list {
            text-align: left;
            margin: 0 0 20px 0;
            padding: 0;
            list-style: none;
        }

        .pending-list li {
            font-size: 0.95rem;
            color: var(--text-dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .pending-list i {
            color: var(--accent-orange);
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .modal-button {
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 10px 20px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .modal-button:hover {
            background-color: var(--primary-dark);
        }

        .modal-button.secondary {
            background: none;
            color: var(--primary-blue);
            border: 2px solid var(--primary-blue);
            margin-left: 10px;
        }

        .modal-button.secondary:hover {
            background-color: rgba(11, 99, 255, 0.1);
        }

        /* Responsive Modal */
        @media (max-width: 480px) {
            .progress-modal-content {
                padding: 20px;
            }

            .modal-header h3 {
                font-size: 1.3rem;
            }

            .modal-circle {
                --size: 80px;
            }

            .modal-button {
                width: 100%;
                margin: 5px 0 0 0 !important;
            }
        }
    </style>
</head>

<body>
    {{-- Asume la inclusión de tu navbar --}}
    @include('partials.navbar')

    <main>
        @php
            use App\Models\PuntosUsuario;
            $userId = Auth::id();
            $totalNiveles = 4;
            $completadoABC = PuntosUsuario::where('usuario_id', $userId)
                ->where('completado', true)
                ->where('nivel_id', 'like', 'ABC%')
                ->count();
            $pendientesABC = $totalNiveles - $completadoABC;

            $completadoNUM = PuntosUsuario::where('usuario_id', $userId)
                ->where('completado', true)
                ->where('nivel_id', 'like', 'NUM%')
                ->count();
            $pendientesNUM = $totalNiveles - $completadoNUM;

            $completadoSL = PuntosUsuario::where('usuario_id', $userId)
                ->where('completado', true)
                ->where('nivel_id', 'like', 'SL%')
                ->count();
            $pendientesSL = $totalNiveles - $completadoSL;

            $completadoSALUD = PuntosUsuario::where('usuario_id', $userId)
                ->where('completado', true)
                ->where('nivel_id', 'like', 'SALUD%')
                ->count();
            $pendientesSALUD = $totalNiveles - $completadoSALUD;

            $porcentaje = $progressData['porcentajeGlobal'] ?? 0;
            $pendingBySection = ['Abecedario' => $pendientesABC, 'Números' => $pendientesNUM, 'Saludos' => $pendientesSL, 'Salud' => $pendientesSALUD];
            $descripcion = $progressData['descripcionProgreso'] ?? '¡Bienvenido! Comienza para ver tu progreso global.';

            // Definición de las secciones con sus rutas e íconos (MANTENIDO)
            $sections = [
                'Abecedario' => [
                    'icon' => 'fas fa-fingerprint',
                    'route' => route('nivel.abecedario'),
                    'description' => 'Aprende y practica la dactilología completa de la LESSA.'
                ],
                'Números' => [
                    'icon' => 'fas fa-calculator',
                    'route' => route('nivel.numeros'),
                    'description' => 'Domina las señas para contar del 0 al 100.'
                ],
                'Saludos' => [
                    'icon' => 'fas fa-handshake',
                    'route' => route('nivel.saludos'),
                    'description' => 'Comienza conversaciones básicas y formales en LESSA.'
                ],
                'Salud' => [
                    'icon' => 'fas fa-heartbeat',
                    'route' => route('nivel.salud'),
                    'description' => 'Vocabulario esencial relacionado con el cuerpo y la salud.'
                ],
            ];

            $totalPending = 16 - ($completadoABC + $completadoNUM + $completadoSL + $completadoSALUD);

        @endphp

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
                    <a href="{{ route('miProgreso') }}" class="hero-button">Ver Mi Progreso <i
                            class="fas fa-chart-line"></i></a>
                </div>
            </div>
        </section>

        <section class="progress-summary-section">
            <div class="container progress-container-main">
                <div class="progress-circle-wrap">
                    {{-- El estilo CSS utiliza la variable --progress para el cálculo --}}
                    <div class="progress-circle" style="--progress: {{ $porcentaje }};">
                        <span class="progress-value">{{ $porcentaje }}%</span>
                    </div>
                    <div class="progress-details">
                        <h2 class="progress-title">Tu Progreso</h2>
                        <p class="progress-description">{{ $descripcion }}</p>
                    </div>
                </div>

                {{-- Detalle de actividades pendientes por sección (ESTÁTICO SIN PHP) --}}
                <div class="pending-activities-grid">

                    <div class="pending-item">
                        <span class="pending-count">{{ $pendientesABC }}</span>
                        <span class="pending-label">
                            Actividades Pendientes en Abecedario
                        </span>
                        <a href="{{ route('nivel.abecedario') }}" class="pending-link">
                            @if ($pendientesABC > 0)
                                ¡Continuar! <i class="fas fa-arrow-right"></i>
                            @else
                                Completado <i class="fas fa-check-circle"></i>
                            @endif
                        </a>
                    </div>

                    <div class="pending-item">
                        <span class="pending-count">{{ $pendientesNUM }}</span>
                        <span class="pending-label">
                            Actividades Completadas en Números
                        </span>
                        <a href="{{ route('nivel.numeros') }}" class="pending-link">
                            @if ($pendientesNUM > 0)
                                ¡Continuar! <i class="fas fa-arrow-right"></i>
                            @else
                                Completado <i class="fas fa-check-circle"></i>
                            @endif
                        </a>
                    </div>

                    <div class="pending-item">
                        <span class="pending-count">{{ $pendientesSL }}</span>
                        <span class="pending-label">
                            Actividades Pendientes en Saludos
                        </span>
                        <a href="{{ route('nivel.saludos') }}" class="pending-link">
                            @if ($pendientesSL > 0)
                                ¡Continuar! <i class="fas fa-arrow-right"></i>
                            @else
                                Completado <i class="fas fa-check-circle"></i>
                            @endif
                        </a>
                    </div>

                    <div class="pending-item">
                        <span class="pending-count">{{ $pendientesSALUD }}</span>
                        <span class="pending-label">
                            Actividades Completadas en Salud
                        </span>
                        <a href="{{ route('nivel.salud') }}" class="pending-link">
                            @if ($pendientesSALUD > 0)
                                ¡Continuar! <i class="fas fa-arrow-right"></i>
                            @else
                                Completado <i class="fas fa-check-circle"></i>
                            @endif
                        </a>
                    </div>

                </div>
            </div>
        </section>

        <section class="practice-sections-v2">
            <div class="container">
                <h2 class="section-title-v2">Inicia o Continúa tu Práctica</h2>
                <div class="cards-grid-v2">

                    <a href="{{ route('nivel.abecedario') }}" class="lesson-card" aria-label="Ir a sección de Abecedario">
                        <div class="card-icon-box abecedario">
                            <i class="fas fa-fingerprint"></i>
                        </div>
                        <div class="card-content-v2">
                            <h3>Abecedario</h3>
                            <p>Aprende y practica la dactilología completa de la LESSA.</p>
                            <div class="card-footer">
                                @if ($pendientesABC > 0)
                                    <span class="badge badge-warning">{{ $pendientesABC }} pendiente(s)</span>
                                @else
                                    <span class="badge badge-success">Completado</span>
                                @endif
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('nivel.numeros') }}" class="lesson-card" aria-label="Ir a sección de Números">
                        <div class="card-icon-box numeros">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <div class="card-content-v2">
                            <h3>Números</h3>
                            <p>Domina las señas para contar del 0 al 100.</p>
                            <div class="card-footer">
                                @if ($pendientesNUM > 0)
                                    <span class="badge badge-warning">{{ $pendientesNUM }} pendiente(s)</span>
                                @else
                                    <span class="badge badge-success">Completado</span>
                                @endif
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('nivel.saludos') }}" class="lesson-card" aria-label="Ir a sección de Saludos">
                        <div class="card-icon-box saludos">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <div class="card-content-v2">
                            <h3>Saludos</h3>
                            <p>Comienza conversaciones básicas y formales en LESSA.</p>
                            <div class="card-footer">
                                @if ($pendientesSL > 0)
                                    <span class="badge badge-warning">{{ $pendientesSL }} pendiente(s)</span>
                                @else
                                    <span class="badge badge-success">Completado</span>
                                @endif
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('nivel.salud') }}" class="lesson-card" aria-label="Ir a sección de Salud">
                        <div class="card-icon-box salud">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <div class="card-content-v2">
                            <h3>Salud</h3>
                            <p>Vocabulario esencial relacionado con el cuerpo y la salud.</p>
                            <div class="card-footer">
                                @if ($pendientesSALUD > 0)
                                    <span class="badge badge-warning">{{ $pendientesSALUD }} pendiente(s)</span>
                                @else
                                    <span class="badge badge-success">Completado</span>
                                @endif
                            </div>
                        </div>
                    </a>

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
                            <p>Sumérgete en un diccionario de fácil recuperación que te ayudará a comunicarte
                                fácilmente.</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <div id="progressModal" class="progress-modal-overlay" role="dialog" aria-modal="true"
            aria-labelledby="modalTitle">
            <div class="progress-modal-content">
                <div class="modal-header">
                    {{-- Icono dinámico basado en el progreso --}}
                    @if ($porcentaje == 100)
                        <i class="fas fa-trophy" style="color: var(--warning-color);"></i>
                        <h3 id="modalTitle">¡Progreso Completado! 🎉</h3>
                    @else
                        <i class="fas fa-chart-bar"></i>
                        <h3 id="modalTitle">¡Hola de nuevo, {{ Auth::user()->name }}!</h3>
                    @endif
                </div>

                <div class="modal-body-progress">
                    <div class="modal-circle" style="--progress: {{ $porcentaje }};">
                        <span class="progress-value">{{ $porcentaje }}%</span>
                    </div>

                    <p class="modal-progress-text">{{ $descripcion }}</p>

                    @if ($totalPending > 0)
                        <p class="modal-progress-desc">Tienes {{ $totalPending }} actividades pendientes. ¡Es momento de
                            practicarlas!</p>
                        <ul class="pending-list">
                            {{-- Muestra hasta 3 secciones pendientes --}}
                            @php $count = 0; @endphp
                            @foreach($pendingBySection as $sectionName => $pendingCount)
                                @if ($pendingCount > 0 && $count < 3)
                                    <li><i class="fas fa-exclamation-triangle"></i> {{ $sectionName }}: {{ $pendingCount }}
                                        pendiente(s)</li>
                                    @php $count++; @endphp
                                @endif
                            @endforeach
                            @if ($totalPending > 3)
                                <li>... y más por explorar.</li>
                            @endif
                        </ul>
                    @elseif ($porcentaje == 100)
                        <p class="modal-progress-desc">Has completado todas las actividades disponibles. ¡Eres un maestro en
                            LESSA! 🎉</p>
                    @else
                        {{-- Caso si $totalPending es 0 pero % < 100 (solo sucede si no hay más actividades en el curso)
                            --}} <p class="modal-progress-desc">Actualmente no tienes actividades pendientes. ¡Revisa el
                            vocabulario o los videos!</p>
                    @endif
                </div>

                <div class="modal-footer">
                    @if ($totalPending > 0)
                        {{-- Muestra continuar si hay pendientes --}}
                        <a href="{{ route('practicar') }}" class="modal-button">Continuar Práctica <i
                                class="fas fa-arrow-right"></i></a>
                        <button type="button" class="modal-button secondary" onclick="closeProgressModal()">Ver
                            Home</button>
                    @else
                        {{-- Muestra videos si no hay pendientes (100% o al día) --}}
                        <a href="{{ route('lecciones.videos') }}" class="modal-button">Ver Videos Educativos <i
                                class="fas fa-video"></i></a>
                        <button type="button" class="modal-button secondary" onclick="closeProgressModal()">Cerrar</button>
                    @endif
                </div>
            </div>
        </div>

    </main>

    <footer>@include('partials.footer')</footer>

    <script>
        const MODAL_SHOWN_KEY = 'progressModalShown';

        // Función para cerrar el modal
        function closeProgressModal() {
            const modal = document.getElementById('progressModal');
            modal.classList.remove('active');

            // Guarda en sessionStorage que el modal ya se mostró
            sessionStorage.setItem(MODAL_SHOWN_KEY, 'true');
        }

        // Lógica para mostrar el modal solo si NO se ha mostrado en esta sesión
        window.addEventListener('load', () => {
            const circle = document.querySelector('.progress-circle');
            if (circle) {
                // Forzar la aplicación del conic-gradient para activar la transición/animación
                circle.style.background = circle.style.background;
            }

            const modal = document.getElementById('progressModal');

            // Verifica si el modal ya se mostró en esta sesión
            const wasModalShown = sessionStorage.getItem(MODAL_SHOWN_KEY);

            if (modal && wasModalShown !== 'true') {
                // Solo muestra el modal si NO ha sido mostrado
                setTimeout(() => {
                    modal.classList.add('active');
                }, 300);
            }
        });

        // Cerrar modal al hacer clic fuera de él
        document.getElementById('progressModal').addEventListener('click', function (event) {
            if (event.target === this) {
                closeProgressModal();
            }
        });
    </script>
</body>

</html>