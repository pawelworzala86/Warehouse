<?php

namespace App\Type;

use App\Common;
use App\DB;
use App\IP;
use App\Type;
use App\User;

class Cash extends Type
{
    private $id;
    private $number;
    private $amount;
    private $kind;
    private $date;
    private $hour;
    private $documentNumber;
    private $documentId;

    function setDocumentId(UUID $documentId = null): Cash
    {
        $this->documentId = $documentId;
        return $this;
    }

    function getDocumentId(): ?UUID
    {
        return $this->documentId;
    }

    function setDocumentNumber(string $documentNumber = null): Cash
    {
        $this->documentNumber = $documentNumber;
        return $this;
    }

    function getDocumentNumber(): ?string
    {
        return $this->documentNumber;
    }

    function setHour(string $hour = null): Cash
    {
        $this->hour = $hour;
        return $this;
    }

    function getHour(): ?string
    {
        return $this->hour;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): Cash
    {
        $this->date = $date;
        return $this;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function setKind(string $kind): Cash
    {
        $this->kind = $kind;
        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): Cash
    {
        $this->amount = $amount;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): Cash
    {
        $this->number = $number;
        return $this;
    }

    function setId(UUID $id): Cash
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}