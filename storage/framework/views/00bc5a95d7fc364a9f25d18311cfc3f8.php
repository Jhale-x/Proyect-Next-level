<?php $__env->startSection('title', 'Página Institucional'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/alumno/paginaInstitucional.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid institutional-page">

        
        <div class="institutional-header">

            <div>
                <h1 class="institutional-title">
                    Página Institucional
                </h1>

                <p class="institutional-subtitle">
                    Últimos anuncios y comunicados oficiales.
                </p>
            </div>

            <div class="header-badge">
                <i class="bi bi-megaphone-fill"></i>
                <?php echo e($anuncios->count()); ?> anuncios
            </div>

        </div>

        
        <div class="announcements-grid">

            <?php $__empty_1 = true; $__currentLoopData = $anuncios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anuncio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="announcement-card">
                    
                    <?php if($anuncio->imagen): ?>
                        <div class="announcement-image">
                            <img src="<?php echo e(asset('storage/' . $anuncio->imagen)); ?>" alt="Imagen anuncio">
                        </div>
                    <?php endif; ?>

                    
                    <div class="announcement-body">

                        <div class="announcement-top">

                            <span class="announcement-status">
                                <i class="bi bi-broadcast"></i>
                                <?php echo e(ucfirst($anuncio->estado)); ?>

                            </span>

                            <small>
                                <?php echo e(\Carbon\Carbon::parse($anuncio->fecha_publicacion)->format('d/m/Y')); ?>

                            </small>

                        </div>

                        <h2 class="announcement-title">
                            <?php echo e($anuncio->titulo); ?>

                        </h2>

                        <p class="announcement-description">
                            <?php echo e($anuncio->descripcion); ?>

                        </p>

                        <?php if($anuncio->contenido): ?>
                            <div class="announcement-content">
                                <?php echo e($anuncio->contenido); ?>

                            </div>
                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <div class="empty-announcements">

                    <i class="bi bi-megaphone"></i>

                    <h3>No hay anuncios disponibles</h3>

                    <p>
                        Cuando el administrador publique anuncios aparecerán aquí.
                    </p>

                </div>
            <?php endif; ?>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.Alumnoslanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\Proyect_Next_Level\resources\views/Alumno/pagina_institucional.blade.php ENDPATH**/ ?>