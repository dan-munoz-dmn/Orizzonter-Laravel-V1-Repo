<?php

return [

    // Las rutas de tu API (es importante que el 'v1' esté aquí)
    'paths' => ['api/*', 'v1/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // La URL de tu frontend de Angular
    'allowed_origins' => [
        'http://localhost:4200',
        'http://127.0.0.1:4200',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];