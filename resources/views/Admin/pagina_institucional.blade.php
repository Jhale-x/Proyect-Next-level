@extends('layouts.Adminlanding')

@section('title', 'Gestión de Página Institucional - Admin')

@section('content')
    <div class="container-fluid page-wrap">

        <div class="page-header mb-4">
            <div>
                <h1 class="section-title mb-1">Gestión de Página Institucional</h1>
                <p class="text-muted mb-0">Administra anuncios y contenido.</p>
            </div>

        </div>

        <div class="row g-4 mb-4">

            <div class="col">
                <div class="card stats-card bg-primary text-white p-3 h-100">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Total Usuarios</small>
                            <h3>{{ $totalUsuarios }}</h3>
                        </div>
                        <i class="bi bi-people stats-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card stats-card bg-info text-white p-3 h-100">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Total Alumnos</small>
                            <h3>{{ $alumnos ?? 0 }}</h3>

                            <small>Academia: {{ $academia ?? 0 }}</small>
                            <div class="mini-bar">
                                <div class="mini-fill"
                                    style="width: {{ $alumnos ?? 0 ? (($academia ?? 0) * 100) / $alumnos : 0 }}%">
                                </div>
                            </div>

                            <small>Colegio: {{ $colegio ?? 0 }}</small>
                            <div class="mini-bar">
                                <div class="mini-fill"
                                    style="width: {{ $alumnos ?? 0 ? (($colegio ?? 0) * 100) / $alumnos : 0 }}%">
                                </div>
                            </div>
                        </div>
                        <i class="bi bi-person-lines-fill stats-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card stats-card bg-dark text-white p-3 h-100">
                    <small>Admins</small>
                    <h3>{{ $admins }}</h3>
                </div>
            </div>

            <div class="col">
                <div class="card stats-card bg-success text-white p-3 h-100">
                    <small>Docentes</small>
                    <h3>{{ $docentes }}</h3>
                </div>
            </div>

            <div class="col">
                <div class="card stats-card bg-warning text-white p-3 h-100">
                    <small>Auxiliares</small>
                    <h3>{{ $auxiliares }}</h3>
                </div>
            </div>

        </div>

        <div class="card card-soft mb-4">
            <div class="card-header bg-white border-0 fw-semibold d-flex justify-content-between">
                <span>Usuarios Recientes</span>
                <small class="text-muted">{{ count($usuariosRecientes) }} usuarios</small>
            </div>

            <div class="card-body py-2">
                <div class="row g-2">
                    @foreach ($usuariosRecientes as $user)
                        <div class="col-md-4">
                            <div class="user-mini-card d-flex align-items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nombre) }}&background=4F46E5&color=fff"
                                    class="avatar-mini">

                                <div>
                                    <div class="fw-semibold small">{{ $user->nombre }}</div>
                                    <small class="text-muted">{{ $user->rol }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- FORM + LISTA --}}
        <div class="row g-4">

            <div class="col-md-8">
                <div class="card card-soft">
                    <div class="card-header bg-primary text-white">
                        Crear Anuncio
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.pagina_institucional.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="text" name="titulo" class="form-control mb-2" placeholder="Título" required>
                            <textarea name="descripcion" class="form-control mb-2" placeholder="Descripción"></textarea>
                            <input type="file" name="imagen" class="form-control mb-2">
                            <input type="datetime-local" name="fecha_publicacion" class="form-control mb-2">

                            <button class="btn btn-success">Publicar</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-soft">
                    <div class="card-header bg-info text-white">
                        Anuncios Recientes
                    </div>

                    <div class="card-body">
                        @forelse ($recientes as $a)
                            <div class="mb-2">
                                <strong>{{ $a->titulo }}</strong><br>
                                <small>{{ $a->fecha_publicacion }}</small>
                            </div>
                        @empty
                            <div>No hay anuncios</div>
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
                <table class="table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($historial as $h)
                            <tr>
                                <td>{{ $h->titulo }}</td>
                                <td>{{ ucfirst($h->estado) }}</td>
                                <td>{{ $h->fecha_publicacion->format('d/m/Y H:i') }}</td>
                                <td>{{ $h->user->nombre ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
