<?php

namespace App\Module\Document\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Document\Collection\DocumentProductCollection;
use App\Module\Document\Model\DocumentProductModel;
use App\Module\Document\Request\GetDocumentRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Document\Model\DocumentModel;
use App\Module\Document\Response\GetDocumentResponse;
use App\Module\Document\Response\GetDocumentsResponse;
use App\Module\Document\Collection\DocumentCollection;
use App\Request\EmptyRequest;
use App\Request\PaginationRequest;
use App\Response\SuccessResponse;
use App\Type\Document;
use App\Type\DocumentProduct;
use App\Type\DocumentProducts;
use App\Type\Documents;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class GetDocumentHandler extends Handler
{
    public function __invoke(GetDocumentRequest $request): GetDocumentResponse
    {
        $document = (new DocumentModel)
            ->load($request->getId(), true);

        $contractor = (new ContractorModel)
            ->load($document->getContractorId());

        $productsCollection = (new DocumentProductCollection)
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
            ->load();

        $products = new DocumentProducts;

        $productsCollection->rewind();
        while ($prod = $productsCollection->current()) {
            $product = (new ProductModel)
                ->load($prod->getProductId());
            $products->add(
                (new DocumentProduct)
                    ->setId($prod->getUuid())
                    ->setName($product->getName())
                    ->setSku($product->getSku())
                    ->setCount($prod->getCount())
                    ->setNet($prod->getNet())
                    ->setVat($prod->getVat())
                    ->setSumNet($prod->getSumNet())
                    ->setSumGross($prod->getSumGross())
            );
            $productsCollection->next();
        }
        $products->rewind();

        return (new GetDocumentResponse)
            ->setId($document->getUuid())
            ->setName($document->getName())
            ->setContractorId($contractor->getUuid())
            ->setProducts($products);
    }
}