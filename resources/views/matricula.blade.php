<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrículas | Next Level</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/marquee_principal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/Matricula.css') }}">
    
    <link rel="icon" type="image/x-icon" href="{{ asset('images/next-level-logo.png') }}">
</head>
<body>
    <div class="top-bar">
        <div class="marquee-wrapper">
            <div class="marquee-track" id="marqueeTrack">
                <div class="marquee-item">
                    ¡Matrícula 2026! &nbsp;&nbsp;&nbsp;&nbsp;
                    ☀️🏊‍♂️ Inicio de Clases: 4 Marzo &nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>

    <nav class="main-nav">
        <div class="nav-container">
            <a href="{{ route('web_principal') }}" class="nav-brand">
                <img src="{{ asset('images/logo_letras.png') }}" alt="Next Level" class="nav-logo-full">
            </a>
            <button class="mobile-menu-toggle" id="menuOpen" type="button">
                <i class="fa-solid fa-bars"></i>
            </button>
            <ul class="nav-menu">
                <li><a href="{{ route('web_principal') }}">INICIO</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-trigger">NOSOTROS <span class="arrow-icon">▾</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Qué ofrecemos</a></li>
                        <li><a href="#">Sobre nosotros</a></li>
                    </ul>
                </li>
                <li><a href="#">UBICACIÓN</a></li>
                <li><a href="{{ route('matricula') }}" class="active">MATRICULAS</a></li>
                <li><a href="{{ route('portal') }}">INTRANET</a></li>
            </ul>
        </div>
    </nav>

    <div class="mobile-menu-overlay" id="menuOverlay"></div>
    <div class="mobile-side-menu" id="sideMenu">
        <div class="menu-header">
            <span>MENÚ</span>
            <button class="close-menu" id="menuClose" type="button"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="menu-panel active">
            <ul class="mobile-nav-list">
                <li><a href="{{ route('web_principal') }}">INICIO</a></li>
                <li><a href="{{ route('matricula') }}">MATRICULAS</a></li>
                <li><a href="{{ route('portal') }}">INTRANET</a></li>
            </ul>
        </div>
    </div>

    <main>
        <section class="main-banner" style="background-image: url('{{ asset('images/imagen10.jpg') }}');">
            <div class="banner-overlay">
                <div class="banner-container">
                    <div class="enrollment-card">
                        
                        {{-- Mensajes de Notificación --}}
                        @if(session('success'))
                            <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 8px; margin-bottom: 15px; font-size: 0.9rem; border: 1px solid #c3e6cb; text-align: left;">
                                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 8px; margin-bottom: 15px; font-size: 0.9rem; border: 1px solid #f5c6cb; text-align: left;">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div style="background: #fff3cd; color: #856404; padding: 12px; border-radius: 8px; margin-bottom: 15px; font-size: 0.85rem; border: 1px solid #ffeeba; text-align: left;">
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <h3>¡Matricúlate <br> 100% ONLINE AQUÍ!</h3>
                        
                        {{-- CAMBIO CLAVE: Se cambió la ruta a 'matricula.verificar.post' --}}
                        <form action="{{ route('matricula.verificar.post') }}" method="POST" class="enrollment-form">
                            @csrf
                            <div class="form-group">
                                <div class="select-wrapper">
                                    <select name="tipo_doc" id="tipo_doc" required>
                                        <option value="" disabled selected hidden>Tipo de documento</option>
                                        <option value="dni" {{ old('tipo_doc') == 'dni' ? 'selected' : '' }}>DNI</option>
                                        <option value="ce" {{ old('tipo_doc') == 'ce' ? 'selected' : '' }}>Carnet de Extranjería</option>
                                    </select>
                                    <i class="fa-solid fa-chevron-down custom-arrow"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="text" name="documento" id="documento" placeholder="Número de documento" value="{{ old('documento') }}" maxlength="8" required>
                            </div>

                            <div class="form-group">
                                <div class="input-with-icon">
                                    <input type="text" name="codigo" id="codigo" placeholder="CV" maxlength="1" required>
                                    <div class="help-container">
                                        <i class="fa-solid fa-circle-question" id="helpIcon" style="cursor: pointer;"></i>
                                        <div class="help-tooltip" id="helpTooltip">
                                            <p>El código es el número después del guion en tu DNI.</p>
                                            <img src="{{ asset('images/dni.png') }}" alt="Ejemplo DNI" width="100">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn-verify">VERIFICAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="hero-enrollment">
            <div class="hero-container">
                <div class="hero-video">
                    <iframe 
                        width="100%" 
                        height="315" 
                        src="https://www.youtube.com/embed/oKoNDgJk6SQ" 
                        title="Video Next Level" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <img src="{{ asset('images/logo_footer.png') }}" alt="Next Level Logo" class="footer-logo-img">
                <div class="footer-contact">
                    <p><i class="fa-solid fa-phone"></i> +51 923 317 626</p>
                    <p><i class="fa-solid fa-location-dot"></i> Pucallpa, Perú</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2026 Next Level. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/marquee_principal.js') }}"></script>
    <script src="{{ asset('js/nav-scroll.js') }}"></script>
    <script src="{{ asset('js/menu-mobile.js') }}"></script>
</body>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipoDoc = document.getElementById('tipo_doc');
    const inputDoc = document.getElementById('documento');
    const inputCodigo = document.getElementById('codigo');
    const helpContainer = document.querySelector('.help-container');
    const btnVerify = document.querySelector('.btn-verify');

    const avisoCE = document.createElement('p');
    avisoCE.style.color = '#ffcc00';
    avisoCE.style.fontSize = '0.8rem';
    avisoCE.style.marginTop = '10px';
    avisoCE.style.display = 'none';
    avisoCE.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Por ahora, la matrícula online solo está disponible para DNI.';
    btnVerify.parentNode.insertBefore(avisoCE, btnVerify.nextSibling);

    tipoDoc.addEventListener('change', function() {
        inputDoc.value = '';
        inputCodigo.value = '';

        if (this.value === 'ce') {
            btnVerify.disabled = true;
            btnVerify.style.backgroundColor = '#666';
            btnVerify.style.cursor = 'not-allowed';
            btnVerify.style.opacity = '0.7';
            btnVerify.innerText = 'NO DISPONIBLE';
            avisoCE.style.display = 'block';
            helpContainer.style.visibility = 'hidden'; 
            inputDoc.placeholder = "No disponible";
            inputDoc.disabled = true;
            inputCodigo.disabled = true;
        } else {
            btnVerify.disabled = false;
            btnVerify.style.backgroundColor = ''; 
            btnVerify.style.cursor = 'pointer';
            btnVerify.style.opacity = '1';
            btnVerify.innerText = 'VERIFICAR';
            avisoCE.style.display = 'none';
            helpContainer.style.visibility = 'visible'; 
            inputDoc.placeholder = "Número de documento";
            inputDoc.disabled = false;
            inputCodigo.disabled = false;
            inputDoc.maxLength = 8;
        }
    });
});
</script>
</html>