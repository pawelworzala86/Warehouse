<?php

namespace App\Container;

use App\Container;
use App\Type\UUID;

class DebtorDocument extends Container
{
    private $name;
    private $id;
    private $date;
    private $contractorName;
    private $gross;
    private $contractorId;
    private $toPay;
    private $payDate;
    private $payTerm;

    public function getPayTerm(): ?bool
    {
        return $this->payTerm;
    }

    public function setPayTerm(bool $payTerm = null): DebtorDocument
    {
        $this->payTerm = $payTerm;
        return $this;
    }

    public function getPayDate(): ?string
    {
        return $this->payDate;
    }

    public function setPayDate(string $payDate = null): DebtorDocument
    {
        $this->payDate = $payDate;
        return $this;
    }

    public function getToPay(): ?float
    {
        return $this->toPay;
    }

    public function setToPay(float $toPay = null): DebtorDocument
    {
        $this->toPay = $toPay;
        return $this;
    }

    public function getContractorId(): ?UUID
    {
        return $this->contractorId;
    }

    public function setContractorId(UUID $contractorId = null): DebtorDocument
    {
        $this->contractorId = $contractorId;
        return $this;
    }

    public function getGross(): ?float
    {
        return $this->gross;
    }

    public function setGross(float $gross = null): DebtorDocument
    {
        $this->gross = $gross;
        return $this;
    }

    public function getContractorName(): ?string
    {
        return $this->contractorName;
    }

    public function setContractorName(string $contractorName = null): DebtorDocument
    {
        $this->contractorName = $contractorName;
        return $this;
    }

    function setDate(string $date = null): DebtorDocument
    {
        $this->date = $date;
        return $this;
    }

    function getDate(): ?string
    {
        return $this->date;
    }

    function setId(UUID $id): DebtorDocument
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }

    function setName(string $name = null): DebtorDocument
    {
        $this->name = $name;
        return $this;
    }

    function getName(): ?string
    {
        return $this->name;
    }
}