<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivina la letra</title>
    {{-- Se agregó Font Awesome para los iconos de los botones del modal --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
    /* 1. Tipografía y Variables */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap');

    :root {
        --primary-blue: #2a6fdb; /* Azul VIBRANTE */
        --secondary-orange: #ff6b35; /* Naranja VIBRANTE */
        --success-color: #069c5e;
        --error-color: #dc3545;
        --warning-color: #ffc107;
        --light-gray: #f4f6f9;
        --medium-gray: #ced4da; /* Para la barra de progreso */
        --dark-gray: #212529;
        --body-bg: #e9ecef; /* Fondo suave */
        
        /* Variables para el Modal Mejorado */
        --modal-bg-dark: #343a40; /* Gris oscuro para botones o fondos */
        --radius-lg: 18px;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--body-bg);
        line-height: 1.6;
        padding: 0;
        margin: 0;
    }

    /* 2. Estilos del Contenedor Principal */
    .game-container {
        max-width: 900px; /* Un poco más de espacio */
        width: 90%;
        margin: 40px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 20px; /* Bordes más suaves */
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15); /* Sombra más profunda */
        text-align: center;
        transition: transform 0.3s ease;
    }

    h1 {
        color: var(--primary-blue);
        font-weight: 800;
        margin-bottom: 10px;
        font-size: 2.2rem;
    }
    
    .text-secondary {
        color: var(--secondary-orange);
        font-weight: 600;
    }

    /* 3. Estilos de la Tarjeta de Pregunta */
    .question-card {
        padding: 25px;
        background-color: var(--light-gray);
        border-radius: 15px;
        margin-bottom: 25px;
        min-height: 380px; /* Mayor altura para mejor presentación */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border: 1px solid #dee2e6; /* Borde sutil */
    }

    .sign-image {
        width: 200px;
        height: 200px;
        object-fit: contain;
        margin-bottom: 25px;
        border: 6px solid var(--secondary-orange); /* Borde más grueso y notable */
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        background-color: white; /* Fondo blanco para la imagen */
        transition: transform 0.3s ease-in-out;
    }

    .sign-image:hover {
        transform: scale(1.03);
    }

    .question-card h2 {
        color: var(--dark-gray);
        font-size: 1.75rem;
        font-weight: 600;
    }

    /* 4. Estilos de los Botones de Opciones (RESPONSIVE GRID) */
    .options-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr); /* 4 columnas en desktop */
        gap: 15px;
        margin-top: 20px;
    }

    .option-btn {
        padding: 18px 10px;
        font-size: 1.35rem;
        font-weight: 700;
        border: 3px solid var(--primary-blue);
        border-radius: 10px;
        background-color: #fff;
        color: var(--primary-blue);
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        user-select: none; /* Evitar selección de texto */
    }

    .option-btn:hover:not(.disabled) {
        background-color: var(--primary-blue);
        color: white;
        transform: translateY(-3px) scale(1.02); /* Efecto 3D sutil */
        box-shadow: 0 5px 10px rgba(42, 111, 219, 0.3);
    }

    .option-btn:active {
        transform: translateY(0);
        box-shadow: none;
    }
    
    .option-btn.disabled {
        pointer-events: none; /* Deshabilitar clics después de la respuesta */
        opacity: 0.7;
    }


    /* Estados de los botones */
    .option-btn.correct {
        background-color: var(--success-color);
        border-color: var(--success-color);
        color: white;
        animation: pulseCorrect 0.5s;
    }

    .option-btn.wrong {
        background-color: var(--error-color);
        border-color: var(--error-color);
        color: white;
        animation: shakeWrong 0.4s;
    }

    @keyframes pulseCorrect {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    @keyframes shakeWrong {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-5px); }
        40%, 80% { transform: translateX(5px); }
    }

    /* 5. Resultados y Progreso */
    .feedback-message {
        font-size: 1.3rem;
        font-weight: 700;
        margin-top: 20px;
        min-height: 30px;
        color: var(--dark-gray);
    }

    .progress-bar {
        height: 12px; /* Un poco más alto */
        background-color: var(--medium-gray);
        border-radius: 6px;
        margin-top: 15px;
        overflow: hidden; /* Para contener el fill */
    }

    .progress-fill {
        height: 100%;
        width: 0%;
        background-color: var(--secondary-orange);
        border-radius: 6px;
        transition: width 0.5s ease-in-out;
    }
    
    .text-muted {
        color: #6c757d !important;
        font-weight: 600;
    }

    /* 6. Modal de fin de juego (ESTILOS MEJORADOS) */
    .end-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.85); /* Fondo más oscuro */
        backdrop-filter: blur(4px); /* Nuevo efecto de desenfoque */
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content {
        background: white;
        padding: 40px 30px;
        border-radius: var(--radius-lg);
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4); /* Sombra más dramática */
        max-width: 480px;
        width: 90%;
        transform: scale(0.8);
        animation: scaleIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; /* Animación elástica */
        border-top: 8px solid var(--success-color); /* Borde superior de éxito */
    }

    @keyframes scaleIn {
        0% { transform: scale(0.8); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    .modal-content h2 {
        color: var(--primary-blue);
        font-size: 2.2rem;
        margin-bottom: 15px;
        font-weight: 800;
    }

    .modal-content p {
        font-size: 1.1rem;
        color: var(--dark-gray);
        margin-bottom: 15px;
        line-height: 1.4;
    }

    .modal-content .points {
        font-size: 3rem; /* Puntos más grandes */
        color: var(--success-color);
        font-weight: 800;
        margin: 20px 0 30px;
        display: block; 
        background: #e6ffed;
        padding: 10px 0;
        border-radius: 10px;
        border: 2px dashed var(--success-color);
    }
    
    /* Contenedor de Acciones del Modal */
    .modal-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 25px;
    }

    .btn-modal-action {
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-size: 1.05rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    .btn-modal-action .fas {
        font-size: 1.1rem;
    }

    /* Estilo del botón Primario (Continuar) - AZUL */
    .btn-primary {
        background-color: var(--primary-blue);
        color: white;
        box-shadow: 0 4px 0 #1e59b2;
    }

    .btn-primary:hover {
        background-color: #1e59b2;
        transform: translateY(-2px);
        box-shadow: 0 6px 0 #144081;
    }
    
    .btn-primary:active {
        transform: translateY(2px);
        box-shadow: 0 2px 0 #144081;
    }

    /* NUEVO Estilo del botón "Ver Mi Progreso" - NARANJA */
    .btn-progress-redirect {
        background-color: var(--secondary-orange);
        color: white;
        box-shadow: 0 4px 0 #d1562b; /* Tono más oscuro de orange */
    }

    .btn-progress-redirect:hover {
        background-color: #d1562b;
        transform: translateY(-2px);
        box-shadow: 0 6px 0 #9c3f1d;
    }

    .btn-progress-redirect:active {
        transform: translateY(2px);
        box-shadow: 0 2px 0 #9c3f1d;
    }


    /* MEDIA QUERIES para responsividad (Móviles) */
    @media (max-width: 768px) {
        .game-container {
            margin: 20px auto;
            padding: 20px;
        }

        h1 {
            font-size: 1.8rem;
        }
        
        /* Cambiar a 2 columnas para opciones en móvil */
        .options-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .option-btn {
            font-size: 1.1rem;
            padding: 12px 8px;
        }
        
        .question-card {
             min-height: 300px;
        }

        .sign-image {
            width: 150px;
            height: 150px;
        }
        
        .feedback-message {
            font-size: 1.1rem;
        }
        
        .modal-content {
            padding: 30px 20px;
        }
        
        .modal-content .points {
            font-size: 2.5rem;
        }
    }
</style>
</head>

<body>
    <header>@include('partials.navbar')</header>
    <div class="container">
        <div class="game-container">
            <h1>Mini-Juego: ¿Qué Letra Es? (Abecedario)</h1>
            <p class="text-secondary">Observa la seña y selecciona la letra correcta. Tienes un límite de **10
                preguntas**.</p>

            <div class="progress-bar">
                <div class="progress-fill" id="progress-fill"></div>
            </div>
            <p class="text-muted mt-2"><span id="current-question">1</span> de <span id="total-questions">10</span></p>

            <div class="question-card">
                <img id="sign-image" class="sign-image" src="" alt="Seña a adivinar">
                <h2 id="question-text">¿Qué letra representa esta seña?</h2>
            </div>

            <div class="options-grid" id="options-grid">
            </div>

            <p class="feedback-message" id="feedback-message"></p>

            <form id="score-form" action="{{ route('nivel.abecedario.adivina.complete') }}" method="POST"
                style="display: none;">
                @csrf
                <input type="hidden" name="errors_count" id="errors-input">
                <button type="submit" id="submit-button">Finalizar y Guardar Puntuación</button>
            </form>
        </div>
    </div>

    {{-- MODAL DE FIN DE JUEGO (MEJORADO) --}}
    <div class="end-modal" id="end-modal">
        <div class="modal-content">
            <h2 id="modal-title">¡Juego Terminado!</h2>
            <p id="modal-message"></p>
            <p>Puntos ganados:</p>
            <p class="points" id="modal-points">+0</p>
            <div class="modal-actions">
                {{-- Botón "Ver Mi Progreso" (DISPARA SUBMIT + REDIRECT) --}}
                <button type="button" class="btn-modal-action btn-progress-redirect" onclick="submitAndRedirect('{{ route('miProgreso') }}')">
                    <i class="fas fa-trophy"></i> Ver Mi Progreso
                </button>
                {{-- Botón "Continuar" (DISPARA SUBMIT y depende del backend) --}}
                <button type="button" class="btn-modal-action btn-primary" onclick="document.getElementById('submit-button').click()">
                    <i class="fas fa-arrow-right"></i> Continuar
                </button>
            </div>
        </div>
    </div>
    <footer>@include('partials.footer')</footer>
    <script>
        // 1. Datos del Abecedario (Pasados desde el Controller)
        // El controlador NivelesController::abecedario_adivina pasa estos datos.
        const abecedarioData = @json($abecedarioData);

        // 2. Variables de Estado
        let questions = []; // Array de las 10 preguntas
        let currentQuestionIndex = 0;
        let errorsCount = 0;
        const TOTAL_QUESTIONS = 10;
        const TOTAL_LETTERS = abecedarioData.length; // Usa la longitud real de los datos pasados

        // 3. Elementos del DOM
        const signImage = document.getElementById('sign-image');
        const optionsGrid = document.getElementById('options-grid');
        const feedbackMessage = document.getElementById('feedback-message');
        const progressFill = document.getElementById('progress-fill');
        const currentQuestionSpan = document.getElementById('current-question');
        const endModal = document.getElementById('end-modal');
        const errorsInput = document.getElementById('errors-input');


        /**
         * Mezcla un array (Algoritmo Fisher-Yates).
         */
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        /**
         * Genera la lista de 10 preguntas.
         */
        function generateQuestions() {
            // Baraja la data del abecedario
            const shuffledData = [...abecedarioData]; // Copia el array para no modificar el original
            shuffleArray(shuffledData);

            // Limita a 10 preguntas o al número total de letras
            const maxQuestions = Math.min(TOTAL_QUESTIONS, shuffledData.length);
            const selectedLetters = shuffledData.slice(0, maxQuestions);

            questions = selectedLetters.map(correctLetter => {
                let options = new Set();
                options.add(correctLetter.id);

                // Generar 3 opciones incorrectas únicas
                while (options.size < 4) {
                    const randomLetter = abecedarioData[Math.floor(Math.random() * TOTAL_LETTERS)];
                    // Asegúrate de que la opción incorrecta no sea la misma que la correcta
                    if (randomLetter.id !== correctLetter.id) {
                        options.add(randomLetter.id);
                    }
                }

                // Convertir el Set a Array y barajar
                let optionsArray = Array.from(options);
                shuffleArray(optionsArray);

                return {
                    id: correctLetter.id,
                    ruta: correctLetter.ruta,
                    options: optionsArray,
                    correct: correctLetter.id
                };
            });

            // Ajustar el contador total si es menor a 10
            document.getElementById('total-questions').textContent = questions.length;
        }

        /**
         * Renderiza la pregunta actual.
         */
        function renderQuestion() {
            const q = questions[currentQuestionIndex];
            
            // Actualizar progreso
            currentQuestionSpan.textContent = currentQuestionIndex + 1;
            progressFill.style.width = ((currentQuestionIndex) / questions.length) * 100 + '%';

            
            // Obtiene la ruta base de los assets de Laravel
            const assetBaseUrl = '{{ asset('') }}'; 
            
            // Concatena la ruta base con la ruta específica del JSON (ej: /img/senas/Aa.png)
            signImage.src = assetBaseUrl + q.ruta.replace(/^\/+/g, '');
            optionsGrid.innerHTML = '';
            
            q.options.forEach(option => {
                const button = document.createElement('button');
                button.className = 'option-btn';
                button.textContent = option;
                button.dataset.value = option;
                button.onclick = () => checkAnswer(option, q.correct, button);
                optionsGrid.appendChild(button);
            });

            // Limpiar el mensaje de retroalimentación
            feedbackMessage.textContent = '';
        }


        /**
         * Comprueba la respuesta del usuario.
         */
        function checkAnswer(selected, correct, button) {
            // Deshabilitar botones para evitar múltiples clics
            document.querySelectorAll('.option-btn').forEach(btn => btn.disabled = true);

            if (selected === correct) {
                button.classList.add('correct');
                feedbackMessage.textContent = '¡Correcto! ✅';
            } else {
                button.classList.add('wrong');
                errorsCount++; // Contar el error
                feedbackMessage.textContent = `¡Incorrecto! La seña es la letra ${correct}. ❌`;
                // Resaltar la respuesta correcta
                document.querySelectorAll('.option-btn').forEach(btn => {
                    if (btn.dataset.value === correct) {
                        btn.classList.add('correct');
                    }
                });
            }

            // Pasar a la siguiente pregunta después de un retraso
            setTimeout(() => {
                currentQuestionIndex++;
                if (currentQuestionIndex < questions.length) {
                    // Habilitar botones y renderizar la siguiente pregunta
                    document.querySelectorAll('.option-btn').forEach(btn => btn.disabled = false);
                    renderQuestion();
                } else {
                    // Fin del juego
                    showEndModal();
                }
            }, 1500); // 1.5 segundos de pausa para ver la respuesta
        }

        /**
         * Muestra el modal de fin de juego y prepara el envío.
         */
        function showEndModal() {
            // Actualizar la barra de progreso al 100%
            progressFill.style.width = '100%';

            // 1. Determinar puntos y mensaje
            let points = 0;
            let message = '';
            let title = '';

            if (errorsCount === 0) {
                points = 10;
                title = '¡PERFECTO! 🤩';
                message = 'No tuviste ningún error. ¡Dominas el Abecedario a la perfección! Has ganado el máximo de puntos.';
            } else if (errorsCount <= 2) {
                points = 5;
                title = '¡MUY BIEN! 👍';
                message = `Tuviste ${errorsCount} error(es). Demuestras gran precisión. ¡Sigue practicando para alcanzar la perfección!`;
            } else {
                points = 2;
                title = '¡BUEN INTENTO! 💪';
                message = `Tuviste ${errorsCount} errores. Necesitas un poco más de práctica. Repite la actividad para dominar las señas.`;
            }

            // 2. Actualizar el input oculto y el modal
            errorsInput.value = errorsCount;

            document.getElementById('modal-title').textContent = title;
            document.getElementById('modal-message').textContent = message;
            document.getElementById('modal-points').textContent = `+${points}`;

            // 3. Mostrar el modal
            endModal.style.display = 'flex';
        }
        
        /**
         * Lógica para enviar el formulario de puntuación y luego redirigir a una URL específica.
         * Se usa para el botón "Ver Mi Progreso".
         */
        function submitAndRedirect(url) {
            // 1. Asegurar que el formulario de puntuación se envíe primero
            document.getElementById('submit-button').click(); 
            
            // 2. Redirigir la ventana después de un breve retraso
            // Se usa un setTimeout para dar tiempo al navegador a empezar el proceso de POST.
            // La redirección ocurrirá justo después, forzando la navegación a la vista de progreso.
            setTimeout(() => {
                window.location.href = url;
            }, 100); 
        }

        // Inicialización del juego
        document.addEventListener('DOMContentLoaded', () => {
            // Asegurarse de que los datos fueron cargados
            if (abecedarioData.length > 0) {
                generateQuestions();
                renderQuestion();
            } else {
                document.getElementById('question-text').textContent = 'Error: No se pudieron cargar los datos del abecedario.';
            }
        });

    </script>
</body>

</html>