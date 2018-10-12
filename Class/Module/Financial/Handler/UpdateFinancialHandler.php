<?php

namespace App\Module\Financial\Handler;

use App\Common;
use App\Handler;
use App\Module\Document\Model\DocumentFinancialModel;
use App\Module\Document\Model\DocumentModel;
use App\Module\Financial\Model\FinancialModel;
use App\Module\Financial\Request\UpdateFinancialRequest;
use App\Response\SuccessResponse;
use App\User;

class UpdateFinancialHandler extends Handler
{
    public function __invoke(UpdateFinancialRequest $request): SuccessResponse
    {
        $documents = $request->getDocuments();
        while($document = $documents->current()){
            $ff = (new FinancialModel)
                ->load($request->getId(), true);
            $doc = (new DocumentModel)
                ->load($document->getId(), true);
            $fin = (new DocumentFinancialModel)
                ->where('added_by', '=', User::getId())
                ->where('deleted', '=', 0)
                ->where('document_id', '=', $doc->getId())
                ->where('financial_id', '=', $ff->getId())
                ->load();
            if($document->getDeleted()){
                $fin->setUuid($fin->getUuid())
                    ->delete();
            }else {
                $f = (new FinancialModel)
                    ->load($request->getId(), true);
                if (!$fin->getId()) {
                    (new DocumentFinancialModel)
                        ->setUuid(Common::getUuid())
                        ->setDocumentId($doc->getId())
                        ->setFinancialId($f->getId())
                        ->setAmount($document->getAmount())
                        ->insert();
                } else {
                    $fin->setUuid($fin->getUuid())
                        ->setAmount($document->getAmount())
                        ->update();
                }
            }
            $documents->next();
        }

        (new FinancialModel)
            ->setUuid($request->getId())
            ->setDate($request->getDate())
            ->setAmount($request->getAmount())
            ->update();

        return new SuccessResponse;
    }
}