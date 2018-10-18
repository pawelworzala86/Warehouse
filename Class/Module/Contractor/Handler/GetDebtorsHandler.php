<?php

namespace App\Module\Contractor\Handler;

use App\Handler;
use App\Module\Contractor\Collection\DebtorViewCollection;
use App\Module\Contractor\Response\GetDebtorsResponse;
use App\Module\Document\Collection\DocumentCollection;
use App\Request\PaginationRequest;
use App\Container\Debtor;
use App\Container\DebtorDocument;
use App\Container\DebtorDocuments;
use App\Container\Debtors;
use App\Container\Filter;
use App\Type\FilterKind;
use App\User;

class GetDebtorsHandler extends Handler
{
    public function __invoke(PaginationRequest $request): GetDebtorsResponse
    {
        $contractors = (new DebtorViewCollection)
            ->setPagination($request->getPagination())
            ->setFilters($request->getFilters())
            ->where(new Filter([
                'name' => 'added_by',
                'kind' => new FilterKind('='),
                'value' => User::getId(),
            ]))->where(new Filter([
                'name' => 'deleted',
                'kind' => new FilterKind('='),
                'value' => 0,
            ]))->where(new Filter([
                'name' => 'debt',
                'kind' => new FilterKind('>'),
                'value' => 0,
            ]))
            ->load();

        $docs = new Debtors;
        $docs->rewind();
        $contractors->rewind();
        while($contractor = $contractors->current()){
            $documents = (new DocumentCollection)
                ->where(new Filter([
                    'name' => 'added_by',
                    'kind' => new FilterKind('='),
                    'value' => User::getId(),
                ]))->where(new Filter([
                    'name' => 'deleted',
                    'kind' => new FilterKind('='),
                    'value' => 0,
                ]))->where(new Filter([
                    'name' => 'to_pay',
                    'kind' => new FilterKind('>'),
                    'value' => 0,
                ]))->where(new Filter([
                    'name' => 'contractor_id',
                    'kind' => new FilterKind('='),
                    'value' => $contractor->getId(),
                ]))
                ->load();
            //print_r([$contractor->getId()]);
            $debtorDocuments = new DebtorDocuments;
            $documents->rewind();
            while($document = $documents->current()){
                $payDate = new \DateTime($document->getPayDate());
                $debtorDocuments->add(
                    (new DebtorDocument)
                    ->setId($document->getUuid())
                    ->setName($document->getName())
                    ->setGross($document->getGross())
                    ->setDate($document->getDate())
                    ->setToPay($document->getToPay())
                    ->setPayDate($document->getPayDate())
                    ->setPayTerm(($payDate<new \DateTime())?true:false)
                );
                $documents->next();
            }
            $docs->add(
                (new Debtor)
                    ->setId($contractor->getUuid())
                    ->setName($contractor->getName())
                    ->setCode($contractor->getCode())
                    ->setDebt($contractor->getDebt())
                    ->setDocuments($debtorDocuments)
            );
            $contractors->next();
        }

        return (new GetDebtorsResponse)
            ->setDebtors($docs)
            ->setPagination($contractors->getPagination())
            ->setFilters($contractors->getFilters());
    }
}