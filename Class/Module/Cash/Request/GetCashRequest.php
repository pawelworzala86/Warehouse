<?php

namespace App\Module\Cash\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class GetCashRequest extends UserRequest
{
    private $id;

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id)
    {
        $this->id = $id;
        return $this;
    }
}