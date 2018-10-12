<?php

namespace App\Module\Financial\Request;

use App\Request\UserRequest;
use App\Container\DocumentProducts;
use App\Type\UUID;

class UpdateFinancialRequest extends UserRequest
{
    private $date;
    private $amount;
    private $id;

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): UpdateFinancialRequest
    {
        $this->id = $id;
        return $this;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): UpdateFinancialRequest
    {
        $this->amount = $amount;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): UpdateFinancialRequest
    {
        $this->date = $date;
        return $this;
    }
}