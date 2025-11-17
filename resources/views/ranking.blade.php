<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking Top 10</title>
    <style>
        /* --- Estilos Generales --- */
        body {
            font-family: "Poppins", sans-serif;
            background: #0a2463;
            color: #e2e8f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 20px;
            background: rgba(31, 61, 130, 0.54);
            backdrop-filter: blur(15px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }

        h1 {
            text-align: center;
            font-size: 2.7em;
            font-weight: 800;
            margin-bottom: 25px;
            background: #FFD166;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 1px;
        }

        /* --- Estilos de la Tabla de Ranking --- */
        .ranking-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
            border-radius: 12px;
        }

        .ranking-table thead th {
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            color: #22c71fff;
            padding-bottom: 10px;
        }

        .ranking-table tbody tr {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(6px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
            border-radius: 12px;
            transition: 0.25s ease;
            cursor: pointer;
        }

        .ranking-table tbody tr:hover {
            transform: translateY(-4px);
            box-shadow: rgba(0, 0, 0, 0.35);
            border-radius: 12px;
        }

        .ranking-table td {
            padding: 20px 20px;
        }

        .rank-gold {
            background: linear-gradient(135deg, #fef9c3, #fde047);
            color: #854d0e !important;
        }

        .rank-silver {
            background: linear-gradient(135deg, #f1f5f9, #cbd5e1);
            color: #334155 !important;
        }

        .rank-bronze {
            background: linear-gradient(135deg, #fef3c7, #fcd34d);
            color: #92400e !important;
        }

        .rank-icon {
            margin-left: 6px;
        }

        .avatar-initial {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            margin-right: 12px;
            font-size: 1.1em;
            color: white;
            text-transform: uppercase;
            background: #FFD166;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.75);
            display: none;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(6px);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            width: 90%;
            max-width: 550px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.35);
            animation: modalPop 0.35s ease forwards;
            color: white;
        }

        @keyframes modalPop {
            from {
                transform: scale(0.85);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal-close {
            position: absolute;
            top: 18px;
            right: 22px;
            font-size: 1.8em;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .modal-close:hover {
            transform: scale(1.2) rotate(90deg);
            color: #f472b6;
        }

        /* ----RECOMPENSAS----- */
        .rewards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 18px;
            margin-top: 20px;
        }

        .reward-card {
            background: rgba(255, 255, 255, 0.10);
            border-radius: 15px;
            padding: 12px;
            text-align: center;
            transition: 0.25s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        }

        .reward-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.35);
        }

        .reward-card img {
            width: 90px;
            height: 90px;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 10px;
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
                            if ($rank == 1)
                                $rankClass = 'rank-gold';
                            if ($rank == 2)
                                $rankClass = 'rank-silver';
                            if ($rank == 3)
                                $rankClass = 'rank-bronze';
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
                            <td>{{ $row->achieved_at ? \Carbon\Carbon::parse($row->achieved_at)->format('Y-m-d H:i') : '-' }}
                            </td>
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
        document.addEventListener('DOMContentLoaded', function () {
            // Abrir modal
            document.querySelectorAll('.clickable-row').forEach(row => {
                row.addEventListener('click', function () {
                    const modalId = this.getAttribute('data-modal-target');
                    const modal = document.querySelector(modalId);
                    if (modal) {
                        modal.classList.add('active');
                    }
                });
            });

            document.querySelectorAll('.modal-close').forEach(button => {
                button.addEventListener('click', function () {
                    this.closest('.modal-overlay').classList.remove('active');
                });
            });

            document.querySelectorAll('.modal-overlay').forEach(overlay => {
                overlay.addEventListener('click', function (e) {
                    if (e.target === this) {
                        this.classList.remove('active');
                    }
                });
            });
        });
    </script>

</body>

</html>