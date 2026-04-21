@extends('layouts.Adminlanding')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/listados.css') }}">

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-white">Editar Personal</h2>
                <p class="text-muted mb-0">Actualiza los datos del personal.</p>
            </div>
            <a href="{{ route('admin.users.show', $user->id_usuario) }}" class="btn btn-secondary">Cancelar</a>
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

        <form action="{{ route('admin.users.update', $user->id_usuario) }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-4">
                <label class="form-label text-white">DNI</label>
                <input type="text" name="dni" value="{{ old('dni', $user->dni) }}" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label text-white">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $user->nombre) }}" class="form-control"
                    required>
            </div>

            <div class="col-md-4">
                <label class="form-label text-white">Apellido</label>
                <input type="text" name="apellido" value="{{ old('apellido', $user->apellido) }}" class="form-control"
                    required>
            </div>

            <div class="col-md-4">
                <label class="form-label text-white">Usuario</label>
                <input type="text" name="usuario" value="{{ old('usuario', $user->usuario) }}" class="form-control"
                    required>
            </div>

            <div class="col-md-4">
                <label class="form-label text-white">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $user->fecha_nacimiento) }}"
                    class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label text-white">Contraseña nueva <small class="text-muted">(opcional)</small></label>
                <input type="password" name="contrasena" class="form-control"
                    placeholder="Dejar vacío para mantener la actual">
            </div>

            <div class="col-md-4">
                <label class="form-label text-white">Rol</label>
                <select name="rol" class="form-select" required>
                    <option value="administrador" {{ old('rol', $user->rol) == 'administrador' ? 'selected' : '' }}>
                        Administrador</option>
                    <option value="docente" {{ old('rol', $user->rol) == 'docente' ? 'selected' : '' }}>Docente</option>
                    <option value="auxiliar" {{ old('rol', $user->rol) == 'auxiliar' ? 'selected' : '' }}>Auxiliar</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label text-white">Curso</label>
                <select name="id_curso" class="form-select">
                    <option value="">Selecciona un curso</option>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id_curso }}"
                            {{ old('id_curso', $user->id_curso) == $curso->id_curso ? 'selected' : '' }}>
                            {{ $curso->materia }}
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
