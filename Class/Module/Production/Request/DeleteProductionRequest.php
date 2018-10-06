<?php

namespace App\Module\Production\Request;

use App\Request\UserRequest;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;
use App\Type\DocumentProducts;
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