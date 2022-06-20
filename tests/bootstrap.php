<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Psr\Container\ContainerInterface;

define('APP_ROOT', dirname(__DIR__));

//load env
$dotenv = Dotenv::createMutable(APP_ROOT . DIRECTORY_SEPARATOR . 'env', 'development.env');
$dotenv->load();


define('APP_NAME', getenv('APP_NAME')?:'php-design-patterns-guide');
define('APP_VERSION', getenv('APP_VERSION')?:'1.0.0');
define('APP_ARCH_VERSION', getenv('APP_ARCH_VERSION')?:'v1');

// Setup autoloading
include_once(APP_ROOT . '/vendor/autoload.php');

//datetime utc
//date_default_timezone_set(getenv('APP_TIMEZONE')?: 'UTC');
// Brazil
date_default_timezone_set('Etc/GMT+3');

// Self-called anonymous function that creates its own scope and keep the global namespace clean.
(static function () {
    // initialize somenthing necessary here
})();
