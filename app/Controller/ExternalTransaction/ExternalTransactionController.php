<?php

namespace App\Controller\ExternalTransaction;

use Illuminate\Http\Request;
use App\Database\Database;
use mysqli;
use mysqli_sql_exception;

class ExternalTransactionController
{

    public function __construct()
    {
    }

    public function CreateETE(): void
    {
        $request = Request::capture();
        $ConDB = Database::getInstance()->getConnection();
        $EANumber = mysqli_real_escape_string($ConDB, $request->post("ea_number"));
        $verified = ExternalTransactionController::VerifiedAccount($EANumber);
        //Variables que almacenaran los datos para la consulta
        $idAccount = $verified;
        $transactionType = mysqli_real_escape_string($ConDB, $request->post("transaction_type"));
        $EAType = mysqli_real_escape_string($ConDB, $request->post("ea_type"));
        $amount = intval(mysqli_real_escape_string($ConDB, $request->post("amount")));
        $date = mysqli_real_escape_string($ConDB, $request->post("date"));
        $status = 'aprove';
        $EAOwnerName = mysqli_real_escape_string($ConDB, $request->post("eao_name"));
        $EAOwnerId = mysqli_real_escape_string($ConDB, $request->post("eao_id"));
        $EAOwnerIdType = mysqli_real_escape_string($ConDB, $request->post("eao_idtype"));
        $description = mysqli_real_escape_string($ConDB, $request->post("description"));
        $bankName = mysqli_real_escape_string($ConDB, $request->post("bank_name"));

        if (strlen($verified) > 0) {
            $res_amount = ExternalTransactionController::VerifiedAmount($EANumber);
            $query_success = "INSERT into `externaltransfer` (`idAccount`, `EANumber`, `transactionType`, `EAType`, `amount`, `date`, `status`, `EAOwnerName`, `EAOwnerId`, `EAOwnerIdType`, `description`, `bankName`)  VALUES ('$idAccount','$EANumber','$transactionType','$EAType','$amount','$date','$status','$EAOwnerName','$EAOwnerId', '$EAOwnerIdType','$description','$bankName')";
            $req = mysqli_query($ConDB, $query_success);
             $new_amount = $res_amount + $amount;
             ExternalTransactionController::UpdateAmount($idAccount, $new_amount);
             // print(json_encode(array('message' => 'Transacción realizada con éxito')));
            //  $ConDB->close();
            echo "ee";
             http_response_code(200);
        } else {
            http_response_code(404);
            print(json_encode(array('message' => 'Número de cuenta no existe')));
        }
    }

    public function CreateETI(): void
    {
        $request = Request::capture();
        $ConDB = Database::getInstance()->getConnection();
        $EANumber = mysqli_real_escape_string($ConDB, $request->post("ea_number"));  
        $idAccount = ExternalTransactionController::VerifiedAccount($EANumber);
        $res_amount = ExternalTransactionController::VerifiedAmount($EANumber);
        $transactionType = mysqli_real_escape_string($ConDB, $request->post("transaction_type"));
        $EAType = mysqli_real_escape_string($ConDB, $request->post("ea_type"));
        $amount = mysqli_real_escape_string($ConDB, $request->post("amount"));
        $date = mysqli_real_escape_string($ConDB, $request->post("date"));
        $status = 'aprove';
        $EAOwnerName = mysqli_real_escape_string($ConDB, $request->post("eao_name"));
        $EAOwnerId = mysqli_real_escape_string($ConDB, $request->post("eao_id"));
        $EAOwnerIdType = mysqli_real_escape_string($ConDB, $request->post("eao_idtype"));
        $description = mysqli_real_escape_string($ConDB, $request->post("description"));
        $bankName = mysqli_real_escape_string($ConDB, $request->post("bank_name"));

        if($idAccount != ''){
            if ($res_amount > $amount) {
                try {
                    $query_success = "INSERT into `externaltransfer` (`idAccount`, `EANumber`, `transactionType`, `EAType`, `amount`, `date`, `status`, `EAOwnerName`, `EAOwnerId`, `EAOwnerIdType`, `description`, `bankName`)  VALUES ('$idAccount','$EANumber','$transactionType','$EAType','$amount','$date','$status','$EAOwnerName','$EAOwnerId', '$EAOwnerIdType','$description','$bankName')";
                    // $query_success = "INSERT INTO `externaltransfer` (`idAccount`, `EANumber`, `transactionType`, `EAType`, `amount`, CURRENT_TIMESTAMP, `status`, `EAOwnerName`, `EAOwnerId`, `EAOwnerIdType`, `description`, `bankName`)  VALUES ('$idAccount','$EANumber','$transactionType','$EAType','$amount','$date','$status','$EAOwnerName','$EAOwnerId', '$EAOwnerIdType','$description','$bankName')";
                    $req = mysqli_query($ConDB, $query_success);
                    $new_amount = $res_amount - $amount;
                    ExternalTransactionController::UpdateAmount($idAccount, $new_amount);
                    //Respuesta
                    http_response_code(200);
                    // print(json_encode(array('message' => 'Transacción realizada con éxito')));
                    // $ConDB->close();
                } catch (mysqli_sql_exception $e) {
                    //throw $th;$ConDB->rollback();
                    $ConDB->rollback();
                    http_response_code(409);
                    print($e);
                } finally {
                    // $ConDB->close();
                }
            } else {
                try {
                    $status = 'refused';
                    $query_unsuccess = "INSERT INTO `externaltransfer` (`idAccount`, `EANumber`, `transactionType`, `EAType`, `amount`, `date`, `status`, `EAOwnerName`, `EAOwnerId`, `EAOwnerIdType`, `description`, `bankName`)  VALUES ('$idAccount','$EANumber','$transactionType','$EAType','$amount','$date','$status','$EAOwnerName','$EAOwnerId', '$EAOwnerIdType','$description','$bankName')";
                    $req = mysqli_query($ConDB, $query_unsuccess);
                    // $ConDB->close();
                    http_response_code(200);
                    print(json_encode(array('message' => 'La transaccion no se pudo realizar, no cuenta con fondos suficientes')));
                } catch (mysqli_sql_exception $e) {
                    $ConDB->rollback();
                    http_response_code(404);
                } finally {
                    // $ConDB->close();
                }
            }    
        }else{
            http_response_code(404);
            print(json_encode(array('message' => 'La transaccion no se pudo realizar, Usuario no encontrado')));
        }
    }



    public function VerifiedAccount($id)
    {
        $response = '';
        $request = Request::capture();
        $ConDB = Database::getInstance()->getConnection();
        $idAccount = mysqli_real_escape_string($ConDB, $request->post("id_account"));
        $query  = "SELECT * FROM account where accountNumber = '$id'";
        $req = mysqli_query($ConDB, $query);
        $query_row = mysqli_fetch_array($req);
        if ($query_row != '') {
            $response = $query_row['id'];
        }
        return $response;
    }

    public function UpdateAmount($id, $amount)
    {
        $ConDB = Database::getInstance()->getConnection();
        $query  = "UPDATE `account` SET `amount` = '$amount' where id = '$id'";
        $req = mysqli_query($ConDB, $query);
        $ConDB->close();
    }

    
    public function VerifiedAmount($id)
    {

        try {
            $response = 0;
            $request = Request::capture();
            $ConDB = Database::getInstance()->getConnection();
            $idAccount = mysqli_real_escape_string($ConDB, $request->post("id_account"));
            $query  = "SELECT * FROM account where accountNumber = '$id'";

            $req = mysqli_query($ConDB, $query);
          
            $query_row = mysqli_fetch_array($req);

            if ($query_row!='') {
                $response = $query_row['amount'];
            }
            return $response;
            //code...
        } catch (\Throwable $th) {
            //throw $th;

            echo $th;
       
        }
        // $response = 0;
        // $request = Request::capture();
        // $ConDB = Database::getInstance()->getConnection();
        // $idAccount = mysqli_real_escape_string($ConDB, $request->post("id_account"));
        // $query  = "SELECT * FROM account where accountNumber = '$id'";
        // $req = mysqli_query($ConDB, $query);
        // $query_row = mysqli_fetch_array($req);

        // if ($query_row) {
        //     $response = $query_row['amount'];
        // }

        // return $response;
    }

    public function getAllET()
    {
        try {
            $request = Request::capture();
            $ConDB = Database::getInstance()->getConnection();
            $query  = "SELECT * FROM externaltransfer";
            $req = mysqli_query($ConDB, $query);
            $query_row = mysqli_fetch_array($req);
            $myarry = [];
            if ($query_row) {
                $req1 = mysqli_query($ConDB, $query);
                $data=array();
                if(mysqli_num_rows($req1)>0){
                    while ($row = mysqli_fetch_array($req1)){
                        $info =  array('id' => $row['id'],'transactioType' => $row['transactionType'], 'amount' => $row['amount'], 'date'=> $row['date'], 'status'=> $row['status'], 'bankName'=>$row['bankName']);
                        array_push($data, $info);                                 
                    }                  
                }
                print(json_encode($data));
                /* print(json_encode(array('message' => 'Datos encontrados', 'data'=> $data))); */
            }else{
                http_response_code(404);
                print(json_encode("404 ERROR"));
            }
        } catch (\Throwable $th) {
            print(json_encode("404 ERROR"));
            http_response_code(400);
        }
    }

    /* public function getAllET(){
        try {
            $request = Request::capture();
            $ConDB = Database::getInstance()->getConnection();
            $query  = "SELECT * FROM account";
            $req = mysqli_query($ConDB, $query);
            $query_row = mysqli_fetch_array($req);
            $myarry = [];
            if ($query_row) {
                $req1 = mysqli_query($ConDB, $query);
                $data=array();
                if(mysqli_num_rows($req1)>0){
                    while ($row = mysqli_fetch_array($req1)){
                        $info =  array('id' => $row['id'],'accountNumber'=> $row['accountNumber'],'type'=> $row['type'],'amount'=> $row['amount'],'idUser'=> $row['idUser'] );
                        array_push($data, $info);                                 
                    }                  
                }
                print(json_encode($data));
                
            }else{
                http_response_code(404);
            }
        } catch (\Throwable $th) {
            http_response_code(400);
        }
    } */

    public function getIdET(){
        try {
            $request = Request::capture();
            $ConDB = Database::getInstance()->getConnection();
            $idAccount = mysqli_real_escape_string($ConDB, $request->post("id_account"));
            $query  = "SELECT * FROM externaltransfer where id = '$idAccount'";
            $req = mysqli_query($ConDB, $query);
            $query_row = mysqli_fetch_array($req);
            if ($query_row) {
                try {
                    $info =  array('id' => $query_row['id'],'idAccount'=> $query_row['idAccount'],'EANumber'=> $query_row['EANumber'], 'transactioType' => $query_row['transactionType'], 'EAType'=> $query_row['EAType'], 'amount' => $query_row['amount'], 'date'=> $query_row['date'], 'status'=> $query_row['status'], 'EAOwnerName'=>$query_row['EAOwnerName'],'EAOwnerId' => $query_row['EAOwnerId'], 'EAOwnerTypeId'=>$query_row['EAOwnerIdType'],'description'=> $query_row['description'], 'bankName'=>$query_row['bankName']);
                    print(json_encode(array('message' => 'Datos encontrados', 'data'=> $info)));
                } catch (\Throwable $th) {
                    //throw $th;
                    $ConDB->rollback();
                    http_response_code(409);
                } finally{
                    $ConDB->close();
                }
            }else{
                http_response_code(404);
                print(json_encode("404 ERROR"));
            } 
        } catch (\Throwable $th) {
            http_response_code(404);
        }
    }

}
