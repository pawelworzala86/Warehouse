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
use App\Module\Document\Request\UpdateDocumentRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Document\Model\DocumentModel;
use App\Module\Document\Response\GetDocumentsResponse;
use App\Module\Document\Collection\DocumentCollection;
use App\Request\EmptyRequest;
use App\Request\PaginationRequest;
use App\Response\SuccessResponse;
use App\Type\Document;
use App\Type\Documents;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class UpdateDocumentHandler extends Handler
{
    public function __invoke(UpdateDocumentRequest $request): SuccessResponse
    {
        $document = (new DocumentModel)
            ->load($request->getId(), true);

        $contractor = (new ContractorModel)
            ->load($request->getContractorId(), true);

        $products = $request->getProducts();

        (new DocumentModel)
            ->setId($document->getId())
            ->setUuid($document->getUuid())
            ->setName($request->getName())
            ->setContractorId($contractor->getId())
            ->setDate($request->getDate())
            ->setDescription($request->getDescription())
            ->setNet($request->getSumNet())
            ->setTax($request->getTax())
            ->setGross($request->getSumGross())
            ->setPayDate($request->getPayDate())
            ->setPayment($request->getPayment())
            ->update();

        $products->rewind();
        while ($product = $products->current()) {
            $documentProduct = (new DocumentProductModel)
                ->load($product->getId(), true);
            $documentProductId = (new DocumentProductModel)
                ->load($product->getId(), true)
                ->getId();
            $productId = $documentProduct->getProductId();
            $pro = null;
            if($documentProduct->isLoaded()) {
                $pro = (new ProductModel)
                    ->load($documentProduct->getProductId());
                $productId = $pro->getId();
            }
            $oldProduct = (new DocumentProductModel)
                ->where(new Filter([
                    'name' => 'added_by',
                    'kind' => new FilterKind('='),
                    'value' => User::getId(),
                ]))
                ->where(new Filter([
                    'name' => 'deleted',
                    'kind' => new FilterKind('='),
                    'value' => 0,
                ]))
                ->where(new Filter([
                    'name' => 'document_id',
                    'kind' => new FilterKind('='),
                    'value' => $document->getId(),
                ]))
                ->where(new Filter([
                    'name' => 'product_id',
                    'kind' => new FilterKind('='),
                    'value' => $pro?$pro->getId():null,
                ]))
                ->load();
            if($oldProduct->isLoaded()&&$documentProduct->isLoaded()){
                if($product->getDeleted()){
                    (new DocumentProductModel)
                        ->setUuid($oldProduct->getId())
                        ->delete();
                }else {
                    (new DocumentProductModel)
                        ->setUuid($product->getId())
                        ->setCount($product->getCount())
                        ->setNet($product->getNet())
                        ->setSumNet($product->getSumNet())
                        ->setSumGross($product->getSumGross())
                        ->setVat($product->getVat())
                        ->update();
                    $stock = (new StockModel)
                        ->where(new Filter([
                            'name' => 'added_by',
                            'kind' => new FilterKind('='),
                            'value' => User::getId(),
                        ]))
                        ->where(new Filter([
                            'name' => 'deleted',
                            'kind' => new FilterKind('='),
                            'value' => 0,
                        ]))
                        ->where(new Filter([
                            'name' => 'document_product_id',
                            'kind' => new FilterKind('='),
                            'value' => $documentProductId,
                        ]))
                        ->load();
                    if($stock->isLoaded()){
                        $count = $product->getCount();
                        (new StockModel)
                            ->setId($stock->getId())
                            ->setUuid($stock->getUuid())
                            ->setProductId($oldProduct->getId())
                            ->setCount($count)
                            ->setDocumentProductId($documentProductId)
                            ->update();
                    }else{
                        (new StockModel)
                            ->setUuid(Common::getUuid())
                            ->setDocumentId($document->getId())
                            ->setProductId($productId)
                            ->setCount($product->getCount())
                            ->setDocumentProductId($documentProductId)
                            ->insert();
                    }
                }
            }else {
                $documentProductId = (new DocumentProductModel)
                    ->setUuid(Common::getUuid())
                    ->setDocumentId($document->getId())
                    ->setProductId($productId)
                    ->setCount($product->getCount())
                    ->setNet($product->getNet())
                    ->setSumNet($product->getSumNet())
                    ->setSumGross($product->getSumGross())
                    ->setVat($product->getVat())
                    ->insert();
                (new StockModel)
                    ->setUuid(Common::getUuid())
                    ->setDocumentId($document->getId())
                    ->setProductId($productId)
                    ->setCount($product->getCount())
                    ->setDocumentProductId($documentProductId)
                    ->insert();
            }
            $products->next();
        }

        return (new SuccessResponse);
    }
}