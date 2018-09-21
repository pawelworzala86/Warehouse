<?php

namespace App\Modules\Contractor\Response;

use App\Response;
use App\Types\DebtsContractors;

class GetDebtsResponse extends Response
{
    public $contractors;

    public function getContractors(): DebtsContractors
    {
        return $this->contractors;
    }

    public function setContractors(DebtsContractors $contractors)
    {
        $this->contractors = $contractors;
        return $this;
    }

}