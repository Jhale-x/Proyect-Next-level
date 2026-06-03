<div class="container mt-3">
    <h3 class="mb-4">Calificaciones</h3>

    <div id="q-alert" class="alert alert-info d-none"></div>

    <div id="q-cursos-wrap" class="mb-4">
        <h5 class="text-primary mb-3">1. Cursos</h5>
        <div id="q-cursos" class="row g-3"></div>
    </div>

    <div id="q-salones-wrap" class="mb-4 d-none">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="text-primary mb-0">2. Salones</h5>
            <button class="btn btn-outline-secondary btn-sm" id="q-volver-cursos" type="button">Volver a
                cursos</button>
        </div>
        <p id="q-curso-seleccionado" class="text-muted small"></p>
        <div id="q-salones" class="row g-3"></div>
    </div>

    <div id="q-notas-wrap" class="d-none">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="text-primary mb-0">3. Notas</h5>
            <button class="btn btn-outline-secondary btn-sm" id="q-volver-salones" type="button">Volver a
                salones</button>
        </div>
        <p id="q-salon-seleccionado" class="text-muted small"></p>

        <div class="table-responsive">
            <table class="table table-bordered table-sm align-middle">
                <thead class="table-light">
                    <tr id="q-head"></tr>
                </thead>
                <tbody id="q-body"></tbody>
            </table>
        </div>
    </div>
</div>

<script>
    (() => {
        const endpoints = {
            base: <?php echo json_encode($qualificationsEndpoints['base'], 15, 512) ?>,
        };

        const state = {
            curso: null,
            salon: null,
        };

        const el = {
            alert: document.getElementById('q-alert'),
            cursosWrap: document.getElementById('q-cursos-wrap'),
            salonesWrap: document.getElementById('q-salones-wrap'),
            notasWrap: document.getElementById('q-notas-wrap'),
            cursos: document.getElementById('q-cursos'),
            salones: document.getElementById('q-salones'),
            head: document.getElementById('q-head'),
            body: document.getElementById('q-body'),
            cursoSel: document.getElementById('q-curso-seleccionado'),
            salonSel: document.getElementById('q-salon-seleccionado'),
            volverCursos: document.getElementById('q-volver-cursos'),
            volverSalones: document.getElementById('q-volver-salones'),
        };

        const showAlert = (message, type = 'info') => {
            el.alert.className = `alert alert-${type}`;
            el.alert.textContent = message;
            el.alert.classList.remove('d-none');
        };

        const hideAlert = () => el.alert.classList.add('d-none');

        const urlCursos = () => `${endpoints.base}/cursos`;
        const urlSalones = (idCurso) => `${endpoints.base}/cursos/${idCurso}/salones`;
        const urlNotas = (idCurso, idSalon) => `${endpoints.base}/cursos/${idCurso}/salones/${idSalon}/notas`;

        const fetchJson = async (url) => {
            const r = await fetch(url, {
                headers: {
                    Accept: 'application/json'
                }
            });
            if (!r.ok) throw new Error('No se pudo cargar la información.');
            return r.json();
        };

        const renderCursos = async () => {
            hideAlert();
            el.cursos.innerHTML = '<div class="text-muted">Cargando cursos...</div>';

            try {
                const cursos = await fetchJson(urlCursos());

                if (!Array.isArray(cursos) || cursos.length === 0) {
                    el.cursos.innerHTML =
                        '<div class="col-12"><div class="alert alert-warning mb-0">No hay cursos con calificaciones.</div></div>';
                    return;
                }

                el.cursos.innerHTML = cursos.map((curso) => `
                <div class="col-md-4 col-lg-3">
                    <div class="course-card q-curso-btn" style="cursor:pointer;" data-id="${curso.id_curso}" data-nombre="${curso.materia}">
                        <div class="course-bar"></div>
                        <div class="p-3">
                            <h6 class="fw-bold mb-0">${curso.materia}</h6>
                        </div>
                    </div>
                </div>
            `).join('');

                document.querySelectorAll('.q-curso-btn').forEach((btn) => {
                    btn.addEventListener('click', () => {
                        state.curso = {
                            id: btn.dataset.id,
                            nombre: btn.dataset.nombre
                        };
                        renderSalones();
                    });
                });
            } catch (e) {
                showAlert(e.message || 'Error al cargar cursos.', 'danger');
            }
        };

        const renderSalones = async () => {
            if (!state.curso) return;

            hideAlert();
            el.salonesWrap.classList.remove('d-none');
            el.notasWrap.classList.add('d-none');
            el.cursoSel.textContent = `Curso seleccionado: ${state.curso.nombre}`;
            el.salones.innerHTML = '<div class="text-muted">Cargando salones...</div>';

            try {
                const salones = await fetchJson(urlSalones(state.curso.id));

                if (!Array.isArray(salones) || salones.length === 0) {
                    el.salones.innerHTML =
                        '<div class="col-12"><div class="alert alert-warning mb-0">No hay salones para este curso.</div></div>';
                    return;
                }

                el.salones.innerHTML = salones.map((salon) => `
                <div class="col-md-4 col-lg-3">
                    <div class="course-card q-salon-btn" style="cursor:pointer;" data-id="${salon.id_salon}" data-nombre="${salon.salon}">
                        <div class="course-bar"></div>
                        <div class="p-3">
                            <h6 class="fw-bold mb-0">${salon.salon}</h6>
                        </div>
                    </div>
                </div>
            `).join('');

                document.querySelectorAll('.q-salon-btn').forEach((btn) => {
                    btn.addEventListener('click', () => {
                        state.salon = {
                            id: btn.dataset.id,
                            nombre: btn.dataset.nombre
                        };
                        renderNotas();
                    });
                });
            } catch (e) {
                showAlert(e.message || 'Error al cargar salones.', 'danger');
            }
        };

        const renderNotas = async () => {
            if (!state.curso || !state.salon) return;

            hideAlert();
            el.notasWrap.classList.remove('d-none');
            el.salonSel.textContent = `Curso: ${state.curso.nombre} | Salón: ${state.salon.nombre}`;
            el.head.innerHTML = '<th>Cargando...</th>';
            el.body.innerHTML = '';

            try {
                const data = await fetchJson(urlNotas(state.curso.id, state.salon.id));
                const alumnos = data.alumnos || [];
                const actividades = data.actividades || [];
                const notas = data.notas || [];

                const notaMap = {};
                notas.forEach((n) => {
                    notaMap[`${n.id_alumno}-${n.id_curso_actividad}`] = n.nota;
                });

                let head = '<th>Alumno</th>';
                actividades.forEach((a) => {
                    head +=
                        `<th>${a.titulo}<br><small class="text-muted">${a.porcentaje ?? 0}%</small></th>`;
                });
                head += '<th>Promedio</th>';
                el.head.innerHTML = head;

                if (alumnos.length === 0) {
                    el.body.innerHTML =
                        `<tr><td colspan="${actividades.length + 2}" class="text-center text-muted">No hay alumnos para este salón.</td></tr>`;
                    return;
                }

                el.body.innerHTML = alumnos.map((alumno) => {
                    let total = 0;
                    let pesoTotal = 0;

                    const celdasNotas = actividades.map((a) => {
                        const key = `${alumno.id_alumno}-${a.id_curso_actividad}`;
                        const nota = notaMap[key];
                        const peso = Number(a.porcentaje ?? 0);

                        if (nota !== null && nota !== undefined && nota !== '') {
                            total += Number(nota) * (peso / 100);
                            pesoTotal += peso;
                        }

                        return `<td>${nota ?? '-'}</td>`;
                    }).join('');

                    const promedio = pesoTotal > 0 ? total.toFixed(2) : '-';

                    return `
                    <tr>
                        <td>${alumno.apellido} ${alumno.nombre}</td>
                        ${celdasNotas}
                        <td class="fw-bold">${promedio}</td>
                    </tr>
                `;
                }).join('');
            } catch (e) {
                showAlert(e.message || 'Error al cargar notas.', 'danger');
            }
        };

        el.volverCursos.addEventListener('click', () => {
            state.curso = null;
            state.salon = null;
            el.salonesWrap.classList.add('d-none');
            el.notasWrap.classList.add('d-none');
        });

        el.volverSalones.addEventListener('click', () => {
            state.salon = null;
            el.notasWrap.classList.add('d-none');
        });

        renderCursos();
    })();
</script>
<?php /**PATH C:\xampp\htdocs\laravel\Proyect_Next_Level\resources\views/partials/qualifications_dynamic.blade.php ENDPATH**/ ?>