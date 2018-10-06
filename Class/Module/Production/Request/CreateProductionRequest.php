<?php

namespace App\Module\Production\Request;

use App\Request\UserRequest;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;
use App\Type\DocumentProducts;
use App\Type\UUID;

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