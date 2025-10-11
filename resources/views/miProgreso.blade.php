<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Progreso - LESSA</title>
    <style>
        :root {
            --bg-dark: #0A2463;
            --progress-bg: rgba(255, 255, 255, 0.1);
            --progress-fill: #4CB944;
            --accent-btn: #FFD166;
            --primary-text: #fff;
            --secondary-text: rgba(255, 255, 255, 0.7);
        }

        body {
            margin: 0;
            font-family: "Segoe UI", sans-serif;
            background: linear-gradient(180deg, #0A2463 0%, #1D3557 100%);
            color: var(--primary-text);
        }

        .hero {
            text-align: center;
            padding: 50px 20px 40px;
            background: #011B40;
            border-bottom: 3px solid var(--accent-btn);
        }

        .hero h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .hero p {
            font-size: 16px;
            color: var(--secondary-text);
            margin-bottom: 20px;
        }

        .progress-container {
            background: var(--bg-dark);
            border-radius: 18px;
            padding: 30px;
            max-width: 900px;
            margin: 30px auto;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        }

        .section-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Progreso General */
        .overall-progress {
            margin-bottom: 40px;
        }

        .overall-progress h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .progress-bar-wrapper {
            background: var(--progress-bg);
            height: 12px;
            border-radius: 6px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: var(--progress-fill);
            transition: width 0.5s ease-in-out;
        }

        .progress-text {
            font-size: 14px;
            text-align: right;
            margin-top: 8px;
            font-weight: 600;
        }

        /* Lecciones Completadas */
        .lessons-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        @media (min-width: 600px) {
            .lessons-list {
                grid-template-columns: 1fr 1fr;
            }
        }

        .lesson-item {
            background: rgba(255, 255, 255, 0.08);
            padding: 18px;
            border-radius: 14px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            transition: transform 0.2s ease;
        }

        .lesson-item:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.12);
        }

        .lesson-name {
            font-weight: 700;
            font-size: 16px;
            color: var(--primary-text);
        }

        .completion-date {
            font-size: 13px;
            color: var(--secondary-text);
        }

        .no-lessons {
            text-align: center;
            padding: 25px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
        }

        .start-btn {
            display: inline-block;
            background: var(--accent-btn);
            color: #0A2463;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            margin-top: 15px;
            transition: background 0.3s ease;
        }

        .start-btn:hover {
            background: #fff;
        }

        /* Próximas Recompensas */
        .rewards {
            margin-top: 50px;
            text-align: center;
            padding: 30px 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
        }

        .rewards h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .rewards p {
            font-size: 15px;
            color: var(--secondary-text);
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header> 
    <!-- Hero -->
    <div class="hero">
        <h1>🎯 Tu Progreso en LESSA</h1>
        <p>Mide tu aprendizaje, repasa tus logros y prepárate para ganar recompensas.</p>
        <a href="{{ route('lecciones') }}" class="start-btn">Seguir Aprendiendo</a>
    </div>

    <!-- Progreso -->
    <div class="progress-container">
        <div class="overall-progress">
            <h3>Progreso General</h3>
            <div class="progress-bar-wrapper">
                <div class="progress-bar" style="width: {{ $porcentaje }}%;"></div>
            </div>
            <div class="progress-text">{{ $porcentaje }}% Completado</div>
        </div>

        <!-- Lecciones -->
        <div class="completed-lessons">
            <h3 class="section-title">Lecciones Completadas</h3>
            <div class="overall-progress" style="margin-bottom: 30px;">
                <h3>Progreso de Lecciones</h3>
                <div class="progress-bar-wrapper">
                    <div class="progress-bar" style="width: {{ $porcentajeLecciones }}%;"></div> 
                </div>
                <div class="progress-text">{{ $porcentajeLecciones }}% Completado</div>
            </div>
            @if ($leccionesCompletadas->isEmpty())
                <div class="no-lessons">
                    <p>Aún no has completado ninguna lección. ¡Comienza a aprender hoy mismo! ✨</p>
                    <a href="{{ route('lecciones') }}" class="start-btn">Explorar Lecciones</a>
                </div>
            @else
                <ul class="lessons-list">
                    @foreach ($leccionesCompletadas as $progreso)
                        <li class="lesson-item">
                            <span class="lesson-name">{{ $progreso->leccion->titulo }}</span>
                            <span class="completion-date">✅ Completado el: {{ \Carbon\Carbon::parse($progreso->fecha_completada)->format('d/m/Y') }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>


        <div class="completed-levels" style="margin-top: 50px;">
            <h3 class="section-title">Minijuegos Completados (Niveles) 🎮</h3>
            
            <div class="overall-progress" style="margin-bottom: 30px;">
                <h3>Progreso de Minijuegos</h3>
                <div class="progress-bar-wrapper">
                    <div class="progress-bar" style="width: {{ $porcentajeNiveles }}%;"></div> 
                </div>
                <div class="progress-text">{{ $porcentajeNiveles }}% Completado</div>
            </div>

            @if ($nivelesCompletados->isEmpty())
                <div class="no-lessons">
                    <p>Aún no has completado ningún minijuego. ¡Demuestra tu dominio! 💪</p>
                    <a href="{{ route('practicar') }}" class="start-btn">Explorar Minijuegos</a>
                </div>
            @else
                <ul class="lessons-list">
                    @foreach ($nivelesCompletados as $nivel)
                        <li class="lesson-item">
                            <span class="lesson-name">{{ $nivel->nombre }}</span>
                            <span class="completion-date">
                                🏆 Puntos obtenidos: {{ $nivel->puntos_obtenidos }}
                            </span>
                            <span class="completion-date">
                                Finalizado el: {{ \Carbon\Carbon::parse($nivel->fecha_finalizado)->format('d/m/Y') }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Próximas Recompensas -->
        <div class="rewards">
            @php
            // Recorrer la bd y mostrar las recompensas de la bd
            use App\Models\Recompensa;
            $recompensas = Recompensa::all();
            @endphp
            @if ($recompensas->isEmpty())
                <h3>🏆 Próximas Recompensas</h3>
                <p>Muy pronto podrás desbloquear logros y recompensas por tu progreso en LESSA.</p>
            @else
                <h3>🏆 Tus Recompensas</h3>
                <ul class="lessons-list">
                    @foreach ($recompensas as $recompensa)
                        <li class="lesson-item">
                            <span class="lesson-name">{{ $recompensa->nombre }}</span>
                            <span class="completion-date">{{ $recompensa->descripcion }}</span>
                            <span class="completion-date">Requiere: {{ $recompensa->puntos_req }} puntos</span>
                            <img src="{{ asset('' . $recompensa->url_imagen) }}" alt="{{ $recompensa->nombre }}" style="width: 50%; border-radius: 8px; margin-top: 10px;">
                        </li>
                    @endforeach
            @endif
        </div>
    </div>
    <footer>@include('partials.footer')</footer>
</body>

</html>
