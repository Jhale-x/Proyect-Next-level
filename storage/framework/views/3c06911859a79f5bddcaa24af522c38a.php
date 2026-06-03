<?php $__env->startSection('title', 'Mis Cursos'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/alumno/cursos.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container py-4">

        <h3 class="fw-bold mb-4">
            📚 Mis Cursos
        </h3>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- CURSOS -->
        <div id="vista-cursos">

            <div class="row g-4">

                <?php $__empty_1 = true; $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-4 col-lg-3">

                        <div class="course-card" onclick='abrirCurso(<?php echo e($curso->id_curso); ?>, <?php echo json_encode($curso->materia, 15, 512) ?>)'>

                            <div class="course-bar"></div>

                            <div class="course-content">

                                <h5 class="course-title">
                                    <?php echo e($curso->materia); ?>

                                </h5>

                                <p class="course-subtitle">
                                    Ver actividades y notas
                                </p>

                            </div>

                        </div>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <div class="col-12">

                        <div class="empty-state">

                            <div class="empty-icon">
                                📚
                            </div>

                            <h4>No tienes cursos asignados</h4>

                            <p>Cuando tus docentes asignen cursos aparecerán aquí.</p>

                        </div>

                    </div>
                <?php endif; ?>

            </div>

        </div>

        <!-- DETALLE CURSO -->
        <div id="vista-detalle" class="d-none">

            <button class="btn-back mb-3" onclick="volverCursos()">
                ← Volver a cursos
            </button>

            <div class="course-header-banner">

                <h2 id="titulo-curso"></h2>

                <p class="mb-0">
                    Actividades registradas y calificaciones
                </p>

            </div>

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table align-middle">

                            <thead>
                                <tr>
                                    <th>Actividad</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Nota</th>
                                </tr>
                            </thead>

                            <tbody id="tabla-actividades">

                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Selecciona un curso
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                    <div class="promedio-box">

                        <span>Promedio General:</span>

                        <span id="promedio-general">
                            -
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/alumno/cursos.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.Alumnoslanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\Proyect_Next_Level\resources\views/Alumno/courses.blade.php ENDPATH**/ ?>