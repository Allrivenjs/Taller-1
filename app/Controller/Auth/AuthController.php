<?php

namespace App\Controller\Auth;

use App\Database\Database;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use mysqli_sql_exception;

class AuthController
{

    /**
     * @return void
     * @throws Exception
     */
    public function SignOut(): void
    {
        $request = Request::capture();
        $UserData = sprintf("'%s'", implode("','",$request->only('identityNumber', 'identityType', 'name', 'lastname', 'address', 'phone', 'email', 'gender', 'dob', 'idUserCredentials')));
        $data_in_token = $request->only("user_name");
        $token = JWT::encode($this->GenerateToken($data_in_token), getenv('JWT_SECRET'), 'HS256');//Generate token
        $ConDB = Database::getInstance()->getConnection(); //Conection to Database
        $username = mysqli_real_escape_string($ConDB,$request->post("user_name"));
        $password = mysqli_real_escape_string($ConDB,sha1($request->post("password")));
        try {
            $ConDB->autocommit(false);
            $insert_user_credentials = sprintf("INSERT INTO `usercredentials` (`user`, `password`) VALUES ('%s','%s');",$username, $password);
            $ConDB->query($insert_user_credentials);
            $insert_user = "INSERT INTO `user` (`identityNumber`, `identityType`, `name`, `lastname`, `address`, `phone`, `email`, `gender`, `dob`, `idUserCredentials`) VALUES ($UserData,'$ConDB->insert_id');";
            $ConDB->query($insert_user);
            $ConDB->commit();
            //Response OK
            http_response_code(200);
            print(json_encode(array('detail' => 'Usuario registrado correctamente', 'token' => $token)));
        } catch (mysqli_sql_exception $e){
            $ConDB->rollback();
            http_response_code(409);
            print(json_encode(array('detail' => 'El usuario ya existe o alguno de los campos es incorrecto.')));
        } finally {
            $ConDB->close();
        }

    }

    /**
     * @throws Exception
     * @return void
     */
    public function Login(): void
    {
        $request = Request::capture();
        $ConDB = Database::getInstance()->getConnection(); //Conection to Database
        $username = mysqli_real_escape_string($ConDB,$request->post("user_name"));
        $password = mysqli_real_escape_string($ConDB,sha1($request->post("password")));
        /*
         * querying user data
         * */
        
        $query_user = sprintf("SELECT uc.idRole, user.* FROM user INNER JOIN usercredentials uc on user.idUserCredentials=uc.id WHERE uc.user = '%s' AND uc.password = '%s';",$username, $password);
        echo"$query_user";
        $stmt_user = mysqli_query($ConDB, $query_user);
        $user_row = $stmt_user->fetch_assoc();
        if (mysqli_num_rows($stmt_user) == 1) {

            $data_in_token = array(
                "user_name" => $username,
                "rol" => $user_row['idRole'],
            );

            $token = JWT::encode($this->GenerateToken($data_in_token), getenv('JWT_SECRET'), 'HS256');//Generate token
            http_response_code(300);
            $output = array('token' => $token, 'user_data' => $user_row);
            print(json_encode($output));
            return;
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
        //only 4 hours to use
        $expiration_time = $start_time + (60 * 60 * 4);
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
                Database::getInstance()->SetUserConnection($tokenDecode->data->rol);
                return true;
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