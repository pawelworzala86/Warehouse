<?php

namespace App\Module\Catalog\Response;

use App\Response\Response;
use App\Type\UUID;

class CreateCatalogProductResponse extends Response
{
    public $id;

    function setId(UUID $id): CreateCatalogProductResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}