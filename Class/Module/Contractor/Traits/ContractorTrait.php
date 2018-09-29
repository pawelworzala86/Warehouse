<?php

namespace App\Module\Contractor\Traits;

use App\Type\Address;
use App\Type\UUID;

trait ContractorTrait
{
    private $name;
    private $id;
    private $address;

    function setAddress(Address $address = null)
    {
        $this->address = $address;
        return $this;
    }

    function getAddress(): ?Address
    {
        return $this->address;
    }

    function setId(UUID $id = null)
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }

    function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }
}