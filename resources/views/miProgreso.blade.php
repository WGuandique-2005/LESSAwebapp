<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Progreso - LESSA</title>
    <style>
        :root {
            --bg-dark: #0A2463;
            --bg-light-dark: #1D3557;
            --progress-bg: rgba(255, 255, 255, 0.15); /* Más visible */
            --progress-fill: #4CB944; /* Verde */
            --progress-fill-gradient: linear-gradient(90deg, #38A3A5 0%, #4CB944 100%); /* Degradado moderno */
            --accent-btn: #FFD166; /* Amarillo */
            --primary-text: #fff;
            --secondary-text: rgba(255, 255, 255, 0.7);
            --card-hover: rgba(255, 255, 255, 0.15); /* Nuevo: Estado hover más suave */
            --icon-color: #FFD166; /* Nuevo: Color de íconos */
        }

        body {
            margin: 0;
            font-family: "Segoe UI", sans-serif;
            background: linear-gradient(180deg, var(--bg-dark) 0%, var(--bg-light-dark) 100%);
            color: var(--primary-text);
            min-height: 100vh;
        }

        .hero {
            text-align: center;
            padding: 50px 20px 40px;
            background: #011B40;
            border-bottom: 3px solid var(--accent-btn);
        }

        .hero h1 {
            font-size: 36px; /* Más grande */
            margin-bottom: 10px;
            font-weight: 800; /* Más audaz */
        }

        .hero p {
            font-size: 18px; /* Más legible */
            color: var(--secondary-text);
            margin-bottom: 30px;
        }

        .progress-container {
            background: var(--bg-dark);
            border-radius: 20px; /* Bordes ligeramente más suaves */
            padding: 40px; /* Más padding */
            max-width: 1000px; /* Ancho máximo aumentado */
            margin: 40px auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .section-title {
            font-size: 26px; /* Más énfasis */
            font-weight: 800;
            margin-bottom: 30px;
            text-align: left; /* Alineado a la izquierda */
            border-left: 5px solid var(--accent-btn);
            padding-left: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Progreso General */
        .overall-progress {
            margin-bottom: 50px;
            padding: 20px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.05); /* Fondo sutil para el bloque de progreso */
        }

        .overall-progress h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--accent-btn);
        }

        .progress-bar-wrapper {
            background: var(--progress-bg);
            height: 16px; /* Barra más gruesa */
            border-radius: 8px;
            overflow: hidden;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .progress-bar {
            height: 100%;
            background: var(--progress-fill-gradient); /* Usar degradado */
            transition: width 0.6s ease-in-out;
            position: relative;
        }
        
        /* Efecto de brillo sutil en la barra */
        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
        }

        .progress-text {
            font-size: 16px;
            text-align: right;
            margin-top: 10px;
            font-weight: 700;
            color: var(--progress-fill);
        }

        /* Listas y Tarjetas */
        .lessons-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Más flexible */
            gap: 20px; /* Más espacio */
        }

        .lesson-item {
            background: rgba(255, 255, 255, 0.08);
            padding: 20px;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: transform 0.2s ease, background 0.3s ease;
            border: 1px solid transparent; /* Para un efecto de borde al hacer hover */
        }

        .lesson-item:hover {
            transform: translateY(-5px); /* Efecto 3D sutil */
            background: var(--card-hover);
            border: 1px solid var(--accent-btn);
        }

        .lesson-name {
            font-weight: 700;
            font-size: 18px; /* Título más prominente */
            color: var(--primary-text);
        }

        .completion-date {
            font-size: 14px;
            color: var(--secondary-text);
        }

        .no-lessons {
            text-align: center;
            padding: 30px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            border: 1px dashed rgba(255, 255, 255, 0.2);
        }

        .start-btn {
            display: inline-block;
            background: var(--accent-btn);
            color: var(--bg-dark);
            padding: 12px 25px; /* Más padding para el botón */
            border-radius: 10px; /* Bordes más suaves */
            text-decoration: none;
            font-weight: 800;
            font-size: 16px;
            margin-top: 20px;
            transition: background 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 10px rgba(255, 209, 102, 0.4);
        }

        .start-btn:hover {
            background: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 255, 255, 0.5);
        }

        /* Recompensa */
        .reward-item {
            display: flex; /* Nuevo: usar flexbox para alinear contenido */
            align-items: center;
            gap: 20px;
            background: rgba(255, 255, 255, 0.08);
            padding: 20px;
            border-radius: 16px;
            transition: transform 0.2s ease, background 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .reward-item:hover {
            transform: translateY(-5px);
            background: var(--card-hover);
            border: 1px solid var(--accent-btn);
        }
        
        .reward-content {
            flex-grow: 1; /* Nuevo: contenido flexible */
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .reward-name {
            font-weight: 800;
            font-size: 18px;
            color: var(--primary-text);
        }
        
        .reward-status {
            font-size: 12px;
            font-weight: 700;
            padding: 5px 10px;
            border-radius: 20px; /* Cápsula */
            display: inline-block;
            margin-top: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-unlocked {
            background: var(--progress-fill);
            color: var(--bg-dark);
        }

        .status-locked {
            background: #e74c3c; /* Rojo */
            color: var(--primary-text);
        }
        
        .reward-image-wrapper {
            width: 80px; /* Tamaño fijo para la imagen/ícono */
            min-width: 80px;
            height: 80px;
            border-radius: 12px;
            overflow: hidden;
            border: 3px solid var(--accent-btn); /* Borde de acento */
        }

        .reward-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        
        /* Contenedor de Minijuegos y Lecciones con margen superior */
        .completed-lessons, .completed-levels {
            margin-top: 60px; 
        }


        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.85); /* Fondo más oscuro */
            backdrop-filter: blur(5px); /* Desenfoque de fondo para UX */
        }

        .modal-content {
            background-color: var(--bg-dark);
            margin: 10% auto; /* Subir un poco */
            padding: 40px;
            border: 2px solid var(--accent-btn);
            width: 90%;
            max-width: 450px;
            border-radius: 24px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
            animation-name: animatetop;
            animation-duration: 0.5s;
        }

        @keyframes animatetop {
            from {top: -100px; opacity: 0}
            to {top: 10%; opacity: 1} /* La animación termina en 10% de margen superior */
        }

        .close-btn {
            color: var(--secondary-text);
            float: right;
            font-size: 32px;
            font-weight: bold;
            line-height: 1; /* Mejor alineación */
        }

        .close-btn:hover,
        .close-btn:focus {
            color: var(--primary-text);
            text-decoration: none;
            cursor: pointer;
            transform: rotate(90deg); /* Efecto visual al cerrar */
            transition: transform 0.3s ease;
        }

        .modal-img {
            width: 120px; /* Más grande */
            height: 120px;
            margin-bottom: 25px;
            border-radius: 50%;
            border: 4px solid var(--accent-btn);
            object-fit: cover;
        }

        .modal-title {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 15px;
            color: var(--accent-btn);
        }

        .modal-desc {
            font-size: 16px;
            color: var(--secondary-text);
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .modal-btn {
            background: var(--accent-btn);
            color: var(--bg-dark);
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-weight: 800;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .modal-btn:hover:not(:disabled) {
            background: #fff;
            transform: translateY(-2px);
        }
        
        .modal-btn:disabled {
            cursor: not-allowed;
            opacity: 0.7;
            box-shadow: none;
        }
        
        .completion-date-modal { /* Estilo específico para la fecha/puntos en el modal */
             font-size: 15px;
             font-weight: 600;
             margin-top: -5px;
             margin-bottom: 20px;
             color: var(--progress-fill);
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
            <div class="overall-progress" style="margin-bottom: 30px;">
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
                                <span style="color: var(--progress-fill);">✓</span> Completado el: {{ \Carbon\Carbon::parse($progreso->fecha_completada)->format('d/m/Y') }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>


        <div class="completed-levels">
            <h3 class="section-title">🎮 Minijuegos Completados (Niveles)</h3>
            
            <div class="overall-progress" style="margin-bottom: 30px;">
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
                                <span style="color: var(--accent-btn);">🏆</span> Puntos obtenidos: {{ $nivel->puntos_obtenidos }}
                            </span>
                            <span class="completion-date">
                                Finalizado el: {{ \Carbon\Carbon::parse($nivel->fecha_finalizado)->format('d/m/Y') }}
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
                            $actionUrl = route('desbloquear.recompensa', $recompensa->id);
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
                                <span class="completion-date">Requiere: {{ $recompensa->puntos_req }} puntos</span>
                                <span class="reward-status {{ $statusClass }}">{{ $statusText }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

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
    </div>
    <footer>@include('partials.footer')</footer>
<script>
        const modal = document.getElementById('rewardModal');
        const modalTitle = document.getElementById('modal-title');
        const modalDesc = document.getElementById('modal-desc');
        const modalPuntos = document.getElementById('modal-puntos');
        const modalImg = document.getElementById('modal-img');
        const modalBtn = document.getElementById('modal-btn');
        let currentRewardId = null;

        function openRewardModal(element) {
            const id = element.getAttribute('data-id');
            const nombre = element.getAttribute('data-nombre');
            const descripcion = element.getAttribute('data-descripcion');
            const puntos = element.getAttribute('data-puntos');
            const url = element.getAttribute('data-url');
            // Cambiado a '1' para mejor compatibilidad con booleanos en JS
            const unlocked = element.getAttribute('data-unlocked') === '1'; 

            currentRewardId = id;

            modalTitle.textContent = nombre;
            modalDesc.textContent = descripcion;
            modalPuntos.textContent = 'Requiere: ' + puntos + ' puntos';
            modalImg.src = url;

            // Lógica de botón más clara y con colores UX
            if (unlocked) {
                modalBtn.textContent = '¡Recompensa Desbloqueada!';
                modalBtn.disabled = true;
                modalBtn.style.backgroundColor = 'var(--progress-fill)'; // Verde
                modalBtn.style.color = 'var(--bg-dark)';
            } else {
                modalBtn.textContent = 'Intentar Desbloquear';
                modalBtn.disabled = false;
                modalBtn.style.backgroundColor = 'var(--accent-btn)'; // Amarillo
                modalBtn.style.color = 'var(--bg-dark)';
            }

            modal.style.display = 'block';
        }

        function closeRewardModal() {
            modal.style.display = 'none';
            currentRewardId = null;
        }

        function claimReward() {
            if (currentRewardId) {
                // Redirigir a la ruta de Laravel para intentar el desbloqueo
                // Nota: se recomienda usar el helper route() de Blade para generar URLs
                // Esto es solo un placeholder si no se puede usar el helper aquí.
                window.location.href = `/recompensas/desbloquear/${currentRewardId}`;
            }
        }

        // Cierra el modal si el usuario hace clic fuera de él
        window.onclick = function(event) {
            if (event.target == modal) {
                closeRewardModal();
            }
        }
    </script>
</body>

</html>