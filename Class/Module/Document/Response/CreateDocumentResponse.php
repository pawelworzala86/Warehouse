<?php

namespace App\Module\Document\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Traits\PaginationResponseTrait;
use App\Type\Document;
use App\Type\Documents;
use App\Type\UUID;

class CreateDocumentResponse extends Response
{
    private $id;

    function setId(UUID $id): CreateDocumentResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}