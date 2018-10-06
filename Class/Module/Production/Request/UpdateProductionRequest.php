<?php

namespace App\Module\Production\Request;

use App\Request\UserRequest;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;
use App\Type\DocumentProducts;
use App\Type\UUID;

class UpdateProductionRequest extends UserRequest
{
    private $id;
    private $name;

    function setName(string $name = null): UpdateProductionRequest
    {
        $this->name = $name;
        return $this;
    }

    function getName(): ?string
    {
        return $this->name;
    }


    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): UpdateProductionRequest
    {
        $this->id = $id;
        return $this;
    }
}