@extends('layouts.Adminlanding')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/listados.css') }}">

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-white">Editar Alumno</h2>
                <p class="text-muted mb-0">Modifica los datos del alumno y actualiza el salón.</p>
            </div>
            <a href="{{ route('admin.alumnos.show', $alumno->id_alumno) }}" class="btn btn-secondary">Cancelar</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.alumnos.update', $alumno->id_alumno) }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-4">
                <label class="form-label text-white">DNI</label>
                <input type="text" name="dni" value="{{ old('dni', $alumno->dni) }}" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label text-white">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $alumno->nombre) }}" class="form-control"
                    required>
            </div>

            <div class="col-md-4">
                <label class="form-label text-white">Apellido</label>
                <input type="text" name="apellido" value="{{ old('apellido', $alumno->apellido) }}" class="form-control"
                    required>
            </div>

            <div class="col-md-4">
                <label class="form-label text-white">Usuario</label>
                <input type="text" name="usuario" value="{{ old('usuario', $alumno->usuario) }}" class="form-control"
                    required>
            </div>

            <div class="col-md-4">
                <label class="form-label text-white">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento"
                    value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento) }}" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label text-white">Contraseña nueva <small class="text-muted">(opcional)</small></label>
                <input type="password" name="contraseña" class="form-control"
                    placeholder="Dejar vacío para mantener la actual">
            </div>

            <div class="col-md-4">
                <label class="form-label text-white">Nivel</label>
                <select name="id_nivel" class="form-select" required>
                    <option value="">Selecciona un nivel</option>
                    @foreach ($niveles as $nivel)
                        <option value="{{ $nivel->id_nivel }}"
                            {{ old('id_nivel', optional($alumno->salon)->id_nivel) == $nivel->id_nivel ? 'selected' : '' }}>
                            {{ $nivel->nivel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label text-white">Grado</label>
                <select name="id_grado" class="form-select">
                    <option value="">Selecciona un grado</option>
                    @foreach ($grados as $grado)
                        <option value="{{ $grado->id_grado }}"
                            {{ old('id_grado', optional($alumno->salon)->id_grado) == $grado->id_grado ? 'selected' : '' }}>
                            {{ $grado->grado }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label text-white">Sección</label>
                <select name="id_seccion" class="form-select">
                    <option value="">Selecciona una sección</option>
                    @foreach ($secciones as $seccion)
                        <option value="{{ $seccion->id_seccion }}"
                            {{ old('id_seccion', optional($alumno->salon)->id_seccion) == $seccion->id_seccion ? 'selected' : '' }}>
                            {{ $seccion->seccion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </div>
@endsection
