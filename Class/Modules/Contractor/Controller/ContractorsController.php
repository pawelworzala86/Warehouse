<?php

namespace App\Modules\Contractor\Controller;

use App\Controller;
use App\Modules\Contractor\Model\ContractorsModel;
use App\Modules\Contractor\Request\GetContractorsRequest;
use App\Modules\Contractor\Response\GetContractorsResponse;
use App\Types\Contractor;
use App\Types\Contractors;

class ContractorsController extends Controller
{

    public function getContractors(GetContractorsRequest $request): GetContractorsResponse
    {
        $model = new ContractorsModel;
        $datas = $model->getContractors(1);

        $contractors = new Contractors;
        foreach ($datas as $data) {
            $contractors->add(
                (new Contractor)
                    ->setNip($data['nip'])
                    ->setMail($data['mail'])
                    ->setCode($data['code'])
                    ->setId($data['sys_unique_id'])
                    ->setName($data['name'])
            );
        }

        return (new GetContractorsResponse)
            ->setContractors($contractors);
    }
}
