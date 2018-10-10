<?php

namespace App\Module\Cash\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Container\Cash;
use App\Container\Cashs;

class GetCashsResponse extends Response
{
    public $fieldClass = Cash::class;

    use PaginationResponseTrait;
    use FiltersTrait;

    private $cashs;
    private $sum;

    public function getSum(): float
    {
        return $this->sum;
    }

    public function setSum(float $sum)
    {
        $this->sum = $sum;
        return $this;
    }

    public function getCashs(): Cashs
    {
        return $this->cashs;
    }

    public function setCashs(Cashs $cashs)
    {
        $this->cashs = $cashs;
        return $this;
    }
}