    @extends('layouts.Docentelanding')

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/docente/eta.css') }}">
    @endpush

    @section('title', 'ETA - Evaluación Tecnológica de Aprendizaje')

    @section('content')
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

                    <!-- Selector -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <button class="btn btn-outline-primary w-100 active-btn" id="btnColegio"
                                onclick="seleccionarModalidad('colegio')">
                                🏫 COLEGIO
                            </button>
                        </div>

                        <div class="col-md-6">
                            <button class="btn btn-outline-danger w-100" id="btnAcademia"
                                onclick="seleccionarModalidad('academia')">
                                🎓 ACADEMIA
                            </button>
                        </div>
                    </div>

                    <!-- FILTROS COLEGIO -->
                    <div id="filtrosColegio">
                        <div class="row g-3">

                            <div class="col-md-4">
                                <label class="form-label fw-bold text-primary">Nivel</label>
                                <select class="form-select" id="nivel" onchange="cargarGrados()">
                                    <option value="">Todos</option>
                                    @foreach ($niveles ?? [] as $nivel)
                                        <option value="{{ $nivel->id_nivel }}">{{ $nivel->nivel }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold text-primary">Grado</label>
                                <select class="form-select" id="grado">
                                    <option value="">Todos</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold text-primary">Sección</label>
                                <select class="form-select" id="seccion">
                                    <option value="">Todas</option>
                                    @foreach ($secciones ?? [] as $seccion)
                                        <option value="{{ $seccion->id_seccion }}">{{ $seccion->seccion }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    <!-- FILTROS ACADEMIA -->
                    <div id="filtrosAcademia" style="display:none;">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-danger">Facultad</label>
                                <select class="form-select" id="facultad">
                                    <option value="">Todas</option>
                                    @foreach ($facultades ?? [] as $facultad)
                                        <option value="{{ $facultad->id_facultad }}">{{ $facultad->facultad }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- BOTONES -->
                    <div class="mt-4">
                        <button class="btn btn-primary" onclick="cargarAlumnos()">Cargar alumnos</button>
                        <button class="btn btn-success ms-2" onclick="exportarPromedios()">Exportar</button>
                        <button class="btn btn-secondary ms-2" onclick="limpiarTodo()">Limpiar</button>
                    </div>

                    <!-- TABLA -->
                    <div id="tablaContainer" style="display:none; margin-top:20px;">
                        <div class="table-responsive">

                            @php
                                $totalCols = 3 + count($actividades ?? []) + 2;
                            @endphp

                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr class="text-center">
                                        <th class="text-start">Alumno</th>
                                        <th>DNI</th>

                                        @forelse ($actividades as $actividad)
                                            <th>
                                                {{ $actividad->actividad }}
                                                <br>
                                                <small>{{ $actividad->porcentaje }}%</small>
                                            </th>
                                        @empty
                                            <th>No hay actividades</th>
                                        @endforelse
                                    </tr>
                                </thead>

                                <tbody id="tablaBody"></tbody>
                            </table>

                        </div>

                        <div class="text-end mt-3">
                            <button class="btn btn-warning" onclick="calcularTodosPromedios()">Calcular</button>
                            <button class="btn btn-primary" onclick="guardarTodasNotas()">Guardar</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script>
            let alumnosData = [];
            let notasGlobal = [];
            let modalidadActual = 'colegio';

            /* FIX: variables seguras */
            const nivel = document.getElementById('nivel');
            const grado = document.getElementById('grado');
            const seccion = document.getElementById('seccion');
            const facultad = document.getElementById('facultad');

            function seleccionarModalidad(tipo) {
                modalidadActual = tipo;

                document.getElementById('btnColegio').classList.toggle('active-btn', tipo === 'colegio');
                document.getElementById('btnAcademia').classList.toggle('active-btn', tipo === 'academia');

                document.getElementById('filtrosColegio').style.display = tipo === 'colegio' ? 'block' : 'none';
                document.getElementById('filtrosAcademia').style.display = tipo === 'academia' ? 'block' : 'none';

                document.getElementById('tablaContainer').style.display = 'none';
                alumnosData = [];
            }

            function cargarGrados() {
                const nivelId = nivel.value;

                fetch(`/admin/eti/grados/${nivelId}`)
                    .then(r => r.json())
                    .then(data => {
                        grado.innerHTML = '<option value="">Todos</option>';

                        data.forEach(g => {
                            grado.innerHTML += `<option value="${g.id_grado}">${g.grado}°</option>`;
                        });
                    });
            }

            async function cargarAlumnos() {

                const filtros = modalidadActual === 'colegio' ? {
                    colegio: true,
                    nivel: nivel.value,
                    grado: grado.value,
                    seccion: seccion.value
                } : {
                    facultad: facultad.value
                };

                const tbody = document.getElementById('tablaBody');


                const colspan = document.querySelectorAll("th").length;

                tbody.innerHTML = `<tr><td colspan="${colspan}" class="text-center">Cargando...</td></tr>`;
                document.getElementById('tablaContainer').style.display = 'block';

                const res = await fetch('/admin/eti/alumnos', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(filtros)
                });

                const data = await res.json();

                if (!data.success || !data.alumnos.length) {
                    tbody.innerHTML = `<tr><td colspan="${colspan}" class="text-center text-warning">Sin alumnos</td></tr>`;
                    return;
                }

                alumnosData = data.alumnos;
                await cargarNotas();
                renderizarTabla(data.alumnos);
            }

            async function cargarNotas() {
                const res = await fetch('/admin/eti/notas');
                const data = await res.json();
                notasGlobal = data.notas;
            }

            function renderizarTabla(alumnos) {

                const tbody = document.getElementById('tablaBody');
                tbody.innerHTML = '';

                const actividades = @json($actividades);

                alumnos.forEach(alumno => {

                    const row = tbody.insertRow();
                    row.dataset.id = alumno.id;

                    // ======================
                    // ALUMNO
                    // ======================
                    row.insertCell(0).innerHTML = `${alumno.apellido}, ${alumno.nombre}`;
                    row.insertCell(1).textContent = alumno.dni ?? '---';

                    // ======================
                    // ACTIVIDADES
                    // ======================
                    actividades.forEach(act => {

                        const cell = row.insertCell();

                        const esPromedio = act.actividad.toLowerCase() === 'promedio';

                        // ======================
                        // PROMEDIO (SOLO SPAN)
                        // ======================
                        if (esPromedio) {

                            const span = document.createElement('span');
                            span.id = `prom-${alumno.id}`;
                            span.className = 'fw-bold';
                            span.textContent = '--';

                            cell.classList.add('text-center');
                            cell.appendChild(span);

                            return;
                        }

                        // ======================
                        // INPUT NOTA
                        // ======================
                        const input = document.createElement('input');
                        input.type = 'number';
                        input.className = 'form-control form-control-sm';
                        input.min = 0;
                        input.max = 20;
                        input.step = 0.5;

                        input.dataset.alumnoId = alumno.id;
                        input.dataset.cursoActividadId = act.id_curso_actividad;

                        // ======================
                        // CARGAR NOTA DESDE BD
                        // ======================
                        const notaEncontrada = notasGlobal.find(n =>
                            n.id_alumno == alumno.id &&
                            n.id_curso_actividad == act.id_curso_actividad
                        );

                        input.value = notaEncontrada ? notaEncontrada.nota : '';

                        // ======================
                        // EVENTO PROMEDIO
                        // ======================
                        input.addEventListener('input', () => calcularPromedio(alumno.id));

                        cell.appendChild(input);
                    });

                    // ======================
                    // BOTÓN GUARDAR
                    // ======================
                    const acc = row.insertCell();

                    acc.innerHTML = `
                        <button class="btn btn-sm btn-success" onclick="guardarIndividual(${alumno.id})">
                            Guardar
                        </button>
                    `;
                });
            }

            function calcularPromedio(id) {

                const row = document.querySelector(`tr[data-id="${id}"]`);
                if (!row) return;

                const inputs = row.querySelectorAll('input[type="number"]');

                let suma = 0;
                let count = 0;

                inputs.forEach(i => {
                    const v = Number(i.value);
                    if (!isNaN(v) && i.value !== '') {
                        suma += v;
                        count++;
                    }
                });

                const promedio = count ? (suma / count).toFixed(2) : '--';

                const span = document.getElementById(`prom-${id}`);
                if (span) span.textContent = promedio;
            }

            function calcularTodosPromedios() {
                alumnosData.forEach(a => calcularPromedio(a.id));
                alert('Promedios listos');
            }

            async function guardarIndividual(id) {

                const inputs = document.querySelectorAll(`[data-alumno-id="${id}"]`);

                let suma = 0;
                let count = 0;

                const requests = [];

                for (const i of inputs) {

                    if (!i.value) continue;

                    const valor = Number(i.value);

                    if (!isNaN(valor)) {
                        suma += valor;
                        count++;

                        requests.push(
                            fetch('/admin/eti/guardar-promedio', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    alumno_id: id,
                                    curso_actividad_id: i.dataset.cursoActividadId,
                                    nota: valor
                                })
                            })
                        );
                    }
                }
                await Promise.all(requests);

                alert('Guardado');
            }

            async function guardarTodasNotas() {

                const inputs = document.querySelectorAll('input[type="number"]');

                const requests = [];

                for (const i of inputs) {

                    if (!i.value) continue;

                    const valor = Number(i.value);

                    if (isNaN(valor)) continue;

                    // ❌ IGNORAR PROMEDIO SI EXISTE COMO INPUT
                    if (!i.dataset.cursoActividadId) continue;

                    requests.push(
                        fetch('/admin/eti/guardar-promedio', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                alumno_id: i.dataset.alumnoId,
                                curso_actividad_id: i.dataset.cursoActividadId, // ✔ CORRECTO
                                nota: valor
                            })
                        })
                    );
                }

                await Promise.all(requests);

                alert('Guardado correctamente');
            }

            function limpiarTodo() {
                location.reload();
            }

            function exportarPromedios() {
                window.location.href = '/admin/eti/exportar';
            }
        </script>

    @endsection
