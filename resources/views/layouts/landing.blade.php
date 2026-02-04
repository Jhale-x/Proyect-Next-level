<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Next Level')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Iconos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    @stack('styles')

    <style>
        body {
            background-color: #f4f6f9;
            margin: 0;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: #460000;
            color: #fff;
            display: flex;
            flex-direction: column;
        }

        .sidebar .logo {
            font-size: 1.4rem;
            font-weight: bold;
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            text-align: center;
        }

        .sidebar .menu {
            flex: 1;
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.75); /*Color de la letra */
            text-decoration: none;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid transparent;
            transition: all 0.2s ease;
        }

        .sidebar a:hover {
            background-color: rgba(255,255,255,0.08);
            color: #fff;
        }

        .sidebar a.active {
            background-color: rgba(255,255,255,0.12);
            color: #fff;
            border-left: 4px solid #3538dc;
        }

        .logout {
            border-top: 1px solid rgba(255,255,255,0.15);
            color: #fff;
        }

        .logout:hover {
            background-color: #0b2864;
            color: #fff;
        }

        .main-content {
            padding: 20px;
            width: 100%;
            background-color: #b9b9b9;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">Next Level</div>

        <div class="menu">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i>
                <span>Página de la institución</span>
            </a>

            <a href="{{ url('/activity') }}" class="{{ request()->is('actividad') ? 'active' : '' }}">
                <i class="bi bi-activity"></i>
                <span>Actividad</span>
            </a>

            <a href="{{ url('/course') }}" class="{{ request()->is('cursos') ? 'active' : '' }}">
                <i class="bi bi-book"></i>
                <span>Cursos</span>
            </a>

            <a href="{{ url('/organizations') }}" class="{{ request()->is('organizaciones') ? 'active' : '' }}">
                <i class="bi bi-diagram-3"></i>
                <span>Organizaciones</span>
            </a>

            <a href="{{ url('/calendar') }}" class="{{ request()->is('calendario') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i>
                <span>Calendario</span>
            </a>

            <a href="{{ url('/messages') }}" class="{{ request()->is('mensajes') ? 'active' : '' }}">
                <i class="bi bi-envelope"></i>
                <span>Mensajes</span>
            </a>

            <a href="{{ url('/qualifications') }}" class="{{ request()->is('calificaciones') ? 'active' : '' }}">
                <i class="bi bi-award"></i>
                <span>Calificaciones</span>
            </a>

            <a href="{{ url('/tools') }}" class="{{ request()->is('herramientas') ? 'active' : '' }}">
                <i class="bi bi-tools"></i>
                <span>Herramientas</span>
            </a>
        </div>

        <a href="{{ url('/logout') }}" class="logout">
            <i class="bi bi-box-arrow-right"></i>
            <span>Cerrar sesión</span>
        </a>
    </div>

    <!-- Main content -->
    <div class="main-content">
        @yield('content')
    </div>
</div>

@stack('scripts')
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
