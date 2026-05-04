

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/alumno/detalle_cursos.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', $curso->nombre . ' - Next Level'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="course-header">
        <h2><?php echo e($curso->nombre); ?></h2>
        <p>Docente: <?php echo e($curso->docente ?? 'No asignado'); ?></p>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="content-card">
                <h3>Contenido del Curso</h3>
                <p>Bienvenido al curso de <?php echo e($curso->nombre); ?>.</p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Alumnoslanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Proyect-Next-level\resources\views/Alumno/course_detail.blade.php ENDPATH**/ ?>