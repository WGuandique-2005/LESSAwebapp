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
    <title>LESSA - Sección de Aprendizaje</title>
    <style>
        :root {
            --primary-color: #070776;
            --primary-hover: #050558;
            --secondary-color: #e6a717;
            --secondary-hover: #d19416;
            --success-color: #22C55E;
            --error-color: #EF4444;
            --text-color: #1f2937;
            --text-light: #6b7280;
            --bg-color: #f3f4f6;
            --card-bg: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --radius-md: 0.5rem;
            --radius-lg: 1rem;
        }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg-color);
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Layout */
        header {
            z-index: 50;
        }

        main.container {
            flex: 1;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
            position: relative;
            box-sizing: border-box;
        }

        footer {
            margin-top: auto;
            z-index: 50;
        }

        /* Background Shapes */
        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.4;
            filter: blur(40px);
            animation: float 20s infinite linear;
        }

        .shape:nth-child(odd) {
            background: rgba(7, 7, 118, 0.1);
        }

        .shape:nth-child(even) {
            background: rgba(230, 167, 23, 0.15);
        }

        /* Simplified shapes for cleaner look */
        .shape-1 { top: -10%; left: -10%; width: 400px; height: 400px; animation-duration: 25s; }
        .shape-2 { top: 40%; right: -5%; width: 300px; height: 300px; animation-duration: 30s; animation-delay: -5s; }
        .shape-3 { bottom: -10%; left: 20%; width: 350px; height: 350px; animation-duration: 28s; animation-delay: -10s; }
        
        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, 50px) rotate(10deg); }
            66% { transform: translate(-20px, 20px) rotate(-5deg); }
            100% { transform: translate(0, 0) rotate(0deg); }
        }

        /* Learning Section */
        .learning-section {
            position: relative;
            z-index: 1;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 2.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            margin-bottom: 2rem;
        }

        .learning-section h1 {
            color: var(--primary-color);
            margin-top: 0;
            font-size: 2.5rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .learning-section .subtitle {
            color: var(--text-light);
            font-size: 1.25rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 2rem;
        }

        .learning-section .description {
            color: var(--text-color);
            line-height: 1.8;
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto 1.5rem auto;
            text-align: center;
        }

        .learning-section .reminder {
            color: var(--primary-color);
            font-weight: 600;
            text-align: center;
            font-style: italic;
            margin-bottom: 3rem;
        }

        /* Progress Bar */
        .progress-container {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            padding: 1.5rem;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            color: white;
            margin-bottom: 3rem;
            transition: transform 0.2s;
        }

        .progress-container:hover {
            transform: translateY(-2px);
        }

        .progress-container p {
            margin: 0 0 10px 0;
            font-weight: 700;
            font-size: 1.1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .progress-bar-outer {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 9999px;
            height: 12px;
            overflow: hidden;
        }

        .progress-bar-inner {
            background-color: var(--secondary-color);
            height: 100%;
            border-radius: 9999px;
            width: 0%;
            transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 0 10px rgba(230, 167, 23, 0.5);
        }

        /* Cards Grid */
        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            height: 100%;
            cursor: pointer;
            position: relative;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(7, 7, 118, 0.1);
        }

        .card-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
            background-color: #f9fafb;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 0.5s ease;
        }

        .card:hover .card-image img {
            transform: scale(1.05);
        }

        .card-content {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-content h3 {
            margin: 0 0 0.75rem 0;
            color: var(--primary-color);
            font-size: 1.25rem;
            font-weight: 700;
        }

        .card-content p {
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0;
            flex-grow: 1;
        }

        .card-status {
            padding: 1rem 1.5rem;
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .card-status .circle {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid #d1d5db;
            background-color: white;
            transition: all 0.3s;
        }

        .card-status .circle.completed {
            background-color: var(--success-color);
            border-color: var(--success-color);
            box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.2);
        }

        /* Modals */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-backdrop.show {
            opacity: 1;
        }

        .custom-modal {
            background-color: white;
            padding: 2rem;
            border-radius: var(--radius-lg);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            max-width: 450px;
            width: 90%;
            text-align: center;
            transform: scale(0.95);
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .modal-backdrop.show .custom-modal {
            transform: scale(1);
        }

        .modal-icon-container {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }

        .modal-icon-container.success { background-color: rgba(34, 197, 94, 0.1); }
        .modal-icon-container.error { background-color: rgba(239, 68, 68, 0.1); }

        .modal-icon {
            font-size: 40px;
            line-height: 1;
        }

        .modal-icon.success-icon { color: var(--success-color); }
        .modal-icon.error-icon { color: var(--error-color); }

        .modal-body-content h3 {
            margin: 0 0 0.5rem;
            font-size: 1.5rem;
            color: var(--text-color);
        }

        .modal-body-content p {
            margin-bottom: 2rem;
            color: var(--text-light);
            line-height: 1.5;
        }

        .modal-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        @media (min-width: 640px) {
            .modal-actions {
                flex-direction: row;
                justify-content: center;
            }
        }

        .btn-modal-action {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: var(--radius-md);
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-progress {
            background-color: var(--secondary-color);
            color: white;
        }

        .btn-progress:hover {
            background-color: var(--secondary-hover);
            transform: translateY(-1px);
        }

        .btn-continue {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-continue:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .learning-section {
                padding: 1.5rem;
            }
            
            .learning-section h1 {
                font-size: 2rem;
            }
            
            .cards-container {
                grid-template-columns: 1fr;
            }

            .card-image {
                height: 180px;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>
    
    <main class="container">
        <aside class="floating-elements">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </aside>

        <section class="learning-section">
            <h1>Sección de Aprendizaje</h1>
            <p class="subtitle">¡Bienvenido a tu zona de Aprendizaje!</p>
            <p class="description">
                Aquí es donde obtendrás todo el conocimiento teórico en habilidades reales de comunicación. La
                sección de Aprendizaje de LESSA está diseñada para ayudarte a desarrollar tus habilidades iniciales
                en este lenguaje, perfeccionar tus movimientos y obtener contexto de su uso o significados.
            </p>
            <p class="reminder">
                Recuerda: Si nunca lo intentas, ¡nunca sabrás el resultado! ¡Tú puedes!
            </p>

            <div class="progress-container goToProgress" style="cursor: pointer;">
                <p>
                    <span>Progreso de Aprendizaje</span>
                    <span>{{ $progresoPorcentaje }}%</span>
                </p>
                <div class="progress-bar-outer">
                    <div class="progress-bar-inner" style="width: {{ $progresoPorcentaje }}%;"></div>
                </div>
            </div>

            <div class="cards-container">
                <div class="card abecedario">
                    <div class="card-image">
                        <img src="{{ asset('img/abcd.png') }}" alt="Abecedario">
                    </div>
                    <div class="card-content">
                        <h3>Abecedario</h3>
                        <p>Aprenderás las letras del abecedario para poder deletrear tu nombre, siglas u otros usos que descubrirás.</p>
                    </div>
                    <div class="card-status">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="card numeros">
                    <div class="card-image">
                        <img src="{{ asset('img/numbers.png') }}" alt="Números">
                    </div>
                    <div class="card-content">
                        <h3>Números</h3>
                        <p>Aprenderás los números del 1 al 100, cantidades más grandes, así como a contar objetos y hacer preguntas simples.</p>
                    </div>
                    <div class="card-status">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="card saludos">
                    <div class="card-image">
                        <img src="{{ asset('img/saludos.png') }}" alt="Saludos">
                    </div>
                    <div class="card-content">
                        <h3>Saludos y Presentaciones</h3>
                        <p>Aprenderás a comunicar saludos como "Hola", "Buenos días", así como frases para presentarte.</p>
                    </div>
                    <div class="card-status">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="card salud">
                    <div class="card-image">
                        <img src="{{ asset('img/health.png') }}" alt="Salud">
                    </div>
                    <div class="card-content">
                        <h3>Salud y Emergencias</h3>
                        <p>Aprenderás a señalar síntomas básicos, expresar alergias y reconocer lugares de atención médica.</p>
                    </div>
                    <div class="card-status">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </section>

        {{-- MODAL DE ÉXITO --}}
        <div id="successModal" class="modal-backdrop">
            <div class="custom-modal">
                <div class="modal-header">
                     <div class="modal-icon-container success">
                        <div class="modal-icon success-icon">&#10003;</div>
                    </div>
                </div>
                <div class="modal-body-content">
                    <h3 id="successModalTitle">¡Éxito!</h3>
                    <p id="successModalMessage"></p>
                </div>
                <div class="modal-actions">
                    <button class="btn-modal-action btn-continue" onclick="closeModal('successModal')">Seguir en Lecciones</button>
                    <button class="btn-modal-action btn-progress" onclick="window.location.href = '{{ route('miProgreso') }}'">Ver Mi Progreso</button>
                </div>
            </div>
        </div>

        {{-- MODAL DE ERROR --}}
        <div id="errorModal" class="modal-backdrop">
            <div class="custom-modal">
                <div class="modal-header">
                    <div class="modal-icon-container error">
                        <div class="modal-icon error-icon">&#10006;</div>
                    </div>
                </div>
                <div class="modal-body-content">
                    <h3 id="errorModalTitle">Error</h3>
                    <p id="errorModalMessage"></p>
                </div>
                <div class="modal-actions">
                    <button class="btn-modal-action btn-continue" onclick="closeModal('errorModal')">Seguir en Lecciones</button>
                    <button class="btn-modal-action btn-progress" onclick="window.location.href = '{{ route('miProgreso') }}'">Ver Mi Progreso</button>
                </div>
            </div>
        </div>
    </main>

    <footer>@include('partials.footer')</footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ls_abcd = document.querySelector('.abecedario');
            const ls_numeros = document.querySelector('.numeros');
            const ls_saludos = document.querySelector('.saludos');
            const ls_salud = document.querySelector('.salud');
            const goToProgress = document.querySelector('.goToProgress');
            const successModal = document.getElementById('successModal');
            const errorModal = document.getElementById('errorModal');
            const sessionStatus = @json($sessionStatus);
            const sessionError = @json($sessionError);

            goToProgress.addEventListener('click', () => {
                window.location.href = "{{ route('miProgreso') }}";
            });

            // Direccionar a la ruta de la lección
            if(ls_abcd) ls_abcd.addEventListener('click', () => window.location.href = "{{ route('lecciones.abecedario') }}");
            if(ls_numeros) ls_numeros.addEventListener('click', () => window.location.href = "{{ route('lecciones.numeros') }}");
            if(ls_saludos) ls_saludos.addEventListener('click', () => window.location.href = "{{ route('lecciones.saludos') }}");
            if(ls_salud) ls_salud.addEventListener('click', () => window.location.href = "{{ route('lecciones.salud') }}");

            const progressBarInner = document.querySelector('.progress-bar-inner');
            // Animation for progress bar
            setTimeout(() => {
                if(progressBarInner) progressBarInner.style.width = `{{ $progresoPorcentaje }}%`;
            }, 100);

            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                if (index < {{ $completadas }}) {
                    const statusCircle = card.querySelector('.card-status .circle');
                    if(statusCircle) statusCircle.classList.add('completed');
                }
            });

            // Lógica del Modal
            window.closeModal = function(modalId) {
                const modal = document.getElementById(modalId);
                if(modal) {
                    modal.classList.remove('show');
                    setTimeout(() => {
                        modal.style.display = 'none';
                    }, 300); // Wait for transition
                }
            }

            function openModal(modal) {
                modal.style.display = 'flex';
                // Force reflow
                void modal.offsetWidth;
                modal.classList.add('show');
            }

            // Mostrar el modal si hay un mensaje de sesión
            if (sessionStatus) {
                const msgEl = document.getElementById('successModalMessage');
                if(msgEl) msgEl.innerText = sessionStatus;
                if(successModal) openModal(successModal);
            } else if (sessionError) {
                const msgEl = document.getElementById('errorModalMessage');
                if(msgEl) msgEl.innerText = sessionError;
                if(errorModal) openModal(errorModal);
            }

            // Cierra el modal al hacer click fuera de él
            window.onclick = function(event) {
                if (event.target == successModal) {
                    closeModal('successModal');
                }
                if (event.target == errorModal) {
                    closeModal('errorModal');
                }
            }
        });
    </script>
</body>
</html>