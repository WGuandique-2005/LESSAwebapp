@php
    // Cargar datos de números y tomar 8 aleatorios
    $numeros = json_decode(file_get_contents(storage_path('app/numeros.json')), true) ?? [];
    shuffle($numeros);
    $numerosJuego = array_slice($numeros, 0, min(6, count($numeros)));

    // Preparar significados (solo de los 8 seleccionados) y barajarlos
    $significados = array_map(function ($n) {
        return ['id' => $n['id'], 'nombre' => $n['nombre']];
    }, $numerosJuego);
    shuffle($significados);
@endphp
<head><title>Números: Test</title>
<meta name="viewport" content="width=device-width, initial-scale=1"></head>
@include('partials.navbar')

<div class="game-wrap">
    <div class="game-frame">
        <header class="game-header">
            <div class="head-text">
                <h1 class="title">Conecta la seña con su significado</h1>
                <p class="subtitle">Arrastra o toca para conectar cada seña con su descripción correcta.</p>
            </div>
            <div class="controls">
                <div class="progress-pill" role="progressbar" aria-label="Progreso de juego" aria-valuemin="0"
                    aria-valuemax="100" aria-valuenow="0" id="progressPill">
                    <div id="gameProgress" class="progress-inner"></div>
                    <span id="progressLabel" class="progress-label">0%</span>
                </div>
            </div>
        </header>

        <div class="card compact-card">
            <div class="card-body">

                <div id="mensaje" class="mt-2" aria-live="polite" role="status"></div>

                <div class="play-area">
                    <div class="sena-column" aria-label="Señas (destinatarios)">
                        <h3 class="col-title">Señas</h3>
                        <div class="sena-grid" id="senaGrid">
                            @foreach($numerosJuego as $num)
                                <div class="sena-card drop-zone" data-id="{{ $num['id'] }}" tabindex="0"
                                    aria-dropeffect="none">
                                    <div class="sena-media">
                                        <img src="{{ $num['ruta'] }}" alt="{{ $num['nombre'] }}" class="sena-img"
                                            loading="lazy" draggable="false">
                                    </div>
                                    <div class="drop-target" id="drop-{{ $num['id'] }}" aria-hidden="false"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="significados-column" aria-label="Significados (draggables)">
                        <h3 class="col-title">Significados</h3>
                        <div class="significados-list" id="significadosList">
                            @foreach($significados as $sig)
                                <div class="significado-card draggable" draggable="true" data-id="{{ $sig['id'] }}"
                                    tabindex="0" role="button" aria-grabbed="false">
                                    <div class="significado-nombre">{{ $sig['nombre'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <form id="completeForm" class="actions-row" method="POST"
                    action="{{ route('lecciones.numeros.complete') }}">
                    @csrf
                    <input type="hidden" name="assigned" id="assignedInput" value="{}">
                    <button id="btnReset" class="btn-ghost" type="button">Reintentar</button>
                    <button id="btnComplete" class="btn-primary" type="submit" disabled aria-disabled="true"
                        title="Completar lección">Completar</button>
                </form>
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
        --glass: rgba(255, 255, 255, 0.65);
        --radius: 14px;
        --shadow-soft: 0 12px 36px rgba(12, 24, 60, 0.06);
    }

    html,
    body {
        height: 100%;
        margin: 0;
        background: linear-gradient(180deg, var(--bg), #ffffff);
        -webkit-font-smoothing: antialiased;
        font-family: Poppins, system-ui, -apple-system, "Segoe UI", Roboto, Arial;
    }

    .game-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 18px;
        box-sizing: border-box;
    }

    .game-frame {
        width: min(900px, 96vw);
        display: flex;
        flex-direction: column;
        gap: 14px;
        margin: 0 auto;
    }

    .game-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 6px 8px;
    }

    .head-text {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .title {
        font-size: 1.15rem;
        margin: 0;
        color: #0f172a;
        font-weight: 800;
    }

    .subtitle {
        margin: 0;
        font-size: 0.92rem;
        color: var(--muted);
    }

    .progress-pill {
        position: relative;
        width: 130px;
        height: 30px;
        border-radius: 999px;
        background: linear-gradient(90deg, #eef6ff, #fbfdff);
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
        width: 0;
        background: linear-gradient(90deg, var(--accent), var(--accent-2));
        border-radius: 999px;
        transition: width .25s ease;
    }

    .progress-label {
        position: relative;
        z-index: 2;
        font-weight: 700;
        color: #04203b;
        font-size: 0.82rem;
    }

    .compact-card {
        background: var(--card);
        border-radius: var(--radius);
        box-shadow: var(--shadow-soft);
        border: 1px solid rgba(13, 27, 62, 0.04);
        overflow: hidden;
    }

    .card-body {
        padding: 14px;
    }

    /* Play area layout */
    .play-area {
        display: flex;
        gap: 18px;
        align-items: flex-start;
        justify-content: space-between;
    }

    .sena-column,
    .significados-column {
        flex: 1;
        min-width: 0;
    }

    .col-title {
        font-size: 0.95rem;
        margin: 0 0 8px 0;
        color: var(--muted);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em
    }

    /* Señas grid */
    .sena-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 12px;
    }

    .sena-card {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 12px;
        background: linear-gradient(180deg, #fff, #fbfdff);
        border-radius: 12px;
        border: 1px solid rgba(10, 25, 60, 0.04);
        box-shadow: 0 6px 18px rgba(8, 20, 45, 0.03);
        min-height: 120px;
        text-align: center;
        transition: transform .12s ease, box-shadow .12s ease;
    }

    .sena-card:focus {
        outline: 3px solid rgba(11, 99, 255, 0.12);
        outline-offset: 3px
    }

    .sena-media {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%
    }

    .sena-img {
        width: 96px;
        height: 96px;
        object-fit: contain;
        border-radius: 8px;
        background: linear-gradient(180deg, #fff, #f7fbff);
        border: 1px solid rgba(10, 25, 60, 0.03)
    }

    .drop-target {
        min-height: 44px;
        margin-top: 10px;
        background: var(--glass);
        border-radius: 10px;
        border: 1px dashed rgba(90, 100, 120, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 6px 8px;
        color: var(--muted);
        min-width: 120px;
        transition: all .18s ease
    }

    /* Significados draggable */
    .significados-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: stretch
    }

    .significado-card {
        background: #fff;
        border-radius: 10px;
        padding: 10px;
        border: 1px solid rgba(10, 25, 60, 0.06);
        box-shadow: 0 6px 18px rgba(8, 20, 45, 0.03);
        cursor: grab;
        transition: transform .12s ease, box-shadow .12s ease;
        display: flex;
        flex-direction: column;
        gap: 6px
    }

    .significado-card:active {
        cursor: grabbing
    }

    .significado-card[aria-grabbed="true"] {
        opacity: 0.7;
        transform: scale(.995)
    }

    .significado-nombre {
        font-weight: 800;
        color: var(--accent)
    }

    /* states */
    .drop-zone.over {
        border-color: var(--accent-2);
        background: #eaf6ff
    }

    .drop-zone.acertado {
        background: #f2fbf4;
        border-color: rgba(22, 163, 74, 0.12)
    }

    .drop-zone.incorrecto {
        background: #fff6f7;
        border-color: rgba(239, 68, 68, 0.12);
        animation: shake .36s
    }

    .significado-card.hidden {
        display: none
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

    .actions-row {
        display: flex;
        gap: 8px;
        justify-content: center;
        margin-top: 12px;
        flex-wrap: wrap
    }

    .btn-ghost {
        background: transparent;
        border: 1px solid rgba(10, 25, 60, 0.06);
        color: #0b254a;
        padding: 8px 12px;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer
    }

    .btn-primary {
        background: linear-gradient(90deg, var(--accent), var(--accent-2));
        color: #fff;
        border: none;
        padding: 8px 14px;
        border-radius: 10px;
        font-weight: 800;
        cursor: pointer
    }

    .btn-primary[disabled] {
        opacity: .6;
        cursor: not-allowed
    }

    #mensaje {
        min-height: 22px;
        text-align: center;
        margin-top: 6px;
        font-weight: 700;
        color: var(--muted)
    }

    /* Responsive adjustments */
    @media (min-width: 880px) {
        .play-area {
            flex-direction: row
        }

        .sena-grid {
            grid-template-columns: repeat(2, 1fr)
        }

        .significados-list {
            flex-direction: column
        }
    }

    @media (max-width: 879px) {
        .play-area {
            flex-direction: column
        }

        .sena-grid {
            grid-template-columns: repeat(2, 1fr)
        }

        .significados-list {
            flex-direction: row;
            flex-wrap: wrap;
            gap: 8px
        }

        .significado-card {
            min-width: calc(50% - 8px)
        }
    }

    @media (max-width: 520px) {
        .sena-grid {
            grid-template-columns: repeat(2, 1fr)
        }

        .sena-img {
            width: 78px;
            height: 78px
        }

        .drop-target {
            min-width: 100px
        }

        .significado-card {
            min-width: 100%
        }

        .game-frame {
            padding: 12px
        }

        .title {
            font-size: 1rem
        }
    }
</style>

<script>
    (function () {
        const dropZones = Array.from(document.querySelectorAll('.drop-zone'));
        const draggables = Array.from(document.querySelectorAll('.draggable'));
        const mensajeEl = document.getElementById('mensaje');
        const progressBar = document.getElementById('gameProgress');
        const progressLabel = document.getElementById('progressLabel');
        const btnReset = document.getElementById('btnReset');
        const btnComplete = document.getElementById('btnComplete');
        const completeForm = document.getElementById('completeForm');
        const assignedInput = document.getElementById('assignedInput');

        let total = dropZones.length;
        let correctas = 0;
        let assignments = {};
        let selectedSign = null;

        function updateProgress() {
            const percent = Math.round((correctas / total) * 100) || 0;
            progressBar.style.width = percent + '%';
            progressBar.setAttribute('aria-valuenow', percent);
            progressLabel.textContent = percent + '%';
            assignedInput.value = JSON.stringify(assignments);
            if (correctas === total) {
                btnComplete.disabled = false;
                btnComplete.setAttribute('aria-disabled', 'false');
                mensajeEl.innerHTML = '<span style="color:var(--success); font-size:1.1rem;">🎉 ¡Felicidades! Has completado todas las conexiones correctamente. 🎉</span>';
            } else {
                btnComplete.disabled = true;
                btnComplete.setAttribute('aria-disabled', 'true');
            }
        }

        function resetGame() {
            assignments = {};
            correctas = 0;
            selectedSign = null;
            draggables.forEach(d => {
                d.classList.remove('hidden');
                d.setAttribute('aria-grabbed', 'false');
            });
            dropZones.forEach(z => {
                z.classList.remove('acertado', 'incorrecto', 'over');
                const target = z.querySelector('.drop-target');
                target.textContent = '';
                z.setAttribute('aria-dropeffect', 'none');
            });
            mensajeEl.innerHTML = '<span style="color:var(--muted)">Arrastra o toca para conectar cada seña.</span>';
            updateProgress();
        }

        draggables.forEach(d => {
            d.addEventListener('dragstart', (e) => {
                d.setAttribute('aria-grabbed', 'true');
                d.classList.add('dragging');
                try { e.dataTransfer.setData('text/plain', d.dataset.id); } catch (err) { }
            });
            d.addEventListener('dragend', () => {
                d.classList.remove('dragging');
                d.setAttribute('aria-grabbed', 'false');
            });

            d.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    toggleSelectSign(d);
                }
            });

            d.addEventListener('click', (e) => {
                e.preventDefault();
                toggleSelectSign(d);
            });
        });

        dropZones.forEach(z => {
            z.addEventListener('dragover', (e) => {
                e.preventDefault();
                z.classList.add('over');
            });
            z.addEventListener('dragleave', () => z.classList.remove('over'));
            z.addEventListener('drop', (e) => {
                e.preventDefault();
                z.classList.remove('over');
                const id = e.dataTransfer.getData('text/plain');
                if (!id) return;
                const signEl = draggables.find(d => d.dataset.id === id);
                if (!signEl) return;
                tryAssign(z, signEl);
            });

            z.addEventListener('click', (e) => {
                if (!selectedSign) return;
                tryAssign(z, selectedSign);
            });

            z.addEventListener('keydown', (e) => {
                if ((e.key === 'Enter' || e.key === ' ') && selectedSign) {
                    e.preventDefault();
                    tryAssign(z, selectedSign);
                }
            });
        });

        function tryAssign(z, signEl) {
            const dropId = z.dataset.id;
            const signId = signEl.dataset.id;

            if (assignments[dropId] === signId) return;

            const used = Object.values(assignments).includes(signId);
            if (used) {
                mensajeEl.innerHTML = '<span style="color:var(--muted)">Esa tarjeta ya fue usada.</span>';
                const usedDrop = dropZones.find(d => assignments[d.dataset.id] === signId);
                if (usedDrop) {
                    usedDrop.classList.add('incorrecto');
                    setTimeout(() => usedDrop.classList.remove('incorrecto'), 600);
                }
                return;
            }

            if (dropId === signId) {
                z.classList.remove('incorrecto');
                z.classList.add('acertado');
                z.querySelector('.drop-target').textContent = signEl.querySelector('.significado-nombre').textContent;
                signEl.classList.add('hidden');
                assignments[dropId] = signId;
                correctas = Object.keys(assignments).length;
                mensajeEl.innerHTML = '<span style="color:var(--success)">¡Correcto!</span>';
            } else {
                z.classList.add('incorrecto');
                z.querySelector('.drop-target').textContent = signEl.querySelector('.significado-nombre').textContent;
                mensajeEl.innerHTML = '<span style="color:var(--danger)">¡No corresponde ese significado!</span>';
                setTimeout(() => {
                    z.classList.remove('incorrecto');
                    z.querySelector('.drop-target').textContent = '';
                    mensajeEl.innerHTML = '<span style="color:var(--muted)">Sigue intentando.</span>';
                }, 800);
            }

            if (selectedSign) {
                selectedSign.classList.remove('selected');
                selectedSign = null;
            }
            updateProgress();
        }

        function toggleSelectSign(el) {
            if (selectedSign === el) {
                el.classList.remove('selected');
                selectedSign = null;
                mensajeEl.innerHTML = '<span style="color:var(--muted)">Selecciona una seña o arrastra una tarjeta.</span>';
                return;
            }
            if (selectedSign) selectedSign.classList.remove('selected');
            selectedSign = el;
            el.classList.add('selected');
            mensajeEl.innerHTML = '<span style="color:var(--muted)">Toca la seña donde quieres colocar: <strong>' + (el.querySelector('.significado-nombre')?.textContent || '') + '</strong></span>';
        }

        btnReset.addEventListener('click', resetGame);

        completeForm.addEventListener('submit', function (e) {
            if (correctas !== total) {
                e.preventDefault();
                mensajeEl.innerHTML = '<span style="color:var(--danger)">Debes conectar todas las señas correctamente.</span>';
                return false;
            }
        });

        resetGame();
    })();
</script>