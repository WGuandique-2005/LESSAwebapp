<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Nueva Contraseña - LESSA</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#1e3a8a", // Deep Blue
                        secondary: "#f59e0b", // Amber/Yellow for accents
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                        "strength-weak": "#ef4444",
                        "strength-moderate": "#eab308",
                        "strength-strong": "#22c55e",
                        "strength-very-strong": "#1e3a8a",
                    },
                    fontFamily: {
                        display: ["Poppins", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "1rem",
                    },
                },
            },
        };
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .bg-glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Alert animations */
        .fade-out {
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        /* Password Strength */
        .password-strength-indicator {
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
        }
        .dark .password-strength-indicator {
            background: #334155;
        }
        .strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
        }
        .strength-bar.weak { background-color: #ef4444; }
        .strength-bar.moderate { background-color: #eab308; }
        .strength-bar.strong { background-color: #22c55e; }
        .strength-bar.very-strong { background-color: #1e3a8a; }
        
        .strength-text {
            font-size: 0.75rem;
            text-align: right;
            margin-top: 4px;
            font-weight: 600;
        }
        .strength-text.weak { color: #ef4444; }
        .strength-text.moderate { color: #eab308; }
        .strength-text.strong { color: #22c55e; }
        .strength-text.very-strong { color: #1e3a8a; }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark min-h-screen flex overflow-x-hidden">
    <div class="hidden lg:flex lg:w-1/2 relative bg-primary items-center justify-center p-12 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-20">
            <img alt="Background pattern of people learning" class="w-full h-full object-cover grayscale"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDPX5lQ80hCK8Y4JURfc2MzC34ijspiXzDsqZ2Js_8W5n4nQgR2_aPzA7QThhX8mBE-4m91KoH2RsalzHmAfQNdLV84JfX_LG8Qj0DxLn8J28j_OXnzRFS7VfnNX3LXOmXYRWWCOaEFVV-47LH6AhfCmcf6f0TgP8ZTXOdKZaFjfqt5hJlEUIZXhV6DxWEOuTwDab8lHng-3hlkuqtxwLl5IutdGZ7FltD3bSKrbjq-MzBy1X0ipvRO_emN9zEI4R9tJZq3hHsQHOSJ" />
        </div>
        <div class="absolute inset-0 bg-gradient-to-br from-primary via-primary/90 to-transparent"></div>
        <div class="relative z-10 text-white max-w-lg">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-20 h-20 bg-white p-2 rounded-lg shadow-lg flex items-center justify-center">
                    <img src="{{ asset('img/logo2.png') }}" alt="LESSA Logo" class="w-full h-full object-contain">
                </div>
                <h1 class="text-4xl font-bold tracking-tight">LESSA</h1>
            </div>
            <h2 class="text-5xl font-extrabold leading-tight mb-6">
                Tu portal para aprender <span class="text-secondary">Lengua de Señas</span>.
            </h2>
            <p class="text-blue-100 text-lg mb-8 leading-relaxed">
                Únete a nuestra comunidad educativa y transforma la comunicación a través del aprendizaje interactivo y
                gamificado.
            </p>
            <div class="flex gap-4">
                <div class="flex -space-x-3 overflow-hidden">
                    <img alt="User 1" class="inline-block h-10 w-10 rounded-full ring-2 ring-primary"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCvp5fkNbgaToPwcnjS8-HlB6a4ONRWnlar8Ps5c81W5WwGMBDl00v_0lm0jkiEDzh0jVhEIyk4j0IIOwMqpUaAYkl4uUcylmJSC3kh28DTD7b8Txl7iGTq2HSScoHuC-ELy4czja6e_JTcTprs3qCMz2kf_zbreJqb7zrsnI7dowL1OduwfkFx4mTc1BMwnVcFHY5ARWrgJS3Zkzc7H5Si9_u-6L-qmDSd6-xtWSTQpbmfQ26_a1gqe5evb1pPj4g07IysYXwxPcmw" />
                    <img alt="User 2" class="inline-block h-10 w-10 rounded-full ring-2 ring-primary"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBP8GNUYTLO3bMcawh354rFbZPqYa7sPWguHKK7D1VUhgf0z3lYSpP9aJGwvtEHzT1li_-UMr34MAtYKUY1eHn3a0PaPBL5DcZZSplggAPs2Urc7wBVGwJh4UAJM2Ja5rqjpMDxGV-IWuxl3IzBwXGrA7ZEC_4Br37dj3mU3_QBcb4hNQn1qbhazsfwCtJGLfTCJsjQWXJF2TApK7Cm3REITp94yyCAhyNRO58lL67cq_rjYToFhGE7mAhBje5WGt241WvGygd2yBQ7" />
                    <img alt="User 3" class="inline-block h-10 w-10 rounded-full ring-2 ring-primary"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAv38rM-pLc98EUHtfTJ_A_fK0TwW2hHcRKfPBA1Xh5doKaK2O3V1iP9pRCKsA2QcGEqT5K1gOMdWRgqOp3wrFit6Qe7vApiFxHjLwpcgiUcChXoS6_sTKBgznueXKkgPave9UZ0vDbn3cRQzidwiZ_uPt3JcjG1Bf8OsFOFfh14hLySLp4rkWTgRts-4-dkWyFRGPLz7bMNcVQXEnBlGRXBQHVbq7x1HHnnjQOH3jvwcDtPFp79KPUQDVJCRqzsluj6LWav9GxF0ot" />
                </div>
                <div class="text-sm">
                    <span class="block font-semibold">Más de 5,000 estudiantes</span>
                    <span class="text-blue-200">aprendiendo hoy mismo</span>
                </div>
            </div>
        </div>
    </div>
    <div
        class="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 sm:p-12 md:p-20 bg-background-light dark:bg-background-dark min-h-screen overflow-y-auto">
        <div class="w-full max-w-md space-y-8 py-8">
            <div class="lg:hidden flex items-center gap-2 mb-10 justify-center">
                <div class="w-20 h-20 bg-white p-2 rounded-lg shadow-lg flex items-center justify-center">
                    <img src="{{ asset('img/logo2.png') }}" alt="LESSA Logo" class="w-full h-full object-contain">
                </div>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">LESSA</span>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Nueva Contraseña</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Ingresa el código de 6 dígitos enviado a tu correo y tu nueva contraseña.
                </p>
            </div>

            <!-- Alerts Logic -->
            <div id="alerts" class="space-y-4">
                @if(session('status'))
                    <div class="flex items-center justify-between p-4 bg-green-500 text-white rounded-xl shadow-lg shadow-green-500/20" data-auto-hide>
                        <div class="flex items-center gap-3">
                            <span class="material-icons">check_circle</span>
                            <span class="font-medium text-sm">{{ session('status') }}</span>
                        </div>
                        <button class="close hover:bg-white/20 p-1 rounded-full text-white transition-colors">
                            <span class="material-icons text-lg">close</span>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="flex items-center justify-between p-4 bg-red-500 text-white rounded-xl shadow-lg shadow-red-500/20" data-auto-hide>
                        <div class="flex items-center gap-3">
                            <span class="material-icons">error</span>
                            <span class="font-medium text-sm">{{ session('error') }}</span>
                        </div>
                        <button class="close hover:bg-white/20 p-1 rounded-full text-white transition-colors">
                            <span class="material-icons text-lg">close</span>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="p-4 bg-red-500 text-white rounded-xl shadow-lg shadow-red-500/20" data-auto-hide="false">
                        <div class="flex items-start justify-between">
                            <div class="flex gap-3">
                                <span class="material-icons mt-0.5">error</span>
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
                                <span class="material-icons text-lg">close</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            <form action="{{ route('newPass') }}" class="space-y-6" method="POST" novalidate>
                @csrf
                <!-- Token Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="token">
                        Código de recuperación
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span
                                class="material-icons text-gray-400 group-focus-within:text-primary transition-colors">vpn_key</span>
                        </div>
                        <input
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none placeholder-gray-400 {{ $errors->has('token') ? 'border-red-500 ring-red-500' : '' }}"
                            id="token" name="token" value="{{ old('token') }}" placeholder="Código de 6 dígitos"
                            required type="text" />
                    </div>
                    @error('token')
                        <p class="text-red-500 text-xs mt-1 flex items-center gap-1 font-semibold">
                            <span class="material-icons text-sm">error</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="password">
                        Nueva contraseña
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span
                                class="material-icons text-gray-400 group-focus-within:text-primary transition-colors">lock_open</span>
                        </div>
                        <input
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none placeholder-gray-400 {{ $errors->has('password') ? 'border-red-500 ring-red-500' : '' }}"
                            id="password" name="password" placeholder="Mínimo 8 caracteres"
                            required type="password" />
                    </div>
                    <div class="password-strength-indicator">
                        <div id="strength-bar" class="strength-bar"></div>
                    </div>
                    <div id="strength-text" class="strength-text"></div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1 flex items-center gap-1 font-semibold">
                            <span class="material-icons text-sm">error</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                        for="password_confirmation">
                        Confirmar contraseña
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span
                                class="material-icons text-gray-400 group-focus-within:text-primary transition-colors">lock</span>
                        </div>
                        <input
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none placeholder-gray-400"
                            id="password_confirmation" name="password_confirmation" placeholder="Confirma tu nueva contraseña"
                            required type="password" />
                    </div>
                </div>

                <button
                    class="w-full bg-primary hover:bg-blue-800 text-white font-semibold py-4 px-6 rounded-xl shadow-lg shadow-primary/25 transform active:scale-[0.98] transition-all flex items-center justify-center gap-2 group"
                    type="submit">
                    <span>Actualizar Contraseña</span>
                    <span
                        class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </button>
            </form>
        </div>
        <footer class="mt-auto pt-10 text-xs text-gray-400 dark:text-gray-600 text-center">
            {{ date('Y') }} LESSA. Todos los derechos reservados.
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Alert logic
            document.querySelectorAll('.close').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const alert = this.closest('div[class*="bg-"]');
                    if (alert) {
                        alert.classList.add('fade-out');
                        setTimeout(() => alert.remove(), 300);
                    }
                });
            });

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

            // Password strength logic
            const passwordInput = document.getElementById('password');
            const strengthBar = document.getElementById('strength-bar');
            const strengthText = document.getElementById('strength-text');

            if (passwordInput) {
                passwordInput.addEventListener('input', function(e) {
                    updateStrength(e.target.value);
                });
            }

            function updateStrength(password) {
                let score = 0;
                if (password.length >= 8) score++;
                if (password.length >= 10) score++;
                if (password.length >= 12) score++;
                if (/[a-z]/.test(password)) score++;
                if (/[A-Z]/.test(password)) score++;
                if (/[0-9]/.test(password)) score++;
                if (/[^a-zA-Z0-9]/.test(password)) score++;

                let level = 'weak';
                let feedback = 'Débil';

                if (score < 3) { level = 'weak'; feedback = 'Débil'; }
                else if (score < 5) { level = 'moderate'; feedback = 'Moderada'; }
                else if (score < 7) { level = 'strong'; feedback = 'Fuerte'; }
                else { level = 'very-strong'; feedback = 'Muy Fuerte'; }

                if (password.length === 0) {
                    strengthBar.style.width = '0%';
                    strengthText.textContent = '';
                } else {
                    strengthBar.style.width = Math.min((score / 7) * 100, 100) + '%';
                    strengthBar.className = 'strength-bar ' + level;
                    strengthText.textContent = feedback;
                    strengthText.className = 'strength-text ' + level;
                }
            }
        });
    </script>
</body>

</html>