<?php

namespace App\Module\Financial\Model;

use App\Model;
use App\Type\UUID;

class FinancialModel extends Model
{
    private $date;
    private $amount;
    private $uuid;

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): FinancialModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): FinancialModel
    {
        $this->set('amount', $amount);
        $this->amount = $amount;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): FinancialModel
    {
        $this->set('date', $date);
        $this->date = $date;
        return $this;
    }
}