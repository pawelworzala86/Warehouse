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

class GetSearchContractorsResponse extends Response
{
    public $fieldClass = Contractor::class;

    public $contractors;

    function setContractors(Contractors $contractors): GetSearchContractorsResponse
    {
        $this->contractors = $contractors;
        return $this;
    }

    function getContractors(): Contractors
    {
        return $this->contractors;
    }
}