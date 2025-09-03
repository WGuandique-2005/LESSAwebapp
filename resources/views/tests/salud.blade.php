@php
    // Cargar Salud y tomar hasta 8 aleatorios (o menos si no hay)
    $Salud = json_decode(file_get_contents(storage_path('app/salud.json')), true) ?? [];
    shuffle($Salud);
    $SaludJuego = array_slice($Salud, 0, min(6, count($Salud)));

    // Cada saludo produce 2 cartas: imagen y texto
    $cartas = [];
    foreach ($SaludJuego as $s) {
        $cartas[] = [
            'id' => $s['id'],
            'tipo' => 'img',
            'contenido' => $s['ruta'],
            'nombre' => $s['nombre']
        ];
        $cartas[] = [
            'id' => $s['id'],
            'tipo' => 'txt',
            'contenido' => $s['nombre'],
            'nombre' => $s['nombre']
        ];
    }
    shuffle($cartas);
@endphp
<head><title>Salud: Test</title></head>
@include('partials.navbar')
<main class="memorama-app" id="memoramaApp">
    <div class="container">
        <header class="mem-header">
            <div class="title-block">
                <h1 class="mem-title">Memorama — Salud en LESSA</h1>
                <p class="mem-sub">Encuentra la pareja: imagen ↔ palabra. Toca o presiona Enter para voltear.</p>
            </div>

            <div class="mem-controls" role="region" aria-label="Controles del juego">
                <div class="mem-stats" aria-hidden="false">
                    <div class="stat"><strong id="pairsFound">0</strong><span>Parejas</span></div>
                    <div class="stat"><strong id="movesCount">0</strong><span>Movimientos</span></div>
                </div>

                <form class="mem-buttons" method="POST" action="{{ route('lecciones.salud.complete') }}">
                    @csrf
                    <button id="btnHint" class="btn ghost" type="button"
                        title="Sugerencia: muestra una pareja temporalmente">Pista</button>
                    <button id="btnReveal" class="btn ghost" type="button"
                        title="Mostrar todas las cartas brevemente">Mostrar</button>
                    <button id="btnShuffle" class="btn ghost" type="button" title="Mezclar cartas">Mezclar</button>
                    <button id="btnReset" class="btn primary" type="button" title="Reiniciar juego">Reiniciar</button>
                    <button id="btnComplete" class="btn primary" type="submit" disabled aria-disabled="true"
                        title="Completar lección">Completar</button>
                </div>
            </div>
        </header>

        <section class="board-wrapper" aria-label="Tablero de memorama">
            <div id="announce" class="sr-only" aria-live="polite" aria-atomic="true"></div>

            <div class="mem-grid" id="memGrid" role="grid" aria-describedby="board-desc">
                <p id="board-desc" class="sr-only">Tablero con cartas boca abajo. Busca parejas de imagen y texto.</p>

                {{-- Renderizamos las cartas desde PHP/Blade --}}
                @foreach($cartas as $idx => $carta)
                    <button class="mem-card" data-id="{{ $carta['id'] }}" data-tipo="{{ $carta['tipo'] }}"
                        aria-label="Carta {{ $carta['tipo'] === 'img' ? 'imagen' : 'texto' }}: {{ $carta['nombre'] }}"
                        tabindex="0" type="button">
                        <div class="card-inner" aria-hidden="true">
                            <div class="card-face card-front">
                                @if($carta['tipo'] === 'img')
                                    <img src="{{ $carta['contenido'] }}" alt="{{ $carta['nombre'] }}" loading="lazy"
                                        draggable="false">
                                @else
                                    <span class="card-text">{{ $carta['contenido'] }}</span>
                                @endif
                            </div>
                            <div class="card-face card-back" aria-hidden="true">
                                <span class="back-mark">?</span>
                            </div>
                        </div>
                    </button>
                @endforeach

            </div>

            <div id="gameMessage" class="game-message" aria-live="polite"></div>
        </section>
    </div>
</main>

@include('partials.footer')

<style>
    /* ========== Variables ========== */
    :root {
        --bg: #f5f8fb;
        --card: #fff;
        --muted: #6b7280;
        --accent: #0b63ff;
        --accent-2: #00b7ff;
        --success: #16a34a;
        --danger: #ef4444;
        --glass: rgba(255, 255, 255, 0.8);
        --radius: 14px;
        --shadow: 0 12px 36px rgba(12, 24, 60, 0.06);
        --tap-size: 56px;
        /* accessible tap radius */
    }

    /* Basic page */
    html,
    body {
        height: 100%;
        margin: 0;
        background: linear-gradient(180deg, var(--bg), #fff);
        font-family: Poppins, system-ui, -apple-system, "Segoe UI", Roboto, Arial;
        color: #0f172a
    }

    .container {
        max-width: 1050px;
        margin: 18px auto;
        padding: 0 16px;
        box-sizing: border-box
    }

    /* Header */
    .mem-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 12px
    }

    .title-block {
        display: flex;
        flex-direction: column
    }

    .mem-title {
        margin: 0;
        font-size: 1.15rem;
        font-weight: 800
    }

    .mem-sub {
        margin: 4px 0 0;
        color: var(--muted);
        font-size: 0.95rem
    }

    .mem-controls {
        display: flex;
        align-items: center;
        gap: 12px
    }

    .mem-stats {
        display: flex;
        gap: 12px;
        align-items: center
    }

    .stat {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-weight: 600
    }

    .stat span {
        font-weight: 400;
        color: var(--muted);
        font-size: 0.85rem
    }

    .mem-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap
    }

    .btn {
        border-radius: 10px;
        padding: 8px 12px;
        border: 1px solid rgba(10, 25, 60, 0.06);
        background: transparent;
        cursor: pointer;
        font-weight: 700
    }

    .btn.ghost {
        background: transparent
    }

    .btn.primary {
        background: linear-gradient(90deg, var(--accent), var(--accent-2));
        color: #fff;
        border: none;
        box-shadow: 0 8px 24px rgba(10, 95, 255, 0.12)
    }

    .btn:focus {
        outline: 3px solid rgba(11, 99, 255, 0.12);
        outline-offset: 2px
    }

    /* Board */
    .board-wrapper {
        background: var(--card);
        border-radius: 12px;
        box-shadow: var(--shadow);
        padding: 10px;
    }

    .mem-grid {
        display: grid;
        gap: 12px;
        align-items: stretch;
        justify-items: center;
        grid-template-columns: repeat(4, 1fr)
    }

    /* Responsive grid: 4 / 3 / 2 */
    @media (min-width: 900px) {
        .mem-grid {
            grid-template-columns: repeat(4, 1fr)
        }
    }

    @media (min-width: 640px) and (max-width:899px) {
        .mem-grid {
            grid-template-columns: repeat(3, 1fr)
        }
    }

    @media (max-width:639px) {
        .mem-grid {
            grid-template-columns: repeat(2, 1fr)
        }
    }

    /* Card styles */
    .mem-card {
    width: 100%;
    aspect-ratio: 1/1.05;        /* casi cuadrada */
    border-radius: 10px;
    padding: 4px;                /* menos borde/padding */
    background: transparent;
    cursor: pointer;
    perspective: 900px;
    display: inline-flex;
    align-items: stretch;
    justify-content: center;
    min-width: 64px;
    max-width: 130px;            /* cartas más pequeñas */
    box-sizing: border-box;
    }
    .card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transform-style: preserve-3d;
    transition: transform .32s cubic-bezier(.2,.9,.3,1);
    border-radius: 10px;
    box-shadow: 0 8px 18px rgba(10,20,40,0.04);
    }

    .mem-card:focus .card-inner {
        box-shadow: 0 10px 28px rgba(11, 99, 255, 0.07);
        transform: translateY(-2px)
    }

    .card-face {
        position: absolute;
        inset: 0;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        backface-visibility: hidden;
        overflow: hidden
    }

    .card-front {
    background: var(--glass);
    transform: rotateY(180deg);
    padding: 6px;               /* reducido */
    display: flex;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
    }

    .card-front img {
    width: calc(100% - 8px);    /* dejar pequeño margen visual */
    height: auto;
    max-height: calc(100% - 8px);
    object-fit: contain;
    border-radius: 6px;
    background: #fff;
    border: 1px solid rgba(10,25,60,0.04); /* sutil borde */
    display: block;
    }

    .card-text {
    font-weight: 800;
    color: var(--accent);
    font-size: 0.98rem;
    text-align: center;
    padding: 6px 4px;
    line-height: 1.05;
    }

    .card-back {
        background: linear-gradient(135deg, var(--accent), var(--accent-2));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 6px;
    }

    .back-mark {
        font-size: 1.3rem;
        font-weight: 900
    }

    /* Flipped / matched states */
    .mem-card.flipped .card-inner {
        transform: rotateY(180deg)
    }

    .mem-card.matched {
        opacity: 0.88;
        transform: scale(0.99);
        pointer-events: none;
        filter: grayscale(0.02)
    }

    .mem-card.incorrect {
        animation: shake .36s
    }

    @keyframes shake {
        0% {
            transform: translateX(0)
        }

        20% {
            transform: translateX(-6px)
        }

        40% {
            transform: translateX(6px)
        }

        60% {
            transform: translateX(-4px)
        }

        80% {
            transform: translateX(4px)
        }

        100% {
            transform: translateX(0)
        }
    }

    /* message */
    .game-message {
        min-height: 36px;
        margin-top: 8px;
        text-align: center;
        font-weight: 700;
        color: var(--muted)
    }

    /* small adjustments for phones (Samsung A35 etc) */
    @media (max-width:420px) {
        .mem-title {
            font-size: 1rem
        }

        .mem-sub {
            font-size: 0.88rem
        }

        .btn {
            padding: 8px 8px;
            font-size: 0.9rem
        }

        .card-front img {
            width: calc(100% - 6px);
        }

        .card-text {
            font-size: 0.98rem
        }

        .mem-card {
            max-width: 110px
        }
    }

    /* accessibility only */
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0
    }

    /* Respect user reduced motion */
    @media (prefers-reduced-motion: reduce) {

        .card-inner,
        .mem-card,
        .mem-card:focus .card-inner {
            transition: none;
            animation: none
        }
    }

    @media (max-width: 640px) {
        .mem-grid{
            grid-template-columns: repeat(3, 1fr);
        }
        .mem-header {
            flex-direction: column;
            align-items: stretch;
        }
        .mem-controls {
            width: 100%;
            justify-content: flex-start;
        }
        .mem-buttons {
            width: 100%;
        }
    }
</style>

<script>
    (function () {
        // Elements
        const grid = document.getElementById('memGrid');
        const cards = Array.from(grid.querySelectorAll('.mem-card'));
        const announce = document.getElementById('announce');
        const msgEl = document.getElementById('gameMessage');
        const pairsFoundEl = document.getElementById('pairsFound');
        const movesEl = document.getElementById('movesCount');
        const progressBar = document.getElementById('gameProgress'); // optional if present
        const btnReset = document.getElementById('btnReset');
        const btnHint = document.getElementById('btnHint');
        const btnReveal = document.getElementById('btnReveal');
        const btnShuffle = document.getElementById('btnShuffle');
        const btnComplete = document.getElementById('btnComplete');
        const form = btnComplete.closest('form');

        let flipped = [];
        let lock = false; // prevent interaction while evaluating
        let pairsFound = 0;
        let moves = 0;
        const totalPairs = cards.length / 2;

        // Utility: announce for screen readers
        function ariaAnnounce(text) {
            if (!announce) return;
            announce.textContent = text;
        }

        function setMessage(text, tone = 'neutral') {
            msgEl.textContent = text;
            // optional styling by tone
            msgEl.style.color = tone === 'error' ? 'var(--danger)' : (tone === 'success' ? 'var(--success)' : 'var(--muted)');
            ariaAnnounce(text);
        }

        function updateStats() {
            pairsFoundEl.textContent = pairsFound;
            movesEl.textContent = moves;
            // update optional progress bar
            if (progressBar) {
                const percent = Math.round((pairsFound / totalPairs) * 100);
                progressBar.style.width = percent + '%';
                progressBar.setAttribute && progressBar.setAttribute('aria-valuenow', percent);
            }
        }

        // flip a card
        function flip(card) {
            if (lock || card.classList.contains('flipped') || card.classList.contains('matched')) return;
            card.classList.add('flipped');
            flipped.push(card);
            if (flipped.length === 2) evaluate();
        }

        function evaluate() {
            lock = true;
            moves++;
            updateStats();
            const [a, b] = flipped;
            const match = (a.dataset.id === b.dataset.id) && (a.dataset.tipo !== b.dataset.tipo);
            if (match) {
                // matched
                setTimeout(() => {
                    a.classList.add('matched'); b.classList.add('matched');
                    pairsFound++;
                    setMessage('¡Pareja encontrada!', 'success');
                    ariaAnnounce(`Pareja: ${a.getAttribute('aria-label')}`);
                    flipped = [];
                    lock = false;
                    updateStats();
                    if (pairsFound === totalPairs) finishGame();
                }, 520);
            } else {
                // not match
                a.classList.add('incorrect'); b.classList.add('incorrect');
                setMessage('No son pareja. Intenta de nuevo.', 'error');
                setTimeout(() => {
                    a.classList.remove('flipped', 'incorrect');
                    b.classList.remove('flipped', 'incorrect');
                    flipped = [];
                    lock = false;
                    setMessage('Sigue buscando.', 'neutral');
                }, 700);
            }
        }

        function finishGame() {
            setMessage(`¡Felicidades! Encontraste todas las parejas en ${moves} movimientos. 🎉`, 'success');
            ariaAnnounce('Juego completado');
            cards.forEach(c => c.classList.add('matched'));
            if (btnComplete) {
                btnComplete.disabled = false;
                btnComplete.setAttribute('aria-disabled', 'false');
            }
            return true;
        }

        function resetGame(shuffleNow = true) {
            flipped = []; lock = false; pairsFound = 0; moves = 0;
            cards.forEach(c => {
                c.classList.remove('flipped', 'matched', 'incorrect');
                c.style.pointerEvents = '';
                c.tabIndex = 0;
            });
            if (btnComplete) {
                btnComplete.disabled = true;
                btnComplete.setAttribute('aria-disabled', 'true');
            }
            if (shuffleNow) shuffleDOM(grid);
            setMessage('Toca o presiona Enter para voltear las cartas.');
            updateStats();
        }

        function shuffleDOM(container) {
            const nodes = Array.from(container.children);
            for (let i = nodes.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                container.appendChild(nodes[j]);
                nodes.splice(j, 1);
            }
        }

        function revealAll(duration = 3500) {
            if (lock) return;
            cards.forEach(c => c.classList.add('flipped'));
            setTimeout(() => {
                cards.forEach(c => {
                    if (!c.classList.contains('matched')) c.classList.remove('flipped');
                });
            }, duration);
        }

        function hintAction() {
            if (lock) return;
            // find unmatched pairs
            const unmatched = cards.filter(c => !c.classList.contains('matched'));
            if (unmatched.length < 2) return;
            // map id -> elements
            const map = {};
            for (const c of unmatched) {
                map[c.dataset.id] = map[c.dataset.id] || [];
                map[c.dataset.id].push(c);
            }
            const pairIds = Object.keys(map).filter(k => map[k].length === 2);
            if (pairIds.length === 0) { setMessage('No hay pareja completa visible para sugerir.'); return; }
            const id = pairIds[Math.floor(Math.random() * pairIds.length)];
            const [c1, c2] = map[id];
            c1.classList.add('flipped'); c2.classList.add('flipped');
            setTimeout(() => {
                if (!c1.classList.contains('matched')) c1.classList.remove('flipped');
                if (!c2.classList.contains('matched')) c2.classList.remove('flipped');
            }, 900);
            setMessage('Sugerencia aplicada.');
        }

        // Event handlers
        cards.forEach(card => {
            card.addEventListener('click', (e) => {
                e.preventDefault();
                flip(card);
            });
            card.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    flip(card);
                }
                // left/right up/down navigation for accessibility (optional)
                if (['ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown'].includes(e.key)) {
                    e.preventDefault();
                    navigateGrid(card, e.key);
                }
            });
            // improve touch experience: slightly delay active state removed automatically
            card.addEventListener('touchstart', () => { card.classList.add('touching'); setTimeout(() => card.classList.remove('touching'), 120); });
        });

        // keyboard grid navigation helper
        function navigateGrid(current, key) {
            const all = Array.from(grid.querySelectorAll('.mem-card'));
            const idx = all.indexOf(current);
            if (idx === -1) return;
            const cols = getComputedStyle(grid).gridTemplateColumns.split(' ').length;
            let nextIdx = idx;
            if (key === 'ArrowRight') nextIdx = Math.min(all.length - 1, idx + 1);
            if (key === 'ArrowLeft') nextIdx = Math.max(0, idx - 1);
            if (key === 'ArrowDown') nextIdx = Math.min(all.length - 1, idx + cols);
            if (key === 'ArrowUp') nextIdx = Math.max(0, idx - cols);
            all[nextIdx].focus();
        }

        // Buttons
        btnReset && btnReset.addEventListener('click', () => resetGame(true));
        btnShuffle && btnShuffle.addEventListener('click', () => resetGame(true));
        btnReveal && btnReveal.addEventListener('click', () => revealAll(1000));
        btnHint && btnHint.addEventListener('click', () => hintAction());

        // initialize
        resetGame(false);
        setTimeout(() => setMessage('Toca o presiona Enter para voltear las cartas.'), 120);

        // Expose for debugging (optional)
        window.memoramaGame = { reset: resetGame, reveal: revealAll, hint: hintAction };

        // Form submission: only allow if all correct
        form.addEventListener('submit', (e) => {
            if (pairsFound !== totalPairs) {
                e.preventDefault();
                setMessage('Debes conectar todas las señas correctamente.', 'error');
            }
        });

    })();
</script>