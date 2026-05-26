@extends('layouts.Adminlanding')

@section('title', 'Gestión de Página Institucional - Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/PaginaInstitucional.css') }}">
@endpush

@section('content')
    <div class="container-fluid page-wrap">

        <div class="page-header mb-4">
            <div>
                <h1 class="section-title mb-1">Gestión de Página Institucional</h1>
                <p class="text-muted mb-0">Administra anuncios y contenido.</p>
            </div>
        </div>

        {{-- FORM + LISTA --}}
        <div class="row g-4 align-items-stretch">

            <div class="col-md-7">
                <div class="card card-soft">
                    <div class="card-header bg-primary text-white">
                        Crear Anuncio
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.pagina_institucional.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="text" name="titulo" class="form-control mb-2" placeholder="Título" required
                                value="{{ old('titulo') }}">
                            <textarea name="descripcion" class="form-control mb-2" placeholder="Descripción" required>{{ old('descripcion') }}</textarea>

                            <select name="estado" id="estadoAnuncio" class="form-select mb-2" required>
                                <option value="activo" {{ old('estado') === 'activo' ? 'selected' : '' }}>Activo
                                </option>
                                <option value="inactivo" {{ old('estado') === 'inactivo' ? 'selected' : '' }}>Inactivo
                                </option>
                                <option value="programado" {{ old('estado') === 'programado' ? 'selected' : '' }}>
                                    Programado</option>
                            </select>

                            <input type="file" name="imagen" class="form-control mb-2">

                            <button class="btn btn-success">Publicar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5     d-flex">
                <div class="card card-soft w-100 d-flex flex-column">

                    <div class="card-header bg-info text-white">
                        Anuncios Recientes
                    </div>

                    <div class="card-body d-flex flex-column">

                        @forelse ($recientes as $a)
                            <div class="mb-3 p-2 border rounded">
                                <strong>{{ $a->titulo }}</strong><br>
                                <small class="text-muted">{{ $a->fecha_publicacion }}</small>
                            </div>
                        @empty
                            <div class="text-center text-muted mt-auto">
                                No hay anuncios
                            </div>
                        @endforelse

                    </div>

                </div>
            </div>

        </div>
        {{-- HISTORIAL --}}
        <div class="card card-soft mt-4">
            <div class="card-header bg-secondary text-white">
                Historial
            </div>

            <div class="card-body">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Acción</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($historial as $h)
                            <tr>
                                <td>{{ $h->titulo }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $h->estado == 'activo' ? 'success' : ($h->estado == 'inactivo' ? 'secondary' : 'warning') }}">
                                        {{ ucfirst($h->estado) }}
                                    </span>
                                </td>
                                <td>{{ $h->fecha_publicacion?->format('d/m/Y') }}</td>
                                <td>{{ $h->user->nombre ?? '-' }}</td>
                                <td>
                                    <div class="d-flex gap-2">

                                        {{-- EDITAR --}}
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#editarAnuncioModal{{ $h->id }}">
                                            Editar
                                        </button>

                                        {{-- ELIMINAR --}}
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalEliminar{{ $h->id }}">
                                            Eliminar
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@push('modals')
    @foreach ($historial as $h)
        {{-- MODAL EDITAR --}}
        <div class="modal fade" id="editarAnuncioModal{{ $h->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Editar anuncio</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <form method="POST" action="{{ route('admin.pagina_institucional.update', $h->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">Título</label>
                                <input type="text" name="titulo" class="form-control" value="{{ $h->titulo }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="3" required>{{ $h->descripcion }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select name="estado" class="form-select">
                                    <option value="activo" {{ $h->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ $h->estado == 'inactivo' ? 'selected' : '' }}>Inactivo
                                    </option>
                                    <option value="programado" {{ $h->estado == 'programado' ? 'selected' : '' }}>
                                        Programado</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Imagen</label>
                                <input type="file" name="imagen" class="form-control">
                            </div>

                            @if ($h->imagen)
                                <small class="text-muted">Imagen actual: {{ $h->imagen }}</small>
                            @endif

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        {{-- MODAL ELIMINAR --}}
        <div class="modal fade" id="modalEliminar{{ $h->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">

                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">⚠️ Confirmar eliminación</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-center">
                        <p class="mb-1">¿Seguro que deseas eliminar?</p>
                        <strong class="text-danger">"{{ $h->titulo }}"</strong>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                        <form method="POST" action="{{ route('admin.pagina_institucional.destroy', $h->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger px-4">Sí, eliminar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endpush
