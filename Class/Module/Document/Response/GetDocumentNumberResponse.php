<?php

namespace App\Module\Document\Response;

use App\Response\Response;
use App\Type\UUID;

class GetDocumentNumberResponse extends Response
{
    private $name;
    private $documentNumberId;

    function setDocumentNumberId(UUID $documentNumberId): GetDocumentNumberResponse
    {
        $this->documentNumberId = $documentNumberId;
        return $this;
    }

    function getDocumentNumberId(): UUID
    {
        return $this->documentNumberId;
    }

    function setName(string $name): GetDocumentNumberResponse
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }
}