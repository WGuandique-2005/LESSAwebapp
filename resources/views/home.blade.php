<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LESSA - Plataforma de Aprendizaje</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* --- 1. VARIABLES Y ESTILOS BASE --- */
        :root {
            /* Paleta de Colores Refinada */
            --primary-color: #2563eb;
            /* Azul vibrante moderno */
            --primary-dark: #1e40af;
            /* Azul oscuro para hover/textos */
            --primary-light: #eff6ff;
            /* Fondo azul muy claro */
            --accent-color: #f97316;
            /* Naranja energético */
            --accent-hover: #ea580c;
            --success-color: #10b981;
            /* Verde esmeralda */
            --warning-color: #f59e0b;
            /* Ambar */
            --danger-color: #ef4444;
            /* Rojo */
            --text-main: #1f2937;
            /* Gris muy oscuro para texto principal */
            --text-secondary: #6b7280;
            /* Gris medio para subtítulos */
            --bg-body: #f3f4f6;
            /* Gris muy claro de fondo */
            --bg-card: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
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

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* --- 2. HERO SECTION --- */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: #ffffff;
            padding: 4rem 0 6rem;
            /* Extra padding bottom for overlap */
            position: relative;
            border-radius: 0 0 var(--radius-xl) var(--radius-xl);
            overflow: hidden;
            text-align: center;
            box-shadow: var(--shadow-md);
        }

        .hero-bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.15;
            mix-blend-mode: overlay;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }

        .hero-logo {
            width: 80px;
            height: auto;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
            margin-bottom: 0.5rem;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }

        .hero-title span {
            color: var(--accent-color);
            font-style: italic;
        }

        .hero-subtitle {
            font-size: 1.125rem;
            max-width: 600px;
            opacity: 0.9;
            font-weight: 300;
        }

        .hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--bg-card);
            color: var(--primary-color);
            padding: 0.75rem 2rem;
            border-radius: var(--radius-full);
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition-base);
            box-shadow: var(--shadow-md);
            margin-top: 1rem;
            border: none;
            cursor: pointer;
        }

        .hero-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            background-color: #f8fafc;
        }

        /* --- 3. PROGRESS SECTION (Overlap) --- */
        .progress-section {
            margin-top: -4rem;
            /* Overlap effect */
            position: relative;
            z-index: 20;
            padding-bottom: 3rem;
        }

        .progress-card {
            background: var(--bg-card);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
        }

        /* Progress Header: Circle + Text */
        .progress-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3rem;
            flex-wrap: wrap;
            text-align: left;
        }

        .progress-circle-container {
            position: relative;
            width: 160px;
            height: 160px;
            flex-shrink: 0;
        }

        .progress-circle {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(var(--success-color) calc(var(--progress) * 3.6deg), var(--bg-body) 0deg);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .progress-circle::before {
            content: '';
            position: absolute;
            width: 86%;
            height: 86%;
            background: var(--bg-card);
            border-radius: 50%;
        }

        .progress-value {
            position: relative;
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-main);
            z-index: 2;
        }

        .progress-info h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .progress-info p {
            color: var(--text-secondary);
            font-size: 1rem;
            max-width: 400px;
        }

        /* Pending Items Grid */
        .pending-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            width: 100%;
            border-top: 1px solid var(--bg-body);
            padding-top: 2.5rem;
        }

        .pending-item {
            background: var(--bg-body);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            text-align: center;
            transition: var(--transition-base);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .pending-item:hover {
            transform: translateY(-3px);
            background: #e5e7eb;
        }

        .pending-count {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-color);
            line-height: 1;
            margin-bottom: 0.5rem;
            display: block;
        }

        .pending-label {
            font-size: 0.9rem;
            color: var(--text-secondary);
            font-weight: 500;
            margin-bottom: 1rem;
            display: block;
        }

        .pending-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary-color);
            transition: color 0.2s;
        }

        .pending-action:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .status-completed {
            color: var(--success-color);
        }

        /* --- 4. PRACTICE SECTIONS --- */
        .practice-section {
            padding: 2rem 0 5rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .section-header p {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .lesson-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            transition: var(--transition-base);
            display: flex;
            flex-direction: column;
            border: 1px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .lesson-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(37, 99, 235, 0.1);
        }

        .card-icon {
            width: 64px;
            height: 64px;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .lesson-card:hover .card-icon {
            transform: scale(1.1) rotate(5deg);
        }

        /* Icon Colors */
        .icon-abc {
            background-color: rgba(37, 99, 235, 0.1);
            color: var(--primary-color);
        }

        .icon-num {
            background-color: rgba(249, 115, 22, 0.1);
            color: var(--accent-color);
        }

        .icon-saludos {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .icon-salud {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        .card-content h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.75rem;
        }

        .card-content p {
            color: var(--text-secondary);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .card-footer {
            padding-top: 1.5rem;
            border-top: 1px solid var(--bg-body);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .badge {
            padding: 0.35rem 0.85rem;
            border-radius: var(--radius-full);
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.025em;
        }

        .badge-pending {
            background-color: rgba(245, 158, 11, 0.15);
            color: #b45309;
        }

        .badge-completed {
            background-color: rgba(16, 185, 129, 0.15);
            color: #047857;
        }

        .card-arrow {
            color: var(--primary-color);
            opacity: 0;
            transform: translateX(-10px);
            transition: var(--transition-base);
        }

        .lesson-card:hover .card-arrow {
            opacity: 1;
            transform: translateX(0);
        }

        /* --- 5. MODAL --- */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background: var(--bg-card);
            width: 90%;
            max-width: 500px;
            border-radius: var(--radius-xl);
            padding: 2.5rem;
            position: relative;
            transform: translateY(20px);
            transition: transform 0.3s ease;
            box-shadow: var(--shadow-lg);
            text-align: center;
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }

        .modal-close {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-secondary);
            cursor: pointer;
            transition: color 0.2s;
        }

        .modal-close:hover {
            color: var(--danger-color);
        }

        .modal-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1.5rem;
        }

        .modal-body {
            margin-bottom: 2rem;
        }

        .modal-btn {
            display: inline-block;
            width: 100%;
            padding: 1rem;
            border-radius: var(--radius-full);
            background: var(--primary-color);
            color: white;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
        }

        .modal-btn:hover {
            background: var(--primary-dark);
        }

        /* --- RESPONSIVENESS --- */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2rem;
            }

            .progress-header {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
            }

            .progress-info p {
                margin: 0 auto;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0 5rem;
            }

            .progress-card {
                padding: 1.5rem;
            }

            .pending-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.75rem;
            }

            .pending-grid {
                grid-template-columns: 1fr;
            }

            .section-header h2 {
                font-size: 1.75rem;
            }
            
            .modal-content {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    {{-- Navbar Include --}}
    @include('partials.navbar')

    <main>
        @php
            use App\Models\PuntosUsuario;
            $userId = Auth::id();
            $totalNiveles = 4;

            // Helper function to get counts
            $getCounts = function ($pattern) use ($userId, $totalNiveles) {
                $completed = PuntosUsuario::where('usuario_id', $userId)
                    ->where('completado', true)
                    ->where('nivel_id', 'like', $pattern . '%')
                    ->count();
                return [$completed, $totalNiveles - $completed];
            };

            list($completadoABC, $pendientesABC) = $getCounts('ABC');
            list($completadoNUM, $pendientesNUM) = $getCounts('NUM');
            list($completadoSL, $pendientesSL) = $getCounts('SL');
            list($completadoSALUD, $pendientesSALUD) = $getCounts('SALUD');

            $porcentaje = $progressData['porcentajeGlobal'] ?? 0;
            $descripcion = $progressData['descripcionProgreso'] ?? '¡Bienvenido! Comienza para ver tu progreso global.';
        @endphp

        <!-- Hero Section -->
        <section class="hero-section">
            <img src="{{ asset('img/sansalvador.png') }}" alt="Background" class="hero-bg-img">
            <div class="container">
                <div class="hero-content">
                    <img src="{{ asset('img/logo2.png') }}" alt="LESSA Logo" class="hero-logo">
                    <h1 class="hero-title">
                        ¡Bienvenido, <span>{{ Auth::user()->name }}</span>!
                    </h1>
                    <p class="hero-subtitle">
                        Tu camino para dominar el lenguaje de señas salvadoreño comienza aquí.
                        ¡Aprende, practica y conéctate sin límites!
                    </p>
                    <button onclick="openProgressModal()" class="hero-btn">
                        Ver Mi Progreso <i class="fas fa-chart-pie"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- Progress Section -->
        <section class="progress-section">
            <div class="container">
                                    @if(Auth::id() == 1)
                    <a href="{{ route('admin.password') }}" class="lesson-card">
                        <div class="card-icon" style="background-color: rgba(79, 70, 229, 0.1); color: #4f46e5;">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="card-content">
                            <h3>Administración</h3>
                            <p>Panel de control para gestionar de datos de los usuarios y manejo del sistema de atención a los usuarios, también puede envio de comunicados.</p>
                        </div>
                        <div class="card-footer">
                            <span class="badge" style="background-color: #e0e7ff; color: #3730a3;">Acceso Restringido</span>
                            <i class="fas fa-arrow-right card-arrow"></i>
                        </div>
                    </a>
                    @endif
                    <br>
                <div class="progress-card">
                    <div class="progress-header">
                        <div class="progress-circle-container">
                            <div class="progress-circle" style="--progress: {{ $porcentaje }};">
                                <span class="progress-value">{{ $porcentaje }}%</span>
                            </div>
                        </div>
                        <div class="progress-info">
                            <h2>Tu Progreso Global</h2>
                            <p>{{ $descripcion }}</p>
                        </div>
                    </div>

                    <div class="pending-grid">
                        <!-- Abecedario -->
                        <div class="pending-item">
                            <div>
                                <span class="pending-count">{{ $pendientesABC }}</span>
                                <span class="pending-label">Pendientes en Abecedario</span>
                            </div>
                            <a href="{{ route('nivel.abecedario') }}" class="pending-action">
                                @if ($pendientesABC > 0)
                                    Continuar <i class="fas fa-chevron-right"></i>
                                @else
                                    <span class="status-completed">Completado <i class="fas fa-check"></i></span>
                                @endif
                            </a>
                        </div>

                        <!-- Números -->
                        <div class="pending-item">
                            <div>
                                <span class="pending-count">{{ $pendientesNUM }}</span>
                                <span class="pending-label">Pendientes en Números</span>
                            </div>
                            <a href="{{ route('nivel.numeros') }}" class="pending-action">
                                @if ($pendientesNUM > 0)
                                    Continuar <i class="fas fa-chevron-right"></i>
                                @else
                                    <span class="status-completed">Completado <i class="fas fa-check"></i></span>
                                @endif
                            </a>
                        </div>

                        <!-- Saludos -->
                        <div class="pending-item">
                            <div>
                                <span class="pending-count">{{ $pendientesSL }}</span>
                                <span class="pending-label">Pendientes en Saludos</span>
                            </div>
                            <a href="{{ route('nivel.saludos') }}" class="pending-action">
                                @if ($pendientesSL > 0)
                                    Continuar <i class="fas fa-chevron-right"></i>
                                @else
                                    <span class="status-completed">Completado <i class="fas fa-check"></i></span>
                                @endif
                            </a>
                        </div>

                        <!-- Salud -->
                        <div class="pending-item">
                            <div>
                                <span class="pending-count">{{ $pendientesSALUD }}</span>
                                <span class="pending-label">Pendientes en Salud</span>
                            </div>
                            <a href="{{ route('nivel.salud') }}" class="pending-action">
                                @if ($pendientesSALUD > 0)
                                    Continuar <i class="fas fa-chevron-right"></i>
                                @else
                                    <span class="status-completed">Completado <i class="fas fa-check"></i></span>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Practice Section -->
        <section class="practice-section">
            <div class="container">
                <div class="section-header">
                    <h2>Explora tus Lecciones</h2>
                    <p>Selecciona una categoría para comenzar o continuar aprendiendo.</p>
                </div>

                <div class="cards-grid">
                    <!-- Card Abecedario -->
                    <a href="{{ route('nivel.abecedario') }}" class="lesson-card">
                        <div class="card-icon icon-abc">
                            <i class="fas fa-fingerprint"></i>
                        </div>
                        <div class="card-content">
                            <h3>Abecedario</h3>
                            <p>Aprende y practica la dactilología completa de la LESSA paso a paso.</p>
                        </div>
                        <div class="card-footer">
                            @if ($pendientesABC > 0)
                                <span class="badge badge-pending">{{ $pendientesABC }} pendientes</span>
                            @else
                                <span class="badge badge-completed">Completado</span>
                            @endif
                            <i class="fas fa-arrow-right card-arrow"></i>
                        </div>
                    </a>

                    <!-- Card Números -->
                    <a href="{{ route('nivel.numeros') }}" class="lesson-card">
                        <div class="card-icon icon-num">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <div class="card-content">
                            <h3>Números</h3>
                            <p>Domina las señas para contar del 0 al 100 con ejercicios interactivos.</p>
                        </div>
                        <div class="card-footer">
                            @if ($pendientesNUM > 0)
                                <span class="badge badge-pending">{{ $pendientesNUM }} pendientes</span>
                            @else
                                <span class="badge badge-completed">Completado</span>
                            @endif
                            <i class="fas fa-arrow-right card-arrow"></i>
                        </div>
                    </a>

                    <!-- Card Saludos -->
                    <a href="{{ route('nivel.saludos') }}" class="lesson-card">
                        <div class="card-icon icon-saludos">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <div class="card-content">
                            <h3>Saludos</h3>
                            <p>Comienza conversaciones básicas y formales. ¡Di hola en LESSA!</p>
                        </div>
                        <div class="card-footer">
                            @if ($pendientesSL > 0)
                                <span class="badge badge-pending">{{ $pendientesSL }} pendientes</span>
                            @else
                                <span class="badge badge-completed">Completado</span>
                            @endif
                            <i class="fas fa-arrow-right card-arrow"></i>
                        </div>
                    </a>

                    <!-- Card Salud -->
                    <a href="{{ route('nivel.salud') }}" class="lesson-card">
                        <div class="card-icon icon-salud">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <div class="card-content">
                            <h3>Salud</h3>
                            <p>Vocabulario esencial relacionado con el cuerpo, síntomas y bienestar.</p>
                        </div>
                        <div class="card-footer">
                            @if ($pendientesSALUD > 0)
                                <span class="badge badge-pending">{{ $pendientesSALUD }} pendientes</span>
                            @else
                                <span class="badge badge-completed">Completado</span>
                            @endif
                            <i class="fas fa-arrow-right card-arrow"></i>
                        </div>
                    </a>

                </div>
            </div>
        </section>
    </main>

    <footer>
        @include('partials.footer')
    </footer>

    <!-- Modal -->
    <div id="progressModal" class="modal-overlay">
        <div class="modal-content">
            <button class="modal-close" onclick="closeProgressModal()">&times;</button>
            <h3 class="modal-title">Resumen de Progreso</h3>
            
            <div class="modal-body">
                <div class="progress-circle-container" style="margin: 0 auto 1.5rem; width: 120px; height: 120px;">
                    <div class="progress-circle" style="--progress: {{ $porcentaje }};">
                        <span class="progress-value" style="font-size: 2rem;">{{ $porcentaje }}%</span>
                    </div>
                </div>
                <p style="color: var(--text-secondary);">{{ $descripcion }}</p>
                
                <ul style="text-align: left; margin-top: 1.5rem; padding: 0;">
                    <li style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid var(--bg-body);">
                        <span>Abecedario</span>
                        <span style="font-weight: 600; color: {{ $pendientesABC == 0 ? 'var(--success-color)' : 'var(--warning-color)' }}">
                            {{ $pendientesABC == 0 ? 'Completado' : $pendientesABC . ' pendientes' }}
                        </span>
                    </li>
                     <li style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid var(--bg-body);">
                        <span>Números</span>
                        <span style="font-weight: 600; color: {{ $pendientesNUM == 0 ? 'var(--success-color)' : 'var(--warning-color)' }}">
                            {{ $pendientesNUM == 0 ? 'Completado' : $pendientesNUM . ' pendientes' }}
                        </span>
                    </li>
                     <li style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid var(--bg-body);">
                        <span>Saludos</span>
                        <span style="font-weight: 600; color: {{ $pendientesSL == 0 ? 'var(--success-color)' : 'var(--warning-color)' }}">
                            {{ $pendientesSL == 0 ? 'Completado' : $pendientesSL . ' pendientes' }}
                        </span>
                    </li>
                     <li style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid var(--bg-body);">
                        <span>Salud</span>
                        <span style="font-weight: 600; color: {{ $pendientesSALUD == 0 ? 'var(--success-color)' : 'var(--warning-color)' }}">
                            {{ $pendientesSALUD == 0 ? 'Completado' : $pendientesSALUD . ' pendientes' }}
                        </span>
                    </li>
                </ul>
            </div>

            <a href="{{ route('miProgreso') }}" class="modal-btn">
                Ver Detalles Completos
            </a>
        </div>
    </div>

    <script>
        function openProgressModal() {
            const modal = document.getElementById('progressModal');
            modal.style.display = 'flex';
            // Small delay to allow display:flex to apply before opacity transition
            setTimeout(() => {
                modal.classList.add('active');
            }, 10);
        }

        function closeProgressModal() {
            const modal = document.getElementById('progressModal');
            modal.classList.remove('active');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }

        // Close on click outside
        document.getElementById('progressModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeProgressModal();
            }
        });
    </script>
</body>

</html>