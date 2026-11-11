<?php

/*
|--------------------------------------------------------------------------
| Datos del proceso de matrícula
|--------------------------------------------------------------------------
| Compartidos por el formulario web, el chatbot y los correos.
*/

return [

    'whatsapp' => '51923317625',
    'telefono' => '923 317 625',

    'pago' => [
        'banco' => 'BBVA',
        'cuenta' => '0011-0233-0200678882',
        'cci' => '011-233-000200678882-48',
        'titular' => 'CORPORACIÓN EXPERTIZ PUCALLPA S.A.C.',
        // Imagen del QR de pago (en public/). Se puede cambiar con MATRICULA_QR en el .env
        'qr' => env('MATRICULA_QR', 'images/QR-BBVA.jpg'),
        'logo_banco' => 'images/BBVA-NEXTLEVEL.jpg',
    ],

    // Intentos fallidos de verificación de DNI permitidos por hora (por IP).
    'max_intentos_dni' => 5,

];
