@extends('layouts.landing')

@section('title', 'Asistencia Profesores')

@section('content')


<div class="px-6 py-6 w-full bg-gradient-to-br from-slate-50 to-blue-50">

    <style>
        .bg-orange {
    background-color: #fd7e14;
    color: #fff;
}

    </style>

    <!-- Header -->
    <div class="mb-6 text-center">
        <h1 class="text-3xl font-light text-slate-800 mb-1">Control de Asistencia</h1>
        <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full"></div>
        <p class="text-slate-500 mt-2 text-sm uppercase tracking-widest">Registro diario de docentes</p>
    </div>

    <!-- Filtros en una sola fila -->
    <div class="max-w-6xl mx-auto mb-6">
        <div class="bg-white rounded-2xl shadow-md p-4 flex flex-wrap md:flex-nowrap items-center gap-4 border">
            <!-- Buscar por texto -->
        <input 
            type="text" 
            placeholder="Buscar por nombre, código o descripción..." 
            class="border rounded-lg px-4 py-2 w-full md:w-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <input type="date" value="2026-02-04" class="border rounded-lg px-4 py-2 w-full md:w-auto">
            
        </div>
    </div>
    
    <!-- Tabla -->
    <div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Foto</th>
                        <th>Docente</th>
                        <th>Documento</th>
                        <th>Entrada</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="/img/juan.jpg" class="rounded-circle" width="55" height="55" alt="Juan">
                        </td>
                        <td>Becerra</td>
                        <td>62458999</td>
                        <td>07:45 AM</td>
                        <td>04/02/2026</td>
                        <td>
                            <span class="badge bg-success">Puntual</span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <img src="/img/maria.jpg" class="rounded-circle" width="55" height="55" alt="María">
                        </td>
                        <td>Pormachi</td>
                        <td>62458999</td>
                        <td>08:15 AM</td>
                        <td>04/02/2026</td>
                        <td>
                            <span class="badge bg-warning text-dark">Tardanza</span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <img src="/img/carlos.jpg" class="rounded-circle" width="55" height="55" alt="Carlos">
                        </td>
                        <td>Gallo</td>
                        <td>62458999</td>
                        <td>—</td>
                        <td>—</td>

                        <td>
                            <span class="badge bg-danger">Ausente</span>
                        </td>
                    </tr>

                    <td>
                        <img src="/img/carlos.jpg" class="rounded-circle" width="55" height="55" alt="Carlos">
                    </td>
                    <td>Carlos Andrés Pérez Gómez</td>
                    <td>62458999</td>
                    <td>—</td>
                    <td>—</td>
                    <td>
                        <span class="badge bg-orange">Justificado - Tardanza</span>
                    </td>
                    

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
