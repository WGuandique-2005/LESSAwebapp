@include('partials.navbar')

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Diccionario Interactivo - LESSA</title>
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
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- HERO SECTION (Simplified) --- */
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
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .hero-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            font-weight: 300;
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

        /* --- CONTROLS (Search & Tabs) --- */
        .controls-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: var(--shadow-lg);
            margin-bottom: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        @media(min-width: 768px) {
            .controls-card {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }

        /* Search */
        .search-wrapper {
            position: relative;
            width: 100%;
            max-width: 400px;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            border: 1px solid #e5e7eb;
            border-radius: var(--radius-full);
            font-size: 0.95rem;
            font-family: inherit;
            outline: none;
            transition: var(--transition-base);
            background: #f9fafb;
        }

        .search-input:focus {
            border-color: var(--primary-color);
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Tabs */
        .tabs-container {
            overflow-x: auto;
            padding-bottom: 4px;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .tabs-container::-webkit-scrollbar { display: none; }

        .sections {
            display: flex;
            gap: 0.5rem;
        }

        .tab-btn {
            background: transparent;
            border: 1px solid #e5e7eb;
            padding: 0.5rem 1.25rem;
            border-radius: var(--radius-full);
            font-weight: 500;
            font-size: 0.9rem;
            color: var(--text-secondary);
            cursor: pointer;
            white-space: nowrap;
            transition: var(--transition-base);
        }

        .tab-btn:hover {
            background: #f3f4f6;
            color: var(--text-main);
        }

        .tab-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            box-shadow: var(--shadow-sm);
        }

        /* --- GRID & CARDS --- */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 1rem;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            transition: var(--transition-base);
            border: 1px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(37, 99, 235, 0.1);
        }

        .card-thumb {
            flex-shrink: 0;
            width: 80px;
            height: 80px;
            border-radius: var(--radius-lg);
            background: #f1f5f9;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card:hover .card-thumb img {
            transform: scale(1.1);
        }

        .card-meta {
            flex: 1;
            min-width: 0;
        }

        .card-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-arrow {
            color: var(--primary-color);
            opacity: 0;
            transform: translateX(-10px);
            transition: var(--transition-base);
            font-size: 1rem;
        }

        .card:hover .card-arrow {
            opacity: 1;
            transform: translateX(0);
        }

        .card-desc {
            font-size: 0.85rem;
            color: var(--text-secondary);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        .empty {
            text-align: center;
            padding: 4rem 1rem;
            color: var(--text-secondary);
            grid-column: 1 / -1;
            display: none;
        }

        .empty svg {
            width: 64px;
            height: 64px;
            margin-bottom: 1rem;
            opacity: 0.5;
            color: var(--text-secondary);
        }

        /* --- MODAL --- */
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

        .modal-content {
            background: var(--bg-card);
            width: 100%;
            max-width: 800px;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transform: scale(0.95);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            max-height: 90vh;
        }

        .modal-backdrop.show .modal-content {
            transform: scale(1);
        }

        @media (min-width: 768px) {
            .modal-content {
                flex-direction: row;
                height: 500px;
            }

            .modal-img-col {
                width: 50%;
                height: 100%;
                background: #f8fafc;
                border-right: 1px solid #e5e7eb;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
            }

            .modal-img-col img {
                max-width: 100%;
                max-height: 100%;
                object-fit: contain;
                border-radius: var(--radius-lg);
                box-shadow: var(--shadow-sm);
            }

            .modal-body-col {
                width: 50%;
                padding: 2.5rem;
                overflow-y: auto;
                display: flex;
                flex-direction: column;
            }
        }

        @media (max-width: 767px) {
            .modal-img-col {
                height: 250px;
                background: #f8fafc;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1.5rem;
            }

            .modal-img-col img {
                max-height: 100%;
                max-width: 100%;
                object-fit: contain;
            }

            .modal-body-col {
                padding: 1.5rem;
                overflow-y: auto;
            }
        }

        .modal-close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            color: var(--text-secondary);
            box-shadow: var(--shadow-sm);
            transition: var(--transition-base);
        }

        .modal-close-btn:hover {
            background: white;
            color: var(--danger-color);
            transform: rotate(90deg);
        }

        .modal-header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            gap: 1rem;
        }

        .modal-title {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            color: var(--text-main);
            line-height: 1.2;
        }

        .modal-desc {
            color: var(--text-secondary);
            font-size: 1.05rem;
            line-height: 1.7;
            flex-grow: 1;
        }

        .btn-speak {
            background: var(--primary-light);
            border: none;
            color: var(--primary-color);
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition-base);
            flex-shrink: 0;
        }

        .btn-speak:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
            box-shadow: var(--shadow-md);
        }

        .btn-speak.speaking {
            background: var(--primary-dark);
            color: white;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4); }
            70% { box-shadow: 0 0 0 15px rgba(37, 99, 235, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0); }
        }

    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;">
            <h1 class="hero-title">Diccionario LESSA</h1>
            <p class="hero-subtitle">Explora y aprende señas de forma interactiva.</p>
        </div>
    </section>

    <div class="main-container" role="main">

        <!-- Controls Card -->
        <div class="controls-card">
            <div class="search-wrapper">
                <svg class="search-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input id="search" class="search-input" type="text" placeholder="Buscar seña (ej. Hola, A...)"
                    aria-label="Buscar">
            </div>

            <div class="tabs-container">
                <div class="sections" role="tablist">
                    <button class="tab-btn active" data-section="abecedario" role="tab">Abecedario</button>
                    <button class="tab-btn" data-section="numeros" role="tab">Números</button>
                    <button class="tab-btn" data-section="salud" role="tab">Salud</button>
                    <button class="tab-btn" data-section="saludos" role="tab">Saludos</button>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <div id="items" class="grid" aria-live="polite"></div>

            <div id="empty" class="empty">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p>No encontramos señas con ese nombre.</p>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="modal-backdrop" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <button id="modal-close" class="modal-close-btn" aria-label="Cerrar">&times;</button>
            <div class="modal-img-col">
                <img id="modal-img" src="" alt="">
            </div>
            <div class="modal-body-col">
                <div class="modal-header-row">
                    <h3 id="modal-title" class="modal-title"></h3>
                    <button id="btn-speak" class="btn-speak" aria-label="Escuchar descripción">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z">
                            </path>
                        </svg>
                    </button>
                </div>
                <div id="modal-desc" class="modal-desc"></div>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <script>
        const sectionsData = {
            abecedario: @json($abecedario),
            numeros: @json($numeros),
            salud: @json($salud),
            saludos: @json($saludos)
        };

        let activeSection = 'abecedario';

        // Elementos del DOM
        const itemsEl = document.getElementById('items');
        const emptyEl = document.getElementById('empty');
        const searchEl = document.getElementById('search');
        const modal = document.getElementById('modal');
        const mImg = document.getElementById('modal-img');
        const mTitle = document.getElementById('modal-title');
        const mDesc = document.getElementById('modal-desc');
        const btnSpeak = document.getElementById('btn-speak');

        // API de Voz
        const synth = window.speechSynthesis;
        let currentUtterance = null;

        // --- Lógica de Tabs ---
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                activeSection = btn.getAttribute('data-section');
                searchEl.value = '';
                // btn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                render();
            });
        });

        // --- Lógica de Búsqueda y Renderizado ---
        searchEl.addEventListener('input', () => render());

        function render() {
            const list = sectionsData[activeSection] || [];
            const query = searchEl.value.trim().toLowerCase();
            const filtered = list.filter(item => {
                const name = (item.nombre || '').toLowerCase();
                const desc = (item.descripcion || '').toLowerCase();
                return !query || name.includes(query) || desc.includes(query);
            });

            itemsEl.innerHTML = '';
            if (filtered.length === 0) {
                emptyEl.style.display = 'block';
            } else {
                emptyEl.style.display = 'none';
                filtered.forEach(item => itemsEl.appendChild(createCard(item)));
            }
        }

        function createCard(item) {
            const el = document.createElement('div');
            el.className = 'card';
            el.setAttribute('role', 'button');
            el.tabIndex = 0;

            const safeName = escapeHtml(item.nombre);
            const safeDesc = escapeHtml(truncate(item.descripcion, 90));

            el.innerHTML = `
                <div class="card-thumb">
                    <img src="${escapeAttr(item.ruta)}" alt="Seña para ${safeName}" loading="lazy">
                </div>
                <div class="card-meta">
                    <div class="card-name">
                        ${safeName}
                        <span class="card-arrow">→</span>
                    </div>
                    <div class="card-desc">${safeDesc || 'Sin descripción disponible.'}</div>
                </div>
            `;

            el.addEventListener('click', () => openModal(item));
            el.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    openModal(item);
                }
            });
            return el;
        }

        // --- Lógica de Modal y Voz ---
        function openModal(item) {
            stopSpeech(); // Detener audio anterior si existe

            mImg.src = item.ruta || '';
            mImg.alt = item.nombre || 'Imagen detalle';
            mTitle.textContent = item.nombre || 'Detalle';

            const descText = (item.descripcion && item.descripcion.trim() !== "") ?
                item.descripcion :
                'No hay descripción detallada disponible para esta seña.';
            mDesc.textContent = descText;

            modal.classList.add('show');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            stopSpeech(); // Importante: Detener voz al cerrar
            modal.classList.remove('show');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        function toggleSpeech() {
            if (synth.speaking) {
                stopSpeech();
                return;
            }
            const textToRead = mDesc.textContent;
            if (!textToRead) return;

            const utterance = new SpeechSynthesisUtterance(textToRead);
            utterance.lang = 'es-ES';

            utterance.onstart = () => btnSpeak.classList.add('speaking');
            utterance.onend = () => btnSpeak.classList.remove('speaking');
            utterance.onerror = () => btnSpeak.classList.remove('speaking');

            currentUtterance = utterance;
            synth.speak(utterance);
        }

        function stopSpeech() {
            if (synth.speaking) synth.cancel();
            btnSpeak.classList.remove('speaking');
        }

        // Event Listeners de Modal y Voz
        btnSpeak.addEventListener('click', toggleSpeech);
        document.getElementById('modal-close').addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });
        window.addEventListener('beforeunload', stopSpeech);

        // Helpers
        function escapeHtml(str) {
            return String(str || '').replace(/[&<>"']/g, s => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            })[s]);
        }

        function escapeAttr(s) {
            return (s || '').replace(/"/g, '&quot;');
        }

        function truncate(str, n) {
            return (str && str.length > n) ? str.slice(0, n - 1) + '...' : str;
        }

        // Inicio
        render();
    </script>
</body>

</html>