<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuda y FAQ - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Variables y Estilos Base (Tomados de practicar.blade.php) */
        :root {
            --primary-blue: #007bff; /* Principal: Azul */
            --primary-orange: #ff6b35; /* Acento: Naranja */
            --light-gray: #f4f6f9; /* Fondo muy claro */
            --medium-gray: #e9ecef;
            --dark-gray: #2c3e50; /* Texto principal oscuro */
            --text-color: #34495e;
            --white: #ffffff;
            --border-color: #dcdcdc;

            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2.5rem; 
            --spacing-xxl: 4rem;

            --font-family-primary: 'Poppins', sans-serif;
            --font-size-base: 1rem;
            --font-size-md: 1rem;
            --font-size-lg: 1.25rem;
            --font-size-xl: 2.5rem;

            --border-radius-sm: 8px;
            --border-radius-lg: 16px;
            --transition-speed: 0.3s;
        }

        /* RESET / BASE */
        body {
            font-family: var(--font-family-primary);
            line-height: 1.6;
            color: var(--text-color);
            margin: 0;
            padding: 0;
            background-color: var(--light-gray);
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 var(--spacing-md);
        }

        /* --- HERO SECTION --- */
        .hero-help {
            background-color: var(--primary-blue);
            padding: var(--spacing-xxl) 0 var(--spacing-xl);
            color: var(--white);
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .hero-help h1 {
            font-size: var(--font-size-xl);
            font-weight: 800;
            margin-bottom: var(--spacing-sm);
        }

        .hero-help p {
            font-size: var(--font-size-lg);
            max-width: 800px;
            margin: 0 auto;
            opacity: 0.9;
        }

        /* --- FAQ SECTION: Acordeón UX/UI --- */
        .faq-section {
            padding: var(--spacing-xxl) 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: var(--spacing-xl);
        }

        .section-title h2 {
            font-size: 2.2rem;
            color: var(--primary-blue);
            font-weight: 700;
            position: relative;
            display: inline-block;
        }

        .section-title h2::after { 
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background-color: var(--primary-orange);
            border-radius: 2px;
        }
        
        .accordion {
            margin-top: var(--spacing-lg);
        }

        .accordion-item {
            background-color: var(--white);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius-sm);
            margin-bottom: var(--spacing-md);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: box-shadow var(--transition-speed);
        }

        .accordion-item:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .accordion-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--spacing-lg);
            cursor: pointer;
            background-color: var(--medium-gray);
            font-weight: 600;
            color: var(--dark-gray);
            transition: background-color var(--transition-speed);
        }
        
        .accordion-header:hover {
            background-color: var(--border-color);
        }

        .accordion-header h3 {
            margin: 0;
            font-size: var(--font-size-md);
        }

        .accordion-icon {
            font-size: var(--font-size-lg);
            margin-left: var(--spacing-md);
            transition: transform var(--transition-speed);
        }

        .accordion-content {
            max-height: 0;
            padding: 0 var(--spacing-lg);
            overflow: hidden;
            transition: max-height 0.4s ease-out, padding 0.4s ease-out;
            border-top: 1px solid var(--border-color);
            background-color: var(--white);
        }

        .accordion-item.active .accordion-content {
            max-height: 500px; /* Suficiente para expandirse */
            padding: var(--spacing-lg);
        }

        .accordion-item.active .accordion-icon {
            transform: rotate(180deg);
            color: var(--primary-orange);
        }

        .accordion-content p {
            margin-top: 0;
            padding-bottom: var(--spacing-sm);
            color: var(--text-color);
        }

        /* --- USER MANUAL SECTION --- */
        .manual-section {
            padding: var(--spacing-xxl) 0;
            text-align: center;
            background-color: var(--white);
            border-top: 1px solid var(--border-color);
        }

        .manual-section h2 {
            color: var(--primary-orange);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: var(--spacing-md);
        }

        .manual-section .placeholder {
            padding: var(--spacing-lg);
            border: 2px dashed var(--medium-gray);
            border-radius: var(--border-radius-sm);
            max-width: 600px;
            margin: var(--spacing-lg) auto;
            color: var(--text-secondary);
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .hero-help h1 {
                font-size: 2rem;
            }
            .section-title h2 {
                font-size: 1.8rem;
            }
            .accordion-header h3 {
                font-size: 1rem;
            }
            .accordion-header {
                padding: var(--spacing-md);
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>
    
    <main>
        <section class="hero-help">
            <div class="container">
                <h1>Centro de Ayuda y Soporte</h1>
                <p>Encuentra respuestas a las preguntas más frecuentes sobre niveles, puntos y el funcionamiento de LESSA.</p>
            </div>
        </section>

        <section class="faq-section">
            <div class="container">
                <div class="section-title">
                    <h2>Preguntas Frecuentes (FAQ)</h2>
                </div>

                <div class="accordion">
                    <div class="accordion-item">
                        <div class="accordion-header" id="faq-1">
                            <h3>¿Cómo se estructura el aprendizaje en LESSA?</h3>
                            <span class="accordion-icon">▼</span>
                        </div>
                        <div class="accordion-content">
                            <p>El aprendizaje se organiza en niveles temáticos (ej. Abecedario, Números, Saludos). Cada nivel contiene múltiples lecciones y mini-juegos de práctica que debes completar para avanzar y ganar puntos de experiencia (XP).</p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-header" id="faq-2">
                            <h3>¿Cuál es la diferencia entre una Lección y un Nivel?</h3>
                            <span class="accordion-icon">▼</span>
                        </div>
                        <div class="accordion-content">
                            <p>Un Nivel es una unidad temática grande (ej. Abecedario) que agrupa un conjunto de habilidades. Una Lección es un subtema o módulo específico dentro de un nivel, enfocado en un grupo reducido de señas o conceptos, culminando generalmente en un mini-juego.</p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-header" id="faq-3">
                            <h3>¿Cómo gano Puntos de Experiencia (XP) en LESSA?</h3>
                            <span class="accordion-icon">▼</span>
                        </div>
                        <div class="accordion-content">
                            <p>Ganas XP al completar mini-juegos, responder correctamente en las evaluaciones de los niveles y mantener una racha de práctica diaria. Los puntos reflejan tu esfuerzo y dedicación en la plataforma.</p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-header" id="faq-4">
                            <h3>¿Qué recompensas obtengo al acumular puntos?</h3>
                            <span class="accordion-icon">▼</span>
                        </div>
                        <div class="accordion-content">
                            <p>Los puntos desbloquean insignias de logro (badges) y trofeos y te dan a recompensas exclusivas. ¡Motívate a coleccionarlas todas!</p>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <div class="accordion-header" id="faq-5">
                            <h3>¿Cuál fue la inspiración detrás de la aplicación LESSA?</h3>
                            <span class="accordion-icon">▼</span>
                        </div>
                        <div class="accordion-content">
                            <p>LESSA nació de la profunda necesidad de promover la inclusión y facilitar el aprendizaje del Lenguaje de Señas Salvadoreño (LESSA). Nuestro objetivo es reducir la brecha comunicativa, apoyar a la comunidad sorda en El Salvador y honrar su rica cultura lingüística.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="manual-section">
            <div class="container">
                <h2>Manual de Usuario de la Plataforma</h2>
                <p>Esta sección está destinada a ofrecer una guía detallada paso a paso de todas las funciones de LESSA.</p>
                <div class="placeholder">
                    El Manual de Usuario estará disponible pronto. Incluirá tutoriales en video y texto para aprovechar al máximo tu aprendizaje en Lengua de Señas.
                </div>
                <a href="#" class="btn-primary" style="display: inline-block; padding: 10px 20px; background-color: var(--primary-orange); color: var(--white); text-decoration: none; border-radius: var(--border-radius-sm); font-weight: 600;">Ver Guía Rápida (Próximamente)</a>
            </div>
        </section>
    </main>
    
    <footer>@include('partials.footer')</footer>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const headers = document.querySelectorAll('.accordion-header');

            headers.forEach(header => {
                header.addEventListener('click', function() {
                    const item = this.closest('.accordion-item');
                    const content = item.querySelector('.accordion-content');
                    
                    // Cierra todos los demás ítems
                    document.querySelectorAll('.accordion-item.active').forEach(activeItem => {
                        if (activeItem !== item) {
                            activeItem.classList.remove('active');
                            activeItem.querySelector('.accordion-content').style.maxHeight = 0;
                        }
                    });

                    // Alterna el ítem actual
                    if (item.classList.contains('active')) {
                        item.classList.remove('active');
                        content.style.maxHeight = 0;
                    } else {
                        item.classList.add('active');
                        // Usar scrollHeight asegura que se abra a la altura correcta
                        content.style.maxHeight = content.scrollHeight + "px";
                    }
                });
            });
        });
    </script>
</body>

</html>