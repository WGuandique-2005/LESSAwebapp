<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos Educativos - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* --- HERO SECTION --- */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: #ffffff;
            padding: 4rem 0 6rem;
            position: relative;
            border-radius: 0 0 var(--radius-xl) var(--radius-xl);
            overflow: hidden;
            text-align: center;
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.125rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.9;
            font-weight: 300;
            padding: 0 1rem;
        }

        /* --- MAIN CONTAINER --- */
        .main-container {
            width: 100%;
            max-width: 1200px;
            margin: -4rem auto 0;
            /* Overlap effect */
            padding: 0 1.5rem 4rem;
            position: relative;
            z-index: 10;
        }

        /* --- DISCLAIMER --- */
        .disclaimer-box {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            text-align: center;
            font-size: 0.95rem;
            color: var(--text-secondary);
            margin-bottom: 3rem;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .disclaimer-box a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: underline;
        }

        /* --- VIDEO SECTIONS --- */
        .video-section {
            margin-bottom: 3rem;
        }

        .section-title-sticky {
            background: var(--bg-card);
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: 700;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
            display: inline-block;
            border-left: 5px solid var(--accent-color);
        }

        /* --- CAROUSEL --- */
        .video-carousel {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            gap: 1.5rem;
            padding-bottom: 1.5rem;
            /* Space for shadow */
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .video-carousel::-webkit-scrollbar {
            display: none;
        }

        /* --- VIDEO CARD --- */
        .video-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: var(--transition-base);
            cursor: pointer;
            flex: 0 0 300px;
            scroll-snap-align: start;
            border: 1px solid transparent;
            height: auto;
        }

        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(37, 99, 235, 0.1);
        }

        .video-thumb {
            width: 100%;
            height: 170px;
            object-fit: cover;
            background: #e0e4ea;
        }

        .video-info {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .video-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .video-desc {
            font-size: 0.9rem;
            color: var(--text-secondary);
            line-height: 1.5;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0 5rem;
            }

            .hero-title {
                font-size: 2rem;
            }

            .video-card {
                flex: 0 0 260px;
            }

            .main-container {
                margin-top: -3rem;
            }
        }

        @media (max-width: 576px) {
            .video-card {
                flex: 0 0 85%;
            }
            
            .hero-title {
                font-size: 1.75rem;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>

    <section class="hero-section">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;">
            <h1 class="hero-title">Videos Educativos LESSA</h1>
            <p class="hero-subtitle">
                Explora nuestra colección de videos educativos del canal <b>LESSA Virtual</b>.
                Aprende el Lenguaje de Señas Salvadoreño de forma visual y práctica.
                ¡Haz click en cualquier video para verlo!
            </p>
        </div>
    </section>

    <main class="main-container">

        <div class="disclaimer-box">
            <b>Permiso de uso:</b> Para este proyecto se contactó al canal <a
                href="https://youtube.com/@lessavirtual?si=h29rCum1uAtz3int" target="_blank">LESSA Virtual</a> mediante
            correo electrónico y se obtuvo autorización para utilizar sus videos.
        </div>

        <!-- SECCIÓN: BÁSICO -->
        <div class="video-section">
            <div class="section-title-sticky">Básico</div>
            <div class="video-carousel">
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/yczExyNssRs?si=-TIsqvmfkLER7lfN')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/yczExyNssRs/maxresdefault.jpg"
                        alt="abecedario">
                    <div class="video-info">
                        <div class="video-title">El Abecedario en LESSA</div>
                        <div class="video-desc">Aprende a deletrear palabras y nombres usando el abecedario
                            dactilológico.</div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/DJOe_jwANGU?si=NLHPwmIPIE1SEqv9')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/DJOe_jwANGU/maxresdefault.jpg"
                        alt="identidad">
                    <div class="video-info">
                        <div class="video-title">Identidad y Pronombres</div>
                        <div class="video-desc">Aprende a usar los pronombres y a expresar tu identidad en LESSA.</div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/oFoT5aEnmeE?si=uN8XLxoj2jZJuA2y')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/oFoT5aEnmeE/maxresdefault.jpg"
                        alt="verbos">
                    <div class="video-info">
                        <div class="video-title">Los verbos</div>
                        <div class="video-desc">Aprende a usar algunos de los verbos más útiles y comunes en LESSA.
                        </div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/BaBm621Bj0M?si=b19JUzTeE1l3KMLi')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/BaBm621Bj0M/maxresdefault.jpg"
                        alt="adjetivos">
                    <div class="video-info">
                        <div class="video-title">Los adjetivos</div>
                        <div class="video-desc">Aprende a realizar oraciones sencillas con los adjetivos aprendidos.
                        </div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/5nUqJgrOeb8?si=dfVJhmNR8OCOBepl')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/5nUqJgrOeb8/maxresdefault.jpg"
                        alt="numeros">
                    <div class="video-info">
                        <div class="video-title">Los números</div>
                        <div class="video-desc">Aprende a contar y a usar los números en LESSA.</div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/VhcXnirk58o?si=zgQU6Yurk-zlKdEx')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/VhcXnirk58o/maxresdefault.jpg"
                        alt="oracionesVerbos">
                    <div class="video-info">
                        <div class="video-title">Los verbos: Oraciones</div>
                        <div class="video-desc">Aprende a realizar oraciones sencillas con los verbos aprendidos.</div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/pDmFAh__f10?si=CZK4lVSH2Yxp4X2K')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/pDmFAh__f10/maxresdefault.jpg"
                        alt="oracionesAdjetivos">
                    <div class="video-info">
                        <div class="video-title">Los adjetivos: Oraciones</div>
                        <div class="video-desc">Aprende a realizar oraciones sencillas con los adjetivos aprendidos.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECCIÓN: VOCABULARIO -->
        <div class="video-section">
            <div class="section-title-sticky">Vocabulario</div>
            <div class="video-carousel">
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/Mke-fqX5Ux4?si=IH1yHW6cDTsScXL9')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/Mke-fqX5Ux4/maxresdefault.jpg"
                        alt="colores">
                    <div class="video-info">
                        <div class="video-title">Los colores</div>
                        <div class="video-desc">Aprende el vocabulario acerca de los colores en LESSA.</div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/Y3umPPvEP4Y?si=6WCzKgapaCUK9fj_')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/Y3umPPvEP4Y/maxresdefault.jpg"
                        alt="familia">
                    <div class="video-info">
                        <div class="video-title">Familia</div>
                        <div class="video-desc">Aprende vocabulario relacionado a la familia en LESSA.</div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/elIT8uGz4Ag?si=h4fZ7dE4LaWHHTl8')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/elIT8uGz4Ag/maxresdefault.jpg"
                        alt="transporte">
                    <div class="video-info">
                        <div class="video-title">Los medios de transporte</div>
                        <div class="video-desc">Aprende a realizar oraciones sencillas con los medios de transporte en
                            LESSA.</div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/XvYOmJ8XjqI?si=SqwRi004jYS1ffdY')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/XvYOmJ8XjqI/maxresdefault.jpg"
                        alt="musicales">
                    <div class="video-info">
                        <div class="video-title">Los instrumentos musicales</div>
                        <div class="video-desc">Aprende a realizar oraciones sencillas con los instrumentos musicales en
                            LESSA.</div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/2hQP44qsNOc?si=5pkk2cSYu8karUCp')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/2hQP44qsNOc/maxresdefault.jpg"
                        alt="profesiones">
                    <div class="video-info">
                        <div class="video-title">Las profesiones y oficios</div>
                        <div class="video-desc">Aprende a realizar oraciones sencillas con las profesiones y oficios en
                            LESSA.</div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/6X-DEc9ez7g?si=Smg5PNtaquoUwR74')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/6X-DEc9ez7g/maxresdefault.jpg"
                        alt="medico">
                    <div class="video-info">
                        <div class="video-title">Salud y medico</div>
                        <div class="video-desc">Aprende a realizar oraciones sencillas sobre salud y medicina en LESSA.
                        </div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/sFcBzIANiPo?si=xrJ4ew0mi1GLqNw0')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/sFcBzIANiPo/maxresdefault.jpg"
                        alt="animales">
                    <div class="video-info">
                        <div class="video-title">Los animales</div>
                        <div class="video-desc">Aprende a realizar los animles en LESSA.</div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/At-_mNLJqRk?si=GdpWnS0qUPD5Zl-i')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/At-_mNLJqRk/maxresdefault.jpg"
                        alt="deportes">
                    <div class="video-info">
                        <div class="video-title">Los deportes</div>
                        <div class="video-desc">Aprende a realizar los deportes en LESSA.</div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/GQdNv90mfAo?si=f8QnrN0tNFAiYqlv')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/GQdNv90mfAo/maxresdefault.jpg"
                        alt="utiles">
                    <div class="video-info">
                        <div class="video-title">Las utiles escolares</div>
                        <div class="video-desc">Aprende a realizar los utiles escolares en LESSA.</div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/smiDcQaRLIs?si=TlpgGuLxQC546LJC')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/smiDcQaRLIs/maxresdefault.jpg"
                        alt="verbos">
                    <div class="video-info">
                        <div class="video-title">Verbos</div>
                        <div class="video-desc">Aprende más verbos en LESSA.</div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/GUa6_9jjs7I?si=LFaEJBUWLy_iGjf6')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/GUa6_9jjs7I/maxresdefault.jpg"
                        alt="frutas">
                    <div class="video-info">
                        <div class="video-title">Las frutas</div>
                        <div class="video-desc">Aprende a realizar las frutas en LESSA.</div>
                    </div>
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/AYDdBZGmrL4?si=Q3hCG2Xl5jIbf5Ja')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/AYDdBZGmrL4/maxresdefault.jpg"
                        alt="verduras">
                    <div class="video-info">
                        <div class="video-title">Las verduras</div>
                        <div class="video-desc">Aprende a realizar las verduras en LESSA.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECCIÓN: IMPORTANCIA -->
        <div class="video-section">
            <div class="section-title-sticky">Importancia</div>
            <div class="video-carousel">
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/r6OCqKeSBLs?si=JPoBNP8zSTL90xIL')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/r6OCqKeSBLs/maxresdefault.jpg"
                        alt="importancia">
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/uSVEoQgG-u8?si=ze4LvLsMNZEjNs85')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/uSVEoQgG-u8/maxresdefault.jpg"
                        alt="importancia">
                </div>
                <div class="video-card" tabindex="0"
                    onclick="window.open('https://youtu.be/8vt6oofwvyY?si=v_gvG7IznmZXvNYZ')">
                    <img class="video-thumb" src="https://img.youtube.com/vi/8vt6oofwvyY/maxresdefault.jpg"
                        alt="importancia">
                </div>
            </div>
        </div>

    </main>
    <footer>@include('partials.footer')</footer>
</body>

</html>