<?php

namespace App\Controller;
use App\Database\Database;
use Exception;

class Controller
{
    /**
     * @throws Exception
     */
    public static function instanceDatabase(): Database
    {
        return Database::getInstance();
    }
}