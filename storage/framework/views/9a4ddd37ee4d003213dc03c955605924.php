<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/alumno/PaginaInstitucional.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', 'Inicio - Alumno'); ?>

<?php $__env->startSection('content'); ?>
<?php
    // Variable segura
    $anuncios = $anuncios ?? collect();
    $actividades = $actividades ?? collect();
?>

<div class="contenido-principal">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="titulo-seccion">Página Institucional</h2>
    </div>

    <div class="card filtros-card mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label mb-1">Busque sus cursos</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Escriba aquí...">
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="form-label mb-1">Filtrar por</label>
                    <select class="form-select">
                        <option selected>Cursos actuales</option>
                        <option>Todos los cursos</option>
                        <option>Cursos pasados</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label mb-1">Estado</label>
                    <select class="form-select">
                        <option selected>Cursos que estoy realizando</option>
                        <option>Finalizados</option>
                        <option>No iniciados</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label mb-1">Mostrar</label>
                    <div class="d-flex align-items-center gap-2">
                        <select class="form-select w-auto">
                            <option selected>25</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                        <span class="text-muted">elementos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="resultados-count mb-4">
        <strong><?php echo e($anuncios->count()); ?> resultados</strong>
    </p>

    <h5 class="seccion-titulo mb-3">
        <i class="bi bi-star-fill text-warning me-2"></i>Favoritos
    </h5>

    <?php if($anuncios->isEmpty()): ?>
        <div class="alert alert-info alert-sin-datos">
            <i class="bi bi-info-circle me-2"></i> No hay anuncios activos por el momento.
        </div>
    <?php else: ?>
        <?php $__currentLoopData = $anuncios->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anuncio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card anuncio-card favorito-card mb-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex gap-3 flex-grow-1">
                            <div class="barra-color" style="background: #6f42c1;"></div>
                            <div>
                                <small class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    <?php echo e($anuncio->fecha_publicacion?->format('d/m/Y H:i') ?? 'Sin fecha'); ?>

                                </small>
                                <h6 class="mb-1 mt-1"><?php echo e($anuncio->titulo); ?></h6>
                                <div>
                                    <span class="badge bg-success"><?php echo e(ucfirst($anuncio->estado ?? 'Activo')); ?></span>
                                    <a href="#" class="text-decoration-none ms-2">Más información <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <i class="bi bi-star-fill text-warning fs-5"></i>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <h6 class="seccion-titulo mt-4 mb-3">
        <i class="bi bi-megaphone me-2"></i>Anuncios institucionales
    </h6>

    <?php if($anuncios->count() > 3): ?>
        <?php $__currentLoopData = $anuncios->skip(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anuncio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card anuncio-card mb-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex gap-3 flex-grow-1">
                            <div class="barra-color" style="background: #0d6efd;"></div>
                            <div>
                                <small class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    <?php echo e($anuncio->fecha_publicacion?->format('d/m/Y H:i') ?? 'Sin fecha'); ?>

                                </small>
                                <h6 class="mb-1 mt-1"><?php echo e($anuncio->titulo); ?></h6>
                                <div>
                                    <span class="badge bg-success"><?php echo e(ucfirst($anuncio->estado ?? 'Activo')); ?></span>
                                    <span class="text-muted ms-2"><?php echo e(Str::limit($anuncio->descripcion ?? 'Sin descripción', 80)); ?></span>
                                </div>
                            </div>
                        </div>
                        <i class="bi bi-star text-secondary fs-5"></i>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php elseif($anuncios->count() > 0 && $anuncios->count() <= 3): ?>
        <div class="alert alert-secondary">
            <i class="bi bi-info-circle me-2"></i>No hay más anuncios institucionales.
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Alumnoslanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Proyect-Next-level\resources\views/Alumno/pagina_institucional.blade.php ENDPATH**/ ?>