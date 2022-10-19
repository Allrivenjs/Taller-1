<?php
use Phroute\Phroute\RouteCollector;

$router = Config\Providers\RouteServiceProviders::getInstance()->getRouter();

$router->get('/', function () {
    echo 'Hello world';
});


$router->group(['prefix'=> 'api'], function (RouteCollector $router){

    $router->get('/login', 'App\Controllers\AuthController@login');

    $router->group(['before' => 'auth'], function (RouteCollector $router) {

        $router->get('/posts', function () {
            echo 'posts';
        });
    });
});
