@extends('layouts.Alumnoslanding')

@section('title', 'Mis Cursos')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/alumno/cursos.css') }}">
@endpush

@section('content')

    <div class="container py-4">

        <h3 class="fw-bold mb-4">
            📚 Mis Cursos
        </h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- CURSOS -->
        <div id="vista-cursos">

            <div class="row g-4">

                @forelse($cursos as $curso)
                    <div class="col-md-4 col-lg-3">

                        <div class="course-card" onclick='abrirCurso({{ $curso->id_curso }}, @json($curso->materia))'>

                            <div class="course-bar"></div>

                            <div class="course-content">

                                <h5 class="course-title">
                                    {{ $curso->materia }}
                                </h5>

                                <p class="course-subtitle">
                                    Ver actividades y notas
                                </p>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="empty-state">

                            <div class="empty-icon">
                                📚
                            </div>

                            <h4>No tienes cursos asignados</h4>

                            <p>Cuando tus docentes asignen cursos aparecerán aquí.</p>

                        </div>

                    </div>
                @endforelse

            </div>

        </div>

        <!-- DETALLE CURSO -->
        <div id="vista-detalle" class="d-none">

            <button class="btn-back mb-3" onclick="volverCursos()">
                ← Volver a cursos
            </button>

            <div class="course-header-banner">

                <h2 id="titulo-curso"></h2>

                <p class="mb-0">
                    Actividades registradas y calificaciones
                </p>

            </div>

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table align-middle">

                            <thead>
                                <tr>
                                    <th>Actividad</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Nota</th>
                                </tr>
                            </thead>

                            <tbody id="tabla-actividades">

                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Selecciona un curso
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                    <div class="promedio-box">

                        <span>Promedio General:</span>

                        <span id="promedio-general">
                            -
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
@push('scripts')
    <script src="{{ asset('js/alumno/cursos.js') }}"></script>
@endpush