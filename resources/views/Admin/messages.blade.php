@extends('layouts.Adminlanding')

@section('title', 'Mensajes')

@section('content')
    <div class="container-fluid mt-3">
        <div class="main-chat-viewport shadow-sm rounded">

            <div class="views-container">
                <!-- 📚 CURSOS -->
                <div id="vista-mensajes-cursos" class="view active">
                    <div class="row g-3">
                        @foreach ($cursos as $curso)
                            <div class="col-md-3">
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

                <!-- 🏫 SALONES -->
                <div id="vista-mensajes-salones" class="view">
                    <a class="btn-back" onclick="volverCursosMsg()">← Volver</a>
                    <h4 id="titulo-curso-msg" class="mb-3"></h4>
                    <div class="row g-3" id="lista-salones-msg"></div>
                </div>
            </div>

            <div id="panelNuevoMensaje">
                <div class="panel-header">
                    <button class="btn-close-custom" onclick="cerrarPanel()">X</button>
                    <div>
                        <small class="text-muted text-uppercase d-block" id="displayMateria"
                            style="font-size: 0.65rem;"></small>
                        <h4 class="mb-0">Nuevo mensaje</h4>
                    </div>
                </div>

                <div class="panel-body text-center">
                    <div class="w-100 text-start mb-4" style="max-width: 700px;">
                        <label for="destinatario_msg" class="small fw-bold">Hasta:</label>
                        <div class="input-group position-relative">
                            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                            <input id="destinatario_msg" type="text" class="form-control"
                                placeholder="Escriba un miembro o grupo del curso">
                        </div>
                        <div id="resultados_busqueda" class="list-group mt-2"></div>
                    </div>

                    <img src="https://cdn-icons-png.flaticon.com/512/2665/2665038.png" class="mailbox-img">
                    <h5 class="fw-bold">Comenzar un nuevo mensaje</h5>
                    <p class="text-muted small">Seleccione un destinatario para comenzar.</p>
                </div>

                <div class="panel-footer">
                    <input type="hidden" id="current_id_curso">
                    <input type="hidden" id="current_id_curso_salon">
                    <div class="border p-2 bg-white rounded">
                        <div id="mensajeEstado" class="mb-2" style="display:none;"></div>
                        <textarea id="mensaje_contenido" class="form-control border-0" rows="3" placeholder="Escribe un mensaje"></textarea>
                    </div>
                    <div class="text-end mt-3">
                        <button class="btn btn-primary px-4"
                            onclick="enviarAccion('{{ route('admin.messages.store') }}', '{{ csrf_token() }}')">
                            <i class="bi bi-send"></i> Enviar
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
        window.buscarAlumnosUrl = "{{ url('/admin/messages/buscar-usuarios') }}";
    </script>
    <script src="{{ asset('js/messages.js') }}"></script>
@endpush
