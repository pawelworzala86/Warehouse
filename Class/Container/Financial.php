<?php

namespace App\Container;

use App\Container;
use App\Type\UUID;

class Financial extends Container
{
    private $date;
    private $amount;
    private $id;

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): Financial
    {
        $this->id = $id;
        return $this;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): Financial
    {
        $this->amount = $amount;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): Financial
    {
        $this->date = $date;
        return $this;
    }
}