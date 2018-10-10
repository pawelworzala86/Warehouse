<?php

namespace App\Module\Contractor\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Container\Debtor;
use App\Container\Debtors;

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