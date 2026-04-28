@extends('layouts.Alumnoslanding')

@section('title', 'Página Institucional')

@section('content')
<div class="container-fluid">
    <div class="hero mb-4">
        <h1 class="h3 mb-2">Página Institucional</h1>
        <p class="mb-0">Noticias y comunicados oficiales de Next Level.</p>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">{{ isset($anuncios) ? $anuncios->count() : 0 }} anuncios publicados</span>
    </div>

    @if(isset($anuncios) && $anuncios->count() > 0)
        @foreach ($anuncios as $anuncio)
            <article class="card anuncio-card mb-3">
                @if ($anuncio->imagen)
                    <img src="{{ asset('storage/' . $anuncio->imagen) }}" alt="Imagen del anuncio"
                        class="card-img-top anuncio-img">
                @endif

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <h2 class="h5 mb-1">{{ $anuncio->titulo }}</h2>
                        <span class="badge bg-success">{{ ucfirst($anuncio->estado) }}</span>
                    </div>

                    <p class="text-muted small mb-2">
                        {{ isset($anuncio->fecha_publicacion) ? \Carbon\Carbon::parse($anuncio->fecha_publicacion)->format('d/m/Y') : 'Sin fecha' }}
                    </p>

                    <p class="mb-0">{{ $anuncio->descripcion }}</p>
                </div>
            </article>
        @endforeach
    @else
        <div class="alert alert-info">Aún no hay anuncios institucionales publicados.</div>
    @endif
</div>
@endsection