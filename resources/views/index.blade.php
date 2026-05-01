<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="google-site-verification" content="XOnnmO2ASsCApDKrAhzfhYTYlxagUHeoz7aGi7b0uis" />
    <title>Inicio - LESSA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/logo2.png') }}">
    <style>
        :root {
            --primary: #0A2463;
            --secondary: #3E92CC;
            --accent: #FFD166;
            --accent-soft: #FFF3D1;
            --ink: #172033;
            --muted: #647086;
            --line: #E6EAF1;
            --surface: #FFFFFF;
            --soft-blue: #EAF4FF;
            --soft-green: #EAF8F1;
            --soft-coral: #FFF0EE;
            --page: #F6F8FB;
            --radius: 16px;
            --shadow-sm: 0 10px 24px rgba(10, 36, 99, 0.08);
            --shadow-md: 0 18px 45px rgba(10, 36, 99, 0.12);
            --transition: 220ms ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--page);
            color: var(--ink);
            line-height: 1.6;
            overflow-x: hidden;
        }

        img {
            max-width: 100%;
            display: block;
        }

        a {
            color: inherit;
        }

        .home {
            overflow: hidden;
        }

        .home-container {
            width: min(1120px, calc(100% - 32px));
            margin: 0 auto;
        }

        .home-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            width: fit-content;
            min-height: 34px;
            padding: 0.38rem 0.8rem 0.38rem 0.48rem;
            border: 1px solid rgba(62, 146, 204, 0.22);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.82);
            color: var(--primary);
            font-size: 0.82rem;
            font-weight: 700;
            box-shadow: 0 8px 18px rgba(10, 36, 99, 0.06);
        }

        .eyebrow-logo {
            width: 24px;
            height: 24px;
            flex: 0 0 24px;
            border-radius: 50%;
            background: #fff;
            object-fit: contain;
            padding: 2px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            min-height: 48px;
            padding: 0.85rem 1.25rem;
            border: 0;
            border-radius: 12px;
            font-family: inherit;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: transform var(--transition), box-shadow var(--transition), background var(--transition);
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 14px 26px rgba(10, 36, 99, 0.22);
        }

        .btn-primary:hover {
            background: #12347F;
        }

        .btn-outline {
            background: #fff;
            color: var(--primary);
            border: 1px solid rgba(10, 36, 99, 0.16);
            box-shadow: 0 10px 20px rgba(10, 36, 99, 0.06);
        }

        .btn-outline:hover {
            box-shadow: 0 14px 28px rgba(10, 36, 99, 0.1);
        }

        .btn-accent {
            background: var(--accent);
            color: var(--primary);
            box-shadow: 0 14px 26px rgba(255, 145, 55, 0.18);
        }

        .home-hero {
            position: relative;
            padding: 5rem 0 4.6rem;
            background:
                linear-gradient(115deg, rgba(246, 248, 251, 0.97) 0%, rgba(246, 248, 251, 0.9) 45%, rgba(234, 244, 255, 0.84) 100%),
                url("{{ asset('img/centroHistorico.png') }}") center / cover;
        }

        .home-hero::after {
            content: "";
            position: absolute;
            inset: auto 0 0;
            height: 120px;
            background: linear-gradient(to bottom, rgba(246, 248, 251, 0), var(--page));
            pointer-events: none;
        }

        .hero-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(340px, 0.84fr);
            gap: clamp(2rem, 5vw, 4.2rem);
            align-items: center;
        }

        .hero-copy {
            display: grid;
            gap: 1.35rem;
        }

        .hero-brand-lockup {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            width: fit-content;
            padding: 0.62rem 0.9rem 0.62rem 0.65rem;
            border: 1px solid rgba(10, 36, 99, 0.08);
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.78);
            box-shadow: 0 14px 28px rgba(10, 36, 99, 0.08);
            backdrop-filter: blur(12px);
        }

        .hero-brand-lockup img {
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            object-fit: contain;
        }

        .hero-brand-lockup span {
            color: var(--primary);
            font-size: 0.92rem;
            font-weight: 800;
            letter-spacing: 0;
        }

        .hero-copy h1 {
            max-width: 760px;
            color: var(--primary);
            font-size: clamp(2.35rem, 5vw, 4.65rem);
            line-height: 1.02;
            letter-spacing: 0;
        }

        .hero-copy p {
            max-width: 650px;
            color: #42506A;
            font-size: clamp(1rem, 1.7vw, 1.18rem);
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.9rem;
            margin-top: 0.25rem;
        }

        .hero-panel {
            position: relative;
            min-height: 430px;
        }

        .hero-image-card {
            position: relative;
            height: 410px;
            overflow: hidden;
            border-radius: 24px;
            background: #fff;
            box-shadow: var(--shadow-md);
        }

        .hero-image-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .hero-image-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(10, 36, 99, 0.58), rgba(10, 36, 99, 0.04) 58%);
        }

        .hero-note {
            position: absolute;
            right: -14px;
            bottom: 22px;
            width: min(290px, calc(100% - 22px));
            padding: 1.05rem;
            border: 1px solid rgba(10, 36, 99, 0.1);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.94);
            box-shadow: var(--shadow-sm);
            backdrop-filter: blur(12px);
        }

        .hero-note::before {
            content: "";
            display: block;
            width: 34px;
            height: 4px;
            margin-bottom: 0.78rem;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--primary), #FF8A3D);
        }

        .hero-note strong {
            display: block;
            color: var(--primary);
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .hero-note span {
            color: var(--muted);
            font-size: 0.88rem;
        }

        .section {
            padding: 4.8rem 0;
        }

        .section-heading {
            display: grid;
            gap: 0.8rem;
            max-width: 740px;
            margin-bottom: 2.2rem;
        }

        .section-heading.center {
            margin-inline: auto;
            text-align: center;
            justify-items: center;
        }

        .section-heading h2 {
            color: var(--primary);
            font-size: clamp(1.8rem, 3vw, 2.55rem);
            line-height: 1.14;
        }

        .section-heading p {
            color: var(--muted);
            font-size: 1rem;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.1rem;
        }

        .benefit-card,
        .path-card,
        .testimonial-card {
            border: 1px solid var(--line);
            border-radius: var(--radius);
            background: var(--surface);
            box-shadow: 0 8px 20px rgba(10, 36, 99, 0.05);
            transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
        }

        .benefit-card:hover,
        .path-card:hover,
        .testimonial-card:hover {
            transform: translateY(-4px);
            border-color: rgba(62, 146, 204, 0.34);
            box-shadow: var(--shadow-sm);
        }

        .benefit-card {
            min-height: 250px;
            padding: 1.55rem;
            display: grid;
            align-content: start;
            gap: 1rem;
            position: relative;
            overflow: hidden;
        }

        .benefit-card::after {
            content: "";
            position: absolute;
            right: -28px;
            bottom: -28px;
            width: 92px;
            height: 92px;
            background: url("{{ asset('img/logo2.png') }}") center / contain no-repeat;
            opacity: 0.045;
            pointer-events: none;
        }

        .icon-box {
            width: 52px;
            height: 52px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            color: var(--primary);
            font-size: 1.25rem;
        }

        .icon-box.blue {
            background: var(--soft-blue);
            color: #2468E8;
        }

        .icon-box.gold {
            background: var(--accent-soft);
            color: #B86A00;
        }

        .icon-box.green {
            background: var(--soft-green);
            color: #12855E;
        }

        .icon-box.coral {
            background: var(--soft-coral);
            color: #E24D44;
        }

        .benefit-card h3,
        .path-card h3,
        .story-copy h3 {
            color: var(--ink);
            font-size: 1.18rem;
            line-height: 1.25;
        }

        .benefit-card p,
        .path-card p,
        .story-copy p,
        .testimonial-card p {
            color: var(--muted);
            font-size: 0.94rem;
        }

        .story-band {
            padding: 1rem;
            border-radius: 28px;
            background: #fff;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(10, 36, 99, 0.06);
        }

        .story-grid {
            display: grid;
            grid-template-columns: minmax(0, 0.95fr) minmax(0, 1.05fr);
            gap: 2rem;
            align-items: center;
        }

        .story-media {
            min-height: 440px;
            overflow: hidden;
            border-radius: 22px;
            background: var(--soft-blue);
        }

        .story-media img {
            width: 100%;
            height: 100%;
            min-height: 440px;
            object-fit: cover;
        }

        .story-copy {
            padding: 2rem 1.25rem 2rem 0;
        }

        .story-copy h2 {
            color: var(--primary);
            font-size: clamp(1.75rem, 3vw, 2.45rem);
            line-height: 1.15;
            margin: 0.85rem 0 1rem;
        }

        .story-points {
            display: grid;
            gap: 0.85rem;
            margin-top: 1.5rem;
        }

        .story-point {
            display: grid;
            grid-template-columns: 44px 1fr;
            gap: 0.85rem;
            align-items: start;
            padding: 1rem;
            border: 1px solid var(--line);
            border-radius: 14px;
            background: #FAFBFD;
        }

        .path-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem;
        }

        .path-card {
            overflow: hidden;
        }

        .path-card img {
            width: 100%;
            height: 168px;
            object-fit: cover;
        }

        .path-card-content {
            display: grid;
            gap: 0.75rem;
            padding: 1.25rem;
        }

        .path-meta {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            width: fit-content;
            padding: 0.32rem 0.65rem;
            border-radius: 999px;
            background: #F1F5FA;
            color: var(--primary);
            font-size: 0.78rem;
            font-weight: 700;
        }

        .testimonials {
            background: linear-gradient(180deg, rgba(234, 244, 255, 0.8), rgba(246, 248, 251, 0));
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
        }

        .testimonial-card {
            padding: 1.5rem;
        }

        .quote-mark {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            margin-bottom: 1rem;
            border-radius: 50%;
            background: var(--accent-soft);
            color: #B86A00;
            font-size: 1.25rem;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            margin-top: 1.2rem;
        }

        .author-img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }

        .author-info h4 {
            color: var(--primary);
            font-size: 0.96rem;
        }

        .author-info span {
            color: var(--muted);
            font-size: 0.84rem;
        }

        .cta-section {
            margin: 0 0 5rem;
        }

        .cta-card {
            position: relative;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 2rem;
            align-items: center;
            padding: clamp(1.5rem, 4vw, 3rem);
            border-radius: 28px;
            background:
                linear-gradient(135deg, rgba(10, 36, 99, 0.97), rgba(62, 146, 204, 0.92)),
                url("{{ asset('img/hands.png') }}") center / cover;
            color: #fff;
            box-shadow: var(--shadow-md);
        }

        .cta-card::after {
            content: "";
            position: absolute;
            right: clamp(1rem, 4vw, 3rem);
            top: 50%;
            width: 160px;
            height: 160px;
            transform: translateY(-50%);
            background: url("{{ asset('img/logo2.png') }}") center / contain no-repeat;
            opacity: 0.07;
            pointer-events: none;
        }

        .cta-card > * {
            position: relative;
            z-index: 1;
        }

        .cta-card h2 {
            color: #fff;
            font-size: clamp(1.7rem, 3vw, 2.4rem);
            line-height: 1.15;
            margin-bottom: 0.75rem;
        }

        .cta-card p {
            max-width: 680px;
            color: rgba(255, 255, 255, 0.86);
        }

        .cta-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.85rem;
            justify-content: flex-end;
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(26px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 980px) {
            .hero-grid,
            .story-grid,
            .cta-card {
                grid-template-columns: 1fr;
            }

            .hero-panel {
                min-height: auto;
            }

            .hero-image-card {
                height: 360px;
            }

            .hero-note {
                right: 18px;
            }

            .benefits-grid,
            .path-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .story-copy {
                padding: 0.5rem;
            }

            .cta-actions {
                justify-content: flex-start;
            }
        }

        @media (max-width: 680px) {
            .home-container {
                width: min(100% - 24px, 1120px);
            }

            .home-hero {
                padding: 3.4rem 0 3rem;
            }

            .hero-actions,
            .cta-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .hero-image-card {
                height: 300px;
                border-radius: 22px;
            }

            .hero-note {
                position: relative;
                right: auto;
                bottom: auto;
                width: 100%;
                margin-top: 0.9rem;
            }

            .section {
                padding: 3.4rem 0;
            }

            .benefits-grid,
            .path-grid,
            .testimonial-grid {
                grid-template-columns: 1fr;
            }

            .story-band,
            .cta-card {
                border-radius: 22px;
            }

            .story-media,
            .story-media img {
                min-height: 300px;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>

    <main class="home">
        <section class="home-hero">
            <div class="home-container hero-grid">
                <div class="hero-copy animate-on-scroll">
                    <div class="hero-brand-lockup">
                        <img src="{{ asset('img/logo2.png') }}" alt="Logo LESSA">
                        <span>Lengua de Señas Salvadoreña</span>
                    </div>
                    <h1>Aprende LESSA de forma clara, práctica e inclusiva</h1>
                    <p>
                        Una plataforma pensada para practicar a tu ritmo, fortalecer la comunicación y acercarte a la
                        comunidad sorda salvadoreña con lecciones simples, visuales y accesibles.
                    </p>
                    <div class="hero-actions">
                        <button class="btn btn-primary" onclick="window.location.href='/signup'">
                            <i class="fas fa-rocket"></i> Empieza ahora
                        </button>
                        <button class="btn btn-outline" onclick="window.location.href='/login'">
                            <i class="fas fa-user"></i> Ya tengo cuenta
                        </button>
                    </div>
                </div>

                <div class="hero-panel animate-on-scroll">
                    <div class="hero-image-card">
                        <img src="{{ asset('img/hands.png') }}" alt="Manos practicando lengua de señas">
                    </div>
                    <div class="hero-note">
                        <strong>Aprendizaje visual y cercano</strong>
                        <span>Lecciones cortas para reconocer, repetir y practicar señas desde cualquier lugar.</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="home-container">
                <div class="section-heading center animate-on-scroll">
                    <span class="home-eyebrow">
                        <img src="{{ asset('img/logo2.png') }}" alt="" class="eyebrow-logo">
                        ¿Por qué LESSA?
                    </span>
                    <h2>Una experiencia de aprendizaje limpia y fácil de seguir</h2>
                    <p>
                        El contenido está organizado para que avances paso a paso, sin saturarte, con actividades que
                        convierten cada seña aprendida en una habilidad útil.
                    </p>
                </div>

                <div class="benefits-grid">
                    <article class="benefit-card animate-on-scroll">
                        <div class="icon-box blue"><i class="fas fa-clock"></i></div>
                        <h3>Aprendizaje a tu ritmo</h3>
                        <p>Repasa las lecciones cuando lo necesites y construye una base sólida sin presión.</p>
                    </article>

                    <article class="benefit-card animate-on-scroll">
                        <div class="icon-box gold"><i class="fas fa-gamepad"></i></div>
                        <h3>Práctica interactiva</h3>
                        <p>Ejercicios, juegos y retroalimentación para aprender haciendo, no solo leyendo.</p>
                    </article>

                    <article class="benefit-card animate-on-scroll">
                        <div class="icon-box green"><i class="fas fa-mobile-alt"></i></div>
                        <h3>Acceso flexible</h3>
                        <p>Continúa desde computadora, tableta o celular con una interfaz sencilla y responsive.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="home-container story-band animate-on-scroll">
                <div class="story-grid">
                    <div class="story-media">
                        <img src="{{ asset('img/salvadorMundo.png') }}" alt="Monumento al Salvador del Mundo">
                    </div>
                    <div class="story-copy">
                        <span class="home-eyebrow">
                            <img src="{{ asset('img/logo2.png') }}" alt="" class="eyebrow-logo">
                            Inclusión con identidad
                        </span>
                        <h2>LESSA nace para acercar a más personas a la comunicación sin barreras</h2>
                        <p>
                            Promovemos el aprendizaje de la lengua de señas salvadoreña con recursos claros, práctica
                            constante y una visión centrada en la accesibilidad.
                        </p>

                        <div class="story-points">
                            <div class="story-point">
                                <div class="icon-box blue"><i class="fas fa-bullseye"></i></div>
                                <div>
                                    <h3>Misión</h3>
                                    <p>Enseñar LESSA de manera accesible y práctica para fortalecer la comunicación
                                        inclusiva.</p>
                                </div>
                            </div>
                            <div class="story-point">
                                <div class="icon-box gold"><i class="fas fa-lightbulb"></i></div>
                                <div>
                                    <h3>Visión</h3>
                                    <p>Ser una plataforma referente en El Salvador para aprender señas y fomentar
                                        integración social, cultural y laboral.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="home-container">
                <div class="section-heading animate-on-scroll">
                    <span class="home-eyebrow">
                        <img src="{{ asset('img/logo2.png') }}" alt="" class="eyebrow-logo">
                        Tu ruta de aprendizaje
                    </span>
                    <h2>Empieza con bases útiles y avanza hacia conversaciones reales</h2>
                    <p>
                        Cada módulo está diseñado para ayudarte a reconocer señas, memorizar vocabulario y practicar en
                        situaciones cotidianas.
                    </p>
                </div>

                <div class="path-grid">
                    <article class="path-card animate-on-scroll">
                        <img src="{{ asset('img/abcd.png') }}" alt="Abecedario en lengua de señas">
                        <div class="path-card-content">
                            <span class="path-meta"><i class="fas fa-fingerprint"></i> Base</span>
                            <h3>Abecedario</h3>
                            <p>Practica la dactilología completa de LESSA paso a paso.</p>
                        </div>
                    </article>

                    <article class="path-card animate-on-scroll">
                        <img src="{{ asset('img/numbers.png') }}" alt="Números en lengua de señas">
                        <div class="path-card-content">
                            <span class="path-meta"><i class="fas fa-calculator"></i> Práctica</span>
                            <h3>Números</h3>
                            <p>Aprende a contar y reconocer números con ejercicios visuales.</p>
                        </div>
                    </article>

                    <article class="path-card animate-on-scroll">
                        <img src="{{ asset('img/saludos.png') }}" alt="Saludos en lengua de señas">
                        <div class="path-card-content">
                            <span class="path-meta"><i class="fas fa-comments"></i> Conversación</span>
                            <h3>Saludos</h3>
                            <p>Inicia interacciones básicas, formales y cotidianas.</p>
                        </div>
                    </article>

                    <article class="path-card animate-on-scroll">
                        <img src="{{ asset('img/health.png') }}" alt="Vocabulario de salud">
                        <div class="path-card-content">
                            <span class="path-meta"><i class="fas fa-heartbeat"></i> Vocabulario</span>
                            <h3>Salud</h3>
                            <p>Reconoce señas esenciales sobre cuerpo, síntomas y bienestar.</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="section testimonials">
            <div class="home-container">
                <div class="section-heading center animate-on-scroll">
                    <span class="home-eyebrow">
                        <img src="{{ asset('img/logo2.png') }}" alt="" class="eyebrow-logo">
                        Comunidad
                    </span>
                    <h2>Una herramienta para aprender y conectar mejor</h2>
                    <p>
                        LESSA busca apoyar a estudiantes, docentes, familias y personas interesadas en una comunicación
                        más inclusiva.
                    </p>
                </div>

                <div class="testimonial-grid">
                    <article class="testimonial-card animate-on-scroll">
                        <div class="quote-mark"><i class="fas fa-quote-left"></i></div>
                        <p>LESSA ha transformado la forma en que practico vocabulario con mis estudiantes. Es clara,
                            visual y fácil de seguir.</p>
                        <div class="testimonial-author">
                            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="María González"
                                class="author-img">
                            <div class="author-info">
                                <h4>María González</h4>
                                <span>Docente</span>
                            </div>
                        </div>
                    </article>

                    <article class="testimonial-card animate-on-scroll">
                        <div class="quote-mark"><i class="fas fa-quote-left"></i></div>
                        <p>Valoro mucho una plataforma que promueva la inclusión y motive a más personas a aprender
                            lengua de señas salvadoreña.</p>
                        <div class="testimonial-author">
                            <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Carlos Rodríguez"
                                class="author-img">
                            <div class="author-info">
                                <h4>Carlos Rodríguez</h4>
                                <span>Estudiante</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <div class="home-container">
                <div class="cta-card animate-on-scroll">
                    <div>
                        <h2>Comienza hoy y aprende una seña nueva cada día</h2>
                        <p>
                            Únete a LESSA y forma parte de una comunidad que aprende para comunicarse mejor y construir
                            espacios más inclusivos.
                        </p>
                    </div>
                    <div class="cta-actions">
                        <button class="btn btn-accent" onclick="window.location.href='/signup'">
                            <i class="fas fa-user-plus"></i> Crear cuenta gratuita
                        </button>
                        <button class="btn btn-outline" onclick="window.location.href='/ayuda/manual'">
                            <i class="fas fa-info-circle"></i> Más información
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        @include('partials.footer')
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const animatedElements = document.querySelectorAll('.animate-on-scroll');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            animatedElements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
</body>

</html>
