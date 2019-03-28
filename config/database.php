<?php
$connection = env('DB_CONNECTION') ? 'pgsql' : 'sqlite';
return [
    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */
    'default' => $connection,

    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => env('DB_PREFIX', ''),
        ],
        'pgsql' => [
           'driver' => env('DB_CONNECTION'),
           'host' => env('DB_HOST'),
           'port' => env('DB_PORT'),
           'database' => env('DB_DATABASE'),
           'username' => env('DB_USERNAME'),
           'password' => env('DB_PASSWORD'),
           'charset' => env('DB_CHARSET', 'utf8'),
           'prefix' => env('DB_PREFIX', ''),
           'schema' => env('DB_SCHEMA', 'public'),
           'sslmode' => env('DB_SSL_MODE', 'prefer'),
       ],
    ],
    'migrations' => 'migrations',
];