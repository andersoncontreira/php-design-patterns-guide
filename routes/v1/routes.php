<?php

use Laravel\Lumen\Routing\Router;

$authMiddlewares = ['authenticate','authorization'];

if (get_environment() == 'development') {
    $authMiddlewares = [];
}

$v1 = [
    'prefix' => '/v1',
    'middleware' => $authMiddlewares
];

$routes = [
    '/routes/v1/product.php',
//    '/routes/v2/product.php',
//    '/routes/v1/product.php',
//    '/routes/v1/product.php',
];

/** @var Router $router */
$router->group($v1, function () use($router, $routes) {
    $dir = dirname(__DIR__, 2) ;
    foreach ($routes as $route) {
        require($dir. $route);
    }
});
