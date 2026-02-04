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
            background-color: #0a1f44;
            color: #fff;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .sidebar .logo {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 12px;
            padding: 20px  20px 20px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .sidebar .logo img {
            height: 70px;
            width: auto;
            object-fit: contain;
        }

        .sidebar .logo-text {
            font-size: 1.4rem;
            font-weight: bold;
        }

        .sidebar .menu {
            flex: 1;
        }

        .sidebar a {
            color: rgba(255,255,255,0.75);
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
            border-left: 4px solid #dc3545;
        }

        .logout {
            border-top: 1px solid rgba(255,255,255,0.15);
            color: #fff;
        }

        .logout:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .main-content {
            flex-grow: 1;
            padding: 32px;
        }
    </style>
</head>
<body>

<div class="d-flex min-vh-100">

    <!-- Sidebar -->
    <aside class="sidebar">
    <div class="logo">
        <img src="{{ asset('img/Logo/next-level-logo.png') }}" alt="Next Level Logo">
        <span class="logo-text">Next Level</span>
    </div>

        <nav class="menu">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i>
                <span>Página de la institución</span>
            </a>

            <a href="{{ url('Activity') }}" class="{{ request()->is('Activity') ? 'active' : '' }}">
                <i class="bi bi-activity"></i>
                <span>Actividad</span>
            </a>

            <a href="{{ url('cursos') }}" class="{{ request()->is('cursos') ? 'active' : '' }}">
                <i class="bi bi-book"></i>
                <span>Cursos</span>
            </a>

            <a href="{{ url('organizaciones') }}" class="{{ request()->is('organizaciones') ? 'active' : '' }}">
                <i class="bi bi-diagram-3"></i>
                <span>Organizaciones</span>
            </a>

            <a href="{{ url('calendario') }}" class="{{ request()->is('calendario') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i>
                <span>Calendario</span>
            </a>

            <a href="{{ url('mensajes') }}" class="{{ request()->is('mensajes') ? 'active' : '' }}">
                <i class="bi bi-envelope"></i>
                <span>Mensajes</span>
            </a>

            <a href="{{ url('calificaciones') }}" class="{{ request()->is('calificaciones') ? 'active' : '' }}">
                <i class="bi bi-award"></i>
                <span>Calificaciones</span>
            </a>

            <a href="{{ url('herramientas') }}" class="{{ request()->is('herramientas') ? 'active' : '' }}">
                <i class="bi bi-tools"></i>
                <span>Herramientas</span>
            </a>
        </nav>

        <a href="{{ url('logout') }}" class="logout d-flex align-items-center gap-2 px-3 py-2">
            <i class="bi bi-box-arrow-right"></i>
            <span>Cerrar sesión</span>
        </a>
    </aside>

    <!-- Main content -->
    <main class="main-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>

</div>

@stack('scripts')
<!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
