<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'apis_peru' => [
        'token' => env('APIS_PERU_TOKEN'),
    ],

    // Pasarela de pagos Niubiz - Botón de Pago Web (https://desarrolladores.niubiz.com.pe)
    'niubiz' => [
        'entorno' => env('NIUBIZ_ENTORNO', 'sandbox'), // sandbox | produccion
        'merchant_id' => env('NIUBIZ_MERCHANT_ID'),
        'usuario' => env('NIUBIZ_USUARIO'),
        'clave' => env('NIUBIZ_CLAVE'),
        'urls' => [
            'sandbox' => [
                'api' => 'https://apisandbox.vnforappstest.com',
                'js' => 'https://static-content-qas.vnforapps.com/env/sandbox/js/checkout.js',
            ],
            'produccion' => [
                'api' => 'https://apiprod.vnforapps.com',
                'js' => 'https://static-content.vnforapps.com/v2/js/checkout.js',
            ],
        ],
        // Datos del comercio que Niubiz pide para antifraude y autorización
        'comercio' => [
            'ciudad' => env('NIUBIZ_CIUDAD', 'Lima'),
            'departamento' => env('NIUBIZ_DEPARTAMENTO', 'LIM'),   // ISO 3166-2
            'direccion' => env('NIUBIZ_DIRECCION', 'Lima'),
            'codigo_postal' => env('NIUBIZ_CODIGO_POSTAL', '15001'),
        ],
    ],

];
