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

        <div class="mt-5">
            <h3>Anuncios Institucionales</h3>

            @if (!isset($anuncios) || $anuncios->isEmpty())
                <div class="alert alert-info mt-3 mb-0">
                    No hay anuncios activos por el momento.
                </div>
            @else
                <div class="row mt-3 g-3">
                    @foreach ($anuncios as $anuncio)
                        <div class="col-md-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $anuncio->titulo }}</h5>
                                    <p class="text-muted mb-2">
                                        {{ $anuncio->fecha_publicacion->format('d/m/Y') }}
                                    </p>
                                    <p class="card-text mb-0">{{ $anuncio->descripcion }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        @auth('alumno')
            <div class="mt-4">
                <a href="{{ route('alumno.dashboard') }}" class="btn btn-primary">Volver a mi panel</a>
            </div>
        @endauth
    </div>
@endsection
