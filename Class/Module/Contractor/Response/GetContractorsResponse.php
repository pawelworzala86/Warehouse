<?php

namespace App\Module\Contractor\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Container\Contractor;
use App\Container\Contractors;

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