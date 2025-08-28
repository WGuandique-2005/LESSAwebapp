<!-- resources/views/partials/footer_lessa.blade.php -->
<footer class="lessa-footer" role="contentinfo" aria-label="Pie de página LESSA">
    <style>
        /* Scoped footer styles to avoid collisions */
        .lessa-footer {
            --primary: #0A2463;
            --secondary: #3E92CC;
            --accent: #FFD166;
            --light: #F2F4F7;
            --dark: #1E1E24;
            --radius: 12px;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all .28s ease;
            font-family: 'Poppins', sans-serif;
            background: var(--dark);
            color: #fff;
            padding: 4rem 0 2rem;
        }

        .lessa-footer * {
            box-sizing: border-box;
        }

        .lessa-footer .lessa-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.25rem;
        }

        .lessa-footer .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2.25rem;
            margin-bottom: 2.25rem;
            align-items: start;
        }

        .lessa-footer .footer-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.25rem;
            color: #fff;
            margin-bottom: .5rem;
        }

        .lessa-footer .footer-logo img {
            height: 30px;
            display: block;
        }

        .lessa-footer p.footer-description {
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .lessa-footer .footer-heading {
            color: #fff;
            margin-bottom: 1rem;
            font-size: 1.05rem;
            font-weight: 700;
        }

        .lessa-footer .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: .5rem;
        }

        .lessa-footer .footer-links a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: var(--transition);
            padding-left: 0;
            display: inline-block;
        }

        .lessa-footer .footer-links a:hover,
        .lessa-footer .footer-links a:focus {
            color: var(--accent);
            transform: translateX(4px);
            outline: none;
        }

        .lessa-footer .contact-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: .6rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .lessa-footer .contact-list svg {
            vertical-align: middle;
            margin-right: .6rem;
            fill: currentColor;
            opacity: .95;
        }

        .lessa-footer .social-links {
            display: flex;
            gap: .6rem;
            margin-top: .6rem;
        }

        .lessa-footer .social-links a {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.06);
            color: #fff;
            text-decoration: none;
            transition: var(--transition);
        }

        .lessa-footer .social-links a:hover,
        .lessa-footer .social-links a:focus {
            background: var(--accent);
            color: var(--dark);
            transform: translateY(-4px);
        }

        .lessa-footer .copyright {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            opacity: .85;
            font-size: .95rem;
        }

        /* subtle reveal animation (will be toggled via .is-visible) */
        .lessa-footer .animate-on-scroll {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .6s ease, transform .6s ease;
        }

        .lessa-footer .is-visible {
            opacity: 1;
            transform: none;
        }

        @media (max-width:480px) {
            .lessa-footer {
                padding: 3rem 0 1.5rem;
            }

            .lessa-footer .lessa-container {
                padding: 0 1rem;
            }
        }
    </style>

    <div class="lessa-container">
        <div class="footer-content">
            <div class="animate-on-scroll">
                <div class="footer-logo">
                    <img src="{{ asset('img/logo2.png') }}" alt="LESSA logo" />
                    <span>LESSA</span>
                </div>
                <p class="footer-description">Plataforma de aprendizaje de Lengua de Señas Salvadoreña diseñada para
                    promover la inclusión y la comunicación.</p>
                <div class="social-links" aria-label="Redes sociales">
                    <a href="#" aria-label="LessA en Twitter">
                        <!-- twitter svg -->
                        <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M22 5.92c-.66.3-1.36.5-2.1.6.76-.46 1.34-1.18 1.6-2.04-.72.43-1.52.75-2.37.92C18.4 4.4 17.26 4 16 4c-1.97 0-3.56 1.6-3.56 3.57 0 .28.03.55.09.81C9.1 8.24 5.62 6.38 3.3 3.5c-.31.54-.49 1.16-.49 1.82 0 1.25.63 2.36 1.6 3.01-.58-.02-1.12-.18-1.6-.44v.04c0 1.75 1.25 3.21 2.9 3.54-.3.08-.62.12-.95.12-.23 0-.45-.02-.66-.06.45 1.4 1.76 2.42 3.31 2.45-1.21.95-2.73 1.52-4.38 1.52-.29 0-.58-.02-.86-.05C6.84 19.16 8.6 20 10.56 20c6.72 0 10.4-5.6 10.4-10.46v-.48c.72-.53 1.3-1.2 1.78-1.96-.66.3-1.37.5-2.1.6z" />
                        </svg>
                    </a>
                    <a href="https://www.youtube.com/@lessavirtual" aria-label="LessA en YouTube">
                        <!-- youtube svg -->
                        <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M23.5 6.2s-.2-1.64-.82-2.36C21.78 3 20.9 3 20.4 3H3.6c-.5 0-1.38 0-2.28.84C.7 4.56.5 6.2.5 6.2S.2 8.1.2 9.98v2.04C.2 14.86.5 16.8.5 16.8s.2 1.64.82 2.36C2.22 19.9 3.1 19.9 3.6 19.9h16.8c.5 0 1.38 0 2.28-.84.62-.72.82-2.36.82-2.36s.3-1.9.3-3.78V9.98c0-1.88-.3-3.78-.3-3.78zM9.8 14.5V7.5l6.6 3.5-6.6 3.5z" />
                        </svg>
                    </a>
                    <a href="#" aria-label="LessA en Facebook">
                        <!-- facebook svg -->
                        <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 5 3.66 9.14 8.44 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.88 3.77-3.88 1.09 0 2.23.2 2.23.2v2.45h-1.25c-1.23 0-1.61.77-1.61 1.56V12h2.75l-.44 2.89h-2.31v6.99C18.34 21.14 22 17 22 12z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="animate-on-scroll" aria-hidden="false">
                <h3 class="footer-heading">Enlaces rápidos</h3>
                <ul class="footer-links" aria-label="Enlaces rápidos">
                    <li><a href="{{ route('/') ?? '#' }}">Inicio</a></li>
                    <li><a href="{{ route('lecciones') ?? '#' }}">Lecciones</a></li>
                    <li><a href="{{ route('aprender') ?? '#' }}">Recursos</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </div>

            <div class="animate-on-scroll" aria-hidden="false">
                <h3 class="footer-heading">Recursos</h3>
                <ul class="footer-links">
                    <li><a href="#">Diccionario LESSA</a></li>
                    <li><a href="#">Guía de uso</a></li>
                    <li><a href="#">Preguntas frecuentes</a></li>
                </ul>
            </div>

            <div class="animate-on-scroll">
                <h3 class="footer-heading">Contacto</h3>
                <ul class="contact-list" aria-label="Información de contacto">
                    <li><span aria-hidden="true"><svg width="16" height="16" viewBox="0 0 24 24">
                                <path
                                    d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2zm0 2l-8 5L4 6h16z" />
                            </svg></span><span>wguandique2006@gmail.com</span></li>
                    <li><span aria-hidden="true"><svg width="16" height="16" viewBox="0 0 24 24">
                                <path
                                    d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.11-.21 11.36 11.36 0 003.55.57 1 1 0 011 1v3.8a1 1 0 01-1 1A18 18 0 014 5a1 1 0 011-1h3.79a1 1 0 011 1 11.36 11.36 0 00.57 3.55 1 1 0 01-.21 1.11l-2.53 2.13z" />
                            </svg></span><span>+503 7941-9140</span></li>
                    <li><span aria-hidden="true"><svg width="16" height="16" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z" />
                            </svg></span><span>San Miguel, El Salvador</span></li>
                </ul>
            </div>
        </div>

        <div class="copyright animate-on-scroll">
            <p>&copy; {{ date('Y') }} LESSA — Todos los derechos reservados</p>
        </div>
    </div>

    <script>
        // Small, safe IntersectionObserver reveal for footer blocks
        (function () {
            if (!('IntersectionObserver' in window)) {
                // fallback: reveal immediately
                document.querySelectorAll('.lessa-footer .animate-on-scroll').forEach(el => el.classList.add('is-visible'));
                return;
            }
            const items = document.querySelectorAll('.lessa-footer .animate-on-scroll');
            const io = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        obs.unobserve(entry.target);
                    }
                });
            }, { root: null, threshold: 0.12 });
            items.forEach(i => io.observe(i));
        })();
    </script>
</footer>