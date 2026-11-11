{{-- Pago en línea con Niubiz. Solo se activa si NIUBIZ_MERCHANT_ID, NIUBIZ_USUARIO y NIUBIZ_CLAVE están en el .env --}}
@php($niubiz = app(\App\Services\NiubizService::class))
@if($niubiz->activo())
    <script>
        window.NIUBIZ = {
            rutaSesion: @json(route('matricula.pago.niubiz.sesion', '__CODIGO__')),
            modoPrueba: @json($niubiz->modoPrueba()),
        };
    </script>
    <script src="{{ asset('js/pago-online.js') }}"></script>
@endif
