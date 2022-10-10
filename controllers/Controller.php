<?php

namespace Controllers;

use Database\Database;

class Controller
{
    /**
     * @throws \Exception
     */
    public static function instanceDatabase(): Database
    {
        return Database::getInstance();
    }
}