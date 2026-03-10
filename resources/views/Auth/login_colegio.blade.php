<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intranet Colegio - Acceso Unificado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login_colegio.css') }}">
</head>

<body class="overflow-x-hidden md:overflow-hidden">

    <div class="main-sliding-container active" id="mainContainer">

        <div class="form-side family-side">
            <div class="max-w-xl w-full mx-auto text-center">
                <div class="mb-14">
                    <p class="text-custom-blue italic text-lg md:text-xl font-bold tracking-[0.4em] uppercase mb-4">
                        Intranet</p>
                    <h1
                        class="text-6xl md:text-9xl font-black text-custom-blue tracking-tighter uppercase leading-none">
                        Colegio</h1>
                </div>

                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-12 italic">¡Bienvenida Familia / Apoderado!
                </h2>

                <form class="space-y-8 text-left" method="POST" action="{{ route('login.familia') }}">
                    @csrf
                    <div class="space-y-4">
                        <label class="block text-slate-800 text-base font-extrabold uppercase ml-2 tracking-widest">Nro.
                            de documento</label>
                        <input type="text" name="documento" placeholder="Ej: 70001234" required
                            class="w-full bg-slate-50 border-2 border-slate-200 rounded-[2rem] py-7 px-10 outline-none focus:border-custom-blue transition-all text-2xl shadow-sm">
                    </div>
                    <button type="submit"
                        class="w-full btn-custom-effect text-white font-black py-8 rounded-[2rem] shadow-custom-blue text-3xl uppercase tracking-widest mt-6">
                        <span>Ingresar</span>
                    </button>
                </form>

                <div class="mt-8">
                    <a href="#"
                        class="text-xl font-bold text-slate-400 hover:text-custom-blue transition-colors">¿Olvidaste tu
                        contraseña?</a>
                </div>

                <div class="social-icons-wrapper !mt-8">
                    <a href="https://www.tiktok.com/@next_level_novus" target="_blank" rel="noopener noreferrer"
                        class="social-btn"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.instagram.com/next_level_novus/" target="_blank" rel="noopener noreferrer"
                        class="social-btn"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/51923317625" target="_blank" rel="noopener noreferrer" class="social-btn"><i
                            class="fab fa-whatsapp"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=61581492196914" target="_blank"
                        rel="noopener noreferrer" class="social-btn"><i class="fab fa-facebook"></i></a>
                </div>

                <div class="mt-6 flex flex-col items-center">
                    <div
                        class="text-slate-400 text-[11px] font-bold uppercase tracking-widest flex items-center gap-3 whitespace-nowrap footer-links">
                        <a href="#"
                            class="hover:text-custom-blue underline decoration-1 underline-offset-4 transition-colors">Términos
                            y condiciones</a>
                        <span class="text-slate-300">/</span>
                        <a href="#"
                            class="hover:text-custom-blue underline decoration-1 underline-offset-4 transition-colors">Política
                            de protección de datos personales</a>
                    </div>
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em] mt-4"> © 2026 Next Level.
                        Todos los derechos reservados.</p>
                </div>
            </div>
        </div>

        <div class="form-side student-side">
            <div class="absolute top-12 left-12 container-back-btn">
                <a href="{{ route('portal') }}"
                    class="inline-block btn-custom-effect rounded-2xl p-4 shadow-custom-blue">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 8L3 12M3 12L7 16M3 12H17" stroke="white" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M15 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H15"
                            stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

            <div class="max-w-xl w-full mx-auto text-center student-content-wrapper">
                <div class="mb-14">
                    <p class="text-custom-blue italic text-lg md:text-xl font-bold tracking-[0.4em] uppercase mb-4">
                        Intranet</p>
                    <h1
                        class="text-6xl md:text-9xl font-black text-custom-blue tracking-tighter uppercase leading-none">
                        Colegio</h1>
                </div>

                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-12 italic">¡Bienvenidos!</h2>

                <form class="space-y-8 text-left" method="POST" action="{{ route('login.alumno') }}">
                    @csrf
                    @if (session('error'))
                        <div class="mb-4 text-red-600 font-semibold">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if ($errors->has('usuario'))
                        <div class="mb-4 text-red-600 font-semibold">
                            {{ $errors->first('usuario') }}
                        </div>
                    @endif
                    <div class="space-y-4">
                        <label class="block text-slate-800 text-base font-extrabold uppercase ml-2 tracking-widest">ID
                            DEL USUARIO</label>
                        <input type="text" name="usuario" placeholder="Ej: 0020261234" required
                            class="w-full bg-slate-50 border-2 border-slate-200 rounded-[2rem] py-7 px-10 outline-none focus:border-custom-blue transition-all text-2xl shadow-sm">
                    </div>
                    <div class="space-y-4">
                        <label
                            class="block text-slate-800 text-base font-extrabold uppercase ml-2 tracking-widest">Contraseña</label>
                        <div class="relative flex items-center">
                            <input id="passwordInput" type="password" name="password" placeholder="••••••••" required
                                class="w-full bg-slate-50 border-2 border-slate-200 rounded-[2rem] py-7 px-10 pr-24 outline-none focus:border-custom-blue transition-all text-2xl shadow-sm">
                            <button id="togglePassword" type="button"
                                class="absolute right-8 text-slate-400 hover:text-custom-blue">
                                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="hidden" width="36"
                                    height="36" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none">
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path
                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                    </path>
                                </svg>
                                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                    <path d="M10.584 10.587a2 2 0 0 0 2.828 2.83"></path>
                                    <path
                                        d="M9.363 5.365a9.466 9.466 0 0 1 2.637 -.365c4 0 7.333 2.333 10 7c-.778 1.361 -1.612 2.524 -2.503 3.488m-2.14 1.861a9.41 9.41 0 0 1 -5.357 1.651c-4 0 -7.333 -2.333 -10 -7c1.369 -2.395 2.913 -4.175 4.632 -5.341">
                                    </path>
                                    <path d="M3 3l18 18"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full btn-custom-effect text-white font-black py-8 rounded-[2rem] shadow-custom-blue text-3xl uppercase tracking-widest mt-6">
                        <span>Ingresar</span>
                    </button>
                </form>

                <div class="mt-8">
                    <a href="#"
                        class="text-xl font-bold text-slate-400 hover:text-custom-blue transition-colors">¿Olvidaste tu
                        contraseña?</a>
                </div>

                <div class="social-icons-wrapper !mt-8">
                    <a href="https://www.tiktok.com/@next_level_novus" class="social-btn"><i
                            class="fab fa-tiktok"></i></a>
                    <a href="https://www.instagram.com/next_level_novus/" class="social-btn"><i
                            class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/51923317625" class="social-btn"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=61581492196914" class="social-btn"><i
                            class="fab fa-facebook"></i></a>
                </div>

                <div class="mt-6 flex flex-col items-center">
                    <div
                        class="text-slate-400 text-[11px] font-bold uppercase tracking-widest flex items-center gap-3 footer-links">
                        <a href="#" class="hover:text-custom-blue underline transition-colors">Términos y
                            condiciones</a>
                        <span class="text-slate-300">/</span>
                        <a href="#" class="hover:text-custom-blue underline transition-colors">Política de
                            protección de datos personales</a>
                    </div>
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em] mt-4"> © 2026 Next Level.
                        Todos los derechos reservados.</p>
                </div>
            </div>
        </div>

        <div class="sliding-panel-container">
            <div class="sliding-panel">
                <div class="text-white text-center px-10 md:px-20">
                    <h1 class="text-5xl md:text-8xl font-black mb-10 uppercase tracking-tighter" id="overlayTitle">
                        ¿Eres Familia?</h1>
                    <p class="text-2xl md:text-3xl opacity-90 mb-14 font-medium" id="overlayText">Accede con tu
                        documento de identidad para el <br class="hidden md:block"> seguimiento de tus hijos.</p>
                    <button class="btn-ghost-white btn-custom-effect" id="toggleBtn">
                        <span>Soy Familia</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>
