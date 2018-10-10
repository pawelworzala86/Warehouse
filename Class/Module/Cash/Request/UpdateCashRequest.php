<?php

namespace App\Module\Cash\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class UpdateCashRequest extends UserRequest
{
    private $number;
    private $kind;
    private $amount;
    private $id;

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function setKind(string $kind)
    {
        $this->kind = $kind;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number)
    {
        $this->number = $number;
        return $this;
    }
}