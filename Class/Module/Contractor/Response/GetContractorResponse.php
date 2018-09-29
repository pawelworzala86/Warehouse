<?php

namespace App\Module\Contractor\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Traits\PaginationResponseTrait;
use App\Type\Contractor;
use App\Type\Contractors;
use App\Type\UUID;

class GetContractorResponse extends Response
{
    private $name;
    private $id;

    function setId(UUID $id): GetContractorResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }

    function setName(string $name): GetContractorResponse
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }
}