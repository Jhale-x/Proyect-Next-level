{{-- Pago en línea con Culqi. Solo se activa si CULQI_PUBLIC_KEY y CULQI_SECRET_KEY están en el .env --}}
@php($culqi = app(\App\Services\CulqiService::class))
@if($culqi->activo())
    <script>
        window.CULQI = {
            publicKey: @json(config('services.culqi.public_key')),
            ruta: @json(route('matricula.pago.culqi', '__CODIGO__')),
            titulo: 'Next Level',
            logo: @json(asset('images/next-level-logo.png')),
            modoPrueba: @json($culqi->modoPrueba()),
        };
    </script>
    <script src="{{ asset('js/pago-culqi.js') }}"></script>
@endif
