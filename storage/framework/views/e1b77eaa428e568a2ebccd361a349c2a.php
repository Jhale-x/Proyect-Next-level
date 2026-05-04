<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/alumno/cursos.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', 'Mis Cursos - Next Level'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h2>Mis Cursos</h2>
                <p>Estos son los cursos asignados para el año académico <?php echo e(date('Y')); ?></p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <?php $__empty_1 = true; $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="course-card">
                    <div class="course-icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <div class="course-info">
                        <h4><?php echo e($curso->nombre ?? $curso->materia ?? 'Curso sin nombre'); ?></h4>
                        <p>Docente: <?php echo e($curso->docente ?? 'No asignado'); ?></p>
                    </div>
                    <a href="<?php echo e(route('alumno.courses.show', $curso->id_curso ?? $curso->id)); ?>" class="btn-course">Ver Curso</a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="alert alert-info">No tienes cursos asignados aún.</div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Alumnoslanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Proyect-Next-level\resources\views/Alumno/courses.blade.php ENDPATH**/ ?>