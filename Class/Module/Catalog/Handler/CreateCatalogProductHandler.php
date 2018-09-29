<?php

namespace App\Module\Catalog\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Response\ErrorResponse;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;
use Complex\Exception;

class CreateCatalogProductHandler extends Handler
{
    public function __invoke(CreateCatalogProductRequest $request)
    {
        $productModel = new ProductModel;
        $productModel
            ->where(
                (new Filter)
                ->setName('sku')
                ->setKind(new FilterKind('='))
                ->setValue($request->getSku())
            )->where(
                (new Filter)
                ->setName('deleted')
                ->setKind(new FilterKind('='))
                ->setValue(0)
            )->where(
                (new Filter)
                ->setName('added_by')
                ->setKind(new FilterKind('='))
                ->setValue(User::getId())
            )
            ->load();

        if($productModel->isLoaded()){
            return (new ErrorResponse)
                ->setMessages(['SKU exists in other product!']);
        }

        $uuid = Common::getUuid();
        (new ProductModel)
            ->setUuid($uuid)
            ->setSku($request->getSku())
            ->setName($request->getName())
            ->setDescriptionShort($request->getDescriptionShort())
            ->setDescriptionFull($request->getDescriptionFull())
            ->setPartial($request->getPartial())
            ->setToSell($request->getToSell())
            ->setSellNet($request->getSellNet())
            ->setSellGross($request->getSellGross())
            ->setVat($request->getVat())
            ->insert();
        return (new CreateCatalogProductResponse)
            ->setId($uuid);
    }
}