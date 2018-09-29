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
            ->update();

        $products->rewind();
        while($product = $products->current()){
            $pro = (new ProductModel)
                ->load($product->getId(), true);
            (new DocumentProductModel)
                ->setUuid(Common::getUuid())
                ->setDocumentId($document->getId())
                ->setProductId($pro->getId())
                ->setCount($product->getCount())
                ->insert();
            $products->next();
        }

        return (new SuccessResponse);
    }
}