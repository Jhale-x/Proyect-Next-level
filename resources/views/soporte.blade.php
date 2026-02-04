@extends('layouts.landing')

@section('title', 'Soporte')

@section('content')

<!-- Encabezado -->
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('herramientas') }}" class="btn btn-primary">
        X
    </a>
    <h1 class="fw-normal mb-0">DESARROLLADORES</h1>
</div>

<!-- Contenido -->
<div class="row g-4">

    <!-- Manuel -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee"
                 class="card-img-top"
                 style="height:160px; object-fit:cover;">

            <div class="card-body">
                <small class="text-muted fw-semibold">SOPORTE-CONTACTO</small>
                <h6 class="mt-2 fw-bold">Manuel Antonio Garay Rivera</h6>
                <p class="text-muted mb-1">Disponible</p>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">📞 945412863</span>
                    <i class="bi bi-star-fill text-purple fs-5"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Adel -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee"
                 class="card-img-top"
                 style="height:160px; object-fit:cover;">

            <div class="card-body">
                <small class="text-muted fw-semibold">SOPORTE-CONTACTO</small>
                <h6 class="mt-2 fw-bold">Adel Brayan Macahuachi Zamudio</h6>
                <p class="text-muted mb-1">Disponible</p>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">📞 944069117</span>
                    <i class="bi bi-star-fill text-purple fs-5"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Sol -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee"
                 class="card-img-top"
                 style="height:160px; object-fit:cover;">

            <div class="card-body">
                <small class="text-muted fw-semibold">SOPORTE-CONTACTO</small>
                <h6 class="mt-2 fw-bold">Sol Korianca Dávila Cruz</h6>
                <p class="text-muted mb-1">Disponible</p>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">📞 985545461</span>
                    <i class="bi bi-star-fill text-purple fs-5"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Alejandro -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee"
                 class="card-img-top"
                 style="height:160px; object-fit:cover;">

            <div class="card-body">
                <small class="text-muted fw-semibold">SOPORTE-CONTACTO</small>
                <h6 class="mt-2 fw-bold">Alejandro Maldonado Perez</h6>
                <p class="text-muted mb-1">Disponible</p>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">📞 994278446</span>
                    <i class="bi bi-star-fill text-purple fs-5"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Gianmarco -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee"
                 class="card-img-top"
                 style="height:160px; object-fit:cover;">

            <div class="card-body">
                <small class="text-muted fw-semibold">SOPORTE-CONTACTO</small>
                <h6 class="mt-2 fw-bold">Gianmarco Garbozo Obregon</h6>
                <p class="text-muted mb-1">Disponible</p>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">📞 931157445</span>
                    <i class="bi bi-star-fill text-purple fs-5"></i>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
