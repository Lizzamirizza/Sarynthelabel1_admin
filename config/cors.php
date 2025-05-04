<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Berikut pengaturan agar Laravel bisa menerima permintaan dari frontend
    | (misalnya Next.js di localhost:3000) dengan kredensial (cookies).
    |
    */

    'paths' => [
        'api/*',
        'login',
        'logout',
        'sanctum/csrf-cookie',
    ],

    'allowed_origins' => ['http://localhost:3000'],  // Ganti dengan alamat frontend kamu
    'allowed_headers' => ['Content-Type', 'X-Requested-With', 'X-CSRF-TOKEN'],
    'allowed_methods' => ['*'],
    'supports_credentials' => true,  // Agar cookies dikirimkan dengan permintaan
];
