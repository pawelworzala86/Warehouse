<?php

namespace App\Module\Catalog\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class DeleteCatalogProductRequest extends UserRequest
{
    public $id;

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