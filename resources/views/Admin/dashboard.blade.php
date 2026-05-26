@extends('layouts.Adminlanding')

@section('title', 'Dashboard - Admin')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
@endpush
@section('content')
    <div class="container-fluid page-wrap">
        <h1 class="section-title mb-4">Dashboard Administrador</h1>

        <div class="row g-3 mb-4">

            <div class="col">
                <div class="card stats-card bg-primary text-white h-100">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Total Usuarios</small>
                            <h3>{{ $totalUsuarios }}</h3>
                        </div>
                        <i class="bi bi-people stats-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card stats-card bg-info text-white h-100">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Total Alumnos</small>
                            <h3>{{ $alumnos ?? 0 }}</h3>

                            <small>Academia: {{ $academia ?? 0 }}</small>
                            <div class="mini-bar">
                                <div class="mini-fill"
                                    style="width: {{ $alumnos ?? 0 ? (($academia ?? 0) * 100) / $alumnos : 0 }}%">
                                </div>
                            </div>

                            <small>Colegio: {{ $colegio ?? 0 }}</small>
                            <div class="mini-bar">
                                <div class="mini-fill"
                                    style="width: {{ $alumnos ?? 0 ? (($colegio ?? 0) * 100) / $alumnos : 0 }}%">
                                </div>
                            </div>
                        </div>

                        <i class="bi bi-mortarboard stats-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card stats-card bg-dark text-white h-100">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Admins</small>
                            <h3>{{ $admins }}</h3>
                        </div>
                        <i class="bi bi-shield-lock stats-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card stats-card bg-success text-white h-100">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Docentes</small>
                            <h3>{{ $docentes }}</h3>
                        </div>
                        <i class="bi bi-person-workspace stats-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card stats-card bg-warning text-white h-100">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Auxiliares</small>
                            <h3>{{ $auxiliares }}</h3>
                        </div>
                        <i class="bi bi-person-badge stats-icon"></i>
                    </div>
                </div>
            </div>

        </div>
        <div class="card card-soft mb-4">
            <div class="card-header bg-white border-0 fw-semibold d-flex justify-content-between">
                <span>Usuarios Recientes</span>
                <small class="text-muted">{{ count($usuariosRecientes) }} usuarios</small>
            </div>

            <div class="card-body py-2">
                <div class="row g-2">
                    @foreach ($usuariosRecientes as $user)
                        <div class="col-md-4">
                            <div class="user-mini-card d-flex align-items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nombre) }}&background=4F46E5&color=fff"
                                    class="avatar-mini">

                                <div>
                                    <div class="fw-semibold small">{{ $user->nombre }}</div>
                                    <small class="text-muted">{{ $user->rol }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row g-4">

            {{-- ACTIVIDAD RECIENTE --}}
            <div class="col-lg-8">
                <div class="card h-100">
                    <div class="card-header">
                        Actividad Reciente
                    </div>

                    <div class="card-body">

                        @forelse ($actividadReciente as $actividad)
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <div>
                                    <strong>{{ $actividad['titulo'] }}</strong>
                                    <div class="text-muted small">
                                        {{ $actividad['descripcion'] }}
                                    </div>
                                </div>

                                <small class="text-muted">{{ $actividad['creado'] }}</small>
                            </div>
                        @empty
                            <div class="text-muted small">No hay actividad reciente registrada.</div>
                        @endforelse

                    </div>
                </div>
            </div>

            {{-- RESUMEN --}}
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header">
                        Resumen General
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <small class="text-muted">Usuarios activos (últimos 30 días)</small>
                            <h4>{{ $usuariosActivosPercent ?? 0 }}%</h4>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Cursos activos</small>
                            <h4>{{ $cursosActivos ?? 0 }}</h4>
                        </div>

                        <div>
                            <small class="text-muted">Mensajes enviados</small>
                            <h4>{{ $mensajes ?? 0 }}</h4>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row mt-4">

                <div class="col-12">

                    <div class="card chart-card">

                        <div class="card-header d-flex justify-content-between align-items-center">

                            <span class="chart-title">
                                Estadísticas Generales
                            </span>

                            <div class="d-flex gap-2">

                                <span class="badge bg-primary">
                                    Usuarios
                                </span>

                                <span class="badge bg-danger">
                                    Sistema
                                </span>

                            </div>

                        </div>

                        <div class="card-body">

                            <div class="chart-container">
                                <canvas id="estadisticasChart"></canvas>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const alumnosCount = {{ $alumnos ?? 0 }};
            const docentesCount = {{ $docentes ?? 0 }};
            const adminsCount = {{ $admins ?? 0 }};
            const auxiliaresCount = {{ $auxiliares ?? 0 }};
            const cursosCount = {{ $cursos ?? 0 }};
        </script>
    @endsection
