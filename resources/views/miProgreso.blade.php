<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Progreso - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        /*
        * ----------------------------------------------------
        * 1. Variables y Reset Básico
        * ----------------------------------------------------
        */
        :root {
            --bg-dark: #0A2463; /* Azul Oscuro Principal */
            --bg-light-dark: #1D3557; /* Azul Oscuro Secundario (degradado) */
            --progress-bg: rgba(255, 255, 255, 0.1); /* Fondo de barra de progreso más sutil */
            --progress-fill: #4CB944; /* Verde de Progreso */
            --progress-fill-gradient: linear-gradient(90deg, #38A3A5 0%, #4CB944 100%); /* Degradado Moderno */
            --accent-btn: #FFD166; /* Amarillo de Acción/Acento */
            --primary-text: #fff;
            --secondary-text: rgba(255, 255, 255, 0.65); /* Más contraste */
            --card-bg: rgba(255, 255, 255, 0.05); /* Fondo de tarjeta base */
            --card-hover: rgba(255, 255, 255, 0.15); /* Fondo de tarjeta en hover */
            --card-border: rgba(255, 255, 255, 0.2); /* Borde sutil */
            --icon-color: #FFD166; /* Color de Íconos */
            /* Status Colors */
            --status-success: var(--progress-fill);
            --status-locked: #e74c3c;
            --status-info: #3498db;
            --status-error: #c0392b;
            
            /* Sombra sutil para el dark mode (Neumorfismo oscuro) */
            --shadow-primary: 0 4px 10px rgba(0, 0, 0, 0.3);
            --shadow-card: 0 8px 15px rgba(0, 0, 0, 0.4);
            --shadow-hover: 0 12px 20px rgba(0, 0, 0, 0.5);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            /* Usar Inter como fuente principal */
            font-family: 'Inter', "Segoe UI", sans-serif; 
            background: linear-gradient(180deg, var(--bg-dark) 0%, var(--bg-light-dark) 100%);
            color: var(--primary-text);
            min-height: 100vh;
            line-height: 1.6;
        }

        /*
        * ----------------------------------------------------
        * 2. Hero y Estructura Principal
        * ----------------------------------------------------
        */
        .hero {
            text-align: center;
            padding: 40px 20px 30px; /* Reducción de padding para ahorrar espacio en móvil */
            background: #011B40;
            border-bottom: 3px solid var(--accent-btn);
            box-shadow: var(--shadow-primary);
        }

        .hero h1 {
            font-size: clamp(28px, 6vw, 40px); /* Título responsivo */
            margin-bottom: 8px;
            font-weight: 800;
        }

        .hero p {
            font-size: clamp(16px, 4vw, 19px);
            color: var(--secondary-text);
            margin-bottom: 25px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .progress-container {
            padding: 20px; /* Padding reducido para móvil */
            max-width: 1200px; /* Ancho máximo aumentado para escritorio */
            margin: 30px auto;
        }
        
        @media (min-width: 768px) {
            .progress-container {
                padding: 40px;
            }
        }

        .section-title {
            font-size: clamp(22px, 5vw, 28px);
            font-weight: 800;
            margin-bottom: 30px;
            text-align: left;
            border-left: 5px solid var(--accent-btn);
            padding-left: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--accent-btn); /* Color de acento para el título */
        }
        
        .completed-lessons, .completed-levels, .rewards {
             margin-top: 50px; 
        }


        /*
        * ----------------------------------------------------
        * 3. Progreso General y Barras
        * ----------------------------------------------------
        */
        .overall-progress {
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 14px;
            background: var(--card-bg); 
            box-shadow: var(--shadow-primary);
        }

        .overall-progress h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--primary-text);
            text-transform: uppercase;
        }

        .progress-bar-wrapper {
            background: var(--progress-bg);
            height: 14px; 
            border-radius: 7px;
            overflow: hidden;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.4); /* Sombra interior para profundidad */
        }

        .progress-bar {
            height: 100%;
            background: var(--progress-fill-gradient); 
            transition: width 0.6s ease-in-out;
            border-radius: 7px;
        }
        
        .progress-text {
            font-size: 15px;
            text-align: right;
            margin-top: 8px;
            font-weight: 700;
            color: var(--progress-fill);
        }

        /*
        * ----------------------------------------------------
        * 4. Listas y Tarjetas (Lecciones y Recompensas)
        * ----------------------------------------------------
        */
        .lessons-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            /* Grid dinámico: 1 columna en móvil, 2 en tabletas, 3 en escritorio */
            grid-template-columns: 1fr; 
            gap: 15px;
        }
        
        @media (min-width: 600px) {
            .lessons-list {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 20px;
            }
        }

        .lesson-item {
            background: var(--card-bg);
            padding: 18px;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            transition: transform 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
            box-shadow: var(--shadow-card);
            border-left: 5px solid var(--progress-fill); /* Indicador visual de progreso */
        }
        
        /* Estilo para items de minijuegos */
        .completed-levels .lesson-item {
             border-left: 5px solid var(--accent-btn);
        }

        .lesson-item:hover {
            transform: translateY(-3px); 
            background: var(--card-hover);
            box-shadow: var(--shadow-hover);
        }

        .lesson-name {
            font-weight: 800;
            font-size: 17px; 
            color: var(--primary-text);
            margin-bottom: 5px;
        }

        .completion-date {
            font-size: 13px;
            color: var(--secondary-text);
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .completion-date > span {
            font-size: 16px; /* Ajuste para los iconos */
        }

        .no-lessons {
            text-align: center;
            padding: 30px;
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px dashed var(--card-border);
            box-shadow: var(--shadow-primary);
        }
        
        /* Recompensa Card */
        .reward-item {
            background: var(--card-bg);
            padding: 15px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: transform 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            box-shadow: var(--shadow-card);
            border-left: 5px solid var(--accent-btn); 
        }

        .reward-item:hover {
            transform: translateY(-3px);
            background: var(--card-hover);
            box-shadow: var(--shadow-hover);
            border-left: 5px solid var(--progress-fill); /* Cambio de color en hover */
        }
        
        .reward-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .reward-name {
            font-weight: 800;
            font-size: 17px;
            color: var(--primary-text);
        }
        
        .reward-status {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 16px;
            display: inline-block;
            margin-top: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            align-self: flex-start; /* Se alinea a la izquierda dentro del flex-column */
        }

        .status-unlocked {
            background: var(--progress-fill);
            color: var(--bg-dark);
        }

        .status-locked {
            background: var(--status-locked); 
            color: var(--primary-text);
        }
        
        .reward-image-wrapper {
            width: 60px; /* Tamaño reducido para mejor integración en móvil */
            min-width: 60px;
            height: 60px;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid var(--accent-btn);
        }

        .reward-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        
        @media (min-width: 600px) {
            .reward-image-wrapper {
                width: 70px; 
                min-width: 70px;
                height: 70px;
            }
        }
        
        /*
        * ----------------------------------------------------
        * 5. Botones (CTA)
        * ----------------------------------------------------
        */
        .start-btn {
            display: inline-block;
            background: var(--accent-btn);
            color: var(--bg-dark);
            padding: 10px 20px; 
            border-radius: 8px; 
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            margin-top: 15px;
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(255, 209, 102, 0.4);
            border: none;
        }

        .start-btn:hover {
            background: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 255, 255, 0.5);
        }
        
        .modal-btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 15px;
            box-shadow: var(--shadow-primary);
        }
        
        /*
        * ----------------------------------------------------
        * 6. Modales
        * ----------------------------------------------------
        */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.88); 
            backdrop-filter: blur(8px); /* Desenfoque más fuerte */
            transition: background-color 0.3s ease;
        }

        .modal-content {
            background-color: var(--bg-dark);
            margin: 15% auto; /* Ajuste para el centrado vertical */
            padding: 30px;
            border: 2px solid var(--accent-btn);
            width: 95%;
            max-width: 400px; /* Reducción de tamaño máximo para un modal más centrado */
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.7);
            animation-name: animatetop;
            animation-duration: 0.4s;
            position: relative;
        }

        @keyframes animatetop {
            from {top: -150px; opacity: 0}
            to {top: 15%; opacity: 1} 
        }
        
        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            color: var(--secondary-text);
            font-size: 30px;
            font-weight: bold;
            line-height: 1;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: var(--primary-text);
            cursor: pointer;
            transform: rotate(90deg) scale(1.1); 
        }

        .modal-img {
            width: 100px; 
            height: 100px;
            margin-bottom: 20px;
            border-radius: 50%;
            border: 3px solid var(--accent-btn);
            object-fit: cover;
        }

        .modal-title {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 10px;
            color: var(--accent-btn);
        }

        .modal-desc {
            font-size: 15px;
            color: var(--secondary-text);
            margin-bottom: 20px;
            line-height: 1.4;
        }

        .completion-date-modal { 
             font-size: 14px;
             font-weight: 600;
             margin-top: -5px;
             margin-bottom: 15px;
             color: var(--progress-fill);
        }
        
        .result-modal-title {
            font-size: 26px;
        }
        
        .result-modal-message {
            font-size: 16px;
            margin-bottom: 25px;
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header> 
    <div class="hero">
        <h1>🎯 Tu Progreso en LESSA</h1>
        <p>Mide tu aprendizaje, repasa tus logros y prepárate para ganar recompensas. ✨</p>
        <a href="{{ route('lecciones') }}" class="start-btn">Seguir Aprendiendo →</a>
    </div>

    <div class="progress-container">
        
        <div class="overall-progress">
            <h3>Progreso General de la Plataforma</h3>
            <div class="progress-bar-wrapper">
                <div class="progress-bar" style="width: {{ $porcentaje }}%;"></div>
            </div>
            <div class="progress-text">{{ $porcentaje }}% Completado</div>
        </div>

        <div class="completed-lessons">
            <h3 class="section-title">📚 Lecciones Completadas</h3>
            <div class="overall-progress" style="margin-bottom: 30px; padding: 15px;">
                <h3>Progreso de Lecciones</h3>
                <div class="progress-bar-wrapper">
                    <div class="progress-bar" style="width: {{ $porcentajeLecciones }}%;"></div> 
                </div>
                <div class="progress-text">{{ $porcentajeLecciones }}% Completado</div>
            </div>
            
            @if ($leccionesCompletadas->isEmpty())
                <div class="no-lessons">
                    <p>Aún no has completado ninguna lección. ¡Comienza a aprender hoy mismo! ✨</p>
                    <a href="{{ route('lecciones') }}" class="start-btn">Explorar Lecciones →</a>
                </div>
            @else
                <ul class="lessons-list">
                    @foreach ($leccionesCompletadas as $progreso)
                        <li class="lesson-item">
                            <span class="lesson-name">{{ $progreso->leccion->titulo }}</span>
                            <span class="completion-date">
                                <span style="color: var(--progress-fill);">✅</span> Completado el: {{ \Carbon\Carbon::parse($progreso->fecha_completada)->format('d/m/Y') }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="completed-levels">
            <h3 class="section-title">🎮 Minijuegos Completados</h3>
            
            <div class="overall-progress" style="margin-bottom: 30px; padding: 15px;">
                <h3>Progreso de Minijuegos</h3>
                <div class="progress-bar-wrapper">
                    <div class="progress-bar" style="width: {{ $porcentajeNiveles }}%;"></div> 
                </div>
                <div class="progress-text">{{ $porcentajeNiveles }}% Completado</div>
            </div>

            @if ($nivelesCompletados->isEmpty())
                <div class="no-lessons">
                    <p>Aún no has completado ningún minijuego. ¡Demuestra tu dominio! 💪</p>
                    <a href="{{ route('practicar') }}" class="start-btn">Explorar Minijuegos →</a>
                </div>
            @else
                <ul class="lessons-list">
                    @foreach ($nivelesCompletados as $nivel)
                        <li class="lesson-item">
                            <span class="lesson-name">{{ $nivel->nombre }}</span>
                            <span class="completion-date">
                                <span style="color: var(--accent-btn);">⭐</span> Puntos obtenidos: {{ $nivel->puntos_obtenidos }}
                            </span>
                            <span class="completion-date">
                                <span style="color: var(--progress-fill);">🗓️</span> Finalizado el: {{ \Carbon\Carbon::parse($nivel->fecha_finalizado)->format('d/m/Y') }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="rewards">
            <h3 class="section-title">🏅 Tus Recompensas</h3>
            @php
                use App\Models\Recompensa;
                use App\Models\RecompensasUsuario;
                $recompensas = Recompensa::all();
                $recompensasDesbloqueadas = auth()->user() 
                    ? RecompensasUsuario::where('usuario_id', auth()->user()->id)->pluck('recompensa_id')->toArray() 
                    : [];
            @endphp
            
            @if ($recompensas->isEmpty())
                <div class="no-lessons">
                    <p>Muy pronto podrás desbloquear logros y recompensas por tu progreso en LESSA.</p>
                </div>
            @else
                <ul class="lessons-list">
                    @foreach ($recompensas as $recompensa)
                        @php
                            $isUnlocked = in_array($recompensa->id, $recompensasDesbloqueadas);
                            $statusClass = $isUnlocked ? 'status-unlocked' : 'status-locked';
                            $statusText = $isUnlocked ? '¡Desbloqueada!' : 'Bloqueada';
                            // La acción se maneja en JS
                        @endphp
                        <li class="reward-item"
                            data-id="{{ $recompensa->id }}"
                            data-nombre="{{ $recompensa->nombre }}"
                            data-descripcion="{{ $recompensa->descripcion }}"
                            data-puntos="{{ $recompensa->puntos_req }}"
                            data-url="{{ asset($recompensa->url_imagen) }}"
                            data-unlocked="{{ $isUnlocked ? 1 : 0 }}"
                            onclick="openRewardModal(this)">
                            
                            <div class="reward-image-wrapper">
                                <img src="{{ asset('' . $recompensa->url_imagen) }}" alt="{{ $recompensa->nombre }}">
                            </div>

                            <div class="reward-content">
                                <span class="reward-name">{{ $recompensa->nombre }}</span>
                                <span class="completion-date">{{ $recompensa->descripcion }}</span>
                                <span class="completion-date">Puntos requeridos: {{ $recompensa->puntos_req }}</span>
                                <span class="reward-status {{ $statusClass }}">{{ $statusText }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Modal de Detalle de Recompensa (EXISTENTE) --}}
        <div id="rewardModal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeRewardModal()">&times;</span>
                <img id="modal-img" class="modal-img" src="" alt="Recompensa">
                <h4 id="modal-title" class="modal-title"></h4>
                <p id="modal-desc" class="modal-desc"></p>
                <p id="modal-puntos" class="completion-date-modal"></p> 
                <button id="modal-btn" class="modal-btn" onclick="claimReward()"></button>
            </div>
        </div>
        
        {{-- Modal de Resultado de Desbloqueo (NUEVO) --}}
        <div id="resultModal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeResultModal()">&times;</span>
                <h4 id="result-modal-title" class="result-modal-title"></h4>
                <p id="result-modal-message" class="result-modal-message"></p>
                <button id="result-modal-btn" class="modal-btn" onclick="handleResultAction()"></button>
            </div>
        </div>
    </div>
    <footer>@include('partials.footer')</footer>
@php
    // Recupera la sesión de forma segura y la valida
    $rewardResult = session('reward_result');
    
    // Si la variable de sesión no es un array (incluyendo null o Closure), la forzamos a null
    if (!is_array($rewardResult)) {
        $rewardResult = null;
    }
@endphp
<script>
        const rewardModal = document.getElementById('rewardModal'); 
        const modalTitle = document.getElementById('modal-title');
        const modalDesc = document.getElementById('modal-desc');
        const modalPuntos = document.getElementById('modal-puntos');
        const modalImg = document.getElementById('modal-img');
        const modalBtn = document.getElementById('modal-btn');
        let currentRewardId = null;

        // Nuevas referencias para el Modal de Resultado
        const resultModal = document.getElementById('resultModal');
        const resultModalTitle = document.getElementById('result-modal-title');
        const resultModalMessage = document.getElementById('result-modal-message');
        const resultModalBtn = document.getElementById('result-modal-btn');
        let currentActionRoute = null; 

        function openRewardModal(element) {
            const id = element.getAttribute('data-id');
            const nombre = element.getAttribute('data-nombre');
            const descripcion = element.getAttribute('data-descripcion');
            const puntos = element.getAttribute('data-puntos');
            const url = element.getAttribute('data-url');
            const unlocked = element.getAttribute('data-unlocked') === '1'; 

            currentRewardId = id;

            modalTitle.textContent = nombre;
            modalDesc.textContent = descripcion;
            modalPuntos.textContent = 'Requiere: ' + puntos + ' puntos';
            modalImg.src = url;

            // Resetear clases de botones
            modalBtn.classList.remove('success', 'locked', 'info', 'error');

            if (unlocked) {
                modalBtn.textContent = '¡Recompensa Desbloqueada!';
                modalBtn.disabled = true;
                modalBtn.classList.add('success'); 
                modalBtn.style.color = 'var(--bg-dark)';
            } else {
                modalBtn.textContent = 'Intentar Desbloquear';
                modalBtn.disabled = false;
                modalBtn.style.backgroundColor = 'var(--accent-btn)'; 
                modalBtn.style.color = 'var(--bg-dark)';
            }

            rewardModal.style.display = 'block';
        }

        function closeRewardModal() {
            rewardModal.style.display = 'none';
            currentRewardId = null;
        }

        function claimReward() {
            if (currentRewardId) {
                // Se asume que esta ruta existe: /recompensas/desbloquear/{id}
                window.location.href = `/recompensas/desbloquear/${currentRewardId}`; 
            }
        }
        
        function closeResultModal() {
            resultModal.style.display = 'none';
            currentActionRoute = null; 
        }

        function handleResultAction() {
            if (currentActionRoute && currentActionRoute !== 'miProgreso') {
                const routeMap = {
                    'lecciones': '{{ route("lecciones") }}',
                    'practicar': '{{ route("practicar") }}',
                };
                
                // Mapeo de rutas (asumiendo que 'nivel.X' o 'lecciones' son las claves)
                let finalUrl = currentActionRoute.includes('nivel.') 
                    ? routeMap['practicar'] || '#'
                    : routeMap[currentActionRoute] || '#';
                    
                window.location.href = finalUrl;
            } else {
                // Si la ruta es 'miProgreso' o nula, solo cierra el modal
                closeResultModal();
            }
        }

        // Cierra el modal si el usuario hace clic fuera de él
        window.onclick = function(event) {
            if (event.target == rewardModal) {
                closeRewardModal();
            }
            if (event.target == resultModal) {
                closeResultModal();
            }
        }

        // --- Lógica para mostrar el modal de resultado al cargar la página ---
        document.addEventListener('DOMContentLoaded', () => {
            
            // Usamos la variable PHP $rewardResult ya validada
            @if (!empty($rewardResult))
                const result = @json($rewardResult);
                const status = result.status;
                const title = result.title;
                let message = result.message;
                const route = result.route;
                
                currentActionRoute = route;

                resultModalTitle.textContent = title;
                resultModalMessage.innerHTML = message; 
                resultModalBtn.classList.remove('success', 'locked', 'info', 'error');

                switch(status) {
                    case 'success':
                        resultModalTitle.style.color = 'var(--status-success)';
                        resultModalBtn.textContent = '¡Ver Recompensas!';
                        resultModalBtn.classList.add('success');
                        resultModalBtn.onclick = () => { closeResultModal(); }; // Al hacer click se queda en la página de progreso
                        break;
                    case 'locked':
                        resultModalTitle.style.color = 'var(--status-locked)';
                        resultModalBtn.textContent = 'Ir a Practicar';
                        resultModalBtn.classList.add('locked');
                        resultModalBtn.onclick = handleResultAction;
                        if (result.puntos_req) {
                            resultModalMessage.innerHTML += `<br><br><strong>Puntos Requeridos:</strong> ${result.puntos_req}`;
                        }
                        break;
                    case 'info': 
                        resultModalTitle.style.color = 'var(--status-info)';
                        resultModalBtn.textContent = 'Entendido';
                        resultModalBtn.classList.add('info');
                        resultModalBtn.onclick = () => { closeResultModal(); }; 
                        break;
                    case 'error':
                    default:
                        resultModalTitle.style.color = 'var(--status-error)';
                        resultModalBtn.textContent = 'Volver al Progreso';
                        resultModalBtn.classList.add('error');
                        resultModalBtn.onclick = handleResultAction;
                        break;
                }
                
                resultModal.style.display = 'block';
            @endif
        });
        
    </script>
</body>

</html>