<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Acceso No Autorizado | LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --text-main: #1f2937;
            --text-secondary: #6b7280;
            --bg-color: #f3f4f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 1rem;
        }

        .error-container {
            background: white;
            padding: 3rem 2rem;
            border-radius: 1.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            max-width: 500px;
            width: 100%;
        }

        .icon-container {
            width: 80px;
            height: 80px;
            background-color: #fee2e2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }

        .icon-container i {
            font-size: 2.5rem;
            color: #dc2626;
        }

        h1 {
            font-size: 4rem;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 1rem;
        }

        p {
            color: var(--text-secondary);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="icon-container">
            <i class="fas fa-lock"></i>
        </div>
        <h1>403</h1>
        <h2>Acceso Restringido</h2>
        <p>Lo sentimos, no tienes permisos para acceder a esta página. Si crees que esto es un error, contacta al administrador.</p>
        <a href="{{ route('home') }}" class="btn">
            <i class="fas fa-home"></i> Volver al Inicio
        </a>
    </div>
</body>
</html>
