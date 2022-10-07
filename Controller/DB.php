<?php

class DB
{
    private string $host = "localhost";
    private string $database = "deswebii";
    private static DB $instance;
    private $connection;

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
    private function ResetDefaultConnection($Rol): void
    {
        $UserDB='defaultuser';
        $Pass='defaultuserpassword';
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

    public function changeConnectionRol($Rol):void{
        /*
         * Method to change the role of the database "reestablishes
         * the connection with the user of the one corresponding
         * to his role"
         * */
        $this->ResetDefaultConnection($Rol);
    }

    public function getConnection(){
        return $this->connection;
    }

    /**
     * @throws Exception
     */
    public static function getInstance():DB{
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
