<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/alumno/calificaciones.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('title', 'Calificaciones por Semestre'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $semestres = [
        1 => [
            [
                'id' => 1,
                'codigo' => '202602-INGL-155-TEC-NRC_76',
                'nombre'    => 'BASIC 4',
                'notas' => [
                    ['titulo' => 'Speaking 1', 'nota' => 14],
                    ['titulo' => 'Speaking 2', 'nota' => 15],
                    ['titulo' => 'Final Project', 'nota' => 16],
                    ['titulo' => 'Attendance', 'nota' => '87.5 %'],
                ]
            ],
            [
                'id' => 2,
                'codigo' => '202602-MATE-210-TEC',
                'nombre' => 'Matemática Aplicada',
                'notas' => [
                    ['titulo' => 'Práctica 1', 'nota' => 18],
                    ['titulo' => 'Examen Parcial', 'nota' => 17],
                ]
            ],
        ],
        2 => [
            [
                'id' => 3,
                'codigo' => 'PREVENCION-202510-38',
                'nombre' => 'Prevención de Accidentes',
                'notas' => []
            ],
            [
                'id' => 4,
                'codigo' => 'PROG-202510-101',
                'nombre' => 'Programación I',
                'notas' => [
                    ['titulo' => 'Algoritmos', 'nota' => 19],
                    ['titulo' => 'POO', 'nota' => 18],
                ]
            ],
        ],
        3 => [
            [
                'id' => 5,
                'codigo' => 'FISICA-303-202410',
                'nombre' => 'Física General',
                'notas' => [
                    ['titulo' => 'Cinemática', 'nota' => 16],
                    ['titulo' => 'Dinámica', 'nota' => 15],
                    ['titulo' => 'Termodinámica', 'nota' => 14],
                ]
            ],
        ],
        4 => [
            [
                'id' => 6,
                'codigo' => 'ESTADISTICA-404-202410',
                'nombre' => 'Estadística Aplicada',
                'notas' => [
                    ['titulo' => 'Probabilidades', 'nota' => 17],
                    ['titulo' => 'Distribuciones', 'nota' => 18],
                ]
            ],
        ],
    ];
?>

<div class="container mt-3">
    <h3 class="mb-5">📊 Calificaciones por Semestre</h3>

    <?php $__currentLoopData = $semestres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $num => $cursos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <h5 class="mt-4 mb-3 text-primary">Semestre <?php echo e($num); ?></h5>

        <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-2 shadow-sm"
                 data-bs-toggle="offcanvas"
                 data-bs-target="#panelCurso<?php echo e($curso['id']); ?>"
                 style="cursor:pointer;">

                <div class="card-header py-2 border-top border-3 border-primary">
                    <small class="text-muted"><?php echo e($curso['codigo']); ?></small>
                    <h6 class="mb-0"><?php echo e($curso['nombre']); ?></h6>
                </div>

                <div class="card-body py-2">
                    <p class="fw-bold mb-1">Calificaciones recientes</p>

                    <?php $__empty_1 = true; $__currentLoopData = array_slice($curso['notas'], 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="d-flex justify-content-between border-bottom py-1">
                            <span>📝 <?php echo e($nota['titulo']); ?></span>
                            <span class="badge bg-dark"><?php echo e($nota['nota']); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-muted small mb-0">Aún no hay calificaciones.</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Panel lateral -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="panelCurso<?php echo e($curso['id']); ?>">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title"><?php echo e($curso['nombre']); ?> - Calificaciones</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>

                <div class="offcanvas-body">
                    <ul class="list-group">
                        <?php $__empty_1 = true; $__currentLoopData = $curso['notas']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><?php echo e($nota['titulo']); ?></span>
                                <span class="badge bg-primary"><?php echo e($nota['nota']); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="list-group-item text-muted">No hay notas registradas</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.Alumnoslanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Proyect-Next-level\resources\views/Alumno/qualifications.blade.php ENDPATH**/ ?>