@extends('layouts.app')

@section('title', 'Dashboard - Alumno')

@section('content')
    <div class="container">
        <h1>Mi Plataforma Educativa</h1>
        <p>Bienvenido, {{ Auth::guard('alumno')->user()->nombre }}. Acceso a tus cursos y calificaciones.</p>

        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Página Institucional</h5>
                        <p class="card-text">Información sobre la institución.</p>
                        <a href="{{ route('alumno.pagina_institucional') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Calificaciones</h5>
                        <p class="card-text">Visualiza tus calificaciones.</p>
                        <a href="{{ route('alumno.qualifications') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Calendario</h5>
                        <p class="card-text">Consulta el calendario académico.</p>
                        <a href="{{ route('alumno.calendar') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mensajes</h5>
                        <p class="card-text">Lee tus mensajes y comunicados.</p>
                        <a href="{{ route('alumno.messages') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Actividades</h5>
                        <p class="card-text">Realiza las actividades asignadas.</p>
                        <a href="{{ route('alumno.activity') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Organizaciones</h5>
                        <p class="card-text">Participa en organizaciones estudiantiles.</p>
                        <a href="{{ route('alumno.organizations') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Herramientas</h5>
                        <p class="card-text">Acceso a herramientas educativas.</p>
                        <a href="{{ route('alumno.tools') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ETI</h5>
                        <p class="card-text">Plataforma educativa integral.</p>
                        <a href="{{ route('alumno.eti') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
