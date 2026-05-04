<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intranet Docentes | Next Level</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap">

    <link rel="stylesheet" href="<?php echo e(asset('css/login_user.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/web/web_principal.css')); ?>">
</head>

<body>

    <div class="main-sliding-container active" id="mainContainer">

        <!-- 🔵 ADMIN -->
        <div class="form-side admin-side">
            <div class="form-content-wrapper">

                <header class="login-header">
                    <p class="intranet-tag">Intranet</p>
                    <h1 class="brand-title">Admin</h1>
                </header>

                <h2 class="welcome-msg">¡Bienvenido Administrador!</h2>

                <!-- FORM ADMIN -->
                <form class="auth-form" method="POST" action="#">
                    <?php echo csrf_field(); ?>

                    <!-- Usuario -->
                    <div class="input-group">
                        <label for="admin_user">Usuario</label>
                        <input type="text" id="admin_user" name="usuario"
                            placeholder="Ej: admin@nextlevel.pe" required class="main-input">
                    </div>

                    <!-- Contraseña -->
                    <div class="input-group">
                        <label for="passwordInputAdmin">Contraseña</label>
                        <div class="pass-relative">
                            <input id="passwordInputAdmin" type="password" name="password"
                                placeholder="••••••••" required class="main-input">

                            <button id="togglePasswordAdmin" type="button" class="eye-btn">
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

                <!-- REDES -->
                <div class="social-icons-wrapper">
                    <a href="https://www.tiktok.com/@next_level_novus" class="social-btn"><i
                            class="fab fa-tiktok"></i></a>
                    <a href="https://www.instagram.com/next_level_novus/" class="social-btn"><i
                            class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/51923317625" class="social-btn"><i
                            class="fab fa-whatsapp"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=61581492196914" class="social-btn"><i
                            class="fab fa-facebook"></i></a>
                </div>

                <footer class="legal-footer">
                    <div class="footer-links">
                        <a href="#">Términos y condiciones</a> <span>/</span>
                        <a href="#">Política de privacidad</a>
                    </div>
                    <p class="copyright">© 2026 Next Level. Todos los derechos reservados.</p>
                </footer>

            </div>
        </div>

        <!-- 🟢 DOCENTE -->
        <div class="form-side teacher-side">

            <div class="back-btn-container">
                <a href="<?php echo e(route('portal')); ?>" class="btn-custom-effect back-circle">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white"
                        stroke-width="2.5">
                        <path d="M7 8L3 12M3 12L7 16M3 12H17" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M15 3H19C19.5304 3 20.4142 3.58579 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H15"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

            <div class="form-content-wrapper">

                <header class="login-header">
                    <p class="intranet-tag">Intranet</p>
                    <h1 class="brand-title">Docentes</h1>
                </header>

                <h2 class="welcome-msg">¡Bienvenido Docente!</h2>

                <!-- FORM DOCENTE -->
                <form class="auth-form" method="POST" action="#">
                    <?php echo csrf_field(); ?>

                    <div class="input-group">
                        <label for="docente_id">ID</label>
                        <input type="text" id="docente_id" name="docente_id"
                            placeholder="Ej: 0020261234@NextLevelAcademy.pe"
                            required class="main-input">
                    </div>

                    <div class="input-group">
                        <label for="passwordInputDoc">Contraseña</label>
                        <div class="pass-relative">
                            <input id="passwordInputDoc" type="password" name="password"
                                placeholder="••••••••" required class="main-input">

                            <button id="togglePasswordDoc" type="button" class="eye-btn">
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

                <!-- REDES -->
                <div class="social-icons-wrapper">
                    <a href="https://www.tiktok.com/@next_level_novus" class="social-btn"><i
                            class="fab fa-tiktok"></i></a>
                    <a href="https://www.instagram.com/next_level_novus/" class="social-btn"><i
                            class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/51923317625" class="social-btn"><i
                            class="fab fa-whatsapp"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=61581492196914" class="social-btn"><i
                            class="fab fa-facebook"></i></a>
                </div>

                <footer class="legal-footer">
                    <div class="footer-links">
                        <a href="#">Términos y condiciones</a> <span>/</span>
                        <a href="#">Política de privacidad</a>
                    </div>
                    <p class="copyright">© 2026 Next Level. Todos los derechos reservados.</p>
                </footer>

            </div>
        </div>

        <!-- 🔁 PANEL DESLIZANTE -->
        <div class="sliding-panel-container">
            <div class="sliding-panel">
                <div class="overlay-text-content">
                    <h1 id="overlayTitle">¿Eres Administrador?</h1>
                    <p id="overlayText">
                        Accede con tu cuenta para la <br> gestión administrativa.
                    </p>
                    <button class="btn-ghost-white btn-custom-effect" id="toggleBtn">
                        <span>Soy Administrador</span>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <script src="<?php echo e(asset('js/login_user.js')); ?>"></script>

</body>
</html><?php /**PATH C:\xampp\htdocs\Proyect-Next-level\resources\views/auth/login_user.blade.php ENDPATH**/ ?>