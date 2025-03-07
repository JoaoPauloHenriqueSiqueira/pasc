<?php

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

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'us-cdbr-iron-east-04.cleardb.net'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'heroku_fb23185d11aec11'),
            'username' => env('DB_USERNAME', 'bbe4f62c4d1f39'),
            'password' => env('DB_PASSWORD', 'a865e703'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],

        'mongodb' => [
            'driver'   => 'mongodb',
            'dsn'       => env('MONGODB_DSN'),
            'host'     => env('MONGODB_HOST', 'localhost'),
            'port'     => env('MONGODB_PORT', 27017),
            'database' => env('MONGODB_DATABASE'),
            'username' => env('MONGODB_USERNAME'),
            'password' => env('MONGODB_PASSWORD'),
            'options'  => [
                'database' => env('MONGODB_AUTH_DATABASE')
            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'cluster' => false,

        'default' => [
            'host'     => env('REDIS_HOST', '127.0.0.1'),
            'port'     => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DATABASE', 0)

        ],
        'jobs' => [
            'host' => env('JOBS_REDIS_HOST'),
            'port' => env('JOBS_REDIS_PORT'),
            'database' => env('JOBS_REDIS_DATABASE', 0),
            'password' => env('JOBS_REDIS_PASSWORD', ''),
        ],
        'mailer' => [
            'host' => env('EMAILS_REDIS_HOST'),
            'port' => env('EMAILS_REDIS_PORT'),
            'database' => env('EMAILS_REDIS_DATABASE', 0),
            'password' => env('EMAILS_REDIS_PASSWORD', ''),
        ],
        'schedule' => [
            'host'     => env('SCHEDULE_REDIS_HOST', '127.0.0.1'),
            'port'     => env('SCHEDULE_REDIS_PORT', 6379),
            'database' => env('SCHEDULE_REDIS_DATABASE', 0),
            'password' => env('SCHEDULE_REDIS_PASSWORD', ''),

        ],


    ],
];
