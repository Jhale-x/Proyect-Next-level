@extends('layouts.Adminlanding')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/listados.css') }}">

    <div class="container-fluid py-4">
        <h2 class="text-white mb-4">Gestión de Alumnos</h2>

        <form action="{{ route('admin.alumnos.index') }}" method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o DNI..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="nivel" class="form-select">
                    <option value="">Todos los niveles</option>
                    @foreach ($niveles as $nivel)
                        <option value="{{ $nivel->id_nivel }}" {{ request('nivel') == $nivel->id_nivel ? 'selected' : '' }}>
                            {{ $nivel->nivel }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="grado" class="form-select">
                    <option value="">Todos los grados</option>
                    @foreach ($grados as $grado)
                        <option value="{{ $grado->id_grado }}" {{ request('grado') == $grado->id_grado ? 'selected' : '' }}>
                            {{ $grado->grado }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.alumnos.index') }}" class="btn btn-secondary w-100">Limpiar</a>
            </div>
        </form>

        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Alumno</th>
                    <th>Nivel/Grado/Sección</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->dni }}</td>
                        <td>{{ $alumno->nombre }} {{ $alumno->apellido }}</td>
                        <td>
                            {{ optional($alumno->salon->nivel)->nivel ?? 'N/A' }}
                            @if (optional($alumno->salon->grado)->grado)
                                - {{ $alumno->salon->grado->grado }}
                            @endif
                            @if (optional($alumno->salon->seccion)->seccion)
                                - {{ $alumno->salon->seccion->seccion }}
                            @endif
                        </td>
                        <td>{{ $alumno->usuario }}</td>
                        <td>
                            <a href="{{ route('admin.alumnos.show', $alumno->id_alumno) }}"
                                class="btn btn-sm btn-outline-info">
                                Ver
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
