<?php

namespace App\Module\Document\Handler;

use App\Handler;
use App\Module\Document\Collection\DocumentViewCollection;
use App\Module\Document\Response\GetDocumentsResponse;
use App\Request\PaginationRequest;
use App\Container\Document;
use App\Container\Documents;
use App\Container\Filter;
use App\Type\FilterKind;
use App\User;

class GetDocumentsHandler extends Handler
{
    public function __invoke(PaginationRequest $request): GetDocumentsResponse
    {
        $documents = (new DocumentViewCollection)
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
                    ->setContractorName($document->getContractorName())
                    ->setGross($document->getGross())
                    ->setContractorId($document->getContractorId())
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