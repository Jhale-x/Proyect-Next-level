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

            @php
                $role = auth()->check() ? strtolower(auth()->user()->rol) : '';
            @endphp

            <nav class="menu">
                {{-- common items for all authenticated users --}}
                <a href="{{ route('admin.pagina_institucional') }}"
                    class="{{ request()->routeIs('admin.pagina_institucional') ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i>
                    <span>Pagina Institucional</span>
                </a>

                <a href="{{ route('admin.activity') }}"
                    class="{{ request()->routeIs('admin.activity') ? 'active' : '' }}">
                    <i class="bi bi-activity"></i>
                    <span>Actividad</span>
                </a>

                <div class="sidebar-item">
                    <a href="{{ route('admin.courses') }}"
                        class="{{ request()->routeIs('admin.courses') ? 'active' : '' }}">
                        <i class="bi bi-book"></i>
                        <span>Cursos</span>
                    </a>
                    <div class="submenu"
                        style="{{ request()->routeIs('admin.courses') || request()->routeIs('admin.eti') ? 'display: flex;' : '' }}">
                        <a href="{{ route('admin.courses') }}"
                            class="{{ request()->routeIs('admin.courses') ? 'text-white fw-bold' : '' }}">
                            <i class="bi bi-collection me-2"></i> Todos los Cursos
                        </a>
                        <a href="{{ route('admin.eti') }}"
                            class="{{ request()->routeIs('admin.eti') ? 'text-white fw-bold' : '' }}">
                            <i class="bi bi-cpu me-2"></i> ETI
                        </a>
                    </div>
                </div>

                <a href="{{ route('admin.organizations') }}"
                    class="{{ request()->routeIs('admin.organizations') ? 'active' : '' }}">
                    <i class="bi bi-diagram-3"></i>
                    <span>Organizaciones</span>
                </a>

                <a href="{{ route('admin.calendar') }}"
                    class="{{ request()->routeIs('admin.calendar') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event"></i>
                    <span>Calendario</span>
                </a>

                <a href="{{ route('admin.messages') }}"
                    class="{{ request()->routeIs('admin.messages') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i>
                    <span>Mensajes</span>
                </a>

                <a href="{{ route('admin.qualifications') }}"
                    class="{{ request()->routeIs('admin.qualifications') ? 'active' : '' }}">
                    <i class="bi bi-award"></i>
                    <span>Calificaciones</span>
                </a>

                {{-- tools available to admin/docente/auxiliar --}}
                @if (in_array($role, ['administrador', 'docente', 'auxiliar']))
                    <a href="{{ route('admin.tools') }}"
                        class="{{ request()->routeIs('admin.tools') ? 'active' : '' }}">
                        <i class="bi bi-tools"></i>
                        <span>Herramientas</span>
                    </a>
                @endif

                {{-- admin only sections --}}
                @if ($role === 'administrador')
                    <a href="{{ route('admin.users') }}"
                        class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Usuarios / Matrícula</span>
                    </a>
                    {{-- the users page contains both the registration forms and (future) listing --}}
                @endif

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

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/course.js') }}"></script>

</body>

</html>
