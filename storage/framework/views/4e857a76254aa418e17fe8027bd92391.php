<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'Next Level - Alumno'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Estilos base del layout -->
    <link rel="stylesheet" href="<?php echo e(asset('css/alumno/layout.css')); ?>">
    
    <!-- Stack para estilos específicos de cada vista -->
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>

    <!-- Header móvil -->
    <div class="mobile-header">
        <div class="d-flex align-items-center gap-2">
            <img src="<?php echo e(asset('images/next-level-logo.png')); ?>" alt="Logo" style="width: 30px;">
            <span class="fw-bold">Next Level</span>
        </div>
        <button class="btn btn-outline-light border-0" onclick="toggleSidebar()">
            <i class="bi bi-list fs-2"></i>
        </button>
    </div>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <div class="d-flex">
        <aside class="sidebar" id="sidebar">
            <div class="logo">
                <img src="<?php echo e(asset('images/next-level-logo.png')); ?>" alt="Next Level" class="logo-img">
                <span>Next Level</span>
            </div>

            <nav class="menu">
                <a href="<?php echo e(route('alumno.pagina_institucional')); ?>" class="<?php echo e(request()->routeIs('alumno.pagina_institucional') ? 'active' : ''); ?>">
                    <i class="bi bi-house-door"></i>
                    <span>Página Institucional</span>
                </a>

                <a href="<?php echo e(route('alumno.courses')); ?>" class="<?php echo e(request()->routeIs('alumno.courses') ? 'active' : ''); ?>">
                    <i class="bi bi-book"></i>
                    <span>Mis Cursos</span>
                </a>

                <a href="<?php echo e(route('alumno.activity')); ?>" class="<?php echo e(request()->routeIs('alumno.activity') ? 'active' : ''); ?>">
                    <i class="bi bi-activity"></i>
                    <span>Actividad</span>
                </a>

                <a href="<?php echo e(route('alumno.calendar')); ?>" class="<?php echo e(request()->routeIs('alumno.calendar') ? 'active' : ''); ?>">
                    <i class="bi bi-calendar-event"></i>
                    <span>Calendario</span>
                </a>

                <a href="<?php echo e(route('alumno.messages')); ?>" class="<?php echo e(request()->routeIs('alumno.messages') ? 'active' : ''); ?>">
                    <i class="bi bi-envelope"></i>
                    <span>Mensajes</span>
                </a>

                <a href="<?php echo e(route('alumno.qualifications')); ?>" class="<?php echo e(request()->routeIs('alumno.qualifications') ? 'active' : ''); ?>">
                    <i class="bi bi-award"></i>
                    <span>Calificaciones</span>
                </a>

                <a href="<?php echo e(route('alumno.tools')); ?>" class="<?php echo e(request()->routeIs('alumno.tools') ? 'active' : ''); ?>">
                    <i class="bi bi-tools"></i>
                    <span>Herramientas</span>
                </a>

                <a href="<?php echo e(route('alumno.eti')); ?>" class="<?php echo e(request()->routeIs('alumno.eti') ? 'active' : ''); ?>">
                    <i class="bi bi-cpu"></i>
                    <span>ETI</span>
                </a>

                <form id="logout-form" action="<?php echo e(route('logout.alumno')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>

                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </nav>
        </aside>

        <main class="main-content" id="mainContent">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH C:\xampp\htdocs\Proyect-Next-level\resources\views/layouts/Alumnoslanding.blade.php ENDPATH**/ ?>