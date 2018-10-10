<?php

namespace App\Module\Document\Handler;

use App\Common;
use App\Handler;
use App\Module\Document\Model\DocumentNumberModel;
use App\Module\Document\Request\GetDocumentNumberRequest;
use App\Module\Document\Response\GetDocumentNumberResponse;
use App\Container\Filter;
use App\Type\FilterKind;

class GetDocumentNumberHandler extends Handler
{
    public function __invoke(GetDocumentNumberRequest $request): GetDocumentNumberResponse
    {
        $type = $request->getType();

        $numberModel = (new DocumentNumberModel)
            ->where(
                (new Filter)
                ->setName('type')
                ->setKind(new FilterKind('='))
                ->setValue($type)
            )
            ->where(
                (new Filter)
                ->setName('deleted')
                ->setKind(new FilterKind('='))
                ->setValue(0)
            )
            ->load();

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
            $numberModel->setUuid($numberModel->getUuid());
        }

        $number = $numberModel->getNumber()+1;
        $numberModel->setNumber($number);

        $year = $numberModel->getYear();
        $month = $numberModel->getMonth();

        $typesNames = [
            'fvp'=>'FV-Z',
            'pz'=>'PZ',
            'pw'=>'PW',

            'fvs'=>'FV',
            'wz'=>'WZ',
            'rw'=>'RW',

            'ord'=>'Z',

            'kp'=>'KP',
            'kw'=>'KW',
        ];

        $name = $typesNames[$type].'/'.$number.'/'.$year;

        return (new GetDocumentNumberResponse)
            ->setName($name)
            ->setDocumentNumberId($numberModel->getUuid());
    }
}