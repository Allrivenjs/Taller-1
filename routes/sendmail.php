<?php

use Controllers\Email\SendEmailController;

require_once '../controllers/Email/EmailController.php';

$router = Config\Providers\RouteServiceProviders::getInstance()->getRouter();

$router->post('/sendmail', function () {
    try {
        $controller = new SendEmailController();
        $data = json_decode(file_get_contents("php://input"));
        if (!$data) {
            throw new Exception('no data');
            exit;
        }
        $resp  = $controller->sendEmail($data->email, $data->userName,$data->valueSent);
        $response = array("code" => 200, "msg" => "Mail sent successfully", "mail"=> $resp);
        return json_encode(["response" => $response]);
    } catch (Exception $ex) {
        $response = array("code" => 400, "msg" => "opps!! Unsent mail", "error" => $ex);
        return json_encode(["response" => $response]);
    }
});
