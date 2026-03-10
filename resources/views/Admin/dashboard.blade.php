@extends('layouts.Adminlanding')

@section('title', 'Dashboard - Admin')

@section('content')
    <div class="container">
        <h1>Dashboard Administrador</h1>
        <p>Bienvenido, {{ Auth::user()->nombre }}. Tienes acceso total al sistema.</p>

        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Usuarios</h5>
                        <p class="card-text">Gestiona docentes, auxiliares y personal.</p>
                        <a href="{{ route('admin.users') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cursos</h5>
                        <p class="card-text">Administra todos los cursos y materias.</p>
                        <a href="{{ route('admin.courses') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Salones</h5>
                        <p class="card-text">Configura salones y niveles educativos.</p>
                        <a href="{{ route('admin.salones.edit', 1) }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Anuncios</h5>
                        <p class="card-text">Visualiza y administra los anuncios institucionales.</p>
                        <a href="{{ route('admin.pagina_institucional') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Calificaciones</h5>
                        <p class="card-text">Registra y visualiza calificaciones.</p>
                        <a href="{{ route('admin.qualifications') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Actividades</h5>
                        <p class="card-text">Crea y asigna actividades educativas.</p>
                        <a href="{{ route('admin.activities.store') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ETI</h5>
                        <p class="card-text">Acceso a la plataforma educativa.</p>
                        <a href="{{ route('admin.eti') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
