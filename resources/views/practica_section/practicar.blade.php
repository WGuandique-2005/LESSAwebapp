<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practicar - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* --- VARIABLES (Existing Colors + New Structure) --- */
        :root {
            --primary-color: #007bff;
            --primary-dark: #0056b3;
            --accent-color: #ff6b35;
            --accent-hover: #e85d2a;
            --bg-body: #f8f9fa;
            --bg-card: #ffffff;
            --text-main: #2c3e50;
            --text-light: #6c757d;
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --radius-lg: 1rem;
            --radius-xl: 1.5rem;
            --radius-full: 9999px;
            --transition-base: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- HERO SECTION --- */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: #ffffff;
            padding: 4rem 0 6rem;
            position: relative;
            border-radius: 0 0 var(--radius-xl) var(--radius-xl);
            overflow: hidden;
            text-align: center;
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
        }

        .hero-bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.1;
            mix-blend-mode: overlay;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--accent-color);
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .hero-desc {
            font-size: 1.1rem;
            opacity: 0.95;
            margin-bottom: 2rem;
        }

        /* --- MAIN CONTAINER --- */
        .main-container {
            width: 100%;
            max-width: 1200px;
            margin: -4rem auto 0;
            padding: 0 1.5rem 4rem;
            position: relative;
            z-index: 10;
        }

        /* --- PROGRESS & RANKING CARDS --- */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .dashboard-card {
            border-radius: var(--radius-lg);
            padding: 2rem;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .dashboard-card.progress-card {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        }

        .dashboard-card.ranking-card {
            background: linear-gradient(135deg, var(--accent-color) 0%, #ff8c42 100%);
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
            pointer-events: none;
        }

        .dashboard-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .dashboard-text {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .progress-bar-bg {
            background: rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-full);
            height: 12px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .progress-bar-fill {
            background: var(--accent-color);
            height: 100%;
            border-radius: var(--radius-full);
            width: 0%;
            transition: width 1s ease;
            box-shadow: 0 0 10px rgba(255, 107, 53, 0.5);
        }

        .ranking-badge {
            background: rgba(255, 255, 255, 0.25);
            padding: 0.25rem 0.75rem;
            border-radius: var(--radius-lg);
            font-weight: 800;
            margin-left: 0.5rem;
        }

        .btn-ranking {
            display: inline-block;
            background: #ffffff;
            color: var(--accent-color);
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-full);
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition-base);
            box-shadow: var(--shadow-sm);
            position: relative;
            z-index: 1;
        }

        .btn-ranking:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            background: #f8f9fa;
        }

        /* --- SECTION HEADER --- */
        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            display: inline-block;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--accent-color);
            margin: 0.5rem auto 0;
            border-radius: var(--radius-full);
        }

        .section-desc {
            color: var(--text-light);
            font-size: 1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* --- CARDS GRID --- */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .learn-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition-base);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            height: 100%;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .learn-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(0, 123, 255, 0.2);
        }

        .card-img-wrapper {
            height: 180px;
            background: #f1f5f9;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .learn-card:hover .card-img {
            transform: scale(1.05);
        }

        .card-content {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .card-text {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .card-footer {
            display: flex;
            align-items: center;
            color: var(--accent-color);
            font-weight: 600;
            font-size: 0.85rem;
        }

        .card-footer i {
            margin-left: 0.5rem;
            transition: transform 0.2s;
        }

        .learn-card:hover .card-footer i {
            transform: translateX(4px);
        }

        /* --- FEEDBACK MESSAGES --- */
        .feedback-message {
            max-width: 800px;
            margin: 1rem auto;
            padding: 1rem 1.5rem;
            border-radius: var(--radius-lg);
            font-weight: 500;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: var(--shadow-sm);
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

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0 5rem;
            }

            .hero-title {
                font-size: 2rem;
            }

            .main-container {
                margin-top: -3rem;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>

    @if(session('status'))
        <div class="container" style="padding: 0 1.5rem;">
            <div class="feedback-message success">
                <i class="fas fa-check-circle"></i> {{ session('status') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="container" style="padding: 0 1.5rem;">
            <div class="feedback-message error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        </div>
    @endif

    <section class="hero-section">
        <div class="hero-bg-img" style="background-image: url('{{ asset('img/aprender.png') }}');"></div>
        <div class="hero-content">
            <h1 class="hero-title">Sección de Práctica</h1>
            <h2 class="hero-subtitle">¡Pon a prueba tus conocimientos!</h2>
            <p class="hero-desc">
                Bienvenido a tu espacio de práctica. Con ejercicios y evaluaciones, reforzarás tu memoria visual y fluidez en LESSA.
            </p>
        </div>
    </section>

    <main class="main-container">
        
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

        <div class="dashboard-grid">
            <!-- Progress Card -->
            <div class="dashboard-card progress-card">
                <div class="dashboard-title">Progreso Global</div>
                <div class="dashboard-text">Has completado {{ $completadas }} de {{ $totalNiveles }} actividades.</div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: {{ $progresoPorcentaje }}%;"></div>
                </div>
                <div style="margin-top: 0.5rem; font-weight: 600; text-align: right;">{{ $progresoPorcentaje }}%</div>
            </div>

            <!-- Ranking Card -->
            @if(Auth::check())
                @php
                    $userRanking = DB::table('puntos_usuarios')
                        ->select('puntos_usuarios.usuario_id', DB::raw('SUM(puntos_obtenidos) as total_points'))
                        ->where('puntos_usuarios.completado', true)
                        ->groupBy('puntos_usuarios.usuario_id')
                        ->orderByDesc('total_points')
                        ->get();

                    $userPosition = $userRanking->search(function ($item) {
                        return $item->usuario_id == Auth::id();
                    });

                    $userTotalPoints = PuntosUsuario::where('usuario_id', Auth::id())
                        ->where('completado', true)
                        ->sum('puntos_obtenidos');
                @endphp

                <div class="dashboard-card ranking-card">
                    @if($userPosition !== false)
                        <div class="dashboard-title">
                            Tu Posición <span class="ranking-badge">#{{ $userPosition + 1 }}</span>
                        </div>
                        <div class="dashboard-text">Has acumulado {{ $userTotalPoints }} puntos totales.</div>
                        <a href="{{ route('ranking') }}" class="btn-ranking">Ver Ranking Completo</a>
                    @else
                        <div class="dashboard-title">¡Únete al Ranking!</div>
                        <div class="dashboard-text">Completa minijuegos para aparecer en el ranking global.</div>
                        <a href="{{ route('ranking') }}" class="btn-ranking">Ver Ranking</a>
                    @endif
                </div>
            @endif
        </div>

        <div class="section-header">
            <h3 class="section-title">Actividades de LESSA</h3>
            <p class="section-desc">Selecciona una lección para iniciar tu práctica y reforzar tus conocimientos.</p>
        </div>

        <div class="cards-grid">
            <!-- Abecedario -->
            <div class="learn-card" onclick="window.location.href='{{ route('nivel.abecedario') }}'">
                <div class="card-img-wrapper">
                    <img src="{{ asset('img/abcd.png') }}" alt="Abecedario" class="card-img">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Abecedario</h3>
                    <p class="card-text">Practica el deletreo manual para nombres propios y palabras desconocidas.</p>
                    <div class="card-footer">Practicar <i class="fas fa-arrow-right"></i></div>
                </div>
            </div>

            <!-- Numeros -->
            <div class="learn-card" onclick="window.location.href='{{ route('nivel.numeros') }}'">
                <div class="card-img-wrapper">
                    <img src="{{ asset('img/numbers.png') }}" alt="Números" class="card-img">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Números y Cantidades</h3>
                    <p class="card-text">Domina los números del 1 al 100 y aprende a contar objetos.</p>
                    <div class="card-footer">Practicar <i class="fas fa-arrow-right"></i></div>
                </div>
            </div>

            <!-- Saludos -->
            <div class="learn-card" onclick="window.location.href='{{ route('nivel.saludos') }}'">
                <div class="card-img-wrapper">
                    <img src="{{ asset('img/saludos.png') }}" alt="Saludos" class="card-img">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Saludos</h3>
                    <p class="card-text">Refuerza las frases esenciales para iniciar una conversación.</p>
                    <div class="card-footer">Practicar <i class="fas fa-arrow-right"></i></div>
                </div>
            </div>

            <!-- Salud -->
            <div class="learn-card" onclick="window.location.href='{{ route('nivel.salud') }}'">
                <div class="card-img-wrapper">
                    <img src="{{ asset('img/health.png') }}" alt="Salud" class="card-img">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Salud y Emergencias</h3>
                    <p class="card-text">Practica cómo señalar síntomas básicos y comunicar información médica.</p>
                    <div class="card-footer">Practicar <i class="fas fa-arrow-right"></i></div>
                </div>
            </div>
        </div>
    </main>

    <footer>@include('partials.footer')</footer>
</body>

</html>