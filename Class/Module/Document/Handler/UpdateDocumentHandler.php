<?php

namespace App\Module\Document\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Document\Collection\StockCollection;
use App\Module\Document\Model\DocumentProductModel;
use App\Module\Document\Model\StockModel;
use App\Module\Document\Request\UpdateDocumentRequest;
use App\Module\Document\Model\DocumentModel;
use App\Module\User\Model\UserModel;
use App\Response\SuccessResponse;
use App\Container\Filter;
use App\Type\FilterKind;
use App\User;

class UpdateDocumentHandler extends Handler
{
    public function __invoke(UpdateDocumentRequest $request): SuccessResponse
    {
        (new ContractorModel)->start();

        $document = (new DocumentModel)
            ->load($request->getId(), true);

        $contractor = (new ContractorModel)
            ->load($request->getContractorId(), true);

        $products = $request->getProducts();

        $documentId = $document->getId();

        $user = (new UserModel)
            ->load(User::getId());

        (new DocumentModel)
            ->setId($document->getId())
            ->setUuid($document->getUuid())
            ->setName($request->getName())
            ->setContractorId($contractor->getId())
            ->setContractorAddressId($contractor->getAddressId())
            ->setOwnerAddressId($user->getAddressId())
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
                            'kind' => new FilterKind('<'),
                            'value' => 0,
                        ]))
                        ->where(new Filter([
                            'name' => 'document_product_id',
                            'kind' => new FilterKind('='),
                            'value' => $documentProductId,
                        ]))
                        //->order(' id desc ')
                        ->load();
                    $stockModel->rewind();
                    while ($stock = $stockModel->current()) {
                        $oldStock = (new StockModel)
                            ->load($stock->getId());
                        $oldStock->setUuid($oldStock->getUuid());
                        $oldStock->delete();
                        $stockModel->next();
                    }
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
                            'name' => 'product_id',
                            'kind' => new FilterKind('='),
                            'value' => $productId,
                        ]))
                        ->where(new Filter([
                            'name' => 'document_product_id',
                            'kind' => new FilterKind('='),
                            'value' => $documentProductId,
                        ]))
                        //->order(' id desc ')
                        ->load();
                    if($request->getKind()==='add') {
                        if($stock->getId()){
                            $st = (new StockModel)
                                ->load($stock->getId());
                            $st->setUuid($st->getUuid())
                                ->setCount($product->getCount())
                                ->update();
                        }else {
                            (new StockModel)
                                ->setUuid(Common::getUuid())
                                ->setDocumentId($documentId)
                                ->setProductId($productId)
                                ->setCount($product->getCount())
                                ->setDocumentProductId($documentProductId)
                                //->setAdd(1)
                                ->insert();
                        }
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
                            ->order(' id desc ')
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

        (new ContractorModel)->commit();

        return (new SuccessResponse);
    }
}