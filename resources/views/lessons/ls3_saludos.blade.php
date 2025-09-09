<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saludos - LESSA (Lección 3)</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Segoe+UI:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        /* Variables CSS para una gestión de colores y espaciados más sencilla */
        :root {
            --primary-color: #004AAD;
            /* Azul principal */
            --secondary-color: #2196F3;
            /* Azul para acentos */
            --background-light: #f4f6fa;
            --text-dark: #333d47;
            /* Casi negro, suave */
            --text-light: #ffffff;
            --sidebar-bg: #2C3E50;
            /* Azul oscuro para la barra lateral */
            --sidebar-active: #FFD700;
            /* Dorado para el elemento activo */
            --shadow-light: rgba(0, 0, 0, 0.08);
            --shadow-medium: rgba(0, 0, 0, 0.12);
            --font-family-body: 'Segoe UI', 'Arial', sans-serif;
            --font-family-heading: 'Poppins', sans-serif;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-family-body);
            background: var(--background-light);
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
            /* Evita scroll horizontal */
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .lesson-layout {
            display: flex;
            min-height: 100vh;
            background-color: var(--background-light);
        }

        /* Sidebar - Navegación de la Lección */
        .sidebar {
            background: var(--sidebar-bg);
            color: var(--text-light);
            width: 250px;
            min-width: 200px;
            padding: 40px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 100;
            transition: width 0.3s ease;
            /* Smooth transition for width change */
        }

        .sidebar h2 {
            font-family: var(--font-family-heading);
            font-size: 1.6em;
            margin-bottom: 40px;
            font-weight: 700;
            letter-spacing: 1.5px;
            color: var(--sidebar-active);
            text-transform: uppercase;
            text-align: center;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            width: 90%;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: flex-start;
        }

        .sidebar li {
            padding: 12px 20px;
            width: calc(100% - 40px);
            /* Adjusted for padding on both sides */
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            border-left: 5px solid transparent;
            transition: all 0.18s ease-in-out;
            box-sizing: border-box;
            user-select: none;
        }

        .sidebar li:hover {
            background: rgba(255, 255, 255, 0.06);
            color: var(--text-light);
            border-left-color: var(--primary-color);
        }

        .sidebar li.active {
            border-left: 5px solid var(--sidebar-active);
            color: var(--sidebar-active);
            background: rgba(255, 255, 255, 0.06);
            font-weight: 700;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.06);
        }

        /* Burger Menu for Mobile */
        .hamburger {
            display: none;
            /* Hidden by default, shown on mobile */
            font-size: 2em;
            color: var(--text-light);
            cursor: pointer;
            position: absolute;
            right: 20px;
            z-index: 101;
            /* Add padding for easier tapping */
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            height: 100vh;
            overflow-y: auto;
            /* allow scrolling */
            -webkit-overflow-scrolling: touch;
            /* smooth scrolling on iOS */
            touch-action: pan-y;
            /* allow vertical pan gestures */
            scroll-snap-type: y mandatory;
            scroll-behavior: smooth;
            padding: 0;
            background: var(--background-light);
            position: relative;
            z-index: 1;
        }

        /* Section Styling */
        section {
            padding: 60px 8vw;
            background: var(--text-light);
            box-shadow: 0 4px 20px var(--shadow-light);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            scroll-snap-align: start;
            box-sizing: border-box;
            max-width: 100%;
        }

        .section-title {
            font-family: var(--font-family-heading);
            font-size: clamp(2em, 4vw, 3.2em);
            color: var(--primary-color);
            margin-bottom: 25px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .section-desc {
            font-size: clamp(1em, 1.5vw, 1.3em);
            /* Responsive font size */
            color: var(--text-dark);
            max-width: 800px;
            margin-bottom: 35px;
            line-height: 1.5;
            font-weight: 400;
        }

        /* Progress Bar - Gamification */
        .progress-bar-container {
            display: flex;
            width: 90%;
            max-width: 700px;
            margin: 0 auto 30px auto;
            padding: 20px 0 10px;
            position: sticky;
            top: 0;
            background: var(--background-light);
            z-index: 50;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .progress-bar {
            width: 100%;
            height: 22px;
            background: #e0e4ea;
            border-radius: 11px;
            overflow: hidden;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            width: 0%;
            border-radius: 11px;
            transition: width 0.4s ease-out;
        }

        /* Badge - Gamification */
        .badge {
            display: inline-block;
            background: var(--sidebar-active);
            color: var(--sidebar-bg);
            font-weight: 700;
            border-radius: 20px;
            padding: 8px 24px;
            margin-top: 20px;
            font-size: clamp(0.9em, 1.2vw, 1.2em);
            /* Responsive font size */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            animation: pulse 1.5s infinite ease-in-out;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.03);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Motivational Message - Gamification */
        .motivational {
            font-size: clamp(1.1em, 1.6vw, 1.4em);
            /* Responsive font size */
            color: var(--secondary-color);
            margin-top: 30px;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        /* Carousel removed - use blade include 'carrusel.numeros' */
        .include-carrusel {
            width: 100%;
            max-width: 900px;
            margin: 25px auto;
        }

        .hamburger:focus {
            outline: 2px solid var(--primary-color);
        }

        /* Mobile backdrop used when menu opens */
        .mobile-backdrop {
            position: fixed;
            top: 60px;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.35);
            z-index: 99;
            display: none;
            -webkit-tap-highlight-color: transparent;
        }

        .mobile-backdrop.open {
            display: block;
        }

        /* --- Estilos Responsive --- */

        /* Para pantallas medianas y tabletas (entre 769px y 1024px) */
        @media (max-width: 1024px) {
            .sidebar {
                width: 200px;
                min-width: unset;
            }

            .sidebar h2 {
                font-size: 1.4em;
            }

            .sidebar li {
                font-size: 1em;
                padding: 10px 15px;
                width: calc(100% - 30px);
                /* Adjusted for padding */
            }

            .section-title {
                font-size: clamp(2em, 3.5vw, 2.8em);
            }

            .section-desc {
                font-size: clamp(0.9em, 1.2vw, 1.1em);
            }
        }

        /* Para tabletas y móviles (máximo 768px de ancho) */
        @media (max-width: 768px) {
            .lesson-layout {
                flex-direction: column;
                min-height: auto;
            }

            .sidebar,
            .hamburger,
            .mobile-backdrop {
                display: none !important;
            }

            .main-content {
                margin-top: 0;
                height: auto;
                min-height: calc(100vh - 60px);
                scroll-snap-type: none;
                padding: 0;
                overflow-y: auto;
            }

            .progress-bar-container {
                display: none;
            }

            section {
                min-height: auto;
                height: auto;
                padding: 30px 5vw;
                box-shadow: none;
                border-bottom: 1px solid #e0e4ea;
            }

            section:last-of-type {
                border-bottom: none;
            }

            .section-title {
                font-size: clamp(1.8em, 4.5vw, 2.2em);
                margin-bottom: 15px;
            }

            .section-desc {
                font-size: clamp(0.9em, 2.5vw, 1em);
                margin-bottom: 20px;
            }

            .badge {
                padding: 6px 18px;
                font-size: clamp(0.8em, 2vw, 1em);
            }

            .motivational {
                font-size: clamp(0.9em, 2.2vw, 1.1em);
                margin-top: 20px;
            }

            .carousel-slide img {
                max-width: 90%;
                max-height: 30vh;
            }

            .carousel-slide h3 {
                font-size: clamp(1.2em, 3vw, 1.5em);
            }

            .carousel-slide p {
                font-size: clamp(0.8em, 2.2vw, 0.9em);
            }
        }

        /* Para teléfonos móviles muy pequeños (máximo 480px de ancho) */
        @media (max-width: 480px) {
            .sidebar h2 {
                font-size: 1.3em;
            }

            .hamburger {
                font-size: 1.8em;
            }

            .section-title {
                font-size: clamp(1.6em, 5vw, 1.8em);
            }

            .section-desc {
                font-size: clamp(0.8em, 2.8vw, 0.9em);
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>
    <div class="lesson-layout">
        <nav class="sidebar" role="navigation" aria-label="Menú de lección">
            <span class="hamburger" id="hamburger" aria-label="Abrir menú" aria-expanded="false">&#9776;</span>
            <h2>Saludos</h2>
            <ul id="sidebarMenu" aria-hidden="false">
                <li class="active" data-section="intro" role="button" tabindex="0">Introducción</li>
                <li data-section="abc" role="button" tabindex="0">Saludos y frases en LESSA</li>
                <li data-section="letras" role="button" tabindex="0">El vocabulario</li>
                <li data-section="practica" role="button" tabindex="0">Práctica</li>
            </ul>
        </nav>

        <div class="mobile-backdrop" id="mobileBackdrop" aria-hidden="true"></div>

        <div class="main-content" id="mainContent">
            <div class="progress-bar-container">
                <div class="progress-bar">
                    <div class="progress-bar-fill" id="progressBarFill"></div>
                </div>
            </div>

            <section id="intro">
                <div class="section-title">Introducción — Lección 3: Saludos y frases</div>
                <div class="section-desc">
                    LESSA (Lengua de Señas Salvadoreña) es el sistema de comunicación natural de la comunidad sorda de
                    El Salvador. Aprender saludos y frases básicas permite establecer contacto respetuoso, presentarse y
                    mantener conversaciones cotidianas con personas sordas es la puerta para una interacción inclusiva y
                    connetiva en contextos sociales y laborales. Menos errores en los movimientos y una pronunciación
                    visual clara (mano, lugar, movimiento, expresión facial) mejora la comprensión.
                </div>
                <span class="badge">¡Cuenta Iniciada!</span>
            </section>

            <section id="abc">
                <div class="section-title">Saludos y frases en LESSA</div>
                <div class="section-desc">
                    En esta sección aprenderás 20–25 expresiones útiles para presentarte, saludar, pedir algo o
                    despedirte. Practica la configuración de la mano, la orientación de la palma, el movimiento y la
                    expresión facial estos elementos son tan importantes como la forma de la mano.
                </div>
                <div class="section-desc">
                    <strong>Puerta de acceso a la comunicación:</strong> Los saludos y frases básicas permiten iniciar la interacción; sin ellos la comunicación suele bloquearse antes de comenzar.
                    <br><strong>Inclusión social:</strong> Saludar y presentarse en la lengua de señas muestra respeto y reduce barreras para personas sordas, favoreciendo la participación en la escuela y trabajo.
                    <br><strong>Confianza y rapport:</strong> Un saludo correcto crea una conexión inmediata, mejora la confianza mutua y facilita conversaciones más largas y efectivas.
                </div>
                <span class="badge">¡Aprende a expresarte!</span>
            </section>

            <section id="letras">
                <div class="section-title">Explorando el vocabulario</div>
                <div class="section-desc">
                    Aquí encontrarás la representación visual y la descripción detallada de cada número en LESSA.
                    Observa
                    las imágenes, sigue la explicación de la configuración de mano y la dinámica (movimientos/giros) y
                    practica las secuencias para números compuestos. Las señas se componen de parámetros: configuración
                    de la mano, ubicación (lugar del signo), movimiento, orientación de la palma y expresión facial. En
                    LESSA, la morfología y el orden visual importan: cambiar un movimiento o la expresión puede alterar
                    el significado.
                </div>
                <div class="include-carrusel">
                    @include('carrusel.saludos')
                </div>
                <span class="badge">¡Visión Inclusiva!</span>
            </section>

            <section id="practica">
                <div class="section-title">Practica y Gana Insignias</div>
                <div class="section-desc">
                    ¡Es hora de poner a prueba tus habilidades con el contenido de esta lección! En esta sección
                    encontrarás ejercicios
                    interactivos para reforzar el reconocimiento y la producción de las señas. Completa los retos
                    para obtener insignias y desbloquear nuevos niveles. Cada seña aprendido mejora tu capacidad de
                    comunicar expresiones y saludos comunes con fluidez.
                </div>
                <span class="badge goToTest" style="cursor: pointer;">¡Vamos a practicar!</span>
                <div class="motivational" id="motivationalMsg">¡Tú puedes lograrlo! Practica estas frases para ganar más
                    insignias.</div>
            </section>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mainContent = document.getElementById('mainContent');
            const sections = document.querySelectorAll('section');
            const progressBarFill = document.getElementById('progressBarFill');
            const motivationalMsg = document.getElementById('motivationalMsg');
            const sidebarLinks = document.querySelectorAll('.sidebar li');
            const hamburger = document.getElementById('hamburger');
            const sidebarMenu = document.getElementById('sidebarMenu');
            const mobileBackdrop = document.getElementById('mobileBackdrop');

            /* Helper: calcula la posición objetivo relativa al contenedor con scroll (mainContent) */
            const computeScrollTopFor = (targetSection) => {
                const sectionRect = targetSection.getBoundingClientRect();
                const containerRect = mainContent.getBoundingClientRect();
                // distancia desde la parte superior del contenedor hasta la sección
                const offsetWithin = sectionRect.top - containerRect.top;
                return Math.round(mainContent.scrollTop + offsetWithin);
            };

            // --- Funcionalidad de la Barra de Progreso y Mensajes Motivacionales ---
            const updateProgressBar = () => {
                const scrollHeight = mainContent.scrollHeight - mainContent.clientHeight;
                let percent = 0;
                if (scrollHeight > 0) { // Evita división por cero si no hay scroll
                    percent = Math.round((mainContent.scrollTop / scrollHeight) * 100);
                }
                progressBarFill.style.width = percent + '%';

                // Mensajes motivacionales basados en el progreso
                if (percent < 25) {
                    motivationalMsg.textContent = '¡Sigue explorando! Cada seña te acerca a un mundo nuevo. ✨';
                } else if (percent < 50) {
                    motivationalMsg.textContent = '¡Vas muy bien! Tu dedicación se nota. ¡No te rindas! 💪';
                } else if (percent < 75) {
                    motivationalMsg.textContent = '¡Ya casi terminas! Estás a un paso de dominar los saludos. 🎉';
                } else {
                    motivationalMsg.textContent = '¡Excelente! Has completado la lección de los saludos. ¡Eres un campeón! 🏆';
                }
            };

            const updateSidebarActive = () => {
                let currentActiveSectionId = '';
                const containerRect = mainContent.getBoundingClientRect();
                sections.forEach(section => {
                    const rect = section.getBoundingClientRect();
                    const relativeTop = rect.top - containerRect.top;
                    if (relativeTop <= (mainContent.clientHeight * 0.25) && (relativeTop + rect.height) > 0) {
                        currentActiveSectionId = section.id;
                    }
                });

                sidebarLinks.forEach(link => {
                    if (link.dataset.section === currentActiveSectionId) {
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }
                });
            };

            // --- Desplazamiento suave a sección dentro de mainContent ---
            const scrollToSection = (targetSectionId) => {
                const targetSection = document.getElementById(targetSectionId);
                if (!targetSection) return;
                const offset = window.innerWidth <= 768 ? 8 : 0; // ajuste pequeño
                const top = computeScrollTopFor(targetSection) - offset;
                mainContent.scrollTo({ top: top, behavior: 'smooth' });
                // Actualizar estado visual inmediatamente
                sidebarLinks.forEach(link => link.classList.toggle('active', link.dataset.section === targetSectionId));
            };

            // --- Navegación Suave al Hacer Clic en el Sidebar ---
            sidebarLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const targetSectionId = link.dataset.section;
                    if (sidebarMenu.classList.contains('open')) {
                        sidebarMenu.classList.remove('open');
                        hamburger.setAttribute('aria-expanded', 'false');
                        mobileBackdrop.classList.remove('open');
                        mobileBackdrop.setAttribute('aria-hidden', 'true');
                    }
                    setTimeout(() => scrollToSection(targetSectionId), 60);
                });

                // keyboard accessibility: Enter / Space
                link.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        link.click();
                    }
                });
            });

            // --- Funcionalidad del Menú Hamburguesa (Móvil) ---
            const openMobileMenu = () => {
                sidebarMenu.classList.add('open');
                hamburger.setAttribute('aria-expanded', 'true');
                mobileBackdrop.classList.add('open');
                mobileBackdrop.setAttribute('aria-hidden', 'false');
            };
            const closeMobileMenu = () => {
                sidebarMenu.classList.remove('open');
                hamburger.setAttribute('aria-expanded', 'false');
                mobileBackdrop.classList.remove('open');
                mobileBackdrop.setAttribute('aria-hidden', 'true');
            };

            hamburger.addEventListener('click', () => {
                if (sidebarMenu.classList.contains('open')) {
                    closeMobileMenu();
                } else {
                    openMobileMenu();
                }
            });

            mobileBackdrop.addEventListener('click', () => {
                closeMobileMenu();
            });


            // --- Event Listeners para Scroll y Carga ---
            mainContent.addEventListener('scroll', () => {
                updateProgressBar();
                updateSidebarActive();
            }, { passive: true });

            window.addEventListener('load', () => {
                updateProgressBar();
                updateSidebarActive();
            });

            window.addEventListener('resize', () => {
                updateProgressBar();
                updateSidebarActive();
            });

            // Si el usuario llega desde una URL con hash, hacemos scroll a la sección correspondiente
            if (location.hash) {
                const idFromHash = location.hash.replace('#', '');
                setTimeout(() => {
                    scrollToSection(idFromHash);
                }, 120);
            }

            const goToTest = document.querySelector('.goToTest');
            goToTest.addEventListener('click', () => {
                window.location.href = '/lecciones/saludos/test';
            });
        });
    </script>
</body>

</html>