<?php

namespace App\Module\Contractor\Request;

use App\Request\UserRequest;
use App\Type\SKU;

class CreateContractorRequest extends UserRequest
{
    public $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
}