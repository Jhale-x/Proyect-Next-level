@extends('layouts.Alumnoslanding')

@section('title', $curso->nombre . ' - Next Level')

@section('content')
<div class="container-fluid">
    <div class="course-header">
        <h2>{{ $curso->nombre }}</h2>
        <p>Docente: {{ $curso->docente ?? 'No asignado' }}</p>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="content-card">
                <h3>Contenido del Curso</h3>
                <p>Bienvenido al curso de {{ $curso->nombre }}.</p>
            </div>
        </div>
    </div>
</div>
@endsection