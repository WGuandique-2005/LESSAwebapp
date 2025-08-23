@php
    $user = Auth::user();
    $fullName = $user ? $user->name : '';
    $firstName = explode(' ', $fullName)[0] ?? '';
    $firstName = strtoupper($firstName);

    // Cargamos señas
    $senas = json_decode(file_get_contents(storage_path('app/abecedario.json')), true);

    // Descomponer el nombre en letras (mantiene repeticiones)
    $letrasNombre = preg_split('//u', $firstName, -1, PREG_SPLIT_NO_EMPTY);

    // Conteo de repeticiones por letra
    $conteoLetras = array_count_values($letrasNombre);

    // Construimos la lista requerida respetando repetidos
    $letrasRequeridas = [];
    foreach ($conteoLetras as $letra => $cantidad) {
        for ($i = 0; $i < $cantidad; $i++) {
            $letrasRequeridas[] = $letra;
        }
    }

    // Letras únicas del nombre (para calcular distractoras)
    $letrasUnicas = array_keys($conteoLetras);

    // Todas las letras disponibles desde el JSON de señas
    $todasLetras = array_column($senas, 'id');

    // Distractoras: letras que no están en el nombre (únicas)
    $distractorasDisponibles = array_values(array_diff($todasLetras, $letrasUnicas));

    // Barajar y elegir algunas distractoras (al menos 3 o igual a número de letras únicas)
    shuffle($distractorasDisponibles);
    $numDistractors = max(3, count($letrasUnicas));
    $distractoras = array_slice($distractorasDisponibles, 0, $numDistractors);

    // Construir el conjunto final: todas las letras requeridas (con repeticiones) + distractoras
    $letrasJuego = array_merge($letrasRequeridas, $distractoras);

    // Finalmente barajar las cartas para mostrar
    shuffle($letrasJuego);
@endphp
<head><title>Abecedario: Test</title></head>
@include('partials.navbar')
<div class="game-wrap">
    <div class="game-frame">
        <header class="game-header">
            <div>
                <h1 class="title">Deletrea tu nombre</h1>
                <p class="subtitle">Forma: <span class="target-name">{{ $firstName ?: '-' }}</span></p>
            </div>
            <div class="controls">
                <div class="progress-pill" role="progressbar" aria-label="Progreso de juego" aria-valuemin="0"
                    aria-valuemax="100" aria-valuenow="0">
                    <div id="gameProgress" class="progress-inner"></div>
                    <span id="progressLabel" class="progress-label">0%</span>
                </div>
            </div>
        </header>

        <div class="card compact-card">
            <div class="card-body">
                <div id="target-name" class="target-row" aria-hidden="false">
                    @foreach($letrasNombre as $letra)
                        <span class="letra-box">{{ $letra }}</span>
                    @endforeach
                </div>

                <div id="imagenes-senas" class="sena-grid" aria-label="Selección de señas">
                    @foreach($letrasJuego as $letra)
                        @php
                            $sena = collect($senas)->firstWhere('id', $letra);
                            $alt = $sena['nombre'] ?? 'Seña ' . $letra;
                        @endphp
                        @if($sena)
                            <button class="sena-card" data-letra="{{ $letra }}" aria-pressed="false"
                                aria-label="Seña {{ $letra }}" title="{{ $alt }}">
                                <div class="sena-media">
                                    <img src="{{ $sena['ruta'] }}" alt="{{ $alt }}" class="sena-img" loading="lazy"
                                        draggable="false">
                                    <div class="order-badge" aria-hidden="true"></div>
                                </div>
                            </button>
                        @endif
                    @endforeach
                </div>

                <form id="completeForm" class="actions-row" method="POST"
                    action="{{ route('lecciones.abecedario.complete') }}">
                    @csrf
                    <button id="btnHint" class="btn-ghost" type="button">Sugerencia</button>
                    <button id="btnReset" class="btn-ghost" type="button">Reintentar</button>
                    <button id="btnReveal" class="btn-ghost" type="button">Mostrar</button>

                    <button id="btnComplete" class="btn-primary" type="submit" disabled aria-disabled="true"
                        title="Completar lección">
                        Completar
                    </button>
                </form>

                <div id="mensaje" class="mt-2" aria-live="polite" role="status"></div>
            </div>
        </div>
    </div>
</div>
@include('partials.footer')
<style>
    :root {
        --bg: #f5f8fb;
        --card: #ffffff;
        --muted: #6b7280;
        --accent: #0b63ff;
        --accent-2: #00b7ff;
        --success: #16a34a;
        --danger: #ef4444;
        --glass: rgba(255, 255, 255, 0.6);
        --radius: 12px;
        --shadow-soft: 0 8px 24px rgba(12, 24, 60, 0.06);
    }

    /* Reset mobile */
    html, body {
        height: 100%;
        margin: 0;
        background: linear-gradient(180deg, var(--bg), #ffffff);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .game-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 18px;
        box-sizing: border-box;
        font-family: "Poppins", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }

    .game-frame {
        width: min(760px, 96vw);
        display: flex;
        flex-direction: column;
        gap: 14px;
        align-items: stretch;
        margin: 0 auto;
        box-sizing: border-box;
    }

    .game-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 6px 10px;
    }

    .title {
        font-size: 1.05rem;
        margin: 0;
        color: #0f172a;
        font-weight: 700;
    }

    .subtitle {
        margin: 2px 0 0 0;
        font-size: 0.825rem;
        color: var(--muted);
    }

    .target-name { color: var(--accent); font-weight: 800; letter-spacing: .06em; }

    .progress-pill {
        position: relative;
        width: 120px;
        height: 28px;
        background: linear-gradient(90deg, #eef6ff, #fbfdff);
        border-radius: 999px;
        border: 1px solid rgba(10, 30, 80, 0.04);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3px;
        box-shadow: var(--shadow-soft);
    }

    .progress-inner {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 0%;
        background: linear-gradient(90deg, var(--accent), var(--accent-2));
        border-radius: 999px;
        transition: width .33s ease;
        opacity: 0.98;
    }

    .progress-label { position: relative; z-index: 2; font-size: 0.8rem; color: #04203b; font-weight:700; }

    .compact-card {
        background: var(--card);
        border-radius: var(--radius);
        box-shadow: var(--shadow-soft);
        border: 1px solid rgba(13,27,62,0.04);
        overflow: hidden;
    }

    .card-body { padding: 14px; box-sizing: border-box; }

    .target-row { display:flex; gap:8px; justify-content:center; flex-wrap:wrap; margin-bottom: 10px; }

    .letra-box {
        min-width: 36px;
        min-height: 36px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        padding:6px 10px;
        border-radius:10px;
        background: linear-gradient(180deg,#f1f8ff,#ffffff);
        color: var(--accent);
        font-weight:800;
        font-size:0.98rem;
        box-shadow: 0 6px 18px rgba(7,34,102,0.04);
    }

    /* GRID: default desktop */
    .sena-grid {
        display:grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin: 6px 0 12px;
        align-items: start;
    }

    .sena-card {
        position: relative;
        display:flex;
        flex-direction:column;
        align-items:center;
        padding:10px;
        background: linear-gradient(180deg,#fff,#fbfdff);
        border-radius:10px;
        border:1px solid rgba(10,25,60,0.04);
        box-shadow:0 8px 18px rgba(8,20,45,0.03);
        cursor:pointer;
        transition: transform .14s ease, box-shadow .14s ease;
        min-height: 150px;
        justify-content: center;
        text-align: center;
    }

    .sena-card:hover, .sena-card:focus { transform: translateY(-4px); box-shadow: 0 14px 36px rgba(8,20,45,0.06); }

    .sena-media { display:flex; align-items:center; justify-content:center; width:100%; height:100%; }

    .sena-img {
        width: 92px;
        height: 92px;
        object-fit: contain;
        border-radius:8px;
        background: linear-gradient(180deg,#fff,#f7fbff);
        border:1px solid rgba(10,25,60,0.03);
        pointer-events:none;
    }

    .order-badge {
        position:absolute;
        top:8px;
        right:8px;
        min-width:28px;
        min-height:28px;
        display:flex;
        align-items:center;
        justify-content:center;
        background: transparent;
        color:#fff;
        font-weight:700;
        font-size:0.88rem;
        border-radius:50%;
        box-shadow:0 6px 14px rgba(0,0,0,0.08);
        transition: all .18s ease;
    }

    .sena-card.acertado { background:#f2fbf4; border-color: rgba(22,163,74,0.12); }
    .order-badge.acertado { background: var(--success); color:#fff; }
    .sena-card.incorrecto { background:#fff6f7; border-color: rgba(239,68,68,0.12); animation: shake .36s; }
    .order-badge.incorrecto { background: var(--danger); color:#fff; }

    @keyframes shake { 0%{transform:translateX(0)}20%{transform:translateX(-6px)}40%{transform:translateX(6px)}60%{transform:translateX(-4px)}80%{transform:translateX(4px)}100%{transform:translateX(0)} }

    .actions-row { display:flex; gap:8px; justify-content:center; align-items:center; margin-top:8px; flex-wrap:wrap; }

    .btn-ghost {
        background:transparent;
        border:1px solid rgba(10,25,60,0.06);
        color:#0b254a;
        padding:8px 10px;
        border-radius:10px;
        font-weight:700;
        cursor:pointer;
    }
    .btn-primary {
        background: linear-gradient(90deg,var(--accent),var(--accent-2));
        color:#fff;
        border:none;
        padding:8px 12px;
        border-radius:10px;
        font-weight:800;
        cursor:pointer;
    }
    .btn-primary[disabled], .btn-primary[aria-disabled="true"] { opacity:.6; cursor:not-allowed; }

    #mensaje { min-height:22px; text-align:center; margin-top:6px; font-weight:700; color:var(--muted); }

    /* -------- Responsive breakpoints -------- */
    /* tablet */
    @media (max-width: 1024px) {
        .sena-grid { grid-template-columns: repeat(3, 1fr); gap: 12px; }
        .sena-img { width: 84px; height: 84px; }
        .game-frame { width: min(720px, 96vw); }
    }

    /* mobile */
    @media (max-width: 720px) {
        .game-wrap { align-items: flex-start; padding: 14px; }
        .game-frame { margin-top: 4vh; width: min(720px, 96vw); }
        .compact-card { border-radius: 10px; }
        .sena-grid { grid-template-columns: repeat(3, 1fr); gap: 10px; }
        .sena-card { min-height: 120px; padding: 8px; }
        .sena-img { width: 72px; height: 72px; }
        .letra-box { min-width: 34px; min-height: 34px; font-size: 0.96rem; }
        .progress-pill { width: 100px; height: 26px; }
        .actions-row { gap: 6px; }
        /* make buttons easier to tap: stack when narrow */
        .actions-row button { flex: 1 1 auto; min-width: 0; }
        .title { font-size: 1rem; }
    }

    /* very small phones */
    @media (max-width: 420px) {
        .sena-grid { grid-template-columns: repeat(3, 1fr); gap: 8px; }
        .sena-card { min-height: 112px; }
        .sena-img { width: 64px; height: 64px; }
        .progress-pill { width: 90px; height: 24px; }
        .game-frame { margin-top: 3vh; }
    }
</style>

<script>
    (function () {
        const letras = @json($letrasNombre);
        const total = letras.length;
        let actual = 0;
        const mensajeEl = document.getElementById('mensaje');
        const progressBar = document.getElementById('gameProgress');
        const progressLabel = document.getElementById('progressLabel');
        const btnReset = document.getElementById('btnReset');
        const btnReveal = document.getElementById('btnReveal');
        const btnHint = document.getElementById('btnHint');
        const btnComplete = document.getElementById('btnComplete');
        const completeForm = document.getElementById('completeForm');
        const cards = Array.from(document.querySelectorAll('.sena-card'));

        const targetSeq = letras.map(s => String(s || ''));

        // init badges
        cards.forEach(c => {
            const badge = c.querySelector('.order-badge');
            badge.textContent = '';
        });

        function updateProgress() {
            const percent = Math.round((actual / total) * 100) || 0;
            progressBar.style.width = percent + '%';
            progressBar.setAttribute('aria-valuenow', percent);
            progressLabel.textContent = percent + '%';

            if (actual === total) {
                btnComplete.disabled = false;
                btnComplete.setAttribute('aria-disabled', 'false');
            } else {
                btnComplete.disabled = true;
                btnComplete.setAttribute('aria-disabled', 'true');
            }
        }

        function markCorrect(card, index) {
            card.classList.add('acertado');
            card.setAttribute('aria-pressed', 'true');
            const badge = card.querySelector('.order-badge');
            badge.textContent = index + 1;
            badge.classList.add('acertado');
            card.style.pointerEvents = 'none';
        }

        function showSuccess() {
            mensajeEl.innerHTML = '<span style="color:var(--success)">¡Felicidades! Has deletreado tu nombre correctamente. 🎉</span>';
        }

        function showTemporaryError(text = 'Selección incorrecta. Intenta otra vez.') {
            mensajeEl.innerHTML = '<span style="color:var(--danger)">' + text + '</span>';
        }

        function resetAttempt(keepMessage = false) {
            actual = 0;
            updateProgress();
            if (!keepMessage) mensajeEl.innerHTML = '';
            cards.forEach(c => {
                c.classList.remove('acertado', 'incorrecto');
                c.style.pointerEvents = '';
                c.setAttribute('aria-pressed', 'false');
                const badge = c.querySelector('.order-badge');
                badge.textContent = '';
                badge.classList.remove('acertado', 'incorrecto');
            });
        }

        function revealAnswer() {
            resetAttempt(true);
            const mapping = {};
            targetSeq.forEach((t, idx) => {
                const found = cards.find(c => c.dataset.letra === t && !Object.values(mapping).includes(c));
                if (found) mapping[idx] = found;
            });
            Object.keys(mapping).forEach(k => {
                const c = mapping[k];
                markCorrect(c, Number(k));
            });
            actual = total;
            updateProgress();
            showSuccess();
        }

        function handleSelect(card) {
            if (card.classList.contains('acertado') || card.classList.contains('incorrecto')) return;
            const letra = card.dataset.letra;
            const esperado = targetSeq[actual];
            if (letra === esperado) {
                markCorrect(card, actual);
                actual++;
                updateProgress();
                mensajeEl.innerHTML = '';
                if (actual === total) setTimeout(showSuccess, 180);
            } else {
                card.classList.add('incorrecto');
                const badge = card.querySelector('.order-badge');
                badge.textContent = '✕';
                badge.classList.add('incorrecto');
                showTemporaryError('¡Ups! Seleccionaste una seña incorrecta. Reiniciando...');
                setTimeout(() => { resetAttempt(); mensajeEl.innerHTML = ''; }, 700);
            }
        }

        cards.forEach(card => {
            card.addEventListener('click', (e) => { e.preventDefault(); handleSelect(card); });
            card.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); handleSelect(card); }});
            card.setAttribute('tabindex', '0');
            card.addEventListener('touchstart', () => { card.classList.add('touched'); setTimeout(() => card.classList.remove('touched'), 200); });
        });

        btnReset.addEventListener('click', () => { resetAttempt(); mensajeEl.innerHTML = '<span style="color:var(--muted)">Intento reiniciado.</span>'; });
        btnReveal.addEventListener('click', () => { revealAnswer(); });
        btnHint.addEventListener('click', () => {
            const next = targetSeq[actual];
            if (!next) return;
            const found = cards.find(c => c.dataset.letra === next && !c.classList.contains('acertado'));
            if (!found) return;
            found.classList.add('acertado');
            const badge = found.querySelector('.order-badge');
            badge.textContent = actual + 1;
            badge.classList.add('acertado');
            found.style.pointerEvents = 'none';
            actual++;
            updateProgress();
            mensajeEl.innerHTML = '<span style="color:var(--accent)">Sugerencia aplicada.</span>';
            if (actual === total) showSuccess();
        });

        completeForm.addEventListener('submit', (e) => {
            if (actual !== total) {
                e.preventDefault();
                mensajeEl.innerHTML = '<span style="color:var(--danger)">No puedes completar la lección hasta deletrear correctamente.</span>';
                const y = Math.max(0, document.querySelector('.game-wrap').offsetTop - 20);
                window.scrollTo({ top: y, behavior: 'smooth' });
                return false;
            }
        });

        // init
        updateProgress();
        mensajeEl.innerHTML = '<span style="color:var(--muted)">Selecciona la primera seña para comenzar.</span>';
    })();
</script>
