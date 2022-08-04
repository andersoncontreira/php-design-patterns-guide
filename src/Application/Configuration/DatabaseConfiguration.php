<?php

declare(strict_types=1);


namespace Application\Configuration;


class DatabaseConfiguration extends AbstractConfiguration
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $this->configuration = [
//            'DB_HOST' => env('DB_HOST', 'mysql'),
//            'DB_USER' => env('DB_USER','root'),
//            'DB_PASSWORD' => env('DB_PASSWORD','root'),
//            'DB' => env('DB','store'),
//            'DB_PORT' => env('DB_PORT','3306'),
            'default' => env('DB_CONNECTION', 'mysql'),
            'migrations' => 'migrations',
            'connections' => [

                'sqlite' => [
                    'driver' => 'sqlite',
                    'database' => env('DB', database_path('database.sqlite')),
                    'prefix' => env('DB_PREFIX', ''),
                ],
                # outside of docker
                'local' => [
                    'driver' => 'mysql',
                    'host' => '127.0.0.1',
                    'port' => env('DB_PORT', 3306),
                    'database' => env('DB', 'xpto'),
                    'username' => env('DB_USER', 'forge'),
                    'password' => env('DB_PASSWORD', ''),
                    'unix_socket' => env('DB_SOCKET', ''),
                    'charset' => env('DB_CHARSET', 'utf8mb4'),
                    'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
                    'prefix' => env('DB_PREFIX', ''),
                    'strict' => env('DB_STRICT_MODE', true),
                    'engine' => env('DB_ENGINE'),
                    'timezone' => env('DB_TIMEZONE', '+00:00'),
                ],
                # inside docker
                'mysql' => [
                    'driver' => 'mysql',
                    'host' => env('DB_HOST', '127.0.0.1'),
                    'port' => env('DB_PORT', 3306),
                    'database' => env('DB', 'forge'),
                    'username' => env('DB_USER', 'forge'),
                    'password' => env('DB_PASSWORD', ''),
                    'unix_socket' => env('DB_SOCKET', ''),
                    'charset' => env('DB_CHARSET', 'utf8mb4'),
                    'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
                    'prefix' => env('DB_PREFIX', ''),
                    'strict' => env('DB_STRICT_MODE', true),
                    'engine' => env('DB_ENGINE'),
                    'timezone' => env('DB_TIMEZONE', '+00:00'),
                ],

                'pgsql' => [
                    'driver' => 'pgsql',
                    'host' => env('DB_HOST', '127.0.0.1'),
                    'port' => env('DB_PORT', 5432),
                    'database' => env('DB', 'forge'),
                    'username' => env('DB_USER', 'forge'),
                    'password' => env('DB_PASSWORD', ''),
                    'charset' => env('DB_CHARSET', 'utf8'),
                    'prefix' => env('DB_PREFIX', ''),
                    'search_path' => env('DB_SCHEMA', 'public'),
                    'sslmode' => env('DB_SSL_MODE', 'prefer'),
                ]
            ],
            'redis' => [

                'default' => [
                    'url' => env('REDIS_URL'),
                    'host' => env('REDIS_HOST', '127.0.0.1'),
                    'password' => env('REDIS_PASSWORD', ''),
                    'port' => env('REDIS_PORT', '6379'),
                    'database' => env('REDIS_DB', '0'),
                ]
            ],

        ];
    }

}
