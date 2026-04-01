<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Next Level')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/course.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<<<<<<< HEAD
    <link rel="stylesheet" href="{{ asset('css/messages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/activity.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminPaginaInstitucional.css')}}">
    @stack('styles')

    <style>
        body {
            background-color: #f5f6fa;
        }

        .admin-topbar {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(16, 24, 40, 0.07);
            margin: 1rem 1rem 0;
            padding: 0.75rem 1rem;
        }

        .admin-topbar .search-box {
            max-width: 380px;
        }

        .admin-topbar .search-box .form-control {
            border-radius: 10px;
            border-color: #e7eaf0;
            padding-left: 2.2rem;
        }

        .admin-topbar .search-icon {
            position: absolute;
            top: 50%;
            left: 0.8rem;
            transform: translateY(-50%);
            color: #8c94a1;
        }

        .admin-topbar .icon-btn {
            width: 40px;
            height: 40px;
            border: 1px solid #e7eaf0;
            border-radius: 10px;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #334155;
            transition: all .2s ease;
        }

        .admin-topbar .icon-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
            color: #0d6efd;
        }

        .admin-user-trigger {
            border: 1px solid #e7eaf0;
            border-radius: 10px;
            padding: 0.35rem 0.6rem;
            background: #fff;
        }
    </style>


=======
    <link rel="stylesheet" href="{{ asset('css/admin/activity.css') }}">
>>>>>>> a7d439919800e4a16f88df4d76cfdfdb85daf643
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

            <nav class="menu">
                <a href="{{ route('admin.pagina_institucional') }}" class="{{ request()->routeIs('admin.pagina_institucional') ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i>
                    <span>Pagina Institucional</span>
                </a>

                <a href="{{ route('admin.activity') }}" class="{{ request()->routeIs('admin.activity') ? 'active' : '' }}">
                    <i class="bi bi-activity"></i>
                    <span>Actividad</span>
                </a>

                <div class="sidebar-item">
                    <a href="{{ route('admin.courses') }}" class="{{ request()->routeIs('admin.courses') || request()->routeIs('admin.eti') ? 'active' : '' }}">
                        <i class="bi bi-book"></i>
                        <span>Cursos</span>
                    </a>
                    <div class="submenu" style="{{ request()->routeIs('admin.courses') || request()->routeIs('admin.eti') ? 'display: flex; flex-direction: column;' : 'display: none;' }}">
                        <a href="{{ route('admin.courses') }}" class="{{ request()->routeIs('admin.courses') ? 'text-white fw-bold' : '' }}">
                            <i class="bi bi-collection me-2"></i> Todos los Cursos
                        </a>
                        <a href="{{ route('admin.eti') }}" class="{{ request()->routeIs('admin.eti') ? 'text-white fw-bold' : '' }}">
                            <i class="bi bi-cpu me-2"></i> ETI
                        </a>
                    </div>
                </div>

                <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Usuarios</span>
                </a>

                <div class="sidebar-item">
                    <a href="javascript:void(0)" class="btn-submenu {{ request()->is('admin/alumnos*') || request()->is('admin/users*') ? 'active' : '' }}" onclick="toggleSubmenu(event, 'listado-items')">
                        <i class="bi bi-people-fill"></i>
                        <span>Listado</span>
                        <i class="bi bi-chevron-down ms-auto arrow-icon" style="font-size: 0.8rem;"></i>
                    </a>
                    
                    <div class="submenu" id="listado-items" style="{{ request()->is('admin/alumnos*') || request()->is('admin/users*') ? 'display: flex; flex-direction: column;' : 'display: none;' }}">
                        <a href="{{ route('admin.alumnos.index') }}" class="{{ request()->routeIs('admin.alumnos.index') ? 'text-white fw-bold' : '' }}">
                            <i class="bi bi-person-workspace me-2"></i> Lista de alumnos
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.index') ? 'text-white fw-bold' : '' }}">
                            <i class="bi bi-person-badge me-2"></i> Lista de personal
                        </a>
                    </div>
                </div>

                <a href="{{ route('admin.organizations') }}" class="{{ request()->routeIs('admin.organizations') ? 'active' : '' }}">
                    <i class="bi bi-diagram-3"></i>
                    <span>Organizaciones</span>
                </a>

                <a href="{{ route('admin.calendar') }}" class="{{ request()->routeIs('admin.calendar') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event"></i>
                    <span>Calendario</span>
                </a>

                <a href="{{ route('admin.messages') }}" class="{{ request()->routeIs('admin.messages') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i>
                    <span>Mensajes</span>
                </a>

                <a href="{{ route('admin.tools') }}" class="{{ request()->routeIs('admin.tools') ? 'active' : '' }}">
                    <i class="bi bi-tools"></i>
                    <span>Herramientas</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->nombre }}+{{ Auth::user()->apellido }}&background=0D6EFD&color=fff"
                                class="rounded-circle" width="34" height="34" alt="Avatar">
                            <div class="text-start d-none d-sm-block">
                                <div class="fw-semibold" style="line-height:1;">{{ Auth::user()->nombre }}
                                    {{ Auth::user()->apellido }}</div>
                                <small class="text-muted text-capitalize">{{ Auth::user()->rol }}</small>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><span
                                    class="dropdown-item-text text-muted text-capitalize">{{ Auth::user()->rol }}</span>
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

            @yield('content')

        </main>
    </div>

<<<<<<< HEAD
    @vite(['resources/js/app.js'])
    <script src="{{ asset('js/course.js') }}"></script>
    @stack('scripts')
=======
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
>>>>>>> a7d439919800e4a16f88df4d76cfdfdb85daf643

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