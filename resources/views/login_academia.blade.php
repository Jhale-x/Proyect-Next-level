<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intranet Academia | Next Level</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap">
    <link rel="stylesheet" href="{{ asset('css/web/login_academia.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
</head>
<body>

    <div class="main-sliding-container active" id="mainContainer">

        <div class="form-side family-side">
            <div class="form-content-wrapper">
                <header class="login-header">
                    <p class="intranet-tag">Intranet</p>
                    <h1 class="brand-title">Academia</h1>
                </header>

                <h2 class="welcome-msg">¡Bienvenido Familia!</h2>

                <form class="auth-form" method="POST" action="#">
                    <div class="input-group">
                        <label for="doc_academia">Nro. de documento</label>
                        <input type="text" id="doc_academia" name="documento" placeholder="Ej: 70001234" required class="main-input">
                    </div>
                    <button type="submit" class="btn-custom-effect btn-submit">
                        <span>Ingresar</span>
                    </button>
                </form>

                <div class="form-footer-actions">
                    <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
                </div>

                <div class="social-icons-wrapper">
                    <a href="https://www.tiktok.com/@next_level_novus" class="social-btn"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.instagram.com/next_level_novus/" class="social-btn"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/51923317625?text=Hola%20Next%20Level,%20deseo%20información.%20Me%20interesa:%0A%0A1.%20Matrícula%20Colegio%20%0A2.%20Ciclos%20Academia%20%0A3.%20Agendar%20Visita%20Guiada%0A4.%20Costos%20y%20Pensiones%0A%0APor%20favor,%20bríndeme%20detalles." class="social-btn"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=61581492196914" class="social-btn"><i class="fab fa-facebook"></i></a>
                </div>

                <footer class="legal-footer">
                    <div class="footer-links">
                        <a href="#">Términos y condiciones</a> <span>/</span> <a href="#">Política de privacidad</a>
                    </div>
                    <p class="copyright">© 2026 Next Level. Todos los derechos reservados.</p>
                </footer>
            </div>
        </div>

        <div class="form-side student-side">
            <div class="back-btn-container">
                <a href="{{ route('portal') }}" class="btn-custom-effect back-circle">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                        <path d="M7 8L3 12M3 12L7 16M3 12H17" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15 3H19C19.5304 3 20.4142 3.58579 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H15" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <div class="form-content-wrapper">
                <header class="login-header">
                    <p class="intranet-tag">Intranet</p>
                    <h1 class="brand-title">Academia</h1>
                </header>

                <h2 class="welcome-msg">¡Bienvenido!</h2>

                <form class="auth-form" method="POST" action="#">
                    <div class="input-group">
                        <label for="alumno_id">ID</label>
                        <input type="text" id="alumno_id" name="alumno_id" placeholder="Ej: 0020261234@nextlevel.pe" required class="main-input">
                    </div>
                    <div class="input-group">
                        <label for="passwordInput">Contraseña</label>
                        <div class="pass-relative">
                            <input id="passwordInput" type="password" name="password" placeholder="••••••••" required class="main-input">
                            <button id="togglePassword" type="button" class="eye-btn">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn-custom-effect btn-submit">
                        <span>Ingresar</span>
                    </button>
                </form>

                <div class="form-footer-actions">
                    <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
                </div>

                <div class="social-icons-wrapper">
                    <a href="https://www.tiktok.com/@next_level_novus" class="social-btn"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.instagram.com/next_level_novus/" class="social-btn"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/51923317625?text=Hola%20Next%20Level,%20deseo%20información.%20Me%20interesa:%0A%0A1.%20Matrícula%20Colegio%20%0A2.%20Ciclos%20Academia%20%0A3.%20Agendar%20Visita%20Guiada%0A4.%20Costos%20y%20Pensiones%0A%0APor%20favor,%20bríndeme%20detalles." class="social-btn"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=61581492196914" class="social-btn"><i class="fab fa-facebook"></i></a>
                </div>

                <footer class="legal-footer">
                    <div class="footer-links">
                        <a href="#">Términos y condiciones</a> <span>/</span> <a href="#">Política de privacidad</a>
                    </div>
                    <p class="copyright">© 2026 Next Level. Todos los derechos reservados.</p>
                </footer>
            </div>
        </div>

        <div class="sliding-panel-container">
            <div class="sliding-panel">
                <div class="overlay-text-content">
                    <h1 id="overlayTitle">¿Eres Familia?</h1>
                    <p id="overlayText">Accede con tu documento de identidad para el <br> seguimiento de tus hijos.</p>
                    <button class="btn-ghost-white btn-custom-effect" id="toggleBtn">
                        <span>Soy Familia</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
