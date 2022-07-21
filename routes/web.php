<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->get('/', 'AppController@index');
$router->get('/alive', 'AppController@alive');


