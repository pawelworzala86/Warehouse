<?php

namespace App\Types;

use App\TypeCollection;

class DebtsContractors extends TypeCollection
{
    private $contractors;

    public function getContractors()
    {
        return $this->contractors;
    }

    public function setContractors($contractors)
    {
        $this->contractors = $contractors;
        return $this;
    }

}