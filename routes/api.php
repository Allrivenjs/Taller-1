<?php

<<<<<<< HEAD
=======
use App\Controller\Auth\AuthController;
>>>>>>> c4ae6cfc27cef11bc299aa885e0c09034c9295a4
use Phroute\Phroute\RouteCollector;
$router = Config\Providers\RouteServiceProviders::getInstance()->getRouter();

$router->get('/', function () {
    echo 'Hello World!';
});


$router->group(['prefix'=> 'api'], function (RouteCollector $router){

<<<<<<< HEAD
    $router->get('/login', 'App\Controllers\AuthController@login');
=======
    $router->post('/login', [AuthController::class, 'Login']);
>>>>>>> c4ae6cfc27cef11bc299aa885e0c09034c9295a4

    $router->group(['before' => 'auth'], function(RouteCollector $router){

        $router->get('/posts', function(){
            echo 'posts';
        });

    });

});




