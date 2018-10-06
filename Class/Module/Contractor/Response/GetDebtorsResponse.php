<?php

namespace App\Module\Contractor\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Traits\PaginationResponseTrait;
use App\Type\Contractor;
use App\Type\Contractors;
use App\Type\Debtor;
use App\Type\Debtors;

class GetDebtorsResponse extends Response
{
    public $fieldClass = Debtor::class;

    use PaginationResponseTrait;
    use FiltersTrait;

    public $debtors;

    function setDebtors(Debtors $debtors): GetDebtorsResponse
    {
        $this->debtors = $debtors;
        return $this;
    }

    function getDebtors(): Debtors
    {
        return $this->debtors;
    }
}