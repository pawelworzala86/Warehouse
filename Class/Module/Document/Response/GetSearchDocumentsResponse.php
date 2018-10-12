<?php

namespace App\Module\Document\Response;

use App\Container\Document;
use App\Container\Documents;
use App\Response\Response;

class GetSearchDocumentsResponse extends Response
{
    public $fieldClass = Document::class;

    public $documents;

    function setDocuments(Documents $documents): GetSearchDocumentsResponse
    {
        $this->documents = $documents;
        return $this;
    }

    function getDocuments(): Documents
    {
        return $this->documents;
    }
}