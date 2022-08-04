<?php

declare(strict_types=1);

error_reporting(E_ALL);
set_error_handler(function (int    $errno,
                            string $errstr,
                            string $errfile,
                            int    $errline,
                            array  $errcontext
) {
    var_dump(func_get_args());

});

require_once __DIR__ . '/../vendor/autoload.php';

// TODO revisar para ver uma solução melhor
// TODO not working
if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__DIR__));
}
if (!defined('APP_NAME')) {
    define('APP_NAME', getenv('APP_NAME') ?: 'php-design-patterns-guide');
}
if (!defined('APP_VERSION')) {
    define('APP_VERSION', getenv('APP_VERSION') ?: '1.0.0');
}
if (!defined('APP_ARCH_VERSION')) {
    define('APP_ARCH_VERSION', getenv('APP_ARCH_VERSION') ?: 'v1');
}
if (!defined('APPLICATION_ENV')) {
    define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: 'testing');
}

$path = dirname(__DIR__) . '/env';
$filename = sprintf('%s.env', APPLICATION_ENV);
(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables($path, $filename))->bootstrap();

//datetime utc
//date_default_timezone_set(getenv('APP_TIMEZONE')?: 'UTC');
// Brazil
date_default_timezone_set('Etc/GMT+3');

// Self-called anonymous function that creates its own scope and keep the global namespace clean.
(static function () {
    // initialize something necessary here
})();
