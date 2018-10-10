<?php

namespace App\Module\Document\Response;

use App\Response\Response;

class GetDocumentDefaultResponse extends Response
{
    private $bankName;
    private $bankSwift;
    private $bankNumber;
    private $issuePlace;

    function setIssuePlace(string $issuePlace): GetDocumentDefaultResponse
    {
        $this->issuePlace = $issuePlace;
        return $this;
    }

    function getIssuePlace(): string
    {
        return $this->issuePlace;
    }

    function setBankNumber(string $bankNumber): GetDocumentDefaultResponse
    {
        $this->bankNumber = $bankNumber;
        return $this;
    }

    function getBankNumber(): string
    {
        return $this->bankNumber;
    }

    function setBankSwift(string $bankSwift): GetDocumentDefaultResponse
    {
        $this->bankSwift = $bankSwift;
        return $this;
    }

    function getBankSwift(): string
    {
        return $this->bankSwift;
    }

    function setBankName(string $bankName): GetDocumentDefaultResponse
    {
        $this->bankName = $bankName;
        return $this;
    }

    function getBankName(): string
    {
        return $this->bankName;
    }
}