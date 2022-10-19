<?php

namespace App\Database;

use Exception;
use mysqli_sql_exception;

class Database
{
    private string $host = "localhost";
    private string $database = "deswebii";
    private static Database $instance;
    private mixed $connection;
    private string $user;
    private string $password;

    /**
     * @throws Exception
     */
    private function __construct(){
        if(!isset($this->connection)){
            try{
                $this->ResetDefaultConnection();
                $this->setAsGlobal();
            }catch(mysqli_sql_exception){
                throw new Exception('Error de conexion a la base de datos');
            }
        }
    }

    /**
     * @throws mysqli_sql_exception
     */
    private function ResetDefaultConnection(): void
    {
        $this->connection = mysqli_connect($this->host,$this->user, $this->password, $this->database);
    }

    /**
     * @return void
     */
    public function setAsGlobal(): void
    {
        static::$instance = $this;
    }


    /**
     * @param null $user
     * @param null $password
     * @return void
     */
    public function changeConnectionRol($user = null, $password = null):void
    {
        $this->changeUserAndPass($user, $password);
        /*
         * Method to change the role of the Database "reestablishes
         * the connection with the user of the one corresponding
         * to his role"
         * */
        $this->ResetDefaultConnection();
    }

    /**
     * @param $user
     * @param $password
     * @return void
     */
    private function changeUserAndPass($user, $password): void
    {
        $this->user = $user ?? $this->user;
        $this->password = $password ?? $this->password;
    }

    /**
     * @return mixed
     */
    public function getConnection(): mixed
    {
        return $this->connection;
    }

    /**
     * @throws Exception
     */
    public static function getInstance():Database
    {
        if(!isset(self::$instance)){
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __wakeup()
    {
        //to prevent serialization
    }

    private function __clone()
    {
        //to prevent duplication
    }

}