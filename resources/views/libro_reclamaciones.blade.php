{{--

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Libro de Reclamaciones | Next Level</title>
    <meta name="description" content="En Next Level School nos importa tu conformidad. Ponemos a tu disposición nuestro Libro de Reclamaciones para atender cualquier disconformidad de manera rápida.">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Libro de Reclamaciones | Next Level">
    <meta property="og:image" content="{{ asset('images/Logo-Next-Level.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/web/libro_reclamaciones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/terminos_condiciones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/cookies_principal.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Logo-Next-Level.png') }}">
</head>

<body>

    <main>

    <section class="hero-banner">
        <div class="banner-inner">
            <div class="banner-title">
                <h1>LIBRO DE <br> RECLAMACIONES</h1>
            </div>
            <div class="banner-contact">
                <a href="{{ route('web.inicio') }}" class="btn-banner">
                <span>INICIO</span>
            </a>
                <a href="https://wa.me/51923317625?text=Hola%20Next%20Level,%20deseo%20más%20información." target="_blank" class="whatsapp-link-wrapper">
                <div class="whatsapp-badge">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span>923 317 626</span>
                </div>
                </a>
            </div>
        </div>
    </section>

    <div class="contenedor-principal">

        <header class="cabecera-libro">
            <div class="titulos-cabecera">
                <h2 class="titulo-principal">Registro Virtual de Disconformidades</h2>
                <p class="subtitulo">Conforme a lo establecido en el Código de Protección y Defensa del Consumidor.</p>
            </div>
            <div class="recuadro-correlativo">
                <p class="texto-hoja">Hoja de Reclamación</p>
                <p class="codigo-hoja" id="claim-number-header">N° Correlativo Automático</p>
            </div>
        </header>

        <form id="claimForm" action="{{ route('reclamaciones.store') }}" method="POST" class="formulario-reclamacion" novalidate>
            @csrf

            <section class="seccion-formulario">
                <h3 class="titulo-seccion">1. Identificación del Consumidor Reclamante</h3>

                <div class="fila-dos-columnas">
                    <div class="bloque-input">
                        <label for="nombre_completo" class="etiqueta-input">Nombres y Apellidos *</label>
                        <input type="text" id="nombre_completo" name="nombre_completo" class="campo-texto" required>
                    </div>
                    <div class="bloque-input">
                        <label for="tipo_documento" class="etiqueta-input">Tipo de Documento *</label>
                        <select id="tipo_documento" name="tipo_documento" class="campo-select" required>
                            <option value="">Selecciona una opción</option>
                            <option value="DNI">DNI</option>
                            <option value="CE">Carnet de Extranjería</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                    </div>
                </div>

                <div class="fila-tres-columnas">
                    <div class="bloque-input">
                        <label for="numero_documento" class="etiqueta-input">Número de Documento *</label>
                        <input type="text" id="numero_documento" name="numero_documento" class="campo-texto" required>
                    </div>
                    <div class="bloque-input">
                        <label for="telefono" class="etiqueta-input">Teléfono/Celular *</label>
                        <input type="tel" id="telefono" name="telefono" class="campo-texto" required>
                    </div>
                    <div class="bloque-input">
                        <label for="correo" class="etiqueta-input">Correo Electrónico *</label>
                        <input type="email" id="correo" name="correo" class="campo-texto" required>
                    </div>
                </div>

                <div class="bloque-input">
                    <label for="domicilio" class="etiqueta-input">Domicilio actual *</label>
                    <input type="text" id="domicilio" name="domicilio" class="campo-texto" required>
                </div>
            </section>

            <section class="seccion-apoderado">
                <div class="opcion-checkbox">
                    <input type="checkbox" id="es_menor_edad" name="es_menor_edad" class="campo-checkbox">
                    <label for="es_menor_edad" class="etiqueta-checkbox">
                        Soy menor de edad (Registrar datos de papá, mamá o apoderado)
                    </label>
                </div>

                <div id="guardian_fields" class="fila-dos-columnas padding-superior" hidden>
                    <div class="bloque-input">
                        <label for="nombre_apoderado" class="etiqueta-input">Nombre Completo del Apoderado *</label>
                        <input type="text" id="nombre_apoderado" name="nombre_apoderado" class="campo-texto">
                    </div>
                    <div class="bloque-input">
                        <label for="documento_apoderado" class="etiqueta-input">DNI / Doc. Apoderado *</label>
                        <input type="text" id="documento_apoderado" name="documento_apoderado" class="campo-texto">
                    </div>
                </div>
            </section>

            <section class="seccion-formulario">
                <h3 class="titulo-seccion">2. Identificación del Bien Contratado</h3>

                <div class="fila-dos-columnas">
                    <div class="bloque-input">
                        <label class="etiqueta-input">Tipo de Bien *</label>
                        <div class="grupo-radios">
                            <label class="opcion-radio">
                                <input type="radio" name="tipo_bien" value="Producto" class="campo-radio">
                                <span class="texto-radio">Producto (Libros, uniformes, etc.)</span>
                            </label>
                            <label class="opcion-radio">
                                <input type="radio" name="tipo_bien" value="Servicio" checked class="campo-radio">
                                <span class="texto-radio">Servicio (Pensión, matrícula, ciclos)</span>
                            </label>
                        </div>
                    </div>
                    <div class="bloque-input">
                        <label for="monto_reclamado" class="etiqueta-input">Monto Reclamado (S/.) u Objeto del reclamo</label>
                        <input type="number" id="monto_reclamado" name="monto_reclamado" placeholder="0.00" step="0.01" class="campo-texto">
                    </div>
                </div>

                <div class="bloque-input">
                    <label for="descripcion_bien" class="etiqueta-input">Descripción del producto o servicio adquirido *</label>
                    <textarea id="descripcion_bien" name="descripcion_bien" rows="2" placeholder="Ej: Matrícula Ciclo Academia 2026 / Pensión de 4to de Secundaria" class="campo-textarea" required></textarea>
                </div>
            </section>

            <section class="seccion-formulario">
                <h3 class="titulo-seccion">3. Detalle de la Reclamación y Pedido</h3>

                <div class="bloque-input">
                    <label class="etiqueta-input">Tipo de Incidencia *</label>
                    <div class="grupo-radios">
                        <label class="opcion-radio">
                            <input type="radio" name="tipo_incidencia" value="Reclamo" checked class="campo-radio">
                            <span class="texto-radio-negrita">Reclamo</span>
                        </label>
                        <label class="opcion-radio">
                            <input type="radio" name="tipo_incidencia" value="Queja" class="campo-radio">
                            <span class="texto-radio-negrita">Queja</span>
                        </label>
                    </div>
                </div>

                <div class="bloque-input">
                    <label for="detalle_incidencia" class="etiqueta-input">Detalle de la Queja o Reclamo *</label>
                    <textarea id="detalle_incidencia" name="detalle_incidencia" rows="4" class="campo-textarea" required></textarea>
                </div>

                <div class="bloque-input">
                    <label for="pedido_consumidor" class="etiqueta-input">Pedido o Solicitud del consumidor *</label>
                    <textarea id="pedido_consumidor" name="pedido_consumidor" rows="3" placeholder="¿Qué solución espera recibir?" class="campo-textarea" required></textarea>
                </div>
            </section>

            <section class="seccion-final">
                <div class="opcion-checkbox-inicio">
                    <input type="checkbox" id="terms" name="terms" class="campo-checkbox" required>
                    <label for="terms" class="etiqueta-terminos">
                        Declaro ser el titular del servicio y acepto que las notificaciones del estado de este trámite se realicen a mi correo electrónico.
                    </label>
                </div>

                <div class="bloque-boton">
                    <button type="submit" class="boton-enviar">
                        Enviar Reclamación
                    </button>
                </div>
            </section>
        </form>
    </div>

    </main>

    <div class="footer-bottom">
        <p>© 2026 Next Level. Todos los derechos reservados.</p>
    </div>

    <script src="{{ asset('js/libro_reclamaciones.js') }}"></script>
    <script src="{{ asset('js/cookie-banner.js') }}"></script>

    <x-cookie-banner />

</body>
</html>

--}}
