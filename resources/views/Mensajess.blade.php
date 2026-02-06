<<<<<<< HEAD
@extends('layouts.app')
=======
@extends('layouts.landing')
>>>>>>> 6449e0ffd2cda145b29f11a55a06e18829329855

@section('title', 'Nuevo mensaje')

@section('content')
<a href="{{ route('mensajes') }}" class="btn btn-link mb-3">← Volver</a>

<style>
    body {
        background: #f8f9fa;
    }

    .page-header {
        margin-bottom: 20px;
    }

    .breadcrumb {
        color: #666;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        display: block;
    }

    h1 {
        font-size: 32px;
        font-weight: 400;
        color: #333;
        margin: 0;
    }

    hr {
        border: none;
        border-top: 1px solid #ddd;
        margin: 20px 0 30px 0;
    }

    .required-text {
        color: #666;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .required-text span {
        color: #dc3545;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        font-size: 15px;
    }

    .form-label .required {
        color: #dc3545;
        margin-right: 4px;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 15px;
        color: #333;
        background: #fff;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #80bdff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    /* Campo de destinatarios con ícono de búsqueda */
    .input-wrapper {
        position: relative;
    }

    .input-wrapper .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        font-size: 16px;
    }

    .input-wrapper .form-control {
        padding-left: 40px;
    }

    /* Editor de texto enriquecido */
    .rich-editor {
        border: 1px solid #ccc;
        border-radius: 4px;
        background: #fff;
        overflow: hidden;
    }

    .editor-toolbar {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        background: #f8f9fa;
        border-bottom: 1px solid #ddd;
        gap: 5px;
        flex-wrap: wrap;
    }

    .toolbar-btn {
        background: none;
        border: none;
        padding: 6px 10px;
        cursor: pointer;
        color: #333;
        font-size: 16px;
        border-radius: 3px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 32px;
    }

    .toolbar-btn:hover {
        background: #e9ecef;
    }

    .toolbar-divider {
        width: 1px;
        height: 24px;
        background: #ddd;
        margin: 0 5px;
    }

    .editor-content {
        min-height: 300px;
        padding: 20px;
        font-size: 15px;
        line-height: 1.6;
        color: #333;
        outline: none;
    }

    .editor-content:empty:before {
        content: "Escriba un mensaje";
        color: #999;
        font-style: italic;
    }

    /* Botón enviar */
    .btn-send {
<<<<<<< HEAD
        background: #0a1f44;
=======
        background: #007bff;
>>>>>>> 6449e0ffd2cda145b29f11a55a06e18829329855
        color: #fff;
        border: none;
        padding: 12px 30px;
        font-size: 15px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
    }

    .btn-send:hover {
<<<<<<< HEAD
        background: #0b347b;
=======
        background: #0056b3;
>>>>>>> 6449e0ffd2cda145b29f11a55a06e18829329855
    }
</style>

<div class="page-header">
    <span class="breadcrumb">{{ strtoupper(str_replace('-', ' ', $curso)) }}</span>
    <h1>Nuevo mensaje</h1>
</div>

<hr>

<p class="required-text"><span>*</span> Indica un campo obligatorio</p>

<form>
    <!-- Destinatarios -->
    <div class="form-group">
        <label class="form-label">Destinatarios</label>
        <div class="input-wrapper">
            <span class="search-icon">🔍</span>
            <input type="text" class="form-control"
                   value="{{ ucfirst(str_replace('-', ' ', $curso)) }}"
                   placeholder="Escriba un miembro o grupo del curso">
        </div>
    </div>

    <!-- Mensaje con editor enriquecido -->
    <div class="form-group">
        <label class="form-label">
            <span class="required">*</span>Mensaje
        </label>
        <div class="rich-editor">
            <div class="editor-toolbar">
                <button type="button" class="toolbar-btn" title="Formato">A</button>
                <button type="button" class="toolbar-btn" title="Tamaño de fuente">T</button>
                <button type="button" class="toolbar-btn" title="Color de fuente">A</button>
                <button type="button" class="toolbar-btn" title="Fondo">🎨</button>
                
                <span class="toolbar-divider"></span>
                
                <button type="button" class="toolbar-btn" title="Negrita"><b>B</b></button>
                <button type="button" class="toolbar-btn" title="Cursiva"><i>I</i></button>
                <button type="button" class="toolbar-btn" title="Subrayado"><u>U</u></button>
                <button type="button" class="toolbar-btn" title="Más opciones">⋯</button>
                
                <span class="toolbar-divider"></span>
                
                <button type="button" class="toolbar-btn" title="Lista">☰</button>
                <button type="button" class="toolbar-btn" title="Lista numerada">1.</button>
                <button type="button" class="toolbar-btn" title="Formato párrafo">¶</button>
                
                <span class="toolbar-divider"></span>
                
                <button type="button" class="toolbar-btn" title="Deshacer">↶</button>
                <button type="button" class="toolbar-btn" title="Rehacer">↷</button>
                <button type="button" class="toolbar-btn" title="Enlace">🔗</button>
                <button type="button" class="toolbar-btn" title="Adjuntar">📎</button>
                <button type="button" class="toolbar-btn" title="Imagen">🖼️</button>
                <button type="button" class="toolbar-btn" title="Emoji">☺</button>
            </div>
            <div class="editor-content" contenteditable="true"></div>
        </div>
    </div>

    <button type="submit" class="btn-send">
        Enviar mensaje
    </button>
</form>

@endsection