<?php $__env->startSection('title', 'Dashboard - Admin'); ?>
<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/dashboard.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/admin/dashboard.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid page-wrap">
        <h1 class="section-title mb-4">Dashboard Administrador</h1>

        <div class="row g-3 mb-4">

            <div class="col">
                <div class="card stats-card bg-primary text-white h-100">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Total Usuarios</small>
                            <h3><?php echo e($totalUsuarios); ?></h3>
                        </div>
                        <i class="bi bi-people stats-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card stats-card bg-info text-white h-100">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Total Alumnos</small>
                            <h3><?php echo e($alumnos ?? 0); ?></h3>

                            <small>Academia: <?php echo e($academia ?? 0); ?></small>
                            <div class="mini-bar">
                                <div class="mini-fill"
                                    style="width: <?php echo e($alumnos ?? 0 ? (($academia ?? 0) * 100) / $alumnos : 0); ?>%">
                                </div>
                            </div>

                            <small>Colegio: <?php echo e($colegio ?? 0); ?></small>
                            <div class="mini-bar">
                                <div class="mini-fill"
                                    style="width: <?php echo e($alumnos ?? 0 ? (($colegio ?? 0) * 100) / $alumnos : 0); ?>%">
                                </div>
                            </div>
                        </div>

                        <i class="bi bi-mortarboard stats-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card stats-card bg-dark text-white h-100">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Admins</small>
                            <h3><?php echo e($admins); ?></h3>
                        </div>
                        <i class="bi bi-shield-lock stats-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card stats-card bg-success text-white h-100">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Docentes</small>
                            <h3><?php echo e($docentes); ?></h3>
                        </div>
                        <i class="bi bi-person-workspace stats-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card stats-card bg-warning text-white h-100">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Auxiliares</small>
                            <h3><?php echo e($auxiliares); ?></h3>
                        </div>
                        <i class="bi bi-person-badge stats-icon"></i>
                    </div>
                </div>
            </div>

        </div>
        <div class="card card-soft mb-4">
            <div class="card-header bg-white border-0 fw-semibold d-flex justify-content-between">
                <span>Usuarios Recientes</span>
                <small class="text-muted"><?php echo e(count($usuariosRecientes)); ?> usuarios</small>
            </div>

            <div class="card-body py-2">
                <div class="row g-2">
                    <?php $__currentLoopData = $usuariosRecientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4">
                            <div class="user-mini-card d-flex align-items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->nombre)); ?>&background=4F46E5&color=fff"
                                    class="avatar-mini">

                                <div>
                                    <div class="fw-semibold small"><?php echo e($user->nombre); ?></div>
                                    <small class="text-muted"><?php echo e($user->rol); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <div class="row g-4">

            
            <div class="col-lg-8">
                <div class="card h-100">
                    <div class="card-header">
                        Actividad Reciente
                    </div>

                    <div class="card-body">

                        <?php $__empty_1 = true; $__currentLoopData = $actividadReciente; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actividad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <div>
                                    <strong><?php echo e($actividad['titulo']); ?></strong>
                                    <div class="text-muted small">
                                        <?php echo e($actividad['descripcion']); ?>

                                    </div>
                                </div>

                                <small class="text-muted"><?php echo e($actividad['creado']); ?></small>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="text-muted small">No hay actividad reciente registrada.</div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header">
                        Resumen General
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <small class="text-muted">Usuarios activos (últimos 30 días)</small>
                            <h4><?php echo e($usuariosActivosPercent ?? 0); ?>%</h4>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Cursos activos</small>
                            <h4><?php echo e($cursosActivos ?? 0); ?></h4>
                        </div>

                        <div>
                            <small class="text-muted">Mensajes enviados</small>
                            <h4><?php echo e($mensajes ?? 0); ?></h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.Adminlanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\Proyect_Next_Level\resources\views/Admin/dashboard.blade.php ENDPATH**/ ?>