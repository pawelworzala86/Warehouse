<?php

namespace App\Modules\Contractor\Handler;

use App\Handler;
use App\Modules\Contractor\Controller\ContractorsController;
use App\Modules\Contractor\Request\GetContractorsRequest;
use App\Modules\Contractor\Response\GetContractorsResponse;

class GetContractors extends Handler{

    public function __invoke(ContractorsController $contractors, GetContractorsRequest $request): GetContractorsResponse
    {
        return $contractors->getContractors($request);
    }
}
