<?php

namespace App\Module\Cash\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Type\Cash;
use App\Type\Cashs;
use App\Type\UUID;

class GetCashResponse extends Response
{
    private $id;
    private $number;
    private $amount;
    private $kind;

    public function getKind(): string
    {
        return $this->kind;
    }

    public function setKind(string $kind): GetCashResponse
    {
        $this->kind = $kind;
        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): GetCashResponse
    {
        $this->amount = $amount;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): GetCashResponse
    {
        $this->number = $number;
        return $this;
    }

    function setId(UUID $id): GetCashResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}