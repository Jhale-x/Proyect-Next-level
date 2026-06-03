<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'Next Level'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php($landingCssVersion = filemtime(public_path('css/landing.css')))

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/course.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') . '?v=' . $landingCssVersion }}">
    <link rel="stylesheet" href="{{ asset('css/messages.css') }}">


</head>

<body>

    <div class="mobile-header">
        <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('images/next-level-logo.png') }}" alt="Logo" style="width: 30px;">
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
                <img src="{{ asset('images/next-level-logo.png') }}" alt="Next Level" class="logo-img">
                <span>Next Level</span>
            </div>

            @php
                $role = auth()->check() ? strtolower(auth()->user()->rol) : '';
            ?>

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

                <div class="sidebar-item">
                    <a href="<?php echo e(route('admin.courses')); ?>"
                        class="<?php echo e(request()->routeIs('admin.courses') ? 'active' : ''); ?>">
                        <i class="bi bi-book"></i>
                        <span>Cursos</span>
                    </a>
                    <div class="submenu"
                        style="<?php echo e(request()->routeIs('admin.courses') || request()->routeIs('admin.eti') ? 'display: flex;' : ''); ?>">
                        <a href="<?php echo e(route('admin.courses')); ?>"
                            class="<?php echo e(request()->routeIs('admin.courses') ? 'text-white fw-bold' : ''); ?>">
                            <i class="bi bi-collection me-2"></i> Todos los Cursos
                        </a>
                        <a href="<?php echo e(route('admin.eti')); ?>"
                            class="<?php echo e(request()->routeIs('admin.eti') ? 'text-white fw-bold' : ''); ?>">
                            <i class="bi bi-cpu me-2"></i> ETI
                        </a>
                    </div>
                </div>

                <a href="<?php echo e(route('admin.organizations')); ?>"
                    class="<?php echo e(request()->routeIs('admin.organizations') ? 'active' : ''); ?>">
                    <i class="bi bi-diagram-3"></i>
                    <span>Organizaciones</span>
                </a>

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

                <a href="<?php echo e(route('admin.qualifications')); ?>"
                    class="<?php echo e(request()->routeIs('admin.qualifications') ? 'active' : ''); ?>">
                    <i class="bi bi-award"></i>
                    <span>Calificaciones</span>
                </a>

                
                <?php if(in_array($role, ['administrador', 'docente', 'auxiliar'])): ?>
                    <a href="<?php echo e(route('admin.tools')); ?>"
                        class="<?php echo e(request()->routeIs('admin.tools') ? 'active' : ''); ?>">
                        <i class="bi bi-tools"></i>
                        <span>Herramientas</span>
                    </a>
                <?php endif; ?>

                
                <?php if($role === 'administrador'): ?>
                    <a href="<?php echo e(route('admin.users')); ?>"
                        class="<?php echo e(request()->routeIs('admin.users') ? 'active' : ''); ?>">
                        <i class="bi bi-people"></i>
                        <span>Usuarios / Matrícula</span>
                    </a>
                    
                <?php endif; ?>

                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="logout btn btn-link p-0 m-0"
                        style="display:flex; align-items:center;">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Cerrar sesión</span>
                    </button>
                </form>
            </nav>



        </aside>

        <main class="main-content" id="mainContent">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?>
    <script src="<?php echo e(asset('js/course.js')); ?>"></script>
    <script src="<?php echo e(asset('js/messages.js')); ?>"></script>


</body>

</html>
<?php /**PATH C:\xampp\htdocs\laravel\Proyect_Next_Level\resources\views/layouts/landing.blade.php ENDPATH**/ ?>