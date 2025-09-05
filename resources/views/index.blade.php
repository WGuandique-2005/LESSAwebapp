<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio - LESSA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #0A2463;
            --secondary: #3E92CC;
            --accent: #FFD166;
            --light: #F2F4F7;
            --dark: #1E1E24;
            --success: #4CB944;
            --radius: 16px;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4 {
            color: var(--primary);
            margin-top: 0;
            font-weight: 700;
            line-height: 1.3;
        }

        h1 {
            font-size: 2.8rem;
            margin-bottom: 1.5rem;
        }

        h2 {
            font-size: 2.2rem;
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }

        h2:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }

        p {
            margin-bottom: 1.5rem;
            font-size: 1.05rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.9rem 2rem;
            border-radius: var(--radius);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
            gap: 8px;
            border: none;
            outline: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            background-color: var(--secondary);
            transform: translateY(-3px);
            box-shadow: 0 12px 20px rgba(62, 146, 204, 0.2);
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--accent);
            border-color: var(--accent);
            color: var(--dark);
            transform: translateY(-3px);
        }

        .btn-accent {
            background-color: var(--accent);
            color: var(--dark);
            box-shadow: var(--shadow);
        }

        .btn-accent:hover {
            background-color: #FFC233;
            transform: translateY(-3px);
            box-shadow: 0 12px 20px rgba(255, 209, 102, 0.25);
        }

        /* HERO */
        .hero {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            padding: 4rem 0;
            gap: 2rem;
            min-height: 85vh;
        }

        .hero-text {
            flex: 1 1 500px;
            animation: fadeInUp 1s ease;
        }

        .hero-text p {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            max-width: 90%;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 2rem;
        }

        .hero-img {
            flex: 1 1 450px;
            text-align: center;
            animation: fadeInRight 1s ease;
            position: relative;
        }

        .hero-img:before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--secondary), var(--primary));
            opacity: 0.1;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            filter: blur(20px);
        }

        .hero-img img {
            max-width: 100%;
            height: auto;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition: transform 0.5s ease;
        }

        .hero-img img:hover {
            transform: scale(1.02);
        }

        /* Features */
        .features {
            padding: 6rem 0;
            background-color: white;
            border-radius: var(--radius);
            position: relative;
            overflow: hidden;
        }

        .features:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary), var(--secondary), var(--accent));
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            margin-bottom: 1rem;
        }

        .section-header h2:after {
            left: 50%;
            transform: translateX(-50%);
        }

        .section-header p {
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.1rem;
        }

        /* CARDS */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .card {
            background: white;
            border-radius: var(--radius);
            padding: 2.5rem 2rem;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .card:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
            transition: var(--transition);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card:hover:after {
            width: 8px;
        }

        .card-icon {
            width: 90px;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(10, 36, 99, 0.05);
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            font-size: 2.5rem;
            color: var(--primary);
            transition: var(--transition);
        }

        .card:hover .card-icon {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        .card h3 {
            margin-bottom: 1rem;
            font-size: 1.4rem;
        }

        .card p {
            color: #666;
        }

        /* Testimonials */
        .testimonials {
            padding: 6rem 0;
            background: linear-gradient(to bottom, #f9fafb, #f2f4f7);
        }

        .testimonial-card {
            background: white;
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            margin: 1rem;
            position: relative;
        }

        .testimonial-card:before {
            content: '\201C';
            font-size: 5rem;
            color: var(--accent);
            opacity: 0.2;
            position: absolute;
            top: -10px;
            left: 20px;
            font-family: Georgia, serif;
        }

        .testimonial-content {
            position: relative;
            z-index: 1;
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 1.5rem;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .author-info h4 {
            margin-bottom: 0.2rem;
            font-size: 1.1rem;
        }

        .author-info p {
            margin: 0;
            font-size: 0.9rem;
            color: #666;
        }

        /* CTA Section */
        .cta-section {
            padding: 5rem 0;
            text-align: center;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border-radius: var(--radius);
            margin: 4rem 0;
        }

        .cta-section h2 {
            color: white;
            margin-bottom: 1.5rem;
        }

        .cta-section h2:after {
            display: none;
        }

        .cta-section p {
            max-width: 700px;
            margin: 0 auto 2.5rem;
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        /* Footer */
        footer {
            background-color: var(--dark);
            color: white;
            padding: 4rem 0 2rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1.5rem;
        }

        .footer-description {
            opacity: 0.8;
            margin-bottom: 1.5rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transition: var(--transition);
        }

        .social-links a:hover {
            background: var(--accent);
            color: var(--dark);
            transform: translateY(-3px);
        }

        .footer-heading {
            color: white;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--accent);
            padding-left: 5px;
        }

        .copyright {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            opacity: 0.7;
            font-size: 0.9rem;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 992px) {
            h1 {
                font-size: 2.4rem;
            }

            h2 {
                font-size: 2rem;
            }

            .hero {
                padding: 3rem 0;
                text-align: center;
            }

            .hero-text p {
                max-width: 100%;
            }

            .hero-buttons {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {

            .btn {
                width: 100%;
            }

            h1 {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.8rem;
            }

            .card {
                padding: 2rem 1.5rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 1rem;
            }

            h1 {
                font-size: 1.8rem;
            }

            h2 {
                font-size: 1.6rem;
            }

            .hero-img {
                flex: 1 1 100%;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>
    <main>
        <div class="container">
            <!-- Hero principal -->
            <section class="hero">
                <div class="hero-text">
                    <h1>Aprende Lengua de Señas Salvadoreña con LESSA</h1>
                    <p>
                        Una plataforma interactiva diseñada para que aprendas a tu ritmo, con un método de
                        <strong>autoaprendizaje divertido</strong>,
                        enfocado en la <strong>inclusión</strong> y rompiendo barreras de comunicación.
                    </p>
                    <div class="hero-buttons">
                        <button class="btn btn-primary" onclick="window.location.href='/signup'">
                            <i class="fas fa-rocket"></i> Empieza ahora
                        </button>
                        <button class="btn btn-outline" onclick="window.location.href='/login'">
                            <i class="fas fa-user"></i> Ya tengo cuenta
                        </button>
                    </div>
                </div>
                <div class="hero-img">
                    <img src="{{ asset('img/logo2.png') }}" alt="Aprendiendo lengua de señas">
                </div>
            </section>

            <!-- Features Section -->
            <section class="features">
                <div class="section-header animate-on-scroll">
                    <h2>¿Por qué aprender con LESSA?</h2>
                    <p>Nuestra plataforma está diseñada para hacer el aprendizaje de la lengua de señas salvadoreña
                        accesible, efectivo y divertido.</p>
                </div>

                <div class="cards">
                    <div class="card animate-on-scroll">
                        <div class="card-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Aprendizaje a tu ritmo</h3>
                        <p>Avanza según tu disponibilidad de tiempo y refuerza los conceptos las veces que necesites.
                        </p>
                    </div>

                    <div class="card animate-on-scroll">
                        <div class="card-icon">
                            <i class="fas fa-gamepad"></i>
                        </div>
                        <h3>Lecciones interactivas</h3>
                        <p>Aprende mediante juegos, ejercicios prácticos y retroalimentación inmediata.</p>
                    </div>

                    <div class="card animate-on-scroll">
                        <div class="card-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3>Acceso desde cualquier dispositivo</h3>
                        <p>Continúa tu aprendizaje en computadora, tableta o smartphone sin interrupciones.</p>
                    </div>
                </div>
            </section>

            <!-- Misión y Visión -->
            <section class="features">
                <div class="section-header animate-on-scroll">
                    <h2>Nuestra Misión y Visión</h2>
                    <p>Promovemos el aprendizaje del lenguaje de señas salvadoreño con lecciones cortas, juegos
                        interactivos y prácticas accesibles desde cualquier lugar.</p>
                </div>

                <div class="cards">
                    <div class="card animate-on-scroll">
                        <img src="{{ asset('img/salvadorMundo.png') }}" alt="Misión" width="100">
                        <h3>Misión</h3>
                        <p>Enseñar LESSA de manera accesible y práctica, fortaleciendo la comunicación inclusiva entre
                            personas sordas y oyentes.</p>
                    </div>

                    <div class="card animate-on-scroll">
                        <img src="{{ asset('img/farolitos.png') }}" alt="Visión" width="100">
                        <h3>Visión</h3>
                        <p>Ser la plataforma líder en El Salvador para aprender lengua de señas, fomentando integración
                            social, cultural y laboral.</p>
                    </div>
                </div>
            </section>

            <!-- Inclusión -->
            <section class="features">
                <div class="section-header animate-on-scroll">
                    <h2>Rompiendo barreras</h2>
                    <p>Cada seña aprendida es un paso hacia un mundo más inclusivo, donde todos podamos comunicarnos sin
                        barreras.</p>
                </div>

                <div class="cards">
                    <div class="card animate-on-scroll">
                        <img src="{{ asset('img/who.png')}}" alt="Quiénes somos" width="100">
                        <h3>¿Quiénes somos?</h3>
                        <p>Un equipo de jóvenes desarrolladores comprometidos con la accesibilidad y la educación
                            inclusiva.</p>
                    </div>

                    <div class="card animate-on-scroll">
                        <img src="{{ asset('img/hands.png')}}" alt="Manos" width="100">
                        <h3>Educación para todos</h3>
                        <p>Ofrecemos una app intuitiva que se adapta a tu ritmo de aprendizaje, incluso en comunidades
                            con recursos limitados.</p>
                    </div>
                </div>
            </section>

            <!-- Testimonials Section -->
            <section class="testimonials">
                <div class="container">
                    <div class="section-header animate-on-scroll">
                        <h2>Lo que dicen nuestros usuarios</h2>
                        <p>La experiencia de aprendizaje de nuestros usuarios es nuestra mayor motivación.</p>
                    </div>

                    <div class="cards">
                        <div class="testimonial-card animate-on-scroll">
                            <div class="testimonial-content">
                                <p class="testimonial-text">LESSA ha transformado la forma en que me comunico con mis
                                    estudiantes con discapacidad auditiva. ¡Una herramienta invaluable!</p>
                                <div class="testimonial-author">
                                    <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="María González"
                                        class="author-img">
                                    <div class="author-info">
                                        <h4>María González</h4>
                                        <p>Estudiantes</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial-card animate-on-scroll">
                            <div class="testimonial-content">
                                <p class="testimonial-text">Como persona con discapacidad auditiva, valoro enormemente
                                    iniciativas como LESSA que promueven la inclusión.</p>
                                <div class="testimonial-author">
                                    <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Carlos Rodríguez"
                                        class="author-img">
                                    <div class="author-info">
                                        <h4>Carlos Rodríguez</h4>
                                        <p>Estudiante</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="cta-section animate-on-scroll">
                <h2>¡Comienza tu journey de aprendizaje hoy!</h2>
                <p>Únete a nuestra comunidad y forma parte del cambio hacia una sociedad más inclusiva y comunicativa.
                </p>
                <div class="cta-buttons">
                    <button class="btn btn-accent" onclick="window.location.href='/signup'">
                        <i class="fas fa-user-plus"></i> Crear cuenta gratuita
                    </button>
                    <button class="btn btn-outline"
                        style="background: rgba(255,255,255,0.1); color: white; border-color: white;">
                        <i class="fas fa-info-circle"></i> Más información
                    </button>
                </div>
            </section>
        </div>
    </main>

    <footer>
        @include('partials.footer')
    </footer>

    <script>
        // Animation on scroll
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