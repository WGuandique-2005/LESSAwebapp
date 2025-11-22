<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking Global - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        /* --- VARIABLES (Dark Theme adapted to new structure) --- */
        :root {
            --primary-dark: #0a2463;
            --primary-light: #1f3d82;
            --accent-gold: #FFD166;
            --accent-green: #41ff3f;
            --text-light: #e2e8f0;
            --text-muted: #94a3b8;
            --bg-body: #05163d; /* Fondo muy oscuro */
            --bg-card: rgba(31, 61, 130, 0.4);
            --bg-card-hover: rgba(31, 61, 130, 0.6);
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.4);
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
            color: var(--text-light);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- HERO SECTION --- */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #05102b 100%);
            padding: 3rem 0 5rem;
            position: relative;
            border-radius: 0 0 var(--radius-xl) var(--radius-xl);
            overflow: hidden;
            text-align: center;
            box-shadow: var(--shadow-lg);
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: linear-gradient(90deg, #fcd34d, var(--accent-gold), #fcd34d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
            font-weight: 300;
        }

        /* --- MAIN CONTAINER --- */
        .main-container {
            width: 100%;
            max-width: 1000px;
            margin: -4rem auto 0;
            padding: 0 1.5rem 4rem;
            position: relative;
            z-index: 10;
        }

        /* --- RANKING CARD --- */
        .ranking-card {
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-lg);
        }

        /* --- TABLE STYLES --- */
        .ranking-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 0.75rem;
        }

        .ranking-table thead th {
            text-transform: uppercase;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--accent-green);
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .ranking-table tbody tr {
            background: rgba(255, 255, 255, 0.05);
            transition: var(--transition-base);
            cursor: pointer;
        }

        .ranking-table tbody tr:hover {
            transform: translateY(-3px);
            background: var(--bg-card-hover);
            box-shadow: var(--shadow-sm);
        }

        .ranking-table td {
            padding: 1.25rem 1rem;
            vertical-align: middle;
            font-weight: 500;
        }

        .ranking-table tbody tr td:first-child {
            border-top-left-radius: var(--radius-lg);
            border-bottom-left-radius: var(--radius-lg);
        }

        .ranking-table tbody tr td:last-child {
            border-top-right-radius: var(--radius-lg);
            border-bottom-right-radius: var(--radius-lg);
        }

        /* --- RANK BADGES --- */
        .rank-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            font-weight: 700;
            font-size: 1rem;
        }

        .rank-1 { background: linear-gradient(135deg, #FFD700, #FFC72C); color: #000; }
        .rank-2 { background: linear-gradient(135deg, #C0C0C0, #E0E0E0); color: #000; }
        .rank-3 { background: linear-gradient(135deg, #CD7F32, #B87333); color: #fff; }
        .rank-other { background: rgba(255, 255, 255, 0.1); color: var(--text-light); }

        /* --- USER INFO --- */
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--accent-gold);
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            text-transform: uppercase;
        }

        .user-name {
            font-weight: 600;
            font-size: 1.05rem;
        }

        .points-badge {
            background: rgba(65, 255, 63, 0.1);
            color: var(--accent-green);
            padding: 0.25rem 0.75rem;
            border-radius: var(--radius-full);
            font-weight: 700;
            font-size: 0.9rem;
        }

        /* --- EMPTY STATE --- */
        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
            color: var(--text-muted);
        }

        /* --- MODAL --- */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(8px);
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

        .modal-content {
            background: #0f2350;
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
            max-width: 500px;
            border-radius: var(--radius-xl);
            padding: 2rem;
            position: relative;
            transform: scale(0.95);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }

        .modal-backdrop.show .modal-content {
            transform: scale(1);
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.2s;
        }

        .modal-close:hover {
            color: var(--accent-gold);
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-gold);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .rewards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 1rem;
        }

        .reward-item {
            background: rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-lg);
            padding: 1rem;
            text-align: center;
            transition: var(--transition-base);
            border: 1px solid transparent;
        }

        .reward-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
            border-color: var(--accent-gold);
        }

        .reward-img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 0.5rem;
        }

        .reward-name {
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            line-height: 1.2;
        }

        .reward-pts {
            font-size: 0.75rem;
            color: var(--accent-gold);
            font-weight: 700;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0 5rem;
            }

            .hero-title {
                font-size: 2rem;
            }

            .ranking-table thead {
                display: none;
            }

            .ranking-table, .ranking-table tbody, .ranking-table tr, .ranking-table td {
                display: block;
                width: 100%;
            }

            .ranking-table tr {
                margin-bottom: 1rem;
                background: rgba(255, 255, 255, 0.08);
                border-radius: var(--radius-lg);
                padding: 1rem;
            }

            .ranking-table td {
                padding: 0.5rem 0;
                text-align: right;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .ranking-table td::before {
                content: attr(data-label);
                font-weight: 700;
                color: var(--accent-green);
                font-size: 0.85rem;
                text-transform: uppercase;
            }

            .ranking-table tbody tr td:first-child {
                border-radius: 0;
                justify-content: center;
                font-size: 1.25rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid rgba(255,255,255,0.1);
                margin-bottom: 0.5rem;
            }
            
            .ranking-table tbody tr td:first-child::before {
                display: none;
            }

            .ranking-table tbody tr td:last-child {
                border-radius: 0;
            }

            .user-info {
                justify-content: flex-end;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>

    <section class="hero-section">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;">
            <h1 class="hero-title">Ranking de Jugadores</h1>
            <p class="hero-subtitle">¡Compite y escala posiciones! Haz clic en un jugador para ver sus trofeos.</p>
        </div>
    </section>

    <main class="main-container">
        <div class="ranking-card">
            @if(isset($ranking) && $ranking->count())
                <table class="ranking-table">
                    <thead>
                        <tr>
                            <th style="width: 10%; text-align: center;">Pos</th>
                            <th style="width: 50%;">Usuario</th>
                            <th style="width: 20%; text-align: center;">Puntos</th>
                            <th style="width: 20%; text-align: right;">Fecha Récord</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ranking as $index => $row)
                            @php
                                $initial = strtoupper(substr($row->username, 0, 1));
                                $rank = $index + 1;
                                $rankClass = 'rank-other';
                                if ($rank == 1) $rankClass = 'rank-1';
                                elseif ($rank == 2) $rankClass = 'rank-2';
                                elseif ($rank == 3) $rankClass = 'rank-3';
                                
                                $achievedAt = $row->achieved_at ? \Carbon\Carbon::parse($row->achieved_at)->format('d/m/Y') : '-';
                            @endphp
                            <tr onclick="openModal('user-modal-{{ $row->usuario_id }}')">
                                <td data-label="Posición" style="text-align: center;">
                                    <div class="rank-badge {{ $rankClass }}">{{ $rank }}</div>
                                </td>
                                <td data-label="Usuario">
                                    <div class="user-info">
                                        <div class="user-avatar">{{ $initial }}</div>
                                        <span class="user-name">{{ $row->username }}</span>
                                    </div>
                                </td>
                                <td data-label="Puntos" style="text-align: center;">
                                    <span class="points-badge">{{ number_format($row->total_points, 0, ',', '.') }}</span>
                                </td>
                                <td data-label="Fecha" style="text-align: right;">
                                    {{ $achievedAt }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <h3>¡Sé el primero!</h3>
                    <p>Aún no hay datos en el ranking. Completa lecciones para aparecer aquí.</p>
                </div>
            @endif
        </div>
    </main>

    <!-- Modals -->
    @if(isset($ranking) && $ranking->count())
        @foreach($ranking as $row)
            <div id="user-modal-{{ $row->usuario_id }}" class="modal-backdrop">
                <div class="modal-content">
                    <button class="modal-close" onclick="closeModal('user-modal-{{ $row->usuario_id }}')">&times;</button>
                    <h3 class="modal-title">Trofeos de {{ $row->username }}</h3>

                    @if($row->rewards && $row->rewards->count())
                        <div class="rewards-grid">
                            @foreach($row->rewards as $rewardEntry)
                                <div class="reward-item">
                                    <img src="{{ asset($rewardEntry->recompensa->url_imagen) }}" 
                                         alt="{{ $rewardEntry->recompensa->nombre }}" 
                                         class="reward-img">
                                    <div class="reward-name">{{ $rewardEntry->recompensa->nombre }}</div>
                                    <div class="reward-pts">{{ $rewardEntry->recompensa->puntos_req }} pts</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p style="text-align: center; color: var(--text-muted);">
                            Este usuario aún no ha desbloqueado recompensas.
                        </p>
                    @endif
                </div>
            </div>
        @endforeach
    @endif

    <footer>@include('partials.footer')</footer>

    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.visibility = 'visible';
                // Force reflow
                void modal.offsetWidth;
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('show');
                setTimeout(() => {
                    modal.style.visibility = 'hidden';
                    document.body.style.overflow = '';
                }, 300);
            }
        }

        // Close on click outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal-backdrop')) {
                closeModal(event.target.id);
            }
        }
    </script>
</body>
</html>