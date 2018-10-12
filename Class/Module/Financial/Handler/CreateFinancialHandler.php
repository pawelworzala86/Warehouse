<?php

namespace App\Module\Financial\Handler;

use App\Common;
use App\Handler;
use App\Module\Cash\Model\CashDocumentModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Document\Collection\StockCollection;
use App\Module\Document\Model\DocumentNumberModel;
use App\Module\Document\Model\DocumentProductModel;
use App\Module\Document\Model\StockModel;
use App\Module\Document\Request\CreateDocumentRequest;
use App\Module\Document\Model\DocumentModel;
use App\Module\Document\Response\CreateDocumentResponse;
use App\Module\Financial\Model\FinancialModel;
use App\Module\Financial\Request\CreateFinancialRequest;
use App\Module\Financial\Response\CreateFinancialResponse;
use App\Module\Production\Model\ProductionDocumentModel;
use App\Module\Production\Model\ProductionModel;
use App\Module\User\Model\UserModel;
use App\Container\Filter;
use App\Type\FilterKind;
use App\User;

class CreateFinancialHandler extends Handler
{
    public function __invoke(CreateFinancialRequest $request): CreateFinancialResponse
    {
        $uuid = Common::getUuid();

        (new FinancialModel)
            ->setUuid($uuid)
            ->setDate($request->getDate())
            ->setAmount($request->getAmount())
            ->insert();

        return (new CreateFinancialResponse)
            ->setId($uuid);
    }
}