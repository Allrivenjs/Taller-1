<?php

namespace Traits\Middleware;

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