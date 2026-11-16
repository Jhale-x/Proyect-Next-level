@extends('legal.layout')

@section('titulo', 'Política de Privacidad')

@section('contenido')
    <p>En el Colegio y Academia Next Level, administrado por <strong>{{ config('matricula.pago.titular') }}</strong>, protegemos los datos personales de estudiantes y apoderados conforme a la Ley N.° 29733, Ley de Protección de Datos Personales, y su reglamento.</p>

    <h2>1. Datos que recopilamos</h2>
    <ul>
        <li><strong>Del estudiante:</strong> nombres y apellidos, DNI, fecha de nacimiento, género, celular y correo electrónico.</li>
        <li><strong>Del apoderado</strong> (si el estudiante es menor de edad): nombres y apellidos, DNI, fecha de nacimiento, celular y correo electrónico.</li>
        <li><strong>Académicos:</strong> nivel, grado, ciclo, turno, sede, modalidad y universidad de interés.</li>
        <li><strong>De pago:</strong> número de operación, fecha, monto y estado del pago. No guardamos los datos de tu tarjeta: los procesa directamente Niubiz.</li>
        <li><strong>Conversaciones con el asistente virtual</strong> del sitio, cuando lo usas para matricularte.</li>
    </ul>

    <h2>2. Para qué los usamos</h2>
    <ul>
        <li>Registrar y gestionar la matrícula y verificar el pago.</li>
        <li>Crear las cuentas de acceso a las plataformas de la institución.</li>
        <li>Enviar la constancia de matrícula y comunicaciones sobre clases, pagos y actividades académicas por correo o WhatsApp.</li>
        <li>Cumplir obligaciones legales y administrativas de la institución.</li>
    </ul>

    <h2>3. Con quién los compartimos</h2>
    <p>No vendemos ni cedemos tus datos. Solo los compartimos con proveedores que necesitamos para prestar el servicio, como la pasarela de pagos Niubiz y el servicio de correo, y con autoridades cuando la ley lo exige.</p>

    <h2>4. Cuánto tiempo los guardamos</h2>
    <p>Mientras dure la relación académica y luego el tiempo que exijan las normas educativas, tributarias y contables.</p>

    <h2>5. Cómo los protegemos</h2>
    <p>El acceso a los datos está restringido al personal autorizado, y usamos conexiones cifradas y contraseñas protegidas.</p>

    <h2>6. Tus derechos</h2>
    <p>Puedes ejercer tus derechos de acceso, rectificación, cancelación y oposición (derechos ARCO) escribiendo a contacto@nextlevel.edu.pe con una copia de tu DNI. Si no recibes respuesta, puedes acudir a la Autoridad Nacional de Protección de Datos Personales del Ministerio de Justicia y Derechos Humanos.</p>

    <h2>7. Menores de edad</h2>
    <p>Los datos de estudiantes menores de edad se registran con el consentimiento de su padre, madre o apoderado, quien acepta esta política al enviar la matrícula.</p>

    <h2>8. Cambios en esta política</h2>
    <p>Podemos actualizar esta política. La versión vigente es la publicada en esta página, con su fecha de última actualización.</p>
@endsection
