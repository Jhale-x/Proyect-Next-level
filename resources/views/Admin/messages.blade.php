@extends('layouts.Adminlanding')

@section('title', 'Mensajes')

@section('content')
<div class="container-fluid mt-3">
    <div class="main-chat-viewport shadow-sm rounded">
        
        <div class="course-list-wrapper">
            <h3 class="mb-4" style="font-family: serif;">Mensajes</h3>
            
            @php $colores = ['#ff6b00', '#e91e63', '#4caf50', '#9c27b0', '#03a9f4']; @endphp

            @foreach($cursos as $index => $curso)
                <div class="course-item" style="border-left-color: {{ $colores[$index % count($colores)] }};">
                    <div class="course-info">
                        <span class="id-label">ID: 202610-{{ $curso->materia }}-{{ $curso->id_curso }}</span>
                        <span class="materia-name">{{ $curso->materia }}</span>
                    </div>
                    <button class="btn btn-link text-muted text-decoration-none small" 
                            onclick="abrirNuevoMensaje('{{ $curso->materia }}', {{ $curso->id_curso }})">
                        <i class="bi bi-envelope"></i> Nuevo mensaje
                    </button>
                </div>
            @endforeach
        </div>

        <div id="panelNuevoMensaje">
            <div class="panel-header">
                <button class="btn-close-custom" onclick="cerrarPanel()">X</button>
                <div>
                    <small class="text-muted text-uppercase d-block" id="displayMateria" style="font-size: 0.65rem;"></small>
                    <h4 class="mb-0">Nuevo mensaje</h4>
                </div>
            </div>

            <div class="panel-body text-center">
                <div class="w-100 text-start mb-4" style="max-width: 700px;">
                    <label class="small fw-bold">Hasta:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Escriba un miembro o grupo del curso">
                    </div>
                </div>
                
                <img src="https://cdn-icons-png.flaticon.com/512/2665/2665038.png" class="mailbox-img">
                <h5 class="fw-bold">Comenzar un nuevo mensaje</h5>
                <p class="text-muted small">Seleccione un destinatario para comenzar.</p>
            </div>

            <div class="panel-footer">
                <input type="hidden" id="current_id_curso">
                <div class="border p-2 bg-white rounded">
                    <textarea id="mensaje_contenido" class="form-control border-0" rows="3" placeholder="Escribe un mensaje"></textarea>
                </div>
                <div class="text-end mt-3">
                    <button class="btn btn-primary px-4" 
                            onclick="enviarAccion('{{ route('admin.messages.ajax') }}', '{{ csrf_token() }}')">
                        <i class="bi bi-send"></i> Enviar
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/messages.js') }}"></script>
@endpush
