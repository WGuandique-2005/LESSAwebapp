<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>LESSA - Carrusel de Señas (Mejorado)</title>
    <style>
        :root {
            --card-bg: #ffffff;
            --accent: #2196F3;
            --accent-2: #4CAF50;
            --muted: #6b7280;
            --shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
            --radius: 12px;
            --gap: 20px;
            --control-size: 44px;
            --dot-size: 10px;
            --duration: 500ms;
            --autoplay-interval: 5000;
            /* ms */
        }

        * {
            box-sizing: border-box
        }

        body {
            font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
            margin: 0;
            background: transparent;
        }

        .carousel-container {
            position: relative;
            width: 100%;
            max-width: 980px;
            margin: 28px auto;
            border-radius: var(--radius);
            background: var(--card-bg);
            box-shadow: var(--shadow);
            overflow: hidden;
            padding: 18px;
        }

        /* track wrapper for overflow hidden */
        .carousel-viewport {
            overflow: hidden;
            position: relative;
            width: 100%;
            border-radius: 8px;
        }

        .carousel-track {
            display: flex;
            transition: transform var(--duration) cubic-bezier(.2, .9, .3, 1);
            will-change: transform;
            align-items: stretch;
        }

        .carousel-slide {
            flex: 0 0 100%;
            padding: 18px;
            display: flex;
            gap: var(--gap);
            align-items: center;
            justify-content: center;
            min-height: 320px;
            box-sizing: border-box;
        }

        /* image column */
        .slide-img {
            flex: 0 0 320px;
            max-width: 320px;
            height: 240px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(180deg, #f8fafc, #ffffff);
            border-radius: 8px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }

        .slide-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }

        /* content column */
        .slide-content {
            flex: 1 1 auto;
            min-width: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 10px;
        }

        .slide-content h3 {
            margin: 0;
            font-size: 1.45rem;
            color: #111827;
        }

        .slide-content p {
            margin: 0;
            color: var(--muted);
            line-height: 1.45;
            font-size: 1rem;
        }

        /* Controls */
        .carousel-control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: var(--control-size);
            height: var(--control-size);
            display: inline-grid;
            place-items: center;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.55);
            color: white;
            border: none;
            cursor: pointer;
            z-index: 20;
            transition: transform .12s ease, background .12s ease;
            box-shadow: 0 6px 18px rgba(2, 6, 23, 0.18);
        }

        .carousel-control:focus {
            outline: 3px solid rgba(34, 197, 94, 0.16);
            transform: translateY(-50%) scale(1.02);
        }

        .carousel-control:hover {
            background: rgba(0, 0, 0, 0.7);
            transform: translateY(-50%) scale(1.02);
        }

        .carousel-control.prev {
            left: 12px
        }

        .carousel-control.next {
            right: 12px
        }

        /* Dots */
        .carousel-dots {
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
            margin-top: 12px;
            padding: 8px 4px;
        }

        .carousel-dot {
            width: var(--dot-size);
            height: var(--dot-size);
            border-radius: 999px;
            background: #e6eef7;
            border: none;
            cursor: pointer;
            transition: background .18s ease, transform .12s ease;
        }

        .carousel-dot[aria-pressed="true"] {
            background: linear-gradient(90deg, var(--accent-2), var(--accent));
            transform: scale(1.14);
            box-shadow: 0 6px 14px rgba(33, 150, 243, 0.18);
        }

        /* counter / status */
        .carousel-status {
            position: absolute;
            right: 16px;
            bottom: 14px;
            background: rgba(0, 0, 0, 0.06);
            color: #0f172a;
            padding: 6px 9px;
            border-radius: 8px;
            font-size: 0.95rem;
            display: flex;
            gap: 8px;
            align-items: center;
            z-index: 15;
        }

        /* small screens: stacked layout */
        @media (max-width: 820px) {
            .carousel-slide {
                flex-direction: column;
                min-height: 420px;
                padding: 12px;
            }

            .slide-img {
                width: 88%;
                height: 200px;
                max-width: 640px;
                margin: 0 auto;
            }

            .slide-content {
                padding: 6px 8px;
                text-align: center;
            }

            .carousel-control.prev {
                left: 6px
            }

            .carousel-control.next {
                right: 6px
            }

            .carousel-status {
                right: 12px;
                bottom: 8px;
            }
        }

        @media (max-width:480px) {
            .slide-img {
                height: 160px;
            }

            .carousel-container {
                padding: 12px;
            }

            .carousel-dots {
                gap: 8px;
            }
        }

        /* Visually hidden helper */
        .sr-only {
            position: absolute !important;
            width: 1px;
            height: 1px;
            overflow: hidden;
            clip: rect(1px, 1px, 1px, 1px);
            white-space: nowrap;
            clip-path: inset(50%);
            border: 0;
            padding: 0;
            margin: -1px;
        }
    </style>
</head>

<body>
    <div class="carousel-container" aria-roledescription="carousel" aria-label="Carrusel de señas">
        <div class="carousel-viewport">
            <div class="carousel-track" id="carouselTrack">
                {{-- Blade loop --}}
                @foreach ($senas as $sena)
                    <article class="carousel-slide" role="group" aria-roledescription="slide"
                        aria-label="{{ $loop->iteration }} de {{ $loop->count }}">
                        <div class="slide-img">
                            <img src="{{ $sena['ruta'] }}" alt="{{ $sena['nombre'] }}" loading="lazy" />
                        </div>
                        <div class="slide-content">
                            <h3>{{ $sena['nombre'] }}</h3>
                            <p>{{ $sena['descripcion'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control prev" id="prevBtn" aria-label="Anterior slide">
            <!-- simple chevron svg -->
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
        <button class="carousel-control next" id="nextBtn" aria-label="Siguiente slide">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>

        <!-- Dots + status -->
        <div style="display:flex; justify-content:center; align-items:center; margin-top:8px; gap:12px;">
            <div class="carousel-dots" id="carouselDots" role="tablist" aria-label="Seleccionar slide"></div>
        </div>

        <div class="carousel-status" id="carouselStatus" aria-live="polite">1 / 1</div>

        <div class="sr-only" id="carouselAnnouncer" aria-live="assertive"></div>
    </div>

    <script>
        (function () {
            const track = document.getElementById('carouselTrack');
            const slides = Array.from(track.children);
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const dotsWrap = document.getElementById('carouselDots');
            const status = document.getElementById('carouselStatus');
            const announcer = document.getElementById('carouselAnnouncer');

            if (!track || slides.length === 0) return;

            let current = 0;
            let slideWidth = 0;
            let autoplayTimer = null;
            const autoplayInterval = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--autoplay-interval')) || 5000;
            const total = slides.length;

            // create dots
            const dots = slides.map((s, i) => {
                const btn = document.createElement('button');
                btn.className = 'carousel-dot';
                btn.type = 'button';
                btn.setAttribute('aria-label', `Ir a la diapositiva ${i + 1} de ${total}`);
                btn.setAttribute('aria-pressed', i === 0 ? 'true' : 'false');
                btn.addEventListener('click', () => goTo(i, true));
                dotsWrap.appendChild(btn);
                return btn;
            });

            // set widths (ensures slideWidth is correct)
            function recalc() {
                slideWidth = track.getBoundingClientRect().width;
                // Every slide is 100% of viewport (= track width), so translate increments = slideWidth * index
                updatePosition(false);
            }

            // update position
            function updatePosition(announce = false) {
                const offset = -current * slideWidth;
                track.style.transform = `translateX(${offset}px)`;
                // update dots
                dots.forEach((d, i) => d.setAttribute('aria-pressed', i === current ? 'true' : 'false'));
                // update status
                status.textContent = `${current + 1} / ${total}`;
                // announce for screen readers
                if (announce && announcer) {
                    announcer.textContent = `Diapositiva ${current + 1} de ${total}`;
                }
            }

            // navigation functions
            function prev() { current = (current - 1 + total) % total; updatePosition(true); resetAutoplay(); }
            function next() { current = (current + 1) % total; updatePosition(true); resetAutoplay(); }
            function goTo(index, announce = true) { current = Math.max(0, Math.min(total - 1, index)); updatePosition(announce); resetAutoplay(); }

            // autoplay
            function startAutoplay() {
                stopAutoplay();
                autoplayTimer = setInterval(() => {
                    current = (current + 1) % total;
                    updatePosition(true);
                }, autoplayInterval);
            }
            function stopAutoplay() {
                if (autoplayTimer) { clearInterval(autoplayTimer); autoplayTimer = null; }
            }
            function resetAutoplay() {
                stopAutoplay();
                // restart after 6s (small pause after user interaction)
                setTimeout(startAutoplay, autoplayInterval);
            }

            // keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') { prev(); }
                else if (e.key === 'ArrowRight') { next(); }
            });

            // prev/next handlers
            prevBtn.addEventListener('click', prev);
            nextBtn.addEventListener('click', next);

            // touch swipe (improved)
            let startX = null;
            let moveX = 0;
            track.addEventListener('touchstart', (e) => {
                stopAutoplay();
                startX = e.touches[0].clientX;
                moveX = 0;
            }, { passive: true });

            track.addEventListener('touchmove', (e) => {
                if (startX === null) return;
                moveX = e.touches[0].clientX - startX;
            }, { passive: true });

            track.addEventListener('touchend', (e) => {
                if (startX === null) return;
                const threshold = 50; // px
                if (moveX > threshold) { prev(); }
                else if (moveX < -threshold) { next(); }
                startX = null;
                moveX = 0;
            });

            // pause on hover / focus
            const interactiveElements = [track, prevBtn, nextBtn, ...dots];
            interactiveElements.forEach(el => {
                el.addEventListener('mouseenter', stopAutoplay, { passive: true });
                el.addEventListener('mouseleave', startAutoplay, { passive: true });
                el.addEventListener('focusin', stopAutoplay);
                el.addEventListener('focusout', startAutoplay);
            });

            // ensure recalc on resize and after images load
            window.addEventListener('resize', () => {
                // small throttling
                clearTimeout(window._carouselResizeTimer);
                window._carouselResizeTimer = setTimeout(recalc, 80);
            });

            // also when images load (they might change track width)
            const imgs = track.querySelectorAll('img');
            let imgLoadedCount = 0;
            if (imgs.length === 0) recalc();
            imgs.forEach(img => {
                if (img.complete) {
                    imgLoadedCount++;
                } else {
                    img.addEventListener('load', () => {
                        imgLoadedCount++;
                        if (imgLoadedCount === imgs.length) recalc();
                    }, { once: true, passive: true });
                    img.addEventListener('error', () => {
                        imgLoadedCount++;
                        if (imgLoadedCount === imgs.length) recalc();
                    }, { once: true, passive: true });
                }
            });
            // fallback recalc after brief delay (ensures correct initial position)
            setTimeout(recalc, 40);

            // start autoplay
            startAutoplay();

            // expose small API (optional)
            window._lessaCarousel = { goTo, next, prev, startAutoplay, stopAutoplay, recalc };
        })();
    </script>
</body>

</html>