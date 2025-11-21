<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking Global de Jugadores</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        /* --- Variables de Diseño --- */
        :root {
            --primary-dark: #0a2463;
            /* Azul oscuro principal */
            --secondary-blue: #1f3d82;
            /* Azul para contenedores */
            --accent-gold: #FFD166;
            --accent-green: #41ff3f;
            /* Verde más brillante para mayor contraste */
            --text-light: #e2e8f0;
            --text-dark: #1e293b;
            /* Más oscuro para contraste con fondos claros */
            --shadow-soft: 0 10px 30px rgba(0, 0, 0, 0.3);
            --shadow-hover: 0 8px 20px rgba(0, 0, 0, 0.45);
        }

        /* --- Estilos Generales --- */
        body {
            font-family: "Poppins", sans-serif;
            background-color: var(--primary-dark);
            color: var(--text-light);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 25px;
            border-radius: 20px;
            background: rgba(31, 61, 130, 0.6);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-soft);
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            font-weight: 800;
            margin-bottom: 30px;
            letter-spacing: 1px;
            background: linear-gradient(90deg, #fcd34d, var(--accent-gold), #fcd34d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .ranking-intro {
            text-align: center;
            color: #a5b4c4;
            /* Color suave para el texto de introducción */
            margin-bottom: 30px;
            font-size: 0.95em;
        }

        /* --- Estilos de la Tabla de Ranking --- */
        .ranking-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 14px;
        }

        .ranking-table thead th {
            text-transform: uppercase;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            color: var(--accent-green);
            /* Títulos de columna con mejor contraste */
            padding: 15px 20px 10px 20px;
            text-align: left;
        }

        .ranking-table thead th:nth-child(3),
        .ranking-table tbody td:nth-child(3) {
            text-align: center;
        }

        .ranking-table thead th:nth-child(4),
        .ranking-table tbody td:nth-child(4) {
            text-align: right;
        }

        .ranking-table tbody tr {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            transition: 0.3s ease;
            cursor: pointer;
        }

        .ranking-table tbody tr:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            background: rgba(255, 255, 255, 0.18);
        }

        .ranking-table td {
            padding: 18px 20px;
            border: none;
            font-size: 1.05em;
            font-weight: 600;
            vertical-align: middle;
        }

        .ranking-table tbody tr td:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .ranking-table tbody tr td:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        /* --- Estilos de Podio (1er, 2do, 3er) --- */
        .rank-gold {
            background: linear-gradient(135deg, #FFD700, #FFC72C);
            color: var(--text-light) !important;
            /* Texto más oscuro para mejor legibilidad */
            font-weight: 700;
        }

        .rank-silver {
            background: linear-gradient(135deg, #c0c0c0, #a9a9a9);
            color: var(--text-light) !important;
            font-weight: 700;
        }

        .rank-bronze {
            background: linear-gradient(135deg, #cd7f32, #b87333);
            color: #ffffff !important;
            font-weight: 700;
        }

        /* Iconos de posición */
        .rank-icon {
            font-size: 1.2em;
            margin-left: 6px;
        }

        .rank-gold .rank-icon {
            content: '👑';
        }

        .rank-silver .rank-icon {
            content: '🥈';
        }

        .rank-bronze .rank-icon {
            content: '🥉';
        }

        /* Usuario y Avatar */
        .user-cell {
            display: flex;
            align-items: center;
        }

        .avatar-initial {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            margin-right: 15px;
            font-size: 1em;
            color: var(--primary-dark);
            text-transform: uppercase;
            background: var(--accent-gold);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            flex-shrink: 0;
        }

        /* Ajuste de color de avatar para el podio */
        .rank-gold .avatar-initial,
        .rank-silver .avatar-initial,
        .rank-bronze .avatar-initial {
            background: #ffffff;
            color: var(--text-dark);
        }

        .user-cell span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* --- Mensaje de Vacío --- */
        .no-ranking-data {
            text-align: center;
            padding: 50px 20px;
            font-size: 1.2em;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            margin-top: 20px;
        }

        /* --- Modales --- */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.9);
            display: none;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(8px);
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background: linear-gradient(145deg, rgba(31, 61, 130, 0.95), rgba(10, 36, 99, 0.95));
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
            animation: modalPop 0.35s ease forwards;
            color: white;
            position: relative;
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

        .modal-content h3 {
            color: var(--accent-gold);
            margin-bottom: 25px;
        }

        .modal-close {
            top: 15px;
            right: 20px;
            font-size: 2em;
            color: var(--text-light);
            transition: 0.2s ease;
            position: absolute;
            cursor: pointer;
            line-height: 1;
        }

        .modal-close:hover {
            color: #f472b6;
            transform: scale(1.1) rotate(90deg);
        }

        /* ---- RECOMPENSAS----- */
        .rewards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .reward-card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 10px;
            text-align: center;
            transition: 0.2s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            min-height: 120px;
            /* evita compresión vertical excesiva */
            padding-top: 12px;
            padding-bottom: 12px;
        }

        .reward-card:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.25);
        }

        .reward-card img {
            width: 100%;
            max-width: 84px;
            /* controla el tamaño máximo manteniendo responsividad */
            height: auto;
            border-radius: 10px;
            object-fit: contain;
            margin-bottom: 0;
            border: 2px solid var(--accent-gold);
            box-shadow: 0 0 10px rgba(255, 209, 102, 0.5);
        }

        .reward-card h4 {
            font-size: 0.95em;
            font-weight: 600;
            margin: 6px 0 0 0;
            white-space: normal;
            word-break: break-word;
        }

        .reward-card p {
            font-size: 0.85em;
            color: var(--accent-gold);
            font-weight: 700;
            margin: 0;
            white-space: nowrap;
        }


        /* --- Responsividad --- */
        @media (max-width: 768px) {
            .container {
                margin: 20px 8px;
                /* Ajuste de márgenes laterales para que no toque los bordes */
                padding: 20px 15px;
                /* Padding interno del contenedor */
            }

            h1 {
                font-size: 1.8em;
            }

            .ranking-table thead {
                display: none;
            }

            /* Ocultar encabezados en móvil */

            .ranking-table,
            .ranking-table tbody,
            .ranking-table tr {
                display: block;
                width: 100%;
            }

            .ranking-table tr {
                margin-bottom: 20px;
                /* Separación entre filas individuales */
                border-radius: 12px;
                /* Las filas siguen teniendo bordes redondeados */
                overflow: hidden;
                /* Asegura que los bordes redondeados se apliquen bien */
                background: rgba(255, 255, 255, 0.1);
                /* Fondo de la fila completa */
            }

            .ranking-table td {
                display: flex;
                /* IMPORTANTE: Cada celda ahora es un flex container */
                justify-content: space-between;
                /* Etiqueta a la izquierda, contenido a la derecha */
                align-items: center;
                padding: 12px 15px;
                /* Padding para cada celda */
                font-size: 0.95em;
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
                /* Separador entre celdas */
            }

            /* Quita el borde inferior de la última celda de cada fila */
            .ranking-table tbody tr td:last-of-type {
                border-bottom: none;
            }

            /* Simular encabezados para celdas en móvil (el "data-label") */
            .ranking-table td::before {
                content: attr(data-label);
                font-weight: 700;
                color: var(--accent-green);
                font-size: 0.85em;
                flex-shrink: 0;
                /* Evita que la etiqueta se encoja */
                margin-right: 10px;
                /* Espacio entre etiqueta y valor */
            }

            /* 1. Celda de POSICIÓN */
            .ranking-table tbody tr td:first-child {
                justify-content: center;
                /* Centrar el contenido completo */
                font-size: 1.6em;
                /* Destacar la posición */
                font-weight: 800;
                padding: 15px;
                /* Más padding para que resalte */
                border-bottom: 1px solid rgba(255, 255, 255, 0.15);
                /* Separador más notorio */
                color: var(--accent-gold);
                /* Color dorado para la posición */
            }

            .ranking-table tbody tr td:first-child::before {
                content: none;
                /* Ocultar la etiqueta "POSICIÓN:" aquí */
            }

            /* 2. Celda de USUARIO */
            .ranking-table tbody tr td:nth-child(2) {
                /* No se necesita display: flex aquí, ya que el TD ya es flex */
            }

            .ranking-table tbody tr td:nth-child(2) .user-cell {
                /* Asegura que el contenido del usuario también sea flex */
                display: flex;
                align-items: center;
                gap: 10px;
                /* El user-cell debe estar a la derecha del data-label */
                justify-content: flex-end;
                flex-grow: 1;
                /* Ocupa el espacio restante */
            }

            .ranking-table tbody tr td:nth-child(2) .avatar-initial {
                width: 35px;
                /* Avatar un poco más pequeño */
                height: 35px;
                font-size: 0.9em;
                margin-right: 0;
                /* Eliminar margen si user-cell maneja el gap */
            }

            .ranking-table tbody tr td:nth-child(2) .user-cell span {
                font-size: 1em;
                /* Asegurar que el nombre del usuario sea legible */
                font-weight: 600;
            }

            /* 3. PUNTOS y FECHA RECORD (ya son manejados por el display: flex genérico de td) */
            /* Solo ajustamos la alineación si es necesario, pero space-between ya lo hace */
            .ranking-table tbody tr td:nth-child(3) .user-cell,
            /* Si Puntos tiene user-cell */
            .ranking-table tbody tr td:nth-child(4) .user-cell {
                /* Si Fecha tiene user-cell */
                justify-content: flex-end;
            }

            .rewards-grid {
                grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            }

            .modal-content {
                padding: 30px 20px;
            }

            /* Ajuste extra para dispositivos muy pequeños (menor a 400px) */
            @media (max-width: 400px) {
                .rewards-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 12px;
                }

                .ranking-table tbody tr td:first-child {
                    font-size: 1.4em;
                }
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>

    <div class="container">
        <h1>Ranking Global de Jugadores</h1>

        <p class="ranking-intro">
            ¡Compite y escala posiciones! Haz clic en una fila para ver las recompensas desbloqueadas del jugador.
        </p>

        @if(isset($ranking) && $ranking->count())
            <table class="ranking-table">
                <thead>
                    <tr>
                        <th style="width: 10%;">POS</th>
                        <th style="width: 50%;">Usuario</th>
                        <th style="width: 20%; text-align: center;">Puntos</th>
                        <th style="width: 20%; text-align: right;">Fecha Record</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ranking as $index => $row)
                        @php
                            $initial = strtoupper(substr($row->username, 0, 1));
                            $rank = $index + 1;
                            $rankClass = '';
                            $rankEmoji = '';
                            if ($rank == 1) {
                                $rankClass = 'rank-gold';
                                $rankEmoji = '👑';
                            } elseif ($rank == 2) {
                                $rankClass = 'rank-silver';
                                $rankEmoji = '🥈';
                            } elseif ($rank == 3) {
                                $rankClass = 'rank-bronze';
                                $rankEmoji = '🥉';
                            } else {
                                $rankEmoji = $rank; // Para el resto, simplemente el número
                            }
                            // Formateo de fecha mejorado
                            $achievedAt = $row->achieved_at ? \Carbon\Carbon::parse($row->achieved_at)->format('d/m/Y') : '-';
                        @endphp

                        <tr class="clickable-row {{ $rankClass }}" data-modal-target="#user-modal-{{ $row->usuario_id }}">

                            <td data-label="POSICIÓN:">{{ $rank }} <span
                                    class="rank-icon">@if($rank <= 3){{ $rankEmoji }}@endif</span></td>

                            <td data-label="USUARIO:">
                                <div class="user-cell">
                                    <div class="avatar-initial" data-initial="{{ $initial }}">{{ $initial }}</div>
                                    <span>{{ $row->username }}</span>
                                </div>
                            </td>
                            <td data-label="PUNTOS:" style="text-align: center;">
                                {{ number_format($row->total_points, 0, ',', '.') }}</td>
                            <td data-label="ALCANZADO:" style="text-align: right;">{{ $achievedAt }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-ranking-data">¡Sé el primero! Aún no hay datos en el ranking. Completa un minijuego para empezar a
                sumar puntos.</p>
        @endif
    </div>

    {{-- MODALES (sin cambiar la lógica de Blade) --}}
    @if(isset($ranking) && $ranking->count())
        @foreach($ranking as $row)
            <div id="user-modal-{{ $row->usuario_id }}" class="modal-overlay">
                <div class="modal-content">
                    <span class="modal-close" data-modal-close>&times;</span>
                    <h3>Recompensas de {{ $row->username }}</h3>

                    @if($row->rewards && $row->rewards->count())
                        <div class="rewards-grid">
                            @foreach($row->rewards as $rewardEntry)
                                <div class="reward-card">
                                    <img src="{{ asset($rewardEntry->recompensa->url_imagen) }}"
                                        alt="{{ $rewardEntry->recompensa->nombre }}">
                                    <h4>{{ $rewardEntry->recompensa->nombre }}</h4>
                                    <p>{{ $rewardEntry->recompensa->puntos_req }} pts</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p style="text-align: center; color: #a5b4c4;">Este usuario aún no ha desbloqueado recompensas. ¡Anímale a
                            seguir jugando!</p>
                    @endif
                </div>
            </div>
        @endforeach
    @endif

    <footer>@include('partials.footer')</footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lógica del Modal
            const clickableRows = document.querySelectorAll('.clickable-row');
            const modalOverlays = document.querySelectorAll('.modal-overlay');

            // Abrir modal
            clickableRows.forEach(row => {
                row.addEventListener('click', function () {
                    const modalId = this.getAttribute('data-modal-target');
                    const modal = document.querySelector(modalId);
                    if (modal) {
                        modal.classList.add('active');
                        document.body.style.overflow = 'hidden';
                    }
                });
            });

            // Cerrar modal
            modalOverlays.forEach(overlay => {
                // 1. Cerrar haciendo click en la X
                const closeButton = overlay.querySelector('.modal-close');
                if (closeButton) {
                    closeButton.addEventListener('click', function () {
                        this.closest('.modal-overlay').classList.remove('active');
                        document.body.style.overflow = '';
                    });
                }

                // 2. Cerrar haciendo click fuera del modal
                overlay.addEventListener('click', function (e) {
                    if (e.target === this) {
                        this.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                });
            });
        });
    </script>

</body>

</html>