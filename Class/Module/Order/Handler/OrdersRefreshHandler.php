<?php

namespace App\Module\Order\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Document\Collection\DocumentProductCollection;
use App\Module\Document\Collection\DocumentProductViewCollection;
use App\Module\Document\Collection\DocumentViewCollection;
use App\Module\Document\Model\DocumentProductModel;
use App\Module\Document\Request\GetDocumentRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Document\Model\DocumentModel;
use App\Module\Document\Response\GetDocumentResponse;
use App\Module\Document\Response\GetDocumentsResponse;
use App\Module\Document\Collection\DocumentCollection;
use App\Module\Order\Model\OrderModel;
use App\Module\Order\Model\OrderProductModel;
use App\Request\EmptyRequest;
use App\Request\PaginationRequest;
use App\Response\SuccessResponse;
use App\Type\Address;
use App\Type\Contractor;
use App\Type\Document;
use App\Type\DocumentProduct;
use App\Type\DocumentProducts;
use App\Type\Documents;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class OrdersRefreshHandler extends Handler
{
    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        $orderId = (new OrderModel)
            ->setUuid(Common::getUuid())
            ->setNumber('number 1')
            ->setContractorId(1)
            ->setAddressId(1)
            ->insert();

        (new OrderProductModel)
            ->setUuid(Common::getUuid())
            ->setProductId(1)
            ->setOrderId($orderId)
            ->setCount(1)
            ->setNet(10)
            ->setVat('23')
            ->setSumNet(10)
            ->setSumGross(12.3)
            ->insert();

        return new SuccessResponse;
    }
}