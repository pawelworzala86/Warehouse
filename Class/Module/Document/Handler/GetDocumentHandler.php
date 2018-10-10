<?php

namespace App\Module\Document\Handler;

use App\Handler;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Document\Collection\DocumentProductCollection;
use App\Module\Document\Request\GetDocumentRequest;
use App\Module\Document\Model\DocumentModel;
use App\Module\Document\Response\GetDocumentResponse;
use App\Module\Production\Model\ProductionDocumentModel;
use App\Module\Production\Model\ProductionModel;
use App\Container\Address;
use App\Container\Contractor;
use App\Container\DocumentProduct;
use App\Container\DocumentProducts;
use App\Container\Filter;
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
                    ->setProductId($product->getUuid())
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

        $addressModel = (new AddressModel)
            ->load($contractor->getAddressId());
        $address = (new Address)
            //->setId($addressModel->getUuid())
            ->setName($addressModel->getName())
            ->setFirstName($addressModel->getFirstName())
            ->setLastName($addressModel->getLastName())
            ->setStreet($addressModel->getStreet())
            ->setPostcode($addressModel->getPostcode())
            ->setCity($addressModel->getCity());

        $contractorResp = (new Contractor)
            ->setId($contractor->getUuid())
            ->setName($contractor->getName())
            ->setCode($contractor->getCode())
            ->setAddress($address);

        $productionDocument = (new ProductionDocumentModel)
            ->where('document_id', '=', $document->getId())
            ->load();
        $production = (new ProductionModel)
            ->load($productionDocument->getProductionId());

        return (new GetDocumentResponse)
            ->setId($document->getUuid())
            ->setName($document->getName())
            ->setDescription($document->getDescription())
            ->setDate($document->getDate())
            ->setContractorId($contractor->getUuid())
            ->setContractor($contractorResp)
            ->setProducts($products)
            ->setNet($document->getNet())
            ->setTax($document->getTax())
            ->setGross($document->getGross())
            ->setPayDate($document->getPayDate())
            ->setPayment($document->getPayment())
            ->setBankName($document->getBankName())
            ->setSwift($document->getSwift())
            ->setBankNumber($document->getBankNumber())
            ->setIssuePlace($document->getIssuePlace())
            ->setDeliveryDate($document->getDeliveryDate())
            ->setPayed($document->getPayed())
            ->setToPay($document->getToPay())
            ->setKind($document->getKind())
            ->setType($document->getType())
            ->setNameFrom($document->getNameFrom())
            ->setProductionName($production->getName());
    }
}