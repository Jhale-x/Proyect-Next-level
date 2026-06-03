<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/docente/activityDocente.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', 'Actividad - Docente'); ?>

<?php $__env->startSection('content'); ?>

    <?php
        use Carbon\Carbon;
    ?>

    <div class="activity-wrapper">

        <!-- Header -->
        <div class="header">
            <h1>Actividad Académica</h1>

            <div class="settings-icon">
                <i class="bi bi-funnel-fill"></i>
            </div>
        </div>

        <!-- Filtros -->
        <div class="filters">

            <select class="filter-select" id="filter-type">
                <option value="all">Todas las actividades</option>
                <option value="tarea">Tareas</option>
                <option value="anuncio">Anuncios</option>
                <option value="comunicacion">Comunicación</option>
            </select>

            <select class="filter-select" id="filter-date">
                <option value="all">Todas las fechas</option>
                <option value="today">Hoy</option>
                <option value="week">Últimos 7 días</option>
                <option value="month">Último mes</option>
            </select>

        </div>

        <!-- Timeline -->
        <div class="timeline-container">
            <div class="timeline">

                <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $texto = mb_strtolower(($act->actividad ?? '') . ' ' . ($act->descripcion ?? ''));

                        $tipo = 'comunicacion';
                        $color = 'blue';
                        $icon = '💬';

                        if (
                            str_contains($texto, 'tarea') ||
                            str_contains($texto, 'trabajo') ||
                            str_contains($texto, 'proyecto') ||
                            str_contains($texto, 'entrega')
                        ) {
                            $tipo = 'tarea';
                            $color = 'purple';
                            $icon = '📝';
                        } elseif (
                            str_contains($texto, 'anuncio') ||
                            str_contains($texto, 'comunicado') ||
                            str_contains($texto, 'aviso')
                        ) {
                            $tipo = 'anuncio';
                            $color = 'orange';
                            $icon = '📢';
                        }

                        $fecha = Carbon::parse($act->fecha_entrega);
                    ?>

                    <div class="activity-item" data-type="<?php echo e($tipo); ?>" data-date="<?php echo e($fecha->format('Y-m-d')); ?>">

                        <!-- Fecha -->
                        <div class="activity-date">

                            <?php echo e($fecha->format('d M Y')); ?>


                            <span>
                                <?php if($act->hora_entrega): ?>
                                    <?php echo e(Carbon::parse($act->hora_entrega)->format('h:i A')); ?>

                                <?php else: ?>
                                    Sin hora
                                <?php endif; ?>
                            </span>

                        </div>

                        <!-- Card -->
                        <div class="activity-card <?php echo e($color); ?>">

                            <div class="timeline-icon">
                                <?php echo e($icon); ?>

                            </div>

                            <div class="timeline-dot"></div>

                            <div class="activity-header">
                                <?php echo e(strtoupper($tipo)); ?>

                            </div>

                            <div class="activity-title">
                                <?php echo e($act->materia); ?> - <?php echo e($act->actividad); ?>

                            </div>

                            <div class="activity-comment">
                                <?php echo e($act->descripcion ?: 'Sin descripción registrada.'); ?>

                            </div>

                            <div class="activity-comment">
                                👨‍🎓 <?php echo e($act->salon_nombre); ?>

                            </div>
                        </div>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <div class="activity-item">

                        <div class="activity-card blue">

                            <div class="activity-header">
                                SIN ACTIVIDADES
                            </div>

                            <div class="activity-title">
                                No hay actividades registradas
                            </div>

                            <div class="activity-comment">
                                Las actividades aparecerán aquí.
                            </div>

                        </div>

                    </div>
                <?php endif; ?>

            </div>
        </div>

    </div>

    <script>
        (() => {

            const filterType = document.getElementById('filter-type');
            const filterDate = document.getElementById('filter-date');
            const items = document.querySelectorAll('.activity-item');

            const isToday = (d) => {
                const now = new Date();

                return d.getDate() === now.getDate() &&
                    d.getMonth() === now.getMonth() &&
                    d.getFullYear() === now.getFullYear();
            };

            const isLast7Days = (d) => {
                const now = new Date();
                const last = new Date();

                last.setDate(now.getDate() - 7);

                return d >= last && d <= now;
            };

            const isLastMonth = (d) => {
                const now = new Date();

                return d.getMonth() === now.getMonth() &&
                    d.getFullYear() === now.getFullYear();
            };

            const applyFilters = () => {

                const type = filterType.value;
                const date = filterDate.value;

                items.forEach((item) => {

                    const itemType = item.dataset.type;
                    const itemDate = new Date(item.dataset.date + 'T00:00:00');

                    let show = true;

                    if (type !== 'all' && itemType !== type) {
                        show = false;
                    }

                    if (date !== 'all') {

                        if (date === 'today' && !isToday(itemDate)) {
                            show = false;
                        }

                        if (date === 'week' && !isLast7Days(itemDate)) {
                            show = false;
                        }

                        if (date === 'month' && !isLastMonth(itemDate)) {
                            show = false;
                        }
                    }

                    item.style.display = show ? '' : 'none';

                });

            };

            filterType.addEventListener('change', applyFilters);
            filterDate.addEventListener('change', applyFilters);

        })();
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.Docentelanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\Proyect_Next_Level\resources\views/Docentes/activity.blade.php ENDPATH**/ ?>