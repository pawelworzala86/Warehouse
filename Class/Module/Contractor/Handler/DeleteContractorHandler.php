<?php

namespace App\Module\Contractor\Handler;

use App\Handler;
use App\Module\Contractor\Request\DeleteContractorRequest;
use App\Module\Contractor\Model\ContractorModel;
use App\Response\SuccessResponse;

class DeleteContractorHandler extends Handler
{
    public function __invoke(DeleteContractorRequest $request): SuccessResponse
    {
        (new ContractorModel)
            ->setUuid($request->getId())
            ->delete();

        return (new SuccessResponse);
    }
}