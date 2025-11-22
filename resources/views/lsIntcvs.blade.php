@php
    use App\Models\ProgresoUsuario;
    $userId = Auth::id();
    $totalLecciones = 4;
    $completadas = ProgresoUsuario::where('usuario_id', $userId)->where('completado', true)->count();
    $progresoPorcentaje = $totalLecciones > 0 ? round(($completadas / $totalLecciones) * 100) : 0;
    // Asignamos el mensaje de sesión a una variable PHP para usar en JS
    $sessionStatus = session('status');
    $sessionError = session('error');
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sección de Aprendizaje - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        /* --- 1. VARIABLES Y ESTILOS BASE (Coincide con home.blade.php) --- */
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #eff6ff;
            --accent-color: #f97316;
            --accent-hover: #ea580c;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --text-main: #1f2937;
            --text-secondary: #6b7280;
            --bg-body: #f3f4f6;
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

        /* --- HERO SECTION --- */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: #ffffff;
            padding: 3rem 0 5rem;
            position: relative;
            border-radius: 0 0 var(--radius-xl) var(--radius-xl);
            overflow: hidden;
            text-align: center;
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }

        .hero-subtitle {
            font-size: 1.125rem;
            max-width: 800px;
            margin: 0 auto;
            opacity: 0.9;
            font-weight: 300;
            padding: 0 1rem;
        }

        .hero-description {
            font-size: 1rem;
            max-width: 700px;
            margin: 1rem auto 0;
            opacity: 0.8;
            font-weight: 300;
            line-height: 1.6;
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

        /* --- PROGRESS BAR --- */
        .progress-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 1.5rem 2rem;
            box-shadow: var(--shadow-lg);
            margin-bottom: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            cursor: pointer;
            transition: var(--transition-base);
        }

        .progress-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            color: var(--text-main);
            font-size: 1.1rem;
        }

        .progress-bar-bg {
            background-color: #e5e7eb;
            border-radius: var(--radius-full);
            height: 12px;
            overflow: hidden;
            width: 100%;
        }

        .progress-bar-fill {
            background: linear-gradient(90deg, var(--success-color), #34d399);
            height: 100%;
            border-radius: var(--radius-full);
            width: 0%;
            transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.3);
        }

        .reminder-text {
            text-align: center;
            font-size: 0.9rem;
            color: var(--primary-color);
            font-weight: 500;
            font-style: italic;
            margin-top: -0.5rem;
        }

        /* --- CARDS GRID --- */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .lesson-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: var(--transition-base);
            cursor: pointer;
            border: 1px solid transparent;
            height: 100%;
        }

        .lesson-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(37, 99, 235, 0.1);
        }

        .card-image {
            width: 100%;
            height: 180px;
            overflow: hidden;
            background-color: #f1f5f9;
            position: relative;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .lesson-card:hover .card-image img {
            transform: scale(1.1);
        }

        .card-content {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.75rem;
        }

        .card-desc {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .card-footer {
            padding-top: 1rem;
            border-top: 1px solid #f3f4f6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-secondary);
        }

        .status-circle {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #d1d5db;
            transition: all 0.3s;
        }

        .status-circle.completed {
            background-color: var(--success-color);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
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

        /* --- MODALS --- */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .modal-backdrop.show {
            opacity: 1;
            visibility: visible;
        }

        .custom-modal {
            background: var(--bg-card);
            width: 100%;
            max-width: 450px;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            padding: 2rem;
            text-align: center;
            transform: scale(0.95);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .modal-backdrop.show .custom-modal {
            transform: scale(1);
        }

        .modal-icon-container {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
        }

        .modal-icon-container.success {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .modal-icon-container.error {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .modal-message {
            color: var(--text-secondary);
            font-size: 1rem;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .modal-actions {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        @media (min-width: 640px) {
            .modal-actions {
                flex-direction: row;
                justify-content: center;
            }
        }

        .btn-modal {
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-full);
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition-base);
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: var(--bg-body);
            color: var(--text-main);
        }

        .btn-secondary:hover {
            background-color: #e5e7eb;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0 5rem;
            }

            .hero-title {
                font-size: 2rem;
            }

            .card-image {
                height: 160px;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;">
            <h1 class="hero-title">Sección de Aprendizaje</h1>
            <p class="hero-subtitle">¡Bienvenido a tu zona de Aprendizaje!</p>
            <p class="hero-description">
                Aquí es donde obtendrás todo el conocimiento teórico en habilidades reales de comunicación.
                Perfecciona tus movimientos y obtén contexto de su uso.
            </p>
        </div>
    </section>

    <main class="main-container">
            <nav aria-label="breadcrumb" style="font-family: 'Poppins', sans-serif; width: 100%; margin: 20px 0;">
                <ol
                    style="display: flex; flex-wrap: wrap; list-style: none; margin: 0; padding: 12px 20px; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); border: 1px solid #e9ecef;">

                    <li style="display: flex; align-items: center; font-size: 0.95rem;">
                        <a href="/"
                            style="color: #2a6fdb; text-decoration: none; font-weight: 600; display: flex; align-items: center;">
                            Inicio
                        </a>
                    </li>

                    <li style="display: flex; align-items: center; font-size: 0.95rem;">
                        <span style="margin: 0 10px; color: #6b7280;">/</span>

                        <a href="{{ route('aprender')}}"
                            style="color: #2a6fdb; text-decoration: none; font-weight: 600;">
                            Aprender
                        </a>
                    </li>

                    <li style="display: flex; align-items: center; font-size: 0.95rem; font-weight: 500;"
                        aria-current="page">
                        <span style="margin: 0 10px; color: #6b7280;">/</span>

                        <span style="color: #212529;">
                            Lecciones
                        </span>
                    </li>

                </ol>
            </nav>
        <!-- Progress Bar -->
        <div class="progress-card goToProgress" onclick="window.location.href='{{ route('miProgreso') }}'">
            <div class="progress-header">
                <span>Tu Progreso Global</span>
                <span>{{ $progresoPorcentaje }}%</span>
            </div>
            <div class="progress-bar-bg">
                <div class="progress-bar-fill" style="width: {{ $progresoPorcentaje }}%;"></div>
            </div>
            <p class="reminder-text">
                "Si nunca lo intentas, ¡nunca sabrás el resultado! ¡Tú puedes!"
            </p>
        </div>

        <!-- Cards Grid -->
        <div class="cards-grid">
            <!-- Abecedario -->
            <div class="lesson-card abecedario" onclick="window.location.href='{{ route('lecciones.abecedario') }}'">
                <div class="card-image">
                    <img src="{{ asset('img/abcd.png') }}" alt="Abecedario">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Abecedario</h3>
                    <p class="card-desc">Aprenderás las letras del abecedario para poder deletrear tu nombre, siglas u otros usos.</p>
                    <div class="card-footer">
                        <div class="status-indicator">
                            <div class="status-circle"></div>
                            <span>Estado</span>
                        </div>
                        <i class="fas fa-arrow-right card-arrow"></i>
                    </div>
                </div>
            </div>

            <!-- Números -->
            <div class="lesson-card numeros" onclick="window.location.href='{{ route('lecciones.numeros') }}'">
                <div class="card-image">
                    <img src="{{ asset('img/numbers.png') }}" alt="Números">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Números</h3>
                    <p class="card-desc">Aprenderás los números del 1 al 100, cantidades más grandes y a contar objetos.</p>
                    <div class="card-footer">
                        <div class="status-indicator">
                            <div class="status-circle"></div>
                            <span>Estado</span>
                        </div>
                        <i class="fas fa-arrow-right card-arrow"></i>
                    </div>
                </div>
            </div>

            <!-- Saludos -->
            <div class="lesson-card saludos" onclick="window.location.href='{{ route('lecciones.saludos') }}'">
                <div class="card-image">
                    <img src="{{ asset('img/saludos.png') }}" alt="Saludos">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Saludos y Presentaciones</h3>
                    <p class="card-desc">Aprenderás a comunicar saludos como "Hola", "Buenos días" y frases para presentarte.</p>
                    <div class="card-footer">
                        <div class="status-indicator">
                            <div class="status-circle"></div>
                            <span>Estado</span>
                        </div>
                        <i class="fas fa-arrow-right card-arrow"></i>
                    </div>
                </div>
            </div>

            <!-- Salud -->
            <div class="lesson-card salud" onclick="window.location.href='{{ route('lecciones.salud') }}'">
                <div class="card-image">
                    <img src="{{ asset('img/health.png') }}" alt="Salud">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Salud y Emergencias</h3>
                    <p class="card-desc">Aprenderás a señalar síntomas básicos, expresar alergias y reconocer lugares médicos.</p>
                    <div class="card-footer">
                        <div class="status-indicator">
                            <div class="status-circle"></div>
                            <span>Estado</span>
                        </div>
                        <i class="fas fa-arrow-right card-arrow"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Modal -->
        <div id="successModal" class="modal-backdrop">
            <div class="custom-modal">
                <div class="modal-icon-container success">
                    <i class="fas fa-check"></i>
                </div>
                <h3 class="modal-title">¡Excelente Trabajo!</h3>
                <p id="successModalMessage" class="modal-message"></p>
                <div class="modal-actions">
                    <button class="btn-modal btn-primary" onclick="closeModal('successModal')">Continuar Aprendiendo</button>
                    <button class="btn-modal btn-secondary" onclick="window.location.href = '{{ route('miProgreso') }}'">Ver Progreso</button>
                </div>
            </div>
        </div>

        <!-- Error Modal -->
        <div id="errorModal" class="modal-backdrop">
            <div class="custom-modal">
                <div class="modal-icon-container error">
                    <i class="fas fa-times"></i>
                </div>
                <h3 class="modal-title">Ups, algo pasó</h3>
                <p id="errorModalMessage" class="modal-message"></p>
                <div class="modal-actions">
                    <button class="btn-modal btn-primary" onclick="closeModal('errorModal')">Intentar de Nuevo</button>
                    <button class="btn-modal btn-secondary" onclick="window.location.href = '{{ route('miProgreso') }}'">Ver Progreso</button>
                </div>
            </div>
        </div>

    </main>

    <footer>@include('partials.footer')</footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sessionStatus = @json($sessionStatus);
            const sessionError = @json($sessionError);
            const successModal = document.getElementById('successModal');
            const errorModal = document.getElementById('errorModal');

            // Animate Progress Bar
            setTimeout(() => {
                const bar = document.querySelector('.progress-bar-fill');
                if(bar) bar.style.width = `{{ $progresoPorcentaje }}%`;
            }, 300);

            // Mark completed cards
            const cards = document.querySelectorAll('.lesson-card');
            const completadas = {{ $completadas }};
            
            cards.forEach((card, index) => {
                if (index < completadas) {
                    const circle = card.querySelector('.status-circle');
                    if(circle) circle.classList.add('completed');
                }
            });

            // Modal Logic
            window.closeModal = function(modalId) {
                const modal = document.getElementById(modalId);
                if(modal) {
                    modal.classList.remove('show');
                    setTimeout(() => {
                        modal.style.visibility = 'hidden';
                    }, 300);
                }
            }

            function openModal(modal) {
                modal.style.visibility = 'visible';
                // Force reflow
                void modal.offsetWidth;
                modal.classList.add('show');
            }

            // Show session messages
            if (sessionStatus) {
                const msgEl = document.getElementById('successModalMessage');
                if(msgEl) msgEl.innerText = sessionStatus;
                if(successModal) openModal(successModal);
            } else if (sessionError) {
                const msgEl = document.getElementById('errorModalMessage');
                if(msgEl) msgEl.innerText = sessionError;
                if(errorModal) openModal(errorModal);
            }

            // Close on click outside
            window.onclick = function(event) {
                if (event.target == successModal) closeModal('successModal');
                if (event.target == errorModal) closeModal('errorModal');
            }
        });
    </script>
</body>
</html>