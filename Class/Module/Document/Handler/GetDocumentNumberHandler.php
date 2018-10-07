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
use App\Module\Document\Response\GetDocumentNumberResponse;
use App\Module\Document\Response\GetDocumentResponse;
use App\Module\Document\Response\GetDocumentsResponse;
use App\Module\Document\Collection\DocumentCollection;
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

class GetDocumentNumberHandler extends Handler
{
    public function __invoke(GetDocumentNumberRequest $request): GetDocumentNumberResponse
    {
        $type = $request->getType();

        $numberModel = (new DocumentNumberModel)
            ->where(
                (new Filter)
                ->setName('type')
                ->setKind(new FilterKind('='))
                ->setValue($type)
            )
            ->where(
                (new Filter)
                ->setName('deleted')
                ->setKind(new FilterKind('='))
                ->setValue(0)
            )
            ->load();

        if(!$numberModel->getId()){
            $id = (new DocumentNumberModel)
                ->setUuid(Common::getUuid())
                ->setNumber(0)
                ->setMonth(10)
                ->setYear(2018)
                ->setType($type)
                ->insert();
            $numberModel = (new DocumentNumberModel)
                ->load($id);
            $numberModel->setUuid($numberModel->getUuid());
        }

        $number = $numberModel->getNumber()+1;
        $numberModel->setNumber($number);

        $year = $numberModel->getYear();
        $month = $numberModel->getMonth();

        $typesNames = [
            'fvp'=>'FV-Z',
            'pz'=>'PZ',
            'pw'=>'PW',

            'fvs'=>'FV',
            'wz'=>'WZ',
            'rw'=>'RW',

            'ord'=>'Z',
        ];

        $name = $typesNames[$type].'/'.$number.'/'.$year;

        return (new GetDocumentNumberResponse)
            ->setName($name)
            ->setDocumentNumberId($numberModel->getUuid());
    }
}