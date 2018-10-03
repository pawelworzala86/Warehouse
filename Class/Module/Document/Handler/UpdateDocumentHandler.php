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
            ->setBankName($request->getBankName())
            ->setSwift($request->getSwift())
            ->setBankNumber($request->getBankNumber())
            ->setIssuePlace($request->getIssuePlace())
            ->setDeliveryDate($request->getDeliveryDate())
            ->setPayed($request->getPayed())
            ->setToPay($request->getToPay())
            ->setKind($request->getKind())
            ->update();

        $products->rewind();
        while ($product = $products->current()) {
            $documentProduct = (new DocumentProductModel)
                ->load($product->getId(), true);
            $documentProductId = $documentProduct->getId();
            $productId = $documentProduct->getProductId();
            /*$pro = null;
            if($documentProduct->getId()) {
                $pro = (new ProductModel)
                    ->load($documentProduct->getProductId());
                $productId = $pro->getId();
            }*/
            $oldProduct = (new DocumentProductModel)
                ->load($documentProduct->getProductId());
            if($product->getProductId()){
                $productModel = (new ProductModel)
                    ->load($documentProduct->getProductId());
                if($product->getDeleted()){
                    (new DocumentProductModel)
                        ->setUuid($oldProduct->getUuid())
                        ->delete();
                    //poprawki w stock dla dec i add
                }else {
                    (new DocumentProductModel)
                        ->setId($documentProductId)
                        ->setCount($product->getCount())
                        ->setNet($product->getNet())
                        ->setSumNet($product->getSumNet())
                        ->setSumGross($product->getSumGross())
                        ->setVat($product->getVat())
                        ->update();
                    /*$stock = (new StockModel)
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
                    if($stock->getId()){*/
                    //print_r([$request->getKind()]);
                        if($request->getKind()==='dec') {
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
                                    'value' => $productModel->getId(),
                                ]))
                                /*->where(new Filter([
                                    'name' => 'document_id',
                                    'kind' => new FilterKind('='),
                                    'value' => $document->getId(),
                                ]))*/
                                /*->where(new Filter([
                                    'name' => 'count',
                                    'kind' => new FilterKind('>'),
                                    'value' => 0,
                                ]))*/
                                ->order(' id desc ')
                                ->load();
                            $stockModel->rewind();
                            //print_r([$productModel->getId(), $count, $stockModel]);
                            while ($stock = $stockModel->current()) {
                                $documentProductModel = (new DocumentProductModel)
                                    ->load($stock->getDocumentProductId());
                                //$originalCount = $documentProductModel->getCount();
                                if (!($count > 0)) {
                                    break;
                                }
                                $stock->setUuid($stock->getUuid());
                                $stockCount = $stock->getCount();
                                //print_r([$originalCount, $count]);
                                $stockU = (new StockModel)
                                    ->load($stock->getId());
                                $stockU->setUuid($stock->getUuid());
                                //$stockCount = $stockCount-$stockU->getCount();
                                if($stockCount<=$count){
                                    if ($stockCount - $count <= 0) {
                                        $stockU->setCount(0);
                                        $count -= $stockCount;
                                        $stockU->update();
                                    } else {
                                        $stockU->setCount($stockCount - $count);
                                        $count = 0;
                                        $stockU->update();
                                    }
                                }else {
                                    if ($stockCount - $count <= 0) {
                                        $stockU->setCount(0);
                                        $count -= $stockCount;
                                        $stockU->update();
                                    } else {
                                        $stockU->setCount($stockCount - $count);
                                        $count = 0;
                                        $stockU->update();
                                    }
                                }
                                $stockModel->next();
                            }
                            if($count>0){
                                $productModel = (new ProductModel)
                                    ->load($product->getId(), true);
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
                                        'value' => $productModel->getId(),
                                    ]))
                                    ->where(new Filter([
                                        'name' => 'count',
                                        'kind' => new FilterKind('>'),
                                        'value' => 0,
                                    ]))
                                    ->order(' id asc ')
                                    ->load();
                                $stockModel->rewind();
                                while($stock = $stockModel->current()){
                                    if(!($count>0)){
                                        break;
                                    }
                                    $stockU = (new StockModel)
                                        ->load($stock->getId());
                                    $stockU->setUuid($stock->getUuid());
                                    $stockCount = $stock->getCount();
                                    //print_r([$stockCount, $count]);
                                    if($stockCount-$count<=0){
                                        $stockU->setCount(0);
                                        $count -= $stockCount;
                                        $stockU->update();
                                    }else{
                                        $stockU->setCount($stockCount-$count);
                                        $count = 0;
                                        $stockU->update();
                                    }
                                    $stockModel->next();
                                }
                            }
                        }else if($request->getKind()==='add'){
                            /*if($stock->getId()){
                                $oldCount = $oldProduct->getCount();
                                $newCount = $product->getCount();
                                $count = $oldCount+($newCount-$oldCount);
                                (new StockModel)
                                    ->setId($stock->getId())
                                    ->setUuid($stock->getUuid())
                                    ->setProductId($oldProduct->getId())
                                    ->setCount($count)
                                    ->setDocumentProductId($documentProductId)
                                    ->update();
                            }else{*/
                                $productModel = (new ProductModel)
                                    ->load($product->getId(), true);
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
                                        'value' => $productModel->getId(),
                                    ]))
                                    ->where(new Filter([
                                        'name' => 'count',
                                        'kind' => new FilterKind('>'),
                                        'value' => 0,
                                    ]))
                                    ->order(' id asc ')
                                    ->load();
                                $stockModel->rewind();
                                while($stock = $stockModel->current()){
                                    if(!($count>0)){
                                        break;
                                    }
                                    $stockU = (new StockModel)
                                        ->load($stock->getId());
                                    $stockU->setUuid($stock->getUuid());
                                    $stockCount = $stock->getCount();
                                    //print_r([$stockCount, $count]);
                                    if($stockCount-$count<=0){
                                        $stockU->setCount(0);
                                        $count -= $stockCount;
                                        $stockU->update();
                                    }else{
                                        $stockU->setCount($stockCount-$count);
                                        $count = 0;
                                        $stockU->update();
                                    }
                                    $stockModel->next();
                                /*}(new StockModel)
                                    ->setUuid(Common::getUuid())
                                    ->setDocumentId($document->getId())
                                    ->setProductId($productId)
                                    ->setCount($product->getCount())
                                    ->setDocumentProductId($documentProductId)
                                    ->insert();*/
                            }
                        }
                    /*}else{
                        if($request->getKind()==='dec'){
                            if($stock->getId()){
                                $oldCount = $oldProduct->getCount();
                                $newCount = $product->getCount();
                                $count = $oldCount+($newCount-$oldCount);
                                (new StockModel)
                                    ->setId($stock->getId())
                                    ->setUuid($stock->getUuid())
                                    ->setProductId($oldProduct->getId())
                                    ->setCount($count)
                                    ->setDocumentProductId($documentProductId)
                                    ->update();
                            }else{
                                $productModel = (new ProductModel)
                                    ->load($product->getId(), true);
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
                                        'value' => $productModel->getId(),
                                    ]))
                                    ->where(new Filter([
                                        'name' => 'count',
                                        'kind' => new FilterKind('>'),
                                        'value' => 0,
                                    ]))
                                    ->order(' id asc ')
                                    ->load();
                                $stockModel->rewind();
                                while($stock = $stockModel->current()){
                                    if(!($count>0)){
                                        break;
                                    }
                                    $stockU = (new StockModel)
                                        ->load($stock->getId());
                                    $stockU->setUuid($stock->getUuid());
                                    $stockCount = $stock->getCount();
                                    //print_r([$stockCount, $count]);
                                    if($stockCount-$count<=0){
                                        $stockU->setCount(0);
                                        $count -= $stockCount;
                                        $stockU->update();
                                    }else{
                                        $stockU->setCount($stockCount-$count);
                                        $count = 0;
                                        $stockU->update();
                                    }
                                    $stockModel->next();
                                }
                                if($count>0){
                                    $productModel = (new ProductModel)
                                        ->load($product->getId(), true);
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
                                            'value' => $productModel->getId(),
                                        ]))
                                        ->where(new Filter([
                                            'name' => 'count',
                                            'kind' => new FilterKind('>'),
                                            'value' => 0,
                                        ]))
                                        ->order(' id asc ')
                                        ->load();
                                    $stockModel->rewind();
                                    while($stock = $stockModel->current()){
                                        if(!($count>0)){
                                            break;
                                        }
                                        $stockU = (new StockModel)
                                            ->load($stock->getId());
                                        $stockU->setUuid($stock->getUuid());
                                        $stockCount = $stock->getCount();
                                        //print_r([$stockCount, $count]);
                                        if($stockCount-$count<=0){
                                            $stockU->setCount(0);
                                            $count -= $stockCount;
                                            $stockU->update();
                                        }else{
                                            $stockU->setCount($stockCount-$count);
                                            $count = 0;
                                            $stockU->update();
                                        }
                                        $stockModel->next();
                                    }
                                }
                            }
                        }else if($request->getKind()==='add'){
                            (new StockModel)
                                ->setUuid(Common::getUuid())
                                ->setDocumentId($document->getId())
                                ->setProductId($productModel->getId())
                                ->setCount($product->getCount())
                                ->setDocumentProductId($documentProductId)
                                ->insert();
                        }*/
                    //}
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