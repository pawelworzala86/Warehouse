<?php

namespace App\Module\Document\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Document\Model\DocumentModel;
use App\Module\Document\Response\GetDocumentsResponse;
use App\Module\Document\Collection\DocumentCollection;
use App\Request\EmptyRequest;
use App\Request\PaginationRequest;
use App\Response\SuccessResponse;
use App\Type\Document;
use App\Type\Documents;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class CreateDocumentHandler extends Handler
{
    public function __invoke(PaginationRequest $request): SuccessResponse
    {
        $document = (new DocumentModel)
            ->insert();

        return (new SuccessResponse);
    }
}