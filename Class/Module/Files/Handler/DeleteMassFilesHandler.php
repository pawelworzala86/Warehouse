<?php

namespace App\Module\Files\Handler;

use App\Handler;
use App\Module\Files\Model\FileModel;
use App\Module\Files\Request\DeleteFileRequest;
use App\Request\UuidCollectionRequest;
use App\Response\SuccessResponse;
use App\Type\UUID;

class DeleteMassFilesHandler extends Handler
{
    public function __invoke(UuidCollectionRequest $request): SuccessResponse
    {
        $ids = $request->getIds();
        $ids->rewind();
        while($uuid = $ids->current()){
            $productModel = new FileModel;
            $productModel->setUuid(new UUID($uuid));
            $productModel->delete();
            $ids->next();
        }
        return new SuccessResponse;
    }
}