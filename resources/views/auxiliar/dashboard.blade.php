@extends('layouts.Auxiliarlanding')

@section('title', 'Dashboard - Auxiliar')

@section('content')
    <div class="container">
        <h1>Dashboard Auxiliar</h1>
        <p>Bienvenido, {{ Auth::user()->nombre }}. Acceso al módulo de soporte.</p>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Soporte</h5>
                        <p class="card-text">Gestiona solicitudes de soporte y ayuda.</p>
                        <a href="{{ route('auxiliar.suport') }}" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
