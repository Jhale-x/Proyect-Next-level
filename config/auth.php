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
    // Panel de matrículas: cuentas propias, separadas de la intranet
    'matricula' => [
        'driver' => 'session',
        'provider' => 'personal_matricula',
    ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Provider para alumnos
        'alumnos' => [
            'driver' => 'eloquent',
            'model' => App\Models\Alumno::class,
        ],

        'personal_matricula' => [
            'driver' => 'eloquent',
            'model' => App\Models\PersonalMatricula::class,
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