<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking Top 10</title>
    <style>
        /* --- Estilos Generales --- */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: linear-gradient(170deg, #f4f7f6 0%, #eef3f1 100%);
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.07), 0 4px 6px -2px rgba(0,0,0,0.05);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2.4em;
            font-weight: 700;
            /* ✨ CAMBIO: Texto con gradiente llamativo */
            background: linear-gradient(45deg, #3498db, #2c3e50);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* --- Estilos de la Tabla de Ranking --- */
        .ranking-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
            margin-top: 20px;
        }
        .ranking-table th {
            background-color: #f8f8f8;
            font-weight: 600;
            padding: 12px 15px;
            text-align: left;
            color: #555;
        }
        .ranking-table td {
            padding: 12px 15px;
            text-align: left;
            background-color: #fff;
            border-bottom: 1px solid #eee;
        }
        .ranking-table tr > td:first-child { border-radius: 8px 0 0 8px; }
        .ranking-table tr > td:last-child { border-radius: 0 8px 8px 0; }
        
        .ranking-table tbody tr {
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
            position: relative;
        }
        .ranking-table tbody tr:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            z-index: 10;
            background-color: #fff;
        }
        .ranking-table td:first-child {
            font-weight: bold;
            color: #3498db;
            width: 60px;
            font-size: 1.1em;
        }
        
        .user-cell { display: flex; align-items: center; }
        .avatar-initial {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1em;
            margin-right: 12px;
            text-transform: uppercase;
            /* ✨ CAMBIO: Sombra sutil en el avatar */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .avatar-initial[data-initial="A"] { background-color: #e74c3c; }
        .avatar-initial[data-initial="B"] { background-color: #3498db; }
        .avatar-initial[data-initial="C"] { background-color: #2ecc71; }
        .avatar-initial[data-initial="D"] { background-color: #f1c40f; }
        .avatar-initial[data-initial="E"] { background-color: #9b59b6; }
        .avatar-initial[data-initial="F"] { background-color: #1abc9c; }
        
        
        .rank-icon {
            display: none;
            font-size: 0.8em;
            margin-left: 4px;
        }

        .rank-gold td {
            background-color: #fffbeb;
        }
        .rank-gold td:first-child {
            color: #d4af37;
            font-size: 1.3em;
            font-weight: 900;
        }
        .rank-gold .rank-icon::before { content: '🏆'; display: inline-block; }
        
        .rank-silver td {
            background-color: #fafafa;
        }
        .rank-silver td:first-child {
            color: #b0b0b0;
            font-size: 1.2em;
            font-weight: 800;
        }
        .rank-silver .rank-icon::before { content: '🥈'; display: inline-block; }
        
        .rank-bronze td {
            background-color: #fdf8f4;
        }
        .rank-bronze td:first-child {
            color: #cd7f32;
            font-size: 1.15em;
            font-weight: 700;
        }
        .rank-bronze .rank-icon::before { content: '🥉'; display: inline-block; }

        .rank-gold .rank-icon, .rank-silver .rank-icon, .rank-bronze .rank-icon {
            display: inline;
        }
        

        /* --- Estilos del Modal (Ventana Emergente) --- */
        .modal-overlay {
            position: fixed; top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: none; align-items: center; justify-content: center;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .modal-overlay.active { display: flex; opacity: 1; }
        
        .modal-content {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
            transform: translateY(-20px) scale(0.95);
            opacity: 0;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.3s ease;
        }
        .modal-overlay.active .modal-content {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
        .modal-close {
            position: absolute; top: 15px; right: 15px;
            font-size: 1.5em; font-weight: bold; color: #888;
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        .modal-close:hover { transform: scale(1.1) rotate(90deg); }
        
        .modal-content h3 {
            margin-top: 0;
            color: #2c3e50;
        }

        /* --- Estilos de las Recompensas (Grid) --- */
        .rewards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        .reward-card {
            border: 1px solid #eee;
            border-radius: 8px;
            text-align: center;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            background: #f9f9f9;
            /* ✨ CAMBIO: Transición para hover */
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .reward-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.08);
        }
        .reward-card img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .reward-card h4 {
            font-size: 0.9em;
            margin: 5px 0;
            font-weight: 600;
        }
        .reward-card p {
            font-size: 0.8em;
            color: #555;
            margin: 0;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <header>@include('partials.navbar')</header>

    <div class="container">
        <h1>Ranking - Top 10</h1>

        @if(isset($ranking) && $ranking->count())
            <table class="ranking-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
                        <th>Puntos</th>
                        <th>Fecha alcanzado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ranking as $index => $row)
                        @php
                            $initial = strtoupper(substr($row->username, 0, 1));
                            
                            $rank = $index + 1;
                            $rankClass = '';
                            if ($rank == 1) $rankClass = 'rank-gold';
                            if ($rank == 2) $rankClass = 'rank-silver';
                            if ($rank == 3) $rankClass = 'rank-bronze';
                        @endphp
                        
                        <tr class="clickable-row {{ $rankClass }}" data-modal-target="#user-modal-{{ $row->usuario_id }}">
                            
                            <td>{{ $rank }} <span class="rank-icon"></span></td>
                            
                            <td>
                                <div class="user-cell">
                                    <div class="avatar-initial" data-initial="{{ $initial }}">{{ $initial }}</div>
                                    <span>{{ $row->username }}</span>
                                </div>
                            </td>
                            <td>{{ $row->total_points }}</td>
                            <td>{{ $row->achieved_at ? \Carbon\Carbon::parse($row->achieved_at)->format('Y-m-d H:i') : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay datos de ranking todavía.</p>
        @endif
    </div>

    @if(isset($ranking) && $ranking->count())
        @foreach($ranking as $row)
            <div id="user-modal-{{ $row->usuario_id }}" class="modal-overlay">
                <div class="modal-content">
                    <span class="modal-close" data-modal-close="#user-modal-{{ $row->usuario_id }}">&times;</span>
                    <h3>Recompensas de {{ $row->username }}</h3>

                    @if($row->rewards && $row->rewards->count())
                        <div class="rewards-grid">
                            @foreach($row->rewards as $rewardEntry)
                                <div class="reward-card">
                                    <img src="{{ $rewardEntry->recompensa->url_imagen }}" alt="{{ $rewardEntry->recompensa->nombre }}">
                                    <h4>{{ $rewardEntry->recompensa->nombre }}</h4>
                                    <p>{{ $rewardEntry->recompensa->puntos_req }} pts</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>Este usuario aún no ha desbloqueado recompensas.</p>
                    @endif
                </div>
            </div>
        @endforeach
    @endif


    <footer>@include('partials.footer')</footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Abrir modal
            document.querySelectorAll('.clickable-row').forEach(row => {
                row.addEventListener('click', function() {
                    const modalId = this.getAttribute('data-modal-target');
                    const modal = document.querySelector(modalId);
                    if (modal) {
                        modal.classList.add('active');
                    }
                });
            });

            document.querySelectorAll('.modal-close').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.modal-overlay').classList.remove('active');
                });
            });

            document.querySelectorAll('.modal-overlay').forEach(overlay => {
                overlay.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.remove('active');
                    }
                });
            });
        });
    </script>

</body>
</html>