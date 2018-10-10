<?php

namespace App\Module\Document\Handler;

use App\Handler;
use App\Module\Document\Model\DocumentModel;
use App\Request\UuidCollectionRequest;
use App\Response\SuccessResponse;
use App\Type\UUID;

class DeleteMassDocumentHandler extends Handler
{
    public function __invoke(UuidCollectionRequest $request): SuccessResponse
    {
        $ids = $request->getIds();
        $ids->rewind();
        while($uuid = $ids->current()){
            $productModel = new DocumentModel;
            $productModel->setUuid(new UUID($uuid));
            $productModel->delete();
            $ids->next();
        }
        return new SuccessResponse;
    }
}