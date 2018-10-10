<?php

namespace App\Module\Document\Response;

use App\Response\Response;
use App\Type\UUID;

class CreateDocumentResponse extends Response
{
    private $id;

    function setId(UUID $id): CreateDocumentResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}