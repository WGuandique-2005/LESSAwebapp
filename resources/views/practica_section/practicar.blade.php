<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practicar - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #007bff;
            --primary-dark: #0056b3;
            --accent-color: #ff6b35;
            --bg-color: #f8f9fa;
            --text-main: #2c3e50;
            --text-light: #6c757d;
            --white: #ffffff;
            --border-radius: 16px;
            --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 15px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            padding: 80px 0;
            color: var(--white);
            position: relative;
            overflow: hidden;
            min-height: 400px;
            display: flex;
            align-items: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("{{ asset('img/aprender.png') }}");
            background-size: cover;
            background-position: center;
            opacity: 0.1;
            mix-blend-mode: overlay;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 40px;
            width: 100%;
        }

        .hero-text {
            max-width: 800px;
        }

        .hero-text h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0 0 10px 0;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .hero-text h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--accent-color);
            margin: 0 0 20px 0;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .hero-text p {
            font-size: 1.1rem;
            opacity: 0.95;
            line-height: 1.8;
            margin: 0;
        }

        .hero-logo {
            width: 180px;
            height: auto;
            filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.2));
            transition: transform 0.3s ease;
        }

        .hero-logo:hover {
            transform: scale(1.05) rotate(-2deg);
        }

        /* Main Content */
        .learn-sections {
            padding: 80px 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .section-header h2 {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-main);
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }

        .section-header h2::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--accent-color);
            margin: 12px auto 0;
            border-radius: 2px;
        }

        .section-header p {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        /* Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
            padding: 10px;
        }

        .learn-card {
            background: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            cursor: pointer;
            border: 1px solid rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .learn-card:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow-hover);
        }

        .card-image-container {
            height: 220px;
            background: #f1f3f5;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-image-container::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.05) 100%);
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .learn-card:hover .card-image {
            transform: scale(1.08);
        }

        .card-content {
            padding: 28px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-content h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0 0 12px 0;
        }

        .card-content p {
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0;
        }

        /* Feedback Messages */
        .feedback-message {
            max-width: 800px;
            margin: 20px auto;
            padding: 16px 24px;
            border-radius: 12px;
            font-weight: 500;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .feedback-message.success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .feedback-message.error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Practicar Specific Styles */
        .progress-container {
            background: linear-gradient(to right, #2c3e50, #34495e);
            border-radius: var(--border-radius);
            padding: 30px;
            margin-top: 40px;
            margin-bottom: 20px;
            color: var(--white);
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
        }

        .progress-container::before {
            content: '';
            position: absolute;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 60%);
            pointer-events: none;
        }

        .progress-container p {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0 0 8px 0;
            color: var(--white);
            position: relative;
            z-index: 1;
        }

        .progress-container small {
            display: block;
            margin-bottom: 20px;
            opacity: 0.8;
            font-size: 0.95rem;
            position: relative;
            z-index: 1;
        }

        .progress-bar-outer {
            background-color: rgba(255,255,255,0.15);
            border-radius: 10px;
            height: 14px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .progress-bar-inner {
            background-color: var(--accent-color);
            height: 100%;
            border-radius: 10px;
            width: 0%;
            transition: width 1.5s cubic-bezier(0.22, 1, 0.36, 1);
            box-shadow: 0 0 10px rgba(255, 107, 53, 0.5);
        }

        .ranking-container {
            background: linear-gradient(135deg, var(--accent-color) 0%, #ff8c42 100%);
        }

        .ranking-position {
            background: rgba(255,255,255,0.25);
            padding: 4px 12px;
            border-radius: 8px;
            font-weight: 800;
            margin-left: 8px;
            display: inline-block;
        }

        .ranking-info {
            margin-top: 20px;
            text-align: right;
            position: relative;
            z-index: 1;
        }

        .btn-view-ranking {
            display: inline-block;
            background: var(--white);
            color: var(--accent-color);
            padding: 12px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            transition: var(--transition);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .btn-view-ranking:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            background: #fff;
        }

        /* Responsive Design */
        @media (min-width: 992px) {
            .hero-content {
                flex-direction: row;
                text-align: left;
                justify-content: space-between;
            }

            .hero-text {
                flex: 1;
                order: 1;
                padding-right: 60px;
            }

            .hero-logo {
                order: 2;
                width: 220px;
            }

            .hero-text h2 {
                font-size: 3rem;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 0;
            }

            .hero-text h2 {
                font-size: 2rem;
            }

            .section-header h2 {
                font-size: 1.8rem;
            }

            .cards-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .ranking-info {
                text-align: center;
            }
        }
    </style>
</head>

<body>
    @if(session('status'))
        <div class="container">
            <p class="feedback-message success">
                {{ session('status') }}
            </p>
        </div>
    @endif
    @if(session('error'))
        <div class="container">
            <p class="feedback-message error">
                {{ session('error') }}
            </p>
        </div>
    @endif

    <header>@include('partials.navbar')</header>

    <main>
        <section class="hero-section">
            <div class="container hero-content">
                <div class="hero-text">
                    <h2>Sección de Práctica</h2>
                    <h3>¡Pon a prueba y consolida lo que has aprendido en LESSA!</h3>
                    <p>Bienvenido a tu espacio de práctica. Con ejercicios, evaluaciones y herramientas interactivas,
                        reforzarás tu memoria visual y fluidez en el Lenguaje de Señas Salvadoreño.</p>
                </div>
                <img src="{{ asset('img/logo2.png') }}" alt="LESSA Logo" class="hero-logo">
            </div>
        </section>

        <div class="container">
            @php
                use App\Models\PuntosUsuario;
                if (Auth::check()) {
                    $userId = Auth::id();
                    $completadas = PuntosUsuario::where('usuario_id', $userId)->where('completado', true)->count();
                } else {
                    $completadas = 3; 
                }

                $totalNiveles = 16;
                $progresoPorcentaje = $totalNiveles > 0 ? round(($completadas / $totalNiveles) * 100) : 0;
            @endphp

            <div class="progress-container">
                <p>Progreso Global de Práctica: {{ $progresoPorcentaje }}%</p>
                <small>Has completado {{ $completadas }} de {{ $totalNiveles }} actividades disponibles.</small>
                <div class="progress-bar-outer">
                    <div class="progress-bar-inner" style="width: {{ $progresoPorcentaje }}%;"></div>
                </div>
            </div>

            @if(Auth::check())
                @php
                    $userRanking = DB::table('puntos_usuarios')
                        ->select(
                            'puntos_usuarios.usuario_id',
                            'users.username',
                            DB::raw('SUM(puntos_obtenidos) as total_points')
                        )
                        ->join('users', 'users.id', '=', 'puntos_usuarios.usuario_id')
                        ->where('puntos_usuarios.completado', true)
                        ->groupBy('puntos_usuarios.usuario_id', 'users.username')
                        ->orderByDesc('total_points')
                        ->get();

                    $userPosition = $userRanking->search(function ($item) {
                        return $item->usuario_id == Auth::id();
                    });

                    $userTotalPoints = PuntosUsuario::where('usuario_id', Auth::id())
                        ->where('completado', true)
                        ->sum('puntos_obtenidos');
                @endphp

                <div class="progress-container ranking-container">
                    @if($userPosition !== false)
                        <p>Tu Posición en el Ranking: <span class="ranking-position">#{{ $userPosition + 1 }}</span></p>
                        <small>Has acumulado {{ $userTotalPoints }} puntos totales</small>
                        <div class="ranking-info">
                            <a href="{{ route('ranking') }}" class="btn-view-ranking">Ver Ranking Completo</a>
                        </div>
                    @else
                        <p>¡Aún no estás en el Ranking!</p>
                        <small>Completa minijuegos y obtén puntos para aparecer en el ranking global</small>
                        <div class="ranking-info">
                            <a href="{{ route('ranking') }}" class="btn-view-ranking">Ver Ranking y Comienza a Competir</a>
                        </div>
                    @endif
                </div>
            @endif

            <section class="learn-sections">
                <div class="section-header">
                    <h2>Actividades de LESSA</h2>
                    <p>Selecciona una lección para iniciar tu práctica y reforzar tus conocimientos con ejercicios interactivos.</p>
                </div>
                
                <div class="cards-grid">
                    <div class="learn-card goToLevelAbecedario">
                        <div class="card-image-container">
                            <img src="{{ asset('img/abcd.png') }}" alt="Señal del abecedario" class="card-image">
                        </div>
                        <div class="card-content">
                            <h3>Abecedario</h3>
                            <p>Practica el deletreo manual para nombres propios, siglas y palabras desconocidas. ¡La base de la comunicación!</p>
                        </div>
                    </div>

                    <div class="learn-card goToLevelNumeros">
                        <div class="card-image-container">
                            <img src="{{ asset('img/numbers.png') }}" alt="Señal de números" class="card-image">
                        </div>
                        <div class="card-content">
                            <h3>Números y Cantidades</h3>
                            <p>Domina los números del 1 al 100 y más allá, aprende a contar objetos y a formular preguntas sobre cantidades.</p>
                        </div>
                    </div>

                    <div class="learn-card goToLevelSaludos">
                        <div class="card-image-container">
                            <img src="{{ asset('img/saludos.png') }}" alt="Señal de saludo" class="card-image">
                        </div>
                        <div class="card-content">
                            <h3>Saludos y Presentaciones</h3>
                            <p>Refuerza las frases esenciales para iniciar una conversación: "Hola", "¿Cómo estás?" y presentarte.</p>
                        </div>
                    </div>

                    <div class="learn-card goToLevelSalud">
                        <div class="card-image-container">
                            <img src="{{ asset('img/health.png') }}" alt="Señal de salud" class="card-image">
                        </div>
                        <div class="card-content">
                            <h3>Salud y Emergencias</h3>
                            <p>Practica cómo señalar síntomas básicos y cómo comunicar información médica crítica en situaciones de emergencia.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer>@include('partials.footer')</footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function setupCardNavigation(className, route) {
                const card = document.querySelector('.' + className);
                if (card) {
                    card.addEventListener('click', function () {
                        window.location.href = route;
                    });
                }
            }

            setupCardNavigation('goToLevelAbecedario', "{{ route('nivel.abecedario') }}");
            setupCardNavigation('goToLevelNumeros', "{{ route('nivel.numeros') }}");
            setupCardNavigation('goToLevelSaludos', "{{ route('nivel.saludos') }}");
            setupCardNavigation('goToLevelSalud', "{{ route('nivel.salud') }}");

            const progressBar = document.querySelector('.progress-bar-inner');
            const porcentaje = '{{ $progresoPorcentaje }}';

            setTimeout(() => {
                if(progressBar) {
                    progressBar.style.width = porcentaje + '%';
                }
            }, 300);
        });
    </script>
</body>

</html>