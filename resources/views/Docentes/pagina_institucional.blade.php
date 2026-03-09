@extends('layouts.Docentelanding')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 mb-4 p-4">
        <h2 class="fw-bold">📢 Panel de Anuncios</h2>
        <p class="text-muted">Bienvenido docente, aquí verás los últimos comunicados de Next Level.</p>
    </div>

    <div class="row">
        @forelse($anuncios as $anuncio)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($anuncio->imagen)
                        <img src="{{ asset('storage/' . $anuncio->imagen) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-primary">{{ $anuncio->titulo }}</h5>
                        <p class="card-text text-secondary">{{ $anuncio->descripcion }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">
                <p>No hay anuncios publicados actualmente.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection