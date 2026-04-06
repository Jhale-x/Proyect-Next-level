<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matricula Formulario | Next Level</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/web/matricula_formulario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/next-level-logo.png') }}">
</head>

<body>

    <main>

    <section class="hero-banner">
        <div class="banner-inner">
            <div class="banner-title">
                <h1>MATRÍCULA <br> ONLINE</h1>
            </div>
            <div class="banner-contact">
                <a href="{{ route('web.inicio') }}" class="btn-banner">
                <span>INICIO</span>
            </a>
                <a href="https://wa.me/51923317625?text=Hola%20Next%20Level,%20deseo%20información.%20Me%20interesa:%0A%0A1.%20Matrícula%20Colegio%20%0A2.%20Ciclos%20Academia%20%0A3.%20Agendar%20Visita%20Guiada%0A4.%20Costos%20y%20Pensiones%0A%0APor%20favor,%20bríndeme%20detalles." target="_blank" class="whatsapp-link-wrapper">
                <div class="whatsapp-badge">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span>923 317 626</span>
                </div>
                </a>
            </div>
        </div>
    </section>

    <section class="registration-container">
        <header class="registration-header-inner"></header>

    <nav class="steps-progress">
        <div class="step-box active" id="step-1-indicator">
            <div class="step-number">1</div>
            <div class="step-info">
                <span class="step-label">Paso 1</span>
                <span class="step-name">BIENVENIDA</span>
            </div>
        </div>
        <div class="step-divider"></div>
        <div class="step-box" id="step-2-indicator">
            <div class="step-number">2</div>
            <div class="step-info">
                <span class="step-label">Paso 2</span>
                <span class="step-name">DATOS ALUMNO</span>
            </div>
        </div>
        <div class="step-divider"></div>
        <div class="step-box" id="step-3-indicator">
            <div class="step-number">3</div>
            <div class="step-info">
                <span class="step-label">Paso 3</span>
                <span class="step-name">CONFIRMACIÓN</span>
            </div>
        </div>
        <div class="step-divider"></div>
        <div class="step-box" id="step-4-indicator">
            <div class="step-number">4</div>
            <div class="step-info">
                <span class="step-label">Paso 4</span>
                <span class="step-name">FINALIZAR</span>
            </div>
        </div>

    </nav>

    <form id="enrollmentForm" class="premium-form fade-in">

    <section class="premium-card" id="welcome-card">
        <div class="card-side-accent"></div>
        <div class="card-body-content">
            <h3 class="card-section-title">
                <span class="icon-circle"><i class="fa-solid fa-user-graduate"></i></span>
                SELECCIÓN DE MODALIDAD
            </h3>

            <div class="input-field-group">
                <div class="custom-select-wrapper">
                    <select id="modalidadSelector" name="modalidad" required>
                        <option value="" disabled selected hidden>Selecciona una modalidad</option>
                        <option value="colegio">Colegio (Primaria / Secundaria)</option>
                        <option value="academia">Academia (Preparación Universitaria)</option>
                    </select>
                    <i class="fa-solid fa-chevron-down select-arrow"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="premium-card hidden-section" id="section-academia">
        <div class="card-side-accent"></div>
        <div class="card-body-content">
            <h3 class="card-section-title">
                <span class="icon-circle"><i class="fa-solid fa-building-columns"></i></span>
                ACADEMIA
            </h3>
            <div class="form-responsive-grid">
                <div class="input-field-group">
                    <select name="aca_sede" id="sedeacademiaSelector" required>
                        <option value="" disabled selected hidden>Seleccionar Sede</option>
                        <option value="Pucallpa, Ucayali">Pucallpa, Ucayali</option>
                    </select>
                </div>

                <div class="input-field-group">
                    <select name="aca_entorno" id="entornoacademiaSelector" required>
                        <option value="" disabled selected hidden>Seleccionar Entorno</option>
                        <option value="Presencial">Presencial</option>
                    </select>
                </div>

                <div class="input-field-group">
                    <select name="universidad" id="universidadSelector">
                        <option value="" disabled selected hidden>Universidad Objectivo</option>
                        <option value="unu">Preparación UNU</option>
                        <option value="unia">Preparación UNIA</option>
                        <option value="san_marcos">Preparación San Marcos</option>
                        <option value="uni">Preparación UNI</option>
                        <option value="catolica">Preparación Católica</option>
                    </select>
                </div>

                <div class="input-field-group">
                    <select id="tipoCicloSelector" disabled>
                        <option value="" disabled selected hidden>Tipo de Ciclo</option>
                        <option value="verano">Ciclo Verano</option>
                        <option value="semestral">Ciclo Semestral</option>
                        <option value="anual">Ciclo Anual</option>
                    </select>
                </div>

                <div class="input-field-group">
                    <select name="turno_academia" id="turnoAcademiaSelector" disabled>
                        <option value="" disabled selected hidden>Turno de Estudio</option>
                    </select>
                </div>
            </div>

            <div id="ciclos-container-academia" class="ciclos-wrapper hidden-section"></div>

            <div id="cronograma-container" class="hidden-section">
                <div class="cronograma-box fade-in">
                    <div class="cronograma-header">CRONOGRAMA</div>
                    <table class="cronograma-table">
                        <thead>
                            <tr><th>Cuota</th>
                                <th>Vencimiento</th>
                                <th>Importe</th>
                                <th>Descuento</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="cronograma-body"></tbody>
                        <tfoot>
                            <tr class="total-row-bold">
                                <td colspan="4" class="text-right">Totales</td>
                                <td id="cronograma-total-general">0.00</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="pago-opciones">
                        <label class="radio-pago"><input type="radio" name="p" value="c" checked> Quiero pagar en cuotas</label>
                        <label class="radio-pago"><input type="radio" name="p" value="co"> Quiero pagar al contado</label>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="premium-card hidden-section" id="section-colegio">
        <div class="card-side-accent"></div>
        <div class="card-body-content">
            <h3 class="card-section-title">
                <span class="icon-circle"><i class="fa-solid fa-school"></i></span>
                COLEGIO
            </h3>
            <div class="form-responsive-grid">
                <div class="input-field-group">
                    <select name="col_sede" id="sedecolegioSelector" required>
                        <option value="" disabled selected hidden>Seleccionar Sede</option>
                        <option value="Pucallpa, Ucayali">Pucallpa, Ucayali</option>
                    </select>
                </div>

                <div class="input-field-group">
                    <select name="col_entorno" id="entornocolegioSelector" required>
                        <option value="" disabled selected hidden>Seleccionar Entorno</option>
                        <option value="Presencial">Presencial</option>
                    </select>
                </div>

                <div class="input-field-group">
                    <select name="nivel_escolar" id="nivel_escolar">
                        <option value="" disabled selected hidden>Nivel Educativo</option>
                        <option value="primaria">Primaria</option>
                        <option value="secundaria">Secundaria</option>
                    </select>
                </div>
                <div class="input-field-group">
                    <select name="grado_escolar" id="grado_escolar" disabled>
                        <option value="" disabled selected hidden>Grado Correspondiente</option>
                    </select>
                </div>
                <div class="input-field-group">
                    <select name="seccion_escolar" id="seccion_escolar" disabled>
                        <option value="" disabled selected hidden>Sección</option>
                    </select>
                </div>

                <div class="input-field-group">
                    <select name="turno_escolar" id="turno_escolar" disabled>
                        <option value="" disabled selected hidden>Turno de Estudio</option>
                    </select>
                </div>
            </div>

            <div id="ciclos-container-colegio" class="ciclos-wrapper hidden-section"></div>

            <div id="cronograma-container-colegio" class="hidden-section">
                <div class="cronograma-box fade-in">
                    <div class="cronograma-header">CRONOGRAMA DE PAGOS ESCOLAR</div>
                    <table class="cronograma-table">
                        <thead>
                            <tr>
                                <th>Cuota</th>
                                <th>Vencimiento</th>
                                <th>Importe</th>
                                <th>Descuento</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="cronograma-body-colegio"></tbody> <tfoot>
                            <tr class="total-row-bold">
                                <td colspan="4" class="text-right">Totales</td>
                                <td id="cronograma-total-general-colegio">0.00</td> </tr>
                        </tfoot>
                    </table>
                    <div class="pago-opciones">
                        <label class="radio-pago"><input type="radio" name="p_col" value="c" checked> Quiero pagar en cuotas</label>
                        <label class="radio-pago"><input type="radio" name="p_col" value="co"> Quiero pagar al contado</label>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="premium-card hidden-section" id="step-2-colegio">
        <div class="card-side-accent"></div>
        <div class="card-body-content">
            <h3 class="card-section-title">
                <span class="icon-circle"><i class="fa-solid fa-school"></i></span>
                DATOS DEL ESCOLAR
            </h3>
            <div class="form-responsive-grid">
                <input type="text" name="col_nombres" placeholder="Nombres" required>
                <input type="text" name="col_ape_paterno" placeholder="Apellido Paterno" required>
                <input type="text" name="col_ape_materno" placeholder="Apellido Materno" required>
                <input type="date" name="col_fecha_nac" max="2020-12-31" required>
                <input type="text" name="col_dni" placeholder="DNI" maxlength="8" inputmode="numeric"required>
                <select name="col_genero" required>
                    <option value="" disabled selected hidden>Género</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
                <input type="email" name="col_email" placeholder="Correo Electrónico" required>
            </div>

            <hr class="separator-line">

            <h3 class="card-section-title">
                <span class="icon-circle"><i class="fa-solid fa-user-shield"></i></span>
                DATOS DEL APODERADO
            </h3>
            <div class="form-responsive-grid">
                <input type="text" name="apo_nombres" placeholder="Nombres" required>
                <input type="text" name="apo_ape_paterno" placeholder="Apellido Paterno" required>
                <input type="text" name="apo_ape_materno" placeholder="Apellido Materno" required>
                <input type="date" name="apo_fecha_nac" max="2008-12-31" required>
                <input type="email" name="apo_email" placeholder="Correo Electrónico" required>
                <input type="tel" name="apo_celular" placeholder="Número de Celular" maxlength="9" required>
                <input type="text" name="apo_dni" placeholder="DNI" maxlength="8" inputmode="numeric" required>
            </div>
        </div>
    </section>

    <section class="premium-card hidden-section" id="step-2-academia">
        <div class="card-side-accent"></div>
        <div class="card-body-content">
            <h3 class="card-section-title">
                <span class="icon-circle"><i class="fa-solid fa-user-graduate"></i></span>
                DATOS DEL POSTULANTE
            </h3>
            <div class="form-responsive-grid">
                <input type="text" name="aca_nombres" placeholder="Nombres" required>
                <input type="text" name="aca_ape_paterno" placeholder="Apellido Paterno" required>
                <input type="text" name="aca_ape_materno" placeholder="Apellido Materno" required>
                <input type="text" name="aca_dni" placeholder="DNI" maxlength="8" inputmode="numeric" required>
                <input type="email" name="aca_email" placeholder="Correo Electrónico" required>
                <select name="aca_genero" required>
                    <option value="" disabled selected hidden>Género</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
                <input type="date" name="aca_fecha_nac" max="2020-12-31" required>
                <input type="tel" name="aca_celular" placeholder="Número de Celular" maxlength="9" required>
            </div>

            <div id="cont-mayor-edad" class="mayor-edad-container">
                <span class="switch-label">¿Soy mayor de edad (sin apoderado)?</span>
                <div class="switch-options">
                    <label class="radio-option"><input type="radio" name="es_mayor" value="si"> Sí</label>
                    <label class="radio-option"><input type="radio" name="es_mayor" value="no" checked> No</label>
                </div>
            </div>

            <div id="seccion-apoderado-academia">
                <hr class="separator-line">
                <h3 class="card-section-title">
                    <span class="icon-circle"><i class="fa-solid fa-user-shield"></i></span>
                    DATOS DEL APODERADO
                </h3>
                <div class="form-responsive-grid">
                    <input type="text" name="aca_apo_nombres" placeholder="Nombres" required>
                    <input type="text" name="aca_apo_ape_paterno" placeholder="Apellido Paterno" required>
                    <input type="text" name="aca_apo_ape_materno" placeholder="Apellido Materno" required>
                    <input type="date" name="aca_apo_fecha_nac" max="2008-12-31" required>
                    <input type="email" name="aca_apo_email" placeholder="Correo Electrónico" required>
                    <input type="tel" name="aca_apo_celular" placeholder="Número de Celular" maxlength="9" required>
                    <input type="text" name="aca_apo_dni" placeholder="DNI" maxlength="8" inputmode="numeric" required>
                </div>
            </div>
        </div>
    </section>

    <section class="premium-card hidden-section" id="step-3-resumen">
        <div class="card-side-accent"></div>
        <div class="card-body-content">
            <h3 class="card-section-title">
                <span class="icon-circle"><i class="fa-solid fa-file-invoice"></i></span>
                CONFIRMACIÓN DE DATOS REGISTRADOS
            </h3>

            <div class="resumen-premium-grid">
                <div class="resumen-card-mini">
                    <header><i class="fa-solid fa-graduation-cap"></i> INFORMACIÓN ACADÉMICA</header>
                    <div class="res-content">
                        <p><strong>Modalidad:</strong> <span id="res-modalidad">-</span></p>
                        <p><strong>Elección:</strong> <span id="res-eleccion">-</span></p>
                        <p><strong>Ciclo/Grado:</strong> <span id="res-ciclo">-</span></p>
                        <p><strong>Sede:</strong> <span id="res-sede">-</span></p>
                        <p><strong>Entorno:</strong> <span id="res-entorno">-</span></p>
                        <p><strong>Turno:</strong> <span id="res-turno">-</span></p>
                    </div>
                </div>

                <div class="resumen-card-mini">
                    <header><i class="fa-solid fa-user"></i> DATOS DEL ESTUDIANTE</header>
                    <div class="res-content">
                        <p><strong>Nombres:</strong> <span id="res-alumno-full">-</span></p>
                        <p><strong>DNI:</strong> <span id="res-alumno-dni">-</span></p>
                        <p><strong>Correo:</strong> <span id="res-alumno-email">-</span></p>
                        <p><strong>Celular:</strong> <span id="res-alumno-celular">-</span></p>
                        <p><strong>Género/Nac:</strong> <span id="res-alumno-extra">-</span></p>
                    </div>
                </div>

                <div class="resumen-card-mini" id="res-card-apoderado">
                    <header><i class="fa-solid fa-user-shield"></i> DATOS DEL APODERADO</header>
                    <div class="res-content">
                        <p><strong>Responsable:</strong> <span id="res-apo-nombre">-</span></p>
                        <p><strong>DNI:</strong> <span id="res-apo-dni">-</span></p>
                        <p><strong>Contacto:</strong> <span id="res-apo-cel">-</span></p>
                    </div>
                </div>

                <div class="resumen-card-mini highlight-card full-width-resumen">
                    <header><i class="fa-solid fa-wallet"></i> RESUMEN DE INVERSIÓN</header>
                    <div class="res-content">
                        <p><strong>Plan Elegido:</strong> <span id="res-pago-metodo">-</span></p>

                        <div class="cronograma-resumen-container">
                            <table class="resumen-tabla-mini">
                                <thead>
                                    <tr>
                                        <th>Cuota</th>
                                        <th>Vencimiento</th>
                                        <th>Descuento</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="res-cronograma-body-final">
                                    </tbody>
                            </table>
                        </div>

                        <p class="total-destacado">
                        <strong>TOTAL FINAL :</strong> S/ <span id="res-pago-total">0.00</span></p>
                    </div>
                </div>
            </div>

            <div class="terms-container-v2">
                <label class="checkbox-premium">
                    <input type="checkbox" id="check-terminos">
                    <span class="check-text">He leído y acepto los <a href="#">Términos y Condiciones</a>.</span>
                </label>
                <label class="checkbox-premium">
                    <input type="checkbox" id="check-politicas">
                    <span class="check-text">He leído y acepto la <a href="#">Política de Privacidad y Cookies</a>.</span>
                </label>
            </div>
        </div>
    </section>

        <div class="form-footer-actions hidden-section" id="footer-actions">
            <button type="button" class="btn-premium-next">
                Continuar Proceso <i class="fa-solid fa-arrow-right-long"></i>
            </button>
        </div>

        <div class="step2-navigation-actions hidden-section">
            <button type="button" class="btn-premium-prev">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar Proceso
            </button>
            <button type="button" class="btn-premium-next-step2">
                Continuar Proceso <i class="fa-solid fa-arrow-right-long"></i>
            </button>
        </div>

    </form>
    </section>

    <template id="template-fila-resumen">
        <tr>
            <td class="res-col-cuota"></td>
            <td class="res-col-vencimiento"></td>
            <td class="res-col-descuento"></td>
            <td class="res-col-total"></td>
        </tr>
    </template>

    <template id="template-ciclo">
        <label class="ciclo-card">
            <input type="radio" name="ciclo_op" class="ciclo-radio">
            <div class="ciclo-text-box">
                <span class="nombre-ciclo"></span>
                <span class="fechas-ciclo"></span>
            </div>
        </label>
    </template>

    <template id="template-fila-cronograma">
        <tr>
            <td class="col-cuota"></td>
            <td class="col-vencimiento"></td>
            <td class="col-importe"></td>
            <td class="col-descuento">0.00</td>
            <td class="col-total"></td>
        </tr>
    </template>

    </main>

    <script src="{{ asset('js/matricula_formulario.js') }}"></script>

</body>
</html>
