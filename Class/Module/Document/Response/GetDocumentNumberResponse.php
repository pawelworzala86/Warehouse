<?php

namespace App\Module\Document\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Traits\PaginationResponseTrait;
use App\Type\Contractor;
use App\Type\Document;
use App\Type\DocumentProducts;
use App\Type\Documents;
use App\Type\UUID;

class GetDocumentNumberResponse extends Response
{
    private $name;

    function setName(string $name): GetDocumentNumberResponse
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }
}