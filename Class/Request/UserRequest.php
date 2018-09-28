<?php

namespace App\Request;

use App\User;

class UserRequest extends Request
{
    public function __construct()
    {
        if(!User::getId()){
            throw new \Exception('User must be logged');
        }
    }
}