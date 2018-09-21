<?php

namespace App\Modules\Contractor\Response;

use App\Response;
use App\Types\Contractors;

class GetContractorsResponse extends Response
{
    public $contractors;

    public function getContractors(): Contractors
    {
        return $this->contractors;
    }

    public function setContractors(Contractors $contractors)
    {
        $this->contractors = $contractors;
        return $this;
    }

}