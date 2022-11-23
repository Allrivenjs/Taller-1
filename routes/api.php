<?php


use App\Controller\Auth\AuthController;
use Phroute\Phroute\RouteCollector;
use App\Controller\Credit\CreditController;

$router = Config\Providers\RouteServiceProviders::getInstance()->getRouter();

$router->get('/', function () {
    echo 'Hello World!';
    
});

$router->get('/view/credit', [CreditController::class, 'ViewCredit']);
$router->get('/view/payment', [CreditController::class, 'ViewPayment']);
$router->post('/create/status', [CreditController::class, 'StatusCredit']);
$router->post('/create/credit', [CreditController::class, 'InsertCredit']);


$router->group(['prefix'=> 'api'], function (RouteCollector $router){

    $router->post('/login', [AuthController::class, 'Login']);
    $router->post('/signout', [AuthController::class, 'SignOut']);

    $router->group(['before' => 'auth'], function(RouteCollector $router){
        
        

        $router->get('/posts', function(){
            echo 'posts';
        });

    });


});






