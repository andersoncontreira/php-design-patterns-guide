<?php

use Laravel\Lumen\Routing\Router;

$v1 = [
    'prefix' => '/v1',
    'middleware' => ['authenticate','authorization']
];

$routes = [
//    '/routes/v1/products/products.php',
//    '/routes/v1/examples/examples.php',
];

/** @var Router $router */
$router->group($v1, function () use($router, $routes) {
    $dir = dirname(__DIR__, 2) ;
//    foreach ($routes as $route) {
//        require($dir. $route);
//    }
});
