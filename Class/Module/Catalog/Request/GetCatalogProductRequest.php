<?php

namespace App\Module\Catalog\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class GetCatalogProductRequest extends UserRequest
{

    public $id;

    public function getId(): ?UUID
    {
        return $this->id;
    }

    public function setId(UUID $id = null)
    {
        $this->id = $id;
        return $this;
    }
}