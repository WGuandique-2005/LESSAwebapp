<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>LESSA - Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#1d4ed8", // Deep blue from the hero section
                        secondary: "#f59e0b", // Orange accent color
                        "background-light": "#f3f4f6", // Light gray background from screenshots
                        "surface-light": "#ffffff",
                        "text-light": "#1f2937",
                        "muted-light": "#6b7280",
                        "success": "#4CB944",
                        "error": "#d9534f",
                    },
                    fontFamily: {
                        display: ["Poppins", "sans-serif"],
                        body: ["Poppins", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                        'xl': '1rem',
                        '2xl': '1.5rem',
                    },
                },
            },
        };
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .bg-hero-pattern {
            background-image: linear-gradient(to bottom right, #1d4ed8, #3b82f6);
        }

        /* Alerts region styles adapted from original */
        .alert {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            font-weight: 500;
            font-size: 14px;
            animation: slideIn 0.3s ease;
            margin-bottom: 1rem;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #ef4444;
        }

        .fade-out {
            opacity: 0;
            transform: translateY(-8px);
            transition: opacity .35s, transform .35s;
        }

        .validation-list ul {
            margin-top: 4px;
            padding-left: 20px;
            list-style-type: disc;
        }
    </style>
</head>

<body class="bg-background-light text-text-light min-h-screen flex flex-col font-body transition-colors duration-300">
    <header> @include('partials.navbar') </header>

    <main class="flex-grow flex items-center justify-center p-4 sm:p-8 relative overflow-hidden">
        <div
            class="absolute top-0 left-0 w-full h-96 bg-hero-pattern opacity-10 skew-y-3 transform origin-top-left -z-10">
        </div>
        <div
            class="absolute bottom-0 right-0 w-96 h-96 bg-primary rounded-full filter blur-3xl opacity-5 -z-10 translate-y-1/2 translate-x-1/2">
        </div>

        <div
            class="bg-surface-light w-full max-w-5xl rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row min-h-[600px] border border-gray-100">
            <!-- Left Side: Visual -->
            <div
                class="hidden md:flex md:w-1/2 bg-hero-pattern p-12 flex-col justify-between text-white relative overflow-hidden">
                <div
                    class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10">
                </div>
                <div class="relative z-10">
                    <h2 class="text-3xl font-bold mb-4">¡Bienvenido de nuevo!</h2>
                    <p class="text-blue-100 text-lg">Tu camino para dominar el lenguaje de señas salvadoreño continúa
                        aquí.</p>
                </div>
                <div class="relative z-10 flex justify-center">
                    <div class="relative w-64 h-64">
                        <div class="absolute inset-0 bg-white opacity-20 rounded-full blur-2xl animate-pulse"></div>
                        <img alt="Students learning together"
                            class="relative rounded-2xl shadow-lg border-4 border-white/20 object-cover w-full h-full transform rotate-3 hover:rotate-0 transition-transform duration-500"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDJ65z2R4s6mqueWi21qMgIRUAczfAZNGQvgULCm6gvEAf2Z7oyeFFLGLjoraIHVbkiEAxbLAc9GOnaZ9-uIJQyuZ_d2Ik2YmXN3OK5o7Or7vrKYWwhqb83IGUZ0oioXZylq8-jD_-2MOKUb9aCc0XbM8VBc9Kg6IdRcs6XnjCk3sZrwHTCtLKAFbTsCIZodstyiazGNnbKe7szlQ3hxZKDXPr3Ahb_yXsrlptMkXpS31PS0ZjpjJJ7DLKQauLvDgx8AqkTseR1SWIY" />
                    </div>
                </div>
                <div class="relative z-10">
                    <blockquote class="italic text-blue-100 text-sm border-l-4 border-secondary pl-4">
                        "La inclusión comienza con la comunicación. Gracias por ser parte del cambio."
                    </blockquote>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Iniciar Sesión</h1>
                    <p class="text-muted-light text-sm">¿Aún no tienes una cuenta? <a
                            class="text-primary font-medium hover:underline transition-colors"
                            href="{{ route('signup') }}">Regístrate gratis</a></p>
                </div>

                <!-- Alerts region (status, error, validation) -->
                <div class="alerts mb-6" id="alerts" aria-live="polite" aria-atomic="true">
                    {{-- success message --}}
                    @if(session('status'))
                    <div class="alert alert-success" role="status" data-auto-hide>
                        <div class="flex gap-3">
                            <span class="material-icons-outlined text-lg">check_circle</span>
                            <div class="msg">{{ session('status') }}</div>
                        </div>
                        <button type="button" class="close opacity-50 hover:opacity-100 transition-opacity"
                            aria-label="Cerrar alerta">
                            <span class="material-icons-outlined text-lg">close</span>
                        </button>
                    </div>
                    @endif

                    {{-- generic error message --}}
                    @if(session('error'))
                    <div class="alert alert-error" role="alert" data-auto-hide>
                        <div class="flex gap-3">
                            <span class="material-icons-outlined text-lg">error_outline</span>
                            <div class="msg">{{ session('error') }}</div>
                        </div>
                        <button type="button" class="close opacity-50 hover:opacity-100 transition-opacity"
                            aria-label="Cerrar alerta">
                            <span class="material-icons-outlined text-lg">close</span>
                        </button>
                    </div>
                    @endif

                    {{-- validation errors --}}
                    @if ($errors->any())
                    <div class="alert alert-error" role="alert" data-auto-hide="false">
                        <div class="flex gap-3">
                            <span class="material-icons-outlined text-lg">report_problem</span>
                            <div class="msg validation-list">
                                <div class="font-bold">Se encontraron los siguientes errores:</div>
                                <ul class="text-xs mt-1">
                                    @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="close opacity-50 hover:opacity-100 transition-opacity"
                            aria-label="Cerrar errores">
                            <span class="material-icons-outlined text-lg">close</span>
                        </button>
                    </div>
                    @endif
                </div>

                <a href="{{ route('auth.google') }}"
                    class="w-full flex items-center justify-center gap-3 bg-white border border-gray-300 rounded-xl py-3 px-4 text-gray-700 font-medium hover:bg-gray-50 transition-all shadow-sm mb-6 group">
                    <img alt="Google Logo" class="w-5 h-5" src="https://img.icons8.com/?size=512&id=17949&format=png" />
                    <span class="group-hover:text-gray-900">Continuar con Google</span>
                </a>

                <div class="relative mb-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-surface-light text-muted-light">o ingresa con tu correo</span>
                    </div>
                </div>

                <form action="{{ route('login.submit') }}" class="space-y-5" method="POST" novalidate>
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Correo
                            electrónico</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons-outlined text-gray-400 text-xl">email</span>
                            </div>
                            <input
                                class="block w-full pl-10 pr-3 py-3 border {{ $errors->has('email') ? 'border-red-500 ring-2 ring-red-100' : 'border-gray-300' }} rounded-xl leading-5 bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition-all"
                                id="email" name="email" placeholder="ejemplo@correo.com" value="{{ old('email') }}"
                                required type="email" />
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-sm font-medium text-gray-700" for="password">Contraseña</label>
                            <a class="text-sm font-medium text-primary hover:text-blue-700 transition-colors"
                                href="{{ route('recuperar') }}">¿Olvidaste tu contraseña?</a>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons-outlined text-gray-400 text-xl">lock</span>
                            </div>
                            <input
                                class="block w-full pl-10 pr-10 py-3 border {{ $errors->has('password') ? 'border-red-500 ring-2 ring-red-100' : 'border-gray-300' }} rounded-xl leading-5 bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition-all"
                                id="password" name="password" placeholder="••••••••" required type="password" />
                            <div id="togglePassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer text-gray-400 hover:text-gray-600 transition-colors">
                                <span class="material-icons-outlined text-xl" id="passwordIcon">visibility_off</span>
                            </div>
                        </div>
                    </div>
                    <button
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-primary hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all transform active:scale-[0.98]"
                        type="submit">
                        Ingresar ahora
                    </button>
                </form>
            </div>
        </div>
        <p class="absolute bottom-4 text-xs text-muted-light text-center w-full">
            © 2026 LESSA — Todos los derechos reservados
        </p>
    </main>

    <script>
        (function () {
            // Alert manual close
            document.querySelectorAll('.alert .close').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const alert = btn.closest('.alert');
                    if (!alert) return;
                    alert.classList.add('fade-out');
                    setTimeout(() => alert.remove(), 350);
                });
            });

            // Auto-hide success/error status alerts
            document.querySelectorAll('.alert[data-auto-hide]').forEach(alert => {
                setTimeout(() => {
                    if (!document.body.contains(alert)) return;
                    alert.classList.add('fade-out');
                    setTimeout(() => alert.remove(), 350);
                }, 7000);
            });

            // Password visibility toggle
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            const passwordIcon = document.querySelector('#passwordIcon');

            if (togglePassword && password) {
                togglePassword.addEventListener('click', function () {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    passwordIcon.textContent = type === 'password' ? 'visibility_off' : 'visibility';
                });
            }

            // Focus first invalid field
            @if ($errors -> any())
                const firstInvalid = document.querySelector('.border-red-500');
            if (firstInvalid) firstInvalid.focus();
            @endif
        })();
    </script>
</body>

</html>