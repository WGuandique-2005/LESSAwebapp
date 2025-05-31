<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu perfil</title>
    <style>
        :root {
            --primary-color: #004AAD;
            --secondary-color: #4A90E2;
            --dark-color: #292f36;
            --light-color: #F5F5F5;
            --bg-color: #ffffff;
            --text-primary: #2d2d2d;
            --text-secondary: #6c757d;
            --border-color: #e0e0e0;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-primary);
        }

        .profile-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: var(--light-color);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .avatar-section {
            position: relative;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }
        .karma-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 2rem;
        }

        .karma-card {
            text-align: center;
            padding: 1.5rem;
            background: var(--light-color);
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .karma-value {
            font-size: 2rem;
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .karma-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>@include('partials.navbar')</header>
    <div class="profile-container">
        <header class="profile-header">
            <div class="avatar-section">
                <div class="profile-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            </div>
            <div>
                <h1>{{ $user->name }}</h1>
                <p>/{{ $user->username }}</p>
                <p>{{ $user->email }}</p>
            </div>
        </header>
        <div class="karma-stats">
            <div class="karma-card">
                <div class="karma-value"> {{ $user->created_at->format('d M Y') }}</div>
                <div class="karma-label">Te uniste a LESSA</div>
            </div>
        </div>
    </div>
    <footer>
        @include('partials.footer')
    </footer>
</body>
</html>