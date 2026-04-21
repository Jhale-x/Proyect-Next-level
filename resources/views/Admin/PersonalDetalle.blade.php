@extends('layouts.Adminlanding')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/listados.css') }}">

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-white">Detalle del Personal</h2>
                <p class="text-muted mb-0">Información completa del personal seleccionado.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.users.edit', $user->id_usuario) }}" class="btn btn-info text-white">Editar</a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Volver al listado</a>
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
                        <div class="text-white">{{ $user->dni }}</div>
                    </div>
                    <div class="col-md-4">
                        <span class="text-secondary">Nombre</span>
                        <div class="text-white">{{ $user->nombre }} {{ $user->apellido }}</div>
                    </div>
                    <div class="col-md-4">
                        <span class="text-secondary">Usuario</span>
                        <div class="text-white">{{ $user->usuario }}@NextLevelAcademy.pe</div>
                    </div>
                    <div class="col-md-4">
                        <span class="text-secondary">Rol</span>
                        <div class="text-white">{{ ucfirst($user->rol) }}</div>
                    </div>
                    <div class="col-md-4">
                        <span class="text-secondary">Curso</span>
                        <div class="text-white">{{ optional($user->cursoRelacion)->materia ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <span class="text-secondary">Fecha de nacimiento</span>
                        <div class="text-white">{{ $user->fecha_nacimiento }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
