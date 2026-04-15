@extends('layouts.Alumnoslanding')

@section('title', 'Mis Cursos - Next Level')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h2>Mis Cursos</h2>
                <p>Estos son los cursos asignados para el año académico {{ date('Y') }}</p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        @forelse($cursos as $curso)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="course-card">
                    <div class="course-icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <div class="course-info">
                        <h4>{{ $curso->nombre }}</h4>
                        <p>Docente: {{ $curso->docente ?? 'No asignado' }}</p>
                    </div>
                    <a href="{{ route('alumno.courses.show', $curso->id_curso) }}" class="btn-course">Ver Curso</a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No tienes cursos asignados aún.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<style>
.page-header {
    margin-bottom: 20px;
}
.page-header h2 {
    color: #0d2242;
    font-weight: 700;
}
.course-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    height: 100%;
}
.course-card:hover {
    transform: translateY(-5px);
}
.course-icon {
    width: 60px;
    height: 60px;
    background: #e60000;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 28px;
}
.course-info h4 {
    margin: 0 0 5px 0;
    font-size: 18px;
    color: #0d2242;
}
.course-info p {
    margin: 0;
    font-size: 13px;
    color: #666;
}
.btn-course {
    background: #e60000;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: background 0.3s ease;
    width: 100%;
    text-align: center;
}
.btn-course:hover {
    background: #cc0000;
    color: white;
}
.alert-info {
    background-color: #e6f7ff;
    border-color: #bae7ff;
    color: #0050b3;
    padding: 15px;
    border-radius: 10px;
}
</style>
@endpush