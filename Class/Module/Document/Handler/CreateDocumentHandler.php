<?php

namespace App\Module\Document\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Document\Collection\StockCollection;
use App\Module\Document\Model\DocumentNumberModel;
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

        ////
        $documentNumberId = $request->getDocumentNumberId();
        $type = $request->getType();
        $numberModel = (new DocumentNumberModel)
            ->load($documentNumberId, true);
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
        }
        //$numberModel->setUuid($numberModel->getUuid());
        $number = $numberModel->getNumber()+1;
        //$numberModel->setNumber($number);
        $year = $numberModel->getYear();
        $month = $numberModel->getMonth();
        $typesNames = [
            'fvp'=>'FV-Z',
            'pz'=>'PZ',
            'fvs'=>'FV',
            'wz'=>'WZ',
        ];
        $name = $typesNames[$type].'/'.$number.'/'.$year;
        (new DocumentNumberModel)
            ->setUuid($numberModel->getUuid())
            ->setNumber($number)
            ->update();
        ////

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
            ->setBankName($request->getBankName())
            ->setSwift($request->getSwift())
            ->setBankNumber($request->getBankNumber())
            ->setIssuePlace($request->getIssuePlace())
            ->setDeliveryDate($request->getDeliveryDate())
            ->setPayed($request->getPayed())
            ->setToPay($request->getToPay())
            ->setKind($request->getKind())
            ->setType($request->getType())
            ->setNameFrom($request->getNameFrom())
            ->insert();

        $products = $request->getProducts();

        $products->rewind();
        while ($product = $products->current()) {
            $productModel = (new ProductModel)
                ->load($product->getProductId(), true);
            //print_r([$productModel]);
            $productId = $productModel->getId();

            if($request->getKind()==='add') {
                $documentProductId = ($docProd = new DocumentProductModel)
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
                    //->setAdd(1)
                    ->insert();
            }else if($request->getKind()==='dec'){
                //$oldCount = $docProd->getCount();
                //$count = $product->getCount();
                //$countDiff = $count;
                //$countDiff = $count-$oldCount;
                $count = $product->getCount();
                $stockModel = (new StockCollection)
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
                        'name' => 'product_id',
                        'kind' => new FilterKind('='),
                        'value' => $productId,
                    ]))
                    ->where(new Filter([
                        'name' => 'count',
                        'kind' => new FilterKind('>'),
                        'value' => 0,
                    ]))
                    ->order(' id asc ')
                    ->load();
                $stockModel->rewind();
                //print_r([$productId]);
                while ($stock = $stockModel->current()) {
                    //$documentProductModel = (new DocumentProductModel)
                    //    ->load($stock->getDocumentProductId());
                    //$originalCount = $documentProductModel->getCount();
                    if ($count <= 0) {
                        break;
                    }
                    //$stock->setUuid($stock->getUuid());
                    //$stockCount = $stockModel->getCount();
                    //print_r([$originalCount, $count]);
                    //$stockU = (new StockModel)
                    //    ->load($stock->getId());
                    //$stockU->setUuid($stock->getUuid());
                    $stockCount = $stock->getCount();
                    //print_r([$stock->getId()]);
                    if($stockCount>=$count){
                        //if ($stockCount - $count <= 0) {
                            //$stockU->setCount(0);
                            //$count = 0;//$stockCount;
                            //$stockU->update();
                        $documentProductId = ($docProd = new DocumentProductModel)
                            ->setUuid(Common::getUuid())
                            ->setDocumentId($documentId)
                            ->setProductId($productId)
                            ->setCount($count)
                            ->setNet($product->getNet())
                            ->setSumNet($product->getSumNet())
                            ->setSumGross($product->getSumGross())
                            ->setVat($product->getVat())
                            ->setDocumentProductId($stock->getDocumentProductId())
                            ->insert();
                            (new StockModel)
                                ->setUuid(Common::getUuid())
                                ->setDocumentId($documentId)
                                ->setProductId($productId)
                                ->setCount(-$count)
                                ->setDocumentProductId($documentProductId)
                                ->setStockId($stock->getId())
                                ->insert();
                            $count = 0;
                        /*} else {
                            //$stockU->setCount($stockCount - $count);
                            $count = 0;
                            //$stockU->update();
                            (new StockModel)
                                ->setUuid(Common::getUuid())
                                ->setDocumentId($documentId)
                                ->setProductId($productId)
                                ->setCount(-$count)
                                ->setDocumentProductId($documentProductId)
                                ->setStockId($stock->getId())
                                ->insert();
                        }*/
                    }else {
                        $documentProductId = ($docProd = new DocumentProductModel)
                            ->setUuid(Common::getUuid())
                            ->setDocumentId($documentId)
                            ->setProductId($productId)
                            ->setCount($stockCount)
                            ->setNet($product->getNet())
                            ->setSumNet($product->getSumNet())
                            ->setSumGross($product->getSumGross())
                            ->setVat($product->getVat())
                            ->setDocumentProductId($stock->getDocumentProductId())
                            ->insert();
                        /*if ($stockCount - $count <= 0) {
                            //$stockU->setCount(0);
                            $count -= $stockCount;
                            //$stockU->update();
                            (new StockModel)
                                ->setUuid(Common::getUuid())
                                ->setDocumentId($documentId)
                                ->setProductId($productId)
                                ->setCount(-$stockCount)
                                ->setDocumentProductId($documentProductId)
                                ->setStockId($stock->getId())
                                ->insert();
                        } else {*/
                            //$stockU->setCount($stockCount - $count);

                            //print_r(['update']);
                            //$stockU->update();
                            (new StockModel)
                                ->setUuid(Common::getUuid())
                                ->setDocumentId($documentId)
                                ->setProductId($productId)
                                ->setCount(-$stockCount)
                                ->setDocumentProductId($documentProductId)
                                ->setStockId($stock->getId())
                                ->insert();
                        $count -= $stockCount;
                        //}
                    }
                    $stockModel->next();
                }
                if($count>0){
                    throw new \Exception('Stock is out!');
                }
            }else{
                throw new \Exception('Kind error!');
            }
            $products->next();
        }

        return (new CreateDocumentResponse)
            ->setId($uuid);
    }
}