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
    <link rel="stylesheet" href="{{ asset('css/docente/PaginaInstitucionalDocente.css') }}">
    @stack('styles')

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
                <a href="{{ route('docente.pagina_institucional') }}" class="{{ request()->routeIs('docente.pagina_institucional') ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i> <span>Página Institucional</span>
                </a>
                <a href="{{ route('docente.activity') }}" class="{{ request()->routeIs('docente.activity') ? 'active' : '' }}">
                    <i class="bi bi-activity"></i> <span>Actividad</span>
                </a>
                <a href="{{ route('docente.calendar') }}" class="{{ request()->routeIs('docente.calendar') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event"></i> <span>Calendario</span>
                </a>
                <a href="{{ route('docente.messages') }}" class="{{ request()->routeIs('docente.messages') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i> <span>Mensajes</span>
                </a>
                <a href="{{ route('docente.qualifications') }}" class="{{ request()->routeIs('docente.qualifications') ? 'active' : '' }}">
                    <i class="bi bi-award"></i> <span>Calificaciones</span>
                </a>
                <a href="{{ route('docente.tools') }}" class="{{ request()->routeIs('docente.tools') ? 'active' : '' }}">
                    <i class="bi bi-tools"></i> <span>Herramientas</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </nav>
        </aside>
        <main class="main-content" id="mainContent">
            @yield('content')
        </main>
    </div>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
</body>
</html>
