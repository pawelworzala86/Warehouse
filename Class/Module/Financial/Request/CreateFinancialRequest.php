<?php

namespace App\Module\Financial\Request;

use App\Request\UserRequest;
use App\Container\DocumentProducts;
use App\Type\UUID;

class CreateFinancialRequest extends UserRequest
{
    private $date;
    private $amount;

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): CreateFinancialRequest
    {
        $this->amount = $amount;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): CreateFinancialRequest
    {
        $this->date = $date;
        return $this;
    }
}