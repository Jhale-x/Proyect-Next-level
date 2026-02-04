@extends('layouts.app')

@section('title', 'Calendario')

@section('content')

<div class="container-fluid">
    <h2 class="mb-4">
        <i class="bi bi-calendar-event"></i> Calendario académico
    </h2>

    <!-- Próximos eventos -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-clock"></i> Próximos eventos
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Evento</th>
                        <th>Curso</th>
                        <th>Responsable</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>18/03/2026</td>
                        <td>Examen parcial</td>
                        <td>Matemática</td>
                        <td>Prof. Gómez</td>
                    </tr>
                    <tr>
                        <td>22/03/2026</td>
                        <td>Entrega de proyecto</td>
                        <td>Ciencias</td>
                        <td>Prof. Ramírez</td>
                    </tr>
                    <tr>
                        <td>25/03/2026</td>
                        <td>Reunión de padres</td>
                        <td>General</td>
                        <td>Dirección</td>
                    </tr>
                    <tr>
                        <td>30/03/2026</td>
                        <td>Acto cívico</td>
                        <td>Todos</td>
                        <td>Coordinación</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recordatorios -->
    <div class="card mb-4">
        <div class="card-header bg-warning text-dark">
            <i class="bi bi-bell"></i> Recordatorios importantes
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    📌 Cierre de notas del primer parcial: <strong>20 de marzo</strong>
                </li>
                <li class="list-group-item">
                    📌 Inscripción a talleres extracurriculares hasta el <strong>27 de marzo</strong>
                </li>
                <li class="list-group-item">
                    📌 Entrega de boletines: <strong>29 de marzo</strong>
                </li>
            </ul>
        </div>
    </div>

    <!-- Calendario visual (placeholder) -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-calendar3"></i> Vista mensual
        </div>
        <div class="card-body text-center">
            <p class="text-muted mb-3">
                Aquí se mostrará el calendario mensual interactivo.
            </p>
            <div class="alert alert-info">
                🔧 Próximamente: calendario interactivo con eventos por día
            </div>
        </div>
    </div>

</div>

@endsection
