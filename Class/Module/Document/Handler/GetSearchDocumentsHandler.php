<?php

namespace App\Module\Document\Handler;

use App\Container\Document;
use App\Container\Documents;
use App\Handler;
use App\Container\Filter;
use App\Module\Document\Response\GetSearchDocumentsResponse;
use App\Module\Document\Collection\DocumentCollection;
use App\Module\Document\Request\GetSearchDocumentsRequest;
use App\Type\FilterKind;
use App\Container\Pagination;
use App\User;

class GetSearchDocumentsHandler extends Handler
{
    public function __invoke(GetSearchDocumentsRequest $request): GetSearchDocumentsResponse
    {
        $pagination = new Pagination;
        $pagination->setLimit(5);
        $pagination->setPage(1);

        $documentsCollection = (new DocumentCollection)
            ->setPagination($pagination)
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
            ->where(new Filter([
                'name' => 'name',
                'kind' => new FilterKind('%'),
                'value' => $request->getSearch(),
            ]))
            ->where('type', '=', 'fvs');
        $documentsCollection->load();

        $docs = new Documents;
        $docs->rewind();
        while($document = $documentsCollection->current()){
            $docs->add(
                (new Document)
                ->setName($document->getName())
                ->setId($document->getUuid())
            );
            $documentsCollection->next();
        }

        return (new GetSearchDocumentsResponse)
            ->setDocuments($docs);
    }
}