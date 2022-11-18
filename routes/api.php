<?php

use App\Controller\Auth\AuthController;
use App\Controller\Email\SendEmailController;
use App\Controller\Consolidado\consolidadoController;
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


        /** Rutas del consolidado diario de operaciones - GRUPO CAMILO PATERNINA */
        $router->get('/todos/usuarios',[consolidadoController::class, 'getAllUser']);
        $router->get('/todos/transferencias/externas',[consolidadoController::class, 'getAllExternalTransfer']);
        $router->get('/todos/transferencias/internas',[consolidadoController::class, 'getAllInternalTransfer']);
        
    });
});
