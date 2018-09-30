<?php

namespace App\Module\Document\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Document\Model\DocumentProductModel;
use App\Module\Document\Model\StockModel;
use App\Module\Document\Request\CreateDocumentRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Document\Model\DocumentModel;
use App\Module\Document\Response\CreateDocumentResponse;
use App\Module\Document\Response\GetDocumentsResponse;
use App\Module\Document\Collection\DocumentCollection;
use App\Request\EmptyRequest;
use App\Request\PaginationRequest;
use App\Response\SuccessResponse;
use App\Type\Contractor;
use App\Type\Document;
use App\Type\Documents;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class CreateDocumentHandler extends Handler
{
    public function __invoke(CreateDocumentRequest $request): CreateDocumentResponse
    {
        $contractor = (new ContractorModel)
            ->load($request->getContractorId(), true);

        $uuid = Common::getUuid();
        $documentId = (new DocumentModel)
            ->setUuid($uuid)
            ->setName($request->getName())
            ->setContractorId($contractor->getId())
            ->setDate($request->getDate())
            ->setDescription($request->getDescription())
            ->setNet($request->getSumNet())
            ->setTax($request->getTax())
            ->setGross($request->getSumGross())
            ->setPayDate($request->getPayDate())
            ->setPayment($request->getPayment())
            ->insert();

        $products = $request->getProducts();

        $products->rewind();
        while ($product = $products->current()) {
            $productModel = (new ProductModel)
                ->load($product->getId(), true);
            $productId = $productModel->getId();
            $documentProductId = (new DocumentProductModel)
                    ->setUuid(Common::getUuid())
                    ->setDocumentId($documentId)
                    ->setProductId($productId)
                    ->setCount($product->getCount())
                    ->setNet($product->getNet())
                    ->setSumNet($product->getSumNet())
                    ->setSumGross($product->getSumGross())
                    ->setVat($product->getVat())
                    ->insert();
                (new StockModel)
                    ->setUuid(Common::getUuid())
                    ->setDocumentId($documentId)
                    ->setProductId($productId)
                    ->setCount($product->getCount())
                    ->setDocumentProductId($documentProductId)
                    ->insert();
            $products->next();
        }

        return (new CreateDocumentResponse)
            ->setId($uuid);
    }
}