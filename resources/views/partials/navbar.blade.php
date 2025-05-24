<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .navbar {
            margin: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.7rem 1.5rem;
            background-color: #4A90E2;
            color: white;
            position: relative;
            border-radius: 8px;
        }

        .navbar img {
            height: 45px;
        }

        .menu {
            display: flex;
            gap: 1.5rem;
        }

        .menu a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .menu a:hover {
            color: #FFD166;
        }

        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .menu-toggle span {
            background-color: white;
            height: 3px;
            width: 25px;
            margin: 4px 0;
            border-radius: 2px;
        }

        @media (max-width: 768px) {
            .menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                right: 15px;
                background-color: #4A90E2;
                border-radius: 8px;
                width: 200px;
                padding: 1rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            }

            .menu.show {
                display: flex;
            }

            .menu-toggle {
                display: flex;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <img src="{{ asset('img/logo_sinfondo.png') }}" alt="Logo LESSA">
        <div class="menu-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="menu" id="menu">
            @if (Auth::check())
                <a href="#">Inicio</a>
                <a href="/logout">Logout</a>
                <a href="#">Practicar</a>
                <a href="#">Aprender</a>
                <a href="#">Info</a>
                <a href="#">Perfil</a>
            @else
                <a href="#">Inicio</a>
                <a href="/login">Login</a>

                <a href="#">Info</a>
            @endif
        </div>
    </nav>
    <script>
        function toggleMenu() {
            document.getElementById('menu').classList.toggle('show');
        }
    </script>
</body>

</html>