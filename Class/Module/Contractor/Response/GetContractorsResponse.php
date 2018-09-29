<?php

namespace App\Module\Contractor\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Traits\PaginationResponseTrait;
use App\Type\Contractor;
use App\Type\Contractors;

class GetContractorsResponse extends Response
{
    public $fieldClass = Contractor::class;

    use PaginationResponseTrait;
    use FiltersTrait;

    public $contractors;

    function setContractors(Contractors $contractors): GetContractorsResponse
    {
        $this->contractors = $contractors;
        return $this;
    }

    function getContractors(): Contractors
    {
        return $this->contractors;
    }
}