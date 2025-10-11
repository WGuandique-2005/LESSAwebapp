<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nivel Abecedario: Mini-Juegos - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            /* Colores Base */
            --primary-blue: #2a6fdb;
            --primary-orange: #ff6b35;
            --secondary-yellow: #ffc107;
            --light-gray: #f4f6f9;
            --medium-gray: #e9ecef;
            --dark-gray: #212529;
            --text-color: #212529;
            --white: #ffffff;
            --success-color: #22C55E;
            --dark-blue-overlay: rgba(30, 58, 138, 0.7); /* Nuevo: Overlay semi-transparente */

            /* Espaciado */
            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --spacing-xxl: 3rem;

            /* Tipografía */
            --font-family-primary: 'Poppins', sans-serif;
            --font-size-base: 1rem;
            --font-size-sm: 0.9rem;
            --font-size-md: 1.125rem;
            --font-size-lg: 1.35rem;
            --font-size-xl: 2.5rem;
            --font-size-xxl: 3rem;
            --font-size-xxxl: 4rem;

            --border-radius: 12px;
            --transition-speed: 0.3s;
        }

        body {
            font-family: var(--font-family-primary);
            line-height: 1.6;
            color: var(--text-color);
            margin: 0;
            padding: 0;
            background-color: var(--light-gray);
        }

        .container {
            max-width: 1080px;
            margin: 0 auto;
            padding: 0 var(--spacing-md);
        }

        /* --- HERO SECTION: Specific to the Alphabet Level --- */
        .hero-section {
            /* Usamos solo un color base sólido para que el overlay de la imagen sea el que dé el toque de color */
            background-color: #1e3a8a; 
            padding: var(--spacing-xl) 0;
            color: var(--white);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            min-height: 300px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Nuevo elemento: La capa de color que asegura el contraste */
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Utilizamos la variable de color azul oscuro semitransparente */
            background-color: var(--dark-blue-overlay); 
            z-index: 1;
        }

        .hero-logo {
            display: none;
        }

        .hero-text {
            text-align: center;
            width: 100%;
            position: relative; /* Asegura que el texto esté sobre la capa (z-index: 2) */
            z-index: 2; 
        }

        .hero-text h2 {
            font-size: var(--font-size-xxl);
            font-weight: 800;
            color: var(--secondary-yellow);
            margin-bottom: var(--spacing-sm);
        }

        .hero-text h3 {
            font-size: var(--font-size-lg);
            font-weight: 600;
            margin-bottom: var(--spacing-md);
        }

        .hero-text p {
            font-size: var(--font-size-md);
            max-width: 700px;
            margin: 0 auto var(--spacing-xl);
        }
        /* --- END HERO SECTION --- */
        
        /* --- PROGRESS CIRCLE: Focused on the specific level --- */
        .progress-and-intro-container {
            padding: var(--spacing-xl) 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .progress-info {
            margin-top: var(--spacing-lg);
            padding: var(--spacing-lg);
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .progress-info h4 {
            font-size: var(--font-size-md);
            color: var(--primary-blue);
            margin-bottom: var(--spacing-sm);
            font-weight: 700;
        }

        .progress-info p {
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
            margin: 0;
        }

        .progress-circle-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin-bottom: var(--spacing-md);
        }

        .progress-circle {
            width: 100%;
            height: 100%;
            transform: rotate(-90deg);
        }

        .progress-circle-bg {
            stroke: var(--medium-gray);
            stroke-width: 10;
            fill: none;
        }

        .progress-circle-bar {
            stroke: var(--success-color); /* Color de progreso */
            stroke-width: 10;
            stroke-linecap: round;
            fill: none;
            transition: stroke-dashoffset 1s ease-out;
        }

        .progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: var(--font-size-md);
            font-weight: 800;
            color: var(--success-color);
        }

        .section-header {
            margin-bottom: var(--spacing-lg);
            text-align: center;
        }

        .section-header h2 {
            color: var(--primary-orange);
            font-size: var(--font-size-xl);
            text-transform: uppercase;
        }

        /* --- CARDS: Mini-Game Cards --- */
        .main-game-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--spacing-lg);
            padding-bottom: var(--spacing-xl);
        }

        .game-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
            cursor: pointer;
            border-top: 5px solid var(--primary-orange);
            text-align: center;
            padding: var(--spacing-lg);
        }

        .game-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            border-top-color: var(--primary-blue);
        }

        .game-card .icon {
            font-size: 3rem;
            margin-bottom: var(--spacing-sm);
            display: block;
        }

        .game-card h3 {
            font-size: var(--font-size-lg);
            color: var(--dark-gray);
            font-weight: 700;
            margin-bottom: var(--spacing-sm);
        }

        .game-card p {
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
        }

        /* Colores de Icono Específicos */
        .game-card.game-1 .icon { color: #f94144; } /* Rojo */
        .game-card.game-2 .icon { color: #f8961e; } /* Naranja */
        .game-card.game-3 .icon { color: #43aa8b; } /* Verde */
        .game-card.game-4 .icon { color: #277da1; } /* Azul */


        /* --- Modal Styles (para resultados) --- */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.85); /* Fondo más oscuro para enfoque */
            display: none; /* Oculto por defecto */
            justify-content: center;
            align-items: center;
            z-index: 1000;
            animation: fadeIn 0.3s ease-out;
        }

        .modal-content {
            background-color: var(--white);
            border-radius: var(--border-radius);
            padding: var(--spacing-xl);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            max-width: 450px;
            width: 90%;
            text-align: center;
            position: relative;
            animation: slideIn 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            border-bottom: 5px solid var(--primary-blue);
        }

        .modal-icon {
            font-size: var(--font-size-xxl);
            margin-bottom: var(--spacing-md);
            display: block;
        }

        .modal-content h3 {
            font-size: var(--font-size-lg);
            font-weight: 800;
            margin-bottom: var(--spacing-sm);
        }

        .modal-content p {
            font-size: var(--font-size-md);
            margin-bottom: var(--spacing-lg);
            color: var(--dark-gray);
        }

        .modal-footer button {
            background-color: var(--primary-blue);
            color: var(--white);
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: var(--font-size-md);
            font-weight: 600;
            cursor: pointer;
            transition: background-color var(--transition-speed), transform var(--transition-speed);
        }

        .modal-footer button:hover {
            background-color: #1e5ac0; /* Azul más oscuro */
            transform: translateY(-1px);
        }
        
        /* Colores de estado del modal */
        .modal-content.success .modal-icon {
            color: var(--success-color); /* Verde */
        }
        .modal-content.info .modal-icon {
            color: var(--secondary-yellow); /* Amarillo/Naranja para la info de "no mejoró" */
        }
        .modal-content.error .modal-icon {
            color: var(--primary-orange); /* Naranja/Rojo para errores de servidor */
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(-50px) scale(0.9); }
            to { transform: translateY(0) scale(1); }
        }

        /* Responsive adjustments */
        @media (min-width: 768px) {
            .hero-text {
                text-align: left;
            }
            .progress-and-intro-container {
                flex-direction: row;
                text-align: left;
                justify-content: space-between;
                align-items: center;
                padding-bottom: var(--spacing-xxl);
            }
            .main-game-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .progress-info {
                max-width: 60%;
                box-shadow: none;
                background: transparent;
                padding-left: var(--spacing-xl);
            }
            .progress-circle-container {
                margin-bottom: 0;
            }
        }
        /* Responsive para el modal */
        @media (max-width: 480px) {
            .modal-content {
                padding: var(--spacing-lg);
            }
            .modal-content h3 {
                font-size: var(--font-size-md);
            }
            .modal-content p {
                font-size: var(--font-size-sm);
            }
            .modal-footer button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>
    <main>
        <section class="hero-section">
            <div class="container hero-content">
                <div class="hero-text">
                    <h2>NIVEL 1: EL ABECEDARIO</h2>
                    <h3>¡Consolida las 27 señas del alfabeto LESSA con nuestros mini-juegos!</h3>
                    <p>La dactilología es la base de la comunicación en Señas. Estos juegos te ayudarán a memorizar la
                        forma correcta de cada letra y a aumentar tu velocidad de deletreo. ¡Completa los 4 desafíos para
                        dominar el nivel!</p>
                </div>
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
            <div class="progress-and-intro-container">
                <div class="progress-circle-container" data-progress="{{ $progresoPorcentaje }}">
                    <svg class="progress-circle" viewBox="0 0 80 80">
                        <circle class="progress-circle-bg" cx="40" cy="40" r="35"></circle>
                        <circle class="progress-circle-bar" cx="40" cy="40" r="35"></circle>
                    </svg>
                    <span class="progress-text" id="progress-percent"></span>
                </div>
                <div class="progress-info">
                    <h4>PROGRESO DEL NIVEL</h4>
                    <p><strong>Has completado {{ $completado }} de {{ $totalNiveles }} mini-juegos.</strong> Sigue practicando para seguir afinando tus habilidades en dactilología con
                        LESSA. ¡Cada juego cuenta!</p>
                </div>
            </div>
            <section class="learn-sections">
                <div class="section-header">
                    <h2>Mini-Juegos de Dactilología</h2>
                </div>
                <div class="learn-sections-layout">
                    <div class="main-game-grid">
                        <div class="game-card game-1" onclick="window.location.href='/practicar/abecedario/adivina'">
                            <span class="icon">🔍</span>
                            <h3>Adivina la Letra</h3>
                            <p>Se te mostrará una seña y deberás identificar la letra correcta entre múltiples opciones.
                                ¡Rapidez y precisión!</p>
                        </div>
                        <div class="game-card game-2" onclick="window.location.href='/practicar/abecedario/memorama'">
                            <span class="icon">⚡</span>
                            <h3>Memorama de señas</h3>
                            <p>Encuentra pares de cartas: imagen de la seña y el gesto correspondiente. Fortalece tu capacidad
                                de reconocimiento y memoria visual.</p>
                        </div>
                        <div class="game-card game-3" onclick="window.location.href='/practicar/abecedario/conecta'">
                            <span class="icon">🧠</span>
                            <h3>Conecta</h3>
                            <p>Conecta la imagen de la seña y la letra escrita. Fortalece tu memoria
                                visual a largo plazo.</p>
                        </div>
                        <div class="game-card game-4" onclick="window.location.href='/practicar/abecedario/extra'">
                            <span class="icon">✍️</span>
                            <h3>Trazado de Señas</h3>
                            <p>Sigue el movimiento guiado de la seña en pantalla con tu mano (o simulación de gesto).
                                Enfocado en la producción correcta.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <div id="result-modal" class="modal-overlay">
        <div class="modal-content" id="modal-content-area">
            <div class="modal-icon" id="modal-icon"></div>
            <h3 id="modal-title-display"></h3>
            <p id="modal-message-display"></p>
            <div class="modal-footer">
                <button onclick="window.location.href='{{ route('nivel.abecedario') }}'">
                    <i class="fas fa-arrow-left"></i> Volver a Mini-Juegos
                </button>
            </div>
        </div>
    </div>

    <footer>@include('partials.footer')</footer>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuración del Círculo de Progreso
            const progressContainer = document.querySelector('.progress-circle-container');
            const progressCircleBar = document.querySelector('.progress-circle-bar');
            const progressText = document.getElementById('progress-percent');
            
            // Obtenemos el progreso calculado en el backend (75 en este caso)
            const currentProgress = parseInt(progressContainer.getAttribute('data-progress'), 10);
            
            // Obtenemos el radio del SVG (r="35")
            const radius = progressCircleBar.r.baseVal.value;
            // Calculamos la circunferencia real: 2 * PI * r
            const circumference = 2 * Math.PI * radius; 

            // Aplicamos la circunferencia como el stroke-dasharray
            progressCircleBar.style.strokeDasharray = circumference;

            // Calculamos el offset: Circunferencia - (Porcentaje / 100) * Circunferencia
            // Para 75% -> offset = circumference - (0.75 * circumference) = 0.25 * circumference
            const offset = circumference - (currentProgress / 100) * circumference;

            // Establecemos el offset y el texto.
            progressCircleBar.style.strokeDashoffset = offset;
            progressText.textContent = currentProgress + '%';

            // Opcional: El timeout que estaba para la transición de animación
            setTimeout(() => {
                progressCircleBar.style.strokeDashoffset = offset;
            }, 500); 

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

                // Define el icono basado en el tipo de mensaje (usando Emojis)
                if (type === 'success') {
                    modalIcon.innerHTML = '🏆'; // Éxito: Nueva mejor marca o igual
                } else if (type === 'info') {
                    modalIcon.innerHTML = '🧠'; // Info: Sacó menos puntaje que antes, debe practicar
                } else if (type === 'error') {
                    modalIcon.innerHTML = '❌'; // Error: Fallo al guardar en el servidor
                }
                
                // Muestra el modal
                resultModal.style.display = 'flex';
            }

            // 1. Manejo de mensajes de éxito, info y error desde el controlador
            
            // Obtener el mensaje completo que viene en el flash data
            const successMessage = "{{ session('success') }}";
            const infoMessage = "{{ session('info') }}";
            const errorMessage = "{{ session('error') }}";

            if (successMessage) {
                // Para éxito (nueva marca o igual): Usamos el mensaje completo del controlador
                showResultModal('success', '¡Progreso Guardado!', successMessage);
            } else if (infoMessage) {
                // Para info (sacó menos puntaje): Usamos el mensaje completo del controlador
                showResultModal('info', '¡Bien Hecho!', infoMessage);
            } else if (errorMessage) {
                // Para errores (fallo de servidor/DB): Usamos el mensaje completo del controlador
                showResultModal('error', '¡Error al Guardar!', errorMessage);
            }
        });
    </script>
</body>

</html>