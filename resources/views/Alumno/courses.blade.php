@extends('layouts.Alumnoslanding')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/alumno/cursos.css') }}">
@endpush

@section('title', 'Mis Cursos - Next Level')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h2>Mis Cursos</h2>
                <p>Estos son los cursos asignados para el año académico {{ date('Y') }}</p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        @forelse($cursos as $curso)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="course-card">
                    <div class="course-icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <div class="course-info">
                        <h4>{{ $curso->nombre ?? $curso->materia ?? 'Curso sin nombre' }}</h4>
                        <p>Docente: {{ $curso->docente ?? 'No asignado' }}</p>
                    </div>
                    <a href="{{ route('alumno.courses.show', $curso->id_curso ?? $curso->id) }}" class="btn-course">Ver Curso</a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No tienes cursos asignados aún.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection