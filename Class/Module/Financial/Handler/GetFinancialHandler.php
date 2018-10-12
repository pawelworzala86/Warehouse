<?php

namespace App\Module\Financial\Handler;

use App\Container\Document;
use App\Container\Documents;
use App\Handler;
use App\Module\Document\Collection\DocumentFinancialCollection;
use App\Module\Document\Model\DocumentModel;
use App\Module\Financial\Model\FinancialModel;
use App\Module\Financial\Request\GetFinancialRequest;
use App\Module\Financial\Response\GetFinancialResponse;
use App\User;

class GetFinancialHandler extends Handler
{
    public function __invoke(GetFinancialRequest $request): GetFinancialResponse
    {
        $financial = (new FinancialModel)
            ->load($request->getId(), true);

        $documents = new Documents;

        $financials = (new DocumentFinancialCollection)
            ->where('added_by', '=', User::getId())
            ->where('deleted', '=', 0)
            ->where('financial_id', '=', $financial->getId())
            ->load();

        while($fin = $financials->current()){
            $doc = (new DocumentModel)
                ->load($fin->getDocumentId());
            $documents->add(
                (new Document)
                ->setId($doc->getUuid())
                ->setName($doc->getName())
                ->setAmount($fin->getAmount())
            );
            $financials->next();
        }

        return (new GetFinancialResponse)
            ->setId($financial->getUuid())
            ->setDate($financial->getDate())
            ->setAmount($financial->getAmount())
            ->setDocuments($documents);
    }
}