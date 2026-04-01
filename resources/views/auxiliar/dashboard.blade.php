@extends('layouts.Auxiliarlanding')

@section('title', 'Dashboard - Auxiliar')

@section('content')
    <div class="container">
        <h1>Dashboard Auxiliar</h1>
        <p>Bienvenido, **{{ Auth::user()->nombre }}**. Gestión de soporte técnico.</p>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-headset fs-1 text-primary"></i>
                        <h5 class="card-title mt-3">Módulo de Soporte</h5>
                        <p class="card-text text-muted">Revisa y gestiona las solicitudes de ayuda de los usuarios.</p>
                        <a href="{{ route('auxiliar.support') }}" class="btn btn-primary px-4">Entrar al Módulo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection