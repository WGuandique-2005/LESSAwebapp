<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecciones - LESSA</title>
    <style>
        /* Basic Reset & Body Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            /* Light gray background */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            display: flex;
            flex-grow: 1;
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Floating Elements (for the scattered shapes) */
        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            /* To hide shapes that go outside */
            pointer-events: none;
            /* Allows clicks on content below */
        }

        .shape {
            position: absolute;
            background-color: rgba(76, 175, 80, 0.6);
            /* Green with transparency */
            border-radius: 5px;
            opacity: 0.8;
        }

        /* Example positions and sizes for shapes (you'd adjust these for precise replication) */
        .shape-1 {
            top: 5%;
            left: 1%;
            width: 30px;
            height: 30px;
            transform: rotate(20deg);
            background-color: #ADD8E6;
        }

        /* LightBlue */
        .shape-2 {
            top: 10%;
            left: 3%;
            width: 25px;
            height: 25px;
            transform: rotate(-45deg);
            background-color: #FFB6C1;
        }

        /* LightPink */
        .shape-3 {
            top: 15%;
            left: 0.5%;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #90EE90;
        }

        /* LightGreen */
        .shape-4 {
            top: 20%;
            left: 2.5%;
            width: 20px;
            height: 20px;
            transform: rotate(60deg);
            background-color: #FFD700;
        }

        /* Gold */
        .shape-5 {
            top: 25%;
            left: 1%;
            width: 35px;
            height: 35px;
            background-color: #ADD8E6;
        }

        .shape-6 {
            top: 30%;
            left: 3%;
            width: 28px;
            height: 28px;
            transform: rotate(15deg);
            background-color: #FFB6C1;
        }

        .shape-7 {
            top: 35%;
            left: 0.8%;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: #90EE90;
        }

        .shape-8 {
            top: 40%;
            left: 2%;
            width: 22px;
            height: 22px;
            transform: rotate(-30deg);
            background-color: #FFD700;
        }

        .shape-9 {
            top: 45%;
            left: 1.5%;
            width: 38px;
            height: 38px;
            background-color: #ADD8E6;
        }

        .shape-10 {
            top: 50%;
            left: 3.5%;
            width: 30px;
            height: 30px;
            transform: rotate(40deg);
            background-color: #FFB6C1;
        }

        .shape-11 {
            top: 55%;
            left: 0.7%;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: #90EE90;
        }

        .shape-12 {
            top: 60%;
            left: 2.8%;
            width: 42px;
            height: 42px;
            transform: rotate(-55deg);
            background-color: #FFD700;
        }

        .shape-13 {
            top: 65%;
            left: 1.2%;
            width: 33px;
            height: 33px;
            background-color: #ADD8E6;
        }

        .shape-14 {
            top: 70%;
            left: 3.2%;
            width: 27px;
            height: 27px;
            transform: rotate(25deg);
            background-color: #FFB6C1;
        }

        .shape-15 {
            top: 75%;
            left: 0.9%;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #90EE90;
        }

        .shape-16 {
            top: 80%;
            left: 2.3%;
            width: 24px;
            height: 24px;
            transform: rotate(-10deg);
            background-color: #FFD700;
        }

        .shape-17 {
            top: 85%;
            left: 1.8%;
            width: 36px;
            height: 36px;
            background-color: #ADD8E6;
        }

        .shape-18 {
            top: 90%;
            left: 3.8%;
            width: 31px;
            height: 31px;
            transform: rotate(70deg);
            background-color: #FFB6C1;
        }

        .shape-19 {
            top: 95%;
            left: 0.6%;
            width: 29px;
            height: 29px;
            border-radius: 50%;
            background-color: #90EE90;
        }


        /* Learning Section */
        .learning-section {
            flex-grow: 1;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-left: 5%;
            /* Adjust to make space for floating elements */
            margin-right: 5%;
        }

        .learning-section h1 {
            color: #333;
            margin-top: 0;
            font-size: 28px;
        }

        .learning-section .subtitle {
            color: #555;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .learning-section .description,
        .learning-section .reminder {
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        /* Progress Bar */
        .progress-container {
            margin-top: 30px;
            background-color: #020282ff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .progress-container p {
            margin-top: 0;
            margin-bottom: 10px;
            font-weight: bold;
            color: #ffffffff;
        }

        .progress-bar-outer {
            background-color: #ccc;
            border-radius: 5px;
            height: 15px;
            overflow: hidden;
        }

        .progress-bar-inner {
            background-color: #f3ab05ff;
            /* Green */
            height: 100%;
            border-radius: 5px;
            width: 0%;
            /* Initial width, will be set by JS or inline style */
            transition: width 0.5s ease-in-out;
            /* Smooth transition for progress */
        }

        /* Cards Container */
        .cards-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 30px;
        }

        .card {
            display: flex;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s ease-in-out;
            border: 1px solid #ddd;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-image {
            flex-shrink: 0;
            width: 120px;
            /* Adjust as needed */
            height: auto;
            object-fit: cover;
            margin: 15px;
            /* Spacing around the image */
            border-radius: 4px;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            display: block;
            border-radius: 4px;
        }

        .card-content {
            flex-grow: 1;
            padding: 15px;
        }

        .card-content h3 {
            margin-top: 0;
            color: #333;
            font-size: 18px;
        }

        .card-content p {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
        }

        .card-status {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .card-status .circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #ccc;
            /* Default gray border */
            background-color: white;
            /* Default white fill */
        }


        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .card-image {
                width: 100px;
                height: 70px;
                margin-bottom: 10px;
            }

            .card-content {
                padding: 10px;
            }

            .card-status {
                padding-top: 0;
            }
        }
    </style>
</head>

<body>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LESSA - Sección de Aprendizaje</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <header>@include('partials.navbar')</header> 
    <main class="container">
        <aside class="floating-elements">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
            <div class="shape shape-5"></div>
            <div class="shape shape-6"></div>
            <div class="shape shape-7"></div>
            <div class="shape shape-8"></div>
            <div class="shape shape-9"></div>
            <div class="shape shape-10"></div>
            <div class="shape shape-11"></div>
            <div class="shape shape-12"></div>
            <div class="shape shape-13"></div>
            <div class="shape shape-14"></div>
            <div class="shape shape-15"></div>
            <div class="shape shape-16"></div>
            <div class="shape shape-17"></div>
            <div class="shape shape-18"></div>
            <div class="shape shape-19"></div>
        </aside>

        <section class="learning-section">
            <h1>Sección de Aprendizaje</h1>
            <p class="subtitle">¡Bienvenido a tu zona de Aprendizaje!</p>
            <p class="description">
                Aquí es donde obtendrás todo el conocimiento teórico en habilidades reales de comunicación. La
                sección de Aprendizaje de LESSA está diseñada para ayudarte a desarrollar tus habilidades iniciales
                en este lenguaje, perfeccionar tus movimientos y obtener contexto de su uso o significados.
            </p>
            <p class="reminder">
                Recuerda: Si nunca lo intentas, ¡nunca sabrás el resultado.
                ¡Tú puedes!
            </p>

            <div class="progress-container">
                <p>Progreso de Aprendizaje</p>
                <div class="progress-bar-outer">
                    <div class="progress-bar-inner" style="width: 20%;"></div> </div>
            </div>

            <div class="cards-container">
                <div class="card">
                    <div class="card-image">
                        <img src="{{ asset('img/abcd.png') }}" alt="Vocabulario del Hogar y la Familia">
                    </div>
                    <div class="card-content">
                        <h3>Abecedario</h3>
                        <p>Aprenderás las letras del abecedario para poder por ejemplo deletrar tu nombre, siglas u otros usos que descubriras.</p>
                    </div>
                    <div class="card-status">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-image">
                        <img src="{{ asset('img/saludos.png') }}" alt="Saludos y Presentaciones">
                    </div>
                    <div class="card-content">
                        <h3>Saludos y Presentaciones</h3>
                        <p>Aprenderás a comunicar saludos como "Hola", "Buenos días", "Buenas noches", "¿Cómo estás?", así como frases para presentarte como "Mi nombre es..." o "Mucho gusto".</p>
                    </div>
                    <div class="card-status">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-image">
                        <img src="https://via.placeholder.com/100x70/E0E0E0/808080?text=Imagen+3" alt="Alimentos y Bebidas">
                    </div>
                    <div class="card-content">
                        <h3>Alimentos y Bebidas</h3>
                        <p>Practicarás las señas de alimentos comunes (pan, arroz, papa, agua, leche, café) y frases como "Tengo hambre" y "¿Quieres comer?".</p>
                    </div>
                    <div class="card-status">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-image">
                        <img src="https://via.placeholder.com/100x70/E0E0E0/808080?text=Imagen+4" alt="Salud y Emergencias">
                    </div>
                    <div class="card-content">
                        <h3>Salud y Emergencias</h3>
                        <p>Aprenderás a señalar síntomas básicos ("me duele", "fiebre", "cansado"), a expresar si tienes alguna alergia y reconocer lugares de atención médica ("hospital", "clínica").</p>
                    </div>
                    <div class="card-status">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-image">
                        <img src="https://via.placeholder.com/100x70/E0E0E0/808080?text=Imagen+5" alt="Emociones y Estados de Ánimo">
                    </div>
                    <div class="card-content">
                        <h3>Emociones y Estados de Ánimo</h3>
                        <p>Explorarás cómo expresar sentimientos como "feliz", "triste", "enojado", "nervioso", "cansado" y preguntas como "¿Cómo te sientes hoy?" o "¿Estás bien?", para poder expresar y entender estados emocionales en conversaciones.</p>
                    </div>
                    <div class="card-status">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>@include('partials.footer')</footer>
    <script>
document.addEventListener('DOMContentLoaded', () => {
    // Example for progress bar animation
    const progressBarInner = document.querySelector('.progress-bar-inner');
    // You'd typically get the actual progress from backend data
    const currentProgress = 60; // Example: 60% completion
    progressBarInner.style.width = `${currentProgress}%`;

    // Example for card status (e.g., if completed, change circle color)
    // You would loop through your cards and update their status based on data
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        // For demonstration, let's say the first two cards are 'completed'
        if (index < 2) {
            const statusCircle = card.querySelector('.card-status .circle');
            statusCircle.style.backgroundColor = '#4CAF50'; // Green for completed
            statusCircle.style.borderColor = '#4CAF50';
        }
    });

    // You could also add event listeners for card clicks, etc.
    cards.forEach(card => {
        card.addEventListener('click', () => {
            console.log('Card clicked!');
            // Add navigation or specific action here
        });
    });
});
    </script>
</body>
</html>
</body>

</html>