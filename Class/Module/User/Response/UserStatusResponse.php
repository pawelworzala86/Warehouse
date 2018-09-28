<?php

namespace App\Module\User\Response;

use App\Response\Response;

class UserStatusResponse extends Response
{

    private $logged;

    function setLogged(bool $logged): UserStatusResponse
    {
        $this->logged = $logged;
        return $this;
    }

    function getLogged()
    {
        return $this->logged;
    }

}