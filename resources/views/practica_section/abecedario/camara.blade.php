<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Detectar Señas - LESSA</title>
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
        <h1>🎮 Detecta la Letra</h1>
        <p class="subtitle">Muestra la letra que se te solicita con tus manos. ¡Tienes 5 vocales para detectar!</p>

        <div class="game-card">
            <div id="wrapper">
                <video id="video" autoplay playsinline></video>
                <canvas id="canvas"></canvas>
            </div>

            <div class="game-panel">
                <div class="letter-prompt">Muestra esta letra:</div>
                <div class="letter-display" id="letter-display">A</div>
                <div class="status-message" id="status-message">Inactivo</div>
            </div>

            <div class="progress-section">
                <span class="progress-text"><span id="current-letter">1</span> / <span id="total-letters">5</span></span>
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
    <form id="score-form" action="{{ route('lecciones.abecedario.extra.complete') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="errors_count" id="errors-input">
        <button type="submit" id="submit-button">Finalizar</button>
    </form>

    <footer>@include('partials.footer')</footer>

    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils/drawing_utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/hands/hands.js"></script>

    <script>
        // Letras a detectar (5 vocales)
        const LETTERS_TO_DETECT = ['A', 'E', 'I', 'O', 'U'];
        const TOTAL_LETTERS = LETTERS_TO_DETECT.length;

        // Estado del juego
        let currentLetterIndex = 0;
        let detectedLetters = [];
        let camera = null;
        let gameRunning = false;
        let lastDetectedLetter = null;
        let detectionConfidence = 0;

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
                const landmarks = results.multiHandLandmarks[0];
                window.drawConnectors(canvasCtx, landmarks, window.HAND_CONNECTIONS, { lineWidth: 2, color: '#00ff00' });
                window.drawLandmarks(canvasCtx, landmarks, { lineWidth: 1, radius: 2, color: '#ff0000' });

                const detectedLetter = evaluarLetra(landmarks);
                if (detectedLetter) {
                    lastDetectedLetter = detectedLetter;
                    checkLetterDetection(detectedLetter);
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
                statusMessage.textContent = '📹 Cámara activa. ¡Muestra la letra!';
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

        // Verifica si la letra detectada es la correcta
        function checkLetterDetection(detectedLetter) {
            const expectedLetter = LETTERS_TO_DETECT[currentLetterIndex];

            if (detectedLetter === expectedLetter) {
                detectionConfidence++;

                if (detectionConfidence >= 8) { // Requiere 8 detecciones consecutivas
                    advanceToNextLetter();
                }

                statusMessage.textContent = `✅ ${detectedLetter} detectada (${detectionConfidence}/8)`;
                statusMessage.className = 'status-message correct';
            } else {
                detectionConfidence = 0;
                statusMessage.textContent = `❌ Mostrada: ${detectedLetter} | Se espera: ${expectedLetter}`;
                statusMessage.className = 'status-message incorrect';
            }
        }

        // Avanza a la siguiente letra
        function advanceToNextLetter() {
            detectedLetters.push(LETTERS_TO_DETECT[currentLetterIndex]);
            detectionConfidence = 0;
            currentLetterIndex++;

            if (currentLetterIndex < TOTAL_LETTERS) {
                updateDisplay();
                statusMessage.textContent = `✨ ¡Excelente! Siguiente letra...`;
                statusMessage.className = 'status-message correct';

                setTimeout(() => {
                    updateDisplay();
                }, 800);
            } else {
                finishGame();
            }
        }

        // Actualiza la pantalla con la letra actual
        function updateDisplay() {
            if (currentLetterIndex < TOTAL_LETTERS) {
                const currentLetter = LETTERS_TO_DETECT[currentLetterIndex];
                letterDisplay.textContent = currentLetter;
                currentLetterSpan.textContent = currentLetterIndex + 1;
                progressFill.style.width = ((currentLetterIndex) / TOTAL_LETTERS) * 100 + '%';
            }
        }

        // Finaliza el juego
        function finishGame() {
            gameRunning = false;
            stopCamera();
            progressFill.style.width = '100%';

            const errorsCount = TOTAL_LETTERS - detectedLetters.length;
            errorsInput.value = errorsCount;

            let points = 0;
            let title = '';
            let message = '';

            if (errorsCount === 0) {
                points = 10;
                title = '¡PERFECTO! 🤩';
                message = 'Detectaste todas las vocales sin errores. ¡Eres un maestro de la LSM!';
            } else if (errorsCount <= 1) {
                points = 5;
                title = '¡MUY BIEN! 👍';
                message = `Detectaste ${detectedLetters.length}/5 vocales correctamente. ¡Excelente trabajo!`;
            } else {
                points = 2;
                title = '¡BUEN INTENTO! 💪';
                message = `Detectaste ${detectedLetters.length}/5 vocales. Sigue practicando para mejorar.`;
            }

            document.getElementById('modal-title').textContent = title;
            document.getElementById('modal-message').textContent = message;
            document.getElementById('modal-points').textContent = `+${points}`;

            endModal.style.display = 'flex';
        }

        // Botones de control
        startBtn.addEventListener('click', startCamera);
        stopBtn.addEventListener('click', stopCamera);

        // Detector de letras (evaluarLetra) - Solo vocales
        function evaluarLetra(landmarks) {

            // Convertimos landmarks a arreglo: [x, y, z]
            const puntos = landmarks.map(p => [p.x, p.y, p.z]);

            // -----------------------------
            // Distancia entre 2 puntos
            // -----------------------------
            const distancia = (a, b) =>
                Math.hypot(
                puntos[a][0] - puntos[b][0],
                puntos[a][1] - puntos[b][1],
                puntos[a][2] - puntos[b][2]
                );
            // Distancias clave
            const dPulgarIndice = distancia(4, 8);
            const dPulgarAnular = distancia(4, 14);
            const dPulgarMenique = distancia(4, 18);
            const dIndiceMedio = distancia(8, 12);
            const dMedioAnular = distancia(12, 16);
            const dAnularMenique = distancia(16, 20);

            // -----------------------------
            // Evauación de estado de dedos
            // -----------------------------
            const Extendido = (punta, mitad, base) =>
                distancia(0, punta) > distancia(0, mitad) &&
                distancia(0, mitad) > distancia(0, base);

            const SemiExtendido = (punta, mitad, base) =>
                distancia(0, punta) < distancia(0, mitad) &&
                distancia(0, mitad) > distancia(0, base);

            const Doblado = (punta, mitad, base) =>
                distancia(0, punta) < distancia(0, mitad) &&
                distancia(0, mitad) < distancia(0, base);
                
            const Horizontal = (punta, base) =>
                (puntos[punta][0] - puntos[base][0]);

            const Vertical = (base1, base2) =>
                (puntos[base1][1] < puntos[base2][1]);

            const Profundo = (base1, base2) =>
                (puntos[base1][2] > puntos[base2][2]);
            
            // Estado de cada dedo
            const pulgarExtendido  = Extendido(4, 3, 2);
            const indiceExtendido  = Extendido(8, 7, 6);
            const medioExtendido   = Extendido(12, 11, 10);
            const anularExtendido  = Extendido(16, 15, 14);
            const meniqueExtendido = Extendido(20, 19, 18);

            const indiceSemi  = SemiExtendido(8, 6, 5);
            const medioSemi   = SemiExtendido(12, 10, 9);
            const anularSemi  = SemiExtendido(16, 14, 13);
            const meniqueSemi = SemiExtendido(20, 18, 17);

            const indiceDoblado  = Doblado(8, 7, 6);
            const medioDoblado   = Doblado(12, 11, 10);
            const anularDoblado  = Doblado(16, 15, 14);
            const meniqueDoblado = Doblado(20, 19, 18);

            const pulgarHorizontal = Horizontal(4, 2);
            const indiceHorizontal = Horizontal(8, 6);
            const medioHorizontal = Horizontal(12, 10);
            const anularHorizontal = Horizontal(16, 14);
            const meniqueHorizontal = Horizontal(20, 18);

            const vPulgarMenique = Vertical(2, 17);
            const vIndiceMedio = Vertical(5, 9);
            const vMedioAnular = Vertical(9, 13);
            const vAnularMenique = Vertical(13, 17);

            const hIndiceMedio = Profundo(5, 9);
            const hMedioAnular = Profundo(9, 13);
            const hAnularMenique = Profundo(13, 17);

            // ============================================================
            // LETRA A
            // ============================================================
            if (
                indiceDoblado && medioDoblado &&
                anularDoblado && meniqueDoblado &&
                dPulgarIndice > 0.08
            ) return "A";

            // ============================================================
            // LETRA B
            // ============================================================
            if (
                indiceExtendido && medioExtendido &&
                anularExtendido && meniqueExtendido &&
                dIndiceMedio < 0.08 && dMedioAnular < 0.08
                && dAnularMenique < 0.08 && dPulgarIndice >= 0.2
            ) return "B";

            // ============================================================
            // LETRA C
            // ============================================================
            if (
                pulgarHorizontal && medioHorizontal &&
                dPulgarIndice < 0.2 && dPulgarIndice > 0.15 && hIndiceMedio && hMedioAnular &&
                hAnularMenique && !medioExtendido && !vIndiceMedio
            ) return "C";

            // ============================================================
            // LETRA D
            // ============================================================
            if (
                indiceExtendido && medioDoblado &&
                anularDoblado && meniqueDoblado &&
                dPulgarIndice >= 0.15 && dPulgarIndice < 0.3
            ) return "D";

            // ============================================================
            // LETRA E
            // ============================================================
            if (
                indiceSemi && medioSemi && anularSemi &&
                meniqueSemi && dPulgarIndice > 0.08
            ) return "E";

            // ============================================================
            // LETRA F
            // ============================================================
            if (
                medioExtendido && anularExtendido &&
                meniqueExtendido && dPulgarIndice < 0.08
            ) return "F";

            // ============================================================
            // LETRA G
            // ============================================================
            if (
                vIndiceMedio && vMedioAnular && vAnularMenique
                && dPulgarIndice > 0.06 && dPulgarIndice < 0.15
                && indiceHorizontal && medioDoblado && vPulgarMenique
            ) return "G";

            // ============================================================
            // LETRA H
            // ============================================================
            if (
                vIndiceMedio && vMedioAnular && vAnularMenique
                && dPulgarIndice > 0.06 && dPulgarIndice < 0.15
                && indiceHorizontal && medioHorizontal && vPulgarMenique
            ) return "H";

            // ============================================================
            // LETRA I
            // ============================================================
            if (
                meniqueExtendido && indiceDoblado && medioDoblado &&
                anularDoblado
            ) return "I";

            // ============================================================
            // LETRA K
            // ============================================================
            if (
                indiceExtendido && medioExtendido &&
                anularDoblado && meniqueDoblado &&
                dIndiceMedio > 0.06 && dPulgarIndice < 0.15
            ) return "K";

            // ============================================================
            // LETRA L
            // ============================================================
            if (
                indiceExtendido && medioDoblado &&
                anularDoblado && meniqueDoblado &&
                dPulgarIndice >= 0.3 && pulgarHorizontal
            ) return "L";

            // ============================================================
            // LETRA M
            // ============================================================
            if (
                indiceDoblado && medioDoblado &&
                anularDoblado && meniqueDoblado &&
                dPulgarMenique < 0.08
            ) return "M";

            // ============================================================
            // LETRA N
            // ============================================================
            if (
                indiceDoblado && medioDoblado &&
                anularDoblado && meniqueDoblado &&
                dPulgarAnular < 0.08
            ) return "N";

            // ============================================================
            // LETRA O
            // ============================================================
            if (
                !indiceExtendido && !medioExtendido &&
                !anularExtendido && !meniqueExtendido &&
                dPulgarIndice < 0.06 &&
                dIndiceMedio < 0.06 &&
                dMedioAnular < 0.06 &&
                dAnularMenique < 0.06
            ) return "O";

            // ============================================================
            // LETRA U
            // ============================================================
            if (
                indiceExtendido && medioExtendido &&
                anularDoblado && meniqueDoblado &&
                dIndiceMedio <= 0.06 && !vIndiceMedio
            ) return "U";

            // ============================================================
            // LETRA V
            // ============================================================
            if (
                indiceExtendido && medioExtendido &&
                anularDoblado && meniqueDoblado &&
                dIndiceMedio > 0.06 && !vIndiceMedio
            ) return "V";

            // ============================================================
            // LETRA W
            // ============================================================
            if (
                indiceExtendido && medioExtendido &&
                anularExtendido && meniqueDoblado
            ) return "W";
        }

        function submitAndRedirect(url) {
            document.getElementById('submit-button').click();
            setTimeout(() => {
                window.location.href = url;
            }, 100);
        }

        // Inicialización
        document.addEventListener('DOMContentLoaded', () => {
            updateDisplay();
        });
    </script>
</body>
</html>