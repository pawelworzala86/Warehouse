<?php

namespace App\Module\Stock\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Document\Model\StockModel;
use App\Module\Document\Response\GetDocumentsResponse;
use App\Module\Document\Collection\DocumentCollection;
use App\Module\Stock\Model\StockViewModel;
use App\Module\Stock\Request\GetStockRequest;
use App\Module\Stock\Response\GetStockResponse;
use App\Module\Stock\Response\GetStocksResponse;
use App\Module\Stock\Collection\StockViewCollection;
use App\Request\EmptyRequest;
use App\Request\PaginationRequest;
use App\Response\SuccessResponse;
use App\Type\Document;
use App\Type\Documents;
use App\Type\Filter;
use App\Type\FilterKind;
use App\Type\Stock;
use App\Type\Stocks;
use App\User;

class GetStockHandler extends Handler
{
    public function __invoke(GetStockRequest $request): GetStockResponse
    {
        $uuid = $request->getProductId();

        $stock = (new StockViewModel)
            ->load($uuid, true);

        return (new GetStockResponse)
            ->setId($stock->getUuid())
            ->setSku($stock->getSku())
            ->setName($stock->getName())
            ->setCount($stock->getCount());
    }
}