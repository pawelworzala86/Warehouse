<?php

namespace App\Module\Production\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class DeleteProductionRequest extends UserRequest
{
    private $id;

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): DeleteProductionRequest
    {
        $this->id = $id;
        return $this;
    }
}