@extends('layouts.Adminlanding')

@section('content')
    <div class="container-fluid py-4" style="background-color: #1a1d21; min-height: 100vh;">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white" style="font-weight: 300;">Gestión de Personal</h2>
        </div>

        <form action="{{ route('admin.users.index') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o DNI..."
                    value="{{ request('search') }}"
                    style="background-color: #fff; border: none; border-radius: 5px; padding: 10px;">
            </div>

            <div class="col-md-3">
                <select name="rol" class="form-select"
                    style="background-color: #fff; border: none; border-radius: 5px; padding: 10px;">
                    <option value="">Todos los cargos</option>
                    <option value="administrador" {{ request('rol') == 'administrador' ? 'selected' : '' }}>Administrador
                    </option>
                    <option value="docente" {{ request('rol') == 'docente' ? 'selected' : '' }}>Docente</option>
                    <option value="auxiliar" {{ request('rol') == 'auxiliar' ? 'selected' : '' }}>Auxiliar</option>
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"
                    style="background-color: #007bff; border: none; padding: 10px;">Buscar</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary w-100"
                    style="background-color: #6c757d; border: none; padding: 10px;">Limpiar</a>
            </div>
        </form>

        <div class="table-responsive" style="border-radius: 5px; overflow: hidden;">
            <table class="table table-dark table-hover mb-0" style="background-color: #212529; border: none;">
                <thead style="border-bottom: 2px solid #2d3238;">
                    <tr>
                        <th style="color: #17a2b8; font-weight: bold; border: none;">DNI</th>
                        <th style="color: #17a2b8; font-weight: bold; border: none;">Personal</th>
                        <th style="color: #17a2b8; font-weight: bold; border: none;">Rol</th>
                        <th style="color: #17a2b8; font-weight: bold; border: none;">Curso</th>
                        <th style="color: #17a2b8; font-weight: bold; border: none;">Usuario</th>
                        <th style="color: #17a2b8; font-weight: bold; border: none; text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr style="border-bottom: 1px solid #2d3238;">
                            <td class="align-middle" style="border: none;">{{ $user->dni }}</td>
                            <td class="align-middle" style="border: none;">{{ $user->nombre }} {{ $user->apellido }}</td>
                            <td class="align-middle" style="border: none;">{{ ucfirst($user->rol) }}</td>
                            <td class="align-middle" style="border: none;">
                                {{ $user->cursoRelacion->materia ?? '-' }}
                            </td>
                            <td class="align-middle text-info" style="border: none;">
                                {{ $user->usuario }}</td>
                            <td class="align-middle text-center" style="border: none;">
                                <a href="{{ route('admin.users.show', $user->id_usuario) }}"
                                    class="btn btn-sm btn-outline-info"
                                    style="border-color: #17a2b8; color: #17a2b8;">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
