<?php

declare(strict_types=1);

//// Setup autoloading
//define('APP_ROOT', dirname(__DIR__));
//include_once(APP_ROOT . '/vendor/autoload.php');
//
//use Dotenv\Dotenv;
//
////TODO mudar para
////(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
////    dirname(__DIR__). 'env',
////))->bootstrap();
////load env
//$dotenv = Dotenv::createUnsafeMutable(APP_ROOT . DIRECTORY_SEPARATOR . 'env', 'testing.env');
//$dotenv->load();
//
//// TODO not working
//define('APP_NAME', getenv('APP_NAME') ?: 'php-design-patterns-guide');
//define('APP_VERSION', getenv('APP_VERSION') ?: '1.0.0');
//define('APP_ARCH_VERSION', getenv('APP_ARCH_VERSION') ?: 'v1');

require_once __DIR__ . '/../vendor/autoload.php';

// TODO revisar para ver uma solução melhor
// TODO not working
define('APP_ROOT', dirname(__DIR__));
define('APP_NAME', getenv('APP_NAME') ?: 'php-design-patterns-guide');
define('APP_VERSION', getenv('APP_VERSION') ?: '1.0.0');
define('APP_ARCH_VERSION', getenv('APP_ARCH_VERSION') ?: 'v1');

/** TODO ajustar o boot */
$filename = sprintf('%s.env', APPLICATION_ENV);
(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__). 'env', $filename
))->bootstrap();

//datetime utc
//date_default_timezone_set(getenv('APP_TIMEZONE')?: 'UTC');
// Brazil
date_default_timezone_set('Etc/GMT+3');

// Self-called anonymous function that creates its own scope and keep the global namespace clean.
(static function () {
    // initialize somenthing necessary here
})();
