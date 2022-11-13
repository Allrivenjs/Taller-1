<?php

use App\Controller\Auth\AuthController;
use Phroute\Phroute\RouteCollector;
$router = Config\Providers\RouteServiceProviders::getInstance()->getRouter();

$router->get('/', function () {
    echo 'Hello World!';
});


$router->group(['prefix'=> 'api'], function (RouteCollector $router){


    $router->post('/login', [AuthController::class, 'Login']);
    $router->post('/signout', [AuthController::class, 'SignOut']);

    
    $router->group(['before' => 'auth'], function(RouteCollector $router){

        $router->get('/posts', function(){
            echo 'posts';
        });

    });


});




