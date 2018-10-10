<?php

namespace App\Module\Production\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class GetProductionRequest extends UserRequest
{
    private $id;

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): GetProductionRequest
    {
        $this->id = $id;
        return $this;
    }
}