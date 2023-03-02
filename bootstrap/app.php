<?php


use Illuminate\Support\Facades\Artisan;

require_once __DIR__ . '/../vendor/autoload.php';

// TODO revisar para ver uma solução melhor
// TODO not working
define('APP_ROOT', dirname(__DIR__));
define('APP_NAME', getenv('APP_NAME') ?: 'php-design-patterns-guide');
define('APP_VERSION', getenv('APP_VERSION') ?: '1.0.0');
define('APP_ARCH_VERSION', getenv('APP_ARCH_VERSION') ?: 'v1');
define('APP_ENV', getenv('APP_ENV') ?: 'development');
define('APPLICATION_ENV', getenv('APP_ENV') ?: 'development');

/** TODO ajustar o boot */
$filename = sprintf('%s.env', APPLICATION_ENV);
(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__). '/env', $filename
))->bootstrap();

//datetime utc
//date_default_timezone_set(getenv('APP_TIMEZONE')?: 'UTC');
// Brazil
date_default_timezone_set('Etc/GMT+3');

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new \Application\Application(dirname(__DIR__));

$app->withFacades();

// $app->withEloquent();


$app->configure('swagger-lume');
/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
//    \Application\Exceptions\CustomExceptionHandler::class // custom
    Laravel\Lumen\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    \Laravel\Lumen\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
|
| Now we will register the "app" configuration file. If the file exists in
| your configuration directory it will be loaded; otherwise, we'll load
| the default version. You may register other files below as needed.
|
*/

$app->configure('app');

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

$app->middleware([
    // Application\Http\Middleware\Public\WatchRequestMiddleware::class,
    Application\Http\Middleware\Cors\CorsMiddleware::class
]);

//$app->routeMiddleware([
//    'authenticate' => Application\Http\Middleware\Authentication\Cognito\CognitoAuthenticationMiddleware::class,
//    'authorization' => Application\Http\Middleware\Authorization\ACL\AuthorizationMiddleware::class
//]);


/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$providers = [
//    Application\Providers\AuthServiceProvider::class,
//    Application\Providers\DependenceInjection\Caching\Redis\RedisCacheClientServiceProvider::class
    SwaggerLume\ServiceProvider::class
];

foreach ($providers as $provider) {
    $app->register($provider);
}

// $app->register(Application\Providers\AuthServiceProvider::class);
// $app->register(Application\Providers\EventServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group(
    [
        'namespace' => 'Application\Http\Controllers',
    ],
    function ($router) {
        require __DIR__ . '/../routes/web.php';
        require __DIR__ . '/../routes/v1/routes.php';
    }
);

/**
 * https://packagist.org/packages/flipbox/lumen-generator
 */
$app->register(Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class);

return $app;
