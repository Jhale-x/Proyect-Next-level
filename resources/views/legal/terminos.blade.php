@extends('legal.layout')

@section('titulo', 'Términos y Condiciones')

@section('contenido')
    <p>Estos términos regulan el uso del sitio web y del proceso de matrícula en línea del Colegio y Academia Next Level, administrado por <strong>{{ config('matricula.pago.titular') }}</strong> Al usar el sitio o enviar una matrícula aceptas estas condiciones.</p>

    <h2>1. Uso del sitio</h2>
    <p>El sitio ofrece información institucional, el formulario de matrícula, el pago en línea y el acceso a las plataformas de la institución. Te comprometes a usarlo de buena fe y a no intentar acceder a cuentas o información de otras personas.</p>

    <h2>2. Matrícula en línea</h2>
    <ul>
        <li>Los datos que registras en el formulario deben ser verdaderos, completos y estar actualizados. La matrícula de un menor de edad debe hacerla su padre, madre o apoderado.</li>
        <li>Enviar el formulario registra una solicitud de matrícula. La matrícula queda confirmada solo cuando la institución verifica el pago.</li>
        <li>Las vacantes están sujetas a disponibilidad por nivel, ciclo, turno y sede.</li>
        <li>La institución puede observar o anular una matrícula con datos falsos o incompletos.</li>
    </ul>

    <h2>3. Pagos</h2>
    <ul>
        <li>Puedes pagar en línea con tarjeta a través de la pasarela Niubiz, o por depósito o transferencia a la cuenta oficial de la institución.</li>
        <li>Los datos de tu tarjeta los procesa directamente Niubiz; Next Level no los recibe ni los guarda.</li>
        <li>Los montos, cuotas y fechas de pago son los publicados para cada ciclo al momento de la matrícula.</li>
        <li>Las solicitudes de devolución se evalúan según el reglamento interno de la institución. Comunícate con nosotros por los medios de contacto indicados abajo.</li>
    </ul>

    <h2>4. Cuentas de acceso</h2>
    <p>Al confirmarse la matrícula, la institución entrega un usuario y una contraseña para sus plataformas. Eres responsable de mantenerlos en reserva y de cambiar la contraseña inicial.</p>

    <h2>5. Propiedad intelectual</h2>
    <p>Los textos, logotipos, imágenes y materiales del sitio y de las plataformas pertenecen a Next Level o a sus autores. No pueden copiarse ni distribuirse sin autorización.</p>

    <h2>6. Cambios en estos términos</h2>
    <p>Podemos actualizar estos términos. La versión vigente es la publicada en esta página, con su fecha de última actualización.</p>

    <h2>7. Ley aplicable</h2>
    <p>Estos términos se rigen por las leyes de la República del Perú, incluido el Código de Protección y Defensa del Consumidor (Ley N.° 29571).</p>
@endsection
