<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu perfil - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        xintegrity="sha512-Fo3rlalr+G/yqW8S8H5f+3zT1xZ6+K/5B5E1Q6Z8c2q5f8+5z7m3gD9c5O6Z7t0+7z9f+2V0P3p3P4p+1Q8+"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --primary-color: #004AAD;
            /* Darker Blue */
            --secondary-color: #4A90E2;
            /* Lighter Blue */
            --accent-color: #FF6B35;
            /* Orange for accents/buttons */
            --dark-color: #292f36;
            --light-color: #F5F5F5;
            --bg-color: #ffffff;
            --text-primary: #2d2d2d;
            --text-secondary: #6c757d;
            --border-color: #e0e0e0;
            --danger-color: #dc3545;
            /* Red for delete actions */
            --error-color: #EF4444; /* Tailwind red-500 */
            --success-color: #22C55E; /* Tailwind green-500 */

            --spacing-xs: 0.5rem;
            --spacing-sm: 0.75rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --spacing-xxl: 3rem;

            --font-size-sm: 0.875rem;
            --font-size-base: 1rem;
            --font-size-lg: 1.25rem;
            --font-size-xl: 1.5rem;
            --font-size-xxl: 2rem;
            --font-size-h1: 2.5rem;

            --border-radius-sm: 8px;
            --border-radius-md: 12px;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition-speed: 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--light-color);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .profile-container {
            max-width: 1200px;
            margin: var(--spacing-xl) auto;
            padding: 0 var(--spacing-md);
            flex-grow: 1; /* Allows container to grow and push footer down */
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-xs);
            margin-bottom: var(--spacing-lg);
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color var(--transition-speed);
        }

        .back-button:hover {
            color: var(--accent-color);
        }

        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--spacing-xl);
            margin-bottom: var(--spacing-xl);
            padding: var(--spacing-xl);
            background: var(--bg-color);
            border-radius: var(--border-radius-md);
            box-shadow: var(--shadow-md);
            text-align: center;
        }

        .avatar-section {
            position: relative;
            display: inline-block;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--font-size-h1);
            color: white;
            font-weight: 600;
            border: 4px solid var(--primary-color);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .change-avatar-button {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background-color: var(--accent-color);
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--font-size-base);
            cursor: pointer;
            border: 2px solid var(--bg-color);
            box-shadow: var(--shadow-sm);
            transition: background-color var(--transition-speed);
        }

        .change-avatar-button:hover {
            background-color: var(--primary-color);
        }

        .profile-info h1 {
            font-size: var(--font-size-h1);
            margin-bottom: var(--spacing-xs);
            color: var(--dark-color);
        }

        .profile-info p {
            font-size: var(--font-size-base);
            color: var(--text-secondary);
            margin-bottom: var(--spacing-xs);
        }

        .profile-info p strong {
            color: var(--text-primary);
        }

        .profile-info .username {
            font-size: var(--font-size-lg);
            font-weight: 500;
            color: var(--primary-color);
            margin-bottom: var(--spacing-sm);
        }

        .karma-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        }

        .karma-card {
            text-align: center;
            padding: var(--spacing-lg);
            background: var(--bg-color);
            border-radius: var(--border-radius-md);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            transition: transform var(--transition-speed), box-shadow var(--transition-speed);
        }

        .karma-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .karma-value {
            font-size: var(--font-size-xxl);
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: var(--spacing-xs);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--spacing-xs);
        }

        .karma-value i {
            color: var(--accent-color);
            font-size: var(--font-size-xl);
        }

        .karma-label {
            font-size: var(--font-size-base);
            color: var(--text-secondary);
            font-weight: 500;
        }

        .profile-actions {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-md);
            margin-top: var(--spacing-xl);
        }

        .action-button {
            padding: var(--spacing-md) var(--spacing-lg);
            border: none;
            border-radius: var(--border-radius-sm);
            font-size: var(--font-size-base);
            font-weight: 600;
            cursor: pointer;
            transition: background-color var(--transition-speed), transform 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--spacing-xs);
        }

        .action-button.primary {
            background-color: var(--primary-color);
            color: white;
        }

        .action-button.primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .action-button.danger {
            background-color: var(--danger-color);
            color: white;
        }

        .action-button.danger:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }

        footer {
            margin-top: auto; /* Pushes footer to the bottom */
        }

        /* Responsive adjustments */
        @media (min-width: 768px) {
            .profile-header {
                flex-direction: row;
                text-align: left;
                align-items: flex-start;
            }

            .profile-info {
                flex-grow: 1;
            }

            .profile-actions {
                flex-direction: row;
                justify-content: flex-end;
            }
        }

        .feedback-message {
            text-align: center;
            margin-bottom: 16px;
            padding: 10px;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 0.95em;
        }

        .feedback-message.success {
            color: var(--success-color);
            background-color: rgba(34, 197, 94, 0.1); /* Light green background */
            border: 1px solid var(--success-color);
        }

        .feedback-message.error {
            color: var(--error-color);
            background-color: rgba(239, 68, 68, 0.1)
            border: 1px solid var(--error-color);
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.85em;
            margin-top: -10px;
            margin-bottom: 6px;
            display: block;
        }
        @media (max-width: 767px) {
            .profile-container {
                margin: var(--spacing-lg) auto;
            }

            .profile-header {
                padding: var(--spacing-lg);
                gap: var(--spacing-lg);
            }

            .profile-avatar {
                width: 100px;
                height: 100px;
                font-size: var(--font-size-xl);
            }



            .profile-info h1 {
                font-size: var(--font-size-xxl);
            }

            .profile-info p,
            .profile-info .username {
                font-size: var(--font-size-sm);
            }

            .karma-stats {
                grid-template-columns: 1fr;
                gap: var(--spacing-md);
            }

            .karma-card {
                padding: var(--spacing-md);
            }

            .karma-value {
                font-size: var(--font-size-xl);
            }

            .karma-value i {
                font-size: var(--font-size-lg);
            }

            .karma-label {
                font-size: var(--font-size-sm);
            }

            .action-button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <header>@include('partials.navbar')</header>
    @if(session('status'))
        <p class="feedback-message success">
            {{ session('status') }}
        </p>
    @endif
    @if(session('error'))
        <p class="feedback-message error">
            {{ session('error') }}
        </p>
    @endif
    <div class="profile-container">
        <a href="{{ route('home') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Volver
        </a>

        <header class="profile-header">
            <div class="avatar-section">
                @if ($user->avatar_url)
                    <div class="profile-avatar">
                        <img src="{{ $user->avatar_url }}" alt="User Avatar">
                    </div>
                @else
                    <div class="profile-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                @endif
            </div>
            <div class="profile-info">
                <h1>{{ $user->name }}</h1>
                <p class="username">/{{ $user->username }}</p>
                <p><i class="fas fa-envelope"></i> {{ $user->email }}</p>
            </div>
        </header>

        <div class="karma-stats">
            <div class="karma-card">
                <div class="karma-value">
                    <i class="fas fa-calendar-alt"></i> {{ $user->created_at->format('d M Y') }}
                </div>
                <div class="karma-label">Te uniste a LESSA</div>
            </div>
        </div>

        <div class="profile-actions">
            <a href="{{ route('profile.edit') }}" class="action-button primary">
                <i class="fas fa-edit"></i> Editar Perfil
            </a>
            <a href="{{ route('delete.account') }}" class="action-button danger" id="deleteAccountButton">
                <i class="fas fa-trash-alt"></i> Eliminar Cuenta
            </a>
        </div>
    </div>

    <footer>
        @include('partials.footer')
    </footer>

    <script>
        addEventListener('DOMContentLoaded', function() {
            const deleteButton = document.getElementById('deleteAccountButton');
            deleteButton.addEventListener('click', function(event) {
                event.preventDefault();
                if (confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción es irreversible.')) {
                    window.location.href = deleteButton.href;
                }
            });
        });
    </script>
</body>

</html>
