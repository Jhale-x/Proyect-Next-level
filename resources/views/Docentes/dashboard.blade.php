@extends('layouts.Docentelanding')

@section('title', 'Dashboard - Docente')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h1 class="h3 mb-1">Dashboard Docente</h1>
                <p class="text-muted mb-0">Bienvenido, {{ Auth::user()->nombre }}. Aquí está el estado de tus cursos y actividades.</p>
            </div>
            <div class="text-md-end">
                <a href="{{ route('docente.qualifications') }}" class="btn btn-outline-primary me-2">Calificaciones</a>
                <a href="{{ route('docente.activity') }}" class="btn btn-primary">Actividades</a>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-6 col-xl-3">
                <div class="card stats-card bg-primary text-white h-100">
                    <div class="card-body">
                        <small class="text-uppercase">Cursos asignados</small>
                        <h3 class="mt-3">{{ $cantidadCursos }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="card stats-card bg-success text-white h-100">
                    <div class="card-body">
                        <small class="text-uppercase">Salones</small>
                        <h3 class="mt-3">{{ $cantidadSalones }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="card stats-card bg-warning text-white h-100">
                    <div class="card-body">
                        <small class="text-uppercase">Alumnos</small>
                        <h3 class="mt-3">{{ $cantidadAlumnos }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="card stats-card bg-info text-white h-100">
                    <div class="card-body">
                        <small class="text-uppercase">Actividades</small>
                        <h3 class="mt-3">{{ $cantidadActividades }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Últimas actividades</span>
                        <small class="text-muted">Actualizado</small>
                    </div>
                    <div class="card-body">
                        @if ($ultimasActividades->isEmpty())
                            <div class="text-muted text-center py-4">No hay actividades recientes.</div>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach ($ultimasActividades as $actividad)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <strong>{{ $actividad->actividad }}</strong>
                                                <div class="text-muted small">Curso: {{ $actividad->materia }}</div>
                                            </div>
                                            <div class="text-end">
                                                <span class="badge bg-secondary">{{ \\Carbon\\Carbon::parse($actividad->fecha_entrega)->format('d/m') }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Cursos asignados</span>
                        <span class="badge bg-primary">{{ $cantidadCursos }}</span>
                    </div>
                    <div class="card-body">
                        @if ($cursosAsignados->isEmpty())
                            <div class="text-muted text-center py-4">No hay cursos asignados.</div>
                        @else
                            <div class="list-group">
                                @foreach ($cursosAsignados as $curso)
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $curso->materia }}</strong>
                                                <div class="small text-muted">ID {{ $curso->id_curso }}</div>
                                            </div>
                                            <i class="bi bi-chevron-right"></i>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
