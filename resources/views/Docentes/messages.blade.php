@extends('layouts.Docentelanding')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/docente/messages.css') }}">
@endpush

@section('title', 'Mensajes')

@section('content')

    <div class="messages-container">

        {{-- HEADER --}}
        <div class="messages-header">
            <h4>Mensajes</h4>
            <p>Gestión de conversaciones del sistema</p>
        </div>

        {{-- CURSOS --}}
        <div class="conversations-grid">

            @foreach ($cursos as $curso)
                <div class="conversation-card"
                    onclick="DocenteMessages.abrirCurso({{ $curso->id_curso }}, '{{ $curso->materia }}')">

                    <div class="conversation-header">
                        <div>
                            <h6>{{ $curso->materia }}</h6>
                            <span class="course-code">CURSO-{{ $curso->id_curso }}</span>
                        </div>

                        <div>📘</div>
                    </div>

                    <div class="conversation-body">
                        <p class="text-muted">Ver conversaciones</p>
                    </div>

                </div>
            @endforeach

        </div>

    </div>

    {{-- ========================= --}}
    {{-- PANEL INBOX (SALONES Y CONVERSACIONES) --}}
    {{-- ========================= --}}
    <div id="inboxModal" class="chat-panel">

        <div class="chat-header">
            <h6 id="chatTitle">Conversaciones</h6>
            <button onclick="DocenteMessages.closeInbox()">✖</button>
        </div>

        <div class="chat-body" id="inboxList">
            <div class="empty">Cargando...</div>
        </div>

        <div class="chat-float-button">
            <button onclick="DocenteMessages.nuevaConversacion()">
                ➕ Nueva conversación
            </button>
        </div>

    </div>

    {{-- ========================= --}}
    {{-- MODAL: SELECCIONAR USUARIO --}}
    {{-- ========================= --}}
    <div id="selectUserModal">

        <div class="chat-header">
            <h6>Seleccionar Usuario</h6>
            <button onclick="DocenteMessages.closeSelectUser()">✖</button>
        </div>

        {{-- BUSCADOR --}}
        <div class="search-box" style="padding: 15px; border-bottom: 1px solid #ddd;">
            <input type="text" id="searchUserInput" placeholder="🔍 Buscar usuario..."
                onkeyup="DocenteMessages.buscarUsuario()"
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
        </div>

        {{-- LISTA DE USUARIOS --}}
        <div class="chat-body" id="usersList" style="overflow-y: auto;">
            <div class="empty">Cargando usuarios...</div>
        </div>

    </div>

    {{-- ========================= --}}
    {{-- CHAT --}}
    {{-- ========================= --}}
    <div id="chatModal">

        <div class="chat-header">
            <h6 id="chatUserTitle">Chat</h6>
            <button onclick="DocenteMessages.closeChat()">✖</button>
        </div>

        <div class="chat-body chat-messages" id="chatMessages"></div>

        <div class="chat-footer">
            <input type="text" id="chatInput" placeholder="Escribe un mensaje...">
            <button onclick="DocenteMessages.sendMessage()">➤</button>
        </div>

    </div>

    <script>
        window.csrfToken = "{{ csrf_token() }}";
    </script>

@endsection

@push('scripts')
    <script src="{{ asset('js/docentes/messages.js') }}"></script>
@endpush
