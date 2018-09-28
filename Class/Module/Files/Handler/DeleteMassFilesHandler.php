<?php

namespace App\Module\Files\Handler;

use App\Handler;
use App\Module\Files\Model\FileModel;
use App\Module\Files\Request\DeleteFileRequest;
use App\Request\UuidCollectionRequest;
use App\Response\SuccessResponse;

class DeleteMassFilesHandler extends Handler
{
    public function __invoke(UuidCollectionRequest $request): SuccessResponse
    {
        $ids = $request->getIds();
        while($uuid = $ids->current()){
            $fileModel = new FileModel;
            $fileModel->load($uuid, true);
            $fileModel->delete();
            $ids->next();
        }
        return new SuccessResponse;
    }
}