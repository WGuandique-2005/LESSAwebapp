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

        <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
            {{ $users->links('admin.pagination') }}
        </div>
    </div>



    <div class="card" style="padding: 0; overflow: hidden;">
        <div class="table-container">
            <table class="responsive-table">
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
                    <tr style="transition: background-color 0.2s; cursor: pointer;" 
                        onmouseover="this.style.backgroundColor='#f9fafb'" 
                        onmouseout="this.style.backgroundColor='white'"
                        onclick="openUserDetailsModal({{ json_encode($user) }})">
                        
                        <td data-label="Nombre" style="padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6;">
                            <div style="display: flex; align-items: center;">
                                <div class="mobile-avatar" style="width: 2.5rem; height: 2.5rem; background-color: #e0e7ff; color: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; margin-right: 1rem; font-size: 0.9rem; flex-shrink: 0;">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div style="font-weight: 500; color: var(--text-main);">{{ $user->name }}</div>
                            </div>
                        </td>
                        <td data-label="Email" style="padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; color: var(--text-secondary);">
                            <div style="word-break: break-all; text-align: right;">{{ $user->email }}</div>
                        </td>
                        <td data-label="Usuario" style="padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6;">
                            <span style="background: #eff6ff; color: var(--primary-color); padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.85rem; font-weight: 500; word-break: break-all; display: inline-block; max-width: 100%;">
                                {{ $user->username }}
                            </span>
                        </td>
                        <td data-label="Acciones" style="padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; text-align: right;" onclick="event.stopPropagation()">
                            <div style="display: inline-flex; gap: 0.5rem; flex-wrap: wrap; justify-content: flex-end;">
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

        <!-- Pagination moved above the table -->
    </div>

    <style>
        /* Existing search styles */
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

            /* Stacked Table Styles */
            .responsive-table, 
            .responsive-table tbody, 
            .responsive-table tr, 
            .responsive-table td {
                display: block;
                width: 100%;
            }

            .responsive-table thead {
                display: none; /* Hide headers */
            }

            .responsive-table tr {
                margin-bottom: 1rem;
                border: 1px solid #e5e7eb;
                border-radius: 0.5rem;
                background: white;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            }

            .responsive-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem 1rem !important;
                border-bottom: 1px solid #f3f4f6;
                text-align: right !important;
            }

            .responsive-table td:last-child {
                border-bottom: none;
                justify-content: center; /* Center actions */
                padding: 1rem !important;
            }

            .responsive-table td::before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--text-secondary);
                text-transform: uppercase;
                font-size: 0.75rem;
                margin-right: 1rem;
                text-align: left;
            }

            /* Adjustments for specific cells */
            .responsive-table td[data-label="Acciones"]::before {
                display: none; /* Hide label for actions */
            }
            
            .responsive-table td[data-label="Nombre"] {
                background-color: #f9fafb;
                border-bottom: 1px solid #e5e7eb;
            }
            
            /* Ensure content doesn't overlap label (except for Actions column) */
            .responsive-table td:not([data-label="Acciones"]) > div,
            .responsive-table td:not([data-label="Acciones"]) > span {
                max-width: 65%;
                text-align: right;
                word-break: break-word; /* Allow wrapping for long words */
                white-space: normal; /* Ensure text wraps */
            }

            /* Specific fix for Name cell which has a nested flex container */
            .responsive-table td[data-label="Nombre"] > div {
                max-width: 100%; /* Allow container to fill available space */
                justify-content: flex-end; /* Align to right on mobile */
            }
            
            .responsive-table td[data-label="Nombre"] > div > div:last-child {
                text-align: right;
                word-break: break-word;
            }

            /* Mobile Avatar Fix */
            .mobile-avatar {
                margin-right: 0.75rem !important;
                width: 2.25rem !important;
                height: 2.25rem !important;
                font-size: 0.85rem !important;
                flex-shrink: 0;
            }

            /* Fix Action Buttons on Mobile */
            .responsive-table td[data-label="Acciones"] {
                justify-content: flex-end !important;
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }

            .responsive-table td[data-label="Acciones"] > div {
                width: 100%;
                justify-content: space-between !important; /* Spread buttons out or use flex-end */
                display: flex !important;
                gap: 0.5rem !important;
            }

            .responsive-table td[data-label="Acciones"] .btn {
                width: auto !important;
                flex: 1 !important; /* Distribute space evenly */
                display: inline-flex !important;
                justify-content: center !important;
                padding: 0.6rem 0.5rem !important;
                margin: 0 !important;
            }
            
            /* If buttons are too small, maybe stack in pairs? */
            /* Let's try just making them auto width and centered if flex:1 looks bad */
            .responsive-table td[data-label="Acciones"] .btn {
                flex: 0 0 auto !important;
                width: auto !important;
            }
            
            .responsive-table td[data-label="Acciones"] > div {
                justify-content: flex-end !important;
            }
        }

        /* Modal Responsiveness */
        .modal-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .modal-stats-grid {
            display: grid; 
            grid-template-columns: repeat(3, 1fr); 
            gap: 1rem; 
            margin-bottom: 2rem; 
            background: #f3f4f6; 
            padding: 1rem; 
            border-radius: 0.75rem;
        }

        .modal-label {
            display: block; 
            font-size: 0.8rem; 
            color: var(--text-secondary); 
            margin-bottom: 0.25rem;
        }

        .modal-value {
            font-weight: 500; 
            color: var(--text-main);
            word-break: break-word; /* Ensure long text wraps */
        }

        @media (max-width: 640px) {
            .modal-info-grid {
                grid-template-columns: 1fr; /* Force single column on mobile */
            }
            
            .modal-stats-grid {
                grid-template-columns: 1fr; /* Stack stats on very small screens if needed, or keep 3 */
                gap: 0.5rem;
            }
        }
    </style>

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

    <!-- User Details Modal -->
    <div id="userDetailsModal" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 100; justify-content: center; align-items: center; padding: 1rem;">
        <div class="modal-content" style="background: white; padding: 0; border-radius: 1rem; width: 100%; max-width: 600px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); overflow: hidden; max-height: 90vh; display: flex; flex-direction: column;">
            
            <div style="padding: 1.5rem; background: #f9fafb; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="font-size: 1.25rem; font-weight: 600; color: var(--text-main); display: flex; align-items: center; gap: 0.75rem;">
                    <div id="modalAvatar" style="width: 2.5rem; height: 2.5rem; background-color: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 1rem;"></div>
                    <span id="modalUserName"></span>
                </h3>
                <button onclick="closeUserDetailsModal()" style="background: none; border: none; font-size: 1.5rem; color: var(--text-secondary); cursor: pointer;">&times;</button>
            </div>

            <div style="padding: 1.5rem; overflow-y: auto;">
                <!-- General Info -->
                <div style="margin-bottom: 2rem;">
                    <h4 style="font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-secondary); font-weight: 600; margin-bottom: 1rem; border-bottom: 2px solid #f3f4f6; padding-bottom: 0.5rem;">Información General</h4>
                    <div class="modal-info-grid">
                        <div>
                            <label class="modal-label">Nombre Completo</label>
                            <div id="modalName" class="modal-value"></div>
                        </div>
                        <div>
                            <label class="modal-label">Usuario</label>
                            <div id="modalUsername" class="modal-value"></div>
                        </div>
                        <div>
                            <label class="modal-label">Email</label>
                            <div id="modalEmail" class="modal-value"></div>
                        </div>
                        <div>
                            <label class="modal-label">Fecha de Registro</label>
                            <div id="modalJoined" class="modal-value"></div>
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="modal-stats-grid">
                    <div style="text-align: center;">
                        <div id="modalLessonsCount" style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color);">0</div>
                        <div style="font-size: 0.8rem; color: var(--text-secondary);">Lecciones</div>
                    </div>
                    <div style="text-align: center;">
                        <div id="modalPoints" style="font-size: 1.5rem; font-weight: 700; color: #f59e0b;">0</div>
                        <div style="font-size: 0.8rem; color: var(--text-secondary);">Puntos</div>
                    </div>
                    <div style="text-align: center;">
                        <div id="modalRewardsCount" style="font-size: 1.5rem; font-weight: 700; color: #10b981;">0</div>
                        <div style="font-size: 0.8rem; color: var(--text-secondary);">Recompensas</div>
                    </div>
                </div>

                <!-- Detailed Lists -->
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <!-- Lessons -->
                    <div>
                        <h4 style="font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-secondary); font-weight: 600; margin-bottom: 0.5rem;">Lecciones Completadas</h4>
                        <div id="modalLessonsList" style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                            <!-- Populated by JS -->
                        </div>
                    </div>

                    <!-- Minigames -->
                    <div>
                        <h4 style="font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-secondary); font-weight: 600; margin-bottom: 0.5rem;">Minijuegos Completados</h4>
                        <div id="modalMinigamesList" style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <!-- Populated by JS -->
                        </div>
                    </div>

                     <!-- Rewards -->
                     <div>
                        <h4 style="font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-secondary); font-weight: 600; margin-bottom: 0.5rem;">Recompensas Desbloqueadas</h4>
                        <div id="modalRewardsList" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 0.5rem;">
                            <!-- Populated by JS -->
                        </div>
                    </div>
                </div>

            </div>
            
            <div style="padding: 1rem 1.5rem; background: #f9fafb; border-top: 1px solid #e5e7eb; text-align: right;">
                <button onclick="closeUserDetailsModal()" class="btn btn-primary">Cerrar</button>
            </div>
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

        // User Details Modal Functions
        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('es-ES', options);
        }

        function openUserDetailsModal(user) {
            const modal = document.getElementById('userDetailsModal');
            
            // Basic Info
            document.getElementById('modalAvatar').innerText = user.name.substring(0, 2).toUpperCase();
            document.getElementById('modalUserName').innerText = user.name;
            document.getElementById('modalName').innerText = user.name;
            document.getElementById('modalUsername').innerText = user.username;
            document.getElementById('modalEmail').innerText = user.email;
            
            document.getElementById('modalJoined').innerText = formatDate(user.created_at);

            // Stats
            document.getElementById('modalLessonsCount').innerText = user.lecciones.length;
            
            let totalPoints = 0;
            user.puntos.forEach(p => totalPoints += p.puntos_obtenidos);
            document.getElementById('modalPoints').innerText = totalPoints;
            
            document.getElementById('modalRewardsCount').innerText = user.recompensas.length;

            // Lessons List
            const lessonsList = document.getElementById('modalLessonsList');
            lessonsList.innerHTML = '';
            if (user.lecciones.length > 0) {
                user.lecciones.sort((a, b) => new Date(b.fecha_completado) - new Date(a.fecha_completado)); // Sort by completion date
                user.lecciones.forEach(l => {
                    const badge = document.createElement('span');
                    badge.style.cssText = 'background: #eff6ff; color: var(--primary-color); padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 500; border: 1px solid #dbeafe;';
                    const lessonTitle = l.leccion ? l.leccion.titulo : 'Lección Eliminada';
                    const completionDate = l.fecha_completada ? ` (${formatDate(l.fecha_completada)})` : '';
                    badge.innerText = `${lessonTitle}${completionDate}`;
                    lessonsList.appendChild(badge);
                });
            } else {
                lessonsList.innerHTML = '<span style="color: var(--text-secondary); font-size: 0.9rem;">Sin lecciones completadas.</span>';
            }

            // Minigames List (using puntos)
            const minigamesList = document.getElementById('modalMinigamesList');
            minigamesList.innerHTML = '';
            if (user.puntos.length > 0) {
                user.puntos.sort((a, b) => new Date(b.fecha_completado) - new Date(a.fecha_completado));
                user.puntos.forEach(p => {
                    const item = document.createElement('div');
                    item.style.cssText = 'background: #f0fdf4; color: #16a34a; padding: 0.5rem 0.75rem; border-radius: 0.5rem; font-size: 0.9rem; display: flex; justify-content: space-between; align-items: center;';
                    const minigameTitle = p.nivel ? p.nivel.nombre : 'Nivel Desconocido';
                    const completionDate = p.fecha_completado ? formatDate(p.fecha_completado) : 'Fecha desconocida';
                    item.innerHTML = `<span>${minigameTitle}</span><span style="font-size: 0.8rem; color: #4b5563;">${completionDate}</span>`;
                    minigamesList.appendChild(item);
                });
            } else {
                minigamesList.innerHTML = '<span style="color: var(--text-secondary); font-size: 0.9rem;">Sin minijuegos completados.</span>';
            }


            // Rewards List
            const rewardsList = document.getElementById('modalRewardsList');
            rewardsList.innerHTML = '';
            if (user.recompensas.length > 0) {
                user.recompensas.forEach(r => {
                    if (r.recompensa) {
                        const card = document.createElement('div');
                        card.style.cssText = 'background: white; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 0.5rem; text-align: center;';
                        
                        card.innerHTML = `
                            <div style="font-size: 2rem; margin-bottom: 0.25rem;">🏆</div>
                            <div style="font-size: 0.8rem; font-weight: 600; color: var(--text-main); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${r.recompensa.nombre}</div>
                        `;
                        rewardsList.appendChild(card);
                    }
                });
            } else {
                rewardsList.innerHTML = '<span style="color: var(--text-secondary); font-size: 0.9rem; grid-column: 1/-1;">Sin recompensas desbloqueadas.</span>';
            }

            modal.style.display = 'flex';
            setTimeout(() => modal.style.opacity = '1', 10);
        }

        function closeUserDetailsModal() {
            const modal = document.getElementById('userDetailsModal');
            modal.style.opacity = '0';
            setTimeout(() => modal.style.display = 'none', 300);
        }

        // Close modals on outside click
        window.onclick = function(event) {
            if (event.target.classList.contains('modal-overlay')) {
                closeEmailModal();
                closeResetModal();
                closeDeleteModal();
                closeUserDetailsModal();
            }
        }
    </script>
@endsection
