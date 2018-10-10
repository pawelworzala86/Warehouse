<?php

namespace App\Module\Production\Request;

use App\Request\UserRequest;

class CreateProductionRequest extends UserRequest
{
    private $name;

    function setName(string $name = null): CreateProductionRequest
    {
        $this->name = $name;
        return $this;
    }

    function getName(): ?string
    {
        return $this->name;
    }
}