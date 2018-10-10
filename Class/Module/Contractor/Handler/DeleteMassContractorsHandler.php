<?php

namespace App\Module\Contractor\Handler;

use App\Handler;
use App\Module\Contractor\Model\ContractorModel;
use App\Request\UuidCollectionRequest;
use App\Response\SuccessResponse;
use App\Type\UUID;

class DeleteMassContractorsHandler extends Handler
{
    public function __invoke(UuidCollectionRequest $request): SuccessResponse
    {
        $ids = $request->getIds();
        $ids->rewind();
        while($uuid = $ids->current()){
            $productModel = new ContractorModel;
            $productModel->setUuid(new UUID($uuid));
            $productModel->delete();
            $ids->next();
        }
        return new SuccessResponse;
    }
}