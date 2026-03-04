<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Next Level | Ciclo Anual UNU</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/marquee_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/propuesta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/ciclo_anual_unu.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/next-level-logo.png') }}">
</head>

<body>

    <div class="top-bar">
        <div class="marquee-wrapper">
            <div class="marquee-track" id="marqueeTrack">
                <div class="marquee-item">
                    ¡Matrícula 2026! &nbsp;&nbsp;&nbsp;&nbsp;
                    ☀️🏊‍♂️ Inicio de Clases: 4 Marzo &nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>

    <nav class="main-nav">
        <div class="nav-container">
            <a href="{{ route('web.inicio') }}" class="nav-brand">
                <img src="{{ asset('images/logo_letras.png') }}" alt="Next Level" class="nav-logo-full">
            </a>

            <button class="mobile-menu-toggle" id="menuOpen" type="button">
                <i class="fa-solid fa-bars"></i>
            </button>

            <ul class="nav-menu">
                <li><a href="{{ route('web.inicio') }}">INICIO</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NOSOTROS <span class="arrow-icon">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('mantenimiento') }}">Qué ofrecemos</a></li>
                        <li><a href="{{ route('mantenimiento') }}">Quiénes Somos</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NIVELES <span class="arrow-icon">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('mantenimiento') }}">Colegio</a></li>
                        <li><a href="{{ route('academia') }}">Academia</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('ubicacion') }}">UBICACIÓN</a></li>
                <li><a href="{{ route('mantenimiento') }}">MATRICULAS</a></li>
                <li><a href="{{ route('mantenimiento') }}">CONCURSOS</a></li>
                <li><a href="{{ route('mantenimiento') }}">INTRANET</a></li>
            </ul>
        </div>
    </nav>

    <div class="mobile-menu-overlay" id="menuOverlay"></div>
    <div class="mobile-side-menu" id="sideMenu">
        <div class="menu-header">
            <span>MENÚ</span>
            <button class="close-menu" id="menuClose" type="button"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="menu-panels-container">
            <div class="menu-panel active" id="mainPanel">
                <ul class="mobile-nav-list">
                    <li><a href="{{ route('web.inicio') }}">INICIO</a></li>
                    <li class="has-submenu" data-target="submenu-nosotros">
                        <span>NOSOTROS</span> <i class="fa-solid fa-chevron-right"></i>
                    </li>
                    <li class="has-submenu" data-target="submenu-niveles">
                        <span>NIVELES</span> <i class="fa-solid fa-chevron-right"></i>
                    </li>
                    <li><a href="{{ route('ubicacion') }}">UBICACIÓN</a></li>
                    <li><a href="{{ route('mantenimiento') }}">MATRICULAS</a></li>
                    <li><a href="{{ route('mantenimiento') }}">CONCURSOS</a></li>
                    <li><a href="{{ route('mantenimiento') }}">INTRANET</a></li>
                </ul>
            </div>

            <div class="menu-panel" id="submenu-nosotros">
                <button class="back-btn" type="button"><i class="fa-solid fa-chevron-left"></i> REGRESAR</button>
                <ul class="mobile-nav-list">
                    <li><a href="{{ route('mantenimiento') }}">Qué ofrecemos</a></li>
                    <li><a href="{{ route('mantenimiento') }}">Quiénes Somos</a></li>
                </ul>
            </div>

            <div class="menu-panel" id="submenu-niveles">
                <button class="back-btn" type="button"><i class="fa-solid fa-chevron-left"></i> REGRESAR</button>
                <ul class="mobile-nav-list">
                    <li><a href="{{ route('mantenimiento') }}">Colegio</a></li>
                    <li><a href="{{ route('academia') }}">Academia</a></li>
                </ul>
            </div>
        </div>
    </div>

    <main>

    <section class="hero-sobre">
        <div class="hero-overlay">
       <!-- <div class="hero-content">
                <span class="section-tag">MATRÍCULA 2026</span>
                <h1>CICLO ANUAL</h1>
                <div class="hero-line"></div>
                <p>La preparación más completa para asegurar tu ingreso. Desde lo básico hasta el nivel avanzado con el método Next Level.</p>
            </div> -->
        </div>
        <img src="{{ asset('images/imagen10.jpg') }}" alt="Fondo" class="hero-bg-img">
    </section>

    <section class="seccion-detalle-unu">
        <div class="contenedor-unu">
            <div class="grid-presentacion">
                <div class="col-texto">
                    <h2 class="color-cian">ANUAL UNU</h2>
                    <p class="txt-descripcion">Ciclo diseñado para quienes <strong>inician su preparación preuniversitaria</strong> y están dispuestos a asumir una preparación exigente. Refuerza tus bases teóricas y prácticas con una preparación 100% alineada al prospecto de admisión de la <strong>Universidad Nacional de Ucayali.</strong></p>

                    <p class="metodologia-destaque">METODOLOGÍA: 50% PRÁCTICO + 50% TEORÍA</p>

                    <ul class="lista-detalles">
                        <li><i class="fa-solid fa-calendar-day"></i> <strong>Inicio:</strong> 16 de marzo</li>
                        <li><i class="fa-solid fa-flag-checkered"></i> <strong>Fin:</strong> 15 de diciembre</li>
                        <li><i class="fa-solid fa-location-dot"></i> <strong>Modalidad:</strong> Presencial / Virtual</li>
                        <li><i class="fa-solid fa-hourglass-start"></i> <strong>Duración:</strong> 40 semanas</li>
                        <li>
                            <i class="fa-solid fa-clock"></i>
                            <div class="bloque-horarios">
                                <strong>Horarios:</strong> Lunes a sábado<br>
                                <span>Mañana → 8:00 a. m. a 1:00 p. m.</span>
                                <span>Tarde → 3:00 p. m. a 8:00 p. m.</span>
                                <span>Noche → 5:00 p. m. a 10:00 p. m.</span>
                            </div>
                        </li>
                    </ul>
                    <a href="#" class="boton-inclinado-horario">HORARIO DE CLASE</a>
                </div>
                <div class="col-imagen">
                    <img src="{{ asset('images/estudiante_unu.png') }}" alt="Estudiante Anual UNU">
                </div>
            </div>
        </div>
    </section>

    <section class="seccion-beneficios-unu">
        <div class="contenedor-unu">
            <h2 class="titulo-blanco">BENEFICIOS</h2>
            <p class="subtitulo-blanco">¡Prepárate al máximo!</p>

            <div class="grid-beneficios">
                <div class="beneficios-foto">
                    <img src="{{ asset('images/beneficios_estudiante.png') }}" alt="Beneficios Next Level">
                </div>
                <div class="beneficios-items">
                    <div class="item-b">
                        <span class="etiqueta-b">Evaluaciones semanales tipo admisión</span>
                        <p>Exámenes de 2 horas con estructura real de la UNU para medir tu progreso semanal.</p>
                    </div>
                    <div class="item-b">
                        <span class="etiqueta-b">Simulacros mensuales</span>
                        <p>Simulacros de 3 horas para adaptarte al ritmo y presión del examen real.</p>
                    </div>
                    <div class="item-b">
                        <span class="etiqueta-b">Acompañamiento Psicopedagógico</span>
                        <p>Orientación vocacional, manejo de estrés y técnicas de estudio personalizado.</p>
                    </div>
                    <div class="item-b">
                        <span class="etiqueta-b">Aula Virtual 24/7</span>
                        <p>Acceso a clases grabadas, materiales en PDF y plataforma de ejercicios.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="seccion-inversion-unu">
        <div class="contenedor-unu">
            <h2 class="color-cian texto-centrado">INVERSIÓN</h2>
            <div class="flex-tablas">
                <div class="tarjeta-precio">
                    <h3 class="color-magenta">PRESENCIAL</h3>
                    <div class="tabla-custom">
                        <div class="fila-cabecera">
                            <div>TURNO</div>
                            <div>PAGO COMPLETO</div>
                            <div>EN CUOTAS</div>
                        </div>
                        <div class="fila-dato">
                            <div class="celda">Mañana</div>
                            <div class="celda verde-ahorro">S/ 3,749 <small>Ahorra S/ 326</small></div>
                            <div class="celda">S/ 429</div>
                        </div>
                        <div class="fila-dato">
                            <div class="celda">Tarde</div>
                            <div class="celda verde-ahorro">S/ 3,224 <small>Ahorra S/ 281</small></div>
                            <div class="celda">S/ 369</div>
                        </div>
                    </div>
                </div>

                <div class="tarjeta-precio">
                    <h3 class="color-cian">VIRTUAL</h3>
                    <div class="tabla-custom">
                        <div class="fila-cabecera">
                            <div>TURNO</div>
                            <div>PAGO COMPLETO</div>
                            <div>EN CUOTAS</div>
                        </div>
                        <div class="fila-dato">
                            <div class="celda">Mañana</div>
                            <div class="celda verde-ahorro">S/ 2,175 <small>Ahorra S/ 190</small></div>
                            <div class="celda">S/ 249</div>
                        </div>
                        <div class="fila-dato">
                            <div class="celda">Tarde</div>
                            <div class="celda verde-ahorro">S/ 1,913 <small>Ahorra S/ 167</small></div>
                            <div class="celda">S/ 219</div>
                        </div>
                        <div class="fila-dato">
                            <div class="celda">Noche</div>
                            <div class="celda verde-ahorro">S/ 1,738 <small>Ahorra S/ 152</small></div>
                            <div class="celda">S/ 199</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pie-inversion">
                <a href="#" class="btn-matricula-final">MATRÍCULA EN LÍNEA</a>
                <p><a href="#">Solicita más información</a></p>
            </div>
        </div>
    </section>

    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <img src="{{ asset('images/logo_footer.png') }}" alt="Next Level Logo" class="footer-logo-img">
                <div class="footer-contact">
                    <p><i class="fa-solid fa-phone"></i> +51 923 317 626</p>
                    <p><i class="fa-solid fa-location-dot"></i> Carretera Federico Basadre Km. 6.5 (Al costado de la UNU)</p>
                    <p><i class="fa-solid fa-envelope"></i> contacto@nextlevel.edu.pe</p>
                </div>
            </div>

            <div class="footer-right">
                <div class="footer-column">
                    <a href="{{ route('ciclos') }}">CICLOS</a>
                    <a href="{{ route('galeria') }}">GALERIA</a>
                    <a href="{{ route('contactenos') }}">CONTÁCTANOS</a>
                    <a href="{{ route('sobre.nosotros') }}">SOBRE NOSOTROS</a>
                    <a href="{{ route('nuestros.valores') }}">NUESTROS VALORES</a>
                </div>
                <div class="footer-column">
                    <a href="{{ route('academia') }}">ACADEMIA</a>
                    <a href="{{ route('pagos') }}">PAGOS EN LÍNEA</a>
                    <a href="{{ route('mantenimiento') }}">MATRíCULA 2026</a>
                    <a href="{{ route('mantenimiento') }}">MATRÍCULA ONLINE</a>
                    <a href="{{ route('mantenimiento') }}">LIBRO RECLAMACIONES</a>
                </div>
                <div class="footer-column social-align">
                    <a href="{{ route('mantenimiento') }}">POLÍTICA COOKIES</a>
                    <a href="{{ route('mantenimiento') }}">POLÍTICA PRIVACIDAD</a>
                    <a href="{{ route('mantenimiento') }}">TERMINOS Y CONDICIONES</a>

                    <div class="footer-social-icons">
                        <a href="https://www.tiktok.com/@next_level_novus" target="_blank" class="social-icon"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/next_level_novus/" target="_blank" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://wa.me/51923317625?text=Hola%20Next%20Level,%20deseo%20información.%20Me%20interesa:%0A%0A1.%20Matrícula%20Colegio%20%0A2.%20Ciclos%20Academia%20%0A3.%20Agendar%20Visita%20Guiada%0A4.%20Costos%20y%20Pensiones%0A%0APor%20favor,%20bríndeme%20detalles." target="_blank" class="social-icon"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="https://www.facebook.com/profile.php?id=61581492196914" target="_blank" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2026 Next Level. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="{{ asset('js/marquee_principal.js') }}"></script>
    <script src="{{ asset('js/nav-scroll.js') }}"></script>
    <script src="{{ asset('js/menu-mobile.js') }}"></script>

</body>

</html>
