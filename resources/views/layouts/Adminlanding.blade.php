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
    <link rel="stylesheet" href="{{ asset('css/admin/activity.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/listados.css') }}">
</head>
<body>
    <div class="mobile-header">
        <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('images/next-level-logo.png') }}" alt="Logo" style="width: 30px;">
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
                <img src="{{ asset('images/next-level-logo.png') }}" alt="Next Level" class="logo-img">
                <span>Next Level</span>
            </div>

            <nav class="menu">
                <a href="{{ route('admin.pagina_institucional') }}" class="{{ request()->routeIs('admin.pagina_institucional') ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i>
                    <span>Página Institucional</span>
                </a>

                <a href="{{ route('admin.activity') }}" class="{{ request()->routeIs('admin.activity') ? 'active' : '' }}">
                    <i class="bi bi-activity"></i>
                    <span>Actividad</span>
                </a>

                <div class="sidebar-item">
                    <a href="javascript:void(0)" class="btn-submenu" onclick="toggleSubmenu(event, 'cursos-items')">
                        <i class="bi bi-book"></i>
                        <span>Cursos</span>
                        <i class="bi bi-chevron-down ms-auto arrow-icon"></i>
                    </a>
                    <div class="submenu" id="cursos-items" style="display: none;">
                        <a href="{{ route('admin.courses') }}">
                            <i class="bi bi-collection me-2"></i> Todos los Cursos
                        </a>
                        <a href="{{ route('admin.eti') }}">
                            <i class="bi bi-cpu me-2"></i> ETI
                        </a>
                    </div>
                </div>

                <div class="sidebar-item">
                    <a href="javascript:void(0)" class="btn-submenu" onclick="toggleSubmenu(event, 'registro-items')">
                        <i class="bi bi-person-plus"></i>
                        <span>Registrar</span>
                        <i class="bi bi-chevron-down ms-auto arrow-icon"></i>
                    </a>
                    <div class="submenu" id="registro-items" style="display: none;">
                        <a href="{{ route('admin.registro.alumno') }}">
                            <i class="bi bi-person-workspace me-2"></i> Registrar Alumno
                        </a>
                        <a href="{{ route('admin.users') }}">
                            <i class="bi bi-person-badge me-2"></i> Registrar Personal
                        </a>
                    </div>
                </div>

                <div class="sidebar-item">
                    <a href="javascript:void(0)" class="btn-submenu" onclick="toggleSubmenu(event, 'listado-items')">
                        <i class="bi bi-list-check"></i>
                        <span>Listados</span>
                        <i class="bi bi-chevron-down ms-auto arrow-icon"></i>
                    </a>
                    <div class="submenu" id="listado-items" style="display: none;">
                        <a href="{{ route('admin.listado.alumnos') }}">
                            <i class="bi bi-person-workspace me-2"></i> Lista de Alumnos
                        </a>
                        <a href="{{ route('admin.listado.personal') }}">
                            <i class="bi bi-person-badge me-2"></i> Lista de Personal
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

                <a href="{{ route('admin.support') }}" class="{{ request()->routeIs('admin.support') ? 'active' : '' }}">
                    <i class="bi bi-headset"></i>
                    <span>Soporte</span>
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
            @yield('content')
        </main>
    </div>

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

    // Cerrar sidebar al hacer clic en un enlace en móvil
    document.querySelectorAll('.sidebar a').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 768) {
                toggleSidebar();
            }
        });
    });
    </script>
</body>
</html>