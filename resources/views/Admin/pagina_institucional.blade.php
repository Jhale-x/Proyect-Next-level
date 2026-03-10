@extends('layouts.Adminlanding')

@section('title', 'Gestionar Página Institucional - Admin')

@section('content')
    <div class="container mt-5">
        <h1>Gestión de Página Institucional</h1>
        <p>Administra anuncios y contenido de la página institucional.</p>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
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

        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Crear Anuncio</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.pagina_institucional.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título del Anuncio</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="contenido" class="form-label">Contenido Completo</label>
                                <textarea class="form-control" id="contenido" name="contenido" rows="6"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="imagen" class="form-label">Imagen</label>
                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label for="fecha_publicacion" class="form-label">Fecha de Publicación</label>
                                <input type="date" class="form-control" id="fecha_publicacion" name="fecha_publicacion"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-control" id="estado" name="estado">
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                    <option value="programado">Programado</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Publicar Anuncio</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5>Anuncios Recientes</h5>
                    </div>
                    <div class="card-body">
                        @if ($recientes->isEmpty())
                            <div class="alert alert-info">
                                <p><strong>Aún no hay anuncios publicados</strong></p>
                                <p>Crea tu primer anuncio usando el formulario.</p>
                            </div>
                        @else
                            <ul class="list-group">
                                @foreach ($recientes as $anuncio)
                                    <li class="list-group-item">
                                        <strong>{{ $anuncio->titulo }}</strong><br>
                                        <small>{{ $anuncio->fecha_publicacion->format('d/m/Y') }} &ndash;
                                            {{ ucfirst($anuncio->estado) }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h5>Historial de Anuncios</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Estado</th>
                                    <th>Fecha Publicación</th>
                                    <th>Publicado por</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($historial as $anuncio)
                                    <tr>
                                        <td>{{ $anuncio->titulo }}</td>
                                        <td>{{ ucfirst($anuncio->estado) }}</td>
                                        <td>{{ $anuncio->fecha_publicacion->format('d/m/Y') }}</td>
                                        <td>
                                            @if ($anuncio->user)
                                                {{ $anuncio->user->nombre }} {{ $anuncio->user->apellido }}
                                            @else
                                                —
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No hay anuncios para mostrar</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
