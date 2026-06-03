@extends('layouts.Apoderadolanding')

@section('title', 'Página Institucional')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/alumno/paginaInstitucional.css') }}">
@endpush

@section('content')

    <div class="container-fluid institutional-page">

        {{-- HEADER --}}
        <div class="institutional-header">

            <div>
                <h1 class="institutional-title">
                    Página Institucional
                </h1>

                <p class="institutional-subtitle">
                    Últimos anuncios y comunicados oficiales.
                </p>
            </div>

            <div class="header-badge">
                <i class="bi bi-megaphone-fill"></i>
                {{ $anuncios->count() }} anuncios
            </div>

        </div>

        {{-- GRID --}}
        <div class="announcements-grid">

            @forelse($anuncios as $anuncio)
                <div class="announcement-card">
                    {{-- IMAGEN --}}
                    @if ($anuncio->imagen)
                        <div class="announcement-image">
                            <img src="{{ asset('storage/' . $anuncio->imagen) }}" alt="{{ $anuncio->titulo }}">
                        </div>
                    @endif

                    {{-- BODY --}}
                    <div class="announcement-body">

                        <div class="announcement-top">

                            <span class="announcement-status">
                                <i class="bi bi-broadcast"></i>
                                {{ ucfirst($anuncio->estado) }}
                            </span>

                            <small>
                                {{ \Carbon\Carbon::parse($anuncio->fecha_publicacion)->format('d/m/Y') }}
                            </small>

                        </div>

                        <h2 class="announcement-title">
                            {{ $anuncio->titulo }}
                        </h2>

                        <p class="announcement-description">
                            {{ $anuncio->descripcion }}
                        </p>

                        @if ($anuncio->contenido)
                            <div class="announcement-content">
                                {{ $anuncio->contenido }}
                            </div>
                        @endif

                    </div>

                </div>

            @empty

                <div class="empty-announcements">

                    <i class="bi bi-megaphone"></i>

                    <h3>No hay anuncios disponibles</h3>

                    <p>
                        Cuando el administrador publique anuncios aparecerán aquí.
                    </p>

                </div>
            @endforelse

        </div>

    </div>

@endsection
