<?php

use Application\Http\Controllers\V1\ProductController;
use Laravel\Lumen\Routing\Router;

$version = 'V1';

function get_simple_name($className) {
    $path = explode('\\', $className);
    return array_pop($path);
}

//$logger = app()->get(\Monolog\Logger::class);
//app()->singleton(ProductController::class, new ProductController($logger));

/** @var Router $router */
$router->group(
    ['prefix' => '/product'],
    function () use ($router, $version) {
        $controller = get_simple_name(ProductController::class);
//        print(sprintf('%s\%s@list', $version, $controller));
        $router->get('/', sprintf('%s\%s@list', $version, $controller));
    }
);

