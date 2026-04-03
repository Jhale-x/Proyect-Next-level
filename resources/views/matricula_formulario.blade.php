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
                    <select name="turno_academia" id="turnoAcademiaSelector" disabled>
                        <option value="" disabled selected hidden>Turno de Estudio</option>
                    </select>
                </div>
            </div>

            <div id="ciclos-container" class="ciclos-wrapper hidden-section"></div>

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
                <input type="date" name="col_fecha_nac" required>
                <input type="text" name="col_dni" placeholder="DNI" maxlength="8" required>
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
                <input type="text" name="apo_dni" placeholder="DNI" maxlength="8" required>
                <input type="email" name="apo_email" placeholder="Correo Electrónico" required>
                <input type="tel" name="apo_celular" placeholder="Número de Celular" required>
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
                <input type="text" name="aca_dni" placeholder="DNI" maxlength="8" required>
                <input type="email" name="aca_email" placeholder="Correo Electrónico" required>
                <select name="aca_genero" required>
                    <option value="" disabled selected hidden>Género</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
                <input type="date" name="aca_fecha_nac" required>
                <input type="tel" name="aca_celular" placeholder="Número de Celular" required>
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
                    <input type="text" name="aca_apo_nombres" placeholder="Nombres">
                    <input type="text" name="aca_apo_ape_paterno" placeholder="Apellido Paterno">
                    <input type="text" name="aca_apo_ape_materno" placeholder="Apellido Materno">
                    <input type="text" name="aca_apo_dni" placeholder="DNI" maxlength="8">
                    <input type="email" name="aca_apo_email" placeholder="Correo Electrónico">
                    <input type="tel" name="aca_apo_celular" placeholder="Número de Celular">
                </div>
            </div>
        </div>
    </section>

        <div class="form-footer-actions hidden-section" id="footer-actions">
            <button type="button" class="btn-premium-next">
                Continuar Proceso <i class="fa-solid fa-arrow-right-long"></i>
            </button>
        </div>
    </form>
    </section>

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
