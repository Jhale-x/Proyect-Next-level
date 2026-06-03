<?php $__env->startSection('title', 'Calificaciones'); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $qualificationsEndpoints = [
            'base' => url('/docente/qualifications'),
        ];
    ?>

    <?php echo $__env->make('partials.qualifications_dynamic', ['qualificationsEndpoints' => $qualificationsEndpoints], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.Docentelanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\Proyect_Next_Level\resources\views/Docentes/qualifications.blade.php ENDPATH**/ ?>