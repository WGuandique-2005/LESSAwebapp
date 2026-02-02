@extends('layouts.admin')

@section('content')
    <div class="header">
        <h1 class="page-title">Dashboard</h1>
        <!-- Global Announcement Button -->
        <button onclick="openAnnouncementModal()" class="btn btn-primary">
            <i class="fas fa-bullhorn"></i> Enviar Anuncio General
        </button>
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

    <!-- Announcement Modal -->
    <div id="announcementModal" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 100; justify-content: center; align-items: center; padding: 1rem;">
        <div class="modal-content" style="background: white; padding: 2rem; border-radius: 1rem; width: 100%; max-width: 500px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem; color: var(--text-main);">
                <i class="fas fa-bullhorn" style="color: var(--primary-color); margin-right: 0.5rem;"></i> 
                Enviar Anuncio General
            </h3>
            <p style="margin-bottom: 1rem; color: var(--text-secondary); font-size: 0.9rem;">
                Este mensaje será enviado a <strong>todos</strong> los usuarios registrados en el sistema.
            </p>
            <form action="{{ route('admin.announcement.send') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-main);">Asunto</label>
                    <input type="text" name="subject" required style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; font-family: inherit;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-main);">Mensaje</label>
                    <textarea name="message" rows="5" required style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; font-family: inherit; resize: vertical;"></textarea>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                    <button type="button" onclick="closeAnnouncementModal()" class="btn btn-secondary">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar a Todos</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAnnouncementModal() {
            const modal = document.getElementById('announcementModal');
            modal.style.display = 'flex';
            setTimeout(() => modal.style.opacity = '1', 10);
        }

        function closeAnnouncementModal() {
            const modal = document.getElementById('announcementModal');
            modal.style.opacity = '0';
            setTimeout(() => modal.style.display = 'none', 300);
        }

        // Close on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('announcementModal');
            if (event.target == modal) {
                closeAnnouncementModal();
            }
        }
    </script>
@endsection
