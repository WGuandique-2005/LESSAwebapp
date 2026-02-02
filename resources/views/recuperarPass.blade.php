<!DOCTYPE html>
<html class="light" lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Recuperar Contraseña - LESSA</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0"
        rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#143168", // Deep brand blue from the image
                        secondary: "#f39200", // Brighter orange accent
                        "background-light": "#f8fafc",
                        "background-dark": "#020617",
                    },
                    fontFamily: {
                        display: ["Lexend", "sans-serif"],
                        sans: ["Lexend", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "12px",
                    },
                },
            },
        };
    </script>
    <style>
        body {
            font-family: 'Lexend', sans-serif;
        }

        .inclusive-bg {
            background: linear-gradient(rgba(20, 49, 104, 0.85), rgba(20, 49, 104, 0.95)), url('https://images.unsplash.com/photo-1531545514256-b1400bc00f31?q=80&w=1974&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
        
        /* Alert animations */
        .fade-out {
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
    <main class="flex min-h-screen flex-col lg:flex-row">
        <section
            class="hidden lg:flex lg:w-1/2 inclusive-bg p-12 flex-col justify-between text-white relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex items-center gap-3">
                    <div class="w-20 h-20 bg-white p-2 rounded-lg shadow-lg flex items-center justify-center">
                        <img src="{{ asset('img/logo2.png') }}" alt="LESSA Logo" class="w-full h-full object-contain">
                    </div>
                    <span class="text-2xl font-bold tracking-wider">LESSA</span>
                </div>
            </div>
            <div class="relative z-10 max-w-lg">
                <h2 class="text-4xl font-bold mb-6 leading-tight">Fortaleciendo la inclusión a través del aprendizaje.
                </h2>
                <p class="text-lg text-slate-200">
                    Nuestra plataforma te ofrece las herramientas necesarias para dominar la Lengua de Señas Salvadoreña
                    de forma interactiva y gamificada.
                </p>
            </div>
            <div class="relative z-10 flex gap-4 text-sm text-slate-300">
                <span>©{{date('Y')}} LESSA Educativo</span>
                <span>•</span>
                <a class="hover:text-white transition-colors" href="#">Privacidad</a>
            </div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-secondary/20 rounded-full blur-3xl"></div>
        </section>
        <section
            class="flex-1 flex flex-col items-center justify-center p-6 lg:p-12 bg-background-light dark:bg-background-dark">
            <div class="lg:hidden w-full max-w-md mb-12 flex items-center justify-center gap-2">
                <div class="bg-primary p-2 rounded-lg">
                    <svg fill="none" height="30" viewBox="0 0 40 40" width="30" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 20C10 14.4772 14.4772 10 20 10C25.5228 10 30 14.4772 30 20C30 25.5228 25.5228 30 20 30"
                            stroke="#f39200" stroke-linecap="round" stroke-width="4"></path>
                        <path d="M15 20C15 17.2386 17.2386 15 20 15C22.7614 15 25 17.2386 25 20" stroke="white"
                            stroke-linecap="round" stroke-width="4"></path>
                    </svg>
                </div>
                <span class="text-2xl font-bold tracking-wider text-primary dark:text-white">LESSA</span>
            </div>
            <div class="w-full max-w-md">
                <div class="mb-10 text-center lg:text-left">
                    <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-3">Recuperar Contraseña</h1>
                    <p class="text-slate-600 dark:text-slate-400">
                        Ingresa tu correo electrónico para recibir un código de recuperación.
                    </p>
                </div>

                <!-- Alerts Logic -->
                <div id="alerts" class="mb-6 space-y-4">
                    @if(session('status'))
                        <div class="flex items-center justify-between p-4 bg-green-500 text-white rounded-xl shadow-lg shadow-green-500/20" data-auto-hide>
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-rounded">check_circle</span>
                                <span class="font-medium text-sm">{{ session('status') }}</span>
                            </div>
                            <button class="close hover:bg-white/20 p-1 rounded-full text-white transition-colors">
                                <span class="material-symbols-rounded text-lg">close</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="flex items-center justify-between p-4 bg-red-500 text-white rounded-xl shadow-lg shadow-red-500/20" data-auto-hide>
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-rounded">error</span>
                                <span class="font-medium text-sm">{{ session('error') }}</span>
                            </div>
                            <button class="close hover:bg-white/20 p-1 rounded-full text-white transition-colors">
                                <span class="material-symbols-rounded text-lg">close</span>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="p-4 bg-red-500 text-white rounded-xl shadow-lg shadow-red-500/20" data-auto-hide="false">
                            <div class="flex items-start justify-between">
                                <div class="flex gap-3">
                                    <span class="material-symbols-rounded mt-0.5">error</span>
                                    <div class="text-sm">
                                        <p class="font-bold mb-1">Corrige los siguientes errores:</p>
                                        <ul class="list-disc pl-4 space-y-1">
                                            @foreach($errors->all() as $err)
                                                <li>{{ $err }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <button class="close hover:bg-white/20 p-1 rounded-full text-white transition-colors">
                                    <span class="material-symbols-rounded text-lg">close</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <form class="space-y-6" action="{{ route('recuperarPass') }}" method="POST" novalidate>
                    @csrf
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="email">
                            Correo electrónico
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                                <span class="material-symbols-rounded text-xl">mail</span>
                            </span>
                            <input
                                class="block w-full pl-11 pr-4 py-3 bg-white dark:bg-slate-900 border rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none text-slate-900 dark:text-white {{ $errors->has('email') ? 'border-red-500 focus:ring-red-500' : 'border-slate-200 dark:border-slate-800' }}"
                                id="email" name="email" placeholder="ejemplo@correo.com" value="{{ old('email') }}" required type="email" />
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs font-bold flex items-center gap-1 mt-1">
                                <span class="material-symbols-rounded text-sm">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <button
                        class="w-full py-3.5 px-4 bg-primary hover:bg-opacity-90 text-white font-semibold rounded-xl shadow-lg shadow-primary/20 transition-all transform active:scale-[0.98] flex items-center justify-center gap-2"
                        type="submit">
                        <span>Enviar código</span>
                        <span class="material-symbols-rounded text-lg">send</span>
                    </button>
                    
                    @if(session('status'))
                    <div class="text-center pt-2">
                         <a href="{{ route('newPass_view') }}" class="text-secondary font-bold hover:underline text-sm transition-all">
                            ¿Ya tienes el código? Cambia tu contraseña aquí.
                        </a>
                    </div>
                    @endif
                </form>
                <div class="mt-8 pt-8 border-t border-slate-100 dark:border-slate-800 text-center">
                    <a class="inline-flex items-center gap-2 text-primary dark:text-secondary font-medium hover:underline transition-all"
                        href="{{ route('login') }}">
                        <span class="material-symbols-rounded text-lg">arrow_back</span>
                        Volver al inicio de sesión
                    </a>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Close alert buttons
            document.querySelectorAll('.close').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const alert = this.closest('div[class*="bg-"]'); // Select the alert container
                    if (alert) {
                        alert.classList.add('fade-out');
                        setTimeout(() => alert.remove(), 300);
                    }
                });
            });

            // Auto-hide success/error alerts
            document.querySelectorAll('div[data-auto-hide]').forEach(alert => {
                const isPermanent = alert.getAttribute('data-auto-hide') === 'false';
                if (!isPermanent) {
                    setTimeout(() => {
                        if (document.body.contains(alert)) {
                            alert.classList.add('fade-out');
                            setTimeout(() => alert.remove(), 300);
                        }
                    }, 7000);
                }
            });

            // Focus first invalid input
            const firstInvalid = document.querySelector('.border-red-500');
            if (firstInvalid) firstInvalid.focus();
        });
    </script>
</body>

</html>