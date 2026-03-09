@extends('layouts.landing')

@section('title', 'Página Institucional')

@section('content')
    <div class="container mt-5">
        <h1>Página Institucional</h1>
        <p>Bienvenido a nuestra institución educativa.</p>

        <div class="row mt-4">
            <div class="col-md-6">
                <h3>Nuestra Misión</h3>
                <p>Proporcionar educación de calidad con excelencia académica.</p>
            </div>
            <div class="col-md-6">
                <h3>Nuestra Visión</h3>
                <p>Formar estudiantes íntegros y comprometidos con la sociedad.</p>
            </div>
        </div>

        @auth('alumno')
            <div class="mt-4">
                <a href="{{ route('alumno.dashboard') }}" class="btn btn-primary">Volver a mi panel</a>
            </div>
        @endauth
    </div>
@endsection
