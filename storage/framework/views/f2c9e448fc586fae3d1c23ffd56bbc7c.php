<?php $__env->startSection('title', 'Registro de Usuarios'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .form-control,
        .form-select {
            border-radius: 8px;
        }

        .fade-form {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .nav-tabs .nav-link.active {
            font-weight: 700;
            color: #0d6efd;
        }

        .section-title {
            font-size: .8rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: #6c757d;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">

        <h2 class="fw-bold mb-1">Registro de Usuarios</h2>
        <p class="text-muted mb-4 small">Registra alumnos o personal del sistema.</p>

        
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <button class="nav-link active" id="tab-alumno">👨‍🎓 Alumno</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-personal">🧑‍💼 Personal</button>
            </li>
        </ul>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger shadow-sm">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        
        <div id="form-alumno" class="fade-form">

            
            <div class="mb-4">
                <div class="d-flex justify-content-between small text-muted">
                    <span>Progreso</span>
                    <span id="pct-alumno">0%</span>
                </div>
                <div class="progress" style="height:6px">
                    <div id="bar-alumno" class="progress-bar"></div>
                </div>
            </div>

            <form method="POST" action="<?php echo e(route('admin.alumnos.store')); ?>" id="frmAlumno">
                <?php echo csrf_field(); ?>

                
                <div class="card p-3 mb-3">
                    <p class="section-title">Datos</p>
                    <div class="row g-3">
                        <div class="col-md-3"><input id="nombre_al" name="nombre" class="form-control" placeholder="Nombre"
                                required></div>
                        <div class="col-md-3"><input id="apellido_al" name="apellido" class="form-control"
                                placeholder="Apellido" required></div>
                        <div class="col-md-3"><input id="dni_al" name="dni" maxlength="8" class="form-control"
                                placeholder="DNI" required></div>
                        <div class="col-md-3"><input type="date" id="fecha_al" name="fecha_nacimiento"
                                class="form-control" required></div>
                    </div>
                </div>

                
                <div class="card p-3 mb-3">
                    <p class="section-title">Ubicación</p>
                    <div class="row g-3">

                        <div class="col-md-4">
                            <select id="nivel" name="id_nivel" class="form-select">
                                <option value="">Nivel</option>
                                <?php $__currentLoopData = $niveles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($n->id_nivel); ?>"><?php echo e($n->nivel); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-4 d-none" id="box-grado">
                            <select id="grado" name="id_grado" class="form-select"></select>
                        </div>

                        <div class="col-md-4 d-none" id="box-seccion">
                            <select id="seccion" name="id_seccion" class="form-select">
                                <?php $__currentLoopData = $secciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($s->id_seccion); ?>"><?php echo e($s->seccion); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-4 d-none" id="box-facultad">
                            <select id="facultad" name="id_facultad" class="form-select">
                                <?php $__currentLoopData = $facultades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($f->id_facultad); ?>"><?php echo e($f->facultad); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                    </div>
                </div>

                
                <div class="card p-3 mb-3">
                    <p class="section-title">Cuenta</p>
                    <div class="row g-3">
                        <div class="col-md-6"><input id="user_al" name="usuario" class="form-control bg-light" >
                        </div>
                        <div class="col-md-6"><input id="pass_al" name="contrasena" class="form-control bg-light"
                                readonly></div>
                    </div>
                </div>

                
                <div class="card p-3 mb-3">
                    <label><input type="checkbox" id="chkApoderado"> Registrar apoderado</label>

                    <div id="bloque-apoderado" class="d-none mt-3">
                        <div class="row g-3">
                            <div class="col-md-4"><input id="apoderado_nombre" name="apoderado_nombre" class="form-control"
                                    placeholder="Nombre">
                            </div>
                            <div class="col-md-4"><input id="apoderado_apellido" name="apoderado_apellido"
                                    class="form-control" placeholder="Apellido"></div>
                            <div class="col-md-4"><input id="apoderado_dni" name="apoderado_dni" maxlength="8"
                                    class="form-control" placeholder="DNI"></div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary" id="btnAlumno" disabled>Registrar Alumno</button>
            </form>
        </div>

        
        <div id="form-personal" class="fade-form d-none">

            <form action="<?php echo e(route('admin.users.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="card p-3 mb-3">
                    <div class="row g-3">
                        <div class="col-md-3"><input id="nombre_per" name="nombre" class="form-control"
                                placeholder="Nombre"></div>
                        <div class="col-md-3"><input id="apellido_per" name="apellido" class="form-control"
                                placeholder="Apellido"></div>
                        <div class="col-md-3"><input id="dni_per" name="dni" class="form-control"
                                placeholder="DNI"></div>
                        <div class="col-md-3"><input type="date" id="fecha_per" name="fecha_nacimiento"
                                class="form-control"></div>
                    </div>
                </div>

                <div class="card p-3 mb-3">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <select name="rol" id="cargo" class="form-select">
                                <option value="administrador">Administrador</option>
                                <option value="docente">Docente</option>
                                <option value="auxiliar">Auxiliar</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <select name="id_curso" id="id_curso" class="form-select">
                                <option value="">Materia</option>
                                <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($c->id_curso); ?>"><?php echo e($c->materia); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-2"><input id="user_per" name="usuario" class="form-control" ></div>
                        <div class="col-md-2"><input id="pass_per" name="contrasena" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <button class="btn btn-secondary">Guardar</button>
            </form>
        </div>

    </div>

    
    <script>
        let modalidad = 'colegio';
        document.addEventListener('DOMContentLoaded', () => {
            const formAlumno = document.getElementById('form-alumno');
            const formPersonal = document.getElementById('form-personal');

            const tabAlumno = document.getElementById('tab-alumno');
            const tabPersonal = document.getElementById('tab-personal');

            const nivel = document.getElementById('nivel');
            const boxGrado = document.getElementById('box-grado');
            const boxSeccion = document.getElementById('box-seccion');
            const boxFacultad = document.getElementById('box-facultad');
            const chkApoderado = document.getElementById('chkApoderado');
            const bloqueApoderado = document.getElementById('bloque-apoderado');

            document.getElementById('frmAlumno').addEventListener('submit', function() {

                const grado = document.getElementById('grado');
                const seccion = document.getElementById('seccion');
                const facultad = document.getElementById('facultad');

                if (modalidad === 'academia') {

                    if (grado) grado.value = '';
                    if (seccion) seccion.value = '';

                } else {

                    if (facultad) facultad.value = '';
                }
            });

            const tabHandler = (showForm, hideForm, activeTab, inactiveTab) => {
                showForm.classList.remove('d-none');
                hideForm.classList.add('d-none');
                activeTab.classList.add('active');
                inactiveTab.classList.remove('active');
            };

            tabAlumno.onclick = () => tabHandler(formAlumno, formPersonal, tabAlumno, tabPersonal);
            tabPersonal.onclick = () => tabHandler(formPersonal, formAlumno, tabPersonal, tabAlumno);

            function vincular(dniId, fechaId, userId, passId) {
                const dni = document.getElementById(dniId);
                const fecha = document.getElementById(fechaId);
                const user = document.getElementById(userId);
                const pass = document.getElementById(passId);

                if (!dni || !fecha || !user || !pass) return;

                // dni.addEventListener('input', () => {
                //     user.value = dni.value + '@nextlevel.Academy.pe';
                // });

                fecha.addEventListener('change', () => {
                    if (!fecha.value) {
                        pass.value = '';
                        return;
                    }
                    let [y, m, d] = fecha.value.split('-');
                    pass.value = d + m + y;
                });
            }

            vincular('dni_al', 'fecha_al', 'user_al', 'pass_al');
            vincular('dni_per', 'fecha_per', 'user_per', 'pass_per');

            const isVisible = element => {
                return element && element.offsetParent !== null && window.getComputedStyle(element).display !==
                    'none';
            };

            function calcularProgreso() {

                const campos = ['nombre_al', 'apellido_al', 'dni_al', 'fecha_al', 'nivel'];

                if (modalidad === 'colegio') {
                    campos.push('grado', 'seccion');
                }

                if (modalidad === 'academia') {
                    campos.push('facultad');
                }

                if (chkApoderado && chkApoderado.checked) {
                    campos.push('apoderado_nombre', 'apoderado_apellido', 'apoderado_dni');
                }

                let llenos = 0;

                campos.forEach(id => {
                    const el = document.getElementById(id);
                    if (el && el.value.trim() !== '') {
                        llenos++;
                    }
                });

                const porcentaje = Math.round((llenos / campos.length) * 100);

                document.getElementById('pct-alumno').innerText = porcentaje + '%';
                document.getElementById('bar-alumno').style.width = porcentaje + '%';
                document.getElementById('btnAlumno').disabled = porcentaje < 100;
            }


            const campos = ['nombre_al', 'apellido_al', 'dni_al', 'fecha_al', 'nivel', 'grado', 'seccion',
                'facultad', 'apoderado_nombre', 'apoderado_apellido', 'apoderado_dni'
            ];

            campos.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', calcularProgreso);
                    el.addEventListener('change', calcularProgreso);
                }
            });

            if (chkApoderado) {
                chkApoderado.addEventListener('change', () => {
                    if (bloqueApoderado) {
                        bloqueApoderado.classList.toggle('d-none', !chkApoderado.checked);
                    }
                    calcularProgreso();
                });
            }

            if (nivel) {
                nivel.addEventListener('change', function() {

                    const idNivel = this.value;

                    modalidad = (idNivel == 1 || idNivel == 2) ? 'colegio' : 'academia';

                    // =========================
                    // GRADO SOLO COLEGIO
                    // =========================
                    if (boxGrado) {
                        if (modalidad === 'colegio' && idNivel !== '') {
                            boxGrado.classList.remove('d-none');
                        } else {
                            boxGrado.classList.add('d-none');
                        }
                    }

                    // =========================
                    // SECCIÓN / FACULTAD
                    // =========================
                    if (idNivel !== '') {

                        if (modalidad === 'colegio') {

                            if (boxSeccion) boxSeccion.classList.remove('d-none');
                            if (boxFacultad) boxFacultad.classList.add('d-none');

                        } else {

                            if (boxSeccion) boxSeccion.classList.add('d-none');
                            if (boxFacultad) boxFacultad.classList.remove('d-none');
                        }

                    } else {
                        if (boxSeccion) boxSeccion.classList.add('d-none');
                        if (boxFacultad) boxFacultad.classList.add('d-none');
                    }

                    // =========================
                    // LIMPIAR GRADO
                    // =========================
                    const grado = document.getElementById('grado');
                    if (grado) {
                        grado.innerHTML = '<option value="">Grado</option>';
                    }

                    if (idNivel && grado) {
                        fetch(`/admin/grados/${idNivel}`)
                            .then(res => res.json())
                            .then(data => {

                                data.forEach(g => {
                                    grado.innerHTML +=
                                        `<option value="${g.id_grado}">${g.grado}</option>`;
                                });

                                calcularProgreso();
                            })
                            .catch(() => calcularProgreso());

                    } else {
                        calcularProgreso();
                    }
                });
            }

            calcularProgreso();
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.Adminlanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\Proyect_Next_Level\resources\views/Admin/users.blade.php ENDPATH**/ ?>