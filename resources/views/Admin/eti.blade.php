@extends('layouts.Adminlanding')

@section('title', 'ETI - Next Level')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center mb-4 border-bottom pb-3">
        <div class="bg-primary text-white p-2 rounded me-3">
            <i class="bi bi-cpu-fill fs-3"></i>
        </div>
        <div>
            <h2 class="fw-bold m-0" style="color: #0a1f44;">Módulo ETI</h2>
            <p class="text-muted m-0">Evaluación Tecnológica Integral</p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6">
            <button class="btn btn-outline-primary w-100 py-3 shadow-sm fw-bold border-2 active-btn" id="btnColegio" onclick="seleccionarModalidad('colegio')">
                <i class="bi bi-building me-2"></i> COLEGIO
            </button>
        </div>
        <div class="col-12 col-md-6">
            <button class="btn btn-outline-danger w-100 py-3 shadow-sm fw-bold border-2" id="btnAcademia" onclick="seleccionarModalidad('academia')">
                <i class="bi bi-mortarboard me-2"></i> ACADEMIA
            </button>
        </div>
    </div>
    
    <div class="card shadow-sm border-0 mb-4 bg-light">
        <div class="card-body">
            <div id="filtros-colegio" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold text-primary">Nivel</label>
                    <select class="form-select border-primary" id="nivel_eti">
                        <option value="primaria">Primaria</option>
                        <option value="secundaria">Secundaria</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold text-primary">Grado</label>
                    <select class="form-select border-primary">
                        <option>1° Grado</option><option>2° Grado</option>
                        <option>3° Grado</option><option>4° Grado</option>
                        <option>5° Grado</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold text-primary">Sección</label>
                    <select class="form-select border-primary">
                        <option>A</option><option>B</option><option>C</option>
                    </select>
                </div>
            </div>

            <div id="filtros-academia" class="row g-3 d-none">
                <div class="col-md-12">
                    <label class="form-label fw-bold text-danger">Facultad / Área</label>
                    <select class="form-select border-danger">
                        <option>Medicina</option>
                        <option>Ingenierías</option>
                        <option>Ciencias Sociales</option>
                        <option>Arquitectura</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 overflow-hidden">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0"><i class="bi bi-pencil-square me-2"></i>Registro de Notas por Semanas</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th class="text-start ps-4" style="min-width: 250px;">Alumno</th>
                            @for ($i = 1; $i <= 10; $i++)
                                <th class="border-start">Sem {{ $i }}</th>
                            @endfor
                            <th class="bg-primary text-white">Prom</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (['García López, Luis', 'Martínez Ruiz, Ana', 'Sánchez Castro, Pedro'] as $alumno)
                        <tr class="text-center">
                            <td class="text-start ps-4 fw-bold text-secondary">{{ $alumno }}</td>
                            @for ($i = 1; $i <= 10; $i++)
                                <td class="p-1 border-start">
                                    <input type="number" class="form-control form-control-sm text-center border-0 bg-transparent input-semana" placeholder="--" min="0" max="20" style="width: 50px; margin: auto;">
                                </td>
                            @endfor
                            <td class="fw-bold bg-light text-primary">--</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white text-end py-3">
            <button class="btn btn-secondary me-2">Cancelar</button>
            <button class="btn btn-primary px-4 fw-bold">Guardar Registro</button>
        </div>
    </div>
</div>

<script>
function seleccionarModalidad(tipo) {
    const btnCol = document.getElementById('btnColegio');
    const btnAca = document.getElementById('btnAcademia');
    const fColegio = document.getElementById('filtros-colegio');
    const fAcademia = document.getElementById('filtros-academia');
    if (tipo === 'colegio') {
        btnCol.classList.add('active-btn');
        btnAca.classList.remove('active-btn');
        fColegio.classList.remove('d-none');
        fAcademia.classList.add('d-none');
    } else {
        btnAca.classList.add('active-btn');
        btnCol.classList.remove('active-btn');
        fAcademia.classList.remove('d-none');
        fColegio.classList.add('d-none');
    }
}
</script>
@endsection