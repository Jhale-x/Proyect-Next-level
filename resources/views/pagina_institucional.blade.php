<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Institucional | Next Level</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f7fb;
        }

        .hero {
            background: linear-gradient(135deg, #0d6efd, #198754);
            color: #fff;
            padding: 2.5rem 1rem;
            border-radius: 14px;
        }

        .anuncio-card {
            border: 0;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        }

        .anuncio-img {
            max-height: 220px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
    </style>
</head>

<body>
    <div class="container py-4 py-md-5">
        <div class="hero mb-4">
            <h1 class="h3 mb-2">Pagina Institucional</h1>
            <p class="mb-0">Noticias y comunicados oficiales de Next Level.</p>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">{{ $anuncios->count() }} anuncios publicados</span>
            <a href="{{ route('portal') }}" class="btn btn-outline-light btn-sm"
                style="background: rgba(13,110,253,0.95);">
                Ir a Intranet
            </a>
        </div>

        @forelse ($anuncios as $anuncio)
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
                        {{ $anuncio->fecha_publicacion?->format('d/m/Y') }}
                    </p>

                    <p class="mb-0">{{ $anuncio->descripcion }}</p>
                </div>
            </article>
        @empty
            <div class="alert alert-info">Aun no hay anuncios institucionales publicados.</div>
        @endforelse
    </div>
</body>

</html>
