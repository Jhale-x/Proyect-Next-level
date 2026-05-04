<?php $__env->startSection('title', 'Gestión de Página Institucional - Admin'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/PaginaInstitucional.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid page-wrap">

        <div class="page-header mb-4">
            <div>
                <h1 class="section-title mb-1">Gestión de Página Institucional</h1>
                <p class="text-muted mb-0">Administra anuncios y contenido.</p>
            </div>
        </div>

        <div class="row g-4 mb-4">

            <div class="col">
                <div class="card stats-card bg-primary text-white p-3 h-100">
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
                <div class="card stats-card bg-info text-white p-3 h-100">
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
                        <i class="bi bi-person-lines-fill stats-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card stats-card bg-dark text-white p-3 h-100">
                    <small>Admins</small>
                    <h3><?php echo e($admins); ?></h3>
                </div>
            </div>

            <div class="col">
                <div class="card stats-card bg-success text-white p-3 h-100">
                    <small>Docentes</small>
                    <h3><?php echo e($docentes); ?></h3>
                </div>
            </div>

            <div class="col">
                <div class="card stats-card bg-warning text-white p-3 h-100">
                    <small>Auxiliares</small>
                    <h3><?php echo e($auxiliares); ?></h3>
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

        
        <div class="row g-4 align-items-stretch">

            <div class="col-md-7">
                <div class="card card-soft">
                    <div class="card-header bg-primary text-white">
                        Crear Anuncio
                    </div>

                    <div class="card-body">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                        <?php endif; ?>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('admin.pagina_institucional.store')); ?>"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <input type="text" name="titulo" class="form-control mb-2" placeholder="Título" required
                                value="<?php echo e(old('titulo')); ?>">
                            <textarea name="descripcion" class="form-control mb-2" placeholder="Descripción" required><?php echo e(old('descripcion')); ?></textarea>

                            <select name="estado" id="estadoAnuncio" class="form-select mb-2" required>
                                <option value="activo" <?php echo e(old('estado') === 'activo' ? 'selected' : ''); ?>>Activo
                                </option>
                                <option value="inactivo" <?php echo e(old('estado') === 'inactivo' ? 'selected' : ''); ?>>Inactivo
                                </option>
                                <option value="programado" <?php echo e(old('estado') === 'programado' ? 'selected' : ''); ?>>
                                    Programado</option>
                            </select>

                            <input type="file" name="imagen" class="form-control mb-2">

                            <button class="btn btn-success">Publicar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5     d-flex">
                <div class="card card-soft w-100 d-flex flex-column">

                    <div class="card-header bg-info text-white">
                        Anuncios Recientes
                    </div>

                    <div class="card-body d-flex flex-column">

                        <?php $__empty_1 = true; $__currentLoopData = $recientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="mb-3 p-2 border rounded">
                                <strong><?php echo e($a->titulo); ?></strong><br>
                                <small class="text-muted"><?php echo e($a->fecha_publicacion); ?></small>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="text-center text-muted mt-auto">
                                No hay anuncios
                            </div>
                        <?php endif; ?>

                    </div>

                </div>
            </div>

        </div>
        
        <div class="card card-soft mt-4">
            <div class="card-header bg-secondary text-white">
                Historial
            </div>

            <div class="card-body">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Acción</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $historial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($h->titulo); ?></td>
                                <td>
                                    <span
                                        class="badge bg-<?php echo e($h->estado == 'activo' ? 'success' : ($h->estado == 'inactivo' ? 'secondary' : 'warning')); ?>">
                                        <?php echo e(ucfirst($h->estado)); ?>

                                    </span>
                                </td>
                                <td><?php echo e($h->fecha_publicacion?->format('d/m/Y')); ?></td>
                                <td><?php echo e($h->user->nombre ?? '-'); ?></td>
                                <td>
                                    <div class="d-flex gap-2">

                                        
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#editarAnuncioModal<?php echo e($h->id); ?>">
                                            Editar
                                        </button>

                                        
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalEliminar<?php echo e($h->id); ?>">
                                            Eliminar
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('modals'); ?>
    <?php $__currentLoopData = $historial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <div class="modal fade" id="editarAnuncioModal<?php echo e($h->id); ?>" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Editar anuncio</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <form method="POST" action="<?php echo e(route('admin.pagina_institucional.update', $h->id)); ?>"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">Título</label>
                                <input type="text" name="titulo" class="form-control" value="<?php echo e($h->titulo); ?>"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="3" required><?php echo e($h->descripcion); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select name="estado" class="form-select">
                                    <option value="activo" <?php echo e($h->estado == 'activo' ? 'selected' : ''); ?>>Activo</option>
                                    <option value="inactivo" <?php echo e($h->estado == 'inactivo' ? 'selected' : ''); ?>>Inactivo
                                    </option>
                                    <option value="programado" <?php echo e($h->estado == 'programado' ? 'selected' : ''); ?>>
                                        Programado</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Imagen</label>
                                <input type="file" name="imagen" class="form-control">
                            </div>

                            <?php if($h->imagen): ?>
                                <small class="text-muted">Imagen actual: <?php echo e($h->imagen); ?></small>
                            <?php endif; ?>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        
        <div class="modal fade" id="modalEliminar<?php echo e($h->id); ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">

                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">⚠️ Confirmar eliminación</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-center">
                        <p class="mb-1">¿Seguro que deseas eliminar?</p>
                        <strong class="text-danger">"<?php echo e($h->titulo); ?>"</strong>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                        <form method="POST" action="<?php echo e(route('admin.pagina_institucional.destroy', $h->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger px-4">Sí, eliminar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.Adminlanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Proyect-Next-level\resources\views/Admin/pagina_institucional.blade.php ENDPATH**/ ?>