<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Formulario de matrícula | Next Level</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/web/matricula-base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/matricula_formulario.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/next-level-logo.png') }}">
</head>
@php
    $pago = config('matricula.pago');
    $soles = fn ($m) => $m !== null ? 'S/ ' . number_format($m, 2) : null;
    // Si solo hay una opción, se deja seleccionada.
    $unica = fn ($lista) => $lista->count() === 1 ? $lista->first()['id'] : null;
    $hoy = now()->format('Y-m-d');
@endphp
<body class="mt-page mf-page">

    <header class="mf-top">
        <div class="mt-container mf-top__inner">
            <a href="{{ route('web.inicio') }}" class="mf-top__brand">
                <img src="{{ asset('images/logo_letras.png') }}" alt="Next Level">
            </a>
            <nav class="mf-top__actions">
                <a href="https://wa.me/{{ config('matricula.whatsapp') }}?text={{ rawurlencode('Hola Next Level, necesito ayuda con mi matrícula.') }}" target="_blank" rel="noopener" class="mf-top__link">
                    <i class="fa-brands fa-whatsapp"></i> <span>{{ config('matricula.telefono') }}</span>
                </a>
                <a href="{{ route('matricula') }}" class="mf-top__link mf-top__link--muted"><i class="fa-solid fa-arrow-left"></i> <span>Salir</span></a>
            </nav>
        </div>
    </header>

    <section class="mf-hero">
        <div class="mt-container">
            <div class="mf-hero__head">
                <div>
                    <h1>Matrícula online</h1>
                    <p>Hola, <strong>{{ \Illuminate\Support\Str::title(mb_strtolower($datos['nombres'])) }}</strong> <span class="mf-verified"><i class="fa-solid fa-circle-check"></i> DNI {{ $datos['dni'] }} verificado</span></p>
                </div>
            </div>

            <ol class="mf-stepper" id="mfStepper">
                <li class="is-active" data-step="1"><span>1</span><b>Programa</b></li>
                <li data-step="2"><span>2</span><b>Datos</b></li>
                <li data-step="3"><span>3</span><b>Confirmación</b></li>
                <li data-step="4"><span>4</span><b>Pago</b></li>
            </ol>
        </div>
    </section>

    <main class="mt-container mf-layout" id="mfLayout">
        <form id="mfForm" class="mf-main" novalidate>

            {{-- ==================== PASO 1: PROGRAMA ==================== --}}
            <section class="mf-step" data-step="1">
                <div class="mt-card">
                    <h2 class="mf-title"><span>1</span> ¿Qué deseas matricular?</h2>

                    <div class="mf-modalidades" role="radiogroup" aria-label="Modalidad">
                        <label class="mf-modalidad">
                            <input type="radio" name="modalidad" value="colegio">
                            <span class="mf-modalidad__body">
                                <i class="fa-solid fa-school"></i>
                                <b>Colegio</b>
                                <small>Primaria y Secundaria</small>
                                @if($soles($desdeColegio))<em>Desde {{ $soles($desdeColegio) }}</em>@endif
                            </span>
                        </label>
                        <label class="mf-modalidad">
                            <input type="radio" name="modalidad" value="academia">
                            <span class="mf-modalidad__body">
                                <i class="fa-solid fa-building-columns"></i>
                                <b>Academia</b>
                                <small>Preparación universitaria</small>
                                @if($soles($desdeAcademia))<em>Desde {{ $soles($desdeAcademia) }}</em>@endif
                            </span>
                        </label>
                    </div>

                    <div id="mfPrograma" hidden>
                        <div class="mf-grid">
                            <div class="mt-field">
                                <label for="id_sede">Sede</label>
                                <select id="id_sede" name="id_sede" required>
                                    <option value="">Selecciona</option>
                                    @foreach($sedes as $o)
                                        <option value="{{ $o['id'] }}" @selected($unica($sedes) == $o['id'])>{{ $o['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-field">
                                <label for="id_entorno">Entorno</label>
                                <select id="id_entorno" name="id_entorno" required>
                                    <option value="">Selecciona</option>
                                    @foreach($entornos as $o)
                                        <option value="{{ $o['id'] }}" @selected($unica($entornos) == $o['id'])>{{ $o['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Academia --}}
                            <div class="mt-field" data-solo="academia">
                                <label for="id_universidad">Universidad a la que postulas</label>
                                <select id="id_universidad" name="id_universidad">
                                    <option value="">Selecciona</option>
                                    @foreach($universidades as $o)
                                        <option value="{{ $o['id'] }}">{{ $o['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-field" data-solo="academia">
                                <label for="id_tipo_ciclo">Tipo de ciclo</label>
                                <select id="id_tipo_ciclo" name="id_tipo_ciclo">
                                    <option value="">Selecciona</option>
                                    @foreach($tiposCiclo as $o)
                                        <option value="{{ $o['id'] }}">{{ $o['nombre'] }}{{ $o['detalle'] ? " · {$o['detalle']}" : '' }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Colegio --}}
                            <div class="mt-field" data-solo="colegio">
                                <label for="id_nivel">Nivel educativo</label>
                                <select id="id_nivel" name="id_nivel">
                                    <option value="">Selecciona</option>
                                    @foreach($niveles as $o)
                                        <option value="{{ $o['id'] }}">{{ $o['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-field" data-solo="colegio">
                                <label for="grado">Grado</label>
                                <select id="grado" name="grado" disabled>
                                    <option value="">Primero elige el nivel</option>
                                </select>
                            </div>
                            <div class="mt-field" data-solo="colegio">
                                <label for="seccion">Sección</label>
                                <select id="seccion" name="seccion">
                                    <option value="">Selecciona</option>
                                    @foreach($secciones as $o)
                                        <option value="{{ $o['id'] }}">{{ $o['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-field">
                                <label for="id_turno">Turno</label>
                                <select id="id_turno" name="id_turno" required>
                                    <option value="">Selecciona</option>
                                    @foreach($turnos as $o)
                                        <option value="{{ $o['id'] }}">{{ $o['nombre'] }}{{ $o['detalle'] ? " · {$o['detalle']}" : '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <h3 class="mf-subtitle">Ciclos disponibles</h3>
                        <div class="mf-ciclos" id="mfCiclos" role="radiogroup" aria-label="Ciclo">
                            <p class="mf-empty"><i class="fa-regular fa-calendar"></i> Completa las opciones de arriba para ver los ciclos y sus precios.</p>
                        </div>
                    </div>
                </div>

                <div class="mf-actions">
                    <span></span>
                    <button type="button" class="mt-btn mt-btn--primary" data-ir="2">Continuar <i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </section>

            {{-- ==================== PASO 2: DATOS ==================== --}}
            <section class="mf-step" data-step="2" hidden>
                <div class="mt-card">
                    <h2 class="mf-title"><span>2</span> Datos del estudiante</h2>

                    <div class="mf-question" id="mfQuienVerifico">
                        <p>El DNI verificado <b>{{ $datos['dni'] }}</b> ({{ \Illuminate\Support\Str::title(mb_strtolower($datos['nombre_completo'])) }}) pertenece al:</p>
                        <div class="mf-pills">
                            <label><input type="radio" name="verificado_es" value="estudiante" checked><span>Estudiante</span></label>
                            <label><input type="radio" name="verificado_es" value="apoderado"><span>Apoderado</span></label>
                        </div>
                    </div>

                    <div class="mf-grid">
                        <div class="mt-field"><label for="alumno_nombres">Nombres</label><input type="text" id="alumno_nombres" name="alumno_nombres" required maxlength="100" autocomplete="given-name"></div>
                        <div class="mt-field"><label for="alumno_ape_paterno">Apellido paterno</label><input type="text" id="alumno_ape_paterno" name="alumno_ape_paterno" required maxlength="100"></div>
                        <div class="mt-field"><label for="alumno_ape_materno">Apellido materno</label><input type="text" id="alumno_ape_materno" name="alumno_ape_materno" required maxlength="100"></div>
                        <div class="mt-field"><label for="alumno_dni">DNI</label><input type="text" id="alumno_dni" name="alumno_dni" required inputmode="numeric" maxlength="8" data-patron="dni"></div>
                        <div class="mt-field"><label for="alumno_fecha_nac">Fecha de nacimiento</label><input type="date" id="alumno_fecha_nac" name="alumno_fecha_nac" required max="{{ $hoy }}" min="1940-01-01"></div>
                        <div class="mt-field">
                            <span class="mt-label">Género</span>
                            <div class="mf-pills mf-pills--full">
                                <label><input type="radio" name="alumno_genero" value="M" required><span>Masculino</span></label>
                                <label><input type="radio" name="alumno_genero" value="F"><span>Femenino</span></label>
                            </div>
                        </div>
                        <div class="mt-field"><label for="alumno_email">Correo electrónico</label><input type="email" id="alumno_email" name="alumno_email" required maxlength="100" autocomplete="email" placeholder="nombre@gmail.com"></div>
                        <div class="mt-field">
                            <label for="alumno_celular">Celular <span class="mt-optional" id="celularOpcional">(opcional)</span></label>
                            <input type="tel" id="alumno_celular" name="alumno_celular" inputmode="numeric" maxlength="9" data-patron="celular" placeholder="9XXXXXXXX">
                        </div>
                    </div>
                    <p class="mf-hint"><i class="fa-solid fa-envelope"></i> Al correo del estudiante enviaremos sus credenciales cuando se verifique el pago.</p>

                    <div class="mf-question" id="mfMayorEdad" hidden>
                        <p>¿El postulante es <b>mayor de edad</b> y se matricula sin apoderado?</p>
                        <div class="mf-pills">
                            <label><input type="radio" name="es_mayor" value="si"><span>Sí</span></label>
                            <label><input type="radio" name="es_mayor" value="no" checked><span>No</span></label>
                        </div>
                    </div>
                </div>

                <div class="mt-card" id="mfApoderado">
                    <h2 class="mf-title"><span><i class="fa-solid fa-user-shield"></i></span> Datos del apoderado</h2>
                    <div class="mf-grid">
                        <div class="mt-field"><label for="apoderado_nombres">Nombres</label><input type="text" id="apoderado_nombres" name="apoderado_nombres" required maxlength="100"></div>
                        <div class="mt-field"><label for="apoderado_ape_paterno">Apellido paterno</label><input type="text" id="apoderado_ape_paterno" name="apoderado_ape_paterno" required maxlength="100"></div>
                        <div class="mt-field"><label for="apoderado_ape_materno">Apellido materno</label><input type="text" id="apoderado_ape_materno" name="apoderado_ape_materno" required maxlength="100"></div>
                        <div class="mt-field"><label for="apoderado_dni">DNI</label><input type="text" id="apoderado_dni" name="apoderado_dni" required inputmode="numeric" maxlength="8" data-patron="dni"></div>
                        <div class="mt-field"><label for="apoderado_fecha_nac">Fecha de nacimiento</label><input type="date" id="apoderado_fecha_nac" name="apoderado_fecha_nac" required max="{{ $hoy }}" min="1920-01-01"></div>
                        <div class="mt-field"><label for="apoderado_celular">Celular</label><input type="tel" id="apoderado_celular" name="apoderado_celular" required inputmode="numeric" maxlength="9" data-patron="celular" placeholder="9XXXXXXXX"></div>
                        <div class="mt-field mf-grid__full"><label for="apoderado_email">Correo electrónico</label><input type="email" id="apoderado_email" name="apoderado_email" required maxlength="100" placeholder="nombre@gmail.com"></div>
                    </div>
                </div>

                <div class="mf-actions">
                    <button type="button" class="mt-btn mt-btn--ghost" data-ir="1"><i class="fa-solid fa-arrow-left"></i> Atrás</button>
                    <button type="button" class="mt-btn mt-btn--primary" data-ir="3">Revisar matrícula <i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </section>

            {{-- ==================== PASO 3: CONFIRMACIÓN ==================== --}}
            <section class="mf-step" data-step="3" hidden>
                <div class="mt-card">
                    <h2 class="mf-title"><span>3</span> Revisa y confirma</h2>
                    <div id="mfErrores" class="mt-alert mt-alert--error" role="alert" hidden></div>

                    <div class="mf-review">
                        <div class="mf-review__block">
                            <h3><i class="fa-solid fa-graduation-cap"></i> Programa <button type="button" class="mf-edit" data-ir="1">Editar</button></h3>
                            <dl id="revPrograma"></dl>
                        </div>
                        <div class="mf-review__block">
                            <h3><i class="fa-solid fa-user"></i> Estudiante <button type="button" class="mf-edit" data-ir="2">Editar</button></h3>
                            <dl id="revEstudiante"></dl>
                        </div>
                        <div class="mf-review__block" id="revApoderadoBlock">
                            <h3><i class="fa-solid fa-user-shield"></i> Apoderado <button type="button" class="mf-edit" data-ir="2">Editar</button></h3>
                            <dl id="revApoderado"></dl>
                        </div>
                    </div>

                    <div class="mf-terms">
                        <label class="mf-check"><input type="checkbox" id="terminos_aceptados"><span>He leído y acepto los <a href="#" onclick="return false;">Términos y Condiciones</a>.</span></label>
                        <label class="mf-check"><input type="checkbox" id="politicas_aceptadas"><span>He leído y acepto la <a href="#" onclick="return false;">Política de Privacidad</a>.</span></label>
                    </div>
                </div>

                <div class="mf-actions">
                    <button type="button" class="mt-btn mt-btn--ghost" data-ir="2"><i class="fa-solid fa-arrow-left"></i> Atrás</button>
                    <button type="submit" class="mt-btn mt-btn--primary" id="mfConfirmar" disabled>Confirmar matrícula <i class="fa-solid fa-check"></i></button>
                </div>
            </section>

            {{-- ==================== PASO 4: PAGO ==================== --}}
            <section class="mf-step" data-step="4" hidden>
                <div class="mt-card mf-success">
                    <div class="mf-success__icon"><i class="fa-solid fa-check"></i></div>
                    <h2 id="finTitulo">¡Matrícula registrada!</h2>
                    <p class="mt-muted" id="finSubtitulo">Solo falta tu pago. Indica este código al pagar:</p>

                    <div class="mf-code">
                        <span id="finCodigo">NL-0000-000000</span>
                        <button type="button" class="mt-copy" data-copiar="#finCodigo"><i class="fa-regular fa-copy"></i> Copiar</button>
                    </div>

                    <div class="mf-due">
                        <div><small>Total a pagar</small><b>S/ <span id="finMonto">0.00</span></b></div>
                        <div><small>Pagar antes del</small><b id="finExpira">-</b></div>
                    </div>
                </div>

                {{-- Pago en línea con Culqi: solo se muestra si está configurado (ver partials/culqi) --}}
                <div class="mt-card mf-online" id="finOnline" hidden>
                    <div class="mf-online__info">
                        <h3><i class="fa-solid fa-bolt"></i> Paga en línea y recibe tus credenciales al instante</h3>
                        <p class="mt-muted">Con tarjeta de crédito, débito o Yape. Pago seguro procesado por Culqi.</p>
                        <p class="mf-online__prueba" id="finPrueba" hidden><i class="fa-solid fa-flask"></i> Modo de prueba: no se cobra dinero real.</p>
                    </div>
                    <button type="button" class="mt-btn mt-btn--primary" id="finPagar"><i class="fa-solid fa-lock"></i> Pagar S/ <span id="finPagarMonto">0.00</span></button>
                    <p class="mf-online__msg" id="finPagoMsg" role="status" hidden></p>
                </div>
                <p class="mf-or" id="finOr" hidden><span>o paga por QR o transferencia y envíanos tu comprobante</span></p>

                <div class="mf-paygrid" id="finManual">
                    <div class="mt-card mf-pay-qr">
                        <h3><i class="fa-solid fa-qrcode"></i> Paga con QR</h3>
                        <p class="mt-muted">Yape, Plin, BBVA o cualquier billetera.</p>
                        <img src="{{ asset($pago['qr']) }}" alt="QR de pago">
                    </div>
                    <div class="mt-card mf-pay-bank">
                        <h3><i class="fa-solid fa-building-columns"></i> Transferencia {{ $pago['banco'] }}</h3>
                        <dl>
                            <div><dt>N° de cuenta</dt><dd><span id="payCuenta">{{ $pago['cuenta'] }}</span> <button type="button" class="mt-copy" data-copiar="#payCuenta">Copiar</button></dd></div>
                            <div><dt>CCI</dt><dd><span id="payCci">{{ $pago['cci'] }}</span> <button type="button" class="mt-copy" data-copiar="#payCci">Copiar</button></dd></div>
                            <div><dt>Titular</dt><dd>{{ $pago['titular'] }}</dd></div>
                        </dl>
                    </div>
                </div>

                <div class="mt-card" id="finPasos">
                    <h3 class="mf-subtitle mf-subtitle--flush">¿Qué sigue?</h3>
                    <ol class="mf-timeline">
                        <li><b>Realiza tu pago</b><span>Dentro de las próximas 24 horas, o tu código vencerá.</span></li>
                        <li><b>Envíanos tu comprobante</b><span>Por WhatsApp, indicando tu código de matrícula.</span></li>
                        <li><b>Recibe tus credenciales</b><span>Al verificar tu pago te llegará un correo a <strong id="finEmail">tu correo</strong> con tu usuario (<strong>DNI</strong>) y contraseña (<strong>fecha de nacimiento</strong>, ddmmaaaa).</span></li>
                    </ol>
                </div>

                <div class="mf-actions">
                    <a href="{{ route('web.inicio') }}" class="mt-btn mt-btn--ghost"><i class="fa-solid fa-house"></i> Ir al inicio</a>
                    <a href="#" id="finWhatsapp" target="_blank" rel="noopener" class="mt-btn mt-btn--whatsapp"><i class="fa-brands fa-whatsapp"></i> Enviar comprobante</a>
                </div>
            </section>
        </form>

        {{-- ==================== RESUMEN LATERAL ==================== --}}
        <aside class="mf-summary" id="mfSummary" aria-label="Resumen de tu matrícula">
            <div class="mt-card">
                <h2><i class="fa-solid fa-receipt"></i> Tu matrícula</h2>
                <dl class="mf-summary__list">
                    <div><dt>Modalidad</dt><dd id="sumModalidad">—</dd></div>
                    <div><dt>Programa</dt><dd id="sumPrograma">—</dd></div>
                    <div><dt>Ciclo</dt><dd id="sumCiclo">—</dd></div>
                    <div><dt>Turno</dt><dd id="sumTurno">—</dd></div>
                </dl>
                <div class="mf-summary__money" id="sumDinero" hidden>
                    <div><span>Matrícula</span><span id="sumImporte">S/ 0.00</span></div>
                    <div class="mf-summary__discount"><span>Dscto. contado (5%)</span><span id="sumDescuento">− S/ 0.00</span></div>
                    <div class="mf-summary__total"><span>Total</span><span id="sumTotal">S/ 0.00</span></div>
                </div>
                <p class="mf-summary__note"><i class="fa-solid fa-lock"></i> Pago único al contado. Tus datos están protegidos.</p>
            </div>
        </aside>
    </main>

    <template id="tplCiclo">
        <label class="mf-ciclo">
            <input type="radio" name="id_ciclo">
            <span class="mf-ciclo__body">
                <span class="mf-ciclo__info"><b class="mf-ciclo__nombre"></b><small class="mf-ciclo__fechas"></small></span>
                <span class="mf-ciclo__precio"><s class="mf-ciclo__antes"></s><b class="mf-ciclo__total"></b></span>
            </span>
        </label>
    </template>

    <script>
        window.MATRICULA = {
            rutaGuardar: @json(route('matricula.guardar')),
            verificado: @json($datos),
            whatsapp: @json(config('matricula.whatsapp')),
        };
    </script>
    @include('partials.culqi')
    <script src="{{ asset('js/matricula_formulario.js') }}"></script>
</body>
</html>
