<?php

namespace App\Type;

use App\Type;

class ProfileInvoice extends Type
{
    private $bankName;
    private $bankSwift;
    private $bankNumber;
    private $issuePlace;

    function setIssuePlace(string $issuePlace = null): ProfileInvoice
    {
        $this->issuePlace = $issuePlace;
        return $this;
    }

    function getIssuePlace(): ?string
    {
        return $this->issuePlace;
    }

    function setBankNumber(string $bankNumber = null): ProfileInvoice
    {
        $this->bankNumber = $bankNumber;
        return $this;
    }

    function getBankNumber(): ?string
    {
        return $this->bankNumber;
    }

    function setBankSwift(string $bankSwift = null): ProfileInvoice
    {
        $this->bankSwift = $bankSwift;
        return $this;
    }

    function getBankSwift(): ?string
    {
        return $this->bankSwift;
    }

    function setBankName(string $bankName = null): ProfileInvoice
    {
        $this->bankName = $bankName;
        return $this;
    }

    function getBankName(): ?string
    {
        return $this->bankName;
    }
}