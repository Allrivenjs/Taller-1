<?php

namespace App\Controller\Auth;

use App\Database\Database;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class AuthController
{


    public function __construct()
    {

    }

    public function SignOut(): void
    {
        $request = Request::capture();
        $UserData = $request->only('id_user', 'names', 'lastnames', 'email', 'dob', 'phone', 'address', 'password');
        $UserDataText = sprintf("'%s'", implode("','",$UserData));
        $data_in_token = array(
            "email" => $UserData["email"],
            "rol" => 1,
        );

        $token = JWT::encode($this->GenerateToken($data_in_token), getenv('JWT_SECRET'), 'HS256');//Generate token
        $insert_user = "INSERT INTO `user` (`id_user`, `names`, `lastnames`, `email`, `dob`, `phone`, `address`, `password`,`token`) VALUES ($UserDataText,'$token');";
        $ConDB = Database::getInstance()->getConnection(); //Conection to Database
        try {
            mysqli_query($ConDB, $insert_user);
            if($ConDB->affected_rows==1){
                //Response OK
                http_response_code(200);
                print(json_encode(array('detail' => 'Usuario registrado correctamente', 'token' => $token)));
            }
        }catch (\mysqli_sql_exception $e){
            //Exception control if the user is already registered or any other error.
            http_response_code(403);
            print(json_encode(array('detail' => 'El usuario ya existe o alguno de los campos es incorrecto.')));
        }

    }

    /**
     * @throws Exception
     */
    public function Login(): void
    {
        $request = Request::capture();
        $credentials = $request->only('email', 'password');//Get credentials
        $ConDB = Database::getInstance()->getConnection(); //Conection to Database
        //Transform credentials
        $temp_email = mysqli_real_escape_string($ConDB, $credentials['email']);
        $temp_pass = mysqli_real_escape_string($ConDB, sha1($credentials['password']));
        /*
         * querying user data
         * */
        $query_user = "SELECT id_user,fk_rol,names,lastnames,phone,dob FROM user WHERE email = '$temp_email' AND password = '$temp_pass'";
        $stmt_user = mysqli_query($ConDB, $query_user);
        $user_row = $stmt_user->fetch_assoc();
        if (mysqli_num_rows($stmt_user) == 1) {

            $data_in_token = array(
                "email" => $temp_email,
                "rol" => $user_row['fk_rol'],
            );

            $token = JWT::encode($this->GenerateToken($data_in_token), getenv('JWT_SECRET'), 'HS256');//Generate token
            //this code insert the token in the user table and return the current rol of user
            $user_id = $user_row["id_user"];
            $query_update = "UPDATE user SET token = '$token' WHERE id_user = $user_id";
            $query_result = mysqli_query($ConDB, $query_update);
            if (mysqli_affected_rows($ConDB) == 1) {
                http_response_code(200);
                $output = array('token' => $token, 'user_data' => $user_row);
                print(json_encode($output));
                return;
            }

        }

        //if it did not find the user, then it exits the upper conditional and prints the following message
        http_response_code(403);
        print(json_encode(array('detail' => 'Credenciales incorrectas o invalidas, por favor intente nuevamente')));

    }

    /**
     * @throws Exception
     */
    private function GenerateToken(array $data): array
    {
        $start_time = time();
        $expiration_time = $start_time + (60 * 60 * 24 * 2);
        return array(
            "iat" => $start_time,
            "exp" => $expiration_time,
            "nbf" => $start_time,
            "jti" => base64_encode(random_bytes(16)),
            "data" => $data);
    }

    /**
     * @throws ExpiredException
     * @throws Exception
     * @return bool
     */
    public static function ValidateToken():bool
    {
        $request = Request::capture();
        $headertoken = $request->header('Authorization');
        if(isset($headertoken)){
            $token = str_replace('Bearer ', '', $headertoken);
            $tokenDecode = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
            $now = time();
            //check that it is not expired
            if ($now < $tokenDecode->exp) {
                $ConDB = Database::getInstance()->getConnection(); //Conection to Database
                $query_user = "SELECT fk_rol FROM user WHERE token = '$token'";
                $stmt_user = mysqli_query($ConDB, $query_user);
                $user_row = $stmt_user->fetch_assoc();
                if($ConDB->affected_rows==1){
                    Database::getInstance()->SetUserConnection($user_row['fk_rol']);
                    return true;
                }
            }
        }

        return false;
    }
    /*
     * ©2/11/2022
     * All Rights Reserved.
     *
     * Made in Colombia by:
     * Carlos Daniel Castro Maussa
     * Juan Guillermo Florez Burgos
     * Daniela Salazar Gonzalez
     * Sebastian Quinchia Lobo
     * */
}