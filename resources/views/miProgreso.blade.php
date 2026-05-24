<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Progreso - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* --- 1. VARIABLES Y ESTILOS BASE (Coincide con home.blade.php) --- */
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #eff6ff;
            --accent-color: #f97316;
            --accent-hover: #ea580c;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --text-main: #1f2937;
            --text-secondary: #6b7280;
            --bg-body: #f3f4f6;
            --bg-card: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
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
            padding: 3rem 0 5rem;
            position: relative;
            border-radius: 0 0 var(--radius-xl) var(--radius-xl);
            overflow: hidden;
            text-align: center;
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }

        .hero-subtitle {
            font-size: 1.125rem;
            max-width: 800px;
            margin: 0 auto;
            opacity: 0.9;
            font-weight: 300;
            padding: 0 1rem;
        }

        .btn-hero {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--bg-card);
            color: var(--primary-color);
            padding: 0.75rem 2rem;
            border-radius: var(--radius-full);
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition-base);
            box-shadow: var(--shadow-md);
            margin-top: 1.5rem;
            text-decoration: none;
        }

        .btn-hero:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
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

        /* --- PROGRESS CARD --- */
        .progress-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-lg);
            margin-bottom: 3rem;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 700;
            color: var(--text-main);
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .progress-bar-bg {
            background-color: #e5e7eb;
            border-radius: var(--radius-full);
            height: 16px;
            overflow: hidden;
            width: 100%;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        }

        .progress-bar-fill {
            background: linear-gradient(90deg, var(--success-color), #34d399);
            height: 100%;
            border-radius: var(--radius-full);
            width: 0%;
            transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.3);
        }

        .progress-text {
            text-align: right;
            font-size: 0.9rem;
            color: var(--success-color);
            font-weight: 600;
            margin-top: 0.5rem;
        }

        /* --- SECTIONS --- */
        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title i {
            color: var(--accent-color);
        }

        .grid-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        /* --- ITEM CARDS --- */
        .item-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            transition: var(--transition-base);
            border-left: 4px solid var(--primary-color);
            position: relative;
            overflow: hidden;
        }

        .item-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .item-card.completed {
            border-left-color: var(--success-color);
        }

        .item-card.reward {
            border-left-color: var(--accent-color);
            flex-direction: row;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
        }

        .item-name {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--text-main);
        }

        .item-meta {
            font-size: 0.9rem;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .reward-img {
            width: 64px;
            height: 64px;
            border-radius: var(--radius-lg);
            object-fit: cover;
            background: #f1f5f9;
        }

        .reward-status {
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.25rem 0.75rem;
            border-radius: var(--radius-full);
            text-transform: uppercase;
            display: inline-block;
        }

        .status-unlocked {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .status-locked {
            background: #f3f4f6;
            color: var(--text-secondary);
        }

        .empty-state {
            grid-column: 1 / -1;
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 3rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            border: 2px dashed #e5e7eb;
        }

        .empty-state p {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        /* --- CERTIFICATE SECTION --- */
        .certificate-card {
            background: linear-gradient(135deg, #1e3a5f 0%, #2a5298 50%, #1e3a5f 100%);
            border-radius: var(--radius-xl);
            padding: 2.5rem;
            box-shadow: var(--shadow-lg);
            margin-bottom: 3rem;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .certificate-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(184, 134, 11, 0.1) 0%, transparent 60%);
            animation: certificateGlow 6s ease-in-out infinite;
        }

        @keyframes certificateGlow {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(5%, 5%); }
        }

        .certificate-card-content {
            position: relative;
            z-index: 1;
        }

        .certificate-icon {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            color: #b8860b;
            text-shadow: 0 0 20px rgba(184, 134, 11, 0.4);
        }

        .certificate-title-main {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #ffffff;
        }

        .certificate-description {
            font-size: 0.95rem;
            opacity: 0.85;
            margin-bottom: 1.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .certificate-progress-info {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.5rem 1.5rem;
            border-radius: var(--radius-full);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .certificate-progress-info i {
            color: #b8860b;
        }

        .btn-certificate {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.9rem 2.5rem;
            border-radius: var(--radius-full);
            font-weight: 700;
            font-size: 1.05rem;
            border: none;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .btn-certificate.active {
            background: linear-gradient(135deg, #b8860b, #daa520, #b8860b);
            color: #1e3a5f;
            box-shadow: 0 4px 15px rgba(184, 134, 11, 0.4);
        }

        .btn-certificate.active:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 25px rgba(184, 134, 11, 0.5);
        }

        .btn-certificate.active::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent 30%,
                rgba(255, 255, 255, 0.3) 50%,
                transparent 70%
            );
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .btn-certificate.disabled {
            background: rgba(255, 255, 255, 0.15);
            color: rgba(255, 255, 255, 0.5);
            cursor: not-allowed;
            border: 1px dashed rgba(255, 255, 255, 0.3);
        }

        .btn-certificate.disabled:hover {
            transform: none;
            box-shadow: none;
        }

        .certificate-check-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .check-item {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            padding: 0.35rem 0.85rem;
            border-radius: var(--radius-full);
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .check-item.done {
            color: #34d399;
            border-color: rgba(52, 211, 153, 0.3);
            background: rgba(52, 211, 153, 0.1);
        }

        .check-item.pending {
            color: rgba(255, 255, 255, 0.5);
            border-color: rgba(255, 255, 255, 0.1);
        }

        /* --- MODALS --- */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .modal-backdrop.show {
            opacity: 1;
            visibility: visible;
        }

        .custom-modal {
            background: var(--bg-card);
            width: 100%;
            max-width: 450px;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            padding: 2rem;
            text-align: center;
            transform: scale(0.95);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }

        .modal-backdrop.show .custom-modal {
            transform: scale(1);
        }

        .modal-close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: var(--text-secondary);
            cursor: pointer;
            transition: color 0.2s;
        }

        .modal-close-btn:hover {
            color: var(--danger-color);
        }

        .modal-img-large {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1.5rem;
            border: 4px solid var(--bg-body);
            box-shadow: var(--shadow-md);
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .modal-desc {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .modal-meta {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        .btn-modal {
            display: inline-block;
            width: 100%;
            padding: 0.75rem;
            border-radius: var(--radius-full);
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition-base);
            text-decoration: none;
            font-size: 1rem;
        }

        .btn-modal.primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-modal.primary:hover {
            background: var(--primary-dark);
        }

        .btn-modal.secondary {
            background: var(--bg-body);
            color: var(--text-main);
        }

        .btn-modal.secondary:hover {
            background: #e5e7eb;
        }

        .btn-modal.success {
            background: var(--success-color);
            color: white;
            cursor: default;
        }

        .btn-modal.locked {
            background: var(--text-secondary);
            color: white;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0 5rem;
            }

            .hero-title {
                font-size: 2rem;
            }

            .progress-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;">
            <h1 class="hero-title">Tu Progreso en LESSA</h1>
            <p class="hero-subtitle">Mide tu aprendizaje, repasa tus logros y prepárate para ganar recompensas.</p>
            <a href="{{ route('lecciones') }}" class="btn-hero">
                Seguir Aprendiendo <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>

    <main class="main-container">

        <!-- Global Progress -->
        <div class="progress-card">
            <div class="progress-header">
                <span>Progreso General</span>
                <span>{{ $porcentaje }}%</span>
            </div>
            <div class="progress-bar-bg">
                <div class="progress-bar-fill" style="width: {{ $porcentaje }}%;"></div>
            </div>
            <div class="progress-text">{{ $porcentaje }}% Completado</div>
        </div>

        <!-- Completed Lessons -->
        <h3 class="section-title"><i class="fas fa-book-open"></i> Lecciones Completadas</h3>
        <div class="grid-list">
            @if ($leccionesCompletadas->isEmpty())
                <div class="empty-state">
                    <p>Aún no has completado ninguna lección. ¡Comienza hoy mismo!</p>
                    <a href="{{ route('lecciones') }}" class="btn-modal primary" style="width: auto; padding: 0.75rem 2rem;">Explorar Lecciones</a>
                </div>
            @else
                @foreach ($leccionesCompletadas as $progreso)
                    <div class="item-card completed">
                        <div class="item-name">{{ $progreso->leccion->titulo }}</div>
                        <div class="item-meta">
                            <i class="fas fa-check-circle" style="color: var(--success-color);"></i>
                            Completado: {{ \Carbon\Carbon::parse($progreso->fecha_completada)->format('d/m/Y') }}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Completed Levels (Minigames) -->
        <h3 class="section-title"><i class="fas fa-gamepad"></i> Minijuegos Completados</h3>
        <div class="grid-list">
            @if ($nivelesCompletados->isEmpty())
                <div class="empty-state">
                    <p>Aún no has completado ningún minijuego. ¡Demuestra tu destreza!</p>
                    <a href="{{ route('practicar') }}" class="btn-modal primary" style="width: auto; padding: 0.75rem 2rem;">Ir a Practicar</a>
                </div>
            @else
                @foreach ($nivelesCompletados as $nivel)
                    <div class="item-card completed">
                        <div class="item-name">{{ $nivel->nombre }}</div>
                        <div class="item-meta">
                            <i class="fas fa-star" style="color: var(--warning-color);"></i>
                            Puntos: {{ $nivel->puntos_obtenidos }}
                        </div>
                        <div class="item-meta">
                            <i class="fas fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($nivel->fecha_finalizado)->format('d/m/Y') }}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Rewards -->
        <h3 class="section-title"><i class="fas fa-medal"></i> Tus Recompensas</h3>
        @php
            use App\Models\Recompensa;
            use App\Models\RecompensasUsuario;
            $recompensas = Recompensa::all();
            $recompensasDesbloqueadas = auth()->user() 
                ? RecompensasUsuario::where('usuario_id', auth()->user()->id)->pluck('recompensa_id')->toArray() 
                : [];
        @endphp

        <div class="grid-list">
            @if ($recompensas->isEmpty())
                <div class="empty-state">
                    <p>Pronto habrá recompensas disponibles.</p>
                </div>
            @else
                @foreach ($recompensas as $recompensa)
                    @php
                        $isUnlocked = in_array($recompensa->id, $recompensasDesbloqueadas);
                        $statusClass = $isUnlocked ? 'status-unlocked' : 'status-locked';
                        $statusText = $isUnlocked ? 'Desbloqueada' : 'Bloqueada';
                    @endphp
                    <div class="item-card reward"
                        data-id="{{ $recompensa->id }}"
                        data-nombre="{{ $recompensa->nombre }}"
                        data-descripcion="{{ $recompensa->descripcion }}"
                        data-puntos="{{ $recompensa->puntos_req }}"
                        data-url="{{ asset($recompensa->url_imagen) }}"
                        data-unlocked="{{ $isUnlocked ? 1 : 0 }}"
                        onclick="openRewardModal(this)">
                        
                        <img src="{{ asset($recompensa->url_imagen) }}" alt="{{ $recompensa->nombre }}" class="reward-img">
                        
                        <div style="flex: 1;">
                            <div class="item-name">{{ $recompensa->nombre }}</div>
                            <div class="item-meta" style="margin-bottom: 0.5rem;">{{ $recompensa->puntos_req }} Puntos</div>
                            <span class="reward-status {{ $statusClass }}">{{ $statusText }}</span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Certificate Section -->
        @php
            $leccionesIds = [1, 2, 3, 4];
            $leccionesNombres = [
                1 => 'Abecedario',
                2 => 'Números',
                3 => 'Saludos',
                4 => 'Salud',
            ];
            $completadasIds = $leccionesCompletadas->pluck('leccion_id')->toArray();
            $todasCompletadas = count(array_intersect($leccionesIds, $completadasIds)) === 4;
        @endphp

        <h3 class="section-title"><i class="fas fa-certificate"></i> Tu Certificado</h3>
        <div class="certificate-card">
            <div class="certificate-card-content">
                <div class="certificate-icon">
                    <i class="fas fa-award"></i>
                </div>
                <h3 class="certificate-title-main">
                    @if($todasCompletadas)
                        ¡Felicidades! Tu certificado está listo
                    @else
                        Certificado de Aprobación LESSA
                    @endif
                </h3>
                <p class="certificate-description">
                    @if($todasCompletadas)
                        Has completado todas las lecciones del curso. Descarga tu diploma oficial avalado por la Universidad Gerardo Barrios y el MINED.
                    @else
                        Completa todas las lecciones del curso para obtener tu certificado oficial de aprobación en Lengua de Señas Salvadoreña.
                    @endif
                </p>

                <!-- Checklist de lecciones -->
                <div class="certificate-check-list">
                    @foreach($leccionesIds as $lid)
                        @php
                            $completada = in_array($lid, $completadasIds);
                        @endphp
                        <span class="check-item {{ $completada ? 'done' : 'pending' }}">
                            <i class="fas {{ $completada ? 'fa-check-circle' : 'fa-circle' }}"></i>
                            {{ $leccionesNombres[$lid] }}
                        </span>
                    @endforeach
                </div>

                <div class="certificate-progress-info">
                    <i class="fas fa-tasks"></i>
                    <span>{{ count(array_intersect($leccionesIds, $completadasIds)) }} de 4 lecciones completadas</span>
                </div>

                @if($todasCompletadas)
                    <a href="{{ route('certificado.descargar') }}" class="btn-certificate active">
                        <i class="fas fa-download"></i>
                        Descargar Certificado PDF
                    </a>
                @else
                    <button class="btn-certificate disabled" onclick="mostrarMensajeCertificado()" type="button">
                        <i class="fas fa-lock"></i>
                        Certificado Bloqueado
                    </button>
                @endif
            </div>
        </div>

    </main>

    <!-- Reward Modal -->
    <div id="rewardModal" class="modal-backdrop">
        <div class="custom-modal">
            <button class="modal-close-btn" onclick="closeRewardModal()">&times;</button>
            <img id="modal-img" src="" alt="" class="modal-img-large">
            <h3 id="modal-title" class="modal-title"></h3>
            <p id="modal-desc" class="modal-desc"></p>
            <div id="modal-puntos" class="modal-meta"></div>
            <button id="modal-btn" class="btn-modal" onclick="claimReward()"></button>
        </div>
    </div>

    <!-- Result Modal -->
    <div id="resultModal" class="modal-backdrop">
        <div class="custom-modal">
            <button class="modal-close-btn" onclick="closeResultModal()">&times;</button>
            <h3 id="result-modal-title" class="modal-title"></h3>
            <p id="result-modal-message" class="modal-desc"></p>
            <button id="result-modal-btn" class="btn-modal" onclick="handleResultAction()"></button>
        </div>
    </div>

    <footer>@include('partials.footer')</footer>

    @php
        $rewardResult = session('reward_result');
        if (!is_array($rewardResult)) {
            $rewardResult = null;
        }
    @endphp

    <script>
        const rewardModal = document.getElementById('rewardModal');
        const modalTitle = document.getElementById('modal-title');
        const modalDesc = document.getElementById('modal-desc');
        const modalPuntos = document.getElementById('modal-puntos');
        const modalImg = document.getElementById('modal-img');
        const modalBtn = document.getElementById('modal-btn');
        let currentRewardId = null;

        const resultModal = document.getElementById('resultModal');
        const resultModalTitle = document.getElementById('result-modal-title');
        const resultModalMessage = document.getElementById('result-modal-message');
        const resultModalBtn = document.getElementById('result-modal-btn');
        let currentActionRoute = null;

        // Certificate locked message
        function mostrarMensajeCertificado() {
            currentActionRoute = 'lecciones';
            resultModalTitle.textContent = '¡Certificado no disponible!';
            resultModalTitle.style.color = 'var(--text-secondary)';
            resultModalMessage.innerHTML = 'Debes completar las <strong>4 lecciones</strong> del curso (Abecedario, Números, Saludos y Salud) para poder descargar tu certificado de aprobación.';
            resultModalBtn.className = 'btn-modal primary';
            resultModalBtn.textContent = 'Ir a las Lecciones';
            resultModalBtn.onclick = handleResultAction;
            openModal(resultModal);
        }

        function openRewardModal(element) {
            const id = element.getAttribute('data-id');
            const nombre = element.getAttribute('data-nombre');
            const descripcion = element.getAttribute('data-descripcion');
            const puntos = element.getAttribute('data-puntos');
            const url = element.getAttribute('data-url');
            const unlocked = element.getAttribute('data-unlocked') === '1';

            currentRewardId = id;

            modalTitle.textContent = nombre;
            modalDesc.textContent = descripcion;
            modalPuntos.textContent = 'Requiere: ' + puntos + ' puntos';
            modalImg.src = url;

            modalBtn.className = 'btn-modal'; // Reset classes

            if (unlocked) {
                modalBtn.textContent = '¡Recompensa Desbloqueada!';
                modalBtn.disabled = true;
                modalBtn.classList.add('success');
            } else {
                modalBtn.textContent = 'Intentar Desbloquear';
                modalBtn.disabled = false;
                modalBtn.classList.add('primary');
            }

            openModal(rewardModal);
        }

        function closeRewardModal() {
            closeModal(rewardModal);
            currentRewardId = null;
        }

        function claimReward() {
            if (currentRewardId) {
                window.location.href = `/recompensas/desbloquear/${currentRewardId}`;
            }
        }

        function closeResultModal() {
            closeModal(resultModal);
            currentActionRoute = null;
        }

        function handleResultAction() {
            if (currentActionRoute && currentActionRoute !== 'miProgreso') {
                const routeMap = {
                    'lecciones': '{{ route("lecciones") }}',
                    'practicar': '{{ route("practicar") }}',
                };
                
                let finalUrl = currentActionRoute.includes('nivel.') 
                    ? routeMap['practicar'] || '#'
                    : routeMap[currentActionRoute] || '#';
                    
                window.location.href = finalUrl;
            } else {
                closeResultModal();
            }
        }

        function openModal(modal) {
            modal.style.visibility = 'visible';
            void modal.offsetWidth; // Force reflow
            modal.classList.add('show');
        }

        function closeModal(modal) {
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.visibility = 'hidden';
            }, 300);
        }

        // Close modals on outside click
        window.onclick = function(event) {
            if (event.target == rewardModal) closeRewardModal();
            if (event.target == resultModal) closeResultModal();
        }

        // Show result modal on load if session data exists
        document.addEventListener('DOMContentLoaded', () => {
            @if (!empty($rewardResult))
                const result = @json($rewardResult);
                const status = result.status;
                
                currentActionRoute = result.route;
                resultModalTitle.textContent = result.title;
                resultModalMessage.innerHTML = result.message;
                
                resultModalBtn.className = 'btn-modal'; // Reset

                switch(status) {
                    case 'success':
                        resultModalTitle.style.color = 'var(--success-color)';
                        resultModalBtn.textContent = '¡Ver Recompensas!';
                        resultModalBtn.classList.add('success');
                        resultModalBtn.onclick = () => closeResultModal();
                        break;
                    case 'locked':
                        resultModalTitle.style.color = 'var(--text-secondary)';
                        resultModalBtn.textContent = 'Ir a Practicar';
                        resultModalBtn.classList.add('primary');
                        resultModalBtn.onclick = handleResultAction;
                        if (result.puntos_req) {
                            resultModalMessage.innerHTML += `<br><br><strong>Puntos Requeridos:</strong> ${result.puntos_req}`;
                        }
                        break;
                    case 'info':
                        resultModalTitle.style.color = 'var(--primary-color)';
                        resultModalBtn.textContent = 'Entendido';
                        resultModalBtn.classList.add('primary');
                        resultModalBtn.onclick = () => closeResultModal();
                        break;
                    case 'error':
                    default:
                        resultModalTitle.style.color = 'var(--danger-color)';
                        resultModalBtn.textContent = 'Volver';
                        resultModalBtn.classList.add('secondary');
                        resultModalBtn.onclick = handleResultAction;
                        break;
                }
                
                openModal(resultModal);
            @endif
        });
    </script>
</body>

</html>