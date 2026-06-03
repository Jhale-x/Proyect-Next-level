<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */

    'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    'alumno' => [
        'driver' => 'session',
        'provider' => 'alumnos',
    ],
    'apoderado' => [
        'driver' => 'session',
        'provider' => 'apoderados',
    ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'alumnos' => [
            'driver' => 'eloquent',
            'model' => App\Models\Alumno::class,
        ],
        'apoderados' => [
            'driver' => 'eloquent',
            'model' => App\Models\Apoderado::class,
        ],
    ],

    

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'alumnos' => [
            'provider' => 'alumnos',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => 10800,

];