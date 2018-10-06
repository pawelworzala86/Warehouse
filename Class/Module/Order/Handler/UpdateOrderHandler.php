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
use App\Module\Order\Request\UpdateOrderRequest;
use App\Module\Order\Response\CreateOrderResponse;
use App\Response\SuccessResponse;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class UpdateOrderHandler extends Handler
{
    public function __invoke(UpdateOrderRequest $request): SuccessResponse
    {
        (new ContractorModel)->start();

        $contractorModel = (new ContractorModel)
            ->load($request->getContractorId(), true);

        $orderModel = (new OrderModel)
            ->load($request->getId(), true);
        $orderId = $orderModel->getId();

        (new OrderModel)
            ->setUuid($request->getOrderId())
            ->setNumber($request->getName())
            ->setContractorId($contractorModel->getId())
            ->setAddressId($contractorModel->getAddressId())
            ->setDate($request->getDate())
            ->setSumNet($request->getSumNet())
            ->setSumVat($request->getSumVat())
            ->setSumGross($request->getSumGross())
            ->update();

        $products = $request->getProducts();
        $products->rewind();
        while($product = $products->current()){
            $productModel = (new ProductModel)
                ->load($product->getProductId(), true);
            $orderProductModel = (new OrderProductModel)
                ->where(
                    (new Filter)
                        ->setName('added_by')
                        ->setKind(new FilterKind('='))
                        ->setValue(User::getId())
                )->where(
                    (new Filter)
                        ->setName('deleted')
                        ->setKind(new FilterKind('='))
                        ->setValue(0)
                )->where(
                    (new Filter)
                        ->setName('order_id')
                        ->setKind(new FilterKind('='))
                        ->setValue($orderId)
                )->where(
                    (new Filter)
                        ->setName('product_id')
                        ->setKind(new FilterKind('='))
                        ->setValue($productModel->getId())
                )->load();
            if($product->getDeleted()==true){
               (new OrderProductModel)
                    ->setUuid($orderProductModel->getUuid())
                    ->delete();
            }else {
                if($orderProductModel->getId()){
                    (new OrderProductModel)
                        ->setUuid($orderProductModel->getUuid())
                        ->setOrderId($orderId)
                        ->setProductId($productModel->getId())
                        ->setCount($product->getCount())
                        ->setNet($product->getNet())
                        ->setSumNet($product->getSumNet())
                        ->setSumGross($product->getSumGross())
                        ->setVat($product->getVat())
                        ->update();
                }else {
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
                }
            }
            $products->next();
        }

        (new ContractorModel)->commit();

        return new SuccessResponse;
    }
}