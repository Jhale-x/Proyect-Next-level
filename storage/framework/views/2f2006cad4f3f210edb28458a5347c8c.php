<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intranet Docentes - Acceso Unificado</title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css']); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/login_colegio.css')); ?>">
</head>

<body class="overflow-x-hidden md:overflow-hidden">

    <div class="main-sliding-container active" id="mainContainer">

        <!-- SIDE FORM -->
        <div class="form-side student-side">

            <!-- BACK BUTTON -->
            <div class="absolute top-6 left-6">
                <a href="<?php echo e(route('portal')); ?>"
                    class="btn-custom-effect rounded-2xl p-3 shadow-custom-blue inline-flex items-center justify-center">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 8L3 12M3 12L7 16M3 12H17" stroke="white" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M15 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H15"
                            stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

            <!-- CONTENT -->
            <div class="max-w-xl w-full mx-auto text-center student-content-wrapper">

                <!-- HEADER -->
                <div class="mb-12">
                    <p class="text-custom-blue italic text-lg font-bold tracking-[0.35em] uppercase mb-3">
                        Intranet
                    </p>

                    <h1 class="text-6xl md:text-8xl font-black text-custom-blue uppercase leading-none">
                        Docentes
                    </h1>
                </div>

                <h2 class="text-2xl font-semibold text-slate-700 mb-10">
                    Bienvenido al portal docente
                </h2>

                <!-- ERRORS -->
                <?php if(session('error')): ?>
                    <div class="mb-5 text-red-600 font-semibold">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="mb-5 text-red-600 text-sm">
                        <ul class="list-disc list-inside">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($err); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- FORM -->
                <form method="POST" action="<?php echo e(route('login.user')); ?>" class="space-y-8 text-left">
                    <?php echo csrf_field(); ?>

                    <!-- USER -->
                    <div>
                        <label class="block text-sm font-bold uppercase tracking-widest ml-2 mb-2">
                            ID del usuario
                        </label>

                        <input type="text" name="usuario" placeholder="Ej: 0020261234" required
                            class="w-full bg-slate-50 border-2 border-slate-200 rounded-[2rem]
                           py-5 px-8 text-lg outline-none focus:border-custom-blue transition">
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="block text-sm font-bold uppercase tracking-widest ml-2 mb-2">
                            Contraseña
                        </label>

                        <div class="relative">
                            <input id="passwordInput" type="password" name="password" placeholder="••••••••" required
                                class="w-full bg-slate-50 border-2 border-slate-200 rounded-[2rem]
                               py-5 px-8 pr-14 text-lg outline-none focus:border-custom-blue transition">

                            <button id="togglePassword" type="button"
                                class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-400">
                                👁
                            </button>
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full btn-custom-effect text-white font-black py-6 rounded-[2rem]
                        text-xl uppercase tracking-widest shadow-custom-blue">
                        Ingresar
                    </button>
                </form>

                <!-- FORGOT -->
                <div class="mt-6 text-center">
                    <a href="#" class="text-slate-400 font-semibold hover:text-custom-blue transition">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>

                <!-- SOCIAL -->
                <div class="social-icons-wrapper mt-8">
                    <a href="https://www.tiktok.com/@next_level_novus" class="social-btn"><i
                            class="fab fa-tiktok"></i></a>
                    <a href="https://www.instagram.com/next_level_novus/" class="social-btn"><i
                            class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/51923317625" class="social-btn"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=61581492196914" class="social-btn"><i
                            class="fab fa-facebook"></i></a>
                </div>

                <!-- FOOTER -->
                <div class="mt-8 text-center text-[11px] text-slate-400 space-y-3">

                    <div class="flex justify-center gap-3">
                        <a href="#" class="hover:text-custom-blue transition">Términos</a>
                        <span>/</span>
                        <a href="#" class="hover:text-custom-blue transition">Privacidad</a>
                    </div>

                    <p>© 2026 Next Level. Todos los derechos reservados.</p>
                </div>

            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('js/login.js')); ?>"></script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\laravel\Proyect_Next_Level\resources\views/auth/login_user.blade.php ENDPATH**/ ?>