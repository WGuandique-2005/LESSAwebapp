<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - LESSA</title>
</head>
<body>
    <header>
        @include('partials.navbar')
    </header>
    <h1>Bienvenido, {{ Auth::user()->name }}</h1>

    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
    <p><strong>Username:</strong> {{ Auth::user()->username }}</p>

    <a href="{{ route('logout') }}">Cerrar sesión</a>
    <footer>
        @include('partials.footer')
    </footer>
</body>
</html>