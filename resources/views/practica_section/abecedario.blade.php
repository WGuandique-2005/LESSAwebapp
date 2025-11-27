<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nivel Abecedario: Mini-Juegos - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* --- 1. VARIABLES Y ESTILOS BASE (Copiado de Home) --- */
        :root {
            /* Paleta de Colores Refinada */
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

            /* Colores específicos de los juegos (Adaptados al sistema) */
            --game1-color: #f94144;
            --game2-color: #f8961e;
            --game3-color: #43aa8b;
            --game4-color: #277da1;
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
            gap: 1rem;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--accent-color);
            margin-bottom: 0.5rem;
        }

        .hero-desc {
            font-size: 1.125rem;
            max-width: 700px;
            opacity: 0.9;
            font-weight: 300;
        }

        /* --- 3. BREADCRUMB --- */
        .breadcrumb-nav {
            margin-top: -3rem;
            position: relative;
            z-index: 20;
            margin-bottom: 2rem;
        }

        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            padding: 1rem 1.5rem;
            background-color: var(--bg-card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            align-items: center;
            gap: 0.5rem;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
            font-size: 0.95rem;
            color: var(--text-secondary);
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition-base);
        }

        .breadcrumb-item a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .breadcrumb-separator {
            margin: 0 0.5rem;
            color: var(--text-secondary);
            font-size: 0.8rem;
        }

        .breadcrumb-item.active {
            color: var(--text-main);
            font-weight: 500;
        }

        /* --- 4. PROGRESS SECTION --- */
        .progress-section {
            margin-bottom: 3rem;
        }

        .progress-card {
            background: var(--bg-card);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            padding: 2.5rem;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            gap: 3rem;
        }

        .progress-content {
            flex: 1;
        }

        .progress-content h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .progress-content p {
            color: var(--text-secondary);
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .progress-link {
            color: var(--accent-color);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition-base);
        }

        .progress-link:hover {
            color: var(--accent-hover);
            transform: translateX(5px);
        }

        .progress-circle-container {
            position: relative;
            width: 140px;
            height: 140px;
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
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-main);
            z-index: 2;
        }

        /* --- 5. GAMES GRID --- */
        .games-section {
            padding-bottom: 5rem;
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

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
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
            cursor: pointer;
            text-align: left;
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

        /* Game Specific Icons */
        .icon-game1 {
            background-color: rgba(249, 65, 68, 0.1);
            color: var(--game1-color);
        }

        .icon-game2 {
            background-color: rgba(248, 150, 30, 0.1);
            color: var(--game2-color);
        }

        .icon-game3 {
            background-color: rgba(67, 170, 139, 0.1);
            color: var(--game3-color);
        }

        .icon-game4 {
            background-color: rgba(39, 125, 161, 0.1);
            color: var(--game4-color);
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
            color: var(--primary-color);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .card-arrow {
            transition: var(--transition-base);
        }

        .lesson-card:hover .card-arrow {
            transform: translateX(5px);
        }

        /* --- 6. MODAL (Results) --- */
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

        .modal-content {
            background: var(--bg-card);
            width: 90%;
            max-width: 450px;
            border-radius: var(--radius-xl);
            padding: 2.5rem;
            position: relative;
            transform: translateY(20px);
            transition: transform 0.3s ease;
            box-shadow: var(--shadow-lg);
            text-align: center;
        }

        .modal-overlay[style*="display: flex"] {
            opacity: 1;
        }

        .modal-overlay[style*="display: flex"] .modal-content {
            transform: translateY(0);
        }

        .modal-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            display: block;
        }

        .modal-content h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1rem;
        }

        .modal-content p {
            font-size: 1rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
        }

        .modal-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
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
            font-size: 1rem;
        }

        .modal-btn:hover {
            background: var(--primary-dark);
        }

        /* Modal States */
        .modal-content.success .modal-icon {
            color: var(--success-color);
        }

        .modal-content.info .modal-icon {
            color: var(--warning-color);
        }

        .modal-content.error .modal-icon {
            color: var(--danger-color);
        }

        /* --- RESPONSIVENESS --- */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2rem;
            }

            .progress-card {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }

            .progress-content {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0 5rem;
            }

            .breadcrumb-nav {
                margin-top: -2rem;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.75rem;
            }

            .modal-content {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <header>
        @include('partials.navbar')
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container hero-content">
                <h1 class="hero-title">Nivel 1: El Abecedario</h1>
                <h2 class="hero-subtitle">¡Consolida las 27 señas del alfabeto LESSA!</h2>
                <p class="hero-desc">
                    La dactilología es la base de la comunicación en Señas. Estos juegos te ayudarán a memorizar la
                    forma correcta de cada letra y a aumentar tu velocidad de deletreo.
                </p>
            </div>
        </section>

        <div class="container">
            @php
                use App\Models\PuntosUsuario;
                $userId = Auth::id();
                $totalNiveles = 4;
                // Donde ID de la leccion comience con 'ABC'
                $completado = PuntosUsuario::where('usuario_id', $userId)
                    ->where('completado', true)
                    ->where('nivel_id', 'like', 'ABC%')
                    ->count();
                $progresoPorcentaje = $totalNiveles > 0 ? round(($completado / $totalNiveles) * 100) : 0;
            @endphp

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/">
                            <i class="fas fa-home"></i> Inicio
                        </a>
                    </li>
                    <li class="breadcrumb-separator">/</li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('practicar') }}">
                            Practicar
                        </a>
                    </li>
                    <li class="breadcrumb-separator">/</li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Abecedario
                    </li>
                </ol>
            </nav>

            <!-- Progress Section -->
            <section class="progress-section">
                <div class="progress-card">
                    <div class="progress-content">
                        <h2>Progreso del Nivel</h2>
                        <p>
                            Has completado <strong>{{ $completado }}</strong> de <strong>{{ $totalNiveles }}</strong> mini-juegos.
                            Sigue practicando para afinar tus habilidades en dactilología.
                        </p>
                        <a href="{{ route('miProgreso') }}" class="progress-link">
                            Ver recompensas desbloqueables <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="progress-circle-container">
                        <div class="progress-circle" style="--progress: {{ $progresoPorcentaje }};">
                            <span class="progress-value">{{ $progresoPorcentaje }}%</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Games Grid -->
            <section class="games-section">
                <div class="section-header">
                    <h2>Mini-Juegos de Dactilología</h2>
                </div>
                <div class="cards-grid">
                    <!-- Game 1 -->
                    <div class="lesson-card" onclick="window.location.href='/practicar/abecedario/adivina'">
                        <div class="card-icon icon-game1">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="card-content">
                            <h3>Adivina la Letra</h3>
                            <p>Identifica la letra correcta entre múltiples opciones. ¡Rapidez y precisión!</p>
                        </div>
                        <div class="card-footer">
                            <span>Jugar Ahora</span>
                            <i class="fas fa-play card-arrow"></i>
                        </div>
                    </div>

                    <!-- Game 2 -->
                    <div class="lesson-card" onclick="window.location.href='/practicar/abecedario/memorama'">
                        <div class="card-icon icon-game2">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="card-content">
                            <h3>Memorama de Señas</h3>
                            <p>Encuentra los pares: imagen de la seña y el gesto correspondiente.</p>
                        </div>
                        <div class="card-footer">
                            <span>Jugar Ahora</span>
                            <i class="fas fa-play card-arrow"></i>
                        </div>
                    </div>

                    <!-- Game 3 -->
                    <div class="lesson-card" onclick="window.location.href='/practicar/abecedario/conecta'">
                        <div class="card-icon icon-game3">
                            <i class="fas fa-brain"></i>
                        </div>
                        <div class="card-content">
                            <h3>Conecta</h3>
                            <p>Une la imagen de la seña con la letra escrita. Fortalece tu memoria visual.</p>
                        </div>
                        <div class="card-footer">
                            <span>Jugar Ahora</span>
                            <i class="fas fa-play card-arrow"></i>
                        </div>
                    </div>

                    <!-- Game 4 -->
                    <div class="lesson-card" onclick="window.location.href='/practicar/abecedario/extra'">
                        <div class="card-icon icon-game4">
                            <i class="fas fa-pen-nib"></i>
                        </div>
                        <div class="card-content">
                            <h3>Trazado de Señas</h3>
                            <p>Realiza la seña que se menciona en pantalla. Enfocado en la producción correcta de cada seña.</p>
                        </div>
                        <div class="card-footer">
                            <span>Jugar Ahora</span>
                            <i class="fas fa-play card-arrow"></i>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer>
        @include('partials.footer')
    </footer>

    <!-- Result Modal -->
    <div id="result-modal" class="modal-overlay">
        <div class="modal-content" id="modal-content-area">
            <div class="modal-icon" id="modal-icon"></div>
            <h3 id="modal-title-display"></h3>
            <p id="modal-message-display"></p>
            <button class="modal-btn" onclick="window.location.href='{{ route('nivel.abecedario') }}'">
                <i class="fas fa-arrow-left"></i> Volver a Mini-Juegos
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- LÓGICA DEL MODAL DE RESULTADOS ---
            const resultModal = document.getElementById('result-modal');
            const modalContentArea = document.getElementById('modal-content-area');
            const modalTitle = document.getElementById('modal-title-display');
            const modalMessage = document.getElementById('modal-message-display');
            const modalIcon = document.getElementById('modal-icon');

            // Función para mostrar el modal
            function showResultModal(type, title, message) {
                // Elimina clases de estado anteriores y añade la nueva
                modalContentArea.className = 'modal-content ' + type;

                // Actualiza el contenido del modal
                modalTitle.textContent = title;
                modalMessage.textContent = message;

                // Define el icono basado en el tipo de mensaje (usando Emojis o Iconos FontAwesome)
                if (type === 'success') {
                    modalIcon.innerHTML = '<i class="fas fa-trophy"></i>'; 
                } else if (type === 'info') {
                    modalIcon.innerHTML = '<i class="fas fa-lightbulb"></i>'; 
                } else if (type === 'error') {
                    modalIcon.innerHTML = '<i class="fas fa-times-circle"></i>'; 
                }

                // Muestra el modal
                resultModal.style.display = 'flex';
            }

            // Obtener el mensaje completo que viene en el flash data
            const successMessage = "{{ session('success') }}";
            const infoMessage = "{{ session('info') }}";
            const errorMessage = "{{ session('error') }}";

            if (successMessage) {
                showResultModal('success', '¡Progreso Guardado!', successMessage);
            } else if (infoMessage) {
                showResultModal('info', '¡Bien Hecho!', infoMessage);
            } else if (errorMessage) {
                showResultModal('error', '¡Error al Guardar!', errorMessage);
            }
        });
    </script>
</body>

</html>