<?php

namespace App\Module\Order\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Document\Model\DocumentNumberModel;
use App\Module\Order\Model\OrderModel;
use App\Module\Order\Model\OrderProductModel;
use App\Module\Order\Request\CreateOrderRequest;
use App\Module\Order\Response\CreateOrderResponse;
use App\Response\SuccessResponse;

class CreateOrderHandler extends Handler
{
    public function __invoke(CreateOrderRequest $request): CreateOrderResponse
    {
        (new ContractorModel)->start();

        $contractorModel = (new ContractorModel)
            ->load($request->getContractorId(), true);

        $documentNumberId = $request->getDocumentNumberId();
        $type = 'ord';
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
        $number = $numberModel->getNumber()+1;
        $year = $numberModel->getYear();
        $month = $numberModel->getMonth();
        $typesNames = [
            'fvp'=>'FV-Z',
            'pz'=>'PZ',
            'fvs'=>'FV',
            'wz'=>'WZ',
            'ord'=>'Z',
        ];
        $name = $typesNames[$type].'/'.$number.'/'.$year;
        (new DocumentNumberModel)
            ->setUuid($numberModel->getUuid())
            ->setNumber($number)
            ->update();

        $orderUuid = Common::getUuid();
        $orderId = (new OrderModel)
            ->setUuid($orderUuid)
            ->setNumber($name)
            ->setContractorId($contractorModel->getId())
            ->setAddressId($contractorModel->getAddressId())
            ->setDate($request->getDate())
            ->setSumNet($request->getSumNet())
            ->setSumVat($request->getSumVat())
            ->setSumGross($request->getSumGross())
            ->insert();

        $products = $request->getProducts();
        $products->rewind();
        while($product = $products->current()){
            $productModel = (new ProductModel)
                ->load($product->getId(), true);
            (new OrderProductModel)
                ->setUuid(Common::getUuid())
                ->setOrderId($orderId)
                ->setProductId($productModel->getId())
                ->setCount($product->getCount())
                ->setNet($product->getNet())
                ->setSumNet($product->getSumNet())
                ->setSumGross($product->getSumGross())
                ->setVat($product->getVat())
                ->insert();
            $products->next();
        }

        (new ContractorModel)->commit();

        return (new CreateOrderResponse)
            ->setId($orderUuid);
    }
}