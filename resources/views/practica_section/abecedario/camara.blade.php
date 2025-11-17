<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Detectar Señas - LESSA</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-size: 16px;
        }

        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center; /* Centra los elementos de la "tarjeta" */
            gap: 0; /* Eliminamos el gap para unir la tarjeta */
            background-color: #f8f9fa; /* Fondo gris claro */
            color: #212529;
            min-height: 100vh;
        }

        header,
        footer {
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            /* Asegura que no se centren por el 'align-items' del body */
            align-self: auto; 
        }

        h2 {
            align-self: center;
            font-weight: 600;
            color: #343a40;
            margin-top: 2rem; /* Más espacio arriba */
            margin-bottom: 1.5rem; /* Espacio antes de la tarjeta */
        }

        /* --- Contenedor del Video/Canvas (Parte superior de la tarjeta) --- */
        #wrapper {
            position: relative;
            align-self: center;
            width: 95%;
            max-width: 720px;
            border-radius: 12px 12px 0 0; 
            overflow: hidden; 
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08); /* Sombra suave */
            background: #000;
        }

        video {
            width: 100%;
            display: block; 
            transform: scaleX(-1);
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

        /* --- Panel de Estado--- */
        #status {
            align-self: center;
            width: 95%;
            max-width: 720px;
            padding: 1.25rem;
            background-color: #fff; /* Fondo blanco */
            border-radius: 0; 
            box-shadow: none; 
            border-top: 1px solid #f0f0f0; 
            font-size: 1.2rem;
            font-weight: 500;
            color: #495057;
            text-align: center;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        #estado {
            font-weight: 600; /* Hace el texto detectado más legible */
        }

        /* --- Contenedor de Botones (Parte inferior de la tarjeta) --- */
        body > div:nth-of-type(2) {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap; 
            align-self: center;
            width: 95%;
            max-width: 720px;
            background-color: #fff; 
            border-radius: 0 0 12px 12px; 
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1); 
            border-top: 1px solid #f0f0f0;
            padding: 1.5rem; /* Espacio interno generoso */
            margin-bottom: 2rem; /* Espacio después de la tarjeta */
        }

        /* --- Estilo de Botones (Base) --- */
        .btn { /* Mantenemos .btn por si se usa en otro lado, pero apuntamos a IDs */
             padding: 8px 12px;
             border-radius: 6px;
             border: 1px solid #ccc;
             cursor: pointer;
             background: #f5f5f5;
        }

        /* --- Botones (Diseño llamativo) --- */
        #startBtn,
        #stopBtn {
            font-size: 1.05rem; /* Ligeramente más grande */
            font-weight: 600;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            color: #fff;
            text-align: center;
            flex-grow: 1;
            flex-basis: 0;
            transition: all 0.2s ease-in-out; 
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Sombra base */
        }

        #startBtn {
            background-image: linear-gradient(135deg, #34d399, #28a745);
        }

        #stopBtn {
            background-image: linear-gradient(135deg, #f87171, #dc3545);
        }

        #startBtn:hover,
        #stopBtn:hover {
            transform: translateY(-3px) scale(1.02); /* Se eleva y crece */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15); /* Sombra más grande */
        }

        #startBtn:active,
        #stopBtn:active {
            transform: scale(0.99); /* Ligero hundimiento */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }


        /* --- Responsividad para Móviles Pequeños --- */
        @media (max-width: 480px) {
            body {
                gap: 0; /* Mantenemos el gap en 0 */
            }

            h2 {
                font-size: 1.5rem;
                margin-top: 1rem;
                margin-bottom: 1rem;
            }

            #status {
                font-size: 1rem;
                padding: 1rem;
            }

            /* Contenedor de botones en móvil */
            body > div:nth-of-type(2) {
                flex-direction: column; /* Apila los botones */
                align-items: stretch; /* Estira los botones */
                gap: 0.75rem;
                padding: 1rem; /* Padding reducido */
                margin-bottom: 1.5rem;
            }

            /* Botones en móvil (flex-grow ya no es necesario) */
            #startBtn,
            #stopBtn {
                flex-grow: 0;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>
    <h2>Detector de señas</h2>
    <div id="wrapper">
        <video id="video" autoplay playsinline></video>
        <canvas id="canvas"></canvas>
    </div>

    <div id="status"><span id="estado">Inactivo</span></div>
    <div>
        <button id="startBtn" class="btn">Iniciar cámara</button>
        <button id="stopBtn" class="btn">Detener cámara</button>
    </div>
    <footer>@include('partials.footer')</footer>

    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils/drawing_utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/hands/hands.js"></script>

    <script>
        // Elementos DOM
        const videoElement = document.getElementById('video');
        const canvasElement = document.getElementById('canvas');
        const canvasCtx = canvasElement.getContext('2d');
        const estado = document.getElementById('estado');
        const startBtn = document.getElementById('startBtn');
        const stopBtn = document.getElementById('stopBtn');

        let camera = null;

        // Ajusta tamaño del canvas al video
        function fitCanvas() {
            canvasElement.width = videoElement.videoWidth || videoElement.clientWidth;
            canvasElement.height = videoElement.videoHeight || videoElement.clientHeight;
        }

        // Callback cuando MediaPipe produce resultados
        function onResults(results) {
            fitCanvas();
            canvasCtx.save();
            canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);

            if (results.multiHandLandmarks && results.multiHandLandmarks.length > 0) {

                // 👉 Solo procesar UNA mano (la primera)
                const landmarks = results.multiHandLandmarks[0];

                window.drawConnectors(canvasCtx, landmarks, window.HAND_CONNECTIONS, { lineWidth: 2 });
                window.drawLandmarks(canvasCtx, landmarks, { lineWidth: 1, radius: 2 });

                const letra = evaluarLetra(landmarks);
                if (letra) estado.textContent = "Letra detectada: " + letra;
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

        // Inicia la cámara usando Camera helper (MediaPipe)
        async function startCamera() {
            estado.textContent = 'Iniciando cámara...';
            if (camera) {
                estado.textContent = 'La cámara ya está iniciada';
                return;
            }

            try {
                camera = new Camera(videoElement, {
                    onFrame: async () => {
                        await hands.send({ image: videoElement });
                    },
                    width: 1280,
                    height: 720
                });
                camera.start();
                estado.textContent = 'Cámara activa';
            } catch (e) {
                console.error(e);
                estado.textContent = 'Error accediendo a la cámara: ' + e.message;
            }
        }

        function stopCamera() {
            if (camera) {
                try {
                    camera.stop();
                } catch (e) { /* ignore */ }
                camera = null;
                estado.textContent = 'Cámara detenida';
                canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);
            } else {
                estado.textContent = 'La cámara no estaba activa';
            }
        }

        // Enviar landmarks al backend (ejemplo)
        async function sendLandmarksToServer(landmarks) {
            try {
                const resp = await fetch('/api/detect', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ landmarks })
                });
                const data = await resp.json();
                // console.log('Servidor respondió', data);
            } catch (e) {
                console.error('Error enviando landmarks:', e);
            }
        }

        // Botones
        startBtn.addEventListener('click', startCamera);
        stopBtn.addEventListener('click', stopCamera);

        // Inicia automáticamente (opcional). Si prefieres que inicie solo al presionar botón, comenta la línea:
        // startCamera();

        // -----------------------------
        // DETECTOR DE LETRAS
        // -----------------------------
        function evaluarLetra(landmarks) {
            const pts = landmarks.map(p => [p.x, p.y, p.z]);

            const dist = (a, b) =>
                Math.hypot(
                    pts[a][0] - pts[b][0],
                    pts[a][1] - pts[b][1],
                    pts[a][2] - pts[b][2]
                );

            const isExtended = (tip, pip) => dist(0, tip) > dist(0, pip);
            const isSemiExtended = (tip, pip) => dist(0, tip) < dist(0, pip);
            const isFolded = (tip, pip) => dist(0, tip) < dist(0, pip);

            // -----------------------------
            // Estados por dedo
            // -----------------------------
            const pulgarIndiceDist = dist(4, 8);

            const indiceExtendido = isExtended(8, 6);
            const medioExtendido = isExtended(12, 10);
            const anularExtendido = isExtended(16, 14);
            const meniqueExtendido = isExtended(20, 18);

            const indiceSemi = isSemiExtended(8, 6);
            const medioSemi = isSemiExtended(12, 10);
            const anularSemi = isSemiExtended(16, 14);
            const meniqueSemi = isSemiExtended(20, 18);

            const indiceDoblado = isFolded(8, 6);
            const medioDoblado = isFolded(12, 10);
            const anularDoblado = isFolded(16, 14);
            const meniqueDoblado = isFolded(20, 18);

            // -----------------------------
            // LETRA A
            // -----------------------------
            if (
                pulgarIndiceDist >= 0.09 &&
                indiceDoblado && medioDoblado &&
                anularDoblado && meniqueDoblado
            ) return "A";

            // -----------------------------
            // LETRA E
            // -----------------------------
            {
                const d812 = dist(8, 12); // índice-medio

                if (
                    indiceSemi && medioSemi && anularSemi && meniqueSemi &&

                    // pulgar NO tan cerca del índice (para no confundirse con O)
                    pulgarIndiceDist > 0.045 &&

                    // índice y medio juntos, pero no exagerado
                    d812 < 0.06 &&

                    // índice doblado hacia adentro (pero no demasiado)
                    pts[8][1] > pts[6][1]
                ) {
                    return "E";
                }
            }
            // -----------------------------
            // LETRA I
            // -----------------------------
            if (
                !indiceExtendido && !medioExtendido &&
                !anularExtendido && meniqueExtendido
            ) return "I";

            // -----------------------------
            // LETRA O
            // -----------------------------
            // -----------------------------
            // 1. distancia pulgar - índice
            const d48 = dist(4, 8);

            // 2. índice y medio juntos
            const d812 = dist(8, 12);

            // 3. índice doblado hacia adentro
            const indexCurved = pts[8][1] > pts[6][1];

            // 4. medio doblado hacia adentro
            const middleCurved = pts[12][1] > pts[10][1];

            // 5. anular y meñique doblados
            const ringCurved = pts[16][1] > pts[14][1];
            const pinkyCurved = pts[20][1] > pts[18][1];

            // CONDICIÓN FINAL
            if (
                d48 < 0.14 &&          // pulgar cerca del índice
                d812 < 0.08 &&         // índice-medio juntos
                indexCurved &&         // índice doblado
                middleCurved
            ) {
                return "O";
            }

            // -----------------------------
            // LETRA U
            // -----------------------------
            if (
                indiceExtendido && medioExtendido &&
                !anularExtendido && !meniqueExtendido &&
                dist(8, 12) < 0.06
            ) return "U";

            return null;
        }
    </script>
</body>

</html>