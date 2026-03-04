<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Next Level | Academia</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/marquee_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/propuesta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/academia.css') }}">
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
                        <li><a href="{{ route('academia') }}" class="active">Academia</a></li>
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
                <div class="hero-content">
                    <span class="section-tag">PREPARACIÓN PREUNIVERSITARIA</span>
                    <h1>ACADEMIA NEXT LEVEL</h1>
                    <div class="hero-line"></div>
                    <p>
                        Formación estratégica de alto rendimiento para ingresar
                        a las universidades más exigentes del país.
                    </p>
                </div>
            </div>
            <img src="{{ asset('images/imagen10.jpg') }}" alt="Fondo" class="hero-bg-img">
        </section>

        <section class="academia-intro">
            <div class="container">
                <div class="academia-grid">
                    <div class="academia-video">
                        <div class="video-wrapper">
                            <iframe src="https://www.youtube.com/embed/tU6c0Bk5uEs"
                                    title="Video Academia" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                            </iframe>
                        </div>
                    </div>

                    <div class="academia-text">
                        <span class="academy-label">MÉTODO NEXT LEVEL</span>
                        <h2 class="title-blue">NUESTRA MISIÓN</h2>
                        <p>
                        Somos una academia de prestigio y trayectoria intachable, gracias al
                        trabajo esmerado y responsable de nuestro equipo docente y administrativo.
                        Acompañamos a nuestros estudiantes en cada etapa de su preparación.
                        </p>
                        <p>
                            Brindamos una formación sólida, disciplina constante y orientación académica
                            para afrontar con seguridad el próximo examen de admisión, fortaleciendo la
                            excelencia en la región.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="simulacros-section">
            <div class="container">
                <div class="simulacros-grid">
                    <div class="simulacros-content">
                        <span class="academy-label">ALTO RENDIMIENTO</span>
                        <h2 class="title-blue">ENTRENAMIENTO TIPO ADMISIÓN</h2>
                        <p>Nuestro sistema de evaluación está diseñado para simular la presión y el nivel de exigencia de los exámenes reales. No solo medimos conocimientos, entrenamos la velocidad y precisión del postulante.</p>

                        <div class="simulacros-features">
                            <div class="sim-item">
                                <div class="sim-icon"><i class="fa-solid fa-trophy"></i></div>
                                <div class="sim-text">
                                    <h4>Ranking General</h4>
                                    <p>Mide tu nivel frente a otros postulantes con nuestro cuadro de méritos actualizado.</p>
                                </div>
                            </div>
                            <div class="sim-item">
                                <div class="sim-icon"><i class="fa-solid fa-chart-line"></i></div>
                                <div class="sim-text">
                                    <h4>Estadísticas por Área</h4>
                                    <p>Identifica tus fortalezas y debilidades en cada curso del prospecto.</p>
                                </div>
                            </div>
                            <div class="sim-item">
                                <div class="sim-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                                <div class="sim-text">
                                    <h4>Solucionarios en Vivo</h4>
                                    <p>Al finalizar cada simulacro, nuestros docentes resuelven las preguntas clave.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="simulacros-visual">
                        <div class="sim-card-floating">
                            <div class="sim-header">
                                <i class="fa-solid fa-file-pen"></i>
                                <span>Próximo Simulacro</span>
                            </div>
                            <div class="sim-body">
                                <span class="date">DOMINGO 15 DE MARZO</span>
                                <span class="location">Campus Principal</span>
                                <div class="sim-line"></div>
                                <p>Abierto para alumnos y público en general</p>
                            </div>
                        </div>
                        <img src="{{ asset('images/imagen10.jpg') }}" alt="Simulacro Next Level" class="sim-img">
                    </div>
                </div>
            </div>
        </section>

        <section class="ciclos-section-carrusel">
            <div class="container content-wrapper">
                <div class="section-header-centered">
                    <h2 class="title-white">PROGRAMAS DE PREPARACIÓN 2026</h2>
                    <div class="title-line-red"></div>
                </div>

                <div class="swiper ciclos-swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="ciclo-card">
                                <div class="ciclo-badge">DISPONIBLE</div>
                                <i class="fa-solid fa-calendar-check ciclo-icon"></i>
                                <h3>CICLO ANUAL</h3>
                                <p>Base sólida desde cero. Ideal para dominar todo el prospecto con calma y seguridad.</p>
                                <ul class="ciclo-features">
                                    <li><i class="fa-solid fa-check"></i> Todas las áreas</li>
                                    <li><i class="fa-solid fa-check"></i> Material impreso</li>
                                </ul>
                                <a href="{{ route('ciclos') }}" class="btn-ciclo">VER INFORMES</a>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="ciclo-card featured">
                                <div class="ciclo-badge highlight">MÁS BUSCADO</div>
                                <i class="fa-solid fa-rocket ciclo-icon"></i>
                                <h3>CICLO SEMESTRAL</h3>
                                <p>Intensivo y avanzado. Para quienes ya tienen base y buscan asegurar su ingreso directo.</p>
                                <ul class="ciclo-features">
                                    <li><i class="fa-solid fa-check"></i> Nivel Exigencia</li>
                                    <li><i class="fa-solid fa-check"></i> Seminarios Nocturnos</li>
                                </ul>
                                <a href="{{ route('ciclos') }}" class="btn-ciclo btn-red">VER INFORMES</a>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="ciclo-card">
                                <div class="ciclo-badge">VACACIONES</div>
                                <i class="fa-solid fa-sun ciclo-icon"></i>
                                <h3>CICLO VERANO</h3>
                                <p>Adelanto académico y reforzamiento para iniciar el año escolar con ventaja.</p>
                                <ul class="ciclo-features">
                                    <li><i class="fa-solid fa-check"></i> 100% Práctico</li>
                                    <li><i class="fa-solid fa-check"></i> Talleres Dinámicos</li>
                                </ul>
                                <a href="{{ route('ciclos') }}" class="btn-ciclo">VER INFORMES</a>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="ciclo-card">
                                <div class="ciclo-badge">DISPONIBLE</div>
                                <i class="fa-solid fa-calendar-check ciclo-icon"></i>
                                <h3>CICLO ANUAL</h3>
                                <p>Base sólida desde cero. Ideal para dominar todo el prospecto con calma y seguridad.</p>
                                <ul class="ciclo-features">
                                    <li><i class="fa-solid fa-check"></i> Todas las áreas</li>
                                    <li><i class="fa-solid fa-check"></i> Material impreso</li>
                                </ul>
                                <a href="{{ route('ciclos') }}" class="btn-ciclo">VER INFORMES</a>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="ciclo-card featured">
                                <div class="ciclo-badge highlight">MÁS BUSCADO</div>
                                <i class="fa-solid fa-rocket ciclo-icon"></i>
                                <h3>CICLO SEMESTRAL</h3>
                                <p>Intensivo y avanzado. Para quienes ya tienen base y buscan asegurar su ingreso directo.</p>
                                <ul class="ciclo-features">
                                    <li><i class="fa-solid fa-check"></i> Nivel Exigencia</li>
                                    <li><i class="fa-solid fa-check"></i> Seminarios Nocturnos</li>
                                </ul>
                                <a href="{{ route('ciclos') }}" class="btn-ciclo btn-red">VER INFORMES</a>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="ciclo-card">
                                <div class="ciclo-badge">VACACIONES</div>
                                <i class="fa-solid fa-sun ciclo-icon"></i>
                                <h3>CICLO VERANO</h3>
                                <p>Adelanto académico y reforzamiento para iniciar el año escolar con ventaja.</p>
                                <ul class="ciclo-features">
                                    <li><i class="fa-solid fa-check"></i> 100% Práctico</li>
                                    <li><i class="fa-solid fa-check"></i> Talleres Dinámicos</li>
                                </ul>
                                <a href="{{ route('ciclos') }}" class="btn-ciclo">VER INFORMES</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <section class="academia-propuesta-v2">
            <div class="container">
                <div class="propuesta-container-full">
                    <div class="propuesta-image-side">
                        <img src="{{ asset('images/imagen10.jpg') }}" alt="Propuesta Next Level">
                        <div class="propuesta-overlay-badge">
                            <i class="fa-solid fa-bolt"></i>
                            <span>ALTO RENDIMIENTO</span>
                        </div>
                    </div>

                    <div class="propuesta-content-box">
                        <span class="label-preu">METODOLOGÍA AVANZADA</span>
                        <h2 class="title-blue">NUESTRA PROPUESTA</h2>
                        <div class="separator-line"></div>
                        <p>
                            Brindamos el más alto nivel académico y la mejor preparación preuniversitaria,
                            actualizada a las exigencias de las universidades de nuestra región y del país.
                        </p>
                        <ul class="propuesta-list-modern">
                            <li><i class="fa-solid fa-circle-check"></i> Clases magistrales con expertos.</li>
                            <li><i class="fa-solid fa-circle-check"></i> Simulacros semanales calificados.</li>
                            <li><i class="fa-solid fa-circle-check"></i> Tutoría y seguimiento individual.</li>
                        </ul>
                        <a href="https://wa.me/51923317625?text=Hola%20Next%20Level,%20deseo%20información.%20Me%20interesa:%0A%0A1.%20Matrícula%20Colegio%20%0A2.%20Ciclos%20Academia%20%0A3.%20Agendar%20Visita%20Guiada%0A4.%20Costos%20y%20Pensiones%0A%0APor%20favor,%20bríndeme%20detalles." class="btn-propuesta-whatsapp">
                            <i class="fa-brands fa-whatsapp"></i> ¡ASEGURA TU VACANTE!
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <img src="{{ asset('images/logo_footer.png') }}" alt="Next Level Logo" class="footer-logo-img">
                <div class="footer-contact">
                    <p><i class="fa-solid fa-phone"></i> 923 317 626</p>
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
    <script src="{{ asset('js/carrusel-docentes.js') }}"></script>
    <script src="{{ asset('js/academia-ciclos.js') }}"></script>
</body>
</html>
