<?php

class DB
{
    private string $host = "localhost";
    private string $database = "deswebii";
    private static DB $instance;
    private mysqli $connection; //u can't use mixed is crazy, don't try again... this it is a formal definition

    /**
     * @throws Exception
     */
    private function __construct(){
        if(!isset($this->connection)){
            try{
                $this->ResetDefaultConnection();
            }catch(PDOException){
                throw new Exception('Error de conexion a la base de datos');
            }
        }
    }

    /**
     * @throws PDOException
     */
    private function ResetDefaultConnection($Rol = null): void
    {
        $UserDB='root';
        $Pass='';
        if (isset($Rol)){
            /*
             * check if the variable exists, otherwise access is given with the default user.
             * */
            switch ($Rol) {
                case 1:$UserDB='client';$Pass='clientpassword';break;
                case 2:$UserDB='admin';$Pass='adminpassword';break;
            }
        }
        $this->connection = mysqli_connect($this->host,$UserDB, $Pass, $this->database);
    }

    /**
     * @param $Rol
     * @return void
     */
    public function changeConnectionRol($Rol):void{
        /*
         * Method to change the role of the database "reestablishes
         * the connection with the user of the one corresponding
         * to his role"
         * */
        $this->ResetDefaultConnection($Rol);
    }

    /**
     * @return mysqli
     */
    public function getConnection():mysqli{
        if(!isset($this->connection)){
            $this->ResetDefaultConnection();
        }
        return $this->connection;
    }

    /**
     * @throws Exception
     * @return DB
     */
    public static function getInstance():DB{
        if(!isset(self::$instance)){
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        /*
         * to prevent serialization.
         * your visibility must be public
         * */
        throw new Exception('No puedes serializar');
    }

    /**
     * @throws Exception
     */
    private function __clone()
    {
        //to prevent duplication
        throw new Exception('No puedes clonar esta clase');
    }


    /*
     * Made in Colombia by:
     * Carlos Daniel Castro Maussa
     * Juan Guillermo Florez Burgos
     * Daniela Salazar Gonzalez
     * Sebastian Quinchia Lobo
     * */
}
