<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Practica el Abecedario - LESSA</title>
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
        * { box-sizing:border-box; margin:0; padding:0; }
        body { font-family:'Poppins',sans-serif; background-color:var(--body-bg); display:flex; flex-direction:column; min-height:100vh; }
        header,footer { width:100%; background:#fff; box-shadow:0 2px 4px rgba(0,0,0,0.05); }
        .main-content { flex:1; display:flex; flex-direction:column; align-items:center; gap:0; padding:24px 16px; }
        h1 { color:var(--primary-blue); font-weight:800; margin-bottom:8px; font-size:2rem; text-align:center; }
        .subtitle { color:var(--dark-gray); font-size:1rem; margin-bottom:24px; text-align:center; }
        .game-card { width:95%; max-width:720px; background:#fff; border-radius:16px; box-shadow:0 6px 20px rgba(0,0,0,0.1); overflow:hidden; }
        #wrapper { position:relative; width:100%; background:#000; aspect-ratio:4/3; overflow:hidden; }
        video { width:100%; height:100%; display:block; transform:scaleX(-1); object-fit:cover; }
        canvas { position:absolute; left:0; top:0; width:100%; height:100%; pointer-events:none; transform:scaleX(-1); }
        .game-panel { padding:24px; background-color:var(--light-gray); text-align:center; }
        .letter-prompt { font-size:1.5rem; font-weight:700; color:var(--dark-gray); margin-bottom:8px; }
        .letter-display { font-size:4rem; font-weight:800; color:var(--primary-blue); margin:16px 0; letter-spacing:8px; }
        .status-message { font-size:1.1rem; font-weight:600; min-height:30px; margin-top:12px; color:var(--dark-gray); }
        .status-message.detecting { color:var(--secondary-orange); }
        .status-message.correct { color:var(--success-color); }
        .status-message.incorrect { color:var(--error-color); }
        .controls { display:flex; flex-wrap:wrap; gap:12px; justify-content:center; padding:24px; }
        .btn { padding:12px 24px; font-size:1.05rem; font-weight:600; border:none; border-radius:8px; cursor:pointer; transition:all 0.3s ease; display:inline-flex; align-items:center; gap:8px; }
        .btn-primary { background:linear-gradient(135deg,#34d399,#28a745); color:#fff; box-shadow:0 4px 12px rgba(0,0,0,0.1); }
        .btn-primary:hover:not(:disabled) { transform:translateY(-2px); box-shadow:0 6px 20px rgba(0,0,0,0.15); }
        .btn-danger { background:linear-gradient(135deg,#f87171,#dc3545); color:#fff; box-shadow:0 4px 12px rgba(0,0,0,0.1); }
        .btn-danger:hover:not(:disabled) { transform:translateY(-2px); box-shadow:0 6px 20px rgba(0,0,0,0.15); }
        .btn-secondary { background:linear-gradient(135deg,#60a5fa,#3b82f6); color:#fff; box-shadow:0 4px 12px rgba(0,0,0,0.1); }
        .btn-secondary:hover:not(:disabled) { transform:translateY(-2px); box-shadow:0 6px 20px rgba(0,0,0,0.15); }
        .btn:disabled { opacity:0.6; cursor:not-allowed; }
        @media (max-width:768px) {
            h1 {font-size:1.5rem;}
            .letter-display {font-size:3rem;}
            .game-panel {padding:18px;}
            .controls {flex-direction:column; gap:10px;}
            .btn {flex:1;}
        }
    </style>
</head>
<body>
    <header>@include('partials.navbar')</header>
    <div class="main-content">
        <h1>👐 Practica el Abecedario</h1>
        <p class="subtitle">Practica las letras más estables a tu ritmo. El sistema mostrará la letra actual y te dará feedback en tiempo real.</p>
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
        </div>
        <div class="controls">
            <button id="startBtn" class="btn btn-primary"><i class="fas fa-camera"></i> Iniciar Cámara</button>
            <button id="stopBtn" class="btn btn-danger"><i class="fas fa-stop"></i> Detener Cámara</button>
            <button id="prevBtn" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Anterior</button>
            <button id="nextBtn" class="btn btn-secondary"><i class="fas fa-arrow-right"></i> Siguiente</button>
            <button id="dictBtn" class="btn btn-primary"><i class="fas fa-book"></i> Ver en Diccionario</button>
            <button id="backBtn" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Volver al Menú</button>
        </div>
    </div>
    <footer>@include('partials.footer')</footer>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils/drawing_utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/hands/hands.js"></script>
    <script>
        const LETTERS_TO_DETECT = ['A','B','C','D','E','F','G','H','I','K','M','N','O','U','V','W'];
        const TOTAL_LETTERS = LETTERS_TO_DETECT.length;
        let currentLetterIndex = 0;
        let camera = null;
        let gameRunning = false;
        let detectionConfidence = 0;
        const videoElement = document.getElementById('video');
        const canvasElement = document.getElementById('canvas');
        const canvasCtx = canvasElement.getContext('2d');
        const letterDisplay = document.getElementById('letter-display');
        const statusMessage = document.getElementById('status-message');
        const startBtn = document.getElementById('startBtn');
        const stopBtn = document.getElementById('stopBtn');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const dictBtn = document.getElementById('dictBtn');
        const backBtn = document.getElementById('backBtn');
        function fitCanvas(){
            canvasElement.width = videoElement.videoWidth || videoElement.clientWidth;
            canvasElement.height = videoElement.videoHeight || videoElement.clientHeight;
        }
        function onResults(results){
            fitCanvas();
            canvasCtx.save();
            canvasCtx.clearRect(0,0,canvasElement.width,canvasElement.height);
            if (results.multiHandLandmarks && results.multiHandLandmarks.length>0 && gameRunning) {
                const landmarks = results.multiHandLandmarks[0];
                window.drawConnectors(canvasCtx, landmarks, window.HAND_CONNECTIONS, { lineWidth:2, color:'#00ff00' });
                window.drawLandmarks(canvasCtx, landmarks, { lineWidth:1, radius:2, color:'#ff0000' });
                const detectedLetter = evaluarLetra(landmarks);
                if (detectedLetter) {
                    checkLetterDetection(detectedLetter);
                }
            }
            canvasCtx.restore();
        }
        const hands = new Hands({ locateFile: (file) => `https://cdn.jsdelivr.net/npm/@mediapipe/hands/${file}` });
        hands.setOptions({ maxNumHands:2, modelComplexity:1, minDetectionConfidence:0.6, minTrackingConfidence:0.6 });
        hands.onResults(onResults);
        async function startCamera(){
            if (camera) {
                statusMessage.textContent = '📹 La cámara ya está activa';
                statusMessage.className = 'status-message';
                return;
            }
            try {
                statusMessage.textContent = '🔄 Iniciando cámara...';
                statusMessage.className = 'status-message detecting';
                camera = new Camera(videoElement, {
                    onFrame: async () => { await hands.send({ image: videoElement }); },
                    width:1280, height:720
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
        function stopCamera(){
            if (camera) {
                camera.stop();
                camera = null;
                gameRunning = false;
                statusMessage.textContent = '⏹️ Cámara detenida';
                statusMessage.className = 'status-message';
                canvasCtx.clearRect(0,0,canvasElement.width,canvasElement.height);
            } else {
                statusMessage.textContent = '⚠️ La cámara no estaba activa';
                statusMessage.className = 'status-message';
            }
        }
        function checkLetterDetection(detectedLetter){
            const expectedLetter = LETTERS_TO_DETECT[currentLetterIndex];
            if (detectedLetter === expectedLetter) {
                detectionConfidence++;
                statusMessage.textContent = `✅ ${detectedLetter} detectada (${detectionConfidence}/8)`;
                statusMessage.className = 'status-message correct';
                if (detectionConfidence >= 8) {
                    detectionConfidence = 0; // stay on same letter for practice
                }
            } else {
                detectionConfidence = 0;
                statusMessage.textContent = `❌ Mostrada: ${detectedLetter} | Se espera: ${expectedLetter}`;
                statusMessage.className = 'status-message incorrect';
            }
        }
        function updateDisplay(){
            const currentLetter = LETTERS_TO_DETECT[currentLetterIndex];
            letterDisplay.textContent = currentLetter;
        }
        function previousLetter(){
            if (currentLetterIndex > 0) {
                currentLetterIndex--;
                detectionConfidence = 0;
                updateDisplay();
                statusMessage.textContent = '🔄 Cambiando a letra anterior';
                statusMessage.className = 'status-message';
            }
        }
        function nextLetter(){
            if (currentLetterIndex < TOTAL_LETTERS - 1) {
                currentLetterIndex++;
                detectionConfidence = 0;
                updateDisplay();
                statusMessage.textContent = '🔄 Cambiando a siguiente letra';
                statusMessage.className = 'status-message';
            }
        }
        dictBtn.addEventListener('click', () => {
            window.location.href = '/lecciones/diccionario';
        });
        backBtn.addEventListener('click', () => {
            window.location.href = '/practicar/abecedario';
        });
        startBtn.addEventListener('click', startCamera);
        stopBtn.addEventListener('click', stopCamera);
        prevBtn.addEventListener('click', previousLetter);
        nextBtn.addEventListener('click', nextLetter);
        document.addEventListener('DOMContentLoaded', () => { updateDisplay(); });
        // Full A‑Z detection (unchanged) – retained for completeness
        function evaluarLetra(landmarks){
            const puntos = landmarks.map(p => [p.x, p.y, p.z]);
            const distancia = (a,b) => Math.hypot(puntos[a][0]-puntos[b][0], puntos[a][1]-puntos[b][1], puntos[a][2]-puntos[b][2]);
            const Extendido = (punta, mitad, base) => distancia(0,punta)>distancia(0,mitad)&&distancia(0,mitad)>distancia(0,base);
            const SemiExtendido = (punta, mitad, base) => distancia(0,punta)<distancia(0,mitad)&&distancia(0,mitad)>distancia(0,base);
            const Doblado = (punta, mitad, base) => distancia(0,punta)<distancia(0,mitad)&&distancia(0,mitad)<distancia(0,base);
            const Horizontal = (punta, base) => (puntos[punta][0]-puntos[base][0]);
            const Vertical = (b1,b2) => (puntos[b1][1] < puntos[b2][1]);
            const Profundo = (b1,b2) => (puntos[b1][2] > puntos[b2][2]);
            const pulgarExtendido = Extendido(4,3,2);
            const indiceExtendido = Extendido(8,7,6);
            const medioExtendido = Extendido(12,11,10);
            const anularExtendido = Extendido(16,15,14);
            const meniqueExtendido = Extendido(20,19,18);
            const indiceSemi = SemiExtendido(8,6,5);
            const medioSemi = SemiExtendido(12,10,9);
            const anularSemi = SemiExtendido(16,14,13);
            const meniqueSemi = SemiExtendido(20,18,17);
            const indiceDoblado = Doblado(8,7,6);
            const medioDoblado = Doblado(12,11,10);
            const anularDoblado = Doblado(16,15,14);
            const meniqueDoblado = Doblado(20,19,18);
            const pulgarHorizontal = Horizontal(4,2);
            const indiceHorizontal = Horizontal(8,6);
            const medioHorizontal = Horizontal(12,10);
            const anularHorizontal = Horizontal(16,14);
            const meniqueHorizontal = Horizontal(20,18);
            const vPulgarMenique = Vertical(2,17);
            const vIndiceMedio = Vertical(5,9);
            const vMedioAnular = Vertical(9,13);
            const vAnularMenique = Vertical(13,17);
            const hIndiceMedio = Profundo(5,9);
            const hMedioAnular = Profundo(9,13);
            const hAnularMenique = Profundo(13,17);
            if (indiceDoblado && medioDoblado && anularDoblado && meniqueDoblado && distancia(4,8)>0.08) return "A";
            if (indiceExtendido && medioExtendido && anularExtendido && meniqueExtendido && distancia(8,12)<0.08 && distancia(12,16)<0.08 && distancia(16,20)<0.08 && distancia(4,8)>=0.2) return "B";
            if (pulgarHorizontal && medioHorizontal && distancia(4,8)<0.2 && distancia(4,8)>0.15 && hIndiceMedio && hMedioAnular && hAnularMenique && !medioExtendido && !vIndiceMedio) return "C";
            if (indiceExtendido && medioDoblado && anularDoblado && meniqueDoblado && distancia(4,8)>=0.15 && distancia(4,8)<0.3) return "D";
            if (indiceSemi && medioSemi && anularSemi && meniqueSemi && distancia(4,8)>0.08) return "E";
            if (medioExtendido && anularExtendido && meniqueExtendido && distancia(4,8)<0.08) return "F";
            if (vIndiceMedio && vMedioAnular && vAnularMenique && distancia(4,8)>0.06 && distancia(4,8)<0.15 && indiceHorizontal && medioDoblado && vPulgarMenique) return "G";
            if (vIndiceMedio && vMedioAnular && vAnularMenique && distancia(4,8)>0.06 && distancia(4,8)<0.15 && indiceHorizontal && medioHorizontal && vPulgarMenique) return "H";
            if (meniqueExtendido && indiceDoblado && medioDoblado && anularDoblado) return "I";
            if (indiceExtendido && medioExtendido && anularDoblado && meniqueDoblado && distancia(8,12)>0.06 && distancia(4,8)<0.15) return "K";
            if (indiceDoblado && medioDoblado && anularDoblado && meniqueDoblado && distancia(4,18)<0.08) return "M";
            if (indiceDoblado && medioDoblado && anularDoblado && meniqueDoblado && distancia(4,14)<0.08) return "N";
            if (!indiceExtendido && !medioExtendido && !anularExtendido && !meniqueExtendido && distancia(4,8)<0.06 && distancia(8,12)<0.06 && distancia(12,16)<0.06 && distancia(16,20)<0.06) return "O";
            if (indiceExtendido && medioExtendido && anularDoblado && meniqueDoblado && distancia(8,12)<=0.06 && !vIndiceMedio) return "U";
            if (indiceExtendido && medioExtendido && anularDoblado && meniqueDoblado && distancia(8,12)>0.06 && !vIndiceMedio) return "V";
            if (indiceExtendido && medioExtendido && anularExtendido && meniqueDoblado) return "W";
            return null;
        }
    </script>
</body>
</html>