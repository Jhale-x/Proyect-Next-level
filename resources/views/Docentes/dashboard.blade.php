@extends('layouts.Docentelanding')

@section('title', 'Dashboard - Docente')

@section('content')
    <div class="container">
        <h1>Dashboard Docente</h1>
        <p>Bienvenido, {{ Auth::user()->nombre }}. Acceso a módulos educativos.</p>

        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Calificaciones</h5>
                        <p class="card-text">Registra y consulta calificaciones de estudiantes.</p>
                        <a href="{{ route('docente.qualifications') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Actividades</h5>
                        <p class="card-text">Crea y asigna actividades a tus estudiantes.</p>
                        <a href="{{ route('docente.activity') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Calendario</h5>
                        <p class="card-text">Visualiza el calendario académico.</p>
                        <a href="{{ route('docente.calendar') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mensajes</h5>
                        <p class="card-text">Comunícate con estudiantes y padres.</p>
                        <a href="{{ route('docente.messages') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Organizaciones</h5>
                        <p class="card-text">Gestiona organizaciones estudiantiles.</p>
                        <a href="{{ route('docente.organizations') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Herramientas</h5>
                        <p class="card-text">Acceso a herramientas educativas.</p>
                        <a href="{{ route('docente.tools') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
