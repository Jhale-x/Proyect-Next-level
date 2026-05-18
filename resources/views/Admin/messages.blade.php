```blade
@extends('layouts.Adminlanding')

@section('title', 'Mensajes')

@section('content')
    <div class="container-fluid mt-3">

        <!-- 🔥 CONTENEDOR PRINCIPAL -->
        <div class="main-chat-viewport shadow-sm rounded">

            <!-- ========================================= -->
            <!-- 🔥 CONTENEDOR DE VISTAS -->
            <!-- ========================================= -->
            <div class="views-container">

                <!-- ========================================= -->
                <!-- 📚 VISTA 1: CURSOS -->
                <!-- ========================================= -->
                <div id="vista-mensajes-cursos" class="view active">

                    <div class="row g-3">

                        @foreach ($cursos as $curso)
                            <div class="col-md-3">

                                <!-- 📘 CARD CURSO -->
                                <div class="course-card"
                                    onclick="abrirCursoMsg('{{ $curso->materia }}', {{ $curso->id_curso }})">

                                    <div class="p-3 fw-bold">
                                        📘 {{ $curso->materia }}
                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>


                <!-- ========================================= -->
                <!-- 🏫 VISTA 2: SALONES -->
                <!-- ========================================= -->
                <div id="vista-mensajes-salones" class="view">

                    <!-- 🔙 VOLVER A CURSOS -->
                    <a class="btn-back" onclick="volverCursosMsg()">
                        ← Volver
                    </a>

                    <!-- 📌 TITULO CURSO -->
                    <h4 id="titulo-curso-msg" class="mb-3"></h4>

                    <!-- 📦 LISTA DE SALONES -->
                    <div class="row g-3" id="lista-salones-msg"></div>

                </div>


                <!-- ========================================= -->
                <!-- 💬 VISTA 3: CONVERSACIONES -->
                <!-- ========================================= -->
                <div id="vista-mensajes-chat" class="view">

                    <!-- 🔙 VOLVER A SALONES -->
                    <a class="btn-back" onclick="volverSalonesMsg()">
                        ← Volver
                    </a>

                    <!-- 📌 TITULO -->
                    <h4 id="titulo-chat-msg" class="mb-3"></h4>

                    <!-- 📦 LISTA DE CONVERSACIONES -->
                    <div id="lista-conversaciones" class="conversation-list"></div>
                    <!-- 💬 CHAT -->
                    <div id="chat-conversacion" class="chat-box d-none">
                        <!-- MENSAJES -->
                        <div id="chat-mensajes" class="chat-messages"></div>
                        <!-- RESPONDER -->
                        <div class="chat-footer mt-3">
                            <textarea id="respuesta_mensaje" class="form-control" rows="2" placeholder="Responder mensaje"></textarea>

                            <button class="btn btn-primary mt-2" onclick="responderMensaje()">
                                Responder

                            </button>

                        </div>

                    </div>

                    <!-- ➕ NUEVO MENSAJE -->
                    <button class="btn btn-primary mt-3" onclick="abrirNuevoMensaje()">

                        + Nuevo mensaje

                    </button>

                </div>

            </div>


            <!-- ========================================= -->
            <!-- ✏️ PANEL NUEVO MENSAJE -->
            <!-- ========================================= -->
            <div id="panelNuevoMensaje">

                <!-- 🔥 HEADER -->
                <div class="panel-header">

                    <!-- ❌ CERRAR -->
                    <button class="btn-close-custom" onclick="cerrarPanel()">

                        X

                    </button>

                    <!-- 📌 TITULO -->
                    <div>

                        <small class="text-muted text-uppercase d-block" id="displayMateria" style="font-size: 0.65rem;">

                        </small>

                        <h4 class="mb-0">
                            Nuevo mensaje
                        </h4>

                    </div>

                </div>


                <!-- ========================================= -->
                <!-- 🔥 BODY -->
                <!-- ========================================= -->
                <div class="panel-body text-center">

                    <!-- 🔎 BUSCADOR -->
                    <div class="w-100 text-start mb-4" style="max-width: 700px;">

                        <label for="destinatario_msg" class="small fw-bold">

                            Hasta:

                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-search"></i>
                            </span>

                            <input id="destinatario_msg" type="text" class="form-control"
                                placeholder="Escriba un miembro o grupo del curso">

                        </div>

                        <div id="resultados_busqueda" class="resultados-container">

                        </div>

                    </div>


                    <!-- 🖼️ IMAGEN -->
                    <img src="https://cdn-icons-png.flaticon.com/512/2665/2665038.png" class="mailbox-img">

                    <!-- 📌 TEXTO -->
                    <h5 class="fw-bold">
                        Comenzar un nuevo mensaje
                    </h5>

                    <p class="text-muted small">
                        Seleccione un destinatario para comenzar.
                    </p>

                </div>


                <!-- ========================================= -->
                <!-- 🔥 FOOTER -->
                <!-- ========================================= -->
                <div class="panel-footer">

                    <!-- 🔒 IDS OCULTOS -->
                    <input type="hidden" id="current_id_curso">
                    <input type="hidden" id="current_id_curso_salon">

                    <!-- ✍️ MENSAJE -->
                    <div class="border p-2 bg-white rounded">

                        <textarea id="mensaje_contenido" class="form-control border-0" rows="3" placeholder="Escribe un mensaje"></textarea>

                    </div>

                    <!-- 🚀 BOTON ENVIAR -->
                    <div class="text-end mt-3">

                        <button class="btn btn-primary px-4"
                            onclick="enviarAccion('{{ route('admin.messages.store') }}', '{{ csrf_token() }}')">

                            <i class="bi bi-send"></i>
                            Enviar

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/messages.css') }}">
@endpush


@push('scripts')
    <script>
        window.buscarAlumnosUrl =
            "{{ route('admin.buscar.usuarios') }}";
    </script>
    <script>
        window.userId =
            {{ auth()->id() }};
    </script>
    <script src="{{ asset('js/messages.js') }}"></script>
@endpush
```
