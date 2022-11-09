<?php

use App\Database\Database;

/*
 * ¿How to use DB class with the pattern Singleton?
 * here is a simple example my friends... u can use it to try...
 * */

try {
    Database::getInstance()->getConnection();
} catch (Exception $e) {
    /*
     * ¡U can check problems here!
     * */
    http_response_code(500);
    print(json_encode(array('response' => $e->getMessage())));
    exit();
}

/*
 * redundancy
 * */
http_response_code(200);
print(json_encode(array('response' => 'OK')));
exit();