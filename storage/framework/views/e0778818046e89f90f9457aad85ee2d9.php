<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/listados.css')); ?>">

    <div class="container-fluid py-4">
        <h2 class="text-white mb-4">Gestión de Alumnos</h2>

        <form action="<?php echo e(route('admin.alumnos.index')); ?>" method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o DNI..."
                    value="<?php echo e(request('search')); ?>">
            </div>
            <div class="col-md-3">
                <select name="nivel" class="form-select">
                    <option value="">Todos los niveles</option>
                    <?php $__currentLoopData = $niveles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nivel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($nivel->id_nivel); ?>" <?php echo e(request('nivel') == $nivel->id_nivel ? 'selected' : ''); ?>>
                            <?php echo e($nivel->nivel); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="grado" class="form-select">
                    <option value="">Todos los grados</option>
                    <?php $__currentLoopData = $grados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($grado->id_grado); ?>" <?php echo e(request('grado') == $grado->id_grado ? 'selected' : ''); ?>>
                            <?php echo e($grado->grado); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
            <div class="col-md-2">
                <a href="<?php echo e(route('admin.alumnos.index')); ?>" class="btn btn-secondary w-100">Limpiar</a>
            </div>
        </form>

        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Alumno</th>
                    <th>Nivel/Grado/Sección</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $alumnos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alumno): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($alumno->dni); ?></td>
                        <td><?php echo e($alumno->nombre); ?> <?php echo e($alumno->apellido); ?></td>
                        <td>
                            <?php echo e(optional($alumno->salon->nivel)->nivel ?? 'N/A'); ?>

                            <?php if(optional($alumno->salon->grado)->grado): ?>
                                - <?php echo e($alumno->salon->grado->grado); ?>

                            <?php endif; ?>
                            <?php if(optional($alumno->salon->seccion)->seccion): ?>
                                - <?php echo e($alumno->salon->seccion->seccion); ?>

                            <?php endif; ?>
                        </td>
                        <td><?php echo e($alumno->usuario); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.alumnos.show', $alumno->id_alumno)); ?>"
                                class="btn btn-sm btn-outline-info">
                                Ver
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.Adminlanding', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\Proyect_Next_Level\resources\views/Admin/ListadoAlumno.blade.php ENDPATH**/ ?>