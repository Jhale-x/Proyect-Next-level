<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'Next Level'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php ($landingCssVersion = filemtime(public_path('css/landing.css'))); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/course.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/landing.css') . '?v=' . $landingCssVersion); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>
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
                <a href="<?php echo e(route('admin.dashboard')); ?>"
                    class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
                <nav class="menu">
                    <a href="<?php echo e(route('admin.pagina_institucional')); ?>"
                        class="<?php echo e(request()->routeIs('admin.pagina_institucional') ? 'active' : ''); ?>">
                        <i class="bi bi-house-door"></i>
                        <span>Pagina Institucional</span>
                    </a>

                    <a href="<?php echo e(route('admin.activity')); ?>"
                        class="<?php echo e(request()->routeIs('admin.activity') ? 'active' : ''); ?>">
                        <i class="bi bi-activity"></i>
                        <span>Actividad</span>
                    </a>
                    <link rel="stylesheet" href="<?php echo e(asset('css/landing.css') . '?v=' . $landingCssVersion); ?>">
                    <div class="sidebar-item">
                        <a href="<?php echo e(route('admin.courses')); ?>"
                            class="<?php echo e(request()->routeIs('admin.courses') || request()->routeIs('admin.eti') ? 'active' : ''); ?>">
                            <i class="bi bi-book"></i>
                            <span>Cursos</span>
                        </a>
                        <div class="submenu"
                            style="<?php echo e(request()->routeIs('admin.courses') || request()->routeIs('admin.eti') ? 'display: flex; flex-direction: column;' : 'display: none;'); ?>">
                            <a href="<?php echo e(route('admin.courses')); ?>"
                                class="<?php echo e(request()->routeIs('admin.courses') ? 'text-white fw-bold' : ''); ?>">
                                <i class="bi bi-collection me-2"></i> Todos los Cursos
                            </a>
                            <a href="<?php echo e(route('admin.eti')); ?>"
                                class="<?php echo e(request()->routeIs('admin.eti') ? 'text-white fw-bold' : ''); ?>">
                                <i class="bi bi-cpu me-2"></i> ETA
                            </a>
                        </div>
                    </div>

                    <a href="<?php echo e(route('admin.users.index')); ?>"
                        class="<?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                        <i class="bi bi-people"></i>
                        <span>Usuarios</span>
                    </a>

                    <div class="sidebar-item">
                        <a href="javascript:void(0)"
                            class="btn-submenu <?php echo e(request()->is('admin/alumnos*') || request()->is('admin/users*') ? 'active' : ''); ?>"
                            onclick="toggleSubmenu(event, 'listado-items')">
                            <i class="bi bi-people-fill"></i>
                            <span>Listado</span>
                            <i class="bi bi-chevron-down ms-auto arrow-icon" style="font-size: 0.8rem;"></i>
                        </a>

                        <div class="submenu" id="listado-items"
                            style="<?php echo e(request()->is('admin/alumnos*') || request()->is('admin/users*') ? 'display: flex; flex-direction: column;' : 'display: none;'); ?>">

                            <a href="<?php echo e(route('admin.alumnos.index')); ?>"
                                class="<?php echo e(request()->routeIs('admin.alumnos.*') ? 'text-white fw-bold' : ''); ?>">
                                <i class="bi bi-person-workspace me-2"></i> Lista de alumnos
                            </a>

                            <a href="<?php echo e(route('admin.users.listado')); ?>"
                                class="<?php echo e(request()->routeIs('admin.users.listado') ? 'text-white fw-bold' : ''); ?>">
                                <i class="bi bi-person-badge me-2"></i> Lista de personal
                            </a>

                        </div>
                    </div>

                    <a href="<?php echo e(route('admin.calendar')); ?>"
                        class="<?php echo e(request()->routeIs('admin.calendar') ? 'active' : ''); ?>">
                        <i class="bi bi-calendar-event"></i>
                        <span>Calendario</span>
                    </a>

                    <a href="<?php echo e(route('admin.messages')); ?>"
                        class="<?php echo e(request()->routeIs('admin.messages') ? 'active' : ''); ?>">
                        <i class="bi bi-envelope"></i>
                        <span>Mensajes</span>
                    </a>

                    <a href="<?php echo e(route('admin.tools')); ?>"
                        class="<?php echo e(request()->routeIs('admin.tools') ? 'active' : ''); ?>">
                        <i class="bi bi-tools"></i>
                        <span>Herramientas</span>
                    </a>

                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                    </a>
                </nav>
        </aside>

        <main class="main-content" id="mainContent">

            <!-- HEADER -->
            <div class="admin-topbar d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="position-relative search-box w-100 w-md-auto">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="form-control" placeholder="Buscar usuario, curso o anuncio...">
                </div>

                <div class="d-flex align-items-center gap-2 ms-auto">
                    <button class="icon-btn" type="button" aria-label="Notificaciones">
                        <i class="bi bi-bell"></i>
                    </button>

                    <div class="dropdown">
                        <button class="btn admin-user-trigger dropdown-toggle d-flex align-items-center gap-2"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name=<?php echo e(Auth::user()->nombre); ?>+<?php echo e(Auth::user()->apellido); ?>&background=0D6EFD&color=fff"
                                class="rounded-circle" width="34" height="34" alt="Avatar">
                            <div class="text-start d-none d-sm-block">
                                <div class="fw-semibold" style="line-height:1;"><?php echo e(Auth::user()->nombre); ?>

                                    <?php echo e(Auth::user()->apellido); ?></div>
                                <small class="text-muted text-capitalize"><?php echo e(Auth::user()->rol); ?></small>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><span
                                    class="dropdown-item-text text-muted text-capitalize"><?php echo e(Auth::user()->rol); ?></span>
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
        // Función para abrir/cerrar submenús al hacer clic
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

        // Tu función existente para el móvil
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\laravel\Proyect_Next_Level\resources\views/layouts/Adminlanding.blade.php ENDPATH**/ ?>