<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio - LESSA</title>
    <style>
        :root{
            --error-color: #EF4444; /* Tailwind red-500 */
            --success-color: #22C55E; /* Tailwind green-500 */
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 2rem;
        }

        h1,
        h2 {
            color: #011B40;
        }

        .btn-start,
        .btn-ihave,
        .btn-start-second {
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin: 0.5rem 0.25rem;
        }

        .btn-start {
            background-color: #011B40;
            color: #fff;
            border: none;
        }

        .btn-start-second {
            background-color: #011B40;
            color: #fff;
            border: none;
        }

        .btn-ihave {
            background-color: #fff;
            color: #011B40;
            border: 2px solid #011B40;
        }

        .btn-start:hover{
            background-color: #0056b3;
        }
        .btn-ihave:hover{
            background-color: #ffff60;
        }
        .btn-start-second:hover{
            background-color: #0056b3;
        }
        .feedback-message {
            text-align: center;
            margin-bottom: 16px;
            padding: 10px;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 0.95em;
        }

        .feedback-message.success {
            color: var(--success-color);
            background-color: rgba(34, 197, 94, 0.1); /* Light green background */
            border: 1px solid var(--success-color);
        }

        .feedback-message.error {
            color: var(--error-color);
            background-color: rgba(239, 68, 68, 0.1)
            border: 1px solid var(--error-color);
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.85em;
            margin-top: -10px;
            margin-bottom: 6px;
            display: block;
        }
        .firstParent,
        .secondParent,
        .thirdParent,
        .fourthParent {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .firstParent>div,
        .secondParent>div,
        .thirdParent>div {
            flex: 1 1 48%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .secondParent>.div6,
        .secondParent>.div7 {
            background-color: #011B40;
            color: white;
            text-align: center;
            padding: 1rem;
            border-radius: 8px;
        }

        .div2,
        .div3,
        .div5,
        .div8,
        .div9 {
            align-items: center;
        }

        .div2 img,
        .div3 img,
        .div5 img,
        .div8 img,
        .div9 img {
            max-width: 100%;
            height: auto;
        }

        .fourthParent {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .fourthParent h1 {
            margin-bottom: 1rem;
        }

        .fourthParent img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        hr {
            border: 0;
            border-top: 2px solid #011B40;
            width: 100%;
            margin: 1rem 0;
        }

        @media (max-width: 768px) {

            .firstParent>div,
            .secondParent>div,
            .thirdParent>div {
                flex: 1 1 100%;
                text-align: center;
            }

            .firstParent .div4 {
                text-align: left;
            }

            .btn-start,
            .btn-ihave {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>

<body>
    <header>
        @include('partials.navbar')
    </header>
    @if(session('status'))
        <p class="feedback-message success">
            {{ session('status') }}
        </p>
    @endif
    @if(session('error'))
        <p class="feedback-message error">
            {{ session('error') }}
        </p>
    @endif
    <div class="container">

        <!-- Sección 1: Bienvenida -->
        <div class="firstParent">
            <div class="div1">
                <h1>Somos LESSA</h1>
                <h2>Conectando manos, uniendo voces</h2>
                <hr>
                <p>¡Bienvenido a LESSA! Una plataforma interactiva pensada para romper las barreras de comunicación y
                    construir un mundo más inclusivo.</p>
                <br>
                <p>Queremos inspirarte a descubrir una nueva forma de comunicarte, aprender a tu ritmo, y conectar con una causa transformadora. Tu viaje de aprendizaje empieza aquí.
                </p>
            </div>
            <div class="div2">
                <h2>¡La forma divertida, efectiva y gratis de aprender LESSA!</h2>
                <img src="{{ asset('img/logo_sinfondo.png') }}" alt="Logo LESSA">
                <button class="btn-start">EMPIEZA AHORA</button>
                <button class="btn-ihave">YA TENGO UNA CUENTA</button>
            </div>
            <div class="div3">
                <img src="{{ asset('img/who.png')}}" alt="¿Quiénes somos?">
            </div>
            <div class="div4">
                <h2>¿Quiénes somos?</h2>
                <hr>
                <p>Somos un equipo de jóvenes desarrolladores comprometidos con crear soluciones accesibles. LESSA nace
                    como respuesta a los retos de comunicación que enfrentan las personas con discapacidades auditivas
                    en El Salvador. LESSA nace como una respuesta a los retos que enfrentan las personas con
                    discapacidades auditivas y de comunicación oral en El Salvador. </p>
                <br>
                <p>
                    Sabemos que la inclusión comienza con la educación, y es por eso que nuestra aplicación busca acercar el aprendizaje del lenguaje de
                    señas de forma dinámica, estructurada y accesible, especialmente para zonas rurales y comunidades
                    con limitaciones tecnológicas.
                </p>
            </div>
        </div>

        <!-- Sección 2: Misión y Visión -->
        <h1>Nuestra Misión y Visión</h1>
        <hr>
        <div class="secondParent">
            <div class="div5">
                <img src="{{ asset('img/salvadorMundo.png') }}" alt="Misión">
            </div>
            <div class="div6">
                <p>Enseñar LESSA de manera accesible y efectiva, ofreciendo herramientas prácticas para fomentar la
                    comunicación inclusiva entre personas sordas y oyentes, contribuyendo al aprendizaje y la
                    comprensión del lenguaje de señas salvadoreño.</p>
            </div>
            <div class="div7">
                <p>Ser la plataforma más reconocida en El Salvador para aprender LESSA, promoviendo la integración
                    social, cultural y laboral de la comunidad sorda y facilitando el acceso a la educación en lenguaje
                    de señas.</p>
            </div>
            <div class="div8">
                <img src="{{ asset('img/farolitos.png') }}" alt="Visión">
            </div>
        </div>

        <!-- Sección 3: Inclusión -->
        <div class="thirdParent">
            <div class="div9">
                <img src="{{ asset('img/hands.png') }}" alt="manos">
            </div>
            <div class="div10">
                <h2>Rompiendo Barreras</h2>
                <hr>
                <p>En LESSA creemos que todos tenemos derecho a comunicarnos. Nuestra agenda está clara: romper las
                    barreras de comunicación y contribuir a un mundo más inclusivo. Cada lección, cada signo aprendido,
                    es un paso hacia una sociedad donde nadie se quede atrás.</p>
                <br>
                <p>Apostamos por una educación que une, que entiende y que transforma. A través del uso de tecnología
                    educativa, buscamos crear oportunidades reales para miles de personas que hoy enfrentan desafíos
                    para comunicarse y ser comprendidas.</p>
                <br>
                <p>Forma parte de la comunidad y accede a los contenidos exclusivos. También puedes aprender, prácticar
                    y muchos retos.</p>
            </div>
        </div>
        <hr>
        <!-- Sección 4: Llamado a la acción -->
        <div class="fourthParent">
            <h1>Todos aprenden con LESSA</h1>
            <button class="btn-start-second" id="btn-start">EMPIEZA AHORA</button>
            <img src="{{ asset('img/game.png') }}" alt="Juego">
        </div>

    </div>

    <footer>
        @include('partials.footer')
    </footer>
    <script>
        addEventListener("DOMContentLoaded", function() {
            const btnStart = document.querySelector(".btn-start");
            const btnIhave = document.querySelector(".btn-ihave");
            const btnStartSecond = document.querySelector(".btn-start-second");

            btnStart.addEventListener("click", function() {
                window.location.href = "/signup";
            });

            btnIhave.addEventListener("click", function() {
                window.location.href = "/login";
            });
            btnStartSecond.addEventListener("click", function() {
                window.location.href = "/signup";
            });
        });
    </script>
</body>

</html>