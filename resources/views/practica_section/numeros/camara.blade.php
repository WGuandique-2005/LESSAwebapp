<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Detectar Números - LESSA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap');

        :root {
            --primary-blue: #2a6fdb;
            --secondary-orange: #ff6b35;
            --success-color: #069c5e;
            --error-color: #dc3545;
            --light-gray: #f4f6f9;
            --dark-gray: #212529;
            --body-bg: #e9ecef;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--body-bg);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header, footer {
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0;
            padding: 24px 16px;
        }

        h1 {
            color: var(--primary-blue);
            font-weight: 800;
            margin-bottom: 8px;
            font-size: 2rem;
            text-align: center;
        }

        .subtitle {
            color: var(--dark-gray);
            font-size: 1rem;
            margin-bottom: 24px;
            text-align: center;
        }

        /* Contenedor principal de la tarjeta */
        .game-card {
            width: 95%;
            max-width: 720px;
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Video wrapper */
        #wrapper {
            position: relative;
            width: 100%;
            background: #000;
            aspect-ratio: 4 / 3;
            overflow: hidden;
        }

        video {
            width: 100%;
            height: 100%;
            display: block;
            transform: scaleX(-1);
            object-fit: cover;
        }

        canvas {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            transform: scaleX(-1);
        }

        /* Panel de instrucción y estado */
        .game-panel {
            padding: 24px;
            background-color: var(--light-gray);
            text-align: center;
        }

        .letter-prompt {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 8px;
        }

        .letter-display {
            font-size: 4rem;
            font-weight: 800;
            color: var(--primary-blue);
            margin: 16px 0;
            letter-spacing: 8px;
        }

        .status-message {
            font-size: 1.1rem;
            font-weight: 600;
            min-height: 30px;
            margin-top: 12px;
            color: var(--dark-gray);
        }

        .status-message.detecting {
            color: var(--secondary-orange);
        }

        .status-message.correct {
            color: var(--success-color);
        }

        .status-message.incorrect {
            color: var(--error-color);
        }

        /* Progreso */
        .progress-section {
            padding: 16px 24px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .progress-text {
            font-size: 0.95rem;
            color: #6b7280;
            font-weight: 600;
        }

        .progress-bar {
            flex: 1;
            height: 10px;
            background-color: #d1d5db;
            border-radius: 6px;
            margin: 0 16px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background-color: var(--secondary-orange);
            width: 0%;
            transition: width 0.4s ease;
        }

        /* Controles */
        .controls {
            display: flex;
            gap: 12px;
            justify-content: center;
            padding: 24px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            font-size: 1.05rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #34d399, #28a745);
            color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-danger {
            background: linear-gradient(135deg, #f87171, #dc3545);
            color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-danger:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Modal de fin */
        .end-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(4px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            padding: 16px;
        }

        .modal-content {
            background: white;
            padding: 40px 30px;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            max-width: 480px;
            width: 100%;
            transform: scale(0.8);
            animation: scaleIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            border-top: 8px solid var(--success-color);
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
            font-size: 3rem;
            color: var(--success-color);
            font-weight: 800;
            margin: 20px 0 30px;
            display: block;
            background: #e6ffed;
            padding: 10px 0;
            border-radius: 10px;
            border: 2px dashed var(--success-color);
        }

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

        .btn-primary-modal {
            background-color: var(--primary-blue);
            color: white;
            box-shadow: 0 4px 0 #1e59b2;
        }

        .btn-primary-modal:hover {
            background-color: #1e59b2;
            transform: translateY(-2px);
            box-shadow: 0 6px 0 #144081;
        }

        .btn-progress-redirect {
            background-color: var(--secondary-orange);
            color: white;
            box-shadow: 0 4px 0 #d1562b;
        }

        .btn-progress-redirect:hover {
            background-color: #d1562b;
            transform: translateY(-2px);
            box-shadow: 0 6px 0 #9c3f1d;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.5rem;
            }

            .letter-display {
                font-size: 3rem;
            }

            .game-panel {
                padding: 18px;
            }

            .controls {
                flex-direction: column;
                gap: 10px;
            }

            .btn {
                flex: 1;
            }

            .progress-section {
                flex-direction: column;
                gap: 12px;
            }

            .progress-bar {
                margin: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>@include('partials.navbar')</header>

    <div class="main-content">
        <h1>🎮 Detecta los Números</h1>
        <p class="subtitle">Muestra el número que se te solicita con tus manos. ¡Tienes del 1 al 100 para detectar!</p>

        <div class="game-card">
            <div id="wrapper">
                <video id="video" autoplay playsinline></video>
                <canvas id="canvas"></canvas>
            </div>

            <div class="game-panel">
                <div class="letter-prompt">Muestra este número:</div>
                <div class="letter-display" id="letter-display">1</div>
                <div class="status-message" id="status-message">Inactivo</div>
            </div>

            <div class="progress-section">
                <span class="progress-text"><span id="current-letter">1</span> / <span id="total-letters">28</span></span>
                <div class="progress-bar">
                    <div class="progress-fill" id="progress-fill"></div>
                </div>
            </div>
        </div>

        <div class="controls">
            <button id="startBtn" class="btn btn-primary">
                <i class="fas fa-camera"></i> Iniciar Cámara
            </button>
            <button id="stopBtn" class="btn btn-danger">
                <i class="fas fa-stop"></i> Detener Cámara
            </button>
        </div>
    </div>

    <!-- Modal de fin -->
    <div class="end-modal" id="end-modal">
        <div class="modal-content">
            <h2 id="modal-title">¡JUEGO TERMINADO!</h2>
            <p id="modal-message"></p>
            <p>Puntos ganados:</p>
            <p class="points" id="modal-points">+0</p>
            <div class="modal-actions">
                <button type="button" class="btn-modal-action btn-progress-redirect" onclick="submitAndRedirect('{{ route('miProgreso') }}')">
                    <i class="fas fa-trophy"></i> Ver Mi Progreso
                </button>
                <button type="button" class="btn-modal-action btn-primary-modal" onclick="document.getElementById('submit-button').click()">
                    <i class="fas fa-arrow-right"></i> Continuar
                </button>
            </div>
        </div>
    </div>

    <!-- Formulario oculto para enviar puntuación -->
    <form id="score-form" action="{{ route('lecciones.numeros.extra.complete') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="errors_count" id="errors-input">
        <button type="submit" id="submit-button">Finalizar</button>
    </form>

    <footer>@include('partials.footer')</footer>

    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils/drawing_utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/hands/hands.js"></script>

    <script>
        // Números a detectar
        const NUMBERS_TO_DETECT = [
            ...Array.from({length: 20}, (_, i) => i + 1),
            30, 40, 50, 60, 70, 80, 90, 100
        ];
        const TOTAL_NUMBERS = NUMBERS_TO_DETECT.length;

        // Estado del juego
        let currentNumberIndex = 0;
        let detectedNumbers = [];
        let camera = null;
        let gameRunning = false;
        let lastDetectedNumber = null;
        let detectionConfidence = 0;
        
        // Variables para secuencias (11-19, 20-90, 100)
        let sequenceStage = 0; // 0: esperando primera parte, 1: esperando segunda parte, 2: esperando tercera parte
        let lastStageTime = 0;
        const SEQUENCE_TIMEOUT = 5000; // 5 segundos para completar la secuencia

        // Elementos DOM
        const videoElement = document.getElementById('video');
        const canvasElement = document.getElementById('canvas');
        const canvasCtx = canvasElement.getContext('2d');
        const letterDisplay = document.getElementById('letter-display');
        const statusMessage = document.getElementById('status-message');
        const startBtn = document.getElementById('startBtn');
        const stopBtn = document.getElementById('stopBtn');
        const progressFill = document.getElementById('progress-fill');
        const currentLetterSpan = document.getElementById('current-letter');
        const endModal = document.getElementById('end-modal');
        const errorsInput = document.getElementById('errors-input');

        // Ajusta el canvas al tamaño del video
        function fitCanvas() {
            canvasElement.width = videoElement.videoWidth || videoElement.clientWidth;
            canvasElement.height = videoElement.videoHeight || videoElement.clientHeight;
        }

        // Callback cuando MediaPipe detecta manos
        function onResults(results) {
            fitCanvas();
            canvasCtx.save();
            canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);

            if (results.multiHandLandmarks && results.multiHandLandmarks.length > 0 && gameRunning) {
                for (const landmarks of results.multiHandLandmarks) {
                    window.drawConnectors(canvasCtx, landmarks, window.HAND_CONNECTIONS, { lineWidth: 2, color: '#00ff00' });
                    window.drawLandmarks(canvasCtx, landmarks, { lineWidth: 1, radius: 2, color: '#ff0000' });
                }

                const detectedValue = evaluarNumero(results.multiHandLandmarks);
                if (detectedValue !== null) {
                    checkNumberDetection(detectedValue);
                }
            }

            canvasCtx.restore();
        }

        // Inicializa MediaPipe Hands
        const hands = new Hands({
            locateFile: (file) => {
                return `https://cdn.jsdelivr.net/npm/@mediapipe/hands/${file}`;
            }
        });

        hands.setOptions({
            maxNumHands: 2,
            modelComplexity: 1,
            minDetectionConfidence: 0.6,
            minTrackingConfidence: 0.6
        });

        hands.onResults(onResults);

        // Inicia la cámara
        async function startCamera() {
            if (camera) {
                statusMessage.textContent = '📹 La cámara ya está activa';
                statusMessage.className = 'status-message';
                return;
            }

            try {
                statusMessage.textContent = '🔄 Iniciando cámara...';
                statusMessage.className = 'status-message detecting';

                camera = new Camera(videoElement, {
                    onFrame: async () => {
                        await hands.send({ image: videoElement });
                    },
                    width: 1280,
                    height: 720
                });

                camera.start();
                gameRunning = true;
                statusMessage.textContent = '📹 Cámara activa. ¡Muestra el número!';
                statusMessage.className = 'status-message';
                updateDisplay();
            } catch (e) {
                console.error(e);
                statusMessage.textContent = '❌ Error: ' + e.message;
                statusMessage.className = 'status-message incorrect';
            }
        }

        // Detiene la cámara
        function stopCamera() {
            if (camera) {
                camera.stop();
                camera = null;
                gameRunning = false;
                statusMessage.textContent = '⏹️ Cámara detenida';
                statusMessage.className = 'status-message';
                canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);
            } else {
                statusMessage.textContent = '⚠️ La cámara no estaba activa';
                statusMessage.className = 'status-message';
            }
        }

        // Verifica si el número detectado es el correcto
        function checkNumberDetection(detectedValue) {
            const targetNumber = NUMBERS_TO_DETECT[currentNumberIndex];
            const now = Date.now();

            // Lógica para números simples (1-10)
            if (targetNumber <= 10) {
                if (detectedValue === targetNumber) {
                    detectionConfidence++;
                    if (detectionConfidence >= 10) { // Requiere 10 frames consecutivos
                        advanceToNextNumber();
                    }
                    statusMessage.textContent = `✅ ${detectedValue} detectado (${detectionConfidence}/10)`;
                    statusMessage.className = 'status-message correct';
                } else {
                    detectionConfidence = 0;
                    statusMessage.textContent = `❌ Mostrado: ${detectedValue} | Se espera: ${targetNumber}`;
                    statusMessage.className = 'status-message incorrect';
                }
            } 
            // Lógica para secuencias (11-19)
            else if (targetNumber >= 11 && targetNumber <= 19) {
                const part1 = 10;
                const part2 = targetNumber - 10;

                if (sequenceStage === 0) {
                    if (detectedValue === part1) {
                        detectionConfidence++;
                        if (detectionConfidence >= 8) {
                            sequenceStage = 1;
                            lastStageTime = now;
                            detectionConfidence = 0;
                            statusMessage.textContent = `✅ ¡10 detectado! Ahora haz el ${part2}`;
                            statusMessage.className = 'status-message correct';
                        } else {
                            statusMessage.textContent = `Detectando 10... (${detectionConfidence}/8)`;
                            statusMessage.className = 'status-message detecting';
                        }
                    } else {
                        detectionConfidence = 0;
                        statusMessage.textContent = `Haz primero el 10 (ambas manos)`;
                        statusMessage.className = 'status-message incorrect';
                    }
                } else if (sequenceStage === 1) {
                    // Timeout
                    if (now - lastStageTime > SEQUENCE_TIMEOUT) {
                        sequenceStage = 0;
                        detectionConfidence = 0;
                        statusMessage.textContent = `⌛ Tiempo agotado. Empieza de nuevo con el 10.`;
                        statusMessage.className = 'status-message incorrect';
                        return;
                    }

                    if (detectedValue === part2) {
                        detectionConfidence++;
                        if (detectionConfidence >= 8) {
                            advanceToNextNumber();
                        } else {
                            statusMessage.textContent = `✅ ¡Bien! Mantén el ${part2} (${detectionConfidence}/8)`;
                            statusMessage.className = 'status-message correct';
                        }
                    } else {
                        statusMessage.textContent = `¡10 listo! Ahora muestra el ${part2}`;
                        statusMessage.className = 'status-message detecting';
                    }
                }
            }
            // Lógica para decenas (20, 30, ..., 90)
            else if (targetNumber >= 20 && targetNumber <= 90 && targetNumber % 10 === 0) {
                const part1 = targetNumber / 10;
                const part2 = 0;

                if (sequenceStage === 0) {
                    if (detectedValue === part1) {
                        detectionConfidence++;
                        if (detectionConfidence >= 8) {
                            sequenceStage = 1;
                            lastStageTime = now;
                            detectionConfidence = 0;
                            statusMessage.textContent = `✅ ¡${part1} detectado! Ahora haz el 0`;
                            statusMessage.className = 'status-message correct';
                        } else {
                            statusMessage.textContent = `Detectando ${part1}... (${detectionConfidence}/8)`;
                            statusMessage.className = 'status-message detecting';
                        }
                    } else {
                        detectionConfidence = 0;
                        statusMessage.textContent = `Haz primero el ${part1}`;
                        statusMessage.className = 'status-message incorrect';
                    }
                } else if (sequenceStage === 1) {
                    if (now - lastStageTime > SEQUENCE_TIMEOUT) {
                        sequenceStage = 0;
                        detectionConfidence = 0;
                        statusMessage.textContent = `⌛ Tiempo agotado. Empieza de nuevo con el ${part1}.`;
                        statusMessage.className = 'status-message incorrect';
                        return;
                    }

                    if (detectedValue === part2) {
                        detectionConfidence++;
                        if (detectionConfidence >= 8) {
                            advanceToNextNumber();
                        } else {
                            statusMessage.textContent = `✅ ¡Bien! Mantén el 0 (${detectionConfidence}/8)`;
                            statusMessage.className = 'status-message correct';
                        }
                    } else {
                        statusMessage.textContent = `¡${part1} listo! Ahora muestra el 0`;
                        statusMessage.className = 'status-message detecting';
                    }
                }
            }
            // Lógica para 100 (1 -> 0 -> 0)
            else if (targetNumber === 100) {
                const part1 = 1;
                const part2 = 0;
                const part3 = 0;

                if (sequenceStage === 0) {
                    if (detectedValue === part1) {
                        detectionConfidence++;
                        if (detectionConfidence >= 8) {
                            sequenceStage = 1;
                            lastStageTime = now;
                            detectionConfidence = 0;
                            statusMessage.textContent = `✅ ¡1 detectado! Ahora haz el primer 0`;
                            statusMessage.className = 'status-message correct';
                        } else {
                            statusMessage.textContent = `Detectando 1... (${detectionConfidence}/8)`;
                            statusMessage.className = 'status-message detecting';
                        }
                    } else {
                        detectionConfidence = 0;
                        statusMessage.textContent = `Haz primero el 1`;
                        statusMessage.className = 'status-message incorrect';
                    }
                } else if (sequenceStage === 1) {
                    if (now - lastStageTime > SEQUENCE_TIMEOUT) {
                        sequenceStage = 0;
                        detectionConfidence = 0;
                        statusMessage.textContent = `⌛ Tiempo agotado. Empieza de nuevo con el 1.`;
                        statusMessage.className = 'status-message incorrect';
                        return;
                    }

                    if (detectedValue === part2) {
                        detectionConfidence++;
                        if (detectionConfidence >= 8) {
                            sequenceStage = 2;
                            lastStageTime = now;
                            detectionConfidence = 0;
                            statusMessage.textContent = `✅ ¡Primer 0 detectado! Haz el segundo 0 (repite la seña)`;
                            statusMessage.className = 'status-message correct';
                        } else {
                            statusMessage.textContent = `Detectando primer 0... (${detectionConfidence}/8)`;
                            statusMessage.className = 'status-message detecting';
                        }
                    } else {
                        statusMessage.textContent = `¡1 listo! Ahora muestra el primer 0`;
                        statusMessage.className = 'status-message detecting';
                    }
                } else if (sequenceStage === 2) {
                    if (now - lastStageTime > SEQUENCE_TIMEOUT) {
                        sequenceStage = 0;
                        detectionConfidence = 0;
                        statusMessage.textContent = `⌛ Tiempo agotado. Empieza de nuevo con el 1.`;
                        statusMessage.className = 'status-message incorrect';
                        return;
                    }

                    // Para detectar el "segundo" 0, idealmente el usuario debería haber "soltado" el gesto o hecho una pausa,
                    // pero como es la misma seña, simplemente verificamos que la mantenga o la vuelva a hacer.
                    // Para simplificar, asumimos que si sigue detectando 0 después de un breve momento, es válido.
                    // O podríamos pedir que deje de hacer 0 y lo vuelva a hacer, pero eso es complejo de detectar.
                    // Vamos a asumir que si mantiene el 0 por OTROS 8 frames, cuenta como el segundo 0.
                    // Pero para dar feedback de "movimiento", podríamos requerir que detectionConfidence empiece de 0 (que ya lo hace).
                    
                    if (detectedValue === part3) {
                        detectionConfidence++;
                        if (detectionConfidence >= 8) {
                            advanceToNextNumber();
                        } else {
                            statusMessage.textContent = `✅ ¡Bien! Mantén el segundo 0 (${detectionConfidence}/8)`;
                            statusMessage.className = 'status-message correct';
                        }
                    } else {
                        statusMessage.textContent = `¡Primer 0 listo! Ahora muestra el segundo 0`;
                        statusMessage.className = 'status-message detecting';
                    }
                }
            }
        }

        // Avanza al siguiente número
        function advanceToNextNumber() {
            detectedNumbers.push(NUMBERS_TO_DETECT[currentNumberIndex]);
            detectionConfidence = 0;
            sequenceStage = 0;
            currentNumberIndex++;

            if (currentNumberIndex < TOTAL_NUMBERS) {
                updateDisplay();
                statusMessage.textContent = `✨ ¡Excelente! Siguiente número...`;
                statusMessage.className = 'status-message correct';

                setTimeout(() => {
                    updateDisplay();
                }, 800);
            } else {
                finishGame();
            }
        }

        // Actualiza la pantalla
        function updateDisplay() {
            if (currentNumberIndex < TOTAL_NUMBERS) {
                const currentNumber = NUMBERS_TO_DETECT[currentNumberIndex];
                letterDisplay.textContent = currentNumber;
                currentLetterSpan.textContent = currentNumberIndex + 1;
                progressFill.style.width = ((currentNumberIndex) / TOTAL_NUMBERS) * 100 + '%';
            }
        }

        // Finaliza el juego
        function finishGame() {
            gameRunning = false;
            stopCamera();
            progressFill.style.width = '100%';

            const errorsCount = TOTAL_NUMBERS - detectedNumbers.length;
            errorsInput.value = errorsCount;

            let points = 0;
            let title = '';
            let message = '';

            // Ajuste de puntos para 20 números
            if (errorsCount === 0) {
                points = 10;
                title = '¡PERFECTO! 🤩';
                message = 'Detectaste todos los números sin errores.';
            } else if (errorsCount <= 3) {
                points = 5;
                title = '¡MUY BIEN! 👍';
                message = `Detectaste ${detectedNumbers.length}/20 números correctamente.`;
            } else {
                points = 2;
                title = '¡BUEN INTENTO! 💪';
                message = `Detectaste ${detectedNumbers.length}/20 números. Sigue practicando.`;
            }

            document.getElementById('modal-title').textContent = title;
            document.getElementById('modal-message').textContent = message;
            document.getElementById('modal-points').textContent = `+${points}`;

            endModal.style.display = 'flex';
        }

        // Botones de control
        startBtn.addEventListener('click', startCamera);
        stopBtn.addEventListener('click', stopCamera);

        // Lógica de detección de números
        function evaluarNumero(multiHandLandmarks) {
            let totalFingers = 0;
            let detectedZero = false;

            for (const landmarks of multiHandLandmarks) {
                const fingers = countFingers(landmarks);
                
                // Chequeo especial para el 0 (forma de O)
                if (isNumberZero(landmarks)) {
                    detectedZero = true;
                }
                
                totalFingers += fingers;
            }

            // Prioridad al 0 si se detecta y no hay otros dedos extendidos claramente
            // O si estamos buscando el 0 específicamente
            if (detectedZero && totalFingers === 0) {
                return 0;
            }

            return totalFingers;
        }

        function countFingers(landmarks) {
            const pts = landmarks.map(p => [p.x, p.y, p.z]);
            const dist = (a, b) => Math.hypot(pts[a][0] - pts[b][0], pts[a][1] - pts[b][1], pts[a][2] - pts[b][2]);

            const isExtended = (tip, pip) => dist(0, tip) > dist(0, pip);

            // Dedos: Índice (8), Medio (12), Anular (16), Meñique (20)
            const index = isExtended(8, 6);
            const middle = isExtended(12, 10);
            const ring = isExtended(16, 14);
            const pinky = isExtended(20, 18);

            // Pulgar (4): Mejorado para mayor sensibilidad
            // Usamos dos criterios:
            // 1. Distancia de la punta (4) a la base del meñique (17) vs articulación (3) a la base (17).
            // 2. Distancia de la punta (4) a la base del medio (9) vs articulación (3) a la base (9).
            // Si cualquiera de los dos indica extensión, lo contamos.
            const thumbExt1 = dist(4, 17) > dist(3, 17) * 1.05;
            const thumbExt2 = dist(4, 9) > dist(3, 9) * 1.05;
            
            const thumb = thumbExt1 || thumbExt2;

            let count = 0;
            if (index) count++;
            if (middle) count++;
            if (ring) count++;
            if (pinky) count++;
            if (thumb) count++;

            return count;
        }

        function isNumberZero(landmarks) {
            // La seña de 0 es como una O. Todos los dedos doblados, pulgar e índice tocándose.
            const pts = landmarks.map(p => [p.x, p.y, p.z]);
            const dist = (a, b) => Math.hypot(pts[a][0] - pts[b][0], pts[a][1] - pts[b][1], pts[a][2] - pts[b][2]);

            const isFolded = (tip, pip) => dist(0, tip) < dist(0, pip);

            const indexFolded = isFolded(8, 6);
            const middleFolded = isFolded(12, 10);
            const ringFolded = isFolded(16, 14);
            const pinkyFolded = isFolded(20, 18);

            // Distancia entre pulgar e índice pequeña
            const thumbIndexDist = dist(4, 8);

            // Para el 0, los dedos suelen estar curvos, no necesariamente "folded" contra la palma,
            // pero las puntas se tocan.
            // Criterio: Pulgar e índice cerca, y los otros dedos algo cerrados.
            
            return thumbIndexDist < 0.05 && middleFolded && ringFolded && pinkyFolded;
        }

        function submitAndRedirect(url) {
            document.getElementById('submit-button').click();
            setTimeout(() => {
                window.location.href = url;
            }, 100);
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateDisplay();
        });
    </script>
</body>
</html>
