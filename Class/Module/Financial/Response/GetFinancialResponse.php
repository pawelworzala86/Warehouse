<?php

namespace App\Module\Financial\Response;

use App\Container\Financial;
use App\Container\Financials;
use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Type\UUID;

class GetFinancialResponse extends Response
{
    private $date;
    private $amount;
    private $id;

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): GetFinancialResponse
    {
        $this->id = $id;
        return $this;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): GetFinancialResponse
    {
        $this->amount = $amount;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): GetFinancialResponse
    {
        $this->date = $date;
        return $this;
    }
}