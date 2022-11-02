<?php


use Phroute\Phroute\RouteCollector;
use Controllers\Email\SendEmailController;

require_once '../controllers/Email/EmailController.php';

$router = Config\Providers\RouteServiceProviders::getInstance()->getRouter();

$router->get('/', function () {
    echo 'Hello world';
});

$router->post('/sendmail', function () {
    // {
    //     "email":"correo@gmail.com",
    //     "userName":"Hola mundo",
    //     "valueSent": "20000",
    //     "accountType":"ahorro",
    //     "typeTransfer":"externa",
    //     "isReceiving":false,
    //     "isFaild":false
    //   }

    try {
        $controller = new SendEmailController();
        $data = json_decode(file_get_contents("php://input"));
        if (!$data) {
            throw new Exception('no data');
            exit;
        }
        $resp  = $controller->sendEmail($data->email, $data->userName, $data->valueSent, $data->accountType, $data->typeTransfer, $data->isReceiving, $data->isFaild);
        $response = array("code" => 200, "msg" => "Mail sent successfully", "mail" => $resp);
        return json_encode(["response" => $response]);
    } catch (Exception $ex) {
        $response = array("code" => 400, "msg" => "opps!! Unsent mail", "error" => $ex);
        return json_encode(["response" => $response]);
    }
});

$router->group(['prefix' => 'api'], function (RouteCollector $router) {

    $router->get('/login', 'App\Controllers\AuthController@login');

    $router->group(['before' => 'auth'], function (RouteCollector $router) {

        $router->get('/posts', function () {
            echo 'posts';
        });
    });
});
