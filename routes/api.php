<?php

use App\Controller\Auth\AuthController;
use App\Controller\Email\SendEmailController;
use Phroute\Phroute\RouteCollector;
use App\Controller\ExternalTransaction\ExternalTransactionController;


$router = Config\Providers\RouteServiceProviders::getInstance()->getRouter();

$router->get('/', function () {
    echo 'Hello world';
});



$router->group(['prefix' => 'api'], function (RouteCollector $router) {

    $router->post('/externalTransById', [ExternalTransactionController::class, 'getIdET']);
    $router->get('/externalTransAll', [ExternalTransactionController::class, 'getAllET']);
    $router->post('/externalTransCreateExternal', [ExternalTransactionController::class, 'CreateETE']);
    $router->post('/externalTransCreateInternal', [ExternalTransactionController::class, 'CreateETI']);

    $router->post('/sendmail', [SendEmailController::class, 'TestEmail']);

    $router->post('/login', [AuthController::class, 'Login']);
    $router->post('/signout', [AuthController::class, 'SignOut']);
    
    $router->group(['before' => 'auth'], function(RouteCollector $router){


        $router->get('/posts', function () {
            echo 'posts';
        });
    });
});
