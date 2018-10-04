<?php

namespace App\Type;

use App\Common;
use App\DB;
use App\IP;
use App\Type;
use App\User;

class OrderResponse extends Type
{
    private $id;
    private $number;

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): OrderResponse
    {
        $this->number = $number;
        return $this;
    }

    function setId(UUID $id): OrderResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}