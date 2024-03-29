<?php

namespace App\Container;

use App\Container;
use App\Type\UUID;

class Contractor extends Container
{
    private $name;
    private $id;
    private $address;
    private $code;

    function setCode(string $code = null): Contractor
    {
        $this->code = $code;
        return $this;
    }

    function getCode(): ?string
    {
        return $this->code;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address = null): Contractor
    {
        $this->address = $address;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name = null): Contractor
    {
        $this->name = $name;
        return $this;
    }

    function setId(UUID $id = null): Contractor
    {
        $this->id = $id;
        return $this;
    }

    function getId(): ?UUID
    {
        return $this->id;
    }
}