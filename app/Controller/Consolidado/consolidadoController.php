<?php 
namespace App\Controller\Consolidado;

use App\Database\Database;

class consolidadoController{

    public function __construct()
    {

    }

    public function getAllUser(){
        $ConDB = Database::getInstance()->getConnection();

        $query = "select * from user";
        $stmt_user = mysqli_query($ConDB, $query);
        $data = array();
        $cont = 0;
        while($user_row = $stmt_user->fetch_assoc()){
            $data[$cont] = $user_row;
            $cont += 1;
        }

        return json_encode($data);
    }

    public function getAllExternalTransfer(){
        $ConDB = Database::getInstance()->getConnection();

        $query = "select * from externaltransfer";
        $stmt_user = mysqli_query($ConDB, $query);
        $data = array();
        $cont = 0;
        while($user_row = $stmt_user->fetch_assoc()){
            $data[$cont] = $user_row;
            $cont += 1;
        }

        return json_encode($data);
    }

    public function getAllInternalTransfer(){
        $ConDB = Database::getInstance()->getConnection();

        $query = "select * from internaltransfer";
        $stmt_user = mysqli_query($ConDB, $query);
        $data = array();
        $cont = 0;
        while($user_row = $stmt_user->fetch_assoc()){
            $data[$cont] = $user_row;
        }

        return json_encode($data);
    }

    public function getAllPayment(){
        $ConDB = Database::getInstance()->getConnection();

        $query = "select * from payment";
        $stmt_user = mysqli_query($ConDB, $query);
        $data = array();
        $cont = 0;
        while($user_row = $stmt_user->fetch_assoc()){
            $data[$cont] = $user_row;
        
            $cont += 1;
        }

        return json_encode($data);
    }

}
?>