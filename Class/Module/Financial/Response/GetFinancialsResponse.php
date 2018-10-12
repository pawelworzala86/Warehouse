<?php

namespace App\Module\Financial\Response;

use App\Container\Financial;
use App\Container\Financials;
use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;

class GetFinancialsResponse extends Response
{
    public $fieldClass = Financial::class;

    use PaginationResponseTrait;
    use FiltersTrait;

    public $financials;

    function setFinancials(Financials $financials): GetFinancialsResponse
    {
        $this->financials = $financials;
        return $this;
    }

    function getFinancials(): Financials
    {
        return $this->financials;
    }
}