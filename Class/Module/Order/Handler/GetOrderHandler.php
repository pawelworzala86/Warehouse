<?php

namespace App\Module\Order\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Document\Model\DocumentNumberModel;
use App\Module\Order\Collection\OrderProductCollection;
use App\Module\Order\Model\OrderModel;
use App\Module\Order\Model\OrderProductModel;
use App\Module\Order\Request\CreateOrderRequest;
use App\Module\Order\Request\GetOrderRequest;
use App\Module\Order\Response\CreateOrderResponse;
use App\Module\Order\Response\GetOrderResponse;
use App\Response\SuccessResponse;
use App\Type\DocumentProduct;
use App\Type\DocumentProducts;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class GetOrderHandler extends Handler
{
    public function __invoke(GetOrderRequest $request): GetOrderResponse
    {
        $orderUuid = $request->getOrderId();
        $order = (new OrderModel)
            ->load($orderUuid, true);

        $contractor = (new ContractorModel)
            ->load($order->getContractorId());

        $products = new DocumentProducts;

        $productsCollection = (new OrderProductCollection)
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
                    ->setValue($order->getId())
            )->load();
        $productsCollection->rewind();
        while ($product = $productsCollection->current()) {
            $productModel = (new ProductModel)
                ->load($product->getProductId());
            $products->add(
                (new DocumentProduct)
                    ->setId($productModel->getUuid())
                    ->setNet($product->getNet())
                    ->setVat($product->getVat())
                    ->setSumGross($product->getSumGross())
                    ->setSumNet($product->getSumNet())
                    ->setSku($product->getSku())
                    ->setName($product->getName())
                    ->setCount($product->getCount())
                    ->setProductId($productModel->getUuid())
            );
            $productsCollection->next();
        }

        return (new GetOrderResponse)
            ->setId($order->getUuid())
            ->setName($order->getNumber())
            ->setContractorId($contractor->getUuid())
            ->setProducts($products)
            ->setDate($order->getDate())
            ->setSumNet($order->getSumNet())
            ->setSumVat($order->getSumVat())
            ->setSumGross($order->getSumGross());
    }
}