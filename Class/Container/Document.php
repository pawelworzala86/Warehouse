<?php

namespace App\Container;

use App\Container;
use App\Type\UUID;

class Document extends Container
{
    private $name;
    private $id;
    private $date;
    private $contractorName;
    private $gross;
    private $contractorId;
    private $amount;
    private $deleted;

    public function getDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted = false): Document
    {
        $this->deleted = $deleted;
        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount = null): Document
    {
        $this->amount = $amount;
        return $this;
    }

    public function getContractorId(): ?UUID
    {
        return $this->contractorId;
    }

    public function setContractorId(UUID $contractorId = null): Document
    {
        $this->contractorId = $contractorId;
        return $this;
    }

    public function getGross(): ?float
    {
        return $this->gross;
    }

    public function setGross(float $gross = null): Document
    {
        $this->gross = $gross;
        return $this;
    }

    public function getContractorName(): ?string
    {
        return $this->contractorName;
    }

    public function setContractorName(string $contractorName = null): Document
    {
        $this->contractorName = $contractorName;
        return $this;
    }

    function setDate(string $date = null): Document
    {
        $this->date = $date;
        return $this;
    }

    function getDate(): ?string
    {
        return $this->date;
    }

    function setId(UUID $id): Document
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }

    function setName(string $name): Document
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }
}