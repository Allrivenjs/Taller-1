<?php

namespace App\Controller\Credit;

use App\Database\Database;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class CreditController
{

    public function __construct()
    {
    }

    
    public function GetDataByToken(){
        $request = Request::capture();
        $conDB = Database::getInstance()->getConnection();

        $headertoken = $request->header('Authorization');
        if(isset($headertoken)){
            $token = str_replace('Bearer ', '', $headertoken);
            $tokenDecode = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
            $username = $tokenDecode->user_name;
            $query = sprintf("SELECT u.id FROM user AS u INNER JOIN usercredentials AS c ON u.idUserCredentials=c.id WHERE user=%s",$username);
            $id=mysqli_query($conDB, $query);
            
            $data = array();
            $cont = 0;
            while ($user_row = $id->fetch_assoc()) {
                $data[$cont] = $user_row;
                $cont += 1;
            }
            return json_encode($data[0]);
    }
}

    public function InsertCredit()
    {

        $request = Request::capture();
        $conDB = Database::getInstance()->getConnection();

        $amount = mysqli_real_escape_string($conDB, $request->post("amountRequired"));
        $description = mysqli_real_escape_string($conDB, $request->post("description"));
        $interest = mysqli_real_escape_string($conDB, $request->post("interestRate"));
        $id=$this->GetDataByToken();
        $query = sprintf("INSERT INTO credit(idUser,amountRequired, description, interestRate) VALUES ('%u','%u','%s','%u')", $id,$amount, $description, $interest);
        mysqli_query($conDB, $query);

        return json_encode([
            'Error' => false,
            'msg' => 'El credito se registro satisfactoriamente'
        ]);
    }

    public function ViewCredit()
    {

        $conDB = Database::getInstance()->getConnection();
        $query = sprintf("SELECT * FROM credit AS c INNER JOIN user AS u ON c.idUser=u.id INNER JOIN creditstatus AS t ON t.idCredit=c.id");
        $allcredits = (mysqli_query($conDB, $query));
        $data = array();
        $cont = 0;
        while ($user_row = $allcredits->fetch_assoc()) {
            $data[$cont] = $user_row;
            $cont += 1;
        }

        return json_encode($data);
    }
    public function StatusCredit(){
        $request = Request::capture();
        $conDB = Database::getInstance()->getConnection();
        $status = mysqli_real_escape_string($conDB, $request->post("status"));
        $idCredit = mysqli_real_escape_string($conDB, $request->post("idCredit"));
        $idUser_responsible = mysqli_real_escape_string($conDB, $request->post("idUser_responsible"));

        $query = sprintf("INSERT INTO creditstatus(status,idCredit,idUser_responsible) VALUES ('%s','%s','%s')", $status, $idCredit, $idUser_responsible);
        mysqli_query($conDB, $query);

        return json_encode([
            'Error' => false,
            'msg' => 'El estado se actualizo correctamente'
        ]);


    }

    public function ViewPayment()
    {
        $conDB = Database::getInstance()->getConnection();
        $query = sprintf("SELECT * FROM payment()");
        $allpaymet = (mysqli_query($conDB, $query));
        $data = array();
        $cont = 0;
        while ($user_row = $allpaymet->fetch_assoc()) {
            $data[$cont] = $user_row;
            $cont += 1;
        }

        return json_encode($data);
    }


    
    }

