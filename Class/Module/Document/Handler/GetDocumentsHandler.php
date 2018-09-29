<?php

namespace App\Module\Document\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
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

class GetDocumentsHandler extends Handler
{
    public function __invoke(PaginationRequest $request): GetDocumentsResponse
    {
        $documents = (new DocumentCollection)
            ->setPagination($request->getPagination())
            ->setFilters($request->getFilters())
            ->where(new Filter([
                'name' => 'added_by',
                'kind' => new FilterKind('='),
                'value' => User::getId(),
            ]))
            ->where(new Filter([
                'name' => 'deleted',
                'kind' => new FilterKind('='),
                'value' => 0,
            ]))
            ->load();

        $docs = new Documents;
        $docs->rewind();
        $documents->rewind();
        while($document = $documents->current()){
            $docs->add(
                (new Document)
                    ->setId($document->getUuid())
                    ->setName($document->getName())
                    ->setDate($document->getDate())
            );
            $documents->next();
        }

        return (new GetDocumentsResponse)
            ->setDocuments($docs)
            ->setPagination($documents->getPagination())
            ->setFilters($documents->getFilters())
            ->setFiltersNames($documents->getFiltersNames());
    }
}