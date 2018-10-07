<?php

namespace App\Module\Document\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Document\Collection\DocumentProductCollection;
use App\Module\Document\Model\DocumentNumberModel;
use App\Module\Document\Model\DocumentProductModel;
use App\Module\Document\Request\GetDocumentNumberRequest;
use App\Module\Document\Request\GetDocumentRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Document\Model\DocumentModel;
use App\Module\Document\Response\GetDocumentDefaultResponse;
use App\Module\Document\Response\GetDocumentNumberResponse;
use App\Module\Document\Response\GetDocumentResponse;
use App\Module\Document\Response\GetDocumentsResponse;
use App\Module\Document\Collection\DocumentCollection;
use App\Module\User\Model\UserModel;
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

class GetDocumentDefaultHandler extends Handler
{
    public function __invoke(EmptyRequest $request): GetDocumentDefaultResponse
    {
        $userModel = (new UserModel)
            ->load(User::getId());

        return (new GetDocumentDefaultResponse)
            ->setBankName($userModel->getBankName())
            ->setBankSwift($userModel->getBankSwift())
            ->setBankNumber($userModel->getBankNumber())
            ->setIssuePlace($userModel->getIssuePlace());
    }
}