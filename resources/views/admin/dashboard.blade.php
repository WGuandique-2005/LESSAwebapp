@extends('layouts.admin')

@section('content')
    <div class="header">
        <h1 class="page-title">Dashboard</h1>
    </div>

    <div class="card">
        <h2>Bienvenido, Administrador</h2>
        <p style="color: var(--text-secondary); margin-top: 0.5rem;">
            Desde aquí puedes gestionar los usuarios y enviar comunicados importantes.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
            <div style="background: #eff6ff; padding: 1.5rem; border-radius: 0.5rem; border: 1px solid #dbeafe;">
                <h3 style="color: var(--primary-color); font-size: 2rem; margin-bottom: 0.5rem;">{{ $totalUsers ?? 0 }}</h3>
                <p style="color: var(--text-secondary);">Usuarios Registrados</p>
            </div>
        </div>
    </div>
@endsection
