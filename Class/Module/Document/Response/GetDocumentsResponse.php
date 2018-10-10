<?php

namespace App\Module\Document\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Container\Document;
use App\Container\Documents;

class GetDocumentsResponse extends Response
{
    public $fieldClass = Document::class;

    use PaginationResponseTrait;
    use FiltersTrait;

    public $documents;

    function setDocuments(Documents $documents): GetDocumentsResponse
    {
        $this->documents = $documents;
        return $this;
    }

    function getDocuments(): Documents
    {
        return $this->documents;
    }
}