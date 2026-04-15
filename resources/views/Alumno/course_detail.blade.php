@extends('layouts.Alumnoslanding')

@section('title', $curso->nombre . ' - Next Level')

@section('content')
<div class="container-fluid">
    <div class="course-header">
        <h2>{{ $curso->nombre }}</h2>
        <p>Docente: {{ $curso->docente ?? 'No asignado' }}</p>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="content-card">
                <h3>Contenido del Curso</h3>
                <p>Bienvenido al curso de {{ $curso->nombre }}.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.course-header {
    background: linear-gradient(135deg, #e60000, #cc0000);
    color: white;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 20px;
}
.course-header h2 {
    margin: 0 0 10px 0;
    font-size: 28px;
}
.content-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}
.content-card h3 {
    margin: 0 0 15px 0;
    font-size: 18px;
    color: #e60000;
}
</style>
@endpush