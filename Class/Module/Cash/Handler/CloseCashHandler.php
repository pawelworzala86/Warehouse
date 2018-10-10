<?php

namespace App\Module\Cash\Handler;

use App\Common;
use App\Handler;
use App\Module\Cash\Collection\CashDocumentViewCollection;
use App\Module\Cash\Model\CashDocumentModel;
use App\Module\Document\Model\DocumentNumberModel;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\Container\Filter;
use App\Type\FilterKind;
use App\User;

class CloseCashHandler extends Handler
{
    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        ////
        //$documentNumberId = $request->getDocumentNumberId();
        $type = 'kz';
        $numberModel = (new DocumentNumberModel)
            ->where(
                (new Filter)
                    ->setName('added_by')
                    ->setKind(new FilterKind('='))
                    ->setValue(User::getId())
            )->where(
                (new Filter)
                    ->setName('deleted')
                    ->setKind(new FilterKind('='))
                    ->setValue(0)
            )->where(
                (new Filter)
                    ->setName('type')
                    ->setKind(new FilterKind('='))
                    ->setValue($type)
            )->load();
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
        $number = $numberModel->getNumber() + 1;
        $year = $numberModel->getYear();
        $month = $numberModel->getMonth();
        $typesNames = [
            'kp' => 'KP',
            'kw' => 'KW',
            'kz' => 'KZ',
        ];
        $name = $typesNames[$type] . '/' . $number . '/' . $year;
        (new DocumentNumberModel)
            ->setUuid($numberModel->getUuid())
            ->setNumber($number)
            ->update();
        ////////////


        $cash = (new CashDocumentViewCollection)
            ->where(
                (new Filter)
                    ->setName('added_by')
                    ->setKind(new FilterKind('='))
                    ->setValue(User::getId())
            )->where(
                (new Filter)
                    ->setName('kind')
                    ->setKind(new FilterKind('='))
                    ->setValue('kz')
            )->order('added desc')
            ->load();
        $cash->rewind();
        $c = $cash->current();
        $lastCloseTime = $c?$c->getAdded():0;
        $cash = (new CashDocumentViewCollection)
            ->where(
                (new Filter)
                    ->setName('added_by')
                    ->setKind(new FilterKind('='))
                    ->setValue(User::getId())
            )->where(
                (new Filter)
                    ->setName('added')
                    ->setKind(new FilterKind('>'))
                    ->setValue($lastCloseTime)
            )->load();
        $cash->rewind();
        $amount = null;
        while ($c = $cash->current()) {
            if ($c->getKind() == 'kp') {
                $amount += $c->getAmount();
            } else if ($c->getKind() == 'kw') {
                $amount -= $c->getAmount();
            }
            $cash->next();
        }

        if($amount) {
            $uuid = Common::getUuid();
            (new CashDocumentModel)
                ->setUuid($uuid)
                ->setNumber($name)
                ->setKind($type)
                ->setAmount($amount)
                ->setDate(date("Y-m-d", time()))
                ->insert();
        }

        return new SuccessResponse;
    }
}