@extends('layouts.admin')

@section('content')

<style>
    .dash-kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2rem;
    }
    .kpi-card {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        border: 1px solid #f1f5f9;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        position: relative;
        overflow: hidden;
    }
    .kpi-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: var(--kpi-color, var(--primary-color));
    }
    .kpi-icon {
        width: 2.5rem; height: 2.5rem;
        border-radius: 0.75rem;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
        background: var(--kpi-bg, #eff6ff);
        color: var(--kpi-color, var(--primary-color));
    }
    .kpi-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-main);
        line-height: 1;
    }
    .kpi-label {
        font-size: 0.8rem;
        color: var(--text-secondary);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .kpi-sub {
        font-size: 0.75rem;
        color: #10b981;
        font-weight: 500;
    }

    .charts-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
        margin-bottom: 1.25rem;
    }
    .chart-card {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        border: 1px solid #f1f5f9;
    }
    .chart-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .chart-title i { color: var(--primary-color); }
    .chart-subtitle {
        font-size: 0.75rem;
        color: var(--text-secondary);
        margin-bottom: 1.25rem;
    }
    .chart-wrap {
        position: relative;
        height: 220px;
    }

    /* Leaderboard */
    .leaderboard-card {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        border: 1px solid #f1f5f9;
        margin-bottom: 1.25rem;
    }
    .leader-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .leader-row:last-child { border-bottom: none; }
    .leader-rank {
        width: 1.75rem; height: 1.75rem;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.8rem;
        font-weight: 800;
        flex-shrink: 0;
        background: #f3f4f6;
        color: var(--text-secondary);
    }
    .leader-rank.gold   { background: #fef3c7; color: #d97706; }
    .leader-rank.silver { background: #f1f5f9; color: #64748b; }
    .leader-rank.bronze { background: #fef0e6; color: #c2681a; }
    .leader-avatar {
        width: 2.25rem; height: 2.25rem;
        background: #eff6ff;
        color: var(--primary-color);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 0.85rem;
        flex-shrink: 0;
    }
    .leader-info { flex: 1; min-width: 0; }
    .leader-name { font-weight: 600; color: var(--text-main); font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .leader-username { font-size: 0.75rem; color: var(--text-secondary); }
    .leader-pts {
        font-weight: 800; font-size: 1rem;
        color: var(--primary-color);
        white-space: nowrap;
    }
    .leader-bar-wrap {
        width: 80px; background: #f3f4f6; border-radius: 999px; height: 6px; flex-shrink: 0;
    }
    .leader-bar {
        height: 6px;
        background: linear-gradient(90deg, #2563eb, #60a5fa);
        border-radius: 999px;
        transition: width 1s ease;
    }

    /* Lesson progress bars */
    .lesson-progress-card {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        border: 1px solid #f1f5f9;
        margin-bottom: 1.25rem;
    }
    .lesson-bar-row {
        margin-bottom: 1.1rem;
    }
    .lesson-bar-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.4rem;
        font-size: 0.85rem;
    }
    .lesson-bar-name { font-weight: 600; color: var(--text-main); }
    .lesson-bar-count { color: var(--text-secondary); font-weight: 500; }
    .lesson-bar-bg { background: #f3f4f6; border-radius: 999px; height: 10px; overflow: hidden; }
    .lesson-bar-fill {
        height: 10px;
        border-radius: 999px;
        width: 0;
        transition: width 1.2s cubic-bezier(.4,0,.2,1);
    }

    /* Announcement button position */
    .dash-header-actions { display: flex; gap: 1rem; align-items: center; flex-wrap: wrap; }

    @media (max-width: 900px) {
        .charts-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 640px) {
        .dash-kpi-grid { grid-template-columns: repeat(2, 1fr); }
        .kpi-value { font-size: 1.6rem; }
        .leader-bar-wrap { display: none; }
    }
</style>

<div class="header">
    <h1 class="page-title">Dashboard</h1>
    <div class="dash-header-actions">
        <button onclick="openAnnouncementModal()" class="btn btn-primary">
            <i class="fas fa-bullhorn"></i> Enviar Anuncio General
        </button>
    </div>
</div>

{{-- ─── KPI Row ──────────────────────────────────────────────────────────────── --}}
<div class="dash-kpi-grid">
    <div class="kpi-card" style="--kpi-color:#2563eb;--kpi-bg:#eff6ff">
        <div class="kpi-icon"><i class="fas fa-users"></i></div>
        <div class="kpi-value">{{ $totalUsers }}</div>
        <div class="kpi-label">Usuarios Registrados</div>
    </div>
    <div class="kpi-card" style="--kpi-color:#10b981;--kpi-bg:#ecfdf5">
        <div class="kpi-icon"><i class="fas fa-book-open"></i></div>
        <div class="kpi-value">{{ array_sum($completadosPorLeccion) }}</div>
        <div class="kpi-label">Lecciones Completadas</div>
        <div class="kpi-sub">en total entre todos</div>
    </div>
    <div class="kpi-card" style="--kpi-color:#f59e0b;--kpi-bg:#fffbeb">
        <div class="kpi-icon"><i class="fas fa-star"></i></div>
        <div class="kpi-value">{{ number_format(array_sum($avgPuntosPorLeccion) / max(1, count(array_filter($avgPuntosPorLeccion))), 0) }}</div>
        <div class="kpi-label">Pts Promedio Global</div>
        <div class="kpi-sub">por actividad</div>
    </div>
    <div class="kpi-card" style="--kpi-color:#8b5cf6;--kpi-bg:#f5f3ff">
        <div class="kpi-icon"><i class="fas fa-chart-line"></i></div>
        <div class="kpi-value">{{ array_sum($actividadSemanal) }}</div>
        <div class="kpi-label">Actividad Reciente</div>
        <div class="kpi-sub">últimas 4 semanas</div>
    </div>
</div>

{{-- ─── Charts Row ─────────────────────────────────────────────────────────── --}}
<div class="charts-grid">
    {{-- Bar chart: Completados por lección --}}
    <div class="chart-card">
        <div class="chart-title"><i class="fas fa-graduation-cap"></i> Usuarios por Lección</div>
        <div class="chart-subtitle">Cuántos usuarios completaron cada lección</div>
        <div class="chart-wrap">
            <canvas id="chartLecciones"></canvas>
        </div>
    </div>

    {{-- Line chart: Prom. puntos por lección --}}
    <div class="chart-card">
        <div class="chart-title"><i class="fas fa-trophy"></i> Promedio de Puntos</div>
        <div class="chart-subtitle">Puntos promedio obtenidos por actividades de cada lección</div>
        <div class="chart-wrap">
            <canvas id="chartPuntos"></canvas>
        </div>
    </div>
</div>

{{-- Activity line chart (full width) --}}
<div class="chart-card" style="margin-bottom:1.25rem;">
    <div class="chart-title"><i class="fas fa-calendar-week"></i> Actividad Semanal</div>
    <div class="chart-subtitle">Lecciones completadas en las últimas 4 semanas</div>
    <div class="chart-wrap" style="height:180px;">
        <canvas id="chartActividad"></canvas>
    </div>
</div>

{{-- ─── Bottom Row: progress bars + leaderboard ──────────────────────────── --}}
<div class="charts-grid">
    {{-- Lesson completion bars --}}
    <div class="lesson-progress-card">
        <div class="chart-title" style="margin-bottom:0.25rem;"><i class="fas fa-tasks"></i> Tasa de Completado</div>
        <div class="chart-subtitle">% de usuarios que completaron cada lección</div>
        @php
            $colors = ['#2563eb','#10b981','#f59e0b','#8b5cf6'];
            $names  = ['Abecedario','Números','Saludos','Salud'];
            $maxVal = max(max($completadosPorLeccion), 1);
        @endphp
        @foreach($completadosPorLeccion as $i => $count)
        <div class="lesson-bar-row">
            <div class="lesson-bar-header">
                <span class="lesson-bar-name">{{ $names[$i] }}</span>
                <span class="lesson-bar-count">{{ $count }} / {{ $totalUsers }}</span>
            </div>
            <div class="lesson-bar-bg">
                <div class="lesson-bar-fill" 
                     style="background:{{ $colors[$i] }};"
                     data-width="{{ $totalUsers > 0 ? round($count/$totalUsers*100) : 0 }}%">
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Leaderboard --}}
    <div class="leaderboard-card">
        <div class="chart-title" style="margin-bottom:0.25rem;"><i class="fas fa-medal"></i> Top 5 Usuarios</div>
        <div class="chart-subtitle">Ranking por puntos totales acumulados</div>
        @php $maxPts = $topUsuarios->first()?->total_puntos ?? 1; @endphp
        @forelse($topUsuarios as $idx => $u)
        <div class="leader-row">
            <div class="leader-rank {{ $idx === 0 ? 'gold' : ($idx === 1 ? 'silver' : ($idx === 2 ? 'bronze' : '')) }}">
                {{ $idx + 1 }}
            </div>
            <div class="leader-avatar">{{ strtoupper(substr($u->name, 0, 2)) }}</div>
            <div class="leader-info">
                <div class="leader-name">{{ $u->name }}</div>
                <div class="leader-username">@{{ $u->username }}</div>
            </div>
            <div class="leader-bar-wrap">
                <div class="leader-bar" data-width="{{ round($u->total_puntos / $maxPts * 100) }}%"></div>
            </div>
            <div class="leader-pts">{{ number_format($u->total_puntos) }} pts</div>
        </div>
        @empty
        <p style="color:var(--text-secondary);font-size:0.9rem;text-align:center;padding:1rem 0;">
            Aún no hay datos de puntos.
        </p>
        @endforelse
    </div>
</div>

{{-- ─── Announcement Modal ─────────────────────────────────────────────────── --}}
<div id="announcementModal" class="modal-overlay" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:100;justify-content:center;align-items:center;padding:1rem;">
    <div class="modal-content" style="background:white;padding:2rem;border-radius:1rem;width:100%;max-width:500px;box-shadow:0 10px 25px rgba(0,0,0,0.1);">
        <h3 style="margin-bottom:1.5rem;font-size:1.25rem;color:var(--text-main);">
            <i class="fas fa-bullhorn" style="color:var(--primary-color);margin-right:0.5rem;"></i>
            Enviar Anuncio General
        </h3>
        <p style="margin-bottom:1rem;color:var(--text-secondary);font-size:0.9rem;">
            Este mensaje será enviado a <strong>todos</strong> los usuarios registrados.
        </p>
        <form action="{{ route('admin.announcement.send') }}" method="POST">
            @csrf
            <div style="margin-bottom:1rem;">
                <label style="display:block;margin-bottom:0.5rem;font-weight:500;color:var(--text-main);">Asunto</label>
                <input type="text" name="subject" required style="width:100%;padding:0.75rem;border:1px solid #e5e7eb;border-radius:0.5rem;font-family:inherit;">
            </div>
            <div style="margin-bottom:1.5rem;">
                <label style="display:block;margin-bottom:0.5rem;font-weight:500;color:var(--text-main);">Mensaje</label>
                <textarea name="message" rows="5" required style="width:100%;padding:0.75rem;border:1px solid #e5e7eb;border-radius:0.5rem;font-family:inherit;resize:vertical;"></textarea>
            </div>
            <div style="display:flex;justify-content:flex-end;gap:1rem;">
                <button type="button" onclick="closeAnnouncementModal()" class="btn btn-secondary">Cancelar</button>
                <button type="submit" class="btn btn-primary">Enviar a Todos</button>
            </div>
        </form>
    </div>
</div>

{{-- ─── Scripts ────────────────────────────────────────────────────────────── --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Shared data from PHP
    const leccionLabels = @json(['Lec 1\nAbecedario','Lec 2\nNúmeros','Lec 3\nSaludos','Lec 4\nSalud']);
    const completados   = @json($completadosPorLeccion);
    const avgPuntos     = @json($avgPuntosPorLeccion);
    const semLabels     = @json($semanaLabels);
    const semData       = @json($actividadSemanal);
    const totalUsers    = {{ $totalUsers }};

    Chart.defaults.font.family = "'Poppins', sans-serif";
    Chart.defaults.color = '#6b7280';

    // ── Bar chart: Lecciones ─────────────────────────────────────────
    new Chart(document.getElementById('chartLecciones'), {
        type: 'bar',
        data: {
            labels: ['Abecedario', 'Números', 'Saludos', 'Salud'],
            datasets: [{
                label: 'Usuarios completados',
                data: completados,
                backgroundColor: ['#3b82f6','#10b981','#f59e0b','#8b5cf6'],
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ` ${ctx.raw} de ${totalUsers} usuarios (${totalUsers > 0 ? Math.round(ctx.raw/totalUsers*100) : 0}%)`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: Math.max(totalUsers, 1),
                    ticks: { stepSize: Math.max(1, Math.ceil(totalUsers / 5)) },
                    grid: { color: '#f3f4f6' }
                },
                x: { grid: { display: false } }
            }
        }
    });

    // ── Line chart: Promedio puntos ──────────────────────────────────
    new Chart(document.getElementById('chartPuntos'), {
        type: 'line',
        data: {
            labels: ['Abecedario', 'Números', 'Saludos', 'Salud'],
            datasets: [{
                label: 'Prom. puntos',
                data: avgPuntos,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37,99,235,0.08)',
                pointBackgroundColor: '#2563eb',
                pointRadius: 6,
                pointHoverRadius: 8,
                tension: 0.4,
                fill: true,
                borderWidth: 2.5,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { callbacks: { label: ctx => ` ${ctx.raw} pts promedio` } }
            },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
                x: { grid: { display: false } }
            }
        }
    });

    // ── Area chart: Actividad semanal ────────────────────────────────
    new Chart(document.getElementById('chartActividad'), {
        type: 'line',
        data: {
            labels: semLabels,
            datasets: [{
                label: 'Lecciones completadas',
                data: semData,
                borderColor: '#8b5cf6',
                backgroundColor: 'rgba(139,92,246,0.1)',
                pointBackgroundColor: '#8b5cf6',
                pointRadius: 5,
                pointHoverRadius: 7,
                tension: 0.4,
                fill: true,
                borderWidth: 2.5,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { callbacks: { label: ctx => ` ${ctx.raw} completadas` } }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f3f4f6' } },
                x: { grid: { display: false } }
            }
        }
    });

    // ── Animate bars on load ─────────────────────────────────────────
    function animateBars() {
        document.querySelectorAll('.lesson-bar-fill').forEach(el => {
            el.style.width = el.dataset.width;
        });
        document.querySelectorAll('.leader-bar').forEach(el => {
            el.style.width = el.dataset.width;
        });
    }
    setTimeout(animateBars, 200);

    // ── Modal helpers ────────────────────────────────────────────────
    function openAnnouncementModal() {
        const m = document.getElementById('announcementModal');
        m.style.display = 'flex';
        setTimeout(() => m.style.opacity = '1', 10);
    }
    function closeAnnouncementModal() {
        const m = document.getElementById('announcementModal');
        m.style.opacity = '0';
        setTimeout(() => m.style.display = 'none', 300);
    }
    window.onclick = e => {
        if (e.target.id === 'announcementModal') closeAnnouncementModal();
    }
</script>

@endsection
