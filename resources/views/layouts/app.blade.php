<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Next Level')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            margin: 0;
            overflow-x: hidden;
        }

        /* --- ANIMACIÓN DEL LOGO --- */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .logo-img, .logo-mobile-spin {
            animation: spin 10s linear infinite; /* Movimiento suave y constante */
        }

        /* SIDEBAR BASE */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: #0a1f44;
            color: #fff;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1100;
            transition: all 0.3s ease;
        }

        /* CONFIGURACIÓN RESPONSIVE */
        @media (max-width: 992px) {
            .sidebar { left: -260px; }
            .sidebar.active { left: 0; }
            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                padding-top: 70px !important;
            }
            .mobile-header { display: flex !important; }
        }

        .mobile-header {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background-color: #0a1f44;
            color: white;
            align-items: center;
            padding: 0 20px;
            z-index: 1000;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1050;
        }
        .sidebar-overlay.active { display: block; }

        .sidebar .logo {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.4rem;
            font-weight: bold;
        }

        .logo-img { width: 36px; height: 36px; object-fit: contain; }

        .sidebar .menu { flex: 1; overflow-y: auto; }

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

        .logout { border-top: 1px solid rgba(255,255,255,0.15); }
        .logout:hover { background-color: #dc3545; color: #fff; }

        .main-content {
            margin-left: 260px;
            padding: 20px;
            width: calc(100% - 260px);
            transition: all 0.3s ease;
        }

        /* SUBMENU STYLES */
        .sidebar-item { position: relative; }
        .sidebar-link { cursor: pointer; }
        .submenu { 
            display: none; 
            flex-direction: column; 
            background-color: #081a36; 
        }
        .submenu a { 
            padding: 10px 20px 10px 45px; 
            font-size: 0.9rem; 
            color: rgba(255,255,255,0.7); 
            border-left: none !important;
        }
        .sidebar-item:hover .submenu { display: flex; }
        
        /* Estilos originales preservados */
        .timeline { position: relative; margin-left: 20px; }
        .timeline::before { content: ''; position: absolute; left: 15px; top: 0; bottom: 0; width: 2px; background: #dee2e6; }
        .timeline-date { margin-left: 40px; margin-bottom: 15px; font-size: 1.1rem; }
        .timeline-item { display: flex; margin-bottom: 30px; position: relative; }
        .timeline-icon { width: 32px; height: 32px; border-radius: 50%; color: #fff; display: flex; align-items: center; justify-content: center; margin-right: 20px; z-index: 1; }
        .timeline-content { background: #fff; padding: 15px; border-radius: 6px; box-shadow: 0 0 10px rgba(0,0,0,0.05); width: 100%; }
    </style>
</head>
<body>

    <div class="mobile-header">
        <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('img/next-level-logo.png') }}" alt="Logo" style="width: 30px;" class="logo-mobile-spin">
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
                <img src="{{ asset('img/next-level-logo.png') }}" alt="Next Level" class="logo-img">
                <span>Next Level</span>
            </div>

            <nav class="menu">
                <a href="{{ route('institucion') }}" class="{{ request()->routeIs('institucion') ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i>
                    <span>Página de la institución</span>
                </a>

                <a href="{{ route('actividad') }}" class="{{ request()->routeIs('actividad') ? 'active' : '' }}">
                    <i class="bi bi-activity"></i>
                    <span>Actividad</span>
                </a>

                <div class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('cursos') || request()->routeIs('eti') ? 'active' : '' }}">
                        <i class="bi bi-book"></i>
                        <span>Cursos</span>
                        <i class="bi bi-chevron-right ms-auto"></i>
                    </a>
                    <div class="submenu" style="{{ request()->routeIs('cursos') || request()->routeIs('eti') ? 'display: flex;' : '' }}">
                        <a href="{{ route('cursos') }}" class="{{ request()->routeIs('cursos') ? 'text-white fw-bold' : '' }}">
                            <i class="bi bi-collection me-2"></i> Todos los Cursos
                        </a>
                        <a href="{{ route('eti') }}" class="{{ request()->routeIs('eti') ? 'text-white fw-bold' : '' }}">
                            <i class="bi bi-cpu me-2"></i> ETI
                        </a>
                    </div>
                </div>

                <a href="{{ route('organizaciones') }}" class="{{ request()->routeIs('organizaciones') ? 'active' : '' }}">
                    <i class="bi bi-diagram-3"></i>
                    <span>Organizaciones</span>
                </a>

                <a href="{{ route('calendario') }}" class="{{ request()->routeIs('calendario') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event"></i>
                    <span>Calendario</span>
                </a>

                <a href="{{ route('mensajes') }}" class="{{ request()->routeIs('mensajes') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i>
                    <span>Mensajes</span>
                </a>

                <a href="{{ route('calificaciones') }}" class="{{ request()->routeIs('calificaciones') ? 'active' : '' }}">
                    <i class="bi bi-award"></i>
                    <span>Calificaciones</span>
                </a>

                <a href="{{ url('asistencia') }}" class="{{ request()->is('asistencia') ? 'active' : '' }}">
                    <i class="bi bi-check2-square"></i>
                    <span>Asistencia</span>
                </a>

                <a href="{{ url('asistenciaP') }}" class="{{ request()->is('asistenciaP') ? 'active' : '' }}">
                    <i class="bi bi-list-check"></i>
                    <span>Asistencia Profesores</span>
                </a>

                <a href="{{ route('herramientas') }}" class="{{ request()->routeIs('herramientas') ? 'active' : '' }}">
                    <i class="bi bi-tools"></i>
                    <span>Herramientas</span>
                </a>

                <div class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('usuario') || request()->routeIs('listado') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Matrícula</span>
                        <i class="bi bi-chevron-right ms-auto"></i>
                    </a>
                    <div class="submenu" style="{{ request()->routeIs('usuario') || request()->routeIs('listado') ? 'display: flex;' : '' }}">
                        <a href="{{ route('usuario') }}"><i class="bi bi-person-plus me-2"></i> Registro</a>
                        <a href="{{ route('listado') }}"><i class="bi bi-list-ul me-2"></i> Listado</a>
                    </div>
                </div>
            </nav>

            <a href="{{ route('logout') }}" class="logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Cerrar sesión</span>
            </a>
        </aside>

        <main class="main-content" id="mainContent">
            @yield('content')
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
</body>
</html>