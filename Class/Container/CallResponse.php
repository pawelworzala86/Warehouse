<?php

namespace App\Container;

use App\Container;
use App\Type\UUID;

class CallResponse extends Container
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