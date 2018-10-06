<?php

namespace App\Type;

use App\Type;

class Debtor extends Type
{
    private $name;
    private $id;
    private $address;
    private $code;
    private $debt;
    private $documents;

    function setDocuments(DebtorDocuments $documents = null): Debtor
    {
        $this->documents = $documents;
        return $this;
    }

    function getDocuments(): ?DebtorDocuments
    {
        return $this->documents;
    }

    function setDebt(float $debt = null): Debtor
    {
        $this->debt = $debt;
        return $this;
    }

    function getDebt(): ?float
    {
        return $this->debt;
    }

    function setCode(string $code = null): Debtor
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

    public function setAddress(Address $address = null): Debtor
    {
        $this->address = $address;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name = null): Debtor
    {
        $this->name = $name;
        return $this;
    }

    function setId(UUID $id = null): Debtor
    {
        $this->id = $id;
        return $this;
    }

    function getId(): ?UUID
    {
        return $this->id;
    }
}