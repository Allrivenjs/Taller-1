<?php

namespace Traits\Middleware;

use Database\Database;
use Exception;

class AuthMiddlewareTrait
{
    /**
     * @throws Exception
     */
    public static function handle(): null|bool
    {
        echo 'You are not logged in';
        return false;
    }
}