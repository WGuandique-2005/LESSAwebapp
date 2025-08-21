<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LESSA - Modern Navbar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #4A90E2;
            --light-blue: #6BB5FF;
            --accent-yellow: #FFD166;
            --text-color: #333;
            --white-color: #ffffff;
            --shadow-light: rgba(0, 0, 0, 0.1);
            --shadow-medium: rgba(0, 0, 0, 0.2);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f8f9fa;
            line-height: 1.6;
            padding-top: 80px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 2rem;
            background-color: var(--primary-blue);
            color: var(--white-color);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            border-radius: 0;
            box-shadow: 0 6px 12px var(--shadow-medium);
            transition: all 0.3s ease;
        }

        .navbar:hover {
            box-shadow: 0 8px 16px var(--shadow-medium);
        }

        .navbar img {
            filter: brightness(0) invert(1);
            height: 50px;
            transition: transform 0.3s ease;
        }

        .navbar img:hover {
            transform: scale(1.05);
        }

        .nav-right-icons {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .menu {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .menu a {
            color: var(--white-color);
            text-decoration: none;
            font-weight: 600;
            padding: 5px 0;
            position: relative;
            transition: color 0.3s ease, transform 0.2s ease;
        }

        .menu a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--accent-yellow);
            transition: width 0.3s ease;
        }

        .menu a:hover {
            color: var(--accent-yellow);
            transform: translateY(-2px);
        }

        .menu a:hover::after {
            width: 100%;
        }

        /* Avatar Styles */
        .avatar-container {
            position: relative;
            cursor: pointer;
            z-index: 1050;
        }

        .avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: var(--accent-yellow);
            color: var(--primary-blue);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            font-size: 1.2rem;
            border: 2px solid var(--white-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .avatar:hover {
            transform: scale(1.08);
            box-shadow: 0 0 0 4px var(--light-blue);
        }

        .avatar-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background-color: var(--white-color);
            border-radius: 8px;
            box-shadow: 0 4px 10px var(--shadow-medium);
            min-width: 180px;
            display: none;
            /* Hidden by default */
            flex-direction: column;
            padding: 10px 0;
            z-index: 1040;
            /* Lower than avatar-container, but still high */
        }

        .avatar-dropdown.show {
            display: flex;
        }

        .avatar-dropdown a {
            color: var(--text-color);
            padding: 10px 15px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.2s ease, color 0.2s ease;
            display: block;
        }

        .avatar-dropdown a:hover {
            background-color: var(--light-blue);
            color: var(--white-color);
            border-radius: 0;
        }

        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 6px;
            padding: 5px;
            z-index: 1060;
        }

        .menu-toggle span {
            background-color: var(--white-color);
            height: 3px;
            width: 28px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .menu-toggle.open span:nth-child(1) {
            transform: translateY(9px) rotate(45deg);
        }

        .menu-toggle.open span:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.open span:nth-child(3) {
            transform: translateY(-9px) rotate(-45deg);
        }

        @media (max-width: 992px) {
            .menu {
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0.7rem 1.5rem;
            }

            .menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                right: 10px;
                background-color: var(--primary-blue);
                border-radius: 10px;
                width: 220px;
                padding: 1.5rem 1rem;
                box-shadow: 0 4px 10px var(--shadow-medium);
                gap: 1rem;
                align-items: flex-start;
                opacity: 0;
                transform: translateY(-10px);
                transition: opacity 0.3s ease, transform 0.3s ease;
                z-index: 1030;
            }

            .menu.show {
                display: flex;
                opacity: 1;
                transform: translateY(0);
            }

            .menu a {
                width: 100%;
                padding: 10px 15px;
                border-radius: 6px;
                background-color: rgba(255, 255, 255, 0.1);
                transition: background-color 0.2s ease, color 0.2s ease;
            }

            .menu a:hover {
                background-color: rgba(255, 255, 255, 0.2);
            }

            .menu a::after {
                display: none;
            }

            .menu-toggle {
                display: flex;
                /* Show hamburger in mobile */
            }

            .nav-right-icons {
                gap: 1rem;
            }
            .avatar-dropdown {
                top: calc(100% + 15px);
                right: 10px;
            }

            .menu.show~.menu a {
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 0.6rem 1rem;
            }

            .navbar img {
                height: 40px;
            }

            .avatar {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <img src="{{ asset('img/logo_sinfondo.png') }}" alt="Logo LESSA">

        <div class="nav-right-icons">
            <div class="menu-toggle" id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            @auth
                <div class="menu" id="mainMenu">
                    <a href="{{ route('home') }}">Inicio</a>
                    <a href="#">Practicar</a>
                    <a href="{{ route('aprender') }}">Aprender</a>
                    <a href="{{ route('info') }}">Info</a>
                    @guest
                        <a href="{{ route('login') }}">Login</a>
                    @endguest
                </div>

                <div class="avatar-container" id="avatarContainer">
                    <div class="avatar" id="userAvatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="avatar-dropdown" id="avatarDropdown">
                        <a href="{{ route('profile') }}">Ver Perfil</a>
                        <a href="{{ route('profile.edit') }}">Configurar Perfil</a>
                        <a href="{{ route('logout')}}">Cerrar Sesión</a>
                    </div>
                </div>
            @else
                <div class="menu" id="mainMenu">
                    <a href="{{ route('/') }}">Inicio</a>
                    <a href="{{ route('login') }}" class="button login-button">Login</a>
                </div>
            @endauth
        </div>
    </nav>

    <script>
        const mainMenu = document.getElementById('mainMenu');
        const menuToggle = document.getElementById('menuToggle');
        const avatarContainer = document.getElementById('avatarContainer');
        const avatarDropdown = document.getElementById('avatarDropdown');

        menuToggle.addEventListener('click', () => {
            mainMenu.classList.toggle('show');
            menuToggle.classList.toggle('open');

            if (avatarDropdown && avatarDropdown.classList.contains('show')) {
                avatarDropdown.classList.remove('show');
            }
        });

        if (avatarContainer) {
            avatarContainer.addEventListener('click', (event) => {
                event.stopPropagation();
                avatarDropdown.classList.toggle('show');

                if (mainMenu.classList.contains('show')) {
                    mainMenu.classList.remove('show');
                    menuToggle.classList.remove('open');
                }
            });

            document.addEventListener('click', (event) => {
                if (avatarContainer && !avatarContainer.contains(event.target) && avatarDropdown && !avatarDropdown.contains(event.target)) {
                    if (avatarDropdown.classList.contains('show')) {
                        avatarDropdown.classList.remove('show');
                    }
                }
            });
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                if (mainMenu.classList.contains('show')) {
                    mainMenu.classList.remove('show');
                    menuToggle.classList.remove('open');
                }
                if (avatarDropdown && avatarDropdown.classList.contains('show')) {
                    avatarDropdown.classList.remove('show');
                }
            }
        });
    </script>
</body>

</html>