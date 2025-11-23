@extends('layouts.admin')

@section('content')
    <div class="header">
        <h1 class="page-title">Gestión de Usuarios</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Usuario
        </a>
    </div>

    <div class="card">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div style="font-weight: 500; color: var(--text-main);">{{ $user->name }}</div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span style="background: #f3f4f6; padding: 0.2rem 0.5rem; border-radius: 0.3rem; font-size: 0.85rem; color: var(--text-secondary);">
                                {{ $user->username }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <button onclick="openEmailModal('{{ $user->id }}', '{{ $user->email }}')" class="btn btn-primary" style="padding: 0.4rem 0.6rem;" title="Enviar Correo">
                                    <i class="fas fa-envelope"></i>
                                </button>
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-success" style="padding: 0.4rem 0.6rem;" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="openDeleteModal('{{ $user->id }}', '{{ $user->name }}')" class="btn btn-danger" style="padding: 0.4rem 0.6rem;" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 1.5rem;">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Email Modal -->
    <div id="emailModal" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 100; justify-content: center; align-items: center; padding: 1rem;">
        <div class="modal-content" style="background: white; padding: 2rem; border-radius: 1rem; width: 100%; max-width: 500px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem; color: var(--text-main);">
                <i class="fas fa-envelope" style="color: var(--primary-color); margin-right: 0.5rem;"></i> 
                Enviar Correo a <span id="modalUserEmail" style="color: var(--primary-color);"></span>
            </h3>
            <form id="emailForm" method="POST">
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
                    <button type="button" onclick="closeEmailModal()" class="btn btn-secondary">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 100; justify-content: center; align-items: center; padding: 1rem;">
        <div class="modal-content" style="background: white; padding: 2rem; border-radius: 1rem; width: 100%; max-width: 450px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: center;">
            <div style="width: 60px; height: 60px; background: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <i class="fas fa-exclamation-triangle" style="font-size: 1.75rem; color: #dc2626;"></i>
            </div>
            
            <h3 style="margin-bottom: 0.5rem; font-size: 1.25rem; color: var(--text-main);">¿Eliminar Usuario?</h3>
            <p style="color: var(--text-secondary); margin-bottom: 1.5rem; line-height: 1.5;">
                Estás a punto de eliminar a <strong id="deleteUserName" style="color: var(--text-main);"></strong>. 
                <br><span style="font-size: 0.9rem; color: #dc2626;">Esta acción eliminará todo su progreso y es irreversible.</span>
            </p>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div style="display: flex; justify-content: center; gap: 1rem;">
                    <button type="button" onclick="closeDeleteModal()" class="btn btn-secondary" style="width: 100%;">Cancelar</button>
                    <button type="submit" class="btn btn-danger" style="width: 100%;">Sí, Eliminar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Email Modal Functions
        function openEmailModal(userId, userEmail) {
            const modal = document.getElementById('emailModal');
            modal.style.display = 'flex';
            document.getElementById('modalUserEmail').innerText = userEmail;
            document.getElementById('emailForm').action = `/admin/users/${userId}/email`;
            // Animation
            setTimeout(() => modal.style.opacity = '1', 10);
        }

        function closeEmailModal() {
            const modal = document.getElementById('emailModal');
            modal.style.opacity = '0';
            setTimeout(() => modal.style.display = 'none', 300);
        }

        // Delete Modal Functions
        function openDeleteModal(userId, userName) {
            const modal = document.getElementById('deleteModal');
            modal.style.display = 'flex';
            document.getElementById('deleteUserName').innerText = userName;
            document.getElementById('deleteForm').action = `/admin/users/${userId}`;
            // Animation
            setTimeout(() => modal.style.opacity = '1', 10);
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.style.opacity = '0';
            setTimeout(() => modal.style.display = 'none', 300);
        }

        // Close modals on outside click
        window.onclick = function(event) {
            if (event.target.classList.contains('modal-overlay')) {
                closeEmailModal();
                closeDeleteModal();
            }
        }
    </script>
@endsection
