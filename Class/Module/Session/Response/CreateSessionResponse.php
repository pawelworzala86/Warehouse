<?php

namespace App\Module\Session\Response;

use App\Response\Response;
use App\Type\SESSID;

class CreateSessionResponse extends Response
{

    private $id;

    function setId(SESSID $id): CreateSessionResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): SESSID
    {
        return $this->id;
    }

}