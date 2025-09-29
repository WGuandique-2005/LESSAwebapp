<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nivel Cifras: Mini-Juegos - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Colores Base */
            --primary-blue: #2a6fdb;
            --primary-orange: #ff6b35;
            --secondary-yellow: #ffc107;
            --light-gray: #f4f6f9;
            --medium-gray: #e9ecef;
            --dark-gray: #212529;
            --text-color: #212529;
            --white: #ffffff;
            --success-color: #069c5e; /* Un verde más oscuro y sólido */
            
            /* Colores específicos del Nivel Cifras (temática de cálculo/contabilidad) */
            --level-color-main: #6b4dff; /* Púrpura/Violeta para distinguir de azul (Abecedario) */
            --dark-overlay: rgba(107, 77, 255, 0.75);

            /* Espaciado, Tipografía y Componentes (Iguales a la versión anterior) */
            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --spacing-xxl: 3rem;

            --font-family-primary: 'Poppins', sans-serif;
            --font-size-base: 1rem;
            --font-size-sm: 0.9rem;
            --font-size-md: 1.125rem;
            --font-size-lg: 1.35rem;
            --font-size-xl: 2.5rem;
            --font-size-xxl: 3rem;

            --border-radius: 12px;
            --transition-speed: 0.3s;
        }

        body {
            font-family: var(--font-family-primary);
            line-height: 1.6;
            color: var(--text-color);
            margin: 0;
            padding: 0;
            background-color: var(--light-gray);
        }

        .container {
            max-width: 1080px;
            margin: 0 auto;
            padding: 0 var(--spacing-md);
        }

        /* --- HERO SECTION: Nivel Cifras --- */
        .hero-section {
            background-color: var(--level-color-main); 
            padding: var(--spacing-xl) 0;
            color: var(--white);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            min-height: 300px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Utilizamos el overlay púrpura/violeta */
            background-color: var(--dark-overlay); 
            z-index: 1;
        }



        .hero-text {
            text-align: center;
            width: 100%;
            position: relative; 
            z-index: 2; 
        }

        .hero-text h2 {
            font-size: var(--font-size-xxl);
            font-weight: 800;
            /* Color amarillo para destacar */
            color: var(--secondary-yellow); 
            margin-bottom: var(--spacing-sm);
        }

        .hero-text h3 {
            font-size: var(--font-size-lg);
            font-weight: 600;
            margin-bottom: var(--spacing-md);
        }

        .hero-text p {
            font-size: var(--font-size-md);
            max-width: 700px;
            margin: 0 auto var(--spacing-xl);
        }
        /* --- END HERO SECTION --- */
        
        /* --- PROGRESS CIRCLE (Estilos sin cambios, solo se adapta el color de éxito) --- */
        .progress-and-intro-container {
            padding: var(--spacing-xl) 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .progress-info {
            margin-top: var(--spacing-lg);
            padding: var(--spacing-lg);
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .progress-info h4 {
            font-size: var(--font-size-md);
            /* Usamos el color del nivel */
            color: var(--level-color-main);
            margin-bottom: var(--spacing-sm);
            font-weight: 700;
        }

        .progress-info p {
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
            margin: 0;
        }

        .progress-circle-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin-bottom: var(--spacing-md);
        }

        .progress-circle {
            width: 100%;
            height: 100%;
            transform: rotate(-90deg);
        }

        .progress-circle-bg {
            stroke: var(--medium-gray);
            stroke-width: 10;
            fill: none;
        }

        .progress-circle-bar {
            stroke: var(--success-color); 
            stroke-width: 10;
            stroke-linecap: round;
            fill: none;
            transition: stroke-dashoffset 1s ease-out;
        }

        .progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: var(--font-size-xl);
            font-weight: 800;
            color: var(--success-color);
        }

        .section-header {
            margin-bottom: var(--spacing-lg);
            text-align: center;
        }

        .section-header h2 {
            /* Usamos el color principal de la aplicación */
            color: var(--primary-orange);
            font-size: var(--font-size-xl);
            text-transform: uppercase;
        }

        /* --- CARDS: Mini-Game Cards --- */
        .main-game-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--spacing-lg);
            padding-bottom: var(--spacing-xl);
        }

        .game-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
            cursor: pointer;
            /* Usamos el color del nivel como borde de destaque */
            border-top: 5px solid var(--level-color-main);
            text-align: center;
            padding: var(--spacing-lg);
        }

        .game-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            border-top-color: var(--primary-orange);
        }

        .game-card .icon {
            font-size: 3rem;
            margin-bottom: var(--spacing-sm);
            display: block;
        }

        .game-card h3 {
            font-size: var(--font-size-lg);
            color: var(--dark-gray);
            font-weight: 700;
            margin-bottom: var(--spacing-sm);
        }

        .game-card p {
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
        }

        /* Colores de Icono Específicos para NÚMEROS */
        .game-card.game-1 .icon { color: #f94144; } /* Lógico */
        .game-card.game-2 .icon { color: #2ecc71; } /* Cálculo */
        .game-card.game-3 .icon { color: #f39c12; } /* Tiempo */
        .game-card.game-4 .icon { color: #3498db; } /* Secuencia */


        /* Responsive adjustments (Sin cambios) */
        @media (min-width: 768px) {
            .hero-text {
                text-align: left;
            }
            .progress-and-intro-container {
                flex-direction: row;
                text-align: left;
                justify-content: space-between;
                align-items: center;
                padding-bottom: var(--spacing-xxl);
            }
            .main-game-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .progress-info {
                max-width: 60%;
                box-shadow: none;
                background: transparent;
                padding-left: var(--spacing-xl);
            }
            .progress-circle-container {
                margin-bottom: 0;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>
    <main>
        <section class="hero-section">
            <div class="container hero-content">
                <div class="hero-text">
                    <h2>NIVEL 2: CIFRAS Y CONTEO</h2>
                    <h3>¡Domina la numeración en LESSA, desde el 0 hasta el 1,000!</h3>
                    <p>La capacidad de contar y comunicar cantidades es crucial. Estos mini-juegos te desafiarán a reconocer,
                        producir y ordenar números grandes y pequeños. ¡Completa el 100% de este nivel para avanzar a las Señas
                        Básicas!</p>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="progress-and-intro-container">
                <div class="progress-circle-container">
                    <svg class="progress-circle" viewBox="0 0 40 40">
                        <circle class="progress-circle-bg" cx="20" cy="20" r="15.9155"></circle>
                        <circle class="progress-circle-bar" cx="20" cy="20" r="15.9155"
                            style="stroke-dasharray: 100; stroke-dashoffset: 50;"></circle>
                    </svg>
                    <span class="progress-text" id="progress-percent">50%</span>
                </div>
                <div class="progress-info">
                    <h4>PROGRESO DEL NIVEL</h4>
                    <p>Has completado **2 de 4** mini-juegos. Estás a mitad de camino para dominar la numeración. ¡Solo dos
                        desafíos más!</p>
                </div>
            </div>
            <section class="learn-sections">
                <div class="section-header">
                    <h2>Mini-Juegos de Numeración</h2>
                </div>
                <div class="learn-sections-layout">
                    <div class="main-game-grid">
                        <div class="game-card game-1" onclick="window.location.href='/juegos/cifras/que-numero-es'">
                            <span class="icon">🔢</span>
                            <h3>¿Qué Número Es?</h3>
                            <p>Se te mostrará la seña de un número y deberás escribir o seleccionar la cifra correspondiente.
                                Incluye números de tres y cuatro dígitos.</p>
                        </div>
                        <div class="game-card game-2" onclick="window.location.href='/juegos/cifras/calculo-rapido'">
                            <span class="icon">➕</span>
                            <h3>Matemáticas en Señas</h3>
                            <p>Resuelve operaciones matemáticas sencillas. Debes leer las señas de los números y responder
                                con rapidez la seña del resultado.</p>
                        </div>
                        <div class="game-card game-3" onclick="window.location.href='/juegos/cifras/contexto-numerico'">
                            <span class="icon">⏰</span>
                            <h3>Números en Contexto</h3>
                            <p>Relaciona las señas de números con conceptos de la vida real como horas, fechas o precios.
                                ¡Aplica lo que sabes!</p>
                        </div>
                        <div class="game-card game-4" onclick="window.location.href='/juegos/cifras/secuencia-señas'">
                            <span class="icon">➡️</span>
                            <h3>Sigue la Secuencia</h3>
                            <p>Se te dará un número de inicio y deberás hacer la seña de los siguientes tres números en orden
                                consecutivo. ¡Practica el conteo!</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer>@include('partials.footer')</footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuración del Círculo de Progreso
            const progressCircleBar = document.querySelector('.progress-circle-bar');
            const progressText = document.getElementById('progress-percent');
            
            // Simulación del progreso (4 juegos, 2 completados = 50%)
            const totalGames = 4;
            const completedGames = 2; // Simulación: 2 juegos completados
            const currentProgress = Math.round((completedGames / totalGames) * 100); // 50
            
            // Fórmula para el círculo SVG: 2 * Pi * Radio (2 * 3.14159 * 15.9155) = 100
            const circumference = 100;
            const offset = circumference - (currentProgress / 100) * circumference;

            // Ajuste el valor inicial de la barra SVG y el texto
            progressCircleBar.style.strokeDashoffset = offset;
            progressText.textContent = currentProgress + '%';

            // Animación (opcional, para visualización dinámica)
            setTimeout(() => {
                 progressCircleBar.style.strokeDashoffset = offset;
            }, 100); 
        });
    </script>
</body>

</html>