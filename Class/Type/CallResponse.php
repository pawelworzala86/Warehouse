<?php

namespace App\Type;

use App\Common;
use App\DB;
use App\IP;
use App\Type;
use App\User;

class CallResponse extends Type
{
    private $id;
    private $pickup;

    public function getPickup(): ?string
    {
        return $this->pickup;
    }

    public function setPickup(string $pickup = null): CallResponse
    {
        $this->pickup = $pickup;
        return $this;
    }

    function setId(UUID $id): CallResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}