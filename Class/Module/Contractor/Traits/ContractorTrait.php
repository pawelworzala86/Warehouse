<?php

namespace App\Module\Contractor\Traits;

use App\Type\Address;
use App\Type\Contact;
use App\Type\UUID;

trait ContractorTrait
{
    private $name;
    private $id;
    private $address;
    private $code;
    private $contact;
    private $contractorId;

    function setContractorId(int $contractorId = null)
    {
        $this->contractorId = $contractorId;
        return $this;
    }

    function getContractorId(): ?int
    {
        return $this->contractorId;
    }

    function setContact(Contact $contact = null)
    {
        $this->contact = $contact;
        return $this;
    }

    function getContact(): ?Contact
    {
        return $this->contact;
    }

    function setCode(string $code = null)
    {
        $this->code = $code;
        return $this;
    }

    function getCode(): ?string
    {
        return $this->code;
    }

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