<?php

namespace App\Module\Files\Handler;

use App\Handler;
use App\Module\Files\Model\FileModel;
use App\Module\Files\Request\DeleteFileRequest;
use App\Response\SuccessResponse;

class DeleteFileHandler extends Handler
{
    public function __invoke(DeleteFileRequest $request): SuccessResponse
    {
        $fileModel = new FileModel;
        $fileModel
            ->load($request->getId(), true);
        $fileModel
            ->setUuid($fileModel->getUuid())
            ->delete();
        return new SuccessResponse;
    }
}