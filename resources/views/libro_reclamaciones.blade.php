@section('content')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/web/libro_reclamaciones.css') }}">

{{-- ================= HERO ================= --}}
<div class="libro-hero">
    <div class="libro-overlay">
        <div class="container-hero">

            <div class="libro-header-top">
                <i class="fas fa-home"></i>
                <i class="fab fa-whatsapp"></i>
                <i class="fas fa-phone-alt"></i>
                <span>6198 100</span>
            </div>

            <div class="libro-content">
                <h1>Libro de reclamaciones</h1>

                <p class="hero-desc">
                    Conforme lo dispone el artículo 5° del Decreto Supremo N° 011-2011-PCM...
                </p>

                <div class="libro-form-inline">

                    <div class="libro-input-group">
                        <select id="sede" class="libro-input-hero">
                            <option value="">--Seleccione sede Colegio--</option>
                            <option value="PUCALLPA">PUCALLPA</option>
                        </select>
                    </div>

                    <div class="libro-input-group">
                        <select id="nivel" class="libro-input-hero">
                            <option value="">--Seleccione el nivel--</option>
                            <option value="COLEGIO">COLEGIO</option>
                            <option value="ACADEMIA">ACADEMIA</option>
                        </select>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


{{-- ================= FORMULARIO ================= --}}
<div id="wrapper-formulario" class="bg-formulario-gris" style="display:none;">

    <div class="empresa-info-container">

        {{-- Datos empresa --}}
        <div class="empresa-header-grid">

            <div class="datos-izq">
                <p><strong>RAZÓN SOCIAL:</strong> ASOCIACIÓN EDUCATIVA SOARISABEL</p>
                <p><strong>RUC:</strong> 20614946297</p>
                <p><strong>FECHA:</strong> <span id="fecha-actual"></span></p>
            </div>

            <div class="datos-der">
                <p><strong>DIRECCIÓN:</strong> Carretera Federico Basadre Km.6.5 - Pucallpa</p>
            </div>

        </div>


        <form action="{{ route('libro.reclamaciones.submit') }}" method="POST">
            @csrf

            <span class="obligatorios">* Campos obligatorios</span>

            <input type="hidden" name="sede" id="hidden_sede">
            <input type="hidden" name="nivel" id="hidden_nivel">


            {{-- ================= DATOS CONSUMIDOR ================= --}}
            <h3 class="seccion-titulo">1. DATOS DEL CONSUMIDOR</h3>

            <div class="form-grid">

                <div class="form-group full-width">
                    <label>Nombres y apellidos *</label>
                    <input type="text" name="nombres" class="form-input" placeholder="Ej: Juan Pérez" required>
                </div>

                <div class="form-group">
                    <div class="radio-flex">
                        <label class="radio-label">
                            <input type="radio" name="genero" value="M" checked> Masculino
                        </label>

                        <label class="radio-label">
                            <input type="radio" name="genero" value="F"> Femenino
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label>DNI *</label>
                    <input type="text" name="dni" class="form-input" required>
                </div>

                <div class="form-group">
                    <label>Grado *</label>

                    <select name="grado" class="form-input" >
                        <option value="" disabled selected>Seleccione...</option>

                        <optgroup label="Primaria">
                            <option value="P1">1.° Año</option>
                            <option value="P2">2.° Año</option>
                            <option value="P3">3.° Año</option>
                            <option value="P4">4.° Año</option>
                            <option value="P5">5.° Año</option>
                            <option value="P6">6.° Año</option>
                        </optgroup>

                        <optgroup label="Secundaria">
                            <option value="S1">1.° Año</option>
                            <option value="S2">2.° Año</option>
                            <option value="S3">3.° Año</option>
                            <option value="S4">4.° Año</option>
                            <option value="S5">5.° Año</option>
                        </optgroup>
                    </select>
                </div>

                <div class="form-group">
                    <label>Celular *</label>
                    <input type="text" name="celular" class="form-input" required>
                </div>

                <div class="form-group full-width">
                    <label>Dirección *</label>
                    <input type="text" name="direccion" class="form-input" required>
                </div>

                <div class="form-group full-width">
                    <label>Correo electrónico *</label>
                    <input type="email" name="correo" class="form-input" required>
                </div>

            </div>


            {{-- ================= SERVICIO ================= --}}
            <h3 class="seccion-titulo">2. SOBRE EL SERVICIO</h3>

            <div class="form-grid">

                <div class="form-group">
                    <label>Monto reclamado (S/.)</label>
                    <input type="text" name="monto" class="form-input">
                </div>

                <div class="form-group full-width">
                    <label>Descripción de Producto / Servicio</label>
                    <textarea name="descripcion" class="form-input" rows="2"></textarea>
                </div>

            </div>


            {{-- ================= RECLAMO ================= --}}
            <h3 class="seccion-titulo">3. DETALLE DEL RECLAMO / QUEJA</h3>

            <div class="detalle-instrucciones">
                <p><strong>- Reclamo:</strong> Disconformidad relacionada a los productos o servicios.</p>
                <p><strong>- Queja:</strong> Malestar respecto a la atención al público.</p>
            </div>

            <div class="radio-flex central">
                <label class="radio-label">
                    <input type="radio" name="tipo" value="Reclamo" checked> Reclamo
                </label>

                <label class="radio-label">
                    <input type="radio" name="tipo" value="Queja"> Queja
                </label>
            </div>

            <div class="form-group full-width">
                <label>Detalle del reclamo / queja *</label>
                <textarea name="detalle" class="form-input" rows="3" required></textarea>
            </div>

            <div class="form-group full-width">
                <label>Pedido concreto *</label>
                <textarea name="pedido" class="form-input" rows="3" required></textarea>
            </div>

            <p class="aviso-naranja">
                * La respuesta será enviada al correo electrónico indicado.
            </p>

            <div class="declaracion-centrada">
                <label class="check-label">
                    <input type="checkbox" name="declaracion" value="1" required>
                    Declaro que los datos consignados son correctos.
                </label>
            </div>

            <button type="submit" class="btn-enviar-naranja">
                ENVIAR RECLAMO
            </button>

        </form>

    </div>
</div>


{{-- ================= FOOTER ================= --}}
<footer class="footer-simple">
    <div class="container-footer">
        <p>&copy; 2026 Next Level. Todos los derechos reservados.</p>
    </div>
</footer>


<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="{{ asset('js/libro-reclamaciones-clean.js') }}"></script>

