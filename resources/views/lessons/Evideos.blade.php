<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos Educativos - LESSA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* --- ESTILOS BASE --- */
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f6fa;
        }
        .hero-section {
            background: linear-gradient(90deg, #2196F3 0%, #4CAF50 100%);
            color: #fff;
            padding: 60px 0 40px 0;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 2em;
            font-weight: 700;
            margin-bottom: 18px;
            letter-spacing: 1.5px;
        }
        .hero-section p {
            font-size: 1em;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }
        
        /* --- CONTENEDOR PRINCIPAL --- */
        .main-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 0 60px 0;
        }
        
        /* --- SECCIONES DE VIDEO --- */
        .video-section {
            margin-bottom: 40px;
        }

        .section-title-sticky {
            color: #2196F3;
            font-size: 1.7em;
            font-weight: 700;
            margin: 0 10px 16px 10px;
            text-align: left;
            padding: 8px 0 8px 8px;
            border-left: 6px solid #4CAF50;
            border-radius: 0 12px 12px 0;
        }

        /* --- ESTILOS DEL CARRUSEL (SCROLL SNAP) --- */
        .video-carousel {
            display: flex;
            overflow-x: scroll; /* Permite el desplazamiento horizontal */
            scroll-snap-type: x mandatory; /* Asegura que se detenga en cada tarjeta */
            gap: 20px;
            padding: 0 10px 20px 10px; /* Padding inferior para scrollbar y lateral */
            /* Ocultar scrollbar en algunos navegadores */
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        .video-carousel::-webkit-scrollbar {
            display: none; /* Ocultar scrollbar en Chrome, Safari y Opera */
        }
        
        /* --- ESTILOS DE LA TARJETA --- */
        .video-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.2s, transform 0.2s;
            cursor: pointer;
            border: 2px solid transparent;
            
            /* Propiedades del carrusel */
            flex: 0 0 320px; /* Ancho fijo para las tarjetas en escritorio */
            scroll-snap-align: start; /* Se detiene al inicio de la tarjeta */
        }
        
        .video-card:hover, .video-card:focus {
            box-shadow: 0 8px 32px rgba(33,150,243,0.18);
            transform: translateY(-6px) scale(1.01);
            border-color: #4CAF50;
        }
        .video-card:active {
            transform: scale(0.98);
        }
        .video-thumb {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: #e0e4ea;
            border-bottom: 1px solid #e0e4ea;
        }
        .video-info {
            padding: 18px 16px 14px 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .video-title {
            font-size: 1.18em;
            font-weight: 700;
            color: #2196F3;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        .video-desc {
            font-size: 1em;
            color: #333d47;
            margin-bottom: 0;
        }
        
        /* --- MEDIA QUERIES --- */
        @media (max-width: 900px) {
            .video-card {
                flex: 0 0 280px; /* Reducir ancho de tarjeta */
            }
            .section-title-sticky {
                font-size: 1.5em;
            }
        }
        @media (max-width: 600px) {
            .hero-section h1 { font-size: 1.3em; }
            .main-container { padding: 10px 0 30px 0; }
            .video-card { 
                flex: 0 0 85%; /* Las tarjetas ocupan el 85% del ancho en móvil */
            }
            .video-thumb { height: 160px; }
            .section-title-sticky {
                font-size: 1.2em;
            }
        }
    </style>
</head>
<body>
    <header>@include('partials.navbar')</header>
    <section class="hero-section">
        <h1>Videos Educativos LESSA</h1>
        <p>
            Explora nuestra colección de videos educativos del canal <b>LESSA Virtual</b>.
            Aprende el Lenguaje de Señas Salvadoreño de forma visual y práctica, con explicaciones claras y ejemplos reales.
            ¡Haz click en cualquier video para verlo directamente en YouTube y sigue aprendiendo!
        </p>
    </section>
    <section style="background:#e9ecef;padding:18px 0;text-align:center;">
        <div style="max-width:700px;margin:0 auto;font-size:1em;color:#333d47;">
            <b>Permiso de uso de videos:</b> Para este proyecto se contactó al canal <a href="https://youtube.com/@lessavirtual?si=h29rCum1uAtz3int" target="_blank">LESSA Virtual</a> mediante correo electrónico y se obtuvo autorización para utilizar sus videos educativos en esta plataforma.
        </div>
    </section>
    <main>
        <div class="main-container">
            
            <div class="video-section">
                <div class="section-title-sticky">Básico</div>
                <div class="video-carousel">
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/yczExyNssRs?si=-TIsqvmfkLER7lfN')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/yczExyNssRs/maxresdefault.jpg" alt="abecedario">
                        <div class="video-info">
                            <div class="video-title">El Abecedario en LESSA</div>
                            <div class="video-desc">Aprende a deletrear palabras y nombres usando el abecedario dactilológico.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/DJOe_jwANGU?si=NLHPwmIPIE1SEqv9')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/DJOe_jwANGU/maxresdefault.jpg" alt="identidad">
                        <div class="video-info">
                            <div class="video-title">Identidad y Pronombres</div>
                            <div class="video-desc">Aprende a usar los pronombres y a expresar tu identidad en LESSA.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/oFoT5aEnmeE?si=uN8XLxoj2jZJuA2y')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/oFoT5aEnmeE/maxresdefault.jpg" alt="verbos">
                        <div class="video-info">
                            <div class="video-title">Los verbos</div>
                            <div class="video-desc">Aprende a usar algunos de los verbos más útiles y comunes en LESSA.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/BaBm621Bj0M?si=b19JUzTeE1l3KMLi')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/BaBm621Bj0M/maxresdefault.jpg" alt="adjetivos">
                        <div class="video-info">
                            <div class="video-title">Los adjetivos</div>
                            <div class="video-desc">Aprende a realizar oraciones sencillas con los adjetivos aprendidos.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/5nUqJgrOeb8?si=dfVJhmNR8OCOBepl')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/5nUqJgrOeb8/maxresdefault.jpg" alt="numeros">
                        <div class="video-info">
                            <div class="video-title">Los números</div>
                            <div class="video-desc">Aprende a contar y a usar los números en LESSA.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/VhcXnirk58o?si=zgQU6Yurk-zlKdEx')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/VhcXnirk58o/maxresdefault.jpg" alt="oracionesVerbos">
                        <div class="video-info">
                            <div class="video-title">Los verbos: Oraciones</div>
                            <div class="video-desc">Aprende a realizar oraciones sencillas con los verbos aprendidos.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/pDmFAh__f10?si=CZK4lVSH2Yxp4X2K')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/pDmFAh__f10/maxresdefault.jpg" alt="oracionesAdjetivos">
                        <div class="video-info">
                            <div class="video-title">Los adjetivos: Oraciones</div>
                            <div class="video-desc">Aprende a realizar oraciones sencillas con los adjetivos aprendidos.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="video-section">
                <div class="section-title-sticky">Vocabulario</div>
                <div class="video-carousel">
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/Mke-fqX5Ux4?si=IH1yHW6cDTsScXL9')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/Mke-fqX5Ux4/maxresdefault.jpg" alt="colores">
                        <div class="video-info">
                            <div class="video-title">Los colores</div>
                            <div class="video-desc">Aprende el vocabulario acerca de los colores en LESSA.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/Y3umPPvEP4Y?si=6WCzKgapaCUK9fj_')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/Y3umPPvEP4Y/maxresdefault.jpg" alt="familia">
                        <div class="video-info">
                            <div class="video-title">Familia</div>
                            <div class="video-desc">Aprende vocabulario relacionado a la familia en LESSA.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/elIT8uGz4Ag?si=h4fZ7dE4LaWHHTl8')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/elIT8uGz4Ag/maxresdefault.jpg" alt="transporte">
                        <div class="video-info">
                            <div class="video-title">Los medios de transporte</div>
                            <div class="video-desc">Aprende a realizar oraciones sencillas con los medios de transporte en LESSA.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/XvYOmJ8XjqI?si=SqwRi004jYS1ffdY')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/XvYOmJ8XjqI/maxresdefault.jpg" alt="musicales">
                        <div class="video-info">
                            <div class="video-title">Los instrumentos musicales</div>
                            <div class="video-desc">Aprende a realizar oraciones sencillas con los instrumentos musicales en LESSA.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/2hQP44qsNOc?si=5pkk2cSYu8karUCp')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/2hQP44qsNOc/maxresdefault.jpg" alt="profesiones">
                        <div class="video-info">
                            <div class="video-title">Las profesiones y oficios</div>
                            <div class="video-desc">Aprende a realizar oraciones sencillas con las profesiones y oficios en LESSA.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/6X-DEc9ez7g?si=Smg5PNtaquoUwR74')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/6X-DEc9ez7g/maxresdefault.jpg" alt="medico">
                        <div class="video-info">
                            <div class="video-title">Salud y medico</div>
                            <div class="video-desc">Aprende a realizar oraciones sencillas sobre salud y medicina en LESSA.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/sFcBzIANiPo?si=xrJ4ew0mi1GLqNw0')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/sFcBzIANiPo/maxresdefault.jpg" alt="animales">
                        <div class="video-info">
                            <div class="video-title">Los animales</div>
                            <div class="video-desc">Aprende a realizar los animles en LESSA.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/At-_mNLJqRk?si=GdpWnS0qUPD5Zl-i')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/At-_mNLJqRk/maxresdefault.jpg" alt="deportes">
                        <div class="video-info">
                            <div class="video-title">Los deportes</div>
                            <div class="video-desc">Aprende a realizar los deportes en LESSA.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/GQdNv90mfAo?si=f8QnrN0tNFAiYqlv')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/GQdNv90mfAo/maxresdefault.jpg" alt="utiles">
                        <div class="video-info">
                            <div class="video-title">Las utiles escolares</div>
                            <div class="video-desc">Aprende a realizar los utiles escolares en LESSA.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/smiDcQaRLIs?si=TlpgGuLxQC546LJC')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/smiDcQaRLIs/maxresdefault.jpg" alt="verbos">
                        <div class="video-info">
                            <div class="video-title">Verbos</div>
                            <div class="video-desc">Aprende más verbos en LESSA.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/GUa6_9jjs7I?si=LFaEJBUWLy_iGjf6')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/GUa6_9jjs7I/maxresdefault.jpg" alt="frutas">
                        <div class="video-info">
                            <div class="video-title">Las frutas</div>
                            <div class="video-desc">Aprende a realizar las frutas en LESSA.</div>
                        </div>
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/AYDdBZGmrL4?si=Q3hCG2Xl5jIbf5Ja')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/AYDdBZGmrL4/maxresdefault.jpg" alt="verduras">
                        <div class="video-info">
                            <div class="video-title">Las verduras</div>
                            <div class="video-desc">Aprende a realizar las verduras en LESSA.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="video-section">
                <div class="section-title-sticky">Importancia</div>
                <div class="video-carousel">
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/r6OCqKeSBLs?si=JPoBNP8zSTL90xIL')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/r6OCqKeSBLs/maxresdefault.jpg" alt="importancia">
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/uSVEoQgG-u8?si=ze4LvLsMNZEjNs85')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/uSVEoQgG-u8/maxresdefault.jpg" alt="importancia">
                    </div>
                    <div class="video-card" tabindex="0" onclick="window.open('https://youtu.be/8vt6oofwvyY?si=v_gvG7IznmZXvNYZ')">
                        <img class="video-thumb" src="https://img.youtube.com/vi/8vt6oofwvyY/maxresdefault.jpg" alt="importancia">
                    </div>
                </div>
            </div>
            
        </div>
    </main>
    <footer>@include('partials.footer')</footer>
</body>
</html>