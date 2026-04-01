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
                <a href="{{ route('alumno.pagina_institucional') }}"
                    class="{{ request()->routeIs('alumno.pagina_institucional') ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i>
                    <span>Pagina Institucional</span>
                </a>

                <a href="{{ route('alumno.activity') }}"
                    class="{{ request()->routeIs('alumno.activity') ? 'active' : '' }}">
                    <i class="bi bi-activity"></i>
                    <span>Actividad</span>
                </a>

                <a href="{{ route('alumno.organizations') }}"
                    class="{{ request()->routeIs('alumno.organizations') ? 'active' : '' }}">
                    <i class="bi bi-diagram-3"></i>
                    <span>Organizaciones</span>
                </a>

                <a href="{{ route('alumno.calendar') }}"
                    class="{{ request()->routeIs('alumno.calendar') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event"></i>
                    <span>Calendario</span>
                </a>

                <a href="{{ route('alumno.messages') }}"
                    class="{{ request()->routeIs('alumno.messages') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i>
                    <span>Mensajes</span>
                </a>

                <a href="{{ route('alumno.qualifications') }}"
                    class="{{ request()->routeIs('alumno.qualifications') ? 'active' : '' }}">
                    <i class="bi bi-award"></i>
                    <span>Calificaciones</span>
                </a>

                <a href="{{ route('alumno.tools') }}"
                    class="{{ request()->routeIs('alumno.tools') ? 'active' : '' }}">
                    <i class="bi bi-tools"></i>
                    <span>Herramientas</span>
                </a>

                <a href="{{ route('alumno.eti') }}" class="{{ request()->routeIs('alumno.eti') ? 'active' : '' }}">
                    <i class="bi bi-cpu"></i>
                    <span>ETI</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="logout btn btn-link p-0 m-0"
                        style="display:flex; align-items:center;">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Cerrar sesión</span>
                    </button>
                </form>
            </nav>



        </aside>

        <main class="main-content" id="mainContent">
            @yield('content')
        </main>
    </div>

    @vite(['resources/js/app.js'])
    <script src="{{ asset('js/course.js') }}"></script>

</body>

</html>
