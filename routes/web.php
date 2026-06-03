<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SuportController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\EtisController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\FacultadController;
use App\Http\Controllers\Web_Principal;
use App\Http\Controllers\Pagina_InstitucionalController;
use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\EtiController;
use App\Http\Controllers\MatriculaController;



// --- RUTAS PÚBLICAS ---
Route::get('/', [Web_Principal::class, 'index'])->name('web_principal');
Route::get('/propuesta-educativa', [Web_Principal::class, 'propuestaEducativa'])->name('propuesta_educativa');
Route::get('/pagina_institucional', [Pagina_InstitucionalController::class, 'index'])->name('pagina_institucional');
Route::get('/matricula', [MatriculaController::class, 'index'])->name('matricula');
Route::get('/matricula/formulario', [MatriculaController::class, 'mostrarFormulario'])->name('matricula.formulario');
Route::post('/matricula/verificar', [MatriculaController::class, 'store'])->name('matricula.verificar.post');

// --- AUTENTICACIÓN ---
Route::prefix('auth')->group(function () {
    Route::get('/intranet', fn() => view('intranet'))->name('portal');
    Route::get('/login-academia', [LoginController::class, 'showAcademia'])->name('login.academia');
    Route::get('/login-colegio', [LoginController::class, 'showColegio'])->name('login.colegio');
    Route::get('/login-familia', [LoginController::class, 'showApoderado'])->name('login.familia');
    Route::post('/login-alumno', [LoginController::class, 'loginAlumno'])->name('login.alumno');
    Route::post('/login-familia', [LoginController::class, 'loginFamilia'])->name('login.familia');
    Route::get('/login-user', [LoginController::class, 'showUser'])->name('login.user');
    Route::post('/login-user', [LoginController::class, 'loginUser']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// --- ADMINISTRACIÓN ---
Route::prefix('admin')->middleware(['auth', 'role:administrador'])->group(function () {

    Route::get('/dashboard', [Pagina_InstitucionalController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/buscar-alumnos', [MessageController::class, 'buscarAlumnos'])->name('admin.messages.search');

    // Gestión Institucional
    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'adminIndex'])->name('admin.pagina_institucional');
    Route::post('/pagina-institucional', [Pagina_InstitucionalController::class, 'storeAnuncio'])->name('admin.pagina_institucional.store');
    Route::put('/pagina-institucional/{id}', [Pagina_InstitucionalController::class, 'updateAnuncio'])->name('admin.pagina_institucional.update');
    Route::delete('/pagina-institucional/{id}', [Pagina_InstitucionalController::class, 'destroyAnuncio'])->name('admin.pagina_institucional.destroy');

    // --- ALUMNOS ---
    Route::prefix('alumnos')->group(function () {
        Route::get('/registro', [AlumnosController::class, 'create'])->name('admin.alumnos.create');
        Route::get('/listado', [AlumnosController::class, 'index'])->name('admin.alumnos.index');
        Route::get('/detalle/{id_alumno}', [AlumnosController::class, 'show'])->name('admin.alumnos.show');
        Route::get('/editar/{id_alumno}', [AlumnosController::class, 'edit'])->name('admin.alumnos.edit');
        Route::put('/{id_alumno}', [AlumnosController::class, 'update'])->name('admin.alumnos.update');
        Route::post('/', [AlumnosController::class, 'store'])->name('admin.alumnos.store');
        Route::get('/datos-formulario', [AlumnosController::class, 'datosFormulario'])->name('admin.alumnos.datosFormulario');
    });

    // Grados por nivel para el formulario de alumnos
    Route::get('/grados/{id_nivel}', [AlumnosController::class, 'gradosPorNivel'])->name('admin.grados.porNivel');

    // --- PERSONAL (Users) ---
    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('admin.users.index');
        Route::get('/listado', [UsersController::class, 'listado'])->name('admin.users.listado');
        Route::get('/detalle/{id_usuario}', [UsersController::class, 'show'])->name('admin.users.show');
        Route::get('/editar/{id_usuario}', [UsersController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{id_usuario}', [UsersController::class, 'update'])->name('admin.users.update');
        Route::post('/', [UsersController::class, 'store'])->name('admin.users.store');
    });
    // --- CURSOS Y SALONES ---
    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('admin.courses');
        Route::post('/', [CourseController::class, 'store'])->name('admin.courses.store');
        Route::get('/{id_curso}/docentes', [CourseController::class, 'docentes'])->name('admin.courses.docentes');
        Route::get('/docente/{id_usuario}/salones', [CourseController::class, 'salonesPorDocente'])->name('admin.courses.salonesPorDocente');
        Route::post('/asignar-salones', [CourseController::class, 'asignarSalones'])->name('admin.courses.asignarSalones');
    });

    Route::prefix('salones')->group(function () {
        Route::get('/', [SalonController::class, 'index'])->name('admin.salones');
        Route::post('/crear-completo', [SalonController::class, 'crearCompleto'])->name('admin.salon.crearCompleto');
        Route::get('/por-nivel', [SalonController::class, 'porNivel'])->name('admin.salones.porNivel');
        Route::get('/{id}/detalle', [CourseController::class, 'detalleSalon'])->name('admin.salones.detalle');
        Route::post('/{id}/guardar-notas', [CourseController::class, 'guardarNotasSalon'])->name('admin.salones.guardarNotas');
        Route::get('/{id}/export/{idCurso}', [SalonController::class, 'export'])->name('admin.salones.export');
        Route::post('/{id}/import', [SalonController::class, 'import'])->name('admin.salones.import');
    });

    // --- CONFIGURACIÓN ACADÉMICA ---
    Route::post('/niveles/store-multiple', [NivelController::class, 'storeMultiple'])->name('admin.niveles.storeMultiple');
    Route::post('/grados/store-multiple', [GradoController::class, 'storeMultiple'])->name('admin.grados.storeMultiple');
    Route::post('/secciones/store-multiple', [SeccionController::class, 'storeMultiple'])->name('admin.secciones.storeMultiple');
    Route::post('/facultades/store-multiple', [FacultadController::class, 'storeMultiple'])->name('admin.facultades.storeMultiple');

    Route::prefix('config')->group(function () {
        Route::post('/secciones/multiple', [NivelController::class, 'storeSecciones'])->name('admin.config.secciones.storeMultiple');
        Route::post('/grados/multiple', [NivelController::class, 'storeGrados'])->name('admin.config.grados.storeMultiple');
        Route::post('/facultades/multiple', [NivelController::class, 'storeFacultades'])->name('admin.config.facultades.storeMultiple');
    });

    // --- ETI ---
    Route::prefix('eti')->group(function () {
        Route::get('/', [EtisController::class, 'etiIndex'])->name('admin.eti');
        Route::get('/notas', [EtisController::class, 'getNotas']);
        Route::get('/grados/{id_nivel}', [EtisController::class, 'getGradosByNivel']);
        Route::post('/alumnos', [EtisController::class, 'getAlumnos']);
        Route::post('/guardar-promedio', [EtisController::class, 'guardarPromedio']);
        Route::post('/guardar-multiples-promedios', [EtisController::class, 'guardarMultiplesPromedios']);
        Route::get('/promedios', [EtisController::class, 'getPromedios']);
        Route::get('/exportar', [EtisController::class, 'exportarPromedios']);
    });

    Route::get('/qualifications', [QualificationController::class, 'index'])->name('admin.qualifications');
    Route::get('/qualifications/cursos', [QualificationController::class, 'cursos'])->name('admin.qualifications.cursos');
    Route::get('/qualifications/cursos/{idCurso}/salones', [QualificationController::class, 'salones'])->name('admin.qualifications.salones');
    Route::get('/qualifications/cursos/{idCurso}/salones/{idSalon}/notas', [QualificationController::class, 'notas'])->name('admin.qualifications.notas');
    Route::get('/activity', [ActivityController::class, 'index'])->name('admin.activity');

    // --- ACTIVIDADES (Corregido para evitar RouteNotFound) ---
    Route::prefix('activities')->group(function () {
        Route::get('/', [ActivityController::class, 'index'])->name('admin.activity');
        Route::post('/store', [ActivityController::class, 'store'])->name('admin.activities.store');
        Route::post('/asignar', [ActivityController::class, 'asignar'])->name('admin.activities.asignar');
        Route::put('/{id}/fecha', [ActivityController::class, 'updateFecha'])->name('admin.activities.updateFecha');
    });

    // --- MENSAJES ---
    Route::prefix('messages')->group(function () {
        Route::get('/', [MessageController::class, 'adminIndex'])->name('admin.messages');
        Route::get('/usuarios/{idCursoSalon}', [MessageController::class, 'usuariosSalon'])->name('admin.messages.usuarios');

        Route::post('/iniciar', [MessageController::class, 'iniciarConversacion'])->name('admin.messages.iniciar');
        Route::get('/cursos', [MessageController::class, 'cursosAdmin'])->name('admin.messages.cursos');
        Route::get('/get-chat/{id_curso}', [MessageController::class, 'getMessagesByCurso'])->name('admin.messages.getChat');
        Route::get('/curso/{id}/salones', [MessageController::class, 'salonesCurso'])->name('admin.messages.salones');
        Route::get('/conversaciones/{idSalon}', [MessageController::class, 'conversaciones'])->name('admin.messages.conversaciones');

        Route::get('/chat/{idCursoSalon}', [MessageController::class, 'chat'])->name('admin.messages.chat');

        Route::post('/responder', [MessageController::class, 'responder'])
            ->name('admin.messages.responder');

        Route::post('/store-ajax', [MessageController::class, 'storeAjax'])->name('admin.messages.ajax');
        Route::post('/store-ajax', [MessageController::class, 'storeAjax'])->name('admin.messages.store');
        Route::get('/buscar-usuarios', [MessageController::class, 'buscarUsuarios'])
            ->name('admin.buscar.usuarios');
    });

    // --- OTROS ---
    Route::get('/calendar', [CalendarController::class, 'index'])->name('admin.calendar');
    Route::get('/organizations', [OrganizationController::class, 'index'])->name('admin.organizations');
    Route::get('/tools', [ToolController::class, 'index'])->name('admin.tools');
    Route::get('/support', [SuportController::class, 'index'])->name('admin.support');
});

// ======================================================
// 🔵 ROL DOCENTE
// ======================================================
Route::prefix('docente')->middleware(['auth', 'role:docente'])->group(function () {

    // ==================================================
    // 🏠 DASHBOARD / INICIO
    // ==================================================
    Route::get('/dashboard', [Pagina_InstitucionalController::class, 'docenteDashboard'])
        ->name('docente.dashboard');

    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'docenteIndex'])
        ->name('docente.pagina_institucional');


    // ==================================================
    // 📚 CURSOS
    // ==================================================
    // --- CURSOS Y SALONES ---
    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'docenteIndex'])->name('docente.courses');
        Route::post('/', [CourseController::class, 'store'])->name('admin.courses.store');
        Route::get('/{id_curso}/docentes', [CourseController::class, 'docentes'])->name('admin.courses.docentes');
        Route::get('/{id_curso}/salones', [CourseController::class, 'salonesPorCursoDocente']);
    });

    Route::prefix('salones')->group(function () {

        Route::get('/{idSalon}/detalle', [CourseController::class, 'detalleSalon']);
        Route::post('/{idSalon}/guardar-notas', [CourseController::class, 'guardarNotasSalon']);
        Route::get('/{idSalon}/export/{idCurso}', [SalonController::class, 'export']);
        Route::post('/{idSalon}/import', [SalonController::class, 'import']);
    });

    // ==================================================
    // 📌 ACTIVIDADES
    // ==================================================
    Route::prefix('activities')->group(function () {

        Route::get('/', [ActivityController::class, 'porCurso'])->name('docente.activities');
        Route::post('/store', [ActivityController::class, 'store'])->name('docente.activities.store');
        Route::post('/asignar', [ActivityController::class, 'asignar'])->name('docente.activities.asignar');
        Route::put('/{id}/fecha', [ActivityController::class, 'updateFecha'])->name('docente.activities.updateFecha');
    });


    // ==================================================
    // 📊 CALIFICACIONES (QUALIFICATIONS)
    // ==================================================
    Route::prefix('qualifications')->group(function () {

        Route::get('/', [QualificationController::class, 'index'])->name('docente.qualifications');
        Route::get('/cursos', [QualificationController::class, 'cursos'])->name('docente.qualifications.cursos');
        Route::get('/cursos/{idCurso}/salones', [QualificationController::class, 'salones'])->name('docente.qualifications.salones');
        Route::get('/cursos/{idCurso}/salones/{idSalon}/notas', [QualificationController::class, 'notas'])->name('docente.qualifications.notas');
    });


    // ==================================================
    // 💬 MENSAJES
    // ==================================================
    Route::prefix('messages')->group(function () {
        Route::get('/', [MessageController::class, 'docenteIndex'])->name('docente.messages');
        Route::get('/usuarios/{idCursoSalon}', [MessageController::class, 'usuariosSalon'])->name('docente.messages.usuarios');

        Route::post('/iniciar', [MessageController::class, 'iniciarConversacion'])->name('docente.messages.iniciar');
        Route::get('/cursos', [MessageController::class, 'cursosDocente'])->name('docente.messages.cursos');
        Route::get('/get-chat/{id_curso}', [MessageController::class, 'getMessagesByCurso'])->name('docente.messages.getChat');
        Route::get('/curso/{id}/salones', [MessageController::class, 'salonesCurso'])->name('docente.messages.salones');
        Route::get('/conversaciones/{idSalon}', [MessageController::class, 'conversaciones'])->name('docente.messages.conversaciones');

        Route::get('/chat/{idCursoSalon}', [MessageController::class, 'chat'])->name('docente.messages.chat');

        Route::post('/responder', [MessageController::class, 'responder'])
            ->name('docente.messages.responder');

        Route::post('/store-ajax', [MessageController::class, 'storeAjax'])->name('docente.messages.store');
        Route::get('/buscar-usuarios', [MessageController::class, 'buscarUsuarios'])
            ->name('docente.buscar.usuarios');
    });


    // ==================================================
    // 📅 CALENDARIO
    // ==================================================
    Route::get('/calendar', [CalendarController::class, 'index'])
        ->name('docente.calendar');


    // ==================================================
    // 🧰 HERRAMIENTAS
    // ==================================================
    Route::get('/tools', [ToolController::class, 'index'])
        ->name('docente.tools');


    // ==================================================
    // 🆘 SOPORTE
    // ==================================================
    Route::get('/support', [SuportController::class, 'index'])
        ->name('docente.support');


    // ==================================================
    // 🧪 ETI
    // ==================================================
    Route::get('/eti', fn() => view('Docentes.eti'))
        ->name('docente.eti');
    // --- ETI ---
    Route::prefix('eti')->group(function () {
        Route::get('/', [EtisController::class, 'etiIndex'])->name('admin.eti');
        Route::get('/notas', [EtisController::class, 'getNotas']);
        Route::get('/grados/{id_nivel}', [EtisController::class, 'getGradosByNivel']);
        Route::post('/alumnos', [EtisController::class, 'getAlumnos']);
        Route::post('/guardar-promedio', [EtisController::class, 'guardarPromedio']);
        Route::post('/guardar-multiples-promedios', [EtisController::class, 'guardarMultiplesPromedios']);
        Route::get('/promedios', [EtisController::class, 'getPromedios']);
        Route::get('/exportar', [EtisController::class, 'exportarPromedios']);
    });


    
    Route::get('/docente/activities', [App\Http\Controllers\ActivityController::class, 'porCurso'])->name('docente.activities');
    Route::get('/activity', [ActivityController::class, 'index'])->name('docente.activity');
});

// --- ROL AUXILIAR ---
Route::prefix('auxiliar')->middleware(['auth', 'role:auxiliar'])->group(function () {
    Route::get('/dashboard', fn() => view('auxiliar.dashboard'))->name('auxiliar.dashboard');
    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'auxiliarIndex'])->name('auxiliar.pagina_institucional');
    Route::get('/buscar-alumnos', [MessageController::class, 'buscarAlumnos'])->name('auxiliar.messages.search');

    Route::prefix('eta')->group(function () {
        Route::get('/', [EtiController::class, 'etaIndex'])->name('auxiliar.eta');
        Route::get('/grados/{id_nivel}', [EtiController::class, 'getGradosByNivel']);
        Route::post('/alumnos', [EtiController::class, 'getAlumnos']);
        Route::post('/guardar-promedio', [EtiController::class, 'guardarPromedio']);
        Route::post('/guardar-multiples-promedios', [EtiController::class, 'guardarMultiplesPromedios']);
        Route::get('/promedios', [EtiController::class, 'getPromedios']);
        Route::get('/exportar', [EtiController::class, 'exportarPromedios']);
    });

    // --- ETA ---
    Route::prefix('eta')->group(function () {
        Route::get('/', [EtiController::class, 'etaIndex'])->name('auxiliar.eta');
        Route::get('/notas', [EtiController::class, 'getNotas']);
        Route::get('/grados/{id_nivel}', [EtiController::class, 'getGradosByNivel']);
        Route::post('/alumnos', [EtiController::class, 'getAlumnos']);
        Route::post('/guardar-promedio', [EtiController::class, 'guardarPromedio']);
        Route::post('/guardar-multiples-promedios', [EtiController::class, 'guardarMultiplesPromedios']);
        Route::get('/promedios', [EtiController::class, 'getPromedios']);
        Route::get('/exportar', [EtiController::class, 'exportarPromedios']);
    });

    Route::get('/support', [SuportController::class, 'index'])->name('auxiliar.support');
    Route::get('/activity', [ActivityController::class, 'index'])->name('auxiliar.activity');

    // ==================================================
    // 💬 MENSAJES
    // ==================================================
    Route::prefix('messages')->group(function () {
        Route::get('/', [MessageController::class, 'auxiliarIndex'])->name('auxiliar.messages');
        Route::get('/usuarios/{idCursoSalon}', [MessageController::class, 'usuariosSalon'])->name('auxiliar.messages.usuarios');

        Route::post('/iniciar', [MessageController::class, 'iniciarConversacion'])->name('auxiliar.messages.iniciar');
        Route::get('/cursos', [MessageController::class, 'cursosAuxiliar'])->name('auxiliar.messages.cursos');
        Route::get('/get-chat/{id_curso}', [MessageController::class, 'getMessagesByCurso'])->name('auxiliar.messages.getChat');
        Route::get('/curso/{id}/salones', [MessageController::class, 'salonesCurso'])->name('auxiliar.messages.salones');
        Route::get('/conversaciones/{idSalon}', [MessageController::class, 'conversaciones'])->name('auxiliar.messages.conversaciones');

        Route::get('/chat/{idCursoSalon}', [MessageController::class, 'chat'])->name('auxiliar.messages.chat');

        Route::post('/responder', [MessageController::class, 'responder'])
            ->name('auxiliar.messages.responder');

        Route::post('/store-ajax', [MessageController::class, 'storeAjax'])->name('auxiliar.messages.store');
        Route::get('/buscar-usuarios', [MessageController::class, 'buscarUsuarios'])
            ->name('auxiliar.buscar.usuarios');
    });
    Route::get('/tools', [ToolController::class, 'index'])->name('auxiliar.tools');
});

// ======================================================
// 🟢 ROL ALUMNO
// ======================================================
Route::prefix('alumno')->middleware(['auth:alumno'])->group(function () {

    // ==================================================
    // 🏠 DASHBOARD / INICIO
    // ==================================================
    Route::get('/dashboard', fn() => view('Alumno.dashboard'))
        ->name('alumno.dashboard');

    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'alumnoIndex'])
        ->name('alumno.pagina_institucional');


    // ==================================================
    // 📚 CURSOS
    // ==================================================
    Route::prefix('courses')->group(function () {

        // Vista principal de cursos
        Route::get('/', [CourseController::class, 'alumnoIndex'])
            ->name('alumno.courses');

        // Detalle del curso (actividades y notas)
        Route::get('/{idCurso}/detalle', [CourseController::class, 'detalleAlumno'])
            ->name('alumno.courses.detalle');
    });


    // ==================================================
    // 📌 ACTIVIDADES
    // ==================================================
    Route::get('/activity', [ActivityController::class, 'index'])
        ->name('alumno.activity');


    // ==================================================
    // 📊 CALIFICACIONES
    // ==================================================
    Route::prefix('qualifications')->group(function () {

        Route::get('/', [QualificationController::class, 'index'])
            ->name('alumno.qualifications');

        Route::get('/cursos', [QualificationController::class, 'cursos'])
            ->name('alumno.qualifications.cursos');

        Route::get('/cursos/{idCurso}/salones', [QualificationController::class, 'salones'])
            ->name('alumno.qualifications.salones');

        Route::get('/cursos/{idCurso}/salones/{idSalon}/notas', [QualificationController::class, 'notas'])
            ->name('alumno.qualifications.notas');
    });


    // ==================================================
    // 💬 MENSAJES
    // ==================================================
    Route::prefix('messages')->group(function () {
        Route::get('/', [MessageController::class, 'alumnoIndex'])->name('alumno.messages');
        Route::get('/usuarios/{idCursoSalon}', [MessageController::class, 'usuariosSalon'])->name('alumno.messages.usuarios');

        Route::post('/iniciar', [MessageController::class, 'iniciarConversacion'])->name('alumno.messages.iniciar');
        Route::get('/cursos', [MessageController::class, 'cursosAlumno'])->name('alumno.messages.cursos');
        Route::get('/get-chat/{id_curso}', [MessageController::class, 'getMessagesByCurso'])->name('alumno.messages.getChat');
        Route::get('/curso/{id}/salones', [MessageController::class, 'salonesCurso'])->name('alumno.messages.salones');
        Route::get('/conversaciones/{idSalon}', [MessageController::class, 'conversaciones'])->name('alumno.messages.conversaciones');

        Route::get('/chat/{idCursoSalon}', [MessageController::class, 'chat'])->name('alumno.messages.chat');

        Route::post('/responder', [MessageController::class, 'responderAlumno'])
            ->name('alumno.messages.responder');

        Route::post('/store-ajax', [MessageController::class, 'storeAjax'])->name('alumno.messages.store');
        Route::get('/buscar-usuarios', [MessageController::class, 'buscarUsuarios'])
            ->name('alumno.buscar.usuarios');
    });


    // ==================================================
    // 📅 CALENDARIO
    // ==================================================
    Route::get('/calendar', [CalendarController::class, 'index'])
        ->name('alumno.calendar');


    // ==================================================
    // 🧰 HERRAMIENTAS
    // ==================================================
    Route::get('/tools', [ToolController::class, 'index'])
        ->name('alumno.tools');


    // ==================================================
    // 🧪 ETI
    // ==================================================
    Route::get('/eti', [EtisController::class, 'index'])
        ->name('alumno.eti');


    // ==================================================
    // 🆘 SOPORTE
    // ==================================================
    Route::get('/support', [SuportController::class, 'index'])
        ->name('alumno.suport');
});

// ======================================================
// 🟢 ROL APODERADO
// ======================================================
Route::prefix('apoderado')->middleware(['auth:apoderado'])->group(function () {

    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'apoderadoIndex'])
        ->name('apoderado.pagina_institucional');


    // ==================================================
    // 📚 CURSOS
    // ==================================================
    Route::prefix('courses')->group(function () {

        // Vista principal de cursos
        Route::get('/', [CourseController::class, 'apoderadoIndex'])
            ->name('apoderado.courses');

        // Detalle del curso (actividades y notas)
        Route::get('/{idCurso}/detalle', [CourseController::class, 'detalleApoderado'])
            ->name('apoderado.courses.detalle');
    });


    // ==================================================
    // 📌 ACTIVIDADES
    // ==================================================
    Route::get('/activity', [ActivityController::class, 'index'])
        ->name('apoderado.activity');
    // ==================================================
    // 📅 CALENDARIO
    // ==================================================
    Route::get('/calendar', [CalendarController::class, 'index'])
        ->name('apoderado.calendar');


    // ==================================================
    // 🧰 HERRAMIENTAS
    // ==================================================
    Route::get('/tools', [ToolController::class, 'index'])
        ->name('apoderado.tools');


    // ==================================================
    // 🆘 SOPORTE
    // ==================================================
    Route::get('/support', [SuportController::class, 'index'])
        ->name('apoderado.suport');
});
