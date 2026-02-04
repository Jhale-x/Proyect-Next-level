@extends('layouts.app')

@section('title', 'Organizaciones')

@section('content')

<div class="container-fluid">
    <h2 class="mb-4">
        <i class="bi bi-diagram-3"></i> Organizaciones del colegio
    </h2>

    <div class="list-group">
        <div class="list-group-item">
            <h5 class="mb-1">Consejo estudiantil</h5>
            <p class="mb-1">Representación de los estudiantes</p>
        </div>

        <div class="list-group-item">
            <h5 class="mb-1">Club de ciencias</h5>
            <p class="mb-1">Proyectos científicos y ferias</p>
        </div>

        <div class="list-group-item">
            <h5 class="mb-1">Equipo deportivo</h5>
            <p class="mb-1">Fútbol, vóley y atletismo</p>
        </div>
    </div>
</div>

@endsection
