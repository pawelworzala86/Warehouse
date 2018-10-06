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
use App\Module\Document\Request\AddInvoiceRequest;
use App\Module\Document\Request\CreateDocumentRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Document\Model\DocumentModel;
use App\Module\Document\Response\AddInvoiceResponse;
use App\Module\Document\Response\CreateDocumentResponse;
use App\Module\Document\Response\GetDocumentsResponse;
use App\Module\Document\Collection\DocumentCollection;
use App\Module\Order\Collection\OrderProductCollection;
use App\Module\Order\Model\OrderModel;
use App\Module\User\Model\UserModel;
use App\Request\EmptyRequest;
use App\Request\PaginationRequest;
use App\Response\SuccessResponse;
use App\Type\Contractor;
use App\Type\Document;
use App\Type\Documents;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class AddInvoiceHandler extends Handler
{
    public function __invoke(AddInvoiceRequest $request): AddInvoiceResponse
    {
        (new ContractorModel)->start();

        $order = (new OrderModel)
            ->load($request->getOrderId(), true);

        $contractor = (new ContractorModel)
            ->load($order->getContractorId());

        ////
        //$documentNumberId = $request->getDocumentNumberId();
        $type = 'fvs';
        $documentNumber = (new DocumentNumberModel)
            ->where(
                (new Filter)
                ->setName('type')
                ->setKind(new FilterKind('='))
                ->setValue($type)
            )
            ->where(
                (new Filter)
                    ->setName('added_by')
                    ->setKind(new FilterKind('='))
                    ->setValue(User::getId())
            )
            ->where(
                (new Filter)
                    ->setName('deleted')
                    ->setKind(new FilterKind('='))
                    ->setValue(0)
            )
            ->load();
        $id = $documentNumber->getId();
        if(!$documentNumber->getNumber()) {
            $id = (new DocumentNumberModel)
                ->setUuid(Common::getUuid())
                ->setNumber(0)
                ->setMonth(10)
                ->setYear(2018)
                ->setType($type)
                ->insert();
        }
        $numberModel = (new DocumentNumberModel)
                ->load($id);
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

        $user = (new UserModel)
            ->load(User::getId());

        $uuid = Common::getUuid();
        $documentId = (new DocumentModel)
            ->setUuid($uuid)
            ->setName($name)
            ->setContractorId($contractor->getId())
            ->setDate(date("Y-m-d", time()))
            ->setDescription('')
            ->setNet($order->getSumNet())
            ->setTax($order->getSumGross()-$order->getSumNet())
            ->setGross($order->getSumGross())
            ->setPayDate(date("Y-m-d", time()))
            ->setPayment('wire')
            ->setBankName($user->getBankName())
            ->setSwift($user->getBankSwift())
            ->setBankNumber($user->getBankNumber())
            ->setIssuePlace($user->getIssuePlace())
            ->setDeliveryDate(date("Y-m-d", time()))
            ->setPayed($order->getTotalPaid())
            ->setToPay($order->getSumGross()-$order->getTotalPaid())
            ->setKind('dec')
            ->setType('fvs')
            ->setNameFrom('')
            ->insert();

        $products = (new OrderProductCollection)
            ->where(
                (new Filter)
                ->setName('order_id')
                ->setKind(new FilterKind('='))
                ->setValue($order->getId())
            )
            ->load();

        $products->rewind();
        while ($product = $products->current()) {
            $productModel = (new ProductModel)
                ->load($product->getProductId());
            //print_r([$productModel]);
            $productId = $productModel->getId();
            $count = $product->getCount();
            if($product->getName()=='Przesyłka'){
                (new DocumentProductModel)
                    ->setUuid(Common::getUuid())
                    ->setDocumentId($documentId)
                    ->setProductId($productId)
                    ->setCount(1)
                    ->setNet($product->getNet())
                    ->setSumNet($product->getSumNet())
                    ->setSumGross($product->getSumGross())
                    ->setVat($product->getVat())
                    //->setDocumentProductId($stock->getDocumentProductId())
                    ->insert();
                $products->next();
                $count = 0;
                continue;
            }
            /*if($request->getKind()==='add') {
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
            }else if($request->getKind()==='dec'){*/
                //$oldCount = $docProd->getCount();
                //$count = $product->getCount();
                //$countDiff = $count;
                //$countDiff = $count-$oldCount;

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
                //print_r([$stockModel]);
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
            /*}else{
                throw new \Exception('Kind error!');
            }*/
            $products->next();
        }

        (new OrderModel)
            ->setUuid($order->getUuid())
            ->setDocumentId($documentId)
            ->update();

        (new ContractorModel)->commit();

        return (new AddInvoiceResponse)
            ->setId($uuid)
            ->setNumber($name);
    }
}