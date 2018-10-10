<?php

namespace App\Module\Contractor\Response;

use App\Response\Response;
use App\Container\Contractor;
use App\Container\Contractors;

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