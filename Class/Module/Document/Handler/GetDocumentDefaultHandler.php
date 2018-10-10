<?php

namespace App\Module\Document\Handler;

use App\Handler;
use App\Module\Document\Response\GetDocumentDefaultResponse;
use App\Module\User\Model\UserModel;
use App\Request\EmptyRequest;
use App\User;

class GetDocumentDefaultHandler extends Handler
{
    public function __invoke(EmptyRequest $request): GetDocumentDefaultResponse
    {
        $userModel = (new UserModel)
            ->load(User::getId());

        return (new GetDocumentDefaultResponse)
            ->setBankName($userModel->getBankName())
            ->setBankSwift($userModel->getBankSwift())
            ->setBankNumber($userModel->getBankNumber())
            ->setIssuePlace($userModel->getIssuePlace());
    }
}