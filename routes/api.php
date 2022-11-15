<?php

use App\Controller\Auth\AuthController;
use Phroute\Phroute\RouteCollector;
use App\Controller\ExternalTransaction\ExternalTransactionController;
$router = Config\Providers\RouteServiceProviders::getInstance()->getRouter();

$router->get('/', function () {
    echo 'Hello World!';
});


$router->group(['prefix'=> 'api'], function (RouteCollector $router){

    $router->post('/login', [AuthController::class, 'Login']);
    $router->post('/signout', [AuthController::class, 'SignOut']);

    $router->get('/externalTransById', [ExternalTransactionController::class, 'getIdET']);
    $router->post('/externalTransCreateExternal', [ExternalTransactionController::class, 'CreateETE']);
    $router->post('/externalTransCreateInternal', [ExternalTransactionController::class, 'CreateETI']);




    $router->group(['before' => 'auth'], function(RouteCollector $router){

        $router->get('/posts', function(){
            echo 'posts';
        });

    });


});




