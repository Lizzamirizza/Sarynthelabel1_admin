<?php

use Illuminate\Support\Str;

return [

    'driver' => env('SESSION_DRIVER', 'file'), // ✅ Gunakan 'file' untuk dev lokal (paling stabil)

    'lifetime' => (int) env('SESSION_LIFETIME', 120),
    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    'encrypt' => env('SESSION_ENCRYPT', false),

    'files' => storage_path('framework/sessions'),

    'connection' => env('SESSION_CONNECTION', null),
    'table' => env('SESSION_TABLE', 'sessions'),

    'store' => env('SESSION_STORE', null),

    'lottery' => [2, 100],

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_') . '_session'
    ),

    'path' => env('SESSION_PATH', '/'),
    'domain' => env('SESSION_DOMAIN', '127.0.0.1'), // ✅ Gunakan '127.0.0.1' untuk pengembangan lokal
    'secure' => env('SESSION_SECURE_COOKIE', false), // ✅ false untuk pengembangan lokal (tanpa HTTPS)
    'http_only' => env('SESSION_HTTP_ONLY', true),
    'same_site' => env('SESSION_SAME_SITE', 'lax'), // ✅ 'lax' lebih cocok untuk pengembangan lokal (mencegah cookie diblokir di SPA)
    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),
];
