<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/auxiliar/eta.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('title', 'ETA - Evaluación Tecnológica de Aprendizaje'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">
                <i class="bi bi-graph-up me-2"></i>
                Módulo ETA - Evaluación Tecnológica de Aprendizaje
            </h4>
            <small>Registro de notas semanales (10 semanas) - El promedio se calcula automáticamente</small>
        </div>
        <div class="card-body">
            <!-- Selector de Modalidad -->
            <div class="row g-3 mb-4">
                <div class="col-12 col-md-6">
                    <button class="btn btn-outline-primary w-100 py-2 active-btn" id="btnColegio" onclick="seleccionarModalidad('colegio')">
                        <i class="bi bi-building me-2"></i> COLEGIO
                    </button>
                </div>
                <div class="col-12 col-md-6">
                    <button class="btn btn-outline-danger w-100 py-2" id="btnAcademia" onclick="seleccionarModalidad('academia')">
                        <i class="bi bi-mortarboard me-2"></i> ACADEMIA
                    </button>
                </div>
            </div>
            
            <!-- Filtros COLEGIO: Nivel, Grado, Sección -->
            <div id="filtrosColegio">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-primary">Nivel</label>
                        <select class="form-select" id="nivel" onchange="cargarGrados()">
                            <option value="">Todos los niveles</option>
                            <?php $__currentLoopData = $niveles ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nivel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($nivel->id); ?>"><?php echo e($nivel->nombre); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-primary">Grado</label>
                        <select class="form-select" id="grado">
                            <option value="">Todos los grados</option>
                            <?php $__currentLoopData = $grados ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($grado->id_grado); ?>"><?php echo e($grado->grado); ?>° Grado</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-primary">Sección</label>
                        <select class="form-select" id="seccion">
                            <option value="">Todas las secciones</option>
                            <?php $__currentLoopData = $secciones ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seccion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($seccion->id_seccion); ?>"><?php echo e($seccion->seccion); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Filtros ACADEMIA: SOLO FACULTAD -->
            <div id="filtrosAcademia" style="display: none;">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label fw-bold text-danger">Facultad / Área</label>
                        <select class="form-select" id="facultad">
                            <option value="">Todas las facultades</option>
                            <?php $__currentLoopData = $facultades ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facultad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($facultad->id_facultad); ?>"><?php echo e($facultad->facultad); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <button type="button" class="btn btn-primary px-4" onclick="cargarAlumnos()">
                        <i class="bi bi-search me-2"></i>Cargar Alumnos
                    </button>
                    <button type="button" class="btn btn-success px-4 ms-2" onclick="exportarPromedios()">
                        <i class="bi bi-download me-2"></i>Exportar CSV
                    </button>
                    <button type="button" class="btn btn-secondary px-4 ms-2" onclick="limpiarTodo()">
                        <i class="bi bi-arrow-repeat me-2"></i>Limpiar
                    </button>
                </div>
            </div>
            
            <!-- Tabla de Notas -->
            <div id="tablaContainer" style="display: none; margin-top: 20px;">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr id="headerRow" class="text-center">
                                <th class="text-start ps-3">Alumno</th>
                                <th>DNI</th>
                                <?php for($i = 1; $i <= 10; $i++): ?>
                                    <th style="min-width: 80px;">Semana <?php echo e($i); ?></th>
                                <?php endfor; ?>
                                <th class="bg-success text-white">Promedio</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tablaBody">
                        </tbody>
                    </table>
                </div>
                <div class="text-end mt-3">
                    <button class="btn btn-warning" onclick="calcularTodosPromedios()">
                        <i class="bi bi-calculator me-2"></i>Calcular Todos
                    </button>
                    <button class="btn btn-primary" onclick="guardarTodosPromedios()">
                        <i class="bi bi-save-all me-2"></i>Guardar Todos
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let alumnosData = [];
let modalidadActual = 'colegio';

function seleccionarModalidad(tipo) {
    modalidadActual = tipo;
    const btnCol = document.getElementById('btnColegio');
    const btnAca = document.getElementById('btnAcademia');
    const filtrosColegio = document.getElementById('filtrosColegio');
    const filtrosAcademia = document.getElementById('filtrosAcademia');
    
    if (tipo === 'colegio') {
        btnCol.classList.add('active-btn');
        btnAca.classList.remove('active-btn');
        filtrosColegio.style.display = 'block';
        filtrosAcademia.style.display = 'none';
    } else {
        btnAca.classList.add('active-btn');
        btnCol.classList.remove('active-btn');
        filtrosAcademia.style.display = 'block';
        filtrosColegio.style.display = 'none';
    }
    
    document.getElementById('tablaContainer').style.display = 'none';
    alumnosData = [];
}

function cargarGrados() {
    const nivelId = document.getElementById('nivel').value;
    const gradoSelect = document.getElementById('grado');
    
    if (nivelId) {
        fetch(`/auxiliar/eta/grados/${nivelId}`)
            .then(response => response.json())
            .then(data => {
                gradoSelect.innerHTML = '<option value="">Todos los grados</option>';
                data.forEach(grado => {
                    gradoSelect.innerHTML += `<option value="${grado.id_grado}">${grado.grado}° Grado</option>`;
                });
            });
    } else {
        gradoSelect.innerHTML = '<option value="">Todos los grados</option>';
    }
}

async function cargarAlumnos() {
    let filtros = {};
    
    if (modalidadActual === 'colegio') {
        filtros.colegio = true;
        filtros.nivel = document.getElementById('nivel').value;
        filtros.grado = document.getElementById('grado').value;
        filtros.seccion = document.getElementById('seccion').value;
        
        if (!filtros.nivel && !filtros.grado && !filtros.seccion) {
            alert('⚠️ Seleccione al menos un filtro (Nivel, Grado o Sección)');
            return;
        }
    } else {
        filtros.facultad = document.getElementById('facultad').value;
        
        if (!filtros.facultad) {
            alert('⚠️ Seleccione una facultad');
            return;
        }
    }
    
    const tbody = document.getElementById('tablaBody');
    tbody.innerHTML = '<tr><td colspan="14" class="text-center py-4">Cargando alumnos... <div class="spinner-border spinner-border-sm ms-2"></div></td></tr>';
    document.getElementById('tablaContainer').style.display = 'block';
    
    try {
        const response = await fetch('/auxiliar/eta/alumnos', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify(filtros)
        });
        
        const data = await response.json();
        
        if (data.success && data.alumnos.length > 0) {
            alumnosData = data.alumnos;
            renderizarTabla(data.alumnos);
        } else {
            tbody.innerHTML = '<tr><td colspan="14" class="text-center text-warning py-4">⚠️ No se encontraron alumnos con los filtros seleccionados</td></tr>';
        }
    } catch (error) {
        console.error('Error:', error);
        tbody.innerHTML = '<tr><td colspan="14" class="text-center text-danger py-4">❌ Error al cargar los datos</td></tr>';
    }
}

async function renderizarTabla(alumnos) {
    const tbody = document.getElementById('tablaBody');
    tbody.innerHTML = '';
    
    for (const alumno of alumnos) {
        const row = tbody.insertRow();
        row.setAttribute('data-alumno-id', alumno.id);
        
        // Nombre
        const cellNombre = row.insertCell(0);
        cellNombre.className = 'ps-3 fw-bold';
        cellNombre.innerHTML = `<i class="bi bi-person-circle me-2"></i>${alumno.apellido}, ${alumno.nombre}`;        
        // DNI
        const cellDni = row.insertCell(1);
        cellDni.className = 'text-center';
        cellDni.textContent = alumno.dni || '---';
        
        // 10 inputs de notas
        for (let i = 1; i <= 10; i++) {
            const cell = row.insertCell();
            cell.className = 'p-1 text-center';
            const input = document.createElement('input');
            input.type = 'number';
            input.className = 'form-control form-control-sm';
            input.style.width = '70px';
            input.style.margin = '0 auto';
            input.min = 0;
            input.max = 20;
            input.step = 0.5;
            input.placeholder = '--';
            input.setAttribute('data-semana', i);
            input.setAttribute('data-alumno-id', alumno.id);
            input.addEventListener('input', () => calcularPromedioAlumno(alumno.id));
            cell.appendChild(input);
        }
        
        // Promedio
        const cellProm = row.insertCell();
        cellProm.className = 'fw-bold text-center bg-light';
        cellProm.id = `promedio-${alumno.id}`;
        cellProm.textContent = '--';
        
        // Acción
        const cellAcc = row.insertCell();
        cellAcc.className = 'text-center';
        cellAcc.innerHTML = `<button class="btn btn-sm btn-success" onclick="guardarPromedioIndividual(${alumno.id})">
                                <i class="bi bi-save"></i> Guardar
                            </button>`;
    }
}

function calcularPromedioAlumno(alumnoId) {
    const inputs = document.querySelectorAll(`input[data-alumno-id="${alumnoId}"]`);
    let suma = 0;
    let count = 0;
    
    inputs.forEach(input => {
        const valor = parseFloat(input.value);
        if (!isNaN(valor) && valor >= 0 && valor <= 20) {
            suma += valor;
            count++;
            input.style.backgroundColor = valor < 11 ? '#f8d7da' : '#d4edda';
        } else if (input.value !== '') {
            input.style.backgroundColor = '#fff3cd';
        } else {
            input.style.backgroundColor = '';
        }
    });
    
    const promedio = count > 0 ? (suma / count).toFixed(2) : '--';
    const tdPromedio = document.getElementById(`promedio-${alumnoId}`);
    tdPromedio.textContent = promedio;
    
    if (promedio !== '--') {
        const p = parseFloat(promedio);
        tdPromedio.style.color = p >= 14 ? '#28a745' : (p >= 11 ? '#ffc107' : '#dc3545');
        tdPromedio.style.fontWeight = 'bold';
    }
    
    return promedio;
}

function calcularTodosPromedios() {
    if (alumnosData.length === 0) {
        alert('⚠️ Primero cargue los alumnos');
        return;
    }
    alumnosData.forEach(alumno => {
        calcularPromedioAlumno(alumno.id);
    });
    alert('✅ Promedios calculados correctamente');
}

async function guardarPromedioIndividual(alumnoId) {
    const tdPromedio = document.getElementById(`promedio-${alumnoId}`);
    const promedio = tdPromedio.textContent;
    
    if (promedio === '--') {
        alert('⚠️ Primero ingrese las notas semanales');
        return;
    }
    
    const inputs = document.querySelectorAll(`input[data-alumno-id="${alumnoId}"]`);
    let semanas = 0;
    inputs.forEach(input => {
        if (input.value && input.value !== '') semanas++;
    });
    
    try {
        const response = await fetch('/auxiliar/eta/guardar-promedio', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({
                curso_id: 1,
                alumno_id: alumnoId,
                promedio_final: parseFloat(promedio),
                semana_completada: semanas
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('✅ Promedio guardado correctamente');
        } else {
            alert('❌ Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('❌ Error al guardar');
    }
}

async function guardarTodosPromedios() {
    if (alumnosData.length === 0) {
        alert('⚠️ Primero cargue los alumnos');
        return;
    }
    
    const promedios = [];
    for (const alumno of alumnosData) {
        const tdPromedio = document.getElementById(`promedio-${alumno.id}`);
        const promedio = tdPromedio.textContent;
        if (promedio !== '--') {
            promedios.push({ id: alumno.id, promedio: parseFloat(promedio) });
        }
    }
    
    if (promedios.length === 0) {
        alert('⚠️ No hay promedios para guardar');
        return;
    }
    
    if (!confirm(`¿Guardar promedios de ${promedios.length} alumno(s)?`)) return;
    
    try {
        const response = await fetch('/auxiliar/eta/guardar-multiples-promedios', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({
                curso_id: 1,
                semana_completada: 10,
                alumnos: promedios
            })
        });
        
        const result = await response.json();
        alert(result.success ? '✅ Todos los promedios guardados' : '❌ Error: ' + result.message);
    } catch (error) {
        console.error('Error:', error);
        alert('❌ Error al guardar');
    }
}

function limpiarTodo() {
    if (confirm('¿Limpiar todos los filtros y la tabla?')) {
        document.getElementById('tablaContainer').style.display = 'none';
        if (modalidadActual === 'colegio') {
            document.getElementById('nivel').value = '';
            document.getElementById('grado').innerHTML = '<option value="">Todos los grados</option>';
            document.getElementById('seccion').value = '';
        } else {
            document.getElementById('facultad').value = '';
        }
        alumnosData = [];
    }
}

async function exportarPromedios() {
    let url = '/auxiliar/eta/exportar?';
    
    if (modalidadActual === 'colegio') {
        const nivel = document.getElementById('nivel').value;
        const grado = document.getElementById('grado').value;
        const seccion = document.getElementById('seccion').value;
        if (nivel) url += `&nivel=${nivel}`;
        if (grado) url += `&grado=${grado}`;
        if (seccion) url += `&seccion=${seccion}`;
    } else {
        const facultad = document.getElementById('facultad').value;
        if (facultad) url += `&facultad=${facultad}`;
    }
    
    window.location.href = url;
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Auxiliarlanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Proyect-Next-level\resources\views/Auxiliar/eta.blade.php ENDPATH**/ ?>