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

    // Pasarela de pagos Culqi (https://docs.culqi.com). Con llaves pk_test_/sk_test_ funciona en modo de prueba.
    'culqi' => [
        'public_key' => env('CULQI_PUBLIC_KEY'),
        'secret_key' => env('CULQI_SECRET_KEY'),
        'url' => env('CULQI_API_URL', 'https://api.culqi.com/v2'),
    ],

];
