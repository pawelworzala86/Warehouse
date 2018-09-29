<?php

namespace App\Module\Document\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Traits\PaginationResponseTrait;
use App\Type\Documents;

class GetDocumentsResponse extends Response
{
    public $fieldClass = CatalogProduct::class;

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