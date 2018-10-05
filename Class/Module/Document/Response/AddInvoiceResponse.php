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

class AddInvoiceResponse extends Response
{
    private $id;
    private $number;

    function setNumber(string $number): AddInvoiceResponse
    {
        $this->number = $number;
        return $this;
    }

    function getNumber(): string
    {
        return $this->number;
    }

    function setId(UUID $id): AddInvoiceResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}