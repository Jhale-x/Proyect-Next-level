<?php $__env->startSection('title', 'Calendario'); ?>

<?php $__env->startSection('content'); ?>
<?php
    use Carbon\Carbon;

    $fecha = request('fecha')
        ? Carbon::parse(request('fecha'))
        : Carbon::now();

    $inicioSemana = $fecha->copy()->startOfWeek(Carbon::MONDAY);

    // ====== "BASE DE DATOS" SIMULADA ======
    $actividades = [
        [
            'curso' => 'BASIC 4',
            'titulo' => 'Speaking 3',
            'fecha' => $fecha->toDateString(),
            'hora'  => 9,
        ],
        [
            'curso' => 'Programación I',
            'titulo' => 'Entrega POO',
            'fecha' => $fecha->toDateString(),
            'hora'  => 14,
        ],
        [
            'curso' => 'Matemática Aplicada',
            'titulo' => 'Práctica 2',
            'fecha' => $fecha->toDateString(),
            'hora'  => 20,
        ],
    ];
?>

<div class="container-fluid px-2">

    <h4 class="mb-3">📆 Calendario</h4>

    <!-- Barra superior -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <button class="btn btn-sm btn-dark">Programar</button>
        </div>

        <div class="fw-semibold">
            <?php echo e($fecha->translatedFormat('d M Y')); ?>

        </div>

        <div>
            <a href="?fecha=<?php echo e($fecha->copy()->subDay()->toDateString()); ?>" class="btn btn-sm btn-outline-dark">◀</a>
            <a href="?fecha=<?php echo e(Carbon::now()->toDateString()); ?>" class="btn btn-sm btn-outline-secondary">Hoy</a>
            <a href="?fecha=<?php echo e($fecha->copy()->addDay()->toDateString()); ?>" class="btn btn-sm btn-outline-dark">▶</a>
        </div>
    </div>

    <!-- Días semana -->
    <div class="d-flex justify-content-between text-center border-bottom pb-2 mb-2">
        <?php for($i = 0; $i < 7; $i++): ?>
            <?php $dia = $inicioSemana->copy()->addDays($i); ?>
            <div class="flex-fill <?php echo e($dia->isSameDay($fecha) ? 'text-primary fw-bold' : ''); ?>">
                <?php echo e(strtoupper($dia->translatedFormat('D'))); ?><br>
                <?php if($dia->isSameDay($fecha)): ?>
                    <span class="badge rounded-circle bg-primary"><?php echo e($dia->day); ?></span>
                <?php else: ?>
                    <small><?php echo e($dia->day); ?></small>
                <?php endif; ?>
            </div>
        <?php endfor; ?>
    </div>

    <!-- Agenda por horas con eventos -->
    <div class="mt-3">
        <?php for($i = 0; $i < 24; $i++): ?>
            <div class="d-flex border-bottom py-2 align-items-start">
                <div style="width:60px" class="text-muted text-end pe-2">
                    <?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>:00
                </div>

                <div class="flex-fill">
                    <?php $__currentLoopData = $actividades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($act['fecha'] === $fecha->toDateString() && $act['hora'] === $i): ?>
                            <div class="alert alert-primary py-1 px-2 mb-1">
                                <strong><?php echo e($act['curso']); ?></strong><br>
                                <small>📌 <?php echo e($act['titulo']); ?></small>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endfor; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.Alumnoslanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Proyect-Next-level\resources\views/Alumno/calendar.blade.php ENDPATH**/ ?>