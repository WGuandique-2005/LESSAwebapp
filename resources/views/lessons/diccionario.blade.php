@include('partials.navbar')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Diccionario Interactivo</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --radius: 16px;
            --radius-sm: 12px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { box-sizing: border-box; -webkit-tap-highlight-color: transparent; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text-main);
            margin: 0;
            line-height: 1.5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px 20px;
            min-height: 80vh;
        }

        /* --- Header --- */
        .header {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 24px;
        }

        @media(min-width: 768px) {
            .header {
                flex-direction: row;
                justify-content: space-between;
                align-items: flex-end;
            }
        }

        .title h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            background: linear-gradient(135deg, var(--text-main) 0%, var(--primary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .title p { margin: 4px 0 0; color: var(--text-muted); font-size: 0.95rem; }

        /* --- Search --- */
        .search-wrapper {
            position: relative;
            width: 100%;
            max-width: 320px;
        }
        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
        }
        .search-input {
            width: 100%;
            padding: 12px 16px 12px 44px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 1rem;
            font-family: inherit;
            outline: none;
            transition: var(--transition);
            background: var(--card-bg);
            box-shadow: var(--shadow-sm);
        }
        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        /* --- Tabs --- */
        .tabs-container {
            position: relative;
            margin-bottom: 28px;
        }
        .tabs-container::after {
            content: '';
            position: absolute;
            right: 0; top: 0; bottom: 0;
            width: 40px;
            background: linear-gradient(to right, transparent, var(--bg));
            pointer-events: none;
        }
        
        .sections {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding-bottom: 8px;
            scrollbar-width: none;
        }
        .sections::-webkit-scrollbar { display: none; }

        .tab-btn {
            background: var(--card-bg);
            border: 1px solid var(--border);
            padding: 10px 20px;
            border-radius: 100px;
            font-weight: 500;
            font-size: 0.95rem;
            color: var(--text-muted);
            cursor: pointer;
            white-space: nowrap;
            transition: var(--transition);
        }
        .tab-btn:hover { background: #f1f5f9; color: var(--text-main); }
        
        .tab-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            transform: translateY(-1px);
        }

        /* --- Grid & Cards --- */
        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }
        @media(min-width: 640px) { .grid { grid-template-columns: repeat(2, 1fr); } }
        @media(min-width: 1024px) { .grid { grid-template-columns: repeat(3, 1fr); gap: 24px; } }

        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 12px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 16px;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: #bfdbfe;
        }
        
        .card-thumb {
            flex-shrink: 0;
            width: 88px;
            height: 88px;
            border-radius: var(--radius-sm);
            background: #f1f5f9;
            overflow: hidden;
            border: 1px solid var(--border);
            display: grid;
            place-items: center;
        }
        .card-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .card:hover .card-thumb img { transform: scale(1.08); }

        .card-meta { flex: 1; min-width: 0; }
        
        .card-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-name::after {
            content: '→';
            font-size: 1.2rem;
            opacity: 0;
            transform: translateX(-10px);
            transition: var(--transition);
            color: var(--primary);
        }
        .card:hover .card-name::after { opacity: 1; transform: translateX(0); }

        .card-desc {
            font-size: 0.875rem;
            color: var(--text-muted);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        .empty {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
            grid-column: 1 / -1;
            display: none;
            animation: fadeIn 0.3s ease;
        }
        .empty svg { width: 64px; height: 64px; margin-bottom: 16px; opacity: 0.5; }

        /* --- Modal --- */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-backdrop.show { opacity: 1; visibility: visible; }

        .modal-content {
            background: white;
            width: 100%;
            max-width: 700px;
            position: relative;
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-lg);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Desktop Modal */
        @media (min-width: 768px) {
            .modal-content {
                border-radius: 20px;
                flex-direction: row;
                overflow: hidden;
                height: 400px;
                transform: scale(0.95);
            }
            .modal-backdrop.show .modal-content { transform: scale(1); }
            
            .modal-img-col { width: 45%; height: 100%; background: #f8fafc; border-right: 1px solid var(--border); position: relative;}
            .modal-img-col img { width: 100%; height: 100%; object-fit: contain; padding: 20px; }
            .modal-body-col { width: 55%; padding: 40px; overflow-y: auto; position: relative; }
        }

        /* Mobile Modal (Bottom Sheet) */
        @media (max-width: 767px) {
            .modal-backdrop { align-items: flex-end; }
            .modal-content {
                border-top-left-radius: 24px;
                border-top-right-radius: 24px;
                max-height: 85vh;
                transform: translateY(100%);
            }
            .modal-backdrop.show .modal-content { transform: translateY(0); }

            .modal-content::before {
                content: ''; position: absolute; top: 12px; left: 50%; transform: translateX(-50%);
                width: 40px; height: 4px; background: #cbd5e1; border-radius: 4px; z-index: 2;
            }
            .modal-img-col { height: 240px; background: #f1f5f9; display: flex; justify-content: center; align-items: center; }
            .modal-img-col img { max-height: 100%; max-width: 100%; padding: 20px; }
            .modal-body-col { padding: 24px; overflow-y: auto; }
        }

        .modal-close-btn {
            position: absolute;
            top: 16px; right: 16px;
            background: rgba(255,255,255,0.8);
            border: none;
            width: 36px; height: 36px;
            border-radius: 50%;
            font-size: 1.2rem;
            cursor: pointer;
            display: grid;
            place-items: center;
            z-index: 10;
            color: var(--text-main);
            box-shadow: var(--shadow-sm);
        }
        .modal-close-btn:hover { background: white; color: var(--primary); }

        /* Modal Header & Audio Button */
        .modal-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            gap: 10px;
        }
        .modal-title { font-size: 1.5rem; font-weight: 700; margin: 0; color: var(--text-main); flex: 1; }
        .modal-desc { color: var(--text-muted); font-size: 1rem; line-height: 1.6; }

        .btn-speak {
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--primary);
            width: 42px; height: 42px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }
        .btn-speak:hover { background: var(--primary); color: white; transform: scale(1.05); }
        
        /* Animación cuando está hablando */
        .btn-speak.speaking {
            background: var(--primary-dark);
            color: white;
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>
<body>

    <div class="container" role="main">
        
        <div class="header">
            <div class="title">
                <h1>Diccionario Lessa</h1>
                <p>Explora y aprende señas de forma interactiva.</p>
            </div>
            <div class="search-wrapper">
                <svg class="search-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input id="search" class="search-input" type="text" placeholder="Buscar seña (ej. Hola, A...)" aria-label="Buscar">
            </div>
        </div>

        <div class="tabs-container">
            <div class="sections" role="tablist">
                <button class="tab-btn active" data-section="abecedario" role="tab">Abecedario</button>
                <button class="tab-btn" data-section="numeros" role="tab">Números</button>
                <button class="tab-btn" data-section="salud" role="tab">Salud</button>
                <button class="tab-btn" data-section="saludos" role="tab">Saludos</button>
            </div>
        </div>

        <div class="content-area">
            <div id="items" class="grid" aria-live="polite"></div>
            
            <div id="empty" class="empty">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p>No encontramos señas con ese nombre.</p>
            </div>
        </div>
    </div>

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
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path>
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
                btn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
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
                    <div class="card-name">${safeName}</div>
                    <div class="card-desc">${safeDesc || 'Sin descripción disponible.'}</div>
                </div>
            `;

            el.addEventListener('click', () => openModal(item));
            el.addEventListener('keydown', (e) => {
                if(e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openModal(item); }
            });
            return el;
        }

        // --- Lógica de Modal y Voz ---
        function openModal(item) {
            stopSpeech(); // Detener audio anterior si existe

            mImg.src = item.ruta || '';
            mImg.alt = item.nombre || 'Imagen detalle';
            mTitle.textContent = item.nombre || 'Detalle';
            
            const descText = (item.descripcion && item.descripcion.trim() !== "") 
                ? item.descripcion 
                : 'No hay descripción detallada disponible para esta seña.';
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
        modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });
        window.addEventListener('beforeunload', stopSpeech);

        // Helpers
        function escapeHtml(str) { return String(str||'').replace(/[&<>"']/g, s=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[s]); }
        function escapeAttr(s) { return (s||'').replace(/"/g, '&quot;'); }
        function truncate(str, n) { return (str && str.length > n) ? str.slice(0, n - 1) + '...' : str; }

        // Inicio
        render();
    </script>
</body>
</html>