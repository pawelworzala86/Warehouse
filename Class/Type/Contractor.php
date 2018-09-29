<?php

namespace App\Type;

use App\Type;

class Contractor extends Type
{
    private $name;
    private $id;
    private $address;

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

    function setId(UUID $id): Contractor
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}