<?php

use App\Controller\Auth\AuthController;
use App\Controller\Email\SendEmailController;
use App\Controller\Auth\conslidadoController;
use Phroute\Phroute\RouteCollector;


$router = Config\Providers\RouteServiceProviders::getInstance()->getRouter();

$router->get('/', function () {
    echo 'Hello world';
});



$router->group(['prefix' => 'api'], function (RouteCollector $router) {


    $router->post('/sendmail', [SendEmailController::class, 'TestEmail']);

    $router->post('/login', [AuthController::class, 'Login']);
    $router->post('/signout', [AuthController::class, 'SignOut']);
    
    $router->group(['before' => 'auth'], function(RouteCollector $router){


        $router->get('/posts', function () {
            echo 'posts';
        });

        $router->get('/todos/usuarios',[conslidadoController::class, 'getAllUser']);
        $router->get('/todos/transferencias/externas',[conslidadoController::class, 'etAllExternalTransfer']);
        $router->get('/todos/transferencias/internas',[conslidadoController::class, 'getAllInternalTransfer']);
        
    });
});
