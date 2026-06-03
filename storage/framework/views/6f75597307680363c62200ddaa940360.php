<?php $__env->startSection('content'); ?>
    <div class="container py-4">

        <div class="d-flex flex-wrap gap-2 mb-4">
            <h3 class="fw-bold me-auto">📚 Cursos</h3>

            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalCurso">
                ➕ Registrar Curso
            </button>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNivel">Nivel</button>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGrado">Grado</button>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSeccion">Sección</button>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFacultad">Facultad</button>

        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('warning')): ?>
            <div class="alert alert-warning"><?php echo e(session('warning')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- ================= VISTAS ================= -->
        <div class="views-container">

            <!-- ================= VISTA CURSOS ================= -->
            <div id="vista-materias" class="view active">
                <div class="row g-3">
                    <?php $__currentLoopData = $cursos ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 col-lg-3">
                            <div class="course-card"
                                onclick="abrirMateria('<?php echo e($curso->materia); ?>', <?php echo e($curso->id_curso); ?>)">
                                <div class="course-bar"></div>
                                <div class="p-3">
                                    <h6 class="fw-bold d-flex align-items-center gap-2">
                                        <?php
                                            $materia = strtolower($curso->materia);
                                            $icono = match (true) {
                                                str_contains($materia, 'matem') => '📊',
                                                str_contains($materia, 'comuni') ||
                                                    str_contains($materia, 'leng') ||
                                                    str_contains($materia, 'liter')
                                                    => '📝',
                                                str_contains($materia, 'cienc') ||
                                                    str_contains($materia, 'biol') ||
                                                    str_contains($materia, 'quim') ||
                                                    str_contains($materia, 'fis')
                                                    => '🔬',
                                                str_contains($materia, 'histo') ||
                                                    str_contains($materia, 'geog') ||
                                                    str_contains($materia, 'social')
                                                    => '🌍',
                                                str_contains($materia, 'ingl') || str_contains($materia, 'idio')
                                                    => '🌐',
                                                str_contains($materia, 'arte') || str_contains($materia, 'musi')
                                                    => '🎨',
                                                str_contains($materia, 'educ') && str_contains($materia, 'fis') => '⚽',
                                                str_contains($materia, 'comput') ||
                                                    str_contains($materia, 'tecno') ||
                                                    str_contains($materia, 'inform')
                                                    => '💻',
                                                default => '📘',
                                            };
                                        ?>
                                        <?php echo e($icono); ?> <?php echo e($curso->materia); ?>

                                    </h6>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>

            <!-- ================= VISTA DOCENTES ================= -->
            <div id="vista-docentes" class="view">

                <a href="javascript:void(0)" class="btn-back" onclick="volverMaterias()">← Volver</a>

                <div id="banner-materia" class="course-header-banner shadow-sm">
                    <h1 id="titulo-materia" class="display-5 fw-bold mb-0"></h1>
                </div>

                <!-- 🔥 BOTÓN SOLO CUANDO ESTÁS DENTRO DEL CURSO -->
                <div class="d-flex gap-2 mb-3">

                    <!-- NUEVA -->
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalActividad">
                        ➕ Registrar Actividad
                    </button>

                    <!-- EXISTENTE -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAsignarActividad">
                        📌 Asignar Actividad
                    </button>

                </div>


                <div class="row g-4 mt-4" id="lista-docentes-materia"></div>

            </div>


            <!-- ================= VISTA SALONES DOCENTE ================= -->
            <div id="vista-salones-docente" class="view">
                <a class="btn-back" onclick="volverDocentes()">← Volver</a>

                <div id="banner-docente" class="course-header-banner">
                    <h1 id="titulo-docente"></h1>
                </div>

                <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modalAsignarSalones">
                    ➕ Asignar Salón
                </button>

                <div class="row g-4" id="lista-salones-docente"></div>
            </div>
            <!-- ================= VISTA DETALLE SALON ================= -->
            <div id="vista-detalle" class="view">

                <!-- Excel actions (export / import) -->
                <div id="excel-actions" class="mb-3 text-end">
                    <form id="export-form" action="" method="GET" class="d-inline">
                        <button class="btn btn-outline-success btn-sm">
                            📥 Descargar Excel
                        </button>
                    </form>
                    <form id="import-form" action="" method="POST" enctype="multipart/form-data"
                        class="d-inline-block ms-2">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id_curso" id="import_curso_id">
                        <input type="file" name="excel" accept=".xlsx,.xls" required
                            class="form-control form-control-sm d-inline-block w-auto">
                        <button class="btn btn-outline-primary btn-sm">📤 Subir Excel</button>
                    </form>
                </div>

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-0">

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">
                                    <tr id="cabecera-actividades"></tr>
                                </thead>

                                <tbody id="tabla-alumnos"></tbody>

                            </table>
                        </div>

                    </div>
                </div>

                <div class="mt-3 text-end">
                    <button class="btn btn-secondary" onclick="cerrarRegistroExcel()">Cerrar</button>
                    <button class="btn btn-success" id="btn-guardar-notas">Guardar</button>
                </div>

            </div>
        </div><!-- /.views-container -->
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/admin/course.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('modals'); ?>
    <!-- MODAL REGISTRO NIVELES -->
    <div class="modal fade" id="modalNivel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?php echo e(route('admin.niveles.storeMultiple')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Niveles</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div id="contenedor-niveles">
                            <div class="input-group mb-2">
                                <input type="text" name="niveles[]" class="form-control"
                                    placeholder="Nombre del nivel" required>
                                <button type="button" class="btn btn-danger eliminar">X</button>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary w-100 mt-2" id="agregarNivel">
                            ➕ Agregar otro
                        </button>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success w-100">
                            Guardar
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- MODAL REGISTRO SECCIONES -->
    <div class="modal fade" id="modalSeccion" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?php echo e(route('admin.secciones.storeMultiple')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Secciones</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div id="contenedor-secciones">
                            <div class="input-group mb-2">
                                <input type="text" name="secciones[]" class="form-control"
                                    placeholder="Nombre de la sección" required>
                                <button type="button" class="btn btn-danger eliminar-seccion">X</button>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary w-100 mt-2" id="agregarSeccion">
                            ➕ Agregar otra
                        </button>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success w-100">
                            Guardar
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- MODAL REGISTRO GRADOS -->
    <div class="modal fade" id="modalGrado" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?php echo e(route('admin.grados.storeMultiple')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Grados</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div id="contenedor-grados"></div>

                        <button type="button" class="btn btn-secondary w-100 mt-2" id="agregarGrado">
                            ➕ Agregar otro
                        </button>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success w-100">
                            Guardar
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <script type="text/template" id="template-grado">
        <div class="bloque-grado border p-3 mb-3 rounded bg-light">

            <label class="form-label">Nivel</label>
            <select class="form-control mb-2 select-nivel" name="grados[][id_nivel]">
                <option value="">Seleccione un nivel</option>
                <?php $__currentLoopData = $niveles ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nivel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($nivel->id_nivel); ?>">
                        <?php echo e($nivel->nivel); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <label class="form-label">Nombre del Grado</label>
            <input type="text" class="form-control mb-2 input-grado"
                name="grados[][grado]" placeholder="Ej: Primero, Segundo, etc" required>

            <button type="button" class="btn btn-danger btn-eliminar w-100">
                Eliminar
            </button>

        </div>
    </script>
    <!-- MODAL REGISTRO FACULTADES -->
    <div class="modal fade" id="modalFacultad" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?php echo e(route('admin.facultades.storeMultiple')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Facultades</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div id="contenedor-facultades"></div>

                        <button type="button" class="btn btn-secondary w-100 mt-2" id="agregarFacultad">
                            ➕ Agregar otra
                        </button>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success w-100">
                            Guardar
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <script type="text/template" id="template-facultad">
        <div class="bloque-facultad border p-3 mb-3 rounded bg-light">

            <label class="form-label">Nombre de la Facultad</label>
            <input type="text" class="form-control mb-2 input-facultad"
                name="facultades[]" placeholder="Ej: Ingeniería, Medicina" required>

            <button type="button" class="btn btn-danger btn-eliminar-facultad w-100">
                Eliminar
            </button>

        </div>
    </script>
    <!-- ================= MODAL REGISTRO ACTIVIDAD ================= -->
    <div class="modal fade" id="modalActividad">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?php echo e(route('admin.activities.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Actividad</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <!-- curso seleccionado -->
                        <input type="hidden" name="id_curso" id="actividad_curso_id">
                        <div class="mb-3">
                            <span class="text-muted">Curso seleccionado: <strong
                                    id="actividad_modal_curso_name">ninguno</strong></span>
                        </div>

                        <div class="mb-3">
                            <label>Nombre</label>
                            <input type="text" name="actividad" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Descripción</label>
                            <textarea name="descripcion" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Porcentaje</label>
                            <input type="number" name="porcentaje" class="form-control" min="1" max="100"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Fecha de entrega</label>
                            <input type="date" name="fecha_entrega" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success">Guardar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- ================= MODAL ASIGNAR ACTIVIDAD ================= -->
    <div class="modal fade" id="modalAsignarActividad">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?php echo e(route('admin.activities.asignar')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="modal-header">
                        <h5>Asignar Actividad</h5>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" name="id_curso" id="asignar_curso_id">

                        <div class="mb-3">
                            <span class="text-muted">Curso seleccionado: <strong
                                    id="asignar_modal_curso_name">ninguno</strong></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Actividad existente</label>
                            <select name="id_actividad" class="form-select" required>
                                <?php $__currentLoopData = $actividades ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actividad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($actividad->id_actividad); ?>">
                                        <?php echo e($actividad->actividad); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha de entrega</label>
                            <input type="date" name="fecha_entrega" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hora de entrega</label>
                            <input type="time" name="hora_entrega" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Asignar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <!-- ================= MODAL ASIGNAR SALONES ================= -->
    <div class="modal fade" id="modalAsignarSalones">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Asignar Salones al Docente</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="<?php echo e(route('admin.courses.asignarSalones')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="modal-body">
                        <input type="hidden" name="docente_id" id="docente_id">
                        <input type="hidden" name="id_curso" id="salones_asignar_curso_id">

                        <div class="mb-3">
                            <span class="text-muted">Curso seleccionado: <strong
                                    id="salones_modal_curso_name">ninguno</strong></span>
                        </div>
                        <h6>Primaria</h6>
                        <div class="row g-2 mb-3">
                            <?php $__currentLoopData = $salonesPrimaria ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-3">
                                    <label class="card p-2 salon-card">
                                        <input type="checkbox" name="salones[]" value="<?php echo e($salon->id_salon); ?>">
                                        <?php echo e($salon->grado?->grado); ?> - <?php echo e($salon->seccion?->seccion); ?>

                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <h6>Secundaria</h6>
                        <div class="row g-2">
                            <?php $__currentLoopData = $salonesSecundaria ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-3">
                                    <label class="card p-2 salon-card">
                                        <input type="checkbox" name="salones[]" value="<?php echo e($salon->id_salon); ?>">
                                        <?php echo e($salon->grado?->grado); ?> - <?php echo e($salon->seccion?->seccion); ?>

                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <h6>Facultades</h6>
                        <div class="row g-2">
                            <?php $__currentLoopData = $facultadesAcademia ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-3">
                                    <label class="card p-2 salon-card">
                                        <input type="checkbox" name="salones[]" value="<?php echo e($salon->id_salon); ?>">
                                        <?php echo e($salon->facultad?->facultad); ?>

                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success">Guardar asignación</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditarFecha" tabindex="-1" aria-labelledby="modalEditarFechaLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarFechaLabel">Editar fecha de entrega</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id_curso_actividad" name="id_curso_actividad">

                    <div class="mb-3">
                        <label for="edit_nombre_actividad" class="form-label">Actividad</label>
                        <input type="text" id="edit_nombre_actividad" name="nombre_actividad" class="form-control"
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label for="edit_porcentaje" class="form-label">Porcentaje</label>
                        <input type="number" id="edit_porcentaje" name="porcentaje"
                            class="form-control input-porcentaje" data-id="" min="0" max="100"
                            step="1">
                    </div>

                    <div class="mb-3">
                        <label for="edit_fecha_entrega" class="form-label">Fecha de entrega</label>
                        <input type="date" id="edit_fecha_entrega" name="fecha_entrega" class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_hora_entrega" class="form-label">Hora de entrega</label>
                        <input type="time" id="edit_hora_entrega" name="hora_entrega" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-guardar-fecha">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCurso" tabindex="-1" aria-labelledby="modalCursoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalCursoLabel">Registrar Curso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="<?php echo e(route('admin.courses.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label>Materia</label>
                        <input type="text" name="materia" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </form>

            </div>
        </div>
    </div>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.Adminlanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\Proyect_Next_Level\resources\views/Admin/courses.blade.php ENDPATH**/ ?>