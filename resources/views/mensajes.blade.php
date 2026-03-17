@extends('layouts.app')

@section('title', 'Mensajes')

@section('content')
<div class="mb-4">
    <h1 class="fw-normal">Mensajes</h1>
    <hr>
</div>

<style>
    body {
        background: #f5f7fa;
    }

    h1 {
        margin-bottom: 25px;
        font-weight: 600;
    }

    .messages-wrapper {
        /* Eliminamos el padding lateral para aprovechar todo el ancho */
        padding: 25px 0;
    }

    .messages {
        display: flex;
        flex-direction: column;
        gap: 19px;
    }

    .message {
        background: #fff;
        border-radius: 6px;
        box-shadow: 0 0 0 1px #e5e5e5;
        display: flex;
        align-items: center;
        /* Aumentamos el padding horizontal para dar más espacio interno */
        padding: 22px 25px;
        position: relative;
        /* Aseguramos que ocupe todo el ancho disponible */
        width: 100%;
        box-sizing: border-box;
    }

    .indicator {
        width: 6px;
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        border-radius: 4px 0 0 4px;
    }

    .pink { background: #ff4f8b; }
    .purple { background: #9b59b6; }

    .content {
        /* Ajustamos el padding izquierdo para compensar el indicador */
        padding-left: 20px;
        flex: 1;
    }

    .id {
        font-size: 13px;
        color: #8a8a8a;
        margin-bottom: 6px;
    }

    .title {
        font-size: 16px;
        font-weight: 600;
        color: #000;
    }

    .new a {
        display: flex;
        align-items: center;
        color: #6b6b6b;
        font-size: 14px;
        gap: 8px;
        text-decoration: none;
        /* Evitamos que se rompa en varias líneas */
        white-space: nowrap;
    }

    .new a:hover {
        text-decoration: underline;
    }

    .icon {
        font-size: 16px;
        opacity: 0.7;
    }
</style>

<div class="messages-wrapper">

    <div class="messages">

        <div class="message">
            <div class="indicator pink"></div>
            <div class="content">
                <div class="id">ID: IND_ALUMNOS-202520-39</div>
                <div class="title">Razonamiento Verbal</div>
            </div>
            <div class="new">
                <a href="{{ route('mensajes.nuevo', 'razonamiento-verbal') }}">
                    <span class="icon">✉️</span> Nuevo mensaje
                </a>
            </div>
        </div>

        <div class="message">
            <div class="indicator purple"></div>
            <div class="content">
                <div class="id">ID: IND_ALUMNOS-202510-39</div>
                <div class="title">Razonamiento Matemático</div>
            </div>
            <div class="new">
                <a href="{{ route('mensajes.nuevo', 'razonamiento-matematico') }}">
                    <span class="icon">✉️</span> Nuevo mensaje
                </a>
            </div>
        </div>

        <div class="message">
            <div class="indicator pink"></div>
            <div class="content">
                <div class="id">ID: PREVENCION-202510-39</div>
                <div class="title">Álgebra</div>
            </div>
            <div class="new">
                <a href="{{ route('mensajes.nuevo', 'algebra') }}">
                    <span class="icon">✉️</span> Nuevo mensaje
                </a>
            </div>
        </div>

        <div class="message">
            <div class="indicator purple"></div>
            <div class="content">
                <div class="id">ID: 202612-INGL-255-TEC-NRC_172</div>
                <div class="title">Psicología</div>
            </div>
            <div class="new">
                <a href="{{ route('mensajes.nuevo', 'psicologia') }}">
                    <span class="icon">✉️</span> Nuevo mensaje
                </a>
            </div>
        </div>

        <div class="message">
            <div class="indicator purple"></div>
            <div class="content">
                <div class="id">ID: 202612-INGL-255-TEC-NRC_172</div>
                <div class="title">Historia</div>
            </div>
            <div class="new">
                <a href="{{ route('mensajes.nuevo', 'historia') }}">
                    <span class="icon">✉️</span> Nuevo mensaje
                </a>
            </div>
        </div>

    </div>
</div>

@endsection