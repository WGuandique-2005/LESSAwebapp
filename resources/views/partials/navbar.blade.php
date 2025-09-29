<!-- resources/views/partials/navbar_lessa_fullwidth.blade.php -->
<header class="lessa-navbar-fullwidth" role="banner">
    <style>
        /* Scoped variables */
        .lessa-navbar-fullwidth {
            --primary: #0A2463;
            --secondary: #3E92CC;
            --accent: #FFD166;
            --light: #F2F4F7;
            --dark: #1E1E24;
            --radius: 14px;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.28s ease;
            font-family: 'Poppins', sans-serif;
        }

        .lessa-navbar-fullwidth * {
            box-sizing: border-box;
        }

        /* Make header full width and place inner content centered */
        .lessa-navbar-outer {
            width: 100%;
            background: white;
            /* full-width background */
            position: sticky;
            top: 0;
            z-index: 1100;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .lessa-navbar-inner {
            max-width: 1400px;
            /* wider for large screens */
            margin: 0 auto;
            padding: 0.9rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        /* Logo */
        .lessa-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.15rem;
            color: var(--primary);
        }

        .lessa-logo img {
            height: 44px;
            display: block;
        }

        /* Right group */
        .lessa-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Desktop main menu (inline) */
        .lessa-menu {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            list-style: none;
        }

        .lessa-menu a {
            color: var(--dark);
            font-weight: 600;
            position: relative;
            padding: 6px 0;
            transition: var(--transition);
            text-decoration: none;
        }

        .lessa-menu a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -6px;
            width: 0;
            height: 3px;
            background: var(--accent);
            border-radius: 2px;
            transition: var(--transition);
        }

        .lessa-menu a:hover {
            color: var(--primary);
            transform: translateY(-2px);
        }

        .lessa-menu a:hover::after {
            width: 100%;
        }

        /* Actions */
        .lessa-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        .lessa-btn {
            padding: 0.65rem 1rem;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            outline: none;
            transition: var(--transition);
        }

        .lessa-btn--primary {
            background: var(--primary);
            color: #fff;
            box-shadow: var(--shadow);
        }

        .lessa-btn--outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        /* Avatar */
        .lessa-avatar-container {
            position: relative;
            cursor: pointer;
            z-index: 1200;
        }

        .lessa-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--accent);
            color: var(--dark);
            font-weight: 700;
            font-size: 1rem;
            border: 2px solid #fff;
            transition: transform .22s ease, box-shadow .22s ease;
        }

        .lessa-avatar:hover {
            transform: scale(1.06);
            box-shadow: 0 0 0 6px rgba(62, 146, 204, 0.10);
        }

        .lessa-avatar-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            min-width: 220px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 12px 26px rgba(0, 0, 0, 0.12);
            display: none;
            flex-direction: column;
            padding: 8px 0;
            overflow: hidden;
        }

        .lessa-avatar-dropdown.show {
            display: flex;
        }

        .lessa-avatar-dropdown a {
            padding: 10px 14px;
            color: var(--dark);
            font-weight: 600;
            text-decoration: none
        }

        .lessa-avatar-dropdown a:hover {
            background: var(--secondary);
            color: #fff;
        }

        /* Hamburger toggle - only visible on small screens */
        .lessa-menu-toggle {
            display: none;
            gap: 6px;
            flex-direction: column;
            cursor: pointer;
            padding: 6px;
            border: none;
            background: transparent;
        }

        .lessa-menu-toggle span {
            display: block;
            height: 3px;
            width: 28px;
            border-radius: 2px;
            background: var(--primary);
            transition: all .28s ease;
        }

        .lessa-menu-toggle.open span:nth-child(1) {
            transform: translateY(9px) rotate(45deg);
        }

        .lessa-menu-toggle.open span:nth-child(2) {
            opacity: 0;
        }

        .lessa-menu-toggle.open span:nth-child(3) {
            transform: translateY(-9px) rotate(-45deg);
        }

        /* Mobile panel (slide-in) */
        .lessa-mobile-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            display: none;
            opacity: 0;
            transition: opacity .2s ease;
            z-index: 1090;
        }

        .lessa-mobile-backdrop.show {
            display: block;
            opacity: 1;
        }

        .lessa-mobile-panel {
            position: fixed;
            top: 0;
            right: -100%;
            height: 100vh;
            width: 92%;
            max-width: 420px;
            background: #fff;
            box-shadow: -12px 0 34px rgba(0, 0, 0, 0.12);
            z-index: 1095;
            transition: right .28s cubic-bezier(.2, .9, .2, 1);
            display: flex;
            flex-direction: column;
            padding: 1.2rem;
        }

        .lessa-mobile-panel.show {
            right: 0;
        }

        .lessa-mobile-panel .panel-close {
            align-self: flex-end;
            background: transparent;
            border: none;
            font-size: 1.1rem;
            padding: 6px;
            cursor: pointer;
        }

        .lessa-mobile-panel nav {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 6px;
        }

        .lessa-mobile-panel nav a {
            padding: 12px 10px;
            border-radius: 8px;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
        }

        .lessa-mobile-panel .panel-divider {
            height: 1px;
            background: rgba(0, 0, 0, 0.06);
            margin: 10px 0;
        }

        .lessa-mobile-panel a{
            text-decoration: none;
        }

        .sheet-content a{
            text-decoration: none;
        }

        /* Mobile avatar bottom-sheet (for better UX on small screens) */
        .lessa-bottom-sheet {
            position: fixed;
            left: 50%;
            transform: translateX(-50%) translateY(110%);
            bottom: 0;
            width: 100%;
            max-width: 560px;
            background: #fff;
            border-top-left-radius: 14px;
            border-top-right-radius: 14px;
            box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.12);
            z-index: 1100;
            transition: transform .28s ease;
        }

        .lessa-bottom-sheet.show {
            transform: translateX(-50%) translateY(0);
        }

        .lessa-bottom-sheet .sheet-content {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* Botón de Ayuda */
        .lessa-help-btn {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--secondary);
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            border: 2px solid #fff;
            cursor: pointer;
            transition: transform .22s ease, box-shadow .22s ease;
            position: relative;
        }

        .lessa-help-btn:hover {
            transform: scale(1.06);
            box-shadow: 0 0 0 6px rgba(62, 146, 204, 0.10);
        }

        /* Tooltip */
        .lessa-help-btn::after {
            content: "¿Necesitas ayuda?";
            position: absolute;
            left: calc(100% - 125px);
            transform: translateX(-50%);
            background: var(--secondary);
            color: #fff;
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 0.85rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity .25s ease, transform .25s ease;
            pointer-events: none;
        }

        .lessa-help-btn:hover::after {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(-3px);
        }

        /* Responsive behaviour */
        @media (max-width: 992px) {
            .lessa-navbar-inner {
                padding: 0.7rem 1rem;
            }

            .lessa-menu {
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {

            /* hide desktop inline menu and show hamburger */
            .lessa-menu {
                display: none;
            }

            .lessa-menu-toggle {
                display: flex;
            }

            .lessa-actions .lessa-btn--outline {
                display: none;
            }

            /* hide some buttons to declutter */
        }

        @media (min-width: 1700px) {

            /* make the inner container wider on very large screens */
            .lessa-navbar-inner {
                max-width: 1700px;
            }
        }
    </style>

    <div class="lessa-navbar-outer">
        <div class="lessa-navbar-inner">
            <a href="/" class="lessa-logo" aria-label="LESSA - Inicio" style="text-decoration: none;">
                <img src="{{ asset('img/logo2.png') }}" alt="LESSA logo">
                <span >LESSA</span>
            </a>

            <!-- Desktop menu (inline) -->
            <nav class="lessa-menu" aria-label="Primary">
                @guest
                    <a href="/">Inicio</a>
                @else
                    <a href="/">Inicio</a>
                    <a href="{{ route('aprender') }}">Aprender</a>
                    <a href="{{ route('practicar') }}">Practicar</a>
                    <a href="{{ route('info') }}">Info</a>
                    <a href="{{ route('miProgreso') }}">Mi progreso</a>
                @endguest
            </nav>

            <div class="lessa-right">
                <button class="lessa-menu-toggle" id="lessaMenuToggle" aria-label="Abrir menú" aria-expanded="false"
                    aria-controls="lessaMobilePanel">
                    <span></span><span></span><span></span>
                </button>

                <div class="lessa-actions">
                    <button class="lessa-help-btn" aria-label="Ayuda">?</button>
                    @guest
                        <button class="lessa-btn lessa-btn--outline"
                            onclick="location.href='{{ url('/login') }}'">Ingresar</button>
                        <button class="lessa-btn lessa-btn--primary"
                            onclick="location.href='{{ url('/signup') }}'">Registrarse</button>
                    @else
                        <div class="lessa-avatar-container" id="lessaAvatarContainer" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="lessa-avatar" id="lessaUserAvatar">
                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</div>
                            <div class="lessa-avatar-dropdown" id="lessaAvatarDropdown" role="menu"
                                aria-label="Opciones de usuario">
                                <a href="{{ route('profile') }}">Ver Perfil</a>
                                <a href="{{ route('profile.edit') }}">Configurar Perfil</a>
                                <a href="{{ route('logout') }}">Cerrar Sesión</a>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <div class="lessa-mobile-backdrop" id="lessaBackdrop" tabindex="-1"></div>

    <aside class="lessa-mobile-panel" id="lessaMobilePanel" aria-hidden="true" aria-labelledby="lessaMenuToggle">
        <button class="panel-close" id="lessaPanelClose" aria-label="Cerrar menú">✕</button>
        <nav aria-label="Mobile Primary">
            @guest
                <a href="/">Inicio</a>
            @else
                <a href="/">Inicio</a>
                <a href="{{ route('aprender') }}">Aprender</a>
                <a href="{{ route('practicar') }}">Practicar</a>
                <a href="{{ route('info') }}">Info</a>
                <a href="{{ route('miProgreso') }}">Mi progreso</a>
                <a href="#">Ayuda</a>
            @endguest
        </nav>

        <div class="panel-divider"></div>

        @guest
            <div style="display:flex; gap:8px; margin-top:6px;">
                <button class="lessa-btn lessa-btn--outline" style="flex:1;"
                    onclick="location.href='{{ url('/login') }}'">Ingresar</button>
                <button class="lessa-btn lessa-btn--primary" style="flex:1;"
                    onclick="location.href='{{ url('/signup') }}'">Registrarse</button>
            </div>
        @else
            <div style="display:flex; flex-direction:column; gap:8px; margin-top:6px;">
                <a style="text-decoration: none;" href="{{ route('profile') }}" style="font-weight:700; padding:10px 8px; border-radius:8px;">Ver
                    Perfil</a>
                <a style="text-decoration: none;" href="{{ route('profile.edit') }}"
                    style="font-weight:700; padding:10px 8px; border-radius:8px;">Configurar Perfil</a>
                <a style="text-decoration: none;" href="{{ route('logout') }}"
                    style="font-weight:700; padding:10px 8px; border-radius:8px; color:var(--primary);">Cerrar Sesión</a>
            </div>
        @endguest

    </aside>

    <div class="lessa-bottom-sheet" id="lessaBottomSheet" role="dialog" aria-hidden="true">
        <div class="sheet-content">
            <div style="display:flex; align-items:center; gap:12px;">
                <div class="lessa-avatar" style="width:56px;height:56px; font-size:1.1rem;">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</div>
                <div>
                    <div style="font-weight:800; color:var(--primary)">{{ Auth::user()->name ?? 'Usuario' }}</div>
                    <div style="font-size:0.9rem; color:rgba(0,0,0,0.6)">{{ Auth::user()->email ?? '' }}</div>
                </div>
            </div>

            <div style="height:8px"></div>
            <a href="{{ route('profile') }}" style="padding:12px; border-radius:10px; font-weight:700;">Ver Perfil</a>
            <a href="{{ route('profile.edit') }}" style="padding:12px; border-radius:10px; font-weight:700;">Configurar
                Perfil</a>
            <a href="{{ route('logout') }}"
                style="padding:12px; border-radius:10px; font-weight:700; color:var(--primary);">Cerrar Sesión</a>
            <div style="height:6px"></div>
            <button id="lessaBottomClose" class="lessa-btn" style="align-self:center; padding:8px 14px;">Cerrar</button>
        </div>
    </div>

    <script>
        (function () {
            const root = document.querySelector('.lessa-navbar-fullwidth');
            if (!root) return;

            const toggle = root.querySelector('#lessaMenuToggle');
            const mobilePanel = root.querySelector('#lessaMobilePanel');
            const backdrop = root.querySelector('#lessaBackdrop');
            const panelClose = root.querySelector('#lessaPanelClose');

            const avatarContainer = root.querySelector('#lessaAvatarContainer');
            const avatarDropdown = root.querySelector('#lessaAvatarDropdown');
            const bottomSheet = root.querySelector('#lessaBottomSheet');
            const bottomClose = root.querySelector('#lessaBottomClose');

            let prevActiveElement = null;
            let activeTrapContainer = null;

            const focusableSelector = 'a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, [tabindex]:not([tabindex="-1"])';

            function getFocusable(el) {
                if (!el) return [];
                return Array.from(el.querySelectorAll(focusableSelector)).filter(Boolean);
            }

            function trapKeyHandler(e) {
                if (!activeTrapContainer) return;

                if (e.key === 'Escape') {
                    e.preventDefault();
                    closeMobile();
                    closeBottomSheet();
                    if (avatarDropdown) avatarDropdown.classList.remove('show');
                    return;
                }

                if (e.key === 'Tab') {
                    const focusables = getFocusable(activeTrapContainer);
                    if (focusables.length === 0) {
                        e.preventDefault();
                        return;
                    }
                    const first = focusables[0];
                    const last = focusables[focusables.length - 1];
                    const currentIndex = focusables.indexOf(document.activeElement);

                    if (e.shiftKey) {
                        // shift + tab
                        if (document.activeElement === first || currentIndex === -1) {
                            e.preventDefault();
                            last.focus();
                        }
                    } else {
                        // tab
                        if (document.activeElement === last) {
                            e.preventDefault();
                            first.focus();
                        }
                    }
                }
            }

            function setBodyScrollLock(lock) {
                document.body.style.overflow = lock ? 'hidden' : '';
            }

            function openMobile() {
                if (!mobilePanel || !backdrop || !toggle) return;
                prevActiveElement = document.activeElement;
                mobilePanel.classList.add('show');
                backdrop.classList.add('show');
                toggle.classList.add('open');
                toggle.setAttribute('aria-expanded', 'true');
                mobilePanel.setAttribute('aria-hidden', 'false');

                activeTrapContainer = mobilePanel;
                setBodyScrollLock(true);

                const focusables = getFocusable(mobilePanel);
                (focusables[0] || mobilePanel).focus();

                document.addEventListener('keydown', trapKeyHandler);
            }

            function closeMobile() {
                if (!mobilePanel || !backdrop || !toggle) return;
                mobilePanel.classList.remove('show');
                backdrop.classList.remove('show');
                toggle.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
                mobilePanel.setAttribute('aria-hidden', 'true');

                activeTrapContainer = null;
                setBodyScrollLock(false);

                document.removeEventListener('keydown', trapKeyHandler);

                if (prevActiveElement && typeof prevActiveElement.focus === 'function') {
                    prevActiveElement.focus();
                    prevActiveElement = null;
                }
            }

            function openBottomSheet() {
                if (!bottomSheet || !backdrop) return;
                prevActiveElement = document.activeElement;
                bottomSheet.classList.add('show');
                backdrop.classList.add('show');
                bottomSheet.setAttribute('aria-hidden', 'false');

                activeTrapContainer = bottomSheet;
                setBodyScrollLock(true);

                const focusables = getFocusable(bottomSheet);
                (focusables[0] || bottomSheet).focus();

                document.addEventListener('keydown', trapKeyHandler);
            }

            function closeBottomSheet() {
                if (!bottomSheet || !backdrop) return;
                bottomSheet.classList.remove('show');
                backdrop.classList.remove('show');
                bottomSheet.setAttribute('aria-hidden', 'true');

                activeTrapContainer = null;
                setBodyScrollLock(false);

                document.removeEventListener('keydown', trapKeyHandler);

                if (prevActiveElement && typeof prevActiveElement.focus === 'function') {
                    prevActiveElement.focus();
                    prevActiveElement = null;
                }
            }

            function toggleAvatarDropdown() {
                if (!avatarDropdown || !avatarContainer) return;
                const isOpen = avatarDropdown.classList.toggle('show');
                avatarContainer.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

                if (mobilePanel && mobilePanel.classList.contains('show')) closeMobile();
            }

            if (toggle) {
                toggle.addEventListener('click', (ev) => {
                    ev.stopPropagation();
                    const shown = mobilePanel && mobilePanel.classList.contains('show');
                    if (shown) closeMobile(); else openMobile();

                    if (avatarDropdown && avatarDropdown.classList.contains('show')) {
                        avatarDropdown.classList.remove('show');
                        avatarContainer && avatarContainer.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            if (panelClose) panelClose.addEventListener('click', (e) => { e.stopPropagation(); closeMobile(); });

            if (backdrop) {
                backdrop.addEventListener('click', (e) => {
                    e.stopPropagation();
                    closeMobile();
                    closeBottomSheet();
                });
            }

            if (avatarContainer) {
                avatarContainer.addEventListener('click', (ev) => {
                    ev.stopPropagation();
                    const isMobile = window.innerWidth <= 768;
                    if (isMobile) {
                        closeMobile();
                        openBottomSheet();
                    } else {
                        toggleAvatarDropdown();
                    }
                });

                document.addEventListener('click', (e) => {
                    if (!avatarContainer.contains(e.target) && avatarDropdown && avatarDropdown.classList.contains('show')) {
                        avatarDropdown.classList.remove('show');
                        avatarContainer.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            if (bottomClose) bottomClose.addEventListener('click', (e) => { e.stopPropagation(); closeBottomSheet(); });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    if (mobilePanel && mobilePanel.classList.contains('show')) closeMobile();
                    if (bottomSheet && bottomSheet.classList.contains('show')) closeBottomSheet();
                    if (avatarDropdown && avatarDropdown.classList.contains('show')) avatarDropdown.classList.remove('show');
                }
            });

            let resizeTimer = null;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    if (window.innerWidth > 768) {
                        closeMobile();
                        closeBottomSheet();
                    }
                }, 120);
            });

        })();
    </script>

</header>