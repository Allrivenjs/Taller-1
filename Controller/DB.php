<?php

class DB
{
    private $host = "localhost";
    private $database = "deswebii";
    private $user = 'userdefault';
    private $pass = 'passwordfordefaultuser';

    private static $instance;
    public $connection;


    /**
     * @throws PDOException
     */
    private function ResetDefaultConnection(){
        $this->connection = mysqli_connect($this->host,$this->user, $this->pass, $this->database);
    }

    public function getConnection(){
        return $this->connection;
    }

    /**
     * @throws Exception
     */
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self;
        }

        if(!isset(self::$instance->connection)){
            try{
                self::$instance->ResetDefaultConnection();
            }catch(PDOException $exception){
                throw new Exception('Error de conexion a la base de datos');
                /*
                http_response_code(500);
                exit();
                */
            }
        }

        return self::$instance;
    }


}
