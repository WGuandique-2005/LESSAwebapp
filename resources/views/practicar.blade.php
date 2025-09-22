<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LESSA - Plataforma de Aprendizaje</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background-color: #f0f2f5;
        }

        .horizontal-scroll-container {
            overflow-x: scroll;
            white-space: nowrap;
            padding-bottom: 2rem;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        /* Scrollbar styles for different browsers */
        .horizontal-scroll-container::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }
        .horizontal-scroll-container {
            scrollbar-width: none; /* Firefox */
        }

        .card {
            display: inline-block;
            margin-right: 2rem;
            min-width: 15rem;
            max-width: 15rem;
            height: 18rem;
            position: relative;
            background-size: cover;
            background-position: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Custom gradients based on the image */
        .card-gradient-1 {
            background-image: linear-gradient(135deg, #a7e94e, #2e8b57);
        }
        .card-gradient-2 {
            background-image: linear-gradient(135deg, #6c5ce7, #a252d6);
        }
        .card-gradient-3 {
            background-image: linear-gradient(135deg, #d32f2f, #ef6c00);
        }
        .card-gradient-4 {
            background-image: linear-gradient(135deg, #ffcc00, #ff8c00);
        }
        .card-gradient-5 {
            background-image: linear-gradient(135deg, #2e8b57, #a7e94e);
        }

        .scroll-indicator {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 1.5rem;
            height: 1.5rem;
            background-color: #3b82f6;
            border-radius: 9999px;
            z-index: 20;
            transition: transform 0.3s ease;
        }
        
        .floating-shape {
            animation: float 6s ease-in-out infinite;
            opacity: 0.6;
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0); }
        }

        .delay-500 { animation-delay: 0.5s; }
        .delay-1000 { animation-delay: 1s; }
        
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Main Content -->
    <main class="container mx-auto mt-10 px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Section -->
            <div class="w-full lg:w-1/3 p-6 bg-white rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-gray-700">Nivel Básico</h2>
                <p class="text-gray-500 mt-1">Abecedario <br> Nivel I</p>
                <div class="flex items-center mt-4">
                    <div class="w-24 h-24 relative">
                        <svg class="w-full h-full" viewBox="0 0 36 36">
                            <path class="text-gray-200" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4" stroke-dasharray="100" stroke-linecap="round"></path>
                            <path class="text-green-500" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4" stroke-dasharray="50, 100" stroke-linecap="round"></path>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center text-xl font-bold text-green-500">50%</div>
                    </div>
                </div>
                <h3 class="font-semibold text-gray-700 mt-4">Vocales</h3>
                <p class="text-sm text-gray-500 mt-2">Domina las bases del abecedario en señas comenzando por las vocales: A, E, I, O, U. En esta sección practicarás la correcta ejecución de cada vocal de manera individual, enfocándote en la forma de la mano, la orientación y el movimiento.</p>
            </div>
            <!-- Right Section - Horizontal Scroll -->
            <div class="w-full lg:w-2/3 relative">
                <div class="absolute inset-0 z-0 overflow-hidden">
                    <!-- Decorative shapes -->
                    <div class="absolute w-12 h-12 rounded-full bg-yellow-300 transform rotate-12 -top-4 left-1/4 floating-shape"></div>
                    <div class="absolute w-8 h-8 rounded-full bg-pink-400 transform -rotate-45 top-1/2 left-3/4 floating-shape delay-500"></div>
                    <div class="absolute w-16 h-16 rounded-full bg-blue-300 transform rotate-90 bottom-8 left-1/2 floating-shape delay-1000"></div>
                </div>
                <div id="scroll-container" class="horizontal-scroll-container z-10 flex flex-nowrap space-x-8">
                    <!-- Cards -->
                    <div class="card card-gradient-1 p-6 text-white rounded-3xl shadow-lg flex-shrink-0">
                        <div class="relative h-full flex flex-col justify-between">
                            <span class="bg-white/30 text-xs font-semibold px-2 py-1 rounded-full backdrop-blur-sm">Abecedario Nivel I</span>
                            <div class="mt-auto">
                                <h4 class="text-xl font-bold">Vocales I</h4>
                                <div class="w-10 h-10 bg-white/40 rounded-full flex items-center justify-center mt-4">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm4.5-8c0 1.93-1.57 3.5-3.5 3.5s-3.5-1.57-3.5-3.5 1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5z"/></svg>
                                </div>
                            </div>
                            <span class="absolute bottom-4 right-4 text-white text-lg"><i class="fas fa-lock-open"></i></span>
                        </div>
                    </div>
                    <div class="card card-gradient-2 p-6 text-white rounded-3xl shadow-lg flex-shrink-0">
                        <div class="relative h-full flex flex-col justify-between">
                            <span class="bg-white/30 text-xs font-semibold px-2 py-1 rounded-full backdrop-blur-sm">Abecedario Nivel III</span>
                            <div class="mt-auto">
                                <h4 class="text-xl font-bold">Vocales II</h4>
                                <div class="w-10 h-10 bg-white/40 rounded-full flex items-center justify-center mt-4">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm4.5-8c0 1.93-1.57 3.5-3.5 3.5s-3.5-1.57-3.5-3.5 1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5z"/></svg>
                                </div>
                            </div>
                            <span class="absolute bottom-4 right-4 text-white text-lg"><i class="fas fa-lock"></i></span>
                        </div>
                    </div>
                    <div class="card card-gradient-3 p-6 text-white rounded-3xl shadow-lg flex-shrink-0">
                        <div class="relative h-full flex flex-col justify-between">
                            <span class="bg-white/30 text-xs font-semibold px-2 py-1 rounded-full backdrop-blur-sm">Consonantes I</span>
                            <div class="mt-auto">
                                <h4 class="text-xl font-bold">Consonantes I</h4>
                                <div class="w-10 h-10 bg-white/40 rounded-full flex items-center justify-center mt-4">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm4.5-8c0 1.93-1.57 3.5-3.5 3.5s-3.5-1.57-3.5-3.5 1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5z"/></svg>
                                </div>
                            </div>
                            <span class="absolute bottom-4 right-4 text-white text-lg"><i class="fas fa-lock"></i></span>
                        </div>
                    </div>
                    <div class="card card-gradient-4 p-6 text-white rounded-3xl shadow-lg flex-shrink-0">
                        <div class="relative h-full flex flex-col justify-between">
                            <span class="bg-white/30 text-xs font-semibold px-2 py-1 rounded-full backdrop-blur-sm">Abecedario Nivel IV</span>
                            <div class="mt-auto">
                                <h4 class="text-xl font-bold">Consonantes II</h4>
                                <div class="w-10 h-10 bg-white/40 rounded-full flex items-center justify-center mt-4">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm4.5-8c0 1.93-1.57 3.5-3.5 3.5s-3.5-1.57-3.5-3.5 1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5z"/></svg>
                                </div>
                            </div>
                            <span class="absolute bottom-4 right-4 text-white text-lg"><i class="fas fa-lock"></i></span>
                        </div>
                    </div>
                    <div class="card card-gradient-5 p-6 text-white rounded-3xl shadow-lg flex-shrink-0">
                        <div class="relative h-full flex flex-col justify-between">
                            <span class="bg-white/30 text-xs font-semibold px-2 py-1 rounded-full backdrop-blur-sm">Abecedario Nivel I</span>
                            <div class="mt-auto">
                                <h4 class="text-xl font-bold">Prueba</h4>
                                <div class="w-10 h-10 bg-white/40 rounded-full flex items-center justify-center mt-4">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm4.5-8c0 1.93-1.57 3.5-3.5 3.5s-3.5-1.57-3.5-3.5 1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5z"/></svg>
                                </div>
                            </div>
                            <span class="absolute bottom-4 right-4 text-white text-lg"><i class="fas fa-lock"></i></span>
                        </div>
                    </div>
                </div>
                <!-- Scroll indicator -->
                <div class="flex justify-center mt-6">
                    <div class="relative w-full h-1 bg-gray-300 rounded-full">
                        <div id="scroll-dot" class="scroll-indicator absolute bottom-0"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const scrollContainer = document.getElementById('scroll-container');
        const scrollDot = document.getElementById('scroll-dot');

        if (scrollContainer && scrollDot) {
            scrollContainer.addEventListener('scroll', () => {
                const scrollWidth = scrollContainer.scrollWidth - scrollContainer.clientWidth;
                const scrollLeft = scrollContainer.scrollLeft;
                const dotPosition = (scrollLeft / scrollWidth) * (scrollContainer.clientWidth - scrollDot.clientWidth);
                scrollDot.style.transform = `translateX(${dotPosition}px)`;
            });
        }
    </script>
</body>
</html>
