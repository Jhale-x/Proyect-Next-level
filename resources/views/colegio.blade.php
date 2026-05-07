<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Next Level | Colegio</title>
    <meta name="description" content="Next Level School ofrece una educación escolar de alto rendimiento con un enfoque preuniversitario desde los primeros grados. El futuro empieza aquí.">
    <meta name="keywords" content="colegio Pucallpa, educación secundaria, formación escolar, alto rendimiento académico">
    <meta property="og:title" content="Educación Escolar | Next Level">
    <meta property="og:image" content="{{ asset('images/Logo-Next-Level.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/marquee_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/colegio.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Logo-Next-Level.png') }}">
</head>

<body>

    <div class="top-bar">
        <div class="marquee-wrapper">
            <div class="marquee-track" id="marqueeTrack">
                <div class="marquee-item">
                    ¡Matrícula 2026! &nbsp;&nbsp;&nbsp;&nbsp;
                    🚀📚 Ciclos Anual / Semestral / Verano &nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>

    <nav class="main-nav">
        <div class="nav-container">
            <a href="{{ route('web.inicio') }}" class="nav-brand">
                <img src="{{ asset('images/Logo-Letras-Next-Level.png') }}" alt="Next Level" class="nav-logo-full">
            </a>

            <button class="mobile-menu-toggle" id="menuOpen" type="button">
                <i class="fa-solid fa-bars"></i>
            </button>

            <ul class="nav-menu">
                <li><a href="{{ route('web.inicio') }}">INICIO</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NOSOTROS <span class="arrow-icon">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('que_ofrecemos') }}">Qué ofrecemos</a></li>
                        <li><a href="{{ route('sobre_nosotros') }}">Sobre nosotros</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NIVELES <span class="arrow-icon">&#9662;</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('colegio') }}" class="active">Colegio</a></li>
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
                    <li><a href="{{ route('que_ofrecemos') }}">Qué ofrecemos</a></li>
                    <li><a href="{{ route('sobre_nosotros') }}">Sobre nosotros</a></li>
                </ul>
            </div>

            <div class="menu-panel" id="submenu-niveles">
                <button class="back-btn" type="button"><i class="fa-solid fa-chevron-left"></i> REGRESAR</button>
                <ul class="mobile-nav-list">
                    <li><a href="{{ route('colegio') }}">Colegio</a></li>
                    <li><a href="{{ route('academia') }}">Academia</a></li>
                </ul>
            </div>
        </div>
    </div>

    <main>

        <header class="exp-hero">
            <div class="exp-hero-overlay">
                <div class="exp-hero-content">
                    <span class="welcome-tag">EDUCACIÓN INTEGRAL</span>
                    <h1 class="welcome-title-hero">COLEGIO NEXT LEVEL</h1>
                    <div class="welcome-line-hero"></div>
                    <p class="welcome-description-hero">
                        Formamos con corazón y futuro, a través de una educación integral, valores humanos
                        excelencia académica que transforma vidas.
                    </p>
                </div>
            </div>
        </header>

        <section class="filosofia-section">
            <div class="container">
                <div class="filosofia-grid">
                    <div class="filosofia-text">
                        <span class="academy-label">NUESTRA ESENCIA</span>
                        <h2 class="title-blue">MÁS QUE UN COLEGIO,<br>UNA FAMILIA EDUCATIVA</h2>
                        <div class="separador"></div>
                        <p>En Colegio Next Level creemos que cada estudiante es único. Por eso, desarrollamos un modelo
                            pedagógico personalizado que potencia talentos, fomenta el pensamiento crítico y cultiva
                            valores como la empatía, la responsabilidad y el respeto.</p>
                        <p>Nuestro enfoque combina innovación tecnológica con tradición humanista, preparando a los
                            jóvenes para los desafíos globales sin perder su identidad y raíces culturales.</p>
                        <div class="pillar-list">
                            <div class="pillar">
                                <i class="fas fa-brain"></i>
                                <h4>Innovación</h4>
                                <p>Tecnología y métodos vanguardistas</p>
                            </div>
                            <div class="pillar">
                                <i class="fas fa-heart"></i>
                                <h4>Valores</h4>
                                <p>Formación humana integral</p>
                            </div>
                            <div class="pillar">
                                <i class="fas fa-user-graduate"></i>
                                <h4>Liderazgo</h4>
                                <p>Forjando agentes de cambio</p>
                            </div>
                        </div>
                    </div>
                    <div class="filosofia-img">
                        <img src="{{ asset('images/Colegio-Esencia-Next-Level.png') }}" alt="Estudiantes felices">
                    </div>
                </div>
            </div>
        </section>

        <section class="nivel-educativo-section">
            <div class="container">
                <div class="section-header">
                    <span class="academy-label">NUESTRA OFERTA EDUCATIVA</span>
                    <h2 class="title-blue">Recorrido Educativo</h2>
                    <div class="title-line-red"></div>
                </div>

                <div class="timeline-educativo">
                    <div class="timeline-line"></div>

                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <div class="marker-dot">
                                <i class="fas fa-child"></i>
                            </div>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-badge">PRIMARIA</div>
                            <div class="timeline-header">
                                <h3>Educación Primaria</h3>
                                <div class="timeline-grados">1° a 6° grado</div>
                            </div>
                            <div class="timeline-desc">
                                <p>Fortalecimiento de habilidades fundamentales, pensamiento lógico, expresión artística
                                    y desarrollo de valores. Metodología activa con énfasis en comprensión lectora y
                                    razonamiento matemático.</p>
                            </div>
                            <div class="timeline-features">
                                <div class="feature-chip"><i class="fas fa-users"></i> Máx. 25 alumnos</div>
                                <div class="feature-chip"><i class="fas fa-language"></i> Inglés 8h/semana</div>
                                <div class="feature-chip"><i class="fas fa-palette"></i> Talleres artísticos</div>
                                <div class="feature-chip"><i class="fas fa-brain"></i> Inteligencias múltiples</div>
                            </div>
                        </div>
                        <div class="timeline-image">
                            <img src="{{ asset('images/Colegio-Primaria-Next-Level.png') }}" alt="Primaria">
                            <div class="image-overlay-timeline">
                                <span><a href="{{ route('galeria') }}"><i class="fas fa-camera"></i> Galería</a></span>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <div class="marker-dot">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-badge">SECUNDARIA</div>
                            <div class="timeline-header">
                                <h3>Educación Secundaria</h3>
                                <div class="timeline-grados">1° a 5° año</div>
                            </div>
                            <div class="timeline-desc">
                                <p>Preparación integral para la vida universitaria y profesional. Desarrollamos
                                    liderazgo, pensamiento crítico, proyectos de innovación y orientación vocacional con
                                    altos estándares académicos.</p>
                            </div>
                            <div class="timeline-features">
                                <div class="feature-chip"><i class="fas fa-university"></i> Preuniversitario</div>
                                <div class="feature-chip"><i class="fas fa-lightbulb"></i> Liderazgo</div>
                                <div class="feature-chip"><i class="fas fa-microchip"></i> Robótica avanzada</div>
                                <div class="feature-chip"><i class="fas fa-globe"></i> Intercambios</div>
                            </div>
                        </div>
                        <div class="timeline-image">
                            <img src="{{ asset('images/Colegio-Next-Level.jpeg') }}" alt="Secundaria">
                            <div class="image-overlay-timeline">
                                <span><a href="{{ route('galeria') }}"><i class="fas fa-camera"></i> Galería</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="valores-hexagon-section">
            <div class="container">
                <div class="section-header">
                    <span class="academy-label">PILARES FUNDAMENTALES</span>
                    <h2 class="title-blue">Nuestros Valores y Principios</h2>
                    <div class="title-line-red"></div>
                </div>

                <div class="hexagon-grid">
                    <div class="hexagon-wrapper">
                        <div class="hexagon">
                            <div class="hexagon-content">
                                <i class="fas fa-hand-holding-heart"></i>
                                <h3>Excelencia</h3>
                                <p>Búsqueda constante de la mejora continua y los más altos estándares educativos.</p>
                            </div>
                        </div>
                    </div>
                    <div class="hexagon-wrapper">
                        <div class="hexagon">
                            <div class="hexagon-content">
                                <i class="fas fa-users"></i>
                                <h3>Respeto</h3>
                                <p>Cultura de respeto mutuo, inclusión y comprensión hacia las diferencias individuales.</p>
                            </div>
                        </div>
                    </div>
                    <div class="hexagon-wrapper">
                        <div class="hexagon">
                            <div class="hexagon-content">
                                <i class="fas fa-seedling"></i>
                                <h3>Responsabilidad</h3>
                                <p>Compromiso con el entorno, cuidado del medio ambiente y el bien común.</p>
                            </div>
                        </div>
                    </div>
                    <div class="hexagon-wrapper">
                        <div class="hexagon">
                            <div class="hexagon-content">
                                <i class="fas fa-lightbulb"></i>
                                <h3>Creatividad</h3>
                                <p>Estimulamos el pensamiento original y la resolución creativa de problemas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="hexagon-wrapper">
                        <div class="hexagon">
                            <div class="hexagon-content">
                                <i class="fas fa-handshake"></i>
                                <h3>Integridad</h3>
                                <p>Actuamos con honestidad, transparencia y ética en todas nuestras acciones.</p>
                            </div>
                        </div>
                    </div>
                    <div class="hexagon-wrapper">
                        <div class="hexagon">
                            <div class="hexagon-content">
                                <i class="fas fa-heart"></i>
                                <h3>Empatía</h3>
                                <p>Comprendemos y nos preocupamos por las necesidades de los demás.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="metodo-floating-section">
            <div class="container">
                <div class="section-header">
                    <span class="academy-label">METODOLOGÍA PROPIA</span>
                    <h2 class="title-white">Método Next Level</h2>
                    <div class="title-line-red"></div>
                </div>

                <div class="metodo-floating-grid">
                    <div class="metodo-floating-card">
                        <div class="card-number">01</div>
                        <div class="card-icon">
                            <i class="fas fa-microscope"></i>
                        </div>
                        <h3>Aprendizaje por Proyectos</h3>
                        <p>Investigación y solución de problemas reales, desarrollando pensamiento crítico y trabajo
                            colaborativo desde temprana edad.</p>
                        <div class="card-hover-effect"></div>
                    </div>
                    <div class="metodo-floating-card">
                        <div class="card-number">02</div>
                        <div class="card-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h3>Pensamiento Crítico</h3>
                        <p>Análisis profundo, reflexión y cuestionamiento constante para formar ciudadanos con criterio
                            propio.</p>
                        <div class="card-hover-effect"></div>
                    </div>
                    <div class="metodo-floating-card">
                        <div class="card-number">03</div>
                        <div class="card-icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h3>Tecnología Educativa</h3>
                        <p>Aulas digitales, realidad aumentada y herramientas innovadoras que potencian el aprendizaje.</p>
                        <div class="card-hover-effect"></div>
                    </div>
                    <div class="metodo-floating-card">
                        <div class="card-number">04</div>
                        <div class="card-icon">
                            <i class="fas fa-hand-peace"></i>
                        </div>
                        <h3>Aprendizaje Socioemocional</h3>
                        <p>Inteligencia emocional, habilidades blandas y formación en valores para la vida.</p>
                        <div class="card-hover-effect"></div>
                    </div>
                    <div class="metodo-floating-card">
                        <div class="card-number">05</div>
                        <div class="card-icon">
                            <i class="fas fa-language"></i>
                        </div>
                        <h3>Inmersión Bilingüe</h3>
                        <p>Inglés desde inicial con metodología comunicativa y certificaciones internacionales.</p>
                        <div class="card-hover-effect"></div>
                    </div>
                    <div class="metodo-floating-card">
                        <div class="card-number">06</div>
                        <div class="card-icon">
                            <i class="fas fa-chalkboard-user"></i>
                        </div>
                        <h3>Acompañamiento Personalizado</h3>
                        <p>Seguimiento individualizado con tutorías y planes de desarrollo personal.</p>
                        <div class="card-hover-effect"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="academia-propuesta-v2">
            <div class="container">
                <div class="propuesta-container-full">
                    <div class="propuesta-image-side">
                        <img src="{{ asset('images/Colegio-Propuesta-Next-Level.png') }}" alt="Propuesta Next Level">
                        <div class="propuesta-overlay-badge">
                            <i class="fa-solid fa-bolt"></i>
                            <span>EDUCACIÓN INTEGRAL</span>
                        </div>
                    </div>

                    <div class="propuesta-content-box">
                        <span class="label-preu">NUESTRA PROPUESTA</span>
                        <h2 class="title-blue">EDUCACIÓN PARA LA VIDA</h2>
                        <div class="separator-line"></div>
                        <p>
                            Brindamos el más alto nivel académico y la mejor formación integral,
                            actualizada a las exigencias del mundo moderno y con sólidos valores humanos.
                        </p>
                        <ul class="propuesta-list-modern">
                            <li><i class="fa-solid fa-circle-check"></i> Formación en valores y liderazgo.</li>
                            <li><i class="fa-solid fa-circle-check"></i> Metodología activa y participativa.</li>
                            <li><i class="fa-solid fa-circle-check"></i> Acompañamiento personalizado y tutorías.</li>
                        </ul>
                        <a href="https://wa.me/51923317625?text=Hola%20Next%20Level,%20deseo%20información%20sobre%20el%20colegio."
                            class="btn-propuesta-whatsapp">
                            <i class="fa-brands fa-whatsapp"></i> ¡AGENDA TU VISITA!
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonios-section">
            <div class="container">
                <div class="section-header">
                    <span class="academy-label">LO QUE DICEN NUESTRAS FAMILIAS</span>
                    <h2 class="title-blue">Testimonios de Confianza</h2>
                    <div class="title-line-red"></div>
                </div>

                <div class="swiper testimonios-swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonio-card-solid">
                                <div class="quote-icon-solid">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <p>"La formación integral que recibe mi hija en Next Level es excepcional. No solo
                                    destacan en lo académico, sino que han desarrollado valores sólidos que la
                                    acompañarán toda la vida."</p>
                                <div class="rating-solid">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonio-card-solid">
                                <div class="quote-icon-solid">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <p>"Los profesores son apasionados y comprometidos. Mi hijo encontró su vocación en
                                    robótica gracias a los talleres extracurriculares que ofrece Next Level."</p>
                                <div class="rating-solid">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonio-card-solid">
                                <div class="quote-icon-solid">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <p>"La infraestructura y el enfoque bilingüe son increíbles. Mis hijos están felices y
                                    aprendiendo cada día más. La comunicación con los profesores en Next Level es
                                    excelente."</p>
                                <div class="rating-solid">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonio-card-solid">
                                <div class="quote-icon-solid">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <p>"El nivel académico es sobresaliente. Mi hija ingresó a la universidad que quería
                                    gracias a la preparación que recibió en Next Level. Totalmente recomendado."</p>
                                <div class="rating-solid">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <img src="{{ asset('images/Logo-Footer-Next-Level.png') }}" alt="Next Level Logo" class="footer-logo-img">
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
                    <a href="{{ route('sobre_nosotros') }}">SOBRE NOSOTROS</a>
                    <a href="{{ route('nuestros_valores') }}">NUESTROS VALORES</a>
                </div>
                <div class="footer-column">
                    <a href="{{ route('academia') }}">ACADEMIA</a>
                    <a href="{{ route('pagos') }}">PAGOS EN LÍNEA</a>
                    <a href="{{ route('mantenimiento') }}">MATRíCULA 2026</a>
                    <a href="{{ route('pagos') }}">MATRÍCULA ONLINE</a>
                    <a href="{{ route('mantenimiento') }}">LIBRO RECLAMACIONES</a>
                </div>
                <div class="footer-column social-align">
                    <a href="{{ route('politica_cookies') }}">POLÍTICA COOKIES</a>
                    <a href="{{ route('politica_privacidad') }}">POLÍTICA PRIVACIDAD</a>
                    <a href="{{ route('terminos_condiciones') }}">TÉRMINOS Y CONDICIONES</a>

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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/colegio.js') }}"></script>
</body>
</html>
