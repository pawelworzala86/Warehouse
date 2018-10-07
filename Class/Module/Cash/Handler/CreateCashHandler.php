<?php

namespace App\Module\Cash\Handler;

use App\Common;
use App\Handler;
use App\Module\Cash\Model\CashDocumentModel;
use App\Module\Cash\Response\CreateCashResponse;
use App\Module\Cash\Request\CreateCashRequest;
use App\Module\Document\Model\DocumentNumberModel;

class CreateCashHandler extends Handler
{
    public function __invoke(CreateCashRequest $request): CreateCashResponse
    {
        ////
        $documentNumberId = $request->getDocumentNumberId();
        $type = $request->getKind();
        $numberModel = (new DocumentNumberModel)
            ->load($documentNumberId, true);
        if(!$numberModel->getId()){
            $id = (new DocumentNumberModel)
                ->setUuid(Common::getUuid())
                ->setNumber(0)
                ->setMonth(10)
                ->setYear(2018)
                ->setType($type)
                ->insert();
            $numberModel = (new DocumentNumberModel)
                ->load($id);
        }
        $number = $numberModel->getNumber()+1;
        $year = $numberModel->getYear();
        $month = $numberModel->getMonth();
        $typesNames = [
            'kp'=>'KP',
            'kw'=>'KW',
        ];
        $name = $typesNames[$type].'/'.$number.'/'.$year;
        (new DocumentNumberModel)
            ->setUuid($numberModel->getUuid())
            ->setNumber($number)
            ->update();
        ////////////

        $uuid = Common::getUuid();
        (new CashDocumentModel)
            ->setUuid($uuid)
            ->setNumber($name)
            ->setKind($request->getKind())
            ->setAmount($request->getAmount())
            ->setDate(date("Y-m-d", time()))
            ->insert();

        return (new CreateCashResponse)
            ->setId($uuid);
    }
}