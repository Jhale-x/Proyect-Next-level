@extends('layouts.Adminlanding')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/listados.css') }}">

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-white">Detalle del Alumno</h2>
                <p class="text-muted mb-0">Información completa del alumno seleccionado.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.alumnos.edit', $alumno->id_alumno) }}" class="btn btn-info text-white">Editar</a>
                <a href="{{ route('admin.alumnos.index') }}" class="btn btn-secondary">Volver al listado</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card bg-dark border-0 shadow-sm">
            <div class="card-body">
                <div class="row gy-3">
                    <div class="col-md-4">
                        <span class="text-secondary">DNI</span>
                        <div class="text-white">{{ $alumno->dni }}</div>
                    </div>
                    <div class="col-md-4">
                        <span class="text-secondary">Alumno</span>
                        <div class="text-white">{{ $alumno->nombre }} {{ $alumno->apellido }}</div>
                    </div>
                    <div class="col-md-4">
                        <span class="text-secondary">Usuario</span>
                        <div class="text-white">{{ $alumno->usuario }}</div>
                    </div>
                    <div class="col-md-4">
                        <span class="text-secondary">Nivel</span>
                        <div class="text-white">{{ optional($alumno->salon->nivel)->nivel ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <span class="text-secondary">Grado</span>
                        <div class="text-white">{{ optional($alumno->salon->grado)->grado ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <span class="text-secondary">Sección</span>
                        <div class="text-white">{{ optional($alumno->salon->seccion)->seccion ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <span class="text-secondary">Fecha de nacimiento</span>
                        <div class="text-white">{{ $alumno->fecha_nacimiento }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
