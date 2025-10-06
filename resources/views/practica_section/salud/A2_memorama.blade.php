@php
    // Cargar datos de salud y tomar hasta 8 aleatorios (para 16 cartas)
    $salud = json_decode(file_get_contents(storage_path('app/salud.json')), true) ?? [];
    shuffle($salud);
    // Tomamos 8 elementos para un tablero de 16 cartas (4x4)
    $saludJuego = array_slice($salud, 0, min(8, count($salud)));

    // Cada elemento produce 2 cartas: imagen (seña) y texto (nombre)
    $cartas = [];
    foreach ($saludJuego as $s) {
        // Carta de Imagen (Seña)
        $cartas[] = [
            'id' => $s['id'], // ID para emparejar
            'tipo' => 'img',
            'contenido' => $s['ruta'],
            'nombre' => $s['nombre']
        ];
        // Carta de Texto (Nombre)
        $cartas[] = [
            'id' => $s['id'], // ID para emparejar
            'tipo' => 'txt',
            'contenido' => $s['nombre'],
            'nombre' => $s['nombre']
        ];
    }
    shuffle($cartas); // Barajar el mazo completo
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memorama — Salud</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    {{-- Asume la inclusión de tu barra de navegación --}}
    @include('partials.navbar')

    <main class="memorama-app" id="memoramaApp">
        <div class="container">
            <header class="mem-header">
                <div class="title-block">
                    <h1 class="mem-title">Memorama — salud LESSA</h1>
                    <p class="mem-sub">Encuentra la pareja: **seña ↔ nombre**. Toca o presiona Enter para voltear.</p>
                </div>
                <div class="stats-block">
                    <div class="stat-item">
                        <i class="fas fa-check-circle success"></i>
                        <span>Parejas: <strong id="pairsFound">0</strong> / {{ count($saludJuego) }}</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-exclamation-triangle error"></i>
                        <span>Errores: <strong id="errorsCount">0</strong></span>
                    </div>
                </div>
            </header>

            {{-- Mensaje central de feedback --}}
            <div id="mensaje" class="feedback-message" aria-live="polite" role="status">
                <i class="fas fa-hand-pointer"></i> Toca o presiona Enter para voltear las cartas.
            </div>

            {{-- Área del juego --}}
            {{-- Añadimos la clase 'locked' al inicio para evitar clicks durante la visualización --}}
            <div class="card-grid locked" id="cardGrid" tabindex="0" role="application" aria-label="Tablero de Memorama">
                @foreach($cartas as $index => $c)
                    <div class="card-wrap" data-card-index="{{ $index }}" tabindex="-1">
                        <div class="card-inner" data-id="{{ $c['id'] }}" data-type="{{ $c['tipo'] }}">
                            <div class="card-face card-back">
                                <i class="fas fa-hands card-icon"></i>
                            </div>
                            <div class="card-face card-front">
                                @if ($c['tipo'] === 'img')
                                    <img src="{{ $c['contenido'] }}" alt="{{ $c['nombre'] }}" class="card-content-img" draggable="false">
                                @else
                                    <span class="card-content-text">{{ $c['contenido'] }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Botones de control --}}
            <div class="game-controls">
                {{-- NUEVO BOTÓN: Revelar Todo (uso único) --}}
                <button id="btnReveal" class="btn btn-primary" type="button" aria-label="Revelar todas las cartas una vez">
                    <i class="fas fa-eye"></i> Revelar Todo (<span id="revealCount">1</span>/1)
                </button>
                <button id="btnHint" class="btn btn-warning" type="button" aria-label="Usar Pista">
                    <i class="fas fa-lightbulb"></i> Pista (<span id="hintCount">3</span>/3)
                </button>
                <button id="btnReset" class="btn btn-ghost" type="button" aria-label="Reiniciar Juego">
                    <i class="fas fa-redo-alt"></i> Reintentar
                </button>
            </div>
            
            {{-- Formulario oculto para el controlador --}}
            <form id="completeForm" method="POST" action="{{ route('lecciones.salud.memorama.complete') }}">
                @csrf
                <input type="hidden" name="errors_count" id="errorsCountInput" value="0">
                <input type="hidden" name="activity_id" value="ABC2">
            </form>
        </div>
    </main>

    {{-- Modal de Fin de Juego --}}
    <div id="endGameModal" class="modal-end-game">
        <div class="modal-content">
            <h2 id="modal-title" class="modal-title">¡Juego Completado!</h2>
            <p id="modal-message" class="modal-text">Has terminado la actividad.</p>
            <div class="modal-points">
                +<span id="modal-points">0</span> Puntos
            </div>
            <div class="modal-actions">
                <a href="{{ route('miProgreso') }}" class="btn btn-secondary">
                    <i class="fas fa-trophy"></i> Ver Progreso
                </a>
                <a href="{{ route('nivel.salud') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-right"></i> Continuar
                </a>
            </div>
        </div>
    </div>

    {{-- Asume la inclusión de tu footer --}}
    @include('partials.footer')

    <style>
        /* --- ESTILOS UX/UI MEJORADOS --- */
        :root {
            --primary: #0b63ff; 
            --primary-dark: #0056b3;
            --accent: #00b7ff; 
            --success: #16a34a; 
            --danger: #ef4444; 
            --warning: #f59e0b;
            --background-light: #f5f8fb;
            --card-bg: #ffffff;
            --text-dark: #212529;
            --text-muted: #6b7280;
            --border-color: rgba(10, 25, 60, 0.06);
            --radius-sm: 10px;
            --radius-md: 14px;
            --radius-lg: 18px;
            --shadow-soft: 0 12px 36px rgba(12, 24, 60, 0.08);
            --shadow-md: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background-light);
            color: var(--text-dark);
            min-height: 100vh;
            padding: 0;
            margin: 0;
        }

        .container {
            width: min(1000px, 98vw);
            margin: 0 auto;
            padding: 20px 18px;
        }
        
        /* HEADER Y ESTADÍSTICAS */
        .mem-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .mem-title {
            font-size: 1.8rem;
            margin: 0;
            color: var(--primary);
            font-weight: 800;
        }

        .mem-sub {
            margin: 0;
            font-size: 1rem;
            color: var(--text-muted);
        }

        .stats-block {
            display: flex;
            gap: 15px;
            background: var(--card-bg);
            padding: 10px 15px;
            border-radius: var(--radius-md);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }

        .stat-item {
            font-size: 0.95rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .stat-item strong {
            font-size: 1.2rem;
            margin-left: 5px;
        }

        .stat-item .fas {
            margin-right: 5px;
            font-size: 1.1rem;
        }

        .stat-item .success { color: var(--success); }
        .stat-item .error { color: var(--danger); }
        
        /* MENSAJE CENTRAL */
        .feedback-message {
            padding: 10px 15px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            text-align: center;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            min-height: 45px;
            transition: all 0.3s ease;
        }
        .feedback-error {
             background-color: rgba(239, 68, 68, 0.1);
             color: var(--danger);
             border-color: var(--danger);
        }
        .feedback-success {
             background-color: rgba(22, 163, 74, 0.1);
             color: var(--success);
             border-color: var(--success);
        }
        .feedback-warning {
             background-color: rgba(245, 158, 11, 0.1);
             color: var(--warning);
             border-color: var(--warning);
        }

        /* GRID DE CARTAS */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); 
            gap: 15px;
            padding: 20px;
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-soft);
            max-width: 650px; 
            margin: 0 auto;
        }
        
        .card-grid.locked .card-wrap {
            pointer-events: none; /* Bloquea clics durante la visualización inicial/acciones especiales */
        }
        
        @media (max-width: 600px) {
            .card-grid {
                grid-template-columns: repeat(3, 1fr); 
            }
        }
        @media (max-width: 400px) {
            .card-grid {
                grid-template-columns: repeat(2, 1fr); 
            }
        }
        
        .card-wrap {
            aspect-ratio: 1 / 1.2; 
            perspective: 1000px;
            cursor: pointer;
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.15s ease;
        }

        .card-wrap:hover:not(.matched) {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .card-wrap.flipped .card-inner {
            transform: rotateY(180deg);
        }
        
        /* ESTADOS DE CARTA: ESTA REGLA PROTEGE A LAS CARTAS EMPAREJADAS DE CUALQUIER CLICK */
        .card-wrap.matched {
            pointer-events: none; 
            opacity: 0.9;
        }
        
        .card-wrap.matched .card-front {
            border: 2px solid var(--success);
            box-shadow: 0 0 10px rgba(22, 163, 74, 0.5);
            background: #e6ffed;
        }
        
        .card-wrap.mismatch .card-front {
            border: 2px solid var(--danger);
            background: #fff6f7;
            animation: pulse-red 0.4s 2;
        }
        
        @keyframes pulse-red {
            0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.5); }
            100% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
        }

        .card-wrap.hinted:not(.matched) .card-back {
            background: var(--warning) !important;
            border: 2px solid var(--warning);
            box-shadow: 0 0 10px rgba(245, 158, 11, 0.5);
        }

        /* CARAS DE LA CARTA */
        .card-face {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-back {
            background: linear-gradient(145deg, var(--primary), var(--accent));
            color: white;
            font-size: 2rem;
            border: 4px solid var(--card-bg);
            transition: all 0.3s ease;
        }

        .card-front {
            background: var(--card-bg);
            color: var(--text-dark);
            transform: rotateY(180deg);
            padding: 10px;
            box-sizing: border-box;
            border: 4px solid var(--border-color);
        }

        .card-icon {
            font-size: 3rem;
            opacity: 0.8;
        }
        
        .card-content-img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            border-radius: 6px;
        }
        
        .card-content-text {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-dark);
        }
        
        @media (max-width: 600px) {
            .card-content-text {
                font-size: 1rem;
            }
            .card-icon {
                font-size: 2rem;
            }
        }
        
        /* CONTROLES */
        .game-controls {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap; /* Permitir que los botones se envuelvan en pantallas pequeñas */
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: var(--radius-sm);
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            justify-content: center;
        }
        
        .btn-primary {
            /* NUEVO ESTILO PARA EL BOTÓN REVELAR TODO */
            background: linear-gradient(90deg, var(--primary), var(--accent));
            color: white;
        }

        .btn-primary:hover:not(:disabled) {
            background: linear-gradient(90deg, var(--primary-dark), #00a0e5);
            transform: translateY(-1px);
        }

        .btn-warning {
            background-color: var(--warning);
            color: var(--text-dark);
        }

        .btn-warning:hover:not(:disabled) {
            background-color: #d9900a;
            transform: translateY(-1px);
        }

        .btn-ghost {
            background-color: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-ghost:hover:not(:disabled) {
            background-color: var(--primary);
            color: white;
        }

        .btn:disabled,
        .btn[aria-disabled="true"] {
            opacity: 0.6;
            cursor: not-allowed;
            box-shadow: none;
        }

        /* MODAL (CSS del ejercicio anterior) */
        .modal-end-game {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            backdrop-filter: blur(5px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-end-game.show {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background: var(--card-bg);
            padding: 30px 40px;
            border-radius: var(--radius-lg);
            text-align: center;
            box-shadow: var(--shadow-md);
            max-width: 450px;
            width: 90%;
            transform: translateY(-50px) scale(0.9);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.27);
            border-top: 8px solid var(--success);
        }

        .modal-end-game.show .modal-content {
            transform: translateY(0) scale(1);
        }

        .modal-title {
            color: var(--primary);
            font-size: 2.5rem;
            margin-top: 0;
            margin-bottom: 10px;
            font-weight: 800;
        }

        .modal-text {
            color: var(--text-dark);
            margin-bottom: 25px;
            font-size: 1.1rem;
        }

        .modal-points {
            font-size: 3rem;
            font-weight: 800;
            color: var(--success);
            margin: 20px 0;
            background: #e6ffed;
            padding: 15px;
            border-radius: var(--radius-md);
            border: 2px dashed var(--success);
        }

        .modal-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 20px;
        }
        
        .btn-secondary {
            background: var(--text-muted);
            color: white;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
        }
        .btn-secondary:hover {
            background: #5a6268;
        }
        /* Reutilizamos .btn-primary para el botón de modal (para 'Continuar')*/
        .modal-actions .btn-primary { 
            background: linear-gradient(90deg, var(--primary), var(--accent));
            color: white;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
        }
    </style>

    <script>
        (function() {
            const grid = document.getElementById('cardGrid');
            const cards = Array.from(document.querySelectorAll('.card-wrap'));
            const pairsFoundEl = document.getElementById('pairsFound');
            const errorsCountEl = document.getElementById('errorsCount');
            const mensajeEl = document.getElementById('mensaje');
            const hintCountEl = document.getElementById('hintCount');
            const btnReset = document.getElementById('btnReset');
            const btnHint = document.getElementById('btnHint');
            const btnReveal = document.getElementById('btnReveal');
            const revealCountEl = document.getElementById('revealCount');
            
            const endModal = document.getElementById('endGameModal');
            const errorsCountInput = document.getElementById('errorsCountInput');
            const completeForm = document.getElementById('completeForm');

            let flippedCards = []; 
            let pairsFound = 0;
            let totalErrors = 0; 
            const totalPairs = {{ count($saludJuego) }};
            const MAX_HINTS = 3;
            let hintsUsed = 0;
            let gameLock = false; // Bloquea el tablero durante la revisión
            
            const REVEAL_DURATION = 1500; // 1.5 segundos
            let revealUsed = false; // Control de uso único para la revelación

            // -------------------------------------------
            // 1. Funciones de UI/Feedback
            // -------------------------------------------

            function setMessage(message, type = null) {
                mensajeEl.classList.remove('feedback-error', 'feedback-success', 'feedback-warning');
                if (type === 'error') {
                    mensajeEl.classList.add('feedback-error');
                } else if (type === 'success') {
                    mensajeEl.classList.add('feedback-success');
                } else if (type === 'warning') {
                    mensajeEl.classList.add('feedback-warning');
                }
                mensajeEl.innerHTML = message;
            }

            function updateStats() {
                pairsFoundEl.textContent = pairsFound;
                errorsCountEl.textContent = totalErrors;
                
                // Pistas
                hintCountEl.textContent = MAX_HINTS - hintsUsed;
                if (hintsUsed >= MAX_HINTS) {
                    btnHint.disabled = true;
                    btnHint.setAttribute('aria-disabled', 'true');
                } else {
                    btnHint.disabled = false;
                    btnHint.setAttribute('aria-disabled', 'false');
                }
                
                // Revelar Todo
                revealCountEl.textContent = revealUsed ? '0' : '1';
                if (revealUsed) {
                    btnReveal.disabled = true;
                    btnReveal.setAttribute('aria-disabled', 'true');
                } else {
                    btnReveal.disabled = false;
                    btnReveal.setAttribute('aria-disabled', 'false');
                }
            }
            
            function showGameResults() {
                // Bloquear interacción final
                grid.classList.add('locked');
                document.querySelector('.game-controls').style.display = 'none';
                
                let points = 0;
                let title = '';
                let message = '';
                const errors = totalErrors;

                if (errors <= 0) {
                    points = 10;
                    title = '¡PERFECTO! 🤩';
                    message = '¡Increíble! No tuviste ningún error. ¡Dominio total del salud!';
                } else if (errors <= 4) {
                    points = 5;
                    title = '¡MUY BIEN! 👍';
                    message = `Tuviste ${errors} errores. Demuestras gran memoria.`;
                } else {
                    points = 2;
                    title = '¡BUEN ATENTO! 💪';
                    message = `Tuviste ${errors} errores. No te rindas, repite la actividad para subir tu puntuación.`;
                }
                
                // 2. Actualizar el input oculto (para el backend)
                errorsCountInput.value = errors;
                
                // 3. Actualizar el modal
                document.getElementById('modal-title').textContent = title;
                document.getElementById('modal-message').textContent = message;
                document.getElementById('modal-points').textContent = points;

                // 4. Mostrar el modal y enviar datos
                endModal.classList.add('show');
                
                // Envío automático al backend para guardar el resultado
                const formData = new FormData(completeForm);
                fetch(completeForm.action, {
                    method: 'POST',
                    body: formData
                }).then(response => {
                    if (!response.ok) {
                        console.error('Error al enviar el resultado del juego.');
                    }
                }).catch(error => {
                    console.error('Error de red al enviar el resultado:', error);
                });
            }

            // -------------------------------------------
            // 2. Lógica del Juego
            // -------------------------------------------
            
            function flipCard(card) {
                // Verificar gameLock, si la carta ya está volteada o si ya está emparejada (.matched se bloquea también por CSS)
                if (gameLock || card.classList.contains('flipped') || grid.classList.contains('locked')) return;

                // Si la carta ya está emparejada, el CSS (pointer-events: none) previene el click, pero esta capa de JS es extra seguridad.
                if (card.classList.contains('matched')) return; 

                card.classList.add('flipped');
                flippedCards.push(card);

                if (flippedCards.length === 2) {
                    gameLock = true;
                    checkForMatch();
                } else {
                    setMessage('Segunda carta lista. ¡A voltear!', null);
                }
            }

            function checkForMatch() {
                const [card1, card2] = flippedCards;
                const inner1 = card1.querySelector('.card-inner');
                const inner2 = card2.querySelector('.card-inner');
                const id1 = inner1.dataset.id;
                const id2 = inner2.dataset.id;

                if (id1 === id2) {
                    // ACIERTO
                    cardsMatched(card1, card2);
                } else {
                    // ERROR
                    cardsMismatch(card1, card2);
                }
            }

            function cardsMatched(card1, card2) {
                setTimeout(() => {
                    card1.classList.add('matched');
                    card2.classList.add('matched');

                    pairsFound++;
                    updateStats();
                    setMessage('¡Pareja encontrada! 🎉', 'success');

                    flippedCards = [];
                    gameLock = false;

                    if (pairsFound === totalPairs) {
                        showGameResults();
                    }
                }, 700);
            }

            function cardsMismatch(card1, card2) {
                totalErrors++;
                updateStats();
                setMessage('¡Incorrecto! No son pareja. Intenta de nuevo. ❌', 'error');

                card1.classList.add('mismatch');
                card2.classList.add('mismatch');

                setTimeout(() => {
                    card1.classList.remove('flipped', 'mismatch');
                    card2.classList.remove('flipped', 'mismatch');
                    flippedCards = [];
                    gameLock = false;
                    setMessage('<i class="fas fa-hand-pointer"></i> Toca o presiona Enter para voltear las cartas.', null);
                }, 1500);
            }
            
            function hintAction() {
                if (hintsUsed >= MAX_HINTS || pairsFound === totalPairs || gameLock || grid.classList.contains('locked')) return;

                hintsUsed++;
                updateStats();
                setMessage(`Pista usada. Tienes ${MAX_HINTS - hintsUsed} restantes. Memoriza rápido.`, 'warning');

                const unmatchedCards = cards.filter(c => !c.classList.contains('matched'));
                
                // Encontrar un par no descubierto
                const unmatchedIds = [...new Set(unmatchedCards.map(c => c.querySelector('.card-inner').dataset.id))];
                if (unmatchedIds.length === 0) return; 

                const hintId = unmatchedIds[Math.floor(Math.random() * unmatchedIds.length)];
                
                const hintPair = unmatchedCards.filter(c => c.querySelector('.card-inner').dataset.id === hintId);

                // Voltear la pareja y luego regresarlas
                hintPair.forEach(c => {
                    c.classList.add('hinted');
                    c.classList.add('flipped');
                });

                gameLock = true;
                grid.classList.add('locked'); // Bloquear el tablero
                
                setTimeout(() => {
                    hintPair.forEach(c => {
                        c.classList.remove('flipped', 'hinted');
                    });
                    gameLock = false;
                    grid.classList.remove('locked'); // Desbloquear el tablero
                    setMessage('<i class="fas fa-hand-pointer"></i> ¡Continúa el juego!', null);
                }, 1800); 
            }

            // FUNCIÓN REVELAR TODO (CORREGIDA)
            function revealAllAction() {
                if (revealUsed || pairsFound === totalPairs || gameLock || grid.classList.contains('locked')) return;

                revealUsed = true;
                updateStats();
                
                setMessage(`¡Visualización de emergencia! Cartas mostradas por ${REVEAL_DURATION / 1000} segundos. ¡Memoriza!`, 'danger');
                
                // Bloquear el juego y el tablero
                gameLock = true;
                grid.classList.add('locked');

                // Voltear SOLO las cartas que NO han sido emparejadas
                const unmatchedCards = cards.filter(c => !c.classList.contains('matched'));
                unmatchedCards.forEach(card => card.classList.add('flipped'));
                
                setTimeout(() => {
                    // Voltear de regreso y desbloquear
                    unmatchedCards.forEach(card => card.classList.remove('flipped')); // Solo removemos de las que volteamos
                    gameLock = false;
                    grid.classList.remove('locked');
                    setMessage('<i class="fas fa-hand-pointer"></i> ¡Continúa el juego!', null);
                }, REVEAL_DURATION);
            }

            function resetGame() {
                // 1. Reiniciar variables
                pairsFound = 0;
                totalErrors = 0;
                hintsUsed = 0;
                revealUsed = false;
                flippedCards = [];
                gameLock = true; 
                
                // 2. Re-barajar las cartas
                cards.sort(() => Math.random() - 0.5).forEach(c => grid.appendChild(c));

                // 3. Resetear estado de las cartas
                cards.forEach(card => {
                    card.classList.remove('flipped', 'matched', 'mismatch', 'hinted');
                });
                
                // 4. Resetear UI
                document.querySelector('.game-controls').style.display = 'flex';
                endModal.classList.remove('show');
                updateStats(); 
                grid.classList.add('locked'); // Bloqueo para evitar interacciones

                // 5. Mostrar cartas por 5 segundo (Initial reveal)
                setMessage('¡Memoricemos! Mira bien las cartas... (5 segundo)', 'warning');
                cards.forEach(card => card.classList.add('flipped'));

                setTimeout(() => {
                    cards.forEach(card => card.classList.remove('flipped'));
                    setMessage('<i class="fas fa-hand-pointer"></i> ¡Adelante! Empieza a voltear las cartas.', 'success');
                    grid.classList.remove('locked'); // Desbloquear el tablero
                    gameLock = false; // Desbloquear la lógica del juego
                }, 5000); // 1000 milisegundos = 5 segundo
            }

            // -------------------------------------------
            // 3. Event Listeners
            // -------------------------------------------

            cards.forEach(card => {
                card.addEventListener('click', () => flipCard(card));
                
                // Navegación por teclado (UX)
                card.addEventListener('keydown', (e) => {
                    if (e.key === ' ' || e.key === 'Enter') {
                        e.preventDefault();
                        flipCard(card);
                    }
                    if (['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
                        e.preventDefault();
                        navigateGrid(e.key, card);
                    }
                });
            });

            btnReset.addEventListener('click', resetGame);
            btnHint.addEventListener('click', hintAction);
            btnReveal.addEventListener('click', revealAllAction);


            function navigateGrid(key, current) {
                // Solo navegamos entre cartas que NO están emparejadas
                const all = cards.filter(c => !c.classList.contains('matched'));
                if (all.length === 0) return;
                
                const currentWrap = current.closest('.card-wrap');
                const idx = all.indexOf(currentWrap);
                if (idx === -1) return;

                const style = getComputedStyle(grid);
                // Asume 4 columnas como base, ajusta si es responsivo
                const cols = style.gridTemplateColumns.split(' ').length; 
                let nextIdx = idx;

                if (key === 'ArrowRight') nextIdx = Math.min(all.length - 1, idx + 1);
                if (key === 'ArrowLeft') nextIdx = Math.max(0, idx - 1);
                if (key === 'ArrowDown') nextIdx = Math.min(all.length - 1, idx + cols);
                if (key === 'ArrowUp') nextIdx = Math.max(0, idx - cols);
                
                if (nextIdx !== idx) {
                    all[nextIdx].focus();
                }
            }

            // Inicializar el juego
            resetGame();
        })();
    </script>
</body>

</html>