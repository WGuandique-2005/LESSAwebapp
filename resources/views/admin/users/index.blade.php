@extends('layouts.admin')

@section('content')
    <div class="header">
        <h1 class="page-title">Gestión de Usuarios</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Usuario
        </a>
    </div>

    <!-- Search Bar -->
    <div class="card" style="margin-bottom: 2rem; padding: 1rem;">
        <form action="{{ route('admin.users') }}" method="GET" class="search-form">
            <div class="search-input-container">
                <i class="fas fa-search" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-secondary);"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre, email o usuario..." style="width: 100%; padding: 0.75rem 1rem 0.75rem 2.5rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; font-family: inherit;">
            </div>
            <div class="search-actions">
                <button type="submit" class="btn btn-primary">Buscar</button>
                @if(request('search'))
                    <a href="{{ route('admin.users') }}" class="btn btn-secondary" title="Limpiar búsqueda">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <style>
        .search-form {
            display: flex;
            gap: 1rem;
            align-items: center;
            width: 100%;
        }
        .search-input-container {
            flex: 1;
            position: relative;
        }
        .search-actions {
            display: flex;
            gap: 0.5rem;
            flex-shrink: 0;
        }
        
        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .search-form {
                flex-direction: column;
                align-items: stretch;
                gap: 0.75rem;
            }
            .search-input-container {
                width: 100%;
            }
            .search-actions {
                width: 100%;
                display: flex;
                gap: 0.5rem;
            }
            .search-actions .btn {
                flex: 1;
                justify-content: center;
                padding: 0.75rem;
            }
        }
    </style>

    <div class="card" style="padding: 0; overflow: hidden;">
        <div class="table-container">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                <thead style="background-color: #f9fafb;">
                    <tr>
                        <th style="padding: 1rem 1.5rem; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-secondary); font-weight: 600; border-bottom: 1px solid #e5e7eb;">Nombre</th>
                        <th style="padding: 1rem 1.5rem; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-secondary); font-weight: 600; border-bottom: 1px solid #e5e7eb;">Email</th>
                        <th style="padding: 1rem 1.5rem; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-secondary); font-weight: 600; border-bottom: 1px solid #e5e7eb;">Usuario</th>
                        <th style="padding: 1rem 1.5rem; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-secondary); font-weight: 600; border-bottom: 1px solid #e5e7eb; text-align: right;">Acciones</th>
                    </tr>
                </thead>
                <tbody style="background-color: white;">
                    @foreach($users as $user)
                    <tr style="transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='white'">
                        <td style="padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6;">
                            <div style="display: flex; align-items: center;">
                                <div style="width: 2.5rem; height: 2.5rem; background-color: #e0e7ff; color: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; margin-right: 1rem; font-size: 0.9rem;">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div style="font-weight: 500; color: var(--text-main);">{{ $user->name }}</div>
                            </div>
                        </td>
                        <td style="padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; color: var(--text-secondary);">{{ $user->email }}</td>
                        <td style="padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6;">
                            <span style="background: #eff6ff; color: var(--primary-color); padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.85rem; font-weight: 500;">
                                {{ $user->username }}
                            </span>
                        </td>
                        <td style="padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; text-align: right;">
                            <div style="display: inline-flex; gap: 0.5rem;">
                                <button onclick="openEmailModal('{{ $user->id }}', '{{ $user->email }}')" class="btn" style="background-color: white; border: 1px solid #e5e7eb; color: var(--text-secondary); padding: 0.4rem 0.6rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);" title="Enviar Correo" onmouseover="this.style.borderColor='var(--primary-color)'; this.style.color='var(--primary-color)'" onmouseout="this.style.borderColor='#e5e7eb'; this.style.color='var(--text-secondary)'">
                                    <i class="fas fa-envelope"></i>
                                </button>
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn" style="background-color: white; border: 1px solid #e5e7eb; color: var(--text-secondary); padding: 0.4rem 0.6rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);" title="Editar" onmouseover="this.style.borderColor='#10b981'; this.style.color='#10b981'" onmouseout="this.style.borderColor='#e5e7eb'; this.style.color='var(--text-secondary)'">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="openResetModal('{{ $user->id }}', '{{ $user->name }}')" class="btn" style="background-color: white; border: 1px solid #e5e7eb; color: var(--text-secondary); padding: 0.4rem 0.6rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);" title="Reiniciar Progreso" onmouseover="this.style.borderColor='#f59e0b'; this.style.color='#f59e0b'" onmouseout="this.style.borderColor='#e5e7eb'; this.style.color='var(--text-secondary)'">
                                    <i class="fas fa-history"></i>
                                </button>
                                <button onclick="openDeleteModal('{{ $user->id }}', '{{ $user->name }}')" class="btn" style="background-color: white; border: 1px solid #e5e7eb; color: var(--text-secondary); padding: 0.4rem 0.6rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);" title="Eliminar" onmouseover="this.style.borderColor='#ef4444'; this.style.color='#ef4444'" onmouseout="this.style.borderColor='#e5e7eb'; this.style.color='var(--text-secondary)'">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="padding: 1rem 1.5rem; border-top: 1px solid #e5e7eb; background-color: #f9fafb;">
            {{ $users->links('admin.pagination') }}
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

    <!-- Reset Progress Modal -->
    <div id="resetModal" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 100; justify-content: center; align-items: center; padding: 1rem;">
        <div class="modal-content" style="background: white; padding: 2rem; border-radius: 1rem; width: 100%; max-width: 450px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: center;">
            <div style="width: 60px; height: 60px; background: #fef3c7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <i class="fas fa-history" style="font-size: 1.75rem; color: #d97706;"></i>
            </div>
            
            <h3 style="margin-bottom: 0.5rem; font-size: 1.25rem; color: var(--text-main);">¿Reiniciar Progreso?</h3>
            <p style="color: var(--text-secondary); margin-bottom: 1.5rem; line-height: 1.5;">
                Estás a punto de reiniciar el progreso de <strong id="resetUserName" style="color: var(--text-main);"></strong>. 
                <br><span style="font-size: 0.9rem; color: #d97706;">Se eliminarán lecciones, puntos y recompensas, pero el usuario permanecerá activo.</span>
            </p>

            <form id="resetForm" method="POST">
                @csrf
                @method('PUT')
                <div style="display: flex; justify-content: center; gap: 1rem;">
                    <button type="button" onclick="closeResetModal()" class="btn btn-secondary" style="width: 100%;">Cancelar</button>
                    <button type="submit" class="btn" style="width: 100%; background-color: #f59e0b; color: white;">Sí, Reiniciar</button>
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
            setTimeout(() => modal.style.opacity = '1', 10);
        }

        function closeEmailModal() {
            const modal = document.getElementById('emailModal');
            modal.style.opacity = '0';
            setTimeout(() => modal.style.display = 'none', 300);
        }

        // Reset Modal Functions
        function openResetModal(userId, userName) {
            const modal = document.getElementById('resetModal');
            modal.style.display = 'flex';
            document.getElementById('resetUserName').innerText = userName;
            document.getElementById('resetForm').action = `/admin/users/${userId}/reset-progress`;
            setTimeout(() => modal.style.opacity = '1', 10);
        }

        function closeResetModal() {
            const modal = document.getElementById('resetModal');
            modal.style.opacity = '0';
            setTimeout(() => modal.style.display = 'none', 300);
        }

        // Delete Modal Functions
        function openDeleteModal(userId, userName) {
            const modal = document.getElementById('deleteModal');
            modal.style.display = 'flex';
            document.getElementById('deleteUserName').innerText = userName;
            document.getElementById('deleteForm').action = `/admin/users/${userId}`;
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
                closeResetModal();
                closeDeleteModal();
            }
        }
    </script>
@endsection
