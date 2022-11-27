<?php


use App\Controller\Auth\AuthController;
use App\Controller\Email\SendEmailController;
use App\Controller\Consolidado\consolidadoController;
use Phroute\Phroute\RouteCollector;
use App\Controller\Credit\CreditController;
use App\Controller\ExternalTransaction\ExternalTransactionController;


$router = Config\Providers\RouteServiceProviders::getInstance()->getRouter();

    $router->get('/', function () {
        echo 'Hello World!';
    });

    $router->group(['prefix' => 'api'], function (RouteCollector $router) {

      $router->get('/todos/transferencias/externas', [consolidadoController::class, 'getAllExternalTransfer']);
      $router->get('/todos/transferencias/internas', [consolidadoController::class, 'getAllInternalTransfer']);
      $router->get('/todos/usuarios', [consolidadoController::class, 'getAllUser']);
      $router->get('/todos/pagos', [consolidadoController::class, 'getAllPayment']);
      $router->get('/todos/creditos', [consolidadoController::class, 'getAllCredit']);



      $router->get('/view/credit', [CreditController::class, 'ViewCredit']);
      $router->get('/view/payment', [CreditController::class, 'ViewPayment']);
      $router->post('/create/status', [CreditController::class, 'StatusCredit']);
      $router->post('/create/credit', [CreditController::class, 'InsertCredit']);



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


          /** Rutas del consolidado diario de operaciones - GRUPO CAMILO PATERNINA */


     });
});

