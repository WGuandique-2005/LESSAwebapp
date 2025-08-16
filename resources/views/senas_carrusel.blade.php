<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LESSA - Carrusel de Señas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f2f5;
            margin: 0;
            overflow: hidden;
            /* Ocultar barras de desplazamiento */
        }

        .carousel-container {
            position: relative;
            width: 80%;
            max-width: 900px;
            overflow: hidden;
            /* Oculta los slides que están fuera de la vista */
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            padding: 20px;
        }

        .carousel-track {
            display: flex;
            /* Permite que los slides se coloquen uno al lado del otro */
            transition: transform 0.5s ease-in-out;
            /* Animación de desplazamiento */
            /* El ancho se ajustará dinámicamente con JS */
        }

        .carousel-slide {
            flex: 0 0 100%;
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            min-height: 350px;
            box-sizing: border-box;
            padding: 20px;
            transition: background 0.3s;
        }

        .slide-img {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 260px;
            max-width: 300px;
            height: 260px;
            margin-right: 40px;
        }

        .slide-img img {
            max-width: 100%;
            max-height: 240px;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        .slide-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 0;
            text-align: left;
        }

        .slide-content h2 {
            color: #333;
            margin-top: 0;
            font-size: 2em;
            font-weight: bold;
        }

        .slide-content p {
            color: #555;
            line-height: 1.6;
            font-size: 1.1em;
            margin: 0;
            word-break: break-word;
        }

        .carousel-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 15px 10px;
            cursor: pointer;
            font-size: 1.5em;
            border-radius: 5px;
            z-index: 10;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .carousel-button:hover {
            opacity: 1;
        }

        .carousel-button.prev {
            left: 10px;
        }

        .carousel-button.next {
            right: 10px;
        }

        @media (max-width: 700px) {
            .carousel-slide {
                flex-direction: column;
                min-height: 400px;
            }

            .slide-img {
                margin-right: 0;
                margin-bottom: 20px;
                height: 180px;
                max-width: 90vw;
            }

            .slide-content {
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="carousel-container">
        <button id="prevBtn" class="carousel-button prev">&lt;</button>
        <div class="carousel-track">
            {{-- Blade loop para renderizar cada tarjeta de seña --}}
            @foreach ($senas as $sena)
                <div class="carousel-slide">
                    <div class="slide-img">
                        <img src="{{ $sena['ruta'] }}" alt="{{ $sena['nombre'] }}">
                    </div>
                    <div class="slide-content">
                        <h2>{{ $sena['nombre'] }}</h2>
                        <p>{{ $sena['descripcion'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <button id="nextBtn" class="carousel-button next">&gt;</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const carouselTrack = document.querySelector('.carousel-track');
            const slides = Array.from(carouselTrack.children);
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            let currentSlideIndex = 0;
            let slideWidth = 0; // Se calculará después de la carga inicial

            // Función para actualizar la posición del carrusel
            const updateCarouselPosition = () => {
                // Recalcula el ancho del slide en cada movimiento para mayor robustez
                // Esto es importante si el tamaño del contenedor cambia, aunque no se espera en este caso
                if (slides.length > 0) {
                    slideWidth = slides[0].getBoundingClientRect().width;
                }
                const offset = -currentSlideIndex * slideWidth;
                carouselTrack.style.transform = `translateX(${offset}px)`;
            };

            // Inicializa el carrusel una vez que las imágenes se hayan cargado (o el DOM esté listo)
            // Se usa setTimeout con 0ms para asegurar que el DOM y CSS se han renderizado
            // antes de calcular slideWidth por primera vez.
            window.addEventListener('load', () => {
                updateCarouselPosition(); // Calcular y posicionar al cargar la página
            });


            // Botón Siguiente
            nextBtn.addEventListener('click', () => {
                currentSlideIndex++;
                if (currentSlideIndex >= slides.length) {
                    currentSlideIndex = 0; // Vuelve al primer slide si llega al final
                }
                updateCarouselPosition();
            });

            // Botón Anterior
            prevBtn.addEventListener('click', () => {
                currentSlideIndex--;
                if (currentSlideIndex < 0) {
                    currentSlideIndex = slides.length - 1; // Vuelve al último slide si llega al principio
                }
                updateCarouselPosition();
            });

            // Opcional: ajustar el carrusel si la ventana cambia de tamaño
            window.addEventListener('resize', updateCarouselPosition);
        });
    </script>
</body>

</html>