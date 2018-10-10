<?php

namespace App\Module\Document\Handler;

use App\Handler;
use App\Module\Document\Request\DeleteDocumentRequest;
use App\Module\Document\Model\DocumentModel;
use App\Response\SuccessResponse;

class DeleteDocumentHandler extends Handler
{
    public function __invoke(DeleteDocumentRequest $request): SuccessResponse
    {
        (new DocumentModel)
            ->setUuid($request->getId())
            ->delete();

        return (new SuccessResponse);
    }
}