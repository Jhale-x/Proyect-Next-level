<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'Next Level'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php
        $landingCssVersion = filemtime(public_path('css/landing.css'));
    ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/course.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/landing.css') . '?v=' . $landingCssVersion); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/alumno/activityAlumno.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>
    <?php
        $currentUser = Auth::guard('alumno')->check() ? Auth::guard('alumno')->user() : Auth::user();
    ?>

    <div class="mobile-header">
        <div class="d-flex align-items-center gap-2">
            <img src="<?php echo e(asset('images/next-level-logo.png')); ?>" alt="Logo" style="width: 30px;">
            <span class="fw-bold">Next Level</span>
        </div>
        <button class="btn btn-outline-light border-0" type="button" data-sidebar-toggle>
            <i class="bi bi-list fs-2"></i>
        </button>
    </div>

    <div class="sidebar-overlay" id="sidebarOverlay" data-sidebar-toggle></div>

    <div class="d-flex">
        <aside class="sidebar" id="sidebar">
            <div class="logo">
                <img src="<?php echo e(asset('images/next-level-logo.png')); ?>" alt="Next Level" class="logo-img">
                <span>Next Level</span>
            </div>

            <nav class="menu">
                <a href="<?php echo e(route('apoderado.pagina_institucional')); ?>"
                    class="<?php echo e(request()->routeIs('apoderado.pagina_institucional') ? 'active' : ''); ?>">
                    <i class="bi bi-house-door"></i>
                    <span>Pagina Institucional</span>
                </a>
                <a href="<?php echo e(route('apoderado.courses')); ?>"
                    class="<?php echo e(request()->routeIs('apoderado.courses') ? 'active' : ''); ?>">
                    <i class="bi bi-journal-bookmark"></i>
                    <span>Cursos</span>
                </a>

                <a href="<?php echo e(route('apoderado.activity')); ?>"
                    class="<?php echo e(request()->routeIs('apoderado.activity') ? 'active' : ''); ?>">
                    <i class="bi bi-activity"></i>
                    <span>Actividad</span>
                </a>

                <a href="<?php echo e(route('apoderado.calendar')); ?>"
                    class="<?php echo e(request()->routeIs('apoderado.calendar') ? 'active' : ''); ?>">
                    <i class="bi bi-calendar-event"></i>
                    <span>Calendario</span>
                </a>

                

                

                <a href="<?php echo e(route('apoderado.tools')); ?>"
                    class="<?php echo e(request()->routeIs('apoderado.tools') ? 'active' : ''); ?>">
                    <i class="bi bi-tools"></i>
                    <span>Herramientas</span>
                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>

                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                </a>
            </nav>
        </aside>

        <main class="main-content" id="mainContent">
            <div class="admin-topbar d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="position-relative search-box w-100 w-md-auto">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="form-control" placeholder="Buscar curso, actividad o mensaje...">
                </div>

                <div class="d-flex align-items-center gap-2 ms-auto">
                    <button class="icon-btn" type="button" aria-label="Notificaciones">
                        <i class="bi bi-bell"></i>
                    </button>

                    <div class="dropdown">
                        <?php
                            $user = Auth::guard('apoderado')->user();
                        ?>

                        <button class="btn admin-user-trigger dropdown-toggle d-flex align-items-center gap-2"
                            type="button" data-bs-toggle="dropdown">

                            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(($user->nombre ?? '') . ' ' . ($user->apellido ?? ''))); ?>&background=0D6EFD&color=fff"
                                class="rounded-circle" width="34" height="34" alt="Avatar">

                            <div class="text-start d-none d-sm-block">
                                <div class="fw-semibold" style="line-height:1;">
                                    <?php echo e($user->nombre ?? 'Usuario'); ?> <?php echo e($user->apellido ?? ''); ?>

                                </div>

                                <small class="text-muted text-capitalize">
                                    Apoderado
                                </small>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><span
                                    class="dropdown-item-text text-muted text-capitalize"><?php echo e($currentUser->rol ?? ''); ?></span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <button type="submit" form="logout-form" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <?php echo $__env->yieldPushContent('modals'); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <script>
        function toggleSubmenu(event, id) {
            event.preventDefault();
            const submenu = document.getElementById(id);
            if (submenu.style.display === "none" || submenu.style.display === "") {
                submenu.style.display = "flex";
                submenu.style.flexDirection = "column";
            } else {
                submenu.style.display = "none";
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\laravel\Proyect_Next_Level\resources\views/layouts/Apoderadolanding.blade.php ENDPATH**/ ?>