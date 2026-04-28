 

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/alumno/eti.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', 'ETI - Next Level'); ?>

<?php $__env->startSection('content'); ?>
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

    <!-- Información del Alumno -->
    <div class="card shadow-sm border-0 mb-4 bg-gradient-primary">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="mb-2"><?php echo e($alumno->nombre); ?> <?php echo e($alumno->apellido); ?></h4>
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-muted">Nivel</small>
                            <p class="fw-bold mb-0"><?php echo e($nivel ?? 'No asignado'); ?></p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Grado</small>
                            <p class="fw-bold mb-0"><?php echo e($grado ?? 'No asignado'); ?></p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Sección</small>
                            <p class="fw-bold mb-0"><?php echo e($seccion ?? 'No asignado'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="bg-white rounded p-3 d-inline-block">
                        <small class="text-muted">Promedio General</small>
                        <h3 class="mb-0 <?php echo e($promedioGeneral >= 13 ? 'text-success' : 'text-danger'); ?>">
                            <?php echo e(number_format($promedioGeneral, 1)); ?>

                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Notas por Semana -->
    <div class="card shadow-sm border-0 overflow-hidden">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0"><i class="bi bi-pencil-square me-2"></i>Registro de Notas por Semanas</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th class="text-start ps-4" style="min-width: 200px;">Evaluación</th>
                            <?php for($i = 1; $i <= 10; $i++): ?>
                                <th class="border-start">Semana <?php echo e($i); ?></th>
                            <?php endfor; ?>
                            <th class="bg-primary text-white">Promedio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $materias = [
                                'Matemática',
                                'Comunicación',
                                'Ciencia y Tecnología',
                                'Personal Social',
                                'Inglés'
                            ];
                        ?>
                        
                        <?php $__currentLoopData = $materias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $materia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $notasMateria = $notas[$materia] ?? array_fill(1, 10, null);
                                $promedioMateria = collect($notasMateria)->filter()->avg();
                            ?>
                            <tr>
                                <td class="text-start ps-4 fw-bold text-secondary"><?php echo e($materia); ?></td>
                                <?php for($semana = 1; $semana <= 10; $semana++): ?>
                                    <td class="text-center border-start">
                                        <?php if(isset($notasMateria[$semana])): ?>
                                            <span class="badge <?php echo e($notasMateria[$semana] >= 13 ? 'bg-success' : 'bg-danger'); ?> px-3 py-2">
                                                <?php echo e($notasMateria[$semana]); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted">--</span>
                                        <?php endif; ?>
                                    </td>
                                <?php endfor; ?>
                                <td class="text-center fw-bold bg-light">
                                    <?php if($promedioMateria): ?>
                                        <span class="<?php echo e($promedioMateria >= 13 ? 'text-success' : 'text-danger'); ?>">
                                            <?php echo e(number_format($promedioMateria, 1)); ?>

                                        </span>
                                    <?php else: ?>
                                        --
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot class="table-secondary">
                        <tr>
                            <th class="text-start ps-4">PROMEDIO POR SEMANA</th>
                            <?php for($semana = 1; $semana <= 10; $semana++): ?>
                                <?php
                                    $sumaSemana = 0;
                                    $countSemana = 0;
                                    foreach($materias as $materia) {
                                        if(isset($notas[$materia][$semana])) {
                                            $sumaSemana += $notas[$materia][$semana];
                                            $countSemana++;
                                        }
                                    }
                                    $promedioSemana = $countSemana > 0 ? $sumaSemana / $countSemana : null;
                                ?>
                                <th class="text-center border-start">
                                    <?php if($promedioSemana): ?>
                                        <span class="<?php echo e($promedioSemana >= 13 ? 'text-success' : 'text-danger'); ?>">
                                            <?php echo e(number_format($promedioSemana, 1)); ?>

                                        </span>
                                    <?php else: ?>
                                        --
                                    <?php endif; ?>
                                </th>
                            <?php endfor; ?>
                            <th class="bg-primary text-white">
                                <?php echo e(number_format($promedioGeneral, 1)); ?>

                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Alumnoslanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Proyect-Next-level\resources\views/Alumno/eti.blade.php ENDPATH**/ ?>