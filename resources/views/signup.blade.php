<!DOCTYPE html>
<html class="light" lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Registro - LESSA</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#136dec",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101822",
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        body {
            font-family: 'Lexend', sans-serif;
        }.custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #334155;
        }

        /* Adapted Styles from original signup.blade.php */
        :root {
            --strength-weak: #ff6b6b;
            --strength-moderate: #ffcc00;
            --strength-strong: #4CAF50;
            --strength-very-strong: #007bff;
        }

        /* Password Strength Indicator Styles */
        .password-strength-indicator {
            width: 100%;
            height: 6px;
            background-color: #e2e8f0;
            border-radius: 4px;
            margin-top: 8px;
            overflow: hidden;
            position: relative;
        }
        .dark .password-strength-indicator {
            background-color: #334155; 
        }

        .strength-bar {
            height: 100%;
            width: 0%;
            border-radius: 4px;
            transition: width 0.3s ease-in-out, background-color 0.3s ease-in-out;
        }

        .strength-text {
            font-size: 12px;
            text-align: right;
            margin-top: 5px;
            font-weight: 600;
            transition: color 0.3s ease-in-out;
        }

        .strength-text.weak { color: var(--strength-weak); }
        .strength-text.moderate { color: var(--strength-moderate); }
        .strength-text.strong { color: var(--strength-strong); }
        .strength-text.very-strong { color: var(--strength-very-strong); }

        .strength-bar.weak { background-color: var(--strength-weak); }
        .strength-bar.moderate { background-color: var(--strength-moderate); }
        .strength-bar.strong { background-color: var(--strength-strong); }
        .strength-bar.very-strong { background-color: var(--strength-very-strong); }

        /* Alerts */
        .alert {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 1rem;
            color: white;
        }
        .alert .left {
            display: flex;
            gap: 10px;
            align-items: center;
            flex: 1;
        }
        .alert button.close {
            background: transparent;
            border: 0;
            color: inherit;
            font-size: 18px;
            cursor: pointer;
        }
        .alert-success {
            background: linear-gradient(90deg, #4CB944, #3fb86a);
        }
        .alert-error {
            background: linear-gradient(90deg, #d9534f, #c63b3b);
        }
        .fade-out {
            opacity: 0;
            transform: translateY(-8px);
            transition: opacity .35s, transform .35s;
        }
        .is-invalid {
            border-color: #d9534f !important;
        }
    </style>
</head>

<body class="bg-white dark:bg-background-dark min-h-screen flex font-display overflow-hidden">
    <div class="flex w-full min-h-screen">
        <div class="hidden lg:flex lg:w-1/2 bg-primary relative flex-col justify-between p-12 text-white">
            <div class="absolute inset-0 z-0">
                <img alt="People communicating" class="w-full h-full object-cover opacity-20"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBgGRDFDJ3zkfo4bmHAek8pcwwD1LZrQQ-BNCILGgRI0jjF99Z9sc4c5eAoRryJ6degXqXCz5EcRE4Rw4rdFMJgwfUg9RzJ5Em83-kicncTE2jUcdIf63TW5RWqkB33n2VWXnxvp5U_l9Z0sitHka700kIK-2692oGw7Qwv3vGP2pqvdu6-271zqzG8I5iTr2oW__qQrOipNeOEHN8svWVU2vfEcQgkKkjr37YCkExUYGm5L64TzYj1autT9zlBNV-PzBDvvHoh5nm1" />
                <div class="absolute inset-0 bg-primary/60 mix-blend-multiply"></div>
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-12">
                    <div class="w-20 h-20 bg-white p-2 rounded-lg shadow-lg flex items-center justify-center">
                        <img src="{{ asset('img/logo2.png') }}" alt="LESSA Logo" class="w-full h-full object-contain">
                    </div>
                    <span class="text-2xl font-bold tracking-tight">LESSA</span>
                </div>
            </div>
            <div class="relative z-10 max-w-lg">
                <h2 class="text-4xl font-bold leading-tight mb-6">Aprender señas es construir puentes de inclusión.</h2>
                <p class="text-xl text-blue-100 font-light leading-relaxed">
                    "La comunicación no solo es hablar, es entender el mundo desde otra perspectiva."
                </p>
            </div>
            <div class="relative z-10 flex items-center gap-4 text-sm text-blue-100">
                <span class="material-symbols-outlined">diversity_3</span>
                <span>Únete a más de 5,000 estudiantes en El Salvador</span>
            </div>
        </div>
        <div
            class="w-full lg:w-1/2 flex flex-col items-center justify-start h-screen overflow-y-auto custom-scrollbar p-8 sm:p-12 lg:p-16 bg-white dark:bg-slate-900">
            
             <div class="w-full max-w-[440px] mb-4">
                <a href="{{ route('/') }}" class="text-slate-500 hover:text-primary flex items-center gap-2 transition-colors font-medium">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Volver
                </a>
             </div>

            <div class="w-full max-w-[440px] my-auto">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-[#0d131b] dark:text-white mb-3">Crea tu cuenta</h1>
                    <p class="text-slate-500 dark:text-slate-400">Empieza tu viaje aprendiendo la Lengua de Señas
                        Salvadoreña.</p>
                </div>

                <!-- Alerts -->
                <div id="alerts" class="mb-6">
                    @if(session('status'))
                        <div class="alert alert-success" role="status" data-auto-hide>
                            <div class="left">
                                <i class="fa-solid fa-check-circle"></i>
                                <div class="msg">{{ session('status') }}</div>
                            </div>
                            <div class="actions"><button type="button" class="close">&times;</button></div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-error" role="alert" data-auto-hide>
                            <div class="left">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <div class="msg">{{ session('error') }}</div>
                            </div>
                            <div class="actions"><button type="button" class="close">&times;</button></div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-error" role="alert" data-auto-hide="false">
                            <div class="left">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <div class="msg">
                                    <div>Corrige los siguientes errores:</div>
                                    <ul class="list-disc pl-4 mt-1">
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="actions"><button type="button" class="close">&times;</button></div>
                        </div>
                    @endif
                </div>

                <form class="space-y-5" action="{{ route('signup.submit') }}" method="POST" novalidate>
                    @csrf
                    <a href="{{ route('auth.google') }}"
                        class="w-full flex items-center justify-center gap-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-[#0d131b] dark:text-white font-medium py-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-all shadow-sm">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="#4285F4"></path>
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853"></path>
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.26.81-.58z"
                                fill="#FBBC05"></path>
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335"></path>
                        </svg>
                        Registrarse con Google
                    </a>
                    <div class="relative flex items-center py-2">
                        <div class="flex-grow border-t border-slate-200 dark:border-slate-700"></div>
                        <span class="flex-shrink mx-4 text-slate-400 text-xs font-medium uppercase tracking-wider">o
                            regístrate con correo</span>
                        <div class="flex-grow border-t border-slate-200 dark:border-slate-700"></div>
                    </div>
                    
                    <div class="flex flex-col gap-2">
                        <label class="text-[#0d131b] dark:text-slate-200 text-sm font-semibold">Nombre real</label>
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">person</span>
                            <input name="name" value="{{ old('name') }}"
                                class="form-input w-full pl-12 pr-4 py-3 rounded-xl border border-[#cfd9e7] dark:border-slate-700 bg-white dark:bg-slate-800 text-[#0d131b] dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary placeholder:text-slate-400 {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                placeholder="Ej. Juan Pérez" type="text" required />
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-[#0d131b] dark:text-slate-200 text-sm font-semibold">Nombre de
                            usuario</label>
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">alternate_email</span>
                            <input name="username" value="{{ old('username') }}"
                                class="form-input w-full pl-12 pr-4 py-3 rounded-xl border border-[#cfd9e7] dark:border-slate-700 bg-white dark:bg-slate-800 text-[#0d131b] dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary placeholder:text-slate-400 {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                placeholder="juan_lessa23" type="text" required />
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-[#0d131b] dark:text-slate-200 text-sm font-semibold">Correo
                            electrónico</label>
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">mail</span>
                            <input name="email" value="{{ old('email') }}"
                                class="form-input w-full pl-12 pr-4 py-3 rounded-xl border border-[#cfd9e7] dark:border-slate-700 bg-white dark:bg-slate-800 text-[#0d131b] dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary placeholder:text-slate-400 {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                placeholder="tu@correo.com" type="email" required />
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-[#0d131b] dark:text-slate-200 text-sm font-semibold">Contraseña</label>
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">lock</span>
                            <input id="password" name="password"
                                class="form-input w-full pl-12 pr-12 py-3 rounded-xl border border-[#cfd9e7] dark:border-slate-700 bg-white dark:bg-slate-800 text-[#0d131b] dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary placeholder:text-slate-400 {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="Crea una contraseña segura" type="password" required />
                            <button
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors focus:outline-none"
                                type="button" onclick="togglePasswordVisibility('password')">
                                <span class="material-symbols-outlined text-xl">visibility</span>
                            </button>
                        </div>
                        <!-- Strength Indicator -->
                        <div class="password-strength-indicator">
                            <div id="strength-bar" class="strength-bar"></div>
                        </div>
                        <div id="strength-text" class="strength-text"></div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-[#0d131b] dark:text-slate-200 text-sm font-semibold">Repetir
                            contraseña</label>
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">lock</span>
                            <input id="password_confirmation" name="password_confirmation"
                                class="form-input w-full pl-12 pr-12 py-3 rounded-xl border border-[#cfd9e7] dark:border-slate-700 bg-white dark:bg-slate-800 text-[#0d131b] dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary placeholder:text-slate-400"
                                placeholder="Repite la contraseña" type="password" required />
                            <button
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors focus:outline-none"
                                type="button" onclick="togglePasswordVisibility('password_confirmation')">
                                <span class="material-symbols-outlined text-xl">visibility</span>
                            </button>
                        </div>
                    </div>

                    <button
                        class="signup-btn w-full bg-primary text-white font-bold py-4 rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-primary/25 active:scale-[0.98] mt-2 disabled:opacity-60 disabled:cursor-not-allowed"
                        type="submit" disabled>
                        Crear cuenta
                    </button>
                </form>
                <div class="mt-10 text-center pb-8">
                    <p class="text-slate-500 dark:text-slate-400">
                        ¿Ya tienes una cuenta?
                        <a class="text-primary font-bold hover:underline ml-1" href="{{ route('login') }}">Inicia sesión</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Alert closing logic
            document.querySelectorAll('.alert .close').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const alert = btn.closest('.alert');
                    if (!alert) return;
                    alert.classList.add('fade-out');
                    setTimeout(() => alert.remove(), 350);
                });
            });

            // Auto-hide alerts
            document.querySelectorAll('.alert[data-auto-hide]').forEach(alert => {
                const timeout = 7000;
                setTimeout(() => {
                    if (!document.body.contains(alert)) return;
                    alert.classList.add('fade-out');
                    setTimeout(() => alert.remove(), 350);
                }, timeout);
            });

            // Focus first invalid field
            const firstInvalid = document.querySelector('.is-invalid');
            if (firstInvalid) firstInvalid.focus();

            // Password Strength Logic
            const passwordInput = document.getElementById('password');
            const strengthBar = document.getElementById('strength-bar');
            const strengthText = document.getElementById('strength-text');
            const submitBtn = document.querySelector('.signup-btn');

            if (passwordInput && strengthBar && strengthText) {
                // Initial check in case of browser autofill
                updatePasswordStrength(passwordInput.value);

                passwordInput.addEventListener('input', function () {
                    updatePasswordStrength(this.value);
                });

                function updatePasswordStrength(password) {
                    let score = 0;
                    let feedback = '';
                    let strengthLevel = 'none';

                    const hasLowercase = /[a-z]/.test(password);
                    const hasUppercase = /[A-Z]/.test(password);
                    const hasNumber = /[0-9]/.test(password);
                    const hasSymbol = /[^a-zA-Z0-9]/.test(password);

                    if (password.length >= 8) score += 1;
                    if (password.length >= 10) score += 1;
                    if (password.length >= 12) score += 1;

                    if (hasLowercase) score += 1;
                    if (hasUppercase) score += 1;
                    if (hasNumber) score += 1;
                    if (hasSymbol) score += 1;

                    if (password.length === 0) {
                        strengthLevel = 'none';
                        feedback = '';
                    } else if (score < 3) {
                        strengthLevel = 'weak';
                        feedback = 'Débil';
                        if (password.length < 8) feedback += ' (min. 8 chars)';
                    } else if (score < 5) {
                        strengthLevel = 'moderate';
                        feedback = 'Moderada';
                    } else if (score < 7) {
                        strengthLevel = 'strong';
                        feedback = 'Fuerte';
                    } else {
                        strengthLevel = 'very-strong';
                        feedback = 'Muy Fuerte';
                    }

                    // Update UI
                    strengthBar.style.width = (score / 7) * 100 + '%';
                    strengthBar.className = 'strength-bar ' + strengthLevel;
                    strengthText.textContent = feedback;
                    strengthText.className = 'strength-text ' + strengthLevel;

                    // Enable/Disable Submit Button
                    // Requirement: Block until password meets characteristics.
                    // Assuming "Moderate" (score >= 3) is the threshold where it starts being acceptable.
                    
                    if (score >= 3) {
                        submitBtn.disabled = false;
                        submitBtn.title = "Listo para registrarse";
                    } else {
                        submitBtn.disabled = true;
                        submitBtn.title = "La contraseña es demasiado débil";
                    }
                }
            }
        });

        // Toggle visibility helper
        function togglePasswordVisibility(id) {
            const input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
</body>

</html>