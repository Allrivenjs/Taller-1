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
        $user_row = $stmt_user->fetch_assoc();
        $data = array();
        while($row = $user_row){
            array_push($data, $row);
        }

        return $data;
    }

    public function getAllExternalTransfer(){
        $ConDB = Database::getInstance()->getConnection();

        $query = "select * from externaltransfer";
        $stmt_user = mysqli_query($ConDB, $query);
        $user_row = $stmt_user->fetch_assoc();
        $data = array();
        while($row = $user_row){
            array_push($data, $row);
        }

        return "Hola";
    }

    public function getAllInternalTransfer(){
        $ConDB = Database::getInstance()->getConnection();

        $query = "select * from internaltransfer";
        $stmt_user = mysqli_query($ConDB, $query);
        $user_row = $stmt_user->fetch_assoc();
        $data = array();
        while($row = $user_row){
            array_push($data, $row);
        }

        return $data;
    }
}
?>