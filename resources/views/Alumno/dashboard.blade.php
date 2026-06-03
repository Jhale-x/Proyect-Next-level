@extends('layouts.Alumnoslanding')

@section('title', 'Dashboard - Next Level')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="welcome-card">
                <h2>¡Bienvenido, {{ $alumno->nombre }} {{ $alumno->apellido }}!</h2>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <h3>Mis Cursos</h3>
            <div class="courses-grid">
                @forelse($cursos as $curso)
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
                @empty
                    <div class="alert alert-info">No tienes cursos asignados aún.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 20px;
}
.course-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}
.course-card:hover {
    transform: translateY(-5px);
}
.course-icon {
    width: 50px;
    height: 50px;
    background: #e60000;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
}
.course-info {
    flex: 1;
}
.course-info h4 {
    margin: 0 0 5px 0;
    font-size: 16px;
}
.course-info p {
    margin: 0;
    font-size: 12px;
    color: #666;
}
.btn-course {
    background: #e60000;
    color: white;
    padding: 8px 15px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 12px;
    transition: background 0.3s ease;
}
.btn-course:hover {
    background: #cc0000;
    color: white;
}
.welcome-card {
    background: linear-gradient(135deg, #e60000, #cc0000);
    color: white;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 20px;
}
.welcome-card h2 {
    margin: 0 0 10px 0;
    font-size: 24px;
}
.welcome-card p {
    margin: 0;
    opacity: 0.9;
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