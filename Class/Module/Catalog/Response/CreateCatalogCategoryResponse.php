<?php

namespace App\Module\Catalog\Response;

use App\Response\Response;
use App\Type\UUID;

class CreateCatalogCategoryResponse extends Response
{
    public $id;

    function setId(UUID $id): CreateCatalogCategoryResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}